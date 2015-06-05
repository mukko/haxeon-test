<html>
<head><title>ログイン</title></head>
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

	$result = $db->query("SELECT * FROM `ACCOUNT` WHERE `userID` = '$id'");
	if($result){
		while($row = $result->fetch_object()){
			$userID   = htmlspecialchars($row->userID);
			$userPass = htmlspecialchars($row->userPass);
			$userName = htmlspecialchars($row->userName);
			echo("$userID | $userPass | $userName <br>");	//デバッグ
		}
		if($userPass == $pass){
			echo("<br>ログイン成功！！こんにちは $userName さん！");
		} else {
			$text = '戻る';
			echo("IDかパスワードが間違っています。");
			echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $text . "</a>";
		}
	}
	else {
		echo("IDかパスワードが間違っています。");
		echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $text . "</a>";
	}

	$db->close();
?>

</body>
</html>
