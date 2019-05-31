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

<div class="Fildactu">
	<?php
	echo "<h2 class='title'>Profile de ". $_GET['login'] ."<h2>";
	$stmt = $db->prepare("SELECT path, date, nb_like, nb_comment FROM pic WHERE user = :user ORDER BY date DESC");
	$stmt->bindValue(':user', $_GET['login'], PDO::PARAM_STR);
	$stmt->execute();
	while ($data = $stmt->fetch())
	{
		echo 
		"<div class='img'>
		<div class='imgdetail2'>
			<div class='likecom'>
				<img class='coeur_com' src='../resources/img/comment-icon.png' alt='C'> ".$data['nb_comment']."
				<img class='coeur_com' src='../resources/img/coeurP.png' alt='C'> ". $data['nb_like']."
			</div>
		</div>
		<img class='fil' src='".$data['path']."' alt='Pic'>
	</div>";
	}
	?>

</div>
</body>
</html>
