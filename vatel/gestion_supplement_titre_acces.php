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

include_once('../librairie_php/recupnoteperiode.php');
validerequete("menuadmin");


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
			<span class="vat-capitalize-title"><?php print LANGVATEL206 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param12.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_examen.php' ><?php print LANGVATEL211 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php
print "<form method='post' action='gestion_supplement_titre_acces.php'   name='formulaire' onsubmit=\"return valide_supp_choix('sClasseGrp','".LANGCLASSE."')\" >";
?>
<BR>
<font class="T2"><?php print LANGPER25 ?> : </font><select name="sClasseGrp">
<option   STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX ?></option>
<?php
select_classe(); // creation des options
?>
</select> 
<br><br>
<?php
$data=recupListeSupplementAuTitre();
//libelle,fichier
print "<font class='T2'>".LANGTMESS510."</font>";
print "<select name='doc' >";
print "<option STYLE='color:#000066;background-color:#FCE4BA'>".LANGCHOIX."</option>";
for($i=0;$i<count($data);$i++) {
	$libelle=$data[$i][0];
	$fichier="./data/parametrage/".$data[$i][1];
	print "<option value=\"$fichier\" >$libelle</font>";
}
print "</select>";
?>
<br><br>
<table><tr><td><script language=JavaScript>buttonMagicSubmitVATEL("<?php print VALIDER ?>","creatett"); //text,nomInput</script></tr></table>
</form>


