<?
	require ("../../config.php");
	$RootPath = $imgpath;
	$upload_mimetypes = explode(",",strtoupper($img_mimetype));
	$allow_upload = $allow_img_upload;
	$allow_delete = $allow_img_delete;
	$allow_mkdir = $allow_img_mkdir;
	$allow_rmdir = $allow_img_rmdir;
?>