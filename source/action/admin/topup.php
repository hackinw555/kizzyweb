<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['merchant'] == '' || $_POST['topuptype'] == '')
	die('parameter');
include '../../config.php';
$KiznickAPI->EditConfig('topuptype', $_POST['topuptype'], $pdo);
$KiznickAPI->EditConfig('merchant', $_POST['merchant'], $pdo);
$KiznickAPI->EditConfig('tmx', $_POST['tmx'], $pdo);
die('success');
?>