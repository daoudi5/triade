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

 
include_once("../common/config.inc.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/db_triade.php");
include_once("../librairie_php/timezone.php");
$cnx=cnx2();

?>
<header id="topNav" class="topHead vat-nav-master">
<?php 
if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")) { 
	$nomClasse=chercheClasse_nom($_SESSION["idClasse"]);
?>
	<div class="container nophone">
		<div class="navbar-collapse nav-main-collapse collapse pull-left " style="height:150px;" >
			<div style="position:relative;left:130px;top:-35px;float:left;z-index:100"><img src="images/paperclip.png" /></div>
			<div style="position:relative;left:84px;top:-8px;float:left;z-index:1;"><img src="../image_trombi.php?idE=<?php print $_SESSION["id_pers"] ?>" /></div>
			<div style="position:relative;left:95px;float:left;z-index:1">
			<p class="vat-font-white" >
			<?php print LANGNA1." : ". $_SESSION["nom"]."<br> ".LANGNA2." : ".$_SESSION["prenom"] ?>
			<br/>
			<?php print LANGELE4." : $nomClasse "?>
			<br/>
			</p>
			</div>
			<div style="position:relative;left:210px;float:left;z-index:100">
				<a title="<?php print LANGCARNET24 ?>" href='notes.php' ><img src='images/B1on.png' id='img1' onmouseover="document.getElementById('img1').src='images/B1off.png'" onMouseOut="document.getElementById('img1').src='images/B1on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a title="Moodle" href='../moodle/login/index.php' target='_blank' ><img src='images/B2on.png' id='img2' onmouseover="document.getElementById('img2').src='images/B2off.png'" onMouseOut="document.getElementById('img2').src='images/B2on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="edtvisu.php" title="<?php print LANGMESS55 ?>" ><img src='images/B3on.png' id='img3' onmouseover="document.getElementById('img3').src='images/B3off.png'" onMouseOut="document.getElementById('img3').src='images/B3on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='absRtdSanc.php' title="<?php print LANGASS6 ?>" ><img src='images/B7on.png' id='img7' onmouseover="document.getElementById('img7').src='images/B7off.png'" onMouseOut="document.getElementById('img7').src='images/B7on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://mail.office365.com" target="_blank" title="<?php print LANGASS14 ?>" ><img src='images/B4on.png' id='img4' onmouseover="document.getElementById('img4').src='images/B4off.png'" onMouseOut="document.getElementById('img4').src='images/B4on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='cahiertext-visu.php' title="<?php print LANGPROF37 ?>" ><img src='images/B5on.png' id='img5' onmouseover="document.getElementById('img5').src='images/B5off.png'" onMouseOut="document.getElementById('img5').src='images/B5on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='circulaire-visu.php' title="<?php print LANGASS24 ?>" ><img src='images/B6on.png' id='img6' onmouseover="document.getElementById('img6').src='images/B6off.png'" onMouseOut="document.getElementById('img6').src='images/B6on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			<div class="container" style="z-index:1">
				<div class="btn-group pull-right">
				<!--	<a href="verrou.php" class="lien" ><img src="../image/commun/img_ssl.gif" border='0' title="" /></a>&nbsp;&nbsp; -->
					<a href="index.php?deconnexion" class="lien" ><img src="images/quitter.png" border='0' title="<?php print LANGVATEL1 ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
		</div>
	</div>

	<div class="container phone">
	<button class="btn btn-mobile vat-btn-nav vat-brradius-4" data-target=".nav-main-collapse" data-toggle="collapse" style="margin-top: 8px;">
	<i class="fa fa-bars"></i>Menus</button>
	<div class="navbar-collapse nav-main-collapse collapse pull-right" style="margin-top: 16px;">
	<nav class="nav-main mega-menu">
	<ul id="topMain" class="nav nav-pills nav-main scroll-menu">
	<a href='notes.php' 		style='text-decoration:none' ><li class="dropdown"><?php print LANGCARNET24 ?>.</li></a>
	<a href='edtvisu.php'  style='text-decoration:none'><li class="dropdown"><?php print LANGMESS55 ?>.</li></a>
	<a href='absRtdSanc.php'  	style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL8 ?>.</li></a>
	<a href='circulaire-visu.php' 	style='text-decoration:none' ><li class="dropdown"><?php print LANGASS24 ?>.</li></a>
 	<a href="http://mail.office365.com" target="_blank" style='text-decoration:none'><li class="dropdown"><?php print LANGASS14 ?>.</li></a>
	<a href='cahiertext-visu.php' 	style='text-decoration:none'><li class="dropdown"><?php print LANGPROF37 ?></li></a>
	<a href='../moodle/login/index.php' target='_blank' style='text-decoration:none'><li class="dropdown">Moodle.</li></a>
	<a href="index.php?deconnexion" style='text-decoration:none' ><li class="dropdown"><?php print LANGVATEL1 ?>.</li></a>
	<li>
	</ul>
	</nav>
	</div>
