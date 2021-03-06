<?php
/* For licensing terms, see /dokeos_license.txt */

/**
 * Learning Path
 * This file was origially the copy of document.php, but many modifications happened since then ;
 * the direct file view is not needed anymore, if the user uploads a scorm zip file, a directory
 * will be automatically created for it, and the files will be uncompressed there for example ;
 * @package dokeos.learnpath
 * @author Denes Nagy, principal author
 * @author Isthvan Mandak, several new features
 * @author Roan Embrechts, code improvements and refactoring
 * @author Yannick Warnier - redesign
 */

$_SESSION['whereami'] = 'lp/view';
$this_section = SECTION_COURSES;

if ($lp_controller_touched != 1) {
  header('location: lp_controller.php?action=view&item_id='.Security::remove_XSS($_REQUEST['item_id']));
}

/*
-----------------------------------------------------------
	Libraries
-----------------------------------------------------------
*/
require_once('back_compat.inc.php');
//require_once('../learnpath/learnpath_functions.inc.php');
require_once('scorm.lib.php');
require_once('learnpath.class.php');
require_once('learnpathItem.class.php');
require_once('course_navigation_interface.inc.php');
//require_once('lp_comm.common.php'); //xajax functions

if ($is_allowed_in_course == false) api_not_allowed();
/*
-----------------------------------------------------------
	Variables
-----------------------------------------------------------
*/
//$charset = 'UTF-8';
//$charset = 'ISO-8859-1';

// we set the encoding of the lp
if (!empty($_SESSION['oLP']->encoding)) {
	$charset = $_SESSION['oLP']->encoding;
    // Check if we have a valid api encoding
    $valid_encodings = api_get_valid_encodings();
    $has_valid_encoding = false;
    foreach ($valid_encodings as $valid_encoding) {
      if (strcasecmp($charset,$valid_encoding) == 0) {
        $has_valid_encoding = true;
      }
    }
    // If the scorm packages has not a valid charset, i.e : UTF-16 we are displaying
    if ($has_valid_encoding === false) {
      $charset = api_get_system_encoding();
    }
} else {
	$charset = api_get_system_encoding();
}
if (empty($charset)) {
	$charset = 'ISO-8859-1';
}

$oLearnpath = false;
$course_code = api_get_course_id();
$user_id = api_get_user_id();
$platform_theme = api_get_setting('stylesheets'); 	// plataform's css
$my_style=$platform_theme;
//escape external variables
/*
-----------------------------------------------------------
	Header
-----------------------------------------------------------
*/
$htmlHeadXtra[] = '<script src="js/course_view_func.js" type="text/javascript" language="javascript"></script>';
$htmlHeadXtra[] = '<script src="js/autoheight.js" type="text/javascript" language="javascript"></script>';
$htmlHeadXtra[] = '<script language="javascript" type="text/javascript">
$(document).ready(function (){
    $("div#log_content_cleaner").bind("click", function(){
      $("div#log_content").empty();
    });
});
</script>';

$htmlHeadXtra[] = '<script language="javascript" type="text/javascript">
$(document).ready(function (){
  transparent_flash();
});
</script>';

$htmlHeadXtra[] = '<script language="JavaScript" type="text/javascript">
  	var dokeos_xajax_handler = window.oxajax;
</script>';

$htmlHeadXtra[]= '<link rel="stylesheet" type="text/css" href="../css/'.api_get_setting('stylesheets').'/course_navigation.css" />';

$_SESSION['oLP']->error = '';
$lp_type = $_SESSION['oLP']->get_type();
$lp_item_id = $_SESSION['oLP']->get_current_item_id();
//$lp_item_id = learnpath::escape_string($_GET['item_id']);
//$_SESSION['oLP']->set_current_item($lp_item_id); // already done by lp_controller.php

//Prepare variables for the test tool (just in case) - honestly, this should disappear later on
$_SESSION['scorm_view_id'] = $_SESSION['oLP']->get_view_id();
$_SESSION['scorm_item_id'] = $lp_item_id;
$_SESSION['lp_mode'] = $_SESSION['oLP']->mode;
//reinit exercises variables to avoid spacename clashes (see exercise tool)
if(isset($exerciseResult) or isset($_SESSION['exerciseResult']))
{
    api_session_unregister($exerciseResult);
}
unset($_SESSION['objExercise']);
unset($_SESSION['questionList']);
/**
 * Get a link to the corresponding document
 */


