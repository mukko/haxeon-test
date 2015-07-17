<?php
  session_start();

  //データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

  $result = $db->query('SELECT * FROM `project` WHERE `ownerUserID` = "'.$_SESSION['userID'].'" AND `projectName` = "'.$_POST['projectName'].'"');
  if($result->num_rows == 0){
    $_SESSION['projectName'] = $_POST['projectName'];
    header('location: try-haxe/index.html');
    exit();
  }else{
    header('location: create_form.php');
    exit();
}
?>
