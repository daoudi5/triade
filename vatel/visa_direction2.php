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
if (isset($_POST["annee_scolaire"])) {
        $anneeScolaire=$_POST["annee_scolaire"];
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
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
<script language="JavaScript" src="../librairie_js/lib_trimestre.js"></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL206 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param12.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href="visa_direction.php" ><?php print LANGVATEL207 ?></a></li>
				<li style="visibility:visible" ></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
<form method=post name="formulaire" action="visa_direction3.php"  >

 <!-- // debut form  -->
<?php
if (isset($_POST["consult"])) {
	$saisie_classe=$_POST["saisie_classe"];
//	$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire='$anneeScolaire' ORDER BY nom";

	 $sql=" SELECT s.* FROM ( SELECT libelle,elev_id,nom,prenom,date_naissance,regime,numero_eleve,code_compta,nomtuteur,prenomtuteur,civ_1,telephone,email FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire='$anneeScolaire' UNION ALL SELECT c.libelle,e.elev_id,e.nom,e.prenom,e.date_naissance,e.regime,e.numero_eleve,e.code_compta,e.nomtuteur,e.prenomtuteur,e.civ_1,e.telephone,e.email FROM ${prefixe}eleves e ,${prefixe}classes c, ${prefixe}eleves_histo h WHERE h.idclasse='$saisie_classe' AND e.elev_id=h.ideleve AND h.idclasse=c.code_class AND h.annee_scolaire='$anneeScolaire') s  ORDER BY s.nom";


	$res=execSql($sql);
	$data=chargeMat($res);

	// nom classe
	$cl=$data[0][0];
	$tri=$_POST["saisie_trimestre"];

	if (defined("NBCARBULLPROFP")) { $nbcar=NBCARBULLPROFP;  }else{ $nbcar="500"; }

	print "<br /><font class=T2>&nbsp;&nbsp;&nbsp;".LANGELE4." : <b>$cl</b></font><br />";
	print "<br /><font class=T2>&nbsp;&nbsp;&nbsp;".LANGTMESS465." $tri  /  $anneeScolaire <br /><br />";



	print "<table align=center width=100%>";

	

	if( count($data) > 0 ) {
			
		for($i=0;$i<count($data);$i++) {
	

			$ideleve=$data[$i][1];
			print "<tr>";
			print "<td valign='top' width='5' ><img style=\"padding-top:24px;padding-right:6px\" src=\"image_trombi.php?idE=".$ideleve."\" border='0' ></td>";
			print "<td valign='top' >";
			print "<input type=hidden value=\"".$data[$i][1]."\" name='eleveid[]' />";
			print LANGTMESS481." : <b> ".ucfirst($data[$i][3])." ".strtoupper($data[$i][2])."</b>";
			$com=recherche_com($ideleve,$tri,$_POST["type_bulletin"],$anneeScolaire);
			print "<br><textarea cols=60 rows=5 name='comm[]' onkeypress=\"compter(this,'$nbcar', this.form.CharRestant_$i)\" >$com</textarea>";
			$nbtexte=strlen($com);
			print "&nbsp;<input type=text name='CharRestant_$i' size=3 disabled='disabled' value='$nbtexte' />";
			print "<br /></td></tr>";

			if (($_POST["type_bulletin"] == "montessori") || ($_POST["type_bulletin"] == "montessori_spec")){
			      $montessori=recherchemontessori($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire);
			      $montessori=$montessori[0][0];
			      if (trim($montessori) == "felicitation")  { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      if ($montessori == "satisfaction")  { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      if ($montessori == "encouragement") { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
			      print "<tr><td colspan='2' >\n";
			      print "&nbsp;&nbsp;";
			      print "Aucun <input type='radio' name='montessori_${ideleve}' value='' />&nbsp;&nbsp;\n";
			      print "Félicitations <input type='radio' name='montessori_${ideleve}' value='felicitation' $checkedmont1 />&nbsp;&nbsp;\n";
			      print "Satisfactions <input type='radio' name='montessori_${ideleve}' value='satisfaction' $checkedmont2 />&nbsp;&nbsp;\n";
			      print "Encouragements <input type='radio' name='montessori_${ideleve}' value='encouragement' $checkedmont3 />&nbsp;&nbsp;\n";
			      print "</td></tr>";
			}

			if ($_POST["type_bulletin"] == "univproafrique") {
			      $montessori=recherchemontessori($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire);
			      $montessori=$montessori[0][0];
			      if (trim($montessori) == "Insuffisant")  { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      if ($montessori == "Satisfaisant")  { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      if ($montessori == "Excellent") { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
			      print "<tr><td colspan='2' >\n";
                              print "&nbsp;&nbsp;";
							  print "Participation à la vie associative de l'école : ";
                              print "Supprimé <input type='radio' name='montessori_${ideleve}' value='' />&nbsp;&nbsp;\n";
                              print "Insuffisant <input type='radio' name='montessori_${ideleve}' value='Insuffisant' $checkedmont1 />&nbsp;&nbsp;\n";
                              print "Satisfaisant <input type='radio' name='montessori_${ideleve}' value='Satisfaisant' $checkedmont2 />&nbsp;&nbsp;\n";
                              print "Excellent <input type='radio' name='montessori_${ideleve}' value='Excellent' $checkedmont3 />&nbsp;&nbsp;\n";
                              print "</td></tr>";
			}


			if ($_POST["type_bulletin"] == "pigierparis") {
				$leap=rechercheleap($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire); 
				//leap_encouragement,leap_felicitation,leap_meg_comp,leap_meg_trav,pp_av_trav,pp_av_comp,pp_enc,pp_feli
			      	if ($leap[0][4]  == "1") { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      	if ($leap[0][5]  == "1") { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      	if ($leap[0][6]  == "1") { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
			      	if ($leap[0][7]  == "1") { $checkedmont4="checked='checked'"; }else{ $checkedmont4=""; }
			      	print "<tr><td colspan='2' >\n";
			      	print "&nbsp;&nbsp;";
			      	print "Avertissement travail <input type='checkbox' name='pp_av_trav_${ideleve}' value='1' $checkedmont1 />&nbsp;&nbsp;\n";
			      	print "Avertissement comportement <input type='checkbox' name='pp_av_comp_${ideleve}' value='1' $checkedmont2 />&nbsp;&nbsp;\n";
			      	print "Encouragement <input type='checkbox' name='pp_enc_${ideleve}' value='1' $checkedmont3 title='Encouragement' />&nbsp;&nbsp;\n";
			      	print "Félicitations <input type='checkbox' name='pp_feli_${ideleve}' value='1' $checkedmont4 title='Félicitations' />&nbsp;&nbsp;\n";
			      	print "</td></tr>";
			}

			if ($_POST["type_bulletin"] == "pigierparisv2") {
				$leap=rechercheleap($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire); 
				//leap_encouragement,leap_felicitation,leap_meg_comp,leap_meg_trav,pp_av_trav,pp_av_comp,pp_enc,pp_feli,ppv2_av,ppv2_faible,ppv2_passable,ppv2_enc,ppv2_feli
			      	if ($leap[0][8]  == "1") { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      	if ($leap[0][9]  == "1") { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      	if ($leap[0][10]  == "1") { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
				if ($leap[0][11]  == "1") { $checkedmont4="checked='checked'"; }else{ $checkedmont4=""; }
				if ($leap[0][12]  == "1") { $checkedmont5="checked='checked'"; }else{ $checkedmont5=""; }
			      	print "<tr><td colspan='2' >\n";
			      	print "&nbsp;&nbsp;";
			      	print "Avertissement <input type='checkbox' name='pp2_av_${ideleve}' value='1' $checkedmont1 />&nbsp;&nbsp;\n";
			      	print "Faible <input type='checkbox' name='pp2_faible_${ideleve}' value='1' $checkedmont2 />&nbsp;&nbsp;\n";
			      	print "Passable <input type='checkbox' name='pp2_passable_${ideleve}' value='1' $checkedmont3 />&nbsp;&nbsp;\n";
			      	print "Encouragement <input type='checkbox' name='pp2_enc_${ideleve}' value='1' $checkedmont4 title='Encouragement' />&nbsp;&nbsp;\n";
			      	print "Félicitations <input type='checkbox' name='pp2_feli_${ideleve}' value='1' $checkedmont5 title='Félicitations' />&nbsp;&nbsp;\n";
			      	print "</td></tr>";
			}



			if ($_POST["type_bulletin"] == "leap") {
				$leap=rechercheleap($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire); //leap_encouragement,leap_felicitation,leap_meg_comp,leap_meg_trav
			      if ($leap[0][1] == "1")  { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      if ($leap[0][2]  == "1")   { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      if ($leap[0][0]  == "1") { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
			      if ($leap[0][3]  == "1") { $checkedmont4="checked='checked'"; }else{ $checkedmont4=""; }
			      print "<tr><td colspan='2' >\n";
			      print "&nbsp;&nbsp;";
			  //  print "Aucun <input type='checkbox' name='montessori_${ideleve}' value='' />&nbsp;&nbsp;\n";
			      print "Félicitations <input type='checkbox' name='leap_felicitation_${ideleve}' value='1' $checkedmont1 />&nbsp;&nbsp;\n";
			      print "Encour. <input type='checkbox' name='leap_encouragement_${ideleve}' value='1' $checkedmont3 title='Encouragement' />&nbsp;&nbsp;\n";
			      print "MEG Comp. <input type='checkbox' name='leap_megcomp_${ideleve}' value='1' $checkedmont2 title='Mise en garde comportement' />&nbsp;&nbsp;\n";
			      print "MEG Trav. <input type='checkbox' name='leap_megtrav_${ideleve}' value='1' $checkedmont4 title='Mise en garde travail' />&nbsp;&nbsp;\n";
			      print "</td></tr>";
			}

			if ($_POST["type_bulletin"] == "jtc") {
				$jtc=recherchejtc($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire); 
			      if ($jtc[0][0] == "1")    { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      if ($jtc[0][1]  == "1")   { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      if ($jtc[0][2]  == "1")   { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
			        print "<tr><td colspan='2' >\n";
			      print "&nbsp;&nbsp;";			   
			      print "Promu <input type='checkbox' name='jtc_promu_${ideleve}' value='1' $checkedmont1 title='Promu' />&nbsp;&nbsp;\n";
			      print "Classe à reprendre <input type='checkbox' name='jtc_reprendre_${ideleve}' value='1' $checkedmont2 title='Classe à reprendre' />&nbsp;&nbsp;\n";
			      print "Orientation Ailleurs <input type='checkbox' name='jtc_orientation_${ideleve}' value='1' $checkedmont3 title='Orientation Ailleurs' />&nbsp;&nbsp;\n";	
			      print "</td></tr>";		
			}
				

			if ($_POST["type_bulletin"] == "seminaire") {
				$montessori=recherchemontessori($ideleve,$_POST["type_bulletin"],$tri,$anneeScolaire);
			      if ($montessori == "felicitation")  { $checkedmont1="checked='checked'"; }else{ $checkedmont1=""; }
			      if ($montessori == "tabhonneur")  { $checkedmont2="checked='checked'"; }else{ $checkedmont2=""; }
			      if ($montessori == "encouragement") { $checkedmont3="checked='checked'"; }else{ $checkedmont3=""; }
			      if ($montessori == "deconduite")  { $checkedmont4="checked='checked'"; }else{ $checkedmont4=""; }
			      if ($montessori == "detravail") { $checkedmont5="checked='checked'"; }else{ $checkedmont5=""; }
			      print "<tr><td colspan='2' >\n";
			      print "&nbsp;&nbsp;";
			      print "Aucun <input type='radio' name='montessori_${ideleve}' value='' />&nbsp;&nbsp;\n";
			      print "Félicitations <input type='radio' name='montessori_${ideleve}' value='felicitation' $checkedmont1 />&nbsp;&nbsp;\n";
			      print "Tableau d'Honneur <input type='radio' name='montessori_${ideleve}' value='tabhonneur' $checkedmont2 />&nbsp;&nbsp;\n";
			      print "Encouragements <input type='radio' name='montessori_${ideleve}' value='encouragement' $checkedmont3 />&nbsp;&nbsp;\n";
			      print "</td></tr>";
			      print "<tr><td colspan='2' >\n";
			      print "&nbsp;&nbsp;";
			      print "Avertissement de conduite <input type='radio' name='montessori_${ideleve}' value='deconduite' $checkedmont4 />&nbsp;&nbsp;\n";
			      print "Avertissement de travail <input type='radio' name='montessori_${ideleve}' value='detravail' $checkedmont5 />&nbsp;&nbsp;\n";
			      print "</td></tr>";
			}
			
			print "<tr><td colspan='2' ><hr></td></tr>";
			


		}
		$valider=VALIDER;
		print "<tr><td colspan=2 ><br><br><script language=JavaScript>buttonMagicSubmitVATEL('$valider','create');</script>";
		include_once("../librairie_php/lib_conexpersistant.php"); 
		connexpersistance("color:black;font-weight:bold;font-size:11px;text-align: center;"); 
		print "</td></tr>";
		print '<input type=hidden name="saisie_trimestre" value="'.$tri.'" />';
		print "<input type=hidden name='saisie_classe' value=\"".$_POST["saisie_classe"]."\" />";
		print "<input type=hidden name='saisie_nb' value='".count($data)."' />";
		print "<input type=hidden name='type_bulletin' value='".$_POST["type_bulletin"]."' />";
		print "<input type=hidden name='anneeScolaire' value='$anneeScolaire' />";
		print "</form>";	
			
	}else{
		print("<tr><td align=center ><font class=T2>".LANGRECH1."</font></td></tr>");
	}
	print "</table>";
}

?>
<br><br>

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