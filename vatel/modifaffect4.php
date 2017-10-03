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
 *<script language="JavaScript" src="./librairie_js/clickdroit2.js"></script>

 ***************************************************************************/
 
 
$anneeScolaire=$_COOKIE["anneeScolaire"];
if (isset($_POST["anneeScolaire"])) {
        $anneeScolaire=$_POST["anneeScolaire"];
        setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}
 
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
include_once("../common/config.inc.php");
include_once('../librairie_php/db_triade.php');


?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content ="no-cache">
<META http-equiv="pragma" content ="no-cache">
<META http-equiv="expires" content ="-1">
<meta name="Copyright" content="Triade©, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="../librairie_js/function.js"></script>
<script language="JavaScript" src="../librairie_js/lib_css.js"></script>
<script language="JavaScript" src="../librairie_js/clickdroit2.js"></script>
<title> Ecole Internationale d'h&ocirc;tellerie et de management Vatel </title>
<?php
if (strtolower($lang) == "fr") { print "<script src='../librairie_js/langue-function-fr.js' ></script>"; print "<script>var lang_lang='fr_FR'; </script>"; }
if (strtolower($lang) == "en") { print "<script src='../librairie_js/langue-function-en.js' ></script>"; print "<script>var lang_lang='en';    </script>"; }
	?>
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
	<?php
	?>
<style type="text/css">

	/* Don't change these options */
	#movableNode{
		position:absolute;
	}
	
	#arrDestInditcator{
		position:absolute;
		display:none;
		width:100px;
	}
	/* End options that shouldn't be changed */

	
	#arrangableNodes,#movableNode ul{
		padding-left:0px;
		margin-left:0px;
		margin-top:0px;
		padding-top:0px;
	}
	
	#arrangableNodes li,#movableNode li{
		list-style-type:none;
		cursor:default;
	}

	</style>
	
	<script type="text/javascript">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, October 2005
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	
	
	var offsetYInsertDiv = -3; // Y offset for the little arrow indicating where the node should be inserted.
	if(!document.all)offsetYInsertDiv = offsetYInsertDiv - 7; 	// No IE

	
	var arrParent = false;
	var arrMoveCont = false;
	var arrMoveCounter = -1;
	var arrTarget = false;
	var arrNextSibling = false;
	var leftPosArrangableNodes = false;
	var widthArrangableNodes = false;
	var nodePositionsY = new Array();
	var nodeHeights = new Array();
	var arrInsertDiv = false;
	var insertAsFirstNode = false;
	var arrNodesDestination = false;
	function cancelEvent()
	{
		return false;
	}
	function getTopPos(inputObj)
	{
		
	  var returnValue = inputObj.offsetTop;
	  while((inputObj = inputObj.offsetParent) != null){
	  	returnValue += inputObj.offsetTop;
	  }
	  return returnValue;
	}
	
	function getLeftPos(inputObj)
	{
	  var returnValue = inputObj.offsetLeft;
	  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetLeft;
	  return returnValue;
	}
		
	function clearMovableDiv()
	{
		if(arrMoveCont.getElementsByTagName('LI').length>0){
			if(arrNextSibling)arrParent.insertBefore(arrTarget,arrNextSibling); else arrParent.appendChild(arrTarget);			
		}
		
	}
	
	function initMoveNode(e)
	{
		clearMovableDiv();
		if(document.all)e = event;
		arrMoveCounter = 0;
		arrTarget = this;
		if(this.nextSibling)arrNextSibling = this.nextSibling; else arrNextSibling = false;
		timerMoveNode();
		arrMoveCont.parentNode.style.left = e.clientX + 'px';
		arrMoveCont.parentNode.style.top = e.clientY + 'px';
		return false;
		
	}
	function timerMoveNode()
	{
		if(arrMoveCounter>=0 && arrMoveCounter<10){
			arrMoveCounter = arrMoveCounter +1;
			setTimeout('timerMoveNode()',20);
		}
		if(arrMoveCounter>=10){
			arrMoveCont.appendChild(arrTarget);
		}
	}
		
	function arrangeNodeMove(e)
	{
		if(document.all)e = event;
		if(arrMoveCounter<10)return;
		if(document.all && arrMoveCounter>=10 && e.button!=1 && navigator.userAgent.indexOf('Opera')==-1){
			arrangeNodeStopMove();
		}
		
		arrMoveCont.parentNode.style.left = e.clientX + 'px';
		arrMoveCont.parentNode.style.top = e.clientY + 'px';	
		
		var tmpY = e.clientY;
		arrInsertDiv.style.display='none';
		arrNodesDestination = false;
		

		if(e.clientX<leftPosArrangableNodes || e.clientX>leftPosArrangableNodes + widthArrangableNodes)return; 
			
		var subs = arrParent.getElementsByTagName('LI');
		for(var no=0;no<subs.length;no++){
			var topPos =getTopPos(subs[no]);
			var tmpHeight = subs[no].offsetHeight;
			
			if(no==0){
				if(tmpY<=topPos && tmpY>=topPos-5){
					arrInsertDiv.style.top = (topPos + offsetYInsertDiv) + 'px';
					arrInsertDiv.style.display = 'block';				
					arrNodesDestination = subs[no];	
					insertAsFirstNode = true;
					return;
				}				
			}
			
			if(tmpY>=topPos && tmpY<=(topPos+tmpHeight)){
				arrInsertDiv.style.top = (topPos+tmpHeight + offsetYInsertDiv) + 'px';
				arrInsertDiv.style.display = 'block';				
				arrNodesDestination = subs[no];
				insertAsFirstNode = false;
				return;
			}				
		}
	}
	
	function arrangeNodeStopMove()
	{
		arrMoveCounter = -1; 
		arrInsertDiv.style.display='none';
		
		if(arrNodesDestination){
			var subs = arrParent.getElementsByTagName('LI');
			if(arrNodesDestination==subs[0] && insertAsFirstNode){
				arrParent.insertBefore(arrTarget,arrNodesDestination);		
			}else{
				if(arrNodesDestination.nextSibling){
					arrParent.insertBefore(arrTarget,arrNodesDestination.nextSibling);
				}else{
					arrParent.appendChild(arrTarget);
				}
			}
		}		
		arrNodesDestination = false;
		clearMovableDiv();
	}		
	
	function saveArrangableNodes()
	{
		var nodes = arrParent.getElementsByTagName('LI');
		var string = "";
		for(var no=0;no<nodes.length;no++){
			if(string.length>0)string = string + ',';
			string = string + nodes[no].id;		
		}
		
		document.forms[0].hiddenNodeIds.value = string;
		// Just for testing
		//document.getElementById('arrDebug').innerHTML = 'Ready to save these nodes:<br>' + string.replace(/,/g,',<BR>');	
		document.forms[0].submit(); // Remove the comment in front of this line when you have set an action to the form.
		
	}
	
	function initArrangableNodes()
	{
		arrParent = document.getElementById('arrangableNodes');
		arrMoveCont = document.getElementById('movableNode').getElementsByTagName('UL')[0];
		
		
		
		arrInsertDiv = document.getElementById('arrDestInditcator');
		
		leftPosArrangableNodes = getLeftPos(arrParent);
		arrInsertDiv.style.left = leftPosArrangableNodes - 5 + 'px';
		widthArrangableNodes = arrParent.offsetWidth;
		
		var subs = arrParent.getElementsByTagName('LI');
		for(var no=0;no<subs.length;no++){
			subs[no].onmousedown = initMoveNode;
			subs[no].onselectstart = cancelEvent;	
		}
	
		document.documentElement.onmouseup = arrangeNodeStopMove;
		document.documentElement.onmousemove = arrangeNodeMove;
		document.documentElement.onselectstart = cancelEvent;
		
	}	
	
	window.onload = initArrangableNodes;
	
	</script>

