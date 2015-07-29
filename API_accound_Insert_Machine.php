<?php
	//データベース接続処理
	$dbName = 'haxeon';
	$user = 'root';
	$password = 'DELL';
	$db = new mysqli('localhost', $user , $password, $dbName) or die("error");

	$i = 0;
	while ($i < 10000) {
		$id = "user".$i;
		$pass = makeRandStr();
		$iconPass = "http://localhost/haxeon/img/icon/empty_thumbnail.png";
		$mail = "delldell201507@gmail.com";
		$hash = "";
		
		//データベースにアカウントを登録
		$result = $db->query("INSERT INTO `haxeon`.`account` (`userID`, `userPass`, `userName` ,`userIcon`,`userMail`, `isEnable`, `MD5`) 
			VALUES ( '$id', '$pass', '$id' ,'$iconPass' , '$mail' , 0 , '$hash');");
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