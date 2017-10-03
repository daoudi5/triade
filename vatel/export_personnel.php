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
			<span class="vat-capitalize-title"><?php print LANGVATEL167 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param11.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
			
			
<font class=T2><?php print LANGVATEL199 ?></font>
<br />
<br />
<form method="post" action="export_personnel_2.php" >

&nbsp;&nbsp;&nbsp;<font class="T2"><?php print "Type membre " ?>  :</font> <select name="saisie_type">
    <option id='select0' value='0' ><?php print LANGCHOIX?></option>
    <option id='select1' value="ENS" ><?php print "Enseignant"?></option>
    <option id='select1' value="ADM" ><?php print "Direction"?></option>
    <option id='select1' value="TUT" ><?php print "Tuteur de stage"?></option>
    <option id='select1' value="PER" ><?php print "Personnel"?></option>
    <option id='select1' value="MVS" ><?php print "Vie Scolaire"?></option>
</select><br><br><br>



<table border=0 width="100%" bordercolor='#000000' style="-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;padding:5px" >
<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='civ_1' > <?php print LANGEDIT3 ?> </td>
<td id='bordure' class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'" >
	<input type="checkbox" name="liste[]" value='nom' > <?php print LANGELE2 ?>   </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='prenom' > <?php print LANGELE3 ?>   </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='adr1' ><?php print LANGPARAM9 ?></td>
</tr>


<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='code_post_adr1' ><?php print LANGELE15 ?> </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='commune_adr1' ><?php print LANGIMP59 ?> </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_port_1' ><?php print LANGSTAGE34 ?> portable</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='email' > Email  </td>
</tr>


<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='telephone' ><?php print LANGSTAGE34 ?></td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='identifiant' >Identifiant</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='indice_salaire' >Indice salaire</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='code_barre' >Code barre</td>
</tr>


</table>
<br>

<font class=T2> <?php print LANGVATEL197 ?> : <input type=text size=3 name="nbcolplus" value="0" /></font> (<i><?php print LANGVATEL198 ?></i>)
<br><br>
<center><input type="submit" value="<?php print LANGBTS ?>" class='btn btn-primary btn-sm  vat-btn-footer'  name="create" /> </center>
</form>



			
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
