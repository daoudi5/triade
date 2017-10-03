<?php
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin               &nbsp;:&nbsp;Janvier 2000
 *   copyright           &nbsp;:&nbsp;(C) 2000 E. TAESCH - T. TRACHET - 
 *   Site                &nbsp;:&nbsp;http://www.triade-educ.com
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

validerequete("menuadmin");
// Sn&nbsp;:&nbsp;variable de Session nom
// Sp&nbsp;:&nbsp;variable de Session prenom
// Sm&nbsp;:&nbsp;variable de Session membre
// Spid&nbsp;:&nbsp;variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$idpers=$mySession[Spid];
?>


<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGMODIF4 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='recherche_eleve.php' ><?php print LANGPER30 ?></a></li>
				<li style="visibility:visible" ><a href='suppression_compte_eleve.php' ><?php print LANGBT50 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php
//debut if pour affichage ou non du formulaire
if(!isset($_POST["update"])):
?>

<?php
$eid=$_GET["eid"];
// récupération des données pour les mettres dans les values des champs du formulaire
$sql=<<<EOF

SELECT
        elev_id,
        trim(nom),
        trim(prenom),
        trim(classe),
        trim(lv1),
        trim(lv2),
        trim(`option`),
        trim(regime),
        date_naissance,
	trim(nationalite),
        trim(passwd),
	trim(passwd_eleve),
	trim(civ_1),
        trim(nomtuteur),
        trim(prenomtuteur),
        trim(adr1),
        trim(code_post_adr1),
	trim(commune_adr1),
	trim(civ_2),
	trim(nom_resp_2),
	trim(prenom_resp_2),
        trim(adr2),
        trim(code_post_adr2),
        trim(commune_adr2),
        trim(telephone),
        trim(profession_pere),
        trim(tel_prof_pere),
        trim(profession_mere),
        trim(tel_prof_mere),
        trim(nom_etablissement),
        trim(numero_etablissement),
        trim(code_postal_etablissement),
        trim(commune_etablissement),
	trim(numero_eleve),
	trim(email),
	trim(email_eleve),
	c.libelle,
        trim(class_ant),
	annee_ant,
	trim(tel_eleve),
	trim(lieu_naissance),
	trim(tel_port_1),
	trim(tel_port_2),
	email_resp_2,
	sexe,
	code_compta,
	information,
	adr_eleve,
	commune_eleve,
	ccp_eleve,
	tel_fixe_eleve,
	pays_eleve,
	boursier,
	montant_bourse,
	indemnite_stage,
	nbmoisindemnite,
	emailpro_eleve,
	rangement,
	cdi,
	bde,
	situation_familiale
	
FROM
        ${prefixe}eleves, ${prefixe}classes c
WHERE
        elev_id='$eid'
AND     c.code_class=classe

EOF;
$res=execSql($sql);
$data=chargeMat($res);

/*
0 elev_id,
1 trim(nom),
2 trim(prenom),
3  trim(classe),
4  trim(lv1),
5  trim(lv2),
6  trim(option),
7  trim(regime),
8  date_naissance,
9  trim(nationalite),
10 trim(passwd),
11 trim(passwd_eleve),
12 trim(civ_1),
13 trim(nomtuteur),
14 trim(prenomtuteur),
15 trim(adr1),
16 trim(code_post_adr1),
17 trim(commune_adr1),
18 trim(civ_2),
19 trim(nom_resp_2),
20 trim(prenom_resp_2),
21 trim(adr2),
22 trim(code_post_adr2),
23 trim(commune_adr2),
24 trim(telephone),
25 trim(profession_pere),
26 trim(tel_prof_pere),
27 trim(profession_mere),
28 trim(tel_prof_mere),
29 trim(nom_etablissement),
30 trim(numero_etablissement),
31 trim(code_postal_etablissement),
32 trim(commune_etablissement),
33 trim(numero_eleve),
34 trim(email),
35 trim(email_eleve),
36 c.libelle,
37 trim(class_ant),
38 annee_ant,
39 tel_eleve
40 lieu_naissance,
41 tel_port_1,
42 tel_port_2,
43 email_tuteur_2
44 sexe
45 code_compta
46 Information
47 adr_eleve
48 commune_eleve
49 ccp_eleve
50 tel_fixe_eleve
51 pays
52 boursier,
53 montant_bourse,
54 indemnite_stage
55 nbmoisindemnite
56 emailpro_eleve
57 rangement
58 cdi
59 bde
60 situation_familiale
*/
?>


