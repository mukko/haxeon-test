<?php
  include("common.php");

  require_once('Smarty.class.php');
  $smarty = new Smarty();

  //ユーザー情報を取得
  //$uid = $_SESSION['userID'];
  $uid;
  if(isset($_GET['id'])){
    $uid = $_GET['id'];
  }
  $smarty->assign('uid', $_SESSION['userID']);

  $result = $db->query("SELECT * FROM `account` WHERE userID = \"".$uid."\"");
  if($result){
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

  //プロジェクト情報を取得
  $result = $db->query("SELECT * FROM `project` WHERE `ownerUserID` = \"".$uid."\"");
  $array = [];
  if($result){
    while($row = $result->fetch_object()){
      $projectID = htmlspecialchars($row->projectID);
      $projectName = htmlspecialchars($row->projectName);
      $pv = htmlspecialchars($row->pv);
      $url = htmlspecialchars($row->url);

      array_push($array,array(
        'id' => $projectID,
        'name' => $projectName,
        'pv' => $pv,
        'url' => $url,
      ));
    }
  }
    $smarty->assign('projects', $array);

    //フォロー情報
    $followID = $uid;
    $result = $db->query("SELECT userFollowingID FROM follow WHERE userID = \"".$_SESSION['userID']."\" ");
    $id = "";
    $isFollow = false;
    if($result){
      while($row = $result->fetch_object()){
        $id = htmlspecialchars($row->userFollowingID);
        if($id == $followID) {
          $isFollow = true;
          break;
        }
        $isFollow = false;
      }
    }
    $smarty->assign('isFollow', $isFollow);

    $db->close();
    $smarty->display('profile.tpl');
  }
