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

$typeout=$_POST["typeout"]; 

?>
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL218 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<table border='0' align='center' >
<tr><td valign="top">
<form method=post onsubmit="return valide_consul_classe()" name="formulaire" action="gestion_stage_convention_eleve.php" >
<font class=T2><?php print LANGELE4?>&nbsp;:&nbsp;</font> </td><td align='center' ><select id="saisie_classe" name="saisie_classe">
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
if ($_SESSION["membre"] == "menuprof") {
	if (PROFSTAGEETUDIANT == "oui") {
		select_classe(); // creation des options
	}else{
		select_classe_profp($_SESSION["id_pers"]); // creation des options
	}
}else{
	select_classe(); // creation des options
}
?>
</select></td>



<td valign="top" >&nbsp;
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
</td></tr>
<tr><td colspan='3' height=10></td></tr>
<tr><td colspan='3' ><input type='checkbox' style="float:none" name="typeout" value='1' <?php if ($typeout == '1') { print "checked='checked'"; } ?> /> <font class='T2'><?php print LANGSTAGE116 ?></font></td></tr>
<tr><td>
</form>
</td></tr></table>
<br><br>

<!-- // fin form -->
 </td></tr></table>

<?php
// affichage de la classe


if ((isset($_GET["idclasse"])) || (isset($_POST["consult"]))) {	
	if  (isset($_POST["consult"])) $saisie_classe=$_POST["saisie_classe"];
	if  (isset($_GET["idclasse"])) $saisie_classe=$_GET["idclasse"];
	$sql="SELECT c.libelle,e.elev_id,e.nom,e.prenom FROM ${prefixe}eleves e,${prefixe}classes c WHERE e.classe='$saisie_classe' AND c.code_class='$saisie_classe' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);

// ne fonctionne que si au moins 1 élève dans la classe
// nom classe
$cl=$data[0][0];
?>

<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2" colspan="3"><b><font   id='menumodule1' >
<?php print LANGELE4?> : <font id='color2'><B><?php print $cl?></font></font></td></tr>
<?php
if( count($data) <= 0 )	{
	print("<tr><td align=center valign=center  id='cadreCentral0' >".LANGRECH1."</td></tr>");
}else {
?>
<!--
<tr  id='cadreCentral0'><td colspan=3>
<br><br>
<form method=post action="gestion_stage_convention_eleve1.php">
<script language=JavaScript>buttonMagicSubmit("<?php print LANGBT49?>","tous"); //text,nomInput</script>
<input type=hidden name="idclasse" value="<?php print $_POST["saisie_classe"] ?>">
</form><br><br><br>
</td></tr>
-->

<!--
<tr  id='coulBar0' >
<td align=right width=45% valign="top" ><font class="T2"><?php print LANGSTAGE48 ?> :</font></td>
<td align=left valign="top" colspan=2>
<?php
//radiobox_stage($_POST["saisie_classe"]);
?>
</td>
</tr>
-->

<tr bgcolor="black"><td><font class='T22' ><?php print ucwords(LANGIMP8)." ".ucwords(LANGIMP9)?></font></td><td title="Num&eacute;ro Convention" ><font class='T22' >Conv.</font></td><td><font class='T22' ><?php print "Convention" ?></font></td></tr>
<?php
for($i=0;$i<count($data);$i++) {
?>
	<form action="gestion_stage_convention_eleve1.php"  method="post" name="formulaire<?php print $i ?>" >
	<?php
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	?>
	<td ><?php print strtoupper($data[$i][2]) ?> <?php print ucwords($data[$i][3])?> </td>
	<td width=5%><select name='nbconv' ><option></option><option value='_conv_A' id='select1' >A</option><option value='_conv_B' id='select1' >B</option><option id='select1' value='_conv_C'>C</option></select></td>
	<td width=5>
	<select name='choix_stage' onChange='document.formulaire<?php print $i ?>.submit()' >
	<option id='select0' ><?php print LANGCHOIX ?></option>
	<?php 
		if ($typeout != "1") {
			selectStage($data[$i][1]);
		}else{
			selectStage2($data[$i][1]);
		}
	?>
	</select>
	<input type="hidden" name="eid" value="<?php print $data[$i][1] ?>" />
	</td>
	</tr>
	</form>
	<?php
	}
      }
print "</table>";
}
?>
			
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