<?php
	require_once("common.php");
	require_once("AssignSmarty.php");
	require_once("connectDB.php");
	
	$smartyArgs = array();
	
	try {
		$cDB = new ConnectDB();
		$db = $cDB->getDB();
	} catch (Exception $e) {
		error($e);
	}
	
	while (true) {
		//メールアドレスから取得した変数のチェック
		if (empty($_GET['hash']) || empty($_GET['id'])) error();
		
		$id = $_GET['id'];
		$hash = $_GET['hash'];
		
		//データベースのハッシュと照合
		$result = $db->query("SELECT * FROM `account` WHERE `userID`= '$id';");
		
		if (!$result) error();
		
		while ($row = $result->fetch_object()) {
			$db_hash = htmlspecialchars($row->MD5);
		}
		//メールアドレスから取得したハッシュ値とDBのハッシュ値の一致確認
		if ($db_hash != $hash) error();
		
		//成功した場合はアカウントを有効にする
		array_push($smartyArgs, "isSuccess", true);
		$db->query("UPDATE `account` SET `isEnable` = 1 WHERE `userID` = '$id';");
		
		break;
	}
	
	$db->close();
	
	new AssignSmarty("authentication.tpl",$smartyArgs);
	
//エラー出力
function error() {
	new AssignSmarty("authentication.tpl", array( "isSuccess", false, 'errorMsg', "認証に失敗しました。メールのリンクをご確認ください。"));
	exit();
}
