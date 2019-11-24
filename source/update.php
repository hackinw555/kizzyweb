<?php
$version = $KiznickAPI->version(config($pdo, 'version'));
function query($sql, $array = [])
{
	global $pdo;
    $q = $pdo->prepare($sql);
    $q->execute($array);
    return $q;
}
function notexistcolumn($table, $column)
{
	global $pdo;
	global $host;
	$q = $pdo->prepare("SELECT column_name FROM information_schema.columns WHERE table_schema = ? and table_name = ? and column_name = ? LIMIT 1");
	$q->execute(array($host['database_name'], $table, $column));
	if($q->rowCount() == 0)
		return true;
	else
		return false;
}
function notexisttable($table)
{
	global $pdo;
	global $host;
	$q = $pdo->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = ? and table_name = ? LIMIT 1");
	$q->execute(array($host['database_name'], $table));
	if($q->rowCount() == 0)
		return true;
	else
		return false;
}
if($version < $KiznickAPI->version('3.0.0'))
{
	// Update Authme
	if(notexistcolumn('authme', 'redeem'))
		query("ALTER TABLE `authme` ADD `redeem` TEXT NOT NULL AFTER `donate`;");
	if(notexistcolumn('authme', 'checkin'))
		query("ALTER TABLE `authme` ADD `checkin` INT NOT NULL AFTER `redeem`;");
	if(notexistcolumn('authme', 'checkindate'))
		query("ALTER TABLE `authme` ADD `checkindate` VARCHAR(10) NOT NULL AFTER `checkin`");
	if(notexisttable('gift'))
		query("CREATE TABLE `gift` (
					 `id` int(3) NOT NULL AUTO_INCREMENT,
					 `product` int(3) NOT NULL,
					 `image` varchar(200) COLLATE utf8mb4_bin NOT NULL,
					 `name` varchar(150) COLLATE utf8mb4_bin NOT NULL,
					 `reciver` int(3) NOT NULL,
					 `sender` int(3) NOT NULL,
					 `date` varchar(10) COLLATE utf8mb4_bin NOT NULL,
					 `expire` varchar(10) COLLATE utf8mb4_bin NOT NULL,
					 PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin
				");
	if(notexisttable('checkin'))
		query("CREATE TABLE `checkin` (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					 `image` varchar(255) NOT NULL,
					 `name` varchar(255) NOT NULL,
					 `command` varchar(255) NOT NULL,
					 `price` int(5) NOT NULL,
					 `server` int(11) NOT NULL,
					 PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8
				");
	if(notexisttable('news'))
		query("CREATE TABLE `news` (
					 `id` int(3) NOT NULL AUTO_INCREMENT,
					 `time` varchar(10) COLLATE utf8mb4_bin NOT NULL,
					 `text` varchar(256) COLLATE utf8mb4_bin NOT NULL,
					 PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin
				");
	if(notexisttable('redeem'))
		query("CREATE TABLE `redeem` (
					 `id` int(3) NOT NULL AUTO_INCREMENT,
					 `redeem` varchar(200) NOT NULL,
					 `command` varchar(50) NOT NULL,
					 `used` int(11) NOT NULL DEFAULT 0,
					 `max` int(11) NOT NULL,
					 `server` int(11) NOT NULL,
					 PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8
				");
}
?>