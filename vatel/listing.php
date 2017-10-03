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
include_once("../common/config.inc.php"); // futur : auto_prepend_file
include_once("../librairie_php/db_triade.php");



include_once("entete.php");
include_once("menu.php");

$cnx=cnx2();

// Sn : variable de Session nom
// Sp : variable de Session prenom
// Sm : variable de Session membre
// Spid : variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);
// données DB utiles pour cette page
$mys=$mySession[Spid];



if (isset($_POST["saisie_pers"])) {
	$mys=$_POST["saisie_pers"];
	$_SESSION["idprofviaadmin"]=$mys;
}

if (isset($_SESSION["idprofviaadmin"])) {
	$mys=$_SESSION["idprofviaadmin"];
	$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($mys);
}

$sql="
SELECT
	a.code_classe,
	trim(c.libelle),
	a.code_matiere,
";
if(DBTYPE=='pgsql')
{
	$sql .= " trim(m.libelle)||' '||trim(m.sous_matiere)||' '||trim(langue), ";
}
elseif(DBTYPE=='mysql')
{
	$sql .= " CONCAT( trim(m.libelle),' ',trim(m.sous_matiere),' ',trim(langue) ) , ";
}
$sql .= "
	a.code_groupe,
	trim(g.libelle)
FROM
	${prefixe}affectations a,
	${prefixe}matieres m,
	${prefixe}classes c,
	${prefixe}groupes g
WHERE
	code_prof='$mys'
AND a.code_classe = c.code_class
AND a.code_matiere = m.code_mat
AND a.code_groupe = group_id
AND a.annee_scolaire ='$anneeScolaire'
AND (a.visubull = '1' OR a.visubullbtsblanc = '1')
AND c.offline = '0'
GROUP BY a.code_matiere,a.code_classe
ORDER BY
	c.libelle,m.libelle
";

$curs=execSql($sql);
$data=chargeMat($curs);
@array_unshift($data,array()); // nécessaire pour compatibilité
// patch pour problème sous-matière à 0
for($i=0;$i<count($data);$i++){
	$tmp=explode(" 0 ",$data[$i][3]);
	$data[$i][3]=$tmp[0].' '.$tmp[1];
}
// fin patch

genMatJs('affectation',$data);
freeResult($curs);
unset($curs);
//htmlTableMat($data);





?> 
	<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGMESS250 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px" >
		<form method="POST" name="formulaire0" action="listing.php">
		<font class="T2"><?php print LANGBULL29 ?> :</font>
                 <select name='anneeScolaire' onChange="document.formulaire0.submit()" class="form-control vat-extend-select pointer">
                 <?php
                 filtreAnneeScolaireSelectNote($anneeScolaire,3);
                 ?>
                 </select>
</form>
<br/><br/>
<form method="POST" onsubmit="return verifAccesNotebis()" name="formulaire" action="listing2.php">
<input type=hidden name='anneeScolaire' value="<?php print $anneeScolaire ?>" />
<font class="T2"><?php print LANGPROFG ?>  :</font>
<select name="sClasseGrp" size="1" class="form-control vat-extend-select pointer" >
<option value="0" STYLE="color:#000066;background-color:#FCE4BA"> <?php print LANGCHOIX3 ?> </option>
				 <?php
				 for($i=1;$i<count($data);$i++){
				 	if ($i>1 && ($data[$i][4]==$gtmp) && ($data[$i][0]==$ctmp) ){
						continue;
					}else{
						// utilisation de l'opérateur ternaire expr1?expr2:expr3;
						$libelle=$data[$i][4]?$data[$i][1]."-".$data[$i][5]:$data[$i][1];
						print "<option STYLE='color:#000066;background-color:#CCCCFF' value=\"".$data[$i][0].":".$data[$i][4]."\">".$libelle."</option>\n";
					}
					$gtmp=$data[$i][4];
					$ctmp=$data[$i][0];
				 }
				 unset($gtmp);
				 unset($ctmp);
				 unset($libelle);
				 ?>
				 </select>
				 <br /><br />

				 <input type='submit' class="btn btn-primary btn-sm  vat-btn-footer" value="<?php print LANGBT31 ?>" name='rien' >
				 <br/><br/>

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
