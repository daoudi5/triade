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
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Gestion d'examen" ?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
<!-- // debut form  -->
<?php
include_once("./librairie_php/lib_licence.php"); 
include_once("librairie_php/db_triade.php");
validerequete("menuadmin");
$cnx=cnx();


$datap=config_param_visu("contnotanet");
$contnotanet=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("notehistarts");
$notehistarts=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("notehistgeo");
$notehistgeo=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("noteeducivi");
$noteeducivi=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("noteA2");
$noteA2=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("epsviaexamen");
$checkepsviaexamen=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("noteeviescolaire");
$noteeviescolaire=($datap[0][0] == "1") ? "checked='checked'" : "";
$datap=config_param_visu("prevsanteenv");
$checkprev_sante_envviaexamen=($datap[0][0] == "1") ? "checked='checked'" : "";

?>
<form method="post" action="notanet_export2.php" onsubmit="return valide_consul_classe()" name="formulaire">
<blockquote><BR>
<font class=T2><?php print LANGBULL3 ?> :</font>
<?php print $_COOKIE["anneeScolaire"] ?>
<br><br>
<font class=T2><?php print LANGPROFG?> :</font> 
<select id="saisie_classe" name="saisie_classe">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?>
</select> <BR>
<BR>
<font class=T2>S�rie :</font> <select name="serie" >
<option value="LV2" id='select1'><?php print "Coll�ge, option de s�rie LV2" ?></option>
<option value="DP6" id='select1'><?php print "Coll�ge, option D�couverte Prof. 6h (DP6)"  ?></option>
<option value="STA" id='select1'><?php print "Coll�ge, S�rie Professionnelle option agricole"  ?></option>
</select>
<br><br>
<font class='T2'>Prendre en compte l'histoire des arts :  </font><input type=checkbox <?php print $notehistarts ?> value='1' name='notehistarts' > <i>(oui)</i><br><br>
<font class='T2'>Prendre en compte le niveau A2 :  </font><input type=checkbox <?php print $noteA2 ?> value='1' name='noteA2' > <i>(oui)</i><br><br>
<font class='T2'>Prendre en compte l'histoire g�ographie :  </font><input type=checkbox <?php print $notehistgeo ?> value='1' name='notehistgeo' > <i>(oui)</i><br><br>
<font class='T2'>Prendre en compte l'�ducation civique :  </font><input type=checkbox <?php print $noteeducivi ?> value='1' name='noteeducivi' > <i>(oui)</i><br><br>
<font class='T2'>Prendre en compte la vie scolaire :  </font><input type=checkbox <?php print $noteeviescolaire ?> value='1' name='noteviescolaire' > <i>(oui)</i><br><br>
<font class='T2'>Effectuer un contr�le avant l'extraction :  </font><input type=checkbox <?php print $contnotanet ?> value='1' name='controle' > <i>(oui)</i><br><br>
<font class='T2'>Mati�re "EPS" via "Examen Brevet" : </font><input type='checkbox' name="epsviaexamen" value='1' <?php print $checkepsviaexamen ?> /> <i>(oui)</i><br><br>
<font class='T2'>Mati�re "SANTE ENV." via "Exam. Brevet" : </font><input type='checkbox' name="prev_sante_envviaexamen" value='1' <?php print $checkprev_sante_envviaexamen ?> /> <i>(oui)</i><br><br>
<UL><UL><UL>
<script language=JavaScript>buttonMagicSubmit("<?php print VALIDER ?>","create"); //text,nomInput</script>
<input type=hidden name="typebull" value="brevetcollege3" />
<form>
<br><br>

<!-- // fin form -->
</td></tr></table>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."2.js'>" ?></SCRIPT>
</BODY>
</HTML>
