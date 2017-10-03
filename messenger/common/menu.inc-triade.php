<?php
/*******************************************************
 **                  IntraMessenger - server          **
 **                                                   **
 **  Copyright:      (C) 2006 - 2009 THeUDS           **
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
if ( (!defined("_MAINTENANCE_MODE")) or (!defined("_ENTERPRISE_SERVER")) or (!defined("_ALLOW_EMAIL_NOTIFIER")) ) 
{
  $t = $_SERVER["PHP_SELF"];
  $t = strrchr($t, "/");
  $t = substr($t, 1, strlen($t)-1);
/*  if ( ($t != "check.php") and ($t != "list_options_updating.php") )
  {
    echo '<META http-equiv="refresh" content="0;url=check.php?lang='. $lang .'&"> ';
    die();
  } */
}
//
if (isset($_COOKIE['im_full_menu'])) $full_menu = $_COOKIE['im_full_menu'];  else  $full_menu = '';
if (isset($_COOKIE['im_top_menu'])) $im_top_menu = $_COOKIE['im_top_menu'];  else  $im_top_menu = '';
if ($im_top_menu != "") define('_MENU_TOP', true);  else define('_MENU_TOP', false);
//
require ("f_not_empty.inc.php");
require ("extern/extern.inc.php");
prevent_error_extern_option_missing();
//
require ("../common/functions.inc.php");
prevent_error_option_missing();
//
$current_page = $_SERVER["PHP_SELF"];
$current_page = strrchr($current_page, "/");
$current_page = substr($current_page, 1, strlen($current_page)-1);
//
function display_header()
{
  GLOBAL $charset, $file_style_css, $lang, $full_menu;
  //
  echo '<LINK REL="SHORTCUT ICON" HREF="../images/favicon.ico" />';
  echo '<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE" />';
  echo "\n";
  echo '<META NAME="Author" CONTENT="THeUDS.com" />';
  echo '<META NAME="Copyright" content="THeUDS.com" />';
  echo '<meta name="Publisher" content="www.intramessenger.net" />';
  echo '<meta name="Generator" content="One head, 10 fingers" />';
  echo '<meta http-equiv="Content-Type" content="text/html;charset=' . $charset . '" />';
  echo '<meta http-equiv="Content-Style-Type" content="text/css" />';
  echo "<link href='../common/styles/" . $file_style_css . "' rel='stylesheet' media='screen, print' type='text/css'/>";
  echo "<link href='../common/styles/default/menu_class.css' rel='stylesheet' media='screen, print' type='text/css'/>";
  if (_MENU_TOP)
  {
    echo '<script language="javascript" type="text/javascript" src="../common/library/menu.js"></script>';
    echo "<link href='../common/library/menu.css' rel='stylesheet' media='screen, print' type='text/css'/>";
    echo '<script language="javascript" type="text/javascript" >';
    echo 'largeur_menu=120;';
    echo 'largeur_sous_menu=160;';
    echo 'top_ssmenu=27;';
    echo "centrer_menu = true;";
    echo "marge_en_haut_de_page = 28;";
    if ($lang == "PT")
      echo "largeur_menu = new Array(70, 80, 80, 160, 70, 160, 70, 100, 70, 20);";
    else
      echo "largeur_menu = new Array(85, 100, 100, 130, 70, 120, 80, 100, 70, 20);";
    if ($full_menu == "")
    {
      if ($lang == "PT")
      {
        echo "largeur_menu = new Array(70, 80, 80, ";
        if ( _SPECIAL_MODE_GROUP_COMMUNITY == '') echo "160, ";
        if ( ( _SPECIAL_MODE_GROUP_COMMUNITY != '') or (_GROUP_FOR_ADMIN_MESSAGES  != '') ) echo "70, ";
        echo "160, 70, 100, 70, 20);";
      }
      else
      {
        echo "largeur_menu = new Array(85, 100, 100, ";
        if ( _SPECIAL_MODE_GROUP_COMMUNITY == '') echo "130, ";
        if ( ( _SPECIAL_MODE_GROUP_COMMUNITY != '') or (_GROUP_FOR_ADMIN_MESSAGES  != '') ) echo "70, ";
        echo "120, 80, 100, 70, 20);";
      }
    }
    echo '</script>';
  }
}


function display_menu_button_top($link, $text, $title, $lang, $submenu, $img, $num_menu)
{
	$title = str_replace("'", "&#146;", $title);
  if ($submenu == '')
  {

    echo "<p id='menu" . $num_menu ."' class='menu' onmouseover='MontrerMenu(\"ssmenu" . $num_menu . "\");' onmouseout='CacherDelai();'>";
    //if ($num_menu == 10) and ($img != "")) echo "<img src=' . _FOLDER_IMAGES . " . $img . "' align='absmiddle' WIDTH='15' HEIGHT='20' align='' alt='" . $title. "' title='" . $title. "' />";
    //if ($img != "") echo "<img src='" . _FOLDER_IMAGES . $img . "' align='absmiddle' WIDTH='16' HEIGHT='16' align='absmiddle' alt='" . $title. "' title='" . $title. "' />";
    echo "<a href='" . $link . "?lang=" . $lang . "&' alt='" . $title. "' title='" . $title. "' onfocus='MontrerMenu(\"ssmenu" . $num_menu . "\");'>" . $text . "<span>&nbsp;:</span></A>";
    echo "</p>";
    if ($link == "") echo "<ul id='ssmenu" . $num_menu . "' class='ssmenu'	onmouseover='AnnulerCacher();' onmouseout='CacherDelai();' onfocus='AnnulerCacher();' onblur='CacherDelai();'>";
  }
  else
  {
    echo "<li>";
    echo "<a href='" . $link . "?lang=" . $lang . "&' alt='" . $title. "' title='" . $title. "'>";
    if ($num_menu < 9) // langues
    {
      if ($img != "") echo "<img src='" . _FOLDER_IMAGES . $img . "' WIDTH='16' HEIGHT='16' align='absmiddle' alt='" . $title. "' title='" . $title. "' />";
    }
    else
    {
      if ($img != "") echo "<img src='" . $img . "' align='absmiddle' alt='" . $title. "' title='" . $title. "' />";
    }
    //
    echo $text. "<span>&nbsp;;</span></a>";
    echo "</li>";
  }
  echo "\n";
}


