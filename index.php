<?php
include 'controller/db_root_login.php';
include 'controller/user.php';
session_start();

// $src = imagecreatefromjpeg('resources/img/crayon.jpg');
// $dst = imagecreatetruecolor(576,576);
// $filter = imagecreatefrompng('resources/img/filter.png');

// imagecopy($dst, $src, 0, 0, 0, 0, 576, 576);
// imagecopy($dst, $filter, 60, 60, 0, 0, 318, 479);
// imagejpeg($dst, 'resources/img/result.jpg');

if (isset($_POST['name']))
{ 
	echo '<p>test</p>';
}
if (isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	session_start();
}
if (isset($_POST['submit']) && $_POST['submit'] == "CREER UN COMPTE")
{
	echo '<meta http-equiv="refresh" content="0;URL=view/user_creation.php">';
}
if (isset($_POST['submit']) && $_POST['submit'] == "VOUS CONNECTER")
{
	if (isset($_POST['login']) && isset($_POST['passwd']))
	{
		auth($_POST['login'], $_POST['passwd']);
	}
}
if (isset($_POST['setting']))
{
	echo '<meta http-equiv="refresh" content="0;URL=view/manage/manage.php">';
}
// if (isset($_POST['mail']))
// {
// 	$to_email = 'mouenba@hotmail.fr';
// 	$subject = 'Testing PHP Mail';
// 	$message = 'This mail is sent using the PHP mail function';
// 	$headers = 'From: noreply@camagru.com';
// 	mail($to_email,$subject,$message,$headers);
// }
?>



<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
	<script src="controller/camera.js"></script>
	<script src="controller/filter.js"></script>
	
</head>
<body>

<div id="banniere">
		<a href="index.php" style="text-decoration: none"><h1 id="nom-site">CAMAGRU</h1></a>
		<div id="log">
		<form method="POST" action ="">
			<?php if(!isset($_SESSION['login'])){
				echo '<input id= "log_bouton" type="text" name="login" value="" placeholder="Mail ou Login"/>
				<br />
				<input id= "log_bouton" type="password" name="passwd" value="" placeholder="Mot de passe"/>
				<br/>
				<input id= "log_bouton" type="submit" name="submit" value="VOUS CONNECTER"/>
				<br />
				<input id= "log_bouton" type="submit" name="submit" value="CREER UN COMPTE"/>
				<br />';}
			if (isset($_SESSION['login']))
			{
				echo'<div class="dot"></div><div style="display: inline-block; margin-left:5px; "><p>Vous etes connecte '.$_SESSION['login'].'</p></div> </br>';
				echo '<input id= "log_bouton" type="submit" name="logout" value="Logout"/>';
				echo '<input id= "setting_bouton" type="submit" name="setting" value="Setting"/>';
				// echo '<input id= "mail_bouton" type="submit" name="mail" value="mail"/>';
			}
			?>
				<br />
			</form>
			
			</div>
</div>
<div id="container">
	<video autoplay="true" id="videoElement"></video>
	<canvas id="canvas" width=1000 height=750></canvas>
</div>
<div style="margin-left: 50px; margin-top: 10px;">
<button type="button" onclick="stop()">Stop</button>
<button type="button" onclick="start()">Start</button>
<button type="button" onclick="capture()">Take picture</button>
<br />
	<input type="image" src="resources/img/quake.png" alt="quake" onclick="switch_filter('quake')">
  <input type="submit">

</div>
</body>
</html>
