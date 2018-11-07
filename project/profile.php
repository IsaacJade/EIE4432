<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header("location:login.html");
	}
	$con=mysqli_connect("localhost","root","","users"); 
		if (!$con) { 
		  die('database connect error');
		}
		$query_num="select * ,count(*) as `num` from `post` where `username` = \"".$_SESSION["username"]."\" order by `post_time` desc";
		$result_num=mysqli_query($con,$query_num);
		$result_num->data_seek(0);
		$row_num=$result_num->fetch_assoc();
		$query_post="select `username`,`post_time`,`post_content`,`post_picture` from `post` where `username` = \"".$_SESSION["username"]."\" order by `post_time` desc";
		$result_num->free();

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

	</script>
<title><?php echo "Profile of ".$_SESSION["username"];?></title>
<link rel="stylesheet" type="text/css" href="theme.css"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favorite.png"/>
</head>
<body style="overflow:visible;">
<span style="position:absolute;top:20px;left:0px;width:100%;height:300px;background-image:url(profile_bgs/bg1.jpg);background-repeat:no-repeat;background-position:-400 -400;text-align:center"></span>

<div style="position:absolute;top:270px;left:0px;width:100%;min-width:1200px;height:60px;background-color:white;box-shadow:0px 0px 4px grey;">
<span style="position:absolute;left:20%;top:15px;">
<a href="profile.php?q=post" class="main_button">Post<span style="padding-left:8px;font-size:16px;"><?php echo $row_num["num"];?></span></a>
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
<div style="position:relative;top:5px;"><img class="headerimg" src="./<?php echo $_SESSION["profile"];?>"/></div>
</div>

<div style="position:absolute;left:10%;margin-top:400px;width:80%;min-width:1000px;text-align:center">

<div style="display:inline-block;width:20%;vertical-align:top;">
<div class="info_block" style="display:inline-block;width:100%;padding:15px;">
<table style="padding-left:10px;" cellspacing="10px">
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/name.png" style="max-height:12px;max-width:12px;"></td><td style="padding-left:8px;"><?php echo $_SESSION["username"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/location.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><?php echo $_SESSION["city"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/description.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><?php echo $_SESSION["email"];?></td></tr>
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
	if((!isset($_GET["q"]))||($_GET["q"]=="post"))
	{
		
		$result=mysqli_query($con,$query_post);
		$result->data_seek(0);
		while($row=$result->fetch_assoc()){
		$time=preg_split("/_/",$row["post_time"]);
			echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\">";

			echo "<span style=\"position:absoulte;top:0px;padding-left:10px;vertical-align:left;font-size:10px;\">".$time[0]."-".$time[1]."-".$time[2]."/".$time[3].":".$time[4].":".$time[5]." by ".$row["username"]."<br/></span><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">";
			
				echo $row["post_content"]."<br/><br/>";
				if($row["post_picture"] != "no pic")
				{
					echo "<img src = ".$row["post_picture"]." style=\"max-width:100%\"/> <br/>";
				}
			echo "</span></span><span style=\"display:inline-block;width:100%;height:30px;vertical-align:left;\"></span>";
		}
		$result->free();

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
		echo "<span class=\"info_block\" style=\"display:inline-block;width:100%;min-height:100px;vertical-align:left;text-align:left\"><span style=\"display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;\">";?>
	
		<form method="POST" action="change_info.php">
			<p> <h3>Info Change</h3> </p>
			<p> <table cellspacing="10"> <tr><td>
	Location:</td><td><input type="text" name="location" size="32"/></td></tr> <tr><td>
	E-mail:</td><td><input type="text" name="email" size="32"/></td></tr> <tr><td>
	Birth Date:</td><td><input type="text" name="birdate" size="32"/></td></tr> <tr><td>
	Gender:</td><td><input type="text" name="gender" size="32"/></td></tr> <tr><td>
	Self Description:</td><td><input type="text" name="seldes" size="32"/></td></tr> <tr><td>
	Profile Picture:</td><td><input type="file" name="image" id="image" accept=".jpg,.png" onchange="javascript:imagePreview();" /></td></tr> <tr><td>
	
	Profile Background:</td><td><input type="text" name="probg" size="32"/></td></tr> <tr><td></td><td>
	<input type="submit" class="node_button" value="Change"/></td></tr> </table> </p> 
	</form>
	<div style="align:center; "><img id="preview" width=-1 height=-1 style="diplay:none "/></div>
		<?php
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
	$con->close();
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
