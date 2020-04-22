<?
	session_start();
	
	require_once("config.inc.php");
	
	if ($_SERVER["REQUEST_METHOD"] != "POST" && $_SERVER["HTTP_REFERER"] != $admin_url."login.php") die();
	
	$admin_id = postParam("ADMINID","");
	$admin_pwd = postParam("ADMINPWD","");
	//$pwd_edit = base64_encode(base64_encode(postParam("ADMINPWD","")));
	//$admin_pwd = $pwd_edit;
	$tries = postParam("TRIES",0);
	
	if (!is_numeric($tries)) $tries = 0;
	$tries++;
	$ref = postParam("ref","index.php?seed=".md5(date('m/d/y,h:m:s')));
	/*
	$strsql = "SELECT tadmin_new.admin_id,tadmin_new.password,tadmin_new.salt,tadmin_new.issuperadmin,tadmingroup_user.group_id  
				FROM tadmin_new inner join tadmingroup_user on  tadmin_new.admin_id=tadmingroup_user.admin_id 
				WHERE tadmin_new.username='".$admin_id."'";
	*/
	
	$strsql = "SELECT tadmin_new.admin_id, tadmin_new.username, tadmin_new.password,tadmin_new.salt,tadmin_new.issuperadmin,tadmingroup.group_id  
				FROM tadmin_new inner join tadmingroup on tadmin_new.admin_id=tadmingroup.group_id 
				WHERE tadmin_new.username='".$admin_id."'";
				
	$mega_db->query($strsql); 
	//echo $mega_db->recordCount();die();
	//$mega_db->row("group_id")."+".$mega_db->row("admin_id");die(); 
	if ($mega_db->recordCount()!=1) {
		location($FJR_VARS["admin_url"]."login.php?err=1&tries=".$tries."&ref=".rawurlencode($ref)."&seed=".md5(date('m/d/y,h:m:s')));
		exit;
	} else {
		$mega_db->next();
		/*
		if ($mega_db->row("password") != $admin_pwd) {
			location($FJR_VARS["admin_url"]."login.php?err=2&tries=".$tries."&ref=".rawurlencode($ref)."&seed=".md5(date('m/d/y,h:m:s')));
			exit;
		}*/
		$hash = hash('sha256', $mega_db->row("salt") . $admin_pwd );
		if ($hash != $mega_db->row("password")) { //incorrect password
			location($FJR_VARS["admin_url"]."login.php?err=2&tries=".$tries."&ref=".rawurlencode($ref)."&seed=".md5(date('m/d/y,h:m:s')));
			exit;
		}
		 else {
			
			$group = cmsDB();
			
			if((intval($mega_db->row("group_id")) == 1) || $mega_db->row("admin_id") == 1){
				$group->query("select group_id FROM tadmingroup");
			}else{
				$group->query("select group_id FROM tadmingroup_user WHERE admin_id=".$mega_db->row("admin_id"));
			}
			$group_auth = "";
			while ($group->next()) {
				$group_auth = ListAppend($group_auth,$group->row("group_id"),",");
			}
			$group->query("select distinct(auth_id) as auth from tadmingroup_authorized where group_id in (". $group_auth .")");
			$lstauth = $group->valueList("auth");
			//echo $group->valueList("auth");
			//die();
			$group->query("select distinct(template_id) as template from tadmingroup_template where group_id in (". $group_auth .")");
			$lsttemplate=$group->valueList("template");
			
			/*
			setcookie("template_auth",$lsttemplate);
			setcookie("module_auth",$lstauth);
			setcookie("group_auth",$group_auth);
						
			setcookie($FJR_VARS["admin_cookie"],$mega_db->row("admin_id"));
			*/
			
			$_SESSION["template_auth"] = $lsttemplate;
			$_SESSION["module_auth"] = $lstauth;
			$_SESSION["group_auth"] = $group_auth;
			$_SESSION["issuperadmin"] = $mega_db->row("issuperadmin");
			$_SESSION[$FJR_VARS["admin_cookie"]] = $mega_db->row("admin_id");
			
			//echo $_SESSION["template_auth"]; 
			//echo $_SESSION["module_auth"]; 
			//echo $_SESSION["group_auth"]; 
			//echo $_SESSION["issuperadmin"];
			//echo $_SESSION[$FJR_VARS["admin_cookie"]]; 
			//die();
			
			jsNavigate($ref,true);
		}
	}
?>
