<?php
session_start();
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
include_once("../librairie_php/lib_error.php");
include_once("../common/config.inc.php");
include_once("../librairie_php/db_triade.php");
include_once("../common/config2.inc.php");

include_once("entete.php");
include_once("menu.php");


if ((VIESCOLAIRENOTEENSEIGNANT == "oui") && ($_SESSION["membre"] != "menupersonnel"))  {
	validerequete("3");
}else{
	if (($_SESSION["membre"] != "menuadmin") && ($_SESSION["membre"] != "menuprof")) {
		$cnx=cnx2();
		if (!verifDroit($_SESSION["id_pers"],"carnetnotes")) {
			accesNonReserveFen();
			exit();
		}
		Pgclose();
	}else{
		validerequete("profadmin");
	}
}

$cnx=cnx2();
$titre1=$_POST["titre1"];
$idcl=$_POST["idclasse"];
$gid=$_POST["gid"];
$data=$_POST["args"];
$sMat=$_POST["sMat"];
$sClasseGrp=$_POST["sClasseGrp"];


$data=explode(";",$data);
array_shift($data);
$i=1;
$l=count($data);
while($i<$l){
	unset($data[$i]);
	$i=$i+2;
}
foreach($data as $tmp){
	$inter=explode("\"",trim($tmp));
	$dataTmp[]=substr($inter[1],0,-1); 
}
$data=$dataTmp;
unset($dataTmp);
if ($_POST["sujet"] != "") {
	$sujet=$_POST["sujet"];
}else{
	$sujet=$data[0];
}
$sujet=preg_replace('/("\w*)\'(\w*")/i','${1}\\\'${2}',$sujet);
$date=change_date(trim($data[1]));
$coef=$data[2];
$examen=$data[3];
$elev_id=$data[4];
$code_mat=$data[5];
$prof_id=$data[6];
unset($data);

if (isset($_SESSION["idprofviaadmin"])) {
	$prof_id=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($prof_id);
}

if (trim($elev_id) != "") {
	$sql="SELECT note_id, CONCAT( upper(trim(e.nom)),' ',trim(e.prenom) ), round(note,2), n.elev_id, n.typenote, n.noteexam, n.notationsur,	n.notevisiblele , e.classe
		FROM  ${prefixe}notes n, ${prefixe}eleves e
		WHERE
		sujet = '$sujet'
		AND date  = '$date'
		AND coef  = '$coef'
		AND	n.elev_id IN ($elev_id)
		AND code_mat = '$code_mat'
		AND prof_id = '$prof_id'
		AND n.elev_id = e.elev_id
		GROUP BY e.elev_id
		ORDER BY e.nom,e.prenom
	";
	$curs=execSql($sql);
	$mat=chargeMat($curs);
}

$sujet2=$sujet;

if (trim($mat[0][4]) == "en") { $note_usa=1;$typenote="en";}
if ((trim($mat[0][4]) == "fr") || (trim($mat[0][4]) == "")) { $note_usa=0;$typenote="fr";}
$noteexamen=$mat[0][5];
$notevisible=dateForm($mat[0][7]);

