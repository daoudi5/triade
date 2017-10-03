<?php
session_start();
if ( (empty($_SESSION["nom"])) && (empty($_SESSION["membre"]) ) ) { exit; }

error_reporting(0);
$id=$_POST["id"];
$heure=$_POST["heure"];
$duree=$_POST["duree"];
include_once("./common/config.inc.php");
include_once("./librairie_php/db_triade.php");
$cnx=cnx();
edtUpdateHoraire($id,$heure,$duree); 
$cr=verifHoraire($id,$heure,$duree);
if ($cr) { // si 1 OK
	$affiche="&nbsp;<i>Modification effectuée</i>";
}else{
	$affiche="&nbsp;<i>Horaire non conforme</i>";
}
sleep(1);
print $affiche;
?>
