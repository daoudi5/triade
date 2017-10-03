<?php

include_once("./common/config.inc.php");


function db_connect()	//retourne l'identifiant de connexion ou FAUX
{
	
  $machine=HOST;
  $login=USER;
  $password=PWD;
  $db = mysql_connect($machine,$login,$password) or die('Erreur de connexion avec la Base de Donnée');  // connexion à la base 
  if ($db && mysql_select_db(DB,$db) )
		return($db); 
  else
	  echo "Erreur de connexion avec la Base de Donnée";
}

?>
