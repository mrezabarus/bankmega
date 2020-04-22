<?
	require_once("../../config.inc.php");
	
	$mega_db->query("DELETE FROM tarticle_authorized WHERE group_id =".uriParam("gid"));
	
	$qtemp = cmsDB();
	$qtemp->query("SELECT authorized_id FROM ttemp_authorized WHERE group_id = ".uriParam("gid")." AND temp_type = 'TEMP' AND authorized_id <> ''");
	if(postParam("ARTICLEMGR")){
		$mega_db->query("INSERT INTO tarticle_authorized (group_id, authorized_id) VALUES (".uriParam("gid").", 'ARTICLEMGR')");
		$arrTemp = array();
		while($qtemp->next()){
			if(!array_key_exists($qtemp->row("authorized_id"),$arrTemp)){
				$arrTemp[$qtemp->row("authorized_id")] = array();
				if(postParam("ARTTEMP_ADD_".$qtemp->row("authorized_id"))){
					$mega_db->query("INSERT INTO tarticle_authorized (group_id, template_id, button) VALUES (".uriParam("gid").", '".$qtemp->row("authorized_id")."', 'ADD')");
				}
				if(postParam("ARTTEMP_".$qtemp->row("authorized_id")) and (postParam("ARTTEMP_ADD_".$qtemp->row("authorized_id")) or strlen(trim(postParam("ART_AUTH_".$qtemp->row("authorized_id")))))){
					$mega_db->query("INSERT INTO tarticle_authorized (group_id, template_id) VALUES (".uriParam("gid").", '".postParam("ARTTEMP_".$qtemp->row("authorized_id"))."')");
					if(strlen(trim(postParam("ART_AUTH_".$qtemp->row("authorized_id"))))){
						foreach(split(",",postParam("ART_AUTH_".$qtemp->row("authorized_id"))) as $artid){
							$mega_db->query("INSERT INTO tarticle_authorized (group_id, template_id, authorized_id) VALUES (".uriParam("gid").", '".postParam("ARTTEMP_".$qtemp->row("authorized_id"))."',".$artid.")");
							foreach(split(",",postParam("btn_".$qtemp->row("authorized_id")."_".$artid)) as $btn){
								$mega_db->query("INSERT INTO tarticle_authorized (group_id, template_id, authorized_id, button) VALUES (".uriParam("gid").", '".postParam("ARTTEMP_".$qtemp->row("authorized_id"))."',".$artid.", '".$btn."')");
							}
						}
					}
				}
			}
		}
	}
	jsAlertAndNavigate("Articles has been authorized","edit.php?gid=".uriParam("gid")."&seed=".mktime(),$replacehistory);
?>