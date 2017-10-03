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
$cnx=cnx2();

// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$idpers=$mySession[Spid];
validerequete("menuadmin");

if(isset($_POST["creat_creneau"])):
        $cr=create_creneau($_POST["saisie_intitule"],$_POST["saisie_depH"],$_POST["saisie_finH"]);
        if($cr != 1){
                alertJs("Créneau non créé, déjà en place -- Service Triade");
        }
endif;

if(isset($_POST["creat_supp"])):
        $cr2=supp_creneau($_POST["saisie_int_supp"]);
        if($cr2 == 1){ alertJs("Créneau supprimé -- Service Triade"); }
endif;

if (isset($_POST["creat_default"])) {
	if ($_POST["saisie_int_default"] != "aucun") { config_param_ajout($_POST["saisie_int_default"],"creneau"); }
	if ($_POST["saisie_int_default"] == "aucun") { supp_param_creneaux(); }
}


?>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL90 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href="gestion_abs_config.php"><?php print LANGVATEL121 ?></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<font class="T2 shadow"><B><?php print LANGVATEL126 ?>.</B><br><br></font><font class='T2'>
<form method=post >
<table border=0><tr><td>
<font class="T2"><?php print LANGVATEL125 ?>&nbsp;:&nbsp;</font></td><td>
<input type=text size=20 maxlength=20 name=saisie_intitule>
</td></tr>

<tr><td align=right><font class=T2>De&nbsp;:&nbsp;</font> </td> <td><input type=text size=5 maxlength=8 name='saisie_depH' onKeyPress="onlyChar2(event)" > <i>(hh:mm)</i> </td></tr>
<tr><td align=right><font class=T2>&agrave;&nbsp;:&nbsp;</font> </td> <td><input type=text size=5 maxlength=8 name='saisie_finH' onKeyPress="onlyChar2(event)" >  <i>(hh:mm)</i> </td></tr>
<tr><td colspan=2><br><br>
<table align=center><tr><td>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGENR ?>","creat_creneau"); //text,nomInput</script>
</td></tr></table>
</td></tr>

</td></tr></table>
</form>
<BR>
<hr>
<form method="post" >
<?php print "Liste des créneaux" ?> :
<select name="saisie_int_supp">
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGPROJ13 ?></option>
<?php
select_creneaux();
?>
</select> <input type=submit name="creat_supp" value="<?php print LANGacce21 ?>" class='btn btn-primary btn-sm  vat-btn-footer' >
</form>
<BR>
<form method="post" >
<?php print LANGVATEL127 ?> :
<select name="saisie_int_default">
<?php
$data=recupCreneauDefault("creneau"); // libelle,text
if (count($data) > 0) {
	print "<option id='select1' value='".$data[0][1]."' >".$data[0][1]."</option>";
	print "<option id='select0' value='aucun' >Aucun</option>";
}else{
	print "<option id='select0' value='aucun' >Aucun</option>";
}
select_creneaux();
?>
	</select> <input type=submit name="creat_default" value="<?php print VALIDER ?>" class='btn btn-primary btn-sm  vat-btn-footer' >
</form>
<hr>
<table border='1'  ><tr bgcolor='black'>
<td><font class='T2' >&nbsp;<font color='#FFFFFF' ><b><?php print LANGVATEL122 ?></b></font>&nbsp;</font></td>
<td><font class='T2' >&nbsp;<font color='#FFFFFF' ><b><?php print LANGVATEL123 ?></b></font>&nbsp;</font></td>
<td><font class='T2' >&nbsp;<font color='#FFFFFF' ><b><?php print LANGVATEL124 ?></b></font>&nbsp;</font></td>
</tr>
<?php 
$data=affCreneaux(); // libelle, dep_h,fin_h 
for($i=0;$i<count($data);$i++) {
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	print "<td id='bordure'><font class='T2'><font color='#FFFFFF'>&nbsp;".$data[$i][0]."&nbsp;</font></font></td>";
	print "<td id='bordure'><font class='T2'><font color='#FFFFFF'>&nbsp;".timeForm($data[$i][1])."&nbsp;</font></font></td>";
	print "<td id='bordure'><font class='T2'><font color='#FFFFFF'>&nbsp;".timeForm($data[$i][2])."&nbsp;</font></font></td>";
	print "</tr>";
}

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
