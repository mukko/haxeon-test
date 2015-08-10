<?php
	include("common.php");

	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	$days = "day";
	$order = "pv";
	$page = 1;
	
	if (isset($_GET['days'])) {
		$days = $_GET['days'];
	}
	if (isset($_GET['order'])) {
		$order = $_GET['order'];
	}
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	
	//検索日時の取得
	$beginDate = date("Y-m-d H:i:s",strtotime("-1 days"));
	$endDate = date("Y-m-d H:i:s");
	switch($days) {
		case "day":  $beginDate = date("Y-m-d H:i:s",strtotime("-1 days"));
		case "week": $beginDate = date("Y-m-d H:i:s",strtotime("-7 days"));
		case "all":  $beginDate = date("Y-m-d H:i:s",strtotime("-365 days"));
		default :    $beginDate = date("Y-m-d H:i:s",strtotime("-1 days"));
	}
	
	//ランキングページ数
	$end = $page * 30;
	$top = $end  - 30;
	$smarty->assign('top', $top);
	
	//要素数をカウント
	$result = $db->query("SELECT COUNT(*) as cnt FROM project WHERE project.modified BETWEEN '$beginDate' AND '$endDate'");
	$cnt = $result->fetch_object()->cnt;
	
	//ホットコードを表示
	$result = $db->query("
		SELECT * FROM project 
		WHERE project.modified BETWEEN '$beginDate' AND '$endDate' 
		ORDER BY project.$order 
		DESC LIMIT $top,$end");
		
	if($result){
		$i = 0;
		$array = [];

		while($row = $result->fetch_object()){
			$proID = htmlspecialchars($row->projectID);
			$proName = htmlspecialchars($row->projectName);
			$userID = htmlspecialchars($row->ownerUserID);
			$pv = htmlspecialchars($row->pv);
			$url = htmlspecialchars($row->url);
			
			$obj = array(
				'proID' => $proID,
				'proName' => $proName,
				'userID' => $userID,
				'pv' => $pv,
				'url' => $url,
			);
			array_push($array, $obj);
			$i++;
		}
		$smarty->assign('var', $array);
		$smarty->assign('proNum', $i);
	}

	$db->close();

	$smarty->display('index.tpl');
