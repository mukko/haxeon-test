<html>
<head><title>���O�C��</title></head>
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

	$result = $db->query("SELECT * FROM `ACCOUNT` WHERE `userID` = '$id'");
	if($result){
		while($row = $result->fetch_object()){
			$userID   = htmlspecialchars($row->userID);
			$userPass = htmlspecialchars($row->userPass);
			$userName = htmlspecialchars($row->userName);
			echo("$userID | $userPass | $userName <br>");	//�f�o�b�O
		}
		if($userPass == $pass){
			echo("<br>���O�C�������I�I����ɂ��� $userName ����I");
		} else {
			$text = '�߂�';
			echo("ID���p�X���[�h���Ԉ���Ă��܂��B");
			echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $text . "</a>";
		}
	}
	else {
		echo("ID���p�X���[�h���Ԉ���Ă��܂��B");
		echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $text . "</a>";
	}

	$db->close();
?>

</body>
</html>
