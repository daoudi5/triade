<?php
session_start();
if (file_exists("common/lib_crypt.php")) {
	include_once("common/lib_crypt.php");
	
	function TextNoAccent($Text){
	 	return (strtr($Text, "�����������������������������������������������������","AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"));
	}

	function encrypt($text)	{
	     	$text_num = str_split($text, CRYPT_CBIT_CHECK);
     		$text_num = CRYPT_CBIT_CHECK - strlen($text_num[count($text_num)-1]);
 
    		for ($i=0;$i<$text_num; $i++)
        	 	$text = $text . chr($text_num);
 
	    	$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES, '', 'cbc', '');
     		mcrypt_generic_init($cipher, CRYPT_CKEY, CRYPT_CIV);
     
    		$decrypted = mcrypt_generic($cipher, $text);
	     	mcrypt_generic_deinit($cipher);
 
    		return base64_encode($decrypted);
	}
	$nom=TextNoAccent($_SESSION["nom"]);
	$prenom=TextNoAccent($_SESSION["prenom"]);
	$tab['nom']="$nom $prenom";
	$serialize=encrypt(serialize($tab));
}
include_once("common/config2.inc.php");
if (LAN == "oui") {
	header("Location:http://www.triade-educ.com/accueil/webradio.php?GRAPH=".GRAPH."&tab=$serialize&r=".CRYPT_CIV."&r2=".CRYPT_CKEY);
}else{
	print "<script>alert(\"Internet non accessible ! Valider l'acc�s via votre compte administrateur Triade\"); this.close(); </script>";
	
}
?>
