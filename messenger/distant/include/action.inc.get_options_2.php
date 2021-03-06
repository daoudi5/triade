<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2010 THeUDS           **
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
if ( !defined('INTRAMESSENGER') )
{
  exit;
}
//
if ( (!isset($_GET['ip'])) or (!isset($_GET['v'])) ) die();
//
$ip = 			  f_decode64_wd($_GET['ip']);
$n_version = 	intval($_GET['v']);
//
if ( ($n_version > 0) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  $t_site_url =      f_encode64(_SITE_URL_TO_SHOW);
  $t_site_title =    f_encode64(_SITE_TITLE_TO_SHOW);
  $t_extern_url =    f_encode64(_EXTERN_URL_TO_REGISTER);
  $t_admin_email =   f_encode64(_ADMIN_EMAIL);
  $t_admin_phone =   f_encode64(_ADMIN_PHONE);
  $t_forget_p_url =  f_encode64(_EXTERN_URL_FORGET_PASSWORD);
  $t_public_folder = f_encode64(_PUBLIC_FOLDER);
  $t_away_list =     f_encode64(_AWAY_REASONS_LIST);
  $t_scroll_text  =  f_encode64(_SCROLL_TEXT);
  $t_email_server =  f_encode64(_INCOMING_EMAIL_SERVER_ADDRESS);
  $t_chang_p_url =   f_encode64(_EXTERN_URL_CHANGE_PASSWORD);
  //
  $keya = ""; $keyb = ""; $keyc = ""; $keyd = ""; $keye = "";
  if (is_readable("../common/config/special.config.inc.php")) include("../common/config/special.config.inc.php");
  //
  $status_list = "";
  if (_FORCE_STATUS_LIST_FROM_SERVER != "")
  {
    require ("lang.inc.php");
    $status_list = $l_admin_session_info_not_connect . ";" . $l_admin_session_info_online . ";" . $l_admin_session_info_away . ";" . $l_admin_session_info_busy .  ";" . $l_admin_session_info_do_not_disturb;
    $status_list = f_encode64($status_list);
  }
  //
  echo ">F09#" . $t_site_url . "#" . $t_site_title  . "#" . $t_extern_url . "#". $t_admin_email . "#" . $t_admin_phone . "#";
  echo $status_list . "#" . $t_away_list . "#" . $t_forget_p_url . "#" . $t_scroll_text . "#" . $t_email_server . "#" . $t_chang_p_url . "#";
  echo f_encode64($keya) . "#" . f_encode64($keyb) . "#" . f_encode64($keyc) . "#" . f_encode64($keyd) . "#";
  echo $t_public_folder . "#" . "#" . "#" . "#";
  echo "##########";
}
?>