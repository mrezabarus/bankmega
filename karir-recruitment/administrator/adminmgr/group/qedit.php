<?
	require_once("../../config.inc.php");
	$mega_db->query("update tadmingroup set group_name='".trim($_POST["GROUPNAME"])."',description='".trim($_POST["DESC"])."' where group_id=".uriParam("gid"));
	$mega_db->query("DELETE FROM tadmingroup_user WHERE group_id = ".uriParam("gid"));
	if(strlen(trim(postParam("USERLIST")))) {
		$ulist = split(",",postParam("USERLIST"));
		foreach($ulist as $uid) {
			$SQL = "INSERT INTO tadmingroup_user (group_id, admin_id) VALUES (".uriParam("gid").",".$uid.")";
			$mega_db->query($SQL);
			if(uriParam("gid")==1){
				$mega_db->query("update tadmin set issuperadmin=1 where admin_id=".$uid);
			}
		}
	}
	jsAlertAndNavigate("Group has updated","edit.php?gid=".uriParam("gid")."&seed=".mktime());
?>