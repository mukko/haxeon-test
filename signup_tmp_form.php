<?php
	//共通部分の読み込み
	require_once("common.php");
	
	//Smartyオブジェクト作成
	$smarty = new Smarty();
	
	$userID = "";
	$userMail = "";
	
	//URLに前のフォームで入力した情報があれば登録する
	if (isset($_GET['id'])) {
		$userID = $_GET['id'];
	}
	if (isset($_GET['mail'])) {
		$userMail = $_GET['mail'];
	}
	
	$smarty->assign('userID', $userID);
	$smarty->assign('userMail', $userMail);
	
	//ひな形のSmartyテンプレートでincludeするテンプレートを指定
	$smarty->assign('content_tpl', 'signup_tmp_form.tpl');
	
	$smarty->assign('params',array(
		'types' => array()
		)
	);
	
	//ページを表示する
	$smarty->display('signup_tmp_form.tpl');
?>
