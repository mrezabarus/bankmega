<?
	require_once("../../config.inc.php");
	$mega_db->query("update tbl_group set group_name='".trim($_POST["GROUPNAME"])."',group_desc='".trim($_POST["DESC"])."' where group_id=".uriParam("gid"));
	$mega_db->query("DELETE FROM tbl_group_hrmuser WHERE group_id = ".uriParam("gid"));
	if(strlen(trim(postParam("USERLIST")))) {
		$ulist = split(",",postParam("USERLIST"));
		foreach($ulist as $uid) {
			$SQL = "INSERT INTO tbl_group_hrmuser (group_id, user_id) VALUES (".uriParam("gid").",".$uid.")";
			$mega_db->query($SQL);
		}
	}
	jsAlertAndNavigate("Group has updated","edit.php?gid=".uriParam("gid")."&seed=".mktime());
?>