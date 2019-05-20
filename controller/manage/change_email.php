<?php
include '../../controller/db_root_login.php';
include '../../controller/user.php';

session_start();

if (!(isset($_SESSION['login'])))
{
	echo"
	<script> 
	 alert('Acces interdit au invités'); 
	 window.location='../../index.php';
	 </script>";
	
	// header('Location: ../../index.php');
	exit();
}
if (isset($_POST['submit']) && $_POST['submit'] == 'OK')
{
	$mail = $_POST['newemail'];
	$cmail = $_POST['newemailconf'];
	$login = $_SESSION['login'];
	$e = 0;

	if (!($mail) || (strlen($mail) == 0))
	{
		echo "<p>Veuillez entrer un E-Mail s'il vous plait</p>";
		$e = 1;
	}

	if (!(preg_match(" /^.+@.+\.[a-zA-Z]{2,}$/ ", $mail)) && (strlen($mail) != 0))
	{
		echo "<p>Veuillez entrer un E-mail valide s'il vous plait</p>";
		$e = 1;
	}

	if (auth($login, $_POST['password']) == false)
	{
		echo "<p>Mauvais Mot de Passe !</p>";
		$e = 1;
	}

	if ($mail != $cmail)
	{
		echo "<p>L'E-Mail de confirmation ne corespond pas</p>";
		$e = 1;
	}
	
	if ($e == 0)
	{
		$stmt = $db->prepare("SELECT mail FROM user WHERE mail = :mail");
		$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
		$res = $stmt->execute();
		$row = $stmt->fetch();
		// print_r($row);
		if (!empty($row))
		{
			echo"<p>L'E-Mail ne peut pas être changer, il est déjà utiliser</p>";
			$e = 1;
		}
	}

	if ($e == 0)
	{
		
		$stmt = $db->prepare("UPDATE user SET mail = :mail WHERE login = :login ");
		$stmt->bindValue(':login', $login, PDO::PARAM_STR);
		$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
		$stmt->execute();
		echo "<p>Bravo vous avez changer votre adresse E-Mail</p>";
	}

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