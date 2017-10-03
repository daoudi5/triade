<?php
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

// fichier pour langue cote admin.
// POUR TOUS -------------------
// brmozilla($_SESSION[navigateur]);
//

function TextNoAccentLicence2($Text){
	 Return (strtr($Text, "�����������������������������������������������������","AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"));
}

if (!defined(INTITULEDIRECTION)) { define("INTITULEDIRECTION","direction"); }
if (!defined(INTITULEELEVE)) { define("INTITULEELEVE","�l�ve"); }
if (!defined(INTITULEELEVES)) { define("INTITULEELEVES","�l�ves"); }



define("CLICKICI","Cliquez ici");
define("VALIDER","Valider");
define("LANGTP22","INFORMATION - Demande de D.S.T. � confimer !");
define("LANGTP3"," calendrier DST ");
define("LANGCHOIX","-- S�lectionnez --");
define("LANGCHOIX2","aucune classe");
define("LANGCHOIX3","-- S�lectionnez --");
define("LANGOUI","oui");
define("LANGNON","non");
define("LANGFERMERFEN","Fermer la fen�tre");
define("LANGATT","ATTENTION !");
define("LANGDONENR","Donn�e(s) enregistr�e(s)");
define("LANGPATIENT","Merci de bien vouloir patienter");
define("LANGSTAGE1",'Gestion des stages professionnels');
define("LANGINCONNU",'inconnu'); // doit �tre identique que langinconnu cote javascript
define("LANGABS",'abs');
define("LANGRTD",'rtd');
define("LANGRIEN",'rien');
define("LANGENR",'Enregistrer');
define("LANGRAS1",'Aujourd\'hui, le ');
define("LANGDATEFORMAT",'jj/mm/aaaa');

//------------------------------
// titre
//-------------------------------

define("LANGTITRE3","Message d�filant dans le haut de la page");
define("LANGTITRE4","Message d�filant dans le bandeau ");
define("LANGTITRE5","R�ception message");
define("LANGTITRE6","Cr�ation d'un compte ".INTITULEDIRECTION);
define("LANGTITRE7","Cr�ation d'un compte vie scolaire");
define("LANGTITRE8","Cr�ation d'un compte enseignant");
define("LANGTITRE9","Cr�ation d'un compte suppl�ant");
define("LANGTITRE10","Cr�ation d'un compte ".INTITULEELEVE);
define("LANGTITRE11","Cr�ation d'un groupe"); //
define("LANGTITRE12","Cr�ation d'une classe"); //
define("LANGTITRE13","Cr�ation d'une mati�re"); //
define("LANGTITRE14","Cr�ation d'une sous-mati�re"); //
define("LANGTITRE16","Cr�ation d'affectation");
define("LANGTITRE17","Cr�ation d'affectation pour la classe");
define("LANGTITRE18","Visualisation d'affectation");
define("LANGTITRE19","Modification d'affectation");
define("LANGTITRE20","Modification de l'affectation pour la classe");
define("LANGTITRE21","Suppression d'affectation");
define("LANGTITRE22","Importation d'un fichier ASCII (txt,csv) ");
define("LANGTITRE23","Liste des retards non justifi�s ");
define("LANGTITRE24","Ajouter une dispense");
define("LANGTITRE25","Lister / Modifier les  dispenses");
define("LANGTITRE26","Supprimer une dispense");
define("LANGTITRE27","Gestion dispenses -  Planification");
define("LANGTITRE28","Affichage / Modification des dispenses");
define("LANGTITRE29","Consultation des classes");
define("LANGTITRE30","Recherche d'un ".INTITULEELEVE);
define("LANGTITRE31","Importation du fichier GEP");
define("LANGTITRE32","Trombinoscope des ".INTITULEELEVE."s");
define("LANGTITRE33","Certificat de scolarit�");

//------------------------------
define("LANGTE1","Titre");
define("LANGTE2","du");
define("LANGTE3","de");
define("LANGTE4","Nombre de caract�res");
define("LANGTE5","Objet");
define("LANGTE6","A");
define("LANGTE6bis","Aux parents de ");
define("LANGTE7","Date");
define("LANGTE8","Suppression messages");
define("LANGTE9","lu");
define("LANGTE10","jusqu'au :");
define("LANGTE11","au ");
define("LANGTE12","le ");
define("LANGTE13","�");
define("LANGTE14","Au groupe ");

//------------------------------
define("LANGFETE","Bonne F�te aux ");
define("LANGFEN1","Ev�nement(s) du jour");
define("LANGFEN2","D.S.T. du jour");
//------------------------------
define("LANGLUNDI","Lundi");
define("LANGMARDI","Mardi");
define("LANGMERCREDI","Mercredi");
define("LANGJEUDI","Jeudi");
define("LANGVENDREDI","Vendredi");
define("LANGSAMEDI","Samedi");
define("LANGDIMANCHE","Dimanche");
// ------------------------------
define("LANGMESS1","Envoi d'un message - le ");
define("LANGMESS3","Message � la vie scolaire : ");
define("LANGMESS4","Message � un enseignant : ");
define("LANGMESS6","Message(s) envoy�(s)");
define("LANGMESS7","Actualit� enregistr�e");
define("LANGMESS8","Message(s) envoy�(s)");
define("LANGMESS9","R�pondre au message - le ");
define("LANGMESS10",'Les dates trimestrielles ne sont pas enregistr�es.');
define("LANGMESS11",'Veuillez pr�venir la '.INTITULEDIRECTION.'.');
define("LANGMESS12",'afin de valider les dates trimestrielles.');
define("LANGMESS13",'Veuillez cliquer <a href="definir_trimestre.php">ici</a>');
define("LANGMESS14",'Les affectations de cette classe  ne sont pas enregistr�es.');
define("LANGMESS15",'Veuillez cliquer <a href="affectation_creation_key.php">ici</a>');
define("LANGMESS16",'afin de valider les affectations de cette classe ');
define("LANGMESS17","Configuration");
define("LANGMESS18","S");     // premi�re lettre de la phrase suivante !!!
define("LANGMESS18bis","i plusieurs emails � d�clarer,<br> s�parer les emails par une virgule.");
define("LANGMESS19","Activ�");
define("LANGMESS20","Configuration mise � jour");
define("LANGMESS21","Etre averti d'un message re�u sur votre messagerie ");
define("LANGMESS22","Envoyer message � un groupe <font class=T1>(Ens,Vs,Dir,Tuteur Stage)</font> : ");
define("LANGMESS23","Cr�ation d'un groupe mail ");
define("LANGMESS24","Indiquer les personnes du groupe ");
define("LANGMESS25","S�lectionner les diff�rentes personnes en maintenant la touche"); //
define("LANGMESS26","Valider la cr�ation");
define("LANGMESS27","Groupe de mail cr��");
define("LANGMESS28","Liste de vos groupes mail ");
define("LANGMESS29","Groupe ");
define("LANGMESS30","Liste des personnes ");
define("LANGMESS31","Message de ");
define("LANGMESS32","Vous avez actuellement ");
define("LANGMESS33","message(s) en attente ");

