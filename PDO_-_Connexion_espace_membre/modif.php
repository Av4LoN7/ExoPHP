<?php
session_start();


echo 'Bienvenu sur la page de modification <br> ';

// gestion de l'affichage suivant si l'utilisateur est connecter et suivant son rang

if (!isset($_SESSION['access']) || $_SESSION['access']['rang'] =='') 
{
	echo strtoupper(' Vous n\'avez pas les droits suffisant pour visualiser cette page ');
	unset($_SESSION);
	header('refresh:3; url= Page_admin.php');
	exit();
}

if (isset($_SESSION['access']) && $_SESSION['access']['rang'] > 0 ) 
{
    // verification de l'envoi de données en POST
	if (isset($_POST) && count($_POST) > 0) 
{
    // verification des données reçus
	if ($_POST['ch_nom']!=='' && $_POST['ch_pnom']!==''  && $_POST['ch_id']!==''  && $_POST['ch_pass']!=='') 
	{
	
	try 
	{
	    // connexion PDO
			$connect = new PDO('mysql:host=localhost;dbname=administration;charset=utf8', 'root', '');
			// requete preparer
			if ( $start = $connect->prepare("UPDATE `user` SET `lastname`=:nom, `firstname`=:pnom, `login`=:log, `pwd`=:pass WHERE `id`=:id"))
			{
			    // assignation des paramatre + traitement des données
				if ($start->bindValue( ':nom', htmlentities( $_POST['ch_nom']) ) && $start->bindValue(':pnom', htmlentities($_POST['ch_pnom'])) && $start->bindValue(':log', htmlentities($_POST['ch_id'])) && $start->bindValue(':pass', htmlentities($_POST['ch_pass'])) && $start->bindValue(':id', htmlentities($_SESSION['access']['u_id'])) ) 
				{
					if ($start->execute()) 
					{

						echo ' <br> Modification effectuer !';
						// assigantion des nouvelle valeur en session
						$_SESSION['access']['nom'] = $_POST['ch_nom'];
						$_SESSION['access']['pnom'] = $_POST['ch_pnom'];
						$_SESSION['access']['id'] = $_POST['ch_id'];
						//$_SESSION['access']['pass'] = $_POST['ch_pass'];

						$start -> closeCursor();
						//redirection
						header('refresh:1; url= modif.php');
						exit();
					}
				}
				
			}	
	} 
	catch(Exception $e)
	{
		die(utf8_encode($e->getMessage()) );
	}
	} else
	{
	    // erreur
		echo 'Une erreur ses produite, <br> Veuillez recommencer...';
		header('refresh:1; url= modif.php');
		exit();
	}

}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>PAGE DE MODIFICATION</title>
	<meta charset="utf-8">
</head>
<body>

<form method="POST" action="">
	<input type="text" name="ch_nom" placeholder="Nom"> <br>
	<input type="text" name="ch_pnom" placeholder="Prenom"><br>
	<input type="text" name="ch_id" placeholder="Identifiant"><br>
	<input type="pass" name="ch_pass" placeholder="Mot de passe"><br>
	<input type="submit" name="valider">
</form>

<?php
echo ' PROFIL ACTUEL <br>';
echo 'NOM : '.$_SESSION['access']['nom'].'<br>';
echo 'PRENOM : '.$_SESSION['access']['pnom'].'<br>';
echo 'IDENTIFIANT : '.$_SESSION['access']['id'].'<br>';
//echo 'MOT DE PASSE : '.$_SESSION['access']['pass'].'<br>';
echo '<br>';
echo '<a href="access.php"> Revenir sur la page d\'administration </a>';

?>

</body>
</html>