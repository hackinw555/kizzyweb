<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['id'] == '' || $_POST['image'] == '' || $_POST['name'] == '' || $_POST['command'] == '' || $_POST['price'] == '')
	die('parameter');
include '../../config.php';
$product = $pdo->prepare("UPDATE checkin SET image = ?, name = ?, command = ?, price = ? WHERE id = ?");
$query = $product->execute(array($_POST['image'], $_POST['name'], $_POST['command'], $_POST['price'], $_POST['id']));
die('success');
?>