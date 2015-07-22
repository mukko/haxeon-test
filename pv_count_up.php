<?php
	if (isset($_GET['uid']) && isset($_GET['pName'])) {
		
		//URLから情報取得
		$uid = $_GET['uid'];	//ユーザーID
		$pName = $_GET['pName'];	//プロジェクト名
		
		echo 
		//データベース接続処理
		$dbName = 'haxeon';
		$user = 'root';
		$password = 'DELL';
		$db = new mysqli('localhost', $user , $password, $dbName) or die("error");
		
		//データベースへの接続が失敗したらエラーを出力して終了
		if ($db->connect_error){
		  print("接続失敗：" . $db->connect_error . "<br>");
		  exit();
		}
		
		//pv数を取得して1増やす
		$result = $db->query('SELECT `pv` FROM `project` WHERE `ownerUserID` = "'.$uid.'" AND `projectName` = "'.$pName.'"');
		if ($result) {
			while($row = $result->fetch_object()){
				$pv = htmlspecialchars($row->pv);
			}
			$pv+=1;	
			echo $pv;	//デバッグ
			
			$db->query('UPDATE `project` SET `pv`='.$pv.' WHERE `ownerUserID` = "'.$uid.'" AND `projectName` = "'.$pName.'"');
		}
		else {
			echo "PVのカウントアップに失敗しました。";
		}
	}
