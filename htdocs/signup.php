<html>
<head><title>�T�C���A�b�v���</title></head>
<body>

<?php
	header("Content-Type: text/html; charset=Shift-JIS");
	$id = $_POST['id'];
	$pass = $_POST['pass'];

	//�f�o�b�O
	print("��M�����f�[�^�� <strong> $id - $pass </strong> �ł��B<br/><br/>");

	//�f�[�^�x�[�X�ڑ�����
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'w3whS2jS23';

	$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
	//�f�[�^�x�[�X�ւ̐ڑ������s������G���[���o�͂��ďI��
	if ($db->connect_error){
	  print("�ڑ����s�F" . $db->connect_error . "<br>");
	  exit();
	}

	$result = $db->query("INSERT INTO `haxeon`.`sample` (`ID`, `PASS`, `FAV`) VALUES ( '$id', '$pass', '.rand(1,100).');");
	if($result){
		print("seikou");
	}
	else{
		die('INSERT�N�G���[�����s���܂����B'.mysql_error());
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
