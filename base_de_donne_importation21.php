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
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title></head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php
include_once("./librairie_php/lib_licence.php");
include_once("./librairie_php/db_triade.php");
validerequete("menuadmin");
?>
<SCRIPT language="JavaScript" src="<?php print './librairie_js/'.$_SESSION[membre].'.js'?>"></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'>
<?php top_h(); ?>
<SCRIPT language="JavaScript" src="<?php print './librairie_js/'.$_SESSION[membre].'1.js'?>"></SCRIPT>
<FORM method=POST action="">
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Importation d'un fichier Excel " ?></font></b></td></tr>
<tr id='cadreCentral0' >
<td valign=top>
<TABLE border=0 width=100%>
<TR><TD align=top><font class=T2><?php print "Module d'importation de fichier Excel" ?> </font></TD>
</TR></TABLE><br>
<?php print "Le fichier � transmettre DOIT contenir 47 champs" ?>
<BR>
<BR>
<font class=T2><?php print LANGIMP7?></font>
<br>
<BR>
<table width="100%" border="1" bgcolor="#FCE4BA" bordercolor=#000000 >
<tr bgcolor="#FFCC00">
        <td valign=top>1) <?php print LANGIMP8?> *</td>
        <td valign=top>2) <?php print LANGIMP9?> *</td>
	<td valign=top>3) <?php print LANGIMP10?> *</td>
	</tr>
	<tr bgcolor="#FFCC00">
	<td valign=top>4) <?php print LANGIMP11?></td>
	<td valign=top>5) <?php print LANGIMP12?>&nbsp;*</td>
	<td valign=top>6) <?php print "Lieu de naissance"?>&nbsp;*</td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>7) <?php print LANGIMP13?> </td>
        <td valign=top>8) <?php print "Civilit� tuteur"?> </td>
	<td valign=top>9) <?php print LANGIMP14?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>10) <?php print LANGIMP15?> </td>
        <td valign=top>11) <?php print LANGIMP16?></td>
	<td valign=top>12) <?php print LANGIMP18?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>13) <?php print LANGIMP19?></td>
        <td valign=top>14) <?php print "T�l. Portable (1)"?></td>
	<td valign=top>15) <?php print "Civilit� Pers. (2)"?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>16) <?php print "Nom resp. (2)"?> </td>
        <td valign=top>17) <?php print "Pr�nom resp. (2)"?> </td>
	<td valign=top>18) <?php print LANGIMP17?></td>
        </tr>
        <tr bgcolor="#FFCC00">
	<td valign=top>19) <?php print LANGIMP18_2?></td>
        <td valign=top>20) <?php print LANGIMP19_2?></td>
	<td valign=top>21) <?php print "T�l. Portable (2)"?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>22) <?php print LANGIMP20." tuteur "?></td>
        <td valign=top>23) <?php print "T�l. �l�ve" ?></td>
	<td valign=top>24) <?php print LANGIMP21?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>25) <?php print LANGIMP22?></td>
        <td valign=top>26) <?php print LANGIMP23?></td>
	<td valign=top>27) <?php print LANGIMP24?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>28) <?php print LANGIMP25_2?></td>
        <td valign=top>29) <?php print LANGIMP25?></td>
	<td valign=top>30) <?php print LANGIMP26?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>31) <?php print LANGIMP27?></td>
        <td valign=top>32) <?php print LANGIMP28?> </td>
	<td valign=top>33) <?php print LANGIMP29?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>34) <?php print "Mot de passe tuteur 1" ?> </td>
	<td valign=top>35) <?php print "Email tuteur" ?> </td>
	<td valign=top>36) <?php print "Email �l�ve" ?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
	<td valign=top>37) <?php print LANGbasededoni41 ?> </td>
	<td valign=top>38) <?php print LANGbasededoni42 ?> </td>
	<td valign=top>39) <?php print LANGIMP52 ?> </td>
        </TR>
	<tr bgcolor="#FFCC00">
	<td valign=top>40) <?php print "Adresse �l�ve" ?> </td>
	<td valign=top>41) <?php print "Commune �l�ve" ?> </td>
	<td valign=top>42) <?php print "CCP �l�ve" ?> </td>
	</TR>     
	 </TR>
	<tr bgcolor="#FFCC00">
	<td valign=top>43) <?php print "T�l. fixe �l�ve" ?> </td>
	<td valign=top>44) <?php print "Boursier" ?> </td>
	<td valign=top>45) <?php print "Email Universitaire" ?> </td>
        </TR>
	</TR>
	<tr bgcolor="#FFCC00">
	<td valign=top>46) <?php print "Sexe �l�ve" ?> </td>
	<td valign=top>47) <?php print "Mot de passe tuteur 2" ?> </td>
        </TR>
      </table>
<br>
<font class=T1>&nbsp;<u>R�gime possible</u> : <br><br>
&nbsp;&nbsp;&nbsp;- EXTERN, ou EXT ou externe <br>
&nbsp;&nbsp;&nbsp;- INT ou interne <br>
&nbsp;&nbsp;&nbsp;- DP DAN ou DP ou demi pension </font>
<br><br>
<font class=T1>&nbsp;<u>Civilit� possible</u> : <br><br>
&nbsp;&nbsp;&nbsp;- M. Mme Mlle Ms Mr Mrs M. OU Mme<br>
&nbsp;&nbsp;&nbsp;- P. Sr Dr<br>
<?php if ( CIVARMEE == "oui") { ?>
&nbsp;&nbsp;&nbsp;- G�n�ral Colonel Lieutenant-colonel Commandant Capitaine Lieutenant <br>
&nbsp;&nbsp;&nbsp;- Sous-lieutenant Aspirant Major Adjudant-chef Adjudant Sergent-chef <br>
&nbsp;&nbsp;&nbsp;- Sergent Caporal-chef Caporal Aviateur<br>
<?php } ?>
<br><br>
<font class=T1>&nbsp;<u>Sexe El�ve</u> : <br><br>
&nbsp;&nbsp;&nbsp;- m, ou f <br>
</font><br>
<script language=JavaScript>
function suite() {
	location.href="./base_de_donne_key.php?base=xls";
}
</script>
<BR><div align="center">
<input type=button class="BUTTON" value='<?php print "Exemple fichier xls" ?>' onclick="open('./librairie_php/import-etudiant.xls','_blank','')" />
&nbsp;&nbsp;&nbsp;
<input type=button class="BUTTON" value='<?php print LANGBTS?>' onclick='suite();'> 
</div><br />
<br>
<br>
<font color=red>
<?php print LANGIMP49?>
</font></b>
<!-- // fin  -->
</td></tr></table> </form>
<BR>
<SCRIPT language="JavaScript" src="<?php print './librairie_js/'.$_SESSION[membre].'2.js'?>"> </SCRIPT>
</BODY></HTML>
