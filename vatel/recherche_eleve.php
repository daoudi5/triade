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

validerequete("menuadmin");
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
			<span class="vat-capitalize-title"><?php print LANGMODIF4 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param8.php' ><?php print "Menu" ?></a></li>
				<li style="visibility:visible" ><a href='recherche_eleve.php' ><?php print LANGPER30 ?></a></li>
                                <li style="visibility:visible" ><a href='suppression_compte_eleve.php' ><?php print LANGBT50 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
<?php			
include_once("../librairie_php/ajax.php");
ajax_js();
?>
<form method=post onsubmit="return valide_recherche_eleve()" name="formulaire">
<table border=0 cellspacing=0><tr><td style="padding-top:0px;" nowrap>
<font class="T2"><?php print LANGABS3?> : </font><input type="text" name="saisie_nom_eleve" size="20" id="search" autocomplete="off" onkeyup="searchRequest(this,'eleve','target','formulaire','saisie_nom_eleve')"   style="width:15em;" />
</td></tr><tr><td style="padding-top:0px;"><div id="target" style="width:18.5em;" ></div></td></tr>
</table><div style="position:relative">
<br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT39?>","create"); //text,nomInput</script>
</div>
</td></tr></table>
</form>
<br /><br />

<?php
//alertJs(empty($create));
// affichage de la liste d élèves trouvés
if(isset($_POST["saisie_nom_eleve"])) {
$saisie_nom_eleve=trim($_POST["saisie_nom_eleve"]);
$motif=strtolower($saisie_nom_eleve);
$sql=<<<EOF

SELECT c.libelle,e.nom,e.prenom,e.elev_id
FROM ${prefixe}eleves e, ${prefixe}classes c
WHERE lower(e.nom) LIKE '%$motif%'
AND c.code_class = e.classe
ORDER BY c.libelle, e.nom, e.prenom

EOF;
$res=execSql($sql);
$data=chargeMat($res);

?>
<table border="0" cellpadding="3" cellspacing="1" width="100%"  >
<tr><td height="2" colspan=3><b><font>
<?php print LANGRECH2?> : <font id="color2"><B><?php print ucwords(stripslashes($motif))?></font>
</font></td>
</tr>
<?php

if( count($data) <= 0 ) {
	print("<tr><td align=center valign=center>".LANGRECH3."</td></tr>");
}else{
?>
	<tr bgcolor="#000000"><td><font color='#FFFFFF'><b><?php print ucwords(LANGIMP10)?></b></font></td><td><font color='#FFFFFF'><B><?php print LANGIMP8?></B></font></td><td><font color='#FFFFFF'><B><?php print LANGIMP9?></B></font></td></tr>
<?php
for($i=0;$i<count($data);$i++)
	{
	 $bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	?>
	<tr bgcolor='<?php print $bgcolor ?>' >
	<td><?php print $data[$i][0]?></td>
	<td><a style="text-decoration:underline" href="edit_eleve.php?eid=<?php print $data[$i][3]?>"><?php print strtoupper($data[$i][1])?></a></td>
	<td><?php print ucwords($data[$i][2])?></td>
	</tr>
	<?php
	}
}

?>
</table>
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
