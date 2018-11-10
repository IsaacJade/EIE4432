<?php
	session_start();
	
	$conn=mysqli_connect("localhost","root","","users");
	if($conn->connection_error)
	{
		echo "Unable to connect database";
	}
	$query="";
	
	$conn->close();
	session_destroy();
?>