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
 
include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/lib_note.php"); 
$cnx=cnx2();
validerequete("menuadmin");


if ($_SESSION["membre"] == "menuadmin") {
	
	if (isset($_POST["modif_date"])) {
		$date=$_POST["saisie_date"];
	}else{
		$date=dateDMY();
	}

	if (isset($_POST["sClasseGrp"])) {
		$filtreCLasse=$_POST["sClasseGrp"];
	}else{
		$filtreCLasse="tous";
	}	

?>
	<script language="JavaScript" >
	function print_abs_rtd_du_jour(){
		var ok=confirm(langfunc3);
		if (ok) {
			open('../gestion_abs_retard_du_jour_print.php?id=<?php print dateFormBase($date) ?>&filtre=<?php print $filtreCLasse?>','_blank','');		
		}
	}

	function print_abs_rtd_du_jour_2(){
		var ok=confirm(langfunc3);
		if (ok) {
			open('../gestion_abs_retard_du_jour_print.php?id=<?php print dateFormBase($date) ?>&filtre=<?php print $filtreCLasse?>&inconnu=1','_blank','');		
		}
	}
	</script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL270  ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='gestionABSRtdSanc.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='consulterABSRtd.php' ><?php print LANGBT28."/".LANGPER30 ?></a></li>
				<li style="visibility:visible" ><a href='impr_abs_rtd_eleve.php' ><?php print LANGVATEL264 ?></a></li>
				<li style="visibility:visible" ><a href='alerteAbsRtd.php' ><?php print "Alerte Absences" ?></a></li>
                                <li style="visibility:visible" ><a href='alerteAbsRtdSMS.php' ><?php print "Alerte SMS" ?></a></li>
                                <li style="visibility:visible" ><a href='gestionABSRtdEtudiant.php' ><?php print LANGVATEL269 ?></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php
//--------------------------------------------------//
if(isset($_POST["supp_retard"])) {
        $cr=suppression_retard($_POST["saisie_eleve_id"],$_POST["saisie_heure_ret"],$_POST["saisie_date_ret"]) ;
}
//--------------------------------------------------//
if(isset($_POST["supp_absence"])) {
        $cr=suppression_absence($_POST["saisie_eleve_id_2"],$_POST["saisie_date_ret_2"],$_POST["saisie_time"],$_POST["saisie_matiere"]) ;
}
//--------------------------------------------------//

// affichage de la liste d'élèves trouvées
if (isset($_GET["ideleve"])) { $ideleve=$_GET["ideleve"]; }
if (isset($_POST["saisie_eleve_id"])) { $ideleve=$_POST["saisie_eleve_id"]; }
if (isset($_POST["saisie_eleve_id_2"])) { $ideleve=$_POST["saisie_eleve_id_2"]; }
$sql=<<<EOF

SELECT c.libelle,e.nom,e.prenom,e.elev_id
FROM ${prefixe}eleves e, ${prefixe}classes c
WHERE e.elev_id = '$ideleve' 
AND c.code_class = e.classe
ORDER BY c.libelle, e.nom, e.prenom

EOF;
$res=execSql($sql);
$data=chargeMat($res);

?>
<?php
if( count($data) <= 0 )
        {
        print("<BR><center><font size=3>".LANGDISP1."</font><BR><BR></center>");
        }
else {
for($i=0;$i<count($data);$i++)
        {
        ?>
<table border="0" bordercolor="#000000" width="100%">
<tr>
<td width=55%><?php print LANGTP1 ?> : <B><?php print ucwords(trim($data[$i][1]))?></b></td>
<td ><?php print LANGCALEN7 ?> : <font color=red><?php print trim($data[$i][0])?></font>
</td></tr>
<tr>
<td ><?php print LANGTP2 ?> : <b><?php print ucwords(trim($data[$i][2]))?></b></td>
<td ></td>
</tr>
</table>
<table border="1" bordercolor="#000000" width="100%">
<TR>
<TD bgcolor='yellow' align=center width=20%><?php print LANGABS13 ?> </td>
<TD bgcolor='yellow' align=center width=20%><?php print LANGPARENT17 ?> </td>
<TD bgcolor='yellow' align=center width=15%><?php print LANGABS60 ?> </td>
<TD bgcolor='yellow' align=center><?php print LANGDISP2 ?> </td>
<TD bgcolor='yellow' align=center width=5%>&nbsp;<?php print LANGBT50 ?>&nbsp;</td>
</TR>
<?php
$data_2=affRetard($data[$i][3]);
// $data : tab bidim - soustab 3 champs
for($j=0;$j<count($data_2);$j++) {
        $matiere=chercheMatiereNom($data_2[$j][7]);
	if (($matiere == "") || ($matiere < 0)) { $matiere="";  }
?>
	<TR  class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<form method=POST>
	<TD align=center valign=top><?php print date_jour(dateForm($data_2[$j][2])); ?><br><?php print dateForm($data_2[$j][2])?></td>
	<TD align=center valign=top><?php print $data_2[$j][1]?><br>(<?php print trunchaine($matiere,11) ?>)</td>
	<TD align=center valign=top><?php if ($data_2[$j][5] == 0) { print "???"; }else{ print $data_2[$j][5]; }?></td>
	<?php $motiftext=$data_2[$j][6]; if ($data_2[$j][6] == "inconnu") { $motiftext=LANGINCONNU; } if (trim($data_2[$j][6]) == "0") { $motiftext=LANGINCONNU; } ?>
	<TD valign=top><?php print $motiftext ?></td>
	<TD align=center valign=top><input type='submit' name=supp_retard value="<?php print LANGBT50 ?>" class="btn btn-primary btn-sm pull-right vat-btn-footer" >
	<input type=hidden name=saisie_eleve_id value="<?php print $data[$i][3]?>">
	<input type=hidden name=saisie_heure_ret value="<?php print $data_2[$j][1]?>">
	<input type=hidden name=saisie_date_ret value="<?php print $data_2[$j][2]?>">
	<input type=hidden name=saisie_nom_eleve value="<?php print $data[$i][1]?>">
	</td>
	</form>
	</TR>
<?php
        }
?>
</table>
<BR>
<table border="1" bordercolor="#000000" width="100%">
<TR>
<TD bgcolor='yellow' align=center width=20%><?php print LANGPARENT8 ?> </td>
<TD bgcolor='yellow' align=center width=20%><?php print LANGABS60 ?> </td>
<TD bgcolor='yellow' align=center width=15%><?php print LANGABS63 ?></td>
<TD bgcolor='yellow' align=center><?php print LANGABS12 ?> </td>
<TD bgcolor='yellow' align=center width=5%>&nbsp;<?php print LANGBT50 ?>&nbsp;</td>
</TR>

<?php
$data_3=affAbsence($data[$i][3]);
// $data : tab bidim - soustab 3 champs
for($j=0;$j<count($data_3);$j++)
        {
?>
	<TR  class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<form method=POST>
<TD align=center valign=top><?php print date_jour(dateForm($data_3[$j][1])); ?><br><?php print dateForm($data_3[$j][1])?></td>

<TD align=center valign=top>
<?php
	if ($data_3[$j][4] >= 0) {	
		print $data_3[$j][4]."  Jour(s)";
	}else{
		print $data_3[$j][7]."h";
	}
?>
</td>

<TD align=center valign=top><?php print dateForm($data_3[$j][2])?></td>
<?php $motiftext=$data_3[$j][6];  if ($data_3[$j][6] == "inconnu") { $motiftext=LANGINCONNU; }  
if ($data_3[$j][6] == "0") { $motiftext=LANGINCONNU; }
?>
<TD valign=top><?php print $motiftext ?></td>
<TD align=center valign=top><input type=submit name=supp_absence value="<?php print LANGBT50 ?>" name=supp_absent class="btn btn-primary btn-sm pull-right vat-btn-footer" >
	<input type=hidden name=saisie_eleve_id_2 value="<?php print $data[$i][3]?>">
	<input type=hidden name=saisie_date_ret_2 value="<?php print $data_3[$j][1]?>">
	<input type=hidden name=saisie_nom_eleve value="<?php print $data[$i][1]?>">
	<input type=hidden name=saisie_time value="<?php print $data_3[$j][9]?>">
	<input type=hidden name=saisie_matiere value="<?php print $data_3[$j][8]?>">
	
	</td>
	</form>
	</TR>
<?php
        }
?>

</table>
<!-- 
<form method=post action="gestion_abs_retard_impr.php" >
&nbsp;&nbsp;<input type=submit  value="Imprimer Rtd/Abs de <?php print ucwords(trim($data[$i][1]))." ".ucwords(trim($data[$i][2])) ?>" class="btn btn-primary btn-sm pull-right vat-btn-footer" >
<input type=hidden name="idEleve" value="<?php print $data[$i][3]?>">
</form>
-->
        <?php
        }
      }
?>

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
