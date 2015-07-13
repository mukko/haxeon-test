<?php 
	include("common.php");
	
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	//ホットコードを表示
	$result = $db->query("SELECT * FROM `PROJECT` ORDER BY `PV` DESC");
	if($result){
		$i = 0;
		$array = [];
		
		while($row = $result->fetch_object()){
			$proID = htmlspecialchars($row->projectID);
			$userID = htmlspecialchars($row->ownerUserID);
			$pv = htmlspecialchars($row->pv);
			$url = htmlspecialchars($row->url);
			
			$obj = array(
				'proID' => $proID,
				'userID' => $userID,
				'pv' => $pv,
				'url' => $url,
			);
			array_push($array, $obj);
			
			//デバッグ用
			//echo "第 $i 位 <a href=$url > $proID   </a>";
			//echo("| $userID | $pv PV!!! <br> ");
			$i++;
		}
		$smarty->assign('var', $array);	
		$smarty->assign('proNum', $i);	
	}

	$db->close();
	
	$smarty->display('index.tpl');
?>