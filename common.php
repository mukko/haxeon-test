<?php
	//スマーティを使用
	require_once('Smarty.class.php');
	$smarty = new Smarty();

	//共通部分のURL登録
	$smarty->assign('commonURL', 'http://localhost/haxeon/');

	//DBへの接続処理
	$dbName 	= 'haxeon';
	$user		= 'root';
	$password 	= 'DELL';

	$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
	if ($db->connect_error){
	  print("connection error" . $db->connect_error . "<br>");
	  exit();
	}

	//未ログイン時の処理
	if (!isset($_COOKIE["PHPSESSID"])) {
		//スマーティのログイン情報の判定変数を設定
		$smarty->assign('isLogin', false);
	}
	//ログイン時はアイコンURLを取得する
	else {
		session_start();
		$id = $_SESSION['userID'];

		$smarty->assign('isLogin', true);
		// $smarty->assign('userName', $name);
		$result =  $db->query("SELECT * FROM `account` WHERE `userID` = \"".$id."\"");

		if($result){
			while($row = $result->fetch_object()){
				$icon = htmlspecialchars($row->userIcon);
				$name = htmlspecialchars($row->userName);
				$smarty->assign('iconURL',$icon);
				$smarty->assign('userName', $name);
			}
		}
	}

	$smarty->display('common.tpl');
?>
