<?php
include '../controller/db_root_login.php';
include '../controller/user.php';
session_start();
if (!(isset($_SESSION['login'])))
{
	echo"
	<script> 
	 alert('Acces interdit au invités'); 
	 window.location='../index.php';
	 </script>";
	
	// header('Location: ../../index.php');
	exit();
}
	if (isset($_GET['start']) && isset($_GET['limit']))
	{
		$s = (int)$_GET['start'];
		$l = (int)$_GET['limit']; 
			$resultat = $db->query("SELECT user, path, date, nb_like, nb_comment FROM pic ORDER BY date DESC LIMIT $s, $l");
			while ($data = $resultat->fetch())
			{
				echo "<div class='img'>
					<div class='imgdetail1'> <a class='auteur' href='./view/userpage.php?login=". $data['user'] ." '>". $data['user'] ."</a></div>
					<div class='imgdetail2'>
						<div class='likecom'>
							<img class='coeur_com' src='resources/img/comment-icon.png' alt='C'> ".$data['nb_comment']."
							<img class='coeur_com' src='resources/img/coeurP.png' alt='C'> ". $data['nb_like']."
						</div>
					</div>
					<img class='fil' src='".substr($data['path'], 3)."' alt='Pic' onclick='enlarge(this)'>
				</div>";
			}
	}
	else
	lol
	?>
