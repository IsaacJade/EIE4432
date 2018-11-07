<html>
<head>
<title>Search Result</title>
<link rel="stylesheet" type="text/css" href="theme.css"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favorite.png"/>
</head>
<script type="text/javascript">
function autoTAH(ta)
{
	if(ta.scrollTop+ta.scrollHeight>180)
	{
		ta.style.height=ta.scrollTop+ta.scrollHeight+"px";
	}
}
function submitForm()
{
	document.getElementById("sf").submit();
	document.getElementById("cf").submit();
}
</script>
<body>
<div style="margin-top:120px;position:absolute;width:80%">

<div style="display:inline-block;width:60%;min-width:300px;min-height:100px;vertical-align:top;">

<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;background-color:grey;">
<span style="display:block;margin-top:30px;margin-left:50px;margin-bottom:20px;text-align:left;">
<form id="sf" action="search1.php" method="POST">
<input type="text" class="input_bar" name="content" style="width:70%;" placeholder="Search"/><input type="button" value="Submit" class="node_button" style="display:inline-block;margin-left:20px;" onclick="submitForm()"/>
</form>
<form id="cf" style="color:white;font-size:15px;" action="search1.php" method="GET">
<input type="radio" name="class" value="total" checked="checked"/>Total
<input type="radio" name="class" value="users"/>Users
<input type="radio" name="class" value="post"/>Post
<input type="radio" name="class" value="relation"/>Relation
</form>
</span>
</span>

<?php
if(!isset($_POST["content"]))
{?>
	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">
	<p>The results will be shown here.</p>
	</span>
	</span>
<?php	
}
else
{
	session_start();
	date_default_timezone_set("Asia/Hong_Kong");
	$xx=$_POST["content"];
	$xx=trim($xx);
	$_SESSION["search"]=explode(" ",$xx);
	$con=mysqli_connect("localhost","root","");
	if(!$con) {die("error with opiening the page: ".mysqli_error());
	}
	mysqli_select_db($con,"users");
	$sql1="select * from users where username like '%".$_SESSION["search"][0]."%' or city like '%".$_SESSION["search"][0]."%' or profile like '%".$_SESSION["search"][0]."%' 
	or birthday like '%".$_SESSION["search"][0]."%' or gender like '%".$_SESSION["search"][0]."%' or email like '%".$_SESSION["search"][0]."%'";
	$sql2="select * from post where username like '%".$_SESSION["search"][0]."%' or post_time like '%".$_SESSION["search"][0]."%' or post_content like '%".$_SESSION["search"][0]."%'
			or emotion like '%".$_SESSION["search"][0]."%' or comment_content like '%".$_SESSION["search"][0]."%' 
			or comment_picture like '%".$_SESSION["search"][0]."%' or comment_user like '%".$_SESSION["search"][0]."%' or comment_time like '%".$_SESSION["search"][0]."%'";
	$sql3="select * from  relation where userone like '%".$_SESSION["search"][0]."%' or usertwo like '%".$_SESSION["search"][0]."%' or relation like '%".$_SESSION["search"][0]."%'";
	
	$result1=mysqli_query($con,$sql1); $rowcount1=mysqli_num_rows($result1);
	$result2=mysqli_query($con,$sql2);$rowcount2=mysqli_num_rows($result2);
	$result3=mysqli_query($con,$sql3);$rowcount3=mysqli_num_rows($result3);$totalrows=$rowcount1+$rowcount2+$rowcount3;
	
	if((!isset($_GET["class"]))||($_GET["class"]=="total"))
	{
		$cl="t";
	}
	else if($_GET["class"]=="users")
	{
		$cl="u";
	}
	else if($_GET["class"]=="post")
	{
		$cl="p";
	}
	else if($_GET["class"]=="relation")
	{
		$cl="r";
	}
	else
	{
		$cl="t";
	}
	
	if(($cl=="t")||($cl=="u"))
	{
	for ($i=0;$i<$rowcount1;$i++){
?>
	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">
	<p>
<?php
		$row1=mysqli_fetch_assoc($result1);
		echo '<h4><a href="\\"https://www.w3schools.com\\">'.$row1["username"]."'s Profile | Home page</a><br /></h4>".$row1["profile"] ;
		echo "City: ".$row1["city"]."  Age: ".$row1["age"]."  Email: ".$row1["email"]."<br />";
?>
	</p>
	</span>
	</span>
<?php
	}
	}
	if(($cl=="t")||($cl=="p"))
	{
	for ($x=0;$x<$rowcount2;$x++)
	{
		$row2=mysqli_fetch_assoc($result2);$present=substr($row2["post_time"],0,-9);$present=date('Y-m-d', strtotime(str_replace('_', '/', $present)));$hour=substr($row2["post_time"],11,-6);
		//if (($_POST["content"]=="no" or $_POST["content"]=="pic" or $_POST["content"]=="no pic") and ($row2["post_picture"]==="no pic") and (strpos(" ".$row2["post_content"], 'no') == false) and (strpos(" ".$row2["post_content"], 'pic')== false)){continue;}
?>
	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;padding-right:50px">
	<p>
<?php		echo '<h4><a href=\\"https://www.w3schools.com\\">'.substr($row2["post_content"],0,30)."...&nbsp; | ".$row2["username"]."'s Post</a></h4>";
			if ($row2["post_picture"]==="no pic"){
				if ($present==date("Y-m-d")){ 
					$ago=intval(date('H'))-intval($hour); 
					echo $ago." hours ago - " .$row2["post_content"]." | Comments: ".wordwrap($row2["comment_content"],60,"<br>\n")."<br />";
				}
				else{
					echo $present.", ".wordwrap($row2["post_content"],60,"<br>\n")." | Comments: ".$row2["comment_content"]."<br />";
				}
			}
			else {
				echo '<img style=\'max-width:100%\'; src="'.$row2["post_picture"].'"/><br />';
				if ($present==date("Y-m-d")){ 
					$ago=intval(date('H'))-intval($hour); echo $ago." hours ago - " .$row2["post_content"]." | Comments: ".wordwrap($row2["post_content"],60,"<br>\n")."<br />";
				}
				else{
					echo $present.", ". wordwrap($row2["post_content"],60,"<br>\n")." | Comments: ".$row2["comment_content"]."<br />";
					}
			}
?>
	</p>
	</span>
	</span>
<?php
	}
}
if(($cl=="t")||($cl=="r"))
{
		for ($y=0;$y<$rowcount3;$y++)
		{
?>
	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">
	<p>
<?php
		$row3=mysqli_fetch_assoc($result3);echo '<h4><a href=\\"https://www.w3schools.com\\">'.$row3["usertwo"]."'s Followers | View ".$row3["usertwo"]."'s relations here</a></h4>";
		//echo '<a href=\\"https://www.w3schools.com\\">View '.$row3["userone"]."'s ".$row3["relation"]."</a><br />";
		echo $row3["userone"]." is the follower and ".$row3["relation"]." of ".$row3["usertwo"].". ".$row3["userone"]." has followed for 1 day....and..<br />";
?>
	</p>
	</span>
	</span>
<?php
	}
}
	if (($rowcount1==0) and ($rowcount2==0) and ($rowcount3==0))
	{
?>
	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">
	<p>
<?php
		echo "<h3>sorry we can't find any matched result</h3>";
?>
	</p>
	</span>
	</span>
<?php
	}
  //$link="Query1.html";echo "<a href="$link">click here</a>";
	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_free_result($result3);	// Free result set
	mysqli_close($con);
}
?>




