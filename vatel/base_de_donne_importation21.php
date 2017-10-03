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
			<span class="vat-capitalize-title"><?php print LANGVATEL168 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			

<?php print LANGVATEL185 ?>
<BR>
<BR>
<font class=T2><?php print LANGIMP7?></font>
<br>
<BR>
<table width="100%" border="1" bgcolor="#FCE4BA" bordercolor=#000000 >
<tr bgcolor="#FFCC00">
        <td valign=top>1) <?php print LANGIMP8?> *</td>
        <td valign=top>2) <?php print LANGIMP9?> *</td>
	<td valign=top>3) <?php print LANGIMP10?> *</td>
	</tr>
	<tr bgcolor="#FFCC00">
	<td valign=top>4) <?php print LANGIMP11?></td>
	<td valign=top>5) <?php print LANGIMP12?>&nbsp;*</td>
	<td valign=top>6) <?php print "Lieu de naissance"?>&nbsp;*</td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>7) <?php print LANGIMP13?> </td>
        <td valign=top>8) <?php print "Civilité tuteur"?> </td>
	<td valign=top>9) <?php print LANGIMP14?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>10) <?php print LANGIMP15?> </td>
        <td valign=top>11) <?php print LANGIMP16?></td>
	<td valign=top>12) <?php print LANGIMP18?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>13) <?php print LANGIMP19?></td>
        <td valign=top>14) <?php print "Tèl. Portable (1)"?></td>
	<td valign=top>15) <?php print "Civilité Pers. (2)"?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>16) <?php print "Nom resp. (2)"?> </td>
        <td valign=top>17) <?php print "Prénom resp. (2)"?> </td>
	<td valign=top>18) <?php print LANGIMP17?></td>
        </tr>
        <tr bgcolor="#FFCC00">
	<td valign=top>19) <?php print LANGIMP18_2?></td>
        <td valign=top>20) <?php print LANGIMP19_2?></td>
	<td valign=top>21) <?php print "Tèl. Portable (2)"?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>22) <?php print LANGIMP20." tuteur "?></td>
        <td valign=top>23) <?php print "Tèl. élève" ?></td>
	<td valign=top>24) <?php print LANGIMP21?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>25) <?php print LANGIMP22?></td>
        <td valign=top>26) <?php print LANGIMP23?></td>
	<td valign=top>27) <?php print LANGIMP24?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>28) <?php print LANGIMP25_2?></td>
        <td valign=top>29) <?php print LANGIMP25?></td>
	<td valign=top>30) <?php print LANGIMP26?></td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>31) <?php print LANGIMP27?></td>
        <td valign=top>32) <?php print LANGIMP28?> </td>
	<td valign=top>33) <?php print LANGIMP29?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
        <td valign=top>34) <?php print "Mot de passe tuteur 1" ?> </td>
	<td valign=top>35) <?php print "Email tuteur" ?> </td>
	<td valign=top>36) <?php print "Email élève" ?> </td>
        </tr>
        <tr bgcolor="#FFCC00">
	<td valign=top>37) <?php print LANGbasededoni41 ?> </td>
	<td valign=top>38) <?php print LANGbasededoni42 ?> </td>
	<td valign=top>39) <?php print LANGIMP52 ?> </td>
        </TR>
	<tr bgcolor="#FFCC00">
	<td valign=top>40) <?php print LANGVATEL175 ?> </td>
	<td valign=top>41) <?php print LANGVATEL176 ?> </td>
	<td valign=top>42) <?php print LANGVATEL177 ?> </td>
	</TR>     
	 </TR>
	<tr bgcolor="#FFCC00">
	<td valign=top>43) <?php print LANGVATEL178 ?> </td>
	<td valign=top>44) <?php print LANGVATEL179 ?> </td>
	<td valign=top>45) <?php print LANGVATEL180?> </td>
        </TR>
	</TR>
	<tr bgcolor="#FFCC00">
	<td valign=top>46) <?php print LANGVATEL181 ?> </td>
	<td valign=top>47) <?php print LANGVATEL182 ?> </td>
        </TR>
      </table>
<br>
<font class=T1>&nbsp;<u><?php print LANGVATEL183 ?></u> : <br><br>
&nbsp;&nbsp;&nbsp;- EXTERN, ou EXT ou externe <br>
&nbsp;&nbsp;&nbsp;- INT ou interne <br>
&nbsp;&nbsp;&nbsp;- DP DAN ou DP ou demi pension </font>
<br><br>
<font class=T1>&nbsp;<u><?php print LANGVATEL184 ?></u> : <br><br>
&nbsp;&nbsp;&nbsp;- M. Mme Mlle Ms Mr Mrs M. OU Mme<br>
&nbsp;&nbsp;&nbsp;- P. Sr Dr<br>
<?php if ( CIVARMEE == "oui") { ?>
&nbsp;&nbsp;&nbsp;- Général Colonel Lieutenant-colonel Commandant Capitaine Lieutenant <br>
&nbsp;&nbsp;&nbsp;- Sous-lieutenant Aspirant Major Adjudant-chef Adjudant Sergent-chef <br>
&nbsp;&nbsp;&nbsp;- Sergent Caporal-chef Caporal Aviateur<br>
<?php } ?>
<br><br>
<font class=T1>&nbsp;<u><?php print LANGVATEL181 ?></u> : <br><br>
&nbsp;&nbsp;&nbsp;- m, ou f <br>
</font><br>
<script language=JavaScript>
function suite() {
	location.href="./base_de_donne_key.php?base=xls";
}
</script>
<BR><div align="center">
<input type=button class='btn btn-primary btn-sm  vat-btn-footer' value='<?php print LANGVATEL186 ?>' onclick="open('../librairie_php/import-etudiant.xls','_blank','')" />
&nbsp;&nbsp;&nbsp;
<input type=button class='btn btn-primary btn-sm  vat-btn-footer' value='<?php print LANGBTS?>' onclick='suite();'> 
</div><br />
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