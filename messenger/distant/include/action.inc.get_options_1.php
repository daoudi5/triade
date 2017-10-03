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
if (isset($_GET['x'])) $exe = $_GET['x']; else $exe = ""; // ajouté le 11/02/10
//
if ( ($n_version > 0) and ($ip != "") )
{
  require ("../common/acces.inc.php");
  f_verif_ip($ip);
  //
  require ("../common/constant.inc.php");
  require ("../common/extern/extern.inc.php");
  require ("../common/f_not_empty.inc.php");
  prevent_error_extern_option_missing();
  //
  $option_col_name_default_active = "";
  $user_cannot_history_messages = "";
  if (_ALLOW_USER_TO_HISTORY_MESSAGES == "") $user_cannot_history_messages = "X";
  //
  if ( intval($n_version) < intval(_CLIENT_VERSION_MINI) )
  {
    // Version number to old (périmée)
    echo ">F01#KO#" . _CLIENT_VERSION_MINI . "#";
    //
    require ("../common/log.inc.php");
    write_log("error_version_log", $ip);
  }
  else
  {
    $private = '';
    if ( strlen(_PASSWORD_FOR_PRIVATE_SERVER) > 5 ) $private = 'P';
    //
    $opt_srv_display_options_list = '';
    $opt_srv_display_user_list = '';
    $opt_srv_can_propose_avatar = '';
    if ( (is_readable("../" . _PUBLIC_FOLDER . "/options.php")) and (_PUBLIC_OPTIONS_LIST != "") ) $opt_srv_display_options_list = 'DOL3';
    if ( (is_readable("../" . _PUBLIC_FOLDER . "/users.php")) and (_PUBLIC_USERS_LIST != "") ) $opt_srv_display_user_list = 'UL1';
    if ( (is_readable("../" . _PUBLIC_FOLDER . "/avatar.php")) and (_PUBLIC_POST_AVATAR != '') ) $opt_srv_can_propose_avatar = 'AV1';
    //
    //
    $can_update_by_server = "";
    $must_update_by_server = "";
    $must_update_by_internet = "";
    if ($exe != "") 
    {
      $exe = f_decode64_wd($exe);
      $exe = f_clean_name($exe);
    }
    if ($exe == "") $exe = "IntraMessenger";
    if ( (is_readable("update/" . $exe . ".exe")) and (is_readable("update/version.ini")) )
    {
      $can_update_by_server = 'X';
      if ( _FORCE_UPDATE_BY_SERVER != '') $must_update_by_server = "X";
    }
    if (_FORCE_UPDATE_BY_INTERNET != '')
    {
      $must_update_by_server = "";
      $must_update_by_internet = "X";
    }
    //
    //
    $authentication_by_extern = "";
    $authentication_extern_type = "";
    if (f_nb_auth_extern() == 1) 
    {
      $authentication_by_extern = "X";
      $authentication_extern_type = f_type_auth_extern();
      if ($authentication_extern_type != "") 
      {
        if (strlen(_SITE_TITLE) > 2) 
          $authentication_extern_type = f_encode64(_SITE_TITLE);
        else
          $authentication_extern_type = f_encode64($authentication_extern_type);
      }
    }
    //
    $t_check_new_msg_every =                              intval(_CHECK_NEW_MSG_EVERY);
    $t_minimum_username_length =                          intval(_MINIMUM_USERNAME_LENGTH);
    $t_minimum_password_length =                          intval(_MINIMUM_PASSWORD_LENGTH);
    $t_proxy_port_number =                                intval(_PROXY_PORT_NUMBER);
    $t_mx_nb_contact =                                    intval(_MAX_NB_CONTACT_BY_USER);
    $t_proxy_address =                                    f_encode64(_PROXY_ADDRESS);
    $t_sbx_refresh_delay =                                intval(_SHOUTBOX_REFRESH_DELAY);
    if (_FORCE_USERNAME_TO_PC_SESSION_NAME != '')         $t_force_username_to_pc_session_name = "X"; else $t_force_username_to_pc_session_name = "";
    if (_USER_NEED_PASSWORD != '')                        $t_user_need_password = "X"; else $t_user_need_password = "";
    if (_CRYPT_MESSAGES != '')                            $t_crypt_messages = "X"; else $t_crypt_messages = "";
    if (_FORCE_AWAY_ON_SCREENSAVER != '')                 $t_force_away_on_screensaver = "X"; else $t_force_away_on_screensaver = "";
    if (_HIDE_COL_FUNCTION_NAME != '')                    $t_hide_col_function_name = "X"; else $t_hide_col_function_name = "";
    if (_ALLOW_INVISIBLE != '')                           $t_allow_invisible = "X"; else $t_allow_invisible = "";
    if (_ALLOW_SEND_TO_OFFLINE_USER != '')                $t_allow_send_to_offline_user = "X"; else $t_allow_send_to_offline_user = "";
    if (_ALLOW_CHANGE_CONTACT_NICKNAME != '')             $t_allow_change_contact_nickname = "X"; else $t_allow_change_contact_nickname = "";
    if (_ALLOW_CONFERENCE != '')                          $t_allow_conference = "X"; else $t_allow_conference = "";
    if (_ALLOW_CHANGE_EMAIL_PHONE != '')                  $t_allow_change_email_phone = "X"; else $t_allow_change_email_phone = "";
    if (_ALLOW_CHANGE_FUNCTION_NAME != '')                $t_allow_change_function_name = "X"; else $t_allow_change_function_name = "";
    if (_LOCK_USER_CONTACT_LIST != '')                    $t_lock_user_contact_list = "X"; else $t_lock_user_contact_list = "";
    if (_LOCK_USER_OPTIONS != '')                         $t_lock_user_options = "X"; else $t_lock_user_options = "";
    if (_LOG_MESSAGES != '')                              $t_log_messages = "X"; else $t_log_messages = "";
    if (_SPECIAL_MODE_OPEN_COMMUNITY != '')               $t_open_community = "X"; else $t_open_community = "";
    if (_SPECIAL_MODE_GROUP_COMMUNITY != '')              $t_group_community = "X"; else $t_group_community = "";
    if (_DISPLAY_USER_FLAG_COUNTRY != '')                 $t_display_user_flag_country = "X"; else $t_display_user_flag_country = "";
    if (_ALLOW_SMILEYS != '')                             $t_allow_smileys = "X"; else $t_allow_smileys = "";
    if (_ALLOW_CHANGE_AVATAR != '')                       $t_allow_change_avatar = "X"; else $t_allow_change_avatar = "";
    if (_ALLOW_USE_PROXY != '')                           $t_allow_use_proxy = "X"; else $t_allow_use_proxy = "";
    if (_ALLOW_EMAIL_NOTIFIER != '')                      $t_allow_email_notifier = "X"; else $t_allow_email_notifier = "";
    if (_ENTERPRISE_SERVER != '')                         $t_enterprise_server = "X"; else $t_enterprise_server = "";
    if (_ALLOW_USER_RATING != '')                         $t_allow_rating = "X"; else $t_allow_rating = "";
    if (_ALLOW_UPPERCASE_SPACE_USERNAME != '')            $t_allow_space_nickname = "X"; else $t_allow_space_nickname = "";
    if (_NEED_QUICK_REGISTER_TO_AUTO_ADD_NEW_USER != '')  $t_need_quick_register = "X"; else $t_need_quick_register = "";
    if (_PWD_NEED_DIGIT_LETTER != '')                     $t_pass_need_digit_and_letter = "X"; else $t_pass_need_digit_and_letter = "";
    if (_PWD_NEED_UPPER_LOWER != '')                      $t_pass_need_upper_and_lower = "X"; else $t_pass_need_upper_and_lower = "";
    if (_PWD_NEED_SPECIAL_CHARACTER != '')                $t_pass_need_special_character = "X"; else $t_pass_need_special_character = "";
    if (_SHOUTBOX != '')                                  $t_allow_shoutbox = "X"; else $t_allow_shoutbox = "";
    if (_SHOUTBOX_VOTE != '')                             $t_shoutbox_allow_vote = "X"; else $t_shoutbox_allow_vote = "";
    if (_GROUP_FOR_SBX_AND_ADMIN_MSG != '')               $t_group_for_shoutbox = "X"; else $t_group_for_shoutbox = "";
    if (_GROUP_USER_CAN_JOIN != '')                       $t_group_user_can_join = "X"; else $t_group_user_can_join = "";
    if (_SERVERS_STATUS != '')                            $t_srv_list_status = "X"; else $t_srv_list_status = "";
    if (_SHOUTBOX_NEED_APPROVAL != '')                    $t_shoutbox_need_approval = "X"; else $t_shoutbox_need_approval = "";
    $t_allow_webcam = "";
    //
    // on renvoi les valeurs des options.
    echo ">F01#" . $t_force_username_to_pc_session_name . "#" . $t_user_need_password . "#" . _CLIENT_VERSION_MINI . "#" . $t_crypt_messages . "#";
    echo "1" . "#" . $t_force_away_on_screensaver  . "#" . $t_hide_col_function_name . "#" .$option_col_name_default_active . "#";
    echo $private . "#" . $t_allow_invisible . "#" . $t_allow_send_to_offline_user . "#" . $t_allow_change_contact_nickname . "#";
    echo $t_lock_user_contact_list . "#" . $t_log_messages . "#" . $t_lock_user_options . "#";
    echo $t_open_community . "#" . $t_group_community . "#"  . $opt_srv_display_options_list . "#";
    echo $t_check_new_msg_every . "#" . $t_minimum_username_length . "#" . $t_minimum_password_length . "#";
    echo $user_cannot_history_messages . "#" . $t_allow_conference . "#" . $authentication_extern_type . "#";
    echo $authentication_by_extern . "#" . $can_update_by_server . "#" . $must_update_by_server . "#" . $t_display_user_flag_country . "#";
    echo _SERVER_VERSION . "#" . $t_allow_change_email_phone . "#" . $t_allow_change_function_name . "#" . $t_allow_smileys . "#";
    echo $t_allow_change_avatar . "#" . $t_allow_use_proxy . "#" . $opt_srv_display_user_list. "#" . $opt_srv_can_propose_avatar . "#";
    echo $must_update_by_internet . "#" . $t_allow_email_notifier . "#" . $t_enterprise_server . "#" . $t_allow_rating . "#";
    echo $t_proxy_port_number . "#" . $t_proxy_address . "#" . $t_mx_nb_contact . "#" . $t_allow_space_nickname . "#" . $t_need_quick_register . "#";
    echo $t_pass_need_digit_and_letter . "#" . $t_pass_need_upper_and_lower . "#" . $t_pass_need_special_character . "#";
    echo $t_allow_webcam . "#" . $t_allow_shoutbox . "#" . $t_shoutbox_allow_vote . "#" . $t_group_for_shoutbox . "#" . $t_group_user_can_join . "#";
    echo $t_sbx_refresh_delay . "#" . $t_srv_list_status . "#" . $t_shoutbox_need_approval . "#" . "#";
    echo "#" . "#" . "#" . "#";
    echo "#################" ;
  }
}
?>