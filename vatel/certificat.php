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
validerequete("menuadmin");
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGTITRE33 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
<font class=T2><?php print LANGMESS325 ?> </font> 
<script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","certificat_param.php","certif_create","scrollbars=yes,width=800,height=780",""); //text,nomInput</script>
<br><br>
<font class=T2><?php print LANGMESS326 ?> </font> </td><td align='top'>
<script language=JavaScript>buttonMagicVATEL("<?php print CLICKICI?>","certificat_param_import.php","_parent","","");</script>
		
<?php
if (isset($_GET["idsup"])) {
	unlink("../data/parametrage/certificat.rtf");
}

if (file_exists("../data/parametrage/certificat.rtf")) {
	print "<tr><td></td><td >[&nbsp;<a href='telecharger.php?fichier=data2/parametrage/certificat.rtf'>".LANGTMESS452."</a>&nbsp;]&nbsp;[&nbsp;<a href='certificat.php?idsup'>".LANGBT50."</a>&nbsp;]</td></tr>";
	$text=LANGTMESS451;
	print "<tr><td colspan=2 align=center><br /><br /><font color='red'>$text</font></td></tr>";
}
?>
		
		
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
