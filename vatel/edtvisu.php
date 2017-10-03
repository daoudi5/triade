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
<?php $cnx=cnx2(); ?>
<?php 


if (isset($_POST["saisie_pers"])) {
	$idprof=$_POST["saisie_pers"];
	$_SESSION["idprofviaadmin"]=$idprof;
}



if (($_SESSION["membre"] == "menueleve") || ($_SESSION["membre"] == "menuparent")) { 
	$source="myfeed";
?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
			<header id="page-title" style="margin-bottom: 0px;" class='menu'>
				<div class="container">
					<?php
					$idclasse=$_SESSION["idClasse"];
					$nomclasse=chercheClasse($idclasse);
					?>
					<span class="vat-capitalize-title"><?php print LANGMESS55 ?> <font color=red><?php print $nomclasse[0][1] ?></font></span>
				</div>
			</header>
			<div class='espace'></div>
			<div style="width:100%;background-color:#F4F5F7">
				<section class="container" style="padding-top:10px">
					<div id='calendar'></div>
				</section>
			</div>
		</div>
	</div>
<?php } ?>


<?php 
if (($_SESSION["membre"] == "menuprof") || ($_SESSION["membre"] == "menuadmin")) { 
	$source="myfeedprof";
	
	if (isset($_SESSION["idprofviaadmin"])) {
		$mys=$_SESSION["idprofviaadmin"];
		$nomduprof=" - ".LANGVATEL41." ".recherche_personne2($mys);
	}

?> 
	<div id="wrapper" style="padding-top: 90px;">
		<div id="blog">
			<header id="page-title" style="margin-bottom: 0px;" class='menu'>
				<div class="container">
					<span class="vat-capitalize-title"><?php print LANGVATEL33 ?> <?php print $nomduprof ?></span>
				</div>
			</header>
			<div class='espace'></div>
			<div style="width:100%;background-color:#F4F5F7">
				<section class="container" style="padding-top:10px">
					<div id='calendar'></div>
				</section>
			</div>
		</div>
	</div>
<?php

}
 
Pgclose();
include_once("piedpage.php"); 
include_once("connexionEnCours.php"); 
include_once("../common/config2.inc.php");
$debut=HD_EDT.":00:00";
$fin=HF_EDT.":00:00";
?>
<script>
/* Javascript */
$(function () {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek'
                },
                editable: false,
                weekends: true,
		theme: true,
		businessHours: true,
		lang: '<?php print $lang ?>',
		minTime: '<?php print $debut ?>', // Set your min time
		maxTime: '<?php print $fin ?>', // Set your max time
		eventSources: [
        		// your event source
		        {
		            url: "<?php print $source ?>.php", // use the `url` property
			    type: 'POST',
               		    data: {
		                custom_param1: 'something',
                		custom_param2: 'somethingelse'
		            },
		        //    color: '#2199da',    // an option!
		            textColor: 'black',  // an option!
		        }
		]
        });

});
</script>
</body>
</html>
