<?php // $Id: $
/*
==============================================================================
	Dokeos - elearning and course management software

	Copyright (c) 2008 Dokeos Latinoamerica SAC
	Copyright (c) 2006 Dokeos SPRL
	Copyright (c) 2006 Ghent University (UGent)
	Copyright (c) various contributors

	For a full list of contributors, see "credits.txt".
	The full license can be read in "license.txt".

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	See the GNU General Public License for more details.

	Contact address: Dokeos, rue du Corbeau, 108, B-1030 Brussels, Belgium
	Mail: info@dokeos.com
==============================================================================
*/
$language_file = 'gradebook';
//$cidReset = true;
require_once ('../inc/global.inc.php');
require_once ('lib/be.inc.php');
require_once ('lib/fe/displaygradebook.php');
require_once ('lib/gradebook_functions.inc.php');
require_once ('lib/fe/evalform.class.php');
require_once ('lib/scoredisplay.class.php');
api_block_anonymous_users();
block_students();
$select_eval=Security::remove_XSS($_GET['selecteval']);
if (empty($select_eval)) {
	api_not_allowed();
}

$resultedit = Result :: load (null,null,$select_eval);
$evaluation = Evaluation :: load ($select_eval);
$edit_result_form = new EvalForm(EvalForm :: TYPE_ALL_RESULTS_EDIT, $evaluation[0], $resultedit, 'edit_result_form', null, api_get_self() . '?&selecteval='.$select_eval);
if ($edit_result_form->validate()) {
	$values = $edit_result_form->exportValues();
	
	// if the evaluation is of the type presence then we have to set the results that do not appear in the form submit to 0
	// (because we use checkboxes => form submit for unchecked checkboxes == empty)
	if ($evaluation[0]->get_type() == 'presence')
	{
		foreach ($resultedit as $result) {
			if (!key_exists($result->get_id(),$values['score']))
			{
				$values['score'][$result->get_id()] = 0;
			}
		}
	}
	
	
	$scores = ($values['score']);
	foreach ($scores as $row) {
		$resultedit = Result :: load (key($scores));
		$row_value=(int)$row ;
		if ((!empty ($row_value)) || ($row_value == 0)) {
			$resultedit[0]->set_score($row_value);
		}
		$resultedit[0]->save();
		next($scores);
	}
	header('Location: gradebook_view_result.php?selecteval='.$select_eval.'&editallresults=');
	exit;
}
$interbreadcrumb[] = array (
	'url' => $_SESSION['gradebook_dest'],
	'name' => get_lang('Gradebook'
));
$interbreadcrumb[]= array (
	'url' => 'gradebook_view_result.php?selecteval='.$select_eval,
	'name' => get_lang('ViewResult'
));
Display::display_tool_header(get_lang('EditResult'));
// Actions bar
echo '<div class="actions">';
	echo '<a href="gradebook_view_result.php?selecteval='.Security::remove_XSS($_GET['selecteval']).'&amp;'.api_get_cidreq().'">'.Display::return_icon('go_previous_32.png',get_lang('Back')).get_lang('Back').'</a>';
echo '</div>';

DisplayGradebook :: display_header_result ($evaluation[0],null,0,0);
echo '<div id="content">';
echo $edit_result_form->toHtml();
echo '</div>';

// Actions bar
echo '<div class="actions">';
echo '</div>';
Display :: display_footer();