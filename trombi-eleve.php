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
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php include("./librairie_php/lib_licence.php"); ?>
<?php
// connexion (apr�s include_once lib_licence.php obligatoirement)
include_once("librairie_php/db_triade.php");
$cnx=cnx();
?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>
<form method=post onsubmit="return valide_consul_classe()" name="formulaire">
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGTITRE32?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
<!-- // debut form  -->
<?php
// affichage de la classe
$idEleve=$_SESSION["id_pers"];
$saisie_classe=chercheIdClasseDunEleve($idEleve);
$sql="SELECT libelle,elev_id,nom,prenom,photo FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
$res=execSql($sql);
$data=chargeMat($res);

// ne fonctionne que si au moins 1 �l�ve dans la classe
// nom classe
$cl=$data[0][0];

if( count($data) <= 0 )
	{
	print("<center>".LANGRECH1."</center>");
	}
else {
?>
<table border="1" width="100%">
<tr>
<?php
$nbphoto=0;
for($i=0;$i<count($data);$i++) {
?>
	<td bgcolor="#FFFFFF" align=center>
	<?php
	$nbphoto++;
	if (  ((TROMBIELEVE == "non") && ($_SESSION["membre"] == "menueleve") && ($_SESSION["id_pers"] != $data[$i][1])) ||  ((TROMBIPARENT == "non") && ($_SESSION["membre"] == "menuparent") && ($_SESSION["id_pers"] != $data[$i][1])) ) {
		print "<img src='./image/commun/photo_vide.jpg' /><br>";
		//print strtoupper($data[$i][2])?> <?php // print trunchaine(ucwords($data[$i][3]),15);
	}else{
		print "<img src='image_trombi.php?idE=".$data[$i][1]."' /><br>";
		print strtoupper($data[$i][2])?> <?php print trunchaine(ucwords($data[$i][3]),15);
	}
	?>
	</td>
	<?php
	if ($nbphoto > 2) {
		print "</tr><tr>";
		$nbphoto=0;
	}

}
print "</tr>";
print "</table>";
}
?>
</td></tr></table>
<?php
       // Test du membre pour savoir quel fichier JS je dois executer
       if (($_SESSION["membre"] == "menuadmin") || ($_SESSION["membre"] == "menuscolaire")) :
            	print "<SCRIPT language='JavaScript' ";
       		print "src='./librairie_js/".$_SESSION[membre]."2.js'>";
            	print "</SCRIPT>";
       else :
            	print "<SCRIPT language='JavaScript' ";
      		print "src='./librairie_js/".$_SESSION[membre]."22.js'>";
            	print "</SCRIPT>";

            top_d();

            	print "<SCRIPT language='JavaScript' ";
      		print "src='./librairie_js/".$_SESSION[membre]."33.js'>";
            	print "</SCRIPT>";

      endif ;
     ?>
<?php
// deconnexion en fin de fichier
Pgclose();
?>
</BODY>
</HTML>
