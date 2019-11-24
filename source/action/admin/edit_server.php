<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['server'] == '' || $_POST['name'] == '' || $_POST['ip'] == '' || $_POST['query'] == '' || $_POST['rport'] == '' || $_POST['rpass'] == '')
	die('parameter');
include '../../config.php';
$product = $pdo->prepare("UPDATE server SET name = ?, ip = ?, qport = ?, rport = ?, rspass = ? WHERE id = ?");
$query = $product->execute(array($_POST['name'], $_POST['ip'], $_POST['query'], $_POST['rport'], $_POST['rpass'], $_POST['server']));
die('success');
?>