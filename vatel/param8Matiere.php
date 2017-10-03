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

$id=$_GET["id"];


if(isset($_POST["supp"])){
	$id=$_POST["saisie_id_matiere"];
	$cr=@verif_utiliser_matiere($_POST["saisie_id_matiere"]);
	if (!$cr) {
        	$cr=suppression_matiere($_POST["saisie_id_matiere"]) ;
	        if($cr) {
				$matierenom=chercheMatiereNom($_POST["saisie_id_matiere"]);
				history_cmd($_SESSION["nom"],"SUPPRESSION","matière $matierenom");
        	    alertJs(LANGSUPP26);
			}
	}else {
		alertJs(LANGVATEL55.". \\n\\n ".LANGVATEL56.".");
	}
}


if (isset($_POST["offline"])) {
	modif_matiere_actif_desactif($_POST["saisie_id_matiere"],"1"); 
	history_cmd($_SESSION["nom"],"DESACTIVE"," de ".chercheMatiereNom($_POST["saisie_id_matiere"]));
	$id=$_POST["saisie_id_matiere"];
}
if (isset($_POST["online"])) {
	modif_matiere_actif_desactif($_POST["saisie_id_matiere"],"0"); 
	history_cmd($_SESSION["nom"],"ACTIVE"," de ".chercheMatiereNom($_POST["saisie_id_matiere"]));
	$id=$_POST["saisie_id_matiere"];
}

if (isset($_GET["suppsous"])) {
	suppSousMatiere($_GET["suppsous"]);
	alertJs(LANGDONENR);
	$id=$_GET["suppsous"];
}

if ((isset($_POST["modif"])) && ($_POST["supp"] != 1) ) {
	$matiere=$_POST["saisie_creat_matiere"];
	$sous_matiere=$_POST["sous_matiere"];
	$id=$_POST["saisie_id_matiere"];
	$matiereLong=$_POST["saisie_creat_matiere_long"];
	$code_matiere=$_POST["saisie_code_matiere"];
	$saisie_creat_matiere_en=$_POST["saisie_creat_matiere_en"];
	$cr=modif_matiere($_POST["saisie_creat_matiere"],$_POST["saisie_id_matiere"],$sous_matiere,$_POST["saisie_creat_matiere_long"],$code_matiere,$saisie_creat_matiere_en);
    if($cr){
		alertJs(LANGMAT5);
		$matiere=$_POST["saisie_creat_matiere"];
        history_cmd($_SESSION["nom"],"MODIFICATION","matière $matiere $sous_matiere");
	}else{
		alertJs(LANGMAT6); 
	}
}

if ($id > 0) {
	$matiere=trim(chercheMatiereNom2($id));
	$sous_matiere=trim(chercheSousMatiereNom($id));
	$matiereLong=trim(chercheMatiereLong($id));
	$code_matiere=trim(chercheCodeMatiere($id));
	$matiereEn=trim(chercheMatiereEn($id));
}

$offline=etatOfflineMatiere($id);

?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL49 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='param8Matiere.php' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='param8MatiereModif.php' ><?php print LANGMAT2 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<form method="post" action="param8Matiere.php" >
<BR>
<BR>
<!-- // fin  -->
&nbsp;&nbsp;
<font class=T2><?php print LANGGRP9?> :</font> <input type=text name="saisie_creat_matiere" size=20 maxlength='200' value="<?php print $matiere ?>" > <i><?php print LANGMESS208 ?></i><BR>
<BR><bR>
&nbsp;&nbsp;
<font class=T2><?php print LANGGRP9?> :</font> <input type=text name="saisie_creat_matiere_en" size=20 maxlength='200' value="<?php print $matiereEn ?>"  > <i><?php print LANGTMESS450 ?></i><BR>
<BR><bR>
&nbsp;&nbsp;
<font class=T2><?php print LANGGRP9?> :</font> <input type=text name="saisie_creat_matiere_long" size=40 maxlength='250' value="<?php print $matiereLong ?>"  > <i><?php print LANGMESS209 ?>.</i><BR>
<BR><bR>
&nbsp;&nbsp;
<font class=T2><?php print LANGMESS210 ?> :</font> <input type=text name="saisie_code_matiere" size=20 maxlength='20' value="<?php print $code_matiere ?>"  ><BR>
<BR><bR>
<?php
	$btsumbit0="create";
	if ($id > 0) {	
		print "<div style='float:left' >&nbsp;&nbsp;<font class=T2>".LANGVATEL54."</font>&nbsp;:&nbsp;</div>";
		print "<div><input type='checkbox' value='1' name='supp' /> (".LANGOUI.")</div>";
	}
	$btsumbit=LANGMAT1;
	if ($id > 0) { 
		$btsumbit0="modif";
		$btsumbit=LANGMAT4;
		if ($offline == 0) { ?>
		<br><br><script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGMESS418 ?>","offline"); //text,nomInput</script>
	<?php } else {?>
		<br><br><script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGMESS419 ?>","online"); //text,nomInput</script>
	<?php } ?>
<?php } ?>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print $btsumbit ?>","<?php print $btsumbit0 ?>"); //text,nomInput</script>
<br><br>	
<input type='hidden' name="saisie_id_matiere" value="<?php print $id ?>" />
</form>
		</section>
		</div>
		</div>
	</div>
<?php
if(isset($_POST["create"])){
    validerequete("menuadmin");
    $cr=create_matiere_2($_POST["saisie_creat_matiere"],$_POST["saisie_creat_matiere_long"],$_POST["saisie_code_matiere"],$_POST["saisie_creat_matiere_en"]);
    if($cr){
	    alertJs(LANGGRP8);
	    $matiere=$_POST["saisie_creat_matiere"];
        history_cmd($_SESSION["nom"],"CREATION","matiere $matiere");
    }
}

Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>