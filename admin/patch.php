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
<?php
include_once("./librairie_php/lib_licence.php");
include_once("./librairie_php/db_triade_admin.php");
include_once("../common/config6.inc.php");
?>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script type="text/javascript" src="./librairie_js/info-bulle.js"></script>
<title>Triade</title>
<script type="text/javascript" >
function alertjs(item) { alert(item); }
</script>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0"  >
<SCRIPT language="JavaScript" src="librairie_js/menudepart.js"></SCRIPT>
<?php include("librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" src="librairie_js/menudepart1.js"></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' >Installation des patchs</font></b></td></tr>
<tr id='cadreCentral0' ><td >
<!-- // debut de la saisie -->

<?php
if (!is_dir("./patch_ftp")) { mkdir("./patch_ftp"); }

if (INTER == "oui") {
	print "<br><ul><font class=T2>Ce service est pris en compte par notre �quipe.";
	print "<br><br>Nous nous occupons de mettre � jour Triade automatiquement. ";
	print "<br><br>L'Equipe Triade</font></ul>";

}else {
	
?>

	<ul><br>

	<font class=T2><b>Mise � jour de Triade.</b></font> <br><br>

	Pour obtenir les patchs, consulter le module : <a href="http://www.triade-educ.com/accueil/support-triade.php" target="_blank" >Support Triade</a>
	<br><br><br>
	<img src='../image/commun/ico_test.gif' align='left'>

<?php
$taille="2Mo";
$maxsize="2000000";
if (MAXUPLOAD == "oui") { $taille="8Mo"; $maxsize="8000000"; }
?>

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="292" height="54" id="fileUpload" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="./librairie_php/fileUploadPatch.swf" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<param name=FlashVars value="maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>">
<?php $couleur=couleurFont(GRAPH); ?>
<param name="bgcolor" value="<?php print $couleur ?>" />
<embed src="./librairie_php/fileUploadPatch.swf" quality="high" bgcolor="<?php print $couleur ?>"  wmode="transparent"
       width="292" height="54" name="fileUpload" align="middle" allowScriptAccess="sameDomain" 
       type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>" />
</object><a href='#'  onMouseOver="AffBulle('Fichier Taille Max : <?php print $taille ?>');"  onMouseOut="HideBulle()";><img src="../image/help.gif" border=0  ></a>


	<br>
	<br>
	<script language=JavaScript>buttonMagic("Acc�s au gestionnaire de patch","patch1.php","_self",'','');</script>
	<br><br>
	<br><br>
	Actuellement, il reste <strong><?php print human_readable(diskfreespace("../")); ?></strong> 
                               <i><?php print filesize_format(diskfreespace("../")); ?></i> d'espace libre <br>sur votre serveur.
	<br>
	<br><br>
	<b>Liste des patchs d�j� install�s</b> :
	</ul>
	<?php

	include_once("librairie_php/db_triade_admin.php");
	$cnx=cnx();
	$data=list_patch();

	print "<table border=1 width=90% align=center bordercolor='#000000' >";


	for($i=0;$i<count($data);$i++) {
		print "<tr class=\"tabnormal2\" onmouseover=\"this.className='tabover'\" onmouseout=\"this.className='tabnormal2'\" >";
		print "<td width='15%' id='bordure' ><b>".$data[$i][0]."</b></td>";
		print "<td id='bordure' width='10%' >".dateForm($data[$i][1])."&nbsp;".$data[$i][2]."</td>";
		print "<td id='bordure' ><a href='#' onclick=\"open('patch-info.php?idpatch=".$data[$i][0]."','','width=400,height=400')\" >Information&nbsp;sur&nbsp;le&nbsp;patch</a></td>";
		print "</tr>";
	}
	
	Pgclose($cnx);
	print "</table><br><br>";
}
?>

<!-- // fin de la saisie -->
</td></tr></table>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart2.js"></SCRIPT>
<?php top_d(); ?>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart22.js"></SCRIPT>
<SCRIPT type="text/javascript">InitBulle("#000000","#FCE4BA","red",1);</SCRIPT>
</body>
</html>
