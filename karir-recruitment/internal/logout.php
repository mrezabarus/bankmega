<?
		include("config.php");
		/*
		session_unregister("ss_id" . date("mdY"));
		session_unregister("user_id" . date("mdY"));
		session_unregister("user_name" . date("mdY"));
		session_unregister("full_name" . date("mdY"));
		session_unregister("ssbranch_id" . date("mdY"));
		*/
		/*
		unset($_SESSION["ss_id" . date("mdY")]);
		unset($_SESSION["ssbranch_id" . date("mdY")]);
		unset($_SESSION["ssregion_id" . date("mdY")]);
		unset($_SESSION["user_id" . date("mdY")]);
		unset($_SESSION["user_name" . date("mdY")]);
		unset($_SESSION["full_name" . date("mdY")]);
		*/
		session_destroy();

		echo "<script>alert('Application Logged out');location='".$base_www."?URLEncryptCode=".md5("mdYHis")."';</script>";
		die();
?>