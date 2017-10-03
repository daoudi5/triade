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


if (($_SESSION["membre"] != "menuprof") && ($_SESSION["membre"] != "menuadmin")) {
	header("Location:index.php");
	exit();
}

$triEleve=$_POST["trier"];
setcookie("tri_eleve",$triEleve,time()+36000*24*30);

include_once("entete.php");
include_once("menu.php");

$cnx=cnx2();

// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
$ident=array('sClasseGrp','cgrp','sMat','mid','sNbNote','nbNote');
$HPV=hashPostVar($ident);
unset($ident);
$listTmp=explode(":",$HPV[cgrp]);
unset($HPV[cgrp]);
$HPV[cid]=$listTmp[0];
$HPV[gid]=$listTmp[1];
unset($listTmp);
//print_r($HPV);

$notationSur=$_POST["NotationSur"];

$idprof=$_SESSION["id_pers"];
if (isset($_SESSION["idprofviaadmin"])) {
	$idprof=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($idprof);
}



if ($_POST["NoteUsa"] == "oui") {
	$notetype="Notation en mode USA";
	$noteusa="oui";
}else{
	$notetype="Notation sur $notationSur";
	$noteusa="non";
}



if (isset($_POST["NoteExam"])) {
	$noteExamen=$_POST["NoteExam"];
	if ($noteExamen == "aucun") {
		$noteExamen="";
	}
}

if($HPV[gid]):
	$verif=verifProfDansGroupe($idprof,$HPV[gid]);
	if ($verif) { blacklistVatel(); }
	$who="<font color=\"#FFFFFF\">- groupe : </font> ".trunchaine(chercheGroupeNom($HPV[gid]),10)." <font color='#FFFFFF'>-</font> $notetype ";
else:
	$cl=chercheClasse($HPV[cid]);
	$verif=verifProfDansClasse($idprof,$cl[0][0]);
	if ($verif) { blacklistVatel(); }
	$who="<font color=\"#FFFFFF\">- classe : </font>".trunchaine(ucfirst($cl[0][1]),10)." <font color='#FFFFFF'>-</font> $notetype ";
	unset($cl);
endif;

$anneeScolaire=$_COOKIE["anneeScolaire"];
if (anneeScolaireViaIdClasse($HPV[cid]) == $anneeScolaire) { 
	$table="eleves";
}else{
	$table="eleves_histo";
}

