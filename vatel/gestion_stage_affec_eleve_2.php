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
<script language="JavaScript" src="./librairie_js/verif_creat.js"></script>
<script type="text/javascript" src="./librairie_js/prototype.js"></script>
<script type="text/javascript" src="./librairie_js/ajaxStage.js"></script>
<script type="text/javascript" src="./librairie_js/ajax_entreprise_centrale.js"></script>
<script type="text/javascript" src="./librairie_js/xorax_serialize.js" ></script>
<script>
function AffectDateStage(val) {
	var elem = val.split('#||#');
	value= elem[0];
	deb = elem[1];
	fin = elem[2];
	nomstage = elem[3];
	numero = "-"+elem[4];

	// $data[$i][2]."#||#$dateDebut#||#$datefin#||#$nomstage|##|$num

	document.formulaire.debutdate.value=deb;
	document.formulaire.findate.value=fin;
	document.formulaire.num.value=numero;
	document.formulaire.nom_stage.value=nomstage;
}
</script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL216 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param13.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
if (isset($_GET["id"])) {
	$prenom=recherche_eleve_prenom($_GET["id"]);
	$nom=recherche_eleve_nom($_GET["id"]);
}
?>
<form method='post' action="gestion_stage_affec_eleve.php" name="formulaire" onsubmit="return validestageeleve()">
<input type='hidden' name='ideleve' 		value="<?php print $_GET["id"]?>" 		/>
<input type='hidden' name='saisie_classe' 	value="<?php print $_GET["idclasse"]?>" />

<table border="0" align="center" width="100%">
<tr>
<td align=right width='45%' ><font class="T2"><?php print LANGNA1 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type='text' size=30 readonly value="<?php print strtolower($nom)?>"></td>
</tr>
<tr>
<td align=right width='45%' ><font class="T2"><?php print LANGNA2 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type='text' size='30' readonly value="<?php print strtolower($prenom)?>"></td>
</tr>

<tr>
<td align="right"><font class='T2'><?php print LANGVATEL239 ?> &nbsp;:&nbsp;</font></td>
<td    align="left">
<?php 
$p=''; $urlcentrale=''; 
if (file_exists("../common/config.centralStageClient.php")) {
	include_once("../common/config.centralStageClient.php");
	$urlcentrale=URLCENTRALSTAGE;
	$p=PASSCENTRALSTAGE;
	print "<select id='periode' name='periode' onchange=\"AffectDateStage(this.value)\">";
	print "<script src='$urlcentrale/ajaxPeriodeCentraleStage.php?productid=".PRODUCTID."&p=$p' ></script>";
	print "</select>";
}else{
	$data=periodeStageCentralDate(); 
?>
	<select id='periode' name='periode' onchange="AjaxAffectDateStage(this.value,'<?php print $urlcentrale ?>','<?php print $p ?>','<?php print PRODUCTID ?>');document.formulaire.create.disabled=false;document.getElementById('alerte').style.display='none';" >
	<option id='select0' value='0' ><?php print LANGCHOIX ?></option>
	<?php
	for($i=0;$i<count($data);$i++) {
		print "<option id='select1' value='".$data[$i][2]."' >(".$data[$i][3].") ".dateForm($data[$i][0])." - ".dateForm($data[$i][1])."</option>";
	}	
	?>
	</select>
<?php } ?>
	<input type='hidden' id="debutdate" name="debutdate" />
	<input type='hidden' id="findate" 	name="findate" />
	<input type='hidden' id="num" 		name="num" value="" />
	<input type='hidden' id="nom_stage" name="nom_stage" />
	<input type='hidden' id="idclasse" 	name="idclasse" value="<?php print $_GET["idclasse"]?>" />
	</td></tr>

<tr>
<td align=right width=45% valign="top" ><font class="T2"><?php print LANGSTAGE48 ?> &nbsp;:&nbsp;</font></td>
<td align=left valign="top">
<?php
checkbox_stage($_GET["idclasse"]);
?>
</td>
</tr>

<tr>
<td align=right width=45% valign="top" ><font class="T2"><?php print LANGSTAGE108 ?>&nbsp;:&nbsp;</font></td>
<td align=left valign="top">
<input type=checkbox name="alternance" value="1" onclick="checkStage();document.formulaire.create.disabled=false;document.getElementById('alerte').style.display='none';" id="newstage" > oui  ( du <input type='text' name="dateDebutAlternance" size='10' id="debutstage"  disabled='disabled' value="jj/mm/aaaa" onKeyPress="onlyChar(event)" /> au <input type='text' name="dateFinAlternance" id="finstage" size=10  disabled='disabled' value="jj/mm/aaaa" onKeyPress="onlyChar(event)" />)
<br>

