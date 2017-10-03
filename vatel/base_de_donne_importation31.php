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
	
<?php

$fichier=$_FILES["fichier1"]["name"];
$type=$_FILES["fichier1"]["type"];
$tmp_name=$_FILES["fichier1"]["tmp_name"];

//$size=$_FILES["fichier1"]["size"];
//print $type;
$optionligne=1;
if ($_POST['optionligne'] == 1) { $optionligne=0; }
if ( (!empty($fichier)) && (($type == "application/octet-stream" ) || ($type == "application/vnd.ms-excel" ))) {
	move_uploaded_file($tmp_name,"../data/fichier_gep/$fichier");
	@unlink("../data/fichier_gep/traitement.xls");
	rename("../data/fichier_gep/$fichier", "../data/fichier_gep/traitement.xls");
	@unlink("../data/fichier_gep/$fichier");
	$fic_xls="../data/fichier_gep/traitement.xls";
	$typefichier="excel";
	include_once('../librairie_php/reader.php');
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$data->read($fic_xls);

	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			if ($i == $optionligne ) {	continue; }
		/*	print $data->sheets[0]['cellsInfo'][$i][$j]."<br>";
			print $data->sheets[0]['cellsInfo'][$i][$j]['raw']."<br>";
			print $data->sheets[0]['cellsInfo'][$i][$j]['colspan']."<br>";
			print $data->sheets[0]['cellsInfo'][$i][$j]['rowspan']."<br>";
			print $data->sheets[0]['cellsInfo'][$i][$j]['type']."<br>";    */

			$donnee=$data->sheets[0]['cells'][$i][3];
			//print $donnee."<br>";
			$tab11[$donnee]=$donnee;
		}
	}

	
		 if ($_POST["vide_eleve"] == "oui") { 
			 purge_element_eleve(); 
			 if (is_dir("../data/archive")) {
				 nettoyage_repertoire("../data/archive");
			 }
		 }


	 	@ksort($tab11);
	 	$ligne=0;
		print "<br><form method='post' action='base_de_donne_importation32.php'>";
		print "<input type='hidden' name='fichier' value=\"$fic_xls\">";
		print "<input type='hidden' name='typefichier' value=\"$typefichier\">";
		print "<ul>".LANGIMP42."</ul>";
		print "<table border=0 align=center bgcolor='#FFFFFF'  style='border-collapse: collapse;'  ><tr bordercolor='#000000'>";
		foreach ($tab11 as $clef => $b ) {
			if (strlen(trim($clef))) {
		    	?>
				<td><input type=text name='saisie_ref[]' value='<?php print $clef?>' size=20 onfocus='this.blur()'></td>
				<td><select name="saisie_classe[]">
			<?php
				print "<option value='-1' >".LANGCHOIX."</option>";
				$id_classe=recherche_gep_classe($clef);
		    	if ($id_classe != "") {
			    	  $nom_classe=chercheClasse_nom($id_classe);
			    	  if ($nom_classe != "") {
	        		  		print "<option selected value='$id_classe'>$nom_classe</option>";
	        		  }
		    	}
			    	select_classe_gep(); // creation des options
			    ?>
				</select>
				</td>
                	<?php
	                if ($ligne == 1) {
        	           	print "</tr><tr bordercolor='#000000'>";
               		     	$ligne=0;
	                }else {
        	            $ligne++;
                	}
        	}
        }
		print "</table>";
	

	
?>
<br><br>
<table align=center  style="border-collapse: collapse;"  ><tr><td>
<script language=JavaScript> buttonMagicReactualiseVATEL()</script>
<script language=JavaScript> buttonMagicVATEL("<?php print LANGBT26 ?>","../creat_classe_gep.php","ajclass","width=450,height=150","")</script>
<input type=hidden  value='<?php print $_POST['update'] ?>' name='update'  >
<input type=hidden  value='<?php print $_POST['updatepasswd'] ?>' name='updatepasswd'  >
<input type=hidden  value='<?php print $_POST['updatevide'] ?>' name='updatevide'  >
<input type=hidden  value='<?php print $_POST['optionligne'] ?>' name='optionligne'  >
<input type=hidden  value='<?php print $_POST['annee_scolaire'] ?>' name='annee_scolaire'  >
<input type=hidden  value='<?php print $_POST['noncontroledatenaissance'] ?>' name='noncontroledatenaissance'  >
<input type=submit class='btn btn-primary btn-sm  vat-btn-footer'  value='<?php print LANGCHER9 ?> >'  ></center>
<br><br/><br/>
&nbsp;&nbsp;<?php print LANGbasededon21?>
</td></tr></table>
</form>
<br />
<br />
<?php
}else {
?>
<br />
<center> <font color=red><?php print LANGbasededon203?></font> <BR><BR>
<?php print LANGDISP26 ?>
<br /><br />
<input type=button Value="<?php print LANGBT24 ?>" onclick="javascript:history.go(-1)" class='btn btn-primary btn-sm  vat-btn-footer'  ><br />
<br />
</center>
<?php
}
?>
			
		
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