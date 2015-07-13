<?php

session_start();
if(!isset($_SESSION['userID']))
{
	echo '{ "error":"access denied"}';
	exit;
}
echo '{ "userID":"' . $_SESSION['userID'] . '"}';
