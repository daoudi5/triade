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

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL254 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			<ul><font class='T2' >
				-&nbsp;<?php print LANGVATEL84 ?><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="configannee.php"><?php print LANGBULL3 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="param.php"><?php print LANGVATEL85 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="definir_trimestre.php"><?php print LANGPARAM17 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="base_de_donne_key.php?base=affectation"><?php print LANGVATEL86 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="base_de_donne_key.php?base=affectationmodif&sClasseGrp=<?php print $_GET["sClasseGrp"] ?>" ><?php print LANGVATEL87 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="suppression_affectation.php"><?php print LANGVATEL88 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="vatel_list_ue.php"><?php print LANGVATEL89 ?></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<a href="edt.php"><?php print LANGVATEL255 ?></a><br>
				-&nbsp;<a href="gestion_abs_config.php"><?php print LANGVATEL90 ?></a><br>
				-&nbsp;<a href="certificat.php"><?php print LANGVATEL91 ?></a><br>
				-&nbsp;<a href="gestion_supplement_titre.php"><?php print LANGVATEL92 ?></a><br>
				</font>
			</ul>
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
