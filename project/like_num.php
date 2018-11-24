<?php
session_start();
//already use ajax to send js variale (number and value,two variables) to php
$a=$_GET["number"];$a1="post_".$_SESSION[$a."post_id"]." ";
$b=$_GET["value"];
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"users");
echo $_SESSION["username"];
//when b=1 add likes, when b=0, subtract likes
if ($b==1) {
	$sql1='update post set like_num=like_num+1 where post_id="'.$_SESSION[$a."post_id"].'"';
	$sql2="update users set like_post=concat(like_post,'".$a1."') where username=\"".$_SESSION["username"]."\"";
}
else if($b==0) {
	$sql1='update post set like_num=like_num-1 where post_id="'.$_SESSION[$a."post_id"].'"';
	$sql2="update users set like_post=REPLACE(like_post,'".$a1."','') where username =\"".$_SESSION["username"]."\"";
}
$result1=mysqli_query($con,$sql1);$result2=mysqli_query($con,$sql2);
//mysqli_free_result($result1);mysqli_free_result($result2);
?>