<?php
session_start();
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


setlocale(LC_TIME, "fr_FR"); // ou "fr"
include_once("./common/config2.inc.php");

$partner = "";
$ville = METEOID; 
$vname =METEOVILLE ; 
//$vname="Paris";
$jours = 2;
$url = "http://wxdata.weather.com/wxdata/weather/local/".$ville."?cc=*&unit=s&dayf=".$jours;

// Conversion Fahrenheit->Celsius
function f2c($t) { return round(($t-32)*5/9); }

// Lecture d'un fichier XML
function lit_xml($chaine,$isFile,$item,$champs) {
   // on lit le fichier ou la chaîne
   if($isFile) $chaine = @file_get_contents($chaine);
   if($chaine) {
      // on explode sur <item>
      $tmp = preg_split("/<\/?".$item.">/",$chaine);
      // pour chaque <item>
      for($i=1;$i<sizeof($tmp);$i++)
         // on lit les champs demandés <champ>
         foreach($champs as $champ) {
            $tmp2 = preg_split("/<\/?".$champ.">/",$tmp[$i]);
            // on ajoute au tableau
            $tmp3[$champ][] = trim(@$tmp2[1]);
         }
      // et on retourne le tableau
      return @$tmp3;
   }
}

// Extraction primaire
$xml = lit_xml($url,true,"day d=.*",array("hi","low","part p=\"d\"","part p=\"n\""));

// Extraction des icones, messages et du taux d'humidité
for($i=0;$i<$jours;$i++) {
   $tmp = preg_split("/<\/?icon>/",$xml["part p=\"d\""][$i]);
   $xml["icond"][$i] = $tmp[1];
   $tmp = preg_split("/<\/?t>/",$xml["part p=\"d\""][$i]);
   $xml["altd"][$i] = $tmp[1];
   $tmp = preg_split("/<\/?hmid>/",$xml["part p=\"d\""][$i]);
   $xml["hmid"][$i] = $tmp[1];
   $tmp = preg_split("/<\/?icon>/",$xml["part p=\"n\""][$i]);
   $xml["iconn"][$i] = $tmp[1];
   $tmp = preg_split("/<\/?t>/",$xml["part p=\"n\""][$i]);
   $xml["altn"][$i] = $tmp[1];
}

?>

<table class=meteofond>
<tr><td class=meteotitre colspan=2>&nbsp;&nbsp;&nbsp;Prévision  sur <?php print $vname?></td></tr> 
<tr>
   <?php for($i=0;$i<$jours;$i++) { ?>
      <td class=meteocorps>
	<table>
      <tr>
         <td colspan=3 class=meteosstitre><strong>
            <?php 
	print	ucfirst(strftime("%d/%m/%Y",time()+$i*24*3600))
		
		?>
         </strong></td>
      </tr>
      <tr>
         <td>Max:<br> <?php print ($xml["hi"][$i]=="N/A")?"N/A":f2c($xml["hi"][$i])."°C"?></td>
         <td class=meteosstitre><?php print LANGMETEO1 ?></td>
         <td class=meteosstitre><?php print LANGMETEO2 ?></td>
      </tr>
      <tr>
         <td>Min:<br> <?php print ($xml["low"][$i]=="N/A")?"N/A":f2c($xml["low"][$i])."°C"?></td>
         <td rowspan=2><img src="./meteo/img/<?php print $xml["icond"][$i]?>.png"
            width=40 alt="<?php print $xml["altd"][$i]?>"></td>
         <td rowspan=2><img src="./meteo/img/<?php print $xml["iconn"][$i]?>.png"
            width=40 alt="<?php print $xml["altn"][$i]?>"></td>
      </tr>
      <!-- <tr>
         <td>H%: <?php print $xml["hmid"][$i]?></td>
      </tr>
	-->
      </table></td>
   <?php } ?>
</tr>
  
</table>
