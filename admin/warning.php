<?php
session_start();
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET - 
 *   Site                 : http://www.triade-educ.com
 *
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
error_reporting(0);
if ($_GET["saisie_efface"] == "oui") {
         $fichier="../data/error.log";
	 @unlink($fichier);
 	 $fichier="../data/error.txt";
         @unlink($fichier);
}
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="librairie_js/clickdroit.js"></script>
<title>Triade</title>
</head>
<body id='bodyfond'  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0"  >
<?php include("./librairie_php/lib_licence.php"); ?>
<SCRIPT language="JavaScript" src="librairie_js/menudepart.js"></SCRIPT>
<?php include("librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart1.js"></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' >Gestion des Erreurs</font></b></td></tr>
<tr id='cadreCentral0'  ><td > <p align="left"><font color="#000000">
<TABLE  width=100%>
<TR><TD>
<BR><DIV align=right>
<input type=button Value="Transmettre au support Triade" onclick="open('/<?php print REPECOLE ?>/<?php print REPADMIN?>/trans-erreur.php','_parent','')" STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;
<input type=button Value="Effacer Warning" onclick="open('/<?php print REPECOLE ?>/<?php print REPADMIN?>/warning.php?saisie_efface=oui','_parent','')" STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;</div><BR>
<hr>
<!-- // debut de la saisie -->
<?php
$fic="../data/error.log";
if (file_exists($fic)) { readfile("../data/error.log");  }
$fic="../data/error.txt";
if (file_exists($fic)) { readfile("../data/error.txt");  }
?>
</TD></TR></TABLE>
<!-- // fin de la saisie -->
</td></tr></table>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart2.js"></SCRIPT>
<?php top_d(); ?>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart22.js"></SCRIPT>
</body>
</html>
