<?php
	include_once("AssignSmarty.php");
	include_once("common.php");
	
	//セッションからログイン中のユーザーIDを取得
	$userID = $_SESSION['userID'];
	
	new AssignSmarty("delete_account_form.tpl", Array("userID", $userID));
