<?php
error_reporting(0);
if($_POST['redeem'] == '')
   die('Redeem');
session_start();
if($_SESSION['id'] == '')
   die('Login');
include '../config.php';
// Redeem
$query = $pdo->prepare("SELECT id, redeem, command, used, max, server FROM redeem WHERE redeem = ?");
$query->execute(array($_POST['redeem']));
$redeem = $query->fetch(PDO::FETCH_ASSOC);
if($redeem['redeem'] != $_POST['redeem'])
	die('Redeem');
if($redeem['used'] >= $redeem['max'])
	die('Limite');
// User
$query = $pdo->prepare("SELECT username, redeem, isLogged FROM authme WHERE id = ?");
$query->execute(array($_SESSION['id']));
$user = $query->fetch(PDO::FETCH_ASSOC);
if(in_array($redeem['id'], explode(',', $user['redeem'])))
	die('Used');
// Server
$query = $pdo->prepare("SELECT ip, rport, rpass, qport FROM server WHERE id = ?");
$query->execute(array($redeem['server']));
$server = $query->fetch(PDO::FETCH_ASSOC);
if($server['ip'] == '')
	die('Server');
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
	$update = $pdo->prepare("UPDATE authme SET redeem = ? WHERE id = ?");
	if(!$update->execute(array($user['redeem'].$redeem['id'].',', $_SESSION['id'])))
	{
		$rcon->disconnect();
		die('Error');
	}
	$update = $pdo->prepare("UPDATE redeem SET used = ? WHERE id = ?");
	if(!$update->execute(array($user['used'] + 1, $redeem['id'])))
	{
		$rcon->disconnect();
		die('Error');
	}
	$command = str_replace('<player>', $user['username'], $redeem['command']);
	$command = explode(",", $command);
	for($i = 0; $i <= count($command) - 1; $i++)
		$rcon->sendCommand($command[$i]);
	die('Success');
}
else
	echo 'Server';
$rcon->disconnect();
?>