<?php
	include("common.php");

	require_once('Smarty.class.php');
	$smarty = new Smarty();

	//ユーザー情報を取得
	$uid;
	if(isset($_SESSION['userID'])){
	$uid = $_SESSION['userID'];
	}
	
	$smarty->assign('userID', $uid);
	
	$smarty->display('delete_account_form.tpl');
