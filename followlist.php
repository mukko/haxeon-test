<?php
include("common.php");

require_once('Smarty.class.php');
$smarty = new Smarty();

$smarty->assign('commonURL', 'http://localhost/haxeon/');

//DBへの接続処理
$dbName 	= 'haxeon';
$user		= 'root';
$password 	= 'DELL';

$db = new mysqli('localhost', $user ,$password, $dbName) or die("error");
if ($db->connect_error){
  print("connection error" . $db->connect_error . "<br>");
  exit();
}

//$id 自分のid
$id = $_SESSION['userID'];
$length = 0;
$array = [];

$result = $db->query("SELECT * FROM follow WHERE userID = \"".$id."\"");
if($result){
  while($row=$result->fetch_object()){
    $fID = htmlspecialchars($row->userFollowingID);

    $res = $db->query("SELECT * FROM account WHERE userID = \"".$fID."\"");
    $userID;
    $userName;
    $userIcon;

    if($res){
      while($row=$res->fetch_object()){
        $userID = htmlspecialchars($row->userID);
        $userName = htmlspecialchars($row->userName);
        $userIcon = htmlspecialchars($row->userIcon);
        array_push($array,array(
          'id' => $fID,
          'name' => $userName,
          'icon' => $userIcon,
        ));
      }
    }
    $length++;
  }
  $smarty->assign('length', $length);
  $smarty->assign('followers', $array);
  $db->close();
  $smarty->display('followlist.tpl');
}
