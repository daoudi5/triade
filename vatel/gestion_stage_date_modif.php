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
<script language="JavaScript" src="../librairie_js/lib_stage.js"></script>
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
<?php
if (isset($_GET["tri"])) {
	$data=listestageTri($_GET["tri"]);
	if (ereg('^idclasse',$_GET["tri"])) { $imgClass="<img src='../image/commun/za.png' border='0' />";	}
	if (ereg('^numstage',$_GET["tri"])) { $imgNum="<img src='../image/commun/za.png' border='0' />";	}
	if (ereg('^datedebut',$_GET["tri"])) { $imgDate="<img src='../image/commun/za.png' border='0' />";	}
}else{
	$imgClass="<img src='../image/commun/za.png' border='0' />";
	$data=listestage();
}

print "<table width=100% border=1 bordercolor='#000000' >";
print "<tr bgcolor='black'  >";
print "<td >&nbsp;<a href='gestion_stage_date_modif.php?tri=idclasse,numstage'><font class='T22'>".LANGELE4."</font></a>&nbsp; $imgClass</td>";
print "<td width=60>&nbsp;<a href='gestion_stage_date_modif.php?tri=numstage'><font class='T22'>".LANGSTAGE50."</font></a>&nbsp;$imgNum</td>";
print "<td>&nbsp;<a href='gestion_stage_date_modif.php?tri=datedebut'><font class='T22'>".LANGSTAGE51."</font></a>&nbsp; $imgDate</td>";
print "<td align=center width='1%'><font class='T22'>&nbsp;".LANGPER30."&nbsp;</font></td>";
print "</tr>";
// idclasse,datedebut,datefin,numstage
for($i=0;$i<count($data);$i++) {
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	print "<td id=bordure><font class=T1>".trunchaine(chercheClasse_nom($data[$i][0]),15)."</font></td>";
	print "<td align=center id=bordure ><font class=T1>".$data[$i][3]."</font></td>";
	print "<td id=bordure ><font class=T1 id=bordure>".dateForm($data[$i][1])." au ".dateForm($data[$i][2])."</font></td>";
	print "<td width=5 id=bordure align='center' ><input type=button value='".strtolower(LANGPER30)."' onclick=\"open('gestion_stage_date_modif2.php?id=".$data[$i][4]."','_parent','');\"  class='btn btn-primary btn-sm  vat-btn-footer' ></td></tr>";

}
print "</table>";

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