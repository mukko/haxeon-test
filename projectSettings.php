<?php
/**
 * プロジェクトの設定ページのつもり
 * タグ登録に関する処理をはじめにつくる
 */
include("common.php");

require_once('Smarty.class.php');
$smarty = new Smarty();

//プロジェクトIDを取得
$pid;

if(isset($_GET['pid'])){
    $uid = $_GET['pid'];
}else{
    exit();
}

//他人が設定変更できないよう、セッションIDとプロジェクト作成者の比較
if (isset($_SESSION['userID'])) {
    $sessionID = $_SESSION['userID'];
    $result = $db->query('SELECT ownerUserID FROM project WHERE projectID = $pid');
    if($result){
        $row = $result->fetch_object();
        $ownerUserID = htmlspecialchars($row);
        if($ownerUserID != $uid){
            exit();
        }
        exit();
    }
}else{
    exit();
}

//入力フォームの書いてあるテンプレートを呼び出す
$smarty->display('projectSettings.tpl');
