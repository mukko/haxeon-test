<?php
	require("AssignSmarty.php");
	
	//セッションからログイン中のユーザーIDを取得
	session_start();
	$userID = $_SESSION['userID'];
	
	new AssignSmarty("common.php", "delete_account_form.tpl", "userID", $userID);
