<? require_once("../config.inc.php"); ?>
<html>

<head>
<title>Hyperlink</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script>
	function _insert() {
		var frm = document.frmlink;
		var href = "";
			if (frm.sel_linkto.options[frm.sel_linkto.selectedIndex].value == 1) {
				if (frm.sel_temp.options[frm.sel_temp.selectedIndex].value != "" && frm.art.options[frm.art.selectedIndex].value != "")
					href = "index.php?pgid="+frm.sel_temp.options[frm.sel_temp.selectedIndex].value+","+frm.art.options[frm.art.selectedIndex].value;
				else if (frm.sel_temp.options[frm.sel_temp.selectedIndex].value != "" && frm.art.options[frm.art.selectedIndex].value == "")
					href = "index.php?pgid="+frm.sel_temp.options[frm.sel_temp.selectedIndex].value;
				else
					href = "index.php";
			} else if (frm.sel_linkto.options[frm.sel_linkto.selectedIndex].value == 2) {
				if (frm.selFile.options[frm.selFile.selectedIndex].value != "") href = frm.selFile.options[frm.selFile.selectedIndex].value;
			} else if (frm.sel_linkto.options[frm.sel_linkto.selectedIndex].value == 3)
				href = frm.urltxt.value;
		var target = frm.target.options[frm.target.selectedIndex].value !=  "" ? frm.target.options[frm.target.selectedIndex].value : frm.otarget.value;
		var txt = "<a href=\""+href+"\"";
		txt += frm.title.value != "" ? frm.title.value : "";
		txt += target != "" ? " target=\""+target+"\"" : "";
		txt += frm.style.value != "" ? " style=\""+frm.style.value+"\"" : "";
		txt += frm.onclick.value != "" ? " onclick=\""+frm.onclick.value+"\"" : "";
		txt += frm.over.value != "" ? " onmouseover=\""+frm.over.value+"\"" : "";
		txt += frm.out.value != "" ? " onmouseout=\""+frm.out.value+"\"" : "";
		txt += ">";
		parent.opener.t_<?= uriParam("frm"); ?>.surround(txt,'<\/a>');
		top.close();
	}
</script>
</head>

<?
	$riau_db->query("SELECT * FROM ttemplate");
	
	$sel_linkto = uriParam("sel_linkto",1);
	$template = uriParam("sel_temp","");
	
	$q_art = cmsDB();
	$q_art->query("SELECT * FROM tarticle WHERE template_id = '".$template."'");
?>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="#DEDEDE">

<table border="0" cellpadding="4" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmlink" action="link.php" method="get">
	<input type="Hidden" name="frm" value="<?= urlencode(uriParam("frm")); ?>">
	<input type="Hidden" name="seed" value="<?= $CMS_VARS["seed"]; ?>">
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td><b>Hyperlink</b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="0" width="100%">
				<tr>
					<td>Link To </td>
					<td>
						<select name="sel_linkto" onchange="submit()" class="select">
							<option value="1" <? if ($sel_linkto == 1) { ?>selected<? } ?>>Article
							<option value="2" <? if ($sel_linkto == 2) { ?>selected<? } ?>>File
							<option value="3" <? if ($sel_linkto == 3) { ?>selected<? } ?>>URL
						</select>
					</td>
				</tr>
				<? if ($sel_linkto == 1) { ?>
					<tr>
						<td>Template</td>
						<td>
							<select name="sel_temp" onchange="submit();" class="select">
								<option value="">Select Template
								<? while ($riau_db->next()) { ?>
									<option value="<?= $riau_db->row("template_id"); ?>" <? if ($template == $riau_db->row("template_id")) { ?>selected<? } ?>><?= $riau_db->row("display_name"); ?>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Article</td>
						<td>
							<select name="art" class="select">
								<? if ($q_art->recordCount() > 0) { ?>
									<? while ($q_art->next()) { ?>
										<option value="<?= $q_art->row("article_id"); ?>"><?= $q_art->row("article_id"); ?>
									<? } ?>
								<? } else {?>
									<option value="">Select Article
								<? } ?>
							</select>
						</td>
					</tr>
				<? } else if ($sel_linkto == 2) { ?>
					<tr>
						<td>File</td>
						<?
							require("../filemgr/_config.php");
							$d = dir($CMS_VARS["www_file_path"]);
							$url_path = $CMS_VARS["www_file_url"];
						?>
						<td>
							<select name="selFile">
								<?	while($entry=$d->read()) { ?>
									<? if ($entry != "." and $entry != "..") { ?>
										<option value="<?=$CMS_VARS["cms_url"]?>getfile.php?fn=<?=rawurlencode($entry);?>"><?=$entry;?>
									<? } ?>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
				<? } else if ($sel_linkto == 3) { ?>
					<tr>
						<td>HRef</td>
						<td><input type="Text" name="urltxt" value="http://" class="text" size="40"></td>
					</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
				<? } ?>
				<tr>
					<td colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr>
							<td>Title</td>
							<td><input type="text" value="" name="title" size="40" class="text"></td>
						</tr>
						<tr>
							<td>Target</td>
							<td>
								<select name="target" class="select"><option value=""> <option value="_blank">_blank<option value="_parent">_parent<option value="_self">_self<option value="_top">_top</select>
								Or
								<input type="Text" name="otarget" value="" class="text" size="25">
							</td>
						</tr>
						<tr>
							<td>Style</td>
							<td><input type="text" value="" name="style" size="40" class="text"></td>
						</tr>
						<tr>
							<td>OnClick</td>
							<td><input type="text" value="" name="onclick" size="40" class="text"></td>
						</tr>
						<tr>
							<td>OnMouseOver</td>
							<td><input type="text" value="" name="over" size="40" class="text"></td>
						</tr>
						<tr>
							<td>OnMouseOut</td>
							<td><input type="text" value="" name="out" size="40" class="text"></td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1" bgcolor="#000000"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
			<input type="button" class="button" value="    Insert    " name="bIns" onclick="_insert();">&nbsp;&nbsp;
			<input type="button" class="button" value="    Close    " name="bCl" onclick="self.close();">
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%" height="1"></td></tr></table></td></tr></table>
		</td>
	</tr>
	</form>
</table>

</body>

</html>