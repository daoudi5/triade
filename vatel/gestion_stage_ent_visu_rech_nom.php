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
<script language="JavaScript" src="../librairie_js/lib_pulldown.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL226 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_visu.php' ><?php print LANGVATEL225 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_ajout.php' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGMESS149 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGASS10 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<br><br>
<?php
// connexion (après include_once lib_licence.php obligatoirement)

if (isset($_GET["recherche"])) {
	$recherche=$_GET["recherche"];
}else{
	$recherche=$_POST["recherche"];
}
print "<font class=T2><ul>";

print LANGASS19." : <b> ".stripslashes($recherche)." </b><br><br><br>";
$data=recherche_entreprise_nom($recherche);
// id_serial,nom,contact,adresse,code_p,ville, 5
// secteur_ac,activite_prin,tel,fax,email,info_plus, 11
// bonus,contact_fonction,pays_ent,registrecommerce,siren, 16
// siret,formejuridique,secteureconomique,INSEE, 20 
// NAFAPE,NACE,typeorganisation,qualite 24
	if (count($data) > 0 ) {

		for($i=0;$i<count($data);$i++) {
			if ($data[$i][12] == null) {
				$bonus="";
			}else{
				$bonus=$data[$i][12];
			}
?>

			<table bgcolor="#FFFFFF" border=1 bordercolor="#000000" width=80% >
			<tr><td id='bordure' ><font class="T2">
			<?php print LANGAGENDA61 ?> : <font color=red><?php print $data[$i][1] ?></font> <br> 
			<?php print LANGSTAGE33 ?> : <?php print  $data[$i][7] ?><br>
			<?php print LANGVATEL228 ?> : <b><?php print $bonus ?></b>
			</font>
			<div align=right>[ <a href="#" onclick="slidedown_showHide('box1');return false;"><?php print LANGSTAGE62 ?> +</a> ]&nbsp;&nbsp;&nbsp;</div>
			</td></tr></table>

<div>
	<div id="dhtmlgoodies_control"></div>
	<div style="width:870px;" class="dhtmlgoodies_contentBox" id="box1">
		<div class="dhtmlgoodies_content" id="subBox1">
		<font class=T2>
		<?php print "Registre du commerce" ?> : <b><?php print $data[$i][15] ?></b>  <br><br>
		<?php print "SIREN" ?> : <b><?php print $data[$i][16] ?></b>  <br><br>
		<?php print "SIRET" ?> : <b><?php print $data[$i][17] ?></b>  <br><br>
		<?php print "Forme Juridique" ?> : <b><?php print $data[$i][18] ?></b>  <br><br>
		<?php print "Secteur Economique" ?> : <b><?php print $data[$i][19] ?></b>  <br><br>
		<?php print "INSEE" ?> : <b><?php print $data[$i][20] ?></b>  <br><br>
		<?php print "NAF (APE)" ?> : <b><?php print $data[$i][21] ?></b>  <br><br>
		<?php print "NACE" ?> : <b><?php print $data[$i][22] ?></b>  <br><br>
		<?php print "Type Organisation" ?> : <b><?php print $data[$i][23] ?></b>  <br><br>

		<?php print LANGSTAGE28 ?> : <b><?php print $data[$i][3] ?></b>  <br><br>
		<?php print LANGSTAGE30 ?> : <b><?php print $data[$i][5] ?> </b> <br><br>
		<?php print LANGSTAGE29 ?> : <b><?php print $data[$i][4] ?></b> <br><br>
		<?php print LANGAGENDA73 ?> : <b><?php print $data[$i][14] ?></b> <br><br>
		<?php print LANGSTAGE27 ?> : <b><?php print $data[$i][2] ?> </b>(<?php print $data[$i][13] ?> )<br><br>
		<?php print LANGSTAGE42 ?> : <b><?php print $data[$i][8] ?> / <?php print $data[$i][9] ?></b> <br><br>
		<?php print LANGSTAGE36 ?> : <b><?php print $data[$i][10] ?> </b><br><br>
		<?php print "Qualit&eacute;" ?>&nbsp;:&nbsp;<b><?php print $data[$i][24] ?> </b><br><br>
		<?php print LANGSTAGE37 ?>&nbsp;:&nbsp;<b><?php print $data[$i][11] ?></b> <br><br>
		<?php print LANGVATEL229 ?>&nbsp;:&nbsp;<a href="#" onclick="open('http://support.triade-educ.com/support/google-map-V3-triade.php?etablissement=<?php print  urlencode($data[$i][1])?>&adresse=<?php print urlencode($data[$i][3]) ?>&ville=<?php print urlencode($data[$i][5]) ?>&pays=<?php print urlencode($data[$i][14])?>','_blank','width=450,height=350')" /><img src="image/commun/loupe.png" border="0" /></a><br><br><br>
		<hr>
		<font class='T1'>
		<u><?php print LANGVATEL230 ?></u> :<br><br>
		<?php
			//identreprise,nomprenomeleve,classeeleve,periodestage
			$datalisting=listingHistorique($data[$i][0]);
			for ($j=0;$j<count($datalisting);$j++) {
				$nomprenom=$datalisting[$j][1];
				$classe=$datalisting[$j][2];
				$periode=$datalisting[$j][3];
				print ucwords($nomprenom)." ($classe) du $periode <br />";
			}
		?>	
		</font>
		<br><br>
 		</font>
		</div>
	</div>
</div>


<script type="text/javascript">
setSlideDownSpeed(4);
</script>
			


<br><br>
<?php
		}
	}else {
		 print "<font class=T2>".LANGSTAGE43.".</font><br><br>";
	}
print "<br>";
print "</font>[<a href='gestion_stage_ent_visu.php'>".LANGSTAGE41."</a>]<br><br> ";
print "</ul>";
?>
		
			
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