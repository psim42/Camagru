<?php
include 'controller/db_root_login.php';
include 'controller/user.php';
session_start();



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
<div class="banniere">
		<a href="index.php" style="text-decoration: none">
			<h1 id="nom-site">CAMAGRU</h1>
		</a>
		
		<div id="log">
			<form method="POST" action ="">
			<?php 
			if(!isset($_SESSION['login']))
			{
				echo '<input id= "log_bouton" type="text" name="login" value="" placeholder="Mail ou Login" required=""/>
				<br />
				<input id= "log_bouton" type="password" name="passwd" value="" placeholder="Mot de passe" required=""/>
				<br/>
				<input id= "log_bouton" type="submit" name="submit" value="VOUS CONNECTER"/><br>';
				echo'<a href="view/user_creation.php"> <input type="button" value="CREE VOTRE COMPTE"> </a>';
			}
			?>


			<?php
			if (isset($_SESSION['login']))
			{
				echo'<div class="dot"></div>
				<div style="display: inline-block; margin-left:5px; ">
				<p>Vous etes connecte <a class="moncompte" href="./view/userpage.php?login='.$_SESSION['login'].'">'.$_SESSION['login'].'</a> </p>
				</div> 
				</br>';
				echo '<input id= "log_bouton" type="submit" name="logout" value="Logout"/>';
				echo '<input id= "setting_bouton" type="submit" name="setting" value="Setting"/>';
				
			}
			?>
				<br />
			</form>
		</div>
		
		<a href="view/cam.php" > 
			<img class="cam" src="resources/img/cam.png" alt="cam">
		</a>

</div>
<div class="Fildactu">
<h2 class="title">Derinères Images !<h2>
	
<?php

$resultat = $db->query('SELECT user, path, date, nb_like, nb_comment FROM pic ORDER BY date DESC');
while ($data = $resultat->fetch())
{
	echo 
"<div class='img'>
	<div class='imgdetail1'> <p class='auteur'>". $data['user'] ."<p></div>
	<div class='imgdetail2'>
		<div class='likecom'>
			<img class='coeur_com' src='resources/img/comment-icon.png' alt='C'> ".$data['nb_comment']."
			<img class='coeur_com' src='resources/img/coeurP.png' alt='C'> ". $data['nb_like']."
		</div>
	</div>
	<img class='fil' src='".substr($data['path'], 3)."' alt='Pic'>
</div>";
}
?>

</div>
</body>
</html>
