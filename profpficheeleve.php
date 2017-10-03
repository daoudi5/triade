<?php
      session_start();
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET - F. ORY
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
        <title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom] "?></title>
        </head>
        <body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
        <?php include("./librairie_php/lib_licence.php"); ?>
	<?php
	// connexion (apr�s include_once lib_licence.php obligatoirement)
	include_once("librairie_php/db_triade.php");
	$cnx=cnx();
	verif_profp_eleve($_GET['eid'],$_SESSION["id_pers"],$_SESSION["membre"]);
	?>
        <SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre].".js'>" ?></SCRIPT>

             <!-- // texte du menu qui defile   -->
               <?php include("./librairie_php/lib_defilement.php"); ?>
             <!-- // fin du texte   -->

             </TD><td width="472" valign="middle" rowspan="3" align="center">

             <!--   -->
             <div align='center'><?php top_h(); ?>
             <!--  -->

             <SCRIPT language="JavaScript" <?php print "src='./librairie_js/".$_SESSION[membre]."1.js'>" ?></SCRIPT>

<?php
// affichage de l'�l�ve (lecture seule)
if(isset($_GET["eid"]))
// $eid provient(entre autres) de la page recherche_eleve.php
{
$eid=$_GET["eid"];
$sql=<<<EOF

SELECT
	elev_id,
	nom,
	prenom,
	c.libelle,
	lv1,
	lv2,
	`option`,
	regime,
	date_naissance,
	nationalite,
	passwd,
	passwd_eleve,
	civ_1,
	nomtuteur,
	prenomtuteur,	
	adr1,
	code_post_adr1,
	commune_adr1,
	civ_2,
	nom_resp_2,
	prenom_resp_2,
	adr2,
	code_post_adr2,
	commune_adr2,
	telephone,
	profession_pere,
	tel_prof_pere,
	profession_mere,
	tel_prof_mere,
	nom_etablissement,
	numero_etablissement,
	code_postal_etablissement,
	commune_etablissement,
	numero_eleve,
	email,
	email_eleve,
	class_ant,
	annee_ant,
	tel_eleve
FROM
	${prefixe}eleves, ${prefixe}classes c
WHERE
	elev_id='$eid'
AND	c.code_class=classe

EOF;
$res=execSql($sql);
$data=chargeMat($res);

?>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2" colspan=2 ><b><font   id='menumodule1' ><B><?php print LANGPROF26 ?></B></font></td></tr>
<td id='cadreCentral0' colspan=2><br>&nbsp;&nbsp;<input type=button class=BUTTON value="<-- <?php print LANGPRECE ?>" onclick="open('profp3.php?eid=<?php print $_GET[eid]?>','_parent','')"><br><br></td>
<?php
if( count($data) <= 0 )
	{
	print("<tr><td align=center valign=center>".LANGEDIT1."</td></tr>");
	}
else { //debut else

$nom_cellule=array( id, LANGELE2, LANGELE3, LANGELE4, Lv1, Lv2, "Option ".LANGELE5, LANGELE6, LANGELE10, LANGELE11, LANGIMP51,LANGIMP52 ,"Civilit� ","Nom Resp. 1", LANGEL12,  LANGEL14, LANGEL15, LANGEL16, "Civilit� ", "Nom Resp. 2", "Pr�nom Resp. 2", LANGEL18, LANGEL19, LANGEL20, LANGEL21, LANGEL22, LANGEL23, LANGEL24, LANGEL25, LANGEL26, LANGEL27, LANGEL28, LANGEL29, LANGEL30,  LANGELE244. " Parent", "Email El�ve",LANGbasededoni41, LANGbasededoni42,"T�l �l�ve");
for($i=1;$i<count($data[0]);$i++)
		{//debut for
		if(ereg("[a-zA-Z0-9��������]{1,}",trim($data[0][$i]))) {
			if($i==8) {$data[0][$i]=dateForm($data[0][$i]);}
			if($i==1) {$data[0][$i]=strtoupper($data[0][$i]);}
			if($i==2) {$data[0][$i]=ucwords($data[0][$i]);}
			if($i==10) {$data[0][$i]="xxxxxxxxx";}
			if($i==11) {$data[0][$i]="xxxxxxxxx";}
			if(($i==12) && (trim($data[0][$i]) != "")) { $data[0][$i]=civ($data[0][$i]); }
			if(($i==18) && (trim($data[0][$i]) != "")) { $data[0][$i]=civ($data[0][$i]); }
		?>
		<tr><td bgcolor="#FFFFFF" width=40% align=right><B><?php print $nom_cellule[$i]?> :</B> </td>
		    <td bgcolor="#FFFFFF"><?php print $data[0][$i]?></td></tr>
		<?php
		}
		else {
		?>
		<tr><td bgcolor="#FFFFFF" width=40% align=right><B><?php print $nom_cellule[$i]?> :</B> </td>
		<td bgcolor="#FFFFFF"><font color="red"><?php print LANGERROR2?></font></td></tr>
		<?php
			}
		}//fin for
    }//fin else
print "</table>";
}
?>
<?php
// Test du membre pour savoir quel fichier JS je dois executer
if ($_SESSION["membre"] == "menuadmin") :
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