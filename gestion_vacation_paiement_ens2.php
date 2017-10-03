<?php
session_start();
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
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/verif_creat.js"></script>
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script type="text/javascript" src="./librairie_js/info-bulle.js"></script>
<script type="text/javascript" src="./librairie_js/prototype.js"></script>
<script type="text/javascript" src="./librairie_js/ajax_proto.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php 
include_once("./librairie_php/lib_licence.php"); 
include_once("librairie_php/db_triade.php");
validerequete("menuadmin");
$cnx=cnx();

if (isset($_GET["idprof"])) {
	$idprof=$_GET["idprof"];
}

if (isset($_POST["saisie_pers"])) {
	$idprof=$_POST["saisie_pers"];
}

$nomprenom=recherche_personne($idprof);

if (isset($_GET["id"])) {
	deletePaimentVacation($_GET["id"]);
	history_cmd($_SESSION["nom"],"PAIEMENT","Suppression � $nomprenom");
}



?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="125">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Paiement vacation enseignant" ?></font></b></td></tr>
<tr id='cadreCentral0'><td ><br>
<form method="post" action="gestion_vacation_ens_paiement3.php" name="formulaire">

<input type="hidden" name=idprof value="<?php print $idprof ?>" />

<?php


print "<font class='T2'>&nbsp;&nbsp;Enseignant(e) :<b> $nomprenom </b></font><br><br>";

$taille="2Mo";
$maxsize="2000000";
if (MAXUPLOAD == "oui") { $taille="8Mo"; $maxsize="8000000"; }
?>

<table width="100%" border="0" align="center">
<tr>
<td align="right"><font class="T2"><?php print "Paiement pour la p�riode du " ?> :</font></td>
<td colspan="2"   align="left"><input type="text" value="" name="saisie_date_debut" TYPE="text" size=13  class=bouton2 readonly='readonly' >
<?php
 include_once("librairie_php/calendar.php");
 calendarDim("id1","document.formulaire.saisie_date_debut",$_SESSION["langue"],"0","0");
?>
</td>
</tr>
<tr>
<td  align="right"><br><font class="T2"><?php print "au" ?> : </font></td>
<td colspan="2"  align="left"><br><input type="text" value="" name="saisie_date_fin" TYPE="text" size=13 class=bouton2  readonly='readonly' >
<?php
 include_once("librairie_php/calendar.php");
 calendarDim("id2","document.formulaire.saisie_date_fin",$_SESSION["langue"],"0","0");

if ((defined("TVAVACATION")) && (TVAVACATION == "oui") ) {

	if (defined("TVAVACATIONTAUX")) {
		if (TVAVACATIONTAUX == "") {
			$tvataux=0;
		}else{	
			$tvataux=TVAVACATIONTAUX;
	 	}
 	}else{
		$tvataux=0;
 	}
}else{
	$tvataux=0;
}
 

$idpiecejointe=md5(date("Y-m-d h:i:s").$nomprenom);
?>
</td>
</tr>
<tr><td height='20'></td></tr>
<tr><td  align="right"><font class="T2">Descriptions / Infos :</font> </td><td colspan="2"  align="left"><textarea name="infopaiement" cols=30 rows=3 class=bouton2 ></textarea></td></tr>
<tr><td height='20'></td></tr>
<tr><td  align="right"><font class="T2">Montant HT :</font> </td><td colspan="2"  align="left"><input type="text" onchange="affectTTC()"  name="montantHT" id="montantHT" size=13 class=bouton2 ></td></tr>
<tr><td height='20'></td></tr>
<tr><td  align="right"><font class="T2">Montant TTC :</font> </td><td colspan="2"  align="left"><input type="text" id='montantTTC' name="montantTTC" size=13 class=bouton2 readonly='readonly' ></td></tr>
<tr><td height='20'></td></tr>
<tr><td  align="right"><font class="T2">Taux TVA : </font> </td><td colspan="2"  align="left"><?php print $tvataux ?></td></tr>
<tr><td height='20'></td></tr>
<tr><td  align="right" colspan='2'>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="292" height="54" id="fileUpload" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="./librairie_php/fileUploadCompta.swf" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<param name=FlashVars value="idpiecejoint=<?php print trim($idpiecejointe) ?>&maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>">
<?php $couleur=couleurFont(GRAPH); ?>
<param name="bgcolor" value="<?php print $couleur ?>" />
<embed src="./librairie_php/fileUploadCompta.swf" quality="high" bgcolor="<?php print $couleur ?>"  wmode="transparent"
       width="292" height="54" name="fileUpload" align="middle" allowScriptAccess="sameDomain" 
       type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="idpiecejoint=<?php print trim($idpiecejointe) ?>&maxsize=<?php print trim($maxsize) ?>&idsession=<?php print session_id()?>" />
