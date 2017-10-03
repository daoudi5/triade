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
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
		
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL160 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='editcertificat.php' ><?php print LANGVATEL160 ?></a></li>
			</ul>
			</div>
		</header>
		
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			<table border='0'  >
			<tr><td align="right"  width=50% >
			<form method='post' onsubmit="return valide_consul_classe()" name="formulaire"  >
			<font class=T2><?php print LANGELE4?> :</font> <select id="saisie_classe" name="saisie_classe">
			<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
			<?php
			select_classe(); // creation des options
			?>
			</select></td><td>&nbsp;&nbsp;
			<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
			</form>
			</td></tr></table>
			
<?php
// affichage de la classe
if ((isset($_POST["consult"])) || (isset($_POST["num_certif"])))  {
	$saisie_classe=$_POST["saisie_classe"];
	$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves , ${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);
	// ne fonctionne que si au moins 1 élève dans la classe
	// nom classe
	$cl=$data[0][0];
	$num_certif=$_POST["num_certif"];
	?>
	<BR><BR>
	<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
	<tr id='coulBar0' ><td height="2" colspan="3"><b><font class='T2 shadow'>
	<?php print LANGELE4?>&nbsp;:&nbsp;<font id='color2'><b><?php print $cl?></b></font>&nbsp;/&nbsp;<?php print LANGCOM3 ?> <font id="color2"><b><?php print count($data) ?></b></font></font></td></tr>
	<?php
	if( count($data) <= 0 )	{
		print("<tr id='cadreCentral0'  ><td align=center valign=center>".LANGRECH1."</td></tr>");
	}else{
		if (!file_exists("../data/parametrage/certificat$num_certif.rtf")) {
			print "<tr id='cadreCentral0' ><td colspan=3><br><form method=post action='certificat1.php'>";
			print "<script language=JavaScript>buttonMagicSubmitVATEL('".LANGBT49."','tous');</script>";
			print "<input type=hidden name='idclasse' value=\"".$_POST["saisie_classe"]."\">";
			print "<input type=hidden name='num_certif' value='".$_POST["num_certif"]."' ></form>";
			?>
			<br>
			<form method='post'><font class='T2'><?php print LANGTMESS453 ?> </font>
			<select name='num_certif' onChange="this.form.submit()" >
			<?php if ($_POST["num_certif"] != "") print "<option value='".$_POST["num_certif"]."'>".preg_replace('/_/','',$_POST["num_certif"])."</option>"; ?>
			<option value=''></option>
			<option value='_A'>A</option>
			<option value='_B'>B</option>
			<option value='_C'>C</option>
			</select>
			<input type='hidden' name='saisie_classe' value='<?php print $saisie_classe ?>' /></form>
			<?php
			print "<br>";
			print "</td></tr>";
		}else{
			print "<tr id='cadreCentral0' ><td colspan=3><br>";
			print "<form method=post action='certificat12.php'>";
			print "<script language=JavaScript>buttonMagicSubmitVATEL('".LANGBT49."','tous');</script>";
			print "<input type=hidden name='idclasse' value=\"".$_POST["saisie_classe"]."\">";
			print "<input type=hidden name='num_certif' value='".$_POST["num_certif"]."' ></form>";
			?>
			<form method='post'><font class='T2'><?php print LANGTMESS453 ?> </font>
			<select name='num_certif' onChange="this.form.submit()" >
			<?php if ($_POST["num_certif"] != "") print "<option value='".$_POST["num_certif"]."'>".preg_replace('/_/','',$_POST["num_certif"])."</option>"; ?>
			<option value=''></option>
			<option value='_A'>A</option>
			<option value='_B'>B</option>
			<option value='_C'>C</option>
			</select><input type='hidden' name='saisie_classe' value='<?php print $saisie_classe ?>' /></form>
			<?php
			print "<br><br>";
			print "</td></tr>";
		}
		print "</table>";
	}
	
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