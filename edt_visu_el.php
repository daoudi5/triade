<?php
session_start();
$rowHeight = 60; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
include_once("./common/config.inc.php");
include_once("./common/config2.inc.php");
include_once("./librairie_php/langue.php");
include_once("./librairie_php/db_triade.php");
validerequete("6");
$cnx=cnx();

nettoyageEdt();
$fichiercsv="data/edt/edtgoogle_".$_SESSION["id_pers"].".csv";
if (!is_dir("data/edt")) { mkdir("data/edt/"); }


$hd_edt="7";
$hf_edt="21";
$mf_edt="00";
if (defined("HD_EDT")){$hd_edt=HD_EDT;}
if (defined("HF_EDT")){$hf_edt=HF_EDT;}
if (defined("MF_EDT")){$mf_edt=MF_EDT;}
if (($mf_edt < 10) && (strlen($mf_edt) == 1)) { $mf_edt="0".$mf_edt; }
if (trim($hd_edt) == "") { $hd_edt="7";$hf_edt="21";$mf_edt="00"; }
$nb=$hf_edt-$hd_edt+1.2;
$ident=array('nom','Sn','prenom','Sp','membre','Sm','id_pers','Spid');
$mySession=hashSessionVar($ident);
unset($ident);

$Seid=$mySession[Spid];

if ($_SESSION["membre"] == "menututeur") { $Seid=""; }
if (isset($_GET["idelevetuteur"])) {
	$Seid=$_GET["idelevetuteur"];
	$_SESSION["idelevetuteur"]=$Seid;
	$Scid=chercheClasseEleve($Seid);
	$_SESSION["idClasse"]=$Scid;
}
if (isset($_SESSION["idelevetuteur"])) {
	$Seid=$_SESSION["idelevetuteur"];	
}

$idclasse=chercheIdClasseDunEleve($Seid);
$nomclasse=chercheClasse($idclasse);

?>
<title>Triade - EDT</title>
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<style type="text/css">
html{
	margin:0px;
	padding:0px;
	height:100%;
	width:100%;
}
body{
	margin:0px;
	padding:0px;
	font-family:arial;
	font-size:0.8em;	
	height:100%;
	width:100%;
}

p,h2{
	margin:2px;
}

h1{
	font-size:1.4em;
	margin:2px;
}
h2{
	font-size:1.3em;
}
.weekButton{
	width:80px;
	font-size:0.8em;
	font-family:arial;
}
#weekScheduler_container{
	border:1px solid #000;
	width:986px;	
	margin:5px;
	padding:0px;
}

.weekScheduler_appointments_day{	/* Column for each day */
	width:130px;
	float:left;
	background-color: #FFFFD5;
	border-right:1px solid #F6DBA2;	
	position:relative;
}
#weekScheduler_top{
	background-color:buttonface;
	height:20px;
	border-bottom:1px solid #ACA899;
}
.calendarContentTime,.spacer{
	background-color:buttonface;
	text-align:center;
	font-family:arial;
	font-size:28px;
	line-height:<?php echo $rowHeight; ?>px;
	height:<?php echo $rowHeight; ?>px;	/* Height of hour rows */
	
	border-right:1px solid #ACA899;
	width:50px;
}

.weekScheduler_appointmentHour{	/* Small squares for each hour inside the appointment div */
	height:60px; /* Height of hour rows */
	border-bottom:1px solid #F6DBA2;	
}

.spacer{
	height:20px;
	float:left;
}	

#weekScheduler_hours{
	width:50px;
	float:left;
}
.calendarContentTime{
	border-bottom:1px solid #ACA899;

}

#weekScheduler_appointments{	/* Big div for appointments */
	width:917px;
	float:left;
}
.calendarContentTime .content_hour{
	font-size:10px;
	text-decoration:superscript;	
	vertical-align:top;
	line-height:<?php echo $rowHeight; ?>px;
}
	
#weekScheduler_top{
	position:relative;
	clear:both;
}
#weekScheduler_content{
	clear:both;
	height:<?php echo $rowHeight*$nb ?>px;
	position:relative;
	overflow:auto;
}

#stime:hover {
        position:absolute;
        border:1px solid #000;
        right:-1px;
        top:-1px;
        width:80px;
        height:18px;
        z-index:100000;
        font-size:1.5em;
        padding:1px;
        background-color:#F6DBA2;
}


.days div{
	width:130px;
	float:left;
	background-color:buttonface;
	text-align:center;
	font-family:arial;
	height:20px;
	font-size:0.9em;
	line-height:20px;
	border-right:1px solid #ACA899;	
}

.weekScheduler_anAppointment{	/* A new appointment */
	position:absolute;
	background-color:#FFF;
	border:1px solid #000;
	z-index:1000;
	overflow:hidden;


}

