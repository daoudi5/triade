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
$cnx=cnx2();

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
			<span class="vat-capitalize-title"><?php print LANGVATEL113 ?> </span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='param9.php' ><?php print LANGVATEL69 ?></a></li>
				<li style="visibility:visible" ><a href='vatel_creat_ue.php' ><?php print LANGMESS223 ?></a></li>
				<li style="visibility:visible" ><a href='vatel_gestion_ue.php?copy' ><?php print LANGVATEL112 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<form method="post" >
&nbsp;&nbsp;&nbsp;<font class="T2"><?php print LANGBULL3?> :</font> <select name='anneeScolaire' onChange="this.form.submit()"  >
<?php
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>
&nbsp;&nbsp;<font class='T2'><?php print LANGMESS347 ?> </font>
<select name='idclasse' onChange="this.form.submit()" >
<option   STYLE='color:#000066;background-color:#FCE4BA'><?php print LANGCHOIX ?></option>
<?php
select_classe($_POST["idclasse"]); // creation des options
?>
</select>
</form>
<!-- // fin  -->
<BR>
<?php 
if (isset($_POST["idclasse"])) {  ?>
	<br><br>
	<table border=1 width='100%'  style="border-collapse: collapse;" >
	<tr>
	<td bgcolor="black"><font color='#FFFFFF'><b><?php print LANGELE4 ?></b></font></td>
	<td bgcolor="black"><font color='#FFFFFF'><b><?php print LANGMESS351 ?></b></font></td>
	<td bgcolor="black"><font color='#FFFFFF'><b><?php print LANGMESS350 ?></b></font></td>
	<td bgcolor="black" align='center' width='1%' ><font color='#FFFFFF'><b><?php print LANGMESS348 ?></b></font></td>
	<td bgcolor="black" align='center' width='1%' ><font color='#FFFFFF'><b><?php print LANGMESS349 ?></b></font></td>
	</tr>
<?php
	include("../librairie_php/fonctions_vatel.php"); 
	$data = vatel_liste_ueViaIdClasse($_POST["idclasse"],$_POST["anneeScolaire"]);
	
	for($i=0;$i<count($data);$i++)  {
		if ($data[$i][1] != "") {
			$classe= Vatel_affUneClasse($data[$i][1]);
			$sem=($data[$i][2] == 0) ? "1&nbsp;et&nbsp;2" : $data[$i][2];
			$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
			print "<tr bgcolor='$bgcolor' >\n";
			print "<td>&nbsp;".$classe[0][0]."&nbsp;</td>";
			print "<td>&nbsp;".$sem."&nbsp;</td>";
			print "<td>&nbsp;".$data[$i][4]."&nbsp;</td>";
			print "<td align=center><input type=button  class='btn btn-primary btn-sm  vat-btn-footer' value=\"".LANGPER30."\" onclick=\"open('vatel_modif_ue.php?id=".$data[$i][0]."','_parent','');\" ></td>";
			print "<td align=center><input type=button  class='btn btn-primary btn-sm  vat-btn-footer' value=\"".LANGacce21."\" onclick=\"open('vatel_supp_ue.php?id=".$data[$i][0]."','_parent','');\" ></td>";
			print "</tr>";
		}
	}
	print "</table>	";
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