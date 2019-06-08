<?php
include '../controller/db_root_login.php';
include '../controller/user.php';
session_start();

if (isset($_GET['start']) && isset($_GET['limit'])) // SCROLL INFINI LOAD IMAGE SCROLL.JS
{
	$s = (int)$_GET['start'];
	$l = (int)$_GET['limit']; 
	$stmt = $db->prepare("SELECT id, user, path, date, nb_like, nb_comment FROM pic ORDER BY date DESC LIMIT :s, :l");
	$stmt->bindValue(':s', $s, PDO::PARAM_INT);
	$stmt->bindValue(':l', $l, PDO::PARAM_INT);
	$stmt->execute();

	
		// $resultat = $db->query("SELECT id, user, path, date, nb_like, nb_comment FROM pic ORDER BY date DESC LIMIT $s, $l");
		while ($data = $stmt->fetch())
		{
			echo "<div class='img'>
				<div class='imgdetail1'> <a class='auteur' href='./view/userpage.php?login=". $data['user'] ." '>". $data['user'] ."</a></div>
				<div class='imgdetail2'>
					<div class='likecom'>
						<img class='coeur_com' src='resources/img/comment-icon.png' alt='C'> 
						<div class='containerlikecom'id='containercom'>".$data['nb_comment']."</div>
						<img class='coeur_com' src='resources/img/coeurP.png' alt='C'> 
						<div class='containerlikecom' id='containerlike".$data['id']."'>". $data['nb_like']."</div>
					</div>
				</div>
				<img class='fil' id='".$data['id']."' src='".substr($data['path'], 3)."' alt='Pic' onclick='enlarge(this)'>
			</div>";
		}
}
elseif (isset($_GET['start2']) && isset($_GET['limit2']) && isset($_GET['user'])) // SCROLL INFINI LOAD IMAGE SCROLL.JS POUR USER PAGE
{
	$s = (int)$_GET['start2'];
	$l = (int)$_GET['limit2'];
	$user = $_GET['user'];
	$stmt = $db->prepare("SELECT id, user, path, date, nb_like, nb_comment FROM pic WHERE user = :user ORDER BY date DESC LIMIT :s, :l");
	$stmt->bindValue(':s', $s, PDO::PARAM_INT);
	$stmt->bindValue(':l', $l, PDO::PARAM_INT);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	$stmt->execute();
		// $resultat = $db->query("SELECT id, user, path, date, nb_like, nb_comment FROM pic ORDER BY date DESC LIMIT $s, $l");
		while ($data = $stmt->fetch())
		{
			echo "<div class='img'>
			<div class='imgdetail2'>
				<div class='likecom'>
					<img class='coeur_com' src='../resources/img/comment-icon.png' alt='C'> 
					<div class='containerlikecom'id='containercom'>".$data['nb_comment']."</div>
					<img class='coeur_com' src='../resources/img/coeurP.png' alt='C'> 
					<div class='containerlikecom' id='containerlike".$data['id']."'>". $data['nb_like']."</div>
				</div>
			</div>
			<img class='fil' id='".$data['id']."' src='".$data['path']."' alt='Pic' onclick='enlarge(this)'>
		</div>";
		}
}
elseif (isset($_GET['like'])) // LOAD LIKE WHITEBOX.JS
{
	$id = $_GET['like'];
	$stmt = $db->prepare("SELECT nb_like FROM pic WHERE id = :id");
	$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$resultat2 = $stmt->fetch();
		echo $resultat2['nb_like'];
}
elseif (isset($_GET['nbcom'])) // LOAD nbCOM WHITEBOX.JS
{
	$id = $_GET['nbcom'];
	$stmt = $db->prepare("SELECT nb_comment FROM pic WHERE id = :id");
	$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$resultat2 = $stmt->fetch();
		echo $resultat2['nb_comment'];
}
elseif (isset($_GET['comment']))
{
	
}
elseif (isset($_GET['addlike'])) // ADD LIKE UPDATE TABLE LIKE ET PIC WHITEBOX.JS
{
	if (!(isset($_SESSION['login'])))
	{
		exit("notlog");
	}
	else
	{
		$id = $_GET['addlike'];
		// echo"$id";
		// 1 ragerder si dans la table il y a une ligne avec id_pic + user
		$stmt = $db->prepare("SELECT id_pic, `login` FROM tab_like WHERE id_pic = :id_pic AND `login` = :user");
		$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
		$stmt->bindValue(':user', $_SESSION['login'], PDO::PARAM_STR);
		$stmt->execute();
		$resultat = $stmt->fetch();
		if (isset($resultat) && $resultat != NULL){ //unlike
			// supprimer la ligne
			$stmt = $db->prepare("DELETE FROM tab_like WHERE id_pic = :id_pic AND `login` = :user");
			$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
			$stmt->bindValue(':user', $_SESSION['login'], PDO::PARAM_STR);
			$stmt->execute(); 
			// compter le nombre de like ligne sur l'id_pic 
			$stmt = $db->prepare("SELECT count(DISTINCT login) FROM tab_like WHERE id_pic = :id_pic");
			$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
			$stmt->execute();
			$nblike = $stmt->fetch();
			// update la table pic a l'id pic nb_like = new_nblike
			$new_nblike = $nblike['count(DISTINCT login)'];
			$stmt = $db->prepare("UPDATE `pic` SET `nb_like`= :new_nblike WHERE id = :id_pic");
			$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
			$stmt->bindValue(':new_nblike', $new_nblike, PDO::PARAM_INT);
			$stmt->execute();
			// exit('unlike') et relancer getlike en js
			exit($new_nblike);
		}
		else{
			// 2 si ya pas de like ajouter un ligne avec id_pic et user
			$stmt = $db->prepare("INSERT INTO tab_like(id_pic, `login`) VALUES (:id_pic, :user) ");
			$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
			$stmt->bindValue(':user', $_SESSION['login'], PDO::PARAM_STR);
			$stmt->execute(); 
			// compter le nombre de like ligne sur l'id_pic 
			$stmt = $db->prepare("SELECT count(DISTINCT login) FROM tab_like WHERE id_pic = :id_pic");
			$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
			$stmt->execute();
			$nblike = $stmt->fetch();
			//update la table pic a l'id pic nb_like = new_nblike
			$new_nblike = $nblike['count(DISTINCT login)'];
			$stmt = $db->prepare("UPDATE `pic` SET `nb_like`= :new_nblike WHERE id = :id_pic");
			$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
			$stmt->bindValue(':new_nblike', $new_nblike, PDO::PARAM_INT);
			$stmt->execute();
			// exit('like') et relancer getlike en js
			exit($new_nblike);
		}
	}
}
elseif (isset($_POST['idPicCom']) && isset($_POST['comment']))
{
	if (!(isset($_SESSION['login'])))
	{
		exit("notlog");
	}
	// Je ressois id photo et commentaire j'ai session user aussi date: NOW()
	//id	date	id_pic	user	comment
	$comment = htmlentities($_POST['comment']);
	$id = $_POST['idPicCom'];
	$stmt = $db->prepare("INSERT INTO tab_comment(id_pic, `date`, user, comment) VALUES (:id_pic, NOW(), :user, :comment) ");
	$stmt->bindValue(':id_pic', $id, PDO::PARAM_INT);
	$stmt->bindValue(':user', $_SESSION['login'], PDO::PARAM_STR);
	$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
	$stmt->execute();
	// if (!$stmt->execute()){
	// 	$error = implode( ", ", $stmt->errorInfo() );
	// 	exit($error);
	// }
	exit($id);
}
else
{
	echo"
	<script> 
	alert('Page non existante'); 
	window.location='../index.php';
	</script>";
	
	// header('Location: ../../index.php');
	exit();
}
?>
