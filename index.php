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
			$proName = htmlspecialchars($row->projectName);
			$userID = htmlspecialchars($row->ownerUserID);
			$pv = htmlspecialchars($row->pv);
			$url = htmlspecialchars($row->url);

			//projectテーブルのuserIDをつかって、accountテーブルからuserNameを取得する
			$accountdata = $db->query("SELECT * FROM `ACCOUNT` WHERE userID = \"".$userID."\"");
			$userName;
			if($accountdata){
				$row = $accountdata->fetch_object();
				$userName = htmlspecialchars($row->userName);
			}

			$obj = array(
				'proID' => $proID,
				'proName' => $proName,
				'userID' => $userID,
				'userName' => $userName,
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
?>
