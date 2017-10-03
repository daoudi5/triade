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
			<span class="vat-capitalize-title"><?php print LANGVATEL138 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<table width='100%' >
<?php
$data=affToutesLesMatieres(); //  code_mat,libelle,sous_matiere,offline,couleur, libelle_longe, code_matiere
for($i=0;$i<count($data);$i++)  {
	if ($data[$i][1] != "") {
		$code_matiere=$data[$i][6];
		if ($code_matiere != "") { 
			$code_matiere="<b>$code_matiere</b>&nbsp;:&nbsp;";
		}
		$libelleLong=$data[$i][5];
		if (trim($libelleLong) != "") {
			$libelleLong=" ($libelleLong)";
		}
		
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr bgcolor='$bgcolor' >\n";
		print "<td >";
		if ($data[$i][3] == 1) {
		print "<img src='../image/commun/img_ssl_mini.png' alt='Inactif' /> ";
		}
		print $code_matiere;
	    print $data[$i][1];
		if (trim($data[$i][2]) != "0") { print " ".$data[$i][2]." <i>(sous-matière)</i>"; }
		print "&nbsp;&nbsp;<i>$libelleLong</i> </td>";
		print "</tr>\n";
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