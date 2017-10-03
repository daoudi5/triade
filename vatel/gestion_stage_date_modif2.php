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
if (isset($_POST["create"])) {

	if ($_POST["id"] != "") {
        		$cr=stage_modif($_POST["id"],$_POST["num"],$_POST["debutdate"],$_POST["findate"],$_POST["saisie_classe"],$_POST["nom_stage"],$_POST["jourstage"]);
			$cr=1;
			if($cr == 1){
               	history_cmd($_SESSION["nom"],"MODIFICATION","date de stage");
        		print "<font color=red><br><br><center>".LANGSTAGE53.".";
				print "</center></font><br><br>";
			}else {
				print "<font color=red><br><br><center>";
				print LANGSTAGE52;
				print "</center></font><br><br>";
			}

	}else{

        		$cr=stage_ajout($_POST["num"],$_POST["debutdate"],$_POST["findate"],$_POST["saisie_classe"],$_POST["nom_stage"]);
			$cr=1;
			if($cr == 1){
                	history_cmd($_SESSION["nom"],"CREATION","date de stage");
        		print "<font color=red><br><br><center>".LANGSTAGE54." ".$_POST["debutdate"]." au ";
				print $_POST["findate"]." <br> ".LANGSTAGE55." ".chercheClasse_nom($_POST["saisie_classe"]) ;
				print LANGSTAGE56.".";
				print "</center></font><br><br>";
			}else {
				print "<font color=red><br><br><center>";
				print LANGSTAGE52;
				print "</center></font><br><br>";
			}
	}

}



$submitform="onsubmit='return validedatestage()'";

if (isset($_GET["id"])) {
	$data=recherchedatestage($_GET["id"]);
	// idclasse,datedebut,datefin,numstage,id,nom_stage,jourdesemaine
	for($i=0;$i<count($data);$i++) {
		$numstage=$data[$i][3];
		$datedebut=dateForm($data[$i][1]);
		$datefin=dateForm($data[$i][2]);
		$nomstage=$data[$i][5];
		$jourdesemaine=$data[$i][6];
		$idclasse="<option STYLE='color:#000066;background-color:#FCE4BA' value='".$data[$i][0]."'>".chercheClasse_nom($data[$i][0])."</option>";
		$id=$data[$i][4];
	}
	$submitform="onsubmit='return validedatestage2()'";
}


?>
<br>
<ul>
<font class=T2>
<form method=post <?php print $submitform?> name="formulaire">
<?php print LANGSTAGE48 ?> : <input type=text name="num" size=3 value='<?php print $numstage; ?>'><br><br>
<?php print "Nom de stage" ?> : <input type=text name="nom_stage" size=30 maxlength=50 value='<?php print $nomstage; ?>'><br><br>
<?php print LANGSTAGE45 ?> : <input type=text name="debutdate" size=12 value='<?php print $datedebut; ?>' class=bouton2>
<?php
 include_once("../librairie_php/calendar.php");
 calendarVATEL("id1","document.formulaire.debutdate",$_SESSION["langue"],"0");
?>
<br><br>
<?php print LANGSTAGE46 ?> : <input type=text name="findate" size=12 value='<?php print $datefin; ?>' class=bouton2>
<?php
 calendarVATEL("id2","document.formulaire.findate",$_SESSION["langue"],"0");
?>

<br><br>
<?php print LANGELE4?> : <select name="saisie_classe">
<?php
if (!isset($_GET['id'])) { ?>
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php } ?>
<?php
print $idclasse;
select_classe(); // creation des options
?>
</select>
<br>
<br>
<font class='T2'>
<?php print "En Entreprise le : " ?> </font>
<?php
$liste=explode(',',$jourdesemaine);
foreach($liste as $key=>$value) {
	if ($value == '1') $checkL="checked='checked'";
	if ($value == '2') $checkMA="checked='checked'";
	if ($value == '3') $checkME="checked='checked'";
	if ($value == '4') $checkJ="checked='checked'";
	if ($value == '5') $checkV="checked='checked'";
	if ($value == '6') $checkS="checked='checked'";
	if ($value == '7') $checkD="checked='checked'";
}
?>
<input type=checkbox name="jourstage[]" value="1"  id="j1"   <?php print $checkL ?>  style="float:none" /> L/M - 
<input type=checkbox name="jourstage[]" value="2"  id="j2"   <?php print $checkMA ?> style="float:none" /> M/T - 
<input type=checkbox name="jourstage[]" value="3"  id="j3"   <?php print $checkME ?> style="float:none" /> M/W -  
<input type=checkbox name="jourstage[]" value="4"  id="j4"   <?php print $checkJ ?>  style="float:none" /> J/T - 
<input type=checkbox name="jourstage[]" value="5"  id="j5"   <?php print $checkV ?>  style="float:none" /> V/F - 
<input type=checkbox name="jourstage[]" value="6"  id="j6"   <?php print $checkS ?>  style="float:none" /> S/S -
<input type=checkbox name="jourstage[]" value="7"  id="j7"   <?php print $checkD ?>  style="float:none" /> D/S 

<br /><br /><br />

<input type=hidden name=id value='<?php print $id;?>'>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGSTAGE47 ?>","create"); //text,nomInput</script>
<br><br>
</form>
</ul>

</font>

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