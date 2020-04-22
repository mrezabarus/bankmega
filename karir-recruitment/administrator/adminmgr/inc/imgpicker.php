<?
	require ("../config.php");
	if (!isset($instance)) $instance = "1";
?>

<html>
<head>
	<title>Insert Image/Embedded Object</title>
	<style>
	  body, .button, fieldset{background: buttonface;font-family:"verdana";font-size:8pt;margin:2px;}
		td {font-family:"verdana";font-size:8pt;}
		a {text-decoration:none;color:black}
		a:hover {text-decoration:underline}
		.a_normal {cursor:hand;text-decoration:none;color:black}
		.a_selected {cursor:default;color:000000;font-weight:bold}
		.a_hover {cursor:hand;text-decoration:underline;color:black}
		select {font-family:verdana,helvetica;font-size:8pt;margin:2px;border:1px inset;margin:2px;}
		.itext {font-family:verdana,helvetica;font-size:8pt;margin:2px;border:1px inset;}
		.ibutton {font-family:verdana,helvetica;font-size:8pt;margin:2px;border:1px outset;}
	</style>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	function LoadingImgBrowser(obj) {
			obj.document.clear();
			obj.document.write("<table width=100% height=80%><tr><td align=center valign=middle>");
			obj.document.write("<font face=arial size=2>Loading List of File(s)...</font>");
			obj.document.write("</td></tr></table>");
			obj.document.close();
		}
  //-->
  </SCRIPT>
	<script language="JScript" for="OK" event="onclick">
		if (deleteSpaces(iURL.value) !="") {
		  window.returnValue = iURL.value;
		  window.close();
		} else alert("Missing or invalid required field!");
	</script>
	<script language="JScript" defer>
		var DocState = 1;
		
		function SetState(frm) {
			if (DocState==1) DocState=2;
			else DocState=1;
			switch (DocState) {
				case 1 :
					state_1.style.visibility = "";
					state_1.style.display = "";
					state_2.style.visibility = "hidden";
					state_2.style.display = "none";
					frm.iBUTTON.value = "File Manager";
					frm.OK.disabled = false;
					break;
				case 2 :
					state_2.style.visibility = "";
					state_2.style.display = "";
					state_1.style.visibility = "hidden";
					state_1.style.display = "none";
					frm.iBUTTON.value = "Back";
					frm.OK.disabled = true;
					break;
				default :
					break;
			}
		}
		function deleteSpaces(str) {
			var A = new Array();
			A = str.split("\n");
			str = A.join("");
			A = str.split(" ");	
			str = A.join("");
			A = str.split("\t");
			str = A.join("");
		
			return str;
		}
		function deleteDBLQuotes(str) {
			var A = new Array();
			A = str.split("\"");
			str = A.join("");
			return str;
		}
		function CheckFileExt(w) {
			var fExt = w.split(".");
			if (fExt.length==0) return '';
			else return fExt[fExt.length - 1].toLowerCase();
		}
	  function isInt() {
	    return ((event.keyCode >= 48) && (event.keyCode <= 57))
	  }
	  function setSelection(el,val){
	    if (el.options[el.selectedIndex] != val){
	      for(var x=0;x<el.options.length;x++){
	        if (el.options[x].value == val){
	          el.selectedIndex = x;
	          break;
	        }
	      }
	    }
	  } 
	</script>
</head>

<body scroll="no" style="border:0px">
<form name="frmImgBrowser">
<fieldset style="font-family:verdana,helvetica;font-size:8pt;width:531px;height:231px;">
<div id="state_1" style="border:1px inset;margin:2px;width:523px;height:228px;overflow-x:hidden;overflow-y:hide">
	<table cellpadding="0" cellspacing="2" border="0" style="margin:3px">
		<tr>
			<td colspan="2">
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td valign="top"><fieldset><legend>Preview</legend>
							<iframe name="imgPreview" style="margin:4px;width:160px;height:160px;" src=""></iframe>
						</fieldset></td>
						<td valign="top"><fieldset style="margin:3px"><legend>Image/Embedded Object Browser</legend>
							<iframe name="imgBrowser" style="margin:4px;width:317px;height:160px;" src="imgbrowser.php?SEED=<?=urlencode(date("mdYhis"))?>"></iframe>
						</fieldset></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="1" border="0">
					<tr>
						<td>URL&nbsp;&nbsp;</td>
						<td><input name="iURL" type="text" class="itext" style="width:474px" value=""></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div id="state_2" style="visbility:hidden;display:none;width:300px;height:232px;">
	<iframe name="imgBrowser" style="margin:4px;width:519px;height:224px;" src="_imgmng/index.php"></iframe>
</div>
</fieldset>
<fieldset style="width:531px;">
	<table width="100%">
		<tr>
			<td><input id="OK" type="button" class="ibutton" value="    Ok    "> <input name="iCANCEL" type="button" class="ibutton" value=" Cancel " onclick="window.close();"></td>
			<td align="right"><?if ($allow_img_upload||$allow_img_delete||$allow_img_mkdir||$allow_img_rmdir) {?><input id="iBUTTON" type="button" class="ibutton" value="File Manager" style="width:140px" onclick="SetState(this.form);"><?}?></td>
		</tr>
	</table>
</fieldset>
</form>
</body>
</html>