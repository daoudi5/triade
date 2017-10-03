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
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_verif_message.js"></script>
<script type="text/javascript" src="./librairie_js/ajax-messagerie.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit2.js"></script>
<script type="text/javascript" src="./librairie_js/info-bulle.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title>
<script type="text/javascript" src="./FCKeditor/fckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	var oFCKeditor = new FCKeditor('resultat','99%','480','messagerie','') ;
	//oFCKeditor.Config['CustomConfigurationsPath'] = './fckeditor/myconfig.js'
	oFCKeditor.BasePath = './FCKeditor/' ;
	oFCKeditor.ReplaceTextarea() ;
}
</script>
</head>
<body id='bodyfond2' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" >
<?php 
include_once("./librairie_php/lib_licence.php"); 
include_once('librairie_php/db_triade.php');
$cnx=cnx();
?>
<!-- // fin du texte   -->
<div align='center'>
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr id='cadreCentral0'>
<td valign='top' >
<!-- // fin  -->
<?php
$data=affichage_messagerie_message($_GET["saisie_id_message"]);
// $data : tab bidim - soustab 3 champs
if ($_SESSION["navigateur"] == "IE") {
	$action="./messagerie_enr.php";
}else{
	$action="./messagerie_enr_firefox.php";
}

for($i=0;$i<count($data);$i++) {
	$qui_envoi=$data[$i][9];
	$number=$data[$i][10];
	if ((trim($data[$i][7]) == "ADM")||(trim($data[$i][7]) == "ENS")||(trim($data[$i][7]) == "MVS")||(trim($data[$i][7]) == "TUT")) {
	    $destinataire=recherche_personne($data[$i][2]);
	}else{
	    $destinataire=recherche_eleve($data[$i][2]);
	}


?>
<form name="formulaire" method=post onsubmit='return verif_message_envoi()' action='<?php print $action ?>' target='_parent'>
<BR>
<font class=T2>&nbsp;&nbsp;<?php print ucwords(LANGTE3)?> : 
<input type=text name="saisie_emetteur" value="<?php print "$_SESSION[nom] $_SESSION[prenom]" ?>" onfocus=this.blur() maxlength='40' size=25 STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;">
<br /><br />
&nbsp;&nbsp;<?php print ucwords(LANGTE5)?> : <input type=text name="saisie_objet" size=50 maxlength=50 value="<?php print trunchaine($data[$i][8],50)?>" >
<BR><BR>
&nbsp;&nbsp;<?php print LANGTE6?> : <input type=text name="saisie_destinataire" onfocus="this.blur()" size=30 STYLE="font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;" value="<?php print $destinataire?>" >
</font>
<input type=hidden name="saisie_destinataire"  value="<?php print $data[$i][2]?>" >

<BR><BR><BR>
<?php
$messageencours.=stripslashes(Decrypte($data[$i][3],$number));
?>
<?php 
if (($_SESSION["navigateur"] != "IE") || ($_SESSION["navigateur"] != "MO")) {
?>
&nbsp;<textarea name="resultat" id="editor" cols=150 rows=25>

<?php print $messageencours?></textarea><br /><br />
<?php
}else{
?>
<textarea name="resultat" id="editor"><?php print  $messageencours ?></textarea>
<?php } ?>

<?php 
$idpiecejointe=md5($_SESSION["membre"].$_SESSION["id_pers"].date("YMDHms"));
?>
<input type=hidden name=saisie_type_personne_dest value="<?php print $qui_envoi?>" >
<input type="hidden" name="idpiecejoint" value="<?php print $idpiecejointe ?>" >
<input type="hidden" name="brouillon" value="0" >
<input type="hidden" name="idsuppbrouillon" value="<?php print $data[$i][0] ?>" >

<div  style="position:absolute; top:700 ;left:100" >
<table align=center><tr><td>
<script language=JavaScript>buttonMagicSubmit2('<?php print LANGBT4?>','rien','<?php print LANGBT5 ?>'); //text,nomInput</script>
</td></tr></table>
<br><br>
</div>

</form>

<div id="fjoint" style="position:absolute; top:625 ;left:10 "  >
<form method="post" enctype="multipart/form-data" action="messagerie_envoi_fichier.php"  target="UploadTarget" >
<?php
$taille="2Mo";
$maxsize="2000000";
if (UPLOADIMG == "oui") { $taille="8Mo"; $maxsize="8000000"; }
?>
<table><tr><td>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="292" height="54" id="fileUpload" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="librairie_php/fileUpload.swf" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<param name=FlashVars value="idpiecejoint=<?php print trim($idpiecejointe) ?>&maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>">
<?php $couleur=couleurFont(GRAPH); ?>
<param name="bgcolor" value="<?php print $couleur ?>" />
<embed src="librairie_php/fileUpload.swf" quality="high" bgcolor="<?php print $couleur ?>"  wmode="transparent"
       width="292" height="54" name="fileUpload" align="middle" allowScriptAccess="sameDomain" 
       type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="idpiecejoint=<?php print trim($idpiecejointe) ?>&maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>" />
</object></td> <td valign='top'> <a href='#'  onMouseOver="AffBulle('Fichier : doc, xls, ppt, pdf, txt, zip, odt, odg, ods - Max : <?php print $taille ?>');"  onMouseOut="HideBulle()";><img src="./image/help.gif" border=0 align=center></a></td></tr></table>
</div>
<br />

<iframe src="vide.html" name="UploadTarget" style="visibility:hidden" width=5 height=5 ></iframe>
<!-- // fin  -->
</td></tr></table>
<?php
}
?>
<SCRIPT type="text/javascript">InitBulle("#000000","#FCE4BA","red",1);</SCRIPT> 
</BODY></HTML>
