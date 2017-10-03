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
<title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom] "?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" >
<?php
include_once("./librairie_php/lib_licence.php");
include_once("librairie_php/db_triade.php");
$cnx=cnx();
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<?php
// affichage de la classe

if (isset($_POST["createregime"])) {
	$ideleve=$_POST["ideleve"];
	$regime=$_POST["regime"];
	$nb=$_POST["nb"];
	for($i=0;$i<=$nb;$i++) { 
		miseAjourRegime($ideleve[$i],$regime[$i]);
	}

}

if(isset($_POST["sClasseGrp"])) {
	$saisie_classe=$_POST["sClasseGrp"];
	$sql="SELECT libelle,elev_id,nom,prenom,regime FROM ${prefixe}eleves ,${prefixe}classes WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);
	// ne fonctionne que si au moins 1 �l�ve dans la classe
	// nom classe
	$cl=$data[0][0];
?>
	<form method="post" action='regime_affectation2.php' >
	<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
	<tr id='coulBar0' ><td height="2" colspan=3><b><font   id='menumodule1' ><?php print LANGELE4 ?> : <font id="color2"><B><?php print $cl?></font> / <?php print LANGCOM3 ?> <font id="color2"><?php print count($data) ?></font></font></td>
	</tr>
	<?php
	if( count($data) <= 0 ) {
		print("<tr id='cadreCentral0' ><td align=center valign=center>".LANGPROJ6."</td></tr>");
	}else {
	?>
		<tr bgcolor="#FFFFFF">
		<td><B><?php print LANGELE2 ?></B></td><td><B><?php print LANGELE3 ?></B></td><td width=5%><b><?php print "R�gime" ?></b></td>
		</tr>
	<?php 
		for($i=0;$i<count($data);$i++) { 
			$regime=$data[$i][4];
	?>
			<tr class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
			<td><?php print strtoupper($data[$i][2])?><input type='hidden' name='ideleve[]' value='<?php print $data[$i][1] ?>' /></td>
			<td><?php print ucwords($data[$i][3])?></td>
			<td><select name='regime[]' >
				<?php
				if ($regime != "") {
					print "<option value=\"$regime\" id='select1' >$regime</option>";
				} ?>
			    	<option value='' id='select0' ><?php print "" ?></option>
				<?php select_regime2() ?>
				</select>
			</td>
			</tr>
	<?php
		}
	}
		print "<tr bgcolor='#FFFFFF' >";
		print "<td colspan='3' align='center'><input type='submit' class='BUTTON' value='Enregistrer' name='createregime' />";
		print "	 <input type='button' class='BUTTON' value='Retour' onclick=\"open('regime_affectation.php','_parent','');\" /></td></tr>";
		print "</table>";
		print "<input type='hidden' name='sClasseGrp' value='".$_POST["sClasseGrp"]."' />";
		print "<input type='hidden' name='nb' value='".count($data)."' />";
		print "</form>";
}

// Test du membre pour savoir quel fichier JS je dois executer
if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire") ):
	print "<SCRIPT language='JavaScript' ";
	print "src='./librairie_js/".$_SESSION['membre']."2.js'>";
	print "</SCRIPT>";
else :
	print "<SCRIPT language='JavaScript' ";
	print "src='./librairie_js/".$_SESSION['membre']."22.js'>";
	print "</SCRIPT>";
	top_d();
	print "<SCRIPT language='JavaScript' ";
	print "src='./librairie_js/".$_SESSION['membre']."33.js'>";
	print "</SCRIPT>";
endif ;
?>

<?php
// deconnexion en fin de fichier
Pgclose();
?>
</BODY>
</HTML>
