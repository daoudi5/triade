<?php
session_start();
$anneeScolaire=$_COOKIE["anneeScolaire"];
if (isset($_POST["anneeScolaire"])) {
        $anneeScolaire=$_POST["anneeScolaire"];
        setcookie("anneeScolaire",$anneeScolaire,time()+36000*24*30);
}
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


include_once("../common/config.inc.php"); // futur : auto_prepend_file
include_once("../librairie_php/db_triade.php");

$cnx=cnx2();

// include_once("entete.php");
$idprof=$_SESSION["id_pers"];
if (isset($_SESSION["idprofviaadmin"])) {
	$idprof=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($idprof);
}


// affichage de la classe
$ident=array('sClasseGrp','cgrp','sMat');
$HPV=hashPostVar($ident);
unset($ident);
$listTmp=explode(":",$HPV[cgrp]);
unset($HPV[cgrp]);
$HPV[cid]=$listTmp[0];
$HPV[gid]=$listTmp[1];
unset($listTmp);
if($HPV[gid]){
    $who="<font color='red'> groupe : ".chercheGroupeNom($HPV[gid]) ."</font>";
    $nomclasse=chercheGroupeNom($HPV[gid]);
	$saisie_classe=$HPV[gid];
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
		if ($in != "") {
	      		$sql="SELECT elev_id,elev_id, ";
		        $sql.=" CONCAT( upper(trim(nom)),' ',trim(prenom) ) ";
        		$sql.=" ,compte_inactif,compte_inactif FROM ${prefixe}eleves WHERE elev_id IN ($in) ORDER BY nom";
		      	unset($in);
        	  	$curs=execSql($sql);
	     		unset($sql);
	      		$data=chargeMat($curs);
          		freeResult($curs);
	      		unset($curs);
		}
	}
}else{
   	$cl=chercheClasse($HPV[cid]);
	$saisie_classe=$HPV[cid];
	$nomclasse=$cl[0][1];
   	$who=" en ". LANGABS31." <font color='red' >".$cl[0][1] ."</font>";
   	unset($cl);
	$sql="SELECT libelle,elev_id,nom,prenom,compte_inactif FROM ${prefixe}eleves, ${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe'  ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);
	$cl=$data[0][0];
}


// ne fonctionne que si au moins 1 élève dans la classe
// nom classe
$nommatiere=chercheMatiereNom($_POST["sMat"]);
// include_once("menu.php");

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
	<script language="JavaScript" src="../librairie_js/function.js"></script>

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

</head>


	<div id="wrapper" style="padding-top: 0px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL34 ?> - <?php print $who." - <font color='green'>".$nommatiere."</font>" ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				
			</ul>
			</div>
		</header>
<form method="post" action="ajoutabsRtdSanc3.php" name="formulaire" >
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px" >
<?php
$data3=recupCreneauDefault("creneau"); // libelle,text
$date=dateDMY2();
$heure=dateHIS();
$dataseance=recupInfoSeance2($date,$heure,$idprof,$_POST["sMat"],$saisie_classe,$gid); // idclasse,idmatiere,heure,duree,idgroupe
?>
<table><tr><td width=150>
<font class='T2' ><?php print LANGPARENT8 ?></font>
<input type="text" name="date" class="form-control" value="<?php print dateDMY() ?>" /></td><td>&nbsp;&nbsp;
<?php
include_once("../librairie_php/calendar.php");
calendarVatel("id1","document.formulaire.date",$lang,"0");
?></td></tr></table><br>

