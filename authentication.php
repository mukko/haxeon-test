<?php
	//共通部分の読み込み
	require_once("common.php");
	
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	$id = "";
	$hash = "";
	$smarty->assign('isEnable', false);
	
	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
		error("データベースの接続に失敗しました。申し訳ございませんが、後ほどやり直して下さい。",$smarty);
	}
	
	//URLに前のフォームで入力した情報があれば登録する
	if (isset($_GET['hash']) && isset($_GET['id'])) {
		$id = $_GET['id'];
		$hash = $_GET['hash'];
	}
	else {
		error("認証に失敗しました。メールのリンクをご確認ください。",$smarty);
	}
	
	//データベースのハッシュと照合
	$result = $db->query("SELECT * FROM `account` WHERE `userID`= '$id';");
	if ($result) {
		while ($row = $result->fetch_object()) {
			$db_hash = htmlspecialchars($row->MD5);
		}
		//成功した場合はアカウントを有効にする
		if ($db_hash == $hash) {
			$smarty->assign('isEnable', true);
			$db->query("UPDATE `account` SET `isEnable` = 1 WHERE `userID` = '$id';");
		}
		else {
			error("認証に失敗しました。メールのリンクをご確認ください。",$smarty);
		}
	}
	else {
		error("認証に失敗しました。メールのリンクをご確認ください。",$smarty);	
	}
	
	$db->close();
	
	$smarty->display('authentication.tpl');

	
//エラー出力関数
function error($errorMsg, $smarty) {
	$smarty->assign('errorMsg', $errorMsg);
	$smarty->display('authentication.tpl');
	exit();	
}
