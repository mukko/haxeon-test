<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<title>Haxe on!</title>
	</head>

	<body>
	<font face="HGP創英角ﾎﾟｯﾌﾟ体","ヒラギノ角ゴ Pro W3","メイリオ">
	<!-- ヘッダー -->
	<div id="header"><h1>Haxe On!</h1></div>

	<div class="menu">

	<?php
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'koji';

	$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
	if ($db->connect_error){
	  print("connection error" . $db->connect_error . "<br>");
	  exit();
	}

	//未ログイン時はログインとサインアップを表示
	if(!isset($_COOKIE["PHPSESSID"])){
	?>
	<ul>
		<li><a href="http://localhost/haxeon_first/htdocs/login.html">Login</a>
			<ul>
				<li><a href="http://localhost/haxeon_first/htdocs/signup.html">Signup</a></li>
			</ul>
		</li>
	<?php
	//ログイン時はアカウント名とアカウントサービスを表示
	} else {
		//print('セッションIDは'.$_COOKIE["PHPSESSID"].'です。<br>');	//デバッグ
		//ユーザー名からアイコンを取得
		$result =  $db->query("SELECT `userIcon` FROM `account` WHERE `userName` = \"$_GET[account]\"");
		if($result){
			while($row = $result->fetch_object()){
				$icon = htmlspecialchars($row->userIcon);
				$id = htmlspecialchars($row->userID);
			}
		}
	?>
	<ul>
		<!-- ログインユーザーのプロフィールページに飛べない -->
		<li><?php echo("<a href=http://localhost/haxeon_fiest/htdocs/profile.php?id=$id>");?><h3>Hello, <img src="<?php echo $icon?>" width=10% height=10%> <?php echo "$_GET[account]"?></a></h3>
			<ul>
				<li><a href="#">Posted Codes</a></li>
				<li><a href="#">Favorite Codes</a></li>
				<li><a href="#">Followers</a></li>
				<li><a href="http://localhost/haxeon_first/htdocs/logout.php">Logout</a></li>
			</ul>
		</li>
	<?php } ?>
		<li>Ranking
			<ul>
				<li><a href="#">Page View Ranking</a></li>
				<li><a href="#">Favorite Ranking</a></li>
				<li><a href="#">Forked Count Ranking</a></li>
			</ul>
		</li>

		<li>Create Code
			<ul>
				<li><a href="http://localhost/haxeon_first/try-haxe/index.html">Try-haxe</a></li>
				<li><a href="http://localhost/haxeon/createProject.html">Create Project</a></li>
			</ul>
		</li>

		<li>Q&A
			<ul>
				<li><a href="#">New Question</a></li>
				<li><a href="#">Hot Questions</a></li>
			</ul>
		</li>

		<li>About Haxe
			<ul>
				<li><a href="http://api.haxe.org/">Api</a></li>
				<li><a href="https://github.com/HaxeFoundation/haxe">Github</a></li>
				<li><a href="http://sipo.jp/blog/2014/01/25.html">enumのすごさ</a></li>
			</ul>
		</li>

		</ul>
	</div>

	<?php
	//ホットコードを表示
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
			echo("|<a href=http://localhost/haxeon_first/htdocs/profile.php?id=$userID>$userID</a>");
			echo("| $pv PV!!! <br> ");
			$i++;
		}
	}

	$db->close();
	?>

	<!-- フッター -->
	<br/><br/>
	<div id="footer"><address>Copyright (c) シテイル All Rights Reserved.</address></div>
	</font>
	</body>
</html>
