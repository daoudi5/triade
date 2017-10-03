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
validerequete("menuadmin");

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
			
<?php
$fichier=$_FILES['fichier']['name'];
$type=$_FILES['fichier']['type'];
$tmp_name=$_FILES['fichier']['tmp_name'];
$size=$_FILES['fichier']['size'];
$erreur_fichier="oui";

if ( (!empty($fichier)) &&  ($size <= 2000000)) {
	if  ((eregi('pdf',$type)) || (eregi('force',$type)))   {
		$erreur_fichier="non";

		//print "Nom du fichier :".$fichier." ".$type." ".$size." ".$tmp_name." ";
		$fichier=str_replace(" ","_",$fichier);
		$fichier=str_replace("'","_",$fichier);
		$fichier=str_replace("\\","",$fichier);
		$fichier=TextNoAccent($fichier);
		$fichier=rand(1000,9999)."-$fichier";
		move_uploaded_file($tmp_name,"../data/circulaire/$fichier");


		if (!empty($_POST["saisie_classe"])) {
			$classesPost=$_POST["saisie_classe"];
			$varClasseSql="{";
			$varClasseSql.=join(",",$classesPost);
			$varClasseSql.="}";
		}else {
			$varClasseSql="NULL";
		}

		$titre=$_POST["saisie_titre"];
		$ref=$_POST["saisie_ref"];
		$prof=$_POST["saisie_envoi_prof"];
		$cr=create_reglement($titre,$ref,$fichier,dateDMY2(),$prof,$varClasseSql);
		if($cr == 1){
			print "<BR><center><font class=T2>".LANGABS28."</font></center><br>";
		}

/*
print "<BR>";
print $titre;
print "<BR>";
print $ref;
print "<BR>";
print $prof;
print "<BR>";
*/
	} /// fin du if size et empty

} // fin du if type

if ($erreur_fichier == "oui" ) {
?>
<center> <font color=red><?php print LANGVATEL67 ?></font> <BR><BR>
<?php print LANGVATEL68 ?>
</center>
<?php
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