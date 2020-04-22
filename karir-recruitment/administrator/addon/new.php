<html>
<head>
<title>New Addon Module</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<link href="../css/tiny_mce.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen",
	theme_advanced_buttons1_add_before : "save,newdocument,separator",
	theme_advanced_buttons1_add_before : "forecolor,backcolor",
	//theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,fontselect,fontsizeselect",
	theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
	theme_advanced_buttons3_add_before : "tablecontrols,separator",
	//theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	content_css : "example_word.css",
	plugi2n_insertdate_dateFormat : "%Y-%m-%d",
	plugi2n_insertdate_timeFormat : "%H:%M:%S",
//		external_link_list_url : "example_link_list.js",
//		external_image_list_url : "example_image_list.js",
//		media_external_list_url : "example_media_list.js",
	file_browser_callback : "fileBrowserCallBack",
	paste_use_dialog : false,
	theme_advanced_resizing : true,
	theme_advanced_resize_horizontal : false,
	theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
	paste_auto_cleanup_on_paste : true,
	paste_convert_headers_to_strong : false,
	paste_strip_class_attributes : "all",
	paste_remove_spans : false,
	paste_remove_styles : false		
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
</script>
</head>
<body>
<form name="frmnew" action="qaddon.php?txtaction=new" method="post" enctype="multipart/form-data">
<table border="0" width="100%" bgcolor="#DEDEDE" cellspacing="0" cellpadding="2">
  <tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">New Addon Module</font></b></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#DEDEDE">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td>Name</td>
        <td>:</td>
        <td><input type="text" name="txtname" size="42"></td>
      </tr>
      <tr>
        <td>Description</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td colspan="3" valign="top"><textarea name="txtdesc" rows="10" cols="65"></textarea></td>
        </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>Syntax</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td colspan="3" valign="top"><textarea name="txtsyntax" rows="10" cols="65"></textarea></td>
        </tr>
	   <tr>
        <td>Script Name</td>
        <td>:</td>
        <td><input type="file" name="txtfilename" size="27"></td>
      </tr>
	 <tr>
        <td>Action Folder Name</td>
        <td>:</td>
        <td><b>/_cms/_addonlib/</b>&nbsp;<input type="text"  name="txtfoldername" size="25"></td>
      </tr>
	   <tr>
        <td>Admin URL</td>
        <td>:</td>
        <td><b>/administrator/</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="txtadminurl" size="25"></td>
      </tr>
	 
	  <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td></td>
        <td></td>
        <td><input type="submit" class="button" value="Save" name="B1">&nbsp;<input type="button" class="button" value="Cancel" name="B1" onClick="location='index.php'"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>