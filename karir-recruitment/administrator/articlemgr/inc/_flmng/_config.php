<?
	require ("../../config.php");
	$RootPath = $filepath;
	$upload_mimetypes = explode(",",strtoupper($file_mimetype));
	$allow_upload = $allow_file_upload;
	$allow_delete = $allow_file_delete;
	$allow_mkdir = $allow_file_mkdir;
	$allow_rmdir = $allow_file_rmdir;
?>