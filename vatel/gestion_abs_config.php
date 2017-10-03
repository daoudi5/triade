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

if(isset($_POST["creat_sanction"])):
        $cr=create_motif($_POST["saisie_intitule"]);
        if($cr == 1){
  //              alertJs("Motif crée -- Service Triade");
        }
        else {
                  error(0);
        }
endif;

if(isset($_POST["creat_supp"])):
        $cr2=supp_motif($_POST["saisie_int_supp"]);
        if($cr2 == 1){
        //        alertJs("Motif supprimé -- Service Triade");
        }
        else {
                error(0);
        }
endif;



?>
<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGVATEL90 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href="gestion_crenau_config.php"><?php print LANGVATEL120 ?></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<font class="T2 shadow"><B><?php print LANGDISP22?> .</B></font><font class='T2' ><br><br>
<form method=post >
<table border=0><tr><td>
<font class="T2"><?php print LANGDISP23 ?> :</font>
<input type=text size=20 maxlength=30 name=saisie_intitule>
</td><td>
<table align=center><tr><td>&nbsp;&nbsp;
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGAGENDA28 ?>","creat_sanction"); //text,nomInput</script>
</td></tr></table>
</td></tr></table>
</form>
<BR>
<form method=POST>
<?php print LANGDISP24 ?> :
<select name="saisie_int_supp">
<option STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGPROJ13 ?></option>
<?php
select_motif();
?>
</select> <input type='submit' name="creat_supp" value='<?php print LANGMESS150 ?>'   class='btn btn-primary btn-sm  vat-btn-footer'  >
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