<form method=post onsubmit="return valide_modif_eleve()" name="formulaire" >
<TABLE border="0" >

<tr>
	<td colspan=2 >
		<div align="left">
			<font color="#CC0000"><?php print LANGMODIF2?> </FONT>
		</div>
	</td>
</tr>
<tr>
	<td>
		<div align="right"><?php print LANGEL1?>&nbsp; :&nbsp;</div>
	</td>
        <td>
		<input type="text" name="saisie_nom" value="<?php print $data[0][1]?>"  size=19 >
	</td>
</tr>
    <tr>
	<td><div align="right"><?php print LANGEL2?> &nbsp;:&nbsp;  </div></td>
        <td><input type="text" name="saisie_prenom" value="<?php print $data[0][2]?>"   size=19></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL3?>&nbsp;:&nbsp;</div></td>
        <td><input type=hidden readonly name="saisie_classe" value='<?php print $data[0][3]?>'>
	    <input type=text readonly  value='<?php print chercheClasse_nom($data[0][3])?>' readonly style="font-family: Arial;font-size:12px;color:#000000;background-color:#CCCCCC;font-weight:bold;border:0px;padding:5px" size=16 >
        </td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL4."/Spe" ?>&nbsp;:&nbsp;</div></td>
        <td>
        <select name="saisie_lv1" size="1">
			<option selected value="<?php print $data[0][4]?>" ><?php print $data[0][4]?></option>
		<?php
		select_matiere_pour_lvo(); // creation des options
		?><option value=''></option>
            </select>
        </td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL5."/Spe" ?>&nbsp;:&nbsp;</div></td>
        <td>
         <select name="saisie_lv2" size="1">
					<option selected value="<?php print $data[0][5]?>" ><?php print $data[0][5]?></option>
				<?php
				select_matiere_pour_lvo(); // creation des options
				?><option value=''></option>
            </select>
       </td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL6?>&nbsp;:&nbsp;</div></td>
      <td>
	<select name="saisie_option" size="1">
		<option selected value="<?php print $data[0][6]?>" ><?php print $data[0][6]?></option>		
		<?php
		select_matiere_pour_lvo(); // creation des options
		?>
	</select>
      </td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL7?>&nbsp;:&nbsp;</div></td>
	<td>
	<select name="saisie_regime" >
		<?php if ($data[0][7] != "") { print "<option value='".$data[0][7]."' id='select0' >".$data[0][7]."</option>"; } ?>
		<option value="" id='select0' ><?php print LANGCHOIX ?></option>
		<option value="Interne"  id='select1'  ><?php print LANGELE7 ?></option>
		<option value="Demi-pension"  id='select1'  ><?php print LANGELE8 ?></option>
		<option value="Externe"  id='select1' ><?php print LANGELE9 ?></option>
		<optgroup label="Personnalisé">
		<?php
			selectRegime();
		?>
	</select> [<a href="regime_ajout.php">ajouter</a>]

	</td>
      </tr>

 <tr><td><div align="right"><?php print "Rangement / Info."?>&nbsp;:&nbsp;</div></td>
        <td><input type="text" name="saisie_rangement"  maxlength='200' value='<?php print $data[0][57]?>' >
    </td></tr>


<?php 
	if (trim($data[0][44]) == "m") { $checkedM="checked='checked'"; $checkedF=""; }
	if (trim($data[0][44]) == "f") { $checkedF="checked='checked'"; $checkedM=""; }
     ?>
    <tr><td><div align="right"><?php print "Sexe"?>&nbsp;:&nbsp;</div></td>
    <td> M <input type="radio" name="saisie_sexe"  value="m" <?php print $checkedM ?> > -  F <input type="radio" name="saisie_sexe"  value="f" <?php print $checkedF ?>>
    </td></tr>

