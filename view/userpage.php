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

?>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
	<script src="../controller/camera.js"></script>
	<script src="../controller/filter.js"></script>
	<script src="../controller/whiteboxuser.js"></script>
	<script src="../controller/scrolluser.js"></script>
	
</head>
<body>
<div class="banniere">
		<a href="../index.php" style="text-decoration: none">
			<h1 id="nom-site">CAMAGRU</h1>
		</a>
		
		<div id="log">
			<form method="POST" action ="../index.php">
				<?php 
			if(!isset($_SESSION['login']))
			{
				echo '<input id= "log_bouton" type="text" name="login" value="" placeholder="Mail ou Login" required=""/>
				<br />
				<input id= "log_bouton" type="password" name="passwd" value="" placeholder="Mot de passe" required=""/>
				<br/>
				<input id= "log_bouton" type="submit" name="submit" value="VOUS CONNECTER"/>
				<br />
				<input id= "log_bouton" type="submit" name="submit" value="CREER UN COMPTE"/>
				<br />';
			}
			
			if (isset($_SESSION['login']))
			{
				echo'<div class="dot"></div><div style="display: inline-block; margin-left:5px; "><p>Vous etes connecte '.$_SESSION['login'].'</p></div> </br>';
				echo '<input id= "log_bouton" type="submit" name="logout" value="Logout"/>';
				echo '<input id= "setting_bouton" type="submit" name="setting" value="Setting"/>';
				
			}
			?>
				<br />
			</form>
		</div>
		
		<a href="cam.php" > 
			<img class="cam" src="../resources/img/cam.png" alt="cam">
		</a>

</div>

<?php
if (!isset($_GET['login']))
{
	if (!(isset($_GET['login']))) // ou n'est pas dans la base
{
	echo"
	<script> 
	 alert('Page inexistante'); 
	 window.location='../index.php';
	 </script>";
	
	// header('Location: ../../index.php');
	exit();
}
}
?>

<div id='status'>? | ?</div>

<div class="Fildactu">
	<?php
	echo "<h2 id='". $_GET['login'] ."' class='title'>Profile de ". $_GET['login'] ."<h2>";
	?>
	<div class='imgscontainer' id='imgscontainer'>
	<?php
	$stmt = $db->prepare("SELECT id, path, date, nb_like, nb_comment FROM pic WHERE user = :user ORDER BY date DESC LIMIT 0, 15");
	$stmt->bindValue(':user', $_GET['login'], PDO::PARAM_STR);
	$stmt->execute();
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
		<input type="image" alt="coeur" class="coeur_comW" src="../resources/img/coeurP.png" onclick="addlike()">
		<div id='containerlikeW'></div>
		
	</div>

	<div class="container2">
		<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Retour</button>
	</div>
</div>

</body>
</html>
