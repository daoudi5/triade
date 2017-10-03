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

if ($_POST["base"] == "administrationxls") { $type="ADM"; }
if ($_POST["base"] == "profxls") { $type="ENS"; }

?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<?php if ($type == "ENS") { ?>
			<span class="vat-capitalize-title"><?php print LANGVATEL169 ?> </span>
			<?php }else{ ?>
			<span class="vat-capitalize-title"><?php print LANGVATEL170 ?> </span>
			<?php } ?>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
validerequete2($_SESSION["adminplus"]);


$fichier=$_FILES['fichier']['name'];
$type=$_FILES['fichier']['type'];
$tmp_name=$_FILES['fichier']['tmp_name'];
$size=$_FILES['fichier']['size'];
$nbeleveaffecte=0;
$ok=0;

$firstline=$_POST['firstline'];

$taille=2000000;
$taille2="2Mo";
include_once("../librairie_php/lib_get_init.php");
$id=php_ini_get("safe_mode");
if ($id != 1) {
	set_time_limit(600); // en secondes
	$taille=8000000;
	$taille2="8Mo";
}

if ($_POST["base"] == "profxls") { 		$membreP="ENS"; }
if ($_POST["base"] == "administrationxls") { 	$membreP="ADM"; }
if ($_POST["base"] == "scolairexls") {		$membreP="MVS"; }
if ($_POST["base"] == "personnelxls") {		$membreP="PER"; }
if ($_POST["base"] == "tuteurstagexls") {	$membreP="TUT"; }

@unlink("../data/fic_pass2.txt");

if ( (!empty($fichier)) && (($type == "application/octet-stream" ) || ($type == "application/vnd.ms-excel" ))) {
	//print "Nom du fichier :".$fichier." ".$type." ".$size." ".$tmp_name." ";
	move_uploaded_file($tmp_name,"../data/fichier_gep/$fichier");
	@unlink("../data/fichier_gep/traitement.xls");
	rename("../data/fichier_gep/$fichier", "../data/fichier_gep/traitement.xls");
	@unlink("../data/fichier_gep/$fichier");
	print "<br /><font class=T2><center>".LANGIMP40."</center></font><br /><br />";


	if ($_POST["base"] == "prof") 		{ $membreP="ENS"; }
	if ($_POST["base"] == "administration") { $membreP="ADM"; }
	if ($_POST["base"] == "scolaire") 	{ $membreP="MVS"; }
	if ($_POST["base"] == "personnel") 	{ $membreP="PER"; }

	$fic_xls="../data/fichier_gep/traitement.xls";
	include_once('../librairie_php/reader.php');
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$data->read($fic_xls);
	/*
	 * 1) Intitulé (M. ou Mme ou Mlle) 
	 * 2) Nom 
	 * 3) Prénom 
	 * 4) Mot de passe  
	 * 5) adresse 
	 * 6) code postal
	 * 7) téléphone 
	 * 8) email 
	 * 9) commune 
	 */ 
	 
	$depart=2;
	if ($firstline == 1) $depart=1;
	for ($i = $depart; $i <= $data->sheets[0]['numRows']; $i++) {
		$nomP="";
		$prenomP="";
		$passwd_enr="";
		$civP="";
		$rue="";
		$adr="";
		$codepostal="";
		$tel="";
		$mail="";
		$commune="";

	 	$nomP=strtolower(trim(addslashes($data->sheets[0]['cells'][$i][2])));
		if ($nomP == "") { continue; }
       	 	$prenomP=strtolower(trim(addslashes($data->sheets[0]['cells'][$i][3])));
	 	$passwd=$data->sheets[0]['cells'][$i][4];
		$adr=strtolower(trim(addslashes(trim($data->sheets[0]['cells'][$i][5]))));
		$codepostal=strtolower(trim(addslashes($data->sheets[0]['cells'][$i][6])));
		$tel=strtolower(trim(addslashes($data->sheets[0]['cells'][$i][7])));
		$mail=strtolower(trim(addslashes(trim($data->sheets[0]['cells'][$i][8]))));
		$commune=strtolower(trim(addslashes(trim($data->sheets[0]['cells'][$i][9]))));
		$civP=civ3($data->sheets[0]['cells'][$i][1]);
	
		if (empty($passwd))  {
			$passwd=passwd_random(); // creation du mot de passe
			$passwd_enr=$passwd;
		}else {
			$passwd_enr=$passwd;
		}


		if( ! cherchePersonneExist($nomP,$prenomP,$membreP)) {
			// creation d un fichier pour récupération des mots de passe
			$f_pass=fopen("../data/fic_pass2.txt","a+");
			fwrite($f_pass,strtolower(trim($nomP)).";".strtolower(trim($prenomP)).";".$passwd_enr."<br />");
		 	fclose($f_pass);
			$cr=create_personnel(addslashes(strtolower($nomP)),addslashes(strtolower($prenomP)),trim($passwd_enr),$membreP,$civP,'',$adr,$codepostal,$tel,$mail,$commune);
			if ($cr > 0) {
				$nbeleveaffecte++;
			}elseif($cr == -3){
				print "&nbsp;&nbsp;".LANGVATEL196." $nomP <br />";
			}else{
				// rien
			}
		}

   		
	}

}else {
	$ok=1;
}

@unlink("$fic_xls");

if ($ok == 1) {
?>
	<br /><center><font color=red ><?php print LANGIMP43 ?><BR><BR>
	<?php print LANGIMP44 ?></font><br /><br />
	<input type='button' Value="<?php print LANGBT24?>" onclick="javascript:history.go(-3)" STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;"><br />
	<br /></center>
<?php
}else{
		// creation ou mise a jour du fichier log  avec prise en
		$today=dateDMY();
		$fichier_s=fopen("../".REPADMIN."/data/fic_opinion.txt","a+");
		$donnee=fwrite($fichier_s,"<BR>Message du : <FONT color=red>$today</font> De :<FONT color=red> $_SESSION[nom] $_SESSION[prenom]</FONT> <BR>Membre : <font color=red> $_SESSION[membre] </FONT><BR> <B>Message :</B> <font color=red> NOUVELLE BASE </font> - avec fichier ASCII <BR>  Etablissement : <font color=red>".REPECOLE."</font> ");
		fclose($fichier_s);
		// suppression du fichier ASCII
		@unlink($fic_ascii);
?>

<br />
<ul>
<font class=T2>
- <?php print LANGbasededoni73 ?> : <?php print $nbeleveaffecte?><br><br>
- <?php print LANGBASE9?> :
<?php
if (file_exists("../data/fic_pass2.txt")) {
?>
<input type=button class='btn btn-primary btn-sm  vat-btn-footer' value="<?php print LANGBT40?>" onclick="open('../recupepw2.php','_blank','')">
<?php } ?>
<br><br>
<font color=red size=2><?php print LANGBASE17?></font>
<br /><br />
</font>
<?php
}
?>

<br><br />
			
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