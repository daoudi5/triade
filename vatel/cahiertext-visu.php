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

$idClasse=0;
if (isset($_SESSION["idClasse"])) $idClasse=$_SESSION["idClasse"];
if ($_SESSION["membre"] == "menuprof") {
	if (isset($_GET["idClasse"])) $idClasse=$_GET["idClasse"];
	
}
//error_reporting(E_ALL);

if (isset($_POST["saisie_pers"])) {
	$mys=$_POST["saisie_pers"];
	$_SESSION["idprofviaadmin"]=$mys;
}

if (isset($_SESSION["idprofviaadmin"])) {
	$mys=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($mys);
}



if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")  || ($_SESSION["membre"] == "menuprof")  || ($_SESSION["membre"] == "menuadmin")  ) { ?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGPROF37 ?> <?php print $nomduprof ?>
			<?php 
			if (isset($_GET["jour"])) {
				print " - ".dateForm($_GET["jour"]);
			}
			if (isset($_GET["idClasse"])) {
				if (is_numeric($_GET["idClasse"])) {
					$idClasse=$_GET["idClasse"];
					$sql="SELECT libelle FROM ${prefixe}classes WHERE code_class='$idClasse'";
					$curs=execSql($sql);
					$data=chargeMat($curs);
					$nomClasse=$data[0][0];
					print " - <font color='green'> $nomClasse </font>";
				}
			}
			?>
			</span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<?php if ($_SESSION["membre"] == "menuprof") { 
							$idpers=$_SESSION["id_pers"];
							$anneeScolaire=anneeScolaireViaIdClasse("");
							$sql="SELECT a.code_classe, trim(c.libelle) FROM ${prefixe}affectations a, ${prefixe}classes c WHERE code_prof='$idpers' AND a.code_classe = c.code_class AND (a.visubull = '1' OR a.visubullbtsblanc = '1') AND c.offline = '0' AND a.annee_scolaire = '$anneeScolaire' GROUP BY a.code_matiere,a.code_classe,a.code_groupe ORDER BY c.libelle";
							$curs=execSql($sql);
							//print $sql;
							$data=chargeMat($curs);
							print "<li style='visibility:visible' ><a href='ajoutcahiertext.php' >".LANGVATEL21."</a></li>";
							for($i=0;$i<count($data);$i++) {
									$idc=$data[$i][0];
									$classe=$data[$i][1];
							?>
							<li style="visibility:visible" ><a href='cahiertext-visu.php?idClasse=<?php print $idc?>' ><?php print $classe ?></a></li>
							<?php } ?>
				<?php }elseif ($_SESSION["membre"] == "menuadmin") {
							$idpers=$_SESSION["idprofviaadmin"];
							$anneeScolaire=anneeScolaireViaIdClasse("");
							$sql="SELECT a.code_classe, trim(c.libelle) FROM ${prefixe}affectations a, ${prefixe}classes c WHERE code_prof='$idpers' AND a.code_classe = c.code_class AND (a.visubull = '1' OR a.visubullbtsblanc = '1') AND c.offline = '0' AND a.annee_scolaire = '$anneeScolaire' GROUP BY a.code_matiere,a.code_classe,a.code_groupe ORDER BY c.libelle";
							$curs=execSql($sql);
							$data=chargeMat($curs);
							print "<li style='visibility:visible' ><a href='ajoutcahiertext.php' >".LANGVATEL21."</a></li>";
							for($i=0;$i<count($data);$i++) {
									$idc=$data[$i][0];
									$classe=$data[$i][1];
							?>
							<li style="visibility:visible" ><a href='cahiertext-visu.php?idClasse=<?php print $idc?>' ><?php print $classe ?></a></li>
							<?php } ?> 
													
				<?php }else{ ?>				
					<li style="visibility:visible" ><a href='cahiertext-visu.php?actu=planning' >Planning</a></li>
					<?php if (isset($_GET["jour"])) {
								$date=dateForm(datesuivante(dateForm($_GET["jour"])));
								print "<li style='visibility:visible' ><a href='cahiertext-visu.php?actu=detail&jour=$date' >$date</a></li>";  
								$date=dateForm(datesuivante($date));
								print "<li style='visibility:visible' ><a href='cahiertext-visu.php?actu=detail&jour=$date' >$date</a></li>";  
							}
				}
					?>
					<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>
		<div class='espace'></div>
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		<?php
		if (($_GET["actu"] == "planning") || (!isset($_GET["actu"]))) { 
			$actu="planning";
		?>

    <div class="container">
      <!-- Responsive calendar - START -->
        <div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn btn-primary"><?php print LANGVATEL13 ?></div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn btn-primary"><?php print LANGVATEL14 ?></div></a>
        </div><hr/>

        <div class="day-headers">
          <div class="day header"><?php print LANGL1 ?></div>
          <div class="day header"><?php print LANGM1 ?></div>
          <div class="day header"><?php print LANGME1 ?></div>
          <div class="day header"><?php print LANGJ1 ?></div>
          <div class="day header"><?php print LANGV1 ?></div>
          <div class="day header"><?php print LANGS1 ?></div>
          <div class="day header"><?php print LANGD1 ?></div>
        </div>
        <div class="days" data-group="days"></div>
      </div>
      <!-- Responsive calendar - END -->
    </div>
    <?php 
    if ($lang == "fr") {
	print "<script src='./calendar/js/langueFr.js'></script>";
    }else{
	print "<script src='./calendar/js/langueEn.js'></script>";
    }
    ?>
    <script src="./calendar/js/jquery.js"></script>
    <script src="./calendar/js/responsive-calendar.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
	$(".responsive-calendar").responsiveCalendar({
          time: '<?php print dateY()."-".dateM() ?>',
          events: {
	
		<?php
		$date="01/".dateM()."/".dateY();
		$i=0;
		while($i <= 42) {	
			$data=affobjectifScolaireParent($idClasse,$date,"date_contenu");
			for($j=0;$j<count($data);$j++) { if (trim($data[$j][5]) != "") $nb++; }
		        $data=affdevoirScolaireParent($idClasse,$date,"date_devoir");
			for($j=0;$j<count($data);$j++) { if (trim($data[$j][5]) != "") $nb++; }
			if ($nb > 0) {   ?>
            			"<?php print dateFormBase($date) ?>": {"number": <?php print $nb ?>, "url": "cahiertext-visu.php?actu=detail&jour=<?php print dateFormBase($date) ?>&idClasse=<?php print $idClasse ?>"},
		<?php 
			}
			$nb=0;
			$date=dateForm(datesuivante($date));
			$i++;
		}

		?>
            }
        });
      });
    </script>



