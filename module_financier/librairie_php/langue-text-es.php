<?php
/***************************** MODULE FINANCIER ****************************

/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET 
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

//------------------------------
// GENERAL
//-------------------------------
define("LANG_FIN_GENE_001","Les donn�es on �t� enregistr�es");
define("LANG_FIN_GENE_002","Information");
define("LANG_FIN_GENE_003","Annuler/Retour");
define("LANG_FIN_GENE_004","Enregistrer");
define("LANG_FIN_GENE_005","Modifier");
define("LANG_FIN_GENE_006","Element introuvable");
define("LANG_FIN_GENE_007","Suppression effectu�e");
define("LANG_FIN_GENE_008","Etes vous s�r de vouloir effectuer la suppression ?");
define("LANG_FIN_GENE_009","Acc�der");
define("LANG_FIN_GENE_010","Libell�");
define("LANG_FIN_GENE_011","Ann�e scolaire");
define("LANG_FIN_GENE_012","Optionnel");
define("LANG_FIN_GENE_013","Montant");
define("LANG_FIN_GENE_014","Ajouter");
define("LANG_FIN_GENE_015","Supprimer");
define("LANG_FIN_GENE_016","Intitul�");
define("LANG_FIN_GENE_017","Oui");
define("LANG_FIN_GENE_018","Non");
define("LANG_FIN_GENE_019","�");
define("LANG_FIN_GENE_020","Rechercher");
define("LANG_FIN_GENE_021","Rechercher par");
define("LANG_FIN_GENE_022","R�sultat");
define("LANG_FIN_GENE_023","Recherche de");
define("LANG_FIN_GENE_024","total");
define("LANG_FIN_GENE_025","tous");
define("LANG_FIN_GENE_026","S�lectionner un crit�re");
define("LANG_FIN_GENE_027","Chargement en cours. Veuillez patienter ...");
define("LANG_FIN_GENE_028","Inclus");
define("LANG_FIN_GENE_029","Calculer");
define("LANG_FIN_GENE_030","Date");
define("LANG_FIN_GENE_031","Pay�");
define("LANG_FIN_GENE_032","Paiement");
define("LANG_FIN_GENE_033","Voir");
define("LANG_FIN_GENE_034","Reste � payer");
define("LANG_FIN_GENE_035","total pr�visionel");
define("LANG_FIN_GENE_036","total � payer");
define("LANG_FIN_GENE_037","total �ch�ances");
define("LANG_FIN_GENE_038","R�alis�");
define("LANG_FIN_GENE_039","Commentaire");
define("LANG_FIN_GENE_040","Annuler l'ajout");
define("LANG_FIN_GENE_041","Fermer la fen�tre");
define("LANG_FIN_GENE_042","Actualiser");
define("LANG_FIN_GENE_043","Totaux");
define("LANG_FIN_GENE_044","Voir plus d'infos");
define("LANG_FIN_GENE_045","Cacher les infos");
define("LANG_FIN_GENE_046","L�gende");
define("LANG_FIN_GENE_047","Copier");
define("LANG_FIN_GENE_048","Element non modifiable");
define("LANG_FIN_GENE_049","Aucun");
define("LANG_FIN_GENE_050","S�lectionner");
define("LANG_FIN_GENE_051","Commentaires");
define("LANG_FIN_GENE_052","Optionnels");
define("LANG_FIN_GENE_053","Non-optionnels");
define("LANG_FIN_GENE_054","Copie");
define("LANG_FIN_GENE_055","Editer");
define("LANG_FIN_GENE_056","Type");
define("LANG_FIN_GENE_057","Copie");
define("LANG_FIN_GENE_058","Inscrits");
define("LANG_FIN_GENE_059","Pas inscrits");
define("LANG_FIN_GENE_060","Imprimer");
define("LANG_FIN_GENE_061","Exporter vers Excel");
define("LANG_FIN_GENE_062","toutes");

//------------------------------
// VALIDATION FORMULAIRE
//-------------------------------
define("LANG_FIN_VALI_001","Veuillez corriger les erreurs suivantes");
define("LANG_FIN_VALI_002","Le champ '%s' ne doit contenir que des chiffres");
define("LANG_FIN_VALI_003","Le champ '%s' doit �tre alphanum�rique");
define("LANG_FIN_VALI_004","Le champ '%s' ne peut pas �tre vide");
define("LANG_FIN_VALI_005","Le champ '%s' doit �tre un nombre d�cimal.\\n            Ex : 54,00  (caract�res autoris�s : 0123456789,)");
define("LANG_FIN_VALI_006","Le champ '%s' doit �tre une date valide (jj/mm/aaa)");
define("LANG_FIN_VALI_007","Le champ '%s' doit �tre sup�rieur � 0");

//------------------------------
// VALIDATION AJAX
//-------------------------------
define("LANG_CHA_AJAX_001","Votre session a expir�. Veuillez vous authentifier � nouveau.");
define("LANG_CHA_AJAX_002","Le script appel� a g�n�r� une erreur inconnue. Veuillez essayer ult�rieurement.");
define("LANG_CHA_AJAX_003","Erreur lors de la communication avec le serveur. Veuillez essayer ult�rieurement.");

//------------------------------
// CLASSE
//-------------------------------
define("LANG_FIN_CLAS_001","Classes"); // Pluriel
define("LANG_FIN_CLAS_002","Pas de classe disponible");
define("LANG_FIN_CLAS_003","Classe"); // Singulier
define("LANG_FIN_CLAS_004","Pas de classe selectionn�e");

//------------------------------
// ELEVE
//-------------------------------
define("LANG_FIN_ELEV_001","El�ves"); // Pluriel
define("LANG_FIN_ELEV_002","El�ve"); // Singulier
define("LANG_FIN_ELEV_003","Aucun �l�ve trouv�");
define("LANG_FIN_ELEV_004","Pr�nom");
define("LANG_FIN_ELEV_005","Nom");
define("LANG_FIN_ELEV_006","Inscrits/Pas inscrits");


//------------------------------
// RIB
//-------------------------------
define("LANG_FIN_RIB_001","Editer les RIB");
define("LANG_FIN_RIB_002","Impossible de g�n�rer l'enregistrement pour le RIB");
define("LANG_FIN_RIB_003","Code banque");
define("LANG_FIN_RIB_004","Code guichet");
define("LANG_FIN_RIB_005","N� de compte");
define("LANG_FIN_RIB_006","Cl� RIB");
define("LANG_FIN_RIB_007","IBAN");
define("LANG_FIN_RIB_008","BIC");
define("LANG_FIN_RIB_009","SWIFT");
define("LANG_FIN_RIB_010","RIB");
define("LANG_FIN_RIB_011","Vous devez saisir le 'Code banque', et le 'Code guichet' et le 'N� de compte' et la 'Cl� RIB'");
define("LANG_FIN_RIB_012","Titulaire");
define("LANG_FIN_RIB_013","Banque");
define("LANG_FIN_RIB_014","N� de RIB");
define("LANG_FIN_RIB_015","Description");
define("LANG_FIN_RIB_016","Pas de RIB");
define("LANG_FIN_RIB_017","RIB �ch�anche");
define("LANG_FIN_RIB_018","La cl� RIB n'est pas valide (elle ne correpond pas au calcul bas� sur le 'Code banque',\\n        le 'Code guichet' et le 'N� de compte'.");

//------------------------------
// PARAMETRAGE
//-------------------------------
define("LANG_FIN_PARA_001","Param�trage du Module Financier");

//------------------------------
// TYPE DE FRAIS
//-------------------------------
define("LANG_FIN_TFRA_001","Gestion des types de frais");
define("LANG_FIN_TFRA_002","Ajouter, modifier ou supprimer un type de frais");
define("LANG_FIN_TFRA_003","Cr�ation d'un type de frais");
define("LANG_FIN_TFRA_004","Liste / modifier type de frais");
define("LANG_FIN_TFRA_005","Supprimer un type de frais");
define("LANG_FIN_TFRA_006","Modifier un type de frais");
define("LANG_FIN_TFRA_007","Intitul� du type de frais");
define("LANG_FIN_TFRA_008","Suppression d'un type de frais");
define("LANG_FIN_TFRA_009","Cr�er le type de frais");
define("LANG_FIN_TFRA_010","Modification d'un type de frais");
define("LANG_FIN_TFRA_011","Pas de type de frais disponible");
define("LANG_FIN_TFRA_012","Les types de frais gris�s ne peuvent pas �tre supprim�s car ils sont utilis�s dans un ou plusieurs bar�mes ou inscriptions");
define("LANG_FIN_TFRA_013","Ce type de frais ne peut pas �tre supprim� car il est utilis� dans un ou plusieurs bar�mes");
define("LANG_FIN_TFRA_014","Liss�");
define("LANG_FIN_TFRA_015","Si le type de frais est liss�, ses paiements seront �tal�s sur plusieurs �ch�ances. Sinon, il n\'y a qu\'une seule �ch�ance au d�part");
define("LANG_FIN_TFRA_016","Caution");
define("LANG_FIN_TFRA_017","Indique si le type de frais est consid�r� comme une caution. Devra �tre valid� dans l\'inscription une fois pay�");
define("LANG_FIN_TFRA_018","Non liss�");
define("LANG_FIN_TFRA_019","Caution rembours�e");

//------------------------------
// TYPE DE REGLEMENT
//-------------------------------
define("LANG_FIN_TREG_001","Gestion des types de r�glements");
define("LANG_FIN_TREG_002","Ajouter, modifier ou supprimer un type de r�glement");
define("LANG_FIN_TREG_003","Cr�ation d'un type de r�glement");
define("LANG_FIN_TREG_004","Liste / modifier type de r�glement");
define("LANG_FIN_TREG_005","Supprimer un type de r�glement");
define("LANG_FIN_TREG_006","Modifier un type de r�glement");
define("LANG_FIN_TREG_007","Intitul� du type de r�glement");
define("LANG_FIN_TREG_008","Suppression d'un type de r�glement");
define("LANG_FIN_TREG_009","Cr�er le type de r�glement");
define("LANG_FIN_TREG_010","Modification d'un type de r�glement");
define("LANG_FIN_TREG_011","Pas de type de r�glement disponible");
define("LANG_FIN_TREG_012","Les types de r�glement gris�s ne peuvent pas �tre supprim�s  soit car ils sont utilis�s dans un ou plusieurs r�glements ou �ch�ancier, soit car ils sont indispensables au bon fonctionement de l\'application");
define("LANG_FIN_TREG_013","Ce type de r�glement ne peut pas �tre supprim� car il est utilis� dans un ou plusieurs r�glements");
define("LANG_FIN_TREG_014","Types de r�glement"); // Pluriel
define("LANG_FIN_TREG_015","Type de r�glement"); // Singulier
define("LANG_FIN_TREG_016","R�glements"); // Pluriel
define("LANG_FIN_TREG_017","R�glement"); // Singulier

//------------------------------
// BAREME
//-------------------------------
define("LANG_FIN_BARE_001","Gestion des bar�mes");
define("LANG_FIN_BARE_002","Ajouter, modifier ou supprimer un bar�me et ses frais pour une classe");
define("LANG_FIN_BARE_003","Bar�mes"); // Pluriel
define("LANG_FIN_BARE_004","Bar�me"); // Singulier
define("LANG_FIN_BARE_005","Pas de bar�me pour cette classe et cette ann�e scolaire");
define("LANG_FIN_BARE_006","Ajouter un bar�me");
define("LANG_FIN_BARE_007","Modifier un bar�me");
define("LANG_FIN_BARE_008","Supprimer un bar�me");
define("LANG_FIN_BARE_009","Etes-vous s�r de vouloir supprimer ce bar�me ?\\n(les frais associ�s seront aussi supprim�s)");
define("LANG_FIN_BARE_010","Copier un bar�me");
define("LANG_FIN_BARE_011","Si vous continuez, le bar�me '#s1#' de la classe '#s2#' sera copi� ici");
define("LANG_FIN_BARE_012","Bar�me initial");

//------------------------------
// FRAIS DE BAREME
//-------------------------------
define("LANG_FIN_FBAR_001","Gestion des frais pour un bar�me");
define("LANG_FIN_FBAR_002","Ajouter, modifier ou supprimer un frais pour un bar�me");
define("LANG_FIN_FBAR_003","Frais"); // Pluriel
define("LANG_FIN_FBAR_004","Frais"); // Singulier
define("LANG_FIN_FBAR_005","Pas de frais pour ce bar�me");
define("LANG_FIN_FBAR_006","Pas de classe, ni de bar�me selectionn�s");
define("LANG_FIN_FBAR_007","Ajouter un frais de bar�me");
define("LANG_FIN_FBAR_008","Modifier un frais de bar�me");
define("LANG_FIN_FBAR_009","Supprimer un frais de bar�me");
define("LANG_FIN_FBAR_010","Etes-vous s�r de vouloir supprimer ce frais ?");
define("LANG_FIN_FBAR_011","Supprimer le frais");
define("LANG_FIN_FBAR_012","Pas de frais disponible (ils ont tous �t� utilis�s)");

//------------------------------
// INSCRIPTIONS
//-------------------------------
define("LANG_FIN_INSC_001","Rechercher une inscription");
define("LANG_FIN_INSC_002","Inscrit");
define("LANG_FIN_INSC_003","Voir inscription");
define("LANG_FIN_INSC_004","Inscrire");
define("LANG_FIN_INSC_005","La classe \'%s\' n\'a pas de bar�me pour l\'ann�e scolaire \'%s\'.<br>Vous devez cr�er au moins un bar�me avant de pouvoir inscrire l\'�l�ve.<br>Pour cela cliquez sur le lien \'Param�trage\' du menu \'Module financier\'.");
define("LANG_FIN_INSC_006","Inscrire un �l�ve");
define("LANG_FIN_INSC_007","Vous devez saisir une date avant de pouvoir calculer les �ch�ances");
define("LANG_FIN_INSC_008","Choisissez une date de d�but et cliquez sur 'Calculer'");
define("LANG_FIN_INSC_009","Vous avez ajout� et/ou enlev� un des frais optionnels ou bien vous avez chang� le type d'�ch�ancier.\\nL'�ch�ancier doit �tre calcul� � nouveau avant d'enregistrer l'inscription.");
define("LANG_FIN_INSC_010","Vous devez saisir une date de d�but et calculer les �ch�ances avant de pouvoir enregistrer l'inscription.");
define("LANG_FIN_INSC_011","Si vous continuez, l'�ch�ancier actuel sera effac�.\\nVoulez-vous continuer ?");
define("LANG_FIN_INSC_012","Date de l'�ch�ance n�#i#");
define("LANG_FIN_INSC_013","Montant de l'�ch�ance n�#i#");
define("LANG_FIN_INSC_014","La date de l'�ch�ance n�#i# doit �tre sup�rieure ou �gale � la pr�c�dente");
define("LANG_FIN_INSC_015","ATTENTION : Le total des montants des �ch�anches (#s1# �) n'est pas �gal au montant total des frais (#s2# �).\\n\\nApr�s avoir enregistr�, veuillez v�rifier que ces deux totaux seront �gaux. Si n�c�ssaire, ajustez les montants des �ch�ances ou cr�ez une nouvelle �ch�ance.");
define("LANG_FIN_INSC_016","L'�l�ve a �t� inscrit");
define("LANG_FIN_INSC_017","L'�l�ve est d�j� inscrit");
define("LANG_FIN_INSC_018","Donn�es de l'inscription de l'�l�ve");
define("LANG_FIN_INSC_019","Inscriptions"); // Pluriel
define("LANG_FIN_INSC_020","Inscription"); // Singulier
define("LANG_FIN_INSC_021","Au moins une �ch�ance a �t� modifi�e.\\nSi vous continuez sans enregistrer, les modifications seront perdues.\\n\\nVoulez-vous enregistrer ?");
define("LANG_FIN_INSC_022","Recalculer le montant des �ch�ances");
define("LANG_FIN_INSC_023","Si vous continuez, les montants de %s �ch�ance(s) liss�e(s) sans paiement seront recalcul� en fonction des frais s�lectionn�s (optionnels et liss�s)\\nVous devrez ensuite vous assurer que le montant total des �ch�ances normales correspond au total des frais. Si ce n'est pas le cas, vous devrez ajuster les montants (et eventuellement ajouter des �ch�ances).\\n\\nVoulez-vous continuer ?");
define("LANG_FIN_INSC_024","Date de d�part");
define("LANG_FIN_INSC_025","Date de d�part de l\'�l�ve si il est partit avant la fin de l\'ann�e scolaire.<br>(�vite que les �ch�ances post�rieures soient consid�r�es comme impay�es)<br>Ce champ reste vide si l\'�l�ve est rest� jusqu\'� la fin de l\'ann�e.");
define("LANG_FIN_INSC_026","Voir les frais");
define("LANG_FIN_INSC_027","Cacher les frais");
define("LANG_FIN_INSC_028","Classe et ann�e scolaire");
define("LANG_FIN_INSC_029","L'�l�ve est d�j� inscrit dans cette classe pour toutes les ann�es disponibles");
define("LANG_FIN_INSC_030","Supprimer cette inscription (pas de r�glements)");
define("LANG_FIN_INSC_031","�tes-vous s�r de vouloir supprimer l'inscription de cet �l�ve ?");
define("LANG_FIN_INSC_032","L'inscription a �t� supprim�e.");
define("LANG_FIN_INSC_033","ATTENTION : Le total des montants des �ch�anches (#s1# �) n'est pas �gal au montant total des frais (#s2# �).\\n\\nVous devez ajustez les montants des �ch�ances et/ou cr�ez une nouvelle �ch�ance.");

//------------------------------
// DUPLICATION ECHEANCIER
//-------------------------------
define("LANG_FIN_DUPL_01","Options de cr�ation d'une inscription");
define("LANG_FIN_DUPL_02","Nouvelle inscription (� partir de 0)");
define("LANG_FIN_DUPL_03","Copier l'inscription et l'�ch�ancier d'un autre �l�ve");

//------------------------------
// ECHEANCIER
//-------------------------------
define("LANG_FIN_ECHE_001","Ech�anciers"); // Pluriel
define("LANG_FIN_ECHE_002","Ech�ancier"); // Singulier
define("LANG_FIN_ECHE_003","Ech�ances"); // Pluriel
define("LANG_FIN_ECHE_004","Ech�ance"); // Singulier
define("LANG_FIN_ECHE_005","Ajouter une �ch�ance"); // Singulier
define("LANG_FIN_ECHE_006","Date de la nouvelle �ch�ance");
define("LANG_FIN_ECHE_007","�Correspond � de la nouvelle �ch�ance");
define("LANG_FIN_ECHE_008","Montant de la nouvelle �ch�ance");
define("LANG_FIN_ECHE_009","Informations sur l\'�ch�ance additionelle");
define("LANG_FIN_ECHE_010","Correspond �");
define("LANG_FIN_ECHE_011","Le champ \'Correspond �\' de l\'�ch�ance n�#i# ne doit pas �tre vide. (si vous ne le voyez pas, cliquez sur le  [+])");
define("LANG_FIN_ECHE_012","Couleurs des lignes des �ch�ances");
define("LANG_FIN_ECHE_013","Ech�ance normale, liss�e et non expir�e");
define("LANG_FIN_ECHE_014","Ech�ance normale, liss�e, mais expir�e");
define("LANG_FIN_ECHE_015","Ech�ance additionnelle et non expir�e");
define("LANG_FIN_ECHE_016","Ech�ance additionnelle, mais expir�e");
define("LANG_FIN_ECHE_017","Ech�ance normale, non-liss�e et non expir�e");
define("LANG_FIN_ECHE_018","Ech�ance normale, non-liss�e, mais expir�e");
define("LANG_FIN_ECHE_019","Supprimer les �ch�ances");
define("LANG_FIN_ECHE_020","Diviser les �ch�ances");
define("LANG_FIN_ECHE_021","Fusioner les �ch�ances");
define("LANG_FIN_ECHE_022","Vous devez s�lectionner une �ch�ance (et une seule)");
define("LANG_FIN_ECHE_023","Etes-vous s�r de vouloir supprimer ces �ch�ances ?");
define("LANG_FIN_ECHE_024","Si vous continuez :\\n      1 - chaque �ch�ance sera dupliqu�e\\n      2 - � chaque fois, les deux �ch�ances auront la m�me date\\n      3 - � chaque fois, le montant sera r�partit entre les deux �ch�ances\\n\\nEtes-vous s�r de vouloir diviser ces �ch�ances ?");
define("LANG_FIN_ECHE_025","Vous devez s�lectionner deux �ch�ances");
define("LANG_FIN_ECHE_026","Si vous continuez :\\n      1 - les deux �ch�ances seront fusionn�es\\n      2 - les donn�es iront dans la premi�re �ch�ance\\n      3 -les montants seront cumul�s dans la premiere �ch�ance\\n\\nEtes-vous s�r de vouloir fusionner ces �ch�ances ?");
define("LANG_FIN_ECHE_027","Remise exceptionnelle et non expir�e");
define("LANG_FIN_ECHE_028","Remise exceptionnelle, mais expir�e");
define("LANG_FIN_ECHE_029","Ligne avec texte et champs gris�s => �ch�ance post�rieure � la date de d�part");

//------------------------------
// TYPE ECHEANCIER
//-------------------------------
define("LANG_FIN_TECHE_001","Types ech�ancier"); // Pluriel
define("LANG_FIN_TECHE_002","Type ech�ancier"); // Singulier
define("LANG_FIN_TECHE_005","Pas de type ech�ancier disponible");
define("LANG_FIN_TECHE_006","Date d�but");

//------------------------------
// REGLEMENT
//-------------------------------
define("LANG_FIN_REGL_001","R�glements"); // Pluriel
define("LANG_FIN_REGL_002","R�glement"); // Singulier
define("LANG_FIN_REGL_003","R�glements pour une �ch�ance");
define("LANG_FIN_REGL_004","En rouge car l\'�ch�ance est expir�e et son montant total n\'a pas �t� pay�");
define("LANG_FIN_REGL_005","En vert car le total des paiement est sup�rieur au montant de l\'�ch�ance (solde cr�diteur pour cette �ch�ance)");
define("LANG_FIN_REGL_006","Solde incluant les sommes pay�es pour les �ch�ances expir�es et les montants des �ch�ances � venir");
define("LANG_FIN_REGL_007","Total des montants des �ch�ances normales (celles g�n�r�es lors de l\'inscription) + le montants des �ch�ances exceptionelles<br>*** doit correspondre au total des frais ***");
define("LANG_FIN_REGL_008","Pas de r�glement trouv�");
define("LANG_FIN_REGL_009","Ajouter un r�glement");
define("LANG_FIN_REGL_010","Date du nouveau r�glement");
define("LANG_FIN_REGL_011","Libell� du nouveau r�glement");
define("LANG_FIN_REGL_012","Montant du nouveau r�glement");
define("LANG_FIN_REGL_013","En orange car  seulement une partie de l\'�ch�ance a �t� pay�e");
define("LANG_FIN_REGL_014","Date du r�glement n�#i#");
define("LANG_FIN_REGL_015","Libell� du r�glement n�#i#");
define("LANG_FIN_REGL_016","Montant du r�glement n�#i#");
define("LANG_FIN_REGL_017","Total �ch�ances normales");
define("LANG_FIN_REGL_018","Total �ch�ances additionnelles");
define("LANG_FIN_REGL_019","Total des montants des �ch�ances additionelles (celles ajout�es manuellement)");
define("LANG_FIN_REGL_020","N� de ch�que");
define("LANG_FIN_REGL_021","N� de bordereau");
define("LANG_FIN_REGL_022","Total remises exceptionelles");
define("LANG_FIN_REGL_023","Total normales + remises");

define("LANG_FIN_REGL_024","Total des montants des �ch�ances normales et aditionnelles<br>(�ch�ances ant�rieures � la date de d�part)");

//------------------------------
// PAIEMENTS
//-------------------------------
define("LANG_FIN_PAIE_001","Paiements"); // Pluriel
define("LANG_FIN_PAIE_002","Paiement"); // Singulier
define("LANG_FIN_PAIE_003","G�n�ration fichier pr�l�vements");
define("LANG_FIN_PAIE_004","G�n�ration du fichier envoy� � la banque pour les pr�l�vements automatiques");
define("LANG_FIN_PAIE_005","G�n�ration des bordereaux");
define("LANG_FIN_PAIE_006","G�n�ration des bordereaux pour d�poser les ch�ques et les esp�ces � la banque");
define("LANG_FIN_PAIE_007","Cautions");
define("LANG_FIN_PAIE_008","Voir la liste des cautions non-rembours�es");
define("LANG_FIN_PAIE_009","Rechercher un bordereau");
define("LANG_FIN_PAIE_010","Rechercher les bordereaux existants de remise de ch�ques et esp�ces");

//------------------------------
// IMPAYES
//-------------------------------
define("LANG_FIN_IMPA_001","Impay�s"); // Pluriel
define("LANG_FIN_IMPA_002","Impay�"); // Singulier
define("LANG_FIN_IMPA_003","Liste des impay�s � ce jour");
define("LANG_FIN_IMPA_004","Pas d'impay�s � ce jour pour ce type de r�glement");

//------------------------------
// GENERATION FICHIER PRELEVEMENT
//-------------------------------
define("LANG_FIN_GPRE_001","G�n�ration du fichier de pr�levement");
define("LANG_FIN_GPRE_002","Date limite �ch�ances");
define("LANG_FIN_GPRE_003","Pour rechercher les �ch�ances qui expirent avant cette date");
define("LANG_FIN_GPRE_004","Pas d'�ch�ance � payer par pr�l�vement pour cette date limite");
define("LANG_FIN_GPRE_005","G�n�rer le fichier de pr�levement");
define("LANG_FIN_GPRE_006","Vous devez s�lectionner un RIB pour l'�l�ve n�#i#.\\n          Si il n'en n'a pas, cliquez sur 'Editer le RIB' pour en ajouter un");
define("LANG_FIN_GPRE_007","Si vous continuez, le fichier sera g�n�r� et un r�glement sera cr�� pour chaque �ch�ance");
define("LANG_FIN_GPRE_008","Date du r�glement");
define("LANG_FIN_GPRE_009","Date avec laquelle le r�glement de chaque �ch�ance sera cr��");
define("LANG_FIN_GPRE_010","Paiement �ch�ance du");
define("LANG_FIN_GPRE_011","Ordre de tri");
define("LANG_FIN_GPRE_012","Nom de l'�l�ve");
define("LANG_FIN_GPRE_013","Date d'�ch�ance");

//------------------------------
// TYPE D'ECHEANCE
//-------------------------------
define("LANG_FIN_TECH2_001","Types ech�ance"); // Pluriel
define("LANG_FIN_TECH2_002","Type ech�ance"); // Singulier
define("LANG_FIN_TECH2_003","Normale - liss�e");
define("LANG_FIN_TECH2_004","Normale - non liss�e");
define("LANG_FIN_TECH2_005","Additionnelle");
define("LANG_FIN_TECH2_006","<b>Normale - liss�e</b> : les �ch�ances liss�es sont celles sur lesquelles le total des frais est r�partit (et leur montant est pris en compte dans \'Total �ch�ances normales\')<br><b>Normale - non liss�e</b> : Leur montant est fixe et il n\'y a pas de r�partition (et leur montant est pris en compte dans \'Total �ch�ances normales\')<br><b>Additionnelle</b> : sont ind�pendantes des frais<br><br>On a :<br>&nbsp;&nbsp;&nbsp;- Total �ch�ances normales = �ch�ances normales liss�es + non liss�es<br>&nbsp;&nbsp;&nbsp;- Total � payer = Total �ch�ances normales + Total �ch�ances additionnelle");
define("LANG_FIN_TECH2_007","Remise Exceptionelle");

//------------------------------
// CAUTIONS NON REMBOURSEES
//-------------------------------
define("LANG_FIN_CANR_001","Liste des cautions non rembours�es");
define("LANG_FIN_CANR_002","Pas de caution non rembours�e");

//------------------------------
// GENERATION DES BORDEREAUX
//-------------------------------
define("LANG_FIN_GBOR_001","Bordereaux"); // Pluriel
define("LANG_FIN_GBOR_002","Bordereau"); // Singulier
define("LANG_FIN_GBOR_003","N� du bordereau");
define("LANG_FIN_GBOR_004","G�n�rer le bordereau");
define("LANG_FIN_GBOR_005","Le r�glement n'est pas r�alis�");
define("LANG_FIN_GBOR_006","Le type de r�glement n'est pas celui recherch�");
define("LANG_FIN_GBOR_007","Le num�ro de bordereau n'est pas vide (le r�glement fait partie d'un autre bordereau)");
define("LANG_FIN_GBOR_008","N� du bordereau qui sera g�n�r� (le n� de bordereau des r�glements s�lectionn�s sera initialis�)");
define("LANG_FIN_GBOR_009","Vous devez s�lectionner au moins un r�glement qui fera partie du bordereau");
define("LANG_FIN_GBOR_010","Ce n� de bordereau est d�j� utilis�. Veuillez en saisir un autre");
define("LANG_FIN_GBOR_011","Si vous continuez, le bordereau sera g�n�r� et le n� de bordereau de chaque r�glement sera initialis�.\\nUne fois le fichier t�l�charg�, cliquez ensuite sur le bouton 'Rechercher' pour voir les modifications apport�es aux r�glements");
define("LANG_FIN_GBOR_012","Pas d'�ch�ances et de r�glements pour cette date limite et ce type de r�glement");
define("LANG_FIN_GBOR_013","Date de remise");
define("LANG_FIN_GBOR_014","Pour rechercher les �ch�ances non pay�es qui expirent avant cette date (inclue)");
define("LANG_FIN_GBOR_015","Bordereau de remise de ch�que");
define("LANG_FIN_GBOR_016","Bordereau de remise d'esp�ce");
define("LANG_FIN_GBOR_017","bordereau_remise_cheque");
define("LANG_FIN_GBOR_018","bordereau_remise_espece");

//------------------------------
// RECHERCHE DES BORDEREAUX
//-------------------------------
define("LANG_FIN_RBOR_001","Pas de r�glement trouv� pour ce num�ro de bordereau");

//------------------------------
// EDITIONS
//-------------------------------
define("LANG_FIN_EDIT_001","Editions du module financier");
define("LANG_FIN_EDIT_002","Editions des bar�mes");
define("LANG_FIN_EDIT_003","Editions des inscriptions");
define("LANG_FIN_EDIT_004","Tableau de bord");
define("LANG_FIN_EDIT_005","Editions des montants de scolarit� par �l�ve");
define("LANG_FIN_EDIT_006","Editions des montants encaiss�s et impay�s");

//------------------------------
// EDITIONS DES BAREMES
//-------------------------------
define("LANG_FIN_EBAR_001","Pas de bar�mes correspondant aux crit�res");

//------------------------------
// EDITIONS DES INSCRIPTIONS
//-------------------------------
define("LANG_FIN_EINS_001","Pas d'inscriptions correspondant aux crit�res");
define("LANG_FIN_EINS_002","S�lectionnez un crit�re puis cliquez sur 'Rechercher'");
define("LANG_FIN_EINS_003","inscription(s) trouv�e(s)");

//------------------------------
// EDITION - TABLEAU DE BORD
//-------------------------------
define("LANG_FIN_EBOR_001","inscriptions");
define("LANG_FIN_EBOR_002","encaiss�'");
define("LANG_FIN_EBOR_003","A encaisser");
define("LANG_FIN_EBOR_004","D�tail par type de frais");
define("LANG_FIN_EBOR_005","Nombre d'inscriptions");
define("LANG_FIN_EBOR_006","Montant encaiss�");
define("LANG_FIN_EBOR_007","Montant � encaisser");
define("LANG_FIN_EBOR_008","Nombre");

//------------------------------
// EDITION - SCOLARITE PAR ELEVE
//-------------------------------
define("LANG_FIN_ESCO_001","Classe/�l�ve");
define("LANG_FIN_ESCO_002","�l�ve/clase");
define("LANG_FIN_ESCO_003","Nombre d'�l�ves");
define("LANG_FIN_ESCO_004","Total pour cette classe");
define("LANG_FIN_ESCO_005","Nombre total d'�l�ves");
define("LANG_FIN_ESCO_006","Total scolarit� g�n�ral");
define("LANG_FIN_ESCO_007","Total reste � payer g�n�ral");
define("LANG_FIN_ESCO_008","Nombre de classes");

//------------------------------
// EDITION - ENCAISSES ET IMPAYES
//-------------------------------
define("LANG_FIN_EENC_001","Date d�but");
define("LANG_FIN_EENC_002","Date fin");
define("LANG_FIN_EENC_003","Date de d�but de la recherche");
define("LANG_FIN_EENC_004","Date de fin de la recherche");
define("LANG_FIN_EENC_005","Date �ch�ance");
define("LANG_FIN_EENC_006","Total �ch�ance");
define("LANG_FIN_EENC_007","Reste � payer");
define("LANG_FIN_EENC_008","Encaiss�");
define("LANG_FIN_EENC_009","Impay�");

?>