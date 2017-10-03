<?php 
function getMonth($valeur){
    return substr($valeur, 5, 2);
} 

function getYear($valeur){
    return substr($valeur, 0, 4);
} 

function monthNumToName($mois){
    $tableau = Array("", "Janvier", "F�vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao�t", "Septembre", "Octobre", "Novembre", "D�cembre");
    return (intval($mois) > 0 && intval($mois) < 13) ? $tableau[intval($mois)] : "Ind�fini";
} 
?>