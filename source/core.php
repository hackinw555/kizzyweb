<?php
// ห้ามแก้ไข
include 'config.php';
session_start();
if($_GET['page'] != '')
{
	$page = array('home', 'shop', 'topup', 'login');
	$ncheck = array('login');
	if($_SESSION['isadmin'] == 1)
		array_push($page, 'admin-dashboard', 'admin-slide', 'admin-player', 'admin-server', 'admin-shop', 'admin-product', 'admin-editproduct', 'admin-createproductui', 'admin-serverinfo', 'admin-topup', 'admin-redeem', 'admin-checkin', 'admin-createcheckin', 'admin-editcheckin', 'admin-update', 'admin-news');
	if($_SESSION['id'] != '')
		array_push($page, 'history', 'redeem', 'checkin', 'truewallet', 'gift');
	if(in_array($_GET['page'], $page))
		include './include/'.$_GET['page'].'.php';
	else
		include './include/home.php';
	if(!in_array($_GET['page'], $ncheck))
		echo '<script>checklogin(\''.$_SESSION['username'].'\');</script>';
	die;
}
if($_GET['shop'] != '' && is_numeric($_GET['shop']))
{
	include './include/product.php';
	die('<script>swal.close();</script>');
}
function config($pdo, $name)
{
	if($name  == '')
		return 'Parameter error';
	$query = $pdo->prepare("SELECT `value` FROM `config` WHERE `name` = ?");
    $query->execute(array($name));
	return $query->fetch(PDO::FETCH_ASSOC)['value'];
}
$config = [
	'title' => config($pdo, 'title'),
	'logo' => config($pdo, 'logo'),
	'background' => config($pdo, 'background')
];
?>
