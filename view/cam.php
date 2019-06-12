<?php
include '../controller/db_root_login.php';
include '../controller/user.php';
session_start();
if (!(isset($_SESSION['login'])))
{
	echo"
	<script> 
	 alert('Acces interdit au invités\n Merci de vous inscrire ou de vous connecter'); 
	 window.location='../index.php';
	 </script>";
	
	// header('Location: ../../index.php');
	exit();
}
?>

<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/cam.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
	<script src="../controller/cam/camera.js"></script>
	<script src="../controller/cam/filter.js"></script>
</head>
<script> 
function alertguest()
{
	alert('Acces interdit au invités');
	window.location='../index.php';
}
</script>

<body>
<div class="banniere">
		<a href="../index.php" style="text-decoration: none">
			<h1 id="nom-site">CAMAGRU</h1>
		</a>
		
		<div id="log">
			<form method="POST" action ="">
			<?php 
			if(!isset($_SESSION['login']))
			{
				echo '<input class= "log_bouton" type="text" name="login" value="" placeholder="Mail ou Login" required=""/>
				<br />
				<input class= "log_bouton" type="password" name="passwd" value="" placeholder="Mot de passe" required=""/>
				<br/>
				<input class="log_bouton" type="submit" name="submit" value="VOUS CONNECTER"/><br>';
				echo'<a href="../view/user_creation.php"> <input type="button" value="CREE VOTRE COMPTE"> </a>';
			}
			if (isset($_SESSION['login']))
			{
				echo'<div class="dot"></div>
				<div class="imconected" style="display: inline-block; margin-left:5px; ">
				Vous etes connecte <a class="moncompte" href="../view/userpage.php?login='.$_SESSION['login'].'">'.$_SESSION['login'].'</a>
				</div> 
				</br>';
				echo '<input class= "log_bouton" type="submit" name="logout" value="Logout"/>';
				echo '<input class= "setting_bouton" type="button" name="setting" value="Setting" onclick="window.location.href=\'manage/manage.php\'"/>';
				
			}
			?>
				<br />
			</form>
		</div>
		
	<a href="../view/cam.php" > <img class="cam" src="../resources/img/cam.png" alt="cam"></a>
</div>

<div class="container1">
	<div class="containerCam">
		<video id="videoElement" autoplay="true" ></video>
		<canvas id="canvas" width=1000 height=750></canvas>
		<div class="container_button">
			<button type="button" onclick="stop()">Stop</button>
			<button type="button" onclick="start()">Start</button>
			<?php // 2 BOUTON DIFERENT EN FONCTION DE SESSION SET OU PAS 
			if (!isset($_SESSION['login']))
				echo'<button type="button" onclick="alertguest()" >Take picture</button>';
			if (isset($_SESSION['login']))
				echo'<button type="button" onclick="capture(), window.location.href='.'\'YourPic.php\''.'" >Take picture</button>';
			?>
		</div>
	</div>
	<div class="container_filtre">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
		<input id="f_quake" type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
	</div>

</div>
<br />
<div class="container2">
	
</div>
</body>
</html>
