<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header("location:login.html");
	}
?>
<html>
<head>
	<title>Out#Rage</title>
	<link rel="stylesheet" type="text/css" href="theme.css"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favorite.png"/>
<script type="text/javascript">
function PickImage() 
{
	var num = 7;

	var n=Math.floor(Math.random()*num+1);
	document.write("<img src=profiles/index"+n+ ".jpg style=height:200px;width:200px;>");
	return true;
}

function PickQuote() 
{
	document.write("<?php
	$con=mysqli_connect("localhost","root","","users"); 
    if (!$con) { 
      die('Connection Failure');
    } 
	$query="select * from `quote` ORDER BY RAND()";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result); 
    print($row["quote_content"]);
	?>");
	return true;
}
</script>
</head>
<body style="overflow:visible;">
<span style="position:absolute;top:20px;left:0px;width:100%;height:600px;background-image:url(profile_bgs/bg1.jpg);background-repeat:no-repeat;background-position:-400 -400;text-align:center"></span>

<div style="position:absolute;left:10%;margin-top:100px;width:80%;min-width:1000px;text-align:center">

<div style="display:inline-block;width:60%;vertical-align:top;">
<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left">
<span style="display:block;margin-top:20px;margin-left:50px;margin-right:50px;margin-bottom:20px;text-align:center;">
<h6><br></h6><br><br><script>PickQuote()</script><br><br><script>PickImage()</script><br></span>
</span>
<span style="display:inline-block;width:100%;height:30px;vertical-align:left;"></span>
<span style="display:inline-block;height:50px;width:100%;min-width:300px;vertical-align:top;">
<a style="font-size:12px;color:black;">Copyright Out#Rage 2018</a>
</span>
</div>

	<!--Put the top bar at the end makes it on top of any other one-->
<div class="top_bar" style="text-align:center">
<span style="float:left">
<a href="index.php" class="main_button">Home</a>
<span class="division_line"></span>
<a href="light.php" class="main_button">Light</a>
<span class="division_line"></span>
<a href="profile.php" class="main_button">Profile</a>
</span>

<img src="images/logo.png" style="display:inline-block;max-height:30px;"/>
<span style="float:right;margin-right:10px;padding-top:8px;"><img src="images/logout.png" style="max-height:20px;max-width:20px;"/><span style="float:right;margin-right:25px;padding-left:8px;position:relative;bottom:1px;"><a class="logout_button" href="logout.php">Logout</a></span></span>

<form style="float:right;margin-right:20px;width:20%;" action="search.php" method="GET" onsubmit="return submitCheck(content)">
<input type="text" class="input_bar" name="content" style="width:100%;" placeholder="Press Enter to Search"/>
</form>
</div>

</body>
</html>