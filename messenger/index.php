<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2013 THeUDS           **
 **  Web:            http://www.theuds.com            **
 **                  http://www.intramessenger.net    **
 **  Licence :       GPL (GNU Public License)         **
 **  http://opensource.org/licenses/gpl-license.php   **
 *******************************************************/

/*******************************************************
 **       This file is part of IntraMessenger-server  **
 **                                                   **
 **  IntraMessenger is a free software.               **
 **  IntraMessenger is distributed in the hope that   **
 **  it will be useful, but WITHOUT ANY WARRANTY.     **
 *******************************************************/
//
define('INTRAMESSENGER',true);
//
$new_install = "";
if (is_readable("common/config/config.inc.php")) 
{
  require ("common/config/config.inc.php");
  if (defined("_MAINTENANCE_MODE"))   
  {
    if ( (_MAINTENANCE_MODE != '') and (is_readable("install/install.php")) )    // New installation
      $new_install = "YES";
  }
  $lang = "";
}
else
  $new_install = "KO";
//
if ($new_install == "YES") 
{
  header("location:install/install.php");
  die();
}
//
if (isset($_GET['lang'])) $lang = $_GET['lang']; 
require ("lang.inc.php");
if ($lang == "") $lang = $c_lang;
//
//
$url  = "http://" . $_SERVER['SERVER_NAME'];
if ($_SERVER['SERVER_PORT'] <> 80) $url .= ":" . $_SERVER['SERVER_PORT'];
$url .= $_SERVER['PHP_SELF'];
if (substr_count($url, "index.php") > 0) $url = substr($url, 0, strlen($url) - 9);
//
echo '<HTML>';
echo '<HEAD>';
echo '<META NAME="Author" CONTENT="THeUDS.com">'."\n";
echo '<META NAME="copyright" content="THeUDS.com">'."\n";
echo '<META NAME="Description" CONTENT="IntraMessenger : Instant collaborative Messenger for enterprise/community">'."\n";
echo '<LINK REL="SHORTCUT ICON" HREF="images/favicon.ico">';
echo '<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />';
echo "\n<TITLE>IntraMessenger</TITLE>\n";
if ( (_SHOUTBOX != "") and (_SHOUTBOX_PUBLIC != "") ) echo '<link rel="alternate" title="test RSS" type="application/rss+xml" href="' . _PUBLIC_FOLDER . '/rss/shoutbox.xml">';
echo '</HEAD>';
//
echo "<body background='common/styles/default/images/blue/background.jpg'>";
if ($lang != "EN") echo "<A href='?lang=EN&' title='English'><IMG SRC='images/flags/gb.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='English'></A> ";
if ($lang != "FR") echo "<A href='?lang=FR&' title='En français'><IMG SRC='images/flags/fr.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='En français'></A> ";
if ($lang != "IT") echo "<A href='?lang=IT&' title='Italian'><IMG SRC='images/flags/it.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='Italian'></A> ";
if ($lang != 'ES') echo "<A HREF='?lang=ES&' TITLE='Spanish'><IMG SRC='images/flags/es.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='Spanish'></A>";
if ($lang != "PT") echo "<A href='?lang=PT&' title='Portuguese'><IMG SRC='images/flags/pt.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='Portuguese'></A> ";
if ($lang != "BR") echo "<A href='?lang=BR&' title='Portuguese'><IMG SRC='images/flags/br.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='Portuguese'></A> ";
if ($lang != "DE") echo "<A href='?lang=DE&' title='German'><IMG SRC='images/flags/de.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='German'></A> ";
if ($lang != "RO") echo "<A href='?lang=RO&' title='Romana'><IMG SRC='images/flags/ro.png' WIDTH='18' HEIGHT='12' BORDER='0' alt='Romana'></A> ";
//
echo "<table width='100%' height='94%'  border='0'>";
echo "  <tr>";
echo "    <td align='center'>";
echo "<FONT FACE='verdana' size='2'>";
//
if ( ($new_install == "KO") or (is_readable("install/install.php")) or (is_readable("admin/index.php")) or (!defined("_MAINTENANCE_MODE")) or (!defined("_SPECIAL_MODE_OPEN_GROUP_COMMUNITY")) or (!defined("_ALLOW_SKIN")) or (!defined("_SHARE_FILES")) or (!defined("_AUTO_ADD_CONTACT_USER_ID")) )  
{
  echo "<H4>" . $l_home_not_configured . "</H4>";
  echo "<br/>";
  echo "<br/>";
  $fic_doc = "doc/en/install.html";
  if ($lang == 'FR') $fic_doc = "doc/fr/install.html";
  //if ($lang == 'IT') $fic_doc = "doc/it/install.html";
  echo $l_index_find_doc . " <I>";
  if (is_readable($fic_doc)) echo  "<A HREF='" . $fic_doc . "#install' target='_blank'>";
  //
  echo $fic_doc . "</I></A>";
  die();
}
//
//
$maintenance_mode = "";
if (defined("_MAINTENANCE_MODE"))   
{
  if ( (_MAINTENANCE_MODE != '') ) $maintenance_mode = "X";
}
else
  $maintenance_mode = "X";