function display_menu_top()
{
	GLOBAL $tri, $lang, $full_menu, $current_page;
  $c_missing = "Missing !";
  //
  $repertoire  = getcwd() . "/"; 
  $demo_folder = "";
  if ( (substr_count($repertoire, "/admin_demo/") > 0) or (substr_count($repertoire, "\admin_demo/") > 0) ) $demo_folder = "X";
  //
	require("lang.inc.php");
	//
	echo "\n";
	echo "<TABLE BORDER='0' WIDTH='100%' height='100%' cellspacing='0' cellpadding='5'>";
	echo "<TR>";
	echo "<TD BGCOLOR='#709BC8' ALIGN='CENTER' HEIGHT='55' background='" . _FOLDER_IMAGES . "background_top.png'>";
    echo "<font face=verdana size='6' color='white'>";
    echo "Intra-MSN";
	echo "</TD>";
	echo "</TR>";
  //
	//echo "<TR>";
	//echo "<TD>";
	echo "\n";
	echo "<div id='conteneurmenu'>\n";
	echo "<script language='Javascript' type='text/javascript'>\n"; 
	echo "preChargement();\n";  // pour éviter le clignotement désagréable
  echo "</script>\n";
  echo '<noscript>';
  echo "<div class='warning' align='center'><B>";
//  echo "<a href='set_cookies.php?lang=" . $lang . "&action=top_menu&tri=&page=" . $current_page ."&'>" . $l_menu_no_javascript . "</B></A></div>"; 
  echo '</noscript>';
  //
  $num = 1;
  display_menu_button_top("", $l_menu_index, "", $lang, "", "menu_home.png", $num);
  display_menu_button_top("index.php", $l_menu_dash_board, "", $lang, "X", "menu_home.png", $num);
  if ( ($full_menu != "") or (_STATISTICS != "") )
    display_menu_button_top("statistics.php", $l_menu_statistics, $l_admin_stats_title, $lang, "X", "menu_statistics.png", $num);
  //
  echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  //if ($demo_folder == "") 
  display_menu_button_top("log.php", $l_menu_log, $l_admin_log_title, $lang, "X", "menu_log.png", $num);
 // display_menu_button_top("saving.php", $l_menu_backup, $l_admin_save_title, $lang, "X", "b_save.png", $num);
  display_menu_button_top("check.php", "Check config !", $l_admin_check_title, $lang, "X", "menu_check.png", $num);
  if ($full_menu != "") 
  {
    echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
    display_menu_button_top("donate.php", $l_menu_donate, $l_menu_donate, $lang, "X", "donate.png", $num);
  }
  echo "</ul>";
  //
  $num++;
  display_menu_button_top("", $l_menu_currently, "", $lang, "", "menu_sessions.png", $num); // $l_admin_conference_title
  display_menu_button_top("list_sessions.php", $l_menu_list_sessions, $l_admin_session_title, $lang, "X", "menu_sessions.png", $num);
  if ( ($full_menu != "") or (_ALLOW_CONFERENCE != "") )
    display_menu_button_top("list_conference.php", $l_menu_conference, $l_menu_list_conference_list, $lang, "X", "menu_conference.png", $num);
  echo "</ul>";
  //
  $num++;
  display_menu_button_top("", $l_menu_list_users, "", $lang, "", "menu_users.png", $num); // $l_admin_users_title
  display_menu_button_top("list_users.php", $l_menu_list, $l_admin_users_title, $lang, "X", "menu_users.png", $num);
  if ( ($full_menu != "") or (_DISPLAY_USER_FLAG_COUNTRY != "") ) 
    display_menu_button_top("list_country.php", $l_country, $l_menu_users_by_country, $lang, "X", "flag_country.png", $num);
  //
  display_menu_button_top("user_searching.php", $l_admin_bt_search, $l_admin_users_searching, $lang, "X", "menu_lookfor.png", $num);
  echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  if ( ($full_menu != "") or (_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER == "") ) 
//    display_menu_button_top("user_adding.php", $l_admin_bt_add, $l_admin_users_add_new, $lang, "X", "menu_user_ajout.png", $num);
  //
  display_menu_button_top("user_deleting_older.php", $l_admin_bt_erase, $l_admin_users_out_of_date, $lang, "X", "b_drop.png", $num);
  echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  display_menu_button_top("list_users_ip.php", $l_menu_list_users_ip, $l_admin_users_title, $lang, "X", "menu_ip_double.png", $num);
  display_menu_button_top("list_users_double.php", $l_menu_list_users_double, $l_admin_users_title, $lang, "X", "menu_pc_double.png", $num);
  echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  if ( ($full_menu != "") or (_ENTERPRISE_SERVER != "") )
   // display_menu_button_top("list_users_pc.php", $l_menu_ban_pc, $l_admin_users_pc_title, $lang, "X", "menu_list_computer.png", $num);
  //
  echo "</ul>";
  //
  if ( ($full_menu != "") or ( _SPECIAL_MODE_GROUP_COMMUNITY == '') )
  {
    $num++;
//    display_menu_button_top("", $l_menu_list_contact, "", $lang, "", "menu_contacts.png", $num); // $l_admin_contact_title
 //   display_menu_button_top("list_contact.php", $l_menu_list, $l_admin_contact_title, $lang, "X", "menu_contacts2.png", $num);
    if ( ($full_menu != "") or (_LOCK_USER_CONTACT_LIST != "") )
    {
  //   echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  //    display_menu_button_top("contact_adding.php", $l_admin_bt_add, $l_admin_contact_add_contact, $lang, "X", "menu_contact_ajout.png", $num);
    }
    echo "</ul>";
  }
  //
  if ( ($full_menu != "") or ( _SPECIAL_MODE_GROUP_COMMUNITY != '') or (_GROUP_FOR_ADMIN_MESSAGES  != '') )
  {
    $num++;
//    display_menu_button_top("", $l_menu_list_group, "", $lang, "", "menu_groups.png", $num); // $l_admin_group_title
  //  display_menu_button_top("list_group.php", $l_menu_list, $l_menu_list_group_list, $lang, "X", "menu_groups.png", $num);
    echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
    display_menu_button_top("group_adding.php", $l_admin_bt_create, $l_admin_group_creat_group, $lang, "X", "menu_ajout.png", $num);
    display_menu_button_top("group_adding_user.php", $l_menu_group_add_member, $l_admin_group_title_add_to_group, $lang, "X", "menu_group_ajout.png", $num);
    echo "</ul>";
  }
  //
  $num++;
  display_menu_button_top("", $l_menu_messagerie, $l_admin_mess_title, $lang, "", "", $num);
  display_menu_button_top("messagerie.php", $l_menu_messagerie, $l_admin_mess_title, $lang, "X", "menu_messagerie.png", $num);
  echo "</ul>";
  //
  $num++;
  display_menu_button_top("", $l_menu_options, "", $lang, "", "menu_options.png", $num); // $l_admin_group_title
  //display_menu_button_top("list_options.php", $l_menu_list, $l_admin_options_title, $lang, "X", "menu_options.png", $num);
  if (is_writeable("../common/config/config.inc.php"))
  //  display_menu_button_top("list_options_updating.php", $l_admin_bt_update, $l_admin_options_update, $lang, "X", "b_save.png", $num);
  //
  //display_menu_button_top("list_options_auth.php", $l_admin_options_autentification, $l_admin_options_info_10, $lang, "X", "menu_auth.png", $num);
  echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  if ( ($full_menu != "") or (_ALLOW_CHANGE_AVATAR != "") )
  {
    display_menu_button_top("avatar_changing.php", $l_menu_avatars, $l_menu_avatars, $lang, "X", "menu_avatars.png", $num);
    echo "<img src='../common/library/lookxphr.gif' class='hr' alt='' />";
  }
  echo "<li>";
//  echo "<a href='set_cookies.php?lang=" . $lang . "&action=full_menu&page=" . $current_page . "&'>";
  echo "<img src='" . _FOLDER_IMAGES . "menu_full.png' align='absmiddle' WIDTH='16' HEIGHT='16' alt='" . $l_menu_left . "' title='" . $l_menu_left . "' />";
  if ($full_menu != "") 
    echo $l_menu_not_full;
  else
    echo $l_menu_full;
  echo "</A>";
  echo "</li>";
  echo "</ul>";
  //
  $num++;
  display_menu_button_top("", $l_menu_ban, "", $lang, "", "menu_ban.png", $num);
  display_menu_button_top("list_ban.php?ban=users&lang=" . $lang . "&", $l_menu_ban_user, $l_admin_ban_users, $lang, "X", "menu_users.png", $num);
  display_menu_button_top("list_ban.php?ban=ip&lang=" . $lang . "&", $l_menu_ban_ip, $l_admin_ban_ip, $lang, "X", "menu_ban_ip.png", $num);
 // display_menu_button_top("list_ban.php?ban=pc&lang=" . $lang . "&", $l_menu_ban_pc, $l_admin_ban_pc, $lang, "X", "ban_computer.png", $num);
  echo "</ul>";
  //
  $num++;
  display_menu_button_top("", $l_language, "Language", $lang, "", "", $num);
  if ($lang != 'EN') display_menu_button_top("", "English", "English", "EN", "X", "../images/flags/us.png", $num);
  if ($lang != 'FR') display_menu_button_top("", "Français", "Français", "FR", "X", "../images/flags/fr.png", $num);
  if ($lang != 'IT') display_menu_button_top("", "Italian", "Italian", "IT", "X", "../images/flags/it.png", $num);
  if ($lang != 'PT') display_menu_button_top("", "Portuguese", "Portuguese", "PT", "X", "../images/flags/pt.png", $num);
  if ($lang != 'RO') display_menu_button_top("", "Romana", "Romana", "RO", "X", "../images/flags/ro.png", $num);
  echo "</ul>";
  //



  //
  $num++;
  //display_menu_button_top("", "&nbsp;", "", $lang, "", "menu-pick-button.gif", "10");
  echo "<p id='menu" . $num . "' class='menu' style='padding:0px;margin:0px;height:22px;' >";
//  echo "<a href='set_cookies.php?lang=" . $lang . "&action=top_menu&tri=&page=" . $current_page . "&'>";
  //echo "<img src='" . _FOLDER_IMAGES . "menu-pick-button.gif' align='top' WIDTH='15' HEIGHT='20' alt='" . $l_menu_left . "' title='" . $l_menu_left . "' />";
  echo "<img src='" . _FOLDER_IMAGES . "menu_on_left.png' align='top' WIDTH='16' HEIGHT='16' alt='" . $l_menu_left . "' title='" . $l_menu_left . "' />";
  echo "</A></p>";
  //
  //
  //
  //
  echo "</div>";
  echo "<script language='Javascript' type='text/javascript'>nbmenu=" . $num . "; Chargement();</script>";
  echo '<noscript>';
  echo "<div class='warning' align='center'><B>";
//  echo "<a href='set_cookies.php?lang=" . $lang . "&action=top_menu&tri=&page=" . $current_page . "&'>" . $l_menu_no_javascript . "</B></A></div>"; 
  echo '</noscript>';
	//echo "</TD>";
	//echo "</TR>";
  //
  display_menu_2($repertoire, $demo_folder);
}