for($i=0;$i<count($mat);$i++){

	for($j=0;$j<count($mat[$i]);$j++){
		if($mat[$i][$j] == -1){
			$mat[$i][$j] = 'abs';
		} elseif ($mat[$i][$j] == -2) {
			$mat[$i][$j] = 'disp';
		} elseif ($mat[$i][$j] == -3) {
			$mat[$i][$j] = 'néant';
		} elseif ($mat[$i][$j] == -4) {
			$mat[$i][$j] = 'DNN';
		} elseif ($mat[$i][$j] == -5) {
			$mat[$i][$j] = 'DNR';
		} elseif ($mat[$i][$j] == -6) {
			$mat[$i][$j] = 'VAL';
		}else {
			continue;
		}
	}

	$notationsur=$mat[0][6];
	if ((trim($mat[0][4]) == "fr") || (trim($mat[0][4]) == "")) {
		$selected20="selected='selected'";
		if ($mat[0][6] == 20) { $selected20="selected='selected'";  } 	
		if ($mat[0][6] == 10) { $selected10="selected='selected'"; $selected20=""; }
		if ($mat[0][6] == 15) { $selected15="selected='selected'"; $selected20=""; }
		if ($mat[0][6] == 5)  { $selected5="selected='selected'";  $selected20=""; }
		if ($mat[0][6] == 30) { $selected30="selected='selected'"; $selected20=""; }
		if ($mat[0][6] == 40) { $selected40="selected='selected'"; $selected20=""; }
	}

	
	if (trim($noteexamen) != "")  {	
		if ($noteexamen == "Brevet Blanc") 	    { $selectedExam1="selected='selected'";  } 	
		if ($noteexamen == "BAC Blanc") 	    { $selectedExam2="selected='selected'"; }
		if ($noteexamen == "CAP Blanc") 	    { $selectedExam3="selected='selected'"; }
		if ($noteexamen == "BEP Blanc") 	    { $selectedExam4="selected='selected'"; }
		if ($noteexamen == "BTS Blanc") 	    { $selectedExam5="selected='selected'"; }
		if ($noteexamen == "Partiel Blanc") 	    { $selectedExam6="selected='selected'"; }
		if ($noteexamen == "Concours Blanc") 	    { $selectedExam9="selected='selected'"; }
		if ($noteexamen == "décembre") 		    { $selectedExam7="selected='selected'"; }
		if ($noteexamen == "juin")	 	    { $selectedExam8="selected='selected'"; }
		if ($noteexamen == "DS1") 		    { $selectedExam10="selected='selected'"; }
		if ($noteexamen == "DS2") 		    { $selectedExam11="selected='selected'"; }
		if ($noteexamen == "DS3") 		    { $selectedExam12="selected='selected'"; }
		if ($noteexamen == "DS4")      		    { $selectedExam13="selected='selected'"; }
		if ($noteexamen == "Partiel") 		    { $selectedExam14="selected='selected'"; }
		if ($noteexamen == "CC") 		    { $selectedExam15="selected='selected'"; }
		if ($noteexamen == "DST") 		    { $selectedExam16="selected='selected'"; }
		if ($noteexamen == "Partiel") 		    { $selectedExam17="selected='selected'"; }
		if ($noteexamen == "Soutenance") 	    { $selectedExam18="selected='selected'"; }
		if ($noteexamen == "Rapport") 		    { $selectedExam19="selected='selected'"; }
		if ($noteexamen == "Fiche de lecture")      { $selectedExam20="selected='selected'"; }
		if ($noteexamen == "Exposé") 		    { $selectedExam21="selected='selected'"; }
		if ($noteexamen == "Dad") 		    { $selectedExam22="selected='selected'"; }
		if ($noteexamen == "TAS") 		    { $selectedExam23="selected='selected'"; }
		if ($noteexamen == "BTS Blanc") 	    { $selectedExam24="selected='selected'"; }
		if ($noteexamen == "Brevet Professionnel Blanc") { $selectedExam25="selected='selected'";  } 	
		if ($noteexamen == "Partiel Blanc") 	    { $selectedExam26="selected='selected'";  } 	
		if ($noteexamen == "semestre")	 	    { $selectedExam27="selected='selected'";  } 
		if ($noteexamen == "2session") 		    { $selectedExam28="selected='selected'";  } 
		if ($noteexamen == "Brevet EPS") 	    { $selectedExam29="selected='selected'";  } 
		if ($noteexamen == "examen") 		    { $selectedExam271="selected='selected'";  } 
		if ($noteexamen == "examen blanc") 	    { $selectedExam272="selected='selected'";  } 
		if ($noteexamen == "DS") 		    { $selectedExam273="selected='selected'";  } 
		if ($noteexamen == "Brevet PREV. SANTE ENV.") { $selectedExam30="selected='selected'";  } 
		if ($noteexamen == "NP") 		    { $selectedExam274="selected='selected'";  } 
		if ($noteexamen == "ND") 		    { $selectedExam275="selected='selected'";  } 
		if ($noteexamen == "ISP") 		    { $selectedExam276="selected='selected'";  } 
		if ($noteexamen == "jtc") 		    { $selectedExam277="selected='selected'";  } 
		if ($noteexamen == "Partiel") 		    { $selectedExam928="selected='selected'";  } 
		if ($noteexamen == "Rattrapage") 	    { $selectedExam929="selected='selected'";  } 
		if ($noteexamen == "Examen complémentaire") { $selectedExam930="selected='selected'";  } 
		if ($noteexamen == "Contrôle continu") 	    { $selectedExam931="selected='selected'";  }
	
	}else{
		$selectedExam0="selected='selected'";
	}
}

