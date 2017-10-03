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


<?php 
if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")|| ($_SESSION["membre"] == "menuprof")) { ?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGASS24 ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='circulaire-visu.php?actu=campus' >CAMPUS</a></li>
				<li style="visibility:visible" ><a href='circulaire-visu.php?actu=classe' ><?php print $nomClasse ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>
		<div class='espace'></div>
		<div style="width:100%;background-color:#F4F5F7;">

		<section class="container" style="padding-top:10px">
		<?php
		if (($_GET["actu"] == "campus") || (!isset($_GET["actu"]))) { 
			$actu="campus";

			if (!isset($_GET["tri"])) {
			        $imgDate="<img src='../image/commun/za2.png'>";
			        $imgRef="";
			        $imgObj="";
			        $tri="date";
			}else{
			        if ($_GET["tri"] == "date") 	$imgDate="<img src='../image/commun/za2.png'>";
			        if ($_GET["tri"] == "refence") 	$imgRef="<img src='../image/commun/za2.png'>";
			        if ($_GET["tri"] == "sujet") 	$imgObj="<img src='../image/commun/za2.png'>";
			        $tri=$_GET["tri"];
			}
		?>	
			<table <?php  if (!$isPhone) print "width='100%'" ?> style="width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);"  >
			<tr bgcolor='#2199da' >
			<?php if ($_SESSION["membre"] == "menuprof") { ?>
				<td bgcolor='black' bordercolor='white' ><a href="circulaire-visu.php?actu=<?php print $actu ?>&tri=date"><font color='FFFFFF'><b><?php print LANGTE7 ?></a> <?php print $imgDate ?></b></font></td>
				<td bgcolor='black' bordercolor='white' ><a href="circulaire-visu.php?actu=<?php print $actu ?>&tri=sujet"><font color='FFFFFF'><b><?php print LANGTE5 ?></a> <?php print $imgObj ?></b></font></td>
				<td bgcolor='black' bordercolor='white' align='right' ><font color='FFFFFF'><b><?php print LANGTELECHARGER ?></b></font></td>
			<?php }else{ ?>
				<td style="border-bottom:1px solid #000000"><a href="circulaire-visu.php?actu=<?php print $actu ?>&tri=date"><font color='FFFFFF'><b><?php print LANGTE7 ?></a> <?php print $imgDate ?></b></font></td>
				<td style="border-bottom:1px solid #000000" ><a href="circulaire-visu.php?actu=<?php print $actu ?>&tri=sujet"><font color='FFFFFF'><b><?php print LANGTE5 ?></a> <?php print $imgObj ?></b></font></td>
				<td style="border-bottom:1px solid #000000"  align='right' ><font color='FFFFFF'><b><?php print LANGTELECHARGER ?></b></font></td>
			<?php } ?>
			</tr>

<?php
			if ($_SESSION["membre"] == "menueleve") {
				$idClasse=$_SESSION["idClasse"];
				$data=circulaireAffParent($idClasse,$tri,$filtre);
			 	for($i=0;$i<count($data);$i++) {
		                	$ok=0;
			                $ligne=$data[$i][6];
			                $ligne=substr("$ligne", 1); // retire le "{"
			                $ligne=substr("$ligne", 0, -1); // retire le "}"
			                $nbsep=substr_count("$ligne", ",");
			                if ($nbsep == 0) {
			                        if ($idClasse == $ligne) { $ok=1; }
			                }else {
			                        for ($j=0;$j<=$nbsep;$j++) {
			                                list ($valeur) = split (',', $ligne);
		                        	        if ($idClasse == $valeur) { $ok=1; }
		                  	              	$ligne = stristr($ligne, ',');
		                                	$ligne=substr("$ligne", 1);
		                        	}
		                	}
		
			                if ($ok == 1) {
						//$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
						 ?>
	        <tr bgcolor='#eeeeee' >
	        <td valign=top style="border-bottom:1px solid #000000"  >&nbsp;<?php print dateForm($data[$i][4])?>&nbsp;</td>
	        <td valign=top style="border-bottom:1px solid #000000" ><?php print $data[$i][1]?></td>
	        <td valign=top align='right' style="border-bottom:1px solid #000000"  >[&nbsp;<a href="../visu_document.php?fichier=./data/circulaire/<?php print $data[$i][3]?>" title="<?php print LANGPARENT20 ?>" target="_blank"><font color="blue"><?php print LANGBT28 ?></font></a>&nbsp;]</td>
	        </tr>
	        <?php
			                }
			        }
			}


			if ($_SESSION["membre"] == "menuprof") {
                                $visuProf="t";
                                $data=circulaireAffProf($visuProf,$tri,$filtre);
                                // id_circulaire sujet refence file date enseignant classe
				for($i=0;$i<count($data);$i++) {
					$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
					?>
					<tr bgcolor='#eeeeee' >
			                <td valign=top bordercolor='white' bgcolor='<?php print $bgcolor ?>'  >&nbsp;<?php print dateForm($data[$i][4])?>&nbsp;</td>
			                <td valign=top bordercolor='white' bgcolor='<?php print $bgcolor ?>'  ><?php print $data[$i][1]?></td>
			                <td valign=top align='right' bordercolor='white' bgcolor='<?php print $bgcolor ?>'  >[&nbsp;<a href="../visu_document.php?fichier=./data/circulaire/<?php print $data[$i][3]?>" title="<?php print LANGPARENT20 ?>" target="_blank"><font color="blue"><?php print LANGBT28 ?></font></a>&nbsp;]</td>
			                </tr>
					<?php
				}
                        }

			print "</table>";

		} 

		if ($_GET["actu"] == "classe")  { 
			$actu="classe";

		}

		?>

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre eleve */ ?>    
	
<?php Pgclose(); ?>
<br><br>	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
</body>
</html>
