<?
	require_once("../../config.inc.php");
	
	$mega_db->query("DELETE FROM tadmingroup_authorized WHERE group_id = ".uriParam("gid"));
	$parent = cmsDB();
	for($i=1;$i<=$_POST["FILECOUNT"];$i++){
		if(isset($_POST["FILEID_".$i])){
			$mega_db->query("select parent_id from tbl_authorization where auth_id=".$_POST["FILEID_".$i]);
			$mega_db->next();
			if($mega_db->row("parent_id")<>0){
				$parent->query("insert into tadmingroup_authorized(group_id,auth_id) values(".uriParam("gid").",". $mega_db->row("parent_id") .")");
			}
			$mega_db->query("insert into tadmingroup_authorized(group_id,auth_id) values(".uriParam("gid").",". $_POST["FILEID_".$i] .")");
		}
	}
	
	jsAlertAndNavigate("Group has been authorized","edit.php?gid=".uriParam("gid")."&seed=".mktime());
?>