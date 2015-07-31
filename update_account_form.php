<?php
	//共通部分の読み込み
	require_once("common.php");
	
	//Smartyオブジェクト作成
	$smarty = new Smarty();
	//$smarty->assign('uid', $_SESSION['userID']);
	
	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
	  print("接続失敗：" . $db->connect_error . "<br>");
	  exit();
	}
	
	//既存IDとの重複チェック
	$result = $db->query("SELECT * FROM `account` WHERE `userID`= '$id'");
	if ($result) {
		while ($row = $result->fetch_object()) {
			$userID = htmlspecialchars($row->userID);
			$userName = htmlspecialchars($row->userName);
			$userIcon = htmlspecialchars($row->userIcon);
			$userProfile = htmlspecialchars($row->userProfile);
			$userURL = htmlspecialchars($row->userURL);
		
			$smarty->assign('userID', $userID);
			$smarty->assign('userName', $userName);
			$smarty->assign('userIcon', $userIcon);
			$smarty->assign('userProfile', $userProfile);
			$smarty->assign('userURL', $userURL);
		}
	}

	$db->close();
	
	//ページを表示する
	$smarty->display('update_account_form.tpl');
