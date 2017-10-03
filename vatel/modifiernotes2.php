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

//variables utiles
$nom=$_SESSION["nom"];
$prenom=$_SESSION["prenom"];
$membre=$_SESSION["membre"];
$pid=$_SESSION["id_pers"];

$cgrp=$_POST["sClasseGrp"];
$cgrp=explode(":",$cgrp);
$cid=$cgrp[0];
$gid=$cgrp[1];
$mid=$_POST["sMat"];

$sMat1=$_POST["sMat"]; 
$sClasseGrp1=$_POST["sClasseGrp"];

$nomClasse=chercheClasse($cid);
$nomClasse=$nomClasse[0][1];
$nomMat=chercheMatiereNom($mid);
$nomGrp=chercheGroupeNom($gid);
$titre1=$nomClasse." ".$nomGrp." ".$nomMat;

if (isset($_SESSION["idprofviaadmin"])) {
	$pid=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($pid);
}
?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL22 ?> - <?php print LANGVATEL26 ?> <?php print $nomduprof ?></span>
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
//	$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$cid' AND code_class='$cid' ";
	$sql="(SELECT e.elev_id, e.nom,e.prenom,e.classe  FROM ${prefixe}eleves e WHERE e.classe='$cid' AND e.annee_scolaire = '$anneeScolaire' ) UNION (SELECT e.elev_id,e.nom,e.prenom,e.classe FROM ${prefixe}eleves e , ${prefixe}eleves_histo h WHERE h.idclasse='$cid' AND h.annee_scolaire = '$anneeScolaire' AND e.elev_id=h.ideleve group by elev_id ) $order";

	$res=execSql($sql);
	$verifdata=chargeMat($res);
	if( count($verifdata) <= 0 )  {
			print("<br><br><br><center><font class=T1>".LANGRECH1."</font></center>");
	}else {

		if($gid){
			//$gid
			$sqlIn="
			SELECT
				liste_elev
			FROM
				${prefixe}groupes
			WHERE
				group_id='$gid'	AND annee_scolaire='$anneeScolaire'
			";
			$curs=execSql($sqlIn);
			$in=chargeMat($curs);
			freeResult($curs);
			$in=$in[0][0];
			$in=substr($in,1);
			$in=substr($in,0,-1);
			$sqlgroupe=" AND id_groupe='$gid' ";
		} else {
			//$cid
		  /*  $sql="
			SELECT
			elev_id
			FROM
			${prefixe}eleves
			WHERE
			classe='$cid'
			"; */
			$sql="(SELECT e.elev_id, e.nom,e.prenom,e.classe  FROM ${prefixe}eleves e WHERE e.classe='$cid' AND e.annee_scolaire='$anneeScolaire' ) UNION (SELECT e.elev_id,e.nom,e.prenom,e.classe FROM ${prefixe}eleves e , ${prefixe}eleves_histo h WHERE h.idclasse='$cid' AND e.elev_id=h.ideleve AND h.annee_scolaire='$anneeScolaire' group by elev_id ) $order";

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
			$sql="SELECT sujet, DATE_FORMAT(date,'%d/%m/%Y'),coef,noteexam FROM ${prefixe}notes WHERE elev_id IN ($in) AND prof_id='$pid' AND code_mat='$mid' AND date >= '$dateDebut' AND date <= '$dateFin' ";
			if ($sqlgroupe != "") {
					$sql.=" $sqlgroupe";
			//}else{
			  //      $sql.="AND id_classe='$cid' ";
			}
			$sql.=" GROUP BY date,coef,sujet ORDER BY date DESC ";
			$curs=execSql($sql);
			$mat=chargeMat($curs);
		}

		$typenote=$_POST["NoteUsa"];
		echo "<table width='100%' border='1'  >";
		echo "<tr>";
		echo "<td bgcolor='black' bordercolor='white' align='center'><font color='white'>".LANGPROF16."</font></td>";
		echo "<td bgcolor='black' bordercolor='white' align='center'><font color='white'>".Examen."</font></td>";
		echo "<td bgcolor='black' bordercolor='white' align='center' width='10%'><font color='white'>".LANGPROF17."</font></td>";
		echo "<td bgcolor='black' bordercolor='white' align='center' width='5%'><font color='white'>&nbsp;".LANGPER19."&nbsp;</font></td>";
		echo "<td bgcolor='black' bordercolor='white' align='center' width='5%'><font color='white'>".LANGBT50."</font></td>";
		echo "</tr>";

		for($i=0;$i<count($mat);$i++){
			$suj="";
			$suj=$mat[$i][0];
			$sujet=$mat[$i][0];
			$datedevoir=$mat[$i][1];
			$coef=$mat[$i][2];
			$examen=$mat[$i][3];

			$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;

			array_push($mat[$i],$in,$mid,$pid);
			$lien="<form method='post' action='modifiernotes3.php' >";
			$datedujour=dateDMY();
			$TD=recupTrimestreDevoir($cid,$datedevoir); // return 1,2,3 ou 0
			$TT=recupTrimestreDevoir($cid,$datedujour); // return 1,2,3 ou 0
			if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menupersonnel")) $TT=0;
			if (MODIFNOTEAPRESARRET == "oui") $TT=0;
			if ($TT > $TD) {
				$lien.="<input type=button value='".LANGPER30."' class='btn btn-primary btn-sm  vat-btn-footer' onclick='alert(\"".LANGVATEL28." !! \\n\\n".LANGVATEL29."\")' >";
			}else{
				$lien.="<input type=submit value='".LANGPER30."' class='btn btn-primary btn-sm  vat-btn-footer' >";
			}
			$lien.="<input type=hidden name='gid' value=\"$gid\"  >";
			$lien.="<input type=hidden name='idclasse' value=\"$cid\"  >";
			$lien.="<input type=hidden name='sMat' value=\"$sMat1\"  >";
			$lien.="<input type=hidden name='sClasseGrp' value=\"$sClasseGrp1\"  >";
			$lien.="<input type=hidden name='typenote' value=\"$typenote\"  >";
			$lien.="<input type=hidden name='titre1' value=\"".$titre1."\"  >";
			$lien.="<input type=hidden name='sujet' value=\"$suj\"  >";
			$lien.="<input type=hidden name='args' value='".serialize($mat[$i])."'  >";
			$lien.="<input type=hidden name='adminIdprof' value='".$_POST["adminIdprof"]."' />";
			$lien .= "</form>";
						echo "<tr>";
						echo "<td bordercolor='white' bgcolor='$bgcolor' >&nbsp;".$sujet."</td>";
						echo "<td bordercolor='white' bgcolor='$bgcolor'  >".$examen."</td>";
						echo "<td bordercolor='white' bgcolor='$bgcolor'  align='center' >".$datedevoir."</td>";
						echo "<td bordercolor='white' bgcolor='$bgcolor'  align='center' >".$coef."</td>";
						echo "<td bordercolor='white' bgcolor='$bgcolor'  >".$lien."</td>";
						echo "</tr>";
			}
			echo "</table>";
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
