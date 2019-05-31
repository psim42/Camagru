<?php
include '../controller/db_root_login.php';
include '../controller/user.php';
session_start();
?>

<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
	<script src="../controller/camera.js"></script>
	<script src="../controller/filter.js"></script>
	
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
			<form method="POST" action ="../index.php">
				<?php 
			if(!isset($_SESSION['login']))
			{
				echo '<input id= "log_bouton" type="text" name="login" value="" placeholder="Mail ou Login" required=""/>
				<br />
				<input id= "log_bouton" type="password" name="passwd" value="" placeholder="Mot de passe" required=""/>
				<br/>
				<input id= "log_bouton" type="submit" name="submit" value="VOUS CONNECTER"/>
				<br />
				<input id= "log_bouton" type="submit" name="submit" value="CREER UN COMPTE"/>
				<br />';
			}
			
			if (isset($_SESSION['login']))
			{
				echo'<div class="dot"></div><div style="display: inline-block; margin-left:5px; "><p>Vous etes connecte '.$_SESSION['login'].'</p></div> </br>';
				echo '<input id= "log_bouton" type="submit" name="logout" value="Logout"/>';
				echo '<input id= "setting_bouton" type="submit" name="setting" value="Setting"/>';
				
			}
			?>
				<br />
			</form>
		</div>
		
		<a href="cam.php" > 
			<img class="cam" src="../resources/img/cam.png" alt="cam">
		</a>

</div>

<div id="container">
	<video autoplay="true" id="videoElement"></video>
	<canvas id="canvas" width=1000 height=750></canvas>
</div>
<div style="margin-left: 50px; margin-top: 10px;">
<button type="button" onclick="stop()">Stop</button>
<button type="button" onclick="start()">Start</button>

<!-- 2 BOUTON DIFERENT EN FONCTION DE SESSION SET OU PAS -->
<!-- Merci -->
<?php

if(!isset($_SESSION['login']))
{

	echo'<button type="button" onclick="alertguest()" >Take picture</button>';

}

if (isset($_SESSION['login']))
{
	echo'<button type="button" onclick="capture(), window.location.href='.'\'YourPic.php\''.'" >Take picture</button>';

}
?>


<br />


	<input type="image" src="../resources/filter/quake.png" alt="quake" onclick="switch_filter('quake')">
</div>
</body>
</html>