<?php 
if (isset($_POST["creatett"])) {

	$ficRTF=$_POST['doc'];
	$idClasse=$_POST['sClasseGrp'];

	$idsite=chercheIdSite($idClasse);
	$data=visu_paramViaIdSite($idsite);
	// nom_ecole,adresse,postal,ville,tel,email,directeur,urlsite,academie,pays,departement
	$nom_etablissement=trim($data[0][0]);
	$nom_directeur=trim($data[0][6]);

	print "<hr>";

	$nbEtudiant=nbEleveTotal();

	$nom_classe_long=chercheClasse_nomLong($idClasse);
	$classeNom=chercheClasse_nom($idClasse);

	if (!is_dir("../data/pdf_certif/supplement_titre/")) { mkdir("../data/pdf_certif/supplement_titre/"); }
	mkdir("../data/pdf_certif/supplement_titre/".$classeNom);

	$datedujour=dateDMY();

	$eleveT=recupEleve($idClasse); // recup liste eleve
	for($j=0;$j<count($eleveT);$j++) {  // premiere ligne de la creation PDF
		// variable eleve
		$nomEleve=ucwords($eleveT[$j][0]);
		$prenomEleve=ucfirst($eleveT[$j][1]);
		$idEleve=$eleveT[$j][4];

		$TempFilename="$ficRTF";
		$fichier=fopen($TempFilename,"r");
		$texte=fread($fichier,filesize($TempFilename));
		fclose($fichier);	

		$dataadresse=chercheadresse($idEleve);
		$INEEleve=$dataadresse[0][9];
		$dateNaissanceEleve=dateForm($dataadresse[0][11]);


		$historyEtudiant="";
		$dataHisto=recherche_stage_historique($idEleve); //e.nom,s.nomprenomeleve,s.classeeleve,s.periodestage,s.trimestre,s.langue
		//$historyEtudiant="School / Ecole - Company / Société - Date - Service";
		$historyEtudiant="(School / Ecole - Company / Société - Date) \\par ";
		for($a=0;$a<count($dataHisto);$a++){
			$nomEt=$dataHisto[$a][0];
			$periode=$dataHisto[$a][3];
			$semestre=$dataHisto[$a][4];
			if ($semestre == 0) $semestre="";
			$Lang=$dataHisto[$a][5];
			if ($Lang == "") $Lang="French / English";
			$periode=preg_replace('/au/','-',$periode);
			//$historyEtudiant.="$nom_etablissment  - $nomEt - $periode - $nom_service";
			$historyEtudiant.="$nom_etablissement  - $nomEt - $periode \\par ";
		}

		$specification=chercherSpecificationClasse($idClasse);

		$texte=preg_replace('/NBETUDIANTS/',"$nbEtudiant",$texte); 			// => Nombre d'étudiants
		$texte=preg_replace('/HISTOETUDIANT/',"$historyEtudiant",$texte); 		// => Parcours de l'étudiant
		$texte=preg_replace('/NOMETUDIANT/',"$nomEleve",$texte); 			// => Nom de l'étudiant
		$texte=preg_replace('/PREETUDIANT/',"$prenomEleve",$texte); 			// => Prénom de l'étudiant
		$texte=preg_replace('/DATENAISETUDIANT/',"$dateNaissanceEleve",$texte); 	// => Date de naissance de l'étudiant
		$texte=preg_replace('/IDENTETUDIANT/',"$INEEleve",$texte); 			// => Code d'identification de l'étudiant
		$texte=preg_replace('/NOMETABLISSEMENT/',"$nom_etablissement",$texte); 		// => Nom de l'établissement de l'étudiant
		$texte=preg_replace('/DATEDUJOUR/',"$datedujour",$texte);	 		// => date du jour
		$texte=preg_replace('/SPECIALISATION/',"$specification",$texte); 		// => spécification de la classe
		$texte=preg_replace('/NOMDIRECTEUR/',"$nom_directeur",$texte); 			// => Nom du directeur de l'établissement
		$texte=preg_replace('/NOMCLASSELONG/',"$nom_classe_long",$texte); 		// => Nom de la classe format long 


		$langueclasse=recupLangueClasse($idClasse); 
		$NBRETUDIANTA2=nbEtudiantNiveau("A2"); 
		$NBRETUDIANTA4=nbEtudiantNiveau("A4"); 
		$NBRETUDIANTPREPA=nbEtudiantNiveau("PREPA"); 

		$NBRETUDIANTPREPAA4=$NBRETUDIANTPREPA+$NBRETUDIANTA4;

		$texte=preg_replace('/LANGUEETUDIANT/',"$langueclasse",$texte); 
		$texte=preg_replace('/NBRETUDIANTPA2/',"$NBRETUDIANTA2",$texte); 
		$texte=preg_replace('/NBRETUDIANTPA1/',"$NBRETUDIANTPREPAA4",$texte); 
		$texte=preg_replace('/NBRETUDIANTM4/',"$NBRETUDIANTA4",$texte); 
		$texte=preg_replace('/NBRETUDIANTPREPA/',"$NBRETUDIANTPREPA",$texte);

		$nomEleve=preg_replace("/'/","",$nomEleve);
		$prenomEleve=preg_replace("/'/","",$prenomEleve);
		$nomEleve=preg_replace("/ /","_",$nomEleve);
		$prenomEleve=preg_replace("/ /","_",$prenomEleve);
		$nomfic="Supplement_titre_${nomEleve}_${prenomEleve}.rtf";
		$fic="../data/pdf_certif/supplement_titre/$classeNom/$nomfic";
		$fichier=fopen("$fic","a+");
		fwrite($fichier,$texte);
		fclose($fichier);
		unset($texte);

	}

	include_once('../librairie_php/pclzip.lib.php');
	@unlink('../data/pdf_certif/supplement_titre/'.$classeNom.'.zip');
	$archive = new PclZip('../data/pdf_certif/supplement_titre/'.$classeNom.'.zip');
	$archive->create('../data/pdf_certif/supplement_titre/'.$classeNom,PCLZIP_OPT_REMOVE_PATH, '../data/pdf_certif/supplement_titre/');
	$fichier='../data/pdf_certif/supplement_titre/'.$classeNom.'.zip';
	//$bttexte="Récupérer le fichier ZIP Suppléments Titre";
	$bttexte=LANGTMESS511;
	@nettoyage_repertoire('../data/pdf_certif/supplement_titre/'.$classeNom);
	@rmdir('../data/pdf_certif/supplement_titre/'.$classeNom);


?>
	<center><input type=button onclick="open('telecharger.php?fichier=<?php print $fichier?>&fichiername=<?php print $fichier ?>','_blank','');" value="<?php print $bttexte ?>" class='btn btn-primary btn-sm  vat-btn-footer' /></center>
<?php
}
?>

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
