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
include_once("entete.php"); 
$typecompte=$_GET["typecompte"];
?>

<header id="topNav" class="topHead vat-nav-master">
<div class="container">
	<div class="navbar-collapse nav-main-collapse collapse pull-right" style="height:100px" >&nbsp;</div>
</div>
</header>
<span id="header_shadow"></span>
<!-- WRAPPER -->
<form method="post" action="index<?php print $typecompte?>.php" >
<div id="wrapper">
<div class="fullwidthbanner-container roundedcorners">
        <div class="fullwidthbanner hidden-xs">
            <ul>
                <!-- SLIDE  -->
                <li data-transition="fade" data-slotamount="7" data-masterspeed="1500">
                    <!-- COVER IMAGE -->
                    <img src="files/slider/background_s1.jpg" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">            
                    <div class="tp-caption customin customout"
                         data-x="right" data-hoffset="50"
                         data-y="bottom" data-voffset="20"
                         data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="800"
                         data-start="700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3"><img src="files/slider/layer_4_s1.png" alt="">
                    </div>
                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption customin customout"
                         data-x="left" data-hoffset="550"
                         data-y="bottom" data-voffset="0"
                         data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:40% 40%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:40% 40%;"
                         data-speed="1500"
                         data-start="700"
                         data-easing="Elastic.easeInOut"
                         data-endspeed="500"
                         data-endeasing="Power1.easeIn"
                         style="z-index: 3"><img src="files/slider/layer_3_s1.png" alt="">
                    </div>
                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption large_bold_grey skewfromrightshort customout"
                         data-x="80"
                         data-y="66"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:40% 40%;"
                         data-speed="500"
                         data-start="800"
                         data-easing="Back.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 4"><?php print LANGVATEL17 ?></div>
                    <!-- LAYER NR. 4 -->
                   <div class="tp-caption large_bold_grey skewfromleftshort customout"
                         data-x="80"
                         data-y="122"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="300"
                         data-start="1100"
                         data-easing="Back.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
			 style="z-index: 7"></div>
                    <!-- LAYER NR. 5 -->
                    <div class="tp-caption small_thin_grey customin customout"
                         data-x="80"
                         data-y="230"
                         data-customin="x:0;y:100;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:1;scaleY:3;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:0% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="500"
                         data-start="1300"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
			 style="z-index: 8">
			 <?php
			 $height=200;
			 ?>
			 <div style="background-color: rgba(36, 36, 36, 0.2); background: rgba(36, 36, 36, 0.2); color: rgba(36, 36, 36, 0.2); border:none 1px #000000; -moz-border-radius: 24px; -webkit-border-radius: 24px; border-radius: 24px; width:450px; height:<?php print $height ?>px;padding:25px " >
				 <input type="text" placeholder="Indiquer votre email" value="" name="email" size='30' style="color:#000000" >
				 <br><br>
				 <table width='100%'><tr><td></td>
				 <td align='center'><input type='submit' role="button" data-toggle="modal" name="mplost" data-target="#brochuremodal" class="btn btn-primary btn-sm pull-right vat-btn-footer" value="<?php print LANGVATEL16 ?>" ></td></tr></table>
			 </div>
                    </div>
                </li>
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
	 <section class="container text-center phone">
                <?php
                 $height=200;
                 if ($message != "") $height="230";
                 ?>
			<div style="background-color: rgba(36, 36, 36, 0.2); background: rgba(36, 36, 36, 0.2); color: rgba(36, 36, 36, 0.2); border:none 1px #000000; -moz-border-radius: 24px; -webkit-border-radius: 24px; border-radius: 24px; width:100%; height:<?php print $height ?>px;padding:15px " ><br>
			 <input type="text" placeholder="Indiquer votre email" value="" name="emailp" size='30' style="color:#000000" >
			 <br><br>
			 <table width='100%'><tr><td></td>
			 <td align='center'><input type='submit' role="button" data-toggle="modal" name="mplostp" data-target="#brochuremodal" class="btn btn-primary btn-sm pull-right vat-btn-footer" value="<?php print LANGVATEL16 ?>" ></td></tr></table>
			 </div>
                </br><br>
        </section>
	
	</form>
 <?php include_once("piedpage.php"); ?>

</body>
</html>
