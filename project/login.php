<?php 
	//don't add code outside php
    session_start(); 
    @$_SESSION["username"]=$_POST["username"]; 
    @$_SESSION["password"]=$_POST['password']; 
  	
	
	$con=mysqli_connect("localhost","root","","users"); 
    if (!$con) { 
      die('Connection Failure');
    } 
	
    $dbusername=null; 
    $dbpassword=null; 
	
	$query="select * from `users` where username ='".$_SESSION["username"]."'";
    $result=mysqli_query($con,$query);
	
	//if(!$result) die("no information");
	
    $row=mysqli_fetch_array($result); 
      $dbusername=$row["username"]; 
      $dbpassword=$row["password"];
	  if(is_null($dbusername)){ 	
		echo "<a style=\"color:blue;font-weight:bold;\">User not exist</a>";
	}
	else if($dbpassword!=$_SESSION["password"]){
		echo"<a style=\"color:blue;font-weight:bold;\">Wrong password</a>";
    }
	else{
		$_SESSION["city"]=$row["city"];
		$_SESSION["email"]=$row["email"];
		$_SESSION["profile"]=$row["profile"];
		echo "<a style=\"color:blue;font-weight:bold;\">Login Successfully</a>";
	}
    
		$result->free();
		mysqli_close($con);
?>