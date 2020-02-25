<?php
session_start(); // activation de la session

if (!isset($_SESSION['access'])) 
{
	$_SESSION['access'] = array ();
}

// verification des variables reçus en POST
if (isset($_POST['id']) && $_POST['id'] !=='' && isset($_POST['pass']) && $_POST['pass'] !=='') 
{
    // assignation de l'id et du mot de pass en session
		$_SESSION['access']['id'] = $_POST['id'];
		$_SESSION['access']['pass'] = $_POST['pass'];
	try
	{
	        // connexion bdd via objet PDO
			$connect = new PDO('mysql:host=localhost;dbname=administration;charset=utf8', 'root', '');
			// requète preparer objet PDO
			if (($start = $connect->prepare('SELECT * FROM `user` WHERE `login` =:id AND `pwd`=:pass') ) !==false)
			{
			    // assignantion des parametres + traitement des données envoyés
				if( $start->bindValue( ':id', htmlentities( $_SESSION['access']['id'] ) ) && $start->bindvalue(':pass', htmlentities($_SESSION['access']['pass'])) )
				{
				    // execution de la requete
						if ($start->execute() && $user = $start->fetchAll(PDO::FETCH_ASSOC) )
						{
						    //  assignation des infos de l'utilisateur en session si la requète réussie
							foreach ($user as $value)
							{
									if ($_SESSION['access']['id'] === ($value['login']) && $_SESSION['access']['pass'] === ($value['pwd']))
								{
										$_SESSION['access']['rang'] = $value['id_role'];
										$_SESSION['access']['nom'] = ($value['firstname']);
										$_SESSION['access']['pnom'] = ($value['lastname']);
										$_SESSION['access']['u_id'] = $value['id'];
										// unset du mot de passe stocké en session
										unset($_SESSION['access']['pass']);
										// redirection
										header('location: access.php');
										exit();
								}
							}
						}
						else
                        {
                            // erreur

                            echo "La requete à échouer, veuillez réessayer";
                        }
				} 
				else
				{
				    // erreur
					echo 'Le couple identifiant / Mot de passe est incorrect';
				}
				
			}
	} // gestion exception de pdo
	catch(PDOException $e)
	{
		die(utf8_encode($e->getMessage()) );
	}
}

?>