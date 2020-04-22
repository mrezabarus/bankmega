<?
$counter_db = cmsDB();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	if(strlen($_SESSION['user_id']==0) && strlen($_SESSION['user_name'])==0){
			if(isset($_GET["login"])){
				if(trim($_GET["login"]) <> md5(date("mdY"))){
					echo "<script>alert('You are not authorized to see this Application!!\nIntruder Alert!!');location='login.php?refresh=".urlencode(date("m d Y h i s"))."';</script>";
					die();
				}
			}else{
					echo "<script>location='login.php?refresh=".urlencode(md5(date("m d Y h m s")))."';</script>";
					die();
			}
	}
}else{
	if(isset($_GET["login"])){
		if(trim($_GET["login"]) <> md5(date("mdY"))){
			echo "<script>alert('You are not authorized to see this Application!!\nIntruder Alert!!');location='login.php?refresh=".urlencode(md5(date("m d Y h m s")))."';</script>";
			die();
		}
	}else{
		echo "<script>location='login.php?refresh=".urlencode(md5(date("m d Y h m s")))."';</script>";
		die();
	}
}
?>