</head>
<body id='bodyfond2' >




<?php

if (empty($_SESSION["adminplus"])) {
	print "<script>";
        print "location.href='./base_de_donne_key.php'";
        print "</script>";
        exit;
}

$cnx=cnx2();

if (isset($_POST["hiddenNodeIds"])) {
	$liste=$_POST["hiddenNodeIds"];
	$idclasse=$_POST["idclasse"];
	$anneeScolaire=$_POST["anneeScolaire"];
	$tri=$_POST["saisie_tri"];
	$cid=$idclasse;
	$dataClasse=chercheClasse($cid);
	$nom_classe=$dataClasse[0][1];
	$matGroup=matGroup($nom_classe);
	$tablist=explode(",",$liste);
	$cr=modifOrdreaffectation($idclasse,$tablist,$tri,$anneeScolaire);
	if ($cr) alertJs(LANGDONENR);
}else{
	//variables utiles
	// code_class(classes) de la classe concernée par l'affectation
	$cid=$_GET["saisie_classe_envoi"];
	$tri=$_GET["saisie_tri"];
	$anneeScolaire=$_GET["anneeScolaire"];
	// tableau 2 valeurs : id,libelle pour classe
	$dataClasse=chercheClasse($_GET["saisie_classe_envoi"]);
	$nom_classe=$dataClasse[0][1];
	$matGroup=matGroup($nom_classe);
}

// création de la matrice pour le select matiere
// 	sql
//		code_mat,libelle,sous_matiere
$sql=<<<SQL
SELECT
	code_mat,
	libelle,
	sous_matiere
FROM
	${prefixe}matieres
ORDER BY
	libelle
