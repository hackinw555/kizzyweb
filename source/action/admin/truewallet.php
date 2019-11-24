<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['tw_key'] == '' || $_POST['tw_tel'] == '')
	die('parameter');
include '../../config.php';
$KiznickAPI->EditConfig('tw_key', $_POST['tw_key'], $pdo);
$KiznickAPI->EditConfig('tw_tel', $_POST['tw_tel'], $pdo);
$KiznickAPI->EditConfig('twx', $_POST['twx'], $pdo);
die('success');
?>
