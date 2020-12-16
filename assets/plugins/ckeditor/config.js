/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html
	
	//KCFinder      
	config.filebrowserBrowseUrl = '/assets/plugins/kcfinder/browse.php?opener=ckeditor&type=files';      
	config.filebrowserImageBrowseUrl = '/assets/plugins/kcfinder/browse.php?opener=ckeditor&type=images';      
	config.filebrowserFlashBrowseUrl = '/assets/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';      
	config.filebrowserUploadUrl = '/assets/plugins/kcfinder/upload.php?opener=ckeditor&type=files';      
	config.filebrowserImageUploadUrl = '/assets/plugins/kcfinder/upload.php?opener=ckeditor&type=images';     
	config.filebrowserFlashUploadUrl = '/assets/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';
	config.htmlEncodeOutput = false;
	config.entities = false;
	 config.colorButton_colors = '00923E,F8C100,28166F';
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];
	config.extraPlugins = 'enterkey,colorbutton';
	config.extraPlugins = 'colorbutton';
	config.extraPlugins = 'panelbutton';
	config.extraPlugins = 'pastefromexcel';
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';
	config.height = 350;  
	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	config.allowedContent = true;
	config.extraAllowedContent = 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}';
    CKEDITOR.dtd.$removeEmpty.i = 0;
	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
