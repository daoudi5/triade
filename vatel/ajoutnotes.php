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

$idprof=$mySession[Spid];
$inputadmin="";
$nomduprof="";
if (isset($_POST["saisie_pers"])) {
	$idprof=$_POST["saisie_pers"];
	$_SESSION["idprofviaadmin"]=$idprof;
}

if (isset($_SESSION["idprofviaadmin"])) {
	$idprof=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($idprof);
}


// données DB utiles pour cette page
$sql="
SELECT
	a.code_classe,
	trim(c.libelle),
	a.code_matiere,
";
$sql .= " CONCAT( trim(m.libelle),' ',trim(m.sous_matiere),' ',trim(IFNULL(langue,''))), ";
$sql .= "
	a.code_groupe,
	trim(g.libelle)
FROM
	${prefixe}affectations a,
	${prefixe}matieres m,
	${prefixe}classes c,
	${prefixe}groupes g
WHERE
	code_prof='$idprof'
	AND a.code_classe = c.code_class
	AND a.code_matiere = m.code_mat
	AND a.code_groupe = group_id
	AND (a.visubull = '1' OR a.visubullbtsblanc = '1')
	AND c.offline = '0'
	AND a.annee_scolaire = '$anneeScolaire'
	
GROUP BY a.code_matiere,a.code_classe,a.code_groupe

ORDER BY c.libelle,m.libelle
	";
$curs=execSql($sql);
$data=chargeMat($curs);
@array_unshift($data,array()); // nécessaire pour compatibilité
// patch pour problème sous-matière à 0
for($i=0;$i<count($data);$i++){
	$tmp=explode(" 0 ",$data[$i][3]);
	$data[$i][3]=trim($tmp[0].' '.$tmp[1]);
}
// fin patch
genMatJs('affectation',$data);
freeResult($curs);
unset($curs);


