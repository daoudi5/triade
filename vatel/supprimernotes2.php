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
if (isset($_POST["anneeScolaire"])) {
	$anneeScolaire=$_POST["anneeScolaire"];
	setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}else{
	$anneeScolaire=$_COOKIE["anneeScolaire"];
}

include_once("../librairie_php/lib_error.php");
include_once("../common/config.inc.php");
include_once("../librairie_php/db_triade.php");

include_once("entete.php");
include_once("menu.php");

$cnx=cnx2();

$mySession[Sn]=$_SESSION["nom"];
$mySession[Sp]=$_SESSION["prenom"];
$pid=$_SESSION["id_pers"];
$cgrp=$_POST["sClasseGrp"];
$cgrp=explode(":",$cgrp);
$cid=$cgrp[0];
$idClasse=$cgrp[0];
$gid=$cgrp[1];
$mid=$_POST[sMat];

if ($_POST["adminIdprof"] != "") { $pid=$_POST["adminIdprof"]; }

if (isset($_SESSION["idprofviaadmin"])) {
	$pid=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($pid);
}

$nomClasse=chercheClasse($cid);
$nomClasse=$nomClasse[0][1];
$nomMat=chercheMatiereNom($mid);
$nomGrp=chercheGroupeNom($gid);
$libel=$nomClasse." ".$nomGrp." ".$nomMat;

?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL23 ?> - <?php print LANGVATEL26 ?></span>
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
		<section class="container" style="padding-top:10px" >
		
<?php		

