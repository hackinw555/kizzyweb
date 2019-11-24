<?php
class KiznickAPI {
	function __construct()
	{
		return true;
	}
	function payment_status($status, $type)
	{
		if($type == 1)
		{
			switch($status) {
				case "0":
					return 'ระบบกำลังตรวจสอบยอดเงิน...';
					break;
				case "1":
					return 'เติมเงินสำเร็จ';
					break;
				case "3":
					return 'บัตรถูกใช้ไปแล้ว';
					break;
				case "4":
					return 'รหัสบัตรเงินสดไม่ถูกต้อง';
					break;
				case "5":
					return 'บัตรทรูมูฟ (ไม่ใช้บัตรทรูมันนี่)';
					break;
				default:
					return 'สถานะที่ไม่รู้จัก !';
			}
		}
		else if($type == 2)
			return 'เติมเงินสำเร็จ';
	}
	function payment_type($type)
	{
		switch($type) {
			case "1":
				return 'Truemoney';
				break;
			case "2":
				return 'Truewallet';
				break;
			default:
        		return 'ไม่ได้ระบุ';
		}
	}
	function CheckAdmin()
	{
		if($_SESSION['isadmin'] != 1 || $_SESSION['id'] == '')
			return false;
		else
			return true;
	}
	function EditConfig($name, $value, $pdo)
	{
		$Edit = $pdo->prepare("UPDATE config SET value = ? WHERE name = ?");
		$query = $Edit->execute(array($value, $name));
		if($query)
			return true;
		else
			return false;
	}
	function version($version)
	{
		$array = explode(".", $version);
		$number = 0;
		foreach ($array as $k => $a) {
			$number += pow(10, count($array) - $k) * $a;
		}
		return $number;
	}
}
?>