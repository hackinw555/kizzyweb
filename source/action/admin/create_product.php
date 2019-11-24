<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['image'] == '' || $_POST['name'] == '' || $_POST['command'] == '' || $_POST['price'] == '' || $_POST['pad'] == '' || $_POST['ispad'] == '' || $_POST['server'] == '')
	die('parameter');
if($_POST['ispad'] == "true")
	$ispad = 1;
else
	$ispad = 0;
include '../../config.php';
$product = $pdo->prepare("INSERT INTO product (image, name, command, price, pad, ispad, server) VALUES (?, ?, ?, ?, ?, ?, ?)");
$query = $product->execute(array($_POST['image'], $_POST['name'], $_POST['command'], $_POST['price'], $_POST['pad'], $ispad, $_POST['server']));
if(!$query)
	die('error');
die('success');
?>