<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['name'] == '' || $_POST['ip'] == '' || $_POST['query'] == '' || $_POST['rport'] == '' || $_POST['rpass'] == '')
	die('parameter');
include '../../config.php';
$create = $pdo->prepare("INSERT INTO `server` (`name`, `ip`, `rport`, `rpass`, `qport`) VALUES (?, ?, ?, ?, ?)");
$query = $create->execute(array($_POST['name'], $_POST['ip'], $_POST['rport'], $_POST['rpass'], $_POST['query']));
if(!$query)
	die('error');
die('success');
?>