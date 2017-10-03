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

validerequete("menuadmin");
// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$idpers=$mySession[Spid];
?>
<script src='../librairie_js/verif_creat.js'></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGSUPP16 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='recherche_eleve.php' ><?php print LANGPER30 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_compte_eleve.php' ><?php print LANGBT50 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<form method=post onsubmit="return valide_consul_classe()" name="formulaire">
<BR>
<font class=T2><?php print LANGEL3?></font> : <select id="saisie_classe" name="saisie_classe">
<option   STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?>
</select> <BR><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28 ?>","consult"); //text,nomInput</script>
</form>
</td></tr></table>
<?php
// affichage de la classe
if(isset($_POST["consult"])) {
$saisie_classe=$_POST["saisie_classe"];
$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
$res=execSql($sql);
$data=chargeMat($res);

// ne fonctionne que si au moins 1 élève dans la classe
// nom classe
$cl=$data[0][0];
?>
<BR><BR><BR>
&nbsp;&nbsp;
<table border="0" cellpadding="3" cellspacing="1" width="100%"  >
<tr ><td height="2" colspan="3"><b><font ><?php print LANGEL3?> : <font id="color2"><b><?php print $cl?></b></font> / --> <?php print LANGSUPP15?></font></td>
</tr>
<?php
if( count($data) <= 0 ) {
	print("<tr><td align='center' valign='center'  id='cadreCentral0' >".LANGDISP1."</td></tr>");
}else {
?>
<tr bgcolor="black"><td> <font color='white'><B><?php print LANGEL1?></B></font></td><td><font color='white'><B><?php print LANGEL2?></B></font></td></tr>
<?php
for($i=0;$i<count($data);$i++)
	{
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	?>
	<tr bgcolor='<?php print $bgcolor ?>' >
	<td ><a href="supp_ele.php?id=<?php print $data[$i][1]?>"><?php print strtoupper($data[$i][2])?></a></td>
	<td ><a href="supp_ele.php?id=<?php print $data[$i][1]?>"><?php print ucwords($data[$i][3])?></a></td>
	</tr>
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
