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

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL49 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='param8Classe.php' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='param8ClasseModif.php' ><?php print LANGCLAS1 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<table width=100% >
<?php

$data=affClasseSansOffline(); //code_class,libelle,desclong,offline,idsite
// code_class,libelle,desclong,offline,idsite,niveau
for($i=0;$i<count($data);$i++)
{
	if ($data[$i][0] == 0) {
			$disabled="disabled='disabled'";
	}else{
			$disabled="";
	}
	$description_long=stripslashes(trim($data[$i][2]));
	$niveau="";
	if ($data[$i][5] != "") $niveau="(".$data[$i][5].")";
	$idsite=$data[$i][4];
	if ($idsite > 0) {
		$site=recupSite($idsite);
	}
	if ($description_long != "") {
		$description_long=" ($description_long)";
	}
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
    print "<tr bgcolor='$bgcolor' >\n";
	print "<td>";
	if ($data[$i][3] == 1) {
		print "<img src='../image/commun/img_ssl_mini.png' alt='Inactif' /> ";
	}
	print "<b>".$data[$i][1]."</b> <font color=green>$niveau</font> <i>".$description_long."</i>&nbsp;<font size=1>(rattach&eacute;e au site : $site)</font> </td>\n";
	print "<td width=5><input type=button value=\"".LANGPER30."\" onclick=\"open('param8Classe.php?id=".$data[$i][0]."','_parent','');\" $disabled class=\"btn btn-primary btn-sm  vat-btn-footer\" ></td>\n";
	print "</tr>\n";
	$description_long="";
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