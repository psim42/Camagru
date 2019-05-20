<?php
include '../../controller/manage/change_login.php';


?>

<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Change Email</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/extern.css">
</head>
<body>
	<div id="center" style="color: black;">
		<h1>Change your Login <h1>
		<form id='manage.php' name="manage.php" action='manage_login.php' method='post' accept-charset='UTF-8'>
			<input class="text" placeholder="New Login" type="login" name="newlogin" value="" />
			<input class="text" placeholder="Confirmation" type="login" name="newloginconf" value="" />
			<br />
			<input class="text" placeholder="Password" type="password" name="password" value="" />
			<input type="submit" name="submit" value="OK"/>
		</form>
		<a href="../../index.php"><button type="button" >Index</button></a>
		<a href="manage.php"><button type="button" >Back</button></a>
	</div>
</body>
</html>
