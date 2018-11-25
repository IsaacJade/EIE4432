<?php
	$con=mysqli_connect("localhost","root","","users"); 
    if (!$con) { 
      die('Connection Failure');
    } 
	$query="select * from `quote` ORDER BY RAND()";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result); 
    print($row["quote_content"]);
?>