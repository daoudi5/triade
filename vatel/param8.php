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
			<span class="vat-capitalize-title"><?php print LANGVATEL49 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			<ul><font class='T2' >
				- <a href='param8Classe.php' ><?php print LANGVATEL64 ?></a> <br />
				- <a href='create_eleve.php' ><?php print LANGMESS247 ?></a> <br />
				- <a href="param8compte.php?type=ENS"><?php print LANGGEN3 ?></a> <br />
				- <a href="param8Matiere.php"><?php print LANGASS18 ?></a><br />
				- <a href='creat_groupe.php'><?php print LANGVATEL74 ?></a><br />
				- <a href="param8compte.php?type=MVS"><?php print LANGGEN2 ?></a> <br />
				- <a href="param8compte.php?type=ADM"><?php print LANGVATEL65 ?></a> <br />
				- <a href="param8compte.php?type=TUT"><?php print LANGVATEL66 ?></a> <br />
				- <a href="param8regleint.php"><?php print LANGVATEL63 ?></a> <br />
				- <a href="param8tronbi.php">Trombinoscope</a> <br />
				- <a href="codebar0.php">code barre</a> <br />
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