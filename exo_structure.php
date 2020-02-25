<?php 
session_start();
?>

<!DOCTYPE html>
<html>

<head>

	<title>Reprise exo structure</title>
	<meta charset="utf-8">

</head>

<body>

		<h2>Ecrire un programe d'inversion de valeur</h2>

<?php 

/**
** fonction qui inverse deux valeurs quelquonque fournis en parametre avec un 3eme parametre qui sert de stokcage temporaire.
*@param int/string/etc
*@param int/string/etc
*@return int/string/etc inverser
**/

function inverser($a, $b) 
{
		$c = $a;
		$a = $b;
		$b = $c;

		return $a . ' / ' . $b; // declaration return non obligatoire suivant l'usage (fonction / Procédure)
}

// test de la fonction :

$a = 35;
$b = 42;

echo 'la premiere valeur est de :' .$a . '<br>';
echo 'la seconde valeur est de :' .$b . '<br>';

echo ' <br> le resultat inverser est : ' . inverser($a, $b);
?>

<hr>

		<h2>Ecrire un programme qui indique que le produit de deux nombres est positif ou négatif</h2>

<?php

/**
*fonction qui verifie et indique si le produit de deux nombres (fournie par l'utilisateur) est positif ou négatif + le resultat du produit :)
*@param int (positif ou négatif)
*@param int (positif ou négatif)
*@return int + string
**/

function produit($a, $b)
{
	

	if ( isset($_POST['chiffre1']) && isset($_POST['chiffre2']) ) 
{
			$a = $_POST['chiffre1'];
			$b = $_POST['chiffre2'];

			if ( ($a < 0 && $b< 0) || ($a >= 0 && $b >= 0) ) 

// ternaire : if ( ($a < 0 && $b< 0) || ($a >= 0 && $b >= 0) ) ? return 'resultat : ' . ($a * $b) . '<br> le produit de ces deux nombres est positif ! '; : return  'resultat : ' . ($a * $b) . '<br> le produit de ces deux nombres est négatif ' ;
		{
				//return 'resultat : ' . ($a * $b) . '<br>'; Je ne peux pas faire deux return à la suite apparemment, l'un ecrasant l'autre...
				return 'resultat : ' . ($a * $b) . '<br> le produit de ces deux nombres est positif ! '; 
		}
			else
		{
				//return 'resultat : ' . ($a * $b) . '<br>';
				return  'resultat : ' . ($a * $b) . '<br> le produit de ces deux nombres est négatif ' ;
		}
}

}

?>

<form method="POST" action="">
	<label for="chiffre1">Entrez votre premier chiffre positif ou négatif : </label>
	<input id="chiffre1" type="number" name="chiffre1"><br>
	<label for="chiffre2">Entrez votre second chiffre positif ou négatif : </label>
	<input id="chiffre2" type="number" name="chiffre2"><br>
	<input type="submit" name="valider">
</form>

<?php

		if( !isset($_POST['chiffre1'])  ||  !isset($_POST['chiffre2'])  )
	{
				echo ' Veuillez entrez un chiffre SVP ';
	}

		if ( isset($_POST['chiffre1']) && isset($_POST['chiffre2']) )
	{
			echo produit($_POST['chiffre1'], $_POST['chiffre2']);
	}
?>

<hr>

		<h2>Plus petit ou plus grand</h2>

<?php

/**
*fonction qui verifie si le chiffre entré par l'utilisateur est plus petit que 10 ou plus grand que 20 :)
*@param int 
*@return string
**/

function tropGrandTropPetit($a) 

{
		if ( ! isset($_POST['numChoice']) || isset($_POST['numChoice']) == '') 
{
			return ' Pas de chiffre pas de jeux ! ';
}

		if (isset($_POST['numChoice'])) 
{
			$a = $_POST['numChoice'];
}

if ($a < 10) 
{
	return ' plus grand voyons ';
}			elseif ($a > 20) 
		{
					return ' plus petit mon grand !' ;
		} 
			else 
				{
					return ' Bravo bien joué ! ';
				}
				
}				

?>

<form method="POST" action="">
		<label for="Num">Veuillez entrez un chiffre : </label>
		<input id="Num" type="number" name="numChoice" min="0">
		<input type="submit" name="Valider" value="Valider votre chiffre">	
</form>

<?php 

		if (isset($_POST['numChoice'])) 
	{
		echo tropGrandTropPetit($_POST['numChoice']);
	}
?>
<hr>

</body>

</html>