function display_menu_2($repertoire, $demo_folder)
{
  GLOBAL $lang, $c_missing;
  //
	require("lang.inc.php");
	echo "<TD VALIGN='TOP' BGCOLOR='#EAEDF4' background='" . _FOLDER_IMAGES . "background.jpg'>"; // La page...
    echo "<CENTER>"; 
    if ( (substr_count($repertoire, "/admin/") > 0) or (substr_count($repertoire, "\admin/") > 0) )
        echo "<div class='warning'>" . $l_menu_need_change_admin_dir . "</div>";
    else
    {
      $sof1 = 0;
      $sof2 = 0;
      if (is_readable(".htaccess")) $sof1 = filesize(".htaccess");
      if (is_readable(".htpasswd")) $sof2 = filesize(".htpasswd");
      //if ( (!is_readable(".htaccess")) and ($demo_folder == "") )
      if ( ( (strval($sof1) < 10) or (strval($sof2) < 10) ) and ($demo_folder == "") )
      {
        if ($demo_folder == "") $l_menu_need_htaccess = str_replace ("htaccess", "<a href='htaccess.php?lang=" . $lang . "&' title='htaccess'>htaccess</A>", $l_menu_need_htaccess);
        echo "<div class='notice'><FONT COLOR='RED'>" . $l_menu_need_htaccess . "</font></div>";
      }
    }
    //
    if (is_readable("../install/install.php")) 
        echo "<div class='notice'><FONT COLOR='RED'>" . $l_menu_need_delete_install_dir . "</font></div>";
    //
    if (_MAINTENANCE_MODE != '') 
        echo "<div class='warning'><FONT COLOR='RED'>" . $l_menu_maintenance_mode_on . "</font></div>";
    //
    if ( (f_is_empty(_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER) ) and (f_not_empty(_PENDING_NEW_AUTO_ADDED_USER)) ) 
      echo "<div class='warning'><B>" . $l_admin_options_info_5 . "</B> <I>_PENDING_NEW_AUTO_ADDED_USER (_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER</I> : off)</div>";
    //  
    if ( (f_is_empty(_PENDING_USER_ON_COMPUTER_CHANGE)) and (f_is_empty(_USER_NEED_PASSWORD)) ) 
      echo "<div class='warning'><B>" . $l_admin_options_info_2 . "</B> : <I>_USER_NEED_PASSWORD / _PENDING_USER_ON_COMPUTER_CHANGE</I></B></div>";
    //  
    if ( (f_not_empty(_CRYPT_MESSAGES)) and (f_not_empty(_LOG_MESSAGES)) ) 
      echo "<div class='warning'>" . $l_admin_options_info_3 . "</div>";
    //  
    if ( (f_not_empty(_SPECIAL_MODE_OPEN_COMMUNITY)) and (f_not_empty(_SPECIAL_MODE_GROUP_COMMUNITY)) ) 
      echo "<div class='warning'><B>" . $l_admin_options_info_4 . "</B></div>";
    //
    if ( (f_not_empty(_GROUP_FOR_ADMIN_MESSAGES)) and (f_not_empty(_SPECIAL_MODE_GROUP_COMMUNITY)) ) 
      echo "<div class='notice'>" . $l_admin_options_info_12 . "<SMALL> : _GROUP_FOR_ADMIN_MESSAGES / _SPECIAL_MODE_GROUP_COMMUNITY</SMALL></div>";
    //
    if ( (f_not_empty(_FORCE_UPDATE_BY_SERVER)) and (f_not_empty(_FORCE_UPDATE_BY_INTERNET)) ) 
      echo "<div class='notice'>" . $l_admin_options_info_12 . "<SMALL> : _FORCE_UPDATE_BY_SERVER / _FORCE_UPDATE_BY_INTERNET</SMALL></div>";
    //
    if ( (f_not_empty(_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN)) and (f_not_empty(_SPECIAL_MODE_GROUP_COMMUNITY)) ) 
      echo "<div class='warning'>_SPECIAL_MODE_GROUP_COMMUNITY <B>" . $l_admin_options_info_9 . "</B> _USER_HIEARCHIC_MANAGEMENT_BY_ADMIN.</div>";
    if ( (f_not_empty(_USER_HIEARCHIC_MANAGEMENT_BY_ADMIN)) and (f_not_empty(_SPECIAL_MODE_OPEN_COMMUNITY)) ) 
      echo "<div class='warning'>_SPECIAL_MODE_OPEN_COMMUNITY <B>" . $l_admin_options_info_9 . "</B> _USER_HIEARCHIC_MANAGEMENT_BY_ADMIN.</div>";
    //
    if ( (f_not_empty(_PUBLIC_OPTIONS_LIST)) and (!is_readable("../" . _PUBLIC_FOLDER . "/options.php")) )
      echo "<div class='notice'>_PUBLIC_OPTIONS_LIST " . $l_admin_options_legende_not_empty . ", " . $l_admin_options_cannot_access_to . " : " . _PUBLIC_FOLDER . "/options.php" . "</div>";
    if ( (f_not_empty(_PUBLIC_USERS_LIST))  and (!is_readable("../" . _PUBLIC_FOLDER . "/users.php")) )
      echo "<div class='notice'>_PUBLIC_USERS_LIST " . $l_admin_options_legende_not_empty . ", " . $l_admin_options_cannot_access_to . " : " . _PUBLIC_FOLDER . "/users.php" . "</div>";
    if ( (f_not_empty(_PUBLIC_POST_AVATAR)) and (!is_readable("../" . _PUBLIC_FOLDER . "/avatar.php")) )
      echo "<div class='notice'>_PUBLIC_POST_AVATAR " . $l_admin_options_legende_not_empty . ", " . $l_admin_options_cannot_access_to . " : " . _PUBLIC_FOLDER . "/avatar.php" . "</div>";
    //
    $nb_auth_extern = f_nb_auth_extern();
    if ($nb_auth_extern > 0)
    {
      if ( (_USER_NEED_PASSWORD == '') or (_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER == '') or (_PENDING_NEW_AUTO_ADDED_USER != '') )
        echo "<div class='warning'><B>" . $l_admin_options_info_10 . " " . $l_admin_options_info_9 . "</B><I> _USER_NEED_PASSWORD _ALLOW_AUTO_ADD_NEW_USER_ON_SERVER _PENDING_NEW_AUTO_ADDED_USER</I>.</div>";
      //
      if ( (_EXTERN_URL_TO_REGISTER == "") or (_EXTERN_URL_TO_REGISTER == $c_missing) )
        echo "<div class='warning'><B>" . $l_admin_options_info_10 . " " . $l_admin_options_info_9 . "</B><I> _EXTERN_URL_TO_REGISTER</I>.</div>";
      //
      if ($nb_auth_extern > 1)
        echo "<div class='warning'><B>" . $l_admin_options_info_10 . " : " . $l_admin_options_info_11 . "</B></div>";
      //
    }
    //
    if ( (!is_readable("../im_setup.reg")) and ($demo_folder == "") )
    {
       if ($demo_folder == "") $l_menu_need_reg = str_replace ("im_setup.reg", "<a href='reg.php?lang=" . $lang . "&' title='im_setup.reg'>im_setup.reg</A>", $l_menu_need_reg);
       echo "<div class='notice'><FONT COLOR='BLUE'>" . $l_menu_need_reg . "</font></div>";
       echo "<BR/>";
    }
}



