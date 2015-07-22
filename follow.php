<?php
$before = $_SERVER['HTTP_REFERER'];
if(isset($before)){
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
session_start();

$followid = $_GET['id'];

$myid = $_SESSION['userID'];

$result = $db->query("SELECT userFollowingID FROM follow WHERE userID = \"".$myid."\" ");
$id = "";
if($result){
  while($row = $result->fetch_object()){
    $id = htmlspecialchars($row->userFollowingID);
    if($id == $followid) {
      header("Location: ".$before."");
      exit();
    }
  }
}

$result = $db->query("INSERT INTO follow(userID, userFollowingID) VALUES (\"".$myid."\",\"".$followid."\")");

header("Location: ".$before."");
}
