<?php					//PHP_PHP_PHP_PHP_PHP_PHP_PHP//
include 'controller/db_root_login.php';
include 'controller/user.php';
session_start();

// if (isset($_POST['name'])) ?? C'est quoi 
// { 
// 	echo '<p>test</p>';
// }
if (isset($_POST['logout']))
{
	session_unset();
	session_destroy();
	session_start();
	header("Refresh:0");// Pour acctualiser sans avoir a resouscrire le formulaire
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
		header("Refresh:0");// Pour acctualiser sans avoir a resouscrire le formulaire
	}
}
if (isset($_POST['setting']))
{
	echo '<meta http-equiv="refresh" content="0;URL=view/manage/manage.php">';
}
?>	<!-- // PHP_END_PHP_END // -->





				<!-- // HTML_HTML_HTML_HTML // -->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>


  <!-- ///////////////////////////  SCRIPT  ///////////////////////////////// -->
	<script src="controller/camera.js"></script>
	<script src="controller/filter.js"></script>
	<script src="controller/whitebox.js"></script>
	<script src="controller/scroll.js"></script>


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
		
	<a href="view/cam.php" > <img class="cam" src="resources/img/cam.png" alt="cam"></a>

</div>

<div id='status'>? | ?</div>

<div class="Fildactu" id="warp">
	<h2 class="title">Derinères Images !</h2>
	<div class='imgscontainer' id='imgscontainer'>
	<?php
	$s = 0;
	$l = 15; 
		$resultat = $db->query("SELECT id, user, path, date, nb_like, nb_comment FROM pic ORDER BY date DESC LIMIT 0, 15");
		while ($data = $resultat->fetch())
		{
			echo "<div class='img'>
				<div class='imgdetail1'> <a class='auteur' href='./view/userpage.php?login=". $data['user'] ." '>". $data['user'] ."</a></div>
				<div class='imgdetail2'>
					<div class='likecom'>
						<img class='coeur_com' src='resources/img/comment-icon.png' alt='C'> 
						<div class='containerlikecom'id='containercom".$data['id']."'>".$data['nb_comment']."</div>
						<img class='coeur_com' src='resources/img/coeurP.png' alt='C'> 
						<div class='containerlikecom' id='containerlike".$data['id']."'>". $data['nb_like']."</div>
					</div>
				</div>
				<img class='fil' id='".$data['id']."' src='".substr($data['path'], 3)."' alt='Pic' onclick='enlarge(this)'>
			</div>";
		}
	?>
	</div>
</div>


<!-- WHITEBOX WHITEBOX WHITEBOX WHITEBOX WHITEBOX -->

<div id="id01" class="modal">

	<div class="modal-content animate">
		<div class="imgcontainer">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<div id="bigview">
	</div>	
	<div class="container">
		<input type="image" alt="coeur" class="coeur_comW" src="resources/img/coeurP.png" onclick="addlike()">
		<div id='containerlikeW'></div>
		<input type="image" alt="comment" class="coeur_comW" src="resources/img/comment-icon.png" onclick="">
		<div id='containercomW'></div>
		<!-- <form> -->
			<textarea id="myTextarea" rows=“15” cols=“60" minlength=“10” maxlength=“20" name="comment" placeholder="Your comment here..."></textarea>
			<input id="send" class="send" type="image" src="resources/img/send.png" alt="send" onclick="addcom()">
		<!-- </form> -->
	</div>
</div>



</body>
</html>
