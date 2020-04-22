<?
if(isset($_POST["user_name"]) && strlen(trim($_POST["pwd"]))){
	$cekuser=cmsDB();
	if(trim($_POST["js_id"])){
		$cekuser->query("select * from erecruitment.tbl_jobseeker where user_name='".trim($_POST["user_name"])."' and pwd='".trim($_POST["pwd"])."'");
	}else{
		$cekuser->query("select * from erecruitment.tbl_jobseeker where user_name='".trim($_POST["user_name"])."' and pwd='".trim($_POST["pwd"])."'");
		if($cekuser->recordCount()){
			$cekuser->next();
			session_register("ss_name");
			session_register("ss_status");
			session_register("ss_id");
			$_SESSION["ss_name"] = $cekuser->row("user_name");
			$_SESSION["ss_id"] = $cekuser->row("js_id");
			$_SESSION["ss_status"];
			header ("Location: index.php?pgid=profile_view&js_id=".$_SESSION["ss_id"]."&refresh=".md5(date('m/d/y,h:m:s'))."");
			exit;
		}else{
			echo "<script>alert(\"User Name or Password is Invalid!!\");history.back();</script>";
			die();
		}
	}
	die();
}
?>