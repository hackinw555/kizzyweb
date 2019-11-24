<?php
error_reporting(0);
	if($_POST['username'] == '')
		die('username');
	if($_POST['TransactionID'] == '' || !is_numeric($_POST['TransactionID']) || strlen($_POST['TransactionID']) != 14)
		die('TransactionID');
	include '../../config.php';
	$x = $pdo->prepare("SELECT `value` FROM `config` WHERE `name` = 'twx'");
	$x->execute();
	$twx = $x->fetch(PDO::FETCH_ASSOC)['value'];

	$wallet_key = $pdo->prepare("SELECT `value` FROM `config` WHERE `name` = 'tw_key'");
	$wallet_key->execute();
	$wallet_key = $wallet_key->fetch(PDO::FETCH_ASSOC)['value'];

	if (isset($wallet_key)) {
		if (empty( $wallet_key ) || $wallet_key  == '') {
			$wallet_phone = "กรุณาติดต่อแอดมิน #UPDATE";
		} else {
					$wallet_key = base64_decode($wallet_key);
					$wallet_key = json_decode($wallet_key, true);
				if(isset($wallet_key['data']['mobile_number'])) {
			$wallet_phone = $wallet_key['data']['mobile_number'];
			$wallet_email = $wallet_key['credentials']['username'];
			$wallet_password = $wallet_key['credentials']['password'];
			$wallet_ref = $wallet_key['reference_token'];
			$wallet_device = $wallet_key['device_id'];
			$wallet_mobile = $wallet_key['mobile_tracking'];
				}else {
					$wallet_phone = "รูปแบบ Key ไม่ถูกต้อง กรุณาลองใหม่";
				}
		}
	} else {
		$wallet_phone = "กรุณาใส่ Key เพื่อใช้งาน Wallet #Wallet";
	}
	$query = $pdo->prepare("SELECT id FROM authme WHERE username = ?");
	$query->execute(array($_POST['username']));
	$user = $query->fetch(PDO::FETCH_ASSOC)['id'];
	if($user == '')
		die('username');
	$query = $pdo->prepare("SELECT id FROM topup WHERE transaction_id = ? and type = 2");
	$query->execute(array($_POST['TransactionID']));
	$used = $query->fetch(PDO::FETCH_ASSOC)['id'];
	if($used != '')
		die('used');
	if(!isset($wallet_phone))
		die('config');
	include '../../api/Truewallet.php';
	$tw = new TrueWallet($wallet_email, $wallet_password, $wallet_ref);
	$tw->device_id = $wallet_device;
	$tw->mobile_tracking = $wallet_mobile;
	$login = $tw->Login();
	if($login['code'] == 40009)
		die('truewallet');
	$transactions = $tw->getTransaction(5)["data"]["activities"];
	foreach($transactions as $reports) {
		if($reports['original_action'] == 'creditor') {
			$txData = $tw->GetTransactionReport($reports['report_id']);
			$tx['id'] = $txData['data']['section4']['column2']['cell1']['value'];
			$tx['message'] = $txData['data']['personal_message']['value'];
			$tx['fee'] = $txData['data']['section3']['column2']['cell1']['value'];
			$tx['date'] = $txData['data']['section4']['column1']['cell1']['value'];
			$tx['sender']['name'] = $txData['data']['section2']['column1']['cell2']['value'];
			$tx['sender']['phone'] = $txData['data']['ref1'];
			$tx['amount'] = $txData['data']['section3']['column1']['cell1']['value'];
			$tx['amount'] = str_replace(',', '', $tx['amount']);
			if($tx['id'] == $_POST['TransactionID'])
			{
				$got = $tx['amount'] * $twx;
				$topup = $pdo->prepare("INSERT INTO topup (`ref`, `transaction_id`, `amount`, `got`, `type`, `time`, `updatetime`, `user`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$topup->execute(array($tx['sender']['phone'], $_POST['TransactionID'], $tx['amount'], $got, 2, time(), time(), $user, 1));
				$update = $pdo->prepare("UPDATE `authme` SET `point` = point + ? WHERE `authme`.`id` = ?");
				$update->execute(array($got, $user));
				die("success|{$got}");
			}
		}
	}
	die('404');
?>
