<?php
error_reporting(0);
if($_POST['username'] == '' && $_POST['password'] == '')
	die('Parameter');
if(!(preg_match('/^[a-zA-Z0-9_\s]+$/', $_POST['username'])))
	die('Username');
session_start();
if($_SESSION['id'] != '')
	die('Login');
include '../config.php';
$query = $pdo->prepare("SELECT `username` FROM `authme` WHERE `username` = ?");
$query->execute(array($_POST['username']));
$data = $query->fetch(PDO::FETCH_ASSOC)['username'];
if($data != '')
    die('Use');
function salt($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$salt = salt(16);
$hash = '$SHA$'.$salt.'$'.hash('sha256', hash('sha256', $_POST['password']).$salt);
$register = $pdo->prepare("INSERT INTO `authme` (`username`, `realname`, `password`, `regdate`, `regip`) VALUES (?, ?, ?, ?, ?)");
$rquery = $register->execute(array($_POST['username'], $_POST['username'], $hash, round(microtime(true)*1000), $_SERVER['REMOTE_ADDR']));
if(!$rquery)
    die('Error');
die('Success');
?>