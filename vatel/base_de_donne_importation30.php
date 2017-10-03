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

@unlink("./data/fichier_gep/traitement.xls");
if (empty($_SESSION["adminplus"])) {
	print "<script>";
	print "location.href='./param11.php'";
	print "</script>";
	exit;
}
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL168 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<br />
<form method='post'  action='./base_de_donne_importation31.php' name='formulaire' ENCTYPE="multipart/form-data">
<font class="T2"><?php print LANGVATEL193 ?> </font><select name="annee_scolaire" size="1" onChange="document.getElementById('file').disabled=false;" >
<?php
filtreAnneeScolaireSelectFutur(); // creation des options
?>
 </select><br><br><br>
<font class=T2><?php print LANGGEP2?> : (<b>xls</b>)  <input type="file" name="fichier1" size=20 id='file' disabled='diabled'  ></font> <br /><br />
<br />
<script>
function fonc1() { 
	if (document.formulaire.update.checked == true) {
		document.formulaire.vide_eleve.checked=false;
		document.formulaire.vide_eleve.disabled=true;
		document.getElementById('up1').style.display='block';
	}
	if (document.formulaire.update.checked == false) {
		document.formulaire.vide_eleve.checked=false;
		document.formulaire.vide_eleve.disabled=false;
		document.formulaire.updatevide.checked=false;
		document.formulaire.updatepasswd.checked=false;
		document.getElementById('up1').style.display='none';
	}
}
</script>
<img src='image/on1.gif' height=8 width=8 > <?php print LANGVATEL188 ?> : <input type=checkbox style="float:none" name="update" value="1" onclick='fonc1()' > (<?php print LANGOUI ?>)
<div id='up1' style="display:none" > 
<?php print "- ".LANGVATEL189 ?> : <input type=checkbox name="updatevide" value="1" style="float:none" > (<?php print LANGNON ?>) <br />
<?php print "- ".LANGVATEL190 ?> : <input type=checkbox name="updatepasswd" value="1" style="float:none" > (<?php print LANGNON ?>) 
</div>
<br />
<img src='image/on1.gif' height=8 width=8 > <?php print LANGVATEL187 ?> : <input style="float:none" type=checkbox name="optionligne" value="1" > (<?php print LANGOUI ?>)
<br />
<img src='image/on1.gif' height=8 width=8 > <?php print LANGBASE41 ?> : <input style="float:none" type=checkbox name="vide_eleve" value="oui"  > (<?php print LANGOUI ?>) ( <i><?php print LANGVATEL191 ?></i> )
<br />
<?php
$annee=date("Y")-1;
$annee=$annee."-".date("Y");
if (file_exists("./data/archive/$annee.sqlite")) {
	print "<br><font color=red>".LANGVATEL192."</font><br>";
}
?>
<br />
<br />
<ul><ul>
<script language=JavaScript>buttonMagicSubmit2VATEL("<?php print LANGBT23?>","<?php print LANGbasededon201?>","<?php print LANGBT5?>"); //text,nomInput</script>
<!-- <script language=JavaScript>buttonMagicSubmit("<?php print LANGbasededon20?>","<?php print LANGbasededon201?>"); //text,nomInput</script> -->
</ul></ul></ul>
<br><br><br>
</font>
&nbsp;&nbsp;<?php print LANGbasededon21?>
<br>
</form>

			
		
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