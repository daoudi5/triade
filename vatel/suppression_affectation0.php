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

if (empty($_SESSION["adminplus"])) {
	print "<script>";
    print "location.href='./param9.php'";
    print "</script>";
    exit;
}

?>
<script language="JavaScript" src="../librairie_js/lib_affectation.js"></script>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL88 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
<form method='post' onsubmit="return affectation_classe3()" name="formulaire" action="suppression_affectation2.php" >
<UL>
<?php print LANGPER33 ?>  : 
<?php
$sql=<<<SQL
SELECT DISTINCT c.code_class,trim(c.libelle)
FROM ${prefixe}classes c,${prefixe}affectations a
WHERE c.code_class = a.code_classe
ORDER BY 2
SQL;
$curs=execSql($sql);
$data=chargeMat($curs);
freeResult($curs);
unset($curs);
print selectHtml('saisie_classe_envoi',1,false,$data);
unset($data);
?>

/ <?php print LANGBULL3 ?> :
<select name="anneeScolaire" >
<?php anneeScolaireSelect(); ?>
</select>&nbsp;&nbsp;


<BR><BR>
<UL>
<br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT22?>","rien"); //text,nomInput</script></ul></ul><br><br><br>
<center><b><font color="#000000" class="T2 shadow"><b><?php print LANGPER34 ?></b></font></center>
<br><br>
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
</body>
</html>