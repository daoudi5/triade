<?php
// +-------------------------------------------------+
// � 2002-2004 PMB Services / www.sigb.net pmb@sigb.net et contributeurs (voir www.sigb.net)
// +-------------------------------------------------+

// param�tres d'acc�s � la base MySQL
// param�tres d'acc�s � la base MySQL
if (file_exists("../common/config.inc.php")) { include_once("../common/config.inc.php"); }
if (file_exists("../../common/config.inc.php")) { include_once("../../common/config.inc.php");}
if (file_exists("../../../common/config.inc.php")) { include_once("../../../common/config.inc.php"); }
if (file_exists("../../../../common/config.inc.php")) { include_once("../../../../common/config.inc.php"); }
if (file_exists("../../../../../common/config.inc.php")) { include_once("../../../../../common/config.inc.php"); }
if (file_exists("../../../../../../common/config.inc.php")) { include_once("../../../../../../common/config.inc.php"); }
if (file_exists("../../../../../../../common/config.inc.php")) { include_once("../../../../../../../common/config.inc.php"); }

$base=DB;


// prevents direct script access
if(preg_match('/db_param\.inc\.php/', $_SERVER['REQUEST_URI'])) {
	include('./forbidden.inc.php'); forbidden();
	}
// inclure ici les tableaux des bases de donn�es accessibles
$_tableau_databases[0]="$base" ;
$_libelle_databases[0]="$base" ;

// pour multi-bases
if ($database) {
	define('LOCATION', $database) ;
	} else {
		if (!$_COOKIE["PhpMyBibli-DATABASE"]) define('LOCATION', $_tableau_databases[0]);
			else define('LOCATION', $_COOKIE["PhpMyBibli-DATABASE"]) ;
		}

// define pour les param�tres de connection. A adapter.
switch(LOCATION):
	case 'remote':	// mettre ici les valeurs pour l'acc�s distant
		define('SQL_SERVER', HOST);		// nom du serveur . exemple : http://sql.free.fr
		define('USER_NAME', USER);	// nom utilisateur
		define('USER_PASS', PWD);		// mot de passe
		define('DATA_BASE', "essai");		// nom base de donn�es
		define('SQL_TYPE',  DBTYPE);		// Type de serveur de base de donn�es
		break;
	case 'pmb':
		define('SQL_SERVER', HOST);		// nom du serveur
		define('USER_NAME', USER);		// nom utilisateur
		define('USER_PASS', PWD);		// mot de passe
		define('DATA_BASE', "essai");		// nom base de donn�es
		define('SQL_TYPE',  DBTYPE);			// Type de serveur de base de donn�es
		// Encode de caracteres de la base de donn�es 
		$charset = "iso-8859-1" ;
		break;
	default:		// valeurs pour l'acc�s local
		define('SQL_SERVER', HOST);		// nom du serveur
		define('USER_NAME', USER);			// nom utilisateur
		define('USER_PASS', PWD);			// mot de passe
		define('DATA_BASE', "essai");			// nom base de donn�es
		define('SQL_TYPE',  DBTYPE);			// Type de serveur de base de donn�es
		break;
endswitch;

$dsn_pear = SQL_TYPE."://".USER_NAME.":".USER_PASS."@".SQL_SERVER."/".DATA_BASE ;

?>
