<?php
/**
 * タグの入力フォームに記載された情報をデータベースに登録する
 */
require_once("common.php");
//タグ上限数
define("TAG_LIMIT", 3);

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

//タグをデータベースに登録する処理
$pid = $_GET['pid'];
$result = $db->query("SELECT * FROM tagmap WHERE projectID = \"".$pid."\"");
$count;
if(empty($result->num_rows)) {
    $count = null;
}else{
    $count = $result->num_rows;
}

//タグ数チェック
if($count < TAG_LIMIT || $count == null) {
    $tag_name = $_POST['tagName'];
    $tag_id;
    if(exists($db, "tag", "tag", $tag_name)){
        //タグがすでにある場合はタグテーブルからidを取得し、mapにprojectIDとtagIDをtagmapに登録
        $result = $db->query("SELECT id FROM tag WHERE tag = \"".$tag_name."\"");
        if($result){
            $row = $result->fetch_object();
            $tag_id = (int)($row->id);
        }
    }else{
        //タグがない場合、タグテーブルにタグを登録し、そのidをtagmapに登録
        $db->query("INSERT INTO tag(tag) VALUES (\"".$tag_name."\")");
        $result = $db->query("SELECT id FROM tag WHERE tag = \"".$tag_name."\"");
        if($result){
            $row = $result->fetch_object();
            $tag_id = (int)($row->id);
        }
    }

    if(!exists($db, "tagmap", "tagID", $tag_id)){
        $re = $db->query("INSERT INTO tagmap(projectID, tagID) VALUES ('$pid', '$tag_id')");
        if(!$re) {
            echo("miss");
        }
        $smarty->assign('isTagNum', true);
    }else{
        $smarty->assign('isTagNum', false);
    }
}else{
    $smarty->assign('isTagNum', false);
}

//自動でページを更新する
header("refresh:3; http://localhost/haxeon/projectSettings.php?pid=$pid");
$db->close();
$smarty->display('tag_post.tpl');


//テーブルに$tagNameのタグが存在するかどうかをチェックする
/*
 * @return true
 */
function exists($db, $table, $colum, $tagname){
    $result = $db->query("SELECT * FROM $table WHERE $colum = \"".$tagname."\"");
    if(!$result){
        echo("miss");
    }
    //エラーの確認
    if(mysql_errno()){
        exit('エラー : '.mysql_error());
    }

    //レコードの有無を確認
    $count;
    if(empty($result->num_rows)) {
        $count = null;
    }else{
        $count = $result->num_rows;
    }

    if($count == null){
        //なし
        return false;
    }else{
        //あり
        return true;
    }
}
