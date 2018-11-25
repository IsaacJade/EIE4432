<?php
	session_start();
	if(!isset($_SESSION["username"]))
	{
		header("location:login.html");
	}
?>
<html>
<head>
<title>Search Result</title>
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
function changeImage(a)
{
	var para1="value=1&number="+a;//like
	var para2="value=0&number="+a;//cancel like
	
	xmlHttp=null;
	
	if(window.XMLHttpRequest)
	{
		xmlHttp=new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (xmlHttp!=null)
	{
		var image=document.getElementById(a);
		xmlHttp.onreadystatechange=stateChangeForLike;
		if(image.src.match("grey"))
		{
			xmlHttp.open("GET","like_num.php?"+para1,true);
		}
		else
		{
			xmlHttp.open("GET","like_num.php?"+para2,true);
		}
		xmlHttp.send(null);
	}
}
function stateChangeForLike(a)
{
	if(xmlHttp.readyState==4)
	{
		if(xmlHttp.status==200)
		{
			location.reload();
		}
		else
		{
			document.getElementById("+1"+a).innerHTML="Problems in retriving data: "+xmlHttp.statusText;
		}
	}
}
</script>
</head>
<body>
<div style="margin-top:120px;position:absolute;width:80%">

<div style="display:inline-block;width:60%;min-width:300px;min-height:100px;vertical-align:top;">

<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;background-color:grey;">
<span style="display:block;margin-top:30px;margin-left:50px;margin-bottom:20px;text-align:left;">
<form id="sf" action="search.php" method="GET">
<input type="text" class="input_bar" name="content" style="width:70%;" placeholder="Press Enter to Search"/><input type="submit" value="Submit" class="node_button" style="display:inline-block;margin-left:20px;" onclick="return submitCheck(content)"/>
<p style="color:white;font-size:15px;">
<input type="radio" name="class" value="total" checked="checked"/>Total
<input type="radio" name="class" value="users"/>Users
<input type="radio" name="class" value="post"/>Post
<input type="radio" name="class" value="relation"/>Relation
<input type="radio" name="class" value="quote"/>Quote
</p>
</form>
</span>
</span>

<?php
if(!isset($_GET["content"]))
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
	$xx=$_GET["content"];
	$xx=trim($xx);
	$_SESSION["search"]=explode(" ",$xx);
	$con=mysqli_connect("localhost","root","");
	if(!$con) {die("error with opiening the page: ".mysqli_error());
	}
	mysqli_select_db($con,"users");
	
	if (count(explode(' ',$xx))==1){
	$_SESSION["keyword"]=1;$a=$_SESSION["search"][0];
	$sql1="select * from users where username like '%".$a."%' or city like '%".$a."%' or profile like '%".$a."%' or birthday like '%".$a."%' or gender like '%".$a."%' or email like '%".$a."%'";
	$sql2="select * from post where username like '%".$a."%' or post_time like '%".$a."%' or post_content like '%".$a."%' order by `post_time` desc";
	$sql3="select * from  relation where userone like '%".$a."%' or usertwo like '%".$a."%' or relation like '%".$a."%' ";
	$sql4="select * from quote where quote_type like '%".$a."%' or quote_content like '%".$a."%' or quote_picture like '%".$a."%'";
	
	}

else if (count(explode(' ',$xx))==2){
	$_SESSION["keyword"]=2;$a=$_SESSION["search"][0];$b=$_SESSION["search"][1];
	$sql1="select * from users where username like '%".$a."%' or city like '%".$a."%' or profile like '%".$a."% ' or birthday like '%".$a."%' or gender like '%".$a."%' or email like '%".$a."%' 
	or username like '%".$b."%' or city like '%".$b."%' or profile like '%".$b."% ' or birthday like '%".$b."%' or gender like '%".$b."%' or email like '%".$b."%'";
	$sql2="select * from post where username like '%".$a."%' or post_time like '%".$a."%' or post_content like '%".$a."%' 
	or username like '%".$b."%' or post_time like '%".$b."%' or post_content like '%".$b."%' order by `post_time` desc";
	$sql3="select * from  relation where userone like '%".$a."%' or usertwo like '%".$a."%' or relation like '%".$a."%' 
	or userone like '%".$b."%' or usertwo like '%".$b."%' or relation like '%".$b."%'";
	$sql4="select * from quote where quote_type like '%".$a."%' or quote_content like '%".$a."%' or quote_picture like '%".$a."%'
	or quote_type like '%".$b."%' or quote_content like '%".$b."%' or quote_picture like '%".$b."%'";
}
	$result1=mysqli_query($con,$sql1); $rowcount1=mysqli_num_rows($result1);
	$result2=mysqli_query($con,$sql2);$rowcount2=mysqli_num_rows($result2);
	$result3=mysqli_query($con,$sql3);$rowcount3=mysqli_num_rows($result3);
	$result4=mysqli_query($con,$sql4);$rowcount4=mysqli_num_rows($result4);
	$totalrows=$rowcount1+$rowcount2+$rowcount3+$rowcount4;
	
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
	else if($_GET["class"]=="quote")
	{
		$cl="q";
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
		echo "<h4><a href=\"profile.php?user=".$row1["username"]."\">".@$row1["username"]."'s Profile | Home page</a><br /></h4>".$row1["profile"] ;
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
?>

	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;padding-right:50px">
	<p>
<?php		
			echo "<h4><a href=\"profile.php?user=".$row2["username"]."\">".$row2["username"]."'s Post</a>"; 
				if ($present==date("Y-m-d")){ 
					$ago=intval(date('H'))-intval($hour); 
					echo "</h4> ".$row2["post_content"]."<br> -- <small> Posted ".$ago." hours ago </small><br>";
				}
				if ($present!=date("Y-m-d")){
					echo "</h4> ".$row2["post_content"]."<br> --<small> Posted on ".$present."</small><br>";
				}
				if ($row2["post_picture"]!="no pic"){
					echo '<img style=\'max-width:100%\'; src="'.$row2["post_picture"].'"/><br />';
			}
		    $_SESSION[$x."name"]=$row2["username"];
			$_SESSION[$x."post_id"]=$row2["post_id"];
			$like_post='select like_post from users where username="'.$_SESSION["username"].'"';
			$result_post=mysqli_query($con,$like_post);
			$row_post=mysqli_fetch_array($result_post);
			$row_post=rtrim($row_post["like_post"]);
			$showl=false;
			$ulikes=preg_split("/\s/",$row_post);
			foreach($ulikes as $m=>$n)
			{
				if($n==$row2["post_id"])
				{
					$showl=true;
					break;
				}
			}
			$like_post='select like_post from users where username="'.$_SESSION["username"].'"';
			$result_post=mysqli_query($con,$like_post);$row_post=mysqli_fetch_array($result_post);
			if($showl==true)
			{
?>
				<img id="<?php echo $x;?>" onclick="changeImage(<?php echo $x;?>)" src="images/like_color.jpg" width="20" height="18"/>
				<?php echo " ".$row2["like_num"]." likes <small>You have liked this post~</small>";?>
				<p id="<?php echo "+1".$x;?>"></p>
<?php
			}
			else
			{	
				?>	       
				<img id="<?php echo $x ?>" onclick="changeImage(<?php echo $x ?>)" src="images/like_grey.jpg" width="20" height="18"/>	
				<?php
				echo " ".$row2["like_num"]." likes";
				?>
				<h4 id="<?php echo "+1".$x ?>"></h4>
				<?php
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
		$row3=mysqli_fetch_assoc($result3);
		echo "<h4><a href=\"profile.php?user=".$row3["usertwo"]."\">".$row3["usertwo"]."'s Followers </a></h4>";
		echo $row3["userone"]." and others are the followers of ".$row3["usertwo"].". <br />";
?>
	</p>
	</span>
	</span>
<?php
	}
}
if(($cl=="t")||($cl=="q"))
{
		for ($y=0;$y<$rowcount4;$y++)
		{
?>
	<span style="display:inline-block;height:30px;vertical-align:left;"></span>
	<span class="info_block" style="display:inline-block;width:100%;min-height:100px;vertical-align:left;">
	<span style="display:block;margin-top:20px;margin-left:50px;margin-bottom:20px;text-align:left;">
	<p>
<?php
		$row4=mysqli_fetch_assoc($result4);
		echo '<h4><a href=light.php>Positive quote: '.$row4["quote_content"]."</a></h4>";
		echo '<img style=\'max-width:90%\'; src="'.$row4["quote_picture"].'"/><br />';
?>
	</p>
	</span>
	</span>
<?php
	}
}
	if (($rowcount1==0) and ($rowcount2==0) and ($rowcount3==0) and ($rowcount4==0))
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

	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_free_result($result3);
	mysqli_free_result($result4);	// Free result set
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
	if(!isset($_GET["content"]))
	{
		echo "[NONE]";
	}
	else
	{
		echo $_GET["content"];
	}
	echo "<br /></h4>";
	
	echo "<h4>Searching category is: ";
	if(!isset($_GET["content"]))
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
		else if($cl=="q")
		{
			echo "Quote";
		}
	}
	echo "<br /></h4>";
	
	echo "About ";
	if(!isset($_GET["content"]))
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
<a href="index.php" class="main_button">Home</a>
<span class="division_line"></span>
<a href="light.php" class="main_button">Light</a>
<span class="division_line"></span>
<a href="profile.php" class="main_button">Profile</a>
</span>

<img src="images/logo.png" style="display:inline-block;max-height:30px;"/>

<div style="float:right;margin-right:45px;width:20%;height:1px;"></div>
</div>

</body>
</html>