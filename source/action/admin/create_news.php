<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['news'] == '')
	die('parameter');
include '../../config.php';
$qredeem = $pdo->prepare("INSERT INTO `news` (`text`, `time`) VALUES (?, ?)");
$query = $qredeem->execute(array($_POST['news'], time()));
if(!$query)
	die('error');
die('success');
?>