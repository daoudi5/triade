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

if ($_SESSION["membre"] == "menupersonnel") {
	if (verifDroit($_SESSION["id_pers"],"trombinoscopeRead")){
		$visu=1;
		$visu2=0;
	}
}else{
	validerequete("2");
	$visu=1;
	$visu2=1;
}


?>
<script language="JavaScript" src="../librairie_js/lib_circulaire.js"></script>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL273 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='param8tronbi.php' ><?php print LANGVATEL69." ".LANGASS38 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<table>
<?php if (($visu == 1) || ($visu2 == 1)) { ?>
<tr><td colspan=2 height=20></td></tr>
<tr><td  align="right" ><font class="T2"><?php print LANGTRONBI1 ?>&nbsp;:&nbsp;</font></td>
<td><script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","tronbinoscope-visu.php","_parent","","");</script>&nbsp;&nbsp;</td></tr>
<tr><td colspan=2 height=20></td></tr>
<tr><td  align="right" ><font class="T2"><?php print LANGMESS322 ?>&nbsp;:&nbsp;</font></td>
<td><script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","tronbinoscope-visu-pdf.php","_parent","","");</script>&nbsp;&nbsp;</td></tr>
<tr><td colspan=2 height=20></td></tr>
<?php } ?>
<?php if ($visu2 == 1) { ?>
<tr><td  align="right" ><font class="T2"><?php print LANGTRONBI2 ?>&nbsp;:&nbsp;</font></td>
<td><script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","tronbinoscope.php","_parent","","");</script>&nbsp;&nbsp;</td></tr>
<tr><td colspan=2 height=20></td></tr>
<?php } ?>

<?php if (($visu == 1) || ($visu2 == 1)) { ?>
<tr><td  align="right" ><font class="T2"><?php print LANGTRONBI30 ?>&nbsp;:&nbsp;</font></td>
<td><script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","tronbinoscope-visu-pers.php","_parent","","");</script>&nbsp;&nbsp;</td></tr>
<tr><td colspan=2 height=20></td></tr>
<?php } ?>
<?php if ($visu2 == 1) { ?>
<tr><td  align="right" ><font class="T2"><?php print LANGTRONBI20 ?>&nbsp;:&nbsp;</font></td>
<td><script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","tronbinoscope-pers.php","_parent","","");</script>&nbsp;&nbsp;</td></tr>

<tr><td colspan=2 height=20></td></tr>
<tr><td colspan="2"><hr></td></tr>
<tr><td colspan=2 height=20></td></tr>

<tr><td  align="right" ><font class="T2"><?php print LANGMESS323 ?>&nbsp;:&nbsp;</font></td>
<td><script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","trombi-import-zip.php","_parent","","");</script>&nbsp;&nbsp;</td></tr>
<tr><td colspan=2 height=20></td></tr>
<?php } ?>

</table>			
			
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
