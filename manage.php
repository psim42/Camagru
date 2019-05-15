<?php
include 'function/db_root_login.php';
include 'user.php';
session_start();

if (!(isset($_SESSION['login'])))
{
	header('Location: index.php');
	exit();
}
	
$login = $_SESSION['login'];

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

<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Index_login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/extern.css">
</head>
<body>
	<div id="center" style="color: white;">
	<h1>Change your Email and Password<h1><br />
	<form id='manage.php' name="manage.php" action='manage_change.php' method='post' accept-charset='UTF-8'>
		<input class="text" placeholder="New e-mail" type="email" name="newlogin" value="" />
		<br />
		<input class="text" placeholder="New password" type="password" name="newpasswd" value="" />
		<input type="submit" name="submit" value="OK"/>
		<br />
		<br />
	</form>

	<h1>Delete your account<h1>
	<form id='manage.php' name="manage.php" action='manage_del.php' method='post' accept-charset='UTF-8'>
	<?php echo'<button type="submit" name="id" value="   '.$id.'   ">Delete your account</button>'?>
	</form>
	<a href="index.php"><button type="button" >Index</button></a>
	</div>
</body>
</html>
