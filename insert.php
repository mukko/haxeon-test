<?php

//データベース接続処理
$dbName = 'haxeon';
$user = 'root';
$password = 'DELL';
$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

set_time_limit(120);

//データベースへの接続が失敗したらエラーを出力して終了
if ($db->connect_error){
  print("接続失敗：" . $db->connect_error . "<br>");
  exit();
}

//$req = $_POST["req"];
$req = 1;
if($req == 1){
  //テスト用にアカウントを作成(実質更新)する処理
  //16384行あるのでそれを更新する
  $i = 0;
  while($i < 10000){
    $userID = "user".$i;
    $userPass = "1234";
    $userName = "name".$i;
    $userIcon = "img/icon/empty_thumbnail.png";
    $userProfile = makeRandStr(10);
    $db->query("INSERT INTO `account`(`userID`, `userPass`, `userName`, `userIcon`, `userProfile`, `userURL`, `userMail`) VALUES ('$userID','$userPass','$userName','$userIcon','$userProfile','','')");
    $i++;
  }
}else{
  //同じくプロジェクトを作成する処理
  $i = 0;
  $pn = 0;
  while($i < 10000){

    $j = 0;
    while($j < 10){
      $projectID = makeRandStr(10);
      $projectName = 'project'.$pn;
      $ownerUserID = 'user'.$i;
      $pv = mt_rand(0,10000);
      $url = makeRandStr(20);
      $db->query("INSERT INTO `project`(`projectID`, `projectName`, `ownerUserID`, `pv`, `url`) VALUES ('$projectID','$projectName','$ownerUserID','$pv','$url')");
      $pn++;
      $j++;
    }
    $i++;
  }
}

$db->close();

/**
 * ランダム文字列生成 (英数字)
 * $length: 生成する文字数
 */
function makeRandStr($length) {
    static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for ($i = 0; $i < $length; ++$i) {
        $str .= $chars[mt_rand(0, 61)];
    }
    return $str;
}
