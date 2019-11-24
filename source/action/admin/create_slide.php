<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['slideimage'] == '')
	die('parameter');
include '../../config.php';
$create = $pdo->prepare("INSERT INTO `slide` (`image`) VALUES (?)");
$query = $create->execute(array($_POST['slideimage']));
if(!$query)
	die('error');
die('success');
?>