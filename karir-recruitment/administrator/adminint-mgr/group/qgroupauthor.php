<?
	require_once("../../config.inc.php");
	$mega_db=cmsDB();
	$mega_db->query("DELETE FROM tbl_group_authorization WHERE group_id = ".uriParam("gid"));
	$mega_db->query("select * from tbl_authorization");
	$parent = cmsDB();
	while($mega_db->next()){
		if(isset($_POST["FILEID_".$mega_db->row("auth_id")])){
			$parent->query("insert into tbl_group_authorization(group_id,auth_id) values(".uriParam("gid").",". $mega_db->row("auth_id") .")");
			//echo $_POST["FILEID_".$mega_db->row("auth_id")]."<br>";
		}
	}
	
	jsAlertAndNavigate("Group has been authorized","edit.php?gid=".uriParam("gid")."&seed=".mktime());
?>