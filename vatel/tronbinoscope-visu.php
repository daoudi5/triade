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

if ($_SESSION["membre"] == "menupersonnel") {
	if (!verifDroit($_SESSION["id_pers"],"trombinoscopeRead")){
		validerequete("2");
	}
}else{
	validerequete("2");
	$visu=1;
	$visu2=1;
}

?>
<script language="JavaScript" src="../librairie_js/lib_circulaire.js"></script>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL273 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='param8tronbi.php' ><?php print LANGVATEL69." ".LANGASS38 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<form method="post" >
<table><tr><td>		
<font class="T2"><?php print LANGELE4?> :</font> <select id="saisie_classe" name="saisie_classe">
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?>
</select></td><td>&nbsp;
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
&nbsp;</td><td><?php
if (isset($_POST["consult"])) { ?>
	<script language=JavaScript>buttonMagicVATEL("<?php print LANGaffec_cre41 ?>","../tronbinoscope-impr.php?idclasse=<?php print $_POST[saisie_classe]?>","impr","width=800,height=600,scrollbars=yes,menubar=yes","") </script>&nbsp;&nbsp;
<?php } ?>
</td></tr></table>
</form>


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
<BR>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2" colspan=3><b><font id='menumodule1' >
<?php print LANGELE4?>&nbsp;:&nbsp;<font  id='colort1' ><B><?php print $cl?></font></font></td>
</tr>
<?php
if( count($data) <= 0 ) {
	print("<tr id='cadreCentral0' ><td align=center valign=center>".LANGRECH1."</td></tr>");
}else{
?>
<tr bgcolor="#000000"><td>&nbsp;&nbsp;<font color='#FFFFFF'><B><?php print ucwords(LANGIMP8)?></B></font></td><td colspan=2>&nbsp;&nbsp;<font color='#FFFFFF'><B><?php print ucwords(LANGIMP9)?></B></font></td></tr>
<?php
for($i=0;$i<count($data);$i++) {
	$bgcolor=($bgcolor=="#8C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
?>
	<td >&nbsp;&nbsp;<?php print strtoupper($data[$i][2])?></td>
	<td >&nbsp;&nbsp;<?php print ucwords($data[$i][3])?></td>
	<td  align=center>&nbsp;&nbsp;
		<a href="#" onclick="open('../photoajouteleve.php?ideleve=<?php print $data[$i][1]?>','photo','width=450,height=280')">
		<img src="../image_trombi.php?idE=<?php print $data[$i][1]?>" border=0 ></a>
	</td>
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
