<?php
/****
* Titre........... : Mysqldump en PHP sans mysqldump
* Description..... : Fait la meme chose que mysqldump mais en PHP sans utiliser le shell avec des +
* version......... : 0.53
* date............ : 20 avril 2003
* fichier......... : phpmysqldump.pclass
* Auteur.......... : Pascal CASENOVE  phpdev@cawete.com
*
* remarques ...... : Le fichier de sauvegarde est creer dans le repertoire du script
* 					 vous devez donc avoir le droit d'ecrire dans ce repertoire
*					 la securite n'est pas geree par cette class. Si vous ne le faite pas
*					 avec des htaccess ou du code n'importe quel visiteur peut avoir une copie de vos bases
*					 Si vous avez un message d'erreur du style temps limite enlevez le // devant la ligne set_time_limit(30)
*					 Cela permet de réussir les grosses sauvegardes sur des serveurs lents ( quand le query prend plus de 30 Secondes)
*
* licence......... : The GNU General Public License (GPL)
*					 http://www.opensource.org/licenses/gpl-license.html
*
* changements..... : suppression de bugs set_timeout, separe ( merci à ADL )
*					 ajout de la sauvegarde au vol sans compression du fichier
*
* A faire......... : compression a la vollee
*					 une autre class en preparation pour sauvegarder en une seule opreration
*					 les bases et le site dans un seul fichier compresse
*
* Suggestion...... : Pour toutes remarques, suggestions ... n'hésitez pas à me contacter
*					 pascal@cawete.com
*
* Description 2... : Pour faire une sauvegarde d'une base MySQL l'outil habituel est mysqldump
*					 fourni avec MySQL.
*					 Pour l'utiliser en PHP il faut avoir un acces au shell et qu'il soit dans le path.
*					 Cela n'est pas toujour le cas selon l'hebergeur, le systeme, Microsoft, Linux ...
*					 J'avais besoin d'un outil qui me genere une sauvegarde totale de base au format
*					 le plus courant et independant de la plateforme.
*					 Comme la sauvegarde doit pouvoir etre faite par un utilisateur de base, le systeme
*					 doit etre simple: j'ouvre la page web je telecharge le fichier, c'est fini.
*					 le fichier peut etre compresse avec la gzlib de PHP,donc sans utiliser le shell et
*					 quelque soit le systeme d'exploitation.
*
*					 Pour la restoration je n'ai rien prevu, simplement parceque pour reconstruire une base
*					 il vaut mieux savoir et verifier ce que l'on fait. il vaut donc mieux utiliser un des
*					 nombreux outils prevus a cet effet qui travaillent en direct sur le port MySQL.
*					 Certain outils de traitement des fichier sql ne suppoortent pas les commantaire.
*					 en mettant $class->format_out = "no_comment" le probleme est regle
*
* Methodes........ : **nettoyage() permet de vider le repertoire temporaire dans lequel sont crees les sauvegardes
*					 si cette methode n'est pas utilisee les sauvegardes sont archivées
*
*                    **backup($fichier) realise la sauvegarde dans le fichier $fichier
*					 si $fichier est ommis un nom de fichier est attribue (methode recomandee)
*					 le fichier est cree dans un sous repertoire temp du repertoire ou s'execute le script
*					 Si temp n'existe pas il est cree
*					 verifiez bien si vous avez le droit d'ecrire.
*
*					 **compress() compresse au format gzip le fichier cree avec backup et le renome en .gz
*					   il vaut mieux utiliser le flag compress_ok pour activer ou desactiver l'utilisation de la methode
*
* Proprietes...... : **format_out si ="no_comment" la sauvegarde est faite sans commentaires
*					 utilie pour certains outils de restoration. A n'utiliser que si votre outil de restoration
*					 ne lit pas correctement le fichier
*					 $fly la sauvegarde n'est pas écrite sur le disque elle est directement telegargee
*					 $compress_ok active la compression gz sauf si $fly
*
* Parametres...... : $sav = new phpmysqldump($link, $host, $user, $password, $base, $langue);
*					 $link est un link vers une base deja ouverte, les autres parametre sont alors ""
*					 si $link est "" les autres parametres sont utilises et n'ont pas besoin de commentaires
*					 se sont les parametre de la base a sauvegarder
*   				 $langue par defaut "fr" "en" supporte le reste viendra
****/

