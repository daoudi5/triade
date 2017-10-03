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

if ($_SESSION["membre"] == "menupersonnel") {
	if (!verifDroit($_SESSION["id_pers"],"trombinoscopeRead")){ validerequete("2"); }
}else{
	validerequete("2");
	$visu=1;
	$visu2=1;
}

if (isset($_POST["create"])) {
	$photo=$_FILES['photo']['name'];
	$type=$_FILES['photo']['type'];
	$tmp_name=$_FILES['photo']['tmp_name'];
	$size=$_FILES['photo']['size'];

	$taille = getimagesize($tmp_name);
	if ((!empty($photo)) &&  ($size <= 2000000) &&  ($taille[0] <= 96) && ($taille[1] <= 96)   ) {
		$type=str_replace("image/","",$type);
		$type=str_replace("pjpeg","jpg",$type);
		$type=str_replace("jpeg","jpg",$type);
		$type=str_replace("x-png","png",$type);
		if (verifImageJpg($type))  {
			$nomphoto=$_POST["idpers"].".$type";
			move_uploaded_file($tmp_name,"../data/image_pers/$nomphoto");
			history_cmd($_SESSION["nom"],"PHOTO","AJOUT $nomphoto");
			modif_photo_pers($nomphoto,$_POST["idpers"]);
			print "<script>alert(\"Photo Enregistré \\n\\n L'Equipe Triade\");</script>";
		 }else{
			print "<script>alert(\"".LANGTRONBI3." \\n\\n L'Equipe Triade\");</script>";
		 }
	} else {
		print "<script>alert(\"".LANGTRONBI4." \\n\\n L'Equipe Triade\");</script>";
	}
}


?>
<script language="JavaScript" src="../librairie_js/lib_circulaire.js"></script>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL273 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='param8tronbi.php' ><?php print LANGVATEL69." ".LANGASS38 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		
<form method="post">
<BR>
<font class="T2"><?php print LANGVATEL73 ?></font>&nbsp;:&nbsp;<select id="saisie_classe" name="saisie_pers">
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<optgroup label="Direction" />
<?php select_personne('ADM'); ?>
<optgroup label="Vie Scolaire" />
<?php select_personne('MVS'); ?>
<optgroup label="Enseignant" />
<?php select_personne('ENS'); ?>
<optgroup label="Personnel" />
<?php select_personne('PER'); ?>
</select>&nbsp;&nbsp;<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
</form>
<?php
// affichage de la classe
if(isset($_POST["consult"])) {
?>
	<br /><br /><hr>
	<form method="post" ENCTYPE="multipart/form-data">
	<br>
	<table border=0 width=100%>
	<tr>
	<?php if (isset($_POST["saisie_pers"])) { $idpers=$_POST["saisie_pers"]; } ?>
	<td align=center><img src="image_trombi.php?idP=<?php print $idpers?>" /></td>
	<td width=65%>
	<font class="T2">
	<?php print LANGNA1 ?> : <b><?php print recherche_personne_nom($idpers,"XXX"); ?></b> <br><br>
	<?php print LANGNA2?> : <b><?php print recherche_personne_prenom($idpers,"XXX"); ?></b> <br><br>
	<br><br>
	</font>
	<br>
	<tr><td colspan=2 align=center><br> <?php print $text1?> <?php print LANGTRONBI7 ?> : <input type="file" name="photo" size=30 > <br> <?php print LANGLOGO3?> </td></tr>
<tr><td colspan=2 align=center><br>
<table align=center><tr><td><br>
<script language=JavaScript>buttonMagicSubmitVATEL('<?php print LANGBT46?>','create'); //text,nomInput</script>&nbsp;&nbsp;
</td></tr></table>
</td></tr></table>
<input type="hidden" name="idpers" value="<?php print $idpers?>" >
</form>
<?php
}
?>

<br><br>

		
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
