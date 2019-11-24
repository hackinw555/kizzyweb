<?php
error_reporting(0);
$amount = array("0.00", "20.00", "50.00", "90.00", "150.00", "300.00", "500.00", "1000.00");
if($_GET['transaction_id'] == '' || strlen($_GET['transaction_id']) != 10 || $_GET['password'] == '' || !is_numeric($_GET['password']) || strlen($_GET['password']) != 14 || $_GET['real_amount'] == '' || !in_array($_GET['real_amount'], $amount) || $_GET['status'] == '' || !is_numeric($_GET['status']) || $_GET['status'] <= 0 || $_GET['status'] >= 6)
	die('Parameter Error.');
include '../../config.php';
$x = $pdo->prepare("SELECT `value` FROM `config` WHERE `name` = 'tmx'");
$x->execute();
$tmx = $x->fetch(PDO::FETCH_ASSOC)['value'];
$got = $_GET['real_amount'] * $tmx;
$topup = $pdo->prepare("UPDATE topup SET amount = ?, got = ?, updatetime = ?, status = ? WHERE ref = ? and transaction_id = ? and status = 0 and type = 1");
$query = $topup->execute(array($_GET['real_amount'], $got, time(), $_GET['status'], $_GET['password'], $_GET['transaction_id']));
if(!$query)
	die('Error');
$qtopup = $pdo->prepare("SELECT user, amount, got FROM topup WHERE ref = ? and transaction_id = ? and status = ? and type = 1");
$qtopup->execute(array($_GET['password'], $_GET['transaction_id'], $_GET['status']));
$topup = $qtopup->fetch(PDO::FETCH_ASSOC);
$quser = $pdo->prepare("SELECT point, donate FROM authme WHERE id = ?");
$quser->execute(array($topup['user']));
$user = $quser->fetch(PDO::FETCH_ASSOC);
$point = $user['point'] + $topup['got'];
$donate = $user['donate'] + $topup['amount'];
$updateuser = $pdo->prepare("UPDATE authme SET point = ?, donate = ? WHERE id = ?");
$query = $updateuser->execute(array($point, $donate, $topup['user']));
if($query)
	die('Success');
else
	die('Error');
?>