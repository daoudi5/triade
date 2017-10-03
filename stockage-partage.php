<?php
session_start();
//error_reporting(0);

if (empty($_SESSION["nom"]))  {
    header('Location: acces_refuse.php');
    exit;
}

include_once("./librairie_php/lib_licence.php");
include_once("./librairie_php/db_triade.php");

function mimetype($fichier,$quoi) {
	global $mess,$HTTP_USER_AGENT;
	if(!eregi("MSIE",$HTTP_USER_AGENT)) {$client="netscape.gif";} else {$client="html.gif";}
	if(is_dir($fichier)){$image="dossier.gif";$nom_type=$mess[8];}
	else if(eregi("\.mid$",$fichier)){$image="mid.gif";$nom_type=$mess[9];}
	else if(eregi("\.txt$",$fichier)){$image="txt.gif";$nom_type=$mess[10];}
	else if(eregi("\.sql$",$fichier)){$image="txt.gif";$nom_type=$mess[10];}
	else if(eregi("\.js$",$fichier)){$image="js.gif";$nom_type=$mess[11];}
	else if(eregi("\.gif$",$fichier)){$image="gif.gif";$nom_type=$mess[12];}
	else if(eregi("\.jpg$",$fichier)){$image="jpg.gif";$nom_type=$mess[13];}
	else if(eregi("\.html$",$fichier)){$image=$client;$nom_type=$mess[14];}
	else if(eregi("\.htm$",$fichier)){$image=$client;$nom_type=$mess[15];}
	else if(eregi("\.rar$",$fichier)){$image="rar.gif";$nom_type=$mess[60];}
	else if(eregi("\.gz$",$fichier)){$image="zip.gif";$nom_type=$mess[61];}
	else if(eregi("\.tgz$",$fichier)){$image="zip.gif";$nom_type=$mess[61];}
	else if(eregi("\.z$",$fichier)){$image="zip.gif";$nom_type=$mess[61];}
	else if(eregi("\.ra$",$fichier)){$image="ram.gif";$nom_type=$mess[16];}
	else if(eregi("\.ram$",$fichier)){$image="ram.gif";$nom_type=$mess[17];}
	else if(eregi("\.rm$",$fichier)){$image="ram.gif";$nom_type=$mess[17];}
	else if(eregi("\.pl$",$fichier)){$image="pl.gif";$nom_type=$mess[18];}
	else if(eregi("\.zip$",$fichier)){$image="zip.gif";$nom_type=$mess[19];}
	else if(eregi("\.wav$",$fichier)){$image="wav.gif";$nom_type=$mess[20];}
	else if(eregi("\.php$",$fichier)){$image="php.gif";$nom_type=$mess[21];}
	else if(eregi("\.php$",$fichier)){$image="php.gif";$nom_type=$mess[22];}
	else if(eregi("\.phtml$",$fichier)){$image="php.gif";$nom_type=$mess[22];}
	else if(eregi("\.exe$",$fichier)){$image="exe.gif";$nom_type=$mess[50];}
	else if(eregi("\.bmp$",$fichier)){$image="bmp.gif";$nom_type=$mess[56];}
	else if(eregi("\.png$",$fichier)){$image="gif.gif";$nom_type=$mess[57];}
	else if(eregi("\.css$",$fichier)){$image="css.gif";$nom_type=$mess[58];}
	else if(eregi("\.mp3$",$fichier)){$image="mp3.gif";$nom_type=$mess[59];}
	else if(eregi("\.xls$",$fichier)){$image="xls.gif";$nom_type=$mess[64];}
	else if(eregi("\.doc$",$fichier)){$image="doc.gif";$nom_type=$mess[65];}
	else if(eregi("\.pdf$",$fichier)){$image="pdf.gif";$nom_type=$mess[79];}
	else if(eregi("\.mov$",$fichier)){$image="mov.gif";$nom_type=$mess[80];}
	else if(eregi("\.avi$",$fichier)){$image="avi.gif";$nom_type=$mess[81];}
	else if(eregi("\.mpg$",$fichier)){$image="mpg.gif";$nom_type=$mess[82];}
	else if(eregi("\.mpeg$",$fichier)){$image="mpeg.gif";$nom_type=$mess[83];}
	else if(eregi("\.swf$",$fichier)){$image="flash.gif";$nom_type=$mess[91];}
	else {$image="defaut.gif";$nom_type=$mess[23];}
	if($quoi=="image"){return $image;} else {return $nom_type;}
}



