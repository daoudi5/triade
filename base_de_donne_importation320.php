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
include_once("./common/config.inc.php");
include_once("./librairie_php/lib_get_init.php");
$id=php_ini_get("safe_mode");
if ($id != 1) {
	set_time_limit(900);
}
?>
<HTML>
<HEAD>
<META http-equiv="CacheControl" content = "no-cache">
<META http-equiv="pragma" content = "no-cache">
<META http-equiv="expires" content = -1>
<meta name="Copyright" content="Triade�, 2001">
<LINK TITLE="style" TYPE="text/CSS" rel="stylesheet" HREF="./librairie_css/css.css">
<script language="JavaScript" src="./librairie_js/lib_defil.js"></script>
<script language="JavaScript" src="./librairie_js/clickdroit.js"></script>
<script language="JavaScript" src="./librairie_js/function.js"></script>
<script language="JavaScript" src="./librairie_js/lib_css.js"></script>
<title>Triade - Compte de <?php print $_SESSION["nom"]." ".$_SESSION["prenom"] ?></title></head>
<body id='bodyfond' marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" onload="Init();" >
<?php include("./librairie_php/lib_licence.php"); ?>
<?php include("./librairie_php/lib_attente.php"); ?>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]".".js'>" ?></SCRIPT>
<?php include("./librairie_php/lib_defilement.php"); ?>
</TD><td width="472" valign="middle" rowspan="3" align="center">
<div align='center'><?php top_h(); ?>
<SCRIPT language="JavaScript"<?php print "src='./librairie_js/$_SESSION[membre]"."1.js'>" ?></SCRIPT>
<table border="0" cellpadding="3" cellspacing="1" width="100%" bgcolor="#0B3A0C" height="85">
<tr id='coulBar0' ><td height="2"><b><font id='menumodule1' ><?php print LANGbasededoni91 ?></font></b></td></tr>
<tr id='cadreCentral0'>
<td >
     <!-- // fin  -->
<?php
include_once("librairie_php/db_triade.php");
include_once("librairie_php/timezone.php");
validerequete("menuadmin");
validerequete2($_SESSION["adminplus"]);

// function appele par la suite
function eclair($x,$y){
	if (!is_array($x) || !is_array($y)){
		echo "<br><br><center>".LANGbasededoni92;
	}
	array_pad($x,count($y),"");
	array_pad($y,count($x),"");
	while(count($x) > 0){
		$in=gep_classe(array_shift($x),array_shift($y));
		if ($in == 0) {
			alertJs(LANGbasededoni93);
			print "<script>history.go(-2);</script>";
			break;
		}
	}
}

$cnx=cnx();
error($cnx);

// enregistrement dans la base de classe avec reference
// netoyage de la base gep_class;
vide_gep_classe();
eclair($_POST["saisie_classe"],$_POST["saisie_ref"]);
// fin d'enregistrement
$nbelevetotal=0;
$nbelevedejaffecte=0;

$optionligne=1;
if ($_POST['optionligne'] == 1) { $optionligne=0; }

