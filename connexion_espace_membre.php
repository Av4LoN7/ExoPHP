<?php 
session_start();
$page ='Reprise_exo_connexion_membre.php';
if ( ( isset($_POST['Identif']) == "" ) && ( isset($_POST['Pwd']) == '')) 
{
	echo 'Identifiant ou mots de passe incorrect !';
	header('location :' . $page );

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion espace securisé</title>
	<meta charset="utf-8">
</head>
<body>


<form method="POST" action="member_secure.php">
	<label for="Identifiant">Veuillez entrer vos identifiants : </label>
	<input id="Identifiant" type="text" name="Identif"><br>
	<label for="Password">Veuillez entrer votre mots de passe :</label>
	<input id="Password" type="password" name="Pwd">
	<input type="submit" name="Valider">
</form>

</body>
</html>