<?php
session_start();

$donnees = array(
array('lettre' => 'a', 'suivant' => 10),
array('lettre' => 'e', 'suivant' => -1),
array('lettre' => 'e', 'suivant' => 6),
array('lettre' => 'l', 'suivant' => 1),
array('lettre' => 'p', 'suivant' => 8),
array('lettre' => 'o', 'suivant' => 11),
array('lettre' => 'x', 'suivant' => 12),
array('lettre' => 'p', 'suivant' => 3),
array('lettre' => 'r', 'suivant' => 5),
array('lettre' => 'm', 'suivant' => 7),
array('lettre' => 'b', 'suivant' => 3),
array('lettre' => 'b', 'suivant' => 0),
array('lettre' => 'a', 'suivant' => 9)
);

/**
*fonction qui permet de construire un mot à partir d'un index de départ dans le tableau
*@param   array  
*@param   int     
*@return  string
**/

function choixLettre($tab, $num)
{	
		$lettre = ''; // indique vide au lancement. Et évite une erreur de variable non definie.
	do 
	{
		$lettre .= $tab[$num]['lettre']; // Ne pas oublier que c'est l'operateur " .= " qui permet de resoudre l'enoncer car c'est lui qui permet d'afficher côte à côte le contenu des diffèrents index du tableau $num !
		$num = $tab[$num]['suivant'];
	}
		while ($num != -1);
		return $lettre;
}


echo choixLettre($donnees, 8);
?>

<br>

<hr>

<?php

include('data.php');

//print_r($story);

/**
*fonction qui affiche le texte d'un chapitre à un index donné.
*@param array
*@param int (numéro du chapitre)
*@return string
**/

function choixChap($tab, $numChap)
{
	return $tab[$numChap]['texte'];
}


		if (! isset($_SESSION['chapter'])) 
	{
			// echo choixChap($story, 0); Ceci ne fonctionne car je doit définir une valeur de depart à $_SESSION['chapter'] | == $story[0]['texte']
	 		$_SESSION['chapter'] = 0;
	}
		if (isset($_POST['choix'])) 
	{
			$_SESSION['chapter'] = $_POST['choix'];
	}

echo choixChap($story, $_SESSION['chapter']);

?>

<form method="POST" action="">
		<select name="choix">

			<?php 
				foreach( $story[$_SESSION['chapter']]['choix'] as $value ) 
				{
					echo ' <option value ="'. $value['page'] . '">' . $value['texte'] . '</option>';
				}
			?>
		</select>

		<input type="submit" name="valider">
</form>

<br>

<hr>