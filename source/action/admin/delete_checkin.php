<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['id'] == '')
	die('parameter');
include '../../config.php';
$create = $pdo->prepare("DELETE FROM `checkin` WHERE `id` = ?");
$query = $create->execute(array($_POST['id']));
if(!$query)
	die('error');
die('success');
?>