<?php
	//共通部分の読み込み
	require_once("common.php");

	//Smartyオブジェクト作成
	$smarty = new Smarty();

	//ひな形のSmartyテンプレートでincludeするテンプレートを指定
	$smarty->assign('content_tpl','create_form.tpl');

	//パラメータを渡す
	$smarty->assign('project', 'プロジェクト名');

	//ページを表示する
	$smarty->display('create_common.tpl');
?>
