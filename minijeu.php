<?php
session_start();

if (isset($_GET['new'])) 
{	unset($_SESSION['mini']['historique']);
	unset($_SESSION['mini']['rand']);
	$page = $_SERVER['PHP_SELF'];
	header('location:' .$page);
	exit();
}
// var_dump($_GET['new']);
/*function nbrRand()
{
	$rand = rand(1,100);
	return $rand;
}*/

if (! isset($_SESSION['mini']['rand'])) 
{
	$_SESSION['mini']['rand'] = rand(1,100);
}

if (isset($_SESSION['mini']['rand']) && isset($_POST['nbrJoueur'])) 
{
	echo 'le nombre à trouver est :' . $_SESSION['mini']['rand'];
}


if (isset($_POST['nbrJoueur']) && is_numeric($_POST['nbrJoueur']) && $_POST['nbrJoueur'] > 0 )
{
	if ($_POST['nbrJoueur'] > $_SESSION['mini']['rand'])  
	{
		echo '<br> Votre chiffre est trop grand ! ';
	}
	if ($_POST['nbrJoueur'] < $_SESSION['mini']['rand'])  
	{
		echo '<br> Votre chiffre est trop petit ! ';
	}
	else
	{
		echo ' <br> Bravo vous avez gagné ! ';
	}
	$_SESSION['mini']['historique'][] = $_POST['nbrJoueur'];
}



?>
<form method="POST" action ="">
	<label for="miniJeu"> Votre chiffre : </label>
	<input id="miniJeu" type="number" name="nbrJoueur">
	<input type="submit" name="Valider">
</form>



<?php
if (isset($_SESSION['mini']['historique'])) 
{
	foreach ($_SESSION['mini']['historique'] as $key => $value) 
	{
		echo '<br> Votre choix : ' . ($key + 1 ). ' / ' . $value;
	}
}

?>
<br>
<a href="?new" title="" >Nouvelle partie ? </a>