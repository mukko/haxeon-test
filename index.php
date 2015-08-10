<?php
	include("common.php");

	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	$days = "1day";
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
	
	//ホットコードを表示
	$result = $db->query("
		SELECT * FROM project 
		WHERE project.modified BETWEEN '2015-08-05' AND '2015-08-06'
		ORDER BY project.pv 
		DESC LIMIT 30");
		
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
