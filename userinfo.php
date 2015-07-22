<?php

session_start();
if(!isset($_SESSION['userID']))
{
	echo '{ "error":"not login"}';
	exit;
}

if(!isset($_SESSION['projectName']))
{
	echo '{"userID":"'.$_SESSION['userID'].'","projectName":""}';
	exit;
}

echo '{"userID":"'.$_SESSION['userID'].'","projectName":"'.$_SESSION['projectName'].'"}';
