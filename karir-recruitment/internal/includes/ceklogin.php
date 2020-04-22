<?
	if(listLast(getenv("script_name"),"/") <> "login.php"){
		if(strlen($_SESSION['user_id']==0) && strlen($_SESSION['user_name'])==0){
			header ("Location: login.php");
		}
	}
?>