<?
	require_once("../config.inc.php");

//	$uid = $_GET["uid"];
//	$strdb = cmsDB();
//	

		if (strlen(trim($_POST["pwd"]))){
			if(trim($_POST["pwd"]) == trim($_POST["pwd"])){
				$mega_db = cmsDB();
				$sql = "update erecruitment.tbl_jobseeker set
				        pwd='".trim($_POST["pwd"])."',email='".$_POST["email"]."'
				        where js_id='".uriParam("js_id")."'";
				//echo $sql;
				$mega_db->query($sql);
			}else{
				echo "<script>alert('Pengetikan Ulang Password Baru, Salah...!');history.back();</script>";
			}
		}else{
				$mega_db = cmsDB();
				$sql = "update erecruitment.tbl_jobseeker set email='".$_POST["email"]."'
						where js_id='".uriParam("js_id")."'";
				//echo $sql;
				$mega_db->query($sql);
		}
		$message = "Password User Telah Di Rubah!!";
		jsAlertAndNavigate($message,"index.php?refresh=".date("m d Y h m s")."&ref=".mktime(),true);
?>