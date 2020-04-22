<?
	require_once("../config.inc.php");

	$_flm_instanceurl = "FLMINS";
	$_FLM_IMGURL = "imgs/";
	$_FLM_SHOWHEADER = true;
	$_FLM_LEFTWIDTH = "25%";

	$_BS_FLM[0]["ROOTPATH"] = $FJR_VARS["www_img_admin"];
	$_BS_FLM[0]["TITLE"] = "Image Library Browser";
	$_BS_FLM[0]["SHOW_FILETYPE"] = false;
	$_BS_FLM[0]["SHOW_FILESIZE"] = true;
	$_BS_FLM[0]["MIME_DENY"] = "";
	$_BS_FLM[0]["MIME_ALLOW"] = "image/jpeg,image/pjpeg,image/gif,image/png";
	$_BS_FLM[0]["EXT_DENY"] = "";
	$_BS_FLM[0]["EXT_ALLOW"] = "";
	$_BS_FLM[0]["FILE_DENY"] = "";
	$_BS_FLM[0]["FILE_ALLOW"] = "";
	$_BS_FLM[0]["DIR_DENY"] = "";
	$_BS_FLM[0]["DIR_ALLOW"] = "";
	$_BS_FLM[0]["IS_UPLOAD"] = adminSecurity("IMAGES.UPLOAD") ? true : false;
	$_BS_FLM[0]["IS_DOWNLOAD"] = true;
	$_BS_FLM[0]["IS_MKDIR"] = adminSecurity("IMAGES.CREATE DIRECTORY") ? true : false;
	$_BS_FLM[0]["IS_RMDIR"] = adminSecurity("IMAGES.DELETE DIRECTORY") ? true : false;
	$_BS_FLM[0]["IS_CREATEFL"] = false;
	$_BS_FLM[0]["IS_EDIT"] = false;
	$_BS_FLM[0]["IS_MOVE"] = adminSecurity("IMAGES.MOVE") ? true : false;
	$_BS_FLM[0]["IS_COPY"] = adminSecurity("IMAGES.COPY") ? true : false;
	$_BS_FLM[0]["IS_DELETE"] = adminSecurity("IMAGES.DELETE") ? true : false;
	$_BS_FLM[0]["IS_RENAME"] = adminSecurity("IMAGES.RENAME") ? true : false;

	$_BS_FLM[1]["ROOTPATH"] = $FJR_VARS["www_embed_admin"];
	$_BS_FLM[1]["TITLE"] = "Embedded Object Library Browser";
	$_BS_FLM[1]["SHOW_FILETYPE"] = false;
	$_BS_FLM[1]["SHOW_FILESIZE"] = true;
	$_BS_FLM[1]["MIME_DENY"] = "";
	$_BS_FLM[1]["MIME_ALLOW"] = "wav,mov,swf";
	$_BS_FLM[1]["EXT_DENY"] = "";
	$_BS_FLM[1]["EXT_ALLOW"] = "";
	$_BS_FLM[1]["FILE_DENY"] = "";
	$_BS_FLM[1]["FILE_ALLOW"] = "";
	$_BS_FLM[1]["DIR_DENY"] = "";
	$_BS_FLM[1]["DIR_ALLOW"] = "";
	$_BS_FLM[1]["IS_UPLOAD"] = adminSecurity("EMBEDS.UPLOAD") ? true : false;
	$_BS_FLM[1]["IS_DOWNLOAD"] = true;
	$_BS_FLM[1]["IS_MKDIR"] = adminSecurity("EMBEDS.CREATE DIRECTORY") ? true : false;
	$_BS_FLM[1]["IS_RMDIR"] = adminSecurity("EMBEDS.DELETE DIRECTORY") ? true : false;
	$_BS_FLM[1]["IS_CREATEFL"] = false;
	$_BS_FLM[1]["IS_EDIT"] = false;
	$_BS_FLM[1]["IS_MOVE"] = adminSecurity("EMBEDS.MOVE") ? true : false;
	$_BS_FLM[1]["IS_COPY"] = adminSecurity("EMBEDS.COPY") ? true : false;
	$_BS_FLM[1]["IS_DELETE"] = adminSecurity("EMBEDS.DELETE") ? true : false;
	$_BS_FLM[1]["IS_RENAME"] = adminSecurity("EMBEDS.RENAME") ? true : false;

	$_BS_FLM[2]["ROOTPATH"] = $FJR_VARS["www_file_admin"];
	$_BS_FLM[2]["TITLE"] = "File Library Browser";
	$_BS_FLM[2]["SHOW_FILETYPE"] = false;
	$_BS_FLM[2]["SHOW_FILESIZE"] = true;
	$_BS_FLM[2]["MIME_DENY"] = "";
	$_BS_FLM[2]["MIME_ALLOW"] = "php,pl,cgi,pdf,doc,xls,ppt";
	$_BS_FLM[2]["EXT_DENY"] = "";
	$_BS_FLM[2]["EXT_ALLOW"] = "";
	$_BS_FLM[2]["FILE_DENY"] = "";
	$_BS_FLM[2]["FILE_ALLOW"] = "";
	$_BS_FLM[2]["DIR_DENY"] = "";
	$_BS_FLM[2]["DIR_ALLOW"] = "";
	$_BS_FLM[2]["IS_UPLOAD"] = adminSecurity("FILES.UPLOAD") ? true : false;
	$_BS_FLM[2]["IS_DOWNLOAD"] = true;
	$_BS_FLM[2]["IS_MKDIR"] = adminSecurity("FILES.CREATE DIRECTORY") ? true : false;
	$_BS_FLM[2]["IS_RMDIR"] = adminSecurity("FILES.DELETE DIRECTORY") ? true : false;
	$_BS_FLM[2]["IS_CREATEFL"] = false;
	$_BS_FLM[2]["IS_EDIT"] = false;
	$_BS_FLM[2]["IS_MOVE"] = adminSecurity("FILES.MOVE") ? true : false;
	$_BS_FLM[2]["IS_COPY"] = adminSecurity("FILES.COPY") ? true : false;
	$_BS_FLM[2]["IS_DELETE"] = adminSecurity("FILES.DELETE") ? true : false;
	$_BS_FLM[2]["IS_RENAME"] = adminSecurity("FILES.RENAME") ? true : false;

	$_BS_FLM[3]["ROOTPATH"] = $FJR_VARS["www_css_path"];
	$_BS_FLM[3]["TITLE"] = "Style Sheet Library Browser";
	$_BS_FLM[3]["SHOW_FILETYPE"] = false;
	$_BS_FLM[3]["SHOW_FILESIZE"] = true;
	$_BS_FLM[3]["MIME_DENY"] = "";
	$_BS_FLM[3]["MIME_ALLOW"] = "css";
	$_BS_FLM[3]["EXT_DENY"] = "";
	$_BS_FLM[3]["EXT_ALLOW"] = "";
	$_BS_FLM[3]["FILE_DENY"] = "";
	$_BS_FLM[3]["FILE_ALLOW"] = "";
	$_BS_FLM[3]["DIR_DENY"] = "";
	$_BS_FLM[3]["DIR_ALLOW"] = "";
	$_BS_FLM[3]["IS_UPLOAD"] = adminSecurity("STYLESHEETS.UPLOAD") ? true : false;
	$_BS_FLM[3]["IS_DOWNLOAD"] = true;
	$_BS_FLM[3]["IS_MKDIR"] = adminSecurity("STYLESHEETS.CREATE DIRECTORY") ? true : false;
	$_BS_FLM[3]["IS_RMDIR"] = adminSecurity("STYLESHEETS.DELETE DIRECTORY") ? true : false;
	$_BS_FLM[3]["IS_CREATEFL"] = adminSecurity("STYLESHEETS.CREATE FILE") ? true : false;
	$_BS_FLM[3]["IS_EDIT"] = adminSecurity("STYLESHEETS.EDIT FILE") ? true : false;
	$_BS_FLM[3]["IS_MOVE"] = adminSecurity("STYLESHEETS.MOVE") ? true : false;
	$_BS_FLM[3]["IS_COPY"] = adminSecurity("STYLESHEETS.COPY") ? true : false;
	$_BS_FLM[3]["IS_DELETE"] = adminSecurity("STYLESHEETS.DELETE") ? true : false;
	$_BS_FLM[3]["IS_RENAME"] = adminSecurity("STYLESHEETS.RENAME") ? true : false;

	$_BS_FLM[4]["ROOTPATH"] = $FJR_VARS["www_js_path"];
	$_BS_FLM[4]["TITLE"] = "Java Script Library Browser";
	$_BS_FLM[4]["SHOW_FILETYPE"] = false;
	$_BS_FLM[4]["SHOW_FILESIZE"] = true;
	$_BS_FLM[4]["MIME_DENY"] = "";
	$_BS_FLM[4]["MIME_ALLOW"] = "js";
	$_BS_FLM[4]["EXT_DENY"] = "";
	$_BS_FLM[4]["EXT_ALLOW"] = "";
	$_BS_FLM[4]["FILE_DENY"] = "";
	$_BS_FLM[4]["FILE_ALLOW"] = "";
	$_BS_FLM[4]["DIR_DENY"] = "";
	$_BS_FLM[4]["DIR_ALLOW"] = "";
	$_BS_FLM[4]["IS_UPLOAD"] = true;
	$_BS_FLM[4]["IS_DOWNLOAD"] = true;
	$_BS_FLM[4]["IS_MKDIR"] = true;
	$_BS_FLM[4]["IS_RMDIR"] = true;
	$_BS_FLM[4]["IS_CREATEFL"] = true;
	$_BS_FLM[4]["IS_EDIT"] = true;
	$_BS_FLM[4]["IS_MOVE"] = true;
	$_BS_FLM[4]["IS_COPY"] = true;
	$_BS_FLM[4]["IS_DELETE"] = true;
	$_BS_FLM[4]["IS_RENAME"] = true;

	$_BS_FLM[5]["ROOTPATH"] = $base_path;
	$_BS_FLM[5]["TITLE"] = "BS System Browser";
	$_BS_FLM[5]["SHOW_FILETYPE"] = false;
	$_BS_FLM[5]["SHOW_FILESIZE"] = true;
	$_BS_FLM[5]["MIME_DENY"] = "";
	$_BS_FLM[5]["MIME_ALLOW"] = "";
	$_BS_FLM[5]["EXT_DENY"] = "";
	$_BS_FLM[5]["EXT_ALLOW"] = "";
	$_BS_FLM[5]["FILE_DENY"] = "";
	$_BS_FLM[5]["FILE_ALLOW"] = "";
	$_BS_FLM[5]["DIR_DENY"] = "";
	$_BS_FLM[5]["DIR_ALLOW"] = "";
	$_BS_FLM[5]["IS_UPLOAD"] = true;
	$_BS_FLM[5]["IS_DOWNLOAD"] = true;
	$_BS_FLM[5]["IS_MKDIR"] = true;
	$_BS_FLM[5]["IS_RMDIR"] = true;
	$_BS_FLM[5]["IS_CREATEFL"] = true;
	$_BS_FLM[5]["IS_EDIT"] = true;
	$_BS_FLM[5]["IS_MOVE"] = true;
	$_BS_FLM[5]["IS_COPY"] = true;
	$_BS_FLM[5]["IS_DELETE"] = true;
	$_BS_FLM[5]["IS_RENAME"] = true;

	$_BS_FLM[6]["ROOTPATH"] = $FJR_VARS["www_banner_admin"];
	$_BS_FLM[6]["TITLE"] = "Banner Library Browser";
	$_BS_FLM[6]["SHOW_FILETYPE"] = false;
	$_BS_FLM[6]["SHOW_FILESIZE"] = true;
	$_BS_FLM[6]["MIME_DENY"] = "";
	$_BS_FLM[6]["MIME_ALLOW"] = "gif,jpg,jpeg,png,bmp";
	$_BS_FLM[6]["EXT_DENY"] = "";
	$_BS_FLM[6]["EXT_ALLOW"] = "";
	$_BS_FLM[6]["FILE_DENY"] = "";
	$_BS_FLM[6]["FILE_ALLOW"] = "";
	$_BS_FLM[6]["DIR_DENY"] = "";
	$_BS_FLM[6]["DIR_ALLOW"] = "";
	$_BS_FLM[6]["IS_UPLOAD"] = adminSecurity("BANNER.UPLOAD") ? true : false;
	$_BS_FLM[6]["IS_DOWNLOAD"] = true;
	$_BS_FLM[6]["IS_MKDIR"] = adminSecurity("BANNER.CREATE DIRECTORY") ? true : false;
	$_BS_FLM[6]["IS_RMDIR"] = adminSecurity("BANNER.DELETE DIRECTORY") ? true : false;
	$_BS_FLM[6]["IS_CREATEFL"] = false;
	$_BS_FLM[6]["IS_EDIT"] = false;
	$_BS_FLM[6]["IS_MOVE"] = adminSecurity("BANNER.MOVE") ? true : false;
	$_BS_FLM[6]["IS_COPY"] = adminSecurity("BANNER.COPY") ? true : false;
	$_BS_FLM[6]["IS_DELETE"] = adminSecurity("BANNER.DELETE") ? true : false;
	$_BS_FLM[6]["IS_RENAME"] = adminSecurity("BANNER.RENAME") ? true : false;

	$_flm_instance = 0;
	if (isset($_GET[$_flm_instanceurl])) $_flm_instance = $_GET[$_flm_instanceurl];

	if (array_key_exists($_flm_instance,$_BS_FLM))
		$_FLM = $_BS_FLM[$_flm_instance];
	else
		die('<font face="arial,helvetica" size="2" color="#FF0000">Error! Cannot Find Valid Instance For File Manager!</font>');
	
	$_instanceurl = $_flm_instanceurl."=".rawurlencode($_flm_instance);
	
	if (!@is_dir($_FLM["ROOTPATH"])) die('<font face="arial,helvetica" size="2">'.$_FLM["TITLE"].' | File Manager : Root Directory Does Not Exists!</font>');
	
	@clearstatcache();
	
	require "_flm_lib.php";
	
	set_magic_quotes_runtime(0);
?>