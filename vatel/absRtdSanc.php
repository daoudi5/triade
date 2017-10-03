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
 ?>
<?php include_once("entete.php"); ?>
<?php include_once("menu.php"); ?>
<?php 
$cnx=cnx2(); 



if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")) { 
	$Seid=$_SESSION["id_pers"];
	$anneeScolaire=$_SESSION["anneeScolaire"];
?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
		<header id="page-title" style="margin-bottom: 0px;" class='menu'>
			<div class="container">
			<span class="vat-capitalize-title"><?php print LANGASS6 ?></span>
			<ul class="breadcrumb" itemprop="breadcrumb" >
				<li style="visibility:visible" ><a href='absRtdSanc.php?actu=abs' ><?php print LANGVATEL9 ?></a></li>
				<li style="visibility:visible" ><a href='absRtdSanc.php?actu=rtd' ><?php print LANGVATEL10 ?></a></li>
				<li style="visibility:visible" ><a href='absRtdSanc.php?actu=sanc' ><?php print LANGVATEL11 ?></a></li>
				<li style="visibility:visible" ><a href='absRtdSanc.php?actu=retenu' ><?php print LANGDISC11 ?></a></li>
			</ul>
			</div>
		</header>
		<div class='espace'></div>
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		<?php
		if (($_GET["actu"] == "abs") || (!isset($_GET["actu"]))) { 
			$actu="abs"; ?>
			<table align=center style="width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);" >
                <tr bgcolor='#2199da' >
                <td valign=top align=left style="padding-left:2px;border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print preg_replace('/ /','&nbsp;',LANGPARENT8) ?> </td>
		<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGABS43) ?> </td>
		<?php if (!$isPhone) { ?>
			<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGPROFK) ?> </td>
		<?php } ?>
		<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGDISP2) ?> </td>
		<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGABSJUS) ?> </td>
		</tr>
		<?php
		$data_2=affAbsence($Seid,$anneeScolaire);
		//  elev_id, date_ab, date_saisie, origin_saisie, duree_ab ,date_fin, motif,  duree_heure, id_matiere, time, justifier, heure_saisie, heuredabsence, creneaux, smsenvoye, idrattrapage
		for($j=0;$j<count($data_2);$j++) {
		        $motif=$data_2[$j][6];
		        $dateRattrapage="";
		        $heureRattrapage="";
		        $valideRattrapage="";
		        $idrattrapage=$data_2[$j][15];
			$justifier=($data_2[$j][10] == "1") ? LANGOUI : LANGNON;
		//      $SMSEnvoye=$data_2[$j][14];
		        if ($idrattrapage > 0) {
		                $dataRattrapage=recupRattrappage($idrattrapage); //date,heure_depart,duree,valider
		                $dateRattrapage=$dataRattrapage[0][0];
		                $heureRattrapage=$dataRattrapage[0][1];
		                $valideRattrapage=$dataRattrapage[0][3];
		        }
		        if ($data_2[$j][6] == "inconnu") { $motif=LANGINCONNU; }
		        if (trim($data_2[$j][6]) == "0") { $motif=LANGINCONNU; }
		?>
		        <tr bgcolor='#eeeeee' >
		        <TD valign=top style="padding-left:2px;border-bottom:1px solid #000000" ><?php print dateForm($data_2[$j][1])?></td>
		        <TD valign=top style="border-bottom:1px solid #000000" ><?php
		        if ($data_2[$j][4] > 0) {
		                print $data_2[$j][4]." Jour(s)";
		        }
		        if ($data_2[$j][4] == -1) {
		                print $data_2[$j][7]." Heure(s)";
		        }
		        ?> </td>
			<?php if (!$isPhone) { ?>
			        <TD valign=top  style="border-bottom:1px solid #000000" ><?php print dateForm($data_2[$j][2])?></td>
			<?php } ?>
		        <TD valign=top  style="border-bottom:1px solid #000000" ><?php print ucwords($motif)?>
		        <?php
		        if ($dateRattrapage != "") {
		                $dateRattrapage=dateForm($dateRattrapage);
        		        $heureRattrapage=timeForm($heureRattrapage);
		                echo "<br> <font color=blue>- Rattrap&eacute; le $dateRattrapage à $heureRattrapage </font>";
		        }
		        ?>
		        </td>
			<TD valign=top  style="border-bottom:1px solid #000000" ><?php print $justifier ?></td>
		        </tr>
	<?php  } ?>
	</table>
