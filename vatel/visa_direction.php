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
<script language="JavaScript" src="../librairie_js/lib_trimestre.js"></script>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL206 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param12.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
		<form method=post onsubmit="return valideTab()" name="formulaire" action="visa_direction2.php">
		<font class="T2"><?php print LANGBULL3 ?> :</font>
        <select name='annee_scolaire' >
        <?php
		$anneeScolaire=$_COOKIE["anneeScolaire"];
        filtreAnneeScolaireSelectNote($anneeScolaire,3);
        ?>
        </select>
		<br><br>
        <font class=T2><?php print LANGPROFG?> :</font> <select id="saisie_classe" name="saisie_classe">
        <option id='select0' ><?php print LANGCHOIX?></option>
<?php
if ($_SESSION["membre"] == "menuprof") {
	print "<option id='select1' value='".$_SESSION["profpclasse"]."' >".chercheClasse_nom($_SESSION["profpclasse"])."</option>";
}else{
	select_classe(); // creation des options
}
?>
</select> <br /><br />
<font class=T2>

<?php print LANGBASE40 ?> <select name="typetrisem" onchange="trimes();" >
     <option value=0   STYLE='color:#000066;background-color:#FCE4BA' ><?php print LANGCHOIX?></option>
     <option value="trimestre" STYLE='color:#000066;background-color:#CCCCFF'><?php print LANGPARAM28?></option>
     <option value="semestre"  STYLE='color:#000066;background-color:#CCCCFF'><?php print LANGPARAM29?></option>
     <option value="annuel"  STYLE='color:#000066;background-color:#CCCCFF'><?php print LANGMESS334?></option>
     </select>  : 
     <select name="saisie_trimestre">
                     <option STYLE='color:#000066;background-color:#CCCCFF'>        </option>
                     <option STYLE='color:#000066;background-color:#CCCCFF'>        </option>
                     <option STYLE='color:#000066;background-color:#CCCCFF'>        </option>
    </Select>
    <br /><br />
	<?php print LANGMESS332 ?> <select name="type_bulletin" >
	<option STYLE='color:#000066;background-color:#CCCCFF' value='default' >Standard</option>
    </select>
</font>
<br><br>
<UL><UL><UL>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print VALIDER?>","consult"); //text,nomInput</script>
</UL></UL></UL>
</blockquote>
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