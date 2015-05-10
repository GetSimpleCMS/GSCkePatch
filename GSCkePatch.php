<?php

/**
* @name ckeditor plugin
* description of
* @version 0.3
* @author Shawn Alverson
* @link http://getsimple-cmd.info
* @file GSCkePatch.php
*/

$pluginid = "GSCkePatch";

function init_GSCkePatch($pluginid){
	$thisfile = basename(__FILE__, ".php");	// Plugin File
	$name     = $pluginid;
	$version  = "0.3";
	$author   = "getsimple";
	$url      = "http://get-simple.info";
	$desc     = "Overrides ckeditor 3.x with 4.4.7";
	$type     = "";
	$func     = "";

	register_plugin($thisfile,$name,$version,$author,$url,$desc,$type,$func);
}

init_GSCkePatch($pluginid);

if(get_filename_id() == 'edit' && $HTMLEDITOR){
	add_action("header",$pluginid.'_header',$pluginid);
	add_action("edit-content",$pluginid.'_edit_content');
}

function GSCkePatch_edit_content(){
	ob_start('GSCkePatch_obfilter');
}

function GSCkePatch_obfilter($buffer){
	return str_replace('<script type="text/javascript" src="template/js/ckeditor/ckeditor.js"></script>','',$buffer);
}

function GSCkePatch_header($pluginid){
	global $SITEURL;
 	echo '<script type="text/javascript" src="'.$SITEURL.'plugins/'.$pluginid.'/js/ckeditor/ckeditor.js"></script>';
}

?>