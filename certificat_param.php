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
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<script type="text/javascript">
_editor_url = "./HTMLArea";
_editor_lang = "fr";
</script>
<script type="text/javascript" src="./HTMLArea/htmlarea-pdf.js"></script>
<script type="text/javascript">
HTMLArea.loadPlugin("ContextMenu");
HTMLArea.loadPlugin("TableOperations");
function initDocument() {
  var editor = new HTMLArea("editor");
  editor.registerPlugin(ContextMenu);
  //editor.registerPlugin(TableOperations);
  editor.generate();
}
</script>
<title>Triade - Compte de <?php print "$_SESSION[nom] $_SESSION[prenom]" ?></title>
</head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="initDocument()" >
<?php 
include_once("./librairie_php/lib_licence.php");
include_once("librairie_php/db_triade.php");
$cnx=cnx();
?>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="100%">
<tr id='coulBar0' ><td height="2"><b><font   id='menumodule1' ><?php print LANGTITRE33?></font></b></td>
</tr>
<tr id='cadreCentral0' >
<td valign="top" ><br>
<?php
if (isset($_POST["create"])) {
	$num_certif=$_POST["num_certif"];
	$texte=$_POST["suite"];
	$texte=ereg_replace('\\\"','"',$texte);
	$texte=ereg_replace("\\\'","'",$texte);
	//----------------------------------------------------//
	config_param_ajout($_POST["suite"],"param_certifica$num_certif");
?>
<font class=T2><b><?php print LANGPARAM4 ?></b></font>
<br><br>
<font class=T1><?php print LANGCONFIG2 ?></font>:<br><br>
<table width=100% height=200 bgcolor="#FFFFFF" border=1 cellpadding="5" >
<tr><td valign=top>
<?php print $texte ?>
</td></tr></table>
<br><br>
<script language=JavaScript>buttonMagicFermeture();</script>
<br><br><br>
<?php
}else{
	$num_certif=$_POST["num_certif"];
	$data=config_param_visu("param_certifica$num_certif");
	print LANGPARAM3;
	$texte=$data[0][0];
?>
<form method='post'>
<font class='T2'>Certificat num�ro : </font><select name='num_certif' onChange="this.form.submit()" >
<?php if ($_POST["num_certif"] != "") print "<option value='".$_POST["num_certif"]."'>".preg_replace('/_/','',$_POST["num_certif"])."</option>"; ?>
<option value=''></option>
<option value='_A'>A</option>
<option value='_B'>B</option>
<option value='_C'>C</option>
</select> 
</form>
<br>
<form method=post>
<textarea id="editor" style="height: 48em; width: 100%;" name="suite"><?php print $texte ?>
</textarea><br><br>
<script language=JavaScript>buttonMagicSubmit("<?php print LANGBT19?>","create");</script>
<script language=JavaScript>buttonMagicFermeture();</script>
<script language=JavaScript>buttonMagicReactualise();</script>
<font class='T2'>Certificat num�ro : </font><select name='num_certif' >
<?php if ($_POST["num_certif"] != "") print "<option value='".$_POST["num_certif"]."'>".preg_replace('/_/','',$_POST["num_certif"])."</option>"; ?>
<option value=''></option>
<option value='_A'>A</option>
<option value='_B'>B</option>
<option value='_C'>C</option>
</select> 
</form>
<br><br>
<?php } ?>
</td></tr></table>
<?php
// deconnexion en fin de fichier
Pgclose();
?>
</BODY>
</HTML>
