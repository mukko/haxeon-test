<?php 
	//共通部分の読み込み
	require_once("common.php");

	//Smartyオブジェクト作成
	$smarty = new Smarty();
	
	//ひな形のSmartyテンプレートでincludeするテンプレートを指定
	$smarty->assign('content_tpl','login_form.tpl');
	
	//パラメータを渡す
	$smarty->assign('params',array(
		'types' => array(
			'id'  => 'ユーザID',
			'pass'=> 'パスワード',
			)
		)
	);
	
	//ページを表示する
	$smarty->display('login_common.tpl');
?>