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
require ("../common/display_errors.inc.php"); 
//
if (isset($_COOKIE['im_nb_row_by_page'])) $nb_row_by_page = $_COOKIE['im_nb_row_by_page'];  else  $nb_row_by_page = '15';
//
if (isset($_GET['page'])) $page = $_GET['page']; else $page = "";
if (isset($_GET['lang'])) $lang = $_GET['lang']; else $lang = "";
if (isset($_GET['group_by'])) $group_by = $_GET['group_by']; else $group_by = "";
//
define('INTRAMESSENGER',true);
require ("../common/styles/style.css.inc.php"); 
require ("../common/config/config.inc.php");
require ("lang.inc.php");
require ("../common/menu.inc.php"); // après config.inc.php !
//echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
echo "<html><head>";
echo "<title>[IM] " . $l_admin_stats_title . "</title>";
display_header();
echo "<link href='../common/styles/defil.css' rel='stylesheet' media='screen, print' type='text/css'/>";
echo "</head>";
echo "<body>";
//
display_menu();
//
require ("../common/sql.inc.php");
//
if ($page == 'all')
  $nb_row_by_page = 1000;
else
{
  if (strval($nb_row_by_page) < 15) $nb_row_by_page = 15;
  if ( ($nb_row_by_page <> 15) and ($nb_row_by_page <> 20) and ($nb_row_by_page <> 30) and ($nb_row_by_page <> 40) and ($nb_row_by_page <> 50) and ($nb_row_by_page <> 100) )  $nb_row_by_page = 20;
}
$page = strval($page);
if ($page < 1) $page = 1;
//
function display_image($nb, $nb_max)
{
  GLOBAL $l_admin_stats_rate;
  //
  if ($nb_max < 1) $nb_max = 1;
  $to = ceil( ($nb / $nb_max) * 100 );
  $comment = $to . "% " . $l_admin_stats_rate . " (" . $nb_max . ")";
  if (strval($to) <= 1) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_0.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 1) and (strval($to) <= 5) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_1.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 5) and (strval($to) <= 12) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_2.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 12) and (strval($to) <= 21) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_3.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 21) and (strval($to) <= 33) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_4.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 33) and (strval($to) <= 44) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_5.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 44) and (strval($to) <= 55) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_6.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 55) and (strval($to) <= 66) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_7.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 66) and (strval($to) <= 78) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_8.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 78) and (strval($to) <= 88) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_9.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if ( (strval($to) > 88) and (strval($to) <= 97) ) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_10.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
  if (strval($to) > 97) echo "<IMG SRC='" . _FOLDER_IMAGES . "sidebar_11.png' width='100%' height='13' alt='" . $comment ."' title='" . $comment ."'>";
}
//
//
if ($group_by == '')
{
  $requete  = " select max(STA_NB_MSG), max(STA_NB_CREAT), max(STA_NB_SESSION), max(STA_NB_USR), max(STA_DATE) ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "STA_STATS ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-G1b]", $requete);
  list ($max_nb_msg, $max_nb_creat, $max_nb_session, $max_nb_user, $max_dat) = mysql_fetch_row ($result);
}
else
{
  $max_nb_msg = 0;
  $max_nb_creat = 0;
  $max_nb_session = 0;
  $max_nb_user = 0;
  $max_dat = "";
}
//
if ( ($group_by == 'week') or ($group_by == 'month') or ($group_by == 'year') )
{
  if ($group_by == 'week') $requete   = " select DATE_FORMAT(STA_DATE, '%v-%Y'), sum(STA_NB_MSG), sum(STA_NB_CREAT), ROUND(avg(STA_NB_SESSION)), ROUND(avg(STA_NB_USR)) ";
  if ($group_by == 'month') $requete  = " select DATE_FORMAT(STA_DATE, '%m-%Y'), sum(STA_NB_MSG), sum(STA_NB_CREAT), ROUND(avg(STA_NB_SESSION)), ROUND(avg(STA_NB_USR)) ";
  if ($group_by == 'year') $requete   = " select DATE_FORMAT(STA_DATE, '%Y'), sum(STA_NB_MSG), sum(STA_NB_CREAT), ROUND(avg(STA_NB_SESSION)), ROUND(avg(STA_NB_USR)) ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "STA_STATS ";
  if ($group_by == 'week') $requete  .= " group by year(STA_DATE), week(STA_DATE) ";
  if ($group_by == 'month') $requete .= " group by year(STA_DATE), month(STA_DATE) ";
  if ($group_by == 'year') $requete  .= " group by year(STA_DATE) ";
  $requete .= " ORDER BY STA_DATE DESC ";
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-G1c]", $requete);
  if ( mysql_num_rows($result) > 0 )
  {
    while( list ($t, $nb_msg, $nb_creat, $nb_session, $nb_user) = mysql_fetch_row ($result) )
    {
      if ($nb_msg > $max_nb_msg) $max_nb_msg = $nb_msg;
      if ($nb_creat > $max_nb_creat) $max_nb_creat = $nb_creat;
      if ($nb_session > $max_nb_session) $max_nb_session = $nb_session;
      if ($nb_user > $max_nb_user) $max_nb_user = $nb_user;
    }
  }
}
else
  $group_by = "";
