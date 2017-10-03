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

include_once("../librairie_php/ajax.php");
ajax_js();

?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL215 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_visu.php' ><?php print LANGVATEL225 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_ent_ajout.php' ><?php print LANGASS8 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGMESS149 ?></a></li>
				<li style="visibility:visible" ><a href='' ><?php print LANGASS10 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		
<form method="post" action="gestion_stage_ent_visu_rech_nom.php" name="formulaire_2" >
<table border=0 cellspacing=0><tr><td style="padding-top:0px;" nowrap>
<font class=T2><?php print LANGSTAGE20?> : </font>
<input type='text' autocomplete='off' name='recherche' size='30' onkeyup="searchRequest(this,'entreprise','target0','formulaire_2','recherche')" style="width:22em" >
</td></tr><tr><td style="padding-top:0px;"><span id="target0" style="width:25.5em" ></span></td></tr>
</table>
<br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","rech2"); //text,nomInput</script>
</form>
<hr>
<br>
<form method="post" action="gestion_stage_impr.php" >
<table border=0 cellspacing=0><tr><td style="padding-top:0px;" nowrap>
<tr><td><script language=JavaScript>buttonMagicSubmitVATEL('<?php print LANGVATEL227 ?>','imp')</script></td></tr>
</table>
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