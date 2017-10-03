<?php
session_start();
//error_reporting(0);

if (empty($_SESSION["nom"]))  {
    header('Location: acces_refuse.php');
    exit;
}

$disabled2="";
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

$fic=$_GET["fic"];
$fichier=$_GET["fichier"];

$idpersS=$_SESSION["id_pers"];
$membreS=$_SESSION["membre"];

if (isset($_POST['saisie_classe'])) {
	$fic=$_POST["fic"];
	$fichier=$_POST["fichier"];
	$idclasse=$_POST['saisie_classe'];
	$saisie_classe=$_POST['saisie_classe'];
}

if (isset($_POST['create'])) {
	$fic=$_POST["fic"];
	$idclasse=$_POST['idclasse'];
	$saisie_classe=$_POST['idclasse'];
	$fichier=$_POST["fichier"];
	$nb=$_POST['saisie_nb'];
	$membrerep=$_POST['membrerep'];
	$idpersrep=$_POST['idpersrep'];
	suppPartage($fic,$fichier,"$membreS$idpersS","$idpersdest",$idclasse);
	for($i=0;$i<$nb;$i++) {
		$idpersdest=$_POST['ideleve'][$i];
		if (trim($idpersdest) != "") ajoutPartage($fic,$fichier,"$membreS$idpersS","$idpersdest",$idclasse,$membrerep,$idpersrep);
	}
	$infoEnr="<font id='color3' class='T2' >".LANGABS28."</font>";

}

$chemin=$fic;

echo "<html>\n";
echo "<head><title>$mess[23] : ".$nomdufichier."</title>";
echo "<LINK TITLE='style' TYPE='text/CSS' rel='stylesheet' HREF='./librairie_css/css.css'>";
?>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<?php
echo "</head>\n";
echo "<body id='coulfond1' >";
echo "<br>\n";
?>
<div style="position:absolute; left:400px; top:35px; border: 2px solid #CCCCCC; background-color: #FFFFEE; border-radius: 10px 10px 10px 10px; width:300px; height:100px"  >
<br>
&nbsp;&nbsp;Fichier : <?php print trunchaine($fichier,25)." <img src='image/stockage/".mimetype("./data/stockage/$membreS/$idpersS/$chemin","image")."' align='bottom' /> " ?>&nbsp;&nbsp;<br><br>
&nbsp;&nbsp;Taille : <?php print taille("./data/stockage/$membreS/$idpersS/$chemin") ?><br><br>
&nbsp;&nbsp;Modifi� le : <?php  $tmp = filemtime("./data/stockage/$membreS/$idpersS/$chemin"); print date("d/m/Y H:i",$tmp); ?>
</div>
	<div style="position:absolute; left:400px; top:150px; width:300px; text-align:center" >
<table width='100%'><tr><td align='center'><input class='BUTTON' type='button' value="<?php print RETOUR ?>"  onclick="open('stockage.php','_self','')" /></td></tr>
<tr><td height='40'></td></tr>
<tr><td align='center'><?php print $infoEnr ?></td></tr></table>

</div>

<form method='post' name='form0' >
<ul><font class=T2><?php print LANGPROFG?> :</font> <select id="saisie_classe" name="saisie_classe" onchange="this.form.submit()" >
<?php
if ($saisie_classe > 0) {
	print "<option id='select1' value='$saisie_classe' >".chercheClasse_nom($saisie_classe)."</option>";
}
print "<option id='select0' >".LANGCHOIX."</option>";
select_classe(); // creation des options
?>
</select>
<input type='hidden' name='fic' value='<?php print $fic ?>' />
<input type='hidden' name='fichier' value='<?php print $fichier ?>' />
</form><BR>
</ul>
<?php 
if ($saisie_classe > 0) {
?>
<form method='post' name='form1' >
<UL>
<table border='1' >
<tr>
<td bgcolor='yellow' ><font class='T2'>&nbsp;Nom&nbsp;</font></td>
<td bgcolor='yellow' ><font class='T2'>&nbsp;Pr�nom&nbsp;</font></td>
<td bgcolor='yellow' ><font class='T2'>&nbsp;Autoris�&nbsp;</font><input type="checkbox" onclick="validecase();" name="tous" value="1" id='checkbox1'  class="css-checkbox" /><label for='checkbox1' name='checkbox1_lbl' class='css-label lite-red-check'></label>&nbsp;</td>
</tr>
<?php
	$sql="SELECT libelle,elev_id,nom,prenom FROM ${prefixe}eleves ,${prefixe}classes  WHERE classe='$saisie_classe' AND code_class='$saisie_classe' ORDER BY nom";
	$res=execSql($sql);
	$data=chargeMat($res);
	$cl=$data[0][0];
	$membre="menueleve";

	$ii=3;
	for ($i=0;$i<count($data);$i++) {
		$idperseleve=$data[$i][1];
		$nomeleve=$data[$i][2];
		$prenomeleve=$data[$i][3];
		print "<tr id='tr$ii' >";
		print "<td>&nbsp;".strtoupper($nomeleve)."&nbsp;</td>";
		print "<td>&nbsp;".ucfirst($prenomeleve)."&nbsp;</td>";
		if (verifSIPartage($chemin,$fichier,"$membreS$idpersS","$membre$idperseleve") > 0) { 
			$checked="checked='checked'"; 
		}else{ 
			$checked=""; 
		}
		print "<td><input type='checkbox' name='ideleve[]' value='$membre$idperseleve' $checked /></td>";
		print "</tr>";
		$ii++;
	}

?>
<tr><td colspan='3' id='bordure' height='20' align='center' ><input type='submit' class='BUTTON' value="<?php print VALIDER ?>" name='create' /></td></tr>
</table>
<input type='hidden' name='saisie_nb' value='<?php print count($data) ?>' />
<input type='hidden' name='fichier' value='<?php print $fichier ?>' />
<input type='hidden' name='fic' value='<?php print $fic ?>' />
<input type='hidden' name='idclasse' value='<?php print $idclasse ?>' />
<input type='hidden' name='membrerep' value='<?php print $membreS ?>' />
<input type='hidden' name='idpersrep' value='<?php print $idpersS ?>' />
</form>
<?php } ?>
<script>
function validecase() {
	var nb=document.form1.saisie_nb.value+3;
	var j=0;
	if (document.form1.tous.checked == true) {
		for(i=3;i<nb;i++) {
			document.form1.elements[j].checked=true;
			j=j+1;
		}
	}else{
		for(i=3;i<nb;i++) {
			document.form1.elements[j].checked=false;
			j=j+1;
		}
	}
}
</script>
<?php Pgclose(); ?>
</body>
</html>
