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
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/verif_creat.js"></script>
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script language="JavaScript" src="./librairie_js/lib_trimestre.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php 
include_once("./librairie_php/lib_licence.php"); 
include_once("./librairie_php/db_triade.php");
validerequete("menuadmin");
$cnx=cnx();
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Visa direction" ?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
<!-- // debut form  -->
<?php
$idclasse=$_POST["saisie_classe"];
$nb=$_POST["saisie_nb"];
$type_notation=$_POST["type_notation"];


for($i=0;$i<$nb;$i++) {
	$eleveid=$_POST[eleveid][$i];
	$note=$_POST["b2I_$eleveid"];
	$cr=create_noteB2IA2($eleveid,$idclasse,$type_notation,$note);
	if ($cr) {
		history_cmd($_SESSION["nom"],"CREATION","B2I/A2");
	}
}	

	

?>
<br />
<center><font class=T2>Notation Enregistr�e</font></center>
<br /><br />
<?php brmozilla($_SESSION["navigateur"]); ?>
<?php brmozilla($_SESSION["navigateur"]); ?>

</form>

<!-- // fin form -->
</td></tr></table>


<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."2.js'>" ?></SCRIPT>
<?php
// deconnexion en fin de fichier
Pgclose();
?>
</BODY>
</HTML>
