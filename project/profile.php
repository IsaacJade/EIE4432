<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header("location:login.html");
	}
	if((!isset($_GET["user"]))||($_GET["user"]==$_SESSION["username"]))
	{
		$current_display_username=$_SESSION["username"];
		$current_display_profile=$_SESSION["profile"];
		$current_display_city=$_SESSION["city"];
		$current_display_email=$_SESSION["email"];
		$display_function=true;
	}
	else
	{
		$current_display_username=$_GET["user"];
		$display_function=false;
		$con=mysqli_connect("localhost","root","","users"); 
		if (!$con)
		{
			die('database connect error');
		}
		$query_num="select profile,city,email from `users` where `username` = \"".$_GET["user"]."\"";
		$result_num=mysqli_query($con,$query_num);
		$result_num->data_seek(0);
		$row_num=$result_num->fetch_assoc();
		$current_display_profile=$row_num["profile"];
		$current_display_city=$row_num["city"];
		$current_display_email=$row_num["email"];
		$result_num->free();
	}
	$con=mysqli_connect("localhost","root","","users"); 
	if (!$con)
	{
		die('database connect error');
	}
	$query_num="select * ,count(*) as `num` from `post` where `username` = \"".$current_display_username."\" order by `post_time` desc";
	$result_num=mysqli_query($con,$query_num);
	$result_num->data_seek(0);
	$row_num=$result_num->fetch_assoc();
	$post_num = $row_num["num"];
	$result_num->free();
	
	$query_num = "select * from `relation` where `userone` = \"".$current_display_username."\"";
	$result_num=mysqli_query($con,$query_num);$num_row1=mysqli_num_rows($result_num);
	for ($i=0;$i<$num_row1;$i++){
		$row_num=mysqli_fetch_assoc($result_num);
		$following[$i]=$row_num["usertwo"];
	}
	$following_num = $i;
	$result_num->free();
	
	
	$query_num = "select * from `relation` where `usertwo` = \"".$current_display_username."\"";
	$result_num=mysqli_query($con,$query_num);$num_row2=mysqli_num_rows($result_num);
	for ($i=0;$i<$num_row2;$i++){
		$row_num=mysqli_fetch_assoc($result_num);
		$follower[$i]=$row_num["userone"];
	}
	$follower_num = $i;
	$result_num->free();
	
	$query_post="select `username`,`post_time`,`post_content`,`post_picture` from `post` where `username` = \"".$current_display_username."\" order by `post_time` desc";
