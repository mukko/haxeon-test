<?php

class ConnectDB {
	private $db;	

	function __construct() {
		$dbName = 'haxeon';
		$user = 'root';
		$password = 'DELL';
	
		$this->db = new mysqli('localhost', $user , $password, $dbName) or die("error");
		
		if ($this->db->connect_error) {
			throw new Exception("データベースの接続に失敗しました。申し訳ございませんが、後ほどやり直して下さい。");
		}
	}
	
	function getDB() {
		return $this->db;
	}
}