?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL22 ?> - <?php print LANGVATEL26 ?>  <?php print $nomduprof ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='ajoutnotes.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='modifiernotes.php' ><?php print LANGVATEL22 ?></a></li>
				<li style="visibility:visible" ><a href='supprimernotes.php' ><?php print LANGVATEL23 ?></a></li>
				<li style="visibility:visible" ><a href='visunotes.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px" >
		
<form method="POST" action="modifiernotes4.php" onsubmit="return valid_modif_note()" name="form11">
<input type="hidden" name="code_mat" value="<?php print $code_mat?>" />
<font class="T2"><?php print LANGPROF6 ?>
<?php 
$sujet2=htmlentities($sujet2,ENT_QUOTES) ;
?>
<input type="text" size=35 maxlength=30 name="sujet" value="<?php print stripslashes($sujet2)?>" class="form-control vat-extend-select pointer" id='select1' onChange="verifSujet(this.value,document.form11.date.value,<?php print $idcl?>,<?php print $gid ?>);" />
<br>

<font class="T2"><?php print LANGTE7 ?>  </font><br>
<input type="text" size=10 maxlength=12 name="date" value="<?php print dateForm($date)?>"  id='select1'  class="dateInput" />
<?php
include_once("../librairie_php/calendar.php");
calendarVatel("id1","document.form11.date",$_SESSION["langue"],"0");
?>
<br><br>

<font class="T2"><?php print LANGPER19 ?>  <font><br>
<input type="text" size=4 name="coef" value="<?php print $coef?>"  id='select1' class="form-control vat-extend-select pointer" readonly='readonly' />
<br>

<font class="T2"><?php print "Notes visibles le " ?></font><br>
<input type="text" name="notevisiblele" size=12  id='select1' value="<?php print $notevisible ?>" readonly="readonly"  class="dateInput" >
<?php
calendarVatel("id2","document.form11.notevisiblele",$_SESSION["langue"],"0");
?>
<br><br>

<font class="T2"><?php print LANGGRP56 ?>  <font><br/>
<select name='NotationSur' class="form-control vat-extend-select pointer" >                 	
			<?php 
				if (NOTATION40 == "oui") { 
					print "<option value='40' STYLE='color:#000066;background-color:#CCCCFF' $selected40  >40</option>";
				}
				if (NOTATION30 == "oui") { 
					print "<option value='30' STYLE='color:#000066;background-color:#CCCCFF' $selected30  >30</option>";
				}
				if (NOTATION20 == "oui") { 
					print "<option value='20' STYLE='color:#000066;background-color:#CCCCFF' $selected20  >20</option>";
				}
				if (NOTATION15 == "oui") { 
					print "<option value='15' STYLE='color:#000066;background-color:#CCCCFF' $selected15  >15</option>";
				}
				if (NOTATION10 == "oui") { 
					print "<option value='10' STYLE='color:#000066;background-color:#CCCCFF' $selected10  >10</option>";
				}
				if (NOTATION5 == "oui") { 
			   		print "<option value='5' STYLE='color:#000066;background-color:#CCCCFF'  $selected5  >05</option>";
				}
             		?>
</select>
<br />

<?php
if ((isset($_POST["typenote"])) && ($_POST["typenote"] == "oui")) {
	print "&nbsp;&nbsp;".LANGNOTEUSA6.".";
	$list_cor="";
	$datalist=aff_config_note_usa();
	// id,libelle,min,max
	for($i=0;$i<count($datalist);$i++) {
		$list_cor.="<font class=T2> De ".$datalist[$i][2]." à ".$datalist[$i][3]." équivaut à  ".$datalist[$i][1]."</font><br>";
	}
	print "&nbsp;<a href='#' onMouseOver=\"AffBulle3('Correspondance','./image/commun/info.jpg','".$list_cor."');\"  onMouseOut='HideBulle()'; ><img src='./image/help.gif' border='0' align='center'></a>";
	print "<br /><br />";
}
?>


