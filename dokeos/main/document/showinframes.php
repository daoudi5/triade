<?php // $Id: showinframes.php 22177 2009-07-16 22:30:39Z iflorespaz $

/* For licensing terms, see /dokeos_license.txt */

/**
==============================================================================
*	This file will show documents in a separate frame.
*	We don't like frames, but it was the best of two bad things.
*
*	display html files within Dokeos - html files have the Dokeos header.
*
*	--- advantages ---
*	users "feel" like they are in Dokeos,
*	and they can use the navigation context provided by the header.
*
*	--- design ---
*	a file gets a parameter (an html file)
*	and shows
*	- dokeos header
*	- html file from parameter
*	- (removed) dokeos footer
*
*	@version 0.6
*	@author Roan Embrechts (roan.embrechts@vub.ac.be)
*	@package dokeos.document
==============================================================================
*/

// name of the language file that needs to be included 
$language_file[] = 'document';

// include the global Dokeos file
require_once '../inc/global.inc.php';

// include additional libraries
require_once '../glossary/glossary.class.php';

if (!empty($_GET['nopages'])) {
	$nopages=Security::remove_XSS($_GET['nopages']);
	if ($nopages==1) {
		require_once api_get_path(INCLUDE_PATH).'reduced_header.inc.php';
		Display::display_error_message(get_lang('FileNotFound'));
	}
	exit;
}

$_SESSION['whereami'] = 'document/view';
$_SESSION['dbName'] = $_course['dbName'];
// breadcrumbs
$interbreadcrumb[]= array ('url'=>'./document.php', 'name'=> get_lang('Documents'));

$nameTools = get_lang('Documents');

$file = Security::remove_XSS(urldecode($_GET['file']));
/*
==============================================================================
		Main section
==============================================================================
*/
header('Expires: Wed, 01 Jan 1990 00:00:00 GMT');
//header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Last-Modified: Wed, 01 Jan 2100 00:00:00 GMT');

header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

/*$browser_display_title = "Dokeos Documents - " . Security::remove_XSS($_GET['cidReq']) . " - " . $file;

//only admins get to see the "no frames" link in pageheader.php, so students get a header that's not so high
$frameheight = 135;
if($is_courseAdmin) {
	$frameheight = 165;
}*/

$file_root=$_course['path'].'/document'.str_replace('%2F', '/',$file);
$file_url_sys=api_get_path(SYS_COURSE_PATH).$file_root;
$file_url_web=api_get_path(WEB_COURSE_PATH).$file_root;
$path_info= pathinfo($file_url_sys);

$is_allowed_to_edit  = api_is_allowed_to_edit();
$curdirpathurl = Security::remove_XSS($_REQUEST['curdirpath']);

Display :: display_tool_header($nameTools, "Doc");
echo '<div class="actions">';
echo '<a href="document.php?'.api_get_cidreq().'&curdirpath='.urlencode($curdirpathurl).$req_gid.'">'.Display::return_icon('go_previous_32.png',get_lang('Documents')).' '.get_lang('Documents').'</a>';
if ($is_allowed_to_edit) {
	if (!$is_certificate_mode) {
		echo '<a href="create_document.php?'.api_get_cidreq().'&amp;dir='.urlencode($curdirpathurl).$req_gid.'">'.Display::return_icon('create_doc.png',get_lang('CreateDoc')).' '.get_lang('CreateDoc').'</a>';
	} else {
		echo '<a href="create_document.php?'.api_get_cidreq().'&amp;dir='.urlencode($curdirpathurl).$req_gid.'&amp;certificate=true&amp;selectcat=' . Security::remove_XSS($_GET['selectcat']).'">'.Display::return_icon('create_doc.png',get_lang('CreateCertificate')).' '.get_lang('CreateCertificate').'</a>';
	}
	echo '<a href="template_gallery.php?doc=N&'.  api_get_cidreq().'">'.Display::return_icon('tools_wizard_48.png',get_lang('Templates')).' '.get_lang('Templates').'</a>';
	echo '<a href="mediabox.php?curdirpath='.$curdirpathurl.$req_gid.'&'.  api_get_cidreq().'">'.Display::return_icon('mediaplayer.png',get_lang('Mediabox')).' '.get_lang('Mediabox').'</a>';
	echo '<a href="upload.php?'.api_get_cidreq().'&amp;path='.$curdirpathurl.$req_gid.'&amp;selectcat=' . Security::remove_XSS($_GET['selectcat']).'">'.Display::return_icon('up.png',get_lang('UplUpload')).' '.get_lang('UplUpload').'</a>';
}
echo '</div>';
?>
<?php
if (file_exists($file_url_sys)) {
  $url = $file_url_web.'?'.api_get_cidreq().'&rand='.mt_rand(1,10000);
} else {
  $url = 'showinframes.php?nopages=1';
}
?>
<div id="content_with_secondary_actions">
<iframe id="content_id" src ="<?php echo $url; ?>" width="100%" height="700" frameborder="0">
  <p>Your browser does not support iframes.</p>
</iframe>
</div>
<?php
 // bottom actions bar
echo '<div class="actions">';
echo '</div>';
Display :: display_footer();
?>