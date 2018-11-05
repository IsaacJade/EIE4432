<?php
	session_start();
	header("Content-type:application/xml");
	
	$con=mysqli_connect("localhost","root","","users"); 
    if (!$con) { 
      die('database connect error');
    }
	date_default_timezone_set("Asia/Hong_Kong");	
	//$Username=$_SESSION["username"];
    //$Time=date("Y-m-d-H:i:s"); 
	//$Content=$_POST["input"];
	$pic = "no pic";
	$date = date("Y_m_d_H_i_s");
	if ($_FILES["image"]["name"]!= null)
	{
		if (!is_dir("image_DB/")){
			mkdir("image_DB/");
		}
		if (!is_dir("image_DB/".$_SESSION["username"])){
			mkdir("image_DB/".$_SESSION["username"]);
		}
		$image_type = strrchr($_FILES["image"]["name"], '.');
		$_FILES["image"]["name"] = $date.$image_type;
		$pic_url="image_DB/".$_SESSION["username"]."/".$_FILES["image"]["name"];
		move_uploaded_file($_FILES["image"]["tmp_name"],$pic_url);
		$pic = $pic_url;
	}
	$con->query("insert into `post` (`username`,`post_time`,`post_content`,`post_picture`) values('".$_SESSION["username"]."','".$date."','".$_POST["input"]."','".$pic."')") or die("insert data error" .mysqli_error($con)) ; 
    $con->close();
	echo "suc";
	

?>
