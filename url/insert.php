<?php
	function newcode($s)//this funtion use for genrate new sorten url here we can use some other algorithim accoring to url name or new algo
	{
		if(ord($s[1])==122)
		{
			$s[0]=chr(ord($s[0])+1);
			$s[1]='a';
		}
		else
		{
		$s[1]=chr(ord($s[1])+1);
		}
		return $s;
	}


	$uri = $_POST['URL'];
	$db = mysqli_connect('127.0.0.1','root','ttt','urishortner');
	if(!$db)
	{
		echo "Connection error to Database urishortner";
	}

	$initcode = "SELECT `url` FROM `url` WHERE `code` = 'lastcode'";
	$result1 = mysqli_query($db,$initcode);
	$row1 = mysqli_fetch_array($result1);
	$code = newcode($row1['url']);
	$result2 = mysqli_query($db,"UPDATE `url` SET `url` = '$code' WHERE `code` = 'lastcode'");
	$query = "INSERT INTO `url`(`code`, `url`) VALUES ('$code','$uri')";
	$result = mysqli_query($db,$query);

	if($result)
		{
			echo 'Your new url is: <a href="http://localhost/url/j/'.$code.'">http://localhost/url/j/'.$code.'</a>';
		}
		else
			{
				echo "error";
			}
?>