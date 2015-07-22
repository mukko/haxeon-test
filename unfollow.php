<?php
//プロフィールページなどの特定のページ以外から直接呼ばれたときに動かないよう、対策をする必要がある
$before = $_SERVER['HTTP_REFERER'];
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

$result = $db->query("DELETE FROM `follow` WHERE `userID` = \"".$myid."\" AND `userFollowingID` =  \"".$followid."\"");

header("Location: ".$before."");
