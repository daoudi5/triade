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
<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
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
		
<font class='T2 shadow'><?php print LANGVATEL235 ?></font><br><br>
<form method='post' onsubmit="return valide_consul_classe()" name="formulaire" >
<font class=T2><?php print LANGELE4?> :</font> <select id="saisie_classe" name="saisie_classe">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
if ($_SESSION["membre"] == "menuprof") {
	if (PROFSTAGEETUDIANT == "oui") {
		select_classe(); // creation des options
	}else{
		select_classe_profp($_SESSION["id_pers"]); // creation des options
	}
}else{
	select_classe(); // creation des options
}
?>
</select>&nbsp;&nbsp;
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","consult"); //text,nomInput</script>
</form>


<?php
// affichage de la classe
if(isset($_POST["consult"]) || isset($_POST["saisie_classe"]) ) {

	$langue=$_POST["langue"];
	$trim=$_POST["trim"];

$ok=0;
if(isset($_POST["create"])) {
	$nbidstage=$_POST["nbidstage"];
	$ident=$_POST["ident"];
	if (preg_match('/CS/',$ident)) {
		$nomentreprise=$_POST["nom_entreprise_via_central"];
		list($null,$idcs)=split(':',$ident);
		$contact=$_POST["contact"];
		$adressesiege=$_POST["adressesiege"];
		$activite=$_POST["activite"];
		$activiteprin=$_POST["activiteprin"];
		$email=$_POST["email"];
		$information=$_POST["information"];
		$activite2=$_POST["activite2"];
		$activite3=$_POST["activite3"];
		$fonction=$_POST["fonction"];
		$nbchambre=$_POST["nbchambre"];
		$siteweb=$_POST["siteweb"];
		$grphotelier=$_POST["grphotelier"];
		$nbetoile=$_POST["nbetoile"];
		$registrecommerce=$_POST["registrecommerce"];
		$siren=$_POST["siren"];
		$siret=$_POST["siret"];
		$formejuridique=$_POST["formejuridique"];
		$secteureconomique=$_POST["secteureconomique"];
		$INSEE=$_POST["INSEE"];
		$NAFAPE=$_POST["NAFAPE"];
		$NACE=$_POST["NACE"];
		

		$typeorganisation=$_POST["typeorganisation"];
		$ident=create_entreprise_via_cs($nomentreprise,$contact,$_POST["lieu"],$_POST["postal"],$_POST["ville"],$activite,$activiteprin,$_POST["tel"],$_POST["fax"],$email,$information,$activite2,$activite3,$fonction,$nbchambre,$siteweb,$grphotelier,$nbetoile,$_POST["pays"],$registrecommerce,$siren,$siret,$formejuridique,$secteureconomique,$INSEE,$NAFAPE,$NACE,$typeorganisation,$idcs,$responsable2);
	}
	$responsable2=$_POST["responsable2"];

	for($i=0;$i<$nbidstage;$i++) {
		$idstage=$_POST["idstage"][$i];
		if (($idstage != "") && ($ident != 0) ) {
			$cr=create_eleve_stage($_POST["ideleve"],$ident,$_POST["lieu"],$_POST["ville"],$_POST["idprof"],$_POST["date"],$_POST["loge"],$_POST["nourri"],$_POST["xservice"],$_POST["raison"],$_POST["info"],$idstage,$_POST["postal"],$_POST["responsable"],$_POST["tel"],$_POST["alternance"],$_POST["dateDebutAlternance"],$_POST["dateFinAlternance"],$_POST["jourstage"],$_POST["idtuteur"],$_POST["horairedebutjournalier"],$_POST["horairefinjournalier"],$_POST["date2"],$_POST["idprof2"],$_POST["service"],$_POST["indemnitestage"],$_POST["pays"],$_POST["fax"],$responsable2,$langue,$trim);
			if($cr == 1){
				bonux_entreprise($ident);
				$dateperiode=recherchedatestage($idstage); //idclasse,datedebut,datefin,numstage,id,nom_stage
				$periode=dateForm($dateperiode[0][1])." au ".dateForm($dateperiode[0][2]);
				history_entreprise($ident,$_POST["ideleve"],$periode,$langue,$trim,$_POST["service"]);
				history_cmd($_SESSION["nom"],"CREATION","Eleve Stage");
				$ok=1;
			}
		}
	}
	if ($_POST["alternance"] == 1) {
		$cr=create_eleve_stage($_POST["ideleve"],$ident,$_POST["lieu"],$_POST["ville"],$_POST["idprof"],$_POST["date"],$_POST["loge"],$_POST["nourri"],$_POST["xservice"],$_POST["raison"],$_POST["info"],$idstage,$_POST["postal"],$_POST["responsable"],$_POST["tel"],$_POST["alternance"],$_POST["dateDebutAlternance"],$_POST["dateFinAlternance"],$_POST["jourstage"],$_POST["idtuteur"],$_POST["horairedebutjournalier"],$_POST["horairefinjournalier"],$_POST["date2"],$_POST["idprof2"],$_POST["service"],$_POST["indemnitestage"],$_POST["pays"],$_POST["fax"],$responsable2,$langue,$trim);
		if($cr == 1){
			bonux_entreprise($ident);
			$periode=$_POST["dateDebutAlternance"]." au ".$_POST["dateFinAlternance"];
			history_entreprise($ident,$_POST["ideleve"],$periode,$langue,$trim,$_POST["service"]);
			history_cmd($_SESSION["nom"],"CREATION","Eleve Stage");
			$ok=1;
		}
	}
	if ($_POST["periode"] != 0) {
		// enregistrer le stage 
		if (verifSiAjoutStage($_POST["idclasse"],$_POST["debutdate"],$_POST["findate"],$_POST["num"],$_POST["nom_stage"]) == 0) {
			$cr=stage_ajout($_POST["num"],dateForm($_POST["debutdate"]),dateForm($_POST["findate"]),$_POST["idclasse"],$_POST["nom_stage"]);
			if ($cr) { history_cmd($_SESSION["nom"],"CREATION","date de stage"); }
		}
		// recuperer l'idstage en question dans $idstage
		$idstage=rechercheiddatestagebyAll($_POST["idclasse"],$_POST["debutdate"],$_POST["findate"],$_POST["num"],$_POST["nom_stage"]);

		$cr=create_eleve_stage($_POST["ideleve"],$ident,$_POST["lieu"],$_POST["ville"],$_POST["idprof"],$_POST["date"],$_POST["loge"],$_POST["nourri"],$_POST["xservice"],$_POST["raison"],$_POST["info"],$idstage,$_POST["postal"],$_POST["responsable"],$_POST["tel"],$_POST["alternance"],$_POST["dateDebutAlternance"],$_POST["dateFinAlternance"],$_POST["jourstage"],$_POST["idtuteur"],$_POST["horairedebutjournalier"],$_POST["horairefinjournalier"],$_POST["date2"],$_POST["idprof2"],$_POST["service"],$_POST["indemnitestage"],$_POST["pays"],$_POST["fax"],$responsable2,$langue,$trim);
		if($cr == 1){
			bonux_entreprise($ident);
			$periode=$_POST["dateDebutAlternance"]." au ".$_POST["dateFinAlternance"];
			history_entreprise($ident,$_POST["ideleve"],$periode,$langue,$trim,$_POST["service"]);
			history_cmd($_SESSION["nom"],"CREATION","Eleve Stage");
			$ok=1;
		}
	}
}

if ($ok) { alertJs(LANGSTAGE84); }

$saisie_classe=$_POST["saisie_classe"];
$anneeScolaire=anneeScolaireViaIdClasse($idClasse);
$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' AND annee_scolaire = '$anneeScolaire' ORDER BY nom";
$res=execSql($sql);
$data=chargeMat($res);

// ne fonctionne que si au moins 1 élève dans la classe
// nom classe
$cl=$data[0][0];
?>
<BR><BR><BR>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" >
<tr id='coulBar0' ><td height="2" colspan=3><b><font   id='menumodule1'><?php print LANGELE4?> : <font id=color2 ><B><?php print $cl?></font> / <?php print LANGBULL2 ?> :  <font id=color2 ><B><?php print $anneeScolaire ?></B></font> </font></td></tr>
<?php
if( count($data) <= 0 )
	{
	print("<tr id='cadreCentral0' ><td align=center valign=center>".LANGRECH1."</td></tr>");
	}
else {
?>
<tr><td bgcolor='black'> <font class='T22'><?php print ucwords(LANGIMP8)?></font></td><td colspan=2 bgcolor='black' ><font class='T22'><?php print ucwords(LANGIMP9)?></font></td></tr>
<?php
for($i=0;$i<count($data);$i++)
	{
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	?>
	<td ><?php print strtoupper($data[$i][2])?></td>
	<td ><?php print ucwords($data[$i][3])?></td>
	<td  width=5><input type='button' onclick="open('gestion_stage_affec_eleve_2.php?id=<?php print $data[$i][1]?>&idclasse=<?php print $saisie_classe ?>','_parent','')" value="Affecter" class='btn btn-primary btn-sm  vat-btn-footer' ></td>

	</tr>
	<?php
	}
      }
print "</table>";
}
?>
<br><br>

<?php
$action="gestion_stage_affec_multieleve.php";
if (AFTEC == 1) {
	$action="gestion_stage_affec_multieleve_aftec.php";
}
?>
<hr>
<form method='post' target='_blank' action='<?php print $action ?>' name='formulaire1' onsubmit="return valide_consul_classe1()" >
<font class='T2 shadow'><?php print LANGVATEL234 ?></font>
<br><br>
<font class=T2><?php print LANGELE4 ?>&nbsp;:&nbsp;</font> <select id="saisie_classe" name="saisie_classe">
<option id='select0' ><?php print LANGCHOIX?></option>
<?php
if ($_SESSION["membre"] == "menuprof") {
	if (PROFSTAGEETUDIANT == "oui") {
		select_classe(); // creation des options
	}else{
		select_classe_profp($_SESSION["id_pers"]); // creation des options
	}
}else{
	select_classe(); // creation des options
}
?>
</select>&nbsp;&nbsp;<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT28?>","aucun"); //text,nomInput</script>

			
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