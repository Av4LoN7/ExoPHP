<?php 
session_start();
if (isset($_SESSION['access']) && $_SESSION['access']['rang'] == 1) 
{
	echo strtoupper('Page en cours de construction ... Veuillez patienter ');
	//unset($_GET);
	header('refresh:3; url= access.php');
	exit();
}

if ( isset($_SESSION['access']) && $_SESSION['access']['rang'] == 2) 
{
	echo strtoupper('Page en cours de construction ... Veuillez patienter ');
	//unset($_GET);
	header('refresh:3; url= access.php');
	exit();
}

if (isset($_SESSION['access']) && $_SESSION['access']['rang'] >= 3 ) 
{
	echo strtoupper(' Vous n\'avez pas les droits suffisant pour visualiser cette page ');
	header('refresh:3; url= access.php');
	exit();
}
if (!isset($_SESSION['access']) || $_SESSION['access']['rang'] =='') 
{
	echo strtoupper(' Vous n\'avez pas les droits suffisant pour visualiser cette page ');
	unset($_SESSION);
	header('refresh:3; url= Page_admin.php');
	exit();
}

?>