function display_menu_button($link, $text, $title, $lang, $submenu, $img)
{
	//$title = str_replace("'", "`", $title);
	$title = str_replace("'", "&#146;", $title);
	//if (strpos(" " . $text, "&nbsp; &nbsp;") == 0 )
  if ($submenu == '')
    echo "<SMALL><SMALL><SMALL><BR/></SMALL></SMALL></SMALL>";
  //
  if ($img != '') 
  {
    if ($link != '') echo "<A href='" . $link . "?lang=" . $lang . "&' title='" . $title . "' >";
    echo "<IMG SRC='" . _FOLDER_IMAGES . $img . "' WIDTH='16' HEIGHT='16' alt='" . $title. "' title='" . $title. "' border='0' />"; 
    if ($link != '') echo "</A>";
  }
	if (strlen($link) > 4) 
	{
    if ($submenu != '')
      echo "&nbsp; &nbsp;";
    if ( (substr_count($_SERVER['PHP_SELF'], $link ) > 0) or (substr_count($_SERVER['REQUEST_URI'], $link ) > 0)  )
    {
      echo "<B><span class='select'>";
      //$text .= "  ";
    }
    //
    if (strpos($link, "?") == 0 )
      echo "<a href='" . $link . "?lang=" . $lang . "&' title='" . $title . "' >&nbsp;" . $text . "&nbsp;</a></span></B>";
    else
      echo "<a href='" . $link . "&lang=" . $lang . "&' title='" . $title . "' >&nbsp;" . $text . "&nbsp;</a></span></B>";
    //
    if ($submenu != '')
      echo "&nbsp; &nbsp;";
  }
	else
    echo "&nbsp;" . $text . "&nbsp;";
  //
	//echo " <a href='" . $link . "?lang=" . $lang . "&' class='select' title='" . $title . "' >" . $text . "</a></B>";
	//echo " <a href='" . $link . "?lang=" . $lang . "&' class='select' title='" . $title . "' ><span class='selected'>" . $text . "</span></a></B>";
	//echo " <a href='" . $link . "?lang=" . $lang . "&' class='contentViews' title='" . $title . "' ><span class='buttonText'>" . $text . "</span></a></B>";
	echo "<BR/>";
  echo "\n";
}