if (($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { 

?> 
	<script>
	var errfound=false;
	var force=0;
	</script>

	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL21 ?> <?php print LANGVATEL26 ?> <?php print $nomduprof ?></span>
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

		<form method="post" action="ajoutnotes3.php" onSubmit="return valide_note()" name="form11" >
<?php
$info_nav=$_SESSION["navigateur"];
$sizenote=4;
if ($info_nav == "IE") { $sizenote=3; }
for($i=0;$i<$HPV[nbNote];$i++){
	print "<div>";
	if ($noteExamen != "") {
		print LANGNOTE1." ".($i+1)." : ";
	}else{
		print LANGPROF7." ".($i+1)." : ";
	}
	if (VERIFSUJETNOTE == "oui") { 
		$verif="oui";
	}else{
		$verif="non";
	}
	print htmlFormTextNoteAjoutVatel("iSujet[$i]",'',15,30,$i,$HPV[cid],$HPV[gid],$HPV[mid],$verif);

//	$valcoef="1";
	
	$dateDuJour=dateDMY();
	print "<br>";
	print strtolower(LANGPER19)." : ";
	print htmlFormTextVatel("iCoef[$i]","$valcoef",2,4,"");
	print "<input type='hidden' name='iCoef[$i]' value='1' /><br>";
	print ucfirst(LANGTE7). " : " ;
	print "<table><tr><td width=150>".htmlFormTextDateNoteAjoutVatel("iDate$i",$dateDuJour,10,12,$i,$HPV[cid],$HPV[gid])."</td><td>";
	print "&nbsp;&nbsp;&nbsp;<input type='hidden' name='iDate[$i]' \>";
	include_once("../librairie_php/calendar.php");
	calendarVatel("id1$i","document.form11.iDate$i",$lang,"0");
	print "</td></tr></table></div>";
}
?>
<div name="info" id="info"></div>
<br><?php print LANGPROFE?></i><br><br>
<?php
if ((isset($_POST["NoteUsa"])) && ($_POST["NoteUsa"] == "oui")  ) {
	print "&nbsp;&nbsp;".LANGNOTEUSA6.".";
	$list_cor="";
	$datalist=aff_config_note_usa();
	// id,libelle,min,max
	for($i=0;$i<count($datalist);$i++) {
		$list_cor.="<font class=T2> De ".$datalist[$i][2]." à ".$datalist[$i][3]." équivaut à  ".$datalist[$i][1]."</font><br>";
	}
	print "&nbsp;<a href='#' onMouseOver=\"AffBulle3('".LANGMESS76."','../image/commun/info.jpg','".$list_cor."');\"  onMouseOut='HideBulle()'; ><img src='../image/help.gif' border='0' align='center'></a>";
	print "<br /><br />";
}


if ($triEleve == "classe") {
	$order="ORDER BY 3,2";
}elseif($triEleve == "nomEleve") {
	$order="ORDER BY 2";
}elseif($triEleve == "Matricule") {
	$order="ORDER BY CAST(e.numero_eleve AS CHAR)";
}else{
	$order="ORDER BY 2";
}


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
			$sql="SELECT e.elev_id, CONCAT( upper(trim(e.nom)),' ',trim(e.prenom) ) ,e.classe, e.numero_eleve  FROM ${prefixe}eleves e WHERE e.compte_inactif != 1 AND e.elev_id='' $order";
			unset($in);		
		}else{
			$sql="SELECT e.elev_id, CONCAT( upper(trim(e.nom)),' ',trim(e.prenom) ) ,e.classe, e.numero_eleve  FROM ${prefixe}eleves e WHERE e.compte_inactif != 1 AND e.elev_id IN ($in) $order";
			unset($in);
		}
}else{
        $cid=$HPV[cid];
		$sql=" SELECT s.* FROM ( SELECT elev_id,CONCAT(upper(trim(nom)),' ',trim(prenom)),classe FROM ${prefixe}eleves, ${prefixe}classes  WHERE classe='$cid' AND code_class=classe AND annee_scolaire='$anneeScolaire' AND compte_inactif != 1 UNION ALL SELECT e.elev_id,CONCAT( upper(trim(e.nom)),' ',trim(e.prenom) ),e.classe FROM ${prefixe}eleves e ,${prefixe}classes c, ${prefixe}eleves_histo h WHERE h.idclasse='$cid' AND e.elev_id=h.ideleve AND h.idclasse=c.code_class AND h.annee_scolaire='$anneeScolaire') s  ORDER BY 2";
        unset($cid);
}

        $curs=execSql($sql);
        unset($sql);
        $mat=chargeMat($curs);
        freeResult($curs);
        unset($curs);
		print "<table>\n";
		
		print htmlFormHidden("gid",$HPV[gid]);
		print htmlFormHidden("cid",$HPV[cid]);
		print htmlFormHidden("mid",$HPV[mid]);
		$nbelem=$HPV[nbNote] * 4 + 4;
		$afficheClasse="";
		for($i=0;$i<count($mat);$i++){
			$nbelem=$nbelem + 2;
		
			$photoeleve="../image_trombi.php?idE=".$mat[$i][0];

	       	print htmlFormHidden("elev_id[$i]",$mat[$i][0]);
			print htmlFormHidden("elev_nom[$i]",$mat[$i][1]);
			if ($triEleve == "classe") {
				$idClasseA=chercheIdClasseDunEleve($mat[$i][0]);
				if ($idClasseA != $afficheClasse) {
					$afficheClasse=$idClasseA;
					print "<tr><td><font class='T2' color='blue'> ".LANGELE4." : <b>".chercheClasse_nom($afficheClasse)."</b></font></td></tr>";
				}
			}

			if ($HPV[gid] != '0') {
				$idClasseA=chercheIdClasseDunEleve($mat[$i][0]);
				$nomClasse="(".chercheClasse_nom($idClasseA).")";
			}else{
				$nomClasse="";
			}
	
			print "<tr class=\"tabnormal\" onmouseover=\"this.className='tabover'\" onmouseout=\"this.className='tabnormal'\"  >\n";
			$nbcaractNom=80;
			if ($HPV[nbNote] == 3) { $nbcaractNom=20; }
			if ($HPV[nbNote] == 2) { $nbcaractNom=40; }
			$infoProba=getProbaEleve($mat[$i][0]);
		        if ($infoProba == 1) {
                		$infoprobatoire="<img src='image/commun/important.png' title=\"En p&eacute;riode probatoire !!\" />";
		        }else{
                		$infoprobatoire="";
		        }

			//print "<td> $infoprobatoire   <a href='#' onMouseOver=\"AffBulleV2('<img src=\'$photoeleve\' >');\"  onMouseOut='HideBulleV2()'>".trunchaine($mat[$i][1],$nbcaractNom)."</a> <font size='1'>$nomClasse</font> $matricule &nbsp;&nbsp;&nbsp;</td>\n";
			print "<td> $infoprobatoire  <font color='#1980b6' >".trunchaine($mat[$i][1],$nbcaractNom)." </font><font size='1'>$nomClasse</font> $matricule &nbsp;&nbsp;&nbsp;</td>\n";
			
			for($j=0;$j<$HPV[nbNote];$j++){
				print "<td><select onChange=chNote('".$nbelem."') class='form-control vat-extend-select pointer' >";
				print "<option value='' selected >".LANGPROF8."</option>";
				print "<option value='abs' title='Absent' >".LANGABS15."</option>";
				print "<option value='disp' title='Dispensé' >".LANGABS30."</option>";
				print "<option value='DNR' title='Devoir non rendu' >DNR</option>";
				print "<option value='DNN' title='Devoir non noté' >DNN</option>";
				print "<option value='VAL' title='Devoir validé' >VAL</option>";
				print "&nbsp;&nbsp;&nbsp;</td>";
				print "<td>".htmlFormTextVatel2("iNotes[$i][$j]",'',$sizenote,6)."</td>\n";
				$nbelem=$nbelem + 2;
			}
			print "</tr>\n";
        }
		print "</table>\n";
?>
<hr />
<!----------------------------------------------------->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- <input type=checkbox name=valideSaisie onclick="forceValeur();" id='btradio1' > -->
<input  type='checkbox' name='valideSaisie' onclick="forceValeur();AfficheTrimestre();document.form11.validation.disabled=true;verifSujetNote();" id='btradio1' >
<label for="btradio1"><font color=red><?php print LANGPROFC?></font></label> <?php if ($noteExamen != "") { print "<b>&nbsp;&nbsp;( ".LANGDISC60." : $noteExamen )</b>"; } ?> <br /><br/ >
<div id="infoTri1" style="display:none;"></div>
&nbsp;&nbsp;&nbsp;&nbsp;<br /><input type="submit" name="validation" value="<?php print LANGPROFD?>" class="btn btn-primary btn-sm  vat-btn-footer" /><br /><br />
<input type=hidden name="NoteExam" value="<?php print $noteExamen ?>" />
<input type=hidden name="NoteUsa" value="<?php print $_POST["NoteUsa"] ?>" />
<input type=hidden name="notevisiblele" value="<?php print $_POST["notevisiblele"] ?>" />
<input type=hidden name="NotationSur" value="<?php print $_POST["NotationSur"] ?>" />
<input type=hidden name="saisie_pers" value="<?php print $_POST["saisie_pers"] ?>" />
<script language=JavaScript>



<?php  if (VERIFSUJETNOTE == "oui") {  ?>

var deja=0;	
function AfficheTrimestre() {
	var nbnotereel=<?php print $HPV[nbNote]?>;
	if (deja == 1) {
		for (m=1;m<=nbnotereel;m++) {
			var element = document.getElementById("newSpan"); 
			var parent = element.parentNode;
			parent.removeChild(element);  
		}
	}
	if ((nbnotereel == 1) || (nbnotereel == 2) || (nbnotereel == 3)) {
		var dateT1=document.form11.elements[2].value;
		AfficheTrimestreAjax(dateT1,'<?php print $HPV[cid] ?>',"infoTri1");
	}	
	if ( (nbnotereel == 2) || (nbnotereel == 3)) {
		var dateT2=document.form11.elements[6].value;
		AfficheTrimestreAjax(dateT2,'<?php print $HPV[cid] ?>',"infoTri1");
	}
	if  (nbnotereel == 3) {
		var dateT3=document.form11.elements[10].value;
		AfficheTrimestreAjax(dateT3,'<?php print $HPV[cid] ?>',"infoTri1");
	}
	deja=1;
}

function verifSujetNote() {
	var nbnotereel=<?php print $HPV[nbNote]?>;
	var ii=2;
	var aa=0;
	for (i=1;i<=nbnotereel;i++) {
		var date=document.form11.elements[ii].value;
		var sujet=document.form11.elements[aa].value;
		ii=ii+4;
		aa=aa+4;
		verifSujet(sujet,date,<?php print $HPV[cid] ?>,<?php print $HPV[gid] ?>,<?php print $HPV[mid] ?>);
	}
	var nbnotereel=<?php print $HPV[nbNote]?>;
	if (nbnotereel > 1) {
		var a=0;
		sujet1=document.form11.elements[a].value;
		if (nbnotereel == 2) {
			a=a+4
			sujet2=document.form11.elements[a].value;
			if (sujet2 == sujet1){
				errfound=true;
				alert("<?php print LANGALERT4 ?>");
				document.form11.valideSaisie.checked=false;
				force=0;
			}
		}
		if (nbnotereel == 3) {
			a=a+4
			sujet2=document.form11.elements[a].value;
			a=a+4
			sujet3=document.form11.elements[a].value;
			if ((sujet2 == sujet1) || (sujet2 == sujet3) || (sujet1 == sujet3)){
				errfound=true;
				alert("<?php print LANGALERT4 ?>");		
				document.form11.valideSaisie.checked=false;
				force=0;
			}
		}		
	}
}
<?php }else{  ?>
		function verifSujetNote() {
			// aucun traitement
			document.form11.validation.disabled=false;
		}
<?php } ?>


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


function trans_date(nb) {
	val=eval('document.form11.iDate'+nb+'.value');
	if (nb == 0) {
		nb = nb + 3;
		document.form11.elements[nb].value=val;
	}
	if (nb == 1) {
                nb = nb + 6;
		document.form11.elements[nb].value=val;
        }
	if (nb == 2) {
                nb = nb + 9;
		document.form11.elements[nb].value=val;
        }

}

function valide_note() {


<?php
if ($HPV[nbNote] == 1) {
	print "trans_date(0);";
}elseif ($HPV[nbNote] == 2) {
	print "trans_date(0);";
	print "trans_date(1);";
}else {
	print "trans_date(0);";
	print "trans_date(1);";
	print "trans_date(2);";
}

if ($noteusa == "oui") {
	print "var noteusa=1;";
}else{
	print "var noteusa=0;";
}

?>

var errfound=false;

if (force  != 1) {
var notationsur=<?php print $notationSur?>;
var nbnotereel=<?php print $HPV[nbNote]?>;
var aa=0;
var nbnote=<?php print $HPV[nbNote] * count($mat) + $HPV[nbNote] * 4 - 1  + 3 + 2 * count($mat) + count($mat) * $HPV[nbNote]  ?>;
var a=<?php print $HPV[nbNote] * 4  + 3 + 2 + 1  ?>;



for ( a ; a <= nbnote ; a++ ) {
		if  (document.form11.elements[a].value.length < 1) {
			document.form11.elements[a].select();
			document.form11.elements[a].focus();
			errfound=true;
			document.form11.elements[a].value=" ";
			break;
		}

	if (noteusa == 0) {   // note sur 20,10,5
		if  (document.form11.elements[a].value < 0  ||  document.form11.elements[a].value > notationsur ) {
			alert(langfunc68+" "+notationsur);
			document.form11.elements[a].select();
			document.form11.elements[a].focus();
			errfound=true;
			break;
		}
	}else{  // note sur 100
		if  (document.form11.elements[a].value < 0  ||  document.form11.elements[a].value > 100 ) {
				alert(langfunc68bis + " 100");
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
			if ((document.form11.elements[a].value != "abs")  && (document.form11.elements[a].value != "disp") && (document.form11.elements[a].value != "DNN") && (document.form11.elements[a].value != "DNR") && (document.form11.elements[a].value != "VAL") ) {
				alert(langfunc71);
				document.form11.elements[a].select();
				document.form11.elements[a].focus();
				errfound=true;
				break;
			}
		}
		a++;


		if (nbnotereel == 1 ) {
			a=a+2;
		}
		if (nbnotereel == 2 ) {
			if (aa==0) {
				aa=1;
			}else {
				a=a+2;
				aa=0;
			}
		}
		if (nbnotereel == 3 ) {
			if ((aa==0) || (aa==1)) {
				if (aa==1) {
					aa=2;
				}
				if (aa==0) {
	 				aa=1;
				}
			}else {
				a=a+2;
				aa=0;
			}
		}
}
}


if (force == 1) {
	var notationsur=<?php print $notationSur?>;
	valide=1;
	if (valide) {
		j=0;
		force=1;	
		for ( b=0 ; b < <?php print $HPV[nbNote]?> ; b++ ) {
			if (document.form11.elements[j].value.length < 3) {
			alert(langfunc72);
			document.form11.elements[j].select();
			document.form11.elements[j].focus();
			errfound=true;
			break;
			}
			j++;

			if (document.form11.elements[j].value.length < 1) {
			alert(langfunc73);
			document.form11.elements[j].select();
			document.form11.elements[j].focus();
			errfound=true;
			break;
			}
			if (document.form11.elements[j].value.indexOf (',') != -1) {
			alert(langfunc69);
			document.form11.elements[j].select();
			document.form11.elements[j].focus();
			errfound=true;
			break;
			}
			



<?php if ( $_SESSION["navigateur"] == "IE" ) { ?>
			if (document.form11.elements[j].value.indexOf ('.') != -1) {
			pos=document.form11.elements[j].value.indexOf ('.')
			long=document.form11.elements[j].value.length;
			total=long - pos ;
				if (total > 3 ) {
				alert(langfunc70);
				document.form11.elements[j].select();
				document.form11.elements[j].focus();
				errfound=true;
				break;
				}
			}
<?php } ?>
			if (isNaN(document.form11.elements[j].value)) {
			alert(langfunc74);
			document.form11.elements[j].select();
			document.form11.elements[j].focus();
			errfound=true;
			break;
			}
			j++;


			if (document.form11.elements[j].value.length != 10) {
			alert(langfunc75);
			document.form11.elements[j].select();
			document.form11.elements[j].focus();
			errfound=true;
			break;
			}

			if (!ValidCaractere(document.form11.elements[j].value)){
			alert(langfunc75);
			document.form11.elements[j].select();
			document.form11.elements[j].focus();
                        errfound=true;
			break;
			}
			j++;j++;

		}

		var nbnotereel=<?php print $HPV[nbNote]?>;
		var aa=0;
		var nbnote=<?php print $HPV[nbNote] * count($mat) + $HPV[nbNote] * 4 - 1  + 3 + 2 * count($mat) + count($mat) * $HPV[nbNote]?>;
		var a=<?php print $HPV[nbNote] * 4  + 3 + 2 + 1?>;

		for ( a ; a <= nbnote ; a++ ) {
			if  (document.form11.elements[a].value.length < 1) {
//			errfound=true;
			document.form11.elements[a].value=" ";
			break;
			}
		if (noteusa == 0) {   // note sur 20,10,5
			if  (document.form11.elements[a].value < 0  ||  document.form11.elements[a].value > notationsur ) {
			alert(langfunc68+" "+notationsur);
			document.form11.elements[a].select();
			document.form11.elements[a].focus();
			errfound=true;
			break;
			}
		}else {  // note sur 100
			if  (document.form11.elements[a].value < 0  ||  document.form11.elements[a].value > 100 ) {
			alert(langfunc68bis + " 100");
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
				if ((document.form11.elements[a].value != "abs")  && (document.form11.elements[a].value != "disp") && (document.form11.elements[a].value != "DNN") && (document.form11.elements[a].value != "DNR") && (document.form11.elements[a].value != "VAL") ) {
					alert(langfunc71);
					document.form11.elements[a].select();
					document.form11.elements[a].focus();
					errfound=true;
					break;
				}
			}

			a++;

			if (nbnotereel == 1 ) {
				a=a+2;
			}
			if (nbnotereel == 2 ) {
				if (aa==0) {
					aa=1;
				}else {
					a=a+2;
					aa=0;
				}
			}
			if (nbnotereel == 3 ) {
                        	if ((aa==0) || (aa==1)) {
                                	if (aa==1) {
                                        	aa=2;
                                	}
                               	 	if (aa==0) {
                                        	aa=1;
                                	}
                       	 	}else {
                                	a=a+2;
                  	              aa=0;
                        	}
                	}
		}
	}
}



if (force) {
	if (errfound == false) {
		document.form11.validation.disabled=true;
		document.getElementById('attenteDiv').style.visibility='visible';	
	}
	return !errfound;
}else {
	return false;

}

}

AfficheTrimestre();

</script>
<SCRIPT language="JavaScript">InitBulleV2("#000000","#CCCCCC","red",1);</SCRIPT>

<!---------------------------------------------------->

	
		</section>
		</div>
		</div>
	</div>
<?php 
} 
Pgclose();
include_once("piedpage.php");
include_once("connexionEnCours.php");
?>
</body>
</html>
