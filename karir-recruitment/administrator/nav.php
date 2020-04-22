<?
	session_start();
	require_once("config.inc.php");
	//echo "cookie :" . $_SESSION["group_auth"];
////////////////////////////////////////////////////////////
	$qeditiondefault = cmsDB();
	$admin = cmsDB();
	$strSQL = "select edition_id from tbl_editiondefault where default_site=1";
	$qeditiondefault->query($strSQL);
	$qeditiondefault->next();
	
	$admin->query("select username from tadmin_new where admin_id=".$_SESSION[$FJR_VARS["admin_cookie"]]);
	$admin->next();
/////////////////////////////////////////////////////////////////
	$open_all = uriParam("openall","0") == "1"?"1":"0";
	
	$strSQL = "SELECT template_id, template_group, display_name FROM ttemplate ORDER BY display_name, template_id";
	$mega_db->query($strSQL);
	//echo $strSQL;
	
	$qmsg = cmsDB();
	$SQL = "SELECT msg_id FROM tmessage WHERE (msg_receiver_id = 0 OR msg_receiver_id = ".getAdminCookie().") AND isread = 0";
	$qmsg->query($SQL);
	$qmsg->next();
	if ($qmsg->recordCount() > 0) $msgCount = "Messages (".$qmsg->recordCount().")";
	else $msgCount = "Messages";

	$mega_db2 = cmsDB();
	$qgroup = cmsDB();
	$strSQL = "SELECT DISTINCT template_group from ttemplate ORDER BY template_group";
	$qgroup->query($strSQL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$admin_title?> [Main Navigation]</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
<script language="Javascript">
function BlinkTxt() {
if(document.getElementById && document.all){
obj = document.getElementsByTagName("blink");
for (var i=0; i<obj.length; i++)
if (obj[i].style.visibility=="hidden") {
obj[i].style.visibility="visible";
}
else {
obj[i].style.visibility="hidden";
}
setTimeout('BlinkTxt()',750);
}
}
onload=BlinkTxt;
</script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript" src="js/navtree.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
	USETEXTLINKS = 1;
	STARTALLOPEN = <?=$open_all?>;
	IMGPATH = "images/treeimgs/";
	navTree = gFld("<b>Menu Administration</b>", "","images/menu.gif","main","Menu Administration")
	<? if(listFind($_SESSION["module_auth"],1,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Profile", "profile/","images/pendingreg.gif","main","Profile"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],2,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Internal Mail", "message/","images/forums.gif","main","Internal Mail"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],3,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Region Area", "region/","images/news.gif","main","Region Area"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],4,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Branch Area", "branch/","images/news.gif","main","Branch Area"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],5,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Grade", "golongan/","images/news.gif","main","Grade"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],6,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Position", "position/","images/news.gif","main","Position"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],26,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Jurusan", "jurusan/","images/news.gif","main","Jurusan"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],27,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Pengalaman Kerja", "lastjob/","images/news.gif","main","Pengalaman Kerja"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],7,",") || $_SESSION["issuperadmin"]==1){ ?>
  	aux1a = insFld(navTree, gFld("&nbsp;Admin Manager", "","images/user_groups.gif","main","Admin Management"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],8,",") || $_SESSION["issuperadmin"]==1){ ?>
			insDoc(aux1a, gLnk("&nbsp;Admin List", "adminmgr/","images/user_mgmt.gif","main","Admin List"))
	<? } 
	   if(listFind($_SESSION["module_auth"],9,",") || $_SESSION["issuperadmin"]==1){ ?>
			insDoc(aux1a, gLnk("&nbsp;Admin Group Manager", "adminmgr/group/","images/user_groups.gif","main","Admin Group Manager"))
	<? }
	  if(listFind($_SESSION["module_auth"],10,",") || $_SESSION["issuperadmin"]==1){ ?>
  	aux1a = insFld(navTree, gFld("&nbsp;Internal Admin Manager", "","images/user_groups.gif","main","Internal Admin Management"))
	<? }
	  if(listFind($_SESSION["module_auth"],11,",") || $_SESSION["issuperadmin"]==1){ ?>
			insDoc(aux1a, gLnk("&nbsp;Internal HRM User", "adminint-mgr/","images/user_mgmt.gif","main","Internal HRM User"))
	<? } 
	   if(listFind($_SESSION["module_auth"],12,",") || $_SESSION["issuperadmin"]==1){ ?>
			insDoc(aux1a, gLnk("&nbsp;Internal HRM Group", "adminint-mgr/group/","images/user_groups.gif","main","Internal HRM Group"))
			insDoc(aux1a, gLnk("&nbsp;Region & Branch Group", "adminint-mgr/group/regionbranch.php","images/user_groups.gif","main","Region & Branch Group"))
			insDoc(aux1a, gLnk("&nbsp;Group Position", "adminint-mgr/group/regionbranch.php","images/user_groups.gif","main","Region & Branch Group"))
	<? } 
	  if(listFind($_SESSION["module_auth"],40,",") || $_SESSION["issuperadmin"]==1){ ?>
	aux2 = insFld(navTree, gFld("&nbsp;Template Manager", "","images/templates.gif","main","Template Manager"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],41,",") || $_SESSION["issuperadmin"]==1){ ?>
		  insDoc(aux2, gLnk("&nbsp;Templates", "templatemgr/","images/templates.gif","main","Templates"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],42,",") || $_SESSION["issuperadmin"]==1){ ?>
		  insDoc(aux2, gLnk("&nbsp;Shared Template Parts", "templatepartmgr/","images/templates.gif","main","Shared Template Parts"))
	<? } ?>
	<? 
	  if(listFind($_SESSION["module_auth"],40,",") || $_SESSION["issuperadmin"]==1){ ?>
	aux2 = insFld(navTree, gFld("&nbsp;Article Manager", "articlemgr/","images/templates.gif","main","Article Manager"))
	<? } ?>
	
	<? if(listFind($_SESSION["module_auth"],13,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;News", "breakingnews/","images/newspaper.gif","main","News"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],26,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Vacancy", "lowongan/","images/newspaper.gif","main","Vacancy"))
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],14,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Training Schedule", "Pelatihan/","images/newspaper.gif","main","Training Schedule"))
	<? if(listFind($_SESSION["module_auth"],15,",") || $_SESSION["issuperadmin"]==1){ ?>
	insDoc(navTree, gLnk("&nbsp;Tips & Tricks", "tips/","images/trik.gif","main","Tips & Tricks"))
	<? } ?>
	<? } ?>
	<? if(listFind($_SESSION["module_auth"],16,",") || $_SESSION["issuperadmin"]==1){ ?>
	 insDoc(navTree, gLnk("&nbsp;Training Group", "training/","images/_docs.gif","main","Training Group"))
	 <? } ?>  
	<? if(listFind($_SESSION["module_auth"],17,",") || $_SESSION["issuperadmin"]==1){ ?>
	 insDoc(navTree, gLnk("&nbsp;Peserta Ujian", "ujian/","images/_docs.gif","main","Jadwal Peserta Ujian"))
	 <? } ?>  
	<? if(listFind($_SESSION["module_auth"],18,",") || $_SESSION["issuperadmin"]==1){ ?>
     insDoc(navTree, gLnk("&nbsp;Contact", "contact/","images/user_groups.gif","main","Contact"))
	 <? } ?>
	  <? if(listFind($_SESSION["module_auth"],19,",") || $_SESSION["issuperadmin"]==1){ ?>
	aux3 = insFld(navTree, gFld("&nbsp;Library", "","images/library.gif","main","Images, Files, Embedded Objects, Style Sheet and Java Script Library"))
	<? }
	   if(listFind($_SESSION["module_auth"],20,",") || $_SESSION["issuperadmin"]==1){ ?>
		  	insDoc(aux3, gLnk("&nbsp;Images", "filemgr/index.php?FLMINS=0","images/images.gif","main","Image Library"))
	<? }
	   if(listFind($_SESSION["module_auth"],21,",") || $_SESSION["issuperadmin"]==1){ ?>
		  	insDoc(aux3, gLnk("&nbsp;Embeds", "filemgr/index.php?FLMINS=1","images/embeds.gif","main","Embedded Object Library"))
	<? } 
	   if(listFind($_SESSION["module_auth"],22,",") || $_SESSION["issuperadmin"]==1){ ?>
		  	insDoc(aux3, gLnk("&nbsp;Files", "filemgr/index.php?FLMINS=2","images/files.gif","main","File Library"))
	<? } 
	   if(listFind($_SESSION["module_auth"],23,",") || $_SESSION["issuperadmin"]==1){ ?>
		  	insDoc(aux3, gLnk("&nbsp;Banner", "filemgr/index.php?FLMINS=6","images/files.gif","main","Banner Library"))
	<? }
	   if(listFind($_SESSION["module_auth"],24,",") || $_SESSION["issuperadmin"]==1){ ?>		
	aux5 = insFld(navTree, gFld("&nbsp;Add-On Module", "addon/","images/templates.gif","main","Add on Modules"))
	<?
		$straddon = "select * from taddonmodule where addon_status = 1";
		$mega_db2->query($straddon);
		while ($mega_db2->next()) {
		?>
					insDoc(aux5, gLnk("<?=trim($mega_db2->row("addon_name"))?>", "<?=trim($mega_db2->row("addon_adminurl"))?>","images/comps.gif","main","<?=trim($mega_db2->row("addon_name"))?>"))
			<? }
	} 
	if(listFind($_SESSION["module_auth"],25,",") || $_SESSION["issuperadmin"]==1){
	?>
	 insDoc(navTree, gLnk("&nbsp;Banner Manager", "banner/","images/embeds.gif","main","Banner Manager"))
	 <? } ?>  
</SCRIPT>
</head>
<body topmargin="16" leftmargin="16" marginheight=16" marginwidth="16" bgcolor="#FFFFFF">
<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center"><img src="images/19.jpg" width="180" height="15"></td>
    </tr>
    <tr>
      <td align="right"><img src="images/25.jpg" width=15 height=49></td>
      <td><table width="154" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><b>&nbsp;&nbsp;Welcome : <font color="#3333FF"><?=$admin->row("username")?></font></b></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><a href="login.php?err=4&seed=<?=md5(date('m/d/y,h:m:s'));?>" target="_parent"><img src="images/logout.jpg"></a></td>
        </tr>
      </table></td>
      <td><img src="images/27.jpg" width=15 height=49></td>
    </tr>
    
    <tr>
      <td colspan="3" align="center"><img src="images/30.jpg" width="180" height=9></td>
    </tr>
  </table>
</center><br />
<script>initializeDocument()</script>
</body>
</html>