//
if ($maintenance_mode != "") 
{
  echo "<H4>" . $l_admin_options_maintenance_mode . "</H4>";
  die();
}
//
//
if ($new_install == "") 
{
  //echo '<BR/>';
  echo "<font color='#F2F7FB'>";
  echo "<H1>" . $l_home_welcome  . "</H1>";
  echo '<BR/>';
  echo "</font>";
  //echo '<BR/>';
}

//
$authentication_by_extern = "";
if ( (_EXTERN_URL_TO_REGISTER != '') and (substr_count(_EXTERN_URL_TO_REGISTER, "http://") > 0) )
{
  require ("common/functions.inc.php");
  require ("common/extern/extern.inc.php");
  require ("common/f_not_empty.inc.php");
  prevent_error_extern_option_missing();
	$authentication_extern_type = "";
	if (f_nb_auth_extern() == 1) 
	{
    $authentication_by_extern = "X";
    $authentication_extern_type = f_type_auth_extern();
  }
  //
  if ($authentication_by_extern != "")
  {
    if (strlen(_SITE_TITLE) > 2) $authentication_extern_type = _SITE_TITLE;
    //
    echo '<BR/>';
    echo "<B><BIG>" . $l_home_thanks_to_first . " <A HREF='" . _EXTERN_URL_TO_REGISTER . "' title='" . $l_home_here_register . "' target='_blank'>" . $l_home_register . "</A> ";
    if ($lang == "FR") echo "au préalable";
    if ($authentication_extern_type != "") echo " sur <I>" . $authentication_extern_type . "</I>";
    echo '</BIG></B><BR/>';
    echo '<BR/>';
    echo '<BR/>';
    echo '<BR/>';
  }
}
if ($authentication_by_extern == "") echo '<BR/>';


//
echo $l_home_download_execute . " <A HREF='im_setup.reg.php' target='blank'><I>im_setup.reg</I></A> " . $l_home_before_install . "<BR/>";
echo '<BR/>';
echo '<BR/>';
echo '<BR/>';
//
  
  
echo "<A HREF='http://www.theuds.com/download.php?soft=intramessenger-clt&site=4&f=" . base64_encode($_SERVER['SERVER_NAME']) . "&' title='" . $l_home_download_install . "'>";
  
if ($lang == "FR")
  echo "<IMG SRC='images/bt_download_install_fr.png' border='0' width='270' height='76' alt='" . $l_home_download_install . "'></A>";
else
  echo "<IMG SRC='images/bt_download_install.png' border='0' width='230' height='76' alt='" . $l_home_download_install . "'></A>";

echo ' &nbsp; &nbsp; <B>' . $l_home_or . '</B> &nbsp; &nbsp; ';

echo "<A HREF='http://www.theuds.com/download.php?soft=intramessenger-clt-zip&site=4&f=" . base64_encode($_SERVER['SERVER_NAME']) . "&' title='" . $l_home_download_zip . "'>";
if ($lang == "FR")
  echo "<IMG SRC='images/bt_download_zip_fr.png' border='0' width='270' height='76' alt='" . $l_home_download_zip . "'></A>";
else
  echo "<IMG SRC='images/bt_download_zip.png' border='0' width='230' height='76' alt='" . $l_home_download_zip . "'></A>";
echo '<BR/>';
echo '<BR/>';
echo '<BR/>';
echo '<BR/>';



$l_home_on_startup_config_url = str_replace("IntraMessenger", "<A HREF='http://www.intramessenger.net/' target='_blank'>IntraMessenger</A>", $l_home_on_startup_config_url);
echo $l_home_on_startup_config_url . " : <BR/><B><BIG>";
echo $url;
echo "</BIG></B><BR/>";

if ($lang == "FR")
  echo "<IMG SRC='images/im_startup_screenshot_fr.png' WIDTH='426' HEIGHT='175'><BR/>";
else
  echo "<IMG SRC='images/im_startup_screenshot.png' WIDTH='426' HEIGHT='175'><BR/>";


  echo '<BR/>';



//
$to_replace = "";
if (strstr($url, "/127.0.0.1/")) $to_replace = "127.0.0.1";
if (strstr($url, "/localhost/")) $to_replace = "localhost";
if ($to_replace != "")
{
  echo '<BR/>';
  echo "<font color='red'>" . $l_home_replace . " /<B>" . $to_replace . "</B>/ " . $l_home_by_ip_address . ".</font><BR/>";
}
//echo '<BR/>';

echo "    </td>";
echo "  </tr>";
echo "</table>";
if ( (_SHOUTBOX != "") and (_SHOUTBOX_PUBLIC != "") ) echo '<iframe src="' . _PUBLIC_FOLDER . '/shoutbox_sticker.php" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:23px;" allowTransparency="true"></iframe><BR/>';
if (date('Y') > 2013) echo '<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.intramessenger.net%2F&amp;layout=standard&amp;show_faces=false&amp;width=500&amp;action=recommend&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:600px; height:23px;" allowTransparency="true"></iframe><BR/>';
?>
<!-- </CENTER> -->
</BODY>
</HTML>