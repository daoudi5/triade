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
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="../librairie_css/css.css">
<script language="JavaScript" src="librairie_js/clickdroit2.js"></script>
<title>Triade</title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" >
<?php include("./librairie_php/lib_licence.php"); ?>
<SCRIPT language="JavaScript" src="librairie_js/menudepart.js"></SCRIPT>
<?php include("librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart1.js"></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' >Google Analytics</font></b></td></tr>
<tr id='cadreCentral0'><td valign=top >
<!-- // debut de la saisie -->
<?php
if (LAN == "oui") {
	include_once("./librairie_php/lib_licence.php");
	include_once("./librairie_php/db_triade_admin.php");
	$cnx=cnx();
?>
<table ><tr><td>
<font class="T2" />
Google Analytics vous permet d'avoir un retour des diff�rents modules 
utilis�s. Google Analytics analyse le trafic de votre TRIADE et fournit 
des rapports clairs et pr�cis au sujet de vos visiteurs, vous informant 
de leur provenance, de leur fr�quentation du site. <br>
<a href="http://www.google.com/analytics/fr-FR/features.html" target="_blank">>> Pour en savoir plus.</a> 
</td><td>
<img src="image/intro_small_new.jpg" align=right />
</td></tr></table>
<br><br><center>
<?php 
$IDGOOGLE=recupcomptegoogleanalytic();

if (verifcomptegoogleanalytic()) {
	print "<font class=T2>";
	print "<a href='http://www.google.com/analytics/fr-FR/index.html' target='_blank'>";
	print "Acc�s � Google Analytics";
	print "</a></font>";

}else{
	?>
	<font class=T2><a href="https://www.google.com/accounts/NewAccount?service=analytics&hl=fr&continue=http://www.google.com/analytics/home/%3Fet%3Dreset" target="_blank" >Inscrivez-vous d�s maintenant : c'est facile et gratuit !</a></font>
	<?php } ?>
</center>
<br>
<br />   
<hr>
<font class=T2>
Une fois votre compte cr�� vous pourrez effectuer la demande d'analyse de votre site TRIADE.
Il vous suffira "Ajouter un profil de site Web", suiver les instructions que l'on vous demande.<br>
<br>
Un code vous sera retourn� comme celui-ci :<br>
<br>

&lt;script type="text/javascript"&gt;<br>
var _gaq = _gaq || [];<br />
_gaq.push(['_setAccount', '<font color=red>xx-xxxxxxx-x</font>']);<br />
_gaq.push(['_trackPageview']);<br />
(function() {<br />
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;<br />
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';<br />
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);<br />
})();<br />
&lt;/script&gt;<br>

<br>
<form method=post action="google-analytics2.php" />
&nbsp;&nbsp;Indiquer ici l'ID de site Web  : <input type=text size=20 name="idref" value="<?php print $IDGOOGLE ?>"  /> <input type=submit value="Valider" class="button" name="creategoogle" />
</form>

</font>


</font>
<?php
	PgClose();
}else{
	print "<br><center><font class=T2>".ERREUR1."</font> <br><br> <i>".ERREUR2."</i></center>";
}
?>

<!-- // fin de la saisie -->
</td></tr></table>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart2.js"></SCRIPT>
<?php top_d(); ?>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart22.js"></SCRIPT>
</body>
</html>
