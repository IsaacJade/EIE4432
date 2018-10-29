<?php
	session_start();
	header("Content-type:application/xml");
	$new_post=fopen("articles/".$_SESSION["username"]."/".date("YmdHis").".txt","w");
	fwrite($new_post,$_POST["input"]);
	echo "suc";
	fclose($new_post);
?>
