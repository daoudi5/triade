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

$idpers=$mySession[Spid];
validerequete("menuadmin");
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL75 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

		<script language="JavaScript" src="../librairie_js/verif_creat.js"></script>
<?php
if (!isset($_POST["aucun_eleve"])) {
	if (count($_POST["saisie_liste"]) <= 0 ) {
?>
		<script language=JavaScript>
		alert("<?php print LANGGRP22?>");
		location.href="creat_groupe.php";
		</script>

<?php
	}
}else{

	if ((count($_POST["saisie_liste"]) <= 0 ) && ($_POST["aucun_eleve"] != "1") ) {
	?>
		<script language=JavaScript>
		alert("<?php print LANGGRP22?>");
		location.href="creat_groupe.php";
		</script>

<?php
	}
}

if (GROUPEGESTIONPROF == "oui") {
	$JS="validecreatgroupe2bis()";
}else{
	$JS="validecreatgroupe2()";
}

?>

<form method=post onsubmit="return <?php print $JS ?>" name="formulaire" action='./creat_groupe_suite.php' >
<ul><BR>
<?php
// debut if de premiere procedure
  if (! isset($_POST["create"])) :
?>

<font class=T2><?php print "Année Scolaire" ?> : <?php print $_POST["annee_scolaire"] ?><br><br>

<font class=T2><?php print LANGGRP1?> </font> : <input type=text name='saisie_intitule' size=25 onfocus="this.blur()" value="<?php print stripslashes($_POST["saisie_intitule"]) ?>"><BR>
<BR>                <BR><font class=T2><?php print LANGGRP16?></font><BR><BR></UL>
<UL><?php print LANGASS27?> : <BR>
<textarea name="saisie_commentaire" cols=65 rows=2></textarea></UL>
<center>
<table width=100% border=0>
<TR><TD>
<?php
$i=0;
foreach($_POST["saisie_liste"] as $value) {
	$classes[$i]=$value;
	$i++;
}
$in=join(",",$classes);

if (trim($in) != "") {

$sql=<<<EOF

SELECT
	c.libelle,
	e.nom,
	e.prenom,
	e.elev_id,
	e.lv1,
	e.lv2
FROM
	${prefixe}classes c,
	${prefixe}eleves e
WHERE
	c.code_class = e.classe
AND 	e.classe IN ($in)
ORDER BY
	e.nom,
	e.prenom

EOF;

$res=execSql($sql);
$data=chargeMat($res);

}

?>
<table border=1 width=100% bordercolor="#000000">
<TR>
<TD bgcolor="yellow" width=20%><B><?php print LANGEL1?></b> </TD>
<TD bgcolor="yellow" width=20%><b><?php print LANGEL2?> </b></TD>
<TD bgcolor="yellow" width=10%><b><?php print LANGEL3?> </b></TD>
<TD bgcolor="yellow" width=15%><b><?php print LANGEL4?></b></TD>
<TD bgcolor="yellow" width=15%><b><?php print LANGEL5?></b></TD>
<TD bgcolor="yellow" align=center width=20%><b><?php print LANGGRP17?> </b></TD>
</TR>
<?php
for($i=0;$i<count($data);$i++)
        {
        ?>
	<TR id="tr<?php print $i ?>" class="tabnormal" onmouseover="this.className='tabover2'" onmouseout="this.className='tabnormal'">
	<TD>
        <?php print ucwords($data[$i][1])?>
	</TD>
	<TD><?php print ucwords($data[$i][2])?>
	</TD>
	<TD><?php print $data[$i][0]?>
	</TD>
	<TD><?php print $data[$i][4]?></TD>
	<TD><?php print $data[$i][5]?></TD>
	<TD align=center >
	 <input type=checkbox name="saisie_choix_eleve[]" onClick="click_eleve();DisplayLigne('tr<?php print $i?>')" value='<?php print $data[$i][3]?>'> </TD>
	</TR>
	<?php
	}
?>
</TABLE>
</TD></TR></TABLE></center>
<input type=hidden name=saisie_eleve >
<input type=hidden name=saisie_liste value='1'>
<input type=hidden name=annee_scolaire value='<?php print $_POST["annee_scolaire"] ?>'>
<?php if (GROUPEGESTIONPROF == "oui") { ?>
<br>&nbsp;&nbsp;&nbsp;<input type=checkbox name=aucun_eleve value='1' /> Création du groupe sans élève. 
<?php } ?>
<BR>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGGRP18?>","create"); //text,nomInput</script>
<br>
</form>
<br /><br />
<?php
endif;  // fin de la premiere procedure

if (isset($_POST["create"])) {

$anneeScolaire=$_POST["annee_scolaire"];
$params[liste_eleve]=join(",",$_POST["saisie_choix_eleve"]);
$params[comment]=$_POST["saisie_commentaire"];
$params[nomgr]=trim($_POST["saisie_intitule"]);

if(create_groupe($params,$anneeScolaire)):
	alertJs("Groupe créé \n\n Service Triade ");
	history_cmd($_SESSION["nom"],"CREATION","groupe ".$_POST["saisie_intitule"]." ");
else:
	error(0);
endif;
?>
</UL><center><font class=T2><?php print LANGGRP19?></font><BR><BR><br>
<table align=center><tr><td>
<script language=JavaScript>buttonMagicVATEL("<?php print LANGGRP20?>","creat_groupe.php","_parent","","");</script>
<script language=JavaScript>buttonMagicVATEL("<?php print LANGGRP21?>","liste_groupe.php","_parent","","");</script>&nbsp;&nbsp;
</td><tr></table>
<bR><bR><br>
<?php
}
?>
		
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