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

validerequete("menuadmin");
// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$idpers=$mySession[Spid];
?>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGMODIF4 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='recherche_eleve.php' ><?php print LANGPER30 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_compte_eleve.php' ><?php print LANGBT50 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
// affichage de l'élève (lecture seule)
$eid=$_GET["eid"];
if($eid)
// $eid provient(entre autres) de la page recherche_eleve.php
{
$sql=<<<EOF

SELECT
	elev_id,
	nom,
	prenom,
	c.libelle,
	lv1,
	lv2,
	`option`,
	regime,
	date_naissance,
	lieu_naissance,
	nationalite,
	passwd,
	passwd_eleve,
	adr_eleve,
	commune_eleve,
	ccp_eleve,
	tel_fixe_eleve,
	boursier,
	montant_bourse,
	indemnite_stage,
	emailpro_eleve,
	rangement,
	cdi,
	bde,
	situation_familiale,
	civ_1,
	nomtuteur,
	prenomtuteur,	
	adr1,
	code_post_adr1,
	commune_adr1,
	tel_port_1,
	civ_2,
	nom_resp_2,
	prenom_resp_2,
	adr2,
	code_post_adr2,
	commune_adr2,
	tel_port_2,
	telephone,
	profession_pere,
	tel_prof_pere,
	profession_mere,
	tel_prof_mere,
	nom_etablissement,
	numero_etablissement,
	code_postal_etablissement,
	commune_etablissement,
	numero_eleve,
	email,
	email_eleve,
	class_ant,
	annee_ant,
	tel_eleve,
	email_resp_2,
	sexe,
	code_compta,
	information,
	classe
FROM
	${prefixe}eleves, ${prefixe}classes c
WHERE
	elev_id='$eid'
AND	c.code_class=classe

EOF;
$res=execSql($sql);
$data=chargeMat($res);
$idClasse=$data[0][58];
?>
<?php
if( count($data) <= 0 ) {
	print(LANGEDIT1);
} else { //debut else
?>
<div ><a href="#" onclick="open('../photoajouteleve.php?ideleve=<?php print $eid?>','photo','width=450,height=280')"><img src="image_trombi.php?idE=<?php print $eid ?>" border=0 ></a><br />[ <a href="#" class="bouton2"  onclick="open('../photoajouteleve.php?ideleve=<?php print $eid?>','photo','width=450,height=280')" >modifier</a> ]</div><br><br>
<input type=button value="<?php print LANGBT52?>" onclick="open('modif_eleve.php?eid=<?php print $data[0][0]?>','_parent','')"   class="btn btn-primary btn-sm  vat-btn-footer"  >
<?php
if (isset($_GET["val"])) { inactifEleve($_GET["eid"],$_GET["val"]); }
$inactif=getInactifEleve($data[0][0]);
if ($inactif == "1") {
	$bouton="D&eacute;bloquer ce compte";
	$inactifval="0";
	$img="<font id='color2'><img src='../image/commun/warning2.gif' align='center' /><b>COMPTE BLOQUE</b></font>";
}else{
	$bouton="Bloquer ce compte";
	$inactifval="1";
}

print $img;

if ($_SESSION["membre"] == "menuadmin") { ?>
<input type=button value="<?php print $bouton ?>" onclick="open('edit_eleve.php?eid=<?php print $data[0][0]?>&val=<?php print $inactifval?>','_parent','')"   class="btn btn-primary btn-sm  vat-btn-footer"   >&nbsp;
<?php } ?>
</form>
<br><br>
<?php
	$nom_cellule=array( id, LANGELE2, LANGELE3, LANGELE4, "Lv1/Spe", "Lv2/Spe", LANGELE5, LANGELE6, LANGELE10, LANGEDIT6, LANGELE11, LANGIMP51,LANGIMP52, "adresse eleve","commune eleve","code postal eleve","telephone fixe eleve","Boursier","Montant de la bourse","Indemnite de stage","Email Universitaire","N° Rangement / Info","Inscription a la bibliotheque","Inscription au BDE" , "Situation Familiale", LANGEDIT7, LANGEDIT8, LANGEL12,  LANGEL14, LANGEL15, LANGEL16, LANGEDIT2,  LANGEDIT3, LANGEDIT4, LANGEDIT5, LANGEL18, LANGEL19, LANGEL20, LANGEDIT9, LANGEL21, LANGEL22, LANGEL23, LANGEL24, LANGEL25, LANGEL26, LANGEL27, LANGEL28, LANGEL29, LANGEL30,  LANGELE244. LANGEDIT10, LANGEDIT11,LANGbasededoni41, LANGbasededoni42,LANGEDIT12,LANGEDIT13,"sexe","Code comptabilite","Information");

print "<table>";		
for($i=1;$i<count($data[0]);$i++)
{//debut for
		if ($i == 58) continue;
		if(ereg("[a-zA-Z0-9äâîïûüèé]{1,}",trim($data[0][$i]))) {
			if($i==8) {$data[0][$i]=dateForm($data[0][$i]);}
			if($i==1) {$data[0][$i]=strtoupper($data[0][$i]);}
			if($i==2) {$data[0][$i]=ucwords($data[0][$i]);}
			if($i==11) {$data[0][$i]="xxxxxxxxx";}
			if($i==12) {$data[0][$i]="xxxxxxxxx";}
			if(($i==25) && (trim($data[0][$i]) != "")) { $data[0][$i]=civ($data[0][$i]); }
			if(($i==32) && (trim($data[0][$i]) != "")) { $data[0][$i]=civ($data[0][$i]); }
			if ($data[0][$i] == "") { $data[0][$i]="&nbsp;"; }
			if($nom_cellule[$i]== "Information") { $data[0][$i]=nl2br($data[0][$i]); }
			if ($i==17) { if ($data[0][$i]==1) { $data[0][$i]=LANGOUI; }else{ $data[0][$i]=LANGNON; } }
			if ($i==18) {$data[0][$i]=affichageFormatMonnaie($data[0][$i])." ".unitemonnaie();  }
			if ($i==19) {$data[0][$i]=affichageFormatMonnaie($data[0][$i])." ".unitemonnaie(); }
			if ($i==22) { if ($data[0][$i]==1) { $data[0][$i]=LANGOUI; }else{ $data[0][$i]=LANGNON; } }
			if ($i==23) { if ($data[0][$i]==1) { $data[0][$i]=LANGOUI; }else{ $data[0][$i]=LANGNON; } }

?>
		<tr><td width=40% align=right><B><?php print $nom_cellule[$i]?> :</B> </td>
		    <td ><?php print $data[0][$i]?></td></tr>
		<?php
		}
		/*
		else {
		?>
		<tr><td bgcolor="#FFFFFF" width=40% align=right><B><?php print $nom_cellule[$i]?> :</B> </td>
		<td bgcolor="#FFFFFF"><font color="red"><?php print LANGERROR2?></font></td></tr>
		<?php
		} */
		}//fin for
    }//fin else
print "</table>";
}
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
