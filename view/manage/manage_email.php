<?php
include '../../controller/manage/change_email.php';


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
		<h1>Change your Email <h1>
		<form id='manage.php' name="manage.php" action='manage_email.php' method='post' accept-charset='UTF-8'>
			<input class="text" placeholder="New E-mail" type="email" name="newemail" value="" required=""/>
			<input class="text" placeholder="E-mail confirmation" type="email" name="newemailconf" value="" required=""/>
			<br />
			<input class="text" placeholder="Password" type="password" name="password" value="" required=""/>
			<input type="submit" name="submit" value="OK"/>
		</form>
		<a href="../../index.php"><button type="button" >Index</button></a>
		<a href="manage.php"><button type="button" >Back</button></a>
	</div>
</body>
</html>