//
$nb_user_last_day = 0;
// les stats du jour pour le nb de user ne se fait que le lendemain, au 1er insert, donc la, on calcule en direct.
if ($max_dat != "")
{
  $requete = " SELECT count(*) FROM " . $PREFIX_IM_TABLE . "USR_USER where USR_DATE_LAST = " . date("Ymd", strtotime($max_dat));
  $result = mysql_query($requete);
  if (!$result) error_sql_log("[ERR-G1a]", $requete);
  list($nb_user_last_day) = mysql_fetch_row ($result);
}
//
//
if ($group_by == '')
{
  $requete  = " select STA_DATE, STA_NB_MSG, STA_NB_CREAT, STA_NB_SESSION, STA_NB_USR ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "STA_STATS ";
  $requete .= " ORDER BY STA_DATE DESC ";
}
else
{
  if ($group_by == 'week')  $requete  = " select DATE_FORMAT(STA_DATE, '%v-%Y'), sum(STA_NB_MSG), sum(STA_NB_CREAT), ROUND(avg(STA_NB_SESSION)), ROUND(avg(STA_NB_USR)) ";
  if ($group_by == 'month') $requete  = " select DATE_FORMAT(STA_DATE, '%m-%Y'), sum(STA_NB_MSG), sum(STA_NB_CREAT), ROUND(avg(STA_NB_SESSION)), ROUND(avg(STA_NB_USR)) ";
  if ($group_by == 'year')  $requete  = " select year(STA_DATE), sum(STA_NB_MSG), sum(STA_NB_CREAT), ROUND(avg(STA_NB_SESSION)), ROUND(avg(STA_NB_USR)) ";
  $requete .= " FROM " . $PREFIX_IM_TABLE . "STA_STATS ";
  if ($group_by == 'week')  $requete .= " group by year(STA_DATE), week(STA_DATE) ";
  if ($group_by == 'month') $requete .= " group by year(STA_DATE), month(STA_DATE) ";
  if ($group_by == 'year')  $requete .= " group by year(STA_DATE) ";
  $requete .= " ORDER BY STA_DATE DESC ";
}
//
$result = mysql_query($requete);
if (!$result) error_sql_log("[ERR-G1d]", $requete);
$nb_row = mysql_num_rows($result);
if ( $nb_row > 0 )
{
  echo "<BR/>";
  // Page défilement :
  echo "<TABLE cellspacing='3' cellpadding='0' BORDER='0'>";
  if ($nb_row_by_page > 50)
  {
    echo "<TR><TD ALIGN='RIGHT'>";
    display_nb_page($page, $nb_row_by_page, $nb_row, "&lang=" . $lang . "&group_by=" . $group_by . "&'", "");
    echo "</TD></TR>";
  }
  echo "<TR><TD>"; //
  //
  echo "<TABLE cellspacing='1' cellpadding='1' class='forumline'>";
  echo "<THEAD>";
  echo "<TR>";
    echo "<TH align=center COLSPAN='9' class='thHead'>";
    echo "<font face=verdana size=3><b>&nbsp; " . $l_admin_stats_title . " </B>";
    if ($nb_row > 10) echo " &nbsp; <SMALL>(" . $nb_row . ")</SMALL>&nbsp;</b></font></TH>";
  echo "</TR>";
  //
	echo "<TR>";
    display_row_table($l_admin_stats_col_date, '');
    //display_row_table($l_admin_stats_col_nb_creat, '150');
    //
    //display_row_table("&nbsp;" . $l_admin_stats_col_nb_session . "&nbsp;", '');
    //echo "<TD align='center' width='" . $width . "' class='catHead' COLSPAN='2'> <font face='verdana' size='2'><b>" . $l_admin_stats_col_nb_session . "</b></font> </TD>";
    echo "<TD align='center' width='210' class='catHead' COLSPAN='2'> <font face='verdana' size='2'><b>&nbsp;" . $l_admin_stats_col_nb_session;
    if ($group_by != '') echo "</b> [*]";
    echo "</font></TD>";
    //display_row_table($l_admin_stats_col_nb_msg, '110');
    echo "<TD align='center' width='150' class='catHead' COLSPAN='2'> <font face='verdana' size='2'><b>" . $l_admin_stats_col_nb_users;
    if ($group_by != '') echo "</b> [*]";
    echo "</b></font> </TD>";
    echo "<TD align='center' width='150' class='catHead' COLSPAN='2'> <font face='verdana' size='2'><b>" . $l_admin_stats_col_nb_creat . "</b></font> </TD>";
    echo "<TD align='center' width='150' class='catHead' COLSPAN='2'> <font face='verdana' size='2'><b>" . $l_admin_stats_col_nb_msg . "</b></font> </TD>";
	echo "</TR>";
	echo "</THEAD>";
  echo "<TFOOT>";
    echo "<TR>";
    echo "<TD align='center' COLSPAN='9' class='catBottom'>";
    echo "<font face=verdana size=2>";
    if ( ($nb_row < 10) and ($group_by == '') )
    {
      echo "<font color='gray'>";
      echo $l_admin_stats_col_nb_session . "   > 1";
      echo "</font>";
    }
    else
    {
      if ($group_by == '') echo "<I>";
      echo "<A HREF='statistics_old.php?page=1&lang=" . $lang . "&group_by=&' class='cattitle' >" . $l_admin_stats_by_day . "</A>";
      if ($group_by == '') echo "</I>";
      echo " - ";
      //
      if ($group_by == 'week') echo "<I>";
      echo "<A HREF='statistics_old.php?page=1&lang=" . $lang . "&group_by=week&' class='cattitle' >" . $l_admin_stats_by_week . "</A>";
      if ($group_by == 'week') echo "</I>";
      echo " - ";
      //
      if ($group_by == 'month') echo "<I>";
      echo "<A HREF='statistics_old.php?page=1&lang=" . $lang . "&group_by=month&' class='cattitle' >" . $l_admin_stats_by_month . "</A>";
      if ($group_by == 'month') echo "</I>";
      echo " - ";
      //
      if ($group_by == 'year') echo "<I>";
      echo "<A HREF='statistics_old.php?page=1&lang=" . $lang . "&group_by=year&' class='cattitle' >" . $l_admin_stats_by_year . "</A>";
      if ($group_by == 'year') echo "</I>";
      //
      //
      if ($group_by != '') echo "</b> &nbsp; &nbsp; &nbsp; [*] " . $l_admin_stats_average;
    }
    echo "</TD>";
    echo "</TR>";
  echo "</TFOOT>";
	echo "\n";
	echo "<TBODY>";
	//
  //
	$row_num = 0;
	$display_start = 0;
	$display_end = 0;
  if ($nb_row > $nb_row_by_page)
  {
    $nb_page = ceil($nb_row / $nb_row_by_page);
    if ($page < 1) $page = 1;
    if ($page > $nb_page) $page = $nb_page;
    $display_start = ( ($page - 1) * $nb_row_by_page + 1);
    $display_end = ($display_start + $nb_row_by_page - 1);
    if ($display_end > $nb_row) $display_end = $nb_row;
  }
	while( list ($date, $nb_msg, $nb_creat, $nb_session, $nb_user) = mysql_fetch_row ($result) )
	{
    $row_num++;
    if (  ($display_start <= 0) or ($display_end <= 0) or ( ($row_num >= $display_start) and ($row_num <= $display_end) )  )
    {
      if ( ($group_by == 'week') or ($group_by == 'month') or ($group_by == 'year') ) 
        $dat = $date;
      else
        $dat = date($l_date_format_display, strtotime($date)); 
      //
      if ( ($row_num == 1) and (strval($nb_user) < 1) ) $nb_user = $nb_user_last_day;
      echo "<TR>";
        echo "<TD align='center' class='row2'>";
          echo "<font face=verdana size=2>&nbsp;" . $dat . "&nbsp;</font>";
        echo "</TD>";
        //
        echo "<TD align='center' valign='center' class='row2'>";
          display_image($nb_session, $max_nb_session);
        echo "</TD>";
        echo "<TD align='right' valign='center' class='row2' width='20'>";
          if (strval($nb_session) > 0)
            echo "<font face=verdana size=2> " . $nb_session . " </font>";
        echo "</TD>";
        //
        echo "<TD align='center' valign='center' class='row1'>";
          display_image($nb_user, $max_nb_user);
        echo "</TD>";
        echo "<TD align='right' valign='center' class='row1' width='20'>";
          if (strval($nb_user) > 0)
            echo "<font face=verdana size=2> " . $nb_user . " </font>";
        echo "</TD>";
        //
        echo "<TD align='center' valign='center' class='row2'>";
          display_image($nb_creat, $max_nb_creat);
        echo "</TD>";
        echo "<TD align='right' valign='center' class='row2' width='20'>";
          if (strval($nb_creat) > 0)
            echo "<font face=verdana size=2> " . $nb_creat . " </font>";
        echo "</TD>";
        //
        echo "<TD align='center' valign='center' class='row1'>";
          display_image($nb_msg, $max_nb_msg);
        echo "</TD>";
        echo "<TD align='right' valign='center' class='row1' width='20'>";
          if (strval($nb_msg) > 0)
            echo "<font face=verdana size=2> " . $nb_msg . " </font>";
        echo "</TD>";
        //
      echo "</TR>";
      echo "\n";
    }
  }
	echo "</TBODY>";
	echo "</TABLE>";
  //
  //echo "/**/";
  echo "</TD></TR><TR><TD ALIGN='RIGHT'>";
  display_nb_page($page, $nb_row_by_page, $nb_row, "&lang=" . $lang . "&group_by=" . $group_by . "&'", "UP");
  echo "</TD></TR>";
  echo "</TABLE>";
}
else
{
  echo "<TABLE cellspacing='1' cellpadding='1' class='forumline'>";
  echo "<THEAD>";
  echo "<TR>";
    echo "<TH align=center COLSPAN='4' class='thHead'>";
    echo "<font face=verdana size=3><b>&nbsp; " . $l_admin_stats_title . " </B>";
  echo "</TR>";
  //
	echo "<TR>";
	echo "<TD colspan='4' ALIGN='CENTER' class='row2'>";
		echo "<font face='verdana' size='2'>" . $l_admin_stats_no_stats . "<BR/>";
    if (_STATISTICS == "")
      echo "<font color='red'>" . $l_admin_stats_option_not . "</FONT>";
	echo "</TD>";
	echo "</TR>";
	echo "</TABLE>";
}
//
mysql_close($id_connect);
//
display_menu_footer();
//
echo "</body></html>";
?>
