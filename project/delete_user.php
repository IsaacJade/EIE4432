<?php
	session_start();
	
	$conn=mysqli_connect("localhost","root","","users");
	if(!$conn)
	{
		echo "Unable to connect database";
	}
	$query1="delete from users where username=\"".$_SESSION["username"]."\"";
	$query2="delete from post where username=\"".$_SESSION["username"]."\"";
	$query3="delete from relation where userone=\"".$_SESSION["username"]."\" or usertwo=\"".$_SESSION["username"]."\"";
	mysqli_query($conn,$query1);
	mysqli_query($conn,$query2);
	mysqli_query($conn,$query3);
	$conn->close();
	session_destroy();
	header("Location:login.html");
?>