<?php 
	if (trim($data[0][52]) == "1") { $checkedOui="checked='checked'"; $checkedNon=""; }
	if (trim($data[0][52]) == "0") { $checkedNon="checked='checked'"; $checkedOui=""; }
     ?>
<!--    <tr><td><div align="right"><?php print "Boursier"?>&nbsp;:&nbsp;</div></td>
    <td> Oui <input type="radio" name="saisie_boursier"  value="1" <?php print $checkedOui ?> > -  Non <input type="radio" name="saisie_boursier"  value=0" <?php print $checkedNon ?>>
    </td></tr>
    <tr><td><div align="right"><?php print "Inscription au BDE"?>&nbsp;:&nbsp;</div></td>
<?php 
	if (trim($data[0][59]) == "1") { $checkedBDEOui="checked='checked'"; $checkedBDENon=""; }
	if (trim($data[0][59]) == "0") { $checkedBDENon="checked='checked'"; $checkedBDEOui=""; }
     ?>
    <td> Oui <input type="radio" name="saisie_bde"  value="1" <?php print $checkedBDEOui ?> > -  Non <input type="radio" name="saisie_bde"  value=0" <?php print $checkedBDENon ?>>
    </td></tr>
    <tr><td><div align="right"><?php print "Inscription à la bibliothèque"?>&nbsp;:&nbsp;</div></td>
<?php 
	if (trim($data[0][58]) == "1") { $checkedCDIOui="checked='checked'"; $checkedCDINon=""; }
	if (trim($data[0][58]) == "0") { $checkedCDINon="checked='checked'"; $checkedCDIOui=""; }
     ?>
    <td> Oui <input type="radio" name="saisie_cdi"  value="1" <?php print $checkedCDIOui ?> > -  Non <input type="radio" name="saisie_cdi"  value=0" <?php print $checkedCDINon ?>>
    </td></tr>
<tr><td><div align="right"><?php print "Montant de la bourse" ?>: </div></td>
        <td><input type="text" name="saisie_montant_bourse" value="<?php print affichageFormatMonnaie($data[0][53]) ?>"   ></td>
    </tr>
-->
<tr><td><div align="right"><?php print "Indemnité de stage" ?>: </div></td>
	<td><input type="text" name="saisie_indemnite_stage" value="<?php print affichageFormatMonnaie($data[0][54]) ?>"  size=4 >
	par mois. Nb mois&nbsp;:&nbsp;<input type="text" name="saisie_nbmoisindemnite_stage" value="<?php print $data[0][55] ?>" size=2  >
</td>
    </tr>

    <tr><td><div align="right"><?php print LANGEL8?>&nbsp;:&nbsp;</div></td>
        <td><input type="text" name="saisie_date_naissance" value="<?php print dateForm($data[0][8])?>">
     <?php
	include_once("../librairie_php/calendar.php");
	calendarVATEL('id1','document.formulaire.saisie_date_naissance',$_SESSION["langue"],"1");
	?>
	</td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL9?>: </div></td>
        <td><input type="text" name="saisie_nationalite" value="<?php print $data[0][9]?>"  maxlength='20' ></td>
    </tr>
<tr><td><div align="right"><?php print LANGEDIT6 ?>&nbsp;:&nbsp;</div></td>
        <td><input type="text" name="saisie_lieunais" value="<?php print $data[0][40]?>" maxlength='40' >
    </td></tr>
    
       <tr><td><div align="right"><?php print ucwords(LANGIMP52) ?>:</div></td>
	         <td><input type=button onclick="open('modif_eleve_pass_eleve.php?ideleve=<?php print $eid;?>','pass','width=450,height=350')" value='<?php print LANGELE30 ?>' class='btn btn-primary btn-sm  vat-btn-footer'  >
	     </td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL30?> :</div></td>
         <td><input type="passwd" name="saisie_numnational" value="<?php print $data[0][33]?>" maxlength=20  <?php if (AUTOINE == "oui") print "readonly='readonly' style='font-family: Arial;font-size:10px;color:#000000;background-color:#CCCCCC;font-weight:bold;' " ?>  >  
	<?php if (AUTOINE == "oui") print "(<a title='Modification possible via le module de \"Config G&eacute;n&eacute;rale\" du compte administrateur Triade.'>Num&eacute;ro automatis&eacute;</a>)"; ?>
	</td>
    </tr>

