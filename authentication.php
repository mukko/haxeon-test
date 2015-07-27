<?php
	//共通部分の読み込み
	require_once("common.php");
	
	//URLに前のフォームで入力した情報があれば登録する
	if (isset($_GET['hash'])) {
		$hash = $_GET['hash'];
		$id = $_GET['id'];
		echo $hash;
		echo $id;
	}