<span style="display:inline-block;width=100%;height:60px;vertical-align:left;"></span>
<span style="display:inline-block;width=100%;height:70px;vertical-align:left;font-size:18px;color:grey;">-- End of Content --</span>

</div>

<div style="display:inline-block;width:80px;vertical-align:top;"></div>

<div style="display:inline-block;position:fixed;width:20%;min-width:300px;vertical-align:top;">
<span class="info_block" style="display:inline-block;width:100%;min-width:300px;vertical-align:top;">
<form style="margin:30px;">
<p>
<?php
	echo "<h4>Your keyword is: ";
	if(!isset($_POST["content"]))
	{
		echo "[NONE]";
	}
	else
	{
		echo $_POST["content"];
	}
	echo "<br /></h4>";
	
	echo "<h4>Searching category is: ";
	if(!isset($_POST["content"]))
	{
		echo "[NONE]";
	}
	else
	{
		if($cl=="t")
		{
			echo "Total";
		}
		else if($cl=="u")
		{
			echo "Users";
		}
		else if($cl=="p")
		{
			echo "Post";
		}
		else if($cl=="r")
		{
			echo "Relation";
		}
	}
	echo "<br /></h4>";
	
	echo "About ";
	if(!isset($_POST["content"]))
	{
		echo "0";
	}
	else
	{
		echo $totalrows;
	}
	echo " results <br />";
?>
</p>
</form>
</span>
<span style="display:inline-block;height:20px;width:100%;min-width:300px;vertical-align:top;">
</span>
<span style="display:inline-block;height:50px;width:100%;min-width:300px;vertical-align:top;">
<a style="font-size:12px;color:grey;">Copyright Out#Rage 2018</a>
</span>
</div>

</div>

<!--Put the top bar at the end makes it on top of any other one-->
<div class="top_bar" style="text-align:center">
<span style="float:left">
<a href="index.html" class="main_button">Home</a>
<span class="division_line"></span>
<a href="" class="main_button">Chat</a>
<span class="division_line"></span>
<a href="profile.html" class="main_button">Profile</a>
</span>

<img src="images/logo.png" style="display:inline-block;max-height:30px;"/>

<div style="float:right;margin-right:45px;width:20%;height:1px;"></div>
</div>

</body>
</html>
