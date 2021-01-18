<?php

// Configuration MariaDB

/*define("MYHOST", "localhost");
define("MYUSER", "gmao");
define("MYPASS", "*Fs4>B(h58Sd");
define("MYBASE","gmao_dev");*/
define("MYHOST", "localhost");
define("MYUSER", "root");
define("MYPASS", "root");


// HTTP_HOST: contenu de l'en-tête c'est la requête courante
$urlAccueil=$_SERVER['HTTP_HOST']."/index.php";
$urlAccueilErr=$_SERVER['HTTP_HOST']."/index.php?message_erreur=Merci de vérifier votre login/mot de passe";
$urlMenu=$_SERVER['HTTP_HOST']."/menu.php";

//clé de session
$_SESSION['global_oc_apikey']="macleapiacontroler_partie1".date("dmY")."macleapiacontroler_partie2";


$adresse_site="https://intranet.groupe-upperside.com/";
$societe="UPPERSIDE CAPITAL PARTNERS®";

//Récuperation date suivant appareil
function isMobileBrowser()
	{
		return strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'Android');
	}
?> 