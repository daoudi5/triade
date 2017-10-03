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
			<?php if ($_GET["id"] == "profxls") { ?>
			<span class="vat-capitalize-title"><?php print LANGVATEL169 ?> </span>
			<?php }else{ ?>
			<span class="vat-capitalize-title"><?php print LANGVATEL170 ?> </span>
			<?php } ?>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
		<?php print LANGVATEL195 ?>
<BR>
<BR>
<font class=T2><?php print LANGIMP7?></font>
<br>
<BR>
<table width="100%" border="1" bgcolor="#FCE4BA" bordercolor=#000000 >
<!-- //$nom,$pren,$mdp,$tp,$civ,$pren2='',$rue,$adr,$codepostal,$tel,$mail,$commune -->
        <tr bgcolor="#FFCC00">
          <td valign=top >1) <?php print LANGIMP47?> *</td>
          <td valign=top >2) <?php print LANGIMP48?> *</td>
          <td valign=top >3) <?php print LANGIMP46?> *</td>
	</tr>
	<tr bgcolor="#FFCC00">
	  <td valign=top >4) <?php print LANGIMP46bis?> </td>
	   <td valign=top >5) <?php print LANGIMP55 ?></td>
	   <td valign=top >6) <?php print LANGIMP56 ?></td>
	</tr>
	<tr bgcolor="#FFCC00">
	   <td valign=top >7) <?php print LANGIMP57 ?></td>
	   <td valign=top >8) <?php print LANGIMP58 ?></td>
	   <td valign=top >9) <?php print LANGIMP59 ?></td>
	</tr>
</table>
<br>
<table>
<tr>
<td valign='top'>
<u><?php print LANGbasededoni51 ?></u> : <br>
<i>
<?php print LANGbasededoni52 ?>
<?php print LANGbasededoni53 ?>
<?php print LANGbasededoni54 ?>
<?php print LANGbasededoni54_2 ?>
<?php print LANGbasededoni54_3 ?>
<?php print LANGbasededoni54_4 ?>
<?php if (CIVARMEE == "oui") { ?>
valeur acceptée : <b>9 </b>ou Général <br>
valeur acceptée : <b>10 </b>ou Colonel<br />
valeur acceptée : <b>11 </b>ou Lieutenant-colonel<br />
valeur acceptée : <b>12 </b>ou Commandant<br />
valeur acceptée : <b>13 </b>ou Capitaine<br />
<?php } ?>
</i>
</td>
<td valign='top'>
<i>
<?php if (CIVARMEE == "oui") { ?>
valeur acceptée : <b>14 </b>ou Lieutenant<br />
valeur acceptée : <b>15 </b>ou Sous-lieutenant<br />
valeur acceptée : <b>16 </b>ou Aspirant<br />
valeur acceptée : <b>17 </b>ou Major<br />
valeur acceptée : <b>18 </b>ou Adjudant-chef<br />
valeur acceptée : <b>19 </b>ou Adjudant<br />
valeur acceptée : <b>20 </b>ou Sergent-chef<br />
valeur acceptée : <b>21 </b>ou Sergent<br />
valeur acceptée : <b>22 </b>ou Caporal-chef<br />
valeur acceptée : <b>23 </b>ou Caporal<br />
valeur acceptée : <b>24 </b>ou Aviateur<br />
<?php } ?>
</i>
</td>
</tr>
</table>
<script language=JavaScript>
function suite() {
	location.href="./base_de_donne_key.php?base=<?php print $_GET["id"]?>";
}
</script>
<BR><div align="center">
<input type='button' class='btn btn-primary btn-sm  vat-btn-footer' value='<?php print LANGVATEL186 ?>' onclick="open('../librairie_php/import-personnel.xls','_blank','')" />
&nbsp;&nbsp;&nbsp;
<input type='button' class='btn btn-primary btn-sm  vat-btn-footer' value='<?php print LANGBTS?>' onclick='suite();'> </div><br />
<br>
<br>
<font color=red>
<?php print LANGIMP49?>
</font></b>

			
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