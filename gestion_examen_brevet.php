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
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php 
include_once("./librairie_php/lib_licence.php");
include_once('librairie_php/db_triade.php');
validerequete("2");
$cnx=cnx();

?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' >
<?php print LANGTITRE29?></font></b></td>
</tr>
<tr id='cadreCentral0'>
<td >
<form action='gestion_examen_brevet2.php' method="post">
<br /><ul><table><tr><td align=right ><font class=T2>&nbsp;&nbsp;Classe  : </font></td>
<td><select name="idclasse"><option   STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?></select>
</td>
</tr>
<tr><td align=right><font class=T2>Format du fichier PDF :</font> </td><td><select name="type_pdf" id="saisie_classe">
<option value="global" id='select1'>Un fichier PDF pour l'ensemble</option>
<option value="pers" id='select1'>Un fichier PDF par �l�ve</option>
<!-- <option value="mail" id='select1'>Un envoi par email par bulletin</option> -->
</select></td></tr>


<tr><td colspan=2 align=center><br /><br /><table><tr><td>
<script language=JavaScript>buttonMagicSubmit("<?php print "Valider" ?>","rien"); //text,nomInput</script></td></tr></table>
</form></td></tr></table>
<!-- // fin form -->
</td></tr></table>
</ul>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."2.js'>" ?></SCRIPT>
<?php Pgclose(); ?>
</BODY>
</HTML>