<input type='checkbox' name="jourstage[]" value="1" onclick='checkStage()' id="j1"  disabled='disabled' > <?php print LANGL  ?>
<input type='checkbox' name="jourstage[]" value="2" onclick='checkStage()' id="j2"  disabled='disabled' > <?php print LANGM  ?>
<input type='checkbox' name="jourstage[]" value="3" onclick='checkStage()' id="j3"  disabled='disabled' > <?php print LANGME  ?>
<input type='checkbox' name="jourstage[]" value="4" onclick='checkStage()' id="j4"  disabled='disabled' > <?php print LANGJ  ?>
<input type='checkbox' name="jourstage[]" value="5" onclick='checkStage()' id="j5"  disabled='disabled' > <?php print LANGV  ?>
<input type='checkbox' name="jourstage[]" value="6" onclick='checkStage()' id="j6"  disabled='disabled' > <?php print LANGS  ?> 
<input type='checkbox' name="jourstage[]" value="7" onclick='checkStage()' id="j7"  disabled='disabled' > <?php print LANGD  ?> 
</td>
</tr>

<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE74 ?> &nbsp;:&nbsp;</font></td>
<td align=left><table><tr><td>
<select name='ident' onchange="checkList(this.value,'<?php print $urlcentrale ?>','<?php print $p?>','<?php print PRODUCTID ?>')" id='ident' >
<option id='select0'><?php print LANGCHOIX ?></option>
<?php
select_entreprise_limit("25"); 
if (file_exists("../common/config.centralStageClient.php")) {
	print "<optgroup label='Central de Stage'>";
	print "<script src='$urlcentrale/ajaxEntrepriseCentraleStage.php?productid=".PRODUCTID."&p=$p' ></script>";
}
?>
	</select>

	<input type="hidden" name='nom_entreprise_via_central' id='nom_entreprise_via_central' />
	<input type="hidden" name="registrecommerce" id="registrecommerce" >
	<input type="hidden" name="siren" id="siren">
	<input type="hidden" name="siret" id="siret" >
	<input type="hidden" name="formejuridique" id="formejuridique" >
	<input type="hidden" name="secteureconomique" id="secteureconomique" >
	<input type="hidden" name="INSEE" id="INSEE" >
	<input type="hidden" name="NAFAPE" id="NAFAPE" >
	<input type="hidden" name="NACE" id="NACE"  > 
	<input type="hidden" name="typeorganisation" id="typeorganisation" >
	<input type="hidden" name="contact" id="contact"  >
	<input type="hidden" name="fonction" id="fonction"  >
	<input type="hidden" name="adressesiege" id="adressesiege"  >
	<input type="hidden" name="activite" id="activite" >
	<input type="hidden" name="activite2" id="activite2" >
	<input type="hidden" name="activite3" id="activite3" >
	<input type="hidden" name="activiteprin" id="activiteprin" >
	<input type="hidden" name="grphotelier" id="grphotelier"  >
	<input type="hidden" name="nbetoile"  id="nbetoile" >
	<input type="hidden" name="nbchambre" id="nbchambre"  >
	<input type="hidden" name="email" id="email"  >
	<input type="hidden" name="siteweb" id="siteweb"  >
	<input type="hidden" name="information"  id="information" >


	</td><td><a href='gestion_stage_ent_ajout.php?lien=gestion_stage_affec_eleve_2.php&lienideleve=<?php print $_GET["id"]?>&lienidclasse=<?php print $_GET["idclasse"] ?>' ><img src="../image/commun/icone-plus.png" title='Ajouter' border='0' /></a></td></tr></table>
</td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE76 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='lieu' id='lieu' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE29 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=15 name='postal' id='postal' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE30 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='ville' id='ville' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE109 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='pays' id='pays' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE77 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='responsable' id='responsable' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print "Autre ".strtolower(LANGSTAGE77) ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='responsable2' id='responsable2' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGABS38 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='tel' id='tel'></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print "Fax" ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='fax' id='fax'></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE110 ?> &nbsp;:&nbsp;</font></td>
<td align=left>
<select name='idtuteur' id='idtuteur'></select>
</td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE78 ?> 1 &nbsp;:&nbsp;</font></td>
<td align=left>
<select name=idprof>
<option  STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX ?></option>
<?php
select_personne_2('ENS',25);
?>
</select>
</td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE85 ?> 1 &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=15 name="date"  id='date1' class='bouton2' onKeyPress="onlyChar(event)" >
<?php
 include_once("../librairie_php/calendar.php");
 calendarVATEL("id1","document.formulaire.date",$_SESSION["langue"],"0");
?>
</td>
</tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE78 ?> 2 &nbsp;:&nbsp;</font></td>
<td align=left>
<select name=idprof2>
<option  STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX ?></option>
<?php
select_personne_2('ENS',25);
?>
</select>
</td>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE85 ?> 2 &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=15 name="date2" id='date2' class='bouton2' onKeyPress="onlyChar(event)" >
<?php
 calendarVATEL("id2","document.formulaire.date2",$_SESSION["langue"],"0");
?>
</td>
</tr>

<tr>
<td align=right width=45%><font class="T2"><?php print LANGVATEL238 ?> &nbsp;:&nbsp;</font></td>
<td align=left><select name='trim'>
<option value='' id='select0'  ></option>
<optgroup label="Trimestre">
<option value='T1' id='select1' ><?php print LANGPROJ3 ?></option>
<option value='T2' id='select1' ><?php print LANGPROJ4 ?></option>
<option value='T3' id='select1' ><?php print LANGPROJ5 ?></option>
<optgroup label="Semestre">
<option value='S1' id='select1' ><?php print LANGPROJ19 ?></option>
<option value='S2' id='select1' ><?php print LANGPROJ20 ?></option>
</select>
</td></tr>

