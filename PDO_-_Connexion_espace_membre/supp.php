<?php
session_start();
// gestion de l'affichage suivant si l'utilisateur est connecter et suivant son rang
if (!isset($_SESSION['access']) || $_SESSION['access']['rang'] =='') 
{
	echo strtoupper(' Vous n\'avez pas les droits suffisant pour visualiser cette page ');
	unset($_SESSION);
	header('refresh:3; url= Page_admin.php');
	exit();
}
if (isset($_SESSION['access']) && $_SESSION['access']['rang'] >= 2) 
{
	echo 'Vous n\'etes pas autoriser à accèder à cette page';
	header('refresh:3; url= access.php');
	exit();
}

// si l'utilisateur est connecter et son rang == 1

if (isset($_SESSION['access']) && $_SESSION['access']['rang'] == 1) 
{
	try
	{
	    // connexion PDO et recuperation de tout les utiliasteurs en base de données

		$connect = new PDO('mysql:host=localhost;dbname=administration;charset=utf8', 'root', '');
			if (($start = $connect->query('SELECT * FROM `user`') ) ) 
			{
					$delete = $start -> fetchAll(PDO::FETCH_ASSOC);
					
			}
	}
	catch(Exception $e)
	{
		die(utf8_encode($e->getMessage()) );
	}
}
// si l'utilisateur envoie une requete de suppression en post
if (isset($_POST['delete']) && $_SESSION['access']['rang'] == 1) 
{
	try
	{
	    // connexion base de données et suppression de l'utilisateur selectionner
		$connect = new PDO('mysql:host=localhost;dbname=administration;charset=utf8', 'root', '');
		if ( $start = $connect->prepare("DELETE FROM `user` WHERE `id` =:u_id"))
        {
            if( $start->bindValue( 'u_id', htmlentities($_POST['delete']) ) )
            {
                    if ($start->execute())
                    {
                        echo 'Suppression effectuer !' ;
                        $start->closeCursor();
                        header('refresh:1; url= supp.php');
                        exit();
                    }
            }
        }
	}
	catch(Exception $e)
	{
		die(utf8_encode($e->getMessage()) );
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAGE DE SUPPRESSION</title>
</head>
<body>
<h2>Qui voulez vous supprimer ?</h2>
<form method="POST" action="">
<select name="delete">
<?php
// affichage de tout les utilisateurs present en base de données
		foreach ($delete as $value) 
		{
			echo '<option value="'.$value['id'].'">'.$value['lastname'].' - ' . $value['firstname']. '</option>';
		}
?>
<input type="submit" name="valider">
</select>
</form>
<a href="access.php"> <br> Retour sur la page d'administration </a>
</body>
</html>