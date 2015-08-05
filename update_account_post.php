<?php
	require_once("common.php");

	//Smartyを使用
	require_once('Smarty.class.php');
	$smarty = new Smarty();

	//サインアップフォームからの情報取得
	$id = $_SESSION['userID'];
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
	
	$db_userID = "";
	$db_userPass = "";
	$db_userName = "";
	
	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
	  print("接続失敗：" . $db->connect_error . "<br>");
	  exit();
	}

	//入力内容チェック処理
	while (true) {
		//データベースから情報を取得
		$result = $db->query("SELECT * FROM `account` WHERE `userID`= '$id'");
		if ($result) {
			while ($row = $result->fetch_object()) {
				$db_userID = htmlspecialchars($row->userID);
				$db_userPass =  htmlspecialchars($row->userPass);
				$db_userName =  htmlspecialchars($row->userName);
			}
		}
		
		//パスワードが入力されていた場合の処理
		if (strlen($currentPass) != 0 ||strlen($pass) != 0 || strlen($pass2) != 0) {
			//既存パスワードが合っているかチェック
			if ($currentPass != $db_userID) {
				error("パスワードが一致しません。", $smarty);
				break;
			}
			//既存パスワードとのチェック
			if ($pass == $currentPass || $pass2 == $currentPass) {
				error("既存のパスワードと同じパスワードは設定できません。", $smarty);
				break;
			}
			//パスワードの不一致チェック
			if ($pass != $pass2) {
				error("新しいパスワードが一致しません。2つの同じパスワードを入力してください。", $smarty);
				break;
			}
			//パスワードの文字数チェック
			if (strlen($pass) < 4 && strlen($pass2) < 4) {
				error("パスワードは4文字以上で入力してください。", $smarty);
				break;
			}
			$db_userPass = $pass;
		}
		
		//ユーザー名が空欄かどうかをチェック
		if (strlen($name) == 0) {
			error("ユーザー名を入力してください。", $smarty);
			break;	
		}
		else {
			$db_userName = $name;
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
		
		$result = $db->query("UPDATE `account` SET `userPass`='$db_userPass' , `userName`='$db_userName' , 
			`userIcon`='$filePass',`userProfile`='$profile', `userURL`='$url' WHERE `userID` = '$id'");
		if ($result) {
			//Smartyに変数登録
			$smarty->assign('isCorrect', true);
			$smarty->assign('userName',$id);
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
	$smarty->assign('isCorrect', false);
	$smarty->assign('userName', $_POST['userName']);
	$smarty->assign('userProfile', $_POST['userProfile']);
	$smarty->assign('userURL', $_POST['userURL']);
}
