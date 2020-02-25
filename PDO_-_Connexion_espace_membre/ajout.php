<?php 
session_start();

echo 'Bienvenu sur la page d\'ajout ';

// gestion de l'affichage suivant si l'utilisateur est connecter ou non

/*if (isset($_SESSION['access']) && $_SESSION['access']['rang'] >= 3)
{
	echo 'Vous n\'etes pas autoriser à accèder à cette page';
	header('refresh:3; url= access.php');
	exit();
}

if (!isset($_SESSION['access']) || $_SESSION['access']['rang'] =='') 
{
	echo strtoupper(' Vous n\'avez pas les droits suffisant pour visualiser cette page ');
	unset($_SESSION);
	header('refresh:3; url= Page_admin.php');
	exit();
}*/
// affichage des options disponibles suivant le rang utilisateur

if (isset($_SESSION['access']) && $_SESSION['access']['rang'] == 1) 
{
		echo '
				<h1>Veuillez remplir les champs : </h1>

<form method="POST" action=""> 
		<input type="text" name="nom"> NOM <br>
		<input type="text" name="pnom"> PRENOM <br>
		<input type="text" name="log"> LOGIN <br>
		<input type="password" name="pass"> MOT DE PASSE <br>
		<h3>Rang utilisateur</h3>
				<select name="rang">
					<option value="1">Super Admin</option>
					<option value="2">Admin</option>
					<option value="3">Invité</option>
				</select>
		<input type="submit" value="valider">
</form>
			';
}
	
if (isset($_SESSION['access']) && $_SESSION['access']['rang'] == 2) 
{
		echo '
				<h1>Veuillez remplir les champs : </h1>

<form method="POST" action=""> 
		<input type="text" name="nom"> NOM <br>
		<input type="text" name="pnom"> PRENOM <br>
		<input type="text" name="log"> LOGIN <br>
		<input type="password" name="pass"> MOT DE PASSE <br>
		<h3>Rang utilisateur</h3>
				<select name="rang">
					<option value="1">Super Admin</option>
					<option value="2">Admin</option>
					<option value="3">Invité</option>
				</select>
		<input type="submit" value="valider">
</form>
			';	
}

// gestion sql pour l'ajout d'un nouvel utilisateur
if (isset($_POST) && count($_POST) > 0) 
{
    // verification de la presence des données
	if ($_POST['nom']!=='' && $_POST['pnom']!==''  && $_POST['log']!==''  && $_POST['pass']!==''  && $_POST['rang']!=='') 
	{
        try
        {
            // connexion PDO
            $connect = new PDO('mysql:host=localhost;dbname=administration;charset=utf8', 'root', '');
            // requete preparer
            if ( $start = $connect->prepare("INSERT INTO `user`(`lastname`,`firstname`, `login`, `pwd`, `id_role`) VALUES (:nom, :pnom, :log, :pass, :rang)"))
            {
                // assignation des parametre + traitements des données envoyé
                if ($start->bindValue( ':nom', htmlentities( $_POST['nom'] ) ) && $start->bindValue(':pnom', htmlentities($_POST['pnom'])) && $start->bindValue(':log', htmlentities($_POST['log'])) && $start->bindValue(':pass', htmlentities($_POST['pass'])) && $start->bindValue(':rang', htmlentities($_POST['rang'])) )
                {
                    if ($start->execute())
                    {
                        echo ' <br> Modification effectuer !';
                        $start -> closeCursor(); // fermeture de la connexion pdo
                        //redirection
                        header('refresh:1; url= ajout.php');
                       exit();
                    }
                    else
                    {
                        echo "test2";
                        $start->errorInfo();
                    }
                }
            }
        }
        catch(Exception $e)
        {
            die(utf8_encode($e->getMessage()) );
            //echo $e->getMessage();
        }
	}
	else
	{
	    // erreur
		echo 'Une erreur ses produite, Veuillez recommencer...';
		header('refresh:1; url= ajout.php');
		exit();
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PAGE D'AJOUT UTILISATEUR </title>
	<meta charset="utf-8">
</head>
<body>
<br>
<a href="access.php">Retour sur la page d'administration </a>

</body>
</html>