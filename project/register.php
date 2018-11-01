<html>
<head>
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="theme.css"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favorite.png"/>
<script type="text/javascript">

function passwordcheck(){
var regex = /\W/;

if (register.password.value == "")
{
document.getElementById('warningpass').innerHTML = "Please enter your name";

}else if(register.password.value.match(regex)){
document.getElementById('warningpass').innerHTML = "You should enter a valid password";

}else{
	document.getElementById('warningpass').innerHTML = "";
}
}
function validateForm() {
	var t1 = 0;
	if (register.username.value=="") {
		document.getElementById("warningusername").innerHTML="Username is required";
		t1=1;
	}
	if (register.email.value=="") {
		document.getElementById("warningemail").innerHTML="Email is required";
		t1=1;
	}
	if (register.password.value=="") {
		document.getElementById("warningpass").innerHTML="Password is required";
		t1=1;
	}
	if (register.city.value=="") {
		document.getElementById("warningcity").innerHTML="City is required";
		t1=1;
	}
	
	if(t1==0)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}
</script>
</head>
<body>
<div style="margin-top:120px;position:absolute;left:10%;width:80%;text-align:center;min-width:950px;min-height:600px;">
<span class="info_block" style="display:inline-block;width:25%;min-width:300px;vertical-align:top;padding:30px;text-align:center;">

<form name="register" method="POST" action="registration.php" onsubmit="return validateForm()">
<p>
Username<br/>
<input type="text" placeholder="John" id="username" name="username" class="input_bar" style="text-align:center;">
</p><span style="color: red;font:italic;" id="warningusername"></span>
<p>
Email<br/>
<input type="email" placeholder="abc@example.com" id="email" name="email" class="input_bar" style="text-align:center;">
</p><span style="color: red;font:italic;" id="warningemail"></span>

<p>
Password<br/>
<input type="password" id="password" name="password" class="input_bar" style="text-align:center;" oninput="passwordcheck()" >
</p><span style="color: red;font:italic;" id="warningpass"></span>

<p>
City<br/>
<input type="text" placeholder="Hong Kong" id="city" name="city" class="input_bar" style="text-align:center;">
</p><span style="color: red;font:italic;" id="warningcity"></span>
 <p> Gender:  
	  <input type="radio" id="gender" name="gender" value="1" /> Male 
	  <input type="radio" id="gender" name="gender" value="2" /> Female
	  <input type="radio" id="gender" name="gender" value="3" /> Both
	  <input type="radio" id="gender" name="gender" value="4" checked /> Undecided
</p>


    <div>
        <label for="start">Birthday</label>
        <input type="date" id="birthday" name="birthday"
               value="2018-10-25"
               min="1900-01-01" max="2018-12-31" />
    </div>
	<p></p>
<input type="submit" value="Register" class="node_button" style="background-color:orange">
</form>

</span>

</div>


<!--Put the top bar at the end makes it on top of any other one-->
<div class="top_bar" style="text-align:center;">
<img src="images/logo.png" style="display:inline-block;max-height:30px;"/>
</div>

<div class="bottom_bar" style="text-align:center;">
<span style="font-size:12px;color:#888888;">Copyright Out#Rage 2018</span>
</div>

</body>
</html>