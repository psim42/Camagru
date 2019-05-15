<?php
include 'function/db_root_login.php';
include 'user.php';
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
	echo '<meta http-equiv="refresh" content="0;URL=user_creation.php">';
}
if (isset($_POST['submit']) && $_POST['submit'] == "VOUS CONNECTER")
{
	if (isset($_POST['login']) && isset($_POST['passwd']))
	{		
		if (auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION['login'] = $_POST['login'];
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
	<video autoplay="true" id="videoElement"></video>
	<canvas id="canvas" width=1000 height=750></canvas>
</div>
<div style="margin-left: 50px; margin-top: 10px;">
<button type="button" onclick="stop()">Stop</button>
<button type="button" onclick="start()">Start</button>
<button type="button" onclick="capture()">Take picture</button>
<br />
	<input type="image" src="resources/img/filter.png" alt="quake" onclick="switch_filter('quake')">
  <input type="submit">

</div>
<script>
var video = document.querySelector("#videoElement");
var filter = "";

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
function capture() {
    canvas.width = 1000;
    canvas.height = 750;
    canvas.getContext('2d').drawImage(video, 0, 0, 1000, 750);
    var canvasData = canvas.toDataURL("image/png");
		var ajax = new XMLHttpRequest();
		alert(filter);
		ajax.open("POST",'pic_save.php',false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(canvasData);
		ajax.open("POST",'add_filter.php',false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(filter);
}

function switch_filter(new_filter)
{
		filter = new_filter;
}

</script>

<img src = "resources/img/crayon.jpg">
</body>
</html>