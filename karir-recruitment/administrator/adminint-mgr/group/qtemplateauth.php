<?
	require_once("../../config.inc.php");
	
	$mega_db->query("DELETE FROM tadmingroup_template WHERE group_id = ".uriParam("gid"));
	
	for($i=1;$i<=$_POST["FILECOUNT"];$i++){
		if(isset($_POST["FILEID_".$i])){
			$mega_db->query("insert into tadmingroup_template(group_id,template_id) values(".uriParam("gid").",'". $_POST["FILEID_".$i] ."')");
		}
	}
	
	jsAlertAndNavigate("Template has been authorized","edit.php?gid=".uriParam("gid")."&seed=".mktime());
?>