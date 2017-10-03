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
<?php include_once("../common/config2.inc.php"); ?>
<?php $cnx=cnx2(); ?>
<?php 
if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent") || ($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { ?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
		<div style="width:100%;background-color:#F4F5F7">
		<section class="container" style="padding-top:10px">
		<br>

		<div id="mainInst" style='background-color:#ddd;padding:20px;box-shadow: 0px 0px 10px 4px rgba(119, 119, 119, 0.75); moz-box-shadow: 0px 0px 10px 4px rgba(119, 119, 119, 0.75); -webkit-box-shadow: 0px 0px 10px 4px rgba(119, 119, 119, 0.75);'>
			<?php
			if ((LAN == "oui") && (AGENTWEB == "oui")) {
	                        $cnx=cnx();
	                        $data=visu_param();
	                        PgClose();
	                        $nometablissement=$data[0][0];
	                        $etablissement=urlencode(stripHTMLtags("$nometablissement"));
	                        print $mess;
	                }
	        include_once("../common/version.php");
			include_once("../librairie_php/lib_licence2.php");
        	include_once("../common/productId.php");
			?>
	                <div style='nophone2;float:left;padding-right:30px' ><img src="../image/logo_triade_licence.gif" alt="logo_triade_licence" /></div>

	                <div style='padding-top:30px'>
	                    Version : <b><?php print VERSION; ?></b><br />
	                    Licence d'utilisation  : <?php print LICENCE; ?> <br />
	                    Product ID = <b> <?php print PRODUCTID; ?> </b><br />
	                </div>
			<br><br>
	                <div style="width:90%;height:200px;overflow:auto;text-align: justify;">
	        	        <?php print DROITUTILISATION."\n\n".DROITRIADE?>
		                <p>S.A.R.L. - T.R.I.A.D.E. &copy; <?php print date("Y"); ?></p>
			</div>
			<br><br>
			<div>	
            <form name="inscripform" method='POST' action="accueil.php">
			<input type='checkbox' name="accord" value="1" onclick="document.inscripform.val.disabled=false; document.inscripform.accord.disabled=true;" /> <?php print LANGCONDITION ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<input type=submit value='<?php print ACCEPTER ?>' disabled='disabled' name="val"  role="button" data-toggle="modal" data-target="#brochuremodal" class="btn btn-primary btn-sm vat-btn-footer" >
			</form>
	        </div>

		</div>

		</section>
		</div>
		</div>
	</div>
<?php } /* fin du IF du membre eleve */ ?>    
	
<?php Pgclose(); ?>
	
<?php include_once("piedpage.php"); ?>
<?php include_once("connexionEnCours.php"); ?>
</body>
</html>