SQL;

$cursor=execSql($sql);
$data=chargeMat($cursor);
freeResult($cursor);
for($l=0;$l<count($data);$l++){
	for($c=0;$c<count($data);$c++){
			if(empty($data[$l][2])):
				$bool=0;
			else:
				$bool=true;
			endif;
		$matMat[$l][0]=$data[$l][0].":".$bool;
		$sl=trim($data[$l][1])." ".trim($data[$l][2]);
		$matMat[$l][1]=$sl;
	}
}
?>
<?php
if (!empty($_SESSION["adminplus"])) {
	print "<table align='center'>";
	print "<tr><td colspan='6'><font class='T2' >&nbsp;&nbsp;Déplacer la ligne en effectuant un drag&drop <i>(cliquer/deplacer)</i> sur le N° correspondant</font>";
	print "<br><br></td></tr><tr><td>";
	print "<ul id='arrangableNodes'>";

$data=visu_affectation_detail_2($_GET["saisie_classe_envoi"],$tri,$anneeScolaire);
// ordre_affichage,code_matiere,code_prof,code_classe,coef,g.libelle,a.langue,a.avec_sous_matiere,a.visubull,a.nb_heure,a.ects,a.id_ue_detail
for ($a=0;$a<count($data);$a++) {
	$nomMatiere=ucwords(chercheMatiereNom($data[$a][1]));
	$idMatiere=$data[$a][1];
	$nomProf=recherche_personne($data[$a][2]);
	$idProf=$data[$a][2];
	$coef=$data[$a][4];
	$nomGrp=trim($data[$a][5]);
	$idGrp=chercheGroupeId($data[$a][5]);
	$idLang=$data[$a][6];
	$nomLang=$data[$a][6];
	$ordre=$data[$a][0];
	$avecSousMatiere=$data[$a][7];
	$visubull=$data[$a][8];
	$nbheure=$data[$a][9];
	$ects=$data[$a][10];
	$id_ue_detail=$data[$a][11];

	$tab=recupNomUE($id_ue_detail);
	$nom_ue=$tab[0][0];
	$ue=$tab[0][1];
	$nom_ueTitle=$nom_ue;
	$nom_ue=trunchaine($nom_ue,40);
?>

<li id="<?php print "${a}:${idMatiere}:${idProf}:${coef}:${idGrp}:$idLang:$avecSousMatiere:$visubull:$ects:$id_ue_detail" ?>" >
	 <input type=text value="N° <?php print $a?>" size=5 style="cursor: move;" readonly="readonly" class=button />
	 <input type=text value="<?php print $nomMatiere ?>" size=30  readonly="readonly" class=bouton2 /> <?php //$idMatiere ?>
	 <input type=text value="<?php print $nomProf ?>" size=30  readonly="readonly" class=bouton2 /> <?php  // $idProf ?> 
	 <input type=text value="<?php print $coef?>" size=5  readonly="readonly" class=bouton2 /> 
	 <input type=text value="<?php print $nomGrp ?>"  size=5 readonly="readonly"  class=bouton2 /> <?php // $idGrp ?> 
	 <input type=text value="<?php if ($nomLang == "0" ) print ""; else print $nomLang ?>" size=4  readonly="readonly" class=bouton2  /> <?php //$idLang ?>
	 <input type=text value="<?php if ($visubull == "0" ) print "non"; else print "oui" ?>" size=4  readonly="readonly" class=bouton2  /> <?php //visubull ?>
	 <input type=text value="<?php print $nbheure ?>" size=5  readonly="readonly" class=bouton2  /> 
	 <input type=text value="<?php print $ects ?>" size=5  readonly="readonly" class=bouton2  /> 
	 <input type=text value="<?php print $nom_ue ?>" size=30  readonly="readonly" class=bouton2  /> 
</li>

<?php  }
?>
</ul>	
<p>
<script language=JavaScript>buttonMagicSubmit3VATEL("<?php print VALIDER ?>","create","onclick='saveArrangableNodes();return false'"); //text,nomInput</script>
<script language=JavaScript>buttonMagicFermetureVATEL(); //text,nomInput</script>
</p>
	

<div id="movableNode"><ul></ul></div>	
<div id="arrDestInditcator"><img src="../image/commun/insert.gif"></div>
<div id="arrDebug"></div>
<form method="post" >
<input type="hidden" name="hiddenNodeIds" />
<input type="hidden" name="idclasse" value="<?php print $_GET["saisie_classe_envoi"] ?>" />
<input type="hidden" name="saisie_tri" value="<?php print $tri ?>" />
<input type="hidden" name="anneeScolaire" value="<?php print $anneeScolaire ?>" />
</form>

<?php } ?>
<BR>
<!-- verif saisie -->
</BODY></HTML>
