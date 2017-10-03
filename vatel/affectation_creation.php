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


if (empty($_SESSION["adminplus"])) {
	print "<script>";
	print "location.href='./param9.php'";
	print "</script>";
}


?>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL86 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
<form method=post onsubmit="return affectation_classe2()" name="formulaire" action="affectation_creation2.php" >
<table border='0' >
<tr><td colspan=2>
<br>
<font class='T2 shadow' id='color3' ><?php print LANGVATEL97 ?></font>
<BR>
<BR>
<font class="T2"><?php print LANGAFF1?> : </font><select name="saisie_classe_envoi">
<option value=0  id='select0' ><?php print LANGCHOIX?></option>
<optgroup label="Classe">
<?php
select_classe(); // creation des options
?>
</select><br><br>
<td></tr>
<tr><td><font class="T2"><?php print LANGPER14?>&nbsp;:&nbsp;</font> <input type=text name="saisie_nb_matiere" size=3></td></tr>
<tr>
<td>
<br><font class="T2"><?php print LANGMESS341."&nbsp;:&nbsp;" ?></font> 
<select name="saisie_tri">
<option value='tous'  id='select0' selected='selected' ><?php print LANGMESS341 ?></option>
<option value='trimestre1'  id='select1' ><?php print LANGMESS342 ?></option>
<option value='trimestre2'  id='select1' ><?php print LANGMESS343 ?></option>
<option value='trimestre3'  id='select1' ><?php print LANGMESS344 ?></option>
</select>
</td>
</tr>
<tr><td height='20'></td></tr>
<tr>
<td><font class="T2"><?php print LANGMESS145 ?>&nbsp;:&nbsp;</font>
<select name='anneeScolaire'>
<?php
print "<option value=''id='select0' >".LANGCHOIX."</option>";
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>
</td></tr>

<tr>
<td><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT19?>","rien"); //text,nomInput</script>
</td></tr></table>
</form>

<br>
<!-- <center><b><font color="#000000" class="T1"><b><?php print LANGAFF2?></b></font></center> -->
<hr>
<form method='post' action='affectation_creation_copy.php' >
<font class='T2 shadow' id='color3' ><?php print LANGVATEL101 ?></font>
<BR>
<BR>
<font class='T2'><?php print LANGVATEL102 ?>&nbsp;:&nbsp;
<select name="saisie_classe_source">
<option value=0  id='select0' ><?php print LANGCHOIX?></option>
<optgroup label="Classe">
<?php
select_classe(); // creation des options
?>
</select> <?php print LANGVATEL100 ?>&nbsp;:&nbsp;<select name='anneeScolaireSource'>
<?php
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>

<br><br><?php print LANGSTAGE55 ?>&nbsp;:&nbsp;
<select name="saisie_classe_destination">
<option value=0  id='select0' ><?php print LANGCHOIX?></option>
<optgroup label="Classe">
<?php
select_classe(); // creation des options
?>
</select>
<?php print LANGVATEL100 ?>&nbsp;:&nbsp; 
<select name='anneeScolaireDest'>
<?php
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>
<br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGVATEL98 ?>","rien"); //text,nomInput</script>
<br><br>
</form>
<?php
if (isset($_GET["errorcopy"])) {
	print "<br><center><font id='color3' class='T2 shadow'>".LANGVATEL99."</font></center><br>";

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
