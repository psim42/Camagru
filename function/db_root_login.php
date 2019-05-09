<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'admin123');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}
?>
