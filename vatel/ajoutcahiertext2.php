<?php
$anneeScolaire=$_COOKIE["anneeScolaire"];
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
 ?>
<?php include_once("entete.php"); ?>
<?php include_once("menu.php"); ?>
<?php include_once("../librairie_php/calendar.php"); ?>
<?php $cnx=cnx2(); ?>
<?php
$anneeScolaire=$_COOKIE["anneeScolaire"];
$idMatiere=$sMat=$_POST["sMat"];
$sClasseGrp=$_POST["sClasseGrp"];

$listTmp=explode(":",$_POST["sClasseGrp"]);
$idClasse=$listTmp[0];
$gid=$listTmp[1];
$list2=$listTmp[1];
$list1=$listTmp[0];
unset($listTmp);

$datepour=dateDMY();

if (isset($_GET["date"])) { 
	$idClasse=$_GET["idclasse"];
	$sMat=$idMatiere=$_GET["idmatiere"];
	$datepour=$_GET["date"];
	$classorgrp=$_GET["classorgrp"];
	$list1=$_GET["list1"];
}

$nomMatiere=chercheMatiereNom($idMatiere);
$nomClasse=chercheClasse_nom($idClasse);
$idPers=$_SESSION["id_pers"];

if (isset($_SESSION["idprofviaadmin"])) {
	$idPers=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($idPers);
}


