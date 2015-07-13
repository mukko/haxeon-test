<?php
	include("common.php");
	
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	header("Content-Type: text/html; charset=UTF-8");

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
	
	$smarty->display('logout.tpl');
