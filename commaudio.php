<?php
session_start();
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
<meta name="Copyright" content="Triade©, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/info-bulle.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script language="JavaScript" src="./framaplayer/framaplayer.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title> </head>
<body  id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" onunload="attente_close()" >
<?php include("./librairie_php/lib_licence.php"); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]".".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]"."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "News audio" ?></font></b></td>
<?php
include_once("./librairie_php/db_triade.php");
validerequete("2");

$taille=2000000;
$taille2="2Mo";

include_once("librairie_php/lib_get_init.php");
include_once("common/config6.inc.php");

if (MAXUPLOAD == "oui") {
	$id=php_ini_get("safe_mode");
	if ($id != 1) {
		//ini_set('memory_limit', 8000000); // en octets
		set_time_limit(3000); // en secondes
		$taille=8000000;
		$taille2="8Mo";
	}
}

if (isset($_POST["create"])) {
	/*
	$fichier=$_FILES['fichier']['name'];
	$titre=$_POST["saisie_titre"];
	$type=$_FILES['fichier']['type'];
	$tmp_name=$_FILES['fichier']['tmp_name'];
	$size=$_FILES['fichier']['size'];
	if ( (!empty($fichier)) &&  ($size <= $taille) && (($type=="audio/mpeg") || ($type=="audio/x-mpeg")) ) {
		// supprimer l'ancien
		$fichier="actu.mp3";
        	$f=fopen("./data/parametrage/audio.txt","r");
		$donnee=fread($f,900000);
	    	$tab=explode("#||#",$donnee);
	    	fclose($f);
		@unlink("./data/parametrage/audio.txt");
		@unlink("./data/audio/actu.mp3");
		// nouveau
		move_uploaded_file($tmp_name,"./data/audio/actu.mp3");
	*/
        	$today=dateDMY();
	   	$titre=strip_tags($_POST["saisie_titre"]);
        	$f=fopen("./data/parametrage/audio.txt","w");
        	fwrite($f,"<font size=1>".LANGAUDIO2."$today,</font> <br><font class=T1>$titre</font>#||#$fichier");
        	fclose($f);
	   	$cnx = cnx();
		$audiook="oui";

	   	history_cmd($_SESSION["nom"],"COMMUNIQUER","Audio");
	

}


if  (isset($_POST["supp"])) {
    $f=fopen("./data/parametrage/audio.txt","r");
	$donnee=fread($f,90000);
    $tab=explode("#||#",$donnee);
    fclose($f);
	@unlink("./data/parametrage/audio.txt");
	@unlink("./data/audio/actu.mp3");
}
?>
<tr id='cadreCentral0'>
<td >
<br />
<form method="post"   name=formulaire ENCTYPE="multipart/form-data">
<table  width=100%  border="0" align="center" >
<tr  >
<td align="right"><font class="T2"><?php print LANGMESS241 ?></font></TD>
<TD align="left"><input type="text" name="saisie_titre" size=30 maxlength=28 ></td>
</tr>
<tr>
<td align="right"  valign=top ><font class="T2"><?php print LANGMESS242 ?></font></TD>
<TD  align="left" >
<!-- <input type="file" name="fichier" size=30 /> -->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="292" height="34" id="fileUpload" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="librairie_php/fileUpload_mp3_Fr.swf" />
<param name="wmode" value="transparent">
<param name="quality" value="high" />
<?php $couleur=couleurFont(GRAPH); ?>
<param name="bgcolor" value="<?php print $couleur ?>" />
<embed src="librairie_php/fileUpload_mp3_Fr.swf" quality="high" bgcolor="<?php print $couleur ?>"  wmode="transparent"
       width="292" height="34" name="fileUpload" align="middle" allowScriptAccess="sameDomain" 
       type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

</td>
</tr>
</table>
<br /><br />
<table align=center><tr><td>
<script language=JavaScript>buttonMagicSubmit3("<?php print LANGAUDIO4 ?>","create","onclick='attente();'"); //text,nomInput</script>
<A href='#' onMouseOver="AffBulle3('Information','./image/commun/info.jpg','<font face=Verdana size=1><B><font color=red><?php print LANGAUDIO3?></font></B><?php print LANGAUDIO3bis." <b>$taille2</b> . </font>" ?> '); window.status=''; return true;" onMouseOut='HideBulle()'><img src='./image/help.gif' align=center width='15' height='15'  border=0></A> <br /><br />
</td></tr></table>
</form>
<?php
$fic="./data/parametrage/audio.txt";
if (file_exists($fic)) {
        $fichier=fopen("./data/parametrage/audio.txt","r");
	    $donnee=fread($fichier,90000);
		$tab=explode("#||#",$donnee);
	    fclose($fichier);
?>
<!-- <input type="button" value="Stop" id="btnPlayStop" onclick="Playa.doPlayStop();" /> -->
<center><a href='#'  onMouseOver="AffBulle3('Information','./image/commun/info.jpg','<?php print $tab[0]; ?>');"  onMouseOut="HideBulle()";><img src="./image/commun/son.gif" border=0 align=center></a> : <font class=T1 color=#000000><b><?php print LANGAUDIO1 ?></b></font>
<br><br>
<script language="JavaScript" type="text/javascript">
fpa = new Array();
fpa['FlashVars'] = new Array();
fpa['type']='tiny';
fpa['defaultfile']='./data/audio/actu.mp3';
fpa['FlashVars'][0] = 'autolaunch=wait';
Framaplayer(fpa);
</script>
<br><br>
<form method=post>
<font class=T1><?php print LANGAUDIO6 ?> :</font> <input name="supp" type=submit value="<?php print LANGBT50?>" STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;">
</center><br><br>
</form>
<?php
}

?>

</td>
</tr></table>
<SCRIPT language="JavaScript">InitBulle("#000000","#FCE4BA","red",1);</SCRIPT>
<?php
       // Test du membre pour savoir quel fichier JS je dois executer
       if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")) :
            print "<SCRIPT language='JavaScript' ";
            print "src='./librairie_js/".$_SESSION[membre]."2.js'>";
            print "</SCRIPT>";
       else :
            print "<SCRIPT language='JavaScript' ";
            print "src='./librairie_js/".$_SESSION[membre]."22.js'>";
            print "</SCRIPT>";

            top_d();

            print "<SCRIPT language='JavaScript' ";
            print "src='./librairie_js/".$_SESSION[membre]."33.js'>";
            print "</SCRIPT>";

       endif ;
     ?>
</body>
</html>
