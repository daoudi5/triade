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

$idpers=$mySession[Spid];

if (empty($_SESSION["adminplus"])) {
	print "<script>";
	print "location.href='./param9.php'";
   	print "</script>";
}

?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGPROFB3 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		
<form method='post' action='modifaffect.php' >
&nbsp;&nbsp;&nbsp;<font class="T2"><?php print LANGCHOIX ?> :</font>
<select name="saisie_tri" >
<?php
if (isset($_GET["sClasseGrp"])) $sClasseGrp=$_GET["sClasseGrp"];
if (isset($_POST["sClasseGrp"])) $sClasseGrp=$_POST["sClasseGrp"];

$tri='tous';
if (isset($_POST["saisie_tri"])) {
	$libelle=libelleTrimestre($_POST["saisie_tri"]);
	print "<option value='".$_POST["saisie_tri"]."' id='select0' >$libelle</option>";
	$tri=$_POST["saisie_tri"];
	$anneeScolaire=$_POST["anneeScolaire"];
}
?>
<option value='tous'  id='select0' ><?php print LANGMESS341 ?></option>
<option value='trimestre1'  id='select1' ><?php print LANGMESS342 ?></option>
<option value='trimestre2'  id='select1' ><?php print LANGMESS343 ?></option>
<option value='trimestre3'  id='select1' ><?php print LANGMESS344 ?></option>
</select> 
<font class="T2">/ <?php print LANGBULL29 ?>&nbsp;:&nbsp;</font>
<select name="anneeScolaire" >
<?php anneeScolaireSelect($anneeScolaire); ?>
</select>&nbsp;&nbsp;
<input type='submit' value='<?php print VALIDER ?>' class='btn btn-primary btn-sm  vat-btn-footer' />
<input type='hidden'  value="<?php print $sClasseGrp ?>" name='sClasseGrp' />
</form>

</td><td align='right'><?php if ($_SESSION["membre"] == "menuprof") { print "<script>buttonMagicRetourVATEL('profp.php','_self')</script>"; } ?></td></tr></table>
<!-- //  debut -->
<br>
<table border=1 bordercolor=#000000" align=center width='90%' style="border-collapse: collapse;"  >
<tr>
<td bgcolor="black" align='center' ><font color='#FFFFFF' ><b><?php print ucwords(LANGPER25)?></b></font></td>
<td bgcolor="black" width='5%' align='center' >&nbsp;<font color='#FFFFFF' ><b><?php print ucwords(LANGPER30)?></b></font>&nbsp;</td>
<td bgcolor="black" width='5%' align='center' >&nbsp;<font color='#FFFFFF' ><b><?php print ucwords("Ordre")?></b></font>&nbsp;</td>
</tr>
<?php
if ($_SESSION["membre"] == "menuprof") {
	$cr=verif_profp_class_sans_blacklist($_SESSION["id_pers"],$sClasseGrp);
	if ($cr == "ok") $data=visu_affectation_2_prof($tri,$sClasseGrp,$anneeScolaire);
}else{
	$data=visu_affectation_2($tri,$anneeScolaire);
}
for($i=0;$i<count($data);$i++) {
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	?>
	<TD><?php $classe=chercheClasse($data[$i][0]);print $classe[0][1];?></td>
	<TD><input type=button onclick="PopupCentrerAttente('./modifaffect2.php?saisie_classe_envoi=<?php print $data[$i][0]?>&saisie_tri=<?php print $tri?>&anneeScolaire=<?php print $anneeScolaire ?>',1000,500,'tollbar=no,menubar=no,scrollbars=yes,resizable=yes');" value="<?php print ucwords(LANGPER30)?>" class='btn btn-primary btn-sm  vat-btn-footer'  ></td>
	<TD><input type=button onclick="PopupCentrerAttente('./modifaffect4.php?saisie_classe_envoi=<?php print $data[$i][0]?>&saisie_tri=<?php print $tri?>&anneeScolaire=<?php print $anneeScolaire ?>',1000,500,'tollbar=no,menubar=no,scrollbars=yes,resizable=yes');" value="<?php print ucwords(LANGPER30)?>" class='btn btn-primary btn-sm  vat-btn-footer'  ></td>
	</tr>
	<?php
}
unset($data);
?>	
</table>
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