<?php
session_start();
error_reporting(0);
if (empty($_SESSION["admin1"])) {
    print "<script language='javascript'>";
    print "location.href='./acces_refuse.php'";
    print "</script>";
    exit;
}
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
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<?php
include_once("../common/lib_admin.php");
include_once("../common/lib_ecole.php");
include_once("../common/config2.inc.php");
?>

<script language="JavaScript" src="./librairie_js/clickdroit2.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<title>Triade</title>
</head>
<body id='bodyfond2' text='#000000' >

<?php
include_once("../common/config.inc.php");
include_once("../librairie_php/db_triade.php");
include_once("./librairie_php/langue-text-admin-fr.php");
$cnx=cnx();

$erreur="";
$modif="non";
if (isset($_POST["create"])) {
	$modifParent1=$_POST["parent1"];
	$modifeleve1=$_POST["eleve1"];
	$emailenvoie=$_POST["emailenvoie"];
	$idclasse=$_POST["idclasse"];
	$anneeScolaire=$_POST["annee_scolaire"];

	if ($_POST["initia"] == "2") {
		$fichier=$_FILES['fichier']['name'];
		$type=$_FILES['fichier']['type'];
		$tmp_name=$_FILES['fichier']['tmp_name'];
		$size=$_FILES['fichier']['size'];
		//alertJs($type);

		if ( (!empty($fichier)) &&  ($size <= 2000000) && (preg_match('/csv$/',$fichier))) {
			$fichier="../data/parametrage/passe_import.txt";
			@unlink($fichier);
			@unlink("../data/fic_pass.txt");
			move_uploaded_file($tmp_name,$fichier);
			$lines = file ("$fichier");
			$erreurPersonne="";
			foreach ($lines as $line_num => $line) {
				$passwd="";
				//Nom;Pr�nom;Date Naissance;Mot de passe parents;Mot de passe �l�ves;
				list($nomP,$prenomP,$dateNaissanceP,$passwdParent,$passwdEleve,$null)= split (";", $line,6);
				$nomP=addslashes($nomP);
				$prenomP=addslashes($prenomP);

				$cr=modifPassword($nomP,$prenomP,$dateNaissanceP,$passwdParent,$passwdEleve);
				if ($cr == "-1") {
					$erreurPersonne.="$nomP;$prenomP;$dateNaissanceP\n";
				}else{
					if ($emailenvoie == 1)  envoiMailPassElPa($nomP,$prenomP,$dateNaissanceP,$passwdParent,$passwdEleve);
				}
			}
			@unlink($fichier);
			$message="Les mots de passe sont r�initialis�s";
		}else{
			alertJs("Fichier non conforme \\n\\n le fichier doit �tre au format csv ");
			$message="Mot de passe NON r�initialis�";
		}
	}


	if ($_POST["initia"] == "0") {
		$nb=initialisePasswordEleveParent($modifeleve1,$modifParent1,$emailenvoie,$idclasse,$anneeScolaire);
		if ($nb > 0) {
			$message="Les mots de passe sont r�initialis�s"; 
		}else{
			$message="Aucun mots de passe modifi�s";
		}
	}
	if ($_POST["initia"] == "1") { 
		$nb=initialisePasswordDefinieEleveParent($_POST["passeldef"],$_POST["passpardef"],$emailenvoie,$idclasse,$anneeScolaire);
		if ($nb > 0) {
			$message="Les mots de passe sont r�initialis�s"; 
		}else{
			$message="Aucun mots de passe modifi�s";
		}
	}

	history_cmdAdmin("Admin Triade","MODIF","R�initialisation mot de passe Eleve / Parent");

	if ($erreurPersonne != "") { ?>
		<textarea cols=90 rows=18 >El�ve non trouv� dans la base, v�rifier que la syntaxe soit exactement la m�me que dans la base de donn�es ainsi que la date de naissance.

<?php print $erreurPersonne ?></textarea><br />
	<?php }else{ ?>
	<center><font size=3><?php print $message ?></font>	
			<br><br>
	<?php } ?>
<?php
if (file_exists("../data/fic_pass.txt")) {
?>
<br /><br /><input type=button class=BUTTON value="<?php print "R�cuperation des mots de passe"?>" onclick="open('recupepw.php','_blank','')"><br /><br /><br /><br />
<?php } ?>
</center>
		<table align=center border=0>
		<tr><td align=center>
		<script language=JavaScript>buttonMagicFermeture(); //text,nomInput</script>
		</td></tr></table>

	<?php	
}else {

	$modif="oui";
}

