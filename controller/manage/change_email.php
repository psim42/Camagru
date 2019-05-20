<?php
include '../../controller/db_root_login.php';
include '../../controller/user.php';

session_start();

if (!(isset($_SESSION['login'])))
{
	header('Location: ../../index.php');
	exit();
}
if (isset($_POST['submit']) && $_POST['submit'] == 'OK')
{
	$mail = $_POST['newemail'];
	$login = $_SESSION['login'];

	if (auth($login, $_POST['password']) == false)
		echo "<p>Mauvais Mot de Passe !</p>";

// IF NEW MAIL ET MAIL CONFIRMATION 


	$stmt = $db->prepare("UPDATE user SET mail = :mail WHERE login = :login ");
	$stmt->bindValue(':login', $login, PDO::PARAM_STR);
	$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
	$stmt->execute();
	echo "<p>Bravo vous avez changer votre adresse E-Mail</p>";
}








// $resultat = mysqli_query($db, 'SELECT id, email FROM users');
// while($donnees = mysqli_fetch_assoc($resultat))
// {
// 	if ($donnees['email'] == $login)
// 	{
// 		$id = $donnees['id'];
// 		break;
// 	}
// }
// mysqli_free_result($resultat);

// if (!(isset($id)))
// {
// 	header('Location: ../index.php');
// }
// echo "$id";
?>
