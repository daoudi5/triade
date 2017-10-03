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
    exit;
}

?>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL88 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">


<center>
<?php
$nom_classe=chercheClasse($_POST["saisie_classe_envoi"]);
?>
<?php print LANGPER35?> <b><?php print $nom_classe[0][1]?></b> <?php print LANGPER35bis ?>
<?php
//--------------------------//

if (($_POST["saisie_classe_envoi"] > 0) && ($_POST["anneeScolaire"] != "")) {
	if(delAffectation($_POST["saisie_classe_envoi"],$_POST["anneeScolaire"])){
		vide_notes_classe($_POST["saisie_classe_envoi"],$_POST["anneeScolaire"]);
		history_cmd($_SESSION["nom"],"SUPPRESSION","affectation $nom_classe / année scolaire : ".$_POST["anneeScolaire"]);
	}
}

//--------------------------//
?>
</center>
<br><br>
<table align=center><tr><td>
<script language=JavaScript>buttonMagicVATEL("<?php print LANGBT47?>","suppression_affectation0.php","_parent","",""); </script>&nbsp;&nbsp;
</td></tr>
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