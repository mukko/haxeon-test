<?php
	require_once("common.php");
	
	//スマーティを使用
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	//ログインフォーム画面からの情報取得
	$id = $_POST['id'];
	$pass = $_POST['pass'];
	
	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");
	
	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
	  error("データベースとの接続に失敗しました。お手数ですがもう一度時間をおいてやり直して下さい。", $smarty);
	}
	
	//クエリ実行
	$result = $db->query("SELECT * FROM `ACCOUNT` WHERE `userID` = '$id'");
	
	if ($result) {
		$userID = "";
		$userPass = "";
		$userName = "";
		$isEnable = 0;
		
		while($row = $result->fetch_object()){
			$userID   = htmlspecialchars($row->userID);
			$userPass = htmlspecialchars($row->userPass);
			$userName = htmlspecialchars($row->userName);
			$isEnable = htmlspecialchars($row->isEnable);
		}
		
		if ($userName != "" && $isEnable == 0) {
			error("このアカウントは認証が完了していません。認証メールをご確認下さい。", $smarty);
		}
		//フォームから入力されたパスワードとDBのパスワードが一致したら成功
		if($userPass == $pass && $userID == $id && ($id != "") && ($pass != "")){
			//セッション開始命令
			session_start();
			$_SESSION['userID'] = $userID;
			$_SESSION['userName'] = $userName;
			
			//スマーティにログイン情報を保持
			$smarty->assign('userName', $userName);
			$smarty->assign('isLogin', true);
			
			//リダイレクト
			header("refresh:2; index.php");
		} else {
			error("IDかパスワードが間違っています。もう一度入力してください。", $smarty);
		}
	}
	else {
		error("クエリの実行に失敗しました。入力エラーです。", $smarty);
	}

	$db->close();
	
	$smarty->display('login_post.tpl');
	
	
//エラー出力関数
function error($errorMsg, $smarty) {
	$smarty->assign('errorMsg', $errorMsg);
	$smarty->assign('isLogin', false);
	$smarty->assign('preLink', $_SERVER['HTTP_REFERER']);
	$smarty->display('login_post.tpl');
	exit();
}