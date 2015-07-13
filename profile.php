<?php
  include("common.php");

  require_once('Smarty.class.php');
  $smarty = new Smarty();

  //ユーザー情報を取得
  $uid = $_SESSION['userID'];
  $result = $db->query("SELECT * FROM `account` WHERE userID = \"".$uid."\"");
  if($result){
    $infomation = [];
    while($row = $result->fetch_object()){
      $userID = htmlspecialchars($row->userID);
      $userName = htmlspecialchars($row->userName);
      $userIcon = htmlspecialchars($row->userIcon);
      $userProfile = htmlspecialchars($row->userProfile);
      $userURL = htmlspecialchars($row->userURL);
      $userMail = htmlspecialchars($row->userMail);

      $smarty->assign('userID', $userID);
      $smarty->assign('userName', $userName);
      $smarty->assign('userIcon', $userIcon);
      $smarty->assign('userProfile', $userProfile);
      $smarty->assign('userURL', $userURL);
      $smarty->assign('userMail', $userMail);
    }

    $db->close();
    $smarty->display('profile.tpl');
  }
