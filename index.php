<?php
	include("common.php");

	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	$num_project = 30;	//表示するプロジェクトの数
	
	$days = "day";
	$order = "pv";
	$page = 667;
	
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
	$smarty->assign('days', $days);
	
	//ランキングページ数
	$end = $page * $num_project;
	$top = $end  - $num_project;
	$smarty->assign('top', $top);
	
	//要素数をカウント
	$result = $db->query("SELECT COUNT(*) as cnt FROM project WHERE project.modified BETWEEN '$beginDate' AND '$endDate'");
	$cnt = $result->fetch_object()->cnt;
	
	//ページ数の保持
	$max_page = ceil($cnt / $num_project);
	$smarty->assign('page', $page);
	$smarty->assign('maxPage', $max_page);
	
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