<!-- <tr><td><div align="right"><?php print "Code comptabilité " ?> :</div></td>
         <td><input type="text" name="saisie_codecompta" maxlength=30   value="<?php print $data[0][45]?>" ></td>
    </tr>
-->
<tr><td><div align="right"><?php print "Adresse" ?>&nbsp;:&nbsp;</div></td>
        <td><input type="text" name="saisie_adr_eleve" size="30"  maxlength=100  value="<?php print $data[0][47]?>" ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGELE15?> &nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_code_post_adr_eleve" size="30"  maxlength=15  value="<?php print $data[0][49]?>"  ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGELE16?> &nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_commune_adr_eleve" size="30"  maxlength=40  value="<?php print $data[0][48]?>"  ></td>
    </tr>
<tr><td><div align="right"><?php print "Pays"?> &nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_pays_eleve" size="30"  maxlength=50  value="<?php print $data[0][51]?>"  ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL21 ?> &nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_tel_fixe_eleve" size="30"  maxlength=25  value="<?php print $data[0][50]?>"  ></td>
    </tr>


<tr><td><div align="right"><?php print LANGEDIT20." ".LANGTITRE40 ?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_portable_eleve"  maxlength=18 value="<?php print $data[0][39]?>" ></td>
    </tr>
 <tr><td><div align="right"><?php print LANGELE244." ".LANGTITRE40?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_email_eleve"  id="saisie_email_eleve" maxlength='150' size='30' value="<?php print $data[0][35]?>" onBlur="verifMailExist(this.value,'rtaff1','saisie_email_eleve','<?php print $eid ?>')"  ><span id='rtaff1'></span></td>
    </tr>
 <tr><td><div align="right"><?php print LANGELE244." "."Universitaire"?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_emailpro_eleve"  id="saisie_emailpro_eleve" maxlength='150' size='30' value="<?php print $data[0][56]?>" onBlur="verifMailExist(this.value,'rtaff2','saisie_emailpro_eleve','<?php print $eid ?>')"  ><span id='rtaff2'></span></td>
    </tr>
<tr><td><div align="right"><?php print "Information"?> <?php print LANGTITRE40?>&nbsp;:&nbsp; </div></td>
      <td><textarea name="saisie_info_eleve"  cols=40 rows=3><?php print ereg_replace('<br />','',nl2br($data[0][46]))?></textarea></td>
    </tr>



   <tr><td colspan=2 ><div align="left">
<font color="#CC0000"><?php print LANGMODIF3 ?></font></div></td></tr>

   <tr><td><div align="right"><?php print "Situation Familiale"?>&nbsp;:&nbsp;</div></td>
      <td><select name='situation_familiale'>
	   <option id='select1' value=''></option>
	   <option id='select1' value='<?php print LANGSITU1 ?>' <?php if ($data[0][60] == LANGSITU1) print "selected='selected'" ?> ><?php print LANGSITU1 ?></option>
	   <option id='select1' value='<?php print LANGSITU2 ?>' <?php if ($data[0][60] == LANGSITU2) print "selected='selected'" ?> ><?php print LANGSITU2 ?></option>
	   <option id='select1' value='<?php print LANGSITU3 ?>' <?php if ($data[0][60] == LANGSITU3) print "selected='selected'" ?> ><?php print LANGSITU3 ?></option>
	   <option id='select1' value='<?php print LANGSITU4 ?>' <?php if ($data[0][60] == LANGSITU4) print "selected='selected'" ?> ><?php print LANGSITU4 ?></option>
	   <option id='select1' value='<?php print LANGSITU5 ?>' <?php if ($data[0][60] == LANGSITU5) print "selected='selected'" ?> ><?php print LANGSITU5 ?></option>
	   <option id='select1' value='<?php print LANGSITU6 ?>' <?php if ($data[0][60] == LANGSITU6) print "selected='selected'" ?> ><?php print LANGSITU6 ?></option>
	   <option id='select1' value='<?php print LANGSITU7 ?>' <?php if ($data[0][60] == LANGSITU7) print "selected='selected'" ?> ><?php print LANGSITU7 ?></option>

	  </select></td>
    </tr>