<table border='0' style="-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;padding:5px" >
<?php
$nbelem=6;
for($i=0;$i<count($mat);$i++){
$photoeleve="image_trombi.php?idE=".$mat[$i][3];
print htmlFormHidden("note_id[$i]",$mat[$i][0]);
print htmlFormHidden("elev_id[$i]",$mat[$i][3]);
print htmlFormHidden("elev_nom[$i]",$mat[$i][1]);
$nbelem=$nbelem + 4;

$idclasse=$mat[$i][8];
if ($gid != '0') {
	$nomClasse="(".chercheClasse_nom($idclasse).")";
}else{
	$nomClasse="";
}

print "<tr>\n";
print "<td align='right' ><font class='colorText'> ".$mat[$i][1]."</font><font size='1'>$nomClasse</font> </td>\n";
print "<td>&nbsp;:&nbsp;<select onchange=chNote('".$nbelem."')>\n";
print "<option value='' selected STYLE='color:#000066;background-color:#FCE4BA'>Note</option>";
print "<option value='abs' title='Absent' STYLE='color:#000066;background-color:#CCCCFF'>Abs</option>";
print "<option value='disp' title='Dispensé' STYLE='color:#000066;background-color:#CCCCFF'>Disp</option>";
print "<option value='DNR' title='Devoir non rendu' STYLE='color:#000066;background-color:#CCCCFF'>DNR</option>";
print "<option value='DNN' title='Devoir non noté' STYLE='color:#000066;background-color:#CCCCFF'>DNN</option>";
print "<option value='VAL' title='Devoir validé' STYLE='color:#000066;background-color:#CCCCFF'>VAL</option>";
print "<option value='supp' title='Supprimer la note' STYLE='color:#000066;background-color:yellow'>Supp</option>";
print "</td>";
print "<td>".htmlFormTextVatel2("iNotes[$i]",$mat[$i][2],6,6)."</td>\n";
print "</tr>\n";
$nbelem=$nbelem + 1;
}
?>
</table>
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=checkbox onclick="forceValeur();" class='btradio1' > <font color=red><?php print LANGPROF19 ?></font><br /><br/ >


