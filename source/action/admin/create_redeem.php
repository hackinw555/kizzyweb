<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['command'] == '' || $_POST['used'] == '' || $_POST['server'] == '')
	die('parameter');
if($_POST['redeem'] == '')
{
	function GenRedeem($length = 32) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$redeem = GenRedeem(32);
}
else
	$redeem = $_POST['redeem'];
include '../../config.php';
$query = $pdo->prepare("SELECT `redeem` FROM `redeem` WHERE `redeem` = ?");
$query->execute(array($redeem));
$data = $query->fetch(PDO::FETCH_ASSOC)['redeem'];
if($data == $redeem)
    die('use');
$qredeem = $pdo->prepare("INSERT INTO `redeem` (`redeem`, `command`, `max`, `server`) VALUES (?, ?, ?, ?)");
$query = $qredeem->execute(array($redeem, $_POST['command'], $_POST['used'], $_POST['server']));
if(!$query)
	die('error');
die('success');
?>