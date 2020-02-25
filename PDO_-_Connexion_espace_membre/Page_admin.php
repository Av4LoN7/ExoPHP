<?php
if (isset($_SESSION['access'])) 
{
	unset($_SESSION['access']);
}
include('common_admin.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>PAGE DE CONNEXION</title>
	<meta charset="utf-8">
	<style type="text/css">
		<!--
			body
			{
				background-color: #ccccb3;
			}

			.form
			{
				height: 80px;
				vertical-align: center;
				padding-top: 4%;
				text-align: center;
				margin-top: 350px; 
				border: 1px dotted black;
			}

		-->
	</style>
</head>
<body>
<div class="accueil">
<form class="form" method="POST" action="">
	<input type="text" name="id" placeholder=" Identifiant " style="text-align: center; color: black;">
	<input type="password" name="pass" placeholder=" Mot de passe" style="text-align: center; color: black;">
	<input type="submit" name="valider">
</form>
</div>
</body>
</html>
