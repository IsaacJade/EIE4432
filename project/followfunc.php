<?php
	session_start();
	$conn=mysqli_connect("localhost","root","","users");
	if(!$conn)
	{
		echo "Connection Error";
		exit();
	}
	$query="insert into relation (userone,relation,usertwo) values (\"".$_SESSION["username"]."\",\"follow\",\"".$_GET["main"]."\")";
	mysqli_query($conn,$query);
	$conn->close();
	echo "suc";
?>