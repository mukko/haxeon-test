<?php

session_start();
if(!isset($_SESSION['userID']))
{
	echo '{ "error":"not login"}';
	exit;
}
echo '{ "userID":"' . $_SESSION['userID'] . '",
				"projectName":"' . $_SESSION['projectName'] . '"
}';
