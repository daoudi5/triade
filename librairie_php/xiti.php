<?php
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : Janvier 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET - F. ORY
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
include_once("./common/config2.inc.php");
// width="39" height="25"
$xiti=VERSION."-".$_SERVER["SERVER_NAME"];
?>
<div align="right" style="visibility:hidden" >
<!-- audience Xiti -->
<a href="http://www.xiti.com/xiti.asp?s=150072" TARGET="_top">
<script language="JavaScript1.1" type="text/javascript">
<!--
var version="<?php print $xiti?>";
Xt_param = 's=150072&p='+version;
Xt_r = document.referrer;
Xt_h = new Date();
Xt_i = '<img width="39" height="25" border="0" id="mailing" class="blk_nav" onmouseover="resetit(this.id)" onmouseout="unfadeimg(this.id)"  style="filter:alpha(opacity=25);-moz-opacity:0.25" ';
Xt_i += 'src="http://logv24.xiti.com/hit.xiti?'+Xt_param;
Xt_i += '&hl='+Xt_h.getHours()+'x'+Xt_h.getMinutes()+'x'+Xt_h.getSeconds();
if(parseFloat(navigator.appVersion)>=4)
{Xt_s=screen;Xt_i+='&r='+Xt_s.width+'x'+Xt_s.height+'x'+Xt_s.pixelDepth+'x'+Xt_s.colorDepth;}
document.write(Xt_i+'&ref='+Xt_r.replace(/[<>"]/g, '').replace(/&/g, '$')+'" title="Analyse d\'audience">');
//-->
</script></a></div>
