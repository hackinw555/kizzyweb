<?php
error_reporting(0);
if($_POST['oldpass'] == '' && $_POST['newpass'] == '')
	die('Parameter');
session_start();
if($_SESSION['id'] == '')
	die('Login');
include '../config.php';
$query = $pdo->prepare("SELECT `password` FROM `authme` WHERE `id` = ?");
$query->execute(array($_SESSION['id']));
$data = $query->fetch(PDO::FETCH_ASSOC);
$salt = explode('$', $data['password']);
$salt = $salt[2];
$hash = '$SHA$'.$salt.'$'.hash('sha256', hash('sha256', $_POST['oldpass']).$salt);
if($data['password'] != $hash)
	die('Password');
$hash = '$SHA$'.$salt.'$'.hash('sha256', hash('sha256', $_POST['newpass']).$salt);
$update = $pdo->prepare("UPDATE authme SET `password` = ? WHERE id = ?");
if(!$update->execute(array($hash, $_SESSION['id'])))
	die('Error');
die('Success');
?>