<?php
if (NOTEEXAMEN == "oui") {
?>
	<font class="T2"><?php print LANGDISC60  ?> </font> :   
	<select name="noteexamen">
	<option value="" <?php print $selectedExam0 ?> STYLE='color:#000066;background-color:#CCCCFF' >non</option>
<?php if (EXAMENBLANC == "oui") { ?>
	<optgroup label="Examen Blanc" />
	<?php if (PRODUCTID != "2b85614b9c7cc3e8f7f02fe4fd52e907") { ?>
		<option value="Brevet Blanc" <?php print $selectedExam1 ?>  STYLE='color:#000066;background-color:#CCCCFF'>Brevet Blanc</option>
		<option value="Brevet Professionnel Blanc" <?php print $selectedExam25 ?>  STYLE='color:#000066;background-color:#CCCCFF'>Brevet Professionnel Blanc</option>
		<option value="BAC Blanc" <?php print $selectedExam2 ?>  STYLE='color:#000066;background-color:#CCCCFF'>BAC Blanc</option>
		<option value="CAP Blanc" <?php print $selectedExam3 ?>  STYLE='color:#000066;background-color:#CCCCFF'>CAP Blanc</option>
		<option value="BEP Blanc" <?php print $selectedExam4 ?>  STYLE='color:#000066;background-color:#CCCCFF'>BEP Blanc</option>
	<?php } ?>
	<option value="BTS Blanc" <?php print $selectedExam5 ?> STYLE='color:#000066;background-color:#CCCCFF'>BTS Blanc</option>
	<option value="Partiel Blanc" <?php print $selectedExam6 ?> STYLE='color:#000066;background-color:#CCCCFF'>Partiel Blanc</option>
	<?php if (PRODUCTID != "2b85614b9c7cc3e8f7f02fe4fd52e907") { ?>
		<option value="Concours Blanc"  <?php print $selectedExam9 ?> STYLE='color:#000066;background-color:#CCCCFF'>Concours Blanc</option>
	<?php } ?>
	<?php } ?>
<?php if (EXAMENNAMUR == "oui") { ?>												
	<optgroup label="Spécif. Namur" />
	<option value="décembre" <?php print $selectedExam7 ?>  STYLE='color:#000066;background-color:#CCCCFF'>Décembre</option>
	<option value="juin"  <?php print $selectedExam8 ?> STYLE='color:#000066;background-color:#CCCCFF'>Juin</option>
<?php } ?>
<?php if (EXAMENISMAP == "oui") { ?>
	<optgroup label="ISMAP" />
	<option value="CC" <?php print $selectedExam15 ?> STYLE='color:#000066;background-color:#CCCCFF'>CC</option>
	<option value="DST" <?php print $selectedExam16 ?> STYLE='color:#000066;background-color:#CCCCFF'>DST</option>
<?php if ($_SESSION["membre"] == "menuadmin") { ?>
	<option value="Partiel" <?php print $selectedExam17 ?> STYLE='color:#000066;background-color:#CCCCFF'>Partiel</option> 
	<option value="Soutenance" <?php print $selectedExam18 ?> STYLE='color:#000066;background-color:#CCCCFF'>Soutenance</option>
<?php } ?>
	<option value="Rapport" <?php print $selectedExam19 ?> STYLE='color:#000066;background-color:#CCCCFF'>Rapport</option>
	<option value="Fiche de lecture" <?php print $selectedExam20 ?> STYLE='color:#000066;background-color:#CCCCFF'>Fiche de lecture</option>
	<option value="Exposé" <?php print $selectedExam21 ?> STYLE='color:#000066;background-color:#CCCCFF'>Exposé</option>
	<option value="Dad" <?php print $selectedExam22 ?> STYLE='color:#000066;background-color:#CCCCFF'>Dad</option>
<?php } ?>
<?php if (EXAMENPIGIERNIMES == "oui") { ?>
	<optgroup label="PIGIER" />
	<option value="ND" <?php print $selectedExam275 ?> STYLE='color:#000066;background-color:#CCCCFF'>Note Devoir (DS)</option>
	<option value="NP" <?php print $selectedExam274 ?> STYLE='color:#000066;background-color:#CCCCFF'>Note Participation</option>
        <option value="DS" <?php print $selectedExam273 ?> STYLE='color:#000066;background-color:#CCCCFF'>DS</option>
	<option value="examen" <?php print $selectedExam271 ?> STYLE='color:#000066;background-color:#CCCCFF'>Examen</option>
        <option value="examen blanc" <?php print $selectedExam272 ?> STYLE='color:#000066;background-color:#CCCCFF'>Examen Blanc</option>
<?php } ?>
<?php if (EXAMENISPACADEMIES == "oui") { ?>
    <optgroup label="ISP ACADEMIES" />
    <option value="ISP" <?php print $selectedExam276 ?> STYLE='color:#000066;background-color:#CCCCFF'>ISP</option>
<?php } ?>
<?php if (EXAMENDS == "oui") { ?>
	<optgroup label="DS" />
	<option value="DS1" <?php print $selectedExam10 ?> STYLE='color:#000066;background-color:#CCCCFF'>DS1</option>
	<option value="DS2" <?php print $selectedExam11 ?> STYLE='color:#000066;background-color:#CCCCFF'>DS2</option>
	<option value="DS3" <?php print $selectedExam12 ?> STYLE='color:#000066;background-color:#CCCCFF'>DS3</option>
	<option value="DS4" <?php print $selectedExam13 ?> STYLE='color:#000066;background-color:#CCCCFF'>DS4</option>
<?php } ?>
<?php if (EXAMEN == "oui") { ?>	
	<optgroup label="Examen" />
	<option value="Partiel" <?php print $selectedExam14 ?>  STYLE='color:#000066;background-color:#CCCCFF'>Partiel</option>
<?php } ?>
<?php if (EXAMENCIEFORMATION == "oui") { ?>												
	<optgroup label="Spécif. Cie. Formation" />
	<option value="TAS" <?php print $selectedExam23 ?>  STYLE='color:#000066;background-color:#CCCCFF'>TAS</option>
	<option value="BTS Blanc"  <?php print $selectedExam24 ?> STYLE='color:#000066;background-color:#CCCCFF'>BTS Blanc</option>
	<option value="Partiel Blanc" <?php print $selectedExam26 ?> STYLE='color:#000066;background-color:#CCCCFF'>Partiel Blanc</option>
<?php } ?>
<?php if (EXAMENEEPP == "oui") { ?>
	<optgroup label="Spécif. EEPP" />
   	<option value="semestre" <?php print $selectedExam27 ?> STYLE='color:#000066;background-color:#CCCCFF'>Semestriel</option>
   	<option value="2session" <?php print $selectedExam28 ?> STYLE='color:#000066;background-color:#CCCCFF'>2ème session</option>
<?php } ?>
<?php if (EXAMENJTC == "oui") { ?>
	<optgroup label="Spécif. JTC" />
        <option value="jtc" STYLE='color:#000066;background-color:#CCCCFF' <?php print $selectedExam277 ?> >Carnet</option>
<?php } ?>
<?php if (EXAMENIPAC == "oui") { ?>
	<optgroup label="IPAC" />
	<option value="Partiel" STYLE='color:#000066;background-color:#CCCCFF' <?php print $selectedExam928 ?> >Partiel</option>
	<option value="Rattrapage" STYLE='color:#000066;background-color:#CCCCFF' <?php print $selectedExam929 ?> >Rattrapage</option>
	<option value="Examen complémentaire" STYLE='color:#000066;background-color:#CCCCFF' <?php print $selectedExam930 ?> >Examen complémentaire</option>
	<option value="Contrôle continu" STYLE='color:#000066;background-color:#CCCCFF' <?php print $selectedExam931 ?> >Contrôle continu</option>
<?php } ?>

<?php if (EXAMENBREVETCOLLEGE == "oui") { ?>
	<optgroup label="Brevet Collège" />
   	<option value="Brevet EPS" <?php print $selectedExam29 ?> STYLE='color:#000066;background-color:#CCCCFF'>Brevet EPS</option>
	<option value="Brevet PREV. SANTE ENV." <?php print $selectedExam30 ?> STYLE='color:#000066;background-color:#CCCCFF'>Brevet PREV. SANTE ENV.</option>
<?php } ?>
        </select><br>
<?php
}
?>



