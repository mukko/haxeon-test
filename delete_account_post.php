<?php
	include("common.php");

	require_once('Smarty.class.php');
	$smarty = new Smarty();

	//ユーザー情報を取得
	$uid = "";
	$pass = "";
	
	//IDとパスワードの取得
	if (isset($_SESSION['userID'])){
		$uid = $_SESSION['userID'];
	}
	if (isset($_POST['userPass'])) {
		$pass = $_POST['userPass'];
	}
	
	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
		error("データベースとの接続に失敗しました。お手数ですがもう一度時間をおいてやり直して下さい。", $smarty);
	}
	
	//データベースからパスワードを取得
	$db_pass = "";
	$result = $db->query("SELECT `userPass` FROM `account` WHERE `userID`= '$uid';");
	if ($result) {
		while ($row = $result->fetch_object()) {
			$db_pass = htmlspecialchars($row->userPass);
		}
	}
	
	//入力されたパスワードとDBのパスワードが一致した場合は削除処理を行う
	if ($pass == $db_pass) {
		//クエリ実行
		$db->query("DELETE FROM `account` WHERE `userID` = '$uid'");		//アカウント情報の削除
		$db->query("DELETE FROM `project` WHERE `ownerUserID` = '$uid'");	//所持プロジェクトの削除
		//セッション変数を全て解除する
		$_SESSION = array();
		//セッションを切断するにはセッションクッキーも削除する。
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		//セッションを破壊する
		session_destroy();
		$smarty->assign('isCorrect', true);
		$smarty->display('delete_account_post.tpl');
	}
	else {
		error("パスワードが一致しません。トップページに移動します。",$smarty);
	}
	
	$db->close();
	header("refresh:3; index.php");

//エラー出力関数
function error($errorMsg, $smarty) {
	$smarty->assign('errorMsg', $errorMsg);
	$smarty->assign('isCorrect', false);
	$smarty->display('delete_account_post.tpl');
	header("refresh:3; index.php");
}
