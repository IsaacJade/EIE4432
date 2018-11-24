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
function autoTAH(ta)
{
	clear_info();
	if(ta.scrollTop+ta.scrollHeight>180)
	{
		ta.style.height=ta.scrollTop+ta.scrollHeight+"px";
	}
}
function create_new_post()
{
	//document.getElementById("input_info").innerHTML=document.getElementById("image").name;
	if((document.getElementById("input").value=="")&&(document.getElementById("image").value==""))
	{
		document.getElementById("input_info").innerHTML="Cannot post null content";
	}
	else
	{
		xmlHttp=null;
		if(window.XMLHttpRequest)
		{
			xmlHttp=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		if(xmlHttp!=null)
		{
			var form = document.getElementById("postform");
			var formData=new FormData(form);
			xmlHttp.onreadystatechange=stateChange;
			xmlHttp.open("POST","create_post.php",true);
			//xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");
			xmlHttp.send(formData);
		}
		else
		{
			alert("Your browser does not support XMLHTTP.");
		}
	}
}
function stateChange()
{
	if(xmlHttp.readyState==4)
	{
		if(xmlHttp.status==200)
		{	document.getElementById("input_info").innerHTML=xmlHttp.responseText;
			if(xmlHttp.responseText=="suc")
			{
				document.getElementById("input_info").innerHTML="Post Successfully";
				document.getElementById("input").value="";
				location.reload();
			}
		}
		else
		{
			document.getElementById("input_info").innerHTML="Problems in retriving data: "+xmlHttp.statusText;
		}
	}
}
function clear_info()
{
	document.getElementById("input_info").innerHTML="";
}
</script>
</head>
<body>
<div style="margin-top:120px;position:absolute;width:80%">

<div style="display:inline-block;width:60%;min-width:300px;min-height:100px;vertical-align:top;">
<form name="postform" id="postform">
<textarea id="input" name="input" type="text" form="postform" autofocus="autofocus" type="text" style="text-align:left;top:0px;left:0px;width:100%;height:180px;resize:vertical;padding:10px;text-decoration:none;box-shadow:0px 0px 3px 0px grey;font-size:20px;" oninput="autoTAH(this)"></textarea>

Choose an image: <input type="file" name="image" id="image" accept=".jpg,.png" onchange="javascript:imagePreview();">
</form>
<div style="align:center; "><img id="preview" width=-1 height=-1 style="diplay:none "/></div>

<span class="info_break" style="text-align:right;margin-top:15px;">
<span id="input_info" style="color:#888888;text-decoration:none;margin-right:30px"></span>
<input type="button" value="Submit" class="node_button" onclick="create_new_post()"/>
</span>

<span class="info_break"></span>
<?php

	$con=mysqli_connect("localhost","root","","users"); 
    if (!$con) { 
      die('database connect error');
    }
	$query="select `username`,`post_time`,`post_content`,`post_picture` from `post` order by `post_time` desc";
	$result=mysqli_query($con,$query);
	$result->data_seek(0);
	while($row=$result->fetch_assoc())
	{
		$time=preg_split("/_/",$row["post_time"]);
?>
		<span class="info_block" style="min-height:100px;vertical-align:left;text-align:left">
			<span style="position:absoulte;top:0px;padding-left:10px;vertical-align:left;font-size:10px;">
<?php
			echo "".@$time[0]."-".@$time[1]."-".@$time[2]."/".@$time[3].":".@$time[4].":".@$time[5]." by ";
			echo "<a href=\"profile.php?user=".$row["username"]."\">".@$row["username"]."</a><br/>";
?>
			</span>
			<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">
<?php
		
			echo $row["post_content"]."<br/><br/>";
			if($row["post_picture"] != "no pic")
			{
				echo "<img src = ".$row["post_picture"]." style=\"max-width:100%\"/> <br/>";
			}
?>
			</span>
		</span>
		<span class="info_break"></span>
<?php
	}
	$result->free();
	$con->close();
	
?>
<span style="display:inline-block;width=100%;height:70px;vertical-align:left;font-size:18px;color:grey;">-- End of Content --</span>

</div>

<div style="display:inline-block;width:80px;vertical-align:top;"></div>

<div style="display:inline-block;position:fixed;width:20%;min-width:300px;vertical-align:top;">
<span class="info_block" style="min-width:300px;vertical-align:top;">
<form style="margin:30px;">
<p>
<img class="headerimg" src="./<?php echo $_SESSION["profile"];?>"/>
</p>
<table style="padding-left:10px;" cellspacing="10px">
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/name.png" style="max-height:12px;max-width:12px;"></td><td style="padding-left:8px;"><?php echo $_SESSION["username"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/location.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><?php echo $_SESSION["city"];?></td></tr>
<tr><td style="vertical-align:top;padding-top:5px;"><img src="images/description.png" style="height:12px;width:12px;"></td><td style="padding-left:8px;"><?php echo $_SESSION["email"];?></td></tr>
</table>
</form>
</span>
<span class="info_break"></span>
<span style="display:inline-block;height:50px;width:100%;min-width:300px;vertical-align:top;">
<a style="font-size:12px;color:grey;">Copyright Out#Rage 2018</a>
</span>
</div>

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
