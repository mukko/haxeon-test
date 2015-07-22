<?php
	if (isset($_GET['id'])) {
		
		//URLから情報取得
		$id = $_GET['id'];
		
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
		$result = $db->query('SELECT `pv` FROM `project` WHERE `projectID` = "'.$id.'"');
		if ($result) {
			while($row = $result->fetch_object()){
				$pv = htmlspecialchars($row->pv);
			}
			$pv+=1;	
			echo $pv;	//デバッグ
			
			$db->query('UPDATE `project` SET `pv`='.$pv.' WHERE `projectID` = "'.$id.'"');
		}
		else {
			echo "PVのカウントアップに失敗しました。";
		}
	}
