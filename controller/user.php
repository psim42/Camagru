<?php

function auth($login, $passwd){
	include 'db_root_login.php';
	if	(!($login) || !($passwd))
		return(FALSE);

	$passwd = hash("whirlpool", $passwd);
	// $USER["login"] = $login;

	$good_info = 0;
	$resultatdeco = $db->query('SELECT login, password, mail FROM user');

	while ($donnees = $resultatdeco->fetch())
	{
		if (($login == $donnees['login'] || $login == $donnees['mail']) && $passwd == $donnees['password'])
		{
			$good_info = 1;
			$_SESSION['login'] = $donnees['login'];
		}
	}
	if ($good_info == 1)
		return(TRUE);
	else
		return(FALSE);

}

function create_user($mail, $login, $passwd, $passwd2){

	include 'db_root_login.php';

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

	if (!($login) || (strlen($login) == 0))
	{
		echo "<p>Veuillez entrer un Login s'il vous plait</p>";
		$e = 1;
	}

	if (isset($login) && (strlen($login) < 3 && (strlen($login) != 0)))
	{
		echo "<p>Veuillez entrer un Login avec au moins 3 caractères s'il vous plait</p>";
		$e = 1;
	}
	
	if (!($passwd) || (strlen($passwd) == 0))
	{
		echo "<p>Veuillez entrer un Mot de passe s'il vous plait</p>";
		$e = 1;
	}

	if ((strlen($passwd) < 6) && (strlen($passwd) != 0))
	{
		echo "<p>Veuillez entrer un Mot de passe avec au mois 6 caractères s'il vous plait</p>";
		$e = 1;
	}

	if ($passwd2 != $passwd)
	{
		echo "<p>Votre Confirmation de mot de passe est fausse</p>";
		$e = 1;
	}



	$tab = [
		"mail" => $mail,
		"passwd" => hash('whirlpool', $passwd) 
	];
	
	$resultat = $db->query('SELECT mail FROM user');
	while ($donnees = $resultat->fetch())
	{
		if ($donnees['mail'] == $tab['mail'])
		{
			echo"<p>Cette E-Mail existe deja\n</p>";
			$e = 1;
		}
	}
	
	$resultatlogin = $db->query('SELECT login FROM user');
	while ($donnees = $resultatlogin->fetch())
	{
		if ($donnees['login'] == $login)
		{
			echo"<p>Ce Login existe deja\n</p>";
			$e = 1;
		}
	}

	if ($e == 1)
		return(false);

	$stmt = $db->prepare("INSERT INTO user (login, password, mail, VALIDE, root) VALUES (:login, :password, :mail, :VALIDE, :root)");
	$stmt->bindValue(':login', $login, PDO::PARAM_STR);
	$stmt->bindValue(':password', $tab['passwd'], PDO::PARAM_STR);
	$stmt->bindValue(':mail', $tab['mail'], PDO::PARAM_STR);
	$stmt->bindValue(':VALIDE', 0, PDO::PARAM_INT);
	$stmt->bindValue(':root', 0, PDO::PARAM_INT);
	$stmt->execute();

	return(true);
}

function mod_user($login, $passwd, $va2){
	if($login == "" || $passwd == "" || $va2 == "")
	{
		return false;
	}
	else
	{
		
		$opasswd = $passwd;
		$npasswd = $va2;
		$hashopw = hash("sha512", $opasswd);
		$hashnpw = hash("sha512", $npasswd);
		$user["login"] = $login;
		$i = 0;
		
		$top_user = unserialize(file_get_contents("./resources/database/db_user"));
		if ($top_user) {
			foreach ($top_user as $arg)
			{
				if ($arg['login'] == $login){
					if(($arg['login'] == $login) && ($arg['passwd'] == $hashopw))
					{
						$top_user[$i]["passwd"] = $hashnpw;
						file_put_contents("./resources/database/db_user", serialize($top_user));
						return true;
					}
				}
				$i++;
			}
		}
		return false;
	}
}

function whoami($login){
	
}

function mod_root($login, $passwd){
	if($login == "" || $passwd == ""){
		return false;
	}
	else{
		
		$npasswd = $passwd;
		$hashnpw = hash("sha512", $npasswd);
		$user["login"] = $login;
		$i = 0;
		
		$top_user = unserialize(file_get_contents("./resources/database/db_user"));
		if ($top_user) {
			foreach ($top_user as $arg){
				if ($arg['login'] == $login){	
						$top_user[$i]["passwd"] = $hashnpw;
						file_put_contents("./resources/database/db_user", serialize($top_user));
						return true;
				}
				$i++;
			}
		}
		return false;
	}
}

?>
