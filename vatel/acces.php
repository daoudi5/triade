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
session_start();

include_once("../common/config.inc.php");
include_once("../common/config2.inc.php");
include_once("../librairie_php/db_triade.php");


//error_reporting(0);

$_SESSION=array();
session_unset();


if (isset($_COOKIE["langue-triade"])) {
	$lang=$_COOKIE["langue-triade"];
}else{
	$lang="fr";
}

if ($lang == "fr") include_once("../librairie_php/langue-text-fr.php");
if ($lang == "en") include_once("../librairie_php/langue-text-en.php");



include_once("../librairie_php/lib_statistique.php");
count_saisie("../data/compteur/compteur_acces.txt","visited","7200","compteur_acces.time");

include_once("../librairie_php/timezone.php");
$cnx=cnx2();

$email=$_POST["email"];
$password=$_POST["password"];

if (trim($_POST["emailp"]) != "")    $email=$_POST["emailp"];
if (trim($_POST["passwordp"]) != "") $password=$_POST["passwordp"];

$membre=$_POST['membre'];
$type=$_POST['type'];
$typecompte=$_POST["typecompte"];

if (isset($_GET["bl"])) {
	$membre=$_GET['membre'];
	$type=$_GET['type'];
	$typecompte=$_GET["typecompte"];
}

if  ((eregi("microsoft",$nav_info)) || (eregi("internet explorer",$nav_info))) {
	$navigateur="IE";
}else {
	$navigateur="NONIE";
}

$code=accesViaEmail($email,$password,$membre);

if ($membre == "menueleve") {
	$id_pers=rechercheIdEleveViaEmail($email);		
}

if ($membre == "menuprof") {
	$id_pers=rechercheIdProfViaEmail($email);		
}

if ($membre == "menuadmin") {
	$id_pers=rechercheIdAdminViaEmail($email);		
}

if ($id_pers > 0) { 
	$nom=recherche_personne_nom($id_pers,$type);
	$prenom=recherche_personne_prenom($id_pers,$type);		
	// test si compte blacklister
	$nom=trim(ucwords($nom));
	$prenom=trim($prenom);
	$membre=trim($membre);


	$data=verifblacklist(strtolower($nom),strtolower($prenom),strtolower($membre));
	if (count($data) > 0) {
		header("Location:index${typecompte}.php?bl=1&message=".LANGTERREURCONNECT."&membre=$membre&typecompte=$type&type=$type");
		exit;
	}
	
	
}


// recuperation des informations de l'utilisateur
// IP, OS, navigateur

include_once("../librairie_php/lib_verif_nav.php");
$ip=$_SERVER["REMOTE_ADDR"];
$os=verif_os();
$nav=verif_navigateur();

// -------------------------------------------------------
$id_session=session_id();
//

if ($membre == 'menueleve' && $code==1 && $id_pers > 0) {
      $nom=trim(ucwords($nom));
      $prenom=trim($prenom) ;
      updatePwdMoodle($id_pers,$_POST["password"]);
      $idClasse=chercheIdClasseDunEleve($id_pers);
      $_SESSION["nom"]=$nom;
      $_SESSION["prenom"]=$prenom;
      $_SESSION["membre"]=$membre;
      $_SESSION["email"]=$email;
      $_SESSION["id_pers"]=$id_pers;
      $_SESSION["MDP"]=$_POST["password"];
      $_SESSION["idClasse"]=$idClasse;
      $_SESSION["navigateur"]=$navigateur;
      $_SESSION["langue"]=$_COOKIE["langue-triade"];
      $_SESSION["nav"]=$nav;
      $_SESSION["os"]=$os;
      $_SESSION["ip"]=$ip;
      $_SESSION["id_session"]=$id_session;
      $_SESSION["pwd"]=$_POST["password"];
      enr_trace($nav,$os,$ip,$nom,$prenom,"Elève");
      enr_statUtilisateur($nom,$prenom,$id_pers,"menueleve",$id_session);
      ip_timeout_clear($ip);
      statConecParHeure(dateH());
      $anneeScolaire=anneeScolaireViaIdClasse($idClasse);
      $_SESSION["anneeScolaire"]=$anneeScolaire;
      setcookie("nom","$nom");
      setcookie("prenom","$prenom");
      setcookie("id_pers","$id_pers");
      setcookie("anneeScolaire","$anneeScolaire");
      header("Location:accueil.php");
}elseif($membre == 'menuadmin' && $code==1 && $id_pers > 0) {
	  $nom=trim(ucwords($nom));
      $prenom=trim($prenom) ;
      $_SESSION["nom"]=$nom;
      $_SESSION["prenom"]=$prenom;
      $_SESSION["membre"]=$membre;
      $_SESSION["email"]=$email;
      $_SESSION["id_pers"]=$id_pers;
      $_SESSION["MDP"]=$_POST["password"];
      $_SESSION["navigateur"]=$navigateur;
      $_SESSION["langue"]=$_COOKIE["langue-triade"];
      $_SESSION["nav"]=$nav;
      $_SESSION["os"]=$os;
      $_SESSION["ip"]=$ip;
      $_SESSION["id_session"]=$id_session;
      $_SESSION["pwd"]=$_POST["password"];
      enr_trace($nav,$os,$ip,$nom,$prenom,"Direction");
      enr_statUtilisateur($nom,$prenom,$id_pers,"menuadmin",$id_session);
      ip_timeout_clear($ip);
      statConecParHeure(dateH());
      setcookie("nom","$nom");
      setcookie("prenom","$prenom");
      setcookie("id_pers","$id_pers");
      header("Location:accueil.php");
}elseif($membre == 'menuprof' && $code==1 && $id_pers > 0) {
	  $nom=trim(ucwords($nom));
      $prenom=trim($prenom) ;
      $_SESSION["nom"]=$nom;
      $_SESSION["prenom"]=$prenom;
      $_SESSION["membre"]=$membre;
      $_SESSION["email"]=$email;
      $_SESSION["id_pers"]=$id_pers;
      $_SESSION["MDP"]=$_POST["password"];
      $_SESSION["navigateur"]=$navigateur;
      $_SESSION["langue"]=$_COOKIE["langue-triade"];
      $_SESSION["nav"]=$nav;
      $_SESSION["os"]=$os;
      $_SESSION["ip"]=$ip;
      $_SESSION["id_session"]=$id_session;
      $_SESSION["pwd"]=$_POST["password"];
      enr_trace($nav,$os,$ip,$nom,$prenom,"Enseignant");
      enr_statUtilisateur($nom,$prenom,$id_pers,"menuprof",$id_session);
      ip_timeout_clear($ip);
      statConecParHeure(dateH());
      setcookie("nom","$nom");
      setcookie("prenom","$prenom");
      setcookie("id_pers","$id_pers");
      header("Location:accueil.php");
}else{
  	session_set_cookie_params(0);
   	$_SESSION=array();
   	session_unset();
	session_destroy();
	$passwd=$_POST["password"];
   	acceslog("ERREUR CONNEXION#$nav#$os#$ip#$nom#$prenom#membre : $membre#$passwd");
//	ip_timeout($ip);
	header("Location: index${typecompte}.php?message=".LANGTERREURCONNECT."&membre=$membre&typecompte=$typecompte&type=$type");
	exit;
}


Pgclose();


?>