// -----------------------------
// bouton
// PAS DE -->' (cote) !!!!
define("LANGBTS","Suivant >");
define("LANGBT1","Enregistrer le message d�filant");
define("LANGBT2","Enregistrer information");
define("LANGBT3","Quitter sans envoyer");
define("LANGBT4","Envoyer message");
define("LANGBT5","Patientez, S.V.P.");
define("LANGBT6","Supprimer les messages coch�s");
define("LANGBT7","Enregistrer le compte");
define("LANGBT11","Liste des suppl�ants");
define("LANGBT12","Liste des groupes");
define("LANGBT13","Valider la ou les classe(s)");
define("LANGBT14","Enregistrer la cr�ation");
define("LANGBT15","Liste des classes");
define("LANGBT16","Liste des mati�res");
define("LANGBT17","Enregistrer la sous-mati�re");
define("LANGBT18","Enregistrer le statut"); //
define("LANGBT19","Valider"); //
define("LANGBT20","Quitter sans enregistrer"); //
define("LANGBT21","Enregistrer affectation"); //
define("LANGBT22","Supprimer affectation"); //
define("LANGBT23","Envoyer le fichier"); //
define("LANGBT24","Recommencer"); //
define("LANGBT25","R�actualiser la page"); //
define("LANGBT26","Cr�er une classe"); //
define("LANGBT27","Planifier abs ou retard"); //
define("LANGBT28","Consulter"); //
define("LANGBT29","Supprimer abs ou retard"); //
define("LANGBT30","Valider la mise � jour"); //
define("LANGBT31","Valider");
define("LANGBT32","Supprimer dispenses");
define("LANGBT33","Modifier dispenses");
define("LANGBT34","Ajouter dispenses");
define("LANGBT35","Enregistrer la donn�e de ");
define("LANGBT36","Dispense  modifi�e --  L'�quipe TRIADE");
define("LANGBT37","Transmettre information");
define("LANGBT38","Envoyer");
define("LANGBT39","Lancer la recherche");
define("LANGBT40","R�cup�ration");
define("LANGBT41","Termin�");
define("LANGBT42","Valider les ".INTITULEELEVE."s non enregistr�s");
define("LANGBT43","Imprimer le bulletin");
define("LANGBT44","Historique");
define("LANGBT45","Consulter la documentation");
define("LANGBT46","Enregistrer la photo");
define("LANGBT47","Autre changement");
define("LANGBT48","Quitter ce module");
define("LANGBT49","Editer toute la classe");
define("LANGBT50","Supprimer");
define("LANGBT51","Valider demande D.S.T");
// -----------------------------
define("LANGCA1","M"); //
define("LANGCA1bis","essage pas encore lu"); // sans la premi�re lettre
define("LANGCA2","M"); //
define("LANGCA2bis","essage d�j� lu"); // sans la premiere lettre
define("LANGCA3","I"); //
define("LANGCA3bis","ndiquez le JJ/MM/AAAA  <BR> Dans le cas d\'une date non <BR>convenue, pr�cisez la mention <br>"); // sans la premiere lettre
// -----------------------------
define("LANGNA1","Nom"); //
define("LANGNA2","Pr&eacute;nom"); //
define("LANGNA3","Mot&nbsp;de&nbsp;passe"); //
define("LANGNA4","Nouveau compte cr�� \\n\\n L'�quipe TRIADE "); //
define("LANGNA5","Remplacement&nbsp;de&nbsp;"); //
// -----------------------------
define("LANGELE1","Renseignements sur l'".INTITULEELEVE); //
define("LANGELE2","Nom"); //
define("LANGELE3","Pr�nom"); //
define("LANGELE4","Classe"); //
define("LANGELE5","Option"); //
define("LANGELE6","R�gime"); //
define("LANGELE7","Interne"); //
define("LANGELE8","Demi-pensionnaire"); //
define("LANGELE9","Externe"); //
define("LANGELE10","Date de naissance"); //
define("LANGELE11","Nationalit�"); //
define("LANGELE12","Num�ro �tudiant"); //
// define("LANGELE12","Num�ro national"); //
define("LANGELE13","Renseignements sur la famille"); //
define("LANGELE14","Adresse 1"); //
define("LANGELE15","Code postal"); //
define("LANGELE16","Commune"); //
define("LANGELE17","Adresse 2"); //
define("LANGELE18",""); //
define("LANGELE19",""); //
define("LANGELE20","Num�ro de t�l�phone"); //
define("LANGELE21","Profession du p�re"); //
define("LANGELE22","T�l�phone du p�re"); //
define("LANGELE23","Profession de la m�re"); //
define("LANGELE24","T�l�phone de la m�re"); //
define("LANGELE25","Ecole ant�rieure"); //
define("LANGELE26","Nom de l'�tablissement"); //
define("LANGELE27","Num�ro �tablissement"); //
define("LANGELE28","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." cr�� -- L'�quipe TRIADE"); //
define("LANGELE29","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." d�j� existant  -- L'�quipe TRIADE"); //
//------------------------------------------------------------
define("LANGGRP1","Intitul� du groupe"); //
define("LANGGRP2","Indiquez les classes pour la cr�ation du groupe"); //
define("LANGGRP3","S�lectionnez les diff�rentes classes en maintenant la touche"); //
define("LANGGRP4","Ctrl"); //
define("LANGGRP5","et en appuyant sur le bouton gauche de la souris."); //
define("LANGGRP6","Intitul� de la section"); //
define("LANGGRP7","Nouvelle classe cr��e -- L'�quipe TRIADE"); //
define("LANGGRP8","Nouvelle mati�re cr��e -- L'�quipe TRIADE"); //
define("LANGGRP9","Intitul� de la mati�re"); //
define("LANGGRP10","Nom de la sous-mati�re"); //
//------------------------------------------------------------
//------------------------------------------------------------
define("LANGAFF1","Affectation pour la classe"); //
define("LANGAFF2","!! La cr�ation d'affectation <u>supprime</u> toutes les notes de la classe !!</u>"); //
define("LANGAFF3","Affectation des classes"); //
//------------------------------------------------------------
define("LANGPER1","Impression de p�riode"); //
define("LANGPER2","D�but de la p�riode"); //
define("LANGPER3","Fin de la p�riode"); //
define("LANGPER4","Section"); //
define("LANGPER5","R�cup�rer le fichier PDF"); //
define("LANGPER6","Enseignant "); //
define("LANGPER8","en classe de "); //
define("LANGPER9","Module d'affectation des classes."); //
define("LANGPER10","ATTENTION ce module est � utiliser lors d'une nouvelle affectation,<br> il d�truit toutes les notes des ".INTITULEELEVE."s  des classes affect�es."); //
define("LANGPER11","ATTENTION, les notes des classes s�lectionn�es  seront supprim�es. \\n Souhaitez-vous continuer ? \\n\\n Equipe TRIADE"); //
define("LANGPER12","Indiquez le code d'acc�s.");
define("LANGPER13","V�rification du code");
define("LANGPER14","Nombre de mati�res");
define("LANGPER15","Cr�ation d'affectation pour la classe");
define("LANGPER16","Nb");
define("LANGPER17","Mati&egrave;re");
define("LANGPER18","Enseignant");
define("LANGPER19","Coef");
define("LANGPER20","Groupe");
define("LANGPER21","Langue");
define("LANGPER22","Imprimer cette page");
define("LANGPER23","affectation");
define("LANGPER23bis","r�ussie");  // affectation xxxx r�ussie
define("LANGPER24","interrompue"); // affectation xxxx interrompue
define("LANGPER25","Classe");
define("LANGPER26","Visualisation");
define("LANGPER27","Visualiser");
define("LANGPER28","Visualisation d'affectation pour la classe");
define("LANGPER29","!! La modification d'affectation <u>supprime</u> toutes les notes de la classe !!");
define("LANGPER30","Modifier");
define("LANGPER31","Modifier l'affectation");
define("LANGPER32","Modification d'affectation");
define("LANGPER32bis","interrompue"); // Modification d'affectation xxxx interrompue
define("LANGPER33","Suppression de l'affectation  pour la ");
define("LANGPER34","!! La suppression d'affectation <u>supprime</u> toutes les notes de la classe !!</u>");
define("LANGPER35","Affectation de la classe");
define("LANGPER35bis","supprim�e"); // Affectation de la classe  xxxx supprim�e
//------------------------------------------------------------------------------
define("LANGIMP1","Importation d'une base existante ");
define("LANGIMP2","Indiquer le type du fichier � importer ");
define("LANGIMP3","Fichier ASCII ");
define("LANGIMP4","Fichier GEP ");
define("LANGIMP5","Module d'importation de fichier ASCII.");
define("LANGIMP6","Le fichier � transmettre <FONT color=RED><B>DOIT</B></FONT> contenir <FONT COLOR=red><B>45</B></FONT> champs <I>(vides ou non vides)</I> s�par�s par un m�me s�parateur le \"<FONT color=red><B>;</B></font>\" <I>Soit la pr�sence de 44 fois le caract�re \"<FONT color=red><B>;</B></font>\"</I>");
define("LANGIMP7","Voici l'ordre des champs � indiquer : ");
define("LANGIMP8","nom");
define("LANGIMP9","pr�nom");
define("LANGIMP10","classe");
define("LANGIMP11","r�gime");
define("LANGIMP12","date naissance");
define("LANGIMP13","nationalit�");
define("LANGIMP14","nom tuteur");
define("LANGIMP15","pr�nom tuteur");

define("LANGIMP16","adresse&nbsp;1");
define("LANGIMP18","code postal&nbsp;1");
define("LANGIMP19","commune&nbsp;1");

define("LANGIMP17","adresse&nbsp;2");
define("LANGIMP18_2","code postal&nbsp;2");
define("LANGIMP19_2","commune&nbsp;2");


define("LANGIMP20","t�l�phone");
define("LANGIMP21","profession p�re");
define("LANGIMP22","t�l�phone profession p�re");
define("LANGIMP23","profession m�re");
define("LANGIMP24","t�l�phone profession m�re");
define("LANGIMP25","num�ro �tablissement");

define("LANGIMP26","lv1");
define("LANGIMP27","lv2");
define("LANGIMP28","option");
define("LANGIMP29","Num�ro ".INTITULEELEVE);
define("LANGIMP30","ATTENTION, la destruction de la base sera automatique. \\n Souhaitez-vous continuer ? \\n\\n L\'Equipe TRIADE");
define("LANGIMP31","ATTENTION : ce module est � utiliser lors de la premi�re utilisation,<br> il d�truit toutes les informations des ".INTITULEELEVE."s (notes, bulletins, vie scolaire).<br /> * champ obligatoire");
define("LANGIMP39","Indiquer le fichier � transmettre ");
define("LANGIMP40","Fichier transmis -- L'�quipe TRIADE ");
define("LANGIMP41","Le nombre de champs n'est pas respect� ");
define("LANGIMP42","Indiquer pour chaque r�f�rence la classe correspondante ");
define("LANGIMP43","Fichier non enregistr� ");
// ------------------------------------------------------------------------------
define("LANGABS1","Gestion absences - retards du jour");
define("LANGABS2","Planifier une absence ou retard");
define("LANGABS3","Indiquer le nom de l'".INTITULEELEVE);
define("LANGABS4","Lister les absences ou retards non justifi�s");
define("LANGABS5","Absences non justifi�es");
define("LANGABS6","Retards non justifi�s");
define("LANGABS7","Visualiser et/ou modifier une absence ou retard");
define("LANGABS8","Indiquer le nom de l'".INTITULEELEVE);
define("LANGABS9","Afficher et/ou supprimer une absence ou retard");
define("LANGABS10","aucun �l�ve dans la base de donn�es");
define("LANGABS11","Abs/Rtd");
define("LANGABS12","Motif");
define("LANGABS13","En retard le");
define("LANGABS14","Rtd");
define("LANGABS15","Abs");
define("LANGABS16","Annuler");
define("LANGABS17","Modifier abs ou retard");
define("LANGABS18","Absent&nbsp;du&nbsp;");
define("LANGABS19","au&nbsp;");
define("LANGABS20","Abs/Rtd");
define("LANGABS21","Dur�e");
define("LANGABS22","Motif");
define("LANGABS23","Heure / Date");
define("LANGABS24","Mise en place des absences ou retards en  Classe de ");
define("LANGABS25","Gestion Absence - Retard");
define("LANGABS26","Gestion Absence - Retard  Planification");
define("LANGABS27","Enregistrer la donn�e de ");
define("LANGABS28","Donn�e(s) Enregistr�e(s) ");
define("LANGABS29","D"); //premiere lettre
define("LANGABS29bis","ispens�(e) de :"); //suite
define("LANGABS30","Disp");
define("LANGABS31","classe de ");
define("LANGABS32","R"); //premiere lettre
define("LANGABS32bis","etard "); //suite
define("LANGABS33","en");
define("LANGABS34","de");
define("LANGABS35","Absence - Retard - dispense  du ");
define("LANGABS36","Mise � jour");
define("LANGABS37","Imprimer les absences, dispenses, retards, du jour ");
define("LANGABS38","T&eacute;l.");
define("LANGABS39","T�l. Prof P�re ");
define("LANGABS40","T�l. Prof M�re");
define("LANGABS41","T�l. Dom ");
define("LANGABS42","Absent(e)  du ");
define("LANGABS43","pendant ");
define("LANGABS44","Jour(s) ");
define("LANGABS45","Enregistrer la mise � jour ");
define("LANGABS46","� partir du ");

define("LANGDISP8","Suppression dispense");
//----------------------------------------------------------------------------
define("LANGPROJ1","Choix de la classe");
define("LANGPROJ2","Choix du trimestre");
define("LANGPROJ3","Trimestre 1");
define("LANGPROJ4","Trimestre 2");
define("LANGPROJ5","Trimestre 3");
define("LANGPROJ6","<font class=T2>Aucun ".INTITULEELEVE." dans cette classe</font>");
define("LANGPROJ7","Nombre de retards");
define("LANGPROJ8"," Cumul");
define("LANGPROJ9","Discipline");
define("LANGPROJ10","minutes");
define("LANGPROJ11","Nbr de retenues");
define("LANGPROJ12","attr.&nbsp;par&nbsp;");
define("LANGPROJ13","Liste");
define("LANGPROJ14","Moy ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
define("LANGPROJ15","Moy Classe");
define("LANGPROJ16","Moyenne ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
// ----------------------------------------------------------------------------
define("LANGDISP1","<font class=T2>aucun ".INTITULEELEVE." � ce nom</font>");
define("LANGDISP2","Motif");
define("LANGDISP3","Certificat m�dical");
define("LANGDISP4","P�riode&nbsp;du&nbsp;");
define("LANGDISP5","en mati�re ");
define("LANGDISP6","Heure de dispense ");
define("LANGDISP7","<B><font color=red>I</font></B>ndiquez le JJ/MM/AAAA  <BR> dans les 2 champs");
define("LANGDISP9","Affichage <b>complet</B> des dispenses");
define("LANGDISP10","En");
// ----------------------------------------------------------------------------
define("LANGASS1","TRIADE assistance");
define("LANGASS2","Vous propose un  service pour vous d�panner, vous aider dans votre utilisation  de TRIADE.<br /><br />Vous avez un probl�me sur un des services de TRIADE, n'h�sitez pas � nous transmettre par le formulaire qui suit, les informations sur le service en question. Nos ing�nieurs se chargeront de v�rifier ce service.");
define("LANGASS3","Membre concern�");
define("LANGASS4","Administration");
define("LANGASS5","Enseignant");
define("LANGASS6","Vie Scolaire");
define("LANGASS6bis","Parent");
define("LANGASS7","Action");
define("LANGASS8","Cr�ation");
define("LANGASS9","Visualisation");
define("LANGASS10","Suppression");
define("LANGASS11","Autre");
define("LANGASS12","Service");
define("LANGASS13","Compte utilisateur");
define("LANGASS14","Messagerie");
define("LANGASS15","Affectation");
define("LANGASS16","Base de donn�es");
define("LANGASS17","Classe");
define("LANGASS18","Mati�re");
define("LANGASS19","Recherche");
define("LANGASS20","D.S.T.");
define("LANGASS21","Planning");
define("LANGASS22","Dispense");
define("LANGASS23","Discipline");
define("LANGASS24","Circulaire");
define("LANGASS25","Bulletin");
define("LANGASS26","P�riode");
define("LANGASS27","Commentaire");
define("LANGASS28","TRIADE assistance vous remercie pour votre aide.");
define("LANGASS29","Equipe TRIADE.");
define("LANGASS30","L'�quipe TRIADE � votre service");
define("LANGASS31","TRIADE est un produit unique et in�dit, aussi, n'h�sitez pas � nous transmettre vos conseils et suggestions afin que le site r�pondre aux attentes r�elles des utilisateurs ! Merci � vous :-)");
define("LANGASS32","Livre d'or");
define("LANGASS33","Votre t�moignage en direct : inscrivez vos remarques sur notre livre d'or.");
define("LANGASS34","Votre message nous a �t� envoy�, nous ne manquerons pas de vous r�pondre.<br> <BR>Merci d'utiliser TRIADE et � bient�t.<BR><BR><BR><UL><UL>L'�quipe TRIADE.<BR>");
define("LANGASS35","Autre");
define("LANGASS36","SMS");
define("LANGASS37","WAP");
define("LANGASS38","Trombinoscope");
define("LANGASS39","Code barre");
define("LANGASS40","Stage Pro.");
// -----------------------------------------------------------------------------
define("LANGRECH1","<font class=T2>aucun ".INTITULEELEVE." dans la classe</font>");
define("LANGRECH2","Recherche de ");
define("LANGRECH3","<font class=T2>aucun ".INTITULEELEVE." pour cette recherche</font>");
define("LANGRECH4","Information / Modification");
// ---------------------------------------------------------------------------------
define("LANGBASE1","ATTENTION : ce module est � utiliser lors de la premi�re utilisation,<br> il d�truit toutes les informations des ".INTITULEELEVE."s  (notes, bulletins, vie scolaire).");
define("LANGBASE2"," Les fichiers � importer DOIVENT �tre au format dbf ");
define("LANGBASE3","Voici la liste des fichiers ");
define("LANGBASE4","Module d'importation des fichiers GEP ");
define("LANGBASE5","Importation d'une base GEP ");
define("LANGBASE6","Total d'".INTITULEELEVE."s dans le fichier DBF ");
define("LANGBASE7","Total d'".INTITULEELEVE."s en classe ");
define("LANGBASE8","Total d'".INTITULEELEVE."s sans classe ");
define("LANGBASE9","R�cup�ration des mots de passe  ");
define("LANGBASE10","Impossible d'ouvrir le fichier F_ele.dbf");
define("LANGBASE11","Base de donn�es trait�e -- L'�quipe TRIADE");
define("LANGBASE12","Le fichier s�lectionn� n'est pas valide !");
define("LANGBASE13","Voici la liste des mots de passe");
define("LANGBASE14","R�cup�rer la liste  en s�lectionnant l'ensemble des lignes et effectuez un copier/coller dans un fichier \"txt\".");
define("LANGBASE15","Puis via excel ou OpenOffice, r�cup�rer le fichier \"txt\"  en pr�cisant le point virgule comme s�parateur de champs.");
define("LANGBASE17"," Attention : les mots de passe ne sont accessibles que sur <br />cette page !! Pensez � r�cuperer la liste <b>AVANT</b> de Terminer ");
define("LANGBASE18","INFORMATION NON DISPONIBLE");
// -----------------------------------------------------------------------------------------------------------------------
define("LANGBULL1","Impression  bulletin trimestriel");
define("LANGBULL2","Indiquez la classe");
define("LANGBULL3","Ann�e scolaire");
define("LANGBULL4","<a href=\"#\" onclick=\"open('./accrobat.php','acro','width=500,height=350')\"><b><FONT COLOR=red>ATTENTION</FONT></B> Besoin de l'outil <B>Adobe Acrobat Reader</B>.  Logiciel et t�l�chargement gratuits  cliquez <B>ICI</B></A>");
// -----------------------------------------------------------------------------------------------------------------------
define("LANGPARENT1","aucun message");
define("LANGPARENT2","Aucun d�l�gu� affect� pour le moment");
define("LANGPARENT3","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."(s) d�l�gu�(s)");
define("LANGPARENT4","Parent(s) d�l�gu�(s)");
define("LANGPARENT5","Liste des d�l�gu�s");
//----------------------------------------------------------------------//
define("LANGPUR3","ATTENTION: ce module est � utiliser <br>lorsque vous souhaitez effacer des donn�es TRIADE.");
define("LANGPUR4","ATTENTION, Vous rentrez dans un module qui par la suite supprimera des donn�es que vous aurez choisi. \\n Souhaitez-vous continuer ? \\n\\n L\'�quipe TRIADE");
define("LANGPUR5","Les donn�es sont supprim�es");
define("LANGPUR6","Information : La s�lection \"".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."\" implique automatiquement la suppression des notes, absences, disciplines, dispenses, retards, entretiens");
define("LANGPUR7","Indiquer l'�l�ment ou les �l�ments  �  d�truire : ");
define("LANGPUR8","A conserver");
define("LANGPUR9","A Supprimer");
//----------------------------------------------------------------------//
define("LANGCHAN0","Module pour le changement de classe d'un ou de plusieurs ".INTITULEELEVE."s");
define("LANGCHAN1","ATTENTION: ce module est � utiliser <br>lorsque vous souhaitez effectuer <br> un changement de classe pour les ".INTITULEELEVE."s");
define("LANGCHAN3","ATTENTION, des donn�es de l\'".INTITULEELEVE." \\n ou des ".INTITULEELEVE."s concern�(s) par le changement de classe seront supprim�es");
//----------------------------------------------------------------------//
define("LANGGEP1",'Importation du fichier GEP');
define("LANGGEP2",'Indiquez le fichier');
//----------------------------------------------------------------------//
define("LANGCERT1"," t�l�charger ce certificat ");
//----------------------------------------------------------------------//
define("LANGPROFR1",'Indiquez des '.INTITULEELEVE.'s en retard');
define("LANGPROFR2",'Mise en place des retards  ');
define("LANGKEY1",'<font class=T1>Pas de clef d\'enregistrement </font>');
define("LANGDISP20",'Ajouter dispenses');
define("LANGPROFA",'<br><center><font size=2>Pas de clef d\'enregistrement </font><br><br>Veuillez contacter votre administrateur TRIADE, <br>afin de valider la demande d\'enregistrement de TRIADE. </center><br><br>');
define("LANGPROFB",'Ajout d\'une note en ');
define("LANGPROFC",'Confirmez l\'enregistrement des notes ');
define("LANGPROFD",'Validez l\'enregistrement des notes');
define("LANGPROFE",'&nbsp;&nbsp;<i><u>Info</u>: La touche Entr�e vous permet de passer automatiquement � la note suivante.</i>');
define("LANGPROFF",'Ajout d\'une note');
define("LANGPROFG",'Indiquer la classe');
//----------------------------------------------------------------------//
define("LANGMETEO1",'JOUR');
define("LANGMETEO2",'NUIT');
//----------------------------------------------------------------------//
define("LANGPROFP1","Message pour la classe");
define("LANGPROFP2","Enregistrer le message");
define("LANGPROFP3","Message du Professeur Principal");
//----------------------------------------------------------------------//
// Module Stage Pro
define("LANGSTAGE1","Planification des stages ");
define("LANGSTAGE2","Visualiser les dates des stages ");
define("LANGSTAGE3","Ajouter ");
define("LANGSTAGE4","Affecter ");
define("LANGSTAGE5","Insertion d'une date de stage ");
define("LANGSTAGE6","Modification  d'une date de stage ");
define("LANGSTAGE7","Supprimer une date de stage ");
define("LANGSTAGE8","Gestion des entreprises ");
define("LANGSTAGE9","Visualiser les diff�rentes entreprises ");
define("LANGSTAGE10","Ajouter une entreprise ");
define("LANGSTAGE11","Modifier une entreprise ");
define("LANGSTAGE12","Supprimer une entreprise ");
define("LANGSTAGE13","Gestion des ".INTITULEELEVE."s ");
define("LANGSTAGE14","Visualiser les ".INTITULEELEVE."s en entreprise ");
define("LANGSTAGE15","Affecter un ".INTITULEELEVE." � une entreprise ");
define("LANGSTAGE16","Modifier les caract�ristiques d'un ".INTITULEELEVE." ");
define("LANGSTAGE17","Supprimer l'attribution d'un ".INTITULEELEVE." ");
define("LANGSTAGE18","Visualisation des dates de stage");
define("LANGSTAGE19","Stage");
define("LANGSTAGE20","Recherche d'entreprises");
define("LANGSTAGE21","Consulter les entreprises par activit�");
define("LANGSTAGE22","Consultation des entreprises");
//----------------------------------------------------------------------//
define("LANGGEN1","Administration");
define("LANGGEN2","Vie Scolaire");
define("LANGGEN3","Enseignants");
//----------------------------------------------------------------------//
define("LANGDST1","Demande de D.S.T");
define("LANGDST2","Bonjour, <br> <br> Votre demande de Devoir sur Table pour le ");
define("LANGDST3","<br><br><b>n\'est pas possible</b>, veuillez choisir une autre date ou nous contacter directement. <br><br> Merci");
define("LANGDST4","<br><br><b>est enregistr�e</b> pour toute information suppl�mentaire, nous contacter. <br><br> Merci");
define("LANGDST5","pour le ");
define("LANGDST6","Sujet / Mati�re");
define("LANGDST7","Demande refus�e");
define("LANGDST8","Demande accord�e");
//----------------------------------------------------------------------//
define("LANGCALEN1","Ev�nement");
define("LANGCALEN2","Planning du ");
define("LANGCALEN3","Ajouter une entr�e");
define("LANGCALEN4","Supprimer une entr�e");
define("LANGCALEN5","R�actualiser la page");
define("LANGCALEN6","Calendrier des �v�nements");
define("LANGCALEN7","En classe de ");
define("LANGCALEN8","Devoir de ");
define("LANGCALEN9","Devoir(s) Sur Table du jour");
//----------------------------------------------------------------------//
//module reservation
define("LANGRESA1","Gestion de l'�quipement");
define("LANGRESA2","Gestion des salles");
define("LANGRESA3","Liste de l'�quipement");
define("LANGRESA4","Liste des salles");
define("LANGRESA5","Ajouter un �quipement");
define("LANGRESA6","Modifier un �quipement");
define("LANGRESA7","Supprimer un �quipement");
define("LANGRESA8","Ajouter salle");
define("LANGRESA9","Supprimer salle");
define("LANGRESA10","Supprimer une salle");
define("LANGRESA11","R�servation �quipement / salle");
define("LANGRESA12","R�servation �quipement");
define("LANGRESA13","R�servation salle");
define("LANGRESA14","R�server");
define("LANGRESA15","Cr�ation d'un �quipement");
define("LANGRESA16","Intitul� de l'�quipement");
define("LANGRESA17","Enregistrer la cr�ation");
define("LANGRESA18","Informations compl�mentaires");
define("LANGRESA19","Equipement enregistr�");
define("LANGRESA20","Cr�ation d'une salle");
define("LANGRESA21","Intitul� de la salle");
define("LANGRESA22","Salle enregistr�e");
define("LANGRESA23","Supprimer salle");
define("LANGRESA24","Salle");
define("LANGRESA25","Supprimer la salle");
define("LANGRESA26","Salle supprim�e");
define("LANGRESA27","une salle");
define("LANGRESA28","Impossible de supprimer cette salle. \\n\\n Salle affect�e.  ");
define("LANGRESA29","Equipement supprim�");
define("LANGRESA30","Impossible de supprimer cet �quipement. \\n\\n Equipement affect�.  ");
define("LANGRESA31","un �quipement");
define("LANGRESA32","Supprimer �quipement");
define("LANGRESA33","Equipement");
define("LANGRESA34","Supprimer un �quipement");
define("LANGRESA35","Liste des �quipements");
define("LANGRESA36","DATE");
define("LANGRESA37","De");
define("LANGRESA38","A");
define("LANGRESA39","Par qui");
define("LANGRESA40","Information");
define("LANGRESA41","Confirmer");
define("LANGRESA42","Confirm�");
define("LANGRESA43","Non&nbsp;Confirm�");
define("LANGRESA44","Planning Equipement");
define("LANGRESA45","Equipement");
define("LANGRESA46","Equipement d�j� r�serv� � cette date");
define("LANGRESA47","Consulter le planning de r�servation de cet �quipement");
define("LANGRESA48","R�servation � partir du ");
define("LANGRESA49","En date du ");
define("LANGRESA50","Equipement r�serv� en attente de confirmation");
define("LANGRESA51","Planning Salle");
define("LANGRESA52","Salle");
define("LANGRESA53","Salle d�j� r�serv�e � cette date");
define("LANGRESA54","Salle r�serv�e en attente de confirmation");
define("LANGRESA55","Consulter le planning de r�servation pour cette salle");
define("LANGRESA56","Confirmer R�servation");
define("LANGRESA57","Planning");
define("LANGRESA58","Confirmer");
//----------------------------------------------------------------------//
define("LANGTTITRE1","Acc&egrave;s Membre");
define("LANGTTITRE2","Membre");
define("LANGTTITRE3","Activation du compte");
define("LANGTTITRE4","Merci de bien vouloir patienter");
//--------------
define("LANGTP1","Nom");
define("LANGTP2","Pr�nom");
define("LANGTP3","Mot de passe");
define("LANGTCONNEXION","Connexion");
define("LANGTERREURCONNECT","Erreur de connexion");
define("LANGTCONNECCOURS","Connexion en cours ");
define("LANGTFERMCONNEC","Cliquez ici pour la fermeture de votre compte");
define("LANGTDECONNEC","D�connexion en cours");

define("LANGTBLAKLIST0",'<b><font color=red  class=T2>Votre compte est d�sactiv� !!</b><br> Pour revalider votre compte, contacter votre �tablissement scolaire.</font>');

define("LANGMOIS1","Janvier");
define("LANGMOIS2","F�vrier");
define("LANGMOIS3","Mars");
define("LANGMOIS4","Avril");
define("LANGMOIS5","Mai");
define("LANGMOIS6","Juin");
define("LANGMOIS7","Juillet");
define("LANGMOIS8","Ao�t");
define("LANGMOIS9","Septembre");
define("LANGMOIS10","Octobre");
define("LANGMOIS11","Novembre");
define("LANGMOIS12","D�cembre");

define("LANGDEPART1","de l'".INTITULEELEVE);

define("LANGVALIDE","Valider");
define("LANGIMP45","Editer");

define("LANGMESS34","Message plus disponible.");
define("LANGMESS35","Rendre public ce groupe.");
define("LANGMESS36","Message supprim�");


define("LANGRESA59","Nom de la salle");
define("LANGRESA60","Information");

define("LANGMAINT0","Une intervention est pr�vue sur le logiciel");
define("LANGMAINT1","Le service TRIADE sera inaccessible le ");
define("LANGMAINT2","entre");
define("LANGMAINT3","et");

define("LANCALED1","Ann�e Pr�c�dente");
define("LANCALED2","Ann�e Suivante");


define("LANGTTITRE5","Probl�me d'acc�s");
define("LANGTTITRE6","Questions");
define("LANGTPROBL1","Actuellement, le service TRIADE  est en  service.");
define("LANGTPROBL2","J'ai une Question");
define("LANGTPROBL3","Enregistrer la question");
define("LANGTPROBL4","Quitter sans enregistrer");
define("LANGTPROBL5","Expliquez-nous votre probl�me");
define("LANGTPROBL6","Etablissement scolaire*: ");
define("LANGTPROBL7","Email : ");
define("LANGTPROBL8","Message : ");
define("LANGTPROBL9","(* champ obligatoire)");
define("LANGTPROBL10","Enregistrer le probl�me");
define("LANGTPROBL12","Nous nous chargeons de r�gler votre probl�me dans les plus brefs d�lais. \\n\\n  L'Equipe TRIADE ");

define("LANGELEV1","Notes scolaires de");

define("LANGFORUM1","- Liste des messages");
define("LANGFORUM2","Aucun message n'a �t� post� dans ce forum de discussion");
define("LANGFORUM3","Vous pouvez ");
define("LANGFORUM3bis"," poster ");
define("LANGFORUM3ter"," un premier message si vous le souhaitez ");
define("LANGFORUM4","Poster un nouveau message");
define("LANGFORUM5","Forum - Poster un message");
define("LANGFORUM6","Charte � respecter");
define("LANGFORUM7","Erreur : le message r�f�rant n'existe pas.");
define("LANGFORUM8","Retour � la liste des messages post�s");
define("LANGFORUM9","--- Message d'origine ---");
define("LANGFORUM10","Votre nom ");
define("LANGFORUM11","Votre email ");
define("LANGFORUM12","Sujet ");
define("LANGFORUM13","Envoyer"); // --> bouton envoyer
define("LANGFORUM14","Retour � la liste des messages post�s");
define("LANGFORUM15","Forum - envoi d'un message");
define("LANGFORUM16","<b>Erreur</b> : cette page ne peut �tre appel�e<br> que si un message a �t� pr�alablement ");
define("LANGFORUM16bis"," post� ");
define("LANGFORUM17","<b>Erreur</b> : votre message ne comporte aucun texte.<br>");
define("LANGFORUM18","<b>Erreur</b> : vous avez oubli� d'indiquer votre nom.<br>");
define("LANGFORUM19","Erreur ! Votre message n'a pas pu �tre post�. ");
define("LANGFORUM20","<b>Erreur</b> : impossible de mettre � jour le fichier index. <br>");
define("LANGFORUM21","Votre message n'a pas pu �tre post�.");
define("LANGFORUM22","Votre message a �t� post� correctement.<br>Merci de votre contribution.");
define("LANGFORUM23","Retour � la liste des messages post�s");
define("LANGFORUM24","Forum - lecture d'un message");
define("LANGFORUM25","Aucun message n'a �t� post� dans ce forum de discussion.");
define("LANGFORUM26","Vous pouvez ");
define("LANGFORUM26bis","poster");
define("LANGFORUM26ter","un premier message si vous le souhaitez.");
define("LANGFORUM27","Ce message n'existe pas ou a �t� supprim� par l'administrateur du forum de discussion.<br>");
define("LANGFORUM28","Retour � la liste des messages post�s");
define("LANGFORUM30","Auteur");
define("LANGFORUM31","Date");
define("LANGFORUM32","Poster une r�ponse");
define("LANGFORUM33","Message pr�c�dent (dans le fil de discussion)");
define("LANGFORUM34","Messages suivants (dans le fil de discussion)");

define("LANGPROFH","Devoir Scolaire  �  faire en ");
define("LANGPROFI","Enregistrer le devoir � faire ");
define("LANGPROFJ","Devoir � faire ");
define("LANGPROFK","saisie&nbsp;le&nbsp;");
define("LANGPROFL","Confirmer la date");
define("LANGPROFM","Pour le ");
define("LANGPROFN","Devoir du ");
define("LANGPROFO","Devoir Scolaire ");
define("LANGPROFP","Mise en place des professeurs principaux");
define("LANGPROFQ","Pour demain");
define("LANGPROFR","Pour hier");
define("LANGPROFS","Mati�re ou sujet");
define("LANGPROFT","Valider la demande de D.S.T");
define("LANGPROFU","Demande Envoy�e -- L'�quipe TRIADE");


define("LANGPROJ17","Nombre d'absences");
define("LANGPROJ18","jours");

define("LANGCALEN10","Calendrier des devoirs sur table");

define("LANGPARENT6","Liste des Retards");
define("LANGPARENT7","Liste des Absences");
define("LANGPARENT8","Absent le ");
define("LANGPARENT9","Liste des dispenses");
define("LANGPARENT10","P�riode&nbsp;du&nbsp;");
define("LANGPARENT11","A"); // indique une date (heure)
define("LANGPARENT12","Le"); // indique une date jour
define("LANGPARENT13","Certificat");
define("LANGPARENT14","Sanction disciplinaire");
define("LANGPARENT15","Sanction");
define("LANGPARENT16","En&nbsp;retenue");
define("LANGPARENT17","�");  // indique une heure
define("LANGPARENT18","Retenue effectu�e");
define("LANGPARENT19","Liste des circulaires administratives");
define("LANGPARENT20","Acc�s Fichier");
define("LANGPARENT21","Visible par ");
define("LANGPARENT22","Calendrier des �v�nements ");
define("LANGPARENT23","Calendrier des devoirs sur table ");
define("LANGPARENT24","Demande de D.S.T ");


define("LANGAUDIO1","Communiqu� Audio");
define("LANGAUDIO2","Le "); // indique une date
define("LANGAUDIO3","C"); // premi�re lettre
define("LANGAUDIO3bis","ommuniqu� audio au format <b>mp3</b><br>Taille maximum du fichier : ");
define("LANGAUDIO4","Enregistrez le communiqu�");
define("LANGAUDIO5","Veuillez patienter 2 � 3 minutes apr�s l'envoi du fichier audio.");
define("LANGAUDIO6","Supprimer le communiqu� audio");


define("LANGOK","Ok");
define("LANGCLICK","Cliquez-ici");
define("LANGPRECE","Pr�c�dent");
define("LANGERROR1","Donn�es introuvables");
define("LANGERROR2","aucune donn�e");


define("LANGPROF1","Indiquer la mati�re");
define("LANGPROF2","Nombre de notes");
define("LANGPROF3","Visualisation des notes");
define("LANGPROF4","groupe");
define("LANGPROF5","Choix du Trimestre");
define("LANGPROF6","Sujet "); // sujet du devoir
define("LANGPROF7","Intitul� du sujet "); // sujet du devoir
define("LANGPROF8","Note"); //note d'un devoir
define("LANGPROF9","Devoir Scolaire  �  faire � la maison");
define("LANGPROF10","Modification d'une note");
define("LANGPROF11","Suppression d'un devoir"); // devoir --> interrogation
define("LANGPROF12","Professeur Principal");
define("LANGPROF13","Fiche ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
define("LANGPROF14","Ajout de Note en ");
define("LANGPROF15","Modifier une note en");
define("LANGPROF16","Nom du devoir");
define("LANGPROF17","Date&nbsp;du&nbsp;devoir"); // &nbsp; --> �gal un blanc
define("LANGPROF18","Patientez");
define("LANGPROF19","Confirmer la modification des notes");
define("LANGPROF20","Valider la modification  des notes");
define("LANGPROF21","Modification de Notes en");
define("LANGPROF22","Visualisation des notes en");
define("LANGPROF23","Suppression d'un devoir en");
define("LANGPROF24","Devoir de "); // interrogation du
define("LANGPROF25","est supprim�");
define("LANGPROF26","Informations sur l'".INTITULEELEVE);
define("LANGPROF27","Renseignements administratifs");
define("LANGPROF28","Informations sur la vie scolaire");
define("LANGPROF29","Informations m�dicales");
define("LANGPROF30","Information du");
define("LANGPROF31","De"); // indiquant une personne


define("LANGEL1","Nom");
define("LANGEL2","Pr�nom");
define("LANGEL3","Classe ");
define("LANGEL4","Lv1");
define("LANGEL5","Lv2");
define("LANGEL6","Option");
define("LANGEL7","R�gime");
define("LANGEL8","Date de naissance");
define("LANGEL9","Nationalit�");
define("LANGEL10","Mot de passe");
define("LANGEL11","Nom de Famille");
define("LANGEL12","Pr�nom");
define("LANGEL13","rue");
define("LANGEL14","Adresse 1");
define("LANGEL15","Code postal");
define("LANGEL16","Commune");
define("LANGEL17","rue");
define("LANGEL18","Adresse 2");
define("LANGEL19","Code Postal");
define("LANGEL20","Commune");
define("LANGEL21","T�l�phone");
define("LANGEL22","Profession du p�re");
define("LANGEL23","T�l�phone du p�re");
define("LANGEL24","Profession de la m�re");
define("LANGEL25","T�l�phone de la m�re");
define("LANGEL26","Etablissement");
define("LANGEL27","Code �tablissement");
define("LANGEL28","Code postal");
define("LANGEL29","Commune");
define("LANGEL30","Num�ro Etudiant");
// define("LANGEL30","Num�ro National");


define("LANGPROF32","Informations scolaires");
define("LANGPROF33","Devoir � la maison");
define("LANGPROF34","Consultation en semaine");
define("LANGPROF35","Semaine derni�re");
define("LANGPROF36","Semaine prochaine");
define("LANGTP23"," INFORMATION - Demande de r�servation !");
define("LANGRESA61","Nom de l'�quipement");


define("LANGIMP46","Pr�nom");
define("LANGIMP47","Intitul� (M. ou Mme ou Mlle) ");
define("LANGIMP48","Nom");
define("LANGIMP49","* champ obligatoire");
define("LANGIMP50","Le fichier � transmettre <FONT color=RED><B>DOIT</B></FONT> contenir <FONT COLOR=red><B>9</B></FONT> champs <I>(non vides)</I> s�par�s par un m�me s�parateur le \"<FONT color=red><B>;</B></font>\" <I>Soit la pr�sence de 8 fois le caract�re \"<FONT color=red><B>;</B></font>\"</I>");
define("LANGIMP51","mot de passe parent");
define("LANGIMP52","mot de passe ".INTITULEELEVE);



define("LANGacce_dep1","Erreur de connexion");
define("LANGacce_dep2","V�rifier vos identifiants de connexion, si le probl�me persiste, <br />  avertissez votre administrateur TRIADE via le lien <br /> 'Probl�me d'acc�s' dans le menu de gauche");

define("LANGacce_ref1","Erreur Type :Acc�s non autoris�");
define("LANGacce_ref11","Visit� le ");
define("LANGacce_ref12","par ");
define("LANGacce_ref13","avec  ");
define("LANGacce_ref2","ACCES NON AUTORISE");
define("LANGacce_ref3","Pour acc�der � votre compte, vous devez vous connecter.");
define("LANGacce1","L'".INTITULEELEVE." ");
define("LANGacce12","a une punition � rendre, <br> suite � la cat�gorie : ");
define("LANGacce13","pour le motif ");
define("LANGacce14","Le devoir � faire est le suivant : ");
define("LANGacce2","Supprimer ce message : ");
define("LANGacce21","Supprimer");
define("LANGacce3","L'".INTITULEELEVE." ");
define("LANacce31","ne s'est pas pr�sent�</b></font> � la vie scolaire (CPE), <b>pour la retenue</b>,  suite � la cat�gorie :");
define("LANacce32","pour le motif : ");
define("LANGacce4","Le devoir � faire est le suivant :");
define("LANGacce5","Supprimer");
define("LANGacce6","Gestion disciplinaire");
define("LANGaccrob11","T�l�chargement du Logiciel Adobe Acrobat Reader 8.1.0 fr");
define("LANGaccrob2","23,4 Mo  pour Windows 2000/XP/2003/Vista");
define("LANGaccrob3","Temps du t�l�chargement :");
define("LANGaccrob4","en 56 K : 57 min et 3 s");
define("LANGaccrob5","en 512 K : 6 min et 14 s");
define("LANGaccrob6","en 5 M : 37 secondes");
define("LANGaccrob7","T�l�chargement du Logiciel Adobe Acrobat Reader 6.O.1 fr");
define("LANGaccrob8","Taille : ");
define("LANGaccrob9","0.40916 Mo pour NT/95/98/2000/ME/XP");
define("LANGaccrob10","en 56 K : 0 min et 58.2 s");
define("LANGaccrob11bis","en 512 K : 0 min et 6.6 s ");
define("LANGaffec_cre21","Cr�ation d'affectation pour la classe ");
define("LANGaffec_cre22","Mise en place d'affectation en cours ");
define("LANGaffec_cre23","Le lancement du logiciel d'affectation va se faire automatiquement<br>Si la nouvelle page n'apparait pas, cliquez ");
define("LANGaffec_cre24","TRIADE - Compte de ");
define("LANGaffec_cre31","CREATION - AFFECTATION");
define("LANGaffec_cre41","Imprimer");
define("LANGaffec_mod_key1","Affectation des classes");
define("LANGaffec_mod_key2","Module de modification d'affectation des classes.");
define("LANGaffec_mod_key3","ATTENTION ce module est � utiliser lors de modification  d'affectation,<br> il d�truit toutes les notes des ".INTITULEELEVE."s  des classes modifi�es. ");
define("LANGaffec_mod_key4","ATTENTION, la destruction des notes des classes s�lectionn�es  seront supprim�es. \\n Souhaitez-vous continuer ? \\n\\n L\'�quipe TRIADE");
define("LANGattente1","Attente - TRIADE");
define("LANGattente2","Veuillez patienter, S.V.P.");
define("LANGattente3","L'Equipe TRIADE.");
define("LANGatte_mess1","TRIADE - Attente - Messagerie");
define("LANGatte_mess2","Veuillez patienter, S.V.P.");
define("LANGatte_mess3","service TRIADE");
define("LANGbasededon20","Envoyer le fichier");
define("LANGbasededon201","rien");
define("LANGbasededon2011","Importation de fichier GEP");
define("LANGbasededon202","Fichier Transmis -- L'�quipe TRIADE");
define("LANGbasededon203","Fichier non enregistr�");
define("LANGbasededon31","Indiquer pour chaque r�f�rence la classe correspondante");
define("LANGbasededon32","Choix ...");
define("LANGbasededon33","aucun");
define("LANGbasededon34","L'envoi du fichier peut durer de <b>2 � 4 minutes</b> en fonction du nombre d'".INTITULEELEVE."s.");
define("LANGbasededon35","Le fichier doit �tre au format <b>dbf</b> et doit �tre <b>F_ele.dbf</b>");
define("LANGbasededon41","Erreur sur le nombre de classes !!! - Contacter l'�quipe TRIADE <br /><br /> support@triade-educ.com</center>");
define("LANGbasededon42","Erreur sur la saisie des classes, une classe est r�p�t�e plusieurs fois -- L'�quipe TRIADE");
define("LANGbasededon43","Message du : ");
define("LANGbasededon44","De");
define("LANGbasededon45","Membre :");
define("LANGbasededon46","Message :");
define("LANGbasededon47","NOUVELLE BASE:");
define("LANGbasededon48","- avec GEP");
define("LANGbasededon49"," Etablissement :");
define("LANGbasededoni11","'Attention','./image/commun/warning.jpg','<font face=Verdana size=1><font color=red>L</font>e module <b>dbase</b> n\'est pas <br> charg� !! <i>N�cessaire pour importer <br> une base GEP.");
define("LANGbasededoni21","ATTENTION, la destruction de l\'ancienne base sera automatique. \\n Souhaitez-vous continuer ? \\n\\n L\'Equipe TRIADE");
define("LANGbasededoni31","Indiquer pour quelle cat�gorie le fichier est attribu� ");
define("LANGbasededoni32","L'import du fichier concerne : ");
define("LANGbasededoni33","Import des ".INTITULEELEVE."s : ");
define("LANGbasededoni34","Import des enseignants :");
define("LANGbasededoni35","Import du personnel vie scolaire : ");
define("LANGbasededoni36","Import du personnel administratif : ");
define("LANGbasededoni41","Classe ant�rieure");
define("LANGbasededoni42","Ann�e ant�rieure");
define("LANGbasededoni51","Pour l'intitul�");

define("LANGbasededoni61","erreur");
define("LANGbasededoni71","Importation du fichier ASCII");
define("LANGbasededoni72","Message du : ");
define("LANGbasededoni721","De");
define("LANGbasededoni722","Membre :");
define("LANGbasededoni723","Message :");
define("LANGbasededoni724","NOUVELLE BASE:");
define("LANGbasededoni725","- avec ASCII");
define("LANGbasededoni726"," Etablissement :");
define("LANGbasededoni73","Total d'enregistrements dans la base ");
define("LANGbasededoni91","Importation du fichier ASCII");
define("LANGbasededoni92","Erreur sur le nombre de classes !!! - Contacter le l'�quipe TRIADE <br />");
define("LANGbasededoni93","Erreur sur la saisie des classes, une classe est r�p�t�e plusieurs fois -- L'�quipe TRIADE");
define("LANGbasededoni94","Donn�e de la base trait�e -- L'�quipe TRIADE<br />");
define("LANGbasededoni95","Total d'".INTITULEELEVE."  enregistr� dans la base : ");
define("LANGPIEDPAGE","<p> La <b>T</b>ransparence et la <b>R</b>apidit� de l'<b>I</b>nformatique <b>A</b>u service <b>D</b>e l'<b>E</b>nseignement<br>Pour visualiser ce site de fa�on optimale :  r�solution minimale : 800x600 <br>  � 2000 - ".date("Y")." TRIADE - Tous droits r�serv�s");

define("LANGAPROPOS1","Version");
define("LANGAPROPOS2","Tous droits r&eacute;serv&eacute;s");
define("LANGAPROPOS3","Licence d'utilisation");
define("LANGAPROPOS4","Product ID");

define("LANGTELECHARGER","T�l�charger");
define("LANGAJOUT1","Pour le R�gime : choix possible (<b>INT</b> (Interne),<b>EXT</b> (Externe), <b>DP</b> (Demi Pension)<br><br>");
define("LANGIMP44","Le fichier n'est pas conforme.");
define("LANGBASE16"," Les colonnes sont repr�sent�es sous la forme : <b>nom de login ; pr�nom de login ; mot de passe Parent ; mot de passe ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." en clair ; classe de l'".INTITULEELEVE." </b>");


define("LANGSUPP0","Suppression d'un compte Suppl�ant");
define("LANGSUPP1","Module Suppression");
define("LANGSUPP2","Supprimer le compte");
define("LANGSUPP3","Voulez-vous supprimer de la liste des suppl�ants");
define("LANGSUPP3bis","rempla�ant de");
define("LANGSUPP4","Confirmer la suppression");
define("LANGSUPP5","Impossible de supprimer ce compte. \\n\\n Compte affect� � une classe.  \\n\\n  L'�quipe TRIADE");
define("LANGSUPP6","Compte supprim� - L'�quipe TRIADE");
define("LANGSUPP7","Suppression d'un groupe");
define("LANGSUPP8","Supprimer le groupe");
define("LANGSUPP9","Suppression d'un compte ");
define("LANGSUPP10","Supprimer le compte");
define("LANGSUPP11","un membre de la vie scolaire");
define("LANGSUPP12","un administrateur");
define("LANGSUPP13","un enseignant");
define("LANGSUPP14","Suppression d'un ".INTITULEELEVE." dans la  classe");
define("LANGSUPP15","Cliquer sur l'".INTITULEELEVE." � supprimer");
define("LANGSUPP16","Suppression d'un ".INTITULEELEVE."");
define("LANGSUPP17","va �tre supprim� de la base");
define("LANGSUPP18","Toutes les informations sur cet ".INTITULEELEVE." vont �tre supprim�es, � savoir : <br> (notes, absences, retards, dispences, sanctions, informations, messageries, ...)");
define("LANGSUPP19","Annuler la suppression");
define("LANGSUPP20","est supprim� de la base");
define("LANGSUPP21","Supprimer une classe");
define("LANGSUPP22","Suppression d'une classe");
define("LANGSUPP23","Suppression d'une mati�re ou sous-mati�re");
define("LANGSUPP24","Supprimer la mati�re");
define("LANGSUPP25","Classe supprim�e --  Service TRIADE");
define("LANGSUPP26","Mati�re supprim�e --  Service TRIADE");
define("LANGSUPP27","Cr�ation de la mati�re");
define("LANGSUPP28","Sous-mati�re enregistr�e");

define("LANGADMIN","Administration");
define("LANGPROF","Enseignant");
define("LANGSCOLAIRE","de la Vie Scolaire");
define("LANGCLASSE","une classe");


define("LANGGRP11","Nom du Groupe");
define("LANGGRP12","Classe(s) concern�e(s)");
define("LANGGRP13","Liste ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."s");
define("LANGGRP14","Liste des groupes");
define("LANGGRP15","Cr�ation d'un groupe");
define("LANGGRP16","Indiquez les ".INTITULEELEVE."s dans le groupe");
define("LANGGRP17","S�lectionner");
define("LANGGRP18","Enregistrer le groupe");
define("LANGGRP19","Cr�ation du groupe effectu�e");
define("LANGGRP20","Autre groupe");
define("LANGGRP21","Liste des groupes");
define("LANGGRP22","Indiquer une classe pour la cr�ation du groupe S.V.P. \\n\\n L'�quipe TRIADE");
define("LANGGRP23","Liste des ".INTITULEELEVE."s du groupe");
define("LANGGRP24","Liste des classes");
define("LANGGRP25","Liste des mati�res");



//----------------//
define("LANGDONNEENR","<font class=T2>Donn�e(s) Enregistr�e(s).</font>");

define("LANGABS47","Ajout d'une sanction disciplinaire");
define("LANGABS48"," a atteint ");
define("LANGABS48bis","fois la cat�gorie");
define("LANGABS49","dur�e");
define("LANGABS50"," Retenue  du ");
define("LANGABS51","T�l. Prof P�re ");
define("LANGABS52","T�l. Prof M�re ");
define("LANGABS53","Aucun retard ou absence signal�");

define("LANGCALRET1","Calendrier &nbsp; des &nbsp; Retenues");

define("LANGHISTO1","Historique des op�rations");

define("LANGDST9","Ajouter une entr�e");
define("LANGDST10","Supprimer une entr�e");
define("LANGDST11","en classe de");

define("LANGDISP11","Affichage <b>complet</B> des dispenses");

define("LANGEN","En");

define("LANGAFF4","Edition d'une classe");
define("LANGAFF5","Toutes les classes");
define("LANGAFF6","Consulter cette classe");

define("LANGCHER1","Recherche Complexe");
define("LANGCHER2","Indiquer le format de fichier � g�n�rer");
define("LANGCHER3","Indiquer le s�parateur de champs");
define("LANGCHER4","Effectuer la recherche d'un ".INTITULEELEVE." � partir du nom : <b>cliquez ici</b>");
define("LANGCHER5","Ajouter");
define("LANGCHER6","Enlever");
define("LANGCHER7","Monter");
define("LANGCHER8","Descendre");
define("LANGCHER9","Suivant");
define("LANGCHER10","El�ment recherch�");
define("LANGCHER11","Nombre de crit�res de recherche");
define("LANGCHER12","A partir de");

define("LANGCHER13","avec la valeur");
define("LANGCHER14","Recherche approximative");
define("LANGCHER15","Recherche pr�cise");
define("LANGCHER16","Lancer la recherche");
define("LANGCHER17","Attention: reste un �l�ment non choisi !! -- L'�quipe TRIADE ");

define("LANGCHER18","avec comme valeur");

define("LANGTITRE34","Configuration du courrier retard");
define("LANGTITRE35","Configuration du courrier absence");

define("LANGCONFIG1","Configuration enregistr�e.");
define("LANGCONFIG2","Voici votre texte ");

define("LANGCONFIG3","Indiquer la liste des parents d'".INTITULEELEVE."s qui recevront un courrier");

define("LANGERROR01","Erreur d'acc�s � la base");
define("LANGERROR02","ATTENTION Impossible <br><br>Le probl�me peut venir des informations saisies <br>(V�rifiez les diff�rents champs avant de valider).<BR>  <BR>Ou l'information est d�j� enregistr�e OU non accessible.");
define("LANGERROR03","Acc�s impossible � la base pour cette action . <BR>");

define("LANGABS54","est d�j� not� absent.");
define("LANGABS55","est d�j� not� en retard.");


define("LANGPARAM4","Le certificat est bien enregistr�.");
define("LANGPARAM5","Le certificat de scolarit� des ".INTITULEELEVE."s de la classe ");
define("LANGPARAM5bis","est disponible, au format PDF");
define("LANGPARAM6","Param�trage pour le contenu des bulletins et p�riodes");

define("LANGPARAM7","Nom  du directeur");
define("LANGPARAM8","Nom  de l'�tablissement");
define("LANGPARAM9","adresse");
define("LANGPARAM10","Code Postal");
define("LANGPARAM11","Ville");
define("LANGPARAM12","T�l�phone");
define("LANGPARAM13","E-mail");
define("LANGPARAM14","Logo �tablissement");
define("LANGPARAM15","Enregistrer les param�tres");
define("LANGPARAM16","Enregistrement effectu�. -- L'Equipe TRIADE");

define("LANGCERTIF1","Le certificat de scolarit� de ");
define("LANGCERTIF1bis","est disponible, au format PDF");


define("LANGRECHE1","Informations sur l'".INTITULEELEVE."");

define("LANGBT52","Modifier les donn�es");

define("LANGEDIT1","Donn�es introuvables");

define("LANGMODIF1","Mise � jour d'un compte ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
define("LANGMODIF2","Renseignements sur l'".INTITULEELEVE);
define("LANGMODIF3","Renseignements sur la famille");

define("LANGALERT1","Donn�es mises � jour -- Equipe TRIADE");
define("LANGALERT2","Attention format du fichier non conforme ou taille non respect�e");
define("LANGALERT3","Attention format du fichier non conforme ou taille non respect�e");

define("LANGLOGO1","Logo � transmettre");
define("LANGLOGO2","Enregistrer le logo");
define("LANGLOGO3","Le logo <b>doit �tre au format jpg</b> et de taille 96px sur 96px.");

define("LANGPARAM17","D�finition des p�riodes trimestrielles ou semestrielles");
define("LANGPARAM18","Trimestre ou Semestre");
define("LANGPARAM19","Date de d�but");
define("LANGPARAM20","Date de fin");
define("LANGPARAM21","Premier");
define("LANGPARAM22","Deuxi�me");
define("LANGPARAM23","Troisi�me");
define("LANGPARAM24","Enregistrer les dates trimestrielles");
define("LANGPARAM25","Donn�e prise en compte, si l'enregistrement est au format Trimestriel");
define("LANGPARAM26","Date non valide -- Equipe TRIADE");
define("LANGPARAM27","Informations Enregistr�es -- Equipe TRIADE");
define("LANGPARAM28","trimestre");
define("LANGPARAM29","semestre");
define("LANGPARAM30","Bulletin");


define("LANGBULL5","Impression de bulletin");
define("LANGBULL6","Continuer le traitement");
define("LANGBULL7","Impression de p�riode");
define("LANGBULL8","Indiquez le d�but de la p�riode");
define("LANGBULL9","Indiquez la fin de la p�riode");
define("LANGBULL10","Indiquez la p�riode");
define("LANGBULL11","Indiquez la section");
define("LANGBULL12","Imprimer la p�riode");
define("LANGBULL13","Historique");
define("LANGBULL14","<FONT COLOR='red'>ATTENTION</FONT></B> Besoin de l'outil <B>Adobe Acrobat Reader</B>.  Logiciel et t�l�chargement Gratuits ");
define("LANGBULL14bis","T�l�chargement");
define("LANGBULL15","Visualiser / Supprimer");
define("LANGBULL16","Nom de l'".INTITULEELEVE);
define("LANGBULL17","Professeur");
define("LANGBULL18","D�tail des notes");
define("LANGBULL19","Appr�ciation du Professeur Principal");
define("LANGBULL20","RELEVE DE NOTES");
define("LANGBULL21","p�riode");

define("LANGBULL22","premier trimestre");
define("LANGBULL23","deuxi�me trimestre");
define("LANGBULL24","troisi�me trimestre");

define("LANGBULL25","premier semestre");
define("LANGBULL26","deuxi�me semestre");

define("LANGBULL27","Bulletin du ");
define("LANGBULL28","Section");
define("LANGBULL29","Ann�e Scolaire");

define("LANGBULL30","BULLETIN");

define("LANGBULL31","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
define("LANGBULL32","Mati�res");
define("LANGBULL33","Classe");
define("LANGBULL34","Appr�ciations, progr�s, conseils pour progresser");

define("LANGBULL35","Coef");
define("LANGBULL36","Moy");
define("LANGBULL37","Mini");
define("LANGBULL38","Maxi");
define("LANGBULL39","Assiduit� et comportement au sein de l'�tablissement : ");
define("LANGBULL40","Appr�ciation globale de l'�quipe p�dagogique : ");
define("LANGBULL41","Bulletin � conserver pr�cieusement");
define("LANGBULL42","Visa du chef d'�tablissement ou de son d�l�gu�");
define("LANGBULL43","ANNEE SCOLAIRE");
define("LANGBULL44","M. & Mme");
define("LANGOU","ou"); // le ou de ou bien


define("LANGPROJ19","Semestre 1");
define("LANGPROJ20","Semestre 2");

define("LANGDISC1","Retenue  du ");
define("LANGDISC2","Imprimer les retenues du jour");


define("LANGDISC3","T�l. Dom. ");
define("LANGDISC4","T�l. Prof. P�re ");
define("LANGDISC5","T�l. Prof. M�re ");
define("LANGDISC6","Mise en place d'une sanction en  Classe de ");
define("LANGDISC7","Intitul� de la cat�gorie ");
define("LANGDISC8","Intitul� de la sanction ");
define("LANGDISC9","Attribu� par ");
define("LANGDISC10","Motif, informations, devoir � faire ");
define("LANGDISC11","Retenue");
define("LANGDISC11bis","Le");  // Le pour indiquer une date
define("LANGDISC11Ter","A");  // A pour indiquer une heure
define("LANGDISC12","dur�e");
define("LANGDISC13","<font color=red>C</font></B>ochez la case si l\'".INTITULEELEVE." est soit en retenue soit sanctionn�.");
define("LANGDISC14","Ajout d'une sanction disciplinaire");
define("LANGDISC15","<B>*<I> D</B>: T�l�phone Domicile, <B>P</B>: T�l�phone Profession P�re, <B>M</B>: T�l�phone Profession M�re</I>");
define("LANGDISC16","Effectuer");
define("LANGDISC17","T�l.");
define("LANGDISC18","Affichage  des Sanctions");
define("LANGDISC19","Affichage des <b>5</B> derni�res sanctions");
define("LANGDISC20","Cat�gorie");
define("LANGDISC21","Liste compl�te de ");
define("LANGDISC22","Visualiser les retenues de ");
define("LANGDISC23","Affichage des retenues");
define("LANGDISC24","Affichage  <b>complet</B> des retenues");
define("LANGDISC25","En&nbsp;retenue");
define("LANGDISC26","Retenue non effectu�e");
define("LANGDISC27","Lister les sanctions de ");
define("LANGDISC28","Affichage   des Sanctions");
define("LANGDISC29","Affichage  <b>complet</B> des sanctions");
define("LANGDISC30","Saisie&nbsp;le");
define("LANGDISC31","Lister les sanctions de ");
define("LANGDISC32","Retenue non affect�e � un �l�ve ");
define("LANGDISC33","ATTENTION l'".INTITULEELEVE." ");
define("LANGDISC33bis"," est d�j� en retenue pour la date et l'heure indiqu�e. ");
define("LANGDISC34","a atteint");
define("LANGDISC34bis","fois la cat�gorie");
define("LANGDISC35","Suppression Sanction");
define("LANGDISC36","Suppression Retenue");

define("LANGattente222","Patientez");



define("LANGSUPP","Supp"); // abr�viation de Supprimer



define("LANGCIRCU1","Gestion des Circulaires administratives");
define("LANGCIRCU2","Ajouter une circulaire");
define("LANGCIRCU3","Lister des circulaires");
define("LANGCIRCU4","Supprimer une circulaire");
define("LANGCIRCU5","Ajout de circulaires administratives");
define("LANGCIRCU6","Sujet");
define("LANGCIRCU7","R�f�rence");
define("LANGCIRCU8","Circulaire");
define("LANGCIRCU9","Corps Enseignant");
define("LANGCIRCU10","Dans la ou les classe(s)");
define("LANGCIRCU11","<font face=Verdana size=1><B><font color=red>C</font></B>irculaire au format : <b>doc</b>, <b>pdf</b>, <b>txt</b>, <b>Office</b>.</FONT>");
define("LANGCIRCU12","<font face=Verdana size=1><B><font color=red>C</font></B>irculaire visible par les enseignants.</FONT>");
define("LANGCIRCU13","Toutes les classes");
define("LANGCIRCU14","Retour au Menu");
define("LANGCIRCU15","Enregistrer la circulaire");
define("LANGCIRCU16","Circulaire non enregistr�e");
define("LANGCIRCU17","Le fichier doit �tre au format <b>txt ou doc ou pdf</b> et inf�rieur � 2Mo ");
define("LANGCIRCU18","<font class=T2>Circulaire enregistr�e</font>");
define("LANGCIRCU19","Supprimer des Circulaires administratives");
define("LANGCIRCU20","Acc�s Fichier");
define("LANGCIRCU21","<font color=red>R</b></font><font color=#000000>�f�rence");

define("LANGCODEBAR1","Gestion des codes barres");
define("LANGCODEBAR2","Ce module ne fonctionne pas avec votre serveur. <br> Vous devez avoir PHP 5 ou supp pour utiliser ce module.");
define("LANGCODEBAR3","Voici la liste des codes barres accessible par TRIADE");
define("LANGCODEBAR4","Le code barre utilis� par d�faut est le ");
define("LANGCODEBAR5","Liste");


define("LANGPUB1","Ajout d'une banni�re de publicit�");
define("LANGPUB2","Vous d�sirez publier sur le site de TRIADE");
define("LANGPUB3","Effectuer une campagne publicitaire");
define("LANGPUB4","Pour cela  ");
define("LANGPUB5","Vous �tes d�j� annonceur sur TRIADE ");

define("LANGPROFB1","Appr�ciation pour les bulletins trimestriels");
define("LANGPROFB2","Param�trage de vos commentaires automatis�s");
define("LANGPROFB3","Param�trage");
define("LANGPROFB4","Configuration Commentaires Bulletins");
define("LANGPROFB5","Enregistrement des commentaires");
define("LANGPROFB6","Commentaire");
define("LANGPROFB7","Liste");


define("LANGPROFC1","Calendrier du planning d'�quipement");
define("LANGPROFC2","Calendrier du planning des salles");


define("LANGPARAM31","Visualisation en mode U.S.A.");
define("LANGPARAM32","Assiduit� et comportement au sein de l'�tablissement : ");
define("LANGPARAM33","R�cup�rer le fichier PDF");

define("LANGDISC37","Ajout d'une sanction disciplinaire");

define("LANGPROFP4","<b>Professeur Principal</b> en ");
define("LANGPROFP5","Informations sur l'".INTITULEELEVE);
define("LANGPROFP6","Informations du ");
define("LANGPROFP7","jusqu'au ");

define("LANGPROFP8","Nombre total de retards");
define("LANGPROFP9","Nombre de retards ce trimestre");
define("LANGPROFP10","Nombre total d'absences");
define("LANGPROFP11","Nombre d'absences ce trimestre");

define("LANGPROFP12","Gestion des d�l�gu�s");
define("LANGPROFP13"," en classe de ");
define("LANGPROFP14","Parent d�l�gu�");
define("LANGPROFP15","Coordonn�es");
define("LANGPROFP16","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." d�l�gu�");
define("LANGPROFP17","Parent(s) d�l�gu�(s)");
define("LANGPROFP18","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."(s) d�l�gu�(s)");
define("LANGPROFP19","T�l."); // pour t�l�phone
define("LANGPROFP20","Mail");
define("LANGPROFP21","Compl�ment d'informations m�dicales sur l'".INTITULEELEVE);

define("LANGETUDE1","Gestion des �tudes");
define("LANGETUDE2","Affectation des ".INTITULEELEVE."s � l'�tude");
define("LANGETUDE3","Consulter la liste des �tudes affect�es");
define("LANGETUDE4","Ajouter une �tude");
define("LANGETUDE5","Modifier une �tude");
define("LANGETUDE6","Supprimer une �tude");
define("LANGETUDE7","Consultation d'une �tude");
define("LANGETUDE8","Affecter un ".INTITULEELEVE." � une �tude");
define("LANGETUDE9","Modifier un ".INTITULEELEVE." � une �tude");
define("LANGETUDE10","Supprimer un ".INTITULEELEVE." d'une �tude");
define("LANGETUDE11","Liste des �tudes");

define("LANGETUDE12","Surveillant");
define("LANGETUDE13","Etude");
define("LANGETUDE14","En salle");
define("LANGETUDE15","Semaine");
define("LANGETUDE16","Le");  		// Le indique une date
define("LANGETUDE17","�");  		// � indique une heure
define("LANGETUDE18","pendant");  	//indique une dur�e
define("LANGETUDE19","Cr�ation d'une �tude");
define("LANGETUDE20","Nom de l'�tude");
define("LANGETUDE21","Jour de la semaine");
define("LANGETUDE22","L'heure d'�tude");
define("LANGETUDE23","Dur�e de l'�tude");
define("LANGETUDE24","hh:mm");
define("LANGETUDE25","Salle d'�tude");
define("LANGETUDE26","Surveillant de cette �tude");
define("LANGETUDE27","L'�tude est enregistr�e");
define("LANGETUDE28","Liste des �tudes");
define("LANGETUDE29","Modification d'une �tude");
define("LANGETUDE30","L'�tude poss�de des ".INTITULEELEVE."s. Supprimer la liste des ".INTITULEELEVE."s de l'�tude avant de supprimer l'�tude");
define("LANGETUDE31","Liste ".INTITULEELEVE);
define("LANGETUDE32","Liste des ".INTITULEELEVE."s");
define("LANGETUDE33","Affectation d'un ".INTITULEELEVE." � une �tude");
define("LANGETUDE34","Choix de l'�tude");
define("LANGETUDE35","Indiquer les classes pour l'affectation des ".INTITULEELEVE."s � cette �tude");
define("LANGETUDE36","Intitul� de l'�tude");
define("LANGETUDE37","Indiquez les ".INTITULEELEVE."s dans cette �tude");
define("LANGETUDE38","autoris� � sortir");
define("LANGETUDE39","Enregistrer l'�tude");
define("LANGETUDE40","Autre �tude");
define("LANGETUDE41","Modifier l'�tude d'un ".INTITULEELEVE);
define("LANGETUDE42","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." en �tude");
define("LANGETUDE43","Enregister les modifications");
define("LANGETUDE44","Sortie autoris�e");
define("LANGETUDE45","Supprimer l'�tude d'un ".INTITULEELEVE);

define("LANGLIST1","Edition d'une classe");
define("LANGLIST2","Liste des enseignants de la classe");
define("LANGLIST3","Professeur Principal");
define("LANGLIST4","Date");
define("LANGLIST5","Liste compl�te au format PDF");
define("LANGLIST6","Professeur Principal");


define("LANGPASS1","Nouveau mot de passe");

define("LANGTRONBI1","Visualisation Trombinoscope des ".INTITULEELEVES);
define("LANGTRONBI2","Modifier Trombinoscope des ".INTITULEELEVES);
define("LANGTRONBI3","Attention format du fichier non conforme");
define("LANGTRONBI4","Impossible photo de taille non conforme");
define("LANGTRONBI5","Nom ".INTITULEELEVE);
define("LANGTRONBI6","Pr�nom ".INTITULEELEVE);
define("LANGTRONBI7","la photo");
define("LANGTRONBI8","ajouter photo");


define("LANGBASE19","Le fichier s�lectionn� n'est pas valide");
define("LANGBASE20","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." sans classe");
define("LANGBASE21","Nombre d'".INTITULEELEVE."s sans classe");
define("LANGBASE22","Affichage des 30 premiers");
define("LANGBASE23","Changement de classe pour les ".INTITULEELEVE."s");
define("LANGBASE24","Changement Termin�");
define("LANGBASE25","AVANT TOUTES MODIFICATIONS CONSULTER NOTRE AIDE");
define("LANGBASE26","Changement de classe pour les ".INTITULEELEVE."s de la classe");
define("LANGBASE27","Information sur le changement de classe d'un ".INTITULEELEVE);
define("LANGBASE28","<b>Pas de changement.</b> <i>(Avec l'option 'choix ...')</i>");
define("LANGBASE29","Aucune suppression d'information de l'".INTITULEELEVE." n'est r�alis�e.");
define("LANGBASE30","<b>Le changement de classe.</b> <i>(Avec indication d'une classe)</i>");
define("LANGBASE31","Suppression notes, abs, retards, disciplines, dispenses  de l'".INTITULEELEVE.".");
define("LANGBASE32","<b>Quitte l'�cole.</b>  <i>(Avec l'option 'Quitte l'�cole')</i>");
define("LANGBASE33","Suppression de l'".INTITULEELEVE." dans la base.");
define("LANGBASE34","Suppression notes, abs, retards, disciplines, dispenses de l'".INTITULEELEVE.".");
define("LANGBASE35","Suppression messages internes de la famille.");
define("LANGBASE36","Va en classe de");
define("LANGBASE37","Quitte l'�cole");
define("LANGBASE38","Valider le(s) changement(s)");
define("LANGBASE39","Choisissez un �l�ment");


define("LANGBASE40","Choix du ");


// MODULE AGENDA 
define("LANGAGENDA1","Attention!!!\nLa note que vous venez de cr�er ou de modifier se superpose\navec une autre note pour les utilisateurs suivants");
define("LANGAGENDA2","Voulez-vous supprimer cette note qui vous a �t� affect�e ?");
define("LANGAGENDA3","Suppression d'une note, rappel :\\n\\n - Toutes les occurences d�coulant de cette note seront �galement effac�es\\n - Pour supprimer juste une occurence, cliquez sur l'image correspondante � droite de la note dans les planning\\n\\nVoulez vous supprimer cette note ?");
define("LANGAGENDA4","Suppression d'une occurence, rappel :\\n\\n - Seule cette occurence sera supprim�e\\n - Pour supprimer une note r�currente et toutes ses occurences, cliquez sur la croix � droite de la note dans les plannings ou �ditez la note et cliquez sur le bouton [Supprimer]\\n\\nVoulez-vous supprimer cette occurence ?");
define("LANGAGENDA5","Note avec rappel");
define("LANGAGENDA6","Supprimer une occurence");
define("LANGAGENDA7","Supprimer une note");
define("LANGAGENDA8","S'approprier une note");
define("LANGAGENDA9","Afficher le d�tail");
define("LANGAGENDA10","Note personnelle");
define("LANGAGENDA11","Note affect�e");
define("LANGAGENDA12","Note Active");
define("LANGAGENDA13","Note Termin�e");
define("LANGAGENDA14","Jour courant");
define("LANGAGENDA15","Jour f�ri�");
define("LANGAGENDA16","Cr�er une note");
define("LANGAGENDA17","cliquer pour changer");
define("LANGAGENDA18","Enregistrer une date d'anniversaire");
define("LANGAGENDA19","Modification d'une date d'anniversaire");
define("LANGAGENDA20","Veuillez saisir le nom de la personne");
define("LANGAGENDA21","Veuillez saisir la date de naissance de la personne");
define("LANGAGENDA22","Anniversaire de");
define("LANGAGENDA23","Date de naissance");
define("LANGAGENDA24","Format jj/mm/aaaa");
define("LANGAGENDA25","Supprimer cet anniversaire ?");
define("LANGAGENDA26","Supprimer");
define("LANGAGENDA27","Annuler");
define("LANGAGENDA28","Enregistrer");
define("LANGAGENDA29","Etes-vous s�r de vouloir effacer cet anniversaire ?");
define("LANGAGENDA30","Modifier");
define("LANGAGENDA31","Ann�e pr�c.");
define("LANGAGENDA32","Mois pr�c.");
define("LANGAGENDA33","Atteindre la date du jour");
define("LANGAGENDA34","maintenir pour menu");
define("LANGAGENDA35","Mois suiv.");
define("LANGAGENDA36","Ann�e suiv.");
define("LANGAGENDA37","S�lectionner une date");
define("LANGAGENDA38","D�placer");
define("LANGAGENDA39","Aujourd'hui");
define("LANGAGENDA40","A propos du calendrier");
define("LANGAGENDA41","Afficher %s en premier");
define("LANGAGENDA42","Fermer");
define("LANGAGENDA43","Cliquer ou glisser pour modifier la valeur");
define("LANGAGENDA44","Utilisateur inconnu");
define("LANGAGENDA45","Votre session a expir� !");
define("LANGAGENDA46","Ce login est d�j� utilis�");
define("LANGAGENDA47","Ancien mot de passe erron�");
define("LANGAGENDA48","Veuillez vous identifier pour utiliser Phenix");
define("LANGAGENDA49","La connexion au serveur SQL a �chou�");
define("LANGAGENDA50","Profil modifi�");
define("LANGAGENDA51","Note enregistr�e");
define("LANGAGENDA52","Note mise � jour");
define("LANGAGENDA53","Note supprim�e");
define("LANGAGENDA54","Occurence de la note supprim�e");
define("LANGAGENDA55","Anniversaire enregistr�");
define("LANGAGENDA56","Anniversaire mis � jour");
define("LANGAGENDA57","Anniversaire supprim�");
define("LANGAGENDA58","Compte cr��, vous pouvez vous connecter");
define("LANGAGENDA59","L'enregistrement a �chou�");
define("LANGAGENDA60","Tous les champs");
define("LANGAGENDA61","Soci�t�");
define("LANGAGENDA62","Nom + Pr�nom");
define("LANGAGENDA63","Adresse");
define("LANGAGENDA64","Num�ro de t�l�phone");
define("LANGAGENDA65","Adresse Email");
define("LANGAGENDA66","Commentaires");
define("LANGAGENDA67","Lancer la recherche");
define("LANGAGENDA68","Soci�t�");
define("LANGAGENDA69","Nom");
define("LANGAGENDA70","Pr�nom");
define("LANGAGENDA71","Adresse");
define("LANGAGENDA72","Ville");
define("LANGAGENDA73","Pays");
define("LANGAGENDA74","T�l. Domicile");
define("LANGAGENDA75","T�l. Travail");
define("LANGAGENDA76","T&eacute;l.&nbsp;Portable");
define("LANGAGENDA77","Fax");
define("LANGAGENDA78","Email");
define("LANGAGENDA79","Email Pro");
define("LANGAGENDA80","Note / Divers");
define("LANGAGENDA81","Groupe");
define("LANGAGENDA82","Partage");
define("LANGAGENDA83","CP");
define("LANGAGENDA84","Date de naissance");
define("LANGAGENDA85","Recommencer");
define("LANGAGENDA86","Importer");
define("LANGAGENDA87","Import termin�");
define("LANGAGENDA88","contact(s) ajout�(s)");
define("LANGAGENDA89","Pas de contact disponible !");
define("LANGAGENDA90","<LI>Dans Outlook, faire <I>Fichier</I>-&gt;<I>Exporter</I>-&gt;<I>Autre carnet d'adresses...</I></LI>");
define("LANGAGENDA91","<LI>Choisir <I>Fichier texte (valeurs s�par�es par des virgules)</I> puis <I>Exporter</I></LI>");
define("LANGAGENDA92","<LI>Choisir l'endroit o&ugrave; le fichier sera sauvegard� puis <I>Suivant</I></LI>");
define("LANGAGENDA93","<LI>Dans la liste des champs � exporter, s�lectionner :<BR>");
define("LANGAGENDA94","<I>Pr�nom, Nom, Adresse de messagerie, Rue (domicile), Ville (domicile), Code Postal (domicile), Pays/r�gion (domicile), T�l�phone personnel, T�l�phone mobile, T�l�phone professionnel, T�l�copie professionnelle, Soci�t�</I> puis cliquer sur <I>Terminer</I></LI>");
define("LANGAGENDA95","<LI>R�cup�rer le fichier ainsi cr�� dans le formulaire ci-dessous et cliquer sur <I>Importer</I></LI>");
define("LANGAGENDA96","Veuillez entrer une soci�t� pour la recherche");
define("LANGAGENDA97","Veuillez entrer un nom ou un pr�nom pour la recherche");
define("LANGAGENDA98","Veuillez entrer une adresse pour la recherche");
define("LANGAGENDA99","Veuillez entrer un num�ro de t�l�phone pour la recherche");
define("LANGAGENDA100","Veuillez entrer une adresse Email pour la recherche");
define("LANGAGENDA101","Veuillez saisir une bribe de commentaire pour la recherche");
define("LANGAGENDA102","Veuillez entrer au moins un crit�re pour la recherche");
define("LANGAGENDA103","Etes-vous s�r de vouloir effacer ce contact ?");
define("LANGAGENDA104","Ann�e");
define("LANGAGENDA105","Pas de p�re");
define("LANGAGENDA106","Liste des personnes<BR>� qui vous pouvez<BR>affecter une note");
define("LANGAGENDA107","Personne(s) possible(s)");
define("LANGAGENDA108","Personne(s) s�lectionn�e(s)");
define("LANGAGENDA109","Pr�cision d'affichage");
define("LANGAGENDA110","Tranche de 30mn");
define("LANGAGENDA111","Tranche de 15mn");
define("LANGAGENDA112","Heure de d�but");
define("LANGAGENDA113","Heure de fin");
define("LANGAGENDA114","Occup�");
define("LANGAGENDA115","Partiel");
define("LANGAGENDA116","Libre");
define("LANGAGENDA117","Cr�er une note entre ");
define("LANGAGENDA118","D�tail par utilisateur de cette journ�e");
define("LANGAGENDA119","Afficher");
define("LANGAGENDA120","Veuillez s�lectionner une personne");
define("LANGAGENDA121","Veuillez s�lectionner une heure de fin post�rieure � l'heure de d�but");
define("LANGAGENDA122","Semaine du ");
define("LANGAGENDA123","au");
define("LANGAGENDA124","Semaine suivante");
define("LANGAGENDA125","Enlever");
define("LANGAGENDA126","Disponibilit�s de vos contacts pour le ");
define("LANGAGENDA127","Ajouter");
define("LANGAGENDA128","Hors Profil");
define("LANGAGENDA129","Veuillez s�lectionner une heure de fin post�rieure � l'heure de d�but");
define("LANGAGENDA130","Pr�cision d'affichage");
define("LANGAGENDA131","Veuillez saisir un nom");
define("LANGAGENDA132","Veuillez saisir une URL");
define("LANGAGENDA133","Ajouter un favori");
define("LANGAGENDA134","Impression en mode paysage conseill�e");
define("LANGAGENDA135","Semaine pr�c�dente ");
define("LANGAGENDA136","Semaine ");
define("LANGAGENDA137","du");
define("LANGAGENDA138","Anniversaire");
define("LANGAGENDA139","Rappel par d�faut � la cr�ation d'une note");
define("LANGAGENDA140","Pas de rappel");
define("LANGAGENDA141","Rappel");
define("LANGAGENDA142","copie par mail");
define("LANGAGENDA143","minute(s)");
define("LANGAGENDA144","heure(s)");
define("LANGAGENDA145","jour(s)");
define("LANGAGENDA146","Journ�e type");
define("LANGAGENDA147","Termine �");
define("LANGAGENDA148","T�l�phone VF");
define("LANGAGENDA149","Interface");
define("LANGAGENDA150","Planning par d�faut");
define("LANGAGENDA151","Quotidien");
define("LANGAGENDA152","Hebdomadaire");
define("LANGAGENDA153","Mensuel");
define("LANGAGENDA154","30 minutes");
define("LANGAGENDA155","15 minutes");
define("LANGAGENDA156","45 minutes");
define("LANGAGENDA157","1 heure");
define("LANGAGENDA158","S�lection automatique de l'heure de fin d'une note");
define("LANGAGENDA159","Partage du planning<BR>en consultation");
define("LANGAGENDA160","Personnes autoris�es � consulter mon planning");
define("LANGAGENDA161","Non partag�");
define("LANGAGENDA162","Au choix");
define("LANGAGENDA163","Tout le monde");
define("LANGAGENDA164","Partage du planning<BR>en modification");
define("LANGAGENDA165","Personne(s) pouvant m'affecter une note");
define("LANGAGENDA166","M'informer par mail lorsqu'une note m'est affect�e");
define("LANGAGENDA167","Supprimer cette note que j'ai cr��e");
define("LANGAGENDA168","Supprimer cette note que l'on m'a affect�e");
define("LANGAGENDA169","M'approprier cette note qui m'a �t� affect�e");
define("LANGAGENDA170","Toute la journ�e");
define("LANGAGENDA171","Choix du libell�");
define("LANGAGENDA172","Nouveau libell�");
define("LANGAGENDA173","Intitul�");
define("LANGAGENDA174","Dur�e moyenne");
define("LANGAGENDA175","Couleur");
define("LANGAGENDA176","Apparence de la note");
define("LANGAGENDA177","Supprimer ce libell� ?");
define("LANGAGENDA178","Enregistrer un m�mo");
define("LANGAGENDA179","Veuillez saisir un titre");
define("LANGAGENDA180","Titre");
define("LANGAGENDA181","Contenu");
define("LANGAGENDA182","Etes-vous s�r de vouloir effacer ce m�mo ?");
define("LANGAGENDA183","Enregistrer une note");
define("LANGAGENDA184","La note que vous souhaitez modifier appartient � une s�rie r�currente");
define("LANGAGENDA185","Souhaitez-vous modifier toute la s�rie ou uniquement cette occurence ?");
define("LANGAGENDA186","Toute la s�rie");
define("LANGAGENDA187","Uniquement cette occurence");
define("LANGAGENDA188","Note couvrant toute la journ�e");
define("LANGAGENDA189","Afficher le calendrier");
define("LANGAGENDA190","Toute la journ�e");
define("LANGAGENDA191","D�bute �");  // D�but �
define("LANGAGENDA192","Personne<BR>concern�e");
define("LANGAGENDA193","Apparence de la note");
define("LANGAGENDA194","Note publique");
define("LANGAGENDA195","note d�taill�e dans le partage de planning");
define("LANGAGENDA196","mention \"Occup�\" dans le partage de planning");
define("LANGAGENDA197","Note priv�e");
define("LANGAGENDA198","Occup�(e)");
define("LANGAGENDA199","consid�rer comme <B>non disponible</B> dans le module des disponibilit�s");
define("LANGAGENDA200","Libre");
define("LANGAGENDA201","consid�rer comme <B>libre</B> dans le module des disponibilit�s");
define("LANGAGENDA202","Couleur");
define("LANGAGENDA203","Partage");
define("LANGAGENDA204","Disponibilit�");
define("LANGAGENDA205","Rappel");
define("LANGAGENDA206","Pas de rappel");
define("LANGAGENDA207","copie par mail");
define("LANGAGENDA208","� l'avance");  // � l'avance
define("LANGAGENDA209","P�riodicit�");
define("LANGAGENDA210","Aucune");
define("LANGAGENDA211","Quotidienne");
define("LANGAGENDA212","Hebdomadaire");
define("LANGAGENDA213","Mensuelle");
define("LANGAGENDA214","Annuelle");
define("LANGAGENDA215","Tous les ");
define("LANGAGENDA215bis","jours");
define("LANGAGENDA216","Tous les jours ouvrables (Lundi au Vendredi)");
define("LANGAGENDA217","Tous les jours de ma semaine type");
define("LANGAGENDA218","Les informations saisies ou modifi�es ne seront pas enregistr�es\\nEtes-vous s�r de vouloir continuer ?");
define("LANGAGENDA219","profil");
define("LANGAGENDA220","Tous les ");
define("LANGAGENDA221","Toutes les ");
define("LANGAGENDA221bis","semaines");
define("LANGAGENDA222","de chaque mois");
define("LANGAGENDA223","premier");
define("LANGAGENDA224","deuxi�me");
define("LANGAGENDA225","troisi�me");
define("LANGAGENDA226","quatri�me");
define("LANGAGENDA227","dernier");
define("LANGAGENDA228","du mois");
define("LANGAGENDA229","Le ");
define("LANGAGENDA230","D�finir la date de fin");
define("LANGAGENDA231","Fin apr�s"); // Fin apr�s
define("LANGAGENDA232","Fin le");
define("LANGAGENDA233","occurence(s)");
define("LANGAGENDA234","Veuillez saisir un libell�");
define("LANGAGENDA235","Veuillez saisir une date");
define("LANGAGENDA236","Veuillez s�lectionner une heure de fin\\npost�rieure � l'heure de d�but");  // \\n signifie un retour chariot
define("LANGAGENDA237","Veuillez s�lectionner une personne");
define("LANGAGENDA238","Veuillez saisir un nombre de jours\\nsup�rieur ou �gal � 1");
define("LANGAGENDA239","Veuillez saisir un nombre d'occurences\\nsup�rieur ou �gal � 1");
define("LANGAGENDA240","R�p�tition"); // r�p�tition
define("LANGAGENDA241","Veuillez saisir votre nom et votre pr�nom au pr�alable");
define("LANGAGENDA242","Veuillez saisir votre Pr�nom");
define("LANGAGENDA243","Vous devez saisir votre login");
define("LANGAGENDA244","Veuillez saisir votre ancien mot de passe");
define("LANGAGENDA245","Mots de passe diff�rents");
define("LANGAGENDA246","Un mot de passe est obligatoire");
define("LANGAGENDA247","Veuillez s�lectionner une heure de fin\\npost�rieure � l'heure de d�but");
define("LANGAGENDA248","Supprimer cette occurence");
define("LANGAGENDA249","Note r�curente");
define("LANGAGENDA250","Supprimer cette note que j'ai cr��e");
define("LANGAGENDA251","M'approprier cette note qui m'a �t� affect�e");
define("LANGAGENDA252","Filtrer");
define("LANGAGENDA253","Imprimer ce planning");
define("LANGAGENDA254","Impression en mode paysage conseill�e");
define("LANGAGENDA255","Note cr��e par ");
define("LANGAGENDA256","Changer le statut");
define("LANGAGENDA257","Supprimer cette occurence");
define("LANGAGENDA258","Supprimer cette note que j'ai cr��e");
define("LANGAGENDA259","Supprimer cette note que l'on m'a affect�e");
define("LANGAGENDA260","une note");
define("LANGAGENDA261","un anniversaire");
define("LANGAGENDA262","un contact");
define("LANGAGENDA263","A l'utilisateur s�lectionn� ci-dessous");
define("LANGAGENDA264","Ajouter une note");
define("LANGAGENDA265","Recherche");
define("LANGAGENDA266","Disponibilit�s");
define("LANGAGENDA267","Contacts");
define("LANGAGENDA268","M�mo");
define("LANGAGENDA269","Libell�s");
define("LANGAGENDA270","Favoris");
define("LANGAGENDA271","Profil");
define("LANGAGENDA272","Echec cr�ation export");
define("LANGAGENDA273","Agenda de ");
// FIN AGENDA

define("LANGL","L");  // L de lundi
define("LANGM","M");  // M de mardi
define("LANGME","M");  // M de mercredi
define("LANGJ","J");  // J de jeudi
define("LANGV","V");  // V de vendredi
define("LANGS","S");  // S de samedi
define("LANGD","D");  // D de dimanche

define("LANGL1","Lun"); // Jours sur 3 lettres
define("LANGM1","Mar");	// Jours sur 3 lettres
define("LANGME1","Mer"); // Jours sur 3 lettres
define("LANGJ1","Jeu");	// Jours sur 3 lettres
define("LANGV1","Ven");	// Jours sur 3 lettres
define("LANGS1","Sam");	// Jours sur 3 lettres
define("LANGD1","Dim");	// Jours sur 3 lettres

define("LANGMOIS21","Janv");			// mois abreg�
define("LANGMOIS22","F�v"); 		// mois abreg�
define("LANGMOIS23","Mars");			// mois abreg�
define("LANGMOIS24","Avr");				// mois abreg�
define("LANGMOIS25","Mai");				// mois abreg�
define("LANGMOIS26","Juin");			// mois abreg�
define("LANGMOIS27","Juil");			// mois abreg�
define("LANGMOIS28","Ao&ucirc;t");		// mois abreg�
define("LANGMOIS29","Sept");			// mois abreg�
define("LANGMOIS210","Oct");			// mois abreg�
define("LANGMOIS211","Nov"); 			// mois abreg�
define("LANGMOIS212","D�c"); 	// mois abreg�



define("LANGPROFP22","Cet enseignant est d�j� assign� comme professeur principal. \\n\\n L'Equipe TRIADE");



define("LANGSTAGE23","Nom de l'activit�");
define("LANGSTAGE24","Enregistrer une nouvelle entreprise");
define("LANGSTAGE25","Le nom de cette entreprise est d�j� enregistr�");
define("LANGSTAGE26","Nom de l'entreprise");
define("LANGSTAGE27","Contact");
define("LANGSTAGE28","Adresse");
define("LANGSTAGE29","Code Postal");
define("LANGSTAGE30","Ville");
define("LANGSTAGE31","Secteur Activit�");
define("LANGSTAGE32","ajouter activit�");
define("LANGSTAGE33","Activit� principale");
define("LANGSTAGE34","T�l�phone");
define("LANGSTAGE35","Fax");
define("LANGSTAGE36","Email");
define("LANGSTAGE37","Informations");
define("LANGSTAGE38","Consultation des entreprises");
define("LANGSTAGE39","Soci�t�");
define("LANGSTAGE40","Activit� principale");
define("LANGSTAGE41","Autre recherche");
define("LANGSTAGE42","T�l. / Fax");
define("LANGSTAGE43","Aucune entreprise pour ce nom");
define("LANGSTAGE44","Planification des stages");
define("LANGSTAGE45","Date de d�but de stage");
define("LANGSTAGE46","Date de fin de stage");
define("LANGSTAGE47","Enregistrer le stage");
define("LANGSTAGE48","Num�ro du stage");
define("LANGSTAGE49","Modification des dates de stage");
define("LANGSTAGE50","Stage");
define("LANGSTAGE51","Date du stage");
define("LANGSTAGE52","Erreur de saisie");
define("LANGSTAGE53","Stage mise � jour");
define("LANGSTAGE54","Le stage du ");
define("LANGSTAGE55","pour la classe de");
define("LANGSTAGE56","est enregistr�");
define("LANGSTAGE57","Date de stage, supprim�e \\n\\n L'Equipe TRIADE");
define("LANGSTAGE58","Entreprise enregistr�e \\n\\n L'Equipe TRIADE");
define("LANGSTAGE59","Modification d'entreprise");
define("LANGSTAGE60","Entreprises par activit�");
define("LANGSTAGE61","Recherche d'entreprises");
define("LANGSTAGE62","Info");
define("LANGSTAGE63","Liste compl�te");
define("LANGSTAGE64","Visualisation des dates de stage");
define("LANGSTAGE65","Suppression d'entreprise");
define("LANGSTAGE66","Entreprise Supprim�e \\n\\n L'Equipe TRIADE");
define("LANGSTAGE67","Consulter les entreprises par activit�");
define("LANGSTAGE68","Aucune entreprise pour ce nom");
define("LANGSTAGE69","Visualisation d'un ".INTITULEELEVE." � un stage");
define("LANGSTAGE70","Imprimer le stage num�ro");
define("LANGSTAGE71","Visualisation d'un ".INTITULEELEVE." aux stages");
define("LANGSTAGE72","&nbsp;Date&nbsp;du&nbsp;Stage&nbsp;"); // respecter les &nbsp;
define("LANGSTAGE73","Retour");
define("LANGSTAGE74","Entreprise");
define("LANGSTAGE75","Affectation d'un ".INTITULEELEVE." � un stage");
define("LANGSTAGE76","Lieu du stage");
define("LANGSTAGE77","Responsable");
define("LANGSTAGE78","Enseignant Visiteur");
define("LANGSTAGE79","Log�");
define("LANGSTAGE80","Nourri");
define("LANGSTAGE81","Passage dans n services");
define("LANGSTAGE82","Raison chgment de service");
define("LANGSTAGE83","Info. compl�mentaires");
define("LANGSTAGE84","Cr�ation enregistr�e \\n \\n L'Equipe TRIADE");
define("LANGSTAGE85","Date de la visite");
define("LANGSTAGE86","Modification d'un ".INTITULEELEVE." � un stage");
define("LANGSTAGE87","Informations enregistr�es");
define("LANGSTAGE88","Suppression d'un ".INTITULEELEVE." � un stage");


define("LANGRESA62","Libell�");
define("LANGRESA63","Refuser");
define("LANGRESA64","Ajouter une demande");
define("LANGRESA65","&nbsp;De&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�");
define("LANGRESA66","R�serv�");
define("LANGRESA66bis","par");  // suite r�serv� par
define("LANGRESA67","Non confirm�");
define("LANGRESA68","Confirm�");
define("LANGRESA69","Enregistrement termin�");
define("LANGRESA70","r�servation pour le ");






define("LANGNOTEUSA1","Configuration des attributions des notes pour le mode USA");
define("LANGNOTEUSA2","Ce module vous permet de positionner les lettres en fonction du pourcentage � attribuer � chaque note (lettre).");
define("LANGNOTEUSA3","Exemple : de 95 � 100 --> A+ , de 87 � 94  --> A, etc...");
define("LANGNOTEUSA4","De");
define("LANGNOTEUSA4bis","�");
define("LANGNOTEUSA4ter","�quivaut �");   //  ex : De  10 � 20 �quivaut � B
define("LANGNOTEUSA5","Entre la note");
define("LANGNOTEUSA5bis","et la note");
define("LANGNOTEUSA5ter","cela �quivaut �");



define("LANGABS56","Liste des absences non justifi�es");
define("LANGABS57","Mise � jour r�alis�e pour cette liste d'".INTITULEELEVE."s");




define("LANGSANC1","Sanction cr��e -- L'Equipe TRIADE");
define("LANGSANC2","Cat�gorie non supprim�e. Cette cat�gorie est d�j� affect�e � une sanction ou un ".INTITULEELEVE." -- Equipe TRIADE");
define("LANGSANC3","Configuration Discipline");
define("LANGSANC4","Enregistrement des cat�gories.");
define("LANGSANC5","Intitul� de la cat�gorie");
define("LANGSANC6","Enregistrement des noms des sanctions par cat�gorie.");
define("LANGSANC7","Intitul� de la sanction");
define("LANGSANC8","Configuration retenue");
define("LANGSANC9","Avertissement d'un message  lorsque l'".INTITULEELEVE."  a atteint la limite autoris�e.");
define("LANGSANC10","Pour  la cat�gorie");
define("LANGSANC11","Avertissement d'un message au bout de");
define("LANGSANC12","Nb de fois");
define("LANGSANC13","Cr�� par");
define("LANGSANC14","Date de saisie");

// Modification de ces 2 phrases � traduire
// define("LANGPARAM1","<font class=T1>Composez votre texte pour le contenu du message de l'absence pour l'envoi du courrier aux parents d'".INTITULEELEVE.". Pour une prise en compte du nom et du pr�nom de l'".INTITULEELEVE." automatiquement dans chaque document, veuillez pr�siser la cha�ne <b>NomEleve</b> et <b>PrenomEleve</b> � l'emplacement d�sir�. De m�me possibilit� d'indiquer la classe avec le mot clef <b>ClasseEleve</b>, ou la date de l'absence ABSDEBUT ou ABSFIN ainsi que la dur�e ABSDUREE </font><br><br>");
// define("LANGPARAM2","<font class=T1>Composez votre texte pour le contenu du message de retard pour l'envoi du courrier aux parents. Pour une prise en compte du nom et du pr�nom de l'".INTITULEELEVE." automatiquement dans chaque document, veuillez pr�siser la cha�ne <b>NomEleve</b> et <b>PrenomEleve</b> � l'emplacement d�sir�. De m�me possibilit� d'indiquer la classe avec le mot clef <b>ClasseEleve</b>, ou la date du retard RTDDATE , l'heure RTDHEURE ainsi que le dur�e RTDDUREE </font><br><br>");


define("LANGMODIF4","Modification d'un compte");
define("LANGMODIF5","Informations de connexion");
define("LANGMODIF6","Photo d'identit�");
define("LANGMODIF7","Cordonn&eacute;es du compte");
define("LANGMODIF8","Adresse");
define("LANGMODIF9","Code Postal");
define("LANGMODIF10","Commune");
define("LANGMODIF11","T&eacute;l.");
define("LANGMODIF12","Email");
define("LANGMODIF13","Modifier le compte");
define("LANGMODIF14","Compte modifi� -- Equipe TRIADE");
define("LANGMODIF15","Le mot de passe de ");
define("LANGMODIF15bis"," a �t� modifi�.");
define("LANGMODIF16","Modification du mot de passe");
define("LANGMODIF17","Impossible photo de taille non conforme");
define("LANGMODIF18","R�actualiser cette photo");
define("LANGMODIF19","Ajouter la photo");
define("LANGMODIF20","Modifier la photo");

define("LANGGRP25bis","Gestion des groupes");
define("LANGGRP26","Liste des groupes");
define("LANGGRP27","Ajouter un ".INTITULEELEVE." dans un groupe");
define("LANGGRP28","Supprimer un ".INTITULEELEVE." d'un groupe");
define("LANGGRP29","Nom du Groupe");
define("LANGGRP30","Classe(s) concern�e(s)");
define("LANGGRP31","Modifier liste");
define("LANGGRP32","Ajouter des ".INTITULEELEVE."s dans le groupe");
define("LANGGRP33","Ajouter un ".INTITULEELEVE." dans ce groupe");
define("LANGGRP34","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." en classe de ");
define("LANGGRP35","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." dans le groupe");
define("LANGGRP36","Valider le groupe");
define("LANGGRP37","Groupe modifi� -- Equipe TRIADE ");
define("LANGGRP38","Liste des ".INTITULEELEVE."s du groupe ");
define("LANGGRP39","Aucun ".INTITULEELEVE." dans ce groupe");

define("LANGCARNET1","Carnet de notes");
define("LANGCARNET2","Classe de l'".INTITULEELEVE);
define("LANGCARNET3","Cliquez sur le <b>nom</b> de l'".INTITULEELEVE);

define("LANGPASSG1","Le mot de passe doit �tre de <b>8 caract�res</b> minimum,<br /> <b>alphanum�rique</b> et utilisant <b>majuscule et minuscule</b>.");
define("LANGPASSG2","Le mot de passe n'est pas correct. \\n Le mot de passe doit comporter : \\n\\n -> 8 caract�res minimum, \\n -> alphanum�rique, \\n -> majuscule et minuscule \\n\\n L\\'Equipe TRIADE");
define("LANGPASSG3","Echec de la cr�ation");



define("LANGDISC38","Ajouter Sanction");
define("LANGDISC39","Gestion des disciplines");
define("LANGDISC40","Retenue non effectu�e.");
define("LANGDISC41","Planning Retenue.");
define("LANGDISC42","Retenue non affect�e � un �l�ve.");
define("LANGDISC43","Configuration.");
define("LANGDISC44","Supprimer Retenues et sanctions");
define("LANGDISC45","Supprimer Retenues et sanctions");
define("LANGDISC46","Liste des absences et des retards d'une classe");
define("LANGDISC47","Indiquez le d�but de la p�riode");
define("LANGDISC48","Indiquez la fin de la p�riode");
define("LANGDISC49","Indiquez la section");
define("LANGDISC50","<br><ul>Suppression des retenues et des sanctions en <br>fonction de l'intervalle de date.</ul>");
define("LANGDISC51","Toutes les classes");
define("LANGDISC52","Retenues et sanctions supprim�es");
define("LANGDISC53","Erreur ! Retenues et sanctions non supprim�es");

define("LANGIMP53","Fichier ASCII via SQL ");


// autre new

define("LANGSTAGE31bis","2�me Secteur Activit�");
define("LANGSTAGE31ter","3�me Secteur Activit�");
define("LANGMEDIC1","Dossier m�dical d'un ".INTITULEELEVE);
define("LANGMEDIC2","Envoyer la recherche");
define("LANGMEDIC3","Information / Modification");


define("LANGDISC54","Visualiser les disciplines d'un �l�ve");
define("LANGDISC55","Supprimer une Sanction");
define("LANGDISC56","Supprimer Sanction");

define("LANGBASE6bis","Total d'".INTITULEELEVE."s dans le fichier ");

define("LANGMODIF21","Le mot de passe doit avoir : \\n\\n - 8 caracteres minimum \\n - Alphanumerique \\n - MAJUSCULE et minuscule.\\n\\n Equipe TRIADE");

define("LANGMODIF22","Mot de passe : 8 caract�res - Alphanum�rique - Majuscules et minuscules");
define("LANGPASS1bis","Confirmer mot de passe");

define("LANGMODIF23","Vous pouvez changer votre mot de passe pour votre compte TRIADE");
define("LANGMODIF24","Le compte ");
define("LANGMODIF24bis","est en cours de validation..");
define("LANGMODIF24ter","est maintenant op�rationnel");
define("LANGMODIF25","Mot de passe non identique. \\n\\n Equipe TRIADE");

define("LANGABS58","Visualisation / Suppression  Absence - Retard");
define("LANGABS59","Affichage complet des retards");
define("LANGABS60","Pendant");  	// une dur�e pendant tant de temps
define("LANGABS61","Visualisation / Modification d'une  Absence - Retard");
define("LANGABS62","Affichage <b>complet</B> des rtds et abs");
define("LANGABS63","Saisie le");
define("LANGABS64","Affichage des <b>5</B> derniers rtd et abs");
define("LANGABS65","Affichage complet des absences");
define("LANGABS66","Mise � jour effectu�e pour cette liste d'".INTITULEELEVE."s");
define("LANGABS6bis","Liste des retards non justifi�s");
define("LANGABS4bis","Lister les absences ou retards");
define("LANGABS67","<font class=T2>Aucun �l�ve dans cette classe</font>");
define("LANGABS68","Abs / Rtds d'une classe");
define("LANGABS69","Cumul abs/rtds des ".INTITULEELEVE."s");
define("LANGABS70","Configuration des motifs");
define("LANGABS71","Nombre d'absences / Cumul");
define("LANGABS72","Nombre de Retards / Cumul");
define("LANGABS73","Absences - Retards -  de la classe ");
define("LANGABS74","Effectuer la mise � jour");
define("LANGABS75","Aucun absent ou retard");
define("LANGABS76","relev� � ");

define("LANGDEPART3","Suite � un probl�me technique,");
define("LANGDEPART4","l'acc�s au serveur est indisponible. L'�quipe TRIADE intervient actuellement sur le serveur.");

define("LANGBASE3_2","Voici la liste des fichiers pouvant �tre import�s.");
define("LANGbasededoni21_2","Souhaitez-vous continuer ? \\n\\n L\'Equipe TRIADE");
define("LANGbasededon21","L'envoi du fichier peut durer de <b>2 � 4 mn</b> en fonction du nombre d'�l�ments.");
define("LANGbasededon31_2","Indiquez les mati�res que vous souhaitez importer.");
define("LANGBASE10_2","Indiquez les enseignants � ajouter.");

define("LANGBASE16_2"," Les colonnes sont repr�sent�es sous la forme : <b>nom de login ; pr�nom de login ; mot de passe en clair</b>");
define("LANGIMP25_2","nom �tablissement");
// ----------------------------- //
define("LANGABS77","Signal� le");
define("LANGSTAGE89","Etablir la convention de stage");
define("LANGSTAGE90","Sortir les conventions de stage");
define("LANGSTAFE91","Liste des ".INTITULEELEVE."s en entreprise actuellement");
define("LANGSTAGE92","Liste des ".INTITULEELEVE."s en entreprise actuellement");
define("LANGPASSG4","Le mot de passe doit �tre de <b>8 caract�res</b> minimum <br /><b>alphanum�rique</b>.");
define("LANGPASSG5","Le mot de passe doit �tre de <b>4 caract�res</b> minimum.");
define("LANGPASSG6","Le mot de passe n'est pas correct. \\n Le mot de passe doit comporter : \\n\\n -> 8 caract�res minimum, \\n -> alphanum�rique \\n\\n L\\'Equipe TRIADE");
define("LANGPASSG7","Le mot de passe n'est pas correct. \\n Le mot de passe doit comporter : \\n\\n -> 4 caract�res minimum. \\n\\n L\\'Equipe TRIADE");

define("LANGMODIF22_1","Mot de passe : 4 caract�res");
define("LANGMODIF22_2","Mot de passe : 8 caract�res - Alphanum�rique ");
define("LANGMODIF22_3","Mot de passe : 8 caract�res - Alphanum�rique - Majuscules et minuscules");
define("LANGDEPART2","<font color=red  class=T2>ATTENTION, pour utiliser TRIADE, la variable php '<strong>register_globals</strong>' doit �tre sur <u>Off</u>.</font><br />");


define("LANGacce15","Devoir � remettre pour le ");
define("LANGacce16","Devoir � rendre aujourd'hui !");
define("LANGacce17","Ajout d'une sanction disciplinaire");

define("LANGBASE41","Supprimer tous les ".INTITULEELEVE."s avant l'import");
define("LANGBASE7bis","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))." d�j� affect�");
define("LANGBASE8bis","pour les ".INTITULEELEVE."s <u>affect�s</u> et <u>sans classe</u>");

define("LANGPER21bis","Langue&nbsp;/&nbsp;option");

define("LANGASS6ter","".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
define("LANGASS41","Stockage");
define("LANGASS42","Param�trage");

define("LANGIMP46bis","Mot de passe");

define("LANGIMP54","N� rue");
define("LANGIMP55","adresse");
define("LANGIMP56","code postal");
define("LANGIMP57","t�l�phone");
define("LANGIMP58","email");
define("LANGIMP59","commune");

define("LANGBULL1pp","Impression bulletin trimestriel ou semestriel");
define("LANGBT43pp","Imprimer Tableau");


define("LANGMESS38","Message lu.");
define("LANGMESS39","Message non lu.");


define("LANGDISC57","Motif&nbsp;/&nbsp;Sanction");

define("CUMUL01","Cumul des absences et retards d'une classe par ".INTITULEELEVE);
define("CUMUL02","Cumul des sanctions d'une classe par ".INTITULEELEVE);
define("CUMUL03","Cumul des sanctions d'un ".INTITULEELEVE);
define("LANGPROJ18bis","heure(s)");
define("LANGCREAT1","Compte d�j� existant.");
define("ERREUR1","R�seau Internet non disponible pour ce module.");
define("ERREUR2","Consulter le module Configuration pour activer le r�seau.");


define("PASSG8","Modification du mot de passe");
define("PASSG9","Le mot de passe de l'".INTITULEELEVE." ");
define("PASSG9bis"," a �t� modifi�.");


define("LANGPARAM34","Site Web de l'�tablissement");
define("LANGLOGO3bis","Le logo <b>doit �tre au format jpg</b>");


define("LANGMAT1","Enregistrer mati�re");
define("LANGMAT2","Liste / Modification d'une mati�re");
define("LANGMAT3","Supprimer mati�re");
define("LANGMAT4","Valider la modification");
define("LANGMAT5","Mati�re modifi�e");
define("LANGMAT6","Mati�re d�j� affect�e");
define("LANGCLAS1","Liste / Modifier classe");
define("LANGCLAS2","Classe modifi�e");
define("LANGCLAS3","Classe d�j� affect�e");

define("LANGDEVOIR1","pour le  groupe");
define("LANGDEVOIR2","pour la  classe");
define("LANGDEVOIR3","Enregistrer un devoir scolaire");
define("LANGCIRCU111","<font face=Verdana size=1><B><font color=red>D</font></B>ocument au format : <b> doc</b>, <b>pdf</b>, <b>txt</b>.</FONT>");

define("LANGAFF7","Module de suppression d'affectation des classes.");
define("LANGAFF8","ATTENTION ce module est � utiliser lors de la suppression d'affectation,<br> il d�truit toutes les notes des ".INTITULEELEVE."s  des classes supprim�es.");
define("LANGAFF9","ATTENTION, les notes des classes s�lectionn�es  seront supprim�es. \\n Souhaitez vous continuer ? \\n\\n Equipe TRIADE");
define("LANGCREAT2","Supprimer compte");


define("LANGPROF37","Cahier de textes.");

// news

define("LANGPARAM35","Choix du bulletin");
define("LANGPROBLE1","r�ponse par email");
define("LANGPROBLE2","Tous les champs doivent �tre renseign�s");
define("LANGMESS37","Ce module n'a pas �t� valid� par l'administrateur TRIADE.<br><br> L'Equipe TRIADE");

define("LANGPROFP23","Notes scolaires de ");
define("LANGPROFP24","du  mois de");
define("LANGPROFP25","Trombinoscope");
define("LANGPROFP26","Suivi d'un ".INTITULEELEVE);
define("LANGPROFP27","Informations sur les d�l�gu�s");
define("LANGPROFP28","Message pour la classe");
define("LANGPROFP29","Circulaire pour la classe");
define("LANGPROFP30","Gestion de stage professionnel");
define("LANGPROFP31","Tableau des moyennes des ".INTITULEELEVE."s");
define("LANGPROFP32","Bulletins graphiques des ".INTITULEELEVE."s");


define("LANGLETTRELUNDI","L");	  // Lundi
define("LANGLETTREMARDI","M");    // Mardi
define("LANGLETTREMERCREDI","M"); // Mercredi
define("LANGLETTREJEUDI","J");    // Jeudi
define("LANGLETTREVENDREDI","V"); // Vendredi
define("LANGLETTRESAMEDI","S");   // Samedi
define("LANGLETTREDIMANCHE","D"); // Dimanche



define("LANGRESA71","r�servation pour le");
define("LANGRESA72","de");
define("LANGRESA73","�");
define("LANGRESA74","Informations compl�mentaires");

define("LANGbasededoni52","valeur accept�e : <b>0</b> ou M.<br>");
define("LANGbasededoni53","valeur accept�e : <b>1</b> ou Mme.<br>");
define("LANGbasededoni54","valeur accept�e : <b>2</b> ou Mlle.<br>");
define("LANGbasededoni54_2","valeur accept�e : <b>3</b> ou Ms <br>");
define("LANGbasededoni54_3","valeur accept�e : <b>4</b> ou Mr <br>");
define("LANGbasededoni54_4","valeur accept�e : <b>5</b> ou Mrs <br>");


define("LANGacce_dep2bis","<br><b>ATTENTION !!  V�rifiez bien votre mode d'acc�s,<br> choisissez votre compte correspondant.</b>");

define("LANGNA3bis","Mot de passe parent "); //
define("LANGNA3ter","Mot de passe ".INTITULEELEVE." "); //

define("LANGELE244","Email");

define("LANGTP12","Veuillez valider votre compte");

define("LANGMESS40","Vous avez <strong> ");
define("LANGMESS40bis"," </strong> flux RSS enregistr�(s).");  // ajouter "\" devant les quotes
define("LANGMESS41","Compte ");  // Compte comme "compte utilisateur".
define("LANGMESS42","Deuxi�me connexion");
define("LANGMESS43","Derni�re connexion le");

define("LANGALERT4","ATTENTION, choisissez des noms de sujet diff�rent.");

define("LANGMODIF26","Modifier sous-mati�re");
define("LANGPROF38","Notes Trimestrielles");
define("LANGPROF39","Compl�ment d'information");

define("LANGCIRCU21","Disp. pour"); // abr�viation de "Disponible pour" 

define("LANGTELECHARGE","T�l�charger"); //  downloader

define("LANGPARENT15bis","Sanction du");
define("LANGDISC2bis","Imprimer les sanctions du jour");

define("LANGRECH5","Indiquer l'�l�ment ou les �l�ments  �  rechercher");
define("LANGRECH6","Trier par ordre");

define("LANGPROFP33","Remplir les bulletins");
define("LANGPROFP34","V�rifier bulletin");
define("LANGPROFP35","Consulter ou modifier les commentaires des bulletins");


define("LANGPROFP36","Aucune date trimestrielle <br /><br /> affect�e pour <u>cette ann�e scolaire</u>");
define("LANGPROFP37","Enregistrer les commentaires");

define("LANGGRP40","Groupe cr��");
define("LANGGRP41","Voici la liste des ".INTITULEELEVE."s non enregistr�s");
define("LANGGRP42","Ce groupe existe d�j�");
define("LANGGRP43","Erreur de fichier");
define("LANGGRP44","Supprimer un groupe");
define("LANGGRP45","Importer fichier");
define("LANGGRP46","Nom de groupe existant -- Service TRIADE");

define("LANGPARAM37","Acad�mie");
define("LANGAGENDA274","F&ecirc;te du jour ");
define("LANGPARAM38","Joyeux Anniversaire � ");
define("LANGEDT1","F"); // premi�re lettre
define("LANGEDT1bis","ichier au format <b>xml</b> ou <b>zip</b> <br>Taille maximum du fichier : ");
define("ERREUR3","Contacter l'administrateur TRIADE pour activer le r�seau.");
define("LANGELE30","Changer le mot de passe");
define("LANGMESS44","Message � un ".INTITULEELEVE." en ");
define("LANGMESS5","Message � un parent en : ");
define("LANGMESS45","Message vers un email : ");
define("LANGMESS2","Message pour ".INTITULEDIRECTION." : ");
define("LANGTRONBI9","des ".INTITULEELEVE."s");
define("LANGTRONBI10","du personnel");
define("LANGTRONBI11","Trombinoscope du personnel");

define("LANGTITRE15","Mise en place des professeurs principaux ou des instituteurs");
define("LANGPER7","affect� en classe "); 
define("LANGPROF40","Renseignements compl�mentaires");
define("LANGPROFP38","Remplir ou consulter le Carnet de Suivi");
define("LANGEDIT2","T�l. Portable 1");
define("LANGEDIT3","Civilit� ");
define("LANGEDIT4","Nom Resp. 2");
define("LANGEDIT5","Pr�nom Resp. 2");
define("LANGEDIT6","Lieu de naissance");
define("LANGEDIT7","Civilit� ");
define("LANGEDIT8","Nom Resp. 1");
define("LANGEDIT9","T�l. Portable 2");
define("LANGEDIT10"," Parent");
define("LANGEDIT11","E-mail ".ucfirst(TextNoAccentLicence2(INTITULEELEVE))."");
define("LANGEDIT12","T�l. ".INTITULEELEVE);
define("LANGEDIT13","E-mail Tuteur 2");
define("LANGEDIT14","d'aujourd'hui");
define("LANGEDIT15","Depuis 1 jour");
define("LANGEDIT16","Depuis 2 jours");
define("LANGEDIT17","Depuis 3 jours");
define("LANGEDIT18","Depuis 4 jours");
define("LANGEDIT19","Retard(s) non justifi�(s)");
define("LANGEDIT20","T�l. Portable ");
define("LANGSMS1","Envoi SMS pour les retards depuis ");
define("LANGSMS2","Non indiqu�");
define("LANGSUPPLE","Liste des suppl�ants");
define("LANGSUPPLE1","En remplacement de ");
define("LANGTITRE2","Actualit�s de l'�tablissement");
define("LANGTITRE1","Ev�nements");

define("LANGDISC58","Ajouter une discipline � un ".INTITULEELEVE);
define("LANGDISC59","Saisie en mode U.S.A.");
define("LANGDISC60","Examen ");

define("LANGBT8","Lister / Modification");
define("LANGBT9","Lister / Modification");
define("LANGBT10","Lister / Modification");
define("LANGDIRECTION","Administration");

define("LANGTITRE36","Gestion des membres ".INTITULEDIRECTION);
define("LANGTITRE37","Gestion des membres Vie Scolaire");
define("LANGTITRE38","Gestion Enseignants");
define("LANGTITRE39","Gestion Suppl�ants");
define("LANGTITRE40",INTITULEELEVE);
define("LANGTITRE41","resp."); // pour l'abr�viation de "responsable"
define("LANGTITRE42","tuteur"); // dans le cadre familial
define("LANGTITRE43","Gestion d'un ".INTITULEELEVE);
define("LANGTITRE44","Importer une liste d'".INTITULEELEVE."s");
define("LANGTITRE45","Recherche ".INTITULEELEVE);
define("LANGCHERCH1","En fonction du crit�re de recherche");
define("LANGCHERCH2","Fin de la recherche");
define("LANGCHERCH3","Nombre d'�l�ments trouv�s");
define("LANGPROF3bis","Visualiser les devoirs, interrogations et contr�les");
define("LANGTROMBI","Exporter les listes d'".INTITULEELEVE."s vers WellPhoto");
define("LANGPURG1","Suppression des informations");
define("LANGPUR2","Suppression des informations");
define("LANGPROFP39","Tableau des moyennes annuelles :");
define("LANGBLK1","Votre compte est d�sactiv�.<br /><br />Vous avez tent� un acc�s sur une page non autoris�e.<br /><br />Pour r�activer votre compte, veuillez contacter votre �tablissement scolaire.<br /><br />L'Equipe TRIADE.");
define("LANGCARNET4","acc�der");
define("LANGFORUM10bis","Votre pr�nom ");
define("LANGTPROBL11","Nous nous chargeons de vous r�pondre dans les plus brefs d�lais. \\n\\n  L'Equipe TRIADE ");
define("LANGTRAD1","Liste des op�rations effectu�es");
define("LANGPARAM39","Certificat enregistr�");
define("LANGPARAM40","Certificat non enregistr�");
define("LANGPARAM41","Le fichier doit �tre au format <b>rtf</b> et inf�rieur � 2Mo");
define("LANGBASE42","Importation du fichier");
define("ACCEPTER","Accepter");
define("LANGCONDITION","J'accepte les Conditions");
define("LANGPARAM42","Liste des retards ou absences");
define("LANGCARNET5","Consulter le Carnet de Suivi");
define("LANGCARNET6","Remplir le Carnet de Suivi");
define("LANGCARNET7","Remplir");
define("LANGCARNET8","Carnet de Suivi");
define("LANGCARNET9","Cr�er un Carnet de Suivi");
define("LANGCARNET10","Modifier un Carnet de Suivi");
define("LANGCARNET11","Supprimer un Carnet de Suivi");
define("LANGCARNET12","Consulter un Carnet de Suivi");
define("LANGCARNET13","Exporter un Carnet de Suivi");
define("LANGCARNET14","Importer un Carnet de Suivi");
define("LANGCARNET15","Importer");
define("LANGCARNET16","Exporter");
define("LANGCARNET17","Menu Carnet de Suivi");
define("LANGCARNET18","Nom du Carnet de Suivi");
define("LANGCONTINUER","Continuer --->");
define("LANGCARNET19","Cr�ation d'un Carnet de Suivi");
define("LANGCARNET20","Codes d'appr�ciation pouvant �tre choisis par les enseignants");
define("LANGCARNET21","Lettres");
define("LANGCARNET22","Chiffres");
define("LANGCARNET23","Couleurs");
define("LANGCARNET24","Notes");
define("LANGCARNET25","(0 � 10 ou 0 � 20)");
define("LANGCARNET26","Correspondance");
define("LANGCARNET27","acquis");
define("LANGCARNET28","�&nbsp;confirmer");
define("LANGCARNET29","non&nbsp;acquis");
define("LANGCARNET30","en&nbsp;cours&nbsp;d'acquisition");
define("LANGCARNET31","non&nbsp;�valu�");
define("LANGCARNET32","Vert");
define("LANGCARNET33","Bleu");
define("LANGCARNET34","Orange");
define("LANGCARNET35","Rouge");
define("LANGCARNET36","p�riode");
define("LANGCARNET37","p�riodes");
define("LANGCARNET38","Gestion du Carnet de Suivi");
define("LANGCARNET39","Nombre(s) de p�riode(s) imposant la signature des parents, de l'enseignant et de la Direction ");
define("LANGCARNET40","Nombre(s) ");
define("LANGCARNET41","Sections associ�es � ce Carnet de Suivi");
define("LANGCARNET42","Sections");
define("LANGCARNET43","Maximum 4 choix possibles (les 4 premiers seront conserv�s)");
define("LANGCARNET44","Carnet de Suivi cr��. Vous pouvez maintenant ajouter les comp�tences associ�es � ce Carnet.");
define("LANGCARNET45","Ajout d'un domaine de comp�tences ");
define("LANGCARNET46","Intitul� du domaine de comp�tences ");
define("LANGCARNET47","Cet intitul� correspond-il � une rubrique de comp�tences ?  ");
define("LANGCARNET48","Intitul�");
define("LANGCARNET49","Ajout d'une comp�tence ");
define("LANGCARNET50","Modifier les caract�ristiques g�n�rales du Carnet ");
define("LANGCARNET51","Ajouter un domaine de comp�tences ");
define("LANGCARNET52","Modifier un domaine de comp�tences ");
define("LANGCARNET53","Indiquez le Carnet de Suivi");
define("LANGCARNET54","Carnet de Suivi non existant ");
define("LANGCARNET55","Consultation d'un Carnet de Suivi");
define("LANGCARNET56","Un Carnet de Suivi");
define("LANGCARNET57","R�cup�ration du Carnet de Suivi au format PDF");
define("LANGCARNET58","Exportation d'un Carnet de Suivi");
define("LANGCARNET59","Pour r�cup�rer ce Carnet de Suivi");
define("LANGCARNET60","Modification d'un Carnet de Suivi");
define("LANGCARNET61","Suppression d'un Carnet de Suivi");
define("LANGCARNET63","Importation d'un Carnet de Suivi");
define("LANGCARNET64","Fichier � importer");
define("LANGCARNET65","Supprimer tout l'emploi du temps avant l'import ?");
define("LANGCARNET66","Importation annul�e. <br><br>Ce nom de Carnet existe d�j� ! <br />Veuillez supprimer ce Carnet avant d'effectuer l'importation.");
define("LANGCARNET62","ATTENTION !!! Toutes les notes assujetties au Carnet de Suivi seront effac�es!");
define("LANGEDT2","Import Emploi du temps Visual Timetabling");
define("LANGEDT3","Import Visual Timetabling termin�");
define("LANGEDT4","Affichage / Gestion de l'Emploi du Temps");
define("LANGEDT5","Importer Emploi du temps Visual Timetabling");
define("LANGEDT6","Exporter Triade vers Visual Timetabling");
define("LANGEDT7","Affichage / Gestion de l'Emploi du Temps");
define("LANGEDT8","Administrer");
define("LANGEDT9","Mise en place de l'Emploi du Temps");
define("LANGEDT10","Module SQLite non support�. Veuillez valider votre serveur pour la prise en charge du support SQLite.");
define("LANGGRP47","Rechercher les groupes");
define("LANGGRP48","Liste des groupes d'un ".INTITULEELEVE);
define("LANGGRP49","Liste des groupes");
define("LANGDISP21","Configuration Motif abs / rtds");
define("LANGDISP22","Enregistrement des motifs ");
define("LANGDISP23","Intitul� du motif ");
define("LANGDISP24","Liste des motifs ");
define("LANGDISP25","Nombre d'".INTITULEELEVE."s mis � jour");
define("LANGDISP26","Le fichier doit �tre au format xls");
define("LANGCARNET63","Import Carnet de Suivi termin�");
define("LANGCARNET64","Liste des sanctions");
// News 2
define("LANGCARNET67","Ajout d'une sanction disciplinaire");
define("LANGCARNET68","Horaire");
define("LANGVIES1","Nom de la personne rattach�e au bulletin");
define("LANGVIES2","Coefficient de la note Vie Scolaire sur le bulletin");
define("LANGVIES3","Coefficient Enseignant");
define("LANGVIES4","Coefficient Vie scolaire");
define("LANGVIES5","Liste des Enseignants");
define("LANGVIES6","Informations Scolaires Compl�mentaires");


define("LANGVIES7","Enregistrer les notes et commentaires");
define("LANGVIES8","Impression des absences d'une classe");
define("LANGVIES9","Indiquez le mois");
define("LANGVIES10","Indiquez une classe ");
define("LANGPDF1","Un fichier PDF pour l'ensemble");
define("LANGPDF2","Un fichier PDF par ".INTITULEELEVE);
define("LANGEDIT5bis","Pr�nom Resp. 1");
define("LANGGRP50","Modifier le nom d'un groupe");
define("LANGGRP51","Nom du groupe");
define("LANGGRP52","Module Modification");
define("LANGGRP53","Nouveau nom de groupe");
define("LANGGRP54","ou relev� de notes");
define("LANGGRP55","examen");
define("LANG1ER","1�re");
define("LANG2EME","2�me");
define("LANG3EME","3�me");
define("LANG4EME","4�me");
define("LANG5EME","5�me");
define("LANG6EME","6�me");
define("LANG7EME","7�me");
define("LANG8EME","8�me");
define("LANG9EME","9�me");
define("LANGGRP56","Notation sur");
define("LANGGRP57","Garder");
define("LANGGRP58","Attention, les notes des ".INTITULEELEVE."s s�lectionn�s � la suppression <br /> seront supprim�es dans toutes les classes utilisant ce groupe !!!");
define("LANGGRP59","D�cocher le(s) ".INTITULEELEVE."(s) n'appartenant plus au groupe");
define("LANGGRP60","Modifier la liste");
define("LANGPARAM3","<font class=T1>Composez votre texte pour le contenu du certificat de scolarit�.  Pour une prise en compte du nom, du pr�nom et de l'adresse de l'".INTITULEELEVE." automatiquement dans chaque document, veuillez pr�siser la cha�ne <b>NomEleve</b>, <b>PrenomEleve</b>, <b>AdresseEleve</b>, <b>CodePostalEleve</b> et <b>VilleEleve</b> � l'emplacement d�sir�. De m�me, possibilit� d'indiquer la classe avec le mot clef <b>ClasseEleve</b> ou <b>ClasseEleveLong</b>, la date de naissance avec <b>DateNaissanceEleve</b>, lieu de naissance via <b>LieuDeNaissance</b>, la date du jour via <b>DateDuJour</b>, l'ann�e scolaire via <b>AnneeScolaire</b>, nationalit� via <b>Nationalite</b>.</font><br><br>");
define("LANGEDIT20bis","Supp");  // abr�viation de Supprimer  sur 3 lettres seulement
define("LANGGRP61","Retour � la mise � jour");
define("LANGRTDJUS","Justifi&eacute;"); // pour un retard
define("LANGABSJUS","Justifi&eacute;e"); // pour une abs
define("LANGPARAM2","<font class=T1>Composez votre texte pour le contenu du message de retard � envoyer aux parents. Vous pouvez pr�ciser les informations suivantes : Nom de l'".INTITULEELEVE." : <b>NomEleve</b> - Pr�nom de l'".INTITULEELEVE." : <b>PrenomEleve</b> - Adresse : <b>AdresseEleve</b> - Code postal : <b>CodePostalEleve</b> - Ville : <b>VilleEleve</b> - Classe de l'".INTITULEELEVE." : <b>ClasseEleve</b> - Date du retard : <b>RTDDATE</b> - Heure du retard : <b>RTDHEURE</b> - Dur�e : <b>RTDDUREE</b>  - Cumul absence : <b>CumulABS</b> </font><br><br>");
define("LANGPARAM1","<font class=T1>Composez votre texte pour le contenu du message de l'absence � envoyer aux parents. Vous pouvez pr�ciser les informations suivantes : Nom de l'".INTITULEELEVE." : <b>NomEleve</b> - Pr�nom de l'".INTITULEELEVE." : <b>PrenomEleve</b> - Adresse : <b>AdresseEleve</b> - Code postal : <b>CodePostalEleve</b> - Ville : <b>VilleEleve</b> - Classe de l'".INTITULEELEVE." : <b>ClasseEleve</b> - Date de d�but d'absence :  <b>ABSDEBUT</b> - Date de fin d'absence : <b>ABSFIN</b> - Dur�e : <b>ABSDUREE</b> - Nom du responsable 1 : <b>NomResponsable1</b> - Adresse responsable 1 : <b>AdresseResponsable1</b> - Ville responsable 1 : <b>VilleResponsable1</b> - Cumul absence : <b>CumulABS</b> - Date du jour : <b>DATEDUJOUR</b> </font><br><br>");
define("LANGGRP62","�tude");
define("LANGGRP63","Courrier");
define("LANGDELEGUE1","d�l�gu�");
define("LANGEDT10bis","Module SimpleXML non support�. Veuillez valider votre serveur pour la prise en charge de l'extension SimpleXML.");
define("LANGBULL45","Envoyer un message � tous les enseignants coch�s pour les pr�venir de remplir leurs bulletins.");
define("LANGBULL46","Nombre de bulletins remplis dans la classe");
define("LANGMESS46","Visualiser dans");
define("LANGMESS47","Supprimer une retenue ou une sanction");
define("LANGCOUR","Courrier termin�");
define("LANGCOUR1","Liste des retenues non effectu�es");
define("LANGCOUR2","Configuration du courrier de retenues");
define("LANGPARAM43","<font class=T1>Composez votre texte pour le contenu du message de retenue � envoyer aux parents. Vous pouvez pr�ciser les informations suivantes : Nom de l'".INTITULEELEVE." : <b>NomEleve</b> - Pr�nom de l'".INTITULEELEVE." : <b>PrenomEleve</b> - Adresse : <b>AdresseEleve</b> - Code postal : <b>CodePostalEleve</b> - Ville : <b>VilleEleve</b> - Classe de l'".INTITULEELEVE." : <b>ClasseEleve</b> - Date de la retenue : <b>DATERETENU</b> - Heure de la retenue : <b>HEURERETENU</b> - Dur�e : <b>RETENUDUREE</b> - Motif : <b>RETENUMOTIF</b> -  Cat�gorie : <b>RETENUCATEGORY</b> - Attribu�e par : <b>ATTRIBUEPAR</b> - Devoir � faire : <b>DEVOIRAFAIRE</b> - Les faits : <b>FAITS</b> - Civilit� tuteur 1 : <b>CIVILITETUTEUR1</b> - Nom du responsable 1 : <b>NOMRESP1</b> Pr�nom du responsable 1 : <b>PRENOMRESP1</b> - Date du jour : <b>DATEDUJOUR</b> </font><br><br>");
define("RESA75","Informations compl�mentaires");
define("LANGCOM","Enregistrer tous vos commentaires dans votre biblioth�que.");
define("LANGCOM1","La valeur max doit �tre plus grande que la valeur min.");
define("LANGCOM2","Tous les champs doivent �tre indiqu�s correctement.");
define("LANGCOM3","Nombre d'".INTITULEELEVE."s : ");
define("LANGSTAGE91","Nom du responsable");
define("LANGSTAGE93","Fonction du resp.");
define("LANGSTAGE94","de l'entreprise");
define("LANGSTAGE95","Entreprise");
define("LANGSTAGE96","Nombre d'�l�ments trouv�s");
define("LANGSTAGE97","Indiquer une valeur num�rique, svp");
define("LANGSTAGE98","Indiquez la date du d�but de stage, svp");
define("LANGSTAGE99","Indiquez la date de fin de stage, svp");
define("LANGPATIENTE","Veuillez patienter");
define("LANGSMS3","Num�ro de t�l�phone portable");
define("LANGSMS4","150 caract�res maximum");
define("LANGSMS5","Message");
define("LANGSMS6","L'envoi du message SMS est conserv� et accessible par ".INTITULEDIRECTION);
define("LANGSMS7","Envoi message SMS");
define("LANGSMS8","Envoyer un message SMS");
define("LANGSMS9","Liste des num�ros de t�l�phones des parents <br> de ");
define("LANGSMS10","Envoyer un sms � toute une classe");
define("LANGSMS11","Envoyer un sms � un parent d'".INTITULEELEVE." via son nom");
define("LANGSMS12","Envoyer un sms � une personne via son nom");
define("LANGSMS13","Envoyer un sms � une personne via son num�ro");
define("LANGSMS14","Num�ro");
define("LANGbasededoni54_5","valeur accept�e : <b>7</b> ou P <br>");
define("LANGbasededoni54_6","valeur accept�e : <b>8</b> ou Sr <br>");
define("LANGGRP27bis","Ajouter un ".INTITULEELEVE." dans plusieurs groupes");
define("LANGGRP28bis","Ajout ".INTITULEELEVE." dans groupe");
define("LANGGRP29bis","Saisie&nbsp;/&nbsp;Modif");
define("LANGNOTEUSA6","Correspondance des notes pour la notation en mode USA");
define("LANGNOTE1","Intitul� de l'examen");
define("LANGPARAM44","Recevoir un message lorsque vous recevez une information de type");
define("LANGMESS17bis","Config.");
define("LANGNNOTE2","Trier par classe");
define("LANGNNOTE3","Trier par nom");
define("LANGNNOTE4","Indiquer le titre du document");
define("LANGBULL47","Bulletin sans sous-mati�res");
define("LANGBULL48","Bulletin avec sous-mati�res");
define("LANGBULL49","Bulletin examen blanc");
define("LANGMESS48","Boite de suppression");
define("LANGMESS49","Aucun ".INTITULEELEVE." n'a d'entreprise affect�e.");
define("LANGMESS50","Plan de la classe");
define("LANGMESS51","Indiquer les mati�res facultatives");
define("LANGMESS52","(Notes comptabilis�es dans la moyenne g�n�rale, si elles sont sup�rieures � 10/20)");
define("LANGMESS53","Semaine pr�c�dente");
define("LANGMESS54","Semaine suivante");
define("LANGMESS55","Emploi du temps de la classe ");
define("LANGMESS56","Aucun ".INTITULEELEVE."");
define("LANGMESS57","Identifiant");
define("LANGMESS58","Ce compte ne poss�de aucun num�ro.");
define("LANGMESS59","Modifier aussi les abs/rtd justifi�s");
define("LANGMESS60","A");
define("LANGMESS60bis","bsent");
define("LANGMESS61","des enseignants");
define("LANGMESS62","Parent de ");
define("LANGMESS63","aujourd\'hui");  // mettre une ' 
define("LANGBT27bis","Enregistrer abs/rtd"); //
define("LANGDEPART3bis","Acc�s interrompu ! ");
define("LANGDEPART4bis","L'acc�s � votre TRIADE est actuellement interrompu, merci de contacter votre �tablissement scolaire pour de plus amples informations.");
define("LANGAIDE","Aide en ligne");
define("LANGAIDE1","Indiquer les correspondances entre vos mati�res enregistr�es dans TRIADE et les mati�res enseign�es pour le brevet des coll�ges. Pour cela, effectuer un drag&drop (glisser&relacher) entre les mati�res de gauche � droite.");
define("LANGAIDE2","Composer votre texte pour le contenu de la convention de stage. Pour une prise en compte d'�l�ments tels que le nom, pr�nom, adresse, etc..., veuillez pr�siser la cha�ne suivante en fonction de vos besoins :");
define("LANGBREVET1","Acc�der");
define("LANGCONFIG4","Etre averti d'un message lorsque");
define("LANGCONFIG5","Nbr d'absences non justifi�es d'un ".INTITULEELEVE." a d�pass� ");
define("LANGCONFIG6","Nbr de retards non justifi�s d'un ".INTITULEELEVE." a d�pass� ");
define("LANGCONFIG7","fois");
define("LANGCONFIG8","Liste des utilisateurs avertis");

define("LANGMESS64","Personnes ayant re�u ce message");
define("LANGMESS65","Liste des r�glements int�rieurs");
define("LANGMESS66","Le Directeur");
define("LANGMESS67","J'ai pris connaissance des diff�rents documents ci-dessus");
define("LANGMESS68","J'accepte le ou les r�glement(s) int�rieur(s)");
define("LANGMESS69","J'accepte les conditions g�n�rales d'enseignement");
define("LANGMESS70","R�glement accessible par les enseignants");
define("LANGMESS71","Consulter Fiche d'�tat des r�glements");
define("LANGMESS72","Imprimer Fiche d'�tat des r�glements");
define("LANGMESS73","Liste des impay�s ou paiement(s) incomplet(s)");
define("LANGMESS74","Fiche d'�tat des r�glements");
define("LANGacce_dep2ter","<br><b>ATTENTION !  V�rifiez bien votre mode d'acc�s, choisissez votre compte correspondant.</b>");
//NEW NON CORRIGE

define("LANGMESS75","Retour menu principal");
define("LANGMESS76","Correspondance");
define("LANGMESS77","(devoir, contr�le, examen)");
define("LANGMESS78","Trier par ");
define("LANGMESS79","Notes visibles aux �l�ves le ");
define("LANGMESS80","vie scolaire");
define("LANGMESS81","Connexion en cours");
define("LANGMESS82","Moyenne");
define("LANGMESS83","Moyenne de classe");
define("LANGMESS84","Max");
define("LANGMESS85","Min");
define("LANGMESS86","Aucune date trimestrielle affect�e");
define("LANGMESS86bis","pour");
define("LANGMESS86ter","cette ann�e scolaire");
define("LANGMESS87","Note des devoirs de");




define("LANGMESS88","Cahier de texte enregistr�  -- Service Triade");
define("LANGMESS89","Cahier de texte en ");
define("LANGMESS90","Penser � enregistrer votre contenu avant de changer d'onglet.");
define("LANGMESS91","Consultation de la semaine");
define("LANGMESS92","Contenu du cours");
define("LANGMESS93","Fichier joint");
define("LANGMESS94","Piece Jointe");
define("LANGMESS95","Objectif du cours");
define("LANGMESS96","Devoir � faire pour le ");
define("LANGMESS97","non indiqu�");
define("LANGMESS98","Devoir � faire");
define("LANGMESS99","Bloc-Notes");
define("LANGMESS100","Consultation compl�te");
define("LANGMESS101","Validation");
define("LANGMESS102","Consultation");
define("LANGMESS103","Temps estim� pour ce travail ");
define("LANGMESS104","Temps de travail estim� � ");
define("LANGMESS105","Fichier ");
define("LANGMESS106","Modification ");
define("LANGMESS107","Supprimer cette fiche ");
define("LANGMESS108","Temps de travail total estim� ");
define("LANGMESS109","du"); // notion de date du xxxx au xxxx
define("LANGMESS110","au"); // notion de date du xxxx au xxxx
define("LANGMESS111","Format PDF"); 
define("LANGBT288","Consulter / Modifier"); //
define("LANGSITU1","Mari�(e)"); //
define("LANGSITU2","Divorc�(e)"); //
define("LANGSITU3","Veuf"); //
define("LANGSITU4","Veuve"); //
define("LANGSITU5","Concubin"); //
define("LANGSITU6","PACS"); //
define("LANGSITU7","C�libataire"); //
define("LANGFIN002","Ech�ancier");//
define("LANGFIN003","Ech�ancier");//
define("LANGFIN004","Aucune date de configur�e");//
define("LANGCONFIG","Configurer");//

define("LANGMESS112","Commentaire bulletin trimestre/semestre");
define("LANGMESS113","Choix du commentaire");
define("LANGMESS114","Commentaire brevet des coll�ges");
define("LANGMESS115","Visualisation du bulletin de classe");
define("LANGMESS116","Acc�der");
define("LANGMESS117","S�rie");
define("LANGMESS118","Passer en mode �tendu");
define("LANGMESS119","Appr�ciations, Conseils pour progresser");
define("LANGMESS120","Points d'appui. Progr�s. Efforts");
define("LANGMESS121","Ecarts par rapport aux objectifs attendu");
define("LANGMESS122","Conseils pour progresser");
define("LANGMESS123","Moyenne de la classe");
define("LANGMESS124","Commentaire pr�c�dent");
define("LANGMESS125","Ajout dans liste"); // v�rif. pas de quote (') 
define("LANGMESS126","Enregistrer le commentaire"); // v�rif. pas de quote (') 
define("LANGMESS127","Revenir et cliquer sur"); // v�rif. pas de quote (') 
define("LANGMESS128","Enregistrement");  // v�rif. pas de quote (') 
define("LANGMESS129","Consulter");
define("LANGMESS130","Moy. Pr�c�dente");
define("LANGMESS131","Enregistrer les commentaires");
define("LANGMESS132","Patientez S.V.P.");
define("LANGMESS133","Commentaire vide");
define("LANGMESS134","commentaire non enregistr�");
define("LANGMESS135","Appr�ciation pour le bulletin trimestriel classe");
define("LANGMESS136","cliquez-ici");
define("LANGMESS137","Information Scolaire Compl�mentaire");
define("LANGMESS138","Saisir autres commentaires pour les bulletins");

//-----------------Traduction Sam le 06/06/2014
//-----------------messagerie_brouillon.php
define("LANGMESS139","Messagerie brouillon");
define("LANGMESS140","Pr�parer un brouillon ");
define("LANGMESS141","Acc�s");
define("LANGMESS142","Valider un brouillon");
define("LANGMESS143","Les messages brouillons sont visibles par tous les membres de la direction");

//------------------param.php
define("LANGMESS144","Signature du directeur");
define("LANGMESS145","Ann�e scolaire");
define("LANGMESS156","Pays");
define("LANGMESS159","Choix du site");
define("LANGMESS160","Nouveau site");
define("LANGMESS177","D�partement ");
//------------------definir_trimestre.php
define("LANGMESS146","Enregistrement au format semestriel.");
define("LANGMESS147","Toutes les classes");
define("LANGMESS148","Liste des p�riodes trimestrielles ou semestrielles ");
define("LANGMESS149","Modifier");
define("LANGMESS150","Supprimer");
define("LANGMESS157","Trimestre");
define("LANGMESS158","Classe");
//-----------------probleme_acces_2.php
define("LANGMESS151","Identifiez votre compte");
define("LANGMESS152","Veuillez d�abord identifier votre compte pour r�initialiser votre mot de passe.");
define("LANGMESS153","Demande de mot de passe");
//-----------------geston_groupe.php
define("LANGMESS154","Cr�ation de groupe");
define("LANGMESS155","Liste des groupes des enseignants");
//-----------------gestcompte.php
define("LANGMESS161","Gestion de votre compte");
//-----------------messagerie_reception.php
define("LANGMESS162","Gestion de votre compte");
//------------------gestion_groupe.php
define("LANGBT53","Entr�e"); // traduit par sam le 09/06/2014
define("LANGMESS163","V�rification des groupes");
//-------------------messagerie_suppression.php
define("LANGMESS164","Boite de suppression");
define("LANGMESS165","Archiver dans");
//-------------------messagerie_reception.php
define("LANGMESS166","Boite de reception");
//-------------------parametrage.php
define("LANGMESS167","Param�trage de votre compte");
define("LANGMESS168","Actualit�s");
define("LANGMESS169","R�servation Salle / Equipement");
define("LANGMESS170","Messagerie Triade");
define("LANGMESS171","(Indiquer votre  email)");
define("LANGMESS172","(Num�ro de portable)");
//-------------------messagerie_envoi.php
define("LANGMESS173","Message � un groupe ");
define("LANGMESS174","Message aux d�l�gu�s :");
define("LANGMESS175","Message � un membre du personnel : ");
define("LANGMESS176","Message � un tuteur de stage : ");
//-------------------creat_admin.php
define("LANGMESS178","Civ.");
define("LANGMESS179","Indice&nbsp;salaire");
//-------------------creat_tuteur.php
define("LANGMESS180","Cr�ation d'un compte tuteur de stage");
define("LANGMESS181","Liste / Modification d'un tuteur de stage");
define("LANGMESS182","Gestion des membres Tuteur de stage");
define("LANGMESS183","Entreprise li�e");
define("LANGMESS184","En qualit� de ");
//--------------------creat_personnel.php
define("LANGMESS185","Gestion des membres du Personnel");
define("LANGMESS186","Cr�ation d'un compte personnel"); // "Cr&eacute;ation d'un compte personnel"
//--------------------creat_eleve.php
define("LANGMESS187","Rechercher");
define("LANGMESS188","Importer");
define("LANGMESS189","Supprimer");
define("LANGMESS190","Lv1/Sp� :");
define("LANGMESS191","Lv2/Sp� :");
define("LANGMESS192","Boursier");
define("LANGMESS193","Inscription au BDE");
define("LANGMESS194","Inscription � la biblioth�que");
define("LANGMESS195","Montant Bourse");
define("LANGMESS196","Indemnit� Stage");
define("LANGMESS197","Code comptabilit� ");
define("LANGMESS198","Adresse");
define("LANGMESS199","T�l�phone");
define("LANGMESS200","T�l. Portable");
define("LANGMESS201","E-mail Etudiant");
define("LANGMESS202","E-mail universitaire");
define("LANGMESS203","Situation Familiale");
define("LANGMESS204","Copier adresse");
define("LANGMESS205","Classe ant�rieure");
//--------------------creat_class.php
define("LANGMESS206","Intitul� de la classe");
define("LANGMESS207","Ecole");
//--------------------creat_matiere.php
define("LANGMESS208","Format court");
define("LANGMESS209","Format long");
define("LANGMESS210","Code mati�re");
//--------------------reglement.php
define("LANGMESS211","R�glement int�rieur");
define("LANGMESS212","Ajouter un r�glement");
define("LANGMESS213","lister le/les r�glements");
define("LANGMESS214","Supprimer un r�glement");
//--------------------sms.php
define("LANGMESS215","Gestion des SMS");
define("LANGMESS216","Membre");
define("LANGMESS217","Direction");
define("LANGMESS218","Enseignant");
define("LANGMESS219","Vie Scolaire");
define("LANGMESS220","Personnel");
//--------------------Codebar0.php
define("LANGMESS221","Code barre :");
//--------------------vatel_gestion_ue.php
define("LANGMESS222","Gestion des Unit�s d'enseignements");
define("LANGMESS223","Cr�ation d'une unit� d'enseignement");
define("LANGMESS224","Lister/Modifier");
//--------------------base_de_donne_importation.php
define("LANGMESS225","Fichier Excel");
define("LANGMESS226","Fichier XML");
define("LANGMESS227","Code barre");
//--------------------edt.php
define("LANGMESS228","Suppression d'une p�riode ");
define("LANGMESS229","Ajustement des horaires ");
define("LANGMESS230","P�riode visible sur l'EDT");
define("LANGMESS231","Importer image ou pdf : ");
define("LANGMESS232","(format  de l'image : jpg et moins de 2Mo )");
define("LANGMESS233","EDT de la classe : ");
//--------------------export.php
define("LANGMESS234","Exportation des donn�es");
define("LANGMESS235","Informations � exporter");
define("LANGMESS236","Personnel");
define("LANGMESS237","Choix de l'extraction : ");
//--------------------export.php
define("LANGMESS238","Nom de l'enseignant ");
define("LANGMESS239","Exportation au format PDF : ");
define("LANGMESS240","Exporter");
//--------------------commaudio.php
define("LANGMESS241","Sujet : ");
define("LANGMESS242","Fichier audio : ");
//--------------------consult_classe.php
define("LANGMESS243","Impression ");
define("LANGMESS365","&nbsp;Demi&nbsp;Pension&nbsp;");
define("LANGMESS366","&nbsp;Interne&nbsp;");
define("LANGMESS367","&nbsp;Externe&nbsp;");
define("LANGMESS368","&nbsp;Inconnu&nbsp;");
//--------------------resr_admin.php
define("LANGMESS244","R�server via E.D.T.");
//--------------------carnetnote.php
//------------modif nom de l'enseignant---LANGMESS238
//--------------------publipostage.php
define("LANGMESS245","Type membre : ");
define("LANGMESS246","Parents");
define("LANGMESS247","Etudiants");
define("LANGMESS248","Type adresse :");
define("LANGMESS249","Tuteur");
define("LANGMESS327","Publipostage");
define("LANGMESS328","Afficher la civilit&eacute; des &eacute;tudiants : ");
define("LANGMESS329","Afficher matricule : ");
define("LANGMESS330","Afficher Classe : ");
define("LANGMESS331","Afficher Adresse : ");
//--------------------ficheeleve3.php
define("LANGMESS250","Listing Classe");
define("LANGMESS251","Envoyer un SMS");
define("LANGMESS252","Modifier Fiche");
define("LANGMESS253","Affecter &agrave; un stage");
define("LANGMESS254","Bloquer ce compte");
define("LANGMESS255","D�bloquer ce compte");
define("LANGMESS259","Renseignements");
define("LANGMESS260","Carnet de notes");
define("LANGMESS261","Vie Scolaire");
define("LANGMESS262","Disciplines");
define("LANGMESS263","Op�rations effectu�es");
define("LANGMESS264","Info. Tuteur 1");
define("LANGMESS265","Info. Tuteur 2");
define("LANGMESS266","Info. Etudiant");
define("LANGMESS267","Archives");
define("LANGMESS268","Info. m�dicales");
define("LANGMESS269","info. compl.");
define("LANGMESS270","Nom :");
define("LANGMESS271","Pr�nom :");
define("LANGMESS272","Classe :");
define("LANGMESS273","Date&nbsp;de&nbsp;nais.&nbsp;:");
define("LANGMESS274","Nationalit�&nbsp;:");
define("LANGMESS275","Lieu&nbsp;naissance&nbsp;:");
define("LANGMESS276","Boursier :");
define("LANGMESS277","Num�ro&nbsp;Etudiant&nbsp;:");
define("LANGMESS278","Lv1/Sp� :");
define("LANGMESS279","Lv2/Sp� :");
define("LANGMESS280","Option :");
define("LANGMESS281","R�gime :");
define("LANGMESS282","N�&nbsp;Rangement&nbsp;:");
define("LANGMESS283","Contact&nbsp;:");
define("LANGMESS284","Situation&nbsp;familiale&nbsp;:");
define("LANGMESS285","Adresse&nbsp;:");
define("LANGMESS287","Code&nbsp;Postal&nbsp;:");
define("LANGMESS288","Ville&nbsp;:");
define("LANGMESS289","Email&nbsp;:");
define("LANGMESS290","T�l�phone&nbsp;:");
define("LANGMESS291","Profession&nbsp;:");
define("LANGMESS292","T�l.&nbsp;Prof.&nbsp;:");
define("LANGMESS293","Sexe&nbsp;:");
define("LANGMESS294","Classe&nbsp;ant.&nbsp;:");
define("LANGMESS295","Ann�e&nbsp;Scolaire");
define("LANGMESS296","Trim&nbsp;/&nbsp;Sem");
define("LANGMESS297","Bulletin");
define("LANGMESS298","Effectu�&nbsp;le");
define("LANGMESS308","Permission non accord�es");
define("LANGMESS309","Ajouter une information");
define("LANGMESS310","Entretien individuel");
define("LANGMESS311","Planifier abs/rtd");
define("LANGMESS312","Modifier abs/rtd");
define("LANGMESS313","Supprimer abs/rtd");
define("LANGMESS320","$email_eleve / $emailpro_eleve");
define("LANGMESS321","$tel_eleve / $tel_fixe_eleve");

//--------------------elevesansclasse.php
define("LANGMESS256","Save");
//--------------------consult_classe.php
define("LANGMESS257","All classes.");
//--------------------ficheeleve.php
define("LANGMESS258","Search");
//--------------------newsactualite.php
define("LANGMESS299","    Titre : ");
define("LANGMESS300","Votre TRIADE n'est pas configur� en acc�s Internet, veuillez consulter votre compte administrateur Triade pour valider l'option de la connexion Internet.");
define("LANGMESS365","Actualit�s  de la 1er page");
//--------------------actualiteetablissement.php
//--------------------newsdefil.php
//--------------------commaudio.php // Bouton Parcourir
//--------------------commvideo.php
define("LANGMESS301","Lien de la video : ");
define("LANGMESS302","ou Lien Youtube : ");
//--------------------emmargement.php
define("LANGMESS303","Gestion des �margements ");
define("LANGMESS304","Au niveau de la classe");
define("LANGMESS305","Emargement vierge");
define("LANGMESS306","Emargement vierge d'examen");
define("LANGMESS307","Au niveau du groupe");
define("LANGMESS314","Emargement du jour ");
define("LANGMESS315","Emargement&nbsp;du&nbsp;");
define("LANGMESS316","Pour la classe : ");
define("LANGMESS317","Enseignant : ");
define("LANGMESS318","Tous les enseignants : ");
define("LANGMESS319","Hauteur des cellules des �l�ves");
//--------------------trombinoscope0.php
define("LANGMESS322","Imprimer au format PDF des ".INTITULEELEVE);
define("LANGMESS323","Importer les photos au format ZIP");
//--------------------chgmentclas.php
define("LANGMESS324",": notes, absences, retards, dispences, sanctions, retenues, Brevets, Commentaires bulletin de l'�l�ve, droits de scolarit�, plan de classe, Brevets, Affectation stage");
//------LANGASS10-- Variable pour suppression
//--------------------certificat.php
define("LANGMESS325","Param�trage  manuel : ");
define("LANGMESS326","Param�trage  import : ");
//define("LANGMESS331","Publipostage");
//--------------------visa_direction.php
define("LANGMESS332","Type du bulletin : ");
define("LANGMESS333","Valider");
define("LANGMESS334","Annuel"); /// voir si posible de mettre une variable
///////////////////////
//--------------------list_classe.php----- Voir comment changer le bouton Modifier
//--------------------list_matiere.php---- Voir comment changer le bouton Modifier
//--------------------listepreinscription.php
define("LANGMESS335","Liste des pr�-inscriptions");
//--------------------reglement_ajout.php
define("LANGMESS336","R�glement int�rieur");
define("LANGMESS337","r�glement");
define("LANGMESS338","la ou les classe(s)");
define("LANGMESS339","la ou les classe(s)");
//--------------------affectation_visu.php
define("LANGMESS340","Ann�e/Trimestre/Semestre");
define("LANGMESS341","Toute l'ann�e");
define("LANGMESS342","Trimestre 1 / Semestre 1");
define("LANGMESS343","Trimestre 2 / Semestre 2");
define("LANGMESS344","Trimestre 3");
//--------------------affectation_modif_key.php
//----Modidifier le bouton suivant par next
//--------------------reglement_ajout.php
//--------------------reglement_liste.php
// comment modifier le lien Reglement interieur
//----------------/reglement_supp.php
define("LANGMESS345","Visualiser");
//-----------------vatel_list_ue.php
define("LANGMESS346","Gestion des Unit�s d'Enseignements");
define("LANGMESS347","Filtre : ");
define("LANGMESS348","Modifier");
define("LANGMESS349","Supprimer");
define("LANGMESS350","Nom UE");
define("LANGMESS351","Sem.");
define("LANGMESS352","Cr�ation d'une UE");

//----------------creat_groupe.php
define("LANGMESS353","Fichier excel");
define("LANGMESS354","Contenu du fichier excel");
//----------------visa_direction2.php
define("LANGMESS355","Commentaire des enseignants");
define("LANGMESS356","Visa direction");
//----------------imprimer_tableaupp.php
define("LANGMESS357","Impression tableau de notes trimestriel ou semestriel");
define("LANGMESS358","Afficher le classement ");
define("LANGMESS359","Afficher les colonnes vides ");
define("LANGMESS360","Regroupement par module ");
define("LANGMESS361","Afficher les mati�res ");
define("LANGMESS362","Tableau des diff�rentes moyennes au format excel");
define("LANGMESS374","Jusqu'au :");
define("LANGMESS375","Fichier Excel");
//------------------affectation_creation_key.php
//------------------affectation_visu2.php
define("LANGMESS363","Visu");
define("LANGMESS364","Unit� Ens.");
//------------------entretien.php
define("LANGMESS369","Journal d'entretiens individuels");
define("LANGMESS370","Journal d'entretiens group�s ");
define("LANGMESS371","Tableau r�capitulatif");
define("LANGMESS372","&nbsp;Enseignants&nbsp;");
define("LANGMESS373","&nbsp;Nombre&nbsp;d'heures&nbsp;");
//------------------base_de_donne_key.php
define("LANGMESS376","Pour modifier / changer votre code d'acc�s, merci de consulter votre compte ");
define("LANGMESS377","administrateur Triade");
define("LANGMESS378","puis le module \"code d'acc�s\"");
//------------------chgmentClas0.php
// ann�e = Year
define("LANGMESS379","pas d'ann�e");
define("LANGMESS380","Choix de la classe");
//------------------chgmentClas00.php
// ann�e et pas d'ann�e 
define("LANGMESS381","Choix des classes :");
define("LANGMESS383","Changement de classe pour les �l�ves en ");
define("LANGMESS384","Passage pour l'ann�e scolaire");
define("LANGMESS385","Sans classe");
//------------------bro3uillon_reception.php
define("LANGMESS382","Liste des messages brouillons");
//------------------imprimer_trimestre.php
define("LANGMESS386","Bulletin&nbsp;personnalis�");
define("LANGMESS387","Bulletin d�finit pour les enseignants (et parents  prochainement)");
define("LANGMESS388","Visible pour la classe");
define("LANGMESS389","Autoriser l'acc�s aux bulletins pour les enseignants");




// --- NEW ERIC --- // 
define("LANGMESST390","Merci de renseigner les informations n�cessaires � Triade pour le site num�ro 1 !!<br>Merci de confirmer en validant ou revalidant le formulaire suivant.");
define("LANGMESST391","Supprimer site");
define("LANGMESST392","Carnet de suivi");
define("LANGMESST393","COMPTE BLOQUE");
define("LANGMESST394","COMPTE EN PERIODE PROBATOIRE");
define("LANGMESST395","Supprimer la p�riode probatoire");
define("LANGMESST396","Mise en p�riode probatoire");
define("LANGMESST397","Saisie&nbsp;par");
define("LANGMESST398","Enregistrer cette liste");
define("LANGMESST399","Effectuer une recherche complexe");
define("LANGMESST700","Supprimer message en cours");
define("LANGMESST701","Actualit�s  de la 1er page");
define("LANGMESST702","Titre de la vid�o");
define("LANGMESST703","Copier/coller le lien ");
define("LANGMESST704","Indiquer le destinateur du message � transmettre.");
define("LANGMESST705","Message non envoy� ! \\n \\n Vous n'avez pas l'autorisation d'envoyer un message � cette personne.\\n\\n L'Equipe TRIADE. ");
define("LANGTMESS400","Votre demande a bien �t� pris en compte,");
define("LANGTMESS401","Veuillez consulter votre adresse email");
define("LANGTMESS402","Aucun compte pour cet email !!");
define("LANGTMESS403","merci de contacter votre administrateur en cliquant ");
define("LANGTMESS404","sur ce lien ");
define("LANGTMESS405","Contacter l'administrateur TRIADE ");
define("LANGTMESS406","V�rifier");
define("LANGTMESS407","V�rification / Check groupes");
define("LANGTMESS408","Email non valide !!");
define("LANGTMESS409","Merci d'indiquer un email valide.");
define("LANGTMESS410","Les emails <b>hotmail</b> ne sont pas reconnues par nos serveurs.");
define("LANGTMESS411","Merci d'indiquer une autre adresse email.");
define("LANGTMESS412","Nouveau R�pertoire");
define("LANGTMESS413","Message d�j� imprim�");
define("LANGTMESS414","Pi�ce jointe");
define("LANGTMESS415","Archiver dans");
define("LANGTMESS416","Boite de ");
define("LANGTMESS417","Boite de R�ception");
define("LANGTMESS418","Mode Classique");
define("LANGTMESS419","Messages envoy�es ");
define("LANGTMESS420","Vos r�pertoires ");
define("LANGTMESS421","via le mail ");
define("LANGTMESS422","via SMS ");
define("LANGTMESS423","via RSS ");
define("LANGTMESS424","Module lors de votre connexion");
define("LANGTMESS425","Module d'absenteisme");
define("LANGTMESS426","Liste d'une UE ( Modif / Suppr )");
define("LANGTMESS427","PDF EDT Enregistr�");
define("LANGTMESS428","L'Equipe Triade");
define("LANGTMESS429","Image EDT Enregistr�e");
define("LANGTMESS430","EDT Supprim�");
define("LANGTMESS431","Nom de structure d�j� utilis�");
define("LANGTMESS432","Exportation format");
define("LANGTMESS433","&nbsp;Total&nbsp;");
define("LANGTMESS434","colonnes");
define("LANGTMESS435","Tuteur de stage");
define("LANGTMESS436","Afficher Adresse");
define("LANGTMESS437","Tous les parents");
define("LANGTMESS438","Tous les ");
define("LANGTMESS439","Lister / Modification");
define("LANGTMESS440","ajouter");
define("LANGTMESS441","Rangement / Info.");
define("LANGTMESS442","par mois");
define("LANGTMESS443","Nb mois");
define("LANGTMESS444","Code comptabilit�");
define("LANGTMESS445","Universitaire");
define("LANGTMESS446","Editer le RIB");
define("LANGTMESS447","Donn�e d�j� enregistr�e");
define("LANGTMESS448","Site rattach�");
define("LANGTMESS449","D�finition compl�te");
define("LANGCIV0","M.");
define("LANGCIV1","Mme");
define("LANGCIV2","Mlle");
define("LANGCIV3","Ms");
define("LANGCIV4","Mr");
define("LANGCIV5","Mrs");
define("LANGCIV6","M. ou Mme");
define("LANGCIV7","Sr");
define("LANGCIV8","G�n�ral");
define("LANGCIV9","Colonel");
define("LANGCIV10","Lieutenant-Colonel");
define("LANGCIV11","Commandant");
define("LANGCIV12","Capitaine");
define("LANGCIV13","Lieutenant");
define("LANGCIV14","Sous-Lieutenant");
define("LANGCIV15","Aspirant");
define("LANGCIV16","Major");
define("LANGCIV17","Adjudant-Chef");
define("LANGCIV18","Adjudant");
define("LANGCIV19","Sergent-Chef");
define("LANGCIV20","Sergent");
define("LANGCIV21","Caporal-Chef");
define("LANGCIV22","Caporal");
define("LANGCIV23","Aviateur");
define("LANGCIV24","Dr");

define("LANGMESS391","Mode Classique");
define("LANGMESS392","Liste des destinataires");
define("LANGMESS393","Effacer liste"); // lg 262
define("LANGMESS394","S�lectionnez un fichier");
define("LANGMESS395","Liste des membres de la direction");
define("LANGMESS396","Visualiser / Modifier");
define("LANGMESS397","Liste de la Vie Scolaire");
define("LANGMESS398","D�sactiver compte");
define("LANGMESS399","Activer compte");
define("LANGMESS400","Permission");
define("LANGMESS401","Liste des comptes personnels ");
define("LANGMESS403","Liste Tuteur de stage");
define("LANGMESS404","Liste / Modifier");
define("LANGMESS405","M.");
define("LANGMESS406","Mme");
//--------------------list_classe.php
//--------------------modif_classe.php
define("LANGMESS407","Modification d'une classe");
define("LANGMESS408","Activer la classe");
define("LANGMESS409","D�sactiver la classe");
define("LANGMESS410","D�finition compl�te");
define("LANGMESS411","Site rattach�");
//--------------------affectation_creation.php
//-------------------publipostage.php
define("LANGMESS412","Type de vignette");
define("LANGMESS413","Type de membre");
//-------------------list_matiere.php
//-------------------modif_matiere.php
define("LANGMESS414","Type de membre");
define("LANGMESS415","Code mati�re");
define("LANGMESS416","Nom de la sous-mati�re");
define("LANGMESS417","Supprimer sous mati�re");
define("LANGMESS418","D�sactiver mati�re");
define("LANGMESS419","Activer mati�re");
//-------------------triadev1/circulaire_liste.php
define("LANGMESS420","R�f�rence");
//-------------------visu_retard_parent.php
//-------------------messagerie_envoi.php
define("LANGMESS421","Vous n'avez pas l'autorisation d'envoyer un message � cette personne.");
//-------------------information.php
define("LANGMESS422","Informations scolaires");
//-------------------parametrage.php
define("LANGMESS423","Module lors de votre connexion ");
define("LANGMESS424","Actualit�s");
define("LANGMESS425","Module d'absenteisme");
//-------------------retardprof.php
define("LANGMESS426","Indiquez des �l�ves en retard ou absent");
//-------------------retardprof2.php
define("LANGMESS427","Indiquer heure d'abs/rtd");
define("LANGMESS428","En ");
define("LANGMESS429","Horaire : ");



define("LANGTMESS450","Traduction autre langue");
define("LANGTMESS451","Actuellement le fichier import sert de r�f�rence � la cr�ation du certificat.");
define("LANGTMESS452","R�cup�rer");
define("LANGTMESS453","Certificat num�ro :");
define("LANGTMESS454","Ajouter une inscription :");
define("LANGTMESS455","Nouveau");
define("LANGTOUS","Tous");
define("LANGTMESS456","En attente");
define("LANGTMESS457","Accept�");
define("LANGTMESS458","R�fus�");
define("LANGTMESS459","D�cision");
define("LANGTMESS460","Transferer liste en classe");
define("LANGTMESS461","Destruction fiche(s)");
define("LANGTMESS462","Attention !, le r�glement doit �tre au format pdf et ne pas d�passer deux m�ga oct�.");
define("LANGTMESS463","Cette option permet aux enseignants, de valider le r�glement au moment de leur premiere connexion.");
define("LANGTMESS464","El�ve(s) au total.");
define("LANGTMESS465","Commentaire pour le");
define("LANGTMESS466","Afficher les sous-mati�res");
define("LANGTMESS467","Prise en compte note examen");
define("LANGTMESS468","Prise en compte coef � z�ro");
define("LANGTMESS469","Si le coefficient est � z�ro, les points sup�rieurs � 10 seront pris en compte.");
define("LANGTMESS470","Sp�cif");
define("LANGTMESS471","Etude de cas");
define("LANGTMESS472","Visu : Visualisation dans le bulletin");
define("LANGTMESS473","pour l'ann�e :");
define("LANGTMESS474","changer");
define("LANGTMESS475","Fichier Taille Max");
define("LANGTMESS476","Liste / Modifier un compte personnel");
define("LANGTMESS477","Liste / Modifier un tuteur de stage");
define("LANGTMESS478","Via code barre");
define("LANGTMESS479","Valider les pr�sents");
define("LANGTMESS480","Visa direction");
define("LANGTMESS481","Commentaires pour les ".INTITULEELEVES);


define("LANGTMESS482","ACTUALITES - TRIADE");
define("LANGTMESS483","non disponible");
define("LANGTMESS484","Vos r�pertoires");
define("LANGTMESS485","Messages aux d�l�gu�s");
define("LANGTMESS486","Modifier des circulaires");


define("LANGMESS430","L'ann�e compl�te");
define("LANGMESS431","Avec notes partiel Vatel ");
define("LANGMESS432","Type du bulletin");
define("LANGMESS433","Enregistrement par code barre");
define("LANGMESS434","Valider les pr�sents");
define("LANGMESS435","Courrier");
define("LANGMESS436","Relev�s sans abs, ni rtd");
define("LANGMESS437","Listing des absences");
define("LANGMESS438","Absences par semaine");
define("LANGMESS439","Imprimer absences / retards");
define("LANGMESS440","Liste des pr�sents");
define("LANGMESS441","Gestion abs/rtd via sconet");
define("LANGMESS442","Statistiques Abs / Rtd ");
define("LANGMESS443","Gestion des absences et retards d'un ".INTITULEELEVE);
define("LANGMESS444","Planifier&nbsp;");
define("LANGMESS445","&nbsp;Consulter&nbsp;/&nbsp;Modifier&nbsp;");
define("LANGMESS446","&nbsp;Supprimer&nbsp;");
define("LANGMESS447","Acc�der");
define("LANGMESS448","&nbsp;Convertir&nbsp;abs.&nbsp;");
define("LANGMESS449","Configuration");
define("LANGMESS450","Gestion alertes");
define("LANGMESS451","Configuration cr�neau horaire ");
define("LANGMESS452","Configuration  SMS ");
define("LANGMESS453","Cr�diter des SMS");

define("LANGTMESS487","Avec notes vie scolaire");
define("LANGTMESS488","Rattrapage non valid�s");

define("LANGTRONBI30","Visualisation Trombinoscope du personnel");
define("LANGTRONBI20","Modifier Trombinoscope du personnel");

define("LANGSEXEF","F");
define("LANGSEXEH","H");
define("LANGHOM","Homme");
define("LANGFEM","Femme");

define("LANGTMESS489","Dupliquer l'EDT");
define("LANGTMESS490","Dupliquer l'EDT d'une classe vers une autre");
define("LANGTMESS491","P�riode � copier");
define("LANGTMESS492","Import du personnel de direction : ");
define("LANGTMESS493","Import des comptes du personnel : ");
define("LANGTMESS494","Import des entreprises : ");
define("LANGTMESS495","Import Sp�cif. IPAC : ");
define("LANGTMESS496","Import des mati�res : ");
define("LANGTMESS497","Module d'importation de fichier : ");
define("LANGTMESS498","Module d'importation de fichier Excel ");
define("LANGTMESS499","Le fichier excel � transmettre DOIT contenir 4 champs");
define("LANGTMESS500","Exemple fichier xls");
define("LANGTMESS501","Nombre de mati�re ajout�e : ");
define("LANGTMESS502","Dates Trimestrielles");
define("LANGTMESS503","Votre acc�s est actuellement d�sactiv�.");



define("LANGTMESS504","Envoyer mot de passe par mail");
define("TITREACC1","parents");      // Info au niveau de la page d'accueil "Acc�s Parents"  
define("TITREACC2","Enseignants");  // Info au niveau de la page d'accueil "Acc�s Enseignants"  
define("TITREACC3","Vie scolaire"); // Info au niveau de la page d'accueil "Acc�s Vie scolaire"  
define("TITREACC4","Tuteur Stage"); // Info au niveau de la page d'accueil "Acc�s Tuteur Stage"  
define("TITREACC5","Personnels");   // Info au niveau de la page d'accueil "Acc�s Personnels"  
define("LANGTMESS505","Classe ant�rieures");
define("LANGTMESS506","Sp�cialisation");

define("LANGTMESS507","Sortie suppl�ment au titre");
define("LANGTMESS508","Configuration suppl�ment au titre");
define("LANGTMESS509","Gestion d'examen");
define("LANGTMESS510","Choix du document :");
define("LANGTMESS511","R�cup�rer le fichier ZIP Suppl�ments Titre");
define("LANGTMESS512","Niveau scolaire");
define("LANGTMESS513","Publipostage des soci�t�s ");
define("LANGTMESS514","Import des entreprises");
define("LANGTMESS515","Indemnit� de stage");
define("LANGTMESS516","Suivi des demandes de convention");
define("LANGTMESS517","Gestion suppl�ment au titre");
define("LANGTMESS518","Libell� :");
define("LANGTMESS519","Fichier");


define("LANGTMESS520","Nom du stage");
define("LANGTMESS521","En Entreprise le : ");
define("LANGTMESS522","Pays");
define("LANGTMESS523","Groupe h�telier");
define("LANGTMESS524","Nombre d'�toiles");
define("LANGTMESS525","Nombre de chambres");
define("LANGTMESS526","Site web");
define("LANGTMESS527","Affectation de plusieurs �tudiants � un stage");
define("LANGSTAGE100","Nom");
define("LANGSTAGE101","N� Stage");
define("LANGSTAGE102","Entreprise");
define("LANGSTAGE103","Service");
define("LANGSTAGE104","Indemnit�");
define("LANGSTAGE105","Log�");
define("LANGSTAGE106","Nourri");
define("LANGSTAGE107","Valider");
define("LANGSTAGE108","Stage personnalis�");
define("LANGSTAGE109","Pays");
define("LANGSTAGE110","Tuteur de stage");
define("LANGSTAGE111","Langue parl� durant le stage");
define("LANGSTAGE112","Intitul� du service");
define("LANGSTAGE113","Indemnit�s de stage");
define("LANGSTAGE114","Horaires journaliers");
define("LANGSTAGE115","Les conventions de stage");
define("LANGSTAGE116","Sortie des conventions group�es");

define("LANGTMESS528","Langue de la classe");
define("LANGTMESS529","Retour classe");
define("LANGTMESS530","R�cuperation des conventions de stage");


define("LANGVATEL1","D&eacute;connexion");
define("LANGVATEL2","Me connecter");
define("LANGVATEL3","Mot de passe oubli&eacute;");
define("LANGVATEL4","Ecris ton email");
define("LANGVATEL5","Ecris ton mot de passe");
define("LANGVATEL6","Semestre");
define("LANGVATEL7","Abs/Rtd/Sanction");
define("LANGVATEL8","Absences / Retards / Sanctions");
define("LANGVATEL9","Absences");
define("LANGVATEL10","Retards");
define("LANGVATEL11","Sanctions");
define("LANGVATEL12","Description des faits");
define("LANGVATEL13","<");
define("LANGVATEL14",">");
define("LANGVATEL15","Mois");
define("LANGVATEL16","R&eacute;initialiser votre mot de passe");
define("LANGVATEL17","Mot de passe oubli&eacute; ?");

define("LANGVATEL18","Acc&egrave;s Etudiant");
define("LANGVATEL19","Acc&egrave;s Enseignant");
define("LANGVATEL20","Acc&egrave;s Direction");

define("LANGVATEL21","Ajouter");
define("LANGVATEL22","Modifier");
define("LANGVATEL23","Supprimer");
define("LANGVATEL24","Visualiser");
define("LANGVATEL25","Quoi de neuf ?");
define("LANGVATEL26","Notes");
define("LANGVATEL27","Statistiques de ce devoir");
define("LANGVATEL28","IMPOSSIBLE");
define("LANGVATEL29","Semestre d�j� pass�.");
define("LANGVATEL30","Ajouter �l�ve");
define("LANGVATEL31","Ajouter une note � un �l�ve pour ce devoir.");
define("LANGVATEL32","Retour sur la liste des devoirs");
define("LANGVATEL33","Emploi du temps");
define("LANGVATEL34","Absent�isme");
define("LANGVATEL35","absent(s) sign�(s)");
define("LANGVATEL36","Calendrier");
define("LANGVATEL37","Probl�me d'enregistrement");
define("LANGVATEL38","Indiquer la date");


define("LANGVATEL39","Accueil");
define("LANGVATEL40","Choix de l'enseignant");
define("LANGVATEL41","pour l'enseignant");
define("LANGVATEL42","Enseignant affect� � ce devoir");
define("LANGVATEL43","Absences ou retards en classe de");
define("LANGVATEL44","Autres absences");
define("LANGVATEL45","Autres absences pour la m�me classe");
define("LANGVATEL46","Signal� le ");
define("LANGVATEL47","Gestion Absences / Retards");
define("LANGVATEL48","Avertir par messagerie ");
define("LANGVATEL49","Mise � jour des tables");
define("LANGVATEL50","Impossible de supprimer cette classe");
define("LANGVATEL51","Classe non supprimable");
define("LANGVATEL52","Classe affect�e");
define("LANGVATEL53","Supprimer cette classe");
define("LANGVATEL54","Supprimer cette mati�re");
define("LANGVATEL55","Impossible de supprimer cette mati�re");
define("LANGVATEL56","Mati�re affect�e � une classe");
define("LANGVATEL57","Si pas de pr�nom, indiquer 'inconnu' ");
define("LANGVATEL58","Cr�ation d'un compte administratif");

define("LANGVATEL59","Liste des Tuteurs de stage");
define("LANGVATEL60","Liste des enseignants");
define("LANGVATEL61","Liste du personnel administratif");
define("LANGVATEL62","Liste des membres de la vie scolaire");
define("LANGVATEL63","R�glement int�rieur");
define("LANGVATEL64","Classes");
define("LANGVATEL65","Personnel administratif");
define("LANGVATEL66","Tuteur de stage");
define("LANGVATEL67","R�glement interieur non enregistr�");
define("LANGVATEL68","Le fichier doit �tre au format pdf et inf�rieur � 2Mo");
define("LANGVATEL69","Menu");
define("LANGVATEL70","Acc�s au PDF de la classe");
define("LANGVATEL71","Acc�s au PDF du r�gime");
define("LANGVATEL72","Imprimer au format PDF");
define("LANGVATEL73","Modifier la photo de ");
define("LANGVATEL74","Groupes");
define("LANGVATEL75","Cr�ation d'un groupe");
define("LANGVATEL76","Voir cette liste");
define("LANGVATEL77","aucun �tudiant");
define("LANGVATEL78","Modifier ce groupe");
define("LANGVATEL79","Gestion des groupes");
define("LANGVATEL80","Groupe NON supprim�");
define("LANGVATEL81","Groupe supprim�");
define("LANGVATEL82","Le groupe est actuellement affect�.\\n\\n Impossible de le supprimer.\\n\\n Modifier l\\'affectation avant de supprimer ce groupe.");
define("LANGVATEL83","Groupe d�j� cr��.");


define("LANGVATEL84","Param�trage Bulletin");
define("LANGVATEL85","Param�trage Ecole");
define("LANGVATEL86","Mise en place des affectations");
define("LANGVATEL87","Modification des affectations");
define("LANGVATEL88","Suppression des affectations");
define("LANGVATEL89","Unit� d'enseignement");
define("LANGVATEL90","Param�trage des absences");
define("LANGVATEL91","Param�trage des certificats de scolarit�");
define("LANGVATEL92","Param�trage du suppl�ment");
define("LANGVATEL93","Indiquer le jour et le mois du d�but de votre ann�e scolaire : ");
define("LANGVATEL94","Indiquer le jour et le mois de la fin de votre ann�e scolaire : ");
define("LANGVATEL95","Erreur de saisie sur vos jours ou mois indiqu�s");
define("LANGVATEL96","Indiquer l'ann&eacute;e scolaire");
define("LANGVATEL97","IMPORTANT, LA CREATION D'AFFECTATION SUPPRIME TOUTES LES INFORMATIONS DE NOTATION DE LA NOUVELLE CLASSE CONCERNEE !!");
define("LANGVATEL98","Copier Affectation");
define("LANGVATEL99","ERREUR DE COPIE");
define("LANGVATEL100","de l'ann�e scolaire");
define("LANGVATEL101","IMPORTANT, LA COPIE D'AFFECTATION SUPPRIME TOUTES LES INFORMATIONS DE NOTATION DE LA NOUVELLE CLASSE CONCERNEE !!");
define("LANGVATEL102","Copier l'affectation de la classe ");
define("LANGVATEL103","Etude de cas");
define("LANGVATEL104","Supprimer les notes scolaires de cette classe.");
define("LANGVATEL105","* Visu. : Visualiser au sein du bulletin / ** Nombre d'heure annuelle / *** Visu. : Visualiser au sein du bulletin AFTEC BTS BLANC");
define("LANGVATEL106","Indiquer un enseignant");
define("LANGVATEL107","Indiquer le coef de la mati�re");
define("LANGVATEL108","Indiquer une valeur Num�rique");
define("LANGVATEL109","D�placer la ligne en effectuant un drag&drop");
define("LANGVATEL110","cliquer/deplacer");
define("LANGVATEL111","sur le N� correspondant");
define("LANGVATEL112","Copier unit� enseignement");
define("LANGVATEL113","Liste des unit�s d'enseignements");
define("LANGVATEL114","ATTENTION !! METTRE A JOUR LES AFFECTATIONS DE LA CLASSE ");
define("LANGVATEL115"," SUR LES DONNEES UNITE D'ENSEIGNEMENT ");
define("LANGVATEL116"," au sein du bulletin de z�ro � n ");
define("LANGVATEL117","Valider la suppression");
define("LANGVATEL118","Etes vous sur de vouloir supprimer l'unit� d'enseignement suivante ?");
define("LANGVATEL119","Suppresion effectu�e");
define("LANGVATEL120","Config. cr�neaux horaires");
define("LANGVATEL121","Config. des motifs");
define("LANGVATEL122","Nom du cr�neau");
define("LANGVATEL123","Heure de d�part");
define("LANGVATEL124","Heure de fin");
define("LANGVATEL125","Intitul� du cr�neau");
define("LANGVATEL126","Enregistrer les cr�neaux horaires");
define("LANGVATEL127","Cr�neaux par d�faut");
define("LANGVATEL128","Certificat num�ro");
define("LANGVATEL129","Param�trage certificats");
define("LANGVATEL130","Importer un certificat");
define("LANGVATEL131","Erreur d'enregistrement");
define("LANGVATEL132","Certificat en cours");
define("LANGVATEL133","Configuration des mots clefs");

define("LANGVATEL134","Erreur d'enregistrement");
define("LANGVATEL135","Erreur : Fichier non reconnu ");
define("LANGVATEL136","Erreur : Fichier supp�rieur � 8 MO");
define("LANGVATEL137","Fichier NON enregistr�");
define("LANGVATEL138","Editions / Listes");
define("LANGVATEL139","Editions par classe");
define("LANGVATEL140","Liste des �tudiants");
define("LANGVATEL150","Tableau de bord de toutes les classes.");
define("LANGVATEL151"," El�ve(s) au total. Ann�e Scolaire : ");
define("LANGVATEL152"," El�ve(s) au total ");
define("LANGVATEL153","Liste d'�margements");
define("LANGVATEL154","Aucun cours d�finis sur l'emploi du temps.");
define("LANGVATEL155","Horaire d�but");
define("LANGVATEL156","Horaire fin");
define("LANGVATEL157","Intitul� du cours");
define("LANGVATEL158","Liste des enseignants");
define("LANGVATEL159","Liste des mati�res");
define("LANGVATEL160","Editions des certificats de scolarit�");
define("LANGVATEL161","Documents de certificats de scolarit�");
define("LANGVATEL162","R�cup�ration des certificats au format ZIP");
define("LANGVATEL163","Liste des entretiens");
define("LANGVATEL164","Edition �tiquettes Etudiants");
define("LANGVATEL165","Edition �tiquettes Parents");
define("LANGVATEL166","R�cup�ration du document Publipostage");
define("LANGVATEL167","Import / Export");
define("LANGVATEL168","Importer des �tudiants");
define("LANGVATEL169","Importer des enseignants");
define("LANGVATEL170","Importer du personnel direction");
define("LANGVATEL171","Importer des entreprises");
define("LANGVATEL172","Exporter des �tudiants");
define("LANGVATEL173","Exporter des enseignants");
define("LANGVATEL174","Exporter du personnel direction");

define("LANGVATEL175","Adresse �l�ve");
define("LANGVATEL176","Commune �l�ve");
define("LANGVATEL177","CCP �l�ve");
define("LANGVATEL178","T�l. fixe �l�ve");
define("LANGVATEL179","Boursier");
define("LANGVATEL180","Email Universitaire");
define("LANGVATEL181","Sexe �l�ve");
define("LANGVATEL182","Mot de passe tuteur 2");
define("LANGVATEL183","R�gime possible");
define("LANGVATEL184","Civilit� possible");
define("LANGVATEL185","Le fichier � transmettre DOIT contenir 47 champs");
define("LANGVATEL186","Exemple fichier xls");
define("LANGVATEL187","Prendre la premi�re ligne du fichier ");
define("LANGVATEL188","Effectuer une mise � jour ");
define("LANGVATEL189","Prendre en compte les champs vides du fichier");
define("LANGVATEL190","Affecter un nouveau mot de passe pour les �l�ves d�j� inscrits");
define("LANGVATEL191","Pas d'archivage possible");
define("LANGVATEL192","Attention la suppression des l'�l�ves, supprimera toutes les archives !!");
define("LANGVATEL193","Import pour l'ann�e scolaire suivante : ");
define("LANGVATEL194","ERREUR CLASSE NON CREEE -- Service Triade");
define("LANGVATEL195","Le fichier � transmettre DOIT contenir 9 champs");
define("LANGVATEL196","ERREUR sur le mot de passe de la personne");
define("LANGVATEL197","Ajouter d'autres colonnes");
define("LANGVATEL198","nbr de colonne(s) suppl�mentaire(s)");
define("LANGVATEL199","Indiquer les donn�es � exporter");
define("LANGVATEL200","Sauvegarder la structure");
define("LANGVATEL201","Si vous souhaitez sauvegarder la structure de l'exporation, r�cup�rez d'abord votre fichier excel, puis cliquez sur le bouton \"Sauvegarder la structure\"");
define("LANGVATEL202","Nom de la structure");
define("LANGVATEL203","R�cup�ration de l'exportation");
define("LANGVATEL204","Indiquer l'ordre des colonnes dans votre fichier excel");
define("LANGVATEL205","Bulletin scolaire");

define("LANGVATEL206","Bulletin / Suppl�ment au dipl�me");
define("LANGVATEL207","Appr�ciations de la direction");
define("LANGVATEL208","Appr�ciations de la classe");
define("LANGVATEL209","Editions des notes");
define("LANGVATEL210","Edition des bulletins scolaires");
define("LANGVATEL211","Edition suppl�ment Bachelor / Master");
define("LANGVATEL212","Commentaires enregistr�s");
define("LANGVATEL213","V�rifier vos affectations pour cette classe");
define("LANGVATEL214","Gestion des dates de stage");
define("LANGVATEL215","Gestion des entreprises");
define("LANGVATEL216","Affectation des �tudiants aux stages");
define("LANGVATEL217","Liste des �tudiants en entreprise");
define("LANGVATEL218","Edition des conventions");
define("LANGVATEL219","Ajouter une p�riode");
define("LANGVATEL220","Liste des p�riodes");
define("LANGVATEL221","La date de fin de stage ne peut �tre avant la date de d�but");
define("LANGVATEL222","Modifier une p�riode");
define("LANGVATEL223","Supprimer une p�riode");
define("LANGVATEL224","Suppression de toutes les dates non affect�es � un �tudiant");
define("LANGVATEL225","Lister");
define("LANGVATEL226","Gestion Stage");
define("LANGVATEL227","Imprimer la liste des entreprises");
define("LANGVATEL228","Nbre d'�l�ves ayant effectu� un stage");
define("LANGVATEL229","Plan");
define("LANGVATEL230","Historique des �l�ves");
define("LANGVATEL231","R�cup�ration du fichier PDF");
define("LANGVATEL232","Adresse / CCP / Ville");
define("LANGVATEL233","Listing des entreprises en date du ");
define("LANGVATEL234","Affectation de plusieurs �tudiants � un stage");
define("LANGVATEL235","Affectation d'un �tudiant � un stage");
define("LANGVATEL236","D�but");
define("LANGVATEL237","Fin");
define("LANGVATEL238","Pour la p�riode : Semestre / Trimestre");
define("LANGVATEL239","P�riode d�sir�e");
define("LANGVATEL240","Indiquer le num�ro de stage ou du stage personnalis�");
define("LANGVATEL241","Imprimer la liste compl�te");

define("LANGVATEL242","Edition des affectations");
define("LANGVATEL243","Autre classe");
define("LANGVATEL244","Mise en place de l'EDT");


define("LANGVATEL245","Veuillez choisir le type de compte souhait&eacute;");
define("LANGVATEL246","Mise &agrave; jour des tables");
define("LANGVATEL247","Gestion Absences / Retards");
define("LANGVATEL248","Ajouter une absence ou un retard");
define("LANGVATEL249","Pour le personnel");
define("LANGVATEL250","Pour la vie scolaire");
define("LANGVATEL251","Pour tuteurs de stage");
define("LANGVATEL252","Pour la direction");
define("LANGVATEL253","la ou les classe(s)");
define("LANGVATEL254","Param&eacute;trage");
define("LANGVATEL255","Mise en place de l'EDT");

define("LANGVATEL256","Indiquer la liste des parents d'�tudiants qui recevront un email");
define("LANGVATEL257","Aucun num�ro");
define("LANGVATEL258","Confirmer envoi SMS");
define("LANGVATEL259","Port. El�ve ");
define("LANGVATEL260","Portable ");
define("LANGVATEL261","Tel Prof. M�re ");
define("LANGVATEL262","Tel Prof. P�re ");
define("LANGVATEL263","Vid�o Projecteur ");
define("LANGVATEL264","D�tail ABS/Rtd ");
define("LANGVATEL265","Cr�neaux ");
define("LANGVATEL266","non pr�cis� ");
define("LANGVATEL267","Lister / Modifier des enseignants ");
define("LANGVATEL268","Supprimer un compte ");
define("LANGVATEL269","Abs/Rtd Etudiant ");
define("LANGVATEL270","Absences et Retards d'un �tudiant");
define("LANGVATEL271","Cr�ation impossible, ann�e scolaire non indiqu�e.");
define("LANGVATEL272","Nouvelle unit� d'enseignement cr��e.");
define("LANGVATEL273","Trombinoscope");


?>
