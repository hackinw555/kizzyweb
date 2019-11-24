<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['id'] == '' || $_POST['point'] == '' || $_POST['isadmin'] == '')
	die('parameter');
include '../../config.php';
$product = $pdo->prepare("UPDATE authme SET username = ?, point = ?, isadmin = ? WHERE id = ?");
$query = $product->execute(array($_POST['username'], $_POST['point'], $_POST['isadmin'], $_POST['id']));
die('success');
?>