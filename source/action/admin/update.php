<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
include '../../core.php';
if(!file_put_contents("update.zip", fopen("https://client.dritestudio.in.th/product/webshop/update.zip", 'r')))
{
    @unlink('update.zip');
    die('file');
}
$zip = new ZipArchive;
if ($zip->open('update.zip') === TRUE)
{
    $zip->extractTo('../../');
    $zip->close();
	include '../../update.php';
	$KiznickAPI->EditConfig('version', file_get_contents('https://client.dritestudio.in.th/product/webshop/version.php'), $pdo);
    @unlink("update.zip");
    die('success');
}
else
    die('zip');
?>