.weekScheduler_appointment_header{	/* Appointment header row */
	height:4px;
	background-color:#ACA899;
}
.weekScheduler_appointment_headerActive{ /* Appointment header row  - when active*/
	height:4px;
	background-color:#00F;
}

.weekScheduler_appointment_textarea{	/* Textarea where you edit appointments */
	font-size:0.7em;
	font-family:arial;
}

.weekScheduler_appointment_txt{
	font-size:0.9em;
	font-family:arial;
	padding:2px;
	padding-top:5px;
	overflow:hidden;

}

.weekScheduler_appointment_footer{
	position:absolute;
	bottom:-1px;
	border-top:1px solid #000;
	height:4px;
	width:100%;
	font-size:0.8em;
	background-color:#000;
}

.weekScheduler_appointment_time{
        position:absolute;
        border:1px solid #000;
        right:1px;
        top:5px;
        width:55px;
        height:12px;
        z-index:100000;
        font-size:0.6em;
        padding-left:3px;
        padding-top:2px;
        background-color:#F6DBA2;
        -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
}

.eventIndicator{
	background-color:#00F;
	z-index:50;
	display:none;
	position:absolute;
}

</style>
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script type="text/javascript" src="./librairie_js/info-bulle.js"></script>
<script type="text/javascript" src="./librairie_js/ajax.js"></script>
<script type="text/javascript" src="./librairie_js/function.js"></script>
<script type="text/javascript">
// It's important that this JS section is above the line below wher dhtmlgoodies-week-planner.js is included
var itemRowHeight=<?php echo $rowHeight; ?>;
var initDateToShow="<?php echo date("Y-m-d"); ?>"	// Initial date to show
</script>
<script src="./librairie_js/dhtmlgoodies-week-planner-ro.js?random=<?php echo date("Ymd"); ?>" type="text/javascript"></script>
</head>
<body id='bodyfond2'>
<?php
//$data=affClasse(); //code_class,libelle
$edtimage=0;

if (file_exists("./data/image_pers/".$idclasse."_edt.jpg")) {
	$edtimage=1;
	$id=$idclasse."#jpg";
	$tabClasse[$id]=$nomclasse[0][1];
}

if (file_exists("./data/image_pers/".$idclasse."_edt.pdf")) {
	$edtimage=1;
	$id=$idclasse."#pdf";
	$tabClasse[$id]=$nomclasse[0][1];
}

