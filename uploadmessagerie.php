<?php
error_reporting(0);
$idsession=$_GET["PHPSESSID"];
session_id($idsession);
session_start();
if (empty($_SESSION["nom"]))  {
    header("Location:./acces_refuse.php");
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



$fichier=$_FILES['Filedata']['name'];
$type=$_FILES['Filedata']['type'];
$tmp_name=$_FILES['Filedata']['tmp_name'];
$size=$_FILES['Filedata']['size'];
$idpiecejointe=$_GET["idpiecejointe"];


/*
$fd=fopen("essai.txt","w");
fwrite($fd,"$idpiecejointe-$infosession-");
fclose($fd);
*/

include_once("./common/config.inc.php"); 
include_once("./common/config2.inc.php"); 
include_once("./common/config6.inc.php"); 
include_once("./librairie_php/db_triade.php");

if (MAXUPLOAD == "oui") {
	$taille="8000000";
}else{
	$taille="2000000";
}
$fichierMD5='';

if ( (!empty($fichier)) &&  ($size <= $taille)) {
	$cnx=cnx();
	if  ( 	(eregi('text',$type))  ||
		(eregi('pdf',$type))   ||
		(eregi('msword',$type)) ||
		(eregi('stuffit',$type)) ||
		(eregi('ms-excel',$type)) ||
		(eregi('zip',$type)) || 
		(eregi('opendocument',$type)) ||
		(eregi('.txt$',$fichier)) ||
		(eregi('.pdf$',$fichier)) ||
		(eregi('.doc$',$fichier)) ||
		(eregi('.docx$',$fichier)) ||
		(eregi('.xlsx$',$fichier)) ||
		(eregi('.xls$',$fichier)) ||
		(eregi('.ppt$',$fichier)) ||
		(eregi('.zip$',$fichier)) || 
		(eregi('.7z$',$fichier)) ||
		(eregi('.tar$',$fichier)) ||
		(eregi('.jpg$',$fichier)) ||
		(eregi('.jpeg$',$fichier)) ||
		(eregi('.gif$',$fichier)) ||
		(eregi('.png$',$fichier)) ||
		(eregi('.xcf$',$fichier)) ||
		(eregi('.html$',$fichier)) ||
		(eregi('.htm$',$fichier)) ||
		(eregi('.odt$',$fichier)) ||
		(eregi('.odf$',$fichier)) ||
		(eregi('.odp$',$fichier)) ||
		(eregi('.ods$',$fichier)) ||
		(eregi('.odg$',$fichier))

       		) {

	
		//print "Nom du fichier :".$fichier." ".$type." ".$size." ".$tmp_name." ";
		$fichier=str_replace(" ","_",$fichier);
		$fichier=str_replace("'","_",$fichier);
		$fichier=str_replace("\\","",$fichier);
		$fichier=TextNoAccent($fichier);

		$nommage=$fichier.date("YmdHms");
		$fichierMD5=md5($nommage);

		if (!is_dir("./data/fichiersj")) { mkdir("./data/fichiersj"); }
		move_uploaded_file($tmp_name,"data/fichiersj/$fichierMD5");
		echo "";
		create_piecejointe($fichier,$fichierMD5,$idpiecejointe,'1');
	}else{
		create_piecejointe($type,$fichierMD5,$idpiecejointe,'0');				
	}
}else{
	create_piecejointe($fichier,$fichierMD5,$idpiecejointe,'2');
}
PgClose();

?>
