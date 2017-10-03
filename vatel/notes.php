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
 ?>
<?php include_once("entete.php"); ?>
<?php include_once("menu.php"); ?>
<?php $cnx=cnx2(); ?>


<?php 
if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")) { ?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu'  >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGCARNET24 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='notes.php?saisie_trimestre=trimestre1' ><?php print LANGPROJ19 ?></a></li>
				<li style="visibility:visible" ><a href='notes.php?saisie_trimestre=trimestre2' ><?php print LANGPROJ20 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>
		<div class='espace'></div>
		<div style="width:100%;background-color:#F4F5F7;">
		<section class="container" style="padding-top:10px">
		<table align=center style="width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);" >
		<tr bgcolor='#2199da' >
		<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' >&nbsp;<?php print LANGPER17?></font></b></td>
		<td valign=top align=center style="border-bottom:1px solid #000000" ><b><font size='2' color='#FFFFFF' >Moy Partiel</font></b></td>
		<td valign=top align=center style="border-bottom:1px solid #000000" ><b><font size='2' color='#FFFFFF' >Moy P&eacute;riode</font></b></td>
		<td valign=top align=center style="border-bottom:1px solid #000000" ><b><font size='2' color='#FFFFFF' ><?php print LANGPROJ15?></font></b></td>
		<?php if (!$isPhone) { ?>
			<td valign=top align=center style="border-bottom:1px solid #000000" ><b><font size='2' color='#FFFFFF' ><?php print "ECTS"?></font></b></td>
		<?php } ?>
		</tr>

		<?php
		// recupe du nom de la classe
		$idClasse=$_SESSION["idClasse"];
		$data=chercheClasse($idClasse);
		$ideleverecup=$_SESSION["id_pers"];
		$classe_nom=$data[0][1];
	
		include_once('../librairie_php/recupnoteperiode.php');
		if(!isset($_GET["saisie_trimestre"])) { 
			$sem=1; 
			$saisie_trimestre="trimestre1"; 
		}else{
			if ($_GET["saisie_trimestre"] == "trimestre1" ) {  $sem=1; }
			if ($_GET["saisie_trimestre"] == "trimestre2" ) {  $sem=2; }
			if ($_GET["saisie_trimestre"] == "trimestre3" ) {  $sem=3; }
			$saisie_trimestre=$_GET["saisie_trimestre"];
		}

		// recuperation des coordonnées
		// de l'etablissement
		$data=visu_paramViaIdSite(chercheIdSite($idClasse));
		for($i=0;$i<count($data);$i++) {
		       $nom_etablissement=trim($data[$i][0]);
		       $adresse=trim($data[$i][1]);
		       $postal=trim($data[$i][2]);
		       $ville=trim($data[$i][3]);
		       $tel=trim($data[$i][4]);
		       $mail=trim($data[$i][5]);
		}
		// fin de la recup


		// recherche des dates de debut et fin
		$dateRecup=recupDateTrimByIdclasse($saisie_trimestre,$idClasse);
		for($j=0;$j<count($dateRecup);$j++) {
			$dateDebut=$dateRecup[$j][0];
			$dateFin=$dateRecup[$j][1];
		}
		$dateDebut=dateForm($dateDebut);
		$dateFin=dateForm($dateFin);

		$anneeScolaire=$_COOKIE["anneeScolaire"];

		$noteMoyEleG=0; // pour la moyenne de l'eleve general
		$coefEleG=0; // pour la moyenne de l'eleve general
		$eleveT=recupEleve($idClasse,$anneeScolaire); // recup liste eleve


		$moyenClasseGen=""; // pour le calcul moyenne classe
		$nbeleve=0;
		$noteMoyEleG1=0; // pour la moyenne  general
		$coefEleG1=0; // pour la moyenne  general
		$nbmatiere=0;  // pour la moyenne general

		// ----------------------------


		$noteMoyEleG=0;
		$coefEleG=0;
		$afficheMoyen="oui";

		for($j=0;$j<count($eleveT);$j++) {  // premiere ligne
			
			// variable eleve
			$lv1Eleve=$eleveT[$j][2];
			$lv2Eleve=$eleveT[$j][3];
			$idEleve=$eleveT[$j][4];
		
			if ($idEleve != $_SESSION["id_pers"]) { continue; }
		
		
			$recupUE=recupUE($idClasse,$sem); //code_ue,nom_ue,coef_ue,ects_ue
			
			$ectsTOTALP1=0;
			$ectsTOTALP2=0;
		
			for($f=0;$f<count($recupUE);$f++) {
				$code_ue=$recupUE[$f][0];
				$nom_ue=$recupUE[$f][1];
				$coef_ue=$recupUE[$f][2];
				$ects_ue=$recupUE[$f][3];

				$listeMatiere=recupMatiereUE($code_ue);  // u.code_matiere,m.libelle,u.code_enseignant
			
				print "<tr>";
				print "<td bgcolor='#eeeeee' valign='top' colspan='5' style='border-bottom:1px solid #000000' ><font class='T2' color='#000000' >&nbsp;&nbsp;".strtoupper($nom_ue)."</font>  </td>";
				print "</tr>";

				// u.code_matiere,m.libelle
				for($i=0;$i<count($listeMatiere);$i++) {
					$X=$Xorigine;
					
					$idmatiere=$listeMatiere[$i][0];
					$idMatiere=$listeMatiere[$i][0];
					$matiere=$listeMatiere[$i][1];
					$idprof=$listeMatiere[$i][2];
					$ordreaffichage=$listeMatiere[$i][3];

					$coeffaffTotal=0;
					$matiere=chercheMatiereNom($idmatiere);
					$nomprof=recherche_personne($idprof);

					$verifGroupe=verifMatiereAvecGroupeUE($idmatiere,$idEleve,$idClasse,$ordreaffichage);
					if ($verifGroupe) {  continue; } // verif pour l'eleve de l'affichage de la matiere
		
					// recupe de l'id du groupe //idMatiere,$idEleve,$idClasse
					$idgroupe=verifMatierAvecGroupeRecupId($idMatiere,$idEleve,$idClasse,$ordreaffichage);


					$datasousmatiere=verifsousmatierebull($idMatiere);
					//	print $datasousmatiere;
					if ($datasousmatiere != "0") {
						$nomMatierePrincipale=$datasousmatiere[0][2];
						$nomSousMatiere=$datasousmatiere[0][1];
						$matiere="$nomMatierePrincipale $nomSousMatiere";
					}

					// mise en place du nom du prof
				        $profAff=recherche_personne($idprof);

				        // mise en place des coeff
					$coeffaff=recupCoeff($idMatiere,$idClasse,$ordreaffichage);
	
					$ects=recupECTS($idmatiere,$idClasse,$saisie_trimestre);
			
					$coef=recupCoefUE($idmatiere,$idClasse,$saisie_trimestre);
					$coeffaff=$coef;
	
					$tri=$saisie_trimestre;
	
					// mise en place des matieres
					print "<tr >";
					print "<td valign='top' style='border-bottom:1px solid #000000'  ><font size='2'>&nbsp;".trunchaine(strtoupper($matiere),25)." (".$coeffaff.")</font>";
					print "<span class='nophone2' ><br><i><font size=1> ".trunchaine(trim($profAff),40)." </font></i></span>";
					print "</td>";

		
					include_once('../librairie_php/fonctions_vatel.php');
					$notepartiel = recupNotepartiel($idEleve,$idMatiere,$dateDebut,$dateFin,$idClasse);
					$moy_partiel_eu='';
					$som_coef_partiel_eu=0;
					for ($nb_note=0;$nb_note<count($notepartiel);$nb_note++) { 
						if ($notepartiel[$nb_note][0]>=0 && is_numeric($notepartiel[$nb_note][0])) {$nb_mat+=1;
							$moy_partiel_eu+=$notepartiel[$nb_note][6]*$notepartiel[$nb_note][0];
							$som_coef_partiel_eu+=$notepartiel[$nb_note][6];
							$moyenne_ue+=$notepartiel[$nb_note][6]*$notepartiel[$nb_note][0];
							$somme_coef+=$notepartiel[$nb_note][6];
							$affich_coef_partiel =$notepartiel[$nb_note][6];
						}else{
							$affich_coef_partiel="";
						}
					}
					$moy_coef_partiel="";
					if (count($notepartiel)>0) {
						$moy_coef_partiel=$som_coef_partiel_eu/count($notepartiel);
						$moy_coef_partiel="($moy_coef_partiel)";
					}
					$affich_coef_partiel='';
					if ($moy_partiel_eu >=0 && is_numeric($moy_partiel_eu) ) {
						$affiche_note = $moy_partiel_eu/$som_coef_partiel_eu ;
					} else {
						$affiche_note = "";
					}			
					print "<td align='center' style='border-bottom:1px solid #000000' ><font size='3'>$affiche_note $moy_coef_pariel</font></td>";

					// mise en place moyenne eleve
					// mise en place des notes
		
					$noteaff="";
					$noteperiode=recupNoteperiode($idEleve,$idmatiere,$dateDebut,$dateFin);
					$moyenne_periode='';
					$nb_note_periode=0;
					$som_coef_periode=0;
					for ($nb_note=0;$nb_note<count($noteperiode);$nb_note++) { 
						if ($noteperiode[$nb_note][0]>=0 && is_numeric($noteperiode[$nb_note][0]) && count($noteperiode)>0) {
							$moyenne_periode+=$noteperiode[$nb_note][0]*$noteperiode[$nb_note][6];
							$nb_note_periode+=1;
							$som_coef_periode+=$noteperiode[$nb_note][6];
						}
					}
					$moyenne_periode=$moyenne_periode/($som_coef_periode);
					$som_coef_periode_ue+= $som_coef_periode;
					$som_coef_periode=0;
					$moyenne_periode_ue+=$moyenne_periode;
					if ($nb_note_periode>0) { $nb_note_periode_ue++; $nb_mat_per++; }
					if ($moyenne_periode >=0 && is_numeric($moyenne_periode) && $nb_note_periode>0) { 
						$noteaff=number_format($moyenne_periode,2,'.','');
					}
					$noteaff1=$noteaff;
					if ($noteaff1 < 10) { $couleur="red"; }else{ $couleur="black"; }
					if ($noteaff >= 10) { 
						$ectsTotal+=$ects; 
					}else{
						$ects=0;
					}
		
					if (trim($noteaff1) == "") {
						$noteaff1='---';
						$couleur="black";
						$b="<i>";
						$bb="</i>";
					}

				    	print "<td align='center' style='border-bottom:1px solid #000000' >&nbsp;";
				    	print "<font size=3 color=$couleur>$b $noteaff1 $bb</font></td>";

					// mise en place des moyennes matieres de classe
					$notetype="";
					unset($moyeMatGen);

		
					if (($idgroupe == "0") || (trim($idgroupe) == "")) { 
						// idMatiere,datedebut,dateFin,idclasse
			       	  		$moyeMatGen=moyeMatGen($idmatiere,$dateDebut,$dateFin,$idClasse,$idprof);
					}else {
		        			$moyeMatGen=moyeMatGenGroupe($idmatiere,$dateDebut,$dateFin,$idgroupe,$idprof);
					}
					$moyeMatGenaff=$moyeMatGen;
		
					$color='#FFFFFF';
					print "<td align='center' style='border-bottom:1px solid #000000' > <font size=3 >$moyeMatGenaff</td>";
		
					// Mise en place ECTS
					if (!$isPhone) print "<td align='center' style='border-bottom:1px solid #000000' ><font size=3 >$ects</td>";
		
					print "</tr>";
					// pour le calcul de la moyenne general de l'eleve
					if (( trim($noteaff) != "" ) && ( $noteaff >= 0 )) {
						$noteMoyEleGTempo=0;
						$noteMoyEleG += $coeffaff * $noteaff;
						$coefEleG += $coeffaff ;
		
						$moyenEU += $noteaff * $coeffaff;
						$coeffEU += $coeffaff ;
					}
					if (($moyeMatGen >= 0) && ( trim($noteaff) != "" )) { 
						$moyenMatEU +=$moyeMatGen * $coeffaff;
						$coeffMatEU += $coeffaff ;
					}
		
					if ($moyeMatGenaff != "") {
						$coefGNCLASS+=$coef;
						$moyGNCLASS+=$moyeMatGenaff*$coef;
					//	$minUECLASS+=$moyeMatGenMinaff*$coef;
					//	$maxUECLASS+=$moyeMatGenMaxaff*$coef;
					}
	
				}
				if ($coeffEU > 0) $moyenEU=$moyenEU/$coeffEU;
				if ($coeffMatEU > 0) $moyenMatEU=$moyenMatEU/$coeffMatEU;
				print "<tr>";
				print "<td align='right' style='border-bottom:1px solid #000000' ><font class='T2'>".LANGMESS82." : </font></td>";
				print "<td style='border-bottom:1px solid #000000' ></td>";
				if ($moyenEU != "") { 
					print "<td align='center' style='border-bottom:1px solid #000000' ><font size=3 >".number_format($moyenEU,2,',','')."</font></td>";
				}else{
					print "<td align='center' style='border-bottom:1px solid #000000' >&nbsp;</td>";
					
				}
				if ($moyenMatEU != "") {
					print "<td align='center' style='border-bottom:1px solid #000000' ><font size=3 >".number_format($moyenMatEU,2,',','')."</font></td>";
				}else{
					print "<td align='center' style='border-bottom:1px solid #000000' >&nbsp;</td>";
			
				}
				print "<td colspan='2' style='border-bottom:1px solid #000000' ></td>";
				print "</tr>";
				unset($moyenEU);
				unset($coeffEU);
				unset($moyenMatEU);
				unset($coeffMatEU);
			}	

		// fin notes
		// --------

		// affichage de la moyenne generale eleve
		if ($moyGNCLASS != "") {
			$moyGNCLASS=$moyGNCLASS/$coefGNCLASS;
			if (($moyGNCLASS < 10) && ($moyGNCLASS != "")) { $moyGNCLASS="0".$moyGNCLASS; }
			$moyGNCLASS = number_format($moyGNCLASS, 2, '.', '');
		}else{
			$moyGNCLASS="";
		}
	
		$moyenEleve=moyGenEleve($noteMoyEleG,$coefEleG);
		if (($moyenEleve == " ") || ($moyenEleve < 0)) { $moyenEleve="&nbsp;"; }
		$noteMoyEleG=0; // pour la moyenne de l'eleve general
		$coefEleG=0; // pour la moyenne de l'eleve general
		$color="black";
		if ($moyenEleve < 10) { $color="red"; }
	 
		print "<tr  bgcolor='red' ><td align='right' ><font class='T2'  color='#FFFFFF' >&nbsp;".LANGVATEL6." : </font></td>";
		print "<td></td>";
		print "<td align=center><b><font size=3 color='#FFFFFF' >";
		print "$moyenEleve";
		print "</font></b></td>";
		print "<td align=center><font size='3' color='#FFFFFF' >$moyGNCLASS</font></td>";
		if (!$isPhone)	print "<td align=center><font color='#FFFFFF' size='3' ><b>$ectsTotal</b></font></td>";
		print "</tr>";
	
		unset($ectsTotal);
		// fin affichage


	} // fin du for on passe à l'eleve suivant
?>
	</table>


	</section>
	</div>
	</div>
	</div>
<?php 
} /* fin du IF du membre eleve */ ?>    
	
<?php Pgclose(); ?>
<br><br>	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
		
<!-- <SCRIPT type="text/javascript">InitBulle("#000000","#CCCCCC","#000000",1);</SCRIPT> -->
</body>
</html>