<?php
		} 

		if ($_GET["actu"] == "rtd")  { 
			$actu="rtd";
			?>
			<table align=center style="width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);" >
	                <tr bgcolor='#2199da' >
			<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print preg_replace('/ /','&nbsp;',ucwords(LANGABS13)) ?> </font></td>
			<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGTE13) ?> </font></td>
			<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGABS43) ?> </font></td>
			<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGDISP2) ?> </font></td>
			<td valign=top align=left style="border-bottom:1px solid #000000"  ><b><font size='2' color='#FFFFFF' ><?php print ucwords(LANGRTDJUS) ?> </td>
			</tr>
<?php
			$data_2=affRetard($Seid,$anneeScolaire);
			// elev_id, heure_ret, date_ret, date_saisie, origin_saisie, duree_ret, motif, idmatiere, justifier, heure_saisie, creneaux , idrattrapage
			for($j=0;$j<count($data_2);$j++) {
	
			        $motif=$data_2[$j][6];
			        $dateRattrapage="";
			        $heureRattrapage="";
			        $valideRattrapage="";
			        $idrattrapage=$data_2[$j][11];
				$justifier=($data_2[$j][8] == "1") ? LANGOUI : LANGNON;
			        if ($idrattrapage > 0) {
		        	        $dataRattrapage=recupRattrappage($idrattrapage); //date,heure_depart,duree,valider
			                $dateRattrapage=$dataRattrapage[0][0];
			                $heureRattrapage=$dataRattrapage[0][1];
			                $valideRattrapage=$dataRattrapage[0][3];
			        }
		        	if ($data_2[$j][6] == "inconnu") { $motif=LANGINCONNU; }
			        if (trim($data_2[$j][6]) == "0") { $motif=LANGINCONNU; }
?>
		        <TR bgcolor='#eeeeee' >
        <TD valign=top  style="border-bottom:1px solid #000000" ><?php print dateForm($data_2[$j][2])?></td>
        <TD valign=top  style="border-bottom:1px solid #000000" ><?php print timeForm($data_2[$j][1])?></td>
        <TD valign=top  style="border-bottom:1px solid #000000" ><?php print $data_2[$j][5]?></td>
        <TD valign=top  style="border-bottom:1px solid #000000" >&nbsp; <?php print ucwords($motif)?>
        <?php
        if ($dateRattrapage != "") {
                $dateRattrapage=dateForm($dateRattrapage);
                $heureRattrapage=timeForm($heureRattrapage);
                echo "<br> <font color=blue>- Rattrap&eacute; le $dateRattrapage à $heureRattrapage </font>";
        }
        ?>

        </td>
	<td valign=top  style="border-bottom:1px solid #000000" >&nbsp;<?php print $justifier ?></td>
        </tr>

<?php
      }