function display_menu()
{
	if (_MENU_TOP != "")
    display_menu_top();
  else
    display_left();
}


function display_left()
{
	GLOBAL $tri, $lang, $full_menu, $current_page;
  $c_missing = "Missing !";
  //
  $repertoire  = getcwd() . "/"; 
  $demo_folder = "";
  if ( (substr_count($repertoire, "/admin_demo/") > 0) or (substr_count($repertoire, "\admin_demo/") > 0) ) $demo_folder = "X";
  //if (isset($_COOKIE['im_full_menu'])) $full_menu = $_COOKIE['im_full_menu'];  else  $full_menu = '';
  //
	require("lang.inc.php");
	//
	echo "\n";
	echo "<TABLE BORDER='0' WIDTH='100%' height='100%' cellspacing='0' cellpadding='5'>";
	echo "<TR>";
	//echo "<TD COLSPAN='2' BGCOLOR='#76A8DB' ALIGN='CENTER' HEIGHT='55'>";
	//echo "<TD COLSPAN='2' BGCOLOR='#79A4D1' ALIGN='CENTER' HEIGHT='55'>"; // idem haut du fond jpg
	echo "<TD COLSPAN='2' BGCOLOR='#709BC8' ALIGN='CENTER' HEIGHT='55' background='" . _FOLDER_IMAGES . "background_top.png'>";
    echo "<font face=verdana size='6' color='white'>";
    echo "Intra-MSN";
	echo "</TD>";
	echo "</TR>";

	echo "<TR>";
	echo "<TD WIDTH='185' VALIGN='TOP' BGCOLOR='#D9E2EC' class='menu_left' background='" . _FOLDER_IMAGES . "background_left.png'>"; // Menu à gauche
    echo "<CENTER>";
    echo "<font face=verdana size='2'>";
		if ($lang != 'FR') echo " <A HREF='?lang=FR&tri=" . $tri . "&' TITLE='Français'><IMG SRC='../images/flags/fr.png' WIDTH='18' HEIGHT='12' BORDER='0' ALIGN=''></A>";
		if ($lang != 'EN') echo " <A HREF='?lang=EN&tri=" . $tri . "&' TITLE='English'><IMG SRC='../images/flags/us.png' WIDTH='18' HEIGHT='12' BORDER='0' ALIGN=''></A>";
		if ($lang != 'IT') echo " <A HREF='?lang=IT&tri=" . $tri . "&' TITLE='Italian'><IMG SRC='../images/flags/it.png' WIDTH='18' HEIGHT='12' BORDER='0' ALIGN=''></A>";
		if ($lang != 'PT') echo " <A HREF='?lang=PT&tri=" . $tri . "&' TITLE='Portuguese'><IMG SRC='../images/flags/pt.png' WIDTH='18' HEIGHT='12' BORDER='0' ALIGN=''></A>";
		if ($lang != 'RO') echo " <A HREF='?lang=RO&tri=" . $tri . "&' TITLE='Romana'><IMG SRC='../images/flags/ro.png' WIDTH='18' HEIGHT='12' BORDER='0' ALIGN=''></A>";
		//
		$no_trans_yet = "No have this translation yet. If you can do it, thanks to post it on the official forum.";
		echo ' <A HREF="javascript:alert(\''.$no_trans_yet.'\');" TITLE="' . $no_trans_yet .'"><IMG SRC="../images/flags/br.png" WIDTH="18" HEIGHT="12" BORDER="0" ALIGN=""></A>';
		echo ' <A HREF="javascript:alert(\''.$no_trans_yet.'\');" TITLE="' . $no_trans_yet .'"><IMG SRC="../images/flags/es.png" WIDTH="18" HEIGHT="12" BORDER="0" ALIGN=""></A>';
		echo ' <A HREF="javascript:alert(\''.$no_trans_yet.'\');" TITLE="' . $no_trans_yet .'"><IMG SRC="../images/flags/de.png" WIDTH="18" HEIGHT="12" BORDER="0" ALIGN=""></A>';
    echo "</CENTER>";

    display_menu_button("index.php", $l_menu_dash_board, $l_menu_dash_board, $lang, "", "menu_home.png");
    //
    display_menu_button("", $l_menu_currently, $l_menu_currently, $lang, "", "menu_sessions.png"); // $l_admin_conference_title
    display_menu_button("list_sessions.php", $l_menu_list_sessions, $l_admin_session_title, $lang, "X", "");
    if ( ($full_menu != "") or (_ALLOW_CONFERENCE != "") )
    {
      display_menu_button("list_conference.php", $l_menu_conference, $l_menu_list_conference_list, $lang, "X", "");
    }
    display_menu_button("", $l_menu_list_users, $l_menu_list_users, $lang, "", "menu_users.png"); // $l_admin_users_title
    display_menu_button("list_users.php", $l_menu_list, $l_admin_users_title, $lang, "X", "");
    display_menu_button("list_users_ip.php", $l_menu_list_users_ip, $l_admin_users_title, $lang, "X", "");
    display_menu_button("list_users_double.php", $l_menu_list_users_double, $l_admin_users_title, $lang, "X", "");
    if ( ($full_menu != "") and (_DISPLAY_USER_FLAG_COUNTRY != "") )  // "and" et non "or"
    {
      display_menu_button("list_country.php", $l_country, $l_menu_users_by_country, $lang, "X", "");
    }
    display_menu_button("user_searching.php", $l_admin_bt_search, $l_admin_users_searching, $lang, "X", "");
    if ( ($full_menu != "") or (_ALLOW_AUTO_ADD_NEW_USER_ON_SERVER == "") ) 
    {
//      display_menu_button("user_adding.php", $l_admin_bt_add, $l_admin_users_add_new, $lang, "X", "");
    }
    display_menu_button("user_deleting_older.php", $l_admin_bt_erase, $l_admin_users_out_of_date, $lang, "X", "");
    if ( ($full_menu != "") or (_ENTERPRISE_SERVER != "") )
    {
     // display_menu_button("list_users_pc.php", $l_menu_ban_pc, $l_admin_users_pc_title, $lang, "X", "");
    }
    //
    if ( _SPECIAL_MODE_GROUP_COMMUNITY == '' )
    {
//      display_menu_button("", $l_menu_list_contact, $l_menu_list_contact, $lang, "", "menu_contacts.png", ""); // $l_admin_contact_title
  //    display_menu_button("list_contact.php", $l_menu_list, $l_admin_contact_title, $lang, "X", "");
      
      if ( ($full_menu != "") or (_LOCK_USER_CONTACT_LIST != "") )
      {
    //    display_menu_button("contact_adding.php", $l_admin_bt_add, $l_admin_contact_add_contact, $lang, "X", "");
      }
    }
    else
    {
      if ($full_menu != "") display_menu_button("list_contact.php", $l_menu_list_contact, $l_menu_list_contact, $lang, "", "menu_contacts.png", "");
    }
    //
    if ( ( _SPECIAL_MODE_GROUP_COMMUNITY != '' ) or (_GROUP_FOR_ADMIN_MESSAGES != '') )
    {
//      display_menu_button("", $l_menu_list_group, $l_menu_list_group, $lang, "", "menu_groups.png"); // $l_admin_group_title
    //  display_menu_button("list_group.php", $l_menu_list, $l_menu_list_group_list, $lang, "X", "");
//      display_menu_button("group_adding.php", $l_admin_bt_create, $l_admin_group_creat_group, $lang, "X", "");
      //display_menu_button("group_renaming.php", $l_admin_bt_update, $l_admin_group_rename_group, $lang, "X", "");
  //    display_menu_button("group_adding_user.php", $l_menu_group_add_member, $l_admin_group_title_add_to_group, $lang, "X", "");
    }
    else
    {
//      if ($full_menu != "") display_menu_button("list_group.php", $l_menu_list_group, $l_menu_list_group, $lang, "", "menu_groups.png");
    }
    //
    display_menu_button("messagerie.php", $l_menu_messagerie, $l_admin_mess_title, $lang, "", "menu_messagerie.png");
    //
    //display_menu_button("list_options.php", $l_menu_options, $l_admin_options_title, $lang, "", "menu_options.png");
    //display_menu_button("", $l_menu_options, $l_admin_options_title, $lang, "", "menu_options.png"); // $l_admin_group_title
    //display_menu_button("list_options.php", $l_menu_list, $l_admin_options_title, $lang, "X", "");
    if (is_writeable("../common/config/config.inc.php"))
     // display_menu_button("list_options_updating.php", $l_admin_bt_update, $l_admin_options_update, $lang, "X", "");
    //
    //display_menu_button("list_options_auth.php", $l_admin_options_autentification, $l_admin_options_info_10, $lang, "X", "");
    if ( ($full_menu != "") or (_ALLOW_CHANGE_AVATAR != "") )
    {
      display_menu_button("avatar_changing.php", $l_menu_avatars, $l_menu_avatars, $lang, "X", "");
    }
    //
    display_menu_button("", $l_menu_ban, $l_menu_ban, $lang, "", "menu_ban.png");
    display_menu_button("list_ban.php?ban=users", $l_menu_ban_user, $l_admin_ban_users, $lang, "X", "");
    display_menu_button("list_ban.php?ban=ip", $l_menu_ban_ip, $l_admin_ban_ip, $lang, "X", "");
//    display_menu_button("list_ban.php?ban=pc", $l_menu_ban_pc, $l_admin_ban_pc, $lang, "X", "");
    //
    if ( ($full_menu != "") or (_STATISTICS != "") )
    {
      display_menu_button("statistics.php", $l_menu_statistics, $l_admin_stats_title, $lang, "", "menu_statistics.png");
    }
    //
    //if ($demo_folder == "")
    display_menu_button("log.php", $l_menu_log, $l_admin_log_title, $lang, "", "menu_log.png");
    //
    //display_menu_button("saving.php", $l_menu_backup, $l_admin_save_title, $lang, "", "b_save.png");
    //
    if ($full_menu != "") display_menu_button("donate.php", $l_menu_donate, $l_menu_donate, $lang, "", "donate.png", "");
    //
//    display_menu_button("check.php", "Check config !", $l_admin_check_title, $lang, "", "menu_check.png");
    //
    echo "<BR/>";
    //echo "<SMALL><SMALL><SMALL><BR/></SMALL></SMALL></SMALL>";
    //
    //echo "<SCRIPT type='text/javascript'>";
    echo '<SCRIPT language="javascript" type="text/javascript">';
    //echo "<!–- ";
  //  echo 'document.write(" <a href=set_cookies.php?lang=' . $lang . '&action=top_menu&tri=x&page=' . $current_page . '&><img src=\"' . _FOLDER_IMAGES . 'menu_on_top.png\" align=`top` WIDTH=`16` HEIGHT=`16` border=`0`alt=\"' . $l_menu_top . '\" title=\"' . $l_menu_top . '\" /></A> &nbsp;    "); ';
    //echo " //-–> ";
    echo "</SCRIPT>";
    echo "<NOSCRIPT>";
      echo "<a href='menu_info_no_js.php?lang=" . $lang . "&'>";
      echo "<img src='" . _FOLDER_IMAGES . "menu_on_top.png' align='top' WIDTH='16' HEIGHT='16' border='0'align='' alt='" . $l_menu_top . "' title='" . $l_menu_top . "' /></A> &nbsp; ";
    echo "</NOSCRIPT>";


    //echo "<a href='set_cookies.php?lang=" . $lang . "&action=top_menu&tri=x&page=" . $current_page . "&'>";
    //echo "<img src='" . _FOLDER_IMAGES . "menu_on_top.png' align='top' WIDTH='16' HEIGHT='16' border='0'align='' alt='" . $l_menu_top . "' title='" . $l_menu_top . "' /></A> &nbsp; ";

//    echo "<a href='set_cookies.php?lang=" . $lang . "&action=full_menu&page=" . $current_page . "&'>";
    if ($full_menu != "") 
      echo "<img src='" . _FOLDER_IMAGES . "menu-pick-button2.gif' align='top' WIDTH='15' HEIGHT='20' border='0'align='' alt='" . $l_menu_not_full . "' title='" . $l_menu_not_full . "' />";
    else
      echo "<img src='" . _FOLDER_IMAGES . "menu-pick-button.gif' align='top' WIDTH='15' HEIGHT='20' border='0'align='' alt='" . $l_menu_full . "' title='" . $l_menu_full . "' /> ";
    echo "</A>";

	echo "</TD>";
	//
	//
	display_menu_2($repertoire, $demo_folder);
}


