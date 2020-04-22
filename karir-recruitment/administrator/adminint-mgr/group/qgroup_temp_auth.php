<?
	require_once("../../config.inc.php");
	$mega_db->query("DELETE FROM ttemp_authorized WHERE group_id = ".uriParam("gid"));
	$str = array("TEMP","SHAREDTEMP");
	$arrGroupTemp = array();
	$qgrouptemp = cmsDB();
	$tempmgr = 0;
	foreach($str as $idx){
		if(postParam($idx) and postParam($idx."_ADD")){
			$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, button) VALUES (".uriParam("gid").", '".$idx."', 'ADD')");
		}
		if(postParam($idx) and strlen(trim(postParam($idx."_AUTH")))){
			if($tempmgr == 0){
				$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, authorized_id) VALUES (".uriParam("gid").", 'TEMPLATEMGR', '')");
				$tempmgr = 1;
			}
			$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, authorized_id) VALUES (".uriParam("gid").", '".$idx."', '')");
			foreach(split(",",postParam($idx."_AUTH")) as $temp_id) {
				$qgrouptemp->query("SELECT template_group FROM ttemplate WHERE template_id = '".$temp_id."'");
				$qgrouptemp->next();
				if(!array_key_exists($qgrouptemp->row("template_group"),$arrGroupTemp)){
					$arrGroupTemp[$qgrouptemp->row("template_group")] = array();
					if(strlen(trim($qgrouptemp->row("template_group")))){
						$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, authorized_id) VALUES (".uriParam("gid").", 'GROUPTEMP', '".$qgrouptemp->row("template_group")."')");
					}else{
						$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, authorized_id) VALUES (".uriParam("gid").", 'GROUPTEMP', '".$temp_id."')");
					}
				}
				$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, authorized_id) VALUES (".uriParam("gid").", '".$idx."', '".$temp_id."')");
				foreach(split(",",postParam($idx."_prop_".$temp_id)) as $btn){
					$mega_db->query("INSERT INTO ttemp_authorized (group_id, temp_type, authorized_id, button) VALUES (".uriParam("gid").", '".$idx."', '".$temp_id."', '".$btn."')");
				}
			}
		}
	}
	if(postParam("selAct") == "GoToArticleAuth"){
?>
	<script>location="group_art_auth.php?gid=<?=uriParam("gid")?>&seed=<?=mktime();?>";</script>
<?
	}else
		jsAlertAndNavigate("Template has authorized","edit.php?gid=".uriParam("gid")."&seed=".mktime(),$replacehistory)
?>