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
			<span class="vat-capitalize-title"><?php print LANGASS39 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		
<table width='100%' border=0 bgcolor="#FFFFFF" bordercolor="#000000" >
<tr>
<td id='bordure' >
<form method=post onsubmit="return valide_consul_classe()" name="formulaire">
<font class=T2><?php print LANGELE4?> :</font> <select id="saisie_classe" name="saisie_classe">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?>
</select> <br><br<
<font class=T2><?php print LANGMESS221 ?></font>&nbsp;&nbsp;<select name="codebase">
<!-- <option value="codabar" id='select0' >CODABAR</option> -->
<option value="code39" id='select0' >code39</option>
<!-- <option value="EAN13-ISBN" id='select0' >EAN-13/ISBN</option> -->
</select>&nbsp;&nbsp;<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
</form>
</td>


<td id='bordure'>
<form method=post onsubmit="return valide_consul_membre()" name="formulaire1">
<font class=T2><?php print LANGMESS216 ?>&nbsp;:</font>&nbsp;<select id="membre" name="membre">
<option id='select0' ><?php print LANGCHOIX?></option>
<option id='select1' value="menuadmin" ><?php print "Direction"?></option>
<option id='select1' value="menuprof" ><?php print "Enseignant"?></option>
<option id='select1' value="menuscolaire" ><?php print "Vie Scolaire"?></option>
<option id='select1' value="menupersonnel" ><?php print "Personnel"?></option>
</select><BR><br />
<font class=T2><?php print LANGMESS221?></font>&nbsp;<select name="codebase">
<!-- <option value="codabar" id='select0' >CODABAR</option> -->
<option value="code39" id='select0' >code39</option>
<!-- <option value="EAN13-ISBN" id='select0' >EAN-13/ISBN</option> -->
</select>&nbsp;&nbsp;<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consultmembre"); //text,nomInput</script>
</form></td></tr></table>

<?php if(isset($_POST["codebase"])) { ?>
		<br><center><?php print LANGCODEBAR4 ?> <b>code39</b>.</center>
<?php } ?>


<?php
// affichage de la classe
if(isset($_POST["consult"])) {
	$saisie_classe=$_POST["saisie_classe"];
	$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);

	// ne fonctionne que si au moins 1 élève dans la classe
	// nom classe
	$cl=$data[0][0];
?>
	<BR><BR>
	<table border="0" cellpadding="3" cellspacing="1" width="100%"  height="85">
	<tr><td height="2"><b><font   id='menumodule1' ><?php print LANGELE4?> : <font id="color2"><B><?php print $cl?></font></font></td></tr>
	<?php
	if( count($data) <= 0 )	{
		print("<tr><td align=center valign=center>".LANGRECH1."</td></tr>");
	}else {
		history_cmd($_SESSION["nom"],"VISUALISA.","Code Barre");

	?>
	<tr><td>
	<iframe src="../codebar.php?idclasse=<?php print $saisie_classe?>&codebase=<?php print $_POST["codebase"]?>" width='100%' height='700' MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=yes name=codebar  ></iframe>
<?php
	}
	print "</td></tr></table>";
}

if(isset($_POST["consultmembre"])) {
	$membre=$_POST["membre"];
?>
	<BR><BR><BR>
	<table border="1" cellpadding="3" cellspacing="1" width="100%"  height="85">
	<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Membre" ?> : <font id="color2"><B><?php print renvoiMembreFormatePersonne($membre) ?></font></font></td></tr>
	<tr><td>
	<iframe src="../codebarmembre.php?membre=<?php print $membre?>&codebase=<?php print $_POST["codebase"]?>" width='100%' height='700' MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=yes name=codebar  ></iframe>
	</td></tr></table>
<?php  } ?>
		
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