if (!isset($src))
 {
 	$src = '';
	switch($lp_type)
	{
		case 1:
			$_SESSION['oLP']->stop_previous_item();
			$htmlHeadXtra[] = '<script src="scorm_api.php" type="text/javascript" language="javascript"></script>';
			$prereq_check = $_SESSION['oLP']->prerequisites_match($lp_item_id);
			if($prereq_check === true){
				$src = $_SESSION['oLP']->get_link('http',$lp_item_id);
				$_SESSION['oLP']->start_current_item(); //starts time counter manually if asset
			}else{
				$src = 'blank.php?error=prerequisites';
			}
			break;
		case 2:
			//save old if asset
			$_SESSION['oLP']->stop_previous_item(); //save status manually if asset
			$htmlHeadXtra[] = '<script src="scorm_api.php" type="text/javascript" language="javascript"></script>';
			$prereq_check = $_SESSION['oLP']->prerequisites_match($lp_item_id);
			if($prereq_check === true){
				$src = $_SESSION['oLP']->get_link('http',$lp_item_id);
				$_SESSION['oLP']->start_current_item(); //starts time counter manually if asset
			}else{
			$src = 'blank.php?error=prerequisites';
			}
			break;
		case 3:
			//aicc
			$_SESSION['oLP']->stop_previous_item(); //save status manually if asset
			$htmlHeadXtra[] = '<script src="scorm_api.php" type="text/javascript" language="javascript"></script>';
			$htmlHeadXtra[] = '<script src="'.$_SESSION['oLP']->get_js_lib().'" type="text/javascript" language="javascript"></script>';
			$prereq_check = $_SESSION['oLP']->prerequisites_match($lp_item_id);
			if($prereq_check === true){
				$src = $_SESSION['oLP']->get_link('http',$lp_item_id);
    error_log($src);
				$_SESSION['oLP']->start_current_item(); //starts time counter manually if asset
			}else{
				$src = 'blank.php';
			}
			break;
		case 4:
			break;
	}
}

$list = $_SESSION['oLP']->get_toc();
$type_quiz = false;

foreach($list as $toc) {
	if ($toc['id'] == $lp_item_id && ($toc['type']=='quiz') ) {
		$type_quiz = true;
	}
}

$autostart = 'true';
// update status,total_time from lp_item_view table when you finish the exercises in learning path
if ($type_quiz && !empty($_REQUEST['exeId']) && isset($_GET['lp_id']) && isset($_GET['lp_item_id'])) {
	global $src;
	$_SESSION['oLP']->items[$_SESSION['oLP']->current]->write_to_db();
	$TBL_TRACK_EXERCICES	= Database::get_statistic_table(TABLE_STATISTIC_TRACK_E_EXERCICES);
	$TBL_LP_ITEM_VIEW		= Database::get_course_table(TABLE_LP_ITEM_VIEW);
	$TBL_LP_VIEW			= Database::get_course_table(TABLE_LP_VIEW);
	$TBL_LP_ITEM			= Database::get_course_table(TABLE_LP_ITEM);
	$safe_item_id      = Database::escape_string($_GET['lp_item_id']);
    $safe_id           = Database::escape_string($_GET['lp_id']);
	$safe_exe_id = Database::escape_string($_REQUEST['exeId']);

	if ($safe_id == strval(intval($safe_id)) && $safe_item_id == strval(intval($safe_item_id))) {

		$sql = 'SELECT start_date,exe_date,exe_result,exe_weighting FROM ' . $TBL_TRACK_EXERCICES . ' WHERE exe_id = '.(int)$safe_exe_id;
		$res = Database::query($sql,__FILE__,__LINE__);
		$row_dates = Database::fetch_array($res);

		$time_start_date = convert_mysql_date($row_dates['start_date']);
		$time_exe_date 	 = convert_mysql_date($row_dates['exe_date']);
		$mytime = ((int)$time_exe_date-(int)$time_start_date);
		$score = (float)$row_dates['exe_result'];
		$max_score = (float)$row_dates['exe_weighting'];

		$sql_upd_status = "UPDATE $TBL_LP_ITEM_VIEW SET status = 'completed' WHERE lp_item_id = '".(int)$safe_item_id."'
				 AND lp_view_id = (SELECT lp_view.id FROM $TBL_LP_VIEW lp_view WHERE user_id = '".(int)$_SESSION['oLP']->user_id."' AND lp_id='".(int)$safe_id."')";
		Database::query($sql_upd_status,__FILE__,__LINE__);

		$sql_upd_max_score = "UPDATE $TBL_LP_ITEM SET max_score = '$max_score' WHERE id = '".(int)$safe_item_id."'";
		Database::query($sql_upd_max_score,__FILE__,__LINE__);

		$sql_last_attempt = "SELECT id FROM $TBL_LP_ITEM_VIEW  WHERE lp_item_id = '$safe_item_id' AND lp_view_id = '".$_SESSION['oLP']->lp_view_id."' order by id desc limit 1";
		$res_last_attempt = Database::query($sql_last_attempt,__FILE__,__LINE__);
		$row_last_attempt = Database::fetch_row($res_last_attempt);

		if (Database::num_rows($res_last_attempt)>0) {
			$sql_upd_score = "UPDATE $TBL_LP_ITEM_VIEW SET score = $score,total_time = $mytime WHERE id='".$row_last_attempt[0]."'";
			Database::query($sql_upd_score,__FILE__,__LINE__);
		}
	}

	if(intval($_GET['fb_type']) == 2) {
		$src = 'blank.php?msg=exerciseFinished';
	} else {
		$src = api_get_path(WEB_CODE_PATH).'exercice/exercise_show.php?id='.Security::remove_XSS($_REQUEST['exeId']).'&origin=learnpath&learnpath_id='.Security::remove_XSS($_GET['lp_id']).'&learnpath_item_id='.Security::remove_XSS($_GET['lp_id']).'&fb_type='.Security::remove_XSS($_GET['fb_type']);
	}
	$autostart = 'false';
}

$_SESSION['oLP']->set_previous_item($lp_item_id);
$nameTools = Security :: remove_XSS(api_convert_encoding($_SESSION['oLP']->get_name(), $charset, api_get_system_encoding()));

$save_setting = api_get_setting("show_navigation_menu");
global $_setting;
$_setting['show_navigation_menu'] = 'false';
$scorm_css_header=true;
$lp_theme_css=$_SESSION['oLP']->get_theme(); //sets the css theme of the LP this call is also use at the frames (toc, nav, message)