if (isset($_POST["date_contenu"])) $datepour=$_POST["date_contenu"];
if (($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { 

$data=recherche_contenu_scolaire_($datepour,$classorgrp,$sMat,$list1,$idPers);
//id,id_class_or_grp,matiere_id,date_saisie,heure_saisie,classorgrp,number,contenu,objectif,date_contenu,idprof,number_obj,blocnote
$contenu=$data[0][7];
$objectif=$data[0][8];

?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGPROF37 ?> / <font color='green'><?php print $nomClasse ?></font> / <font color='green'><?php print $nomMatiere ?></font> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<?php print "<li style='visibility:visible' ><a href='cahiertext-visu.php' >".LANGVATEL36."</a></li>"; ?>
				<li style='visibility:visible' ></li>
			</ul>
			</div>
		</header>
		<div class='espace'></div>
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<form method='post' name="form1" >
<script type="text/javascript">
tinymce.init({
    save_onsavecallback: function() {savecontenu();},
    save_enablewhendirty: true,
    language : lang_lang,
    selector: "textarea#elm2",
    statusbar : false,
    width: '100%',
    height: '240',
    browser_spellcheck : true,
    menubar : "tools table format edit ",
    plugins: [ "textcolor","link", "save"], 
    element_format : "html",
    protect: [
        /\<\/?(if|endif)\>/g, 
        /\<xsl\:[^>]+\>/g, 
	/<\?php.*?\?>/g,
	/\<script/ig,
	/<\?.*\?>/g
	],
	schema: "html4",
<?php	
     if (($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { ?>
    	toolbar: "forecolor | bold italic | bullist numlist outdent indent | link | save"
<?php }else{ ?>
	toolbar: "undo redo "
<?php } ?>
});

</script>
<font class='T2'><?php print LANGVATEL38 ?> : </font><input type=text name="date_contenu" id='date_contenu1' value="<?php print $datepour ?>"  size='12' class="dateInput" onKeyPress="onlyChar(event)"  >
<?php
calendarVatel("id1","document.form1.date_contenu",$_SESSION["langue"],"0");
?>
<input type='hidden'   name="sMat" value="<?php print $idMatiere ?>" >
<input type='hidden'   name="sClasseGrp" value="<?php print $sClasseGrp ?>" >
<input type='submit' value="<?php print VALIDER ?>" class="btn btn-primary btn-sm  vat-btn-footer" />
</form>
<form method='post' name="form112" >
<br><br>
<font class='T2 text colorText'><?php print LANGMESS95 ?></font><br><br>
<textarea id='elm2' name="saisie_contenu" ><?php print $objectif ?></textarea>  
<input type='hidden' id="saisie_idmatiere2" value="<?php print $sMat?>" >
<input type='hidden'   id="date_contenu2" value="<?php print $datepour ?>" >
<input type='hidden' id="tempsestime2" value="<?php print $tempsestimedevoir?>" >
<input type='hidden' id="saisie_idclsorgrp2" value="<?php print $list1?>" >
<input type='hidden' id="saisie_clsorgrp2" value="<?php print $list2?>" >
<input type='hidden' id="sClasseGrp2" value="<?php print $sClasseGrp?>" >
<input type='hidden' id="sMat2" value="<?php print $sMat?>" >
<input type='hidden' id="number2" value="" >
</form>

<?php 
/******************************************************************/
?>

<?php
print "<form method=post name='form12' >";
$data=recherche_devoir_scolaire_2($datepour,$list2,$sMat,$list1,$idPers);
//id,id_class_or_grp,matiere_id,date_saisie,heure_saisie,date_devoir,texte,classorgrp,number,idprof,tempsestimedevoir
$travail=$data[0][6];
$number=$data[0][8];
if ($number == "") {
	$idpiecejointe3=md5("3".$_SESSION["membre"].$_SESSION["id_pers"].date("YMDHms").rand(0,9999));
}else{
	$idpiecejointe3=$number;
}
$tempsestimedevoir=$data[0][10];
?>

<script type="text/javascript">
tinymce.init({
    save_onsavecallback: function() {savecontenu();},
    save_enablewhendirty: true,
    language : lang_lang,
    selector: "textarea#elm3",
    statusbar : false,
    width: '100%',
    height: '240',
    browser_spellcheck : true,
    menubar : "format edit table ",
    plugins: ["textcolor emoticons","link","table","save"],
    element_format : "html",
    protect: [
        /\<\/?(if|endif)\>/g, 
        /\<xsl\:[^>]+\>/g, 
	/<\?php.*?\?>/g,
	/\<script/ig,
	/<\?.*\?>/g
	],
	schema: "html4",
   <?php	
     if (($_SESSION["membre"] == "menuprof") || (DIRCAHIERTEXTE == "oui") || ($_SESSION["membre"] == "menuadmin") ) { ?>
    	toolbar: "forecolor | bold italic | textcolor | emoticons |  bullist numlist outdent indent | link | save"
<?php }else{ ?>
	toolbar: "undo redo "
<?php } ?>
});

</script>

<?php
print "<br>&nbsp;&nbsp;<font class='T2 text colorText'>".LANGPROFJ;

	


print 	"</font><br /><br>";

if ( (isset($_GET["tempsestime"]))  && (trim($_GET["tempsestime"]) != "" )) {
	$tempsestime=$_GET["tempsestime"];
}else{
	$tempsestime='hh:mm';
}

print "&nbsp;&nbsp;<font class='T2'>".LANGMESS103." : 
	<select id='tempsestime3' >";
	if (($tempsestimedevoir != "00:00:00") && ($tempsestimedevoir != "")) {
		if ($tempsestimedevoir == "00:10:00") { $tempstime="10mn"; }
		if ($tempsestimedevoir == "00:15:00") { $tempstime="15mn"; }
		if ($tempsestimedevoir == "00:20:00") { $tempstime="20mn"; }
		if ($tempsestimedevoir == "00:25:00") { $tempstime="25mn"; }
		if ($tempsestimedevoir == "00:30:00") { $tempstime="30mn"; }
		if ($tempsestimedevoir == "00:35:00") { $tempstime="35mn"; }
		if ($tempsestimedevoir == "00:40:00") { $tempstime="40mn"; }
		if ($tempsestimedevoir == "00:45:00") { $tempstime="45mn"; }
		if ($tempsestimedevoir == "00:50:00") { $tempstime="50mn"; }
		if ($tempsestimedevoir == "00:55:00") { $tempstime="55mn"; }
		if ($tempsestimedevoir == "01:00:00") { $tempstime="1h00"; }
		if ($tempsestimedevoir == "01:15:00") { $tempstime="1h15"; }
		if ($tempsestimedevoir == "01:30:00") { $tempstime="1h30"; }
		if ($tempsestimedevoir == "01:45:00") { $tempstime="1h45"; }
		if ($tempsestimedevoir == "02:00:00") { $tempstime="2h00"; }
		if ($tempsestimedevoir == "02:30:00") { $tempstime="2h30"; }
		if ($tempsestimedevoir == "03:00:00") { $tempstime="3h00"; }
		if ($tempsestimedevoir == "04:00:00") { $tempstime="4h00"; }
		print "<option value='$tempsestimedevoir'  id='select1'>$tempstime</option>";

	}
print "	<option value='00:00:00' id='select0'> ".LANGMESS97." </option>
	<option value='00:10:00' id='select1'> 10mn </option>
	<option value='00:15:00' id='select1'> 15mn </option>
	<option value='00:20:00' id='select1'> 20mn </option>
	<option value='00:25:00' id='select1'> 25mn </option>
	<option value='00:30:00' id='select1'> 30mn </option>
	<option value='00:35:00' id='select1'> 35mn </option>
	<option value='00:40:00' id='select1'> 40mn </option>
	<option value='00:45:00' id='select1'> 45mn </option>
	<option value='00:50:00' id='select1'> 50mn </option>
	<option value='00:55:00' id='select1'> 55mn </option>
	<option value='01:00:00' id='select1'> 1h00 </option>
	<option value='01:15:00' id='select1'> 1h15  </option>
	<option value='01:30:00' id='select1'> 1h30  </option>
	<option value='01:45:00' id='select1'> 1h45  </option>
	<option value='02:00:00' id='select1'> 2h00  </option>
	<option value='02:30:00' id='select1'> 2h30  </option>
	<option value='03:00:00' id='select1'> 3h00  </option>
	<option value='04:00:00' id='select1'> 4h00  </option>
	</select> 
	</font>";
print "<br><br>";
?>

	<textarea id='elm3' name="saisie_contenu" ><?php print $travail ?></textarea><br><br>

<?php
	if (($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { 
	$taille="2Mo";
	$maxsize="2000000";
	if (UPLOADIMG == "oui") { $taille="8Mo"; $maxsize="8000000"; }
?>
<br/>
(<?php print LANGTMESS414 ?> max : <?php print $taille ?> )<br/>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" style="width:292px;height:54px" width="292" height="54" id="fileUpload" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="../librairie_php/fileUploadcahiertext.swf" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<param name=FlashVars value="idpiecejoint=<?php print trim($idpiecejointe3) ?>&maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>">
<?php $couleur=couleurFont(GRAPH); ?>
<param name="bgcolor" value="<?php print $couleur ?>" />
<embed style="width:292px;height:54px" src="../librairie_php/fileUploadcahiertext.swf" quality="high" bgcolor="<?php print $couleur ?>"  wmode="transparent"
       name="fileUpload" align="middle" allowScriptAccess="sameDomain" 
       type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="idpiecejoint=<?php print trim($idpiecejointe3) ?>&maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>" />
</object>
<?php } ?>
<div id="listingpiecejointe3" style="position:relative;top:-150px ; width:100%;height:50;overflow:auto" ></div>
<input type='hidden' id="saisie_idmatiere3" value="<?php print $sMat?>" >
<input type='hidden' id="saisie_idclsorgrp3" value="<?php print $list1?>" >
<input type='hidden' id="saisie_clsorgrp3" value="<?php print $list2?>" >
<input type='hidden' id="date_contenu3" value="<?php print $datepour?>" >
<input type='hidden' id="sClasseGrp3" value="<?php print $sClasseGrp?>" >
<input type='hidden' id="sMat3" value="<?php print $sMat?>" >
<input type='hidden' id="saisie_date3" value="<?php print $datepour?>" >
<input type='hidden' id="number3" value="<?php print $idpiecejointe3 ?>" >
</form>





<input type='hidden' id='choix' value='0' /> 



		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre  */ ?>    
	
<?php Pgclose(); ?>
	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>


<script>
function savecontenu() {
	var choix=document.getElementById('choix').value;
	tinyMCE.triggerSave();
	var ok3='0';
	var ok2='0';
//------------------------------------------------------------------------------------------------------------

	var saisie_idmatiere=document.getElementById('saisie_idmatiere2').value;
	var tempsestime=document.getElementById('tempsestime2').value;
	var date_contenu=document.getElementById('date_contenu2').value;
	var saisie_idclsorgrp=document.getElementById('saisie_idclsorgrp2').value;
	var saisie_clsorgrp=document.getElementById('saisie_clsorgrp2').value;
	var sClasseGrp=document.getElementById('sClasseGrp2').value;
	var sMat=document.getElementById('sMat2').value;
	var saisie_contenu=escape(document.getElementById('elm2').value);
	var num=document.getElementById('number2').value;
	var myAjax = new Ajax.Request(
		"../ajaxEnrDevoir.php",
		{	method: "post",
			asynchronous: false,
			parameters: "etape=2&saisie_idmatiere="+saisie_idmatiere+"&tempsestime="+tempsestime+"&date_contenu="+date_contenu+"&saisie_idclsorgrp="+saisie_idclsorgrp+"&saisie_clsorgrp="+saisie_clsorgrp+"&sClasseGrp="+sClasseGrp+"&sMat="+sMat+"&saisie_contenu="+saisie_contenu+"&number="+num,
			timeout: 5000,
			onComplete: function (request) {
				if ("ok" == request.responseText)  {
					ok2="1"; 
				}else{
					ok2="0";    
				}
			}
		}
	);

// ----------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------
	var saisie_idmatiere=document.getElementById('saisie_idmatiere3').value;
	var date_contenu=document.getElementById('date_contenu3').value;
	var saisie_idclsorgrp=document.getElementById('saisie_idclsorgrp3').value;
	var saisie_clsorgrp=document.getElementById('saisie_clsorgrp3').value;
	var sClasseGrp=document.getElementById('sClasseGrp3').value;
	var sMat=document.getElementById('sMat3').value;
	var saisie_contenu=escape(document.getElementById('elm3').value);
	var num=document.getElementById('number3').value;
	var date_devoir=document.getElementById('date_contenu1').value;
	var selectElmt=document.getElementById('tempsestime3');
    var tempsestime=selectElmt.options[selectElmt.selectedIndex].value;

	var myAjax = new Ajax.Request(
		"../ajaxEnrDevoir.php",
		{	method: "post",
			asynchronous: false,
			parameters: "etape=3&saisie_idmatiere="+saisie_idmatiere+"&date_contenu="+date_contenu+"&saisie_idclsorgrp="+saisie_idclsorgrp+"&saisie_clsorgrp="+saisie_clsorgrp+"&sClasseGrp="+sClasseGrp+"&sMat="+sMat+"&saisie_contenu="+saisie_contenu+"&number="+num+"&date_devoir="+date_devoir+"&tempsestime="+tempsestime,
			timeout: 5000,
			onComplete: function (request) {
				if ("ok" == request.responseText)  {
					ok3="1"; 
				}else{
					ok3="0";    
				}
			}
		}
	);
// ----------------------------------------------------------------------------------------------------------------
	if (ok2  && ok3 ) {
		alert("<?php print LANGDONENR ?>");
	}else{
		alert("<?php print LANGVATEL37 ?> !!!");
	}	
	//open("ajoutcahiertext2.php?aff="+choix+"&date_convenu=<?php print $datepour ?>&sClasseGrp=<?php print $sClasseGrp ?>&sMat=<?php print $sMat ?>","_self","");
}

function updatefichier(item) {
	if (item == "ok") {
		ajaxActualisePieceJointeCahierText2('<?php print $idpiecejointe3 ?>','listingpiecejointe','3');	
	}
}

updatefichier("ok"); 

</script>



</body>
</html>
