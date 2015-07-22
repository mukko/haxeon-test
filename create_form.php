<?php
	//共通部分の読み込み
	require_once("common.php");
	
	//プロジェクト作成時にログインしていなかったら警告
	if (!isset($_SESSION['userID'])) {
		echo "ログインしてください！5秒後にトップページに戻ります。";
		header("refresh:5; index.php");
		exit;
	}

	//Smartyオブジェクト作成
	$smarty = new Smarty();

	//ひな形のSmartyテンプレートでincludeするテンプレートを指定
	$smarty->assign('content_tpl','create_form.tpl');

	//パラメータを渡す
	$smarty->assign('project', 'プロジェクト名');

	//ページを表示する
	$smarty->display('create_common.tpl');
?>
