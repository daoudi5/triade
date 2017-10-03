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
if (isset($_POST["val"])) {
	statUtilisateur($_SESSION["nom"],$_SESSION["prenom"],$_SESSION["id_pers"],$_SESSION["membre"]);
	enr_statUtilisateur($_SESSION["nom"],$_SESSION["prenom"],$_SESSION["id_pers"],$_SESSION["membre"],$_SESSION["id_SESSION"]);
}
if (verif_compte($_SESSION["nom"],$_SESSION["prenom"],$_SESSION["id_pers"],$_SESSION["membre"])) {
      print "<script type='text/javascript'>location.href='inscription.php'; </script>";
}



if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")) { ?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL25 ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='accueil.php?actu=campus' >CAMPUS</a></li>
				<li style="visibility:visible" ><a href='accueil.php?actu=classe' ><?php print $nomClasse ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;height:500px;background-color:#F4F5F7">

		<section class="container" style="padding-top:10px">
		<?php
		if (($_GET["actu"] == "campus") || (!isset($_GET["actu"]))) { 
			$recupMessAdmin=consultMessAdmin();  //idnews,nom,prenom,date,heure,titre,texte,type
			if (count($recupMessAdmin)) { $nbbordure='1'; }else{ $nbbordure='0'; }
			for($i=0;$i<count($recupMessAdmin);$i++) {
		        	$imgfilm=$recupMessAdmin[$i][7];
			        //id,nom,prenom,date,heure,titre,texte
			        $text1=$recupMessAdmin[$i][6];
			        $titre1=$recupMessAdmin[$i][5];
			        $heure1=timeForm($recupMessAdmin[$i][4]);
			        $date1=dateForm($recupMessAdmin[$i][3]);
			        $prenom1=$recupMessAdmin[$i][2];
			        $nom1=$recupMessAdmin[$i][1];
			        $id1=$recupMessAdmin[$i][0];
			        if (trim($titre1) == "") {
			                $titre1="<i>sans objet</i>";
			        }
			        if ($imgfilm == "video") {
			                $imgfilm="<img src='../image/commun/film.png' border='0' align='center' />&nbsp;";
			        }else{
			                $imgfilm="<img src='images/icone-doc.png' border='0' align='center' />&nbsp;&nbsp;";
			        }
			?>
				<span style="position:relative; left:20px;" ><?php print $imgfilm ?> <U><?php print LANGTE2?></u> : <i><?php print $date1?></i> - <i><?php print $heure1?></i></span>

				<div id='actu_<?php print $i ?>' style="position:relative; left:20px; display:block;width:100%" >
				<ul><?php print $text1 ?></ul>
				</div>
		<?php 	} 
			$tri="date";
			$data=circulaireAffParent($_SESSION["idClasse"],$tri,$filtre);	
			// id_circulaire, sujet, refence, file, date, enseignant,
			for($i=0;$i<count($data);$i++) {
				$date=preg_replace('/-/','',$data[$i][4]);
				$datedujour=date("Ymd");
				$date+=15;
				$sujet=$data[$i][1];
				if( $date > $datedujour) {
					print "<div id='circulaire_$i' style='position:relative; left:20px; display:block;width:100%' >";
					print "<img src='images/icone-doc.png' align='center' > Nouvelle circulaire de disponible. \"<a href='circulaire-visu.php'>$sujet</a>\"";
					print "</div>";
				}		
			}

		} 

		if ($_GET["actu"] == "classe")  { 
			// id,idclasse,commentaire,date_saisie
			$data=aff_news_prof_p($_SESSION["idClasse"]);
			if (count($data) > 0 ) {
				for($i=0;$i<count($data);$i++) {
			        	$nomprofp2=recherche_personne($data[$i][4]);
					print "<div  style='padding:10px;-moz-border-radius:15px;-webkit-border-radius:15px;border-radius:15px;border: 1px solid #000000;background-color:#FFFFFF'  >";
					print $data[$i][2];
					print "<font size=1>".dateForm($data[$i][3]);
					print " - ".$nomprofp2."</font>"; 
					print "</div>";
				}
			}
		}

		?>

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre eleve */ 



