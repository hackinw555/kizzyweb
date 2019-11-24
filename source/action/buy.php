<?php
error_reporting(0);
if($_POST['id'] == '' || !is_numeric($_POST['id']))
   die('Product');
include '../config.php';
session_start();
if($_SESSION['id'] == '')
   die('Login');
// Product
$query = $pdo->prepare("SELECT command, price, pad, ispad, server FROM product WHERE id = ?");
$query->execute(array($_POST['id']));
$product = $query->fetch(PDO::FETCH_ASSOC);
if($product['price'] == '')
	die('Product');
if($product['ispad'] == 1)
	$Price = $product['pad'];
else
	$Price = $product['price'];
// Server
$query = $pdo->prepare("SELECT ip, rport, rpass, qport FROM server WHERE id = ?");
$query->execute(array($product['server']));
$server = $query->fetch(PDO::FETCH_ASSOC);
if($server['ip'] == '')
	die('Server');
// User
$query = $pdo->prepare("SELECT username, point, isLogged FROM authme WHERE id = ?");
$query->execute(array($_SESSION['id']));
$user = $query->fetch(PDO::FETCH_ASSOC);
if(!($user['point'] >= $Price))
	die('Point');
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
	if($Price != 0)
	{
		$_SESSION['point'] = $user['point'] - $Price;
		$update = $pdo->prepare("UPDATE authme SET point = ? WHERE id = ?");
		if(!$update->execute(array($_SESSION['point'], $_SESSION['id'])))
		{
			$rcon->disconnect();
			die('Error');
		}
	}
	$command = str_replace('<player>', $user['username'], $product['command']);
	$command = explode(",", $command);
	for($i = 0; $i <= count($command) - 1; $i++)
		$rcon->sendCommand($command[$i]);
	echo $_SESSION['point'];
}
else
	echo 'Server';
$rcon->disconnect();
?>