<?php

		} 

		if ($_GET["actu"] == "detail")  { 
			$actu="detail";
			$date=dateForm($_GET["jour"]);
			
			print "<style>p { color:#000000;padding-left:3px; }</style>";

			print "<table align=center style='width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);' >";
	        	print "<tr bgcolor='#2199da' >";
        		print "<td valign=top align=left style='padding-left:2px;border-bottom:1px solid #000000'  ><b><font size='2' color='#FFFFFF' > ".LANGMESS95." en $nomClasse </td>";
			print "</tr>";
	        $data=affobjectifScolaireParent($idClasse,$date,"date_contenu");
	        // id_class_or_grp, matiere_id, date_saisie, heure_saisie, date_contenu, objectif, classorgrp, id, number_obj, idprof
	        for($j=0;$j<count($data);$j++) {
		 	    if (trim($data[$j][5]) == "") continue;
	                    $contenu=$data[$j][5];
	                    $datafile=recupPieceJointe($data[$j][8]); //md5,nom,etat,idpiecejointe
	                    $lienFichier="";
			    $idmatiere=$data[$j][1];
			    $idprof=$data[$j][9];
			    $classorgrp=$data[$j][6];
                            $list1=$data[$j][0];
			    $prof=recherche_personne2($idprof);
			    if (($idprof == $_SESSION["id_pers"]) && ($_SESSION["membre"] == "menuprof")) {
			    	$lienmodif="&nbsp;&nbsp;[<a href='ajoutcahiertext2.php?idclasse=$idClasse&idmatiere=$idmatiere&date=$date&classorgrp=$classorgrp&list1=$list1' >".LANGPER30."</a>]";
			    } 
	                    for($F=0;$F<count($datafile);$F++) {
							$fichier=$datafile[$F][1];
	                        $md5=$datafile[$F][0];
	                        $lienFichier.="<img src='../image/stockage/defaut.gif' align='center'> ".LANGMESS105." : <a href='../telecharger.php?fichier=data2/DevoirScolaire/${md5}&fichiername=$fichier' target='_blank' >".trunchaine($fichier,30)."</a> / ";
	                    }
				if ($lienFichier != "") $lienFichier.="<br><br>";
		    print "<tr><td valign=top  bgcolor='#eeeeee'  style='border-bottom:1px solid #000000' >";
	            print "&nbsp;".LANGPER17." : <font color=blue>".ucfirst(chercheMatiereNom($data[$j][1]))."</font> ";
	            print "<font class='T1'><i>(".ucwords(LANGPROFK)." ".dateForm($data[$j][2]).") - $prof</i></font>";
		    print $lienmodif;
		    print "<br>";
		    $contenu=preg_replace('/tinymce/',"../tinymce",$contenu);
	            print "&nbsp;&nbsp;&nbsp;".$contenu;
	            print "$lienFichier";
	            print "</td></tr>";
	        }
	        print "</table>";

			print "<br><br>";	
			print "<table align=center style='width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);' >";
	        print "<tr bgcolor='#2199da' >";
        	print "<td valign=top align=left style='padding-left:2px;border-bottom:1px solid #000000'  ><b><font size='2' color='#FFFFFF' > ".LANGPROFJ." en $nomClasse </td>";
			print "</tr>";
            $data=affdevoirScolaireParent($idClasse,$date,"date_devoir");
            // id_class_or_grp, matiere_id, date_saisie, heure_saisie, date_devoir, texte, classorgrp, id, number, idprof, tempsestimedevoir
            for($i=0;$i<count($data);$i++) {
                        	if (trim($data[$i][5]) == "") continue;
	                        $number=$data[$i][8];
	                        $tempsestime=$data[$i][10];
	                        $idprof=$data[$i][9];
				$idmatiere=$data[$i][1];
				$classorgrp=$data[$i][6];
			        $list1=$data[$i][0];

				if (($idprof == $_SESSION["id_pers"]) && ($_SESSION["membre"] == "menuprof")) {
					$lienmodif="&nbsp;&nbsp;[<a href='ajoutcahiertext2.php?idclasse=$idClasse&idmatiere=$idmatiere&date=$date&classorgrp=$classorgrp&list1=$list1' >".LANGPER30."</a>]";
				} 
	                        $contenu=$data[$i][5];
				$contenu=preg_replace('/tinymce/',"../tinymce",$contenu);
	                        $nomprof=recherche_personne2($idprof);
	                        if ((trim($tempsestime) != "") && (trim($tempsestime) != "00:00:00"))  {
	                                $tempsestime="<br>&nbsp;&nbsp; - <font class='T1'>".LANGMESS104." ".timeForm($tempsestime)."</font><br>";
	                        }else{
	                                $tempsestime="";
	                        }
	                        $datafile=recupPieceJointe($data[$i][8]); //md5,nom,etat,idpiecejointe
	                        $lienFichier="";
	                        for($F=0;$F<count($datafile);$F++) {
	                                $fichier=$datafile[$F][1];
	                                $md5=$datafile[$F][0];
	                                $lienFichier.="<img src='../image/stockage/defaut.gif' align='center'> ".LANGMESS105." : <a href='../telecharger.php?fichier=data2/DevoirScolaire/${md5}&fichiername=$fichier' target='_blank' >".trunchaine($fichier,30)."</a> / ";
	                        }
				if ($lienFichier != "") $lienFichier.="<br><br>";
				print "<tr><td valign=top  bgcolor='#eeeeee'  style='border-bottom:1px solid #000000' >";	
	                        print "&nbsp;".LANGPER17." : <font color=blue>".ucfirst(chercheMatiereNom($data[$i][1]))."</font> ";
	                        print "<font class='T1'><i>(".ucwords(LANGPROFK)." ".dateForm($data[$i][2]).") - $nomprof</i></font>";
				print $lienmodif;
				print "<br>";
	                        print "$contenu";
	                        print $tempsestime;
	                        print "$lienFichier";
	                        print "</td></tr>";
	        	}
	                print "</table>";
	?>
  			<script src='./calendar/js/jquery.js'></script>
		<?php 
		}
		?>

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre eleve */ ?>    
	
<?php Pgclose(); ?>
	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
</body>
</html>
