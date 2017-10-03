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
validerequete("menuadmin");
$idpers=$mySession[Spid];
?>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL242 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
	
<form method='post' action='affectation_visu.php' >
&nbsp;&nbsp;&nbsp;<font class="T2"><?php print LANGMESS340 ?> :</font>
<select name="saisie_tri" >
<?php
$tri='tous';
include_once('librairie_php/db_triade.php');
$cnx=cnx();
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
</select> / <?php print LANGBULL3 ?> : 
<select name="anneeScolaire" >
<?php filtreAnneeScolaireSelect($anneeScolaire); ?>
</select>&nbsp;&nbsp;
<input type='submit' value='<?php print VALIDER ?>'   class='btn btn-primary btn-sm  vat-btn-footer'  />
<br /><br /> 
</form>

<table border=1 bordercolor=#000000" align=center width='95%' style="border-collapse: collapse;" >
<TR bgcolor='#000000' > 
<td align=center><font class='T22'><?php print ucwords(LANGPER25)?></font></td>
<td align=center width=10><font class='T22'><?php print "&nbsp;".LANGPER16."&nbsp;".ucwords(LANGBULL32)."&nbsp;"; ?></font></td>
<td align=center width=10><font class='T22'><?php print "&nbsp;".LANGPER16."&nbsp;".ucwords(LANGBULL31)."&nbsp;"; ?></font></td>
<td width='5%' align='center'>&nbsp;<font class='T22'><?php print ucwords(LANGPER26)?></font>&nbsp;</td>
</TR>
<?php
$nbeleveTotal='0';
verif_table_classe();
verif_table_groupe();
$data=visu_affectation_2($tri,$anneeScolaire);
for($i=0;$i<count($data);$i++) {
	$nbeleve=nbEleve($data[$i][0],$anneeScolaire);
	$nbeleveTotal+=$nbeleve;
?>
	<form method=post name="formulaire<?php print $i?>" action="affectation_visu2.php" >
	<?php
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	?>
	<TD><?php $classe=chercheClasse($data[$i][0]);print ucwords($classe[0][1]);?></td>
	<TD align="center"><?php print nbMatiere2($data[$i][0],$anneeScolaire); ?></td>
	<TD align="center"><?php print $nbeleve ?></td>
	<TD align='center'><input type='submit' value="<?php print LANGPER27?>"  class='btn btn-primary btn-sm  vat-btn-footer'  ></td>
	<input type='hidden' name="saisie_classe" value="<?php print $data[$i][0]?>">
	<input type='hidden' name="saisie_tri" value="<?php print $tri ?>">
	<input type='hidden' name="anneeScolaire" value="<?php print $anneeScolaire ?>">
	</form>
	</tr>
<?php
}
unset($data);
Pgclose();
?>
</table>
<script>document.getElementById('nbeleve').innerHTML=" <font id='color2'><b><?php print $nbeleveTotal ?></b></font><font  id='menumodule1' > <?php print LANGTMESS464 ?></font>"; </script>
<BR>
	
			
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
