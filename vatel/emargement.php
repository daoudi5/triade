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

validerequete("3");


?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL138 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param10.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<?php
$datap=config_param_visu("hauteuremarg");
$hauteur=$datap[0][0];
if ($hauteur != "") {
	$option="<option value='$hauteur' id='select0'>$hauteur</option>";
}else{
    $hauteur=6;
}
?>
<br />

<table border='0' width="50%">
<tr><td align='center' colspan='2' >
<form method='post' >
<font class="T2"><?php print LANGBULL29 ?> :</font>
<select name='anneeScolaire' onChange="this.form.submit()"  >
<?php
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>
</form>
</td></tr>

<tr><td height='20' width='50%' ></td></tr>


<tr><td height='20' colspan='2' align='center' > <b><font class="T2 shadow"><?php print LANGMESS304 ?></font></b> </td></tr>
<tr><td height='20' width='50%' ></td></tr>
<tr>
<form action='emargementvierge.php?idclasse' method='post' name='form1' >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' id='hauteur1'  />
<td align=right><font class="T2"><?php print LANGMESS305 ?> :</font></td>
<td align=left ><select id="saisie_classe" name="saisie_classe" onChange="this.form.submit();">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_classe2(20); // creation des options
?>
</select></td></tr>
</form>

<tr><td height='20'></td></tr>

<tr>
<form action='emargementviergeexamen.php' method='post' name='form2' >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' id='hauteur2' />
<td align=right ><font class="T2"><?php print LANGMESS306 ?> :</font></td>
<td align=left ><select id="saisie_classe" name="saisie_classe" onChange="this.form.submit();">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_classe2(20); // creation des options
?>
</select></td></tr>
</form>
<tr><td height='20'></td></tr>
<tr><td height='20' colspan='2' align='center'> <b><font class="T2 shadow"><?php print LANGMESS307 ?></font></b> </td></tr>
<tr><td height='20'></td></tr>

<form action='emargementvierge.php?idgroupe' method='post' name='form1' >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' id='hauteur3' />
<td align=right ><font class="T2"><?php print LANGMESS305 ?> :</font></td>
<td align=left ><select id="saisie_groupe" name="saisie_groupe" onChange="this.form.submit();">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_groupe_id(); // creation des options
?>
</select></td></tr>
</form>


<tr><td height='20'></td></tr>

<tr>
<form action='emargementviergeexamen.php' method='post' name='form2' >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' id='hauteur4' />
<td align=right ><font class="T2"><?php print LANGMESS306 ?> :</font></td>
<td align=left ><select id="saisie_groupe" name="saisie_groupe" onChange="this.form.submit();">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
select_groupe_id(20); // creation des options
?>
</select></td></tr>
</form>
<tr><td height='20'></td></tr>
<tr><td height='20' colspan='2'><hr></td></tr>

<tr><td height='20'></td></tr>

<tr>
<form action='emargementdujour.php' method='post' name='form3' >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' id='hauteur5'  />
<td align=right><font class="T2"><?php print LANGMESS314 ?>&nbsp;:&nbsp;</font></td>
<td align=left ><script language=JavaScript> buttonMagicSubmit3VATEL("<?php print LANGBT28?>","create","")</script></td></tr>
<input type="hidden" name="datedujour" value="<?php print date("d/m/Y") ?>" />
</form>

<tr><td height='20'></td></tr>

<form action='emargementdujour.php' method='post' name="formulaire" >
<input type='hidden' name='hauteur' value='<?php print $hauteur ?>' id='hauteur6'  />
<td align=right><font class="T2"><?php print LANGMESS315 ?>&nbsp;</td><td>&nbsp;<input type="text" name="datedujour" value="<?php print date("d/m/Y") ?>"  onclick="this.value=''" size=12 class="bouton2" onKeyPress="onlyChar(event)" />&nbsp;<?php
include_once("../librairie_php/calendar.php");
calendarVatel("id1","document.formulaire.datedujour",$_SESSION["langue"],"0","0");
?></td></tr>
<td align=right><font class="T2">au&nbsp;</td><td>&nbsp;<input type="text" name="datedujourfin" value=""  onclick="this.value=''" size=12 class="bouton2" onKeyPress="onlyChar(event)" />&nbsp;
<?php
include_once("../librairie_php/calendar.php");
calendarVatel("id2","document.formulaire.datedujourfin",$_SESSION["langue"],"0","0");
?>&nbsp;</font></td>
<tr><td align=right><font class="T2"><?php print LANGMESS316 ?>&nbsp;</font></td><td><select id="saisie_classe" name="saisie_classe" >
<option id='select0' value='tous' ><?php print LANGAFF5 ?></option>
<?php
select_classe2(20); // creation des options
?>
</select>
</td></tr>
<tr><td align=right ><font class="T2"><?php print LANGMESS317 ?>&nbsp;</font></td><td><select id="saisie_prof" name="saisie_prof" >
<option id='select0' value='tous' ><?php print LANGMESS318 ?></option>
<?php select_personne_2('ENS','25'); ?>
</select>
</td></tr>
<tr><td></td><td valign='bottom' ><br><script language=JavaScript> buttonMagicSubmit3VATEL("<?php print LANGBT28?>","create","")</script></td></tr>
</form>
<form name="form0" >
<td >
         <br><font align='right' class="T2"><?php print LANGMESS319 ?>&nbsp;:&nbsp;</font>
        </td>
	<td colspan="2" ><br>
	
	<select name="hauteur" size=1 onChange='affecttaille(this.value)' >
		<?php print $option ?>
		<option value="4" id='select1'>04</option>
		<option value="5" id='select1'>05</option>
		<option value="5.5" id='select1'>05.5</option>
		<option value="6" id='select1'>06</option>
		<option value="7" id='select1'>07</option>
		<option value="8" id='select1'>08</option>
		<option value="9" id='select1' >09</option>
		<option value="10" id='select1'>10</option>
		<option value="11" id='select1'>11</option>
		<option value="12" id='select1'>12</option>
		<option value="13" id='select1'>13</option>
		<option value="14" id='select1'>14</option>
		<option value="15" id='select1'>15</option>
	</select>
	 </td>
    </tr>
</form>


</table>

<script>
function affecttaille(val) {
	document.getElementById('hauteur1').value=val;
	document.getElementById('hauteur2').value=val;
	document.getElementById('hauteur3').value=val;
	document.getElementById('hauteur4').value=val;
	document.getElementById('hauteur5').value=val;
	document.getElementById('hauteur6').value=val;
}

</script>

			
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