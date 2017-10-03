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
include_once("../librairie_php/timezone.php");
validerequete("menuadmin");
validerequete2($_SESSION["adminplus"]);

// function appele par la suite
function eclair($x,$y){
	if (!is_array($x) || !is_array($y)){
		echo "<br><br><center>".LANGbasededoni92;
	}
	array_pad($x,count($y),"");
	array_pad($y,count($x),"");
	while(count($x) > 0){
		$in=gep_classe(array_shift($x),array_shift($y));
		if ($in == 0) {
			alertJs(LANGbasededoni93);
			print "<script>history.go(-2);</script>";
			break;
		}
	}
}

// enregistrement dans la base de classe avec reference
// netoyage de la base gep_class;
vide_gep_classe();
eclair($_POST["saisie_classe"],$_POST["saisie_ref"]);
// fin d'enregistrement
$nbelevetotal=0;
$nbelevedejaffecte=0;

$optionligne=1;
if ($_POST['optionligne'] == 1) { $optionligne=0; }

$noncontroledatenaissance=$_POST["noncontroledatenaissance"];

if ($_POST["typefichier"] == "excel" ) {
		$fic_xls=$_POST["fichier"];
		include_once('../librairie_php/reader.php');
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($fic_xls);
/*
1) nom * 2) prénom * 3) classe * 
4) régime 5) date naissance * 6) Lieu de naissance * 
7) nationalité  8) Civilité tuteur  9) nom tuteur  
10) prénom tuteur  11) adresse 1 12) code postal 1 
13) commune 1 14) Tèl. Portable (1) 15) Civilité Pers. (2)  
16) Nom resp. (2)  17) Prénom resp. (2)  18) adresse 2 
19) code postal 2 20) commune 2 21) Tèl. Portable (2) 
22) téléphone tuteur  23) Tel. élève 24) profession père 
25) téléphone profession père 26) profession mère 27) téléphone profession mère 
28) nom établissement 29) numéro établissement 30) lv1 
31) lv2 32) option  33) Numéro élève  
34) mot de passe tuteur 1  35) Email tuteur  36) Email élève  
37) Classe antérieure  38) Année antérieure  39) mot de passe élève  
40) Adresse élève  41) Commune élève  42) CCP élève  
43) Tél. fixe élève  44) boursier 45) Email Universitaire 46) sexe eleve
47) mot de passe tuteur 2
 
*/
		
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			if ($i == $optionligne ) { continue; }

			$classe=recherche_gep_classe(trim($data->sheets[0]['cells'][$i][3]));
			
			$passwd=trim($data->sheets[0]['cells'][$i][34]);
			$passwd2=trim($data->sheets[0]['cells'][$i][47]);
			
			$passwd_eleve=trim($data->sheets[0]['cells'][$i][39]);
			$date_naissance=trim($data->sheets[0]['cells'][$i][5]);
		
			if ((trim($passwd) == "") || (! isset($passwd)))  {
					$passwd=passwd_random(); // creation du mot de passe
					$passwd_enr=$passwd;
			}else {
					$passwd_enr=$passwd;
			}
			
			if ((trim($passwd2) == "") || (! isset($passwd2)))  {
					$passwd2=passwd_random(); // creation du mot de passe
					$passwd_enr2=$passwd2;
			}else {
					$passwd_enr2=$passwd2;
			}
			

			if ((trim($passwd_eleve) == "") || (! isset($passwd_eleve)) ||  (trim($passwd_eleve) == "null") )  {
					$passwd_eleve=passwd_random(); // creation du mot de passe
					$passwd_eleve_enr=$passwd_eleve;
			}else {
					$passwd_eleve_enr=$passwd_eleve;
			}


			if ($date_naissance == "") {
					$date_naissance=dateDMY();
			}

			if ((strtoupper(trim($data->sheets[0]['cells'][$i][4])) == "EXTERN") ||  (strtoupper(trim($data->sheets[0]['cells'][$i][4])) == "EXT") || (strtolower(trim($data->sheets[0]['cells'][$i][4])) == "externe") ) {
				$regime="externe";
			}

			if ((strtoupper(trim($data->sheets[0]['cells'][$i][4])) == "INT")  || (strtolower(trim($data->sheets[0]['cells'][$i][4])) == "interne")) {
				$regime="interne";
			}

			if ((strtoupper(trim($data->sheets[0]['cells'][$i][4])) == "DP DAN") || (strtoupper(trim($data->sheets[0]['cells'][$i][4])) == "DP")  || (strtolower(trim($data->sheets[0]['cells'][$i][4])) == "demi pension") ){
				$regime="Demi Pension";
			}


			if (strlen(trim($classe))) {
					$nbelevetotal++;
					// création du tableau de hash contenant les paramètres de la fonction create_eleve
					$params[ne]=            trim(addslashes($data->sheets[0]['cells'][$i][1]));
					$params[pe]=            trim(addslashes($data->sheets[0]['cells'][$i][2]));
					$params[ce]=            $classe;
					$params[lv1]=           trim(addslashes($data->sheets[0]['cells'][$i][30]));
					$params[lv2]=           trim(addslashes($data->sheets[0]['cells'][$i][31]));
					$params[option]=        trim(addslashes($data->sheets[0]['cells'][$i][32]));
					$params[regime]=        $regime;
					$params[naiss]=         $date_naissance;   // attend jj/mm/aaaa
					$params[lieunais]=	trim(addslashes($data->sheets[0]['cells'][$i][6]));
					$params[nat]=           trim(addslashes($data->sheets[0]['cells'][$i][7]));
					$params[mdp]=           $passwd_enr;
					$params[mdpeleve]=		$passwd_eleve_enr;
					$params[mdp2]=			$passwd_enr2;
					$params[civ_1]=         civ2($data->sheets[0]['cells'][$i][8]);
					$params[nt]=            trim(addslashes($data->sheets[0]['cells'][$i][9]));
					$params[pt]=		trim(addslashes($data->sheets[0]['cells'][$i][10]));
					$params[adr1]=        	trim(addslashes($data->sheets[0]['cells'][$i][11]));
					$params[cpadr1]=      	trim(addslashes($data->sheets[0]['cells'][$i][12]));
					$params[commadr1]=     	trim(addslashes($data->sheets[0]['cells'][$i][13]));
					$params[tel_port_1]=    trim(addslashes($data->sheets[0]['cells'][$i][14]));
					$params[civ_2]=         civ2($data->sheets[0]['cells'][$i][15]);
					$params[nom_resp2]=     trim(addslashes($data->sheets[0]['cells'][$i][16]));
					$params[prenom_resp2]=  trim(addslashes($data->sheets[0]['cells'][$i][17]));
					$params[adr2]=          trim(addslashes($data->sheets[0]['cells'][$i][18]));
					$params[cpadr2]=       	trim(addslashes($data->sheets[0]['cells'][$i][19]));
					$params[commadr2]=     	trim(addslashes($data->sheets[0]['cells'][$i][20]));
					$params[tel_port_2]=    trim(addslashes($data->sheets[0]['cells'][$i][21]));
					$params[tel]=          	trim(addslashes($data->sheets[0]['cells'][$i][22]));
					$params[tel_eleve]=	trim(addslashes($data->sheets[0]['cells'][$i][23]));
					$params[profp]=        	trim(addslashes($data->sheets[0]['cells'][$i][24]));
					$params[telprofp]=     	trim(addslashes($data->sheets[0]['cells'][$i][25]));
					$params[profm]=         trim(addslashes($data->sheets[0]['cells'][$i][26]));
					$params[telprofm]=     	trim(addslashes($data->sheets[0]['cells'][$i][27]));
					$params[nomet]=        	trim(addslashes($data->sheets[0]['cells'][$i][28]));
					$params[numet]=        	trim(addslashes($data->sheets[0]['cells'][$i][29]));
					$params[cpet]=         	"";
					$params[commet]=    	"";
					$params[numero_eleve]=  trim(addslashes($data->sheets[0]['cells'][$i][33]));
					$params[email]=  	trim(addslashes($data->sheets[0]['cells'][$i][35]));
					$params[mail_eleve]=  	trim(addslashes($data->sheets[0]['cells'][$i][36]));
					$params[classe_ant]=  	trim(addslashes($data->sheets[0]['cells'][$i][37]));
					$params[annee_ant]=  	trim(addslashes($data->sheets[0]['cells'][$i][38]));
					$params[adr_eleve]=  	trim(addslashes($data->sheets[0]['cells'][$i][40]));
					$params[commune_eleve]= trim(addslashes($data->sheets[0]['cells'][$i][41]));
					$params[ccp_eleve]=  	trim(addslashes($data->sheets[0]['cells'][$i][42]));
					$params[tel_fixe_eleve]=trim(addslashes($data->sheets[0]['cells'][$i][43]));
					$params[boursier]=	trim(addslashes($data->sheets[0]['cells'][$i][44]));
					$params[mailpro_eleve]=	trim(addslashes($data->sheets[0]['cells'][$i][45]));
					$params[sexe]=		trim(addslashes($data->sheets[0]['cells'][$i][46]));
					$params[annee_scolaire] = $_POST["annee_scolaire"];
					// nouvelle version de create_eleve()
					$ascii=1;
					if ($_POST['update'] == 1) {
						$cr=create_update_eleve($params[ne],$params[pe],$params[naiss],$params,$ascii,$_POST['updatevide'],$_POST['updatepasswd'],$noncontroledatenaissance);
					}else{
						$cr=@create_eleve($params,$ascii);
					}
	
					if ($cr == 1){
							$f_pass=fopen("../data/fic_pass.txt","a+");
				     	    fwrite($f_pass,strtolower(trim($data->sheets[0]['cells'][$i][1])).";".strtolower(trim($data->sheets[0]['cells'][$i][2])).";".$passwd_enr.";".$passwd_enr2.";".$passwd_eleve_enr."<br />");
			     			fclose($f_pass);
							$nbeleveaffecte++;
					}
					if ($cr == -3) {
						$nbelevedejaffecte++;
					}

		}else{
					$nbelevetotal++;
					// création du tableau de hash contenant les paramètres de la fonction create_eleve
					$params[ne]=            trim(addslashes($data->sheets[0]['cells'][$i][1]));
					$params[pe]=            trim(addslashes($data->sheets[0]['cells'][$i][2]));
					$params[ce]=            $classe;
					$params[lv1]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][30])));
					$params[lv2]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][31])));
					$params[option]=        strtolower(trim(addslashes($data->sheets[0]['cells'][$i][32])));
					$params[regime]=        $regime;
					$params[naiss]=         $date_naissance;   // attend jj/mm/aaaa
					$params[lieunais]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][6])));
					$params[nat]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][7])));
					$params[mdp]=           $passwd_enr;
					$params[mdp2]=          $passwd_enr2;
					$params[mdpeleve]=		$passwd_eleve_enr;
					$params[civ_1]=         civ2($data->sheets[0]['cells'][$i][8]);
					$params[nt]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][9])));
					$params[pt]=		strtolower(trim(addslashes($data->sheets[0]['cells'][$i][10])));
					$params[adr1]=        	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][11])));
					$params[cpadr1]=      	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][12])));
					$params[commadr1]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][13])));
					$params[tel_port_1]=    trim(addslashes($data->sheets[0]['cells'][$i][14]));
					$params[civ_2]=         civ2($data->sheets[0]['cells'][$i][15]);
					$params[nom_resp2]=     strtolower(trim(addslashes($data->sheets[0]['cells'][$i][16])));
					$params[prenom_resp2]=  strtolower(trim(addslashes($data->sheets[0]['cells'][$i][17])));
					$params[adr2]=          strtolower(trim(addslashes($data->sheets[0]['cells'][$i][18])));
					$params[cpadr2]=       	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][19])));
					$params[commadr2]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][20])));
					$params[tel_port_2]=    trim(addslashes($data->sheets[0]['cells'][$i][21]));
					$params[tel]=          	trim(addslashes($data->sheets[0]['cells'][$i][22]));
					$params[tel_eleve]=	trim(addslashes($data->sheets[0]['cells'][$i][23]));
					$params[profp]=        	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][24])));
					$params[telprofp]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][25])));
					$params[profm]=         strtolower(trim(addslashes($data->sheets[0]['cells'][$i][26])));
					$params[telprofm]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][27])));
					$params[nomet]=        	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][28])));
					$params[numet]=        	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][29])));
					$params[cpet]=         	"";
					$params[commet]=    	"";
					$params[numero_eleve]=  strtolower(trim(addslashes($data->sheets[0]['cells'][$i][33])));
					$params[email]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][35])));
					$params[mail_eleve]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][36])));
					$params[classe_ant]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][37])));
					$params[annee_ant]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][38])));
					$params[adr_eleve]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][40])));
					$params[commune_eleve]= strtolower(trim(addslashes($data->sheets[0]['cells'][$i][41])));
					$params[ccp_eleve]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][42])));
					$params[tel_fixe_eleve]=strtolower(trim(addslashes($data->sheets[0]['cells'][$i][43])));
					$params[boursier]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][44])));
					$params[mailpro_eleve]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][45])));
					$params[sexe]=		strtolower(trim(addslashes($data->sheets[0]['cells'][$i][46])));
					$params[annee_scolaire] = $_POST["annee_scolaire"];
					// nouvelle create eleve sans classe
					$ascii=1;
					$cr=@create_eleve_sans_classe($params,$ascii);
					if ($cr == 1) {
						$f_pass=fopen("../data/fic_pass.txt","a+");
						fwrite($f_pass,strtolower(trim($data->sheets[0]['cells'][$i][1])).";".strtolower(trim($data->sheets[0]['cells'][$i][2])).";".$passwd_enr.";".$passwd_enr2.";".$passwd_eleve_enr."<br />");
						fclose($f_pass);
						$nbeleverreur++;
					}
					if ($cr == -3) {
						$nbelevedejaffecte++;
					}
				
			}
		    
} 
			fclose($fp);
			// creation ou mise a jour du fichier log  avec prise en
			$today=dateDMY();
			$fichier_s=fopen("../".REPADMIN."/data/fic_opinion.txt","a+");
			$donnee=fwrite($fichier_s,"<BR>Message du : <FONT color=red>$today</font> De :<FONT color=red> $_SESSION[nom] $_SESSION[prenom]</FONT> <BR>Membre : <font color=red> $_SESSION[membre] </FONT><BR> <B>Message :</B> <font color=red> NOUVELLE BASE </font> - avec fichier EXCEL <BR>  Etablissement : <font color=red>".REPECOLE."</font> ");
			fclose($fichier_s);

			// suppression du fichier EXCEL
			@unlink($fic_xls);


}




Pgclose();
?>

<br />
<ul>
<font class="T2">
- <?php print LANGBASE6bis?> : <?php print $nbelevetotal?><br>
- <?php print LANGBASE7?> : <?php print $nbeleveaffecte?><br>
- <?php print LANGBASE7bis ?> : <?php print $nbelevedejaffecte?><br>
- <?php print LANGBASE8?> : <?php print $nbeleverreur?><br><br>
- <?php print LANGBASE9?> <br /> (<?php print LANGBASE8bis ?>)<br /><br />
</font>
<?php
if (file_exists("../data/fic_pass.txt")) {
?>
<input type=button class='btn btn-primary btn-sm  vat-btn-footer'  value="<?php print LANGBT40?>" onclick="open('../recupepw.php','_blank','')">
<?php } ?>
<br><br>
<font color=red size=2><?php print LANGBASE17?></font>
<br><br />
</ul>



		
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