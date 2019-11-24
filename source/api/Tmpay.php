<?php
class tmpay {
		function tmpay_sender($truemoney_password, $merchant_id, $base)
		{
			if(function_exists('curl_init'))
			{
				$curl =
				curl_init('https://www.tmpay.net/TPG/backend.php?merchant_id='.$merchant_id.'&password=' . $truemoney_password . '&resp_url='.$base.'action/topup/tmpay_confirm');
	            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
				curl_setopt($curl, CURLOPT_HEADER, FALSE);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
				$curl_content = curl_exec($curl);
				curl_close($curl);
			}
			else
			{
				$curl_content = file_get_contents('https://www.tmpay.net/TPG/backend.php?merchant_id='.$merchant_id.'&password=' . $truemoney_password . '&resp_url='.$base.'action/topup/tmpay_confirm');
			}
			if(strpos($curl_content,'SUCCEED') !== FALSE)
				return $curl_content;
			else if($curl_content == 'ERROR|THIS_CARD_IS_BEING_PROCESSED')
				return 'process';
			else if($curl_content == 'ERROR|INVALID_PASSWORD')
				return 'password';
			else if($curl_content == 'ERROR|INVALID_MERCHANT_ID')
				return 'merchant';
		}
}