function footer()
{
  require("constant.inc.php");
  //
	echo "<BR/><span class='copyright'><a href='http://www.theuds.com/intramessenger.php?lang=EN&' target='_blank' class='copyright' alt='THeUDS.com' title='THeUDS.com'>Intra-MSN</A> server " . _SERVER_VERSION;
	echo " by <a href='http://www.theuds.com/' target='_blank' class='copyright' alt='THeUDS.com' title='THeUDS.com'>THeUDS</A> &copy; 2006 - 2009</span>";
	//
	if (  ( strpos($_SERVER['HTTP_USER_AGENT'], "Gecko") == 0 ) and ( strpos(" " . $_SERVER['HTTP_USER_AGENT'], "Opera") == 0 )  ) // "MSIE"
	{
		echo '<BR/><BR/><A HREF="http://getfirefox.com/" TARGET="_blank">';
		echo '<img src="../images/get_firefox.png" border="0" title="FireFox (Mozilla)" align="center" width="80" height="15" ALIGN="TOP"></A><BR/>';
	}
}


function display_row_table($text, $width)  
{
	//echo "<TH align='center' width='" . $width . "' bgcolor='" . $color . "' class='row1'><font face='verdana' size='2'><b>" . $text . "</b></font></TH>";
	echo "<TD align='center' width='" . $width . "' class='catHead'> <font face='verdana' size='2'><b>" . $text . "</b></font> </TD>\n";
}

