<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['server'] == '')
	die('parameter');
include '../../config.php';
$server = $pdo->prepare("DELETE FROM `product` WHERE `server` = ?");
$query = $server->execute(array($_POST['server']));
if(!$query)
	die('error');
$server = $pdo->prepare("DELETE FROM `checkin` WHERE `server` = ?");
$query = $server->execute(array($_POST['server']));
if(!$query)
	die('error');
$server = $pdo->prepare("DELETE FROM `server` WHERE `id` = ?");
$query = $server->execute(array($_POST['server']));
if(!$query)
	die('error');
die('success');
?>