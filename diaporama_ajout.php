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
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/lib_circulaire.js"></script>
<script language="JavaScript" src="./librairie_js/info-bulle.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom] "?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" onunload="attente_close()">
<?php
include_once("./librairie_php/lib_licence.php");
include_once("librairie_php/db_triade.php");
validerequete("3");
?>

<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Ajout photo pour diaporama" ?></font></b></td></tr>
<tr id='cadreCentral0' >
<td >
<!-- // fin  -->
<form method=post  action='./circulaire_ajout2.php' name=formulaire ENCTYPE="multipart/form-data">
<table  width=100%  border="0" align="center" >
<tr  >
<td align="right" valign=top><?php print "Commentaire" ?> : </TD>
<TD align="left"><textarea name="saisie_titre" cols=50 rows=5  ></textarea></td>
</tr>
<tr  >
<td align="right"><?php print "Pour le diaporama N� "  ?> : </TD>
<TD align="left"><select name="diapo_num">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	</select></td>
</tr>
<tr>
<td align="right"  ><?php print "Photo" ?> : </TD>
<TD  align="left">
<input type="file" name="fichier" size=30 >
<A href='#' onMouseOver="AffBulle3('Attention','./image/commun/warning.jpg','<?php print "Photo au format jpg ou  <br>png ou gif" ?>'); window.status=''; return true;" onMouseOut='HideBulle()'><img src='./image/help.gif' align=center width='15' height='15'  border=0></A>
</td>
    </tr>
    <tr>
      <td width=35% align="right"  ><?php print LANGCIRCU9 ?> : </TD>
      <TD  align="left"><input type="checkbox" name="saisie_envoi_prof" id="btradio1" > <A href='#' onMouseOver="AffBulle3('Information','./image/commun/info.jpg','<?php print "Diaporama visible par les enseignants." ?>'); window.status=''; return true;" onMouseOut='HideBulle()'><img src='./image/help.gif' align=center width='15' height='15'  border=0></A>
      </td>
    </tr>
    <tr>
      <td  align="right" valign=top><?php print LANGCIRCU10 ?> : </td>
      <TD  align="left">
<?php
$cnx=cnx();
$data=affclasse();
?>
<SCRIPT LANGUAGE=JavaScript>
nbcase="<?php print count($data)?>";
nbcase+=4;
function tout() {
	for (i=4;i<=nbcase;i++) {
                document.formulaire.elements[i].checked=true;
	}
}
</SCRIPT>
<?php
$j=0;
for($i=0;$i<count($data);$i++)
     {
      if ($j == 4 ) { $j=0; print "<br/>"; }
      print "<input type=checkbox  id='btradio1'  name='saisie_classe[]' value='".$data[$i][0]."' />".trim($data[$i][1])."\n";
      $j++;
     }
?>
<br>
<BR><div align=right><a HREF="#" onclick="tout();"><?php print LANGCIRCU13?></a></DIV>
<br>
</td>
</tr></table><BR>
<table align=center><tr><td>
<script language=JavaScript>buttonMagic("<?php print LANGCIRCU14 ?>","Javascript:history.go(-1)","_parent","","");</script>
<script language=JavaScript>buttonMagicSubmit3("<?php print "Enregistrer cette photo" ?>","rien","onclick='attente();'"); //text,nomInput</script>&nbsp;&nbsp;
</td></tr></table>
</form>
<BR>
     <!-- // fin  -->
     </td></tr></table>
     <?php
       // Test du membre pour savoir quel fichier JS je dois executer
       if ($_SESSION[membre] == "menuadmin") :
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
	Pgclose();
     ?>
<SCRIPT language="JavaScript">InitBulle("#000000","#FCE4BA","red",1);</SCRIPT>
</BODY></HTML>
