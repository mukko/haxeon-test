<?php
	include_once("AssignSmarty.php");
	include_once("connectDB.php");
	
	$smartyArgs = array();
	array_push($smartyArgs, "commonURL", "http://localhost/haxeon/");
	
	try {
		$cDB = new ConnectDB();
		$db = $cDB->getDB();
	} catch (Exception $e) {
		echo($e);
		exit();
	}

	//ログイン時はアイコンURLを取得する
	if (isset($_COOKIE["PHPSESSID"])){
		//セッションがアクティブでない場合はセッションを起動する
		if (!(session_status() == PHP_SESSION_ACTIVE)) {
			session_start();
		}
		
		array_push($smartyArgs, "id", $_SESSION['userID']);
		array_push($smartyArgs, "isLogin", true);
		
		$result =  $db->query("SELECT * FROM `account` WHERE `userID` = \"".$_SESSION['userID']."\"");
		
		if($result){
			while($row = $result->fetch_object()){
				array_push($smartyArgs ,"iconURL", htmlspecialchars($row->userIcon));
				array_push($smartyArgs ,"userName", htmlspecialchars($row->userName));
			}
		}
	}
	else {
		array_push($smartyArgs, "isLogin", false);
	}
	
	new AssignSmarty("common.tpl",$smartyArgs);
