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
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL138 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			<ul><font class='T2' >
				<li><?php print LANGVATEL139 ?></li>
				<ul>
				<li><a href="consult_classe.php"><?php print LANGVATEL140 ?></a></li>
				<li><a href="emargement.php"><?php print LANGVATEL153 ?></a></li>
				<li><a href="listEns.php?type=ENS"><?php print LANGVATEL158 ?></a></li>
				<li><a href="listMat.php"><?php print LANGVATEL159 ?></a></li>
				<li><a href="affectation_visu.php"><?php print LANGVATEL242 ?></a></li>
				<li><a href="editcertificat.php"><?php print LANGVATEL160 ?></a></li>
				<li><?php print LANGVATEL163 ?></li>
				</ul>
				<li><?php print LANGMESS327 ?></li>
				<ul>
				<li><a href="publipostage.php?type=ELE"><?php print LANGVATEL164 ?></li>
				<li><a href="publipostage.php?type=PAR"><?php print LANGVATEL165 ?></li>
				</ul>
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