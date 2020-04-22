<? 
	require_once("../../config.inc.php");
	$err = 0;
	if(!strlen(trim(postParam("GROUPNAME"))))
		$err = 1;
		
	$mega_db->query("SELECT group_name FROM tadmingroup WHERE group_name = '".postParam("GROUPNAME")."'");
	$mega_db->next();
	if($mega_db->recordCount() > 0 and $err == 0)
		$err = 2;
		
	if($err > 0) {
		include "add.php";
		exit;
	}
	
	$sql = "INSERT INTO tadmingroup (group_name,description) VALUES ('";
	$sql .= postParam("GROUPNAME")."','".postParam("DESC")."')";
	$mega_db->query($sql);
	$mega_db->query("SELECT max(group_id) as group_id FROM tadmingroup");
	$mega_db->next();
	jsAlertAndNavigate("Group has added","edit.php?gid=".$mega_db->row("group_id")."&seed=".mktime());
?>