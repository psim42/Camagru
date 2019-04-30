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
	if (($_POST['login'] !== "") && ($_POST['passwd'] !== ""))
	{
		if (create_user($_POST['login'], $_POST['passwd']) == true)
			echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		else
			echo "<p>Erreur compte deja existant</p>";
	}
	if (($_POST['login'] !=="")  && ($_POST['passwd'] === ""))
		echo "<p>Veuillez rentrer un mot de passe svp</p>";
}
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" media="screen" href="./resources/css/index.css" />
</head>
<body>
	
<html>
		<h1>Entrer un Identifiant et un Mot de passe pour créer votre compte</h1>
		<form method="POST" action = >
				<input type="text" name="login" value="" placeholder="Identifiant"/>
					<br />
				<input type="password" name="passwd" value="" placeholder="Mot de Passe"/>
				<br />
				<input type="submit" name="submit" value="OK" href="/index.php"/>
					<br />
		</form>
		<a href= "/index.php">Cliquer ici pour retourner a la page d'accueil</a>
</html>