if (($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { ?> 

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL21 ?> - <?php print LANGVATEL26 ?> <?php print $nomduprof ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='ajoutnotes.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='modifiernotes.php' ><?php print LANGVATEL22 ?></a></li>
				<li style="visibility:visible" ><a href='supprimernotes.php' ><?php print LANGVATEL23 ?></a></li>
				<li style="visibility:visible" ><a href='visunotes.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<form method="post" action="ajoutnotes.php" >
        <font class="T2"><?php print LANGBULL29 ?> :</font>
        <select name='anneeScolaire' onChange="this.form.submit()"  class="form-control vat-extend-select pointer" >
        <?php
        filtreAnneeScolaireSelectNote($anneeScolaire,3);
        ?>
        </select>
		<?php print $inputadmin ?>
        <br/>
        </form>
<!-- // fin  -->
<?php
$res=vsuite();
$res=0;
if ($res) {
        print $message;
}else {

	if ($choixmatiere == 0) {
		$onsubmit="onsubmit=\"return verifAccesNotebis()\"";
	}else{
		$onsubmit="onsubmit=\"return verifAccesNote()\"";
	}

?>
<form method="POST" <?php print $onsubmit ?> name="formulaire" action="ajoutnotes2.php" >
<font class="T2"><?php print LANGPROFG ?> :</font>
<select name="sClasseGrp" size="1" onChange="upSelectMat(this)" class="form-control vat-extend-select pointer" >
<option value="0" > <?php print LANGCHOIX3 ?> </option>
	<?php
		for($i=1;$i<count($data);$i++){
			 	if( $i>1 && ($data[$i][4]==$gtmp) && ($data[$i][0]==$ctmp) ){
					continue;
				}else{
					// utilisation de l'opérateur ternaire expr1?expr2:expr3;
					$libelle=$data[$i][4]?$data[$i][1]."-".$data[$i][5]:$data[$i][1];
					print "<option class='select1' value=\"".$data[$i][0].":".$data[$i][4]."\">".ucfirst($libelle)."</option>\n";
				}
				$gtmp=$data[$i][4];
				$ctmp=$data[$i][0];
		}
		unset($gtmp);
		unset($ctmp);
		unset($libelle);
	?>
	</select>
	<br />

	<font class="T2"><?php print LANGPROF1 ?> :</font>

	<select name="sMat" size="1" class="form-control vat-extend-select pointer" > <!-- saisie_matiere -->
            <option value="0" ><?php print LANGCHOIX ?></option>
	</select>
	<BR>

	<font class="T2"><?php print LANGMESS78  ?> :</font>   <select name="trier" class="form-control vat-extend-select pointer" >
	<option value="nomeleve" <?php print $selectTrieNom ?>  >Nom</option>
	<option value="classe"  <?php print $selectTrieClasse ?>   >Classe</option>
    	</select>
	<BR>
	<?php
    if (NOTEUSA == "oui") {
    ?>
    <font class="T2"><?php print LANGDISC59  ?> :</font>   <select name="NoteUsa" class="form-control vat-extend-select pointer"  >
					                    <option value="non"  >Non</option>
					                    <option value="oui"  >Oui</option>
                                       </select>
    <?php
        print "<br><br>";
    }
    ?>
    <font class="T2"><?php print LANGPROF2 ?> :</font>
    <?php
        print "<select name='sNbNote' class='form-control vat-extend-select pointer'  >";
                 					   for($j=1;$j<=NOTEPROF;$j++) {
                 					   		if ($j == 1) {
                 					   			$couleur="class='select1'";
                 					   		}else{
                 					   			$couleur="class='select1'";
                 					   		}
                 				       		print "<option value='$j' $couleur >$j</option>";
                                       }
                                 ?>
                 </select><BR>
		<font class="T2"><?php print LANGGRP56 ?> :</font>
                 <select name='NotationSur' class="form-control vat-extend-select pointer"  >                 					   	
			<?php 
			      $info=0;
			      if (NOTATION40 == "oui") { $info=1;?>
				   <option value="40" >40</option>
			<?php }
			      if (NOTATION30 == "oui") { $info=1;?>
				   <option value="30" >30</option>
			<?php } 
			      if (NOTATION20 == "oui") { $info=1;?>
				   <option value="20" selected='selected' class='select1'>20</option>
			<?php } 
			      if (NOTATION15 == "oui") { $info=1;?>
				   <option value="15" class='select1'>15</option>
			<?php } 
			      if (NOTATION10 == "oui") { $info=1;?>
				   <option value="10" class='select1'>10</option>
			<?php } ?>
			<?php if (NOTATION5 == "oui") { $info=1; ?>
				   <option value="5" class='select1'>05</option>
			<?php } ?>
			<?php if ($info == 0) { ?>
				   <option value="20" class='select1'>20</option>
			<?php } ?>
		
                 
                 </select><BR>
		<?php
                 if (NOTEEXAMEN == "oui") {
			 // voir aussi fichier notemodif3.php si ajout d'élèment
			 // voir aussi fichier notevisuadmin.php si ajout d'élèment
                 	?>

			<font class="T2"><?php print LANGDISC60  ?> :</font>
					<select name="NoteExam" class="form-control vat-extend-select pointer"  >
							<option value="" STYLE="color:#000066;background-color:#FCE4BA">non</option>
					<?php if (EXAMENBLANC == "oui") { ?>
						<optgroup label="Blanc" />
						<?php if (PRODUCTID != "2b85614b9c7cc3e8f7f02fe4fd52e907") { ?>
					        	<option value="Brevet Blanc"  class='select1'>Brevet Blanc</option>
						        <option value="Brevet Professionnel Blanc"  class='select1'>Brevet Professionnel Blanc</option>
						        <option value="BAC Blanc"  class='select1'>BAC Blanc</option>
						        <option value="CAP Blanc"  class='select1'>CAP Blanc</option>
						        <option value="BEP Blanc"  class='select1'>BEP Blanc</option>
						<?php } ?>
					        <option value="BTS Blanc"  class='select1'>BTS Blanc</option>
					        <option value="Partiel Blanc"  class='select1'>Partiel Blanc</option>
						<?php if (PRODUCTID != "2b85614b9c7cc3e8f7f02fe4fd52e907") { ?>
							<option value="Concours Blanc"  class='select1'>Concours Blanc</option>
						<?php } ?>
					<?php } ?>
					<?php if (EXAMENNAMUR == "oui") { ?>							
							<optgroup label="Spécif. Namur" />
					                <option value="décembre"  class='select1'>Décembre</option>
							<option value="juin" class='select1'>Juin</option>
					<?php } ?>
					<?php if (EXAMENPIGIERNIMES == "oui") { ?>
							<optgroup label="PIGIER" />
							<option value="ND" class='select1'>Note Devoir (DS)</option>
						        <option value="NP" class='select1'>Note Participation</option>
							<option value="DS" class='select1'>DS</option>
							<option value="examen" class='select1'>Examen</option>
							<option value="examen blanc" class='select1'>Examen Blanc</option>
					<?php } ?>
					<?php if (EXAMENISMAP == "oui") { ?>
						    <optgroup label="ISMAP" />
						    <option value="CC" class='select1'>CC</option>
						    <option value="DST" class='select1'>DST</option>
						   <!-- <option value="Partiel" class='select1'>Partiel</option> -->
						  <!--  <option value="Soutenance" class='select1'>Soutenance</option> -->
						    <option value="Rapport" class='select1'>Rapport</option>
						    <option value="Fiche de lecture" class='select1'>Fiche de lecture</option>
						    <option value="Exposé" class='select1'>Expos&eacute;</option>
  						    <option value="Dad" class='select1'>Dad</option>
					<?php } ?>
					<?php if (EXAMENDS == "oui") { ?>
							<optgroup label="DS" />
							<option value="DS1"  class='select1'>DS1</option>
							<option value="DS2"  class='select1'>DS2</option>
							<option value="DS3"  class='select1'>DS3</option>
							<option value="DS4"  class='select1'>DS4</option>
					<?php } ?>
					<?php if (EXAMEN == "oui") { ?>	
							<optgroup label="Examen" />
							<option value="Partiel"  class='select1'>Partiel</option>
					<?php } ?>
					<?php if (EXAMENISPACADEMIES == "oui") { ?>
						    <optgroup label="ISP ACADEMIES" />
						    <option value="ISP" class='select1'>ISP</option>
					<?php } ?>
					<?php if (EXAMENCIEFORMATION == "oui") { ?>							
							<optgroup label="Spécif. Cie. Formation" />
					        <option value="TAS"  class='select1'>TAS</option>
							<option value="BTS Blanc" class='select1'>BTS Blanc</option>
							<option value="Partiel Blanc" class='select1'>Partiel Blanc</option>
					<?php } ?>
					<?php if (EXAMENEEPP == "oui") { ?>
							<optgroup label="Spécif. EEPP" />
   							<option value="semestre" class='select1'>Semestriel</option>
   							<option value="2session" class='select1'>2ème session</option>
					<?php } ?>
					<?php if (EXAMENJTC == "oui") { ?>
                            <optgroup label="Spécif. JTC" />
                            <option value="jtc" class='select1'>Carnet</option>
                    <?php } ?>
					<?php if (EXAMENIPAC == "oui") { ?>
							<optgroup label="IPAC" />
							<option value="Partiel" class='select1'>Partiel</option>
   							<option value="Rattrapage" class='select1'>Rattrapage</option>
   							<option value="Examen complémentaire" class='select1'>Examen complémentaire</option>
   							<option value="Contrôle continu" class='select1'>Contrôle continu</option>
					<?php } ?>
					<?php if (EXAMENBREVETCOLLEGE == "oui") { ?>
							<optgroup label="Brevet Collège" />
						   	<option value="Brevet EPS" class='select1'>Brevet EPS</option>
							<option value="Brevet PREV. SANTE ENV." class='select1'>Brevet PREV. SANTE ENV.</option>
					<?php } ?>
                    </select>
                 	<?php
                 	print "<br>";
                 }
                 ?>
		<font class="T2"><?php print LANGMESS79 ?> :</font>
		<input type="text" name="notevisiblele" size='12'  value="<?php print dateDMY(); ?>" class="dateInput" >
		<?php
 		include_once("../librairie_php/calendar.php");
 		calendarVatel("id1","document.formulaire.notevisiblele",$lang,"0");
		?> 
		<br><br>
		<input type='submit' class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print LANGBT31 ?>" name='rien' >
		<br>
		</form>

<?php } ?>
	
		</section>
		</div>
		</div>
	</div>
<?php 
} 
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>
