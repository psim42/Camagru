<?php
if($db = mysqli_connect('127.0.0.1', 'root', 'admin123'))
	 echo "Connection etablie\n";
else
	echo "Erreur de connexion\n";
$file = file_get_contents("sql/rush00.sql");
$file = explode(';', $file);
mysqli_query($db, 'DROP DATABASE rush00');
mysqli_query($db, 'CREATE DATABASE rush00');
mysqli_query($db, 'USE rush00');
foreach($file as $tmp)
	mysqli_query($db, $tmp);
?>