</div>

<?php } ?>




<?php 
if ($_SESSION["membre"] == "menuprof") { 
	$nomClasse=chercheClasse_nom($_SESSION["idClasse"]);
?>
	<div class="container nophone">
		<div class="navbar-collapse nav-main-collapse collapse pull-left " style="height:150px;" >
			<div style="position:relative;left:130px;top:-35px;float:left;z-index:100"><img src="images/paperclip.png" /></div>
			<div style="position:relative;left:84px;top:-8px;float:left;z-index:1;"><img src="../image_trombi.php?idE=<?php print $_SESSION["id_pers"] ?>" /></div>
			<div style="position:relative;left:95px;float:left;z-index:1">
			<p class="vat-font-white" >
			<?php print LANGNA1." : ". $_SESSION["nom"]."<br> ".LANGNA2." : ".$_SESSION["prenom"] ?>
			<br/>
			</p>
			</div>
			<div style="position:relative;left:210px;float:left;z-index:100">
				<a title="<?php print LANGCARNET24 ?>" href='ajoutnotes.php' ><img src='images/B1on.png' id='img1' onmouseover="document.getElementById('img1').src='images/B1off.png'" onMouseOut="document.getElementById('img1').src='images/B1on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a title="Moodle" href='../moodle/login/index.php' target='_blank' ><img src='images/B2on.png' id='img2' onmouseover="document.getElementById('img2').src='images/B2off.png'" onMouseOut="document.getElementById('img2').src='images/B2on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="edtvisu.php" title="<?php print LANGMESS55 ?>" ><img src='images/B3on.png' id='img3' onmouseover="document.getElementById('img3').src='images/B3off.png'" onMouseOut="document.getElementById('img3').src='images/B3on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='ajoutabsRtdSanc.php' title="<?php print LANGASS6 ?>" ><img src='images/B7on.png' id='img7' onmouseover="document.getElementById('img7').src='images/B7off.png'" onMouseOut="document.getElementById('img7').src='images/B7on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='cahiertext-visu.php' title="<?php print LANGPROF37 ?>" ><img src='images/B5on.png' id='img5' onmouseover="document.getElementById('img5').src='images/B5off.png'" onMouseOut="document.getElementById('img5').src='images/B5on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='circulaire-visu.php' title="<?php print LANGASS24 ?>" ><img src='images/B6on.png' id='img6' onmouseover="document.getElementById('img6').src='images/B6off.png'" onMouseOut="document.getElementById('img6').src='images/B6on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='listing.php' title="<?php print LANGMESS250 ?>" ><img src='images/B16on.png' id='img16' onmouseover="document.getElementById('img16').src='images/B16off.png'" onMouseOut="document.getElementById('img16').src='images/B16on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://mail.office365.com" target="_blank" title="<?php print LANGASS14 ?>" ><img src='images/B4on.png' id='img4' onmouseover="document.getElementById('img4').src='images/B4off.png'" onMouseOut="document.getElementById('img4').src='images/B4on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
			</div>
			<div class="container" style="z-index:1">
				<div class="btn-group pull-right">
					<a href="index.php?deconnexion" class="lien" ><img src="images/quitter.png" border='0' title="<?php print LANGVATEL1 ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
		</div>
	</div>

	<div class="container phone">
	<button class="btn btn-mobile vat-btn-nav vat-brradius-4" data-target=".nav-main-collapse" data-toggle="collapse" style="margin-top: 8px;">
	<i class="fa fa-bars"></i>Menus</button>
	<div class="navbar-collapse nav-main-collapse collapse pull-right" style="margin-top: 16px;">
	<nav class="nav-main mega-menu">
	<ul id="topMain" class="nav nav-pills nav-main scroll-menu">
	<a href='ajoutnotes.php' 		style='text-decoration:none' ><li class="dropdown"><?php print LANGCARNET24 ?>.</li></a>
	<a href='edtvisu.php'  style='text-decoration:none'><li class="dropdown"><?php print LANGMESS55 ?>.</li></a>
	<a href='ajoutabsRtdSanc.php'  	style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL8 ?>.</li></a>
	<a href='ajoutcahiertext.php' 	style='text-decoration:none'><li class="dropdown"><?php print LANGPROF37 ?></li></a>
	<a href='cahiertext-visu.php' 	style='text-decoration:none'><li class="dropdown"><?php print LANGASS24 ?></li></a>
	<a href='listing.php'     	style='text-decoration:none'><li class="dropdown"><?php print LANGMESS250 ?></li></a>
	<a href='../moodle/login/index.php' target='_blank' style='text-decoration:none'><li class="dropdown">Moodle.</li></a>
	<a href="index.php?deconnexion" style='text-decoration:none' ><li class="dropdown"><?php print LANGVATEL1 ?>.</li></a>
 	<a href="http://mail.office365.com" target="_blank" style='text-decoration:none'><li class="dropdown"><?php print LANGASS14 ?>.</li></a>
	<li>
	</ul>
	</nav>
	</div>
</div>

<?php } ?>