<?php
if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menupersonnel")){
	print "<font class='T2'>".LANGVATEL42." : </font>";
	print "<select name='adminIdprof' >";
	print "<option id='select0' value='".$prof_id."'>".recherche_personne($prof_id)."</option>";
	select_personne('ENS');
	print "</select>";
	print "<br><br><br>";
}else{ ?>
	<input type="hidden" name="adminIdprof" value="<?php print $_POST["adminIdprof"] ?>" />
<?php } ?>


<br>
&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print LANGPROF20 ?>" name="validation" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print LANGVATEL30 ?>" id='btnote' onclick="document.getElementById('ajoutnote').style.display='block'"  />


<input type="hidden" name="idcl" value="<?php print $idcl?>" />
<input type="hidden" name="gid" value="<?php print $gid?>" />
<input type="hidden" name="typenote" value="<?php print $_POST["typenote"]?>" />
<input type="hidden" name="titre" value="<?php $titre1=urldecode($_POST["titre1"]); print $titre1?>" />
<input type="hidden" name="sClasseGrp" value="<?php print $sClasseGrp ?>" >
<input type="hidden" name="sMat" value="<?php print $sMat ?>" >

</ul>
</form>



<?php 
$nbtop=(count($mat)*30)+50; 
$order="ORDER BY 2";
if($HPV[gid]){
        $gid=$HPV[gid];
        $sqlIn=<<<SQL
        SELECT
        	liste_elev
        FROM
        	${prefixe}groupes
        WHERE
        	group_id='$gid'
SQL;
        $curs=execSql($sqlIn);
        $in=chargeMat($curs);
        freeResult($curs);
        $in=$in[0][0];
	$in=substr($in,1);
	$in=substr($in,0,-1);
	if (trim($in) == "") {
		$sql="SELECT elev_id, CONCAT( upper(trim(nom)),' ',trim(prenom) ) ,classe, numero_eleve  FROM ${prefixe}eleves WHERE elev_id=''  AND compte_inactif != 1 $order ";
		unset($in);		
	}else{
		$sql="SELECT elev_id, CONCAT( upper(trim(nom)),' ',trim(prenom) ) ,classe, numero_eleve  FROM ${prefixe}eleves WHERE compte_inactif != 1 AND elev_id IN ($in) $order ";
		unset($in);
	}
} else {
      	$sql="SELECT elev_id, ";
       	$sql.=" CONCAT( upper(trim(nom)),' ',trim(prenom) ) ";
	$sql.=",classe  FROM ${prefixe}eleves WHERE classe='$idcl' AND compte_inactif != 1 $order ";
}
        $curs=execSql($sql);
        unset($sql);
        $ele=chargeMat($curs);

