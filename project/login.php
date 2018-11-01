<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
	
	
  <?php 
    session_start(); 
    @$_SESSION["username"]=$_POST["username"]; 
    @$_SESSION["password"]=$_POST['password']; 
  	
	
	$con=mysqli_connect("localhost","root",""); 
    if (!$con) { 
      die ('数据库连接失败'.$mysql_error()); 
    } 
	mysqli_select_db($con,"users");
    //mysql_select_db("users",$con); 
    $dbusername=null; 
    $dbpassword=null; 
	
	$query="select * from `users` where username ='".$_SESSION["username"]."'";
    $result=mysqli_query($con,$query);
	
	//if(!$result) die("no information");
	
    while ($row=mysqli_fetch_array($result)) { 
      $dbusername=$row["username"]; 
      $dbpassword=$row["password"];
	  
    } 
    if(is_null($dbusername)){ 
		
		
   echo "用户名不存在";
    
	}else if($dbpassword!=$_SESSION["password"]){

	
		echo"密码错误";
		
  
    } else{
			header("location:index.html");
		}

	
		mysqli_close($con);
	?>
</body>
</html>