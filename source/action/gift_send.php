<?php
error_reporting(0);
session_start();
if($_SESSION['id'] == '')
   die('Login');
if($_POST['reciver'] == '' || $_POST['id'] == '')
	die('Parameter');
include '../config.php';
// Reciver
$query = $pdo->prepare("SELECT id FROM authme WHERE username = ?");
$query->execute(array($_POST['reciver']));
$reciver = $query->fetch(PDO::FETCH_ASSOC)['id'];
if($reciver == '')
	die('Reciver');
//Product
$query = $pdo->prepare("SELECT id, name, image, price, pad, ispad FROM product WHERE id = ?");
$query->execute(array($_POST['id']));
$product = $query->fetch(PDO::FETCH_ASSOC);
if($product['id'] == '')
	die('Product');
if($product['ispad'] == 1)
	$Price = $product['pad'];
else
	$Price = $product['price'];
// User
$query = $pdo->prepare("SELECT username, point FROM authme WHERE id = ?");
$query->execute(array($_SESSION['id']));
$user = $query->fetch(PDO::FETCH_ASSOC);
if(!($user['point'] >= $Price))
	die('Point');
$expire = time()+(60*60*24*7); // 24 Hr
$sendgift = $pdo->prepare("INSERT INTO `gift` (`product`, `image`, `name`, `reciver`, `sender`, `date`, `expire`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$query = $sendgift->execute(array($product['id'], $product['image'], $product['name'], $reciver, $_SESSION['id'], time(), $expire));
if(!$query)
	die('Error');
$_SESSION['point'] = $user['point'] - $Price;
$update = $pdo->prepare("UPDATE authme SET point = ? WHERE id = ?");
if(!$update->execute(array($_SESSION['point'], $_SESSION['id'])))
	die('Error');
die($_SESSION['point']);
?>