</object><a href='#'  onMouseOver="AffBulle('Fichier Taille Max : <?php print $taille ?>');"  onMouseOut="HideBulle()";><img src="./image/help.gif" border=0  ></a></td></tr>

</table>


<table align='center'><tr><td>
<script type="text/javascript" >buttonMagicSubmit("Enregistrer","create")</script>
<script type="text/javascript" >buttonMagicRetour("gestion_vacation.php","_parent")</script>&nbsp;&nbsp;&nbsp;
</td></tr></table>
<input type="hidden" name='idpiecejointe' value="<?php print $idpiecejointe ?>" />
<br>
</form>
</td></tr></table>
<br><br>

<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="125">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print "Paiements effectu�s � $nomprenom" ?></font></b></td></tr>
<tr id='cadreCentral0'><td valign='top'>

<table border='1' width='100%' >
<tr>
<td bgcolor='yellow' align=center>&nbsp;Date&nbsp;</td>
<td bgcolor='yellow' align=center>&nbsp;P�riode&nbsp;</td>
<td bgcolor='yellow' align=center>&nbsp;Description&nbsp;</td>
<td bgcolor='yellow' align=center colspan=2>&nbsp;Montant&nbsp;</td>
</tr>
<?php
$data=listingPaiementVacation($idprof); //id_prof,datedebut,datefin,montant_ht,montant_tc,montant_tva,info,datetransaction,idpiecejointe,id
for($i=0;$i<count($data);$i++) {
	$date=dateForm($data[$i][7]);
	$dateDebut=dateForm($data[$i][1]);
	$dateFin=dateForm($data[$i][2]);
	$description=$data[$i][6];
	$montant=$data[$i][4];
	$id=$data[$i][9];
	$idpiecejointe=$data[$i][8];
	print "<tr class=\"tabnormal2\" onmouseover=\"this.className='tabover'\" onmouseout=\"this.className='tabnormal2'\" >";
	print "<td align=center>$date</td>";
	print "<td align=center>$dateDebut&nbsp;-&nbsp;$dateFin</td>";
	if (file_exists("./data/comptaenseignant/$idpiecejointe.pdf")) {
		$imgpdf="<a href='./visu_pdf_compta.php?id=./data/comptaenseignant/${idpiecejointe}.pdf' target='_blank'><img src='image/commun/pdf.png' border='0' /></a>";
	}else{
		$imgpdf="";
	}
	print "<td valign='top' >$imgpdf $description</td>";
	print "<td align='right'>".affichageFormatMonnaie($montant)." ".unitemonnaie()."</td>";
	print "<td align=center><a href='JavaScript:supppaiement($id,$idprof)' title='Supprimer'><img src='image/commun/trash.png' border='0'/></a></td>";
	print "</tr>";

}

?>
</table>
<br>
<!-- // fin form -->
</td></tr></table>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."2.js'>" ?></SCRIPT>
 <SCRIPT type="text/javascript">InitBulle("#000000","#FCE4BA","red",1);</SCRIPT>
<script>
function affectTTC() {
        var HT=eval(document.formulaire.montantHT.value);
        var taux='<?php print $tvataux ?>';

        if (HT > 0) {
                var resultat = (HT * taux) / 100 ;
                document.formulaire.montantTTC.value=HT + resultat ;
        }

}


function supppaiement(id,idprof) {
	var cr=confirm('Confirmer la suppression du paiement ?');
	if (cr) {
		location.href="gestion_vacation_paiement_ens2.php?id="+id+"&idprof="+idprof;
	}
}

</script>
</BODY>
</HTML>
<?php Pgclose(); ?>

