<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header("location:login.html");
	}

$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"users");
$query="select * from `post` where `username`='{$_SESSION["username"]}'";
$result =mysqli_query($con,$query);
$post_query="select post from `post` where `username`='{$_SESSION["username"]}'";
$_SESSION["articles"]=mysqli_query($con,$post_query);

//echo mysqli_num_rows($result);	
	




?>

<html>
<head>
<title><?php echo "Profile of ".$_SESSION["username"];?></title>
<link rel="stylesheet" type="text/css" href="theme.css"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favorite.png"/>
</head>
<body style="overflow:visible;">
<span style="position:absolute;top:20px;left:0px;width:100%;height:300px;background-image:url(profile_bgs/bg1.jpg);background-repeat:no-repeat;background-position:-400 -400;text-align:center"></span>

<div style="position:absolute;top:270px;left:0px;width:100%;min-width:1200px;height:60px;background-color:white;box-shadow:0px 0px 4px grey;">
<span style="position:absolute;left:20%;top:15px;">
<a href="profile.php?q=post" class="main_button">Post<span style="padding-left:8px;font-size:16px;"><?php 
	/*
$query="select count(*) from `post` where `username`='{$_SESSION["username"]}'";
$result =mysqli_query($con,$query);*/
	//$row=mysqli_fetch_array($result);
	
echo mysqli_num_rows($result);
	
	?></span></a>
<span class="division_line"></span>
<a href="profile.php?q=following" class="main_button">Following<span style="padding-left:8px;font-size:16px;">68</span></a>
<span class="division_line"></span>
<a href="profile.php?q=follower" class="main_button">Follower<span style="padding-left:8px;font-size:16px;">15</span></a>
<span class="division_line"></span>
<a href="profile.php?q=like" class="main_button">Like<span style="padding-left:8px;font-size:16px;">104</span></a>
</span>
<input type="button" value="Follow" style="position:absolute;top:12px;right:5%;" class="node_button"/>
</div>

<div style="position:absolute;top:200px;left:8%;width:160px;height:160px;border-radius:50%;background-color:white;box-shadow:0px 0px 4px grey;padding:0px;">
<div style="position:relative;top:5px;"><img class="headerimg" src="./profiles/<?php echo $_SESSION["profile"];?>"/></div>
</div>

<div style="position:absolute;left:10%;margin-top:400px;width:80%;min-width:1000px;text-align:center">

<div style="display:inline-block;width:20%;vertical-align:top;">
<div class="info_block" style="display:inline-block;width:100%;padding:15px;">
<table style="padding-left:10px;" cellspacing="10px">
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/name.png" style="max-height:12px;max-width:12px;"></td><td style="padding-left:8px;"><?php echo @$_SESSION["username"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/location.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><?php echo @$_SESSION["location"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/description.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><?php echo @$_SESSION["signature"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/pen.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><a href="profile.php?q=edit">Edit my information</a></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/pen.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><a href="profile.php?q=delete">Delete my account</a></td></tr>
</table>
</div>
<span style="display:inline-block;height:20px;width:100%;min-width:300px;vertical-align:top;">
</span>
<span style="display:inline-block;height:50px;width:100%;min-width:300px;vertical-align:top;">
<a style="font-size:12px;color:grey;">Copyright Out#Rage 2018</a>
</span>
</div>

<div style="display:inline-block;width:80px;height:300px;vertical-align:top;"></div>

<div style="display:inline-block;width:60%;vertical-align:top;">


<?php
	mysqli_select_db($con,"users");
	$post_query="select `post_content` from `post` where `username`='{$_SESSION["username"]}'";
$articles=mysqli_query($con,$post_query);

	if((!isset($_GET["q"]))||($_GET["q"]=="post")){
		while($row1=mysqli_fetch_array($articles)){
			$post=$row1["post_content"];
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\">";
		
			echo "<span style=\"position:absoulte;top:0px;padding-left:10px;vertical-align:left;font-size:30px;\">" .$post.
				"<br/></span><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\"></span></span><span style='display:inline-block;height:20px;width:100%;min-width:300px;vertical-align:top;'></span>";
		
	}
	}
	else if($_GET["q"]=="following")
	{
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\"><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">This is following board</span></span><span style=\"display:inline-block;width:100%;height:30px;vertical-align:left;\"></span>";
	}
	else if($_GET["q"]=="follower")
	{
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\"><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">This is follower board</span></span><span style=\"display:inline-block;width:100%;height:30px;vertical-align:left;\"></span>";
	}
	else if($_GET["q"]=="like")
	{
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\"><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">This is like board</span></span><span style=\"display:inline-block;width:100%;height:30px;vertical-align:left;\"></span>";
	}
	else if($_GET["q"]=="edit")
	{
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\"><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">";
		echo "<form method=\"POST\" action=\"change_info.php\"> <p> <h3>Info Change</h3> </p> <p> <table cellspacing=\"10\"> <tr><td>Location:</td><td><input type=\"text\" name=\"location\" size=\"32\"/></td></tr> <tr><td>E-mail:</td><td><input type=\"text\" name=\"email\" size=\"32\"/></td></tr> <tr><td>Birth Date:</td><td><input type=\"text\" name=\"birdate\" size=\"32\"/></td></tr> <tr><td>Gender:</td><td><input type=\"text\" name=\"gender\" size=\"32\"/></td></tr> <tr><td>Self Description:</td><td><input type=\"text\" name=\"seldes\" size=\"32\"/></td></tr> <tr><td>Profile Picture:</td><td><input type=\"text\" name=\"pro\" size=\"32\"/></td></tr> <tr><td>Profile Background:</td><td><input type=\"text\" name=\"probg\" size=\"32\"/></td></tr> <tr><td></td><td><input type=\"submit\" class=\"node_button\" value=\"Change\"/></td></tr> </table> </p> </form>";
		echo "</span></span><span style=\"display:inline-block;width:100%;height:30px;vertical-align:left;\"></span>";
	}
	else if($_GET["q"]=="delete")
	{
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\"><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">This is delete board</span></span><span style=\"display:inline-block;width:100%;height:30px;vertical-align:left;\"></span>";
	}
	else
	{
		header("location:profile.php?q=post");
	}

?>
<span style="display:inline-block;width=100%;height:70px;vertical-align:left;font-size:18px;color:grey;">-- End of Content --</span>
</div>

</div>

<!--Put the top bar at the end makes it on top of any other one-->
<div class="top_bar" style="text-align:center">
<span style="float:left">
<a href="index.php" class="main_button">Home</a>
<span class="division_line"></span>
<a href="" class="main_button">Chat</a>
<span class="division_line"></span>
<a href="profile.php" class="main_button">Profile</a>
</span>

<img src="images/logo.png" style="display:inline-block;max-height:30px;"/>
<span style="float:right;margin-right:10px;padding-top:8px;"><img src="images/logout.png" style="max-height:20px;max-width:20px;"/><span style="float:right;margin-right:25px;padding-left:8px;position:relative;bottom:1px;"><a class="logout_button" href="logout.php">Logout</a></span></span>
<input type="text" class="input_bar" style="float:right;margin-right:45px;width:20%;" placeholder="Search"/>
</div>

</body>
</html>

