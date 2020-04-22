<?
	if(getAdminCookie() != ""){
		$quser = cmsDB();
		$quser->query("SELECT * FROM tadmin_new WHERE admin_id = ".getAdminCookie());
		$quser->next();
		$FJR_VARS["isSuperAdmin"] = $quser->row("issuperadmin");
		if($FJR_VARS["isSuperAdmin"] == 0){
		$qauth = cmsDB();
		$SQL = "SELECT Auth.* 
		        FROM tadmingroup_user AS G, tadmingroup_authorized AS Auth 
				WHERE G.group_id = Auth.group_id AND G.admin_id = ".getAdminCookie();
			$qauth->query($SQL);
			while($qauth->next()){
				if(!strlen(trim($qauth->row("parent")))){
					$FJR_VARS["arrAuthorized"][$qauth->row("authorized_id")] = array();
				}else{
					$FJR_VARS["arrAuthorized"][$qauth->row("parent").".".$qauth->row("authorized_id")] = array();
				}
			}
		//print_r($FJR_VARS["arrAuthorized"]);
		}
	}
	
	function adminSecurity($keyword=""){
		global $FJR_VARS;
		if(getAdminCookie() != "" and strlen(trim($keyword))){
			if($FJR_VARS["isSuperAdmin"] == 1 or (array_key_exists($keyword,$FJR_VARS["arrAuthorized"])))
				return true;
			else
				return false;
		}else
			return false;
	}
?>