<?php
// Dokeos - elearning and course management software
// See license terms in dokeos/documentation/license.txt

// Training tools
// Wiki

// For more information: http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options

// This is the visible toolbar set when the editor has "normal" size.
$config['ToolbarSets']['Normal'] = array(
/*	array('NewPage','Templates','Save','PageBreak','Preview','FitWindow','-','PasteText','-','Undo','Redo','-','SelectAll','-','Find'),
	array('Wikilink','Link','Unlink','Anchor'),
	array('Image','flvPlayer','Flash','EmbedMovies','YouTube','MP3','mimetex','asciimath'),
	array('Table','Smiley','SpecialChar','googlemaps'),
	array('FontFormat','FontName','FontSize'),
	array('Bold','Italic','Underline'),
	array('Subscript','Superscript','-','JustifyLeft','JustifyCenter','JustifyRight','-','OrderedList','UnorderedList','-','Outdent','Indent','-','TextColor','BGColor'),
	array('Source')*/

	array('Save','FitWindow','-','PasteText'),
	array('Wikilink','Link','Unlink','Anchor','Glossary'),
	array('Image','imgmapPopup','MascotManager','MindmapManager','flvPlayer','Flash','EmbedMovies','YouTube','MP3','mimetex','asciimath'),
	array('Table','SpecialChar'),
	array('Subscript','Superscript','-','OrderedList','UnorderedList','-','TextColor','BGColor'),
	'/',
	array('Style','FontFormat','FontSize','JustifyLeft','JustifyCenter','JustifyRight'),
	array('Bold','Italic','Underline'),	
	array('Source')
);

// This is the visible toolbar set when the editor is maximized.
// If it has not been defined, then the toolbar set for the "normal" size is used.
/*
$config['ToolbarSets']['Maximized'] = array(
	array('FitWindow','-') // ...
);
*/

// Sets whether the toolbar can be collapsed/expanded or not.
// Possible values: true , false
//$config['ToolbarCanCollapse'] = true;

// Sets how the editor's toolbar should start - expanded or collapsed.
// Possible values: true , false
//$config['ToolbarStartExpanded'] = true;

//This option sets the location of the toolbar.
// Possible values: 'In' , 'None' , 'Out:[TargetId]' , 'Out:[TargetWindow]([TargetId])'
//$config['ToolbarLocation'] = 'In';

// A setting for blocking copy/paste functions of the editor.
// This setting activates on leaners only. For users with other statuses there is no blocking copy/paste.
// Possible values: true , false
//$config['BlockCopyPaste'] = false;

// Here new width and height of the editor may be set.
// Possible values, examples: 300 , '250' , '100%' , ...
//$config['Width'] = '100%';
//$config['Height'] = '400';