// must include ../common/styles/defil.css
function display_nb_page($num_page, $nb_by_page, $nb_res, $add_url, $go_up)
{
  $num_page = strval($num_page);
  $nb_res = strval($nb_res);
  $nb_by_page = strval($nb_by_page);
  if ($nb_by_page < 10) $nb_by_page = 20;
  $add_url = trim($add_url);
  $go_up = trim($go_up);
  //
  if ($nb_res > $nb_by_page)
  {
    GLOBAL $lang;
    require("lang.inc.php");
    //
    $nb_page = ceil($nb_res / $nb_by_page);
    if ($num_page < 1) $num_page = 1;
    if ($num_page > $nb_page) $num_page = $nb_page;
    //
    echo "<TABLE class='tborder' cellspacing='1' cellpadding='3' border='0'>";
    echo "<TR>";
    echo "<TD class='vbmenu_control' style='font-weight:normal'>Page " . $num_page . " " . $l_pg_of . " " . $nb_page . "</td>";
    if ($num_page > 1)
    {
      if ($num_page > 2)
      {
        echo "<TD class='alt1'><A class='smallfont' href='?page=1" . $add_url . "' title='" . $l_pg_first_page . " - " . $l_pg_result . " 1 " . $l_pg_to . " " . $nb_by_page . " " . $l_pg_of . " " . $nb_res . "'>&laquo; " . $l_pg_first . "</A></td>";
      }
      $last_page = ($num_page - 1);
      $start = ( ($last_page - 1) * $nb_by_page + 1);
      $end = ($start + $nb_by_page - 1);
      echo "<TD class='alt1'><A class='smallfont' href='?page=" . $last_page . $add_url . "' title='" . $l_pg_prev_page . " - " . $l_pg_result . " " . $start . " " . $l_pg_to . " " . $end . " " . $l_pg_of . " " . $nb_res . "'>&lt;</A></td>";
      echo "<TD class='alt1'><A class='smallfont' href='?page=" . $last_page . $add_url . "' title='" . $l_pg_show_result . " " . $start . " " . $l_pg_to . " " . $end . " " . $l_pg_of . " " . $nb_res . "'>" . $last_page . "</A></td>";
    }
    //
    $start = ( ($num_page - 1) * $nb_by_page + 1);
    $end = ($start + $nb_by_page - 1);
    echo "<td class='alt2'><span class='smallfont' title='" . $l_pg_show_result . " " . $start . " " . $l_pg_to . " " . $end . " " . $l_pg_of . " " . $nb_res . "'><strong>" . $num_page . "</strong></span></TD>";
    //
    if ( $num_page < $nb_page )
    {
      $next_page = ($num_page + 1);
      $start = ( ($next_page - 1) * $nb_by_page + 1);
      $end = ($start + $nb_by_page - 1);
      echo "<td class='alt1'><A class='smallfont' href='?page=" . $next_page . $add_url . "' title='" . $l_pg_show_result . " " . $start . " " . $l_pg_to . " " . $end . " " . $l_pg_of . " " . $nb_res . "'>" . $next_page . "</A></TD>";
      echo "<td class='alt1'><A class='smallfont' href='?page=" . $next_page . $add_url . "' title='" . $l_pg_next_page . " - " . $l_pg_result . " " . $start . " " . $l_pg_to . " " . $end . " " . $l_pg_of . " " . $nb_res . "'>&gt;</A></TD>";
      if ( $num_page < ($nb_page - 1) )
      {
        $start = ( ($nb_page-1) * $nb_by_page );
        $end = $nb_res;
        echo "<td class='alt1'><A class='smallfont' href='?page=" . $nb_page . $add_url . "' title='" . $l_pg_last_page . " - " . $l_pg_result . " " . $start . " " . $l_pg_to . " " . $end . "'>" . $l_pg_last . " &raquo;</A></TD>";
      }
    }
    echo "<td class='vbmenu_control' title='" . $l_pg_all . "'><a HREF='?page=all" . $add_url . "'>&laquo; &raquo;</A></TD>";
    //
    if ( ($go_up != '') and ($nb_by_page > 20) )
      echo "<td class='vbmenu_control' title='Top'><a HREF='#top'><IMG SRC='" . _FOLDER_IMAGES . "b_top.gif' height='15' width='15' border='0'></A></TD>";
    //echo "<td class='vbmenu_control' title='Top'><a HREF='#top'>^</A></TD>";
    //echo "<td class='vbmenu_control' title='Bottom'><a HREF='#bottom'>^</A></TD>";
    echo "</TR>";
    echo "</TABLE>";
  }
}

