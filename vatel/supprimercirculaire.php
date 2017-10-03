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
?>

<div id="wrapper" style="padding-top: 50px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu' >
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGASS24 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='circulaire-admin.php' ><?php print LANGVATEL21 ?></a></li>
				<li style="visibility:visible" ><a href='visucirculaire.php' ><?php print LANGVATEL24 ?></a></li>
				<li style="visibility:visible" ><a href='supprimercirculaire.php' ><?php print LANGVATEL23 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<?php
validerequete("menuadmin");
if (isset($_POST["supp"])) {
	$cr=circulaireSup($_POST["saisie_id"]) ;
        if($cr) {
		$nomfichier=$_POST["saisie_nom_fic"];
		@unlink ("../data/circulaire/".trim($_POST["saisie_nom_fic"]));
        // alertJs("Circulaire supprimée --  Service Triade");
	    // reload_page('circulaire_supp.php');
        }
}
?>
<table border=1 width=100%>
<?php
	$data=circulaireAffAdmin2();
?>
	<tr>
	<td bgcolor="black" width=5%><font color='white'><?php print LANGTE7 ?></font></td>
	<td bgcolor="black"><font color='white'><?php print LANGFORUM12?></font></td>
	<td bgcolor="black"><font color='white'><?php print LANGCIRCU20 ?></font></td>
	<td bgcolor="black" align=center width=5%><font color='white'><?php print LANGBT50?></font></td>
	</tr>
<?php
	for($i=0;$i<count($data);$i++)	{
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
?>
	<form method=post>
	<tr bgcolor='<?php print $bgcolor ?>' >
	<td valign=top>&nbsp;<?php print dateForm($data[$i][4])?>&nbsp;</td>
	<td valign=top>
	&nbsp;<?php print $data[$i][1]?>&nbsp;
	</td>
	<td valign=top width=15>&nbsp;[&nbsp;<a href="visu_document.php?fichier=../data/circulaire/<?php print $data[$i][3]?>" title="<?php print LANGPARENT20 ?>" target="_blank"><?php print LANGPER27 ?></a>&nbsp;]&nbsp;</td>
	<td valign=top>
	<input type=submit name=supp value="<?php print LANGBT50?>"  onclick="this.value='<?php print LANGattente222 ?>'" class="btn btn-primary btn-sm  vat-btn-footer" >
	<input type=hidden name="saisie_id" value="<?php print $data[$i][0]?>">
	<input type=hidden name="saisie_nom_fic" value="<?php print $data[$i][3]?>">
	</td>
	</tr>
	</form>
<?php
	}

?>

</table>
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
