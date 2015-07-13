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
	  print("接続失敗：" . $db->connect_error . "<br>");
	  exit();
	}
	
	//クエリ実行
	$result = $db->query("SELECT * FROM `ACCOUNT` WHERE `userID` = '$id'");
	
	if ($result) {
		$userID = "";
		$userPass = "";
		
		while($row = $result->fetch_object()){
			$userID   = htmlspecialchars($row->userID);
			$userPass = htmlspecialchars($row->userPass);
			$userName = htmlspecialchars($row->userName);
		}
		//フォームから入力されたパスワードとDBのパスワードが一致したら成功
		if($userPass == $pass && $userID == $id){
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
			$smarty->assign('isLogin', false);
			$smarty->assign('preLink', $_SERVER['HTTP_REFERER']);
		}
	}
	else {
		$smarty->assign('isLogin', false);
		$smarty->assign('preLink', $_SERVER['HTTP_REFERER']);
	}

	$db->close();
	
	$smarty->display('login_post.tpl');
?>