if ($modif=="oui") {
?>
<form name="formulaire" method="post" enctype="multipart/form-data" onSubmit="document.formulaire.rien.disabled=true" >
<?php print $erreur?>
<table width=100% align=center border=0>
<tr><td >
<ul><font class="T2">R�initialisation des mots de passe (parents et �l�ves)</font></ul><br>
</td></tr>

<tr><td>
&nbsp;<font class='T2'>Ann�e Scolaire : </font><select name='annee_scolaire' > 
<?php filtreAnneeScolaireSelectNote($anneeScolaire,3); ?>
</select> 
</td></tr>

<tr><td>
&nbsp;<font class='T2'>Choix de la classe : </font><select name='idclasse' > 
<option value='tous' >Toutes les classes</option>
<?php select_classe(); ?>
</select> 
</td></tr>

<?php if ((LAN == "oui") && (ValideMail(MAILREPLY))) { ?>
<tr>
<td><input type='checkbox' name='emailenvoie'  value='1' onclick="envoiMailP()"   > <font class="T2">Envoyer un email au compte avec son nouveau mot de passe.</font>  </td>
</tr>

<?php
}
?>
<tr><td ><input type="radio" name="initia" value="0" checked="checked"  onclick="document.getElementById('passimp').style.visibility='hidden';document.getElementById('passpar').style.visibility='hidden'; document.getElementById('passel').style.visibility='hidden'; document.formulaire.passeldef.value=''; document.formulaire.passpardef.value=''; " > Mot de passe al�atoire. 

(<input type='checkbox' name='parent1'  value='1'  > Parents et <input type='checkbox' name='eleve1' value='1' > El�ves) </td></tr>
<tr><td ><input type="radio" name="initia" value="2"  onclick="document.getElementById('passpar').style.visibility='hidden'; document.getElementById('passel').style.visibility='hidden'; document.getElementById('passimp').style.visibility='visible'; document.getElementById('passimp').style.visibility='visible'; document.formulaire.passeldef.value=''; document.formulaire.passpardef.value=''; " > Importer mot de passe. (Parents et El�ves) / sans notion d'ann�e scolaire</td></tr>
<tr><td><input type="radio" name="initia" value="1"   onclick="document.getElementById('passimp').style.visibility='hidden'; document.getElementById('passel').style.visibility='visible';document.getElementById('passpar').style.visibility='visible'" > Mot de passe d�finie. </td>

<tr>
<td><div id='passel' style="visibility='hidden'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Mot de passe El�ves : <input type=text name="passeldef" /> vide pas de modification )<br></div>
</td></tr>


<tr>
<td><div id='passpar' style="visibility='hidden'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Mot de passe Parents : <input type=text name="passpardef" /> vide pas de modification )<br></div>
</td></tr>
<tr>
<td><div id='passimp' style="visibility='hidden'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Fichier CSV  : <input type=file name="fichier" /> )<br><br>
<i>Nom<b>;</b>Pr�nom<b>;</b>Date Naissance (jj/mm/aaaa) <b>;</b>Mot de passe parents<b>;</b>Mot de passe �l�ves<b>;</b> (Colonne de mot de passe vide, pas de changement pour la colonne)</i>
</div>
<div id='infourl' style="display:none"><br><font class='T2'  id='color3' > AVEZ VOUS VERIFIE L'ADRESSE INTERNET DU SITE TRIADE DANS LE MODULE "CONFIG GENERAL" AVANT VALIDATION !!! </font></div>
</td></tr>


</td></tr>

<tr><td colspan=2><br>

<table align=center border=0>
<tr><td align=center>
<script language=JavaScript>buttonMagicSubmit("Confirmer","rien"); //text,nomInput</script>
<script language=JavaScript>buttonMagicFermeture(); //text,nomInput</script>&nbsp;&nbsp;
</td></tr>
</table>
</td></tr>
</table>
<input type='hidden' name='create' />
</form>
	<script>
	document.getElementById('passimp').style.visibility='hidden';
	document.getElementById('passpar').style.visibility='hidden'; 
	document.getElementById('passel').style.visibility='hidden'; 
	document.formulaire.passeldef.value=''; 
	document.formulaire.passpardef.value='';
	</script>

	<script>
	function envoiMailP() {
		if (document.getElementById('infourl').checked == false) {
			document.getElementById('infourl').checked=true;
			document.getElementById('infourl').style.display='block';
		}else{
			document.getElementById('infourl').checked=false;
			document.getElementById('infourl').style.display='none';
		}
	}
	document.getElementById('infourl').checked=false;
	</script>
<?php
}
Pgclose($cnx);
?>
</BODY>
</HTML>
