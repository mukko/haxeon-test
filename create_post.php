<?php
  session_start();
  $_SESSION['projectName'] = $_POST['projectName'];
  header('location: try-haxe/index.html');
  exit();
?>
