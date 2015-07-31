<?php
	require_once("common.php");

	//Smartyを使用
	require_once('Smarty.class.php');
	$smarty = new Smarty();

	//サインアップフォームからの情報取得
	$id = $_POST['userID'];
	$currentPass = $_POST['currentPass'];
	$pass  = $_POST['userPass'];
	$pass2 = $_POST['userPass2'];
	$name = $_POST['userName'];
	$profile = $_POST['userProfile'];
	$url = $_POST['userURL'];

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

	//入力内容チェック処理
	while (true) {
		//IDの文字数チェック
		if (strlen($id) < 4) {
			error("IDが短すぎます。4文字以上で登録して下さい。", $smarty);
			break;
		}
		//既存IDとの重複チェック
		$result = $db->query("SELECT * FROM `account` WHERE `userID`= \"".$id."\"");
		if ($result) {
			$db_id = "";
			while ($row = $result->fetch_object()) {
				$db_id = htmlspecialchars($row->userID);
			}
			if ($db_id == $id) {
				error("入力されたIDは既に使用されています。別のIDを入力して下さい。", $smarty);
				break;
			}
		}
		//パスワードの不一致チェック
		if ($pass != $pass2) {
			error("パスワードが一致しません。2つの同じパスワードを入力してください。", $smarty);
			break;
		}
		//パスワードの文字数チェック
		if (strlen($pass) < 4 || strlen($pass2) < 4 ) {
			error("パスワードは4文字以上で入力してください。", $smarty);
			break;
		}
		//アイコン画像のチェック
		if (strlen($_FILES["userIcon"]["name"]) == 0 ) {
			$filePass = "img/icon/empty_thumbnail.png";
		}else{
			//入力内容が正しかった場合
			$filePass = "img/icon/".$_FILES["userIcon"]["name"];
			//アップロードされた画像ファイルの保存
			if (move_uploaded_file($_FILES["userIcon"]["tmp_name"], "img/icon/".$_FILES["userIcon"]["name"])) {
				chmod("img/icon/".$_FILES["userIcon"]["name"],0644);
				echo $_FILES["userIcon"]["name"] . "をアップロードしました。";
			} else {
				error("画像アップロードに失敗しました。お手数ですがやり直してください。", $smarty);
				break;
			}
		}

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
		}
		break;
	}

	$db->close();

	$smarty->display('update_account_post.tpl');


//エラー出力関数
function error($errorMsg, $smarty) {
	$smarty->assign('errorMassage', $errorMsg);
	$smarty->assign('preLink', $_SERVER['HTTP_REFERER']);
	$smarty->assign('isCorrect', false);
}
