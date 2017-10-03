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
 
include_once("entete.php");
include_once("menu.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/lib_note.php"); 
$cnx=cnx2();



if ($_SESSION["membre"] == "menuadmin") { 
	$action1="";
	$action=$_GET["action"];
	if ($action == "ajoutnotes") 	  { $action1="ajoutnotes.php"; 		$menu=LANGVATEL26 ; }
	if ($action == "edtvisu") 	  { $action1="edtvisu.php"; 		$menu=LANGVATEL33 ; }
	if ($action == "ajoutabsRtdSanc") { $action1="ajoutabsRtdSanc.php";	$menu=LANGVATEL247 ; }
	if ($action == "cahiertext-visu") { $action1="cahiertext-visu.php"; 	$menu=LANGPROF37; } 
?> 

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print $menu ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<form method="post" action="<?php print $action1 ?>" >
		<font class="T2"><?php print LANGMESS238 ?> :</font> <select name="saisie_pers" class="form-control vat-extend-select pointer" >
             <option   STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
			<?php
			select_personne_2_selected('ENS','35',$_SESSION["idprofviaadmin"]); // creation des options
			?>
		</select>
		<br><br>
		<input type='submit' class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print LANGBT31 ?>" name='ajoutadmin' >
		
		</form>
		<br><br><br>
		</section>
		</div>
		</div>
	</div>
<?php 
} 
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>
