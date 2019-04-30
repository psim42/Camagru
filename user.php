<?php

function auth($login, $passwd){
	$opasswd = $passwd;
	$hashopw = hash("sha512", $opasswd);
	$user["login"] = $login;

	$top_user = unserialize(file_get_contents("./resources/database/db_user"));
	if ($top_user) {
		foreach ($top_user as $arg)
		{
			if ($arg['login'] == $login){
				if(($arg['login'] == $login) && ($arg['passwd'] == $hashopw))
				{
					return(true);
				}
			}
		}
	}
	return(false);
}

function create_user($login, $passwd){
	if($login == "" || $passwd == "")
	{
		return false;
	}
	else
	{
		$hashpw = hash("sha512", $passwd);
		$user["login"] = $login;
		$user["passwd"] = $hashpw;

		if (file_exists("./resources/database/db_user"))
			$top_user = unserialize(file_get_contents("./resources/database/db_user"));
		if ($top_user) {
			foreach ($top_user as $arg)
			{
				if ($arg['login'] == $login)
				return false;
			}
		}
		$top_user[] = $user;
		file_put_contents("./resources/database/db_user", serialize($top_user));
		return true;
	}
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

function is_there($login){
	if($login == "")
	{
		echo "ERROR\n";
	}
	else
	{
		$user["login"] = $login;

		if (file_exists("./resources/database/db_user"))
			$top_user = unserialize(file_get_contents("./resources/database/db_user"));
		if ($top_user) {
			foreach ($top_user as $arg)
			{
				if ($arg['login'] == $login)
					return true;
			}
		}
		return false;
	}
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