if ($edtimage == 1){
	print "<form method='post'><br>&nbsp;&nbsp;<font class=T2>Classe : </font><select name='idclasse' onChange='this.form.submit();' >";
	print select_classe_search($donnee[0][6]); 
	print "<option  value='' STYLE='color:#000066;background-color:#FCE4BA'>Aucun</option>";
 	foreach($tabClasse as $id => $nomclasse) {
     		print "<option id='select1' value='".$id."'>".strtoupper($nomclasse)."</option>\n";
        }
	print "</select></form>";
	if (isset($_POST["idclasse"])) {
		list($idclasse,$type)=split("#",$_POST["idclasse"]);
		if ($type == "jpg") {
			print "<br /><img src='image_trombi.php?edt&idclasse=".$idclasse."'  />";
		}else{
			print "<iframe src='visu_pdf_edt.php?id=$idclasse' width='1' height='1' ></iframe>";
		}
	}
}else{
?>

<script type="text/javascript" >
initTopHour = <?php print $hf_edt ?>;	// Initially auto scroll scheduler to the position of this hour
weekplannerStartHour=<?php print $hd_edt ?>;	// If you don't want to display all hours from 0, but start later, example: 8am
</script>
<form name="form">
<br />
&nbsp;&nbsp;<input type="button" class="button" value="<?php print LANGMESS53 ?>" onclick="displayPreviousWeek();return false">
<input type="button" class="button" value="<?php print LANGMESS54 ?>" onclick="displayNextWeek();return false">
 - <input type="text" name="saisiedate" readonly="readonly" size=10  STYLE='color:#000066;background-color:#FCE4BA' > 
<?php include_once("librairie_php/calendar.php"); 
calendarpopupCalend('id2','document.form.saisiedate',$_SESSION["langue"],"1","0");
?> <input type="button" value="ok" class="bouton2" onclick="displayPreviousWeek2(document.form.saisiedate.value)" />
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;<a href='javascript:imprimer()'><img src="image/print.gif" border='0' align=center ></a>
&nbsp;&nbsp;&nbsp;&nbsp;

<input type=hidden name="profID" value="" >
<input type=hidden name="classeID" value="<?php print $idclasse ?>" >
<?php 
if ($_SESSION["membre"] == "menututeur") {
?>
	&nbsp;&nbsp;
	<select name='idelevetuteur' onchange="this.form.submit()" >
		<?php 
		if ($Seid != "") {
			$nom=recherche_eleve_nom($Seid);
			$prenom=recherche_eleve_prenom($Seid);
	        	print "<option id='select1' value='$Seid' title=\"".strtoupper($nom)." $prenom\" >".trunchaine(strtoupper($nom)." ".$prenom,30)."</option>\n";
		}else{
			print "<option id='select0' >".LANGCHOIX."</option>";
		}
		listEleveTuteur($_SESSION["id_pers"],30)
		?>
	</select>
<?php }else{ ?>
	<font class="T2"><?php print LANGMESS55 ?> <font color=red><?php print $nomclasse[0][1] ?></font></font>
<?php } ?>
<script type="text/javascript"> //displayDate(); </script>
<br /><br />
&nbsp;&nbsp;<input type="button" onclick="open('telecharger.php?fichier=<?php print $fichiercsv ?>&fichiername=Export_Google.csv','_blank','');" class="BUTTON" value="Export Google Agenda" />
<br /><br />
<div id="weekScheduler_container" style='box-shadow: 0px 0px 10px 4px rgba(119, 119, 119, 0.75); moz-box-shadow: 0px 0px 10px 4px rgba(119, 119, 119, 0.75); -webkit-box-shadow: 0px 0px 10px 4px rgba(119, 119, 119, 0.75);' >
	<div id="weekScheduler_top">
		<div class="spacer"><span></span></div>
		<div class="days" id="weekScheduler_dayRow">
			<div><?php print LANGLUNDI ?> <span></span></div>
			<div><?php print LANGMARDI ?> <span></span></div>
			<div><?php print LANGMERCREDI ?> <span></span></div>
			<div><?php print LANGJEUDI ?> <span></span></div>
			<div><?php print LANGVENDREDI ?> <span></span></div>
			<div><?php print LANGSAMEDI ?> <span></span></div>
			<div><?php print LANGDIMANCHE ?> <span></span></div>		
		</div>	
	</div>
	<div id="weekScheduler_content">
		<div id="weekScheduler_hours">
		<?php
		
		$startHourOfWeekPlanner = $hd_edt;	// Start hour of week planner
		$endHourOfWeekPlanner = $hf_edt;	// End hour of weekplanner.

		$month=dateM_duServeur();
		$day=dateD_duServeur();
		$year=dateY_duServeur();

		$date = mktime($startHourOfWeekPlanner,0,0,$month,$day,$year);
		for($no=$startHourOfWeekPlanner;$no<=$endHourOfWeekPlanner;$no++){
			
			$hour = $no;
			
			//Remove these two lines in case you want to show hours like 08:00 - 23:00
			//$suffix = date("a",$date);
			//$hour = date("g",$date);
			
			$suffix = "$mf_edt"; // Enable this line in case you want to show hours like 08:00 - 23:00 
			
			
			$time = $hour."<span class=\"content_hour\">$suffix</span>";	
			$date = $date + 3600;		
			?>
			<div class="calendarContentTime"><?php echo $time; ?></div>
			<?php
		}
		?>
		</div>	
		
		<div id="weekScheduler_appointments">
			<?php
			for($no=0;$no<7;$no++){	// Looping through the days of a week
				?>
				<div class="weekScheduler_appointments_day">
				<?php
				for($no2=$startHourOfWeekPlanner;$no2<=$endHourOfWeekPlanner;$no2++){
					echo "<div id=\"weekScheduler_appointment_hour".$no."_".$no2."\" class=\"weekScheduler_appointmentHour\"></div>\n";					
				}				
				?>				
				</div>
				<?php
			}
			?>		
		</div>
	</div>
</div>

<?php
	/*
<h2>How it works</h2>
<p>This script uses Ajax(Asyncron Javascript and XML) to read event data from the server.</p>
<p>New event: Hold your mouse down and drag</p>
<p>Move event: Hold your mouse down at the top of an event and drag</p>
<p>Resize event: Hold your mouse down at the bottom of an event and drag</p> 
<p>Edit event: Hold your mouse down at the middle of an event and wait until a textarea appears. Click outside of the textarea when you're finished or hit
the escape key to cancel the changes</p>
<p>Delete event: Click on event and press delete key on your keyboard</p>
	 */
?>
</form>
<script  type="text/javascript" > displayPreviousClasse3(); </script>
<?php @Pgclose() ?>
<SCRIPT type="text/javascript">InitBulle("#000000","#FCE4BA","red",1);</SCRIPT>
<?php } ?>
</body>
</html>
