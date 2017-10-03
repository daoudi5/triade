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
 
$anneeScolaire=$_COOKIE["anneeScolaire"];
if (isset($_POST["anneeScolaire"])) {
        $anneeScolaire=$_POST["anneeScolaire"];
        setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}
 
 if (isset($_COOKIE["langue-triade"])) {
	$lang=$_COOKIE["langue-triade"];
}else{
	$lang="fr";
}

if (isset($_GET["lang"])) {
	$lang=$_GET["lang"];
	setcookie("langue-triade","$lang",time()+3600*24*2);
}


if (strtolower($lang) == "fr") { include_once("../librairie_php/langue-text-fr.php"); }
if (strtolower($lang) == "en") { include_once("../librairie_php/langue-text-en.php"); }

include_once("../common/config2.inc.php");
include_once("../common/config.inc.php");
include_once('../librairie_php/db_triade.php');

?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade©, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="../librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
<script language="JavaScript" src="../librairie_js/function.js"></script>
<title> Ecole Internationale d'h&ocirc;tellerie et de management Vatel </title>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/superslides.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/pikaday.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/masonry.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/layout-responsive.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/color_scheme/darkblue.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/vatel.css" rel="stylesheet" type="text/css" media="screen"> 
    <link href="css/vatel-print.css" rel="stylesheet" type="text/css" media="print">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
	<?php
if (strtolower($lang) == "fr") { print "<script src='../librairie_js/langue-function-fr.js' ></script>"; print "<script>var lang_lang='fr_FR'; </script>"; }
if (strtolower($lang) == "en") { print "<script src='../librairie_js/langue-function-en.js' ></script>"; print "<script>var lang_lang='en';    </script>"; }
	?>
</head>
<body>
<?php
if (empty($_SESSION["adminplus"])) {
        print "<script>";
        print "location.href='./param9.php'";
        print "</script>";
        exit;
}
$cnx=cnx2();
$cdata=chercheClasse($_POST["saisie_classe_envoi"]);
$cid=$cdata[0][0];
$cnom=trim($cdata[0][1]);
$tri=$_POST["saisie_tri"];


// affectation
if(createAffectation($cdata)):
	alertJs(LANGPER32." $cnom ".LANGPER23bis);
	if ($_POST["suppnote"] == "oui") {
		vide_notes_classe($_POST["saisie_classe_envoi"],$_POST["anneeScolaire"]);
		history_cmd($_SESSION["nom"],"MODIF","Affectation - note supprime - $cnom - $anneeScolaire ");
	}else{
		history_cmd($_SESSION["nom"],"MODIF","Affectation - note non supprime - $cnom - $anneeScolaire ");
	}
else:
	alertJs(LANGPER32." $cnom ".LANGPER32bis);
	//error(0);
endif;
// affichage
$sql=<<<SQL
SELECT
	CONCAT(trim(m.libelle),' ',trim(m.sous_matiere)),
	CONCAT(upper(trim(p.nom)),' ',trim(p.prenom)),
	a.coef,
	trim(g.libelle),
	langue,
	visubull,
	visubullbtsblanc,
	nb_heure,
	ects,
	id_ue_detail,
	specif_etat
FROM
	${prefixe}matieres m,${prefixe}personnel p,${prefixe}affectations a,${prefixe}groupes g
WHERE
	a.code_matiere = m.code_mat
AND a.code_prof = p.pers_id
AND a.code_groupe = g.group_id
AND p.type_pers = 'ENS'
AND a.code_classe = '$cid'
AND a.trim = '$tri'
AND a.annee_scolaire = '$anneeScolaire'
ORDER BY
	a.ordre_affichage
SQL;
$curs=execSql($sql);
$data=chargeMat($curs);
freeResult($curs);
?>

<table border="0" cellpadding="3" cellspacing="1" bgcolor="#0B3A0C" width=90%  align=center>
<tr><td height="2"><b><font   id='menumodule1' ><?php print LANGTITRE20?>&nbsp;<font  color="#99CCFF"><?php print $cnom?></font> / <?php print LANGBULL3 ?> : </font>
<font  color="#99CCFF"><?php print $anneeScolaire ?></font>

</b></td></tr>
<tr>
     <td >
	<br />
	<ul>
	<?php print LANGPER22?>&nbsp;:&nbsp;
	<a href="#" onclick="print_affectation()"><img src="../image/print.gif" alt="Imprimer" align="center" border="0" /></a>
	</ul>

     <!-- //  debut -->
	<table border="0" width="100%" style="border-collapse: collapse;" >
	<TR>
		<TD>
		<TABLE border="1"  width="100%">
		<tr bgcolor='black' >
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print LANGPER17?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print LANGPER18?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;
			<font color='#FFFFFF'><b><?php print LANGPER19?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;
			<font color='#FFFFFF'><b><?php print LANGPER20?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print LANGPER21?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print "Visu."?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print "Visu.&nbsp;BTS&nbsp;Blanc"?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print "Nb&nbsp;d'heure"?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print "ECTS"?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print "Unités&nbsp;Enseignements"?></b></font>&nbsp;&nbsp;
			</TD>
			<TD align="center">&nbsp;&nbsp;<font color='#FFFFFF'><b>
			<?php print "Spécif." ?></b></font>&nbsp;&nbsp;
			</TD>

		</tr>
		<!-- ici résultat -->
		<?php
		htmlTrMatAffec($data);
		?>
		<!-- fin résultat -->
		</TD>
	</TR>
	</TABLE>
     <!-- // fin  -->
    </td>
</tr>
</table>
<br />
<center>
<input type='button' value="<?php print LANGFERMERFEN?>" onclick="parent.window.close()"  class='btn btn-primary btn-sm  vat-btn-footer' >
</center>
<br />
<?php Pgclose() ?>
</BODY>
</HTML>
