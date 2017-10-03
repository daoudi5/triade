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
<script language="JavaScript" src="./librairie_js/info-bulle.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php 
include("./librairie_php/lib_licence.php"); 
include_once("./librairie_php/db_triade.php");
validerequete("2");
?>
<SCRIPT language="JavaScript" src="<?php print './librairie_js/'.$_SESSION[membre].'.js'?>"></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
<?php  $today= date ("j M, Y");  ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'>
<?php top_h(); ?>
<SCRIPT language="JavaScript" src="<?php print './librairie_js/'.$_SESSION[membre].'1.js'?>"></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Exportation des donn�es �l�ves" ?>  </font></b></td>
</tr>
<tr id='cadreCentral0'>
<td valign=top>
<br />
<ul><font class=T2><?php print "Indiquer l'ordre des colonnes dans votre fichier excel" ?></font></ul>
<br />
<form method="post" action="export_eleve_3.php" >
<font class="T2">
<?php
$nbordre=count($_POST['liste']);
$nbcolplus=$_POST['nbcolplus'];

if (isset($_POST['create'])) {
	print "<table width='100%' border=0  style='border-collapse: collapse;'  >";
	print "<tr>";
	$j=0;
	$tab=$_POST['liste'];
	if ($nbcolplus > 0) {
		for($i=0;$i<$nbcolplus;$i++) {
			$tab[]="$i";
			$nbordre++;
		}
	}

	foreach($tab as $key=>$value) {
		print "<td width='33%'>";
		print "<select name='ordre[]'>";
		print "<option value='' >N�</option>";
		for($i=1;$i<=$nbordre;$i++) {
			print "<option value='$i' >$i</option>";
		}
		print "</select>&nbsp;";
		$name="";
		if ($value == "nom") { $name="nom&nbsp;�l�ve"; }
		if ($value == "prenom") { $name="prenom&nbsp;�l�ve"; }
		if ($value == "classe") { $name="classe"; }
		if ($value == "lv1") { $name="LV1"; }
		if ($value == "lv2") { $name="LV2"; }
		if ($value == "option") { $name="Option"; }
		if ($value == "regime") { $name="R�gime"; }
		if ($value == "date_naissance") { $name="date&nbsp;naissance"; }
		if ($value == "lieu_naissance") { $name="lieu&nbsp;naissance"; }
		if ($value == "nationalite") { $name="nationalit�"; }
		if ($value == "civ_1") { $name="Civ.&nbsp;tuteur&nbsp;1"; }
		if ($value == "nomtuteur") { $name="nom&nbsp;tuteur&nbsp;1"; }
		if ($value == "nomtuteur_2") { $name="nom&nbsp;tuteur&nbsp;2"; }
		if ($value == "prenomtuteur") { $name="pr�nom&nbsp;tuteur&nbsp;1"; }
		if ($value == "prenomtuteur_2") { $name="pr�nom&nbsp;tuteur&nbsp;2"; }
		if ($value == "adr1") { $name="adr.&nbsp;tuteur&nbsp;1"; }
		if ($value == "adr2") { $name="adr.&nbsp;tuteur&nbsp;2"; }
		if ($value == "code_post_adr1") { $name="CCP&nbsp;tuteur&nbsp;1"; }
		if ($value == "commune_adr1") { $name="Commune&nbsp;tuteur&nbsp; 1"; }
		if ($value == "tel_port_1") { $name="T�l.&nbsp;port.&nbsp;tuteur&nbsp;1"; }
		if ($value == "civ_2") { $name="Civ.&nbsp;tuteur&nbsp;2"; }
		if ($value == "nom_resp_2") { $name="nom&nbsp;tuteur&nbsp;2"; }
		if ($value == "prenom_resp_2") { $name="pr�nom&nbsp;tuteur&nbsp;2"; }
		if ($value == "code_post_adr2") { $name="CCP&nbsp;tuteur&nbsp;2"; }
		if ($value == "commune_adr2") { $name="Commune&nbsp;tuteur&nbsp;2"; }
		if ($value == "tel_port_2") { $name="T�l.&nbsp;port.&nbsp;tuteur&nbsp;2"; }
		if ($value == "telephone") { $name="T�l�phone"; }
		if ($value == "profession_pere") { $name="Prof.&nbsp;p�re"; }
		if ($value == "tel_prof_pere") { $name="T�l.&nbsp;prof.&nbsp;p�re"; }
		if ($value == "profession_mere") { $name="Prof.&nbsp;m�re"; }
		if ($value == "tel_prof_mere") { $name="T�l.&nbsp;prof.&nbsp;m�re"; }
		if ($value == "nom_etablissement") { $name="Nom&nbsp;�tablissement"; }
		if ($value == "numero_etablissement") { $name="N�&nbsp;�tablissement"; }
		if ($value == "code_postal_etablissement") { $name="CCP&nbsp;�tablissement"; }
		if ($value == "commune_etablissement") { $name="Commune&nbsp;�tablissement"; }
		if ($value == "numero_eleve") { $name="INE&nbsp;-&nbsp;N�&nbsp;�l�ve"; }
		if ($value == "email_eleve") { $name="Email&nbsp;�l�ve"; }
		if ($value == "email_resp_2") { $name="Email&nbsp;Tuteur&nbsp;2"; }
		if ($value == "email") { $name="Email&nbsp;Tuteur&nbsp;1"; }
		if ($value == "class_ant") { $name="Classe&nbsp;ant�rieur"; }
		if ($value == "annee_ant") { $name="Ann�e&nbsp;ant�rieur"; }
		if ($value == "tel_eleve") { $name="T�l.&nbsp;�l�ve"; }
		if ($value == "sexe") { $name="sexe"; }
		if ($value == "code_barre") { $name="Code&nbsp;barre"; }
		if ($value == "email_eleve") { $name="Email&nbsp;�l�ve"; }
		if ($value == "email_eleve_pro") { $name="Email&nbsp;�l�ve&nbsp;Univ."; }
		if ($value == "annee_scolaire") { $name="Ann�e&nbsp;scolaire."; }
		if ($value == "tel_fixe_eleve") { $name="T�l.&nbsp;fixe&nbsp;�l�ve"; }
		if ($value == "information") { $name="Informations"; }

		if ($name == "") { $name="<input type=text name='nbcolname[]' size='20' />"; }

		print "<font class='T2'>$name </font></td>";
		$j++;
		if ($j == 3) { print "</tr><tr>"; $j=0; }
		$liste.= $value."%##%";

	}
	print "</tr></table>";
	print "<br>";
	$liste=ereg_replace("%##%$","",$liste);
	print "<input type='hidden' name='liste' value=\"$liste\" />";
}
?>
</font>
<br>
<center><input type="submit" value="Suivant -->" class="BUTTON" name="create" /> </center>
</form>
<br>

<br />
<!-- // fin  -->
</td></tr></table>
<BR>
<SCRIPT language="JavaScript" src="<?php print './librairie_js/'.$_SESSION[membre].'2.js'?>"> </SCRIPT>
<SCRIPT language="JavaScript">InitBulle("#000000","#FFFFFF","red",1);</SCRIPT>
</BODY></HTML>
