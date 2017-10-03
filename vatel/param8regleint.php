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

validerequete("menuadmin");
// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$idpers=$mySession[Spid];
?>
<script language="JavaScript" src="../librairie_js/lib_circulaire.js"></script>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL63 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='param8regleint.php' ><?php print LANGMESS212 ?></a></li>
				<li style="visibility:visible" ><a href='param8regleintlist.php' ><?php print LANGMESS213 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<form method=post  action='./param8regleint2.php' name='formulaire' ENCTYPE="multipart/form-data">
<table  width=100%  border="0" align="center" >
<tr  >
<td align="right"><font class="T2"><?php print LANGCIRCU6 ?>&nbsp;&nbsp;:&nbsp;&nbsp;</font> </TD>
<TD align="left"><input type="text" name="saisie_titre" size='30' maxlength='28' ></td>
</tr>
<tr  >
<td align="right"><font class="T2"><?php print LANGCIRCU7 ?>&nbsp;&nbsp;:&nbsp;&nbsp;</font></TD>
<TD align="left"><input type="text" name="saisie_ref" size='30' maxlength='28' ></td>
</tr>
<tr>
<td align="right"  ><font class="T2"><?php print LANGMESS337 ?>&nbsp;&nbsp;:&nbsp;&nbsp;</font> </TD>
<?php 
$mess="Format PDF (Max 2Mo)";
?>
<TD  align="left">
<div style="float:left"><input type="file" name="fichier" size='30' ></div><div>&nbsp;&nbsp;<A href='#' title="<?php print $mess?>" ><img src='../image/help.gif' align=center width='15' height='15'  border='0' ></a></div>
</td>
    </tr>
    <tr>
      <td width=35% align="right"  ><font class="T2"><?php print LANGCIRCU9 ?>&nbsp;&nbsp;:&nbsp;&nbsp;</font> </TD>
<?php
$mess=LANGMESS70;
?>
      <TD  align="left"><input type="checkbox" name="saisie_envoi_prof" id="btradio1" value="1" > <A href='#' title="<?php print $mess ?>"><img src='../image/help.gif' align=center width='15' height='15'  border='0' ></a></td>
    </tr>
    <tr>
      <td  align="right" valign=top><font class="T2"><?php print LANGMESS338 ?>&nbsp;&nbsp;:&nbsp;&nbsp;</font></td>
      <TD  align="left">
<?php
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
for($i=0;$i<count($data);$i++) {
      if ($j == 4 ) { $j=0; print "<br/>"; }
      print "<div style='float:left;width:200px'><input type=checkbox  id='btradio1'  name='saisie_classe[]' value='".$data[$i][0]."' />".trim($data[$i][1])."</div>";
      $j++;
}
?>
<br>
<BR><div align=right><a HREF="#" onclick="tout();"><?php print LANGCIRCU13?></a></DIV>
<br>
</td>
</tr></table><BR>
<table align=center><tr><td>
<script language=JavaScript>buttonMagicSubmit3VATEL("<?php print LANGENR?>","rien",""); //text,nomInput</script>&nbsp;&nbsp;
</td></tr></table>
</form>
			
			
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