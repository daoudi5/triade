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

$dstJ.="\" \"";
$dstT.="\" \"";
$date_deja="00/0000";
$txt_fini=0;

$data=affDst(); // id_dst,date,matiere,code_classe,heure,duree

$tab_j=array();
// $data : tab bidim - soustab 3 champs
for($i=0;$i<count($data);$i++)
{
      $date_actuel=dateMY();
	$date_recup=dateMoisAnnee($data[$i][1]);
	$date_recup_jour_mois=dateJourMois($data[$i][1]);

       if ($date_recup == $date_actuel) {
		$data[$i][2]=ereg_replace('"',"&quot;",$data[$i][2]);
                $data[$i][2]=ereg_replace('\'','\\\\\'',$data[$i][2]);
                $data[$i][3]=ereg_replace('"',"&quot;",$data[$i][3]);
                $data[$i][3]=ereg_replace('\'','\\\\\'',$data[$i][3]);
		$heure=$data[$i][5];
		$data[$i][5]=ereg_replace("\.","h",$data[$i][5])."0 mn";
		$data[$i][5]="0".$data[$i][5];
		if (!ereg("h",$data[$i][5])) { $data[$i][5]="0${heure}h00 mn"; }
		if ($date_deja == $date_recup_jour_mois ) {
			$dstT.="<hr />";
			$dstT.="<font size=2>".LANGCALEN7.": <strong>".trim($data[$i][3])."</strong><br />DST de: <strong>".trim($data[$i][2]."</strong> � ".timeForm($data[$i][4])." (".$data[$i][5].") </font>");
		}else{
			if ($txt_fini == 1) {
				$dstT.="\"";
			}
			$date_deja=$date_recup_jour_mois;
			$dstJ.=",\"".$date_recup_jour_mois."\"";
			$dstT.=",\" <font size=2>".LANGCALEN7.": <strong>".trim($data[$i][3])."</strong><br />DST de: <strong>".trim($data[$i][2]."</strong> � ".timeForm($data[$i][4])." (".$data[$i][5].") </font>");
			$txt_fini=1;
		}
       }
}

if ($txt_fini == 1) {
$dstT.="\"";
}

$LLUNDI=LANGLETTRELUNDI;
$LMARDI=LANGLETTREMARDI;
$LMERCREDI=LANGLETTREMERCREDI;
$LJEUDI=LANGLETTREJEUDI;
$LVENDREDI=LANGLETTREVENDREDI;
$LSAMEDI=LANGLETTRESAMEDI;
$LDIMANCHE=LANGLETTREDIMANCHE;



$FerieSamedi="";
$FerieMercredi="";
if ((CALMERCREDIAP == "oui") && (CALMERCREDIMATIN == "oui"))  { $FerieMercredi=" || (j==2)"; }
if ((CALMERCREDIAP == "oui") && (CALMERCREDIMATIN == "non"))  { $Ferieap="background='image/commun/ma.jpg'"; $FerieMatin=""; }
if ((CALMERCREDIAP == "non") && (CALMERCREDIMATIN == "oui"))  { $FerieMatin="background='image/commun/ap.jpg'"; $Ferieap=""; }

if ((CALSAMEDIAP == "oui") && (CALSAMEDIMATIN == "oui"))  { $FerieSamedi=" || (j==5)"; }
if ((CALSAMEDIAP == "oui") && (CALSAMEDIMATIN == "non"))  { $FerieSaap="background='image/commun/ma.jpg'"; $FerieSaMatin=""; }
if ((CALSAMEDIAP == "non") && (CALSAMEDIMATIN == "oui"))  { $FerieSaMatin="background='image/commun/ap.jpg'"; $FerieSaap=""; }


if (SEMAINEDIMANCHE == "non") { $FerieDimanche="|| (j == 6) "; }else{  $FerieDimanche=""; }
if (SEMAINEVENDREDI == "non") { $FerieVendredi="|| (j == 4) "; }else{  $FerieVendredi=""; }


print "<script type=\"text/javascript\">";
print "\nvar dstJ=new Array(".$dstJ.");";
print "\nvar dstT=new Array(".$dstT.");";

// Ici on d�clare les dates des jours f�ri�s fixes
print "var ferie=new Array(".FERIE.");";


print <<<EOF
var mois=new Array(langfuncmois1,langfuncmois2,langfuncmois3,langfuncmois4,langfuncmois5,langfuncmois6,langfuncmois7,langfuncmois8,langfuncmois9,langfuncmois10,langfuncmois11,langfuncmois12);

