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

<form method='POST' >
&nbsp;&nbsp;&nbsp;<font class="T2"><?php print "Type membre " ?>  :</font> <select name="saisie_type" onChange="this.form.submit()" >
     
    <option id='select0' value='0' <?php print ($_POST["saisie_type"] == 0) ? "selected='selected'" : "" ?> ><?php print LANGCHOIX?></option>
    <option id='select1' value="ENS" <?php print ($_POST["saisie_type"] == "ENS") ? "selected='selected'" : "" ?> ><?php print "Enseignant"?></option>
    <option id='select1' value="ADM" <?php print ($_POST["saisie_type"] == "ADM") ? "selected='selected'" : "" ?> ><?php print "Direction"?></option>
    <option id='select1' value="TUT" <?php print ($_POST["saisie_type"] == "TUT") ? "selected='selected'" : "" ?> ><?php print "Tuteur de stage"?></option>
    <option id='select1' value="PER" <?php print ($_POST["saisie_type"] == "PER") ? "selected='selected'" : "" ?> ><?php print "Personnel"?></option>
    <option id='select1' value="MVS" <?php print ($_POST["saisie_type"] == "MVS") ? "selected='selected'" : "" ?> ><?php print "Vie Scolaire"?></option>
</select><br><br>
</form>

<!-- // debut form  -->
<?php
$sqlsuite="(type_pers='ENS' OR type_pers='ADM' OR type_pers='PER' OR type_pers='MVS')";
if (isset($_POST["saisie_type"])) {
	if ($_POST["saisie_type"] != "0") $sqlsuite=" type_pers='".$_POST["saisie_type"]."' ";
}

$sql="SELECT pers_id,nom,prenom FROM ${prefixe}personnel WHERE $sqlsuite AND  offline='0' ORDER BY nom";
$res=execSql($sql);
$data=chargeMat($res);

print "<table width='100%'>";
if( count($data) <= 0 )	{
	print("<tr id='cadreCentral0' ><td align=center valign=center>"."AUCUN COMPTE DE DISPONIBLE"."</td></tr>");
} else {
	print "<tr>";
	$j=0;
	for($i=0;$i<count($data);$i++) {
		$j++;
	?>	
		<td align=center><img src="../image_trombi.php?idP=<?php print $data[$i][0]?>" border=0 /><br><?php print recherche_personne($data[$i][0])?></td>
<?php
		if ($j == 3) { print "</tr><tr>"; $j=0; }
	}
}
print "</tr></table>";
?>

<br>
<table align=center><tr><td align=center><script language=JavaScript>buttonMagicVATEL("<?php print LANGVATEL72 ?>","tronbinoscope-pers-impr-pdf.php?saisie_type=<?php print $_POST["saisie_type"] ?>","impr","width=800,height=600,scrollbars=yes,menubar=yes","") </script></tr></td></table>


		
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
