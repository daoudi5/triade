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
//------------------------------------------------------------------------------
// section pour un acces non autorise



include_once("./lib_emul_register.php");


include_once("./common/version.php");
include_once("./common/lib_admin.php");
include_once("./common/lib_ecole.php");
include_once("./common/config2.inc.php");
include_once("./common/config8.inc.php");
include_once("timezone.php");
include_once("langue.php");
include_once("lib_error.php");
include_once("./common/productId.php");
//include_once("./sound/lib_sound.php"); sonore_action();


// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------
// syxtaxe d'utilisation
// verifplus("menuadmin",$_SESSION[id_pers],$_SESSION[membre]);
// verifplus("menuparent",$_SESSION[id_pers],$_SESSION[membre]);
// verifplus("menuprof",$_SESSION[id_pers],$_SESSION[membre]);
// verifplus("menuscolaire",$_SESSION[id_pers],$_SESSION[membre]);
// verifplus("menudeux",$_SESSION[id_pers],$_SESSION[membre]);
// scolaire et admin
function verifplus($verifplus,$idpers,$idmembre) {
	if ($verifplus == "menudeux") {
		if (($idmembre == "menuadmin") || ($idmembre == "menuscolaire")) {
			$blackliste=0;
		}else{
			$blackliste=1;
		}
	}else {
		if ($idmembre != $verifplus) {
			$blackliste=1;
		}else{
			$blackliste=0;
		}
	}

	if ($blackliste == 1) {
    		print "<script type=\"text/javascript\">";
	    	print "location.href='./blacklist.php'";
 		print "</script>";
		exit;
	}
}


// -----------------------------------------------------------------------------

function testadminplus() {
	if (empty($_SESSION["adminplus"])) {
	    print "<script type=\"text/javascript\">";
	    print "location.href=\"./affectation_creation_key.php\"";
	    print "</script>";
	    exit;
	}
}


//  brmozilla($_SESSION[navigateur]);
function brmozilla($navig) {
	if ($navig == "NONIE") {
		print "<br />";
	}
}



//------------------------------------------------------------------------------
// construction de la license
// pour Internet explorer
if (eregi('msie', $_SERVER['HTTP_USER_AGENT']) && !eregi('opera', $_SERVER['HTTP_USER_AGENT']))
{
print "<div id='menu' class='fond' style='background-image:url(./image/commun/fond_inscrip.jpg);position:absolute;z-index:2;' >";
print "<div class='intitules' url='' align=left>";
print "<br /><img src='./image/commun/logo_triade_licence.gif'>";
print "        <br /><br />Version : <strong>".VERSION."</strong>";
print "        <br /> Tous droits r�serv�s <br />";
print "                Licence d'utilisation : ".LICENCE."<br />";
print "                Product ID = <b>".PRODUCTID ."</b>";
print "        <br /><br />";
print "        <textarea cols=55 rows=3 STYLE='font-family: Arial;font-size:10px;color:#CC0000;background-color:#CCCCFF;font-weight:bold;'>";
droit();
print "</textarea>";
print "        <HR><table width=95%><tr><TD align=left> <font size=2 >Triade�, 2000 - 2006 </font></td><td align=right><input type=button value='Fermer Fen�tre' onclick='masque_menu()' class='bouton2'></td></tr></table>";
print "<br /></div></div>";
print "<script type=\"text/javascript\">";
print "document.getElementById('menu').style.visibility='hidden'";
print "</script>";
}


//------------------------------------------------------------------------------
// declaration de variables
include_once("./common/config.inc.php");
//------------------------------------------------------------------------------

//----------------------------------------------------------------------------
function droit() {
print <<<EOF
Copyright (C) 2000-2007 S.A.R.L. - T.R.I.A.D.E.

Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique G�n�rale GNU publi�e par la Free Software Foundation.

Ce programme est distribu� car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but sp�cifique. Reportez-vous � la Licence Publique G�n�rale GNU pour plus de d�tails.

Vous devez avoir re�u une copie de la Licence Publique G�n�rale GNU en m�me temps que ce programme ; si ce n'est pas le cas, �crivez � la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, �tats-Unis.

EOF;
}

include_once("mactu.php")

print "var versiontriade='".VERSION."'; ";
print "var versionpatch='".VERSIONPATCH."'; ";
print "var productId='".PRODUCTID."'; ";

//----------------------------------------------------------------

?>
