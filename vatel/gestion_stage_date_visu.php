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
			<span class="vat-capitalize-title"><?php print LANGSTAGE19." / ".LANGVATEL220 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_visu.php' ><?php print LANGVATEL220 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_aj.php' ><?php print LANGVATEL219 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_modif.php' ><?php print LANGVATEL222 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_supp.php' ><?php print LANGVATEL223 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">		
<br>
<!-- // fin  -->
<table border='1' width='100%'  bordercolor='#CCCCCC' style="border-collapse: collapse;" >
<?php
// connexion (après include_once lib_licence.php obligatoirement)
if ($_SESSION["membre"] != "menupersonnel") { validerequete("3"); }
$data=listestagenum();
for($i=0;$i<count($data);$i++) {
	$data22=$data[$i][0];
	$nomstage=$data[$i][1];
	$datanum[$data22]=$nomstage;
}
print "<tr>";
print "<td></td>";
$nb=0;
foreach($datanum as $key => $value) {
		$nb++;
		if ($nb == 5) { break; }
		print "<td align='center'  bgcolor='#FFFFFF' bordercolor='#000000' >".LANGSTAGE19."&nbsp;Num&nbsp;".$key." <br> <b>".trunchaine($value,20)."</b></td>";
}
print "</tr>";
$data=listestageclasse();
for($i=0;$i<count($data);$i++) {
        $data22=$data[$i][0];
        $dataclasse[$data22]=$data22;
}
foreach($dataclasse as $key => $value) {
		$nb=0;
		$nomClasse=chercheClasse_nom($key);
		if ($nomClasse == "") continue;
		print "<tr>";
		print "<td width=5  bgcolor='#FFFFFF' bordercolor='#000000' >&nbsp;".ereg_replace(' ','&nbsp;',$nomClasse)."&nbsp;</td>";
		foreach($datanum as $key2 => $value2) {
			$nb++;
			$datestage=listestageclassenum($key2,$key);
			print "<td align=center class='tabnormal' onmouseover=\"this.className='tabover'\" onmouseout=\"this.className='tabnormal'\" bordercolor='#000000' >";
			if (($_SESSION["membre"] != "menupersonnel") && ($_SESSION["membre"] != "menuprof")) { 
				print "<a href='gestion_stage_date_modif2.php?id=$key2'>";
			}		
			print "$datestage";
			if ($_SESSION["membre"] != "menupersonnel") {
				print "</a>";
			}
			print "</td>";
		}
		print "</tr>";
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