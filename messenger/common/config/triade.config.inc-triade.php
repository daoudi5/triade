<?php
/*******************************************************
 **                  IntraMessenger 				          **
 **                                                   **
 **  Copyright:         (C) 2007 - 2008 THeUDS        **
 **  Web:               http://www.theuds.com         **
 *******************************************************/

/*******************************************************
 **       This file is part of IntraMessenger.        **
 **                                                   **
 **  IntraMessenger is free software.  			          **
 **  IntraMessenger is distributed in the hope that   **
 **  it will be useful, but WITHOUT ANY WARRANTY.     **
 *******************************************************/


## Parametre Mysql pour que l'authentification se passe via l'application triade

## [FR] laisser vide si paramètres identiques à ceux d'IntraMessenger
## [EN] keep empty if parameters same IntraMessenger (same database).


# Mysql Database host (généralement : "localhost")

$pers="X";
$eleve="X";
include_once("../../common/config.inc.php");

if (file_exists("../../common/config-messenger.php")) {
	include_once("../../common/config-messenger.php");
	if (MESSENGERPERS == "oui") { $pers=""; }
	if (MESSENGERELEV == "oui") { $eleve=""; }
	
}
 
$extern_dbhost    = HOST;

# Mysql Database
$extern_database  = DB;

# Mysql user
$extern_dbuname   = USER;                

# Mysql pass :
$extern_dbpass    = PWD;

# Table prefix :
$table_prefix     = PREFIXE;

# Phenix table prefix :
$phenix_table_prefix     = "tria_px_";


# Only school (seulement le personnel scolaire) :
$do_not_use_student = "$pers";  

# OR (OU)

# Only student (seulement les élèves) :
$do_not_use_school_members = "$eleve";  


?>