?>
<div id="ajoutnote" style="position:absolute;top:<?php print $nbtop ?>;left:430;display:none;margin:20px;width:400px;height:200px;padding:1px;border:1px #666 solid;background-color:#ddd;z-index:1000000;">
	<form method='post' name='form12'><br />
	&nbsp;&nbsp;&nbsp;<font class=T2><b><?php print LANGVATEL31 ?></b></font><br /><br />
	&nbsp;&nbsp;&nbsp;
	<select name=ideleve >
		<option value='' id='select0' ><?php print LANGCHOIX ?></option>
	<?php
	for($a=0;$a<count($ele);$a++){
		$sql="SELECT note_id, CONCAT( upper(trim(e.nom)),' ',trim(e.prenom) ), round(note,2),n.elev_id,n.typenote,n.noteexam,n.notationsur,n.notevisiblele FROM ${prefixe}notes n, ${prefixe}eleves e WHERE sujet = '$sujet' AND date  = '$date' AND coef  = '$coef' AND n.elev_id = '".$ele[$a][0]."' AND code_mat = '$code_mat' AND prof_id = '$prof_id' AND n.elev_id = e.elev_id";
		$curs=execSql($sql);
		$mat3=chargeMat($curs);
		if (count($mat3) == 0) {
			print "<option value='".$ele[$a][0]."' id='select1' >".$ele[$a][1]."</option>";
		}
	}
	?>
	</select>&nbsp;
<select  onchange="chNoteAj()" name='notation'>
<option value='' selected STYLE='color:#000066;background-color:#FCE4BA'>Note</option>
<option value='abs' title='Absent' STYLE='color:#000066;background-color:#CCCCFF'>Abs</option>
<option value='disp' title='Dispensé' STYLE='color:#000066;background-color:#CCCCFF'>Disp</option>
<option value='DNR' title='Devoir non rendu' STYLE='color:#000066;background-color:#CCCCFF'>DNR</option>
<option value='DNN' title='Devoir non noté' STYLE='color:#000066;background-color:#CCCCFF'>DNN</option>
<option value='VAL' title='Devoir validé' STYLE='color:#000066;background-color:#CCCCFF'>VAL</option>
</select>&nbsp;
<input type='text' name='note' size=3 />
	&nbsp;<br><br>
	&nbsp;&nbsp;&nbsp;<?php
	if  (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuprof")) {
		print "<input type='button' onclick=\"enrNoteAjax(this.form.ideleve.options[this.form.ideleve.selectedIndex].value,this.form.note.value,'".stripslashes($sujet2)."','$date','$coef','".dateFormBase($notevisible)."','$notationsur','$noteexamen','$code_mat','$prof_id','$typenote','$idcl','$gid','retourenr1')\" value=\"".LANGENR."\"  class='btn btn-primary btn-sm  vat-btn-footer' />";
	} ?>
	&nbsp;&nbsp;<input type='button' value='<?php print LANGFERMERFEN ?>' class="btn btn-primary btn-sm  vat-btn-footer" onclick="document.getElementById('ajoutnote').style.display='none'" /><br /><br />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='retourenr1' style='color:red;'></span>
	</form>
</div>
<br><br>
<br><br>
<br><br>
<br><br>




<!------------------------->
<script language="JavaScript">

<?php
if ($_POST["typenote"] == "oui") {
	print "var note_usa=1;";
}else{
	print "var note_usa=0;";
}
?>

var force=0;
function  forceValeur() {
        if (force == 0 ) {force=1;} else { force=0; }
}

function ValidCaractere(nom) {
        var dernier = nom.lenght ;
        var slach1  = nom.charAt(2);
        var slach2  = nom.charAt(5);
        var jour = nom.substring(0,2);
        var mois = nom.substring(3,5);
        var annee = nom.substring(6,10);
        if (isNaN(jour)) { return false }
        if (isNaN(mois)) { return false }
        if (isNaN(annee)) { return false }
        if  ((annee < 2000) || (jour > 31) || (mois > 12) || (slach1 != '/') || (slach2 != '/')){
                return false
        }
        else {
                return true
        }

}

//fonction de validation d'après la longueur de la chaîne
function ValidLongueur(item,len) {
	return (item.length >= len);
}


// affiche un message d'alerte
function error(elem, text) {
// abandon si erreur déjà signalée
   if (errfound) return;
   window.alert(text);
   elem.select();
   elem.focus();
   errfound = true;
}

function ValidNumeric(item,item1){
	if (!ValidLongueur(item,1)) return false;
	return !isNaN(item1.value);
}


