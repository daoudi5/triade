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
	
<br />
<ul><font class=T2><?php print LANGVATEL199 ?></font></ul>
<br />

<form method="post" action="export_eleve_2.php" >
<table border='0' width="100%" bordercolor='#000000' >
<tr>
<td id='bordure' class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'" >
	<input type="checkbox" name="liste[]" value='nom' > <?php print LANGELE2 ?> <?php print INTITULEELEVE ?>  </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='prenom' > prénom <?php print INTITULEELEVE ?>  </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='classe' > classe  </td>
<td id='bordure'  class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='date_naissance' > date naissance  </td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='adresse_eleve' ><?php print LANGVATEL175 ?></td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='ccp_eleve' ><?php print LANGVATEL177 ?></td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='commune_eleve' ><?php print LANGVATEL176 ?></td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='pays_eleve' ><?php print LANGAGENDA73 ?> <?php print INTITULEELEVE ?></td>
</tr>


<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='sexe' > sexe  </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='lieu_naissance' > lieu naissance </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='nationalite' > Nationalité  </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='numero_eleve' > INE - N° <?php print INTITULEELEVE ?>  </td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='regime' > régime </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='lv1' > langue vivant 1 </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='lv2' > langue vivant 2 </td>
<td id='bordure'  class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='option' > Option </td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='civ_1' > Civ. tuteur 1 </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='nomtuteur' > nom tuteur 1 </td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='prenomtuteur' > prénom tuteur 1</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='adr1' >adr. tuteur 1</td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='code_post_adr1' >CCP tuteur 1</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='commune_adr1' >commune tuteur 1</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_port_1' >Tél. port. tuteur 1</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='email' > Email tuteur 1 </td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='civ_2' >Civ. tuteur 2</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='nomtuteur_2' >nom tuteur 2</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='prenomtuteur_2' >prénom tuteur 2</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='adr2' >adr. tuteur 2</td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='code_post_adr2' > CCP tuteur 2</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='commune_adr2' >commune tuteur 2</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_port_2' >Tél. port. tuteur 2</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='email_resp_2' >Email tuteur 2</td>
</tr>


<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='telephone' >Téléphone</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_eleve' >Tél. port. <?php print INTITULEELEVE ?></td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='profession_pere' >Prof. Père</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_prof_pere' >Tél. Prof. Père</td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='profession_mere' >Prof. Mère</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_prof_mere' >Tél. Prof. Mère</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='class_ant' >Classe antérieur</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='nom_etablissement' >Nom établi.</td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='numero_etablissement' >N° établi.</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='code_postal_etablissement' >CCP établi.</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='commune_etablissement' >commune établi.</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='code_barre' >Code barre</td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='email_eleve' >Email <?php print INTITULEELEVE ?></td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='email_eleve_pro' >Email <?php print INTITULEELEVE ?> Univ.</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='annee_scolaire' >Année scolaire.</td>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='information' >Informations.</td>
</tr>

<tr>
<td id='bordure'   class="tabnormal2" onmouseover="this.className='tabover'" onmouseout="this.className='tabnormal2'">
	<input type="checkbox" name="liste[]" value='tel_fixe_eleve' >Tel. Fixe <?php print INTITULEELEVE ?>.</td>
</tr>

</table>
<!--
	/* elev_id,			0
	 * nom, 			1
	 * prenom,			2
	 * classe,			3
	 * lv1,				4
	 * lv2,				5
	 * option,			6
	 * regime,			7
	 * date_naissance,		8
	 * lieu_naissance,		9
	 * nationalite,			10
	 * passwd,			11
	 * passwd_eleve,		12
	 * civ_1,			13
	 * nomtuteur,			14
	 * prenomtuteur,		15
	 * adr1,			16
	 * code_post_adr1,		17
	 * commune_adr1,		18
	 * tel_port_1,			19
	 * civ_2,			20
	 * nom_resp_2,			21
	 * prenom_resp_2,		22
	 * adr2,			23
	 * code_post_adr2,		24
	 * commune_adr2,		25
	 * tel_port_2,			26
	 * telephone,			27
	 * profession_pere,		28
	 * tel_prof_pere,		29
	 * profession_mere,		30
	 * tel_prof_mere,		31
	 * nom_etablissement,		32
	 * numero_etablissement,	33
	 * code_postal_etablissement,	34
	 * commune_etablissement,	35
	 * numero_eleve,		36
	 * photo,			37
	 * email,			38
	 * email_eleve,			39
	 * email_resp_2,		40
	 * class_ant,			41
	 * annee_ant,			42
	 * numero_gep,			43
	 * valid_forward_mail_eleve,	44
	 * valid_forward_mail_parent,	45
	 * tel_eleve,			46
	 * code_compta,			47
	 * sexe 			48
	 */
-->
<br>

<font class=T2> <?php print LANGVATEL197 ?> : <input type=text size=3 name="nbcolplus" value="0" /></font> (<i><?php print LANGVATEL198 ?></i>)
<br><br>
<center><input type="submit" value="<?php print LANGBTS ?>" class='btn btn-primary btn-sm  vat-btn-footer' name="create" /> </center>
</form>

<br />	
	
		
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