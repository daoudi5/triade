<?php  // Moodle configuration file

unset($CFG);
global $CFG;
if (file_exists('../common/config.inc.php')) include('../common/config.inc.php');
if (file_exists('../../common/config.inc.php')) include('../../common/config.inc.php');
if (file_exists('../../../common/config.inc.php')) include('../../../common/config.inc.php');
if (file_exists('../../../../common/config.inc.php')) include('../../../../common/config.inc.php');
if (file_exists('../../../../../common/config.inc.php')) include('../../../../../common/config.inc.php');
if (file_exists('../../../../../../common/config.inc.php')) include('../../../../../../common/config.inc.php');
if (file_exists('../../../../../../../common/config.inc.php')) include('../../../../../../../common/config.inc.php');
if (file_exists('../../../../../../../../common/config.inc.php')) include('../../../../../../../../common/config.inc.php');

$CFG = new stdClass();
$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = HOST ;
$CFG->dbname    = DB ;
$CFG->dbuser    = USER ;
$CFG->dbpass    = PWD ;
$CFG->prefix    = 'mdl_';

$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
);

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

require_once(dirname(__FILE__) . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
