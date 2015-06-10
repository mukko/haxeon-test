<!DOCTYPE html>
<html>
	<head>	
	<meta charset="UTF-8" />
	<title>HAXEON</title>
	</head>

	<img src="img/title.jpg" width="500" height="200" alt=""> <br>
	へようこそ。<br><br>

	<body>
	<a href="http://localhost/try-haxe/index.html"><img src="img/sample3.jpg" border="10"></a><br>
	<a href="createProject.html"><img src="img/createPro.jpg" border="10"></a><br>

	<?php

	$dbName = 'haxeon';
	$user = 'root';
	$password = 'w3whS2jS23';

	$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
	if ($db->connect_error){
	  print("connection error" . $db->connect_error . "<br>");
	  exit();
	}

	if(!isset($_COOKIE["PHPSESSID"])){
		?> <font size="7" color="red" face="HGP創英角ﾎﾟｯﾌﾟ体">
		こんにちは、ゲストさん！！ <br>
		<a href="login.html"><img src="img/sample.jpg" border="0"></a>
		<a href="signup.html"><img src="img/sample2.jpg" border="0"></a><br>
		</font> <?php
	} else {
		echo '<font size="7" color="red" face="HGP創英角ﾎﾟｯﾌﾟ体">'."$_GET[account]".' さん、こんにちは！！</font></br>';
		echo '<a href="logout.php"><img src="img/logout.jpg" border="0"></a><br>';
		print('セッションIDは'.$_COOKIE["PHPSESSID"].'です。<br>');
		$result =  $db->query("SELECT `userIcon` FROM `account` WHERE `userName` = \"$_GET[account]\"");
		if($result){
			while($row = $result->fetch_object()){
				$icon = htmlspecialchars($row->userIcon);
			}
		}
		echo '<img src='.$icon.' border="0">';
	}

	$result = $db->query("SELECT * FROM `PROJECT` ORDER BY `PV` DESC");
	if($result){
		$i = 1;

		?><br><br><font size="10">Hot Codes</font><br><?php

		while($row = $result->fetch_object()){
			$proID = htmlspecialchars($row->projectID);
			$userID = htmlspecialchars($row->ownerUserID);
			$pv = htmlspecialchars($row->pv);
			$url = htmlspecialchars($row->url);

			//後で出力を整える
			echo "第 $i 位 <a href=$url > $proID   </a>";
			echo("| $userID | $pv PV!!! <br> ");
			$i++;
		}
	}

	$db->close();

	?>

	<br><br><font size="10"><a href="http://haxe.org/" target="_blank"> What's HAXE </a></font><br>
	</body>
</html>