$valeur=affDateTrimByIdclasse('',$cid,$anneeScolaire);
if (count($valeur)) {
	// verif si eleve dans la classe
	//$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$cid' AND code_class='$cid' ";
	$sql="(SELECT e.elev_id, e.nom,e.prenom,e.classe  FROM ${prefixe}eleves e WHERE e.classe='$cid' AND e.annee_scolaire='$anneeScolaire' ) UNION (SELECT e.elev_id,e.nom,e.prenom,e.classe FROM ${prefixe}eleves e , ${prefixe}eleves_histo h WHERE h.idclasse='$cid' AND e.elev_id=h.ideleve AND  h.annee_scolaire='$anneeScolaire'  group by elev_id ) $order";

	$res=execSql($sql);
	$verifdata=chargeMat($res);
	if( count($verifdata) <= 0 )  {
		print("<br><br><br><center><font class=T1>".LANGRECH1."</font></center>");
	}else {


	// fournit les elev_id d'un grp donné
	// sous forme d'une string avec la virgule
	// comme séparateur
	function ElevesDsGrp($gid,$prefixe,$anneeScolaire){
		$sqlIn="
		SELECT
			liste_elev
		FROM
			${prefixe}groupes
		WHERE
			group_id='$gid' AND annee_scolaire='$anneeScolaire'
		";
		$curs=execSql($sqlIn);
		$in=chargeMat($curs);
		$in=$in[0][0];
		$in=substr($in,1);
		$in=substr($in,0,-1);
		return $in;
	}


	if($gid){
		$in=ElevesDsGrp($gid,$prefixe,$anneeScolaire);
			$sqlgroupe=" AND id_groupe='$gid' " ;
	} else {
		//$cid
	/*    $sql="
		SELECT
		elev_id
		FROM
		${prefixe}eleves
		WHERE
		classe='$cid'
		"; */
		$sql="(SELECT e.elev_id, e.nom,e.prenom,e.classe  FROM ${prefixe}eleves e WHERE e.classe='$cid' AND e.annee_scolaire='$anneeScolaire' ) UNION (SELECT e.elev_id,e.nom,e.prenom,e.classe FROM ${prefixe}eleves e , ${prefixe}eleves_histo h WHERE h.idclasse='$cid' AND e.elev_id=h.ideleve  AND  h.annee_scolaire='$anneeScolaire' group by elev_id ) $order";

		// utilisation d'une liste de valeurs plutôt
		// que sous-req pour compatibilité avec MySQL < 4.1
		// mettre dans une transaction pour plus de fiabilité
		$curs=execSql($sql);
		$data = chargeMat($curs);
		for($i=0;$i<count($data);$i++)
		{
		$in[$i] = $data[$i][0];
		}
		$in = join($in,",");
	}


	$date=recupDateTrimIdclasse($cid,$anneeScolaire);
	// date_debut,date_fin,trim_choix,idclasse
	for($p=0;$p<count($date);$p++) {
			$tri=$date[$p][2];
			if ($tri == "trimestre1") $dateDebut=$date[$p][0];
			if ($tri == "trimestre2") $dateFin=$date[$p][1];
			if ($tri == "trimestre3") $dateFin=$date[$p][1];
	}



	if ($in != "") {
	$sql="
	SELECT
		sujet,
	";
	if(DBTYPE=='pgsql')
	{
		$sql .= " to_char(date,'dd/mm/YYYY'), ";
	}
	elseif(DBTYPE=='mysql')
	{
		$sql .= " DATE_FORMAT(date,'%d/%m/%Y'), ";
	}
	$sql .= "
		coef,noteexam
	FROM
		${prefixe}notes
	WHERE
		elev_id IN ($in)
	AND prof_id='$pid'
	AND code_mat='$mid'
	AND date >= '$dateDebut' AND date <= '$dateFin' 
	";
	if ($sqlgroupe != "") {
		$sql.=" $sqlgroupe";
	//}else{
	//	$sql.="AND id_classe='$cid' ";
	}
	$sql.="
	GROUP BY
		date,coef,sujet
	ORDER BY
			date DESC
	";
	$curs=execSql($sql);
	$mat=chargeMat($curs);
	}

	echo "<table width='100%' border='1'  >";
	echo "<tr>";
	echo "<td bgcolor='black' bordercolor='white' align='center'><font color='white'>".LANGPROF16."</font></td>";
	echo "<td bgcolor='black' bordercolor='white' align='center'><font color='white'>".Examen."</font></td>";
	echo "<td bgcolor='black' bordercolor='white' align='center' width='10%'><font color='white'>".LANGPROF17."</font></td>";
	echo "<td bgcolor='black' bordercolor='white' align='center' width='5%'><font color='white'>&nbsp;".LANGPER19."&nbsp;</font></td>";
	echo "<td bgcolor='black' bordercolor='white'align='center' width='5%'><font color='white'>".LANGBT50."</font></td>";
	echo "</tr>";

		if ($gid > 0) { $cid="-1"; };
			for($i=0;$i<count($mat);$i++){
			$suj="";
			//if (ereg('"',$mat[$i][0])) {
			$suj=urlencode($mat[$i][0]);
			$sujet=$mat[$i][0];
			//}
			$examen=$mat[$i][3];
			$coef=$mat[$i][2];

			$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
			
			array_push($mat[$i],$in,$mid,$pid);	
			$datedevoir=$mat[$i][1];
			$datedujour=dateDMY();
			$TD=recupTrimestreDevoir($cid,$datedevoir); // return 1,2,3 ou 0
			$TT=recupTrimestreDevoir($cid,$datedujour); // return 1,2,3 ou 0
			if ($_SESSION["membre"] == "menuadmin") $TT=0;
			if (MODIFNOTEAPRESARRET == "oui") $TT=0;
			if ($TT > $TD) {
				$lien ="<input type='button' value='".LANGBT50."' class='btn btn-primary btn-sm  vat-btn-footer' onclick='alert(\"".LANGVATEL28." !! \\n\\n".LANGVATEL29."\")' >";
			}else{
				$lien  = '<input type="button" onclick="open(\'supprimernotes3.php?pid='.$pid.'&args=';
				$lien .= urlencode(serialize($mat[$i])).'&libel='.urlencode($libel).'&gid='.$gid.'&idClasse='.$idClasse.'&sujet='.$suj.'\',\'_parent\',\'\');this.value=\''.LANGPROF18.'\'" class="btn btn-primary btn-sm  vat-btn-footer"  value="'.LANGBT50.'">';
			}
			echo "<tr >";
			echo "<td bordercolor='white' bgcolor='$bgcolor' >&nbsp;".$sujet."</td>";
			echo "<td bordercolor='white' bgcolor='$bgcolor' >&nbsp;".$examen."</td>";
			echo "<td bordercolor='white' bgcolor='$bgcolor' align='center' >&nbsp;".$datedevoir."</td>";
			echo "<td bordercolor='white' bgcolor='$bgcolor' align='center' >&nbsp;".$coef."</td>";
			echo "<td bordercolor='white' bgcolor='$bgcolor' valign='top' >".$lien."</td>";
			echo "</tr>";
			}
		echo "</table>";
			?>
	<?php

	}

}else {
	print "pas de date de configuer pour cette période";
} 
 
 ?>

<!-- // fin  -->
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