<tr><td align=right >Civ 1&nbsp;:&nbsp;</td><td>
<select name="saisie_civ1" >
<?php 
	if (trim($data[0][12]) != "") {
		print "<option value='".$data[0][12]."' >".civ($data[0][12])."</option>";
	}

	listingCiv() 
?>
</select>
</td></tr>
   <tr><td><div align="right"><?php print LANGEL11?>&nbsp;:&nbsp;</div></td>
       <td><input type="text" name="saisie_nomtuteur" size="30" value="<?php print $data[0][13]?>" maxlength=30></td>
   </tr>
    <tr><td><div align="right"><?php print LANGEL12?>&nbsp;:&nbsp; </div></td>
        <td><input type="text" name="saisie_prenomtuteur" size="30" value="<?php print $data[0][14]?>" maxlength=30></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL14?>&nbsp;:&nbsp;</div></td>
        <td><input type="text" name="saisie_adr1" size="30" value="<?php print $data[0][15]?>" maxlength=100></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL15?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_code_post_adr1" size="30" value="<?php print $data[0][16]?>" maxlength=15></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL16?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_commune_adr1" size="30" value="<?php print $data[0][17]?>" maxlength=40></td>
    </tr>
<tr><td><div align="right"><?php print LANGEDIT2 ?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_tel_port_1" size="30" value="<?php print $data[0][41]?>" maxlength=25 ></td>
    </tr>
 <tr><td><div align="right"><?php print LANGELE244?> 1&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_email" id="saisie_email" size="30" value="<?php print $data[0][34]?>" maxlength=150 onBlur="verifMailExist(this.value,'rtaff3','saisie_email','<?php print $eid ?>')"  ><span id='rtaff3'></span></td>
    </tr>
 <tr><td><div align="right"><?php print ucwords(LANGIMP51) ?> 1 :</div></td>
<td><input type=button onclick="open('modif_eleve_pass.php?ideleve=<?php print $eid;?>','pass','width=400,height=350')" value='<?php print LANGELE30 ?>' class='btn btn-primary btn-sm  vat-btn-footer'  >
     </td>
    </tr> 

<tr><td align=right >Civ 2&nbsp;:&nbsp;</td><td>
<select name="saisie_civ2" >
<?php 
	if (trim($data[0][18]) != "") {
		print "<option value='".$data[0][12]."' >".civ($data[0][18])."</option>";
	}
	listingCiv() ?>
</select>
</td></tr>
<tr><td width="50%" ><div align="right"><?php print LANGEDIT4?> &nbsp;:&nbsp;</div></td>
       <td><input type="text" name="saisie_nomtuteur2" size="30" value="<?php print $data[0][19]?>" maxlength=30 ></td>
   </tr>
    <tr><td><div align="right"><?php print LANGEDIT5?>&nbsp;:&nbsp; </div></td>
        <td><input type="text" name="saisie_prenomtuteur2" size="30"  maxlength=50 value="<?php print $data[0][20]?>" ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL18?>&nbsp;:&nbsp;</div></td>
        <td><input type="text" name="saisie_adr2" size="30" value="<?php print $data[0][21]?>" maxlength=100></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL19?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_code_post_adr2" size="30" value="<?php print $data[0][22]?>" maxlength=15></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL20?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_commune_adr2" size="30" value="<?php print $data[0][23]?>" maxlength=40></td>
