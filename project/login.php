<?php
session_start();
header("Content-type:application/xml");
if(!(@$file=fopen("list.txt","r")))
{
	echo "Cannot access the login data";
}
else
{
	$find=false;
	while((!feof($file))&&(!$find))
	{
		$line=fgets($file);
		$line=rtrim($line);
		$field=preg_split("/,/",$line);
		if($_POST["username"]==$field[0])
		{
			if($_POST["password"]==$field[1])
			{
				$_SESSION["username"]=$field[0];
				if(!(@$info=fopen("info.txt","r")))
				{
					echo "Cannot access the user info data<br/>";
					echo "<a href=\"logout.php\">Destory Session</a><br/>";
				}
				else
				{
					while(!feof($info))
					{
						$line=fgets($info);
						$line=rtrim($line);
						$field=preg_split("/,/",$line);
						if($field[0]==$_SESSION["username"])
						{
							$_SESSION["location"]=$field[1];
							$_SESSION["signature"]=$field[2];
							$_SESSION["profile"]=$field[3];
							break;
						}
					}
					fclose($info);
				}
				echo "<a style=\"color:blue;\">Login Successfully</a>";
			}
			else
			{
				echo "<a style=\"color:red;\">Wrong Password or Username</a>";
			}
			$find=true;
		}
	}
	if($find==false)
	{
		echo "<a style=\"color:red;\">Username not Found</a>";
	}
	fclose($file);
}
?>