/*******************************************************************
*
*    class
*
********************************************************************/
class phpmysqldump
{
	var $link;			// lien vers la base a sauvegarder
	var $base;			// nom de la bse
	var $errr;			// remontees d'erreurs
	var $host;			// nom ou ip du serveur de MySQL
	var $filename; 			// nom du fichier de sauvegarde
	var $sousdir="../data/dump/";	// sous repertoire dans lequel s'effectue la sauvegarde avec le / final
	var $version="0.53";
	var $format_out;		// format de sortie null : mysql dump "no_comment" idem sans commentaires
	var $language;			// pret pour d'autres langues defaut "fr" sinon "en" "sp" "ge"
	var $fly;			// flag si oui sauvegarde au vol
	var $compress_ok;		// flag pour la compression
//**** constructeur *********************************************
	function phpmysqldump( $host, $user, $password, $base, $langue="fr", $link=NULL)
	{
		$this->language=$langue;
		if($link){
			$this->link = $link;
		}else{
			$this->link = @mysql_connect($host, $user, $password);
			if(!$this->link ){$this->errr=$this->message("err_mysql"); return false;}
		}

		if(!mysql_select_db($base)){$this->errr=$this->message("err_base"); return false;}
		$this->base=$base;
		$this->host=$host;
	}
//**** fin du constructeur **************************************
	function ecrire($fp, $val){
		if($this->fly){echo $val;}else{fwrite($fp, $val);}
	}
	function entete($filename){
		header( "Content-type: application/force-download");
    	header( "Content-Disposition: inline; filename=\"" . $filename . "\"");
		header( "Expires: Mon, 1 Jul 1999 01:00:00 GMT");
    	header( "Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
		//ob_start("ob_gzhandler");
	}
//************** dump de la base vers un fichier*****************
	function backup($fichier="") 	// si $fichier null ignoré sinon utilise comme nom de fichier de sauvegarde
	{
		if($this->fly){$this->sousdir="";}
		if($this->errr)
		{
			return false;
		}else{

			if($fichier){ 				// *** si un nom de fichier en parametre on l'utilise
				$this->filename=$this->sousdir.$fichier;
			}else{						// *** sinon on en genere un
				$this->filename = $this->sousdir."backup_".$this->base."_".date("Y_m_d__G_i").".sql";
			}
		   if($this->fly){  // sauvegarde a la volee
		   		$this->entete($this->filename);
		   }else{
		   		@mkdir($this->sousdir,700);	// creation du repertoire s'il n'existe pas
		   		$fp = @fopen($this->filename,"w");
				if (!$fp){$this->errr=$this->message("err_fichier"); return false;}
		   }

		   if($this->format_out<>"no_comment"){
				// en tete du fichier dump
				$this->ecrire($fp,"--TRIADE MySQLDump $this->version \n");
				$tt=$this->spe();			// voir remarques à la fin
				$this->ecrire($fp,"$tt \n");
				$this->ecrire($fp,"--\n");
				$this->ecrire($fp,"--Host : $this->host     Database :  $this->base\n");
				$this->ecrire($fp,"-----------------------------------------------\n");
				$server_info=mysql_get_server_info($this->link);
				$this->ecrire($fp,"--Server version            $server_info \n");
				$this->ecrire($fp,"\n");
			}
			// liste des tables
			$ltable = mysql_list_tables($this->base,$this->link);
			$nb_row = mysql_num_rows($ltable);

			$i = 0;
			while ($i < $nb_row)
			{ 	$tablename = mysql_tablename($ltable, $i);
				if($this->format_out<>"no_comment"){
					$this->ecrire($fp,"\n");
					$this->ecrire($fp,"\n");
					$this->ecrire($fp,"--\n");
					$this->ecrire($fp,"-- Table structure for table '$tablename' \n");
					$this->ecrire($fp,"--\n");
					$this->ecrire($fp,"\n");
				}
				// debut du query on vire la table si elle existe deja
				$this->ecrire($fp,"DROP TABLE IF EXISTS `$tablename`;\n");

				// creation des tables
				$query = "SHOW CREATE TABLE $tablename";
				$tbcreate = mysql_query($query);
				$row = mysql_fetch_array($tbcreate);
				$create = $row[1].";";
				$this->ecrire($fp,"$create\n\n");
				if($this->format_out<>"no_comment"){
					$this->ecrire($fp,"--\n");
					$this->ecrire($fp,"-- Dumping data for table '$tablename' \n");
					$this->ecrire($fp,"--\n");
					$this->ecrire($fp,"\n");
				}
				// recuperation des data
				$query = "SELECT * FROM $tablename";
				$datacreate = mysql_query($query);
				if (mysql_num_rows($datacreate) > 0) 	// *** si la table n'est pas vide
				{
					// sauvegarde des donnees
					$qinsert = "LOCK TABLES $tablename WRITE; \n";
					$qinsert .= "INSERT INTO `$tablename` values \n  ";

					while($row12 = mysql_fetch_assoc($datacreate))
					{   //set_time_limit(30);  		// set this line in comment if your server is in safe mode
						   $row12 = array_map(array($this, 'separe'), $row12);// mise en forme des data dans le tableau
						   $data = implode(",",$row12);				// tableau -> chaine unique
						   $data = "$qinsert($data)";				// assemblage pour value() pour 1er enregistrement
						   $this->ecrire($fp,"$data\n");
						   $qinsert=", ";		// pour les enregistrements suivant une virgule suffit
					}
					$this->ecrire($fp,";\n");
					$this->ecrire($fp,"UNLOCK TABLES; \n");
					$this->ecrire($fp,"\n");
				}else{								// *** si la table est vide
					if($this->format_out<>"no_comment"){
						$this->ecrire($fp,"--\n");
						$this->ecrire($fp,"-- table '$tablename' empty \n");
						$this->ecrire($fp,"--\n");
						$this->ecrire($fp,"\n");
					}

			}
		  $i++;
		  }
		if(!$this->fly){fclose($fp);}
		}
		if($this->compress_ok && !$this->fly){$this->compress();}
	}
	//************************************
	// ******* fonction utilisee pour la separer les data
	function separe($tbl) // utilisee dans array_map dans backup pour formater la recup du query
	{
		$tbl=mysql_real_escape_string($tbl); 	// prepare les data pour etre injectées dans mysql
		if(is_numeric($tbl)){ return $tbl;}	// si chiffre , c'est bon
		if(!$tbl){return "NULL";}			// si c'est null on le dit
		return "'".$tbl."'";				// pour le reste entre gillements simples
	}
	//************************************************

	function compress()
	{	// compresse un fichier sans utiliser le shell
		// pour ne pas se preocuper de la plateforme sur laquelle tourne le script
		// juste verifier que la GZLIB de PHP est bien active
		if($this->filename and !$this->errr){
			$fp = @fopen($this->filename,"rb");
			$zp = @gzopen($this->filename.".gz", "wb9");
			if(!$zp or !$fp){$this->errr =$this->message("err_compress"); return false; }
			while(!feof($fp)){
				$data=fgets($fp, 8192);			// taille du buffer php
				gzwrite($zp,$data);
			}
			fclose($fp);
			gzclose($zp);
			unlink($this->filename);
			$this->filename=$this->filename.".gz";
		}

	}
	//***********************************
	function nettoyage() // pour suprimer les fichiers de sauvegardes du serveur
	{ 	if(!$this->errr){
			if ($dir = @opendir($this->sousdir))
			{
				while($file = @readdir($dir))
				{
					@unlink($this->sousdir.$file);
				}
				@closedir($dir);
			}
		}
	}
	//*****************************************
	function spe()// juste pour vous faire consulter la doc de PHP
	{
		return base64_decode("LS0gICAgICAgICAgICAgICAgICAgIFBhc2NhbCBDQVNFTk9WRQo=");
	}
	//****************************
	function message($numero){ // petit test pour la traduction des messages d'erreur

		$lang=$this->language;
		if(!$lang){$lang="fr";}

		$message["err_compress"][fr]="Erreur de compression de fichier";
		$message["err_compress"][en]="Error when compress file";
		$message["err_compress"][sp]="Erreur de compression de fichier a traduire";
		$message["err_compress"][ge]="Erreur de compression de fichier a traduire";

		$message["err_fichier"][fr]="Erreur d'ouverture de fichier";
		$message["err_fichier"][en]="Error when open file";
		$message["err_fichier"][sp]="Erreur d'ouverture de fichier a traduire";
		$message["err_fichier"][ge]="Erreur d'ouverture de fichier a traduire";

		$message["err_base"][fr]="base mysql inexistante";
		$message["err_base"][en]="mysql database not exist";
		$message["err_base"][sp]="base mysql inexistante a traduire";
		$message["err_base"][ge]="base mysql inexistante a traduire";

		$message["err_mysql"][fr]="Erreur d'ouverture de mysql";
		$message["err_mysql"][en]="mysql server not found";
		$message["err_mysql"][sp]="Erreur d'ouverture de mysql a traduire";
		$message["err_mysql"][ge]="Erreur d'ouverture de mysql a traduire";

		return $message[$numero][$lang];
	}
}
?>