</tr>
<tr><td><div align="right"><?php print LANGEDIT9 ?> &nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_tel_port_2" size="30"  value="<?php print $data[0][42]?>" maxlength=25 ></td>
    </tr>
 <tr><td><div align="right"><?php print LANGELE244?> 2&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_email_2" id='saisie_email_2' size="30" value="<?php print $data[0][43]?>" maxlength=150 onBlur="verifMailExist(this.value,'rtaff4','saisie_email_2','<?php print $eid ?>')"  ><span id='rtaff4'></span></td>
    </tr>
 <tr><td><div align="right"><?php print ucwords(LANGIMP51) ?> 2 :</div></td>
<td><input type=button onclick="open('modif_eleve_pass.php?ideleve=<?php print $eid;?>&p2=P2','pass','width=400,height=350')" value='<?php print LANGELE30 ?>' class='btn btn-primary btn-sm  vat-btn-footer'  >
     </td>
    </tr> 

    <tr><td><div align="right"><?php print LANGEL21?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_telephone" size="30" value="<?php print $data[0][24]?>" maxlength='18' ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL22?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_profession_pere" size="30" value="<?php print $data[0][25]?>" maxlength='30' ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL23?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_tel_prof_pere" size="30" value="<?php print $data[0][26]?>" maxlength='18' ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL24?>&nbsp;:&nbsp;</div></td>
      <td><input type="text" name="saisie_profession_mere" size="30" value="<?php print $data[0][27]?>" maxlength='30' ></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL25?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_tel_prof_mere" size="30" value="<?php print $data[0][28]?>" maxlength='18' ></td>
    </tr>
 
   <tr><td colspan=2  ><div align="left">
<font color="#CC0000"><?php print ucwords(LANGELE25) ?> </font></div></td></tr>
    <tr><td><div align="right">Etablissement :</div></td>
          <td><input type="text" name="saisie_nom_etablissement" size="30" value="<?php print $data[0][29]?>" maxlength=30></td>
    </tr>
    <tr><td><div align="right"><?php print LANGELE27 ?> :</div></td>
      <td><input type="text" name="saisie_numero_etablissement" size="30" value="<?php print $data[0][30]?>" maxlength=30></td>
    </tr>
    <tr><td><div align="right"><?php print LANGbasededoni41 ?>&nbsp;:&nbsp;</div></td>
	      <td><input type="text" name="saisie_classe_ant" size="30" value="<?php print $data[0][37]?>" maxlength=30></td>
    </tr>
    <tr><td><div align="right"><?php print LANGbasededoni42 ?>&nbsp;:&nbsp; </div></td>
	        <td><input type="text" name="saisie_annee_ant" size="30" value="<?php print $data[0][38]?>">
		</td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL28 ?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_code_postal_etablissement" size="30" value="<?php print $data[0][31]?>" maxlength=6></td>
    </tr>
    <tr><td><div align="right"><?php print LANGEL29 ?>&nbsp;:&nbsp; </div></td>
      <td><input type="text" name="saisie_commune_etablissement" size="30" value="<?php print $data[0][32]?>" maxlength=30></td>
    </tr>

<tr><td colspan='2' align='center'> <br><br><script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGABS45?>","update");</script></td></tr>
</table>
</form>
<?php
// fin du if pour affichage ou non du formulaire
endif;
?>

