<cfheader name="Expires" value="0">
<html>
<head><title>Hyperlink Properties</title>
<meta http-equiv="Expires" content="0">
<style>
  body, .button, fieldset, td {background: buttonface;font-family:verdana,helvetica;font-size:8pt;margin:2px;}
	select {font-family:verdana,helvetica;font-size:8pt;margin:2px;border:1px inset;margin:2px;}
	.itext {font-family:verdana,helvetica;font-size:8pt;margin:2px;border:1px inset;}
	.ibutton {font-family:verdana,helvetica;font-size:8pt;margin:2px;border:1px outset;}
	.a_normal {cursor:hand;text-decoration:none;color:0000FF}
	.a_hover {cursor:hand;text-decoration:underline;color:0000FF}
</style>
<script>
	function setSelection(el,val) {
	  if (el.options[el.selectedIndex] != val)
	    for(var x=0;x<el.options.length;x++) 
	      if (el.options[x].value == val) {
	        el.selectedIndex = x;
	        break;
	      }
	}
</script>

<script language="JScript" for="window" event="onload">
	var I = 1;
  for ( elem in window.dialogArguments ) {
    switch( elem ) {
    case "href":
      iurl.value = window.dialogArguments["href"];
      break;
    case "name":
      iname.value = window.dialogArguments["name"];
      break;
    case "protocol":
      setSelection(itype,window.dialogArguments["protocol"]);
      break;
    case "target":
      setSelection(itarget,window.dialogArguments["target"]);
      break;  
    case "style":
      istyle.value = window.dialogArguments["style"];
      break;  
    case "class":
      iclass.value = window.dialogArguments["class"];
      break;  
    case "title":
      ititle.value = window.dialogArguments["title"];
      break;  
    case "onclick":
      ionclick.value = window.dialogArguments["onclick"];
      break;  
    case "onmout":
      ionmout.value = window.dialogArguments["onmout"];
      break;  
    case "onmover":
      ionmover.value = window.dialogArguments["onmover"];
      break;  
    }
  }
</script>

<script language="JScript" for="type" event="onchange">
  url.value = this.options[this.selectedIndex].value;
</script>

<script language="JScript" for="OK" event="onclick">
  var arr = new Array();
	arr["url"] = iurl.value;
	arr["name"] = iname.value;
	arr["target"] = (itarget.value == "" ? "_self" : itarget.value);
	arr["style"] = istyle.value;
	arr["title"] = ititle.value;
	arr["class"] = iclass.value;
	arr["onclick"] = ionclick.value;
	arr["onmout"] = ionmout.value;
	arr["onmover"] = ionmover.value;
	window.returnValue = arr;
	window.close();
</script>
</head>

<body scroll="no" style="margin:2px">
<fieldset style="font-family:verdana,helvetica;font-size:8pt;height:150px;width:386px">
<legend>Hyperlink Properties</legend>
<div id="normallink" style="border:1px inset;overflow:auto;height:183px; margin:2px">
<table>
<tr><td>
<table cellpadding="0" cellspacing="2" border="0">
<tr>
  <td>Type</td>
  <td nowrap><select name="itype"><option value="http://">http:</option><option value="https://">https:</option><option value="mailto:">mailto:</option><option value="ftp://">ftp:</option><option value="news:">news:</option><option value="telnet://">telnet:</option></select></td>  
</tr>
<tr>
  <td>Name</td>
  <td nowrap><input name="iname" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
<tr>
  <td>URL</td>
  <td nowrap><input name="iurl" type="text" class="itext" size="35" maxlength="255" value="http://"></td>  
</tr>
<tr>
  <td>Title</td>
  <td nowrap><input name="ititle" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
<tr>
  <td>Target</td>
  <td nowrap><select name="itarget"><option></option><option value="_self" selected>_self</option><option value="_blank">_blank</option><option value="_parent">_parent</option><option value="_top">_top</option></select></td>  
</tr>
<tr>
  <td>Class</td>
  <td nowrap><input name="iclass" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
<tr>
  <td>Style</td>
  <td nowrap><input name="istyle" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
<tr>
  <td>On Click</td>
  <td nowrap><input name="ionclick" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
<tr>
  <td>On Mouse Over</td>
  <td nowrap><input name="ionmover" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
<tr>
  <td>On Mouse Out</td>
  <td nowrap><input name="ionmout" type="text" class="itext" size="35" maxlength="255" value=""></td>  
</tr>
</table>
</td>
</tr>
</table>
</div>
</fieldset>
<fieldset>
<table cellpadding="2" cellspacing="0" border="0">
	<tr><td nowrap><input id="OK" type="button" class="ibutton" value="     Ok     "> <input type="button" class="ibutton" value="  Cancel  " onclick="window.close();"></td></tr>
</table>
</fieldset>
</body>
</html>
