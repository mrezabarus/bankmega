<?
	require_once("../config.inc.php");
	$err = 0;
	if (!strlen(trim(postParam("SUBJECT")))) {
		$err = 1;
	} else if(!postParam("rdTO") or (postParam("rdTO") == 2 and !strlen(trim(postParam("INPUSER"))))) {
		$err = 2;
	} else if(!strlen(trim(postParam("MSGTEXT")))) {
		$err = 3;
	}
	
	if($err > 0){
		include "sendmsg.php";
		exit;
	}if (postParam("rdTO") == 1) {
		$SQL = "INSERT INTO tmessage (msg_datetime, msg_subject, msg_text, msg_sender_id, msg_receiver_id, highpriority, isread) 
		        VALUES (";
		$SQL .= "'".date("Y-m-d H:i:s")."','".postParam("SUBJECT")."','".postParam("MSGTEXT")."','".getAdminCookie()."','0',";
		if (postParam("HIGHPRI")) $SQL .= "'1',";
		else $SQL .= "'0',";
		$SQL .= "'0')";
		$mega_db->query($SQL);
	} else if (postParam("rdTO") == 2) {
		//echo postParam("INPUSER");
		for ($i = 1; $i <= listlen(postParam("INPUSER")); $i++) { 
		   $uid = listgetat(postParam("INPUSER"),$i); 
		   $SQL = "INSERT INTO tmessage (msg_datetime, msg_subject, msg_text, msg_sender_id, msg_receiver_id, highpriority, isread) VALUES (";
			$SQL .= "'".date("Y-m-d H:i:s")."','".postParam("SUBJECT")."','".postParam("MSGTEXT")."','".getAdminCookie()."','".$uid."',";
			if (postParam("HIGHPRI")) $SQL .= "'1',";
			else $SQL .= "'0',";
			$SQL .= "'0')";
			$mega_db->query($SQL);
		} 
	}
	jsAlert("Message has been sent");
?>
<script>
	parent.nav.location.reload();
	self.location = "index.php?seed=<?=mktime();?>";
</script>