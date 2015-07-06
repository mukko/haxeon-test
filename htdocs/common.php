<?php
	//スマーティを使用
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	//共通部分のURL登録
	$smarty->assign('commonURL', 'http://localhost/haxeon/');
	
	//DBへの接続処理
	$dbName 	= 'haxeon';
	$user		= 'root';
	$password 	= 'w3whS2jS23';

	$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
	if ($db->connect_error){
	  print("connection error" . $db->connect_error . "<br>");
	  exit();
	}
	
	//未ログイン時の処理
	if (!isset($_COOKIE["PHPSESSID"])) {
		$smarty->assign('isLogin', false);
	}
	//ログイン時はアイコンURLを取得する
	else {
		$smarty->assign('isLogin', true);
		$smarty->assign('userName', $_GET[account]);
		$result =  $db->query("SELECT `userIcon` FROM `account` WHERE `userName` = \"$_GET[account]\"");
		if($result){
			while($row = $result->fetch_object()){
				$icon = htmlspecialchars($row->userIcon);
			}
		}
		$smarty->assign('iconURL',$icon);
	}
	
	$smarty->display('common.tpl');
?>
