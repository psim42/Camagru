<?php
// include "function/db_root_login.php";

try
{
	$db = new PDO('mysql:host=localhost;charset=utf8', 'root', 'admin123');
}
catch (Exception $e)
{
	die('Erreur : AH BAH VOILA ' . $e->getMessage());
}

$file = file_get_contents("../sql/camagru.sql");
$file = explode(';', $file);
$db->query('DROP DATABASE camagru');
$db->query('CREATE DATABASE camagru');
$db->query('USE camagru');
foreach($file as $tmp)
	$db->query($tmp);
?>
