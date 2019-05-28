<?php
include '../controller/db_root_login.php';
session_start();

if (!(isset($_SESSION['login'])))
{
	echo"
	<script> 
	 alert('Acces interdit au invités'); 
	 window.location='../index.php';
	 </script>";
	
	// header('Location: ../../index.php');
	exit();
}

if (isset($GLOBALS['HTTP_RAW_POST_DATA']))
{
	$data = $GLOBALS['HTTP_RAW_POST_DATA'];
	if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
		$data = substr($data, strpos($data, ',') + 1);
		$data = base64_decode($data);
		if ($data === false) {
			throw new \Exception('base64_decode failed');
		}
	} else {
		throw new \Exception('did not match data URI with image data');
	}

	if (!(file_exists("../resources/user/".$_SESSION['login']."")))
	{
		mkdir("../resources/user/".$_SESSION['login']."");
	}
	$c = count(glob("../resources/user/".$_SESSION['login']."/*.png"));
	$r = $c + 1;
	file_put_contents("../resources/user/".$_SESSION['login']."/".$r.".png", $data);

}
echo"end start of view :  ";
print_r( count(glob("../resources/user/".$_SESSION['login']."/*.png")));
?>
<!-- Faire le dossier l'algo de control et tout -->
