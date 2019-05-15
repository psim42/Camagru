<?php
	include 'user.php';
	session_start();
if (isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	session_start();
}
if (isset($_POST['submit']))
{
	// if (($_POST['login'] !== "") && ($_POST['email'] !== "") && ($_POST['passwd'] !== "") && ($_POST['passwd2'] !== ""))
	// {
	if (create_user($_POST['email'], $_POST['login'], $_POST['passwd'], $_POST['passwd2']) == true)
		echo "<p>Felicitation vous avez crée votre compte un mail de confirmation va vous etre envoyer</p>";
	else
		echo "<p>Erreur veuillez réessayer s'il vous plait</p>";
	// }

	// if (($_POST['login'] !== "")  && ($_POST['passwd'] === ""))
	// 	echo "<p>Veuillez rentrer un mot de passe svp</p>";
}
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" media="screen" href="register.css" />
</head>
<body>
	
<html>
		<h2>Entrer un Email, un Identifiant et un Mot de passe pour créer votre compte</h2>
		<h2>Un Email de confirmation vous sera envoyer pour créer votre compte</h2>
		<form method="POST" action = >
				<input type="text" name="email" value="" placeholder="Adresse email"/>
					<br />
				<input type="text" name="login" value="" placeholder="Identifiant"/>
					<br />
					
				<input type="password" name="passwd" value="" placeholder="Mot de Passe"/>
				<br />
				<input type="password" name="passwd2" value="" placeholder="Confirmation mot de passe"/>
					<br />
				<input type="submit" name="submit" value="OK" href="/index.php"/>
					<br />
		</form>
		<a href= "/index.php">Cliquer ici pour retourner a la page d'accueil</a>
</html>
