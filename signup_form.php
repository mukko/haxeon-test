<?php
	//共通部分の読み込み
	require_once("common.php");
	
	//Smartyオブジェクト作成
	$smarty = new Smarty();
	
	//ひな形のSmartyテンプレートでincludeするテンプレートを指定
	$smarty->assign('content_tpl', 'signup_form.tpl');
	
	$smarty->assign('params',array(
		'types' => array()
		)
	);
	
	//ページを表示する
	$smarty->display('signup_common.tpl');
?>