if ($_SESSION["membre"] == "menuprof") { ?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL25 ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='accueil.php?actu=campus' >CAMPUS</a></li>
				<li style="visibility:visible" ><a href='accueil.php?actu=classe' ><?php print $nomClasse ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;height:500px;background-color:#F4F5F7">

		<section class="container" style="padding-top:10px">
		<?php
		if (($_GET["actu"] == "campus") || (!isset($_GET["actu"]))) { 
			$recupMessAdmin=consultMessAdmin();  //idnews,nom,prenom,date,heure,titre,texte,type
			if (count($recupMessAdmin)) { $nbbordure='1'; }else{ $nbbordure='0'; }
			for($i=0;$i<count($recupMessAdmin);$i++) {
		        	$imgfilm=$recupMessAdmin[$i][7];
			        //id,nom,prenom,date,heure,titre,texte
			        $text1=$recupMessAdmin[$i][6];
			        $titre1=$recupMessAdmin[$i][5];
			        $heure1=timeForm($recupMessAdmin[$i][4]);
			        $date1=dateForm($recupMessAdmin[$i][3]);
			        $prenom1=$recupMessAdmin[$i][2];
			        $nom1=$recupMessAdmin[$i][1];
			        $id1=$recupMessAdmin[$i][0];
			        if (trim($titre1) == "") {
			                $titre1="<i>sans objet</i>";
			        }
			        if ($imgfilm == "video") {
			                $imgfilm="<img src='../image/commun/film.png' border='0' align='center' />&nbsp;";
			        }else{
			                $imgfilm="<img src='images/icone-doc.png' border='0' align='center' />&nbsp;&nbsp;";
			        }
			?>
				<span style="position:relative; left:20px;" ><?php print $imgfilm ?> <U><?php print LANGTE2?></u> : <i><?php print $date1?></i> - <i><?php print $heure1?></i></span>

				<div id='actu_<?php print $i ?>' style="position:relative; left:20px; display:block;width:100%" >
				<ul><?php print $text1 ?></ul>
				</div>
		<?php 	} 
			$tri="date";
			$data=circulaireAffParent($_SESSION["idClasse"],$tri,$filtre);	
			// id_circulaire, sujet, refence, file, date, enseignant,
			for($i=0;$i<count($data);$i++) {
				$date=preg_replace('/-/','',$data[$i][4]);
				$datedujour=date("Ymd");
				$date+=15;
				$sujet=$data[$i][1];
				if( $date > $datedujour) {
					print "<div id='circulaire_$i' style='position:relative; left:20px; display:block;width:100%' >";
					print "<img src='images/icone-doc.png' align='center' > Nouvelle circulaire de disponible. \"<a href='circulaire-visu.php'>$sujet</a>\"";
					print "</div>";
				}		
			}

		} 

		if ($_GET["actu"] == "classe")  { 
			// id,idclasse,commentaire,date_saisie
			$data=aff_news_prof_p($_SESSION["idClasse"]);
			if (count($data) > 0 ) {
				for($i=0;$i<count($data);$i++) {
			        $nomprofp2=recherche_personne($data[$i][4]);
					print "<div  style='padding:10px;-moz-border-radius:15px;-webkit-border-radius:15px;border-radius:15px;border: 1px solid #000000;background-color:#FFFFFF'  >";
					print $data[$i][2];
					print "<font size=1>".dateForm($data[$i][3]);
					print " - ".$nomprofp2."</font>"; 
					print "</div>";
				}
			}
		}

		?>

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre eleve */ ?>

<?php
  if ($_SESSION["membre"] == "menuadmin") { ?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL25 ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='accueil.php?actu=campus' >CAMPUS</a></li>
				<li style="visibility:visible" ><a href='accueil.php?actu=classe' ><?php print $nomClasse ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;height:500px;background-color:#F4F5F7">

		<section class="container" style="padding-top:10px">
		

		

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre admin */ ?>
	
<?php Pgclose(); ?>
	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
</body>
</html>
