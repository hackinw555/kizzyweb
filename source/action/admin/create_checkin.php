<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['image'] == '' || $_POST['name'] == '' || $_POST['command'] == '' || $_POST['price'] == '' || $_POST['server'] == '')
	die('parameter');
include '../../config.php';
$product = $pdo->prepare("INSERT INTO checkin (image, name, command, price, server) VALUES (?, ?, ?, ?, ?)");
$query = $product->execute(array($_POST['image'], $_POST['name'], $_POST['command'], $_POST['price'], $_POST['server']));
if(!$query)
	die('error');
die('success');
?>