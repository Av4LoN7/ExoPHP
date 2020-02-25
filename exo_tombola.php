<?php 
session_start();
require('Tombola_common.php');

if (isset($_GET['New'])) 
{
	unset($_SESSION['Tombola']);
	unset($_SESSION['Argent']);
	unset($_SESSION['TicketDispo']);
	$Page = $_SERVER['PHP_SELF'];
	header('location:' .$Page);
	exit();
}
if (isset($_GET['continuer'])) 
{
	unset($_SESSION['TicketDispo']);
	unset($_SESSION['Tombola']['Joueur']);
	unset($_SESSION['final']);
	header('location:' .$_SERVER['PHP_SELF']);
	exit();
}

// Je crée ma variable session qui contiendra les tickets du joueur //

if ( !isset($_SESSION['Tombola']['Joueur'])) 
{
	$_SESSION['Tombola']['Joueur'] = array ();
}

// je crée ma variable session qui contiendra les tickets à achetés //

if ( !isset($_SESSION['Tombola']['Ticket'])) 
{
	$_SESSION['Tombola']['Ticket'] = range(1, 100);
}
// je crée ma variable session argent du joueur // 

if ( !isset($_SESSION['Argent'])) 
{
	$_SESSION['Argent'] = ArgentDepart;
}


// je crée ma variable session Ticket disponible //

if ( !isset($_SESSION['TicketDispo'])) 
{
	$_SESSION['TicketDispo'] = TicketTotal;
}


if ($_SESSION['TicketDispo'] <= 0) 
{
	
	echo 'Il n\'y a plus de tickets disponible. Veuillez procédez au tirage ';
}

// je crée ma condition d'achat //

// qui me renvoie le N° des tickets Acheter

if (isset($_POST['nbrTickets']) ) 
{

	ChoixTicket($_SESSION['Tombola']['Ticket'], $_POST['nbrTickets'], $_SESSION['Tombola']['Joueur']);

		//echo 'Vos tickets sont : ' . implode(',', $_SESSION['Tombola']['Joueur']). '<br>';

		//print_r($_SESSION['Tombola']['Joueur']);

// J'actualise les tickets restant à jouer //

$_SESSION['Tombola']['Ticket'] = array_diff($_SESSION['Tombola']['Ticket'], $_SESSION['Tombola']['Joueur']);

}
// je deduit la somme sur ma cagnotte de départ //

if (isset($_POST['nbrTickets']) && $_POST['nbrTickets'] > 0  ) 
{
	$_SESSION['Argent'] = AchatTicket($_POST['nbrTickets']);

}

// Je deduit également le nobre de tickets disponible à l'achat //

if (isset($_POST['nbrTickets']) && $_POST['nbrTickets'] > 0 ) 
{
	$_SESSION['TicketDispo'] -= $_POST['nbrTickets'];

}

// le tirage //
// des 3 tickets gagnant aléatoirement //


// Comparaison avec les tickets acheté //



//print_r($tirage);
//print_r($_SESSION['Tombola']['Ticket']);
?>

<!-- Je crée un formulaire pour l'achat des tickets -->

<?php echo 'Vous avez une cagnote de ' . $_SESSION['Argent']. ' euros '; ?> <br>
<?php
 echo 'Le nombre de tickets disponible est de ' . $_SESSION['TicketDispo'];
 ?>

	<form method="POST" action="">
		<label for="achat" >Combien de tickets voulez vous acheter ?</label>
		<input id="Achat" type="number" name="nbrTickets" min="1" max="100">
		<input type="submit" name="valider">
	</form>

<a href="?Tirage">Lancer le tirage </a><br>
<a href="?New">Nouvelle partie </a><br>
<a href="?continuer">Continuer</a>
<?php 
	echo  '<br>';
	$_SESSION['tirage'] = array ();
	for ($i=0; $i < 3; $i++) 
	{ 
		$_SESSION['tirage'][] = array_rand($_SESSION['Tombola']['Ticket']);
	}
	$tirageFinal = array ();
	$tirageFinale = $_SESSION['tirage'];

	
	
		$_SESSION['final'] = array ();
		$_SESSION['final'] = array_intersect($_SESSION['tirage'], $_SESSION['Tombola']['Joueur']);
echo 'Vos tickets sont : ' . implode(',', $_SESSION['Tombola']['Joueur']). '<br>';


if (isset($_GET['Tirage'])) 
{
		echo  'les tickets gagnant sont :' . implode(' , ', $_SESSION['tirage'] ) . '<br/>';; 
if ( isset($_SESSION['final']) !== '') 
{

			if (isset($_SESSION['final'][0])) 
			{
				echo 'vous avez gagné 100 euros';
				$_SESSION['Argent'] += 100;
			}
			if (isset($_SESSION['final'][1])) 
			{
				echo 'vous avez gagné 50 euros';
				$_SESSION['Argent'] += 50;
			} 
			if (isset($_SESSION['final'][2])) 
			{
				echo 'vous avez gagner 20 euros';
				$_SESSION['Argent'] += 20;
			} 	
}
else
{
			echo 'dommage pas de chances';
}

}


?>