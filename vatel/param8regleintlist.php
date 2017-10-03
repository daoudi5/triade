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

if (isset($_GET["supp"])) {
	$info=chercheReglement($_GET["supp"]); // id,sujet,refence,file,date,enseignant,classe
	$cr=reglementSup($_GET["supp"]) ;
    if($cr) {
		$nomfichier=$info[0][3];
		@unlink ("../data/circulaire/".trim($nomfichier));
    }
}

?>
<script language="JavaScript" src="../librairie_js/lib_circulaire.js"></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL63 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='param8regleint.php' ><?php print LANGMESS212 ?></a></li>
				<li style="visibility:visible" ><a href='param8regleintlist.php' ><?php print LANGMESS213 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
	
<table width='100%' style="padding:15px" >	
<?php
if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")) {
	$data=reglementAffAdmin(); // id,sujet,refence,file,date,enseignant,classe
	/*
	<td bgcolor='yellow'><?php print LANGTE5 ?></td>
	<td bgcolor='yellow'><?php print LANGPARENT20 ?></td>
	<td bgcolor="yellow"><?php print LANGPARENT21 ?></td>
	*/
	for($i=0;$i<count($data);$i++) {
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr bgcolor='$bgcolor' >\n";
	?>
	<td valign=top>&nbsp;<?php print dateForm($data[$i][4])?>&nbsp;:&nbsp;<b><?php print $data[$i][2]?> <?php print $data[$i][1]?></b></b> 
	<?php
	if ($data[$i][5] == 1) { print LANGPER6." - "; }
	print LANGELE4."&nbsp;:&nbsp;";
	// liste des classes
	$ligne=$data[$i][6];
	$idcirculaire=$data[$i][0];
	$ligne=substr("$ligne", 1); // retire le "{"
	$ligne=substr("$ligne", 0, -1); // retire le "}"
	$nbsep=substr_count("$ligne", ",");
	if ($nbsep == 0) {
		$val=chercheClasse_nom($ligne);
		print $val;
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

	?></td><td width='5%'>&nbsp;[&nbsp;<a href="visu_document.php?fichier=./data/circulaire/<?php print trim($data[$i][3])?>" title="<?php print LANGPARENT20 ?>" target="_blank"><font class='white' ><?php $cir=trim($data[$i][3]); print  LANGBT28 ?></font></a>&nbsp;]&nbsp;[&nbsp;<a href="param8regleintlist.php?supp=<?php print $idcirculaire ?>" ><font class='white' ><?php print  LANGacce21 ?></font></a>]&nbsp;</td></tr>
<?php
	}
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