<font class='T2' ><?php print LANGMESS429 ?> 
<select name="saisie_heure" onChange="fonc2()" class="form-control vat-extend-select pointer" >
<?php
if (count($dataseance)) {
	$heuredebut=$dataseance[0][2];
	$duree=$dataseance[0][3];
	$dureesec=conv_en_seconde($duree);
	$heuresec=conv_en_seconde($heuredebut);
	$sommeSec=$dureesec+$heuresec;
	$heurefin=trim(timeForm(calcul_hours($sommeSec)));
	$heuredebut=trim(timeForm($dataseance[0][2]));
	$optionCreneau="<option  id='select0' value=\"".trim($data3[0][0])."#".$data3[0][1]."#".$data3[0][2]."\" selected='selected' >EDT : ".$heuredebut." - ".$heurefin."</option>";
}else{
	$optionCreneau="";
}
print $optionCreneau ;
$disabled='disabled';
if (count($data3) > 0) {
	$disabled='';
	$data3=recupInfoCreneau($data3[0][1]);
	print "<option id='select0' value=\"".trim($data3[0][0])."#".$data3[0][1]."#".$data3[0][2]."\" selected='selected' >".trim($data3[0][0])." : ".timeForm($data3[0][1])." - ".timeForm($data3[0][2])."</option>\n";
}
print "<option id='select0' value='null' >".LANGCHOIX."</option>";
select_creneaux2();
?>
</select></font><br>
<?php
$sub=0;
if (count($data) <= 0 ) {
	print("<font class='text T2' >".LANGRECH1."</font>");
}else{
	
	?>
	<script>
	function activeABS(i) {
		document.getElementById('img_'+i).style.opacity='0.4';
		var e=document.getElementById('ideleve_'+i).value;
		if (e == "oui") {
			document.getElementById('ideleve_'+i).value="";
			document.getElementById('img_'+i).style.opacity='1';
		}else{
			document.getElementById('ideleve_'+i).value="oui";	
		}
		
		
	}
	</script>
	

	<table align='center' ><tr>	
	<?php
	
	$II=1;	
	for($i=0;$i<count($data);$i++) {
		if ($data[$i][4] == "1") continue; 
		$enstage=verifSiEleveEnStage($data[$i][1],dateDMY());
		$photoeleve="./image_trombi.php?idE=".$data[$i][1];
		$a="onClick=\"activeABS('$i');\" ";
		if ($enstage == 1) {
			$style=" style=\"opacity: 0.4; filter: alpha(opacity=40);\" ";
			$a="";
		}
		?>
		<td style="padding:10px" >
		<a name='ancre<?php print $i?>'></a>
		<img class="imgclick" src='<?php print $photoeleve ?>' <?php print $a ?> id='img_<?php print $i ?>'  <?php print $style ?> height=80 />
		<input type='hidden' name='ideleve_<?php print $i ?>'  id='ideleve_<?php print $i ?>' />
		<input type='hidden' name='idpers_<?php print $i ?>'  value='<?php print $data[$i][1] ?>'  />
		<br>
		<font size=1><?php print ucwords($data[$i][2])."<br>".ucwords($data[$i][3]); ?></font>
		</td>
		<?php 
		$II++;
		if ($II == 9) { print "</tr><tr>"; $II=1 ; }
	}
	print "</tr></table>";
?>
<div style="clear:both" >
<input type='hidden' name='saisie_id'   value="<?php print count($data) ?>" >
<input type='hidden' name='idmatiere'   value="<?php print $_POST["sMat"] ?>" >
<input type='hidden' name='nomclasse'   value="<?php print $nomclasse ?>" >
<input type='hidden' name='nommatiere'  value="<?php print $nommatiere ?>" >
<input type='hidden' name='idprof' 	value="<?php print $_SESSION["id_pers"] ?>" >
<input type='hidden' name='sMat' 	value="<?php print $_POST["sMat"] ?>" >
<input type='hidden' name='sClasseGrp' 	value="<?php print $_POST["sClasseGrp"] ?>" >
<br><br>
<font class='T2'>&nbsp;&nbsp;&nbsp;&nbsp;<?php print LANGABS53 ?> :  <input type=checkbox class="btradio1" name='retard_aucun' value="oui" onclick="fonc1();"> (<?php print LANGOUI?>)<br><br></font>
<input type='submit' value="<?php print LANGENR?>" id='rien' name="rien" class="btn btn-primary btn-sm  vat-btn-footer" disabled="disabled" />
</div>
</form>
<br>
<?php 
}
?>
<!-- // fin  -->
</section>
</div>
</div>
</div>
<?php 
Pgclose();
//include_once("piedpage.php");
include_once("connexionEnCours.php");
?>

</body>
</html>
