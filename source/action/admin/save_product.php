<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['id'] == '' || $_POST['image'] == '' || $_POST['name'] == '' || $_POST['command'] == '' || $_POST['price'] == '' || $_POST['pad'] == '' || $_POST['ispad'] == '')
	die('parameter');
if($_POST['ispad'] == "true")
	$ispad = 1;
else
	$ispad = 0;
include '../../config.php';
$product = $pdo->prepare("UPDATE product SET image = ?, name = ?, command = ?, price = ?, pad = ?, ispad = ? WHERE id = ?");
$query = $product->execute(array($_POST['image'], $_POST['name'], $_POST['command'], $_POST['price'], $_POST['pad'], $ispad, $_POST['id']));
die('success');
?>