<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['title'] == '' || $_POST['logo'] == '' || $_POST['background'] == '' || $_POST['ip'] == '')
	die('parameter');
include '../../config.php';
$KiznickAPI->EditConfig('title', $_POST['title'], $pdo);
$KiznickAPI->EditConfig('logo', $_POST['logo'], $pdo);
$KiznickAPI->EditConfig('background', $_POST['background'], $pdo);
$KiznickAPI->EditConfig('ip', $_POST['ip'], $pdo);
die('success');
?>