function taille($fichier) {
	global $size_unit;
	$taille=filesize($fichier);
	if ($taille >= 1073741824) {$taille = round($taille / 1073741824 * 100) / 100 . " G".$size_unit;}
	elseif ($taille >= 1048576) {$taille = round($taille / 1048576 * 100) / 100 . " M".$size_unit;}
	elseif ($taille >= 1024) {$taille = round($taille / 1024 * 100) / 100 . " K".$size_unit;}
	else {$taille = $taille . " ".$size_unit;} 
	if($taille==0) {$taille="-";}
	return $taille;
}

$cnx=cnx();

$idpers=$_SESSION["id_pers"];
$membre=$_SESSION["membre"];

echo "<html>\n";
echo "<head><title>$mess[23] : ".$nomdufichier."</title>";
echo "<LINK TITLE='style' TYPE='text/CSS' rel='stylesheet' HREF='./librairie_css/css.css'>";
?>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<?php
echo "</head>\n";
echo "<body id='coulfond1' >";

echo "<table width='100%'>";
echo "<tr><td align='right' >";
echo "<a href=\"stockage-partage.php\" title=\"R�seau / Partage\"><img src=\"image/stockage/reseau.png\" alt=\"R�seau Partage\" border=\"0\"></a>&nbsp;&nbsp;\n";
echo "<a href=\"stockage.php\"><img src=\"image/stockage/hdd.gif\" alt=\"Local\" border=\"0\"></a>&nbsp;&nbsp;\n";
echo "<a href=\"javascript:location.reload()\"><img src=\"image/stockage/refresh.gif\" alt=\"$mess[85]\" border=\"0\"></a>&nbsp;&nbsp;\n";
echo "</td></tr></table>";

print "<div style='position:absolute; left:30px; top:45px; border: 2px solid #CCCCCC; background-color: #FFFFEE; border-radius: 10px 10px 10px 10px; width:90%; height:360px; overflow:auto '  >";
print "<br>";
print "<font class='T2'>&nbsp;&nbsp;<b>Liste des fichiers partag�s : </b>";
print "&nbsp;&nbsp;<table width='100%' >";
print "<tr><td height='5' colspan='4' ></td></tr>";
print "<tr><td width='40%' >Fichier</td><td>Taille</td><td>Modifi� le</td><td>T�l�charger</td></tr>";
print "<tr><td height='5' colspan='4' ></td></tr>";
$data=recupListFichierPartager($idpers,$membre);
// fichier,chemin,membreIdProprio,membreIdAutorise,idclasse,membresource,idsource,id
for($i=0;$i<count($data);$i++) {
	$fichier=$data[$i][0];
	$chemin=$data[$i][1];
	$membresource=$data[$i][5];
	$idsource=$data[$i][6];
	$id=$data[$i][7];

	print "<tr>";
	print "<td width='5' ><img src='image/stockage/".mimetype("./data/stockage/$membreS/$idpersS/$chemin","image")."' align='bottom' />";
	print "$fichier</td>";
	print "<td>".taille("./data/stockage/$membresource/$idsource/$chemin")."</td>";
	$tmp=filemtime("./data/stockage/$membresource/$idsource/$chemin");
	print "<td>".date("d/m/Y H:i",$tmp)."</td>";
	print "<td><a href='stockage-download.php?id=$id' target='_blank' ><img src='./image/stockage/download.gif' /></a></td>";
	print "</tr>";

}
print "</table>";
print "</font></div>";
?>

<?php Pgclose(); ?>
</body>
</html>
