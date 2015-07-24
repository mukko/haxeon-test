<?php
	require_once("common.php");

	//Smartyを使用
	require_once('Smarty.class.php');
	$smarty = new Smarty();

	//サインアップフォームからの情報取得
	$id = $_POST['userID'];
	$pass = $_POST['userPass'];
	$mail = $_POST['userMail'];

	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
	  error("接続に失敗しました。申し訳ございませんが、後ほどやり直して下さい。", $smarty);
	  exit();
	}

	//入力内容チェック処理
	while (true) {
		//IDの文字数チェック
		if (strlen($id) < 4) {
			error("IDが短すぎます。4文字以上で登録して下さい。", $smarty);
			break;
		}
		//パスワードの文字数チェック
		if (strlen($pass) < 4) {
			error("パスワードが短すぎます。4文字以上で登録して下さい。", $smarty);
			break;		
		}
		//既存ID・メール重複チェック
		$result = $db->query("SELECT * FROM `account` WHERE `userID`= \"".$id."\" OR `userMail` = \"".$mail."\";");
		if ($result) {
			$db_id = "";
			$db_mail = "";
			while ($row = $result->fetch_object()) {
				$db_id = htmlspecialchars($row->userID);
				$db_mail = htmlspecialchars($row->userMail);
			}
			if ($db_id == $id) {
				error("入力されたIDは既に使用されています。別のIDを入力して下さい。", $smarty);
				break;
			}
			if($db_mail == $mail) {
				error("入力されたメールアドレスは既に使用されています。別のメールアドレスで登録してください。", $smarty);
				break;
			}
		}
		/*
		$result = $db->query("INSERT INTO `haxeon`.`account` (`userID`, `userPass`, `userName`, `userIcon`, `userProfile`, `userURL`,`userMail`) VALUES ( '$id', '$pass', '$name', '$filePass' , '$profile', '$url', '$mail');");
		if ($result) {
			//Smartyに変数登録
			$smarty->assign('isCorrect', true);
			$smarty->assign('userName',$id);
			//リダイレクト
			header("refresh:3; login_form.php");
		}
		else {
			error("登録処理に失敗しました。お手数ですがやり直してください。", $smarty);
			die('INSERTクエリーが失敗しました。'.mysql_error());
		}*/
		header("refresh:3; login_form.php");
		break;
	} 

	$db->close();

	$smarty->display('signup_tmp_post.tpl');


//エラー出力関数
function error($errorMsg, $smarty) {
	$smarty->assign('errorMassage', $errorMsg);
	$smarty->assign('preLink', $_SERVER['HTTP_REFERER']);
	$smarty->assign('isCorrect', false);
	$smarty->assign('userID', $_POST['userID']);
	$smarty->assign('userMail', $_POST['userMail']);
}
