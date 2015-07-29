<?php
	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

	$i = 0;
	while ($i < 10000) {
		$proID = makeRandStr();
		$proName = "project".makeRandStr();
		$userID = "user".$i;
		$pv = mt_rand();
		$proURL = "localhost/haxeon/try-haxe/tmp/".makeRandStr();
		
		//データベースにアカウントを登録
		$result = $db->query("INSERT INTO `haxeon`.`project` (`projectID`, `projectName`, `ownerUserID` ,`pv`,`url`) 
			VALUES ( '$proID', '$proName', '$userID' , $pv , '$proURL');");
		$i++;
		echo $i."</br>";
	}
	
	$db->close();
	
	
/**
 * ランダム文字列生成 (英数字)
 * $length: 生成する文字数
 */
function makeRandStr($length = 8) {
    static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for ($i = 0; $i < $length; ++$i) {
        $str .= $chars[mt_rand(0, 61)];
    }
    return $str;
}