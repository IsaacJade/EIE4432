<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title>Registering</title>
</head>

<body>
	
	
  <?php 
    session_start(); 
    @$_SESSION["username"]=$_POST["username"]; 
    @$_SESSION["password"]=$_POST['password']; 
  	@$_SESSION["email"]=$_POST["email"];
	@$city=$_POST['city'];
	$_SESSION["gender"]=$_POST['gender'];
	$_SESSION["birthday"]=$_POST['birthday'];
	$_SESSION["profile"]="profiles/index".$_POST["profile"].".jpg";
    @$con=mysqli_connect("localhost","root",""); 
	$username=$_SESSION["username"];
	$password=$_SESSION["password"];
	$email=$_SESSION["email"];
	$gender=$_SESSION["gender"];
	$birthday=$_SESSION["birthday"];
	$profile=$_SESSION["profile"];
	
    if (!$con) { 
      die ('Database connection failed'.$mysql_error()); 
    } 
	mysqli_select_db($con,"users");
    //mysql_select_db("users",$con); 
    $dbusername=null; 
    $dbpassword=null; 
	$dbemail=null;
	$dbcity=null;
	$dbgender=null;
	$dbbirthday=null;
	$query="select * from `users` where username ='{$username}'";
    $result=mysqli_query($con,$query);
	
	//if(!$result) die("no information");
	
    while ($row=mysqli_fetch_array($result)) { 
      $dbusername=$row["username"]; 
      $dbpassword=$row["password"];
	  $dbcity=$row["city"];
	  $dbemail=$row["email"];
	  $dbgender=$row["gender"];
		$dbbirthday=$row["birthday"];
    } 
    if(!is_null($dbusername)){ 
		
		
  ?> 
  <script type="text/javascript"> 
    alert("User existed"); 
	<?php session_destroy(); ?>
    window.location.href="register.php";
  </script> 
	<?php
	}
		if(!is_null($dbemail)){
	?>
	<script type="text/javascript">
		alert("The mailbox is already occupied");
		<?php session_destroy(); ?>
		window.location.href="register.php";
	</script>
  <?php 
    } 
	
    $con->query("insert into `users` (username,`password`,email,city,profile,birthday,gender) values('".$_SESSION["username"]."','".$_SESSION["password"]."','{$email}','{$city}','{$profile}','{$birthday}','{$gender}')") or die("Fail to write into database" .mysqli_error($con)) ; 
    $con->close();
  ?> 
  <script type="text/javascript"> 
    alert("Registration Success"); 
	<?php session_destroy();?>
    window.location.href="login.html"; 
  </script> 
	
</body>
</html>
