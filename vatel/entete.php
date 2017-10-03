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
session_start();


if (($_SESSION["membre"] == "menuviescolaire") || ($_SESSION["membre"] == "menupersonnel") || ($_SESSION["membre"] == "menututeur") || (isset($_SESSION["admin1"]))) {
	session_set_cookie_params(0);
	$_SESSION=array();
	session_unset();
	session_destroy();
	header("Location:index.php");
	exit();
}

$pageaccueil=true;
if ( (!preg_match('/\/index.php/',$_SERVER['SCRIPT_NAME'])) &&  (!preg_match('/\/index3.php/',$_SERVER['SCRIPT_NAME'])) &&  (!preg_match('/\/index1.php/',$_SERVER['SCRIPT_NAME']))  &&  (!preg_match('/\/index2.php/',$_SERVER['SCRIPT_NAME']))  && (!preg_match('/\/mplost.php/',$_SERVER['SCRIPT_NAME'])) && (!preg_match('/\/verrou.php/',$_SERVER['SCRIPT_NAME']))    ) { 
	$pageaccueil=false;
	if (!isset($_SESSION["id_pers"])) {
		header("Location:index.php");
		exit;
	}
}

if (preg_match('/\/verrou.php/',$_SERVER['SCRIPT_NAME'])) {
	$nom=$_SESSION["nom"];
	$prenom=$_SESSION["prenom"];
	$membre=$_SESSION["membre"];
	$langue=$_SESSION["langue"];
	$email=$_SESSION["email"];
	session_set_cookie_params(0);
	$_SESSION=array();
	session_unset();
	session_destroy();
}

include_once("Mobile_Detect.php");
$detect = new Mobile_Detect();
$isPhone = $detect->isMobile() || $detect->isTablet();



if (isset($_COOKIE["langue-triade"])) {
	$lang=$_COOKIE["langue-triade"];
}else{
	$lang="fr";
}

if (isset($_GET["lang"])) {
	$lang=$_GET["lang"];
	setcookie("langue-triade","$lang",time()+3600*24*2);
}


if (strtolower($lang) == "fr") { include_once("../librairie_php/langue-text-fr.php"); }
if (strtolower($lang) == "en") { include_once("../librairie_php/langue-text-en.php"); }


include_once("../common/config2.inc.php");


?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8" lang="fr"><![endif]-->
<!--[if IE 9]><html class="ie ie9" lang="fr"><![endif]-->
<!--[if gt IE 9]><!--><html lang="fr"><!--<![endif]-->
<head>
    <title> Ecole Internationale d'h&ocirc;tellerie et de management Vatel </title>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/superslides.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/pikaday.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/masonry.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/layout-responsive.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/color_scheme/darkblue.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/vatel.css" rel="stylesheet" type="text/css" media="screen"> 
    <link href="css/vatel-print.css" rel="stylesheet" type="text/css" media="print">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <script type="text/javascript" src="assets/plugins/modernizr.min.js"></script>

	<script type='text/javascript' src="../librairie_php/server.php?client=Util,main,dispatcher,httpclient,request,json,loading,iframe"></script>
	<script type='text/javascript' src="../librairie_php/auto_server.php?client=all&stub=livesearch"></script>

	
<?php  if  ( (preg_match('/\/cahiertext-visu.php/',$_SERVER['SCRIPT_NAME'])) ||  (preg_match('/\/ajoutcahiertext2.php/',$_SERVER['SCRIPT_NAME'])) ) { ?>    
    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
    <link href="./calendar/css/responsive-calendar.css" rel="stylesheet">
<?php } ?>