<?php
if(isset($_POST["update"])):
	$eid=$_GET["eid"];

	// création du tableau de hash contenant les paramètres de la fonction modif_eleve
	$params[ne]=		strtolower($_POST["saisie_nom"]);
	$params[pe]=		$_POST["saisie_prenom"];
	$params[ce]=		$_POST["saisie_classe"];
	$params[lv1]=		strtolower($_POST["saisie_lv1"]);
	$params[lv2]=		strtolower($_POST["saisie_lv2"]);
	$params[option]=	strtolower($_POST["saisie_option"]);
	$params[regime]=	strtolower($_POST["saisie_regime"]);
	$params[naiss]=		$_POST["saisie_date_naissance"];
	$params[nat]=		strtolower($_POST["saisie_nationalite"]);
	$params[nt]=		$_POST["saisie_nomtuteur"];
	$params[pt]=		$_POST["saisie_prenomtuteur"];
	$params[adr1]=		$_POST["saisie_adr1"];
	$params[cpadr1]=	$_POST["saisie_code_post_adr1"];
	$params[commadr1]=	$_POST["saisie_commune_adr1"];
	$params[adr2]=		$_POST["saisie_adr2"];
	$params[cpadr2]=	$_POST["saisie_code_post_adr2"];
	$params[commadr2]=	$_POST["saisie_commune_adr2"];
	$params[tel]=		$_POST["saisie_telephone"];
	$params[profp]=		$_POST["saisie_profession_pere"];
	$params[telprofp]=	$_POST["saisie_tel_prof_pere"];
	$params[profm]=		$_POST["saisie_profession_mere"];
	$params[telprofm]=	$_POST["saisie_tel_prof_mere"];
	$params[nomet]=		$_POST["saisie_nom_etablissement"];
	$params[numet]=		$_POST["saisie_numero_etablissement"];
	$params[cpet]=		$_POST["saisie_code_postal_etablissement"];
	$params[commet]=	$_POST["saisie_commune_etablissement"];
	$params[numero_eleve]=	$_POST["saisie_numnational"];
	$params[email]=		$_POST["saisie_email"];
	$params[classe_ant]=	$_POST["saisie_classe_ant"];
	$params[annee_ant]=	$_POST["saisie_annee_ant"];
	$params[civ1]=		$_POST["saisie_civ1"];
	$params[civ2]=		$_POST["saisie_civ2"];
	$params[tel_eleve]=	$_POST["saisie_portable_eleve"];
	$params[mail_eleve]=	$_POST["saisie_email_eleve"];
	$params[mailpro_eleve]=	$_POST["saisie_emailpro_eleve"];
	$params[nom_resp2]=	$_POST["saisie_nomtuteur2"];
	$params[prenom_resp2]=	$_POST["saisie_prenomtuteur2"];
	$params[lieunais]=	$_POST["saisie_lieunais"];
	$params[tel_port_1]=	$_POST["saisie_tel_port_1"];
	$params[tel_port_2]=	$_POST["saisie_tel_port_2"];
	$params[email_2]=	$_POST["saisie_email_2"];
	$params[codecompta]=    $_POST["saisie_codecompta"];
	$params[sexe]=    	$_POST["saisie_sexe"];
	$params[information]=  	$_POST["saisie_info_eleve"];
	$params[adr_eleve]= 	$_POST["saisie_adr_eleve"];
	$params[commune_eleve]= $_POST["saisie_commune_adr_eleve"];
	$params[ccp_eleve]= 	$_POST["saisie_code_post_adr_eleve"];
	$params[tel_fixe_eleve]=$_POST["saisie_tel_fixe_eleve"];
	$params[pays_eleve]=    $_POST["saisie_pays_eleve"];
	$params[boursier]=	$_POST["saisie_boursier"];
	$params[boursier_montant]=$_POST["saisie_montant_bourse"];
	$params[indemnite_stage]=$_POST["saisie_indemnite_stage"];
	$params[nbmoisindemnite_stage]=$_POST["saisie_nbmoisindemnite_stage"];
	$params[rangement]=$_POST["saisie_rangement"];
	$params[cdi]=$_POST["saisie_cdi"];
	$params[bde]=$_POST["saisie_bde"];
	$params[situation_familiale]=$_POST["situation_familiale"];

	// trim et strtolower des values du hash params
	foreach($params as $key => $value) {
		strtolower($value);
		trim($value);
	}

	$cr=modif_eleve($eid,$params);

        if($cr):
            alertJs(LANGALERT1);
			$nomElve=strtolower($_POST["saisie_nom"]);
			history_cmd($_SESSION["nom"],"Modification","Elève: $nomElve");
        endif;
endif;
?>

<?php
// si mise à jour on affiche les données modifiées via un reload vers consult_eleve.php
if($cr) {
	print("<script>window.location.replace('edit_eleve.php?eid=$eid');</script>");
}
?>

     <!-- // fin  -->
			
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
