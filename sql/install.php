<?php
include 'function/db_root_login.php';
$file = file_get_contents("sql/camagru.sql");
$file = explode(';', $file);
$db->query('DROP DATABASE camagru');
$db->query('CREATE DATABASE rush00');
$db->query('USE rush00');
foreach($file as $tmp)
	$db->query($tmp);
?>