function valid_modif_note() {
 errfound=true;
	if (force == 1) {
		    errfound=false;
                        if (document.form11.sujet.value.length < 3) {
                        alert(langfunc72);
                        document.form11.sujet.select();
                        document.form11.sujet.focus();
                        errfound=true;
                        }

                        if (document.form11.date.value.length != 10) {
                        alert(langfunc75);
                        document.form11.date.select();
                        document.form11.date.focus();
                        errfound=true;
			}

                        if (!ValidCaractere(document.form11.date.value)){
                        alert(langfunc75);
                        document.form11.date.select();
                        document.form11.date.focus();
                        errfound=true;
                        }

                        if (document.form11.coef.value.length < 1) {
                        alert(langfunc73);
                        document.form11.coef.select();
                        document.form11.coef.focus();
                        errfound=true;
                        }

                        if (document.form11.coef.value.indexOf (',') != -1) {
                        alert(langfunc69);
                        document.form11.coef.select();
                        document.form11.coef.focus();
			errfound=true;
                        }
<?php if ( $_SESSION["navigateur"] == "IE" ) { ?>
			if (document.form11.coef.value.indexOf ('.') != -1) {
				pos=document.form11.coef.value.indexOf ('.')
				long=document.form11.coef.value.length;
				total=long - pos ;
				if (total > 3 ) {
					alert(langfunc70);
					document.form11.coef.select();
					document.form11.coef.focus();
					errfound=true;
			//		break;
				}
			}
<?php } ?>
                        if (isNaN(document.form11.coef.value)) {
                        alert(langfunc74);
                        document.form11.coef.select();
                        document.form11.coef.focus();
                        errfound=true;
                        }
	                var a=10;
			var nbnote="<?php print 4 + count($mat) * 5 - 1?>";

                	for ( a ; a <= nbnote ; a++ ) {
                        	if  (document.form11.elements[a].value.length < 1) {
	                        errfound=true;
        	                document.form11.elements[a].value=" ";
                	        break;
                        	}
			if (note_usa == 1) { 
                        	if  (document.form11.elements[a].value > 0  &&  document.form11.elements[a].value > 100 ) {
            	            		alert(langfunc68bis + " 100");
            	            		document.form11.elements[a].select();
            	            		document.form11.elements[a].focus();
            	            		errfound=true;
            	            		break;
            			}
			}else{
			    if  (document.form11.elements[a].value > 0  &&  document.form11.elements[a].value > eval(document.form11.NotationSur.options[document.form11.NotationSur.selectedIndex].value+".00") ) {
			          alert(langfunc68 +" "+document.form11.NotationSur.options[document.form11.NotationSur.selectedIndex].value );
			          document.form11.elements[a].select();
			          document.form11.elements[a].focus();
			          errfound=true;
			          break;
			    }
                        }


                        if (document.form11.elements[a].value.indexOf (',') != -1) {
                        alert(langfunc69);
                        document.form11.elements[a].select();
                        document.form11.elements[a].focus();
                        errfound=true;
                        break;
                        }
<?php if ( $_SESSION["navigateur"] == "IE" ) { ?>
			if (document.form11.elements[a].value.indexOf ('.') != -1) {
			pos=document.form11.elements[a].value.indexOf ('.')
			long=document.form11.elements[a].value.length;
			total=long - pos ;
			if (total > 3 ) {
				alert(langfunc70);
				document.form11.elements[a].select();
				document.form11.elements[a].focus();
				errfound=true;
				break;
				}
			}
<?php } ?>
                        if (isNaN(document.form11.elements[a].value)) {
 				if ((document.form11.elements[a].value != "abs") && (document.form11.elements[a].value != "disp") && (document.form11.elements[a].value != "néant")  && (document.form11.elements[a].value != "DNR")  && (document.form11.elements[a].value != "DNN") && (document.form11.elements[a].value != "supp") && (document.form11.elements[a].value != "VAL") ) {
                                        alert(langfunc71);
                                        document.form11.elements[a].select();
                                        document.form11.elements[a].focus();
                                        errfound=true;
                                        break;
                                }
                        }
                        a=a+4;
		     } // fin du for
                }

		if (force == 1) {
			if (errfound == false) {
				document.form11.validation.disabled=true;
				document.getElementById('attenteDiv').style.visibility='visible';
			}
		}

        return !errfound;
}
</script>


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
