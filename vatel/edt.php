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

$idpers=$mySession[Spid];
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGPROFB3 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		
<table border=0 align='center' >
<tr><td align='right'><font class="T2"><?php print LANGEDT7 ?> &nbsp;:&nbsp;</td><td><input type=button class='btn btn-primary btn-sm  vat-btn-footer' onclick="open('../edt_visu.php','edt','width=1050,height=650,resizable=yes,personalbar=no,toolbar=no,statusbar=no,locationbar=no,menubar=no,scrollbars=yes')" value="<?php print LANGBREVET1  ?>" />
</td></tr>
<!-- 
<tr><td align='right'><font class="T2"><?php print LANGMESS229 ?> &nbsp;:&nbsp;</font></td>
<td><input type='button'  class='btn btn-primary btn-sm  vat-btn-footer' onclick="open('gestion_vacation_horaire.php','_parent','')" value="<?php print LANGBREVET1 ?>" />
</td></tr>

<tr><td align='right'><font class="T2"><?php print LANGTMESS489 ?> &nbsp;:&nbsp;</font></td>
<td><input type='button' class='btn btn-primary btn-sm  vat-btn-footer' onclick="open('edt_duplicate.php','_parent','')" value="<?php print LANGBREVET1 ?>" />
</td></tr>

<tr><td align='right'><font class="T2"><?php print LANGMESS228 ?> &nbsp;:&nbsp;</font></td>
<td><input type='button' class='btn btn-primary btn-sm  vat-btn-footer' onclick="open('gestion_suppr_edt.php','_parent','')" value="<?php print LANGBREVET1 ?>" />
</td></tr>
-->
</table>
<hr>
<?php 
if (isset($_POST["createEDT"])) {
	enr_parametrage("datefinEDT",$_POST["datefinEDT"]);
	enr_parametrage("datedebutEDT",$_POST["datedebutEDT"]);
}

$datefinEDT=aff_enr_parametrage("datefinEDT");
$datedebutEDT=aff_enr_parametrage("datedebutEDT");

?>
<table border=0 align='center' >
<form action='edt.php' method='post' name="form2" >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' />
<td align=right><font class="T2"><?php print LANGMESS230 ?> :</td><td>
<?php print LANGMESS109 ?> <input type="text" name="datedebutEDT" value="<?php print $datedebutEDT[0][1] ?>"  onclick="this.value=''" size=12 class="bouton2" onKeyPress="onlyChar(event)" />&nbsp;<?php
include_once("../librairie_php/calendar.php");
calendarVATEL("id111","document.form2.datedebutEDT",$_SESSION["langue"],"0","0");
?>&nbsp;<br><?php print LANGMESS110 ?>&nbsp;<input type="text" name="datefinEDT" value="<?php print $datefinEDT[0][1] ?>"  onclick="this.value=''" size=12 class="bouton2" onKeyPress="onlyChar(event)" />&nbsp;<?php
calendarVATEL("id222","document.form2.datefinEDT",$_SESSION["langue"],"0","0");
?> </font></td>
<td align=left valign='bottom' ><script language=JavaScript> buttonMagicSubmit3VATEL("<?php print "ok" ?>","createEDT","")</script></td></tr>
</form>
</table>
<br>
		
		
		
		
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