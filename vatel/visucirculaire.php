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
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGASS24 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='circulaire-admin.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='visucirculaire.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a href='supprimercirculaire.php' ><?php print LANGVATEL23 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
validerequete("menuadmin");
$data=listeCatCirculaire();
?>
<br>
<form>
<table style="border-collapse: collapse;" ><tr><td>
&nbsp;&nbsp;<font class='T2'><?php print LANGMESS347 ?> </font><select name='filtre' onChange="this.form.submit()" >
				<option value="" id='select0' ><?php print LANGCHOIX ?></option>
				<?php 
				for ($i=0;$i<count($data);$i++) {
					$selected='';
					if ($_GET["filtre"] == $data[$i][0]) $selected="selected='selected'"; 
					print "<option id='select1' $selected  value=\"".$data[$i][0]."\">".$data[$i][0]."</option>";
				}	
				?>
				</select></td><td>
</td></tr></table><br>
</form>
<table bgcolor=#FFFFFF border=1 bordercolor="#CCCCCC" width=100% style="border-collapse: collapse;" >

<?php
if (!isset($_GET["tri"])) {
//	$imgDate="<img src='../image/commun/za2b.png'>";
	$imgRef="";
	$imgObj="";
	$tri="date";
}else{
//	if ($_GET["tri"] == "date") $imgDate="<img src='../image/commun/za2b.png'>";
//	if ($_GET["tri"] == "refence") $imgRef="<img src='../image/commun/za2b.png'>";
//	if ($_GET["tri"] == "sujet") $imgObj="<img src='../image/commun/za2b.png'>";
	$tri=$_GET["tri"];
}


$filtre=$_GET["filtre"];

?>
<tr>
<td bgcolor='black'><a href="visucirculaire.php?tri=date&filtre=<?php print $filtre ?>"><font color='#FFFFFF' ><b><?php print LANGTE7 ?></b></font></a> <?php print $imgDate ?></td>
<td bgcolor='black'><a href="visucirculaire.php?tri=refence&filtre=<?php print $filtre ?>"><font color='#FFFFFF' ><b><?php print LANGMESS420 ?></b></font></a> <?php print $imgRef ?></td>
<td bgcolor='black'><a href="visucirculaire.php?tri=sujet&filtre=<?php print $filtre ?>"><font color='#FFFFFF' ><b><?php print LANGTE5 ?></b></font></a> <?php print $imgObj ?></td>
<td bgcolor='black' width='5%'><font color='#FFFFFF' ><b><?php print LANGASS7 ?></b></font></td>
</tr>


<?php
//---------------------------
// pour admin et vie scolaire
//---------------------------
if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")) {

	if ($_SESSION["membre"] == "menuscolaire") {
		$data=circulaireAffVieScolaire($tri,$filtre);
	}else{
		$data=circulaireAffAdmin($tri,$filtre); // id_circulaire,sujet,refence,file,date,enseignant,classe
	}

	for($i=0;$i<count($data);$i++) {
		$color=($color=="#87C1E6") ? $color="#BCDAF0" : $color="#87C1E6" ; 
		$id=$data[$i][0];
	?>
	<tr  bgcolor='<?php print $color ?>' >
	<td valign=top>&nbsp;<?php print dateForm($data[$i][4])?>&nbsp;</td>
	<td valign=top>&nbsp;<?php print $data[$i][2]?></td>
	<td valign=top>&nbsp;<?php print $data[$i][1]?></td>
	<td valign=top><input type='button' onClick="open('visu_document.php?fichier=data/circulaire/<?php print $data[$i][3]?>','_blank','')" title="<?php print LANGPARENT20 ?>" value="<?php print LANGBT28 ?>" class="btn btn-primary btn-sm  vat-btn-footer" /></td>
	</tr>
	<tr><td></td><td colspan='3'><i>
	<?php
	if ($data[$i][5] == 1) {
		print LANGPER6." - ";
	}

	// liste des classes
	$ligne=$data[$i][6];
	$ligne=substr("$ligne", 1); // retire le "{"
	$ligne=substr("$ligne", 0, -1); // retire le "}"
	$nbsep=substr_count("$ligne", ",");
	if ($nbsep == 0) {
		$val=chercheClasse_nom($ligne);
		print " $val";
	}else {
		for ($j=0;$j<=$nbsep;$j++) {
			list ($valeur) = split (',', $ligne);
			$sql="SELECT code_class,libelle FROM ${prefixe}classes WHERE  code_class='$valeur'";
			$res=execSql($sql);
			$data_7=chargeMat($res);
			for($a=0;$a<count($data_7);$a++) {
				print $data_7[$a][1]." - ";
			}
			$ligne = stristr($ligne, ',');
			$ligne=substr("$ligne", 1);
		}
	}

	?>
	</i></td></tr>
<?php
	}
}
?>
</table>
<br>
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
