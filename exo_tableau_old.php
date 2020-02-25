<?php 
session_start();

/**
*Fonction moyenne: qui fait la moyenne de deux nombres
*@param int 
*@param int
*@return int
**/

function moyenne($a, $b)
{		
	if ($a == 0 || $b == 0) 
	{
		return '<br> Division par 0 impossible !';
	} 
	else 
	{
		return $a / $b ;
	}
	
}


		if (isset($_POST['eleve']) && count($_POST['eleve']) > 0 ) 
{
	$_SESSION['eleve'] = $_POST['eleve'];
}
		if (isset($_POST['note']) && count($_POST['note']) > 0) 
{
	$_SESSION['note'] = $_POST['note'];

}

$_SESSION['tabEleve'] = array ();
$_SESSION['somme'] = 0;


		for ($i=0; $i < $_SESSION['eleve']; $i++) 
{ 
	$_SESSION['tabEleve'][$i] = $_SESSION['note'] ++;
	$_SESSION['somme'] += $_SESSION['tabEleve'][$i];

}


print_r($_SESSION['tabEleve']);

echo '<br> Le nombre d\'élève est de : ' .$_SESSION['eleve'];
echo '<br> La somme des notes est : ' . $_SESSION['somme'];
echo '<br> la moyenne de la classe est de : ' . moyenne($_SESSION['somme'], $_SESSION['eleve']);
?>

<br>

<hr>

<form method="POST" action="" name="eleve">
		<label for="eleve">Combien avez vous d'élèves ? : </label>
				<input id="eleve" type="number" name="eleve" min="0">
				<input type="submit" name="valider"> <br>
</form>

<form method="POST" action="" name="note">
	<label for="note">Veuillez entrer leurs notes SVP : </label>
				<input id="note" type="number" name="note" min="0">
				<input type="submit" name="valider">
</form>

<hr>

<h2>Tri par minimum successif </h2>

<?php 

/**
** fonction qui inverse deux valeurs quelconque fournis en parametre avec un 3eme parametres servant de stokcage temporaire.
*@param int/string/etc
*@param int/string/etc
*@param $c temporaire / declarée automatiquement au sein de la fonction
*@return int/string/etc inverser
**/

function inverser(&$a, &$b) // [&] = Entrer/sortie; afin de pouvoir modifier les valeurs au sein du tableau et les afficher..
{
		$c = $a;
		$a = $b;
		$b = $c;
}

/**
*fonction de tri par minimum successif. Au sein d'un tableau qu'il va parcourir intégralement, la fonction va comparer deux elements numerique du tableau et les inverser, si l'un est plus grand que l'autre et ainsi de suite.(avec une fonction "inverser" declarer au préalable)
*@param array
*@return array (inverser)
**/

function triMinSuccessif(&$tab)
{

		for ($i = 0; $i < count($tab) ; $i++) 
{
   			for ($j = $i +1 ; $j < count($tab); $j++ ) 
   		{		
      			if ( $tab[$i] > $tab[$j] ) 
      		{
        		inverser($tab[$i], $tab[$j]);
      		}
   		}
}

}

$tabNote = array(12,14,14,8,19,12,11,8,18,5,7,7,18,9,16,17);

print_r($tabNote);
echo '<br>';

triMinSuccessif($tabNote);
print_r($tabNote);
echo '<br>';

// avec la fonction \sort/ de php :

sort($tabNote);
print_r($tabNote);

?>
<hr>