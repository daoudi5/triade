<?php
// +-------------------------------------------------+
// � 2002-2004 PMB Services / www.sigb.net pmb@sigb.net et contributeurs (voir www.sigb.net)
// +-------------------------------------------------+
// $Id: index.php,v 1.86 2008-08-06 14:41:58 gueluneau Exp $
/* 

Ce logiciel est un programme informatique servant � g�rer une biblioth�que
ou un centre de documentation et notamment le catalogue des ouvrages et le
fichier des lecteurs. PMB est conforme � la d�claration simplifi�e de la CNIL
en ce qui concerne le respect de la Loi Informatique et Libert�s applicable
en France.

Ce logiciel est r�gi par la licence CeCILL soumise au droit fran�ais et
respectant les principes de diffusion des logiciels libres. Vous pouvez
utiliser, modifier et/ou redistribuer ce programme sous les conditions
de la licence CeCILL telle que diffus�e par le CEA, le CNRS et l'INRIA 
sur le site "http://www.cecill.info".

En contrepartie de l'accessibilit� au code source et des droits de copie,
de modification et de redistribution accord�s par cette licence, il n'est
offert aux utilisateurs qu'une garantie limit�e.  Pour les m�mes raisons,
seule une responsabilit� restreinte p�se sur l'auteur du programme,  le
titulaire des droits patrimoniaux et les conc�dants successifs.

A cet �gard  l'attention de l'utilisateur est attir�e sur les risques
associ�s au chargement,  � l'utilisation,  � la modification et/ou au
d�veloppement et � la reproduction du logiciel par l'utilisateur �tant 
donn� sa sp�cificit� de logiciel libre, qui peut le rendre complexe � 
manipuler et qui le r�serve donc � des d�veloppeurs et des professionnels
avertis poss�dant  des  connaissances  informatiques approfondies.  Les
utilisateurs sont donc invit�s � charger  et  tester  l'ad�quation  du
logiciel � leurs besoins dans des conditions permettant d'assurer la
s�curit� de leurs syst�mes et ou de leurs donn�es et, plus g�n�ralement, 
� l'utiliser et l'exploiter dans les m�mes conditions de s�curit�. 

Le fait que vous puissiez acc�der � cet en-t�te signifie que vous avez 
pris connaissance de la licence CeCILL, et que vous en avez accept� les
termes.

 */
session_start();
if ($_SESSION["id_pers"] != "") {
	$idpers=$_SESSION["id_pers"];
	$nom=$_SESSION["nom"];
	$prenom=$_SESSION["prenom"];
	$membre=$_SESSION["membre"];

	if ($membre == "menueleve") $catego=1;
	if ($membre == "menuprof") $catego=2;

	$datecreation=date("Y-m-d");
	$datemodif=date("Y-m-d");

	global $password;
	$password=md5("999ABCD");
	global $login;
	$login="$membre$idpers";


	include_once("../../common/config.inc.php");
	include_once("../../librairie_php/db_triade.php");


$cnx=cnx();
if ("$membre$idpers" != "") {
	$sql="SELECT * FROM empr WHERE empr_login='$membre$idpers'";
	$res=execSql($sql);
	$data=ChargeMat($res);
//	print count($data);
	if (count($data) > 0) {
		$sql="UPDATE  empr SET empr_modif='$datemodif' WHERE empr_login='$membre$idpers'";
		execSql($sql);
	}else{
		$codebar=recupIdCodeBar($idpers,$membre);
		$sql="INSERT INTO  empr ( empr_cb,
				empr_nom,
      				empr_prenom,
				empr_adr1,
				empr_adr2,
				empr_cp,
				empr_ville,
				empr_pays,
				empr_mail,
				empr_tel1,
				empr_tel2,
				empr_prof,
				empr_year,
				empr_categ,
				empr_codestat,
				empr_creation,
				empr_modif,
				empr_sexe,
				empr_login,
				empr_password,
				empr_date_adhesion,
				empr_date_expiration,
				empr_msg,
				empr_lang,
				empr_ldap,
				type_abt,
				last_loan_date,
				empr_location,
				date_fin_blocage,
				total_loans,
				empr_statut,
				cle_validation,
				empr_sms ) VALUES (
				'$codebar',
				'$nom',
      				'$prenom',
				empr_adr1,
				empr_adr2,
				empr_cp,
				empr_ville,
				empr_pays,
				empr_mail,
				empr_tel1,
				empr_tel2,
				'$enseignante',
				'$anneenaissance',
				'$catego',
				'1',
				'$datecreation',
				'$datemodif',
				'$sexe',
				'$membre$idpers',
			        '$password',
				'$datecreation',
				'2035-01-01',
				'',
				'fr_FR',
				'0',
				'0',
				'',
				'1',
				'',
				'0',
				'1',
				'',
				'0')";
			execSql($sql);
		}
	}
}

$base_path=".";
$is_opac_included=false;

//Inclusion de l'OPAC
require_once($base_path."/includes/index_includes.inc.php");
?>
