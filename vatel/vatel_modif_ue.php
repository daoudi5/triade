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
				<li style="visibility:visible" ><a href='vatel_list_ue.php' ><?php print LANGVATEL113 ?></a></li>
				<li style="visibility:visible" ><a href='vatel_gestion_ue.php?copy' ><?php print LANGVATEL112 ?></a></li>
				<li style="visibility:visible" ><a></a></li>
			</ul>
			</div>
		</header>

		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">

<form  method="post" name="formulaire">
<!-- // fin  -->
<BR>
<?php
include("../librairie_php/fonctions_vatel.php"); 
validerequete("menuadmin");

if (isset($_POST["create"])){
	$cr1=vatel_modif_ue($_POST,$_POST['id_detail']);
	vatel_supp_ue($_POST['id_detail'],'ue_detail');
	for($i=0;$i<=$_POST["nb"];$i++) {
		$code_matiere=$_POST["code_matiere_$i"];
		if ($code_matiere > 0) { 
			$idprof=$_POST["idprof_$i"];
			vatel_create_due_bis($code_matiere,$_POST['id_detail'],$idprof);
		}
	}
 	
}

$data_ue=vatel_liste_ue($_GET['id']); // code_ue,code_classe,semestre,num_ue,nom_ue,coef_ue,ects,idpers_prof,nom_ue_en ,annee_scolaire  

?>
<table>
<td align='right'><font class="T2"><?php print LANGBULL3?>&nbsp;:&nbsp;</font> </td>
<td> 
        <select name='annee_scolaire' >
<?php
        filtreAnneeScolaireSelectNote($data_ue[0][9],3);
?>
	</select>
</td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Nom &nbsp;:&nbsp;</font> </td><td><input type=text name="nom_ue" size=40  maxlength='40' value="<?php print $data_ue[0][4]?>"></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Ordre d'apparition &nbsp;:&nbsp;</font> </td><td> <input type=text name="num_ue" size='2' value="<?php print $data_ue[0][3]?>"> ( <?php print LANGVATEL116 ?> ) </td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Coef. &nbsp;:&nbsp;</font> </td><td> <input type=text name="coef_ue" size='2' value="<?php print $data_ue[0][5]?>" ></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>ECTS &nbsp;:&nbsp;</font> </td><td> <input type=text name="ects_ue" size='2' value="<?php print $data_ue[0][6]?>" ></td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2>Classe &nbsp;:&nbsp;</font> </td><td> <select name='code_classe'>
<option value=''></option>
<?php
$data=affClasse();
for($i=0;$i<count($data);$i++)
        {
	print "<option STYLE='color:#000066;background-color:#CCCCFF' value='".$data[$i][0]."'";
	if ($data_ue[0][1]==$data[$i][0]) {
		print "selected";
	      	$nomclasse=$data[$i][1];	
	} 
	print " >".$data[$i][1]."</option>";
        }
?>
</select></td></tr>
<?php
if($cr1){
  alertJs(LANGDONENR." \\n\\n".LANGVATEL114." $nomclasse ".LANGVATEL115." !! ");
}
?>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2><?php print ucfirst(LANGPARAM29) ?>&nbsp;:&nbsp;</font></td><td> 
	 <select name="semestre">
        <option STYLE='color:#000066;background-color:#CCCCFF' value="0" <?php if ($data_ue[0][2]==0) { print 'selected';  } ?> >1 et 2</option>
        <option STYLE='color:#000066;background-color:#CCCCFF' value="1" <?php if ($data_ue[0][2]==1) { print 'selected';  } ?> >1</option>
        <option STYLE='color:#000066;background-color:#CCCCFF' value="2" <?php if ($data_ue[0][2]==2) { print 'selected';  } ?> >2</option>
     </select><br>
</td></tr>
<tr><td align='right' >&nbsp;&nbsp;<font class=T2><?php print LANGLIST3 ?> &nbsp;:&nbsp;</font> </td><td> <select name='idpers_profp'>
<option  id='select0' value='0' ><?php print LANGCHOIX ?></option>
<?php
$idprofp=$data_ue[0][7];
if ($idprofp > 0) print "<option  id='select1' value='$idprofp' selected='selected'>".strtoupper(recherche_personne_nom($idprofp,'ENS'))." ".ucfirst(recherche_personne_prenom($idprofp,'ENS'))."</option>";
?>
<option  id='select0' value='0' ><?php print LANGCHOIX ?></option>
<?php

select_personne_2('ENS','40');
?>
</select>
</table>
<br><br>

<table border=1 style="border-collapse: collapse;" >
<tr>
<td bgcolor='black' >&nbsp;&nbsp;<font class='T2' color='#FFFFFF' ><?php print LANGASS18 ?>&nbsp;&nbsp;</font></td>
<td bgcolor='black' >&nbsp;&nbsp;<font class='T2' color='#FFFFFF' ><?php print LANGGEN3 ?>&nbsp;&nbsp;</font></td>
</tr>
<?php
$data_detail=vatel_liste_uedetail($_GET['id']); //code_ue_detail,code_ue,code_matiere,code_enseignant
$data=affMatiere();

for($i=0;$i<count($data);$i++)  {
	$checked="";
	$id="";
	$code_enseignant="0";
	if ($data[$i][1] != "") {
		for($j=0;$j<count($data_detail);$j++)  {
			$code_enseignant=$data_detail[$j][3];
			if ($data_detail[$j][2]==$data[$i][0]) {
				$checked="checked='checked'"; 
				$id=$data_detail[$j][0];
				break;
			}else{
				$code_enseignant="0";
			}
		}
	}
	$bgcolor=($bgcolor=="#87C1E6") ? $bgcolor="#BCDAF0" : $bgcolor="#87C1E6" ;
	print "<tr bgcolor='$bgcolor' >\n";
	print "<td align='center' >&nbsp;&nbsp;<input type='checkbox' $checked name='code_matiere_$i' value='".$data[$i][0]."' > ".strtolower($data[$i][1]); 
	print "</td><td><select name='idprof_$i'>";
	if ($code_enseignant > 0) {
		print "<option  id='select1' value='$code_enseignant' >".ucfirst(recherche_personne_nom($code_enseignant,"ENS"))." ".ucfirst(recherche_personne_prenom($code_enseignant,"ENS"))."</option>";
	}else{
		print "<option  id='select0' value='0' >".LANGCHOIX."</option>;";
	}
	select_personne_2('ENS','20'); 
	print "</select></td></tr>";
}

?><input type="hidden" value="<?php print $_GET['id']?>" name="id_detail"></td></tr>
<tr><td colspan="3" id='bordure' >
<input type='hidden' name='nb' value='<?php print count($data) ?>' /> 
<script language=JavaScript>buttonMagicSubmitVATEL("<?php print LANGBASE38 ?>","create"); //text,nomInput</script>
<br><br><br>
</td></tr></table>


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