<?php  if  (preg_match('/\/edtvisu.php/',$_SERVER['SCRIPT_NAME']))  { ?>    
	<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
	<link rel='stylesheet' href='fullcalendar/lib/cupertino/jquery-ui.min.css' />
     	<script src='fullcalendar/lib/jquery.min.js'></script>
     	<script src='fullcalendar/lib/moment.min.js'></script>
     	<script src='fullcalendar/fullcalendar.js'></script>
	<script src='fullcalendar/lang-all.js'></script>
	<link href='fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<?php } ?>

<?php
if (strtolower($lang) == "fr") { print "<script src='../librairie_js/langue-function-fr.js' ></script>"; print "<script>var lang_lang='fr_FR'; </script>"; }
if (strtolower($lang) == "en") { print "<script src='../librairie_js/langue-function-en.js' ></script>"; print "<script>var lang_lang='en';    </script>"; }
?>
	<?php  if  (preg_match('/\/ajoutnotes2.php/',$_SERVER['SCRIPT_NAME']))  { ?>    
				<script language="JavaScript" src="./info-bulle.js"></script>
	<?php } ?>
	<script language="JavaScript" src="../librairie_js/function.js"></script>
	<script language="JavaScript" src="../librairie_js/lib_note.js"></script>
	<script type="text/javascript">
<?php
$choixmatiere='1';
if (defined("CHOIXMATIEREPROF")) {
	$choixmatiere=CHOIXMATIEREPROF;
}
if (trim($choixmatiere) == "") { $choixmatiere='1'; }
?>
function upSelectMat(arg) {
	for(i=1;i<document.formulaire.sMat.options.length;i++){
		document.formulaire.sMat.options[i].value='';
		document.formulaire.sMat.options[i].text='';
	}
	var tmp=arg.value.split(":");
	var clas=tmp[0];
	var grp=tmp[1];
	var opt='<?php print $choixmatiere ?>';
	for(i=0;i<affectation.length;i++) {
		if(affectation[i][0] == clas && affectation[i][4] == grp) {
		myOpt=new Option();
		myOpt.value = affectation[i][2];
		myOpt.text = affectation[i][3];
		myOpt.text = myOpt.text.replace(/ 0 *$/,"");   // supprime le 0 de la matiere ajout ET
		document.formulaire.sMat.options[opt]=myOpt;
		opt++;
		}
	}
	return true;
}


function upSelectMat2(arg) {
	for(i=1;i<document.formulaire2.sMat.options.length;i++){
		document.formulaire2.sMat.options[i].value='';
		document.formulaire2.sMat.options[i].text='';
	}
	var tmp=arg.value.split(":");
	var clas=tmp[0];
	var grp=tmp[1];
	var opt='<?php print $choixmatiere ?>';;
	for(i=0;i<affectation.length;i++) {
		if(affectation[i][0] == clas && affectation[i][4] == grp) {
		myOpt=new Option();
		myOpt.value = affectation[i][2];
		myOpt.text = affectation[i][3];
		myOpt.text = myOpt.text.replace(/ 0 *$/,"");   // supprime le 0 de la matiere ajout ET
		document.formulaire2.sMat.options[opt]=myOpt;
		opt++;
		}
	}
	return true;
}
</script>

	<?php  if  (preg_match('/\/modifiernotes3.php/',$_SERVER['SCRIPT_NAME']))  { ?>
				<script type="text/javascript" src="../librairie_js/ajax-note.js"></script>
				<script type="text/javascript" src="../librairie_js/prototype.js"></script>
				<script type="text/javascript" src="../librairie_js/scriptaculous.js"></script>
				<script type="text/javascript" src="../librairie_js/ajax_ajoutnote.js"></script>
	<?php } ?>
	
	<?php  if  (preg_match('/\/ajoutnotes2.php/',$_SERVER['SCRIPT_NAME']))  {    ?>
				<script language="JavaScript" src="../librairie_js/ajax-note-vatel.js"></script>
				<script language="JavaScript" src="../librairie_js/prototype.js"></script>
				<script language="JavaScript" src="../librairie_js/lib_cal1.js"></script>
				<script language="JavaScript" src="../librairie_js/info-bulle.js"></script>
	<?php } ?>
	
	
	<?php  if ( (preg_match('/\/modifiernotes.php/',$_SERVER['SCRIPT_NAME']))  
			||  (preg_match('/\/ajoutabsRtdSanc.php/',$_SERVER['SCRIPT_NAME']))  
			||  (preg_match('/\/ajoutcahiertext.php/',$_SERVER['SCRIPT_NAME']))   
			|| 	(preg_match('/\/supprimernotes.php/',$_SERVER['SCRIPT_NAME'])) 
			|| 	(preg_match('/\/visunotes.php/',$_SERVER['SCRIPT_NAME'])) )  { ?>
		<?php genMatJs('affectation',$data); ?>
	<?php } ?>
	
	<?php  if  (preg_match('/\/ficheeleve3.php/',$_SERVER['SCRIPT_NAME'])) { ?>
			<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/menu-tab.css">
			<script type="text/javascript" src="../librairie_js/prototype.js"></script>
			<script type="text/javascript" src="../librairie_js/scriptaculous.js"></script>
			<script type="text/javascript" src="../librairie_js/ajaxNoteVisu-vatel.js"></script>
			<script language="JavaScript"  src="../librairie_js/lib_absrtdplanifier.js"></script>
			<script type="text/javascript" src="../librairie_js/ajax-menu-tab.js"></script>
			<script type="text/javascript" src="../librairie_js/menu-tab.js"></script>
	<?php } ?>

	
	<?php  if  (preg_match('/\/ajoutcahiertext2.php/',$_SERVER['SCRIPT_NAME'])) { ?>
					<script type="text/javascript" src="../librairie_js/prototype.js"></script>
					<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
					<script type="text/javascript" src="../librairie_js/ajax_actualisepiecejointecahiertext.js"></script>
					
	<?php } ?>

<?php  if  (preg_match('/\/certificat_param.php/',$_SERVER['SCRIPT_NAME'])) { ?>
<script type="text/javascript">
_editor_url = "../HTMLArea";
_editor_lang = "fr";
</script>
<script type="text/javascript" src="../HTMLArea/htmlarea-pdf.js"></script>
<script type="text/javascript">
HTMLArea.loadPlugin("ContextMenu");
HTMLArea.loadPlugin("TableOperations");
function initDocument() {
  var editor = new HTMLArea("editor");
  editor.registerPlugin(ContextMenu);
  //editor.registerPlugin(TableOperations);
  editor.generate();
}
</script>
<?php } ?>	
	
<script  language="JavaScript">
function fonc1() {
	var indexselect=document.formulaire.saisie_heure.options.selectedIndex;
	document.formulaire.reset();
	document.formulaire.retard_aucun.checked=true;
	document.formulaire.rien.disabled=false;
	document.formulaire.saisie_heure.options.selectedIndex=indexselect;
}

function fonc2() {
	var op=document.formulaire.saisie_heure.options.selectedIndex;
	if (document.formulaire.saisie_heure.options[op].value == "null") {
		document.getElementById('rien').disabled=true;
	}else{
		document.getElementById('rien').disabled=false;
	}
}

</script>

	
    <style>
    .lien:hover { text-decoration:none;color:#CCCCCC; }
    .lien 	{ color:#FFFFFF;text-decoration:none; }
    </style>

</head>
<body itemscope itemtype="http://schema.org/WebPage">
<header id="topHead" class="vat-top-head">
    <div class="container">
        <a class="vat-logo" href="accueil.php">
            <img src="images/vat-logo-header.png" alt="" >
        </a>
        <div class="btn-group pull-right">
            <button class="dropdown-toggle language vat-font-white" type="button" data-toggle="dropdown">

<?php
if ($lang == "fr") { ?>
    <img src="assets/images/flags/fr.png" width="16" height="11" alt="Francais"> Francais <span class="caret"></span></button>
<?php }else{ ?>
	<img src="assets/images/flags/en.png" width="16" height="11" alt="Francais"> English <span class="caret"></span></button>
<?php } ?>
<ul class="dropdown-menu">
	<li><a href="<?php print $_SERVER['SCRIPT_NAME']?>?lang=fr"><img src="assets/images/flags/fr.png" width="16" height="11" alt="FR"> [FR] Francais</a></li>
	<li><a href="<?php print $_SERVER['SCRIPT_NAME']?>?lang=en"><img src="assets/images/flags/en.png" width="16" height="11" alt="EN"> [EN] English</a></li>
</ul>
</div>
        <div class="pull-right nav hidden-xs">
            <p class="vat-baseline">ECOLE INTERNATIONALE D'H&Ocirc;TELLERIE ET DE MANAGEMENT VATEL</p>
        </div>
    </div>
</header>