function disp(txt) { document.write(txt) }
function estFerie(j,m) {
        var nb=ferie.length;
        var test=false;
        for(var i=0;i<nb;i++) {
                if ((ferie[i].substring(0,2)==j)&&(ferie[i].substring(3,5)==m)) return true;
        }
        return false;
}

function estConseil(j,m) {
        var nb=dstJ.length;
        var test=false;
        for(var i=0;i<nb;i++) {
           if ((dstJ[i].substring(0,2)==j)&&(dstJ[i].substring(3,5)==m)) return true;
        }
        return false;
}

var ii=1;

function calendar(colFond,colTitre,colTexte,colFerie,colOn) {
EOF;
	$newDATE=datecalendrier();
	print "var d_jour=$newDATE";
print <<<EOF
	var d_jour=new Date();

	var a=d_jour.getYear(); if (a<1970) {a=1900+a}
	var m=d_jour.getMonth()+1;

	var d=new Date(a,m-1,1);
	var dfin=new Date(a,m-1,1);
	var nb_jour=31;
	var aff_j="";
	for(var k=32;k>27;k--) {
		dfin.setMonth(m-1);
		dfin.setDate(k);
		if (dfin.getMonth()!=m-1) {nb_jour=k-1;}
	}

	var j1=d.getDay(); if (j1==0) j1=7;
	var jour=0;
	disp("<font face='Arial' size='-1'><center><strong>"+mois[m-1]+" "+a+"<\/strong><\/center><\/font>");
	disp("<table summary=\"calendar\" border=0 cellspacing=0 cellpadding='2'>");
	disp("<tr align='center' bgcolor='"+colTitre+"'><TD width='10'>$LLUNDI</TD><TD width='10'>$LMARDI</TD><TD width='10'>$LMERCREDI</TD><TD width='10'>$LJEUDI</TD><TD width='10'>$LVENDREDI</TD><TD width='10'>$LSAMEDI</TD><TD width='10'>$LDIMANCHE</TD></TR>");
	for(var i=0;i<6;i++) {
		disp("<tr>");
		for (j=0;j<7;j++) {
			jour=7*i+j-j1+2;
			aff_j=jour;
			if ((jour==d_jour.getDate())&&(m==d_jour.getMonth()+1)) {aff_j="<font size='-1' color='"+colOn+"' face='Arial'><em><u><strong>"+jour+"<\/strong><\/em><u><\/font>";}
			if ((7*i+j>=j1-1)&&(jour<=nb_jour)) {
				if ( (estFerie(jour,m)) || (estConseil(jour,m)) $FerieSamedi $FerieMercredi $FerieDimanche $FerieVendredi )  {
					if (estConseil(jour,m)) {
						disp("<td style=\"width:10; background-color:pink; text-align:center;\"><font face='Arial' size='-1' color='#0000CC'><a href=\"#\" onMouseOver=\\"AffBulle('<font face=Georgia, Times New Roman, Times, serif>"+dstT[ii]+" <\/font>');\\"  onMouseOut='HideBulle()'>"+aff_j+"<\/a><\/font><\/td>");
        		                        ii++;
					}else {
						disp("<td style=\"width:10; background-color:#CCCCFF; text-align:center;\"><font face='Arial' size='-1' color='"+colTexte+"'>"+aff_j+"<\/font><\/td>");
					}
				}else{
					if (j == 2) {
						disp("<td $Ferieap $FerieMatin style=\"width:10; background-color:#FFFFFF; text-align:center;\"><font face='Arial' size='-1' color='"+colTexte+"'>"+aff_j+"<\/font><\/td>");
					}else{
						if (j == 5) {
							disp("<td $FerieSaap $FerieSaMatin style=\"width:10; background-color:#FFFFFF; text-align:center;\"><font face='Arial' size='-1' color='"+colTexte+"'>"+aff_j+"<\/font><\/td>");
						}else{
							disp("<td  style=\"width:10; background-color:#FFFFFF; text-align:center;\"><font face='Arial' size='-1' color='"+colTexte+"'>"+aff_j+"<\/font><\/td>");
						}
					}						
				}
			}
			else disp("<td style=\"width:10; background-color:#FFFFFF;\"     ><font size=-1>&nbsp; <\/td>");
		}
		disp("<\/tr>");
	}
	disp("<\/table>");
}
</script>
EOF;
?>