?>
</table>



		<?php
		}

		if ($_GET["actu"] == "sanc")  { 
			$actu="sanc";
			if (($_SESSION["membre"] == "menuparent") || ($_SESSION["membre"] == "menueleve")) $data_2=affSanction_par_eleve($Seid);
			?>
			<table align=center style="width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);" >
			<TR bgcolor='#2199da' ><td colspan=4 align=center><b><font size='2' color='#FFFFFF' ><?php print LANGPARENT15 ?></font></td></tr>
			<TR>
			    <TD bgcolor='yellow' align=center width=5>&nbsp;<?php print ucwords(LANGPROFK) ?></td>
			    <TD bgcolor='yellow' align=center ><?php print LANGDISC57?> </td>
			</TR>

			<?php
			for($j=0;$j<count($data_2);$j++) {
		                $raison=$data_2[$j][8];
                		$raison=ereg_replace("\r\n","<br />",$raison);
		                $raison=ereg_replace("\n","<br />",$raison);
			?>
			        <TR bgcolor='#eeeeee' >
			        <TD align=center valign="top" width=10% style="border-bottom:1px solid #000000"  ><?php print dateForm($data_2[$j][4])?></td>
			        <TD valign=top style="border-bottom:1px solid #000000"  >
			        &nbsp;<?php print ucwords(LANGDISC20) ?>: <font color=red><b><?php print rechercheCategory($data_2[$j][3])?></b></font> <br />
			        &nbsp;<?php print ucwords(LANGPARENT15) ?>: <b><?php print $data_2[$j][2]?></b><br />
			        &nbsp;<?php print LANGDISC9 ?> : <?php print trim($data_2[$j][7]) ?><br>
			        &nbsp;<?php print LANGVATEL12 ?> : <?php print $data_2[$j][9]?><br>
			        &nbsp;<?php print LANGPROFJ ?> : <?php print $data_2[$j][8]?>
			        </td>
        			</TR>
<?php
        		}
			print "</table>";
		}


		if ($_GET["actu"] == "retenu")  {
			$actu="retenu";
			

		?>
		<table align=center style="width: 95%; padding: 5px; border-radius: 10px; background: rgba(0,0,0,0.25); box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.1), inset 0 10px 20px rgba(255,255,255,0.3), inset 0 -15px 30px rgba(0,0,0,0.3); -o-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3); -moz-box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 1px rgba(255,255,255,0.3), inset 0 10px rgba(255,255,255,0.2), inset 0 10px 20px rgba(255,255,255,0.25), inset 0 -15px 30px rgba(0,0,0,0.3);" >
		<TR bgcolor='#2199da' ><td colspan=4 align=center><b><font size='2' color='#FFFFFF' ><?php print LANGPARENT16 ?></font></td></tr>
		<TR  bgcolor='#2199da'  >
		<TD bgcolor='yellow' align=center width=10%><?php print LANGPARENT16 ?></td>
		<TD bgcolor='yellow' align=center ><?php print LANGDISP2 ?></td>
		</TR>

		<?php 
		if (($_SESSION["membre"] == "menuparent") || ($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menututeur") ) {
		        $data_2= affRetenuTotal_par_eleve($_SESSION["id_pers"]);
		}
		for($j=0;$j<count($data_2);$j++) {
		?>
	        <TR bgcolor='#eeeeee' >
	        <TD align=center valign=top style="border-bottom:1px solid #000000"  ><?php print dateForm($data_2[$j][1])?><br><?php print LANGPARENT17 ?><br><?php print $data_2[$j][2]?>
	        <br> (<?php print timeForm($data_2[$j][10]) ?>) </td>
	        <TD valign=top style="border-bottom:1px solid #000000"  >
	        &nbsp;<?php print ucwords(LANGDISC20) ?>: <font color=red><b><?php print rechercheCategory($data_2[$j][5])?></b></font> <br />
	        &nbsp;<?php print ucwords(LANGPARENT15) ?>: <b><?php print $data_2[$j][7]?></b><br />
	        &nbsp;<?php print LANGPARENT18 ?> :
	                <?php
	                if ($data_2[$j][6] != 1 ) {
	                        print "<b><font color=red>".ucwords(LANGNON)."</font></b>";
	                }else {
	                        print ucwords(LANGOUI);
	                }
	                ?>
	        <br />&nbsp;<?php print LANGDISC9 ?> : <?php print ucwords($data_2[$j][8])?> - le <?php print dateForm($data_2[$j][3]) ?>
	        <br />&nbsp;<?php print LANGVATEL12 ?> : <?php print $data_2[$j][12]?>
	        <br />&nbsp;<?php print LANGPROFJ ?> : <?php print $data_2[$j][11]?>
	        </td>
        	</TR>
<?php } ?>

	
		</table>	


		<?php

		}

		?>

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre eleve */ ?>    
	
<?php Pgclose(); ?>
<br><br>	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
</body>
</html>