<?php 
if ($_SESSION["membre"] == "menuadmin") { 
	$nomClasse=chercheClasse_nom($_SESSION["idClasse"]);
?>
	<div class="container nophone">
		<div class="navbar-collapse nav-main-collapse collapse pull-left " style="height:150px;" >
			<div style="position:relative;left:130px;top:-35px;float:left;z-index:100"><img src="images/paperclip.png" /></div>
			<div style="position:relative;left:84px;top:-8px;float:left;z-index:1;"><img src="../image_trombi.php?idE=<?php print $_SESSION["id_pers"] ?>" /></div>
			<div style="position:relative;left:95px;float:left;z-index:1">
			<p class="vat-font-white" >
			<?php print LANGNA1." : ". $_SESSION["nom"]."<br> ".LANGNA2." : ".$_SESSION["prenom"] ?>
			<br/>
			</p>
			</div>
			<div style="position:relative;left:210px;float:left;z-index:100">
				<a title="<?php print LANGCARNET24 ?>" href='selectens.php?action=ajoutnotes' ><img src='images/B1on.png' id='img1' onmouseover="document.getElementById('img1').src='images/B1off.png'" onMouseOut="document.getElementById('img1').src='images/B1on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a title="Moodle" href='../moodle/login/index.php' target='_blank' ><img src='images/B2on.png' id='img2' onmouseover="document.getElementById('img2').src='images/B2off.png'" onMouseOut="document.getElementById('img2').src='images/B2on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="selectens.php?action=edtvisu" title="<?php print LANGMESS55 ?>" ><img src='images/B3on.png' id='img3' onmouseover="document.getElementById('img3').src='images/B3off.png'" onMouseOut="document.getElementById('img3').src='images/B3on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='gestionABSRtdSanc.php' title="<?php print LANGASS6 ?>" ><img src='images/B7on.png' id='img7' onmouseover="document.getElementById('img7').src='images/B7off.png'" onMouseOut="document.getElementById('img7').src='images/B7on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='selectens.php?action=cahiertext-visu' title="<?php print LANGPROF37 ?>" ><img src='images/B5on.png' id='img5' onmouseover="document.getElementById('img5').src='images/B5off.png'" onMouseOut="document.getElementById('img5').src='images/B5on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='circulaire-admin.php' title="<?php print LANGASS24 ?>" ><img src='images/B6on.png' id='img6' onmouseover="document.getElementById('img6').src='images/B6off.png'" onMouseOut="document.getElementById('img6').src='images/B6on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='param8.php' title="<?php print LANGVATEL246 ?>" ><img src='images/B8on.png' id='img8' onmouseover="document.getElementById('img8').src='images/B8off.png'" onMouseOut="document.getElementById('img8').src='images/B8on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='param9.php' title="<?php print LANGVATEL254 ?>" ><img src='images/B9on.png' id='img9' onmouseover="document.getElementById('img9').src='images/B9off.png'" onMouseOut="document.getElementById('img9').src='images/B9on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='param10.php' title="<?php print LANGVATEL138 ?>" ><img src='images/B11on.jpg' id='img10' onmouseover="document.getElementById('img10').src='images/B11off.jpg'" onMouseOut="document.getElementById('img10').src='images/B11on.jpg'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br>
				<a href='param11.php' title="<?php print LANGVATEL167 ?>" ><img style="padding-top:7px" src='images/B14on.jpg' id='img12' onmouseover="document.getElementById('img12').src='images/B14off.jpg'" onMouseOut="document.getElementById('img12').src='images/B14on.jpg'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='param12.php' title="<?php print LANGVATEL206 ?>" ><img style="padding-top:7px" src='images/B13on.jpg' id='img13' onmouseover="document.getElementById('img13').src='images/B13off.jpg'" onMouseOut="document.getElementById('img13').src='images/B13on.jpg'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='param13.php' title="<?php print LANGSTAGE19 ?>" ><img style="padding-top:7px" src='images/B12on.jpg' id='img14' onmouseover="document.getElementById('img14').src='images/B12off.jpg'" onMouseOut="document.getElementById('img14').src='images/B12on.jpg'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='../acces2.php' target="_blank" title="<?php print "Old Version" ?>" ><img style="padding-top:7px" src='images/B18on.jpg' id='img18' onmouseover="document.getElementById('img18').src='images/B18off.jpg'" onMouseOut="document.getElementById('img18').src='images/B18on.jpg'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="editer_eleve.php" title="<?php print LANGTITRE30 ?>" ><img src='images/B17off.jpg' id='img17' onmouseover="document.getElementById('img17').src='images/B17on.jpg'" onMouseOut="document.getElementById('img17').src='images/B17off.jpg'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<a href="http://mail.office365.com" target="_blank" title="<?php print LANGASS14 ?>" ><img src='images/B4on.png' id='img4' onmouseover="document.getElementById('img4').src='images/B4off.png'" onMouseOut="document.getElementById('img4').src='images/B4on.png'" ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
				</div>
			<div class="container" style="z-index:1">
				<div class="btn-group pull-right">
					<a href="index.php?deconnexion" class="lien" ><img src="images/quitter.png" border='0' title="<?php print LANGVATEL1 ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
		</div>
	</div>

	<div class="container phone">
	<button class="btn btn-mobile vat-btn-nav vat-brradius-4" data-target=".nav-main-collapse" data-toggle="collapse" style="margin-top: 8px;">
	<i class="fa fa-bars"></i>Menus</button>
	<div class="navbar-collapse nav-main-collapse collapse pull-right" style="margin-top: 16px;">
	<nav class="nav-main mega-menu">
	<ul id="topMain" class="nav nav-pills nav-main scroll-menu">
	<a href='selectens.php?action=ajoutnotes' 		style='text-decoration:none' ><li class="dropdown"><?php print LANGCARNET24 ?>.</li></a>
	<a href='selectens.php?action=edtvisu'  style='text-decoration:none'><li class="dropdown"><?php print LANGMESS55 ?>.</li></a>
	<a href='gestionABSRtdSanc.php'  	style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL8 ?>.</li></a>
	<a href='selectens.php?action=cahiertext-visu' 	style='text-decoration:none'><li class="dropdown"><?php print LANGPROF37 ?></li></a>
	<a href='circulaire-admin.php' 	style='text-decoration:none'><li class="dropdown"><?php print LANGASS24 ?></li></a>
	<a href='param8.php'  style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL49 ?>.</li></a>
	<a href='param9.php'  style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL254 ?>.</li></a>
	<a href='param10.php' style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL138 ?>.</li></a>
	<a href='param11.php' style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL167 ?>.</li></a>
	<a href='param12.php' style='text-decoration:none'><li class="dropdown"><?php print LANGVATEL167 ?>.</li></a>
	<a href='param13.php' style='text-decoration:none'><li class="dropdown"><?php print LANGSTAGE19 ?>.</li></a>
	<a href='../moodle/login/index.php' target='_blank' style='text-decoration:none'><li class="dropdown">Moodle.</li></a>
 	<a href="http://mail.office365.com" target="_blank" style='text-decoration:none'><li class="dropdown"><?php print LANGASS14 ?>.</li></a>
	<a href="index.php?deconnexion" style='text-decoration:none' ><li class="dropdown"><?php print LANGVATEL1 ?>.</li></a>
	<li>
	</ul>
	</nav>
	</div>
</div>

<?php } ?>



</header>
<span id="header_shadow"></span>
<?php Pgclose(); ?>
