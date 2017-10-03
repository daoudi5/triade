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
include_once("../librairie_php/ajax.php");
ajax_js();
?>
<form method=post onsubmit="return valide_recherche_eleve()" name="formulaire">
<table border=0 cellspacing=0><tr><td style="padding-top:0px;" nowrap>
<font class="T2"><?php print LANGABS3?> : </font><input type="text" name="saisie_nom_eleve" size="20" id="search" autocomplete="off" onkeyup="searchRequest(this,'eleve','target','formulaire','saisie_nom_eleve')"   style="width:15em;" />
</td></tr><tr><td style="padding-top:0px;"><div id="target" style="width:18.5em;" ></div></td></tr>
</table><div style="position:relative">
<br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT39?>","create"); //text,nomInput</script>
</div>
</td></tr></table>
</form>
<br /><br />

<?php
//alertJs(empty($create));
// affichage de la liste d élèves trouvés
if(isset($_POST["saisie_nom_eleve"])) {
$saisie_nom_eleve=trim($_POST["saisie_nom_eleve"]);
$motif=strtolower($saisie_nom_eleve);
$sql=<<<EOF

SELECT c.libelle,e.nom,e.prenom,e.elev_id
FROM ${prefixe}eleves e, ${prefixe}classes c
WHERE lower(e.nom) LIKE '%$motif%'
AND c.code_class = e.classe
ORDER BY c.libelle, e.nom, e.prenom

EOF;
$res=execSql($sql);
$data=chargeMat($res);

?>
<table border="0" cellpadding="3" cellspacing="1" width="100%"  >
<tr><td height="2" colspan=3><b><font>
<?php print LANGRECH2?> : <font id="color2"><B><?php print ucwords(stripslashes($motif))?></font>
</font></td>
</tr>
<?php

if( count($data) <= 0 ) {
	print("<tr><td align=center valign=center>".LANGRECH3."</td></tr>");
}else{
?>
	<tr bgcolor="#000000"><td><font color='#FFFFFF'><b><?php print ucwords(LANGIMP10)?></b></font></td><td><font color='#FFFFFF'><B><?php print INTITULEELEVES ?></B></font></td><td></font></td><td colspan=2><font color='#FFFFFF'><b></b></td></tr>
<?php
for($i=0;$i<count($data);$i++)
	{
	 $bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	$ideleve=$data[$i][3];
	?>
	<tr bgcolor='<?php print $bgcolor ?>' >
	<td><?php print $data[$i][0]?></td>
	<td><?php print strtoupper($data[$i][1])?> <?php print ucwords($data[$i][2])?></td>
	<td width='5' ><input type='button' onClick="open('gestion_abs_retard_modif_donne.php?ideleve=<?php print $ideleve ?>','_self','')"  value="<?php print LANGPER30 ?>" class="btn btn-primary btn-sm  vat-btn-footer" /></td>
	<td width='5'><input type='button' onClick="open('gestion_abs_retard_modif.php?ideleve=<?php print $ideleve ?>','_self','')"  value="<?php print LANGBT50 ?>" class="btn btn-primary btn-sm  vat-btn-footer" /></td>
	</tr>
	<?php
	}
}

?>
</table>
<?php
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