if ($_POST["typefichier"] == "excel" ) {
	$fic_xls=$_POST["fichier"];
		include_once('./librairie_php/reader.php');
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($fic_xls);
/*
1 Sexe;
2 Pays Nat.;
3 El�ve No Etab;
4 Num. El�ve Etab;
5 Nom;
6 Pr�nom;
7 Pr�nom 2;
8 Pr�nom 3;
9 Date Naissance;
10 Doublement;
11 Id National;
12 Date Entr�e;
13 Date Sortie;
14 Adh�sion Transport;
15 Date Modification;
16 Autorisation Abs. Perm.;
17 Autorisation Abs. Temp.;
18 Pr�sence Doss. M�dic.;
19 Pr�sence Doss. Scol.;
20 Ville Naiss. Etrang�re;
21 Commune Naiss.;
22 Pays Naiss.;
23 Code R�gime;
24 Lib. R�gime;
25 Motif Sortie;
26 Code Circuit;
27 Lib. Circuit;
28 Code Bourse 1;
29 Lib. Bourse 1;
30 Code Bourse 2;
31 Lib. Bourse 2;
32 Code MEF;
33 Lib. MEF;
34 Code Structure;
35 Type Structure;
36 Lib. Structure;
37 Cl� Gestion Mat. Enseign�e 1;
38 Lib. Mat. Enseign�e 1;
39 Code Modalit� Elect. 1;
40 Lib. Modalit� Elect. 1;
41 Cl� Gestion Mat. Enseign�e 2;
42 Lib. Mat. Enseign�e 2;
43 Code Modalit� Elect. 2;
44 Lib. Modalit� Elect. 2;
45 Cl� Gestion Mat. Enseign�e 3;
46 Lib. Mat. Enseign�e 3;
47 Code Modalit� Elect. 3;
48 Lib. Modalit� Elect. 3;
49 Cl� Gestion Mat. Enseign�e 4;
50 Lib. Mat. Enseign�e 4;
51 Code Modalit� Elect. 4;
52 Lib. Modalit� Elect. 4;
53 Cl� Gestion Mat. Enseign�e 5;
54 Lib. Mat. Enseign�e 5;
55 Code Modalit� Elect. 5;
56 Lib. Modalit� Elect. 5;
57 Cl� Gestion Mat. Enseign�e 6;
58 Lib. Mat. Enseign�e 6;
59 Code Modalit� Elect. 6;
60 Lib. Modalit� Elect. 6;
61 Cl� Gestion Mat. Enseign�e 7;
62 Lib. Mat. Enseign�e 7;
63 Code Modalit� Elect. 7;
64 Lib. Modalit� Elect. 7;
65 Cl� Gestion Mat. Enseign�e 8;
66 Lib. Mat. Enseign�e 8;
67 Code Modalit� Elect. 8;
68 Lib. Modalit� Elect. 8;
69 Cl� Gestion Mat. Enseign�e 9;
70 Lib. Mat. Enseign�e 9;
71 Code Modalit� Elect. 9;
72 Lib. Modalit� Elect. 9;
73 Cl� Gestion Mat. Enseign�e 10;
74 Lib. Mat. Enseign�e 10;
75 Code Modalit� Elect. 10;
76 Lib. Modalit� Elect. 10;
77 Cl� Gestion Mat. Enseign�e 11;
78 Lib. Mat. Enseign�e 11;
79 Code Modalit� Elect. 11;
80 Lib. Modalit� Elect. 11;
81 Cl� Gestion Mat. Enseign�e 12;
82 Lib. Mat. Enseign�e 12;
83 Code Modalit� Elect. 12;
84 Lib. Modalit� Elect. 12;
85 T�l. Personnel;
86 T�l. Professionnel;
87 T�l. Portable;
88  Email;
89 Ligne Adresse 1;
90 Ligne Adresse 2;
91 Ligne Adresse 3;
92 Ligne Adresse 4;
93 Lib. Postal;
94 Code Postal;
95 D�partement;
96 Commune Etrang�re;
97 Pays;
98 Civilit� Resp. L�g. 1;
99 Nom Resp. L�g. 1;
100 Pr�nom Resp. L�g. 1;
101 T�l. Personnel Resp. L�g. 1;
102 Lien Parent� Resp. L�g. 1;
103 T�l. Portable Resp. L�g. 1;
104 T�l. Professionnel Resp. L�g. 1;
105 Email Resp. L�g. 1;
106 Communication Adresse Resp. L�g. 1;
107 Ligne Adresse 1 Resp. L�g. 1;
108 Ligne Adresse 2 Resp. L�g. 1;
109 Ligne Adresse 3 Resp. L�g. 1;
110 Ligne Adresse 4 Resp. L�g. 1;
111 Lib. Postal Resp. L�g. 1;
112 Code Postal Resp. L�g. 1;
113 Code D�partement Resp. L�g. 1;
114 Commune Etrang�re Resp. L�g. 1;
115 Pays Resp. L�g. 1;
116 Civilit� Resp. L�g. 2;
117 Nom Resp. L�g. 2;
118 Pr�nom Resp. L�g. 2;
119 T�l. Personnel Resp. L�g. 2;
120 Lien Parent� Resp. L�g. 2;
121 T�l. Portable Resp. L�g. 2;
122 T�l. Professionnel Resp. L�g. 2;
123 Email Resp. L�g. 2;
124 Communication Adresse Resp. L�g. 2;
125 Ligne Adresse 1 Resp. L�g. 2;
126 Ligne Adresse 2 Resp. L�g. 2;
127 Ligne Adresse 3 Resp. L�g. 2;
128 Ligne Adresse 4 Resp. L�g. 2;
129 Lib. Postal Resp. L�g. 2;
130 Code Postal Resp. L�g. 2;
131 Code D�partement Resp. L�g. 2;
132 Commune Etrang�re Resp. L�g. 2;
133 Pays Resp. L�g. 2
*/
		
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			if ($i == $optionligne ) { continue; }

			if (strtolower($data->sheets[0]['cells'][$i][35]) == "g") { continue ; }

			$classe=recherche_gep_classe(trim($data->sheets[0]['cells'][$i][34]));
			
			$passwd="";
			$passwd_eleve="";
			$date_naissance=$data->sheets[0]['cells'][$i][9];

			if ((trim($passwd) == "") || (! isset($passwd)))  {
					$passwd=passwd_random2(); // creation du mot de passe
					$passwd_enr=$passwd;
			}else {
					$passwd_enr=$passwd;
			}

			if ((trim($passwd_eleve) == "") || (! isset($passwd_eleve)) ||  (trim($passwd_eleve) == "null") )  {
					$passwd_eleve=passwd_random(); // creation du mot de passe
					$passwd_eleve_enr=$passwd_eleve;
			}else {
					$passwd_eleve_enr=$passwd_eleve;
			}


			if ($date_naissance == "") {
					$date_naissance=dateDMY();
			}

			if (strtoupper($data->sheets[0]['cells'][$i][24]) == "EXTERN") {
				$regime="Externe";
			}

			if (strtoupper($data->sheets[0]['cells'][$i][24]) == "INT") {
				$regime="Interne";
			}

			if (strtoupper($data->sheets[0]['cells'][$i][24]) == "DP DAN") {
				$regime="Demi Pension";
			}

			$sexe="";
			if (strtoupper(trim($data->sheets[0]['cells'][$i][1])) == 'M') { $sexe="m"; }
			if (strtoupper(trim($data->sheets[0]['cells'][$i][1])) == 'F') { $sexe="f"; }

			if (strlen(trim($classe))) {
					$nbelevetotal++;
					// cr�ation du tableau de hash contenant les param�tres de la fonction create_eleve
					$params[ne]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][5])));
					$params[pe]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][6]." ".$data->sheets[0]['cells'][$i][7])));
					$params[ce]=            $classe;
					$params[lv1]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][38])));
					$params[lv2]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][42])));
					$params[option]=        strtolower(trim(addslashes($data->sheets[0]['cells'][$i][45])));
					$params[regime]=        $regime;
					$params[naiss]=         $date_naissance;   // attend jj/mm/aaaa
					$params[lieunais]=      strtolower(trim(addslashes($data->sheets[0]['cells'][$i][22])));
					$params[nat]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][2])));
					$params[mdp]=           $passwd_enr;
					$params[mdpeleve]=	$passwd_eleve_enr;
					$params[nt]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][99])));
					$params[pt]=		strtolower(trim(addslashes($data->sheets[0]['cells'][$i][100])));
					$params[nadr1]=        	"";
					$params[adr1]=        	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][107])));
					$params[cpadr1]=      	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][112])));
					$params[commadr1]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][111])));
					$params[nadr2]=         "";
					$params[adr2]=          strtolower(trim(addslashes($data->sheets[0]['cells'][$i][125])));
					$params[cpadr2]=       	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][130])));
					$params[commadr2]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][129])));
					$params[tel]=          	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][101])));
					$params[profp]=        	"";
					$params[telprofp]=     	"";
					$params[profm]=         "";
					$params[telprofm]=     	"";
					$params[nomet]=        	"";
					$params[numet]=        	"";
					$params[cpet]=         	"";
					$params[commet]=    	"";
					$params[numero_eleve]=  strtolower(trim(addslashes($data->sheets[0]['cells'][$i][11])));
					$params[email]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][105])));
					$params[classe_ant]=  	"";
					$params[annee_ant]=  	"";
					$params[civ_1]=  	civ2($data->sheets[0]['cells'][$i][98]);
					$params[civ_2]=  	civ2($data->sheets[0]['cells'][$i][116]);
					$params[nom_resp2]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][117])));
					$params[prenom_resp2]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][118])));
					$params[tel_port_1]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][103])));
					$params[tel_port_2]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][121])));
					$params[sexe]=		$sexe;

					// nouvelle version de create_eleve()
					$ascii=1;
					$datedesorti=dateFormBase($data->sheets[0]['cells'][$i][13]);
					$datedesorti=preg_replace('/-/',"",$datedesorti);
					$datedujour=dateYMD();
					if (($datedesorti < $datedujour) && (trim($datedesorti) != "")) {
						delete_compte_eleve($params[ne],$params[pe],$params[naiss]);
					}else{
						if ($_POST['update'] == 1) {
							$cr=create_update_eleve_scolnet($params[ne],$params[pe],$params[naiss],$params,$ascii,$_POST['updatevide'],$_POST['updatepasswd']);
						}else{
							$cr=@create_eleve($params,$ascii);
						}
						if ($cr == 1) {
							$f_pass=fopen("./data/fic_pass.txt","a+");
					     	    	fwrite($f_pass,strtolower(trim($data->sheets[0]['cells'][$i][5])).";".strtolower(trim($data->sheets[0]['cells'][$i][6]." ".$data->sheets[0]['cells'][$i][7])).";".$passwd_enr.";".$passwd_eleve_enr."<br />");
				     			fclose($f_pass);
							$nbeleveaffecte++;
						}
						if ($cr == -3) {
							$nbelevedejaffecte++;
						}
					}
		}else{
					$nbelevetotal++;
					// cr�ation du tableau de hash contenant les param�tres de la fonction create_eleve
					$params[ne]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][5])));
					$params[pe]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][6]." ".$data->sheets[0]['cells'][$i][7])));
					$params[ce]=            $classe;
					$params[lv1]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][38])));
					$params[lv2]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][42])));
					$params[option]=        strtolower(trim(addslashes($data->sheets[0]['cells'][$i][45])));
					$params[regime]=        $regime;
					$params[naiss]=         $date_naissance;   // attend jj/mm/aaaa
					$params[lieunais]=      strtolower(trim(addslashes($data->sheets[0]['cells'][$i][22])));
					$params[nat]=           strtolower(trim(addslashes($data->sheets[0]['cells'][$i][2])));
					$params[mdp]=           $passwd_enr;
					$params[mdpeleve]=	$passwd_eleve_enr;
					$params[nt]=            strtolower(trim(addslashes($data->sheets[0]['cells'][$i][99])));
					$params[pt]=		strtolower(trim(addslashes($data->sheets[0]['cells'][$i][100])));
					$params[nadr1]=        	"";
					$params[adr1]=        	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][107])));
					$params[cpadr1]=      	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][112])));
					$params[commadr1]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][111])));
					$params[nadr2]=         "";
					$params[adr2]=          strtolower(trim(addslashes($data->sheets[0]['cells'][$i][125])));
					$params[cpadr2]=       	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][130])));
					$params[commadr2]=     	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][129])));
					$params[tel]=          	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][101])));
					$params[profp]=        	"";
					$params[telprofp]=     	"";
					$params[profm]=         "";
					$params[telprofm]=     	"";
					$params[nomet]=        	"";
					$params[numet]=        	"";
					$params[cpet]=         	"";
					$params[commet]=    	"";
					$params[numero_eleve]=  strtolower(trim(addslashes($data->sheets[0]['cells'][$i][4])));
					$params[email]=  	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][105])));
					$params[classe_ant]=  	"";
					$params[annee_ant]=  	"";
					$params[civ_1]=  	civ2($data->sheets[0]['cells'][$i][98]);
					$params[civ_2]=  	civ2($data->sheets[0]['cells'][$i][116]);
					$params[nom_resp2]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][117])));
					$params[prenom_resp2]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][118])));
					$params[tel_port_1]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][103])));
					$params[tel_port_2]=	strtolower(trim(addslashes($data->sheets[0]['cells'][$i][121])));
					$params[sexe]=		$sexe;

					// nouvelle create eleve sans classe
					$ascii=1;
					$datedesorti=dateFormBase($data->sheets[0]['cells'][$i][13]);
					$datedesorti=preg_replace('/-/',"",$datedesorti);
					$datedujour=dateYMD();
					if (($datedesorti < $datedujour) && (trim($datedesorti) != "")) {
						delete_compte_eleve($params[ne],$params[pe],$params[naiss]);
					}else{
						$cr=@create_eleve_sans_classe($params,$ascii);
						if ($cr == 1) {
							$f_pass=fopen("./data/fic_pass.txt","a+");
							fwrite($f_pass,strtolower(trim($data->sheets[0]['cells'][$i][5])).";".strtolower(trim($data->sheets[0]['cells'][$i][6]." ".$data->sheets[0]['cells'][$i][7])).";".$passwd_enr.";".$passwd_eleve_enr."<br />");
							fclose($f_pass);
							$nbeleverreur++;
						}
						if ($cr == -3) {
							$nbelevedejaffecte++;
						}
					}
				
			}
		    
} 
			fclose($fp);
			// creation ou mise a jour du fichier log  avec prise en
			$today=dateDMY();
			$fichier_s=fopen("./".REPADMIN."/data/fic_opinion.txt","a+");
			$donnee=fwrite($fichier_s,"<BR>Message du : <FONT color=red>$today</font> De :<FONT color=red> $_SESSION[nom] $_SESSION[prenom]</FONT> <BR>Membre : <font color=red> $_SESSION[membre] </FONT><BR> <B>Message :</B> <font color=red> NOUVELLE BASE </font> - avec fichier EXCEL <BR>  Etablissement : <font color=red>".REPECOLE."</font> ");
			fclose($fichier_s);

			// suppression du fichier EXCEL
			@unlink($fic_xls);


}




Pgclose();
?>

<br />
<ul>
<font class='T2'>
- <?php print LANGBASE6bis?> : <?php print $nbelevetotal?><br>
- <?php print LANGBASE7?> : <?php print $nbeleveaffecte?><br>
- <?php print LANGBASE7bis ?> : <?php print $nbelevedejaffecte?><br>
- <?php print LANGBASE8?> : <?php print $nbeleverreur?><br><br>
- <?php print LANGBASE9?> <br /> (<?php print LANGBASE8bis ?>)<br /><br />
</font>
<?php
if (file_exists("./data/fic_pass.txt")) {
?>
<input type=button class=BUTTON value="<?php print LANGBT40?>" onclick="open('recupepw.php','_blank','')">
<?php } ?>
<br><br>
<font color=red size=2><?php print LANGBASE17?></font>
<br /><br />
<script language=JavaScript>buttonMagic("<?php print LANGBT41?>","acces2.php","_parent","","");</script>
<br><br />
</ul>
<!-- // fin  -->
</td></tr></table>
<SCRIPT language="JavaScript" <?php print "src='./librairie_js/$_SESSION[membre]"."2.js'>" ?></SCRIPT>
</BODY></HTML>
