<?php
error_reporting(0);
if($_POST['id'] == '' || !is_numeric($_POST['id']))
   die('Gift');
include '../config.php';
session_start();
if($_SESSION['id'] == '')
   die('Login');
// Gift
$query = $pdo->prepare("SELECT product, expire FROM gift WHERE id = ? and reciver = ?");
$query->execute(array($_POST['id'], $_SESSION['id']));
$gift = $query->fetch(PDO::FETCH_ASSOC);
if($gift['product'] == '')
	die('Gift');
if($gift['expire'] <= time())
	die('Expire');
// Product
$query = $pdo->prepare("SELECT command, server FROM product WHERE id = ?");
$query->execute(array($gift['product']));
$product = $query->fetch(PDO::FETCH_ASSOC);
if($product['command'] == '')
	die('Product');
// Server
$query = $pdo->prepare("SELECT ip, rport, rpass, qport FROM server WHERE id = ?");
$query->execute(array($product['server']));
$server = $query->fetch(PDO::FETCH_ASSOC);
if($server['ip'] == '')
	die('Server');
// User
$query = $pdo->prepare("SELECT username, isLogged FROM authme WHERE id = ?");
$query->execute(array($_SESSION['id']));
$user = $query->fetch(PDO::FETCH_ASSOC);
// Query
include '../api/Query.php';
$Query = new MinecraftQuery( );
try
{
	$Query->Connect($server['ip'], $server['qport'], 5);
	$Player = array_map('strtolower', $Query->GetPlayers());
}
catch( MinecraftQueryException $e )
{
	if($e->getMessage() == 'Failed to receive challenge.')
		die('Server');
}
if(!in_array($user['username'], $Player))
	die('Online');
if($user['isLogged'] == 0)
	die('GLogin');
use Thedudeguy\Rcon;
include '../api/Rcon.php';
$rcon = new Rcon($server['ip'], $server['rport'], $server['rpass'], 5);
if($rcon->connect())
{
	$update = $pdo->prepare("DELETE FROM `gift` WHERE `id` = ? and `reciver` = ?");
	if(!$update->execute(array($_POST['id'], $_SESSION['id'])))
	{
		$rcon->disconnect();
		die('Error');
	}
	$command = str_replace('<player>', $user['username'], $product['command']);
	$command = explode(",", $command);
	for($i = 0; $i <= count($command) - 1; $i++)
		$rcon->sendCommand($command[$i]);
	echo 'Success';
}
else
	echo 'Server';
$rcon->disconnect();
?>