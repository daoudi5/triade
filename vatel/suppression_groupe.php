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
			<span class="vat-capitalize-title"><?php print LANGVATEL75 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='liste_groupe.php' ><?php print LANGBT12 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_groupe.php' ><?php print LANGGRP44 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
		
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php
if(isset($_POST["supp"])):
	$cr=@verifGroupeAffectation($_POST["saisie_grp_supp"]);
	$groupe=chercheGroupeNom($_POST["saisie_grp_supp"]);
	if (!$cr) {
        	$cr=suppression_groupe($_POST["saisie_grp_supp"]) ;
        	if($cr){
                	alertJs(LANGVATEL81." --  L'Equipe Triade");
			history_cmd($_SESSION["nom"],"SUPPRESSION","Groupe $groupe supprimé");
                	reload_page('suppression_groupe.php');
        	}else{
                	alertJs(LANGVATEL80." --  L'Equipe Triade");
		}
	}else {
		alertJs(LANGVATEL82."\\n\\n Service Triade");

	}
endif;
?>
<form method=post onsubmit="return valide_supp_choix('saisie_grp_supp','un groupe')" name="formulaire">

<font class="T2">Nom du groupe :</font>
<select name="saisie_grp_supp">
<option value=choix STYLE="color:#000066;background-color:#FCE4BA" ><?php print LANGCHOIX?></option>
<?php
$data=aff_groupe();
for($i=0;$i<count($data);$i++) {
	if ($data[$i][3] != "") {
?>
	<option value="<?php print $data[$i][0]?>" STYLE='color:#000066;background-color:#CCCCFF' ><?php print $data[$i][3]?></option>
<?php
	}
}
?>
</select><br><br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGSUPP8?>","supp"); //text,nomInput</script></UL></UL></UL><br><br>
</fieldset>

		
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