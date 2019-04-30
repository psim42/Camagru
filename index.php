<?php
	include 'user.php';
	session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=psim;charset=utf8', 'root', '123456');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
if (isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	session_start();
}
if ($_POST['submit'] == "CREER UN COMPTE")
{
	echo '<meta http-equiv="refresh" content="0;URL=user_creation.php">';
}
if ($_POST['submit'] == "VOUS CONNECTER")
{
	if (isset($_POST['login']) && isset($_POST['passwd']))
	{		
		if (auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION['login'] = $_POST['login'];
			if ($_SESSION['login'] == "root")
			{
				echo '<meta http-equiv="refresh" content="0;URL=admin.php">';
			}
		}
	}
}
?>



<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
  <script src="script.js"></script>
</head>
<body>

<div id="banniere">
		<a href="index.php" style="text-decoration: none"><h1 id="nom-site">CAMAGRU</h1></a>
		<div id="log">
		<form method="POST" action ="">
			<?php if(!isset($_SESSION['login'])){
				echo '<input id= "log_bouton" type="text" name="login" value="" placeholder="Identifiant"/>
				<br />
				<input id= "log_bouton" type="password" name="passwd" value="" placeholder="Mot de passe"/>
				<br/>
				<input id= "log_bouton" type="submit" name="submit" value="VOUS CONNECTER"/>
				<br />
				<input id= "log_bouton" type="submit" name="submit" value="CREER UN COMPTE"/>
				<br />';}
			if (isset($_SESSION['login'])){
				echo'<div class="dot"></div><div style="display: inline-block; margin-left:5px; "><p>Vous etes connecte</p></div> </br>';
				echo '<input id= "log_bouton" type="submit" name="logout" value="Logout"/>';}
			?>
				<br />
			</form>
			
			</div>
</div>
<div id="container">
	<video autoplay="true" id="videoElement">
	
	</video>
</div>
<div style="margin-left: 50px; margin-top: 10px;">
<button type="button" onclick="stop()">Stop</button>
<button type="button" onclick="start()">Start</button>
</div>
<script>
var video = document.querySelector("#videoElement");

function start(e){
	if (navigator.mediaDevices.getUserMedia) {
 	 navigator.mediaDevices.getUserMedia({ video: true })
   	 .then(function (stream) {
   	   video.srcObject = stream;
   	 })
    	.catch(function (err0r) {
    	  console.log("Something went wrong!");
  	  });
	}
}

function stop(e) {
  var stream = video.srcObject;
  var tracks = stream.getTracks();

  for (var i = 0; i < tracks.length; i++) {
    var track = tracks[i];
    track.stop();
  }

  video.srcObject = null;
}
</script>
</body>
</html>