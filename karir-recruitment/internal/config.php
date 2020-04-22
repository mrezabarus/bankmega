<?php
	/*
	$base_path = "/home/xolut246/public_html/client/mega/internal/";
	$base_www = "http://xolution.net/client/mega/internal";
	$base_url = "/client/mega/internal/";
	
	$base_path = "c:/xampp183/htdocs/mega/internal/";
	$base_www = "http://localhost/mega/internal";
	$base_url = "/mega/internal/";
	*/
	
	$base_path = "C:Apache2/htdocs/erec/internal/";
	$base_www = "http://localhost/erec/internal/";
	$base_url = "/erec/internal/";
	
	session_start();
	/*
	require_once($base_path."includes/dbmysql.inc.php");
	require_once($base_path."includes/miscfunction.inc.php");
	require_once($base_path."includes/listfunction.inc.php");
	require_once($base_path."includes/defaultvar.inc.php");
	*/
	include "includes/dbmysql.inc.php";
	include "includes/miscfunction.inc.php";
	include "includes/listfunction.inc.php";
	include "includes/defaultvar.inc.php";
	if(!isset($_SESSION["ss_id" . date("mdY")])){
		header("Location: index.php"); 	
	}
?>
