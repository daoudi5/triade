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
if (isset($_GET["id"])) {
	if ($_GET["id"] == "tous") {
		$cr=stage_date_supp_tous();
		if($cr == 1){
			history_cmd($_SESSION["nom"],"SUPPRESSION","des dates de stage");
		}
	}else{
		$cr=stage_date_supp($_GET["id"]);
		if($cr == 1){
			history_cmd($_SESSION["nom"],"SUPPRESSION","date de stage");
			alertJs(LANGSTAGE57);
		}else{
			alertJs("Suppression Impossible \\n \\n Cette référence de date est actuellement affecté à un ou plusieurs élèves.");
		}
	}
}
$data=listestage();
print "<br>&nbsp;&nbsp;<font class='T2'>".LANGVATEL224."&nbsp;:&nbsp;<input type=button value='".LANGBT50."' onclick=\"open('gestion_stage_date_supp.php?id=tous','_parent','');\"  class='btn btn-primary btn-sm  vat-btn-footer' /></font><br><br>";

print "<table width=100% border=1 bordercolor='#000000' >";
print "<tr bgcolor='black'  ><td ><font class='T22'>&nbsp;".LANGELE4."&nbsp;</font></td>";
print "<td width=5><font class='T22'>&nbsp;".LANGSTAGE50."&nbsp;N&deg;&nbsp;</font></td>";
print "<td><font class='T22'>&nbsp;".LANGSTAGE51."&nbsp;</font></td>";
print "<td align=center><font class='T22'>&nbsp;".LANGBT50."&nbsp;</font></td></tr>";
// idclasse,datedebut,datefin,numstage,id
for($i=0;$i<count($data);$i++) {
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	$nomclasse=chercheClasse_nom($data[$i][0]);
	print "<td id=bordure align=left><font class=T1>".trunchaine($nomclasse,15)."</font></td>";
	print "<td id=bordure align=center><font class=T1>".$data[$i][3]."</font></td>";
	print "<td id=bordure ><font class=T1>".dateForm($data[$i][1])." au ".dateForm($data[$i][2])."</font></td>";
	print "<td id=bordure width=5><input type='button' value='".LANGBT50."' onclick=\"open('gestion_stage_date_supp.php?id=".$data[$i][4]."','_parent','');\"  class='btn btn-primary btn-sm  vat-btn-footer' ></td>";
	print "</tr>";
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