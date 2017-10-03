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
			
			
<?php
if (isset($_GET["err"])) {
	print "<br><center><font id='color3'><b>Merci d'indiquer le choix du bulletin !!</b></font></center>";
}

include_once("../librairie_php/lib_bulletin.php");

if (!is_dir("../data/archive/bulletin")) mkdir("../data/archive/bulletin"); 

if (isset($_GET["sClasseGrp"])) { 
	$idclasse=$_GET["sClasseGrp"];
	verif_profp_class($_SESSION["id_pers"],$idclasse);
}

if (isset($_POST["saisie_classe"])) { $idclasse=$_POST["saisie_classe"]; } 
if ($_SESSION["membre"] == "menupersonnel") { 
	if (!verifDroit($_SESSION["id_pers"],"imprbulletin")) {
		Pgclose();
		accesNonReserveFen();
		exit();
	}
}

if (isset($_POST["param"]))  {	
	enrbulletinclasse($_POST["saisie_classe"],$_POST["enrbull"]);
	enr_parametrage("autorisebulletinprof",$_POST["autorisebulletinprof"]); 
}

$idsite=chercheIdSite($idclasse);

$erreurdeja=0;
$valeur=aff_Trimestre();
if (count($valeur)) {
?>
     <form method="post" action="imprimer_trimestre.php" >
     <table width="100%" border="0" align="center" >
     <tr><td width=100%>
     <table width="90%" border="0" align="center" height=150>
     <tr>
     <td width="50%" align="right" valign=top ><font class="T2"><?php print LANGBULL2?> : </font></td>
     <td  valign=top>
     <?php 
	if ( (isset($idclasse)) && ($_SESSION["membre"] != "menuadmin") )  { ?>
		<b><?php print chercheClasse_nom($idclasse) ?></b>
		<input type="hidden" name="saisie_classe" value="<?php print $idclasse ?>" />
<?php }else{ ?>
     <select name="saisie_classe" onChange="this.form.submit()" >
	 <?php 	if (isset($idclasse)) { ?>
     		<option value='<?php print $idclasse ?>'  id='select0' ><?php print chercheClasse_nom($idclasse) ?></option>
	 <?php } ?>
     		<option value='0' id='select0' ><?php print LANGCHOIX?></option>
<?php
		if (isset($_GET["sClasseGrp"])) {
			$deja=0;
			for($i=0;$i<count($tabClasse);$i++) {
				if ($tabClasse[$i][1] == $_GET["sClasseGrp"]) {
					$deja=1;
					break;
				}
			}
			if ($deja == 0) print "<option  value='".$_GET["sClasseGrp"]."' id='select1' >".chercheClasse_nom($_GET["sClasseGrp"])."</option>";
		}
		if (count($tabClasse)  > 0) {
			for($i=0;$i<count($tabClasse);$i++) {
				print "<option  value='".$tabClasse[$i][1]."' id='select1' >".$tabClasse[$i][0]."</option>";
			}
		}else{
			select_classe(); // creation des options
		}
		print "</select>";
	} 
?>
     </td>
     </tr>
	 <tr><td height=20></td></tr>
     </form>
     <form name="formulaire" method="post" action="./bulletin_construction0.php"  onsubmit="return verifimpbull();">
     <input type='hidden' name='saisie_classe' value='<?php print $idclasse ?>' >
     <tr><br><td align="right"  valign=top ><font class="T2"><?php print LANGBASE40 ?></font> <select name="typetrisem" onchange="trimes();" >
     <option value=0  id='select0' ><?php print LANGCHOIX?></option>
     <option value="trimestre" id='select1'><?php print LANGPARAM28?></option>
     <option value="semestre"  id='select1'><?php print LANGPARAM29?></option>
     </select> <font class="T2"> : </font></TD>
     <TD  valign=top><select name="saisie_trimestre">
                     <option id='select1'>        </option>
                     <option id='select1'>        </option>
                     <option id='select1'>        </option>
              </Select>
         </td>
     </tr>
	 <tr><td height=20></td></tr>
     <tr><td align=right  valign=top ><font class="T2"><?php print LANGBULL3?> :</font> </td>
     <td valign=top> 
        <select name='anneeScolaire' >
        <?php
        $anneeScolaire=$_COOKIE["anneeScolaire"];
        filtreAnneeScolaireSelectNote($anneeScolaire,3);
        ?>
        </select>
   	</td></tr>
    <tr><td height=20></td></tr>
     <tr><td align=right  valign=top><font class="T2"><?php print LANGPARAM35 ?> :</font> </td>
     <td  valign=top>
		<select name="typebull" >
		<option value=0  id='select0' ><?php print LANGCHOIX?></option>
	<?php
	if (isset($_COOKIE["bulletinannee"])) {
			print "<option id='select1' value='".$_COOKIE["bulletinselection"]."' selected='selected' >".RecupBulletin(trim($_COOKIE["bulletinselection"]))."</option>";
	}

	$tab=array();
	if (file_exists("../common/config.bulletin.php")) {
		include_once("../common/config.bulletin.php");
		$liste=LISTEBULLETIN;
		$tab=explode(",",$liste);
	}
	if (count($tab) >= 1) {
		foreach($tab as $key=>$value) {
			$libelle=RecupBulletin(trim($value));
			print "<option id='select1' value='$value'>$libelle</option>";
		}
	}else{
      
		for($i=0;$i<count($tabClasse);$i++) {
			$data=recupBulletinClasse($tabClasse[$i][1]); 
			if (count($data) > 0) {
				$libel=RecupBulletin($data[0][0]);	
				$tablibel[$libel]=$data[0][0];		
			}
		}
		foreach($tablibel as $key=>$value) {
			print "<option value='$value' id='select1' >$key</option>";
		}

		if ($_SESSION["membre"] != "menuprof") {
			listingBulletin();
		}
		listBulletinBlanc();
	}
	?>
     	 </select>
      </td></tr>
	  <tr><td height=20></td></tr>
	  <tr><td colspan='2' align='center' ><br><br><script language=JavaScript>buttonMagicSubmit3VATEL("<?php print LANGBT43?>","rien","");</script></td></td></tr>
</table>
</form>
<br><br>
</table>
<?php } ?>

			
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