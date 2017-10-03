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
	<script language="JavaScript" src="./librairie_js/lib_absrtdplanifier.js"></script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL47  ?></span>
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
<br><br>
<form method=post name=formulaire  action="impr_abs_rtd_eleve2.php">
<table  border="0" >
<tr>
<td align="right"><font class="T2"><?php print LANGDISC47 ?>&nbsp; :&nbsp;</font></td>
<td colspan="2"   align="left"><input type="text" value="" name="saisie_date_debut" TYPE="text" size=13  class=bouton2 readonly>
<?php
 include_once("../librairie_php/calendar.php");
 calendarVATEL("id1","document.formulaire.saisie_date_debut",$_SESSION["langue"],"0");
?>
</td>
</tr>
<tr>
<td  align="right"><br><font class="T2"><?php print LANGDISC48 ?>&nbsp; :&nbsp; </font></td>
<td colspan="2"  align="left"><br><input type="text" value="" name="saisie_date_fin" TYPE="text" size=13 class=bouton2 readonly>
<?php
 calendarVATEL("id2","document.formulaire.saisie_date_fin",$_SESSION["langue"],"0");
?>
</td>
</tr>
<tr>
<td  align="right"><br><font class="T2"><?php print "Nature de l'impression" ?>&nbsp; :&nbsp; </font></td>
<td colspan="2"  align="left"><br>
<select name='absrtd' >
<option value='tous' id='select0' ><?php print LANGTOUS ?></option>
<option value='abs' id='select1' ><?php print "Absences" ?></option>
<option value='rtd' id='select1' ><?php print "Retards" ?></option>
</td>
</tr>
<tr>
<td ><div align="right"><br><font class="T2"><?php print LANGDISC49 ?>&nbsp; :&nbsp; </font></div></td>
<td colspan="2" ><br>
<select name="saisie_classe">
<option selected value=0 selected   STYLE='color:#000066;background-color:#FCE4BA' ><?php print LANGCHOIX ?></option>
<option selected value="tous" selected   STYLE='color:#000066;background-color:#FCE4BA' ><?php print "Toutes les classes" ?></option>
<?php select_classe2(35);?>
</select>
</td></tr>
<tr><td align=center colspan='2'>

<br>
<script language=JavaScript>buttonMagicSubmit3VATEL("<?php print LANGPER27 ?>","rien",""); </script>
</td></tr>
</table>
<br>
</form>




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
