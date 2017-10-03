<?php
// +-------------------------------------------------+
// � 2002-2004 PMB Services / www.sigb.net pmb@sigb.net et contributeurs (voir www.sigb.net)
// +-------------------------------------------------+

// param�tres d'acc�s � la base MySQL

// prevents direct script access
if(preg_match('/opac_db_param\.inc\.php/', $_SERVER['REQUEST_URI'])) {
	include('./forbidden.inc.php'); forbidden();
}

if (file_exists("../../../../common/config.inc.php")) { include("../../../../common/config.inc.php"); }
if (file_exists("../../../common/config.inc.php")) { include("../../../common/config.inc.php"); }
if (file_exists("../../common/config.inc.php")) { include("../../common/config.inc.php"); }
if (file_exists("../common/config.inc.php")) { include("../common/config.inc.php"); }


// inclure ici les tableaux des bases de donn�es accessibles
$_tableau_databases[0]=DB ;
$_libelle_databases[0]=DB ;
$DB=DB;

// pour multi-bases
if (!$database) {
	if ($_COOKIE["PhpMyBibli-OPACDB"]) $database=$_COOKIE["PhpMyBibli-OPACDB"];
	elseif ($_COOKIE["PhpMyBibli-DATABASE"]) $database=$_COOKIE["PhpMyBibli-DATABASE"];
	else $database=$_tableau_databases[0];
}
if (array_search($database,$_tableau_databases)===false) $database=$_tableau_databases[0];
define('LOCATION', $database) ;
$expiration = time() + 30000000; /* 1 year */
setcookie ('PhpMyBibli-OPACDB', $database, $expiration);

// define pour les param�tres de connection. A adapter.
switch(LOCATION):
	case 'remote':	// mettre ici les valeurs pour l'acc�s distant
		define('SQL_SERVER', 'remote');		// nom du serveur . exemple : http://sql.free.fr
		define('USER_NAME', 'username');	// nom utilisateur
		define('USER_PASS', 'userpwd');		// mot de passe
		define('DATA_BASE', 'dbname');		// nom base de donn�es
		define('SQL_TYPE',  'mysql');		// Type de serveur de base de donn�es
		break;
	case "$DB":
		define('SQL_SERVER', HOST);		// nom du serveur
		define('USER_NAME', USER);		// nom utilisateur
		define('USER_PASS', PWD);		// mot de passe
		define('DATA_BASE', DB);		// nom base de donn�es
		define('SQL_TYPE',  'mysql');			// Type de serveur de base de donn�es
		// Encode de caracteres de la base de donn�es 
		$charset = "iso-8859-1" ;
		break;
	default:		// valeurs pour l'acc�s local
		define('SQL_SERVER', HOST);		// nom du serveur
		define('USER_NAME', 'bibli');			// nom utilisateur
		define('USER_PASS', 'bibli');			// mot de passe
		define('DATA_BASE', 'bibli');			// nom base de donn�es
		define('SQL_TYPE',  'mysql');			// Type de serveur de base de donn�es
		break;
endswitch;

$dsn_pear = SQL_TYPE."://".USER_NAME.":".USER_PASS."@".SQL_SERVER."/".DATA_BASE ;
