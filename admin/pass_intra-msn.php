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
<script language="JavaScript" src="librairie_js/clickdroit.js"></script>
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
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' >Mot de passe  Intra-MSN</font></b></td></tr>
<tr id='cadreCentral0' > <td > <p align="left"><font color="#000000">
<TABLE  bordercolor="#000000" border=0 width=100%>
<TR><TD><br>
<!-- // debut de la saisie -->
<?php
if (isset($_POST["create"])) {
	include_once("./librairie_php/db_triade_admin.php");
	$cnx=cnx();
	modifPasseAdminIntraMSN($_POST["pwd"]);
	print "<center><font class=T2>Mot de passe Intra-MSN initialis�</font></center><br><br>";
	Pgclose($cnx);
}else{
?>
	<ul>
	<form method="post">
	<table border='0'>
	<tr><td align='right'><font class='T2'>Login :</td><td><font class='T2'> administrateur</font></td></tr> 
	<tr><td align='right'><font class='T2'>Mot de passe :</td><td> <input type="text" name="pwd" /></td></tr>
	</TD></TR>
	<tr><td colspan='2' align='center'><br /><input type="submit" value="Enregistrer" class='button' name='create' /></td></tr>
	</table>
	</form>
	<br><br>
	</font>
	</ul>
<?php } ?>

</td></tr></table>
<!-- // fin de la saisie -->
</td></tr></table>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart2.js"></SCRIPT>
<?php top_d(); ?>
<SCRIPT language="JavaScript" src="./librairie_js/menudepart22.js"></SCRIPT>
</body>
</html>
