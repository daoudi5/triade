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
$cnx=cnx2();

?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content ="no-cache">
<META http-equiv="pragma" content ="no-cache">
<META http-equiv="expires" content ="-1">
<meta name="Copyright" content="Triade©, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="../librairie_js/function.js"></script>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
<script language="JavaScript" src="../librairie_js/lib_css.js"></script>
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
    <script language="JavaScript" src="../librairie_js/clickdroit2.js"></script>
    <script language="JavaScript" src="../librairie_js/function.js"></script>
    <script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
    <script language="JavaScript" src="../librairie_js/lib_css.js"></script>
</head>
<body id='bodyfond2' >
<?php
validerequete("menuadmin");
validerequete2($_SESSION["adminplus"]);
if (!empty($_SESSION["adminplus"])) {
	$cnx=cnx2();
	verif_table_groupe();
	verif_table_matiere();
	$tri=$_POST['saisie_tri'];
	$anneeScolaire=$_POST["anneeScolaire"];
	$cdata=chercheClasse($_POST["saisie_classe_envoi"]);
	$cid=$cdata[0][0];
	$cnom=trim($cdata[0][1]);
	if(createAffectation($cdata)):
		alertJs(LANGPER23." $cnom ".LANGPER23bis);
		history_cmd($_SESSION["nom"],LANGaffec_cre31,"$cnom");
	else:
		alertJs( LANGPER23." $cnom ".LANGPER24 );
	endif;
	// la fonction initcap n'existe pas en MySQL (sous cette forme en tout cas)
	// CONCAT remplace ||
	$sql="SELECT CONCAT(trim(m.libelle),' ',trim(m.sous_matiere)),CONCAT(upper(trim(p.nom)),' ',trim(p.prenom)),a.coef,trim(g.libelle),langue,visubull,visubullbtsblanc,nb_heure,ects FROM ${prefixe}matieres m,${prefixe}personnel p,${prefixe}affectations a,${prefixe}groupes g WHERE a.code_matiere = m.code_mat  AND a.code_prof = p.pers_id AND a.code_groupe = g.group_id AND p.type_pers = 'ENS' AND a.code_classe = '$cid' AND trim = '$tri' AND a.annee_scolaire='$anneeScolaire' ORDER BY a.ordre_affichage";
	$curs=execSql($sql);
	$data=chargeMat($curs);
	freeResult($curs);
}
?>
<table border="0" cellpadding="3" cellspacing="1" width=70%  align=center>
<tr><td height="2"><font size=3><b><font><?php print LANGTITRE17?> <font id="color2"><?php print $cnom?></font></font></b>
<font>pour l'ann&eacute;e scolaire </font><font id="color2"><?php print $anneeScolaire ?></font></b></font>
</td></tr>
<tr id='cadreCentral0' >
     <td >
	<br />
	<ul>
	<?php print LANGPER22?> :
	<a href="#" onclick="print_affectation()">
	<img src="../image/print.gif" alt="<?php print LANGaffec_cre41?>" align="center" border="0" /></A>
	</ul>

     <!-- //  debut -->
	<table border="0" bgcolor="#ffffff" width="100%" style='border-collapse: collapse;' >
	<TR>
		<TD>
		<TABLE border="1"  width="100%">
		<tr>
			<!--
			<td align="center">
				Nb
			</td>
			-->
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print LANGPER17?>
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print LANGPER18?>
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			&nbsp;&nbsp;<?php print LANGPER19?>&nbsp;&nbsp;
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			&nbsp;&nbsp;<?php print LANGPER20?>&nbsp;&nbsp;
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print LANGPER21?>
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print "Visu"?>
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print "Visu BTS Blanc"?>
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print "Nb d'heure"?>
			</b></font>
			</TD>
			<TD align="center" bgcolor='black' >
			<font color='white' ><b>
			<?php print "ECTS"?>
			</b></font>
			</TD>
	
		</tr>
		<!-- ici résultat -->
		<?php
		htmlTrMat($data);
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
<input type=button value="<?php print LANGFERMERFEN?>"  onClick="parent.window.close()" class="btn btn-primary btn-sm pull-right vat-btn-footer" />
</center>
<br />
<?php Pgclose() ?>
</BODY>
</HTML>
