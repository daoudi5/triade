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
			<span class="vat-capitalize-title"><?php print LANGSTAGE19." / ".LANGVATEL220 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_visu.php' ><?php print LANGVATEL220 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_aj.php' ><?php print LANGVATEL219 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_modif.php' ><?php print LANGVATEL222 ?></a></li>
				<li style="visibility:visible" ><a href='gestion_stage_date_supp.php' ><?php print LANGVATEL223 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">		

		<script language="JavaScript">

// variable globale signalant une erreur
var errfound = false;
//fonction de validation d'après la longueur de la chaîne
function Validlongueur(item,len) {
   return (item.length >= len);
}

// affiche un message d'alerte
function error9(elem, text) {
// abandon si erreur déjà signalée
   if (errfound) return;
   window.alert(text);
   elem.select();
   elem.focus();
   errfound = true;
}

function Validdate(nom) {
        var dernier = nom.lenght ;
        var slach1  = nom.charAt(2);
        var slach2  = nom.charAt(5);
        var jour = nom.substring(0,2);
        var mois = nom.substring(3,5);
        var caractere= nom.charAt(6);
        if (isNaN(caractere)) { return false }
        var annee = nom.substring(6,10);
        if (isNaN(jour)) { return false }
        if (isNaN(mois)) { return false }
        if (isNaN(annee)) { return false }
        if ((annee > 9999) || (jour > 31) || (mois > 12) || (slach1 != '/') || (slach2 != '/') ){
                return false
        }
        else {

                return true
        }
}
// affiche un message d'alerte
function error2(text) {
// abandon si erreur déjà signalée
   if (errfound) return;
   window.alert(text);
   errfound = true;
}


// validation d'un champ de select
function Validselect(item){
 if (item == 0) {
        return (false) ;
 }else {
        return (true) ;
        }
}

function ValiddatePeriode(datedebut,datefin) {
	var jour = datedebut.substring(0,2);
        var mois = datedebut.substring(3,5);
        var annee = datedebut.substring(6,10);
	var datedebut=annee+""+mois+""+jour;
 	var jour = datefin.substring(0,2);
        var mois = datefin.substring(3,5);
        var annee = datefin.substring(6,10);
	var datefin=annee+""+mois+""+jour;     
	if (datedebut > datefin) {
		return(false)
	}else{
		return(true);
	}
}

function validedatestage() {
errfound = false;
if (document.formulaire.num.value.length < 1) {
	error9(document.formulaire.num,"<?php print LANGSTAGE97 ?>  \n\n Service Triade ");
}
if (isNaN(document.formulaire.num.value)) {
	error9(document.formulaire.num,"<?php print LANGSTAGE97 ?>    \n\n Service TRIADE ");
}
if (!Validdate(document.formulaire.debutdate.value)) {
	error9(document.formulaire.debutdate,"<?php print LANGSTAGE98 ?> \n\n Service TRIADE"); }
if (!Validdate(document.formulaire.findate.value)) {
	error9(document.formulaire.findate,"<?php print LANGSTAGE99 ?> \n\n Service TRIADE"); }
if (!ValiddatePeriode(document.formulaire.debutdate.value,document.formulaire.findate.value)) {
	error2("<?php print LANGVATEL221 ?> \n\n Service TRIADE"); }
if (!Validselect(document.formulaire.saisie_classe.options.selectedIndex)) {
      error2(langfunc11);
}
return !errfound; /* vrai si il ya pas d'erreur */
}
</script>
<?php
validerequete("2");
?>
<br>
<ul>
<font class=T2>
<form method=post onsubmit="return validedatestage()" name="formulaire">
<?php print LANGSTAGE48 ?>&nbsp;:&nbsp;<select name="num">
<?php if ($numstage != '') {
	print "<option value='$numstage' id='select0'>$numstage</option>";
} 
?>
			<option value='' id='select0'></option>		
			<?php 
			for ($i=0;$i<=30;$i++) {
			    print "<option value='$i' id='select1'>$i</option>";
			}
			?>
</select><br><br>
<?php print LANGTMESS520 ?> : <input type=text name="nom_stage" size=30 value='<?php print $nomstage; ?>' maxlength="50" ><br><br>
<?php print LANGSTAGE45 ?> : <input type=text name="debutdate" size=12 value='<?php print $datedebut; ?>' class=bouton2 onKeyPress="onlyChar(event)" maxlength='10' > </font>
<?php
 include_once("../librairie_php/calendar.php");
 calendarVATEL("id1","document.formulaire.debutdate",$_SESSION["langue"],"0");
?>
<br><br>
<font class='T2'>
<?php print LANGSTAGE46 ?> : <input type=text name="findate" size=12 value='<?php print $datefin; ?>' class=bouton2 onKeyPress="onlyChar(event)" maxlength='10' > </font>
<?php
 calendarVATEL("id2","document.formulaire.findate",$_SESSION["langue"],"0");
?>
<br><br>
<font class='T2'>
<?php print LANGELE4 ?> : </font><select name="saisie_classe">
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX?></option>
<?php
select_classe(); // creation des options
?>
</select><br />

<br>
<font class='T2'>
<?php print LANGTMESS521 ?> </font>
<input type=checkbox name="jourstage[]" value="1"  id="j1"  checked='checked' style="float:none" /> L / M -
<input type=checkbox name="jourstage[]" value="2"  id="j2"  checked='checked' style="float:none" /> M / T -
<input type=checkbox name="jourstage[]" value="3"  id="j3"  checked='checked' style="float:none" /> M / W -
<input type=checkbox name="jourstage[]" value="4"  id="j4"  checked='checked' style="float:none" /> J / T -
<input type=checkbox name="jourstage[]" value="5"  id="j5"  checked='checked' style="float:none" /> V / F -
<input type=checkbox name="jourstage[]" value="6"  id="j6"  checked='checked' style="float:none" /> S / S -
<input type=checkbox name="jourstage[]" value="7"  id="j7"  checked='checked' style="float:none" /> D / S

<br /><br /><br />
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGSTAGE47 ?>","create"); //text,nomInput</script>
<br><br>
</form>
</ul>
<?php
if (isset($_POST["create"])) {
	$cr=stage_ajout($_POST["num"],$_POST["debutdate"],$_POST["findate"],$_POST["saisie_classe"],$_POST["nom_stage"],$_POST["jourstage"]);
	if($cr){
        history_cmd($_SESSION["nom"],"CREATION","date de stage");
        print "<font color='red' class='T2' ><br><br><center>Le stage du ".$_POST["debutdate"]." au ";
		print $_POST["findate"]." <br> pour la classe de ".chercheClasse_nom($_POST["saisie_classe"]) ;
		print " est enregistré.";
		print "</center></font><br><br>";
	}
}
?>
</font>



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