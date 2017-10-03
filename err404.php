<?php include_once("./common/config5.inc.php"); header('Content-type: text/html; charset='.CHARSET); ?>
<HTML>
<?php
error_reporting(0);
include_once("./common/lib_admin.php");
include_once("./common/lib_ecole.php");
?>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade©, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="/<?php print REPECOLE?>/librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/clickdroit2.js"></script>
<title>Accès IMPOSSIBLE</title>
</head>
<body id='bodyfond2'>
<BR><BR><BR><BR>
<center>
<table width="57%" border="0" align="center" >
<tr><td align=center id='bordure' >
<font color="red" class="T2"><br />ERREUR 404<br />
Page non trouvée.<br /><br /></font>
<br /><br />
<input type=button  value="Retour Page Précédente" onClick="open('Javascript:history.go(-1)','_top','');" class='bouton2' ><BR><BR>
</td>
</tr>
</table>
<BR><BR>
Notre site web : <a href="http://www.triade-educ.com">www.triade-educ.com</A> pour toutes informations.
<br />
<p> La <b>T</b>ransparence et la <b>R</b>apidité de l'<b>I</b>nformatique <b>A</b>u service <b>D</b>e l'<b>E</b>nseignement<br>Pour visualiser ce site de façon optimale : résolution minimale : 800x600 <br>  © 2000/<?php print date("Y"); ?> S.A.R.L. T.R.I.A.D.E. - Tous droits réservés
</center>
<BR><BR>
<?php
/*
$pass=1;
if (trim($_SERVER["REDIRECT_URL"]) == "/favicon.ico") { $pass=0; }
if (ereg("favicon",$_SERVER["REDIRECT_URL"])) { $pass=0; }
if (ereg('banniere000.gif$',$_SERVER["REDIRECT_URL"])) { $pass=0; }
if (ereg('fleche.ani$',$_SERVER["REDIRECT_URL"])) { $pass=0; }
if (ereg('banniere000.jpg',$_SERVER["REDIRECT_URL"])) { $pass=0; }
if (ereg('err404.php$',$_SERVER["REDIRECT_URL"])) { $pass=0; }
if (ereg('main.css$',$_SERVER["REDIRECT_URL"])) { $pass=0; }
if (trim($_SERVER["HTTP_REFERER"]) == "") { $pass=0; }
if (ereg('AppleWebKit',$_SERVER["HTTP_REFERER"])) { $pass=0; }
if (eregi('fckeditor',$_SERVER["HTTP_REFERER"])) { $pass=0; }

if ( "213.138.13.198" == $_SERVER["REMOTE_ADDR"] ) { $pass=0; }

if ($pass == "1") {
	$date = date("d/m/Y \à G:i");
	$fp=fopen("./data/error.log","a+");
	fwrite($fp,"<font color=red>Erreur Type : 404 </font>- Page non trouvé - <br /> Visité le $date par ".$_SERVER["REMOTE_ADDR"]." <BR>avec ".$_SERVER["HTTP_USER_AGENT"]." <BR><font color=red>  ".$_SERVER["REDIRECT_URL"]." </font> <br> - lien à partir de : <font color=red>".$_SERVER["HTTP_REFERER"]."  </font><br><hr><br>\n");
	fclose($fp);
}
 */
?>
</BODY></HTML>
