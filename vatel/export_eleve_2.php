<?php
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

include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/lib_note.php"); 
$cnx=cnx2();

// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);
validerequete("menuadmin");
$idpers=$mySession[Spid];
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL167 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
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
		print "<option value='' >N&#176;</option>";
		for($i=1;$i<=$nbordre;$i++) {
			print "<option value='$i' >$i</option>";
		}
		print "</select>&nbsp;";
		$name="";
		if ($value == "nom") { $name="nom&nbsp;".INTITULEELEVE; }
		if ($value == "prenom") { $name="prenom&nbsp;".INTITULEELEVE; }
		if ($value == "classe") { $name="classe"; }
		if ($value == "lv1") { $name="LV1"; }
		if ($value == "lv2") { $name="LV2"; }
		if ($value == "option") { $name="Option"; }
		if ($value == "regime") { $name="Régime"; }
		if ($value == "date_naissance") { $name="date&nbsp;naissance"; }
		if ($value == "lieu_naissance") { $name="lieu&nbsp;naissance"; }
		if ($value == "nationalite") { $name="nationalité"; }
		if ($value == "civ_1") { $name="Civ.&nbsp;tuteur&nbsp;1"; }
		if ($value == "nomtuteur") { $name="nom&nbsp;tuteur&nbsp;1"; }
		if ($value == "nomtuteur_2") { $name="nom&nbsp;tuteur&nbsp;2"; }
		if ($value == "prenomtuteur") { $name="prénom&nbsp;tuteur&nbsp;1"; }
		if ($value == "prenomtuteur_2") { $name="prénom&nbsp;tuteur&nbsp;2"; }
		if ($value == "adr1") { $name="adr.&nbsp;tuteur&nbsp;1"; }
		if ($value == "adr2") { $name="adr.&nbsp;tuteur&nbsp;2"; }
		if ($value == "code_post_adr1") { $name="CCP&nbsp;tuteur&nbsp;1"; }
		if ($value == "commune_adr1") { $name="Commune&nbsp;tuteur&nbsp; 1"; }
		if ($value == "tel_port_1") { $name="Tél.&nbsp;port.&nbsp;tuteur&nbsp;1"; }
		if ($value == "civ_2") { $name="Civ.&nbsp;tuteur&nbsp;2"; }
		if ($value == "nom_resp_2") { $name="nom&nbsp;tuteur&nbsp;2"; }
		if ($value == "prenom_resp_2") { $name="prénom&nbsp;tuteur&nbsp;2"; }
		if ($value == "code_post_adr2") { $name="CCP&nbsp;tuteur&nbsp;2"; }
		if ($value == "commune_adr2") { $name="Commune&nbsp;tuteur&nbsp;2"; }
		if ($value == "tel_port_2") { $name="Tél.&nbsp;port.&nbsp;tuteur&nbsp;2"; }
		if ($value == "telephone") { $name="Téléphone"; }
		if ($value == "profession_pere") { $name="Prof.&nbsp;père"; }
		if ($value == "tel_prof_pere") { $name="Tél.&nbsp;prof.&nbsp;père"; }
		if ($value == "profession_mere") { $name="Prof.&nbsp;mère"; }
		if ($value == "tel_prof_mere") { $name="Tél.&nbsp;prof.&nbsp;mère"; }
		if ($value == "nom_etablissement") { $name="Nom&nbsp;établissement"; }
		if ($value == "numero_etablissement") { $name="N°&nbsp;établissement"; }
		if ($value == "code_postal_etablissement") { $name="CCP&nbsp;établissement"; }
		if ($value == "commune_etablissement") { $name="Commune&nbsp;établissement"; }
		if ($value == "numero_eleve") { $name="INE&nbsp;-&nbsp;N°&nbsp;".INTITULEELEVE; }
		if ($value == "email_eleve") { $name="Email&nbsp;".INTITULEELEVE; }
		if ($value == "email_resp_2") { $name="Email&nbsp;Tuteur&nbsp;2"; }
		if ($value == "email") { $name="Email&nbsp;Tuteur&nbsp;1"; }
		if ($value == "class_ant") { $name="Classe&nbsp;antérieur"; }
		if ($value == "annee_ant") { $name="Année&nbsp;antérieur"; }
		if ($value == "tel_eleve") { $name="Tél.&nbsp;".INTITULEELEVE; }
		if ($value == "sexe") { $name="sexe"; }
		if ($value == "code_barre") { $name="Code&nbsp;barre"; }
		if ($value == "email_eleve") { $name="Email&nbsp;".INTITULEELEVE; }
		if ($value == "email_eleve_pro") { $name="Email&nbsp;".INTITULEELEVE."&nbsp;Univ."; }
		if ($value == "annee_scolaire") { $name="Année&nbsp;scolaire."; }
		if ($value == "tel_fixe_eleve") { $name="Tél.&nbsp;fixe&nbsp;".INTITULEELEVE; }
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
<center><input type="submit" value="<?php print LANGBTS ?>" class='btn btn-primary btn-sm  vat-btn-footer' name="create" /> </center>
</form>
<br>
	
		
		</section>
		</div>
		</div>
	</div>
<?php
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>