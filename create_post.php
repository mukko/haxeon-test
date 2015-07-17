<?php
  require_once("common.php");

  //スマーティを使用
  require_once('Smarty.class.php');
  $smarty = new Smarty();

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

  $result = $db->query('SELECT * FROM `project` WHERE `ownerUserID` = "'.$_SESSION['userID'].'" AND `projectName` = "'.$_POST['projectName'].'"');
  if($result->num_rows == 0){
    $_SESSION['projectName'] = $_POST['projectName'];
    $smarty->assign('isLogin', true);
    $smarty->assign('projectName', $_SESSION['projectName']);
    header("refresh:2; try-haxe/index.html");
  }else{
    $smarty->assign('isLogin', false);
    $smarty->assign('preLink', $_SERVER['HTTP_REFERER']);
}

	$db->close();
  $smarty->display('create_post.tpl');
?>
