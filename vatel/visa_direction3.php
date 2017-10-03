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
if (isset($_POST["annee_scolaire"])) {
        $anneeScolaire=$_POST["annee_scolaire"];
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
				<li style="visibility:visible" ><a href="visa_direction.php" ><?php print LANGVATEL207 ?></a></li>
				<li style="visibility:visible" ></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		
<?php
$idclasse=$_POST["saisie_classe"];
$tri=$_POST["saisie_trimestre"];
$nb=$_POST["saisie_nb"];
$type_bulletin=$_POST["type_bulletin"];
$anneeScolaire=$_POST["anneeScolaire"];


for($i=0;$i<$nb;$i++) {
	$com=$_POST['comm'][$i];
	$eleveid=$_POST['eleveid'][$i];
	$montessori="aucun";
	$tmpp="montessori_$eleveid";
	if (isset($_POST[$tmpp])) { $montessori=$_POST[$tmpp]; }

	$leap_felicitation=0;
	$leap_encouragement=0;
	$leap_megcomp=0;
	$leap_megtrav=0;
	$jtc_promu=0;
	$jtc_reprendre=0;
	$jtc_orientation=0;
	$pp_av_trav=0;
	$pp_av_comp=0;
	$pp_enc=0;
	$pp_feli=0;
	$ppv2_av=0;
	$ppv2_faible=0;
	$ppv2_passable=0;
	$ppv2_enc=0;
	$ppv2_feli=0;

	// LEAP
	$tmpp="leap_felicitation_$eleveid";
	if (isset($_POST[$tmpp])) { $leap_felicitation=$_POST[$tmpp]; }
	$tmpp="leap_encouragement_$eleveid";
	if (isset($_POST[$tmpp])) { $leap_encouragement=$_POST[$tmpp]; }
	$tmpp="leap_megcomp_$eleveid";
	if (isset($_POST[$tmpp])) { $leap_megcomp=$_POST[$tmpp]; }
	$tmpp="leap_megtrav_$eleveid";
	if (isset($_POST[$tmpp])) { $leap_megtrav=$_POST[$tmpp]; }

	//JTC
	$tmpp="jtc_promu_$eleveid";
	if (isset($_POST[$tmpp])) { $jtc_promu=$_POST[$tmpp]; }
	$tmpp="jtc_reprendre_$eleveid";
	if (isset($_POST[$tmpp])) { $jtc_reprendre=$_POST[$tmpp]; }
	$tmpp="jtc_orientation_$eleveid";
	if (isset($_POST[$tmpp])) { $jtc_orientation=$_POST[$tmpp]; }

	//Pigier Paris
	$tmpp="pp_av_trav_$eleveid";
	if (isset($_POST[$tmpp])) { $pp_av_trav=$_POST[$tmpp]; }
	$tmpp="pp_av_comp_$eleveid";
	if (isset($_POST[$tmpp])) { $pp_av_comp=$_POST[$tmpp]; }
	$tmpp="pp_enc_$eleveid";
	if (isset($_POST[$tmpp])) { $pp_enc=$_POST[$tmpp]; }
	$tmpp="pp_feli_$eleveid";
	if (isset($_POST[$tmpp])) { $pp_feli=$_POST[$tmpp]; }
	

	//Pigier Paris V2
	$tmpp="pp2_av_$eleveid";
	if (isset($_POST[$tmpp])) { $ppv2_av=$_POST[$tmpp]; }
	$tmpp="pp2_faible_$eleveid";
	if (isset($_POST[$tmpp])) { $ppv2_faible=$_POST[$tmpp]; }
	$tmpp="pp2_passable_$eleveid";
	if (isset($_POST[$tmpp])) { $ppv2_passable=$_POST[$tmpp]; }
	$tmpp="pp2_enc_$eleveid";
	if (isset($_POST[$tmpp])) { $ppv2_enc=$_POST[$tmpp]; }
	$tmpp="pp2_feli_$eleveid"; 
	if (isset($_POST[$tmpp])) { $ppv2_feli=$_POST[$tmpp]; }

	$cr=create_comm_direc_bull($eleveid,$tri,$com,$montessori,$type_bulletin,$leap_felicitation,$leap_encouragement,$leap_megcomp,$leap_megtrav,$jtc_promu,$jtc_reprendre,$jtc_orientation,$pp_av_trav,$pp_av_comp,$pp_enc,$pp_feli,$ppv2_av,$ppv2_faible,$ppv2_passable,$ppv2_enc,$ppv2_feli,$anneeScolaire);
	if ($cr) {
		history_cmd($_SESSION["nom"],"BULLETIN","Commentaire Direction");
	}
}	

	

?>
<br />
</form>
<center><font class=T2><?php print LANGVATEL212 ?></font></center>
<br><br>

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