<?php
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin               &nbsp;:&nbsp; Janvier 2000
 *   copyright           &nbsp;:&nbsp; (C) 2000 E. TAESCH - T. TRACHET - 
 *   Site                &nbsp;:&nbsp; http://www.triade-educ.com
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

// Sn&nbsp;:&nbsp; variable de Session nom
// Sp&nbsp;:&nbsp; variable de Session prenom
// Sm&nbsp;:&nbsp; variable de Session membre
// Spid&nbsp;:&nbsp; variable de Session pers_id
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$idpers=$mySession[Spid];
validerequete("menuadmin");

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
<form  method="post" name="formulaire" onSubmit="return verifAnneeScolaire()" >

<table>
<td align='right'><font class="T2"><?php print LANGBULL3?>&nbsp;:&nbsp;</font> </td>
<td> 
<select name='annee_scolaire' >
<?php
include("../librairie_php/fonctions_vatel.php"); 
$cnx=cnx();
$anneeScolaire=$_COOKIE["anneeScolaire"];
filtreAnneeScolaireSelectNote($anneeScolaire,3);
?>
</select>
</td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Nom&nbsp;:&nbsp;</font> </td><td><input type=text name="nom_ue" size=40  maxlength=40></td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Ordre d'apparition&nbsp;:&nbsp;</font> </td><td> <input type=text name="num_ue" size='2' value="<?php print $data_ue[0][3]?>"> ( au sein du bulletin de z&eacute;ro &agrave; n ) </td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Coef.&nbsp;:&nbsp;</font> </td><td> <input type=text name="coef_ue" size='2' ></td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>ECTS&nbsp;:&nbsp;</font> </td><td> <input type=text name="ects_ue" size='2' ></td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Classe&nbsp;:&nbsp;</font> </td><td> <select name='code_classe'>
<?php
$data=affClasse();
for($i=0;$i<count($data);$i++){
	print "<option STYLE='color:#000066;background-color:#CCCCFF' value='".$data[$i][0]."'>".strtoupper($data[$i][1])."</option>";
}
?>
</select></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Semestre&nbsp;:&nbsp;</font></td><td> 
	<select name="semestre">
        <option STYLE='color:#000066;background-color:#CCCCFF' value="0">1 et 2</option>
        <option STYLE='color:#000066;background-color:#CCCCFF' value="1">1</option>
        <option STYLE='color:#000066;background-color:#CCCCFF' value="2">2</option>
    </Select>
</td></tr>
<tr><td height='10'></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Professeur Principal&nbsp;:&nbsp;</font> </td><td> 
<select name='idpers_profp'>
<option  id='select0' value='0' ><?php print LANGCHOIX ?></option>
<?php
select_personne_2('ENS','40');
?>
</select>
</table>
<br>
<table border='1' style="border-collapse: collapse;" width='90%'>
<tr>
<td width=5%></td>
<td bgcolor='black' ><font color='white'><b>&nbsp;<?php print LANGASS18 ?>&nbsp;</b></font></td>
<td bgcolor='black' width='1%'><font color='white'><b>&nbsp;<?php print LANGPER18 ?>&nbsp;</b></font></td>
</tr>
<?php
$cnx=cnx();
$data=affMatiere();
for($i=0;$i<count($data);$i++)  {
	if ($data[$i][1] != "") {
		$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
		print "<tr  bgcolor='$bgcolor' >";
		print "<td><input type='checkbox' name='code_matiere_$i' value='".$data[$i][0]."'></td>"; 
	 	print "<td>&nbsp;".$data[$i][1]." ".ereg_replace("^0$","",$data[$i][2]);
	 	print "</td><td><select name='idprof_$i'>
			<option  id='select0' value='0' >".LANGCHOIX."</option>";
	       		select_personne_2('ENS','30'); 
	 	print "</select></td></tr>";
	}
}
Pgclose();
?>
</table>
<br><br>
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBT14?>","create"); //text,nomInput</script>
<input type='hidden' name='nb' value='<?php print count($data) ?>' /> 
</form>
<!-- // fin  -->
<?php
if(isset($_POST["create"])){
	validerequete("menuadmin");
    	$cnx=cnx();
	$anneeScolaire=$_POST["annee_scolaire"];
	if ($anneeScolaire == "") {
		alertJs(LANGVATEL271);
	}else{
		$cr=vatel_create($_POST,'ue');
		for($i=0;$i<=$_POST["nb"];$i++) {
			$code_matiere=$_POST["code_matiere_$i"];
			if ($code_matiere > 0) { 
				$idprof=$_POST["idprof_$i"];
				vatel_create_due_bis($code_matiere,$cr,$idprof);
			}	
		}
    		if($cr) {
        		alertJs(LANGVATEL272);
    		}
	}
	Pgclose();
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