function display_menu_footer()
{
  GLOBAL $lang;
  require("lang.inc.php");
  require("config/mysql.config.inc.php");
  if ( ($dbuname == "root") and ($dbpass == "") ) 
  {
    //
    echo "</TR>";
    echo "<TR>";
    echo "<TD COLSPAN='2' ALIGN='CENTER' BGCOLOR='#FCFDFF' HEIGHT='40'>";
    echo "<div class='warning'>" . $l_menu_pass_root_empty . "</div>";
    echo "</TD>";
    echo "</TR>";
  }
  unset($dbpass);
  //
  //
  require("constant.inc.php");
  //
  echo "</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "<TD COLSPAN='2' ALIGN='CENTER' BGCOLOR='#FCFDFF' HEIGHT='40'>"; // F4F4F4
    if ($lang == "FR")
      echo "<span class='copyright'><a href='http://www.intramessenger.net/?lang=FR&' target='_blank' class='copyright' alt='IntraMessenger.net' title='IntraMessenger.net'>Intra-MSN</A> server " . _SERVER_VERSION;
    else
      echo "<span class='copyright'><a href='http://www.theuds.com/intramessenger.php?lang=EN&' target='_blank' class='copyright' alt='THeUDS.com' title='THeUDS.com'>Intra-MSN</A> server " . _SERVER_VERSION;
    //
    echo " by <a href='http://www.theuds.com/' target='_blank' class='copyright' alt='THeUDS.com' title='THeUDS.com'>THeUDS</A> &copy; 2006 - 2009</span>";
    //
    if (  ( strpos($_SERVER['HTTP_USER_AGENT'], "Gecko") == 0 ) and ( strpos(" " . $_SERVER['HTTP_USER_AGENT'], "Opera") == 0 )  ) // "MSIE"
    {
      echo '<BR/><BR/><A HREF="http://getfirefox.com/" TARGET="_blank">';
      echo '<img src="../images/get_firefox.png" border="0" title="FireFox (Mozilla)" align="center" width="80" height="15" ALIGN="TOP"></A><BR/>';
    }
  echo "</TD>";
  echo "</TR>";
  echo "</TABLE>";
}


function display_nb_row_page($nb, $nb_row_by_page, $from)
{
  GLOBAL $tri, $page, $lang;
  //
  if (strval($nb) == strval($nb_row_by_page) ) 
    echo "<B>" . $nb . "</B>";
  else
  {
   // echo "<A HREF='set_cookies.php?action=" . $from . "&tri=" . $tri . "&page=" . $page . "&lang=" . $lang . "&nb_row_by_page=" . $nb . "&'>" . $nb . "</A>";
  }
}

?>
