<?php

include '../../controller/db_root_login.php';
session_start();

if (!(isset($_SESSION['login'])))
{
	echo"
	<script> 
	 alert('Acces interdit au invités'); 
	 window.location='../../index.php';
	 </script>";
	
	// header('Location: ../../index.php');
	exit();
}

if (isset($GLOBALS['HTTP_RAW_POST_DATA']))
{
	$c = count(glob("../../resources/user/".$_SESSION['login']."/*.png"));
	$set_filter = $GLOBALS['HTTP_RAW_POST_DATA'];
	$src = imagecreatefrompng("../../resources/user/".$_SESSION['login']."/".$c.".png");
	$dst = imagecreatetruecolor(1000,750);
	$filter = imagecreatefrompng("../../resources/filter/{$set_filter}.png");
	list($width, $height) = getimagesize("../../resources/filter/{$set_filter}.png");
	// cree function qui resize pour augmanter la taille et diminuer ta taille du filter ?
	if (!(file_exists("../../resources/user/".$_SESSION['login']."")))
	{
		mkdir("../../resources/user/".$_SESSION['login']."");
	}
	imagecopy($dst, $src, 0, 0, 0, 0, 1000, 750);
	imagecopy($dst, $filter, 60, 60, 0, 0, $width, $height); // 60, 60, 0, 0, 318, 479)
	imagejpeg($dst, "../../resources/user/".$_SESSION['login']."/".$c.".png");
}