<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE111 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='langue' id='langue' maxlength='200' ></td>
</tr>

<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE112 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='service' id='service' maxlength='200' ></td>
</tr>
<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE113 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type=text size=30 name='indemnitestage' id='indemnitestage' maxlength='200' ></td>
</tr>

<tr>
<td align=right width=45%><font class="T2"><?php print LANGSTAGE79 ?> &nbsp;:&nbsp;</font></td>
<td align=left><input type='radio' name="loge" value='1' class='btradio1'  style="float:none" > <?php print LANGOUI ?> / <input type=radio name="loge" value=0 class=btradio1 style="float:none" checked> <?php print LANGNON ?> </td>
</tr>
<tr>
<td align='right' width='45%'><font class="T2"><?php print LANGSTAGE80 ?> &nbsp;:&nbsp;</font></td>
<td align='left'><input type='radio' value=1 name="nourri" class='btradio1' style="float:none" > <?php print LANGOUI ?> / <input type=radio  name="nourri" value=0 class=btradio1 style="float:none" checked > <?php print LANGNON ?></td>
</tr>

<tr>
<td align='right' width='45%' ><font class="T2"><?php print LANGSTAGE114 ?> &nbsp;:&nbsp;</font></td>
<td align='left' ><?php print LANGVATEL236 ?> : <input type=text name="horairedebutjournalier" size=4  value='hh:mm' onKeyPress="onlyChar2(event)" > / <?php print LANGVATEL237 ?> <input type=text name="horairefinjournalier" size=4   value='hh:mm' onKeyPress="onlyChar2(event)"  ></td>
</tr>

<tr>
<td align='right' width='45%'><font class="T2"><?php print nbsp(LANGSTAGE81) ?> &nbsp;:&nbsp;</font></td>
<td align='left'><input type='radio' name="xservice" value='1' class='btradio1' style="float:none" > <?php print LANGOUI ?> / <input type=radio name="xservice" value='0' class='btradio1' style="float:none"  checked > <?php print LANGNON ?></td>
</tr>
<tr>
<td align='right' width='45%' valign='top' ><font class="T2"><?php print nbsp(LANGSTAGE82) ?> &nbsp;:&nbsp;</font></td>
<td align='left' ><textarea cols='40' name='raison' ></textarea></td>
</tr>
<tr>
<td align='right' width='45%' valign='top'  ><font class="T2"><?php print nbsp(LANGSTAGE83) ?> &nbsp;:&nbsp;</font></td>
<td align=left><textarea cols=40 name=info></textarea></td>
</tr>
<tr>
<td colspan=2 align=center><table align=center><tr><td><br>
<script language=JavaScript>buttonMagicSubmit3VATEL("<?php print LANGBT7?>","create","disabled='disabled'"); //text,nomInput</script>
&nbsp;&nbsp;
</td></tr></table>
</td>
</tr>
<tr><td colspan='2' align='center' ><span id='alerte' ><font id='color2'><?php print LANGVATEL240 ?></font></span></td></tr>
</table>
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
<script>
function checkStage() {
	
	if (document.getElementById("newstage").checked == true) {
		document.getElementById("debutstage").disabled=false;
		document.getElementById("finstage").disabled=false;
		document.getElementById("j1").disabled=false;
		document.getElementById("j2").disabled=false;
		document.getElementById("j3").disabled=false;
		document.getElementById("j4").disabled=false;
		document.getElementById("j5").disabled=false;
		document.getElementById("j6").disabled=false;
		document.getElementById("j7").disabled=false;
		var nbstage=document.getElementById("nbstage").value;
		for(var i=0;i<nbstage;i++) {
			document.getElementById("idstage"+i).checked=false;
			document.getElementById("idstage"+i).disabled=true;
		}

	}else{
		document.getElementById("debutstage").value="jj/mm/aaaa";
		document.getElementById("finstage").value="jj/mm/aaaa";		
		document.getElementById("debutstage").disabled=true;
		document.getElementById("finstage").disabled=true;
		document.getElementById("j1").checked=false;
		document.getElementById("j2").checked=false;
		document.getElementById("j3").checked=false;
		document.getElementById("j4").checked=false;
		document.getElementById("j5").checked=false;
		document.getElementById("j6").checked=false;
		document.getElementById("j7").checked=false;
		document.getElementById("j1").disabled=true;
		document.getElementById("j2").disabled=true;
		document.getElementById("j3").disabled=true;
		document.getElementById("j4").disabled=true;
		document.getElementById("j5").disabled=true;
		document.getElementById("j6").disabled=true;
		document.getElementById("j7").disabled=true;
		var nbstage=document.getElementById("nbstage").value;
		for(var i=0;i<nbstage;i++) {
			document.getElementById("idstage"+i).checked=false;
			document.getElementById("idstage"+i).disabled=false;
		}
	}
}
</script>

</body>
</html>