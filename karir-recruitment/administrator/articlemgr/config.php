<?
	require_once("../../config.inc.php");
	$imgpath = $CMS_VARS["cms_path"] ."_images/";
	$filepath = $CMS_VARS["cms_path"] ."_files/";
	$imgurl = $CMS_VARS["cms_url"] ."_images/";
	$fileurl = $CMS_VARS["cms_url"] ."_files/";
	$imgbaseurl = $CMS_VARS["cms_url"] ."_images/";
	$filebaseurl = $CMS_VARS["cms_url"] ."_files/";
	
	$allow_img_upload = true;
	$allow_img_delete = true;
	$allow_img_mkdir = true;
	$allow_img_rmdir = true;

	$allow_file_upload = true;
	$allow_file_delete = true;
	$allow_file_mkdir = true;
	$allow_file_rmdir = true; 
	
	$img_ext = "jpg,jpeg,gif,png,swf,mov,wav,mp3,mid";
	$file_ext = "jpg,jpeg,gif,png,swf,mov,wav,mp3,zip,exe,ppt,doc";
	$img_mimetype = "image/jpeg,image/pjpeg,image/gif,application/x-shockwave-flash,audio/mid,audio/wav,audio/mpeg";
	$file_mimetype = "image/jpeg,image/pjpeg,image/gif,application/octet-stream,application/zip,application/msword,application/vnd.ms-powerpoint";
?>