if($_SESSION['oLP']->mode == 'fullscreen') {
	$htmlHeadXtra[] = "<script>window.open('$src','content_id','toolbar=0,location=0,status=0,scrollbars=1,resizable=1');</script>";
	include_once('../inc/reduced_header.inc.php');

	//set flag to ensure lp_header.php is loaded by this script (flag is unset in lp_header.php)
	$_SESSION['loaded_lp_view'] = true;
    ?>
<body>
<div align="center"  style="width:100%;height:100%;">
<!-- New Header Dokeos 2.0-->
<div id="courseHeader">
	<?php
		// get tocs from learnpath and convert for re-using in toggle menu
		$currentId = $_SESSION['oLP']->current;
		$menuItems = getMenuItemsFromToc($_SESSION['oLP']->get_toc(), $currentId);
		echo renderCourseHeader($nameTools, $_SESSION['oLP']->get_progress_bar_text(), $menuItems, $charset);
	?>
</div>

<div id="learning_path_main"  style="width:100%;height:100%;" >
	<div id="learning_path_left_zone" style="display:none;float:left;width:280px;height:100%">
		<!-- header -->
		<div id="header">
            <div id="learning_path_header" style="font-size:14px;">
	            <table>
	                <tr>
	                    <td>
                      <a href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();">
	                        <img src="../img/lp_arrow.gif" />
	                        </a>
	                    </td>
	                    <td>
	                        <a class="link" href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();">
	                        <?php echo api_convert_encoding(get_lang('CourseHomepageLink'), $charset, api_get_system_encoding()); ?></a>
	                    </td>
	                </tr>
	            </table>
	        </div>
		</div>
		<!-- end header -->

        <!-- Image preview Layout -->
        <div id="author_image" name="author_image" class="lp_author_image" style="height:23%; width:100%;margin-left:5px">
		<?php $image = '../img/lp_author_background.gif'; ?>
			<div id="preview_image" style="padding:5px;background-image: url('../img/lp_author_background.gif');background-repeat:no-repeat;height:110px">
		       	<div style="width:100; float:left;height:105;margin:5px">
		       		<span>
			        <?php
			        if ($_SESSION['oLP']->get_preview_image()!='') {
			            echo '<img width="115px" height="100px" src="'.api_get_path(WEB_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image().'">';
			        } else {
                        echo Display :: display_icon('unknown_250_100.jpg', ' ');
			        }; ?>
					</span>
		       	</div>

				<div id="nav_id" name="nav_name" class="lp_nav" style="margin-left:105px;height:90px">
			        <?php
						$display_mode = $_SESSION['oLP']->mode;
						$scorm_css_header = true;
						$lp_theme_css = $_SESSION['oLP']->get_theme();

						//Setting up the CSS theme if exists

						if (!empty ($lp_theme_css) && !empty ($mycourselptheme) && $mycourselptheme != -1 && $mycourselptheme == 1) {
							global $lp_theme_css;
						} else {
							$lp_theme_css = $my_style;
						}

						$progress_bar = $_SESSION['oLP']->get_progress_bar('', -1, '', true);
						$navigation_bar = $_SESSION['oLP']->get_navigation_bar();
						$mediaplayer = $_SESSION['oLP']->get_mediaplayer($autostart);

						$tbl_lp_item	= Database::get_course_table(TABLE_LP_ITEM);
						$show_audioplayer = false;
						// getting all the information about the item
						$sql = "SELECT audio FROM " . $tbl_lp_item . " WHERE lp_id = '" . Database::escape_string($_SESSION['oLP']->lp_id)."'";
						$res_media= Database::query($sql, __FILE__, __LINE__);

						if (Database::num_rows($res_media) > 0) {
							while ($row_media= Database::fetch_array($res_media)) {
							     if (!empty($row_media['audio'])) {$show_audioplayer = true; break;}
							}
						}
					?>

					<div id="lp_navigation_elem" class="lp_navigation_elem" style="padding-left:130px;margin-top:9px;">
						<div style="padding-top:20px;padding-bottom:50px;" ><?php echo $navigation_bar; ?></div>
						<div style="height:20px"><?php echo $progress_bar; ?></div>
					</div>
				</div>
		</div>

	</div>
	<!-- end image preview Layout -->
	<div id="author_name" style="position:relative;top:2px;left:0px;margin:0;padding:0;text-align:center;width:100%">
		<?php echo $_SESSION['oLP']->get_author() ?>
	</div>

	<!-- media player layaout -->
	<?php $style_media = (($show_audioplayer)?' style= "position:relative;top:10px;left:10px;margin:8px;font-size:32pt;height:20px;"':'style="height:15px"'); ?>
	<div id="media"  <?php echo $style_media ?>>
		<?php echo (!empty($mediaplayer))?$mediaplayer:'&nbsp;' ?>
	</div>
	<!-- end media player layaout -->

	<!-- toc layout -->
	<div id="toc_id" name="toc_name"  style="overflow: auto; padding:0;margin-top:20px;height:60%;width:100%">
		<div id="learning_path_toc" style="font-size:9pt;margin:0;"><?php echo $_SESSION['oLP']->get_html_toc(); ?>
			<!-- log message layout -->

			<div id="lp_log_name" name="lp_log_name" class="lp_log" style="height:50px;overflow:auto;margin:15px">
				<div id="log_content"></div>
				<div id="log_content_cleaner" style="color: white;">.</div>
			</div>
    		<!-- end log message layout -->
        </div>
	</div>
	<!-- end toc layout -->
</div>
<!-- end left Zone -->

<!-- right Zone -->
<div id="learning_path_right_zone" style="border : 0pt solid blue;height:100%">
    <iframe id="content_id_blank" name="content_name_blank" src="blank.php" class="autoHeight" border="0" frameborder="0"  style="width:100%;height:600px" ></iframe>
</div>
<!-- end right Zone -->

</div>
</div>
</body>
<?php
} elseif ($_SESSION['oLP']->mode == 'embedded' && $_SESSION['oLP']->lp_interface == 0) {
	//not fullscreen mode
	include_once('../inc/reduced_header.inc.php');
	//$displayAudioRecorder = (api_get_setting('service_visio','active')=='true') ? true : false;
	//check if audio recorder needs to be in studentview
	$course_id=$_SESSION["_course"]["id"];
	if ($_SESSION["status"][$course_id]==5) {
		$audio_recorder_studentview = true;
	} else {
		$audio_recorder_studentview = false;
	}
	//set flag to ensure lp_header.php is loaded by this script (flag is unset in lp_header.php)
	$_SESSION['loaded_lp_view'] = true;
?>
<body>
<div align="center"  style="margin-left:auto;margin-right: auto; width:960px;height:700px;">
<!-- New Header Dokeos 2.0-->
<div id="courseHeader">
	<?php
		// get tocs from learnpath and convert for re-using in toggle menu
		$currentId = $_SESSION['oLP']->current;
		$menuItems = getMenuItemsFromToc($_SESSION['oLP']->get_toc(), $currentId);
		echo renderCourseHeader($nameTools, $_SESSION['oLP']->get_progress_bar_text(), $menuItems, $charset);
	?>
</div>
<!-- Header for navigation in course tool -->
<?php
	if(api_is_allowed_to_edit())
	{
?>
<div class="actions" align="left">
<?php
$return = '';
$author_lang_var = api_convert_encoding(get_lang('Author'), $charset, api_get_system_encoding());
$content_lang_var = api_convert_encoding(get_lang('Content'), $charset, api_get_system_encoding());
$scenario_lang_var = api_convert_encoding(get_lang('Scenario'), $charset, api_get_system_encoding());
     // The lp_id parameter will be added by Javascript
     $my_lp_id = Security::remove_XSS($_GET['lp_id']);
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&lp_id='.$my_lp_id.'">' . Display::return_icon('go_previous_32.png', $author_lang_var).$author_lang_var . '</a>';
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&action=add_item&type=step&lp_id='.$my_lp_id.'">' . Display::return_icon('content.png', $content_lang_var).$content_lang_var . '</a>';
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&gradebook=&action=admin_view&lp_id='.$my_lp_id.'">' . Display::return_icon('organize.png', $scenario_lang_var).$scenario_lang_var . '</a>';
     echo $return;
	 ?>
</div>
<?php
	}
?>
<div id="content_with_secondary_actions"  style="width:940px;height:100%;" >
    <div id="learning_path_left_zone" style="display:none;float:left;width:280px;height:100%">

		<!-- header -->
		<div id="header">
	        <div id="learning_path_header" style="font-size:14px;">
	            <table>
	                <tr>
	                    <td>
	                        <a href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();"><img src="../img/lp_arrow.gif" /></a>
	                    </td>
	                    <td>
	                        <a class="link" href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();">
	                        <?php echo api_convert_encoding(get_lang('CourseHomepageLink'), $charset, api_get_system_encoding()); ?></a>
	                    </td>
	                </tr>
	            </table>
	        </div>
		</div>
		<!-- end header -->

        <!-- Image preview Layout -->

			<div id="author_image" class="lp_author_image" style="height:15%; width:100%;margin-left:5px;">
		<?php $image = '../img/lp_author_background.gif'; ?>

			<div id="preview_image" style="padding:5px;background-image: url('../img/lp_author_background.gif');background-repeat:no-repeat;height:110px">

		       	<div style="width:100px; float:left;height:105px;margin:5px">
		       		<span style="width:104px; height:96px; float:left; vertical-align:bottom;">
			        <center>
			        <?php
			        if ($_SESSION['oLP']->get_preview_image()!='') {
			        	$picture = getimagesize(api_get_path(SYS_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image());
			        	if($picture['1'] < 96) { $style = ' style="padding-top:'.((94 -$picture['1'])/2).'px;" '; }
			        	$size = ($picture['0'] > 104 && $picture['1'] > 96 )? ' width="104" height="96" ': $style;
			        	$my_path = api_get_path(WEB_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image();
			        	echo '<img '.$size.' src="'.$my_path.'">';
			        } else {
						echo Display :: display_icon('unknown_250_100.jpg', ' ');
					}
					?>
				    </center>
				    </span>
		       	</div>

				<div id="nav_id" name="nav_name" class="lp_nav" style="margin-left:105px;height:90px">
			        <?php
						$display_mode = $_SESSION['oLP']->mode;
						$scorm_css_header = true;
						$lp_theme_css = $_SESSION['oLP']->get_theme();

						//Setting up the CSS theme if exists
						if (!empty ($lp_theme_css) && !empty ($mycourselptheme) && $mycourselptheme != -1 && $mycourselptheme == 1) {
							global $lp_theme_css;
						} else {
							$lp_theme_css = $my_style;
						}

						$progress_bar = $_SESSION['oLP']->get_progress_bar('', -1, '', true);
						$navigation_bar = $_SESSION['oLP']->get_navigation_bar();
						$mediaplayer = $_SESSION['oLP']->get_mediaplayer($autostart);

						$tbl_lp_item	= Database::get_course_table(TABLE_LP_ITEM);
						$show_audioplayer = false;
						// getting all the information about the item
						$sql = "SELECT audio FROM " . $tbl_lp_item . " WHERE lp_id = '" . $_SESSION['oLP']->lp_id."'";
						$res_media= Database::query($sql, __FILE__, __LINE__);

						if (Database::num_rows($res_media) > 0) {
							while ($row_media= Database::fetch_array($res_media)) {
							     if (!empty($row_media['audio'])) {$show_audioplayer = true; break;}
							}
						}
					?>

					<div id="lp_navigation_elem" class="lp_navigation_elem" style="padding-left:130px;margin-top:9px;">
						<div style="padding-top:15px;padding-bottom:50px;" ><?php echo $navigation_bar; ?></div>
						<div style="height:20px"><?php echo $progress_bar; ?></div>
					</div>
				</div>
    		</div>
	   </div>
	   <!-- end image preview Layout -->
		<div id="author_name" style="position:relative;top:2px;left:0px;margin:0;padding:0;text-align:center;width:100%">
			<?php echo $_SESSION['oLP']->get_author() ?>
		</div>

		<!-- media player layaout -->
		<?php $style_media = (($show_audioplayer)?' style= "position:relative;top:10px;left:10px;margin:8px;font-size:32pt;height:20px;"':'style="height:15px"'); ?>
		<div id="media"  <?php echo $style_media ?>>
			<?php echo (!empty($mediaplayer))?$mediaplayer:'&nbsp;' ?>
		</div>
		<!-- end media player layaout -->

		<!-- toc layout -->
		<div id="toc_id"  style="overflow: auto; padding:0;margin-top:20px;height:60%;width:100%">
			<div id="learning_path_toc" style="font-size:9pt;margin:0;"><?php echo $_SESSION['oLP']->get_html_toc(); ?>

    				</div>
		</div>
		<!-- end toc layout -->
	</div>
    <!-- end left Zone -->

    <!-- right Zone -->
	<div id="learning_path_right_zone" style="height:700px">
		<iframe id="content_id" name="content_name" class="course_view autoHeight author_view_min_height" width="100%" height="700px" frameborder="0" ></iframe>
	</div>
    <!-- end right Zone -->
    <?php if (!empty($_SESSION['oLP']->scorm_debug)) {//only show log ?>
	        <!-- log message layout -->
			<div id="lp_log_name" name="lp_log_name" class="lp_log" style="height:150px;overflow:auto;margin:4px">
				<div id="log_content"></div>
				<div id="log_content_cleaner" style="color: white;">.</div>
			</div>
	        <!-- end log message layout -->
	   <?php } ?>
    
</div>
</div>
<script language="JavaScript" type="text/javascript">
<!--
	// now we load the content after havin loaded the dom, so that we are sure that scorm_api is loaded
	window.onload = function () {
		$('#content_id').attr('src','<?php echo addslashes($src) ?>');
	};
-->
</script>
</body>
<?php
	/*
	==============================================================================
	  FOOTER
	==============================================================================
	*/
	//Display::display_footer();
} elseif ($_SESSION['oLP']->mode == 'embedded' && $_SESSION['oLP']->lp_interface == 1) {
	
	include_once('../inc/reduced_header.inc.php');
	//check if audio recorder needs to be in studentview
	$course_id=$_SESSION["_course"]["id"];
	if($_SESSION["status"][$course_id] == 5) {
		$audio_recorder_studentview = true;
	} else {
		$audio_recorder_studentview = false;
	}
	//set flag to ensure lp_header.php is loaded by this script (flag is unset in lp_header.php)
	$_SESSION['loaded_lp_view'] = true;
	?>

	<!-- New Header Dokeos 2.0-->
	<body>
<div align="center">
<div align="left"  style="margin-left:auto;margin-right: auto; width:960px;">
<div id="courseHeader">
	<?php
		// get tocs from learnpath and convert for re-using in toggle menu
		$currentId = $_SESSION['oLP']->current;
		$menuItems = getMenuItemsFromToc($_SESSION['oLP']->get_toc(), $currentId);		
		echo renderCourseHeader($nameTools, $_SESSION['oLP']->get_progress_bar_text(), $menuItems, $charset);			
	?>
</div>
<!-- Header for navigation in course tool -->
	
	<input type="hidden" id="old_item" name ="old_item" value="0"/>
	<input type="hidden" id="current_item_id" name ="current_item_id" value="0" />
<?php
	if(api_is_allowed_to_edit())
	{
?>
<div class="actions" align="left">
<?php
$return = '';
$author_lang_var = api_convert_encoding(get_lang('Author'), $charset, api_get_system_encoding());
$content_lang_var = api_convert_encoding(get_lang('Content'), $charset, api_get_system_encoding());
$scenario_lang_var = api_convert_encoding(get_lang('Scenario'), $charset, api_get_system_encoding());
     $my_lp_id = Security::remove_XSS($_GET['lp_id']);
     // The lp_id parameter will be added by Javascript
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&lp_id='.$my_lp_id.'">' . Display::return_icon('go_previous_32.png', $author_lang_var).$author_lang_var . '</a>';
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&action=add_item&type=step&lp_id='.$my_lp_id.'">' . Display::return_icon('content.png', $content_lang_var).$content_lang_var . '</a>';
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&gradebook=&action=admin_view&lp_id='.$my_lp_id.'">' . Display::return_icon('organize.png', $scenario_lang_var).$scenario_lang_var . '</a>';
     echo $return;
	 ?>
</div>
<?php
	}
?>

<div id="learningPathMain">
	<div id="learningPathLeftZone" style="float:left;width:200px;height:100%">

		<!-- header -->
	<!--<div id="header">
		        <div id="learningPathHeader" style="font-size:14px;">
		            <table>
		                <tr>
		                    <td>
		                        <a href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();"><img src="../img/lp_arrow.gif" /></a>
		                    </td>
		                    <td>
		                        <a class="link" href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();">
		                        <?php echo api_convert_encoding(get_lang('CourseHomepageLink'), $charset, api_get_system_encoding()); ?></a>
		                    </td>
		                </tr>
		            </table>
		        </div>
		</div>-->
		<!-- end header -->

<!-- Image preview Layout -->
<!--	<div id="author_image" name="author_image" class="lp_author_image" style="height:23%; width:100%;margin-left:5px;">
		<?php $image = '../img/lp_author_background.gif'; ?>

			<div id="preview_image" style="padding:5px;background-image: url('../img/lp_author_background.gif');background-repeat:no-repeat;height:110px">

		       	<div style="width:100; float:left;height:105;margin:5px">
		       		<span style="width:104px; height:96px; float:left; vertical-align:bottom;">
			        <center><?php if ($_SESSION['oLP']->get_preview_image()!=''): ?>
			        <?php
			        	$picture = getimagesize(api_get_path(SYS_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image());
			        	if($picture['1'] < 96) $style = ' style="padding-top:'.((94 -$picture['1'])/2).'px;" ';
			        	$size = ($picture['0'] > 104 && $picture['1'] > 96 )? ' width="104" height="96" ': $style;
			        	$flie = api_get_path(WEB_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image();
			        	echo '<img '.$size.' src="'.$flie.'">';
			        ?>
			        <?php
						else
						: echo Display :: display_icon('unknown_250_100.jpg', ' ');
						endif;
						?></center>
					</span>
		       	</div>

				<div id="nav_id" name="nav_name" class="lp_nav" style="margin-left:105;height:90">
			        <?php
						$display_mode = $_SESSION['oLP']->mode;
						$scorm_css_header = true;
						$lp_theme_css = $_SESSION['oLP']->get_theme();

						//Setting up the CSS theme if exists
						if (!empty ($lp_theme_css) && !empty ($mycourselptheme) && $mycourselptheme != -1 && $mycourselptheme == 1) {
							global $lp_theme_css;
						} else {
							$lp_theme_css = $my_style;
						}

						$progress_bar = $_SESSION['oLP']->get_progress_bar('', -1, '', true);
						$navigation_bar = $_SESSION['oLP']->get_navigation_bar();
						$mediaplayer = $_SESSION['oLP']->get_mediaplayer($autostart);

						$tbl_lp_item	= Database::get_course_table(TABLE_LP_ITEM);
						$show_audioplayer = false;
						// getting all the information about the item
						$sql = "SELECT audio FROM " . $tbl_lp_item . " WHERE lp_id = '" . Database::escape_string($_SESSION['oLP']->lp_id)."'";
						$res_media= api_sql_query($sql, __FILE__, __LINE__);

						if(Database::num_rows($res_media) > 0){
							while($row_media= Database::fetch_array($res_media)) {
							     if(!empty($row_media['audio'])) {$show_audioplayer = true; break;}
							}
						}
					?>

					<div id="lp_navigation_elem" class="lp_navigation_elem" style="padding-left:130px;margin-top:9px;">
						<div style="padding-top:15px;padding-bottom:50px;" ><?php echo $navigation_bar; ?></div>
						<div style="height:20px"><?php echo $progress_bar; ?></div>
					</div>
				</div>
		</div>

	</div>-->
	<!-- end image preview Layout -->
		<!--	<div id="author_name" style="position:relative;top:2px;left:0px;margin:0;padding:0;text-align:center;width:100%">
					<?php echo $_SESSION['oLP']->get_author() ?>
				</div>-->

	<!-- media player layaout -->
<!--	<?php $style_media = (($show_audioplayer)?' style= "position:relative;top:10px;left:10px;margin:8px;font-size:32pt;height:20px;"':'style="height:15px"'); ?>
	<div id="media"  <?php echo $style_media ?>>
		<?php echo (!empty($mediaplayer))?$mediaplayer:'&nbsp;' ?>
	</div>-->
	<!-- end media player layaout -->

	<!-- toc layout -->
	<div id="toc_id" name="toc_name"  style="padding:0;margin-top:0px;height:60%;width:100%">
		<div id="learningPathToc" style="font-size:9pt;margin:0;"><?php echo $_SESSION['oLP']->get_html_toc(); ?>
		<!-- log message layout -->
    <?php if (!empty($_SESSION['oLP']->scorm_debug)) { //only show log ?>
	  <!-- log message layout -->
			<div id="lp_log_name" name="lp_log_name" class="lp_log" style="height:150px;overflow:auto;margin:4px">
				<div id="log_content"></div>
				<div id="log_content_cleaner" style="color: white;">.</div>
			 <div style="color: white;" onClick="cleanlog();">.</div>
			</div>
	  <!-- end log message layout -->
	  <?php } ?>
	<!-- end log message layout -->
		</div>

	</div>
	<!-- end toc layout -->


	</div>
<!-- end left Zone -->

<!-- right Zone -->	
	<div id="learningPathRightZone" style="margin-left:205px;height:100%;background-color:white;">	
		<iframe id="content_id" name="content_name" src="<?php echo $src; ?>" border="0" frameborder="0" class="autoHeight" style="width:100%;height:680px" ></iframe>	
	</div>
<!-- end right Zone -->

</div></div>
</div><!--Ended by breetha -->
   <script language="JavaScript" type="text/javascript">
<!--
	// now we load the content after havin loaded the dom, so that we are sure that scorm_api is loaded
	window.onload = function () {
		$('#content_id').attr('src','<?php echo addslashes($src) ?>');
	};
-->
</script>
</body>
<?php
}  elseif ($_SESSION['oLP']->mode == 'embedded' && $_SESSION['oLP']->lp_interface == 2) { // Full screen mode
	//not fullscreen mode
	include_once('../inc/reduced_header.inc.php');
	//$displayAudioRecorder = (api_get_setting('service_visio','active')=='true') ? true : false;
	//check if audio recorder needs to be in studentview
	$course_id=$_SESSION["_course"]["id"];
	if ($_SESSION["status"][$course_id]==5) {
		$audio_recorder_studentview = true;
	} else {
		$audio_recorder_studentview = false;
	}
	//set flag to ensure lp_header.php is loaded by this script (flag is unset in lp_header.php)
	$_SESSION['loaded_lp_view'] = true;
?>
<body>
<div align="center"  style="margin-left:auto;margin-right: auto; width:1024px;height:768px;">
<!-- New Header Dokeos 2.0-->
<div id="courseHeaderFullScreen">
	<?php
    // Display the home icon and the tittle
    if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
      ?>
      <div align="left"><a href="lp_controller.php?<?php echo api_get_cidreq(); ?>&action=return_to_course_homepage"><?php echo Display::return_icon('home21.png', get_lang('Home')).'&nbsp;&nbsp;<span style="color:#ffffff;">'.get_lang('Home').'</span>'?></a></div>
      <?php
    } else {
      ?>
      <div align="left"><a href="lp_controller.php?<?php echo api_get_cidreq(); ?>&action=return_to_course_homepage"><div style="float:left;"><?php echo Display::return_icon('home21.png', get_lang('Home')).'<div style="float:right;margin-left:5px;margin-top:3px;">'.get_lang('Home').'</div>'?></div></a></div>
    <?php
    }
		// get tocs from learnpath and convert for re-using in toggle menu
		/*$currentId = $_SESSION['oLP']->current;
		$menuItems = getMenuItemsFromToc($_SESSION['oLP']->get_toc(), $currentId);
		echo renderCourseHeader($nameTools, $_SESSION['oLP']->get_progress_bar_text(), $menuItems, $charset);*/
	?>
</div>
<!-- Header for navigation in course tool -->
<?php
	if(api_is_allowed_to_edit())
	{
?>
<!--<div class="actions" align="left">
<?php
$return = '';
$author_lang_var = api_convert_encoding(get_lang('Author'), $charset, api_get_system_encoding());
$content_lang_var = api_convert_encoding(get_lang('Content'), $charset, api_get_system_encoding());
$scenario_lang_var = api_convert_encoding(get_lang('Scenario'), $charset, api_get_system_encoding());
     $my_lp_id = Security::remove_XSS($_GET['lp_id']);
     // The lp_id parameter will be added by Javascript
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&lp_id='.$my_lp_id.'">' . Display::return_icon('go_previous_32.png', $author_lang_var).$author_lang_var . '</a>';
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&action=add_item&type=step&lp_id='.$my_lp_id.'">' . Display::return_icon('content.png', $content_lang_var).$content_lang_var . '</a>';
     $return.= '<a href="../newscorm/lp_controller.php?' . api_get_cidreq() . '&gradebook=&action=admin_view&lp_id='.$my_lp_id.'">' . Display::return_icon('organize.png', $scenario_lang_var).$scenario_lang_var . '</a>';
     echo $return;
	 ?>
</div>-->
<?php
	}
?>
<div id="content_with_secondary_actions"  style="width:1004px;height:100%;" >
    <div id="learning_path_left_zone" style="display:none;float:left;width:280px;height:100%">

		<!-- header -->
		<div id="header">
	        <div id="learning_path_header" style="font-size:14px;">
	            <table>
	                <tr>
	                    <td>
	                        <a href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();"><img src="../img/lp_arrow.gif" /></a>
	                    </td>
	                    <td>
	                        <a class="link" href="lp_controller.php?<?php echo api_get_cidreq(); ?>&amp;action=return_to_course_homepage" target="_self" onclick="window.parent.API.save_asset();">
	                        <?php echo api_convert_encoding(get_lang('CourseHomepageLink'), $charset, api_get_system_encoding()); ?></a>
	                    </td>
	                </tr>
	            </table>
	        </div>
		</div>
		<!-- end header -->

        <!-- Image preview Layout -->

			<div id="author_image" class="lp_author_image" style="height:15%; width:100%;margin-left:5px;">
		<?php $image = '../img/lp_author_background.gif'; ?>

			<div id="preview_image" style="padding:5px;background-image: url('../img/lp_author_background.gif');background-repeat:no-repeat;height:110px">

		       	<div style="width:100px; float:left;height:105px;margin:5px">
		       		<span style="width:104px; height:96px; float:left; vertical-align:bottom;">
			        <center>
			        <?php
			        if ($_SESSION['oLP']->get_preview_image()!='') {
			        	$picture = getimagesize(api_get_path(SYS_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image());
			        	if($picture['1'] < 96) { $style = ' style="padding-top:'.((94 -$picture['1'])/2).'px;" '; }
			        	$size = ($picture['0'] > 104 && $picture['1'] > 96 )? ' width="104" height="96" ': $style;
			        	$my_path = api_get_path(WEB_COURSE_PATH).api_get_course_path().'/upload/learning_path/images/'.$_SESSION['oLP']->get_preview_image();
			        	echo '<img '.$size.' src="'.$my_path.'">';
			        } else {
						echo Display :: display_icon('unknown_250_100.jpg', ' ');
					}
					?>
				    </center>
				    </span>
		       	</div>

				<div id="nav_id" name="nav_name" class="lp_nav" style="margin-left:105px;height:90px">
			        <?php
						$display_mode = $_SESSION['oLP']->mode;
						$scorm_css_header = true;
						$lp_theme_css = $_SESSION['oLP']->get_theme();

						//Setting up the CSS theme if exists
						if (!empty ($lp_theme_css) && !empty ($mycourselptheme) && $mycourselptheme != -1 && $mycourselptheme == 1) {
							global $lp_theme_css;
						} else {
							$lp_theme_css = $my_style;
						}

						$progress_bar = $_SESSION['oLP']->get_progress_bar('', -1, '', true);
						$navigation_bar = $_SESSION['oLP']->get_navigation_bar();
						$mediaplayer = $_SESSION['oLP']->get_mediaplayer($autostart);

						$tbl_lp_item	= Database::get_course_table(TABLE_LP_ITEM);
						$show_audioplayer = false;
						// getting all the information about the item
						$sql = "SELECT audio FROM " . $tbl_lp_item . " WHERE lp_id = '" . Database::escape_string($_SESSION['oLP']->lp_id)."'";
						$res_media= Database::query($sql, __FILE__, __LINE__);

						if (Database::num_rows($res_media) > 0) {
							while ($row_media= Database::fetch_array($res_media)) {
							     if (!empty($row_media['audio'])) {$show_audioplayer = true; break;}
							}
						}
					?>

					<div id="lp_navigation_elem" class="lp_navigation_elem" style="padding-left:130px;margin-top:9px;">
						<div style="padding-top:15px;padding-bottom:50px;" ><?php echo $navigation_bar; ?></div>
						<div style="height:20px"><?php echo $progress_bar; ?></div>
					</div>
				</div>
    		</div>
	   </div>
	   <!-- end image preview Layout -->
		<div id="author_name" style="position:relative;top:2px;left:0px;margin:0;padding:0;text-align:center;width:100%">
			<?php echo $_SESSION['oLP']->get_author() ?>
		</div>

		<!-- media player layaout -->
		<?php $style_media = (($show_audioplayer)?' style= "position:relative;top:10px;left:10px;margin:8px;font-size:32pt;height:20px;"':'style="height:15px"'); ?>
		<div id="media"  <?php echo $style_media ?>>
			<?php echo (!empty($mediaplayer))?$mediaplayer:'&nbsp;' ?>
		</div>
		<!-- end media player layaout -->

		<!-- toc layout -->
		<div id="toc_id"  style="overflow: auto; padding:0;margin-top:20px;height:60%;width:100%">
			<div id="learning_path_toc" style="font-size:9pt;margin:0;"><?php echo $_SESSION['oLP']->get_html_toc(); ?>

    	<?php if (!empty($_SESSION['oLP']->scorm_debug)) { //only show log ?>
	        <!-- log message layout -->
			<div id="lp_log_name" name="lp_log_name" class="lp_log" style="height:150px;overflow:auto;margin:4px">
				<div id="log_content"></div>
				<div id="log_content_cleaner" style="color: white;">.</div>
			</div>
	        <!-- end log message layout -->
	   <?php } ?>
			</div>
		</div>
		<!-- end toc layout -->
	</div>
    <!-- end left Zone -->

    <!-- right Zone -->
	<div id="learning_path_right_zone" style="height:700px">
		<iframe id="content_id" name="content_name" class="course_view autoHeight author_view_min_height" width="100%" height="700px" frameborder="0" ></iframe>
	</div>
    <!-- end right Zone -->
</div>
</div>
<script language="JavaScript" type="text/javascript">
<!--
	// now we load the content after havin loaded the dom, so that we are sure that scorm_api is loaded
	window.onload = function () {
		$('#content_id').attr('src','<?php echo addslashes($src) ?>');
	};
-->
</script>
</body>
<?php
	/*
	==============================================================================
	  FOOTER
	==============================================================================
	*/
	//Display::display_footer();
}
//restore global setting
$_setting['show_navigation_menu'] = $save_setting;
