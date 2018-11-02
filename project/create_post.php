<?php
	session_start();
header("Content-type:application/xml");
$con=mysqli_connect("localhost","root","");
$_SESSION["post"]=$_POST["input"];
 if (!$con) { 
      die ('Database connection failed'.$mysql_error()); 
    } 
mysqli_select_db($con,"users");
date_default_timezone_set("Asia/Shanghai");

$date=date("Y/m/d h:i:sa");
echo $_SESSION["post"];

$query="insert into `post`(`username`,`post_time`,`post_content`) values('{$_SESSION["username"]}','{$date}','{$_SESSION["post"]}')";
$result=mysqli_query($con,$query);
if(!$result) die("insert failed");



/*
	
	$new_post=fopen("articles/".$_SESSION["username"]."/".date("YmdHis").".txt","w");
	fwrite($new_post,$_POST["input"]);
	echo "suc";
	fclose($new_post);*/
?>
