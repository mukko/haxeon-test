<html>
<head><title>サインアップ画面</title></head>
<body>

<?php
	header("Content-Type: text/html; charset=Shift-JIS");
	$id = $_POST['id'];
	$pass = $_POST['pass'];

	//デバッグ
	print("受信したデータは <strong> $id - $pass </strong> です。<br/><br/>");

	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'w3whS2jS23';

	$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
	//データベースへの接続が失敗したらエラーを出力して終了
	if ($db->connect_error){
	  print("接続失敗：" . $db->connect_error . "<br>");
	  exit();
	}

	$result = $db->query("INSERT INTO `haxeon`.`sample` (`ID`, `PASS`, `FAV`) VALUES ( '$id', '$pass', '.rand(1,100).');");
	if($result){
		print("seikou");
	}
	else{
		die('INSERTクエリーが失敗しました。'.mysql_error());
	}


	$result = $db->query("SELECT * FROM `SAMPLE` ORDER BY `ID` ASC");
	if($result){
		echo("  ID  | PASS | FAV <br>");
		while($row = $result->fetch_object()){
			$id = htmlspecialchars($row->ID);
			$pass = htmlspecialchars($row->PASS);
			$fav = htmlspecialchars($row->FAV);
			echo("$id | $pass | $fav <br>");
		}
	}

	$db->close();
?>

</body>
</html>
