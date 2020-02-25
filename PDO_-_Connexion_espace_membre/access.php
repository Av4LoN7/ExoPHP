<?php
session_start();

if (isset($_GET['destroy'])) 
{
	unset($_SESSION['access']);
	header('location: Page_admin.php');
	exit();
}

if (count($_SESSION['access']) > 0) 
{
	// s'affiche seulement si l'utilisateur est connecter
		if (isset($_SESSION['access']['id']) && $_SESSION['access']['id'] !=='')
		{ 
			echo '<h2> BIENVENU SUR VOTRE ESPACE PERSONNEL <br> '. htmlentities(strtoupper($_SESSION['access']['nom'])) .' '. htmlentities(strtoupper($_SESSION['access']['pnom'])). '</h2> ';
			// affichage des options suivant le rang utilisateur
			switch ($_SESSION['access']['rang']) 
			{
				case 1:
					echo ' <br> <span class="log"> [ SUPER ADMIN ] </span><hr> <br/>Votre tableau de bord :   <br>
					<ul class="super">
					<li><a href="approb.php">Approbation</a></li>
					<hr>
					<li><a href="supp.php">Suppression</a></li>
					<hr>
					<li><a href="ajout.php">Ajout</a></li>
					<hr>
					<li><a href="modif.php?">Modification</a></li>
					<hr>
					<li><a href="edit.php">Edition</a></li>
					</ul>
					'; 
					break;
				
				case 2:
					echo '  <br> <span class="log"> [ ADMIN ] </span><hr> <br/>Votre tableau de bord :  <br>
					<ul class="adm">
					<li><a href="approb.php">Approbation</a></li>
					<hr>
					<li><a href="ajout.php">Ajout</a></li>
					<hr>
					<li><a href="modif.php?">Modification</a></li>
					<hr>
					<li><a href="edit.php">Edition</a></li>
					</ul>
					'; 
					break;

				case 3:
					echo ' <br> <span class="log"> [ INVITE ] </span><hr> <br/>Votre tableau de bord :   <br>
					<ul class="invit">
					<li><a href="modif.php?">Modification</a></li>
					<hr>
					<li><a href="edit.php">Edition</a></li>
					</ul>
					'; 
					break;

				default:
					echo 'Erreur veuillez patienter ... ';
					header('location: Page_admin.php');
					exit();
					break;
			}
		}
}

?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	<!--
		.super 
		{
			background-color: #33ccff;
			color: #ffffff;
			width: 50%;
		}
		.adm
		{
			background-color: #00ff00;
			color: #ffffff;
			width: 50%;
		}
		.invit
		{
			background-color: #6699ff;
			color: #ffffff;
			width: 50%;
		}
		a
		{
			text-decoration: none;
			color: white;
		}

		.log 
		{
			background-color:  #cccccc;
		}
		h2
		{
			text-align: center;
			background-color: #d2a679;
		}
		.none
		{
			display: inline-block;
			color: black;
			border: 1px solid black;
			border-radius: 10px;
			background-color:  #cccccc;
			width: 10%;
			height: auto;
			text-align: center;
		}
		body
		{
			background-color:  #ccccb3;
		}
		footer
		{
			/*display: block;*/
			padding-top: 300px;
			text-align: center;
			
			
		}
	-->
	</style>
	<meta charset="utf-8">
	<title>PAGE PERSONNELLE</title>
</head>
<body>
<br/>
<hr>
<a class="none" href="?destroy"> Déconnexion </a>
<footer>
</footer>
</body>
</html>