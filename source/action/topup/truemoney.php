<?php
error_reporting(0);
	if($_POST['username'] == '')
		die('username');
	if($_POST['card'] == '' || !is_numeric($_POST['card']) || strlen($_POST['card']) != 14)
		die('card');
	include '../../config.php';
	$query = $pdo->prepare("SELECT id FROM authme WHERE username = ?");
	$query->execute(array($_POST['username']));
	$user = $query->fetch(PDO::FETCH_ASSOC)['id'];
	if($user == '')
		die('username');
	$query = $pdo->prepare("SELECT id FROM topup WHERE ref = ? and status = 0 and type = 1");
	$query->execute(array($_POST['card']));
	$used = $query->fetch(PDO::FETCH_ASSOC)['id'];
	if($used != '')
		die('used');
	function config($pdo, $name)
	{
		if($name  == '')
			return 'Parameter error';
		$query = $pdo->prepare("SELECT `value` FROM `config` WHERE `name` = ?");
		$query->execute(array($name));
		$value = $query->fetch(PDO::FETCH_ASSOC)['value'];
		if($value == '')
			die('config');
		return $value;
	}
	$topuptype = config($pdo, 'tm_type');
	if($topuptype == 1)
	{
		$merchant = config($pdo, 'merchant');
		include '../../api/Tmpay.php';
		$tmpay = new tmpay();
		$tmpay_send = $tmpay->tmpay_sender($_POST['card'], $merchant, $url['base_url']);
		if($tmpay_send == 'password')
			die('card');
		else if($tmpay_send == 'process')
			die('process');
		else if($tmpay_send == 'merchant')
			die('merchant');
		else if(strpos($tmpay_send,'SUCCEED') !== FALSE)
			$transaction_id = substr($tmpay_send, 8, 18);
		else
			die('error');
		$topup = $pdo->prepare("INSERT INTO topup (`ref`, `transaction_id`, `type`, `time`, `updatetime`, `user`) VALUES (?, ?, ?, ?, ?, ?)");
		$query = $topup->execute(array($_POST['card'], $transaction_id, 1, time(), time(), $user));
		if($query)
			die('success');
		else
			die('error');
	}
	else if($topuptype == 2)
	{
		$config = [
			'tw_tel' => config($pdo, 'tw_tel'),
			'tw_password' => config($pdo, 'tw_password'),
			'tw_token' => config($pdo, 'tw_token')
		];
		include '../../api/Truewallet.php';
		$tw = new TrueWallet($config['tw_tel'], $config['tw_password'], $config['tw_token']);
		var_dump($tw->Login());
		echo '<br><br>';
		var_dump($tw->TopupCashcard());
		
	}
	else
		die('error');
?>