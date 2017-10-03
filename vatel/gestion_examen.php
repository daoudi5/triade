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
validerequete("menuadmin");
$idpers=$mySession[Spid];
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL206 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param12.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
			
			<table align="center">

<tr>
<form method="post" action="gestion_examen.php" >
<td align='right' ><font class="T2"><?php print LANGBULL3 ?> :</font></td>
<td align='left' ><select name='anneeScolaire' onChange="this.form.submit()" >
<?php
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select></td></tr>
</form>

<?php if (trim($anneeScolaire)  != "") { ?>
<tr><td height=20></td></tr>

<?php if (VATEL != 1) { ?>

<!-- 
<tr>
<form action='gestion_examen_brevet_bonif.php'>
<td align=right><font class="T2"><?php print "Fiche Scolaire Brevet (Bonifacio)" ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmit("<?php print  LANGMESS447 ?>","rien"); //text,nomInput</script></td>
</form>
</tr>
-->
<tr>
<form action='gestion_examen_brevet_nf.php'>
<td align=right><font class="T2"><?php print "Fiche Scolaire Brevet série collège " ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitVATEL("<?php print  LANGMESS447 ?>","rien"); //text,nomInput</script></td>
</form>
</tr>

<tr><td height=20></td></tr>
<tr>
<form action='gestion_examen_brevet_pf.php'>
<td align=right><font class="T2"><?php print "Fiche Scolaire Brevet série professionnelle " ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGMESS447 ?>","rien"); //text,nomInput</script></td>
</form>
</tr>

<tr><td height=20></td></tr>
<tr>
<form action='gestion_examen_brevet_techno.php'>
<td align=right><font class="T2"><?php print "Fiche Scolaire Brevet série professionnelle ".date("Y") ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitVATEL("<?php print  LANGMESS447 ?>","rien"); //text,nomInput</script></td>
</form>
</tr>

<!--
<tr><td height=20></td></tr>
<tr>
<form action='gestion_examen_b2i.php'  method="post"  >
<input type=hidden name="type_notation" value="A2" />
<td align=right><font class="T2"><?php print "<s>Notation niveau A2 de langue</s>" ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitAttVATEL("<?php print  LANGMESS447 ?>","rien","disabled"); //text,nomInput</script></td>
</form>
</tr>
-->

<tr><td height=20></td></tr>
<tr>
<form action='gestion_examen_b2i.php'  method="post"  >
<input type=hidden name="type_notation" value="A2R" />
<td align=right><font class="T2"><?php print "Notation niveau A2 de langue régionale" ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitAttVATEL("<?php print  LANGMESS447 ?>","rien",""); //text,nomInput</script></td>
</form>
</tr>

 
<tr><td height=20></td></tr>
<tr>
<form action='gestion_examen_listing.php'  method="post"  >
<input type=hidden name="type_notation" value="A2" />
<td align=right><font class="T2"><?php print "Examen par matières (listing)" ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitAttVATEL("<?php print  LANGMESS447 ?>","rien",""); //text,nomInput</script></td>
</form>
</tr>


<tr><td height=20></td></tr>
<tr>
<form action='gestion_examen_jury.php'  method="post"  >
<td align=right><font class="T2"><?php print "Evaluation et notation du jury" ?> :</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitAttVATEL("<?php print LANGMESS447 ?>","rien",""); //text,nomInput</script></td>
</form>
</tr>

<?php } ?>

<tr><td height=20></td></tr>
<tr>
<form action='gestion_supplement_titre_acces.php'  method="post"  >
<td align=right><font class="T2"><?php print LANGTMESS507 ?>&nbsp;:&nbsp;</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitAttVATEL("<?php print LANGMESS447 ?>","rien",""); //text,nomInput</script></td>
</form>
</tr>


<tr><td height=20></td></tr>
<tr>
<form action='gestion_supplement_titre.php'  method="post"  >
<td align=right><font class="T2"><?php print LANGTMESS508 ?>&nbsp;:&nbsp;</font></td>
<td align=left><script language=JavaScript>buttonMagicSubmitAttVATEL("<?php print LANGMESS447 ?>","rien",""); //text,nomInput</script></td>
</form>
</tr>

<?php } ?>
</table>
<br><br>

			
			
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