?>
<html>
<head>
<script type="text/javascript">
function imagePreview() 
{
	var imgObj=document.getElementById("image"); 
	var previewObj=document.getElementById("preview");
	if(imgObj.files && imgObj.files[0])
	{
		previewObj.style.display = 'block';
		previewObj.style.height = '300px';
		previewObj.style.width = 'auto';
		previewObj.style.align = 'center';		
		previewObj.src = window.URL.createObjectURL(imgObj.files[0]);
	}
	return true;
}
function submitCheck(f)
{
	if(f.value=="")
	{
		alert("Cannot search without keyword");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<title><?php echo "Profile of ".$current_display_username;?></title>
<link rel="stylesheet" type="text/css" href="theme.css"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favorite.png"/>
</head>
<body style="overflow:visible;">
<span style="position:absolute;top:20px;left:0px;width:100%;height:300px;background-image:url(profile_bgs/bg1.jpg);background-repeat:no-repeat;background-position:-400 -400;text-align:center"></span>

<div style="position:absolute;top:270px;left:0px;width:100%;min-width:1200px;height:60px;background-color:white;box-shadow:0px 0px 4px grey;">
<span style="position:absolute;left:20%;top:15px;">
<a href="profile.php?<?php echo "user=".$current_display_username."&";?>q=post" class="main_button">Post
<span style="padding-left:8px;font-size:16px;">
<?php echo $post_num;?>
</span>
</a>
<span class="division_line"></span>
<a href="profile.php?<?php echo "user=".$current_display_username."&";?>q=following" class="main_button">Following
<span style="padding-left:8px;font-size:16px;">
<?php echo $following_num;?>
</span>
</a>
<span class="division_line"></span>
<a href="profile.php?<?php echo "user=".$current_display_username."&";?>q=follower" class="main_button">Follower
<span style="padding-left:8px;font-size:16px;">
<?php echo $follower_num;?>
</span>
</a>
</span>
<?php if(!$display_function){?>
<input type="button" value="Follow" style="position:absolute;top:12px;right:5%;" class="node_button"/>
<?php }?>
</div>

<div style="position:absolute;top:200px;left:8%;width:160px;height:160px;border-radius:50%;background-color:white;box-shadow:0px 0px 4px grey;padding:0px;">
<div style="position:relative;top:5px;"><img class="headerimg" src="./<?php echo $current_display_profile;?>"/></div>
</div>

<div style="position:absolute;left:10%;margin-top:400px;width:80%;min-width:1000px;text-align:center">

<div style="display:inline-block;width:20%;vertical-align:top;">
<div class="info_block" style="display:inline-block;width:100%;padding:15px;">
<table style="padding-left:10px;" cellspacing="10px">
<tr>
<td style="vertical-align:top;padding-top:5px;"><img src="images/name.png" style="max-height:12px;max-width:12px;"></td>
<td style="padding-left:8px;"><?php echo $current_display_username;?></td>
</tr>
<tr>
<td style="vertical-align:top;padding-top:5px;"><img src="images/location.png" style="height:12px;width:12px;"></td>
<td style="padding-left:8px;"><?php echo $current_display_city;?></td>
</tr>
<tr>
<td style="vertical-align:top;padding-top:5px;"><img src="images/description.png" style="height:12px;width:12px;"></td>
<td style="padding-left:8px;"><?php echo $current_display_email;?></td>
</tr>

<?php if($display_function){?>
<tr>
<td style="vertical-align:top;padding-top:5px;"><img src="images/pen.png" style="height:12px;width:12px;"></td>
<td style="padding-left:8px;"><a href="profile.php?q=edit">Edit my information</a></td>
</tr>
<tr>
<td style="vertical-align:top;padding-top:5px;"><img src="images/pen.png" style="height:12px;width:12px;"></td>
<td style="padding-left:8px;"><a href="profile.php?q=delete">Delete my account</a></td>
</tr>
<?php }?>

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

<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left">

<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">

<?php
	if((!isset($_GET["q"]))||($_GET["q"]=="post"))
	{
		$result=mysqli_query($con,$query_post);
		$result->data_seek(0);
		while($row=$result->fetch_assoc())
		{
			$time=preg_split("/_/",$row["post_time"]);
			echo "<h6>".$time[0]."-".$time[1]."-".$time[2]."/".$time[3].":".$time[4].":".$time[5]." by ".$row["username"]."<br/></h6>";
			echo $row["post_content"]."<br/><br/>";
			if($row["post_picture"] != "no pic")
			{
				echo "<img src = ".$row["post_picture"]." style='max-width:100%'/> <br/>";
			}
		}
		$result->free();
	}
//可以查看自己追踪的用户
	else if($_GET["q"]=="following")
	{
		echo "<h3>You have followed these users: </h3>";
		for ($i=0;$i<$num_row1;$i++){
			echo "<h4><a href=\"profile.php?user=".$following[$i]."\">".@$following[$i]."</a><br/></h4>";
		}
	}
//可以查看哪些用户追踪了自己
	else if($_GET["q"]=="follower")
	{
		echo "<h3>You have these followers: </h3>";
		for ($i=0;$i<$num_row2;$i++){
			echo "<h4><a href=\"profile.php?user=".$follower[$i]."\">".@$following[$i]."</a><br/></h4>";
		}
	}
	else if($_GET["q"]=="like")
	{
		echo "This is like board";
	}
	else if($_GET["q"]=="edit")
	{
		$query_edit = "select * from `users` where `username` = \"".$_SESSION["username"]."\"";
		$result_edit=mysqli_query($con,$query_edit);
		$result_edit->data_seek(0);
		$row_edit=$result_edit->fetch_assoc();
		$ori_city = $row_edit["city"];
		$ori_email = $row_edit["email"];
		$ori_birthday = $row_edit["birthday"];
		$ori_gender = $row_edit["gender"];
?>
	
	<form method="POST" action="profile.php?q=change" enctype="multipart/form-data">
	<p> <h3>Info Change</h3> </p>
	<p>
	<table cellspacing="10">
		
		<tr>
		<td>Location:</td>
		<td><input type="text" name="city" size="32" value = "<?php echo"$ori_city"?>"/></td>
		</tr>
		
		<tr>
		<td>E-mail:</td>
		<td><input type="text" name="email" size="32" value = "<?php echo"$ori_email" ?>"/></td>
		</tr>
		
		<tr>
		<td>Birth Date:</td>
		<td><input type="date" name="birthday" size="32" value = "<?php echo"$ori_birthday" ?>"/></td>
		</tr>
		
		<tr>
		<td>Gender:</td>
		<td><input type="radio" id="gender" name="gender" value="1" /> Male 
			<input type="radio" id="gender" name="gender" value="2" /> Female
			<input type="radio" id="gender" name="gender" value="3" /> Both
			<input type="radio" id="gender" name="gender" value="4" checked /> Undecided
		</td>
		</tr>
		
		<tr>
		<td>Self Description:</td>
		<td><input type="text" name="seldes" size="32"value = "没做" /></td>
		</tr>
		
		<tr>
		<td>Profile Picture:</td>
		<td><input type="file" name="image" id="image" accept=".jpg,.png" onchange="javascript:imagePreview();" /></td>
		</tr>
		
		<tr>
		<td>Profile Background:</td>
		<td><input type="text" name="probg" size="32"value ="没做"/></td>
		</tr>
		
		<tr>
		<td></td>
		<td><input type="submit" class="node_button" value="Change"/></td>
		</tr>
	
	</table>
	</p> 
	</form>
	
	<div style="align:center;">
	<img id="preview" width=-1 height=-1 style="diplay:none;"/>
	</div>
	
	<?php
	}
	else if($_GET["q"]=="delete")
	{
?>
		<p>Are you sure to delete your account?</p>
		<p><input type="button" value="Yes" onclick="location.href='delete_user.php'"/><input type="button" value="No" onclick="location.href='profile.php'"/></p>
<?php
	}
	else if($_GET["q"]=="change")
	{
		$change_email=$_POST["email"];
		$change_city=$_POST['city'];
		$change_gender=$_POST['gender'];
		$change_birthday=$_POST['birthday'];
		
		if ($_FILES["image"]["name"]!= null)
		{
			if (!is_dir("image_DB/"))
			{
				mkdir("image_DB/");
			}
			if (!is_dir("image_DB/".$_SESSION["username"]))
			{
				mkdir("image_DB/".$_SESSION["username"]);
			}
			$image_type = strrchr($_FILES["image"]["name"], '.');
			$_FILES["image"]["name"] = "header".$image_type;
			$pic_url="image_DB/".$_SESSION["username"]."/".$_FILES["image"]["name"];
			move_uploaded_file($_FILES["image"]["tmp_name"],$pic_url);
			$pic = $pic_url;
		}
		
		if (!$con)
		{ 
		  die('database connect error');
		}
		
		if($pic=="")
		{
			$query="update `users` set `email`='{$change_email}',`city`='{$change_city}',`gender`='{$change_gender}',`birthday`='{$change_birthday}',where `username`='{$_SESSION["username"]}'";
		}
		else
		{
			$query="update `users` set `email`='{$change_email}',`city`='{$change_city}',`gender`='{$change_gender}',`birthday`='{$change_birthday}',`profile`='{$pic}' where `username`='{$_SESSION["username"]}'";
			$_SESSION["profile"]=$pic;
		}

		$result_num=mysqli_query($con,$query) or die("update failed".mysqli_error($con));
		
		echo "Edit done";
	}
	else
	{
		header("location:profile.php?q=post");
	}
	$con->close();
?>
</span>

</span>

<span style="display:inline-block;width:100%;height:30px;vertical-align:left;"></span>

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

<form style="float:right;margin-right:20px;width:20%;" action="search.php" method="GET" onsubmit="return submitCheck(content)">
<input type="text" class="input_bar" name="content" style="width:100%;" placeholder="Press Enter to Search"/>
</form>

</div>

</body>
</html>