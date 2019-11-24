<?php
error_reporting(0);
session_start();
if($_SESSION['id'] == '')
	die('login');
include '../config.php';
$query = $pdo->prepare("SELECT `checkin`, `checkindate` FROM `authme` WHERE `id` = ?");
$query->execute(array($_SESSION['id']));
$data = $query->fetch(PDO::FETCH_ASSOC);
if($data['checkindate'] == date("d-m-Y"))
	die('date');
$update = $pdo->prepare("UPDATE authme SET `checkin` = ?, `checkindate` = ? WHERE id = ?");
if(!$update->execute(array($data['checkin'] + 1, date("d-m-Y"), $_SESSION['id'])))
	die('error');
die('success')
?>