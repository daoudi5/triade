<?php  /// Moodle Configuration File 

unset($CFG);
if (file_exists('../common/config.inc.php')) include('../common/config.inc.php');
if (file_exists('../../common/config.inc.php')) include('../../common/config.inc.php');
if (file_exists('../../../common/config.inc.php')) include('../../../common/config.inc.php');
if (file_exists('../../../../common/config.inc.php')) include('../../../../common/config.inc.php');
if (file_exists('../../../../../common/config.inc.php')) include('../../../../../common/config.inc.php');
if (file_exists('../../../../../../common/config.inc.php')) include('../../../../../../common/config.inc.php');
if (file_exists('../../../../../../../common/config.inc.php')) include('../../../../../../../common/config.inc.php');
if (file_exists('../../../../../../../../common/config.inc.php')) include('../../../../../../../../common/config.inc.php');

$CFG = new stdClass();
$CFG->dbtype    = DBTYPE ;
$CFG->dbhost    = HOST ;
$CFG->dbname    = DB ;
$CFG->dbuser    = USER ;
$CFG->dbpass    = PWD ;
$CFG->dbpersist =  false;
$CFG->prefix    = 'mdl_';

$CFG->wwwroot   = 'http://'.$_SERVER['SERVER_NAME'].'/'.ECOLE.'/moodle';
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {	
	$CFG->dirroot   = WEBROOT."".ECOLE."\moodle";
	$CFG->dirroot   = str_replace("/","\\",$CFG->dirroot);
}else{
	$CFG->dirroot   = WEBROOT.ECOLE."/moodle";
}


if ( (preg_match('/lyon.vatel.fr/',$_SERVER['SERVER_NAME'])) || (preg_match('/nimes.vatel.fr/',$_SERVER['SERVER_NAME']))  )     {
        $CFG->dataroot  = WEBROOT."moodledata";
}else{
        $CFG->dataroot  = WEBROOT."/".ECOLE."/data/moodledata";
}
$CFG->admin     = 'admin';

$CFG->directorypermissions = 00755;  // try 02777 on a server in Safe Mode

$CFG->passwordsaltmain = 'JFAR3Ia6VRKQjV hA);M+[-/f:]Bh';

require_once("$CFG->dirroot/lib/setup.php");
// MAKE SURE WHEN YOU EDIT THIS FILE THAT THERE ARE NO SPACES, BLANK LINES,
// RETURNS, OR ANYTHING ELSE AFTER THE TWO CHARACTERS ON THE NEXT LINE.
?>
