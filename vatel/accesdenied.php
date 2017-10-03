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
?>

<?php include_once("entete.php"); ?>
<?php include_once("menu.php"); ?>
<?php $cnx=cnx2(); ?>
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL25 ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='accueil.php?actu=campus' >CAMPUS</a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>
		<div style="width:100%;height:500px;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
		Vous ne disposez pas des droits d'accès.
		
		</section>
		</div>
		</div>
	</div>
	
<?php Pgclose(); ?>
	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
</body>
</html>
