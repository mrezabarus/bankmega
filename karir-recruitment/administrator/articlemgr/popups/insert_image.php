<?
require_once("../../config.inc.php");
?>
<html>

<head>
  <title>Insert Image</title>

<script type="text/javascript" src="popup.js"></script>

<script type="text/javascript">

window.resizeTo(400, 100);

function Init() {
  __dlg_init();
  var param = window.dialogArguments;
  if (param) {
      document.getElementById("f_url").value = param["f_url"];
      document.getElementById("f_alt").value = param["f_alt"];
      document.getElementById("f_border").value = param["f_border"];
      document.getElementById("f_align").value = param["f_align"];
      document.getElementById("f_vert").value = param["f_vert"];
      document.getElementById("f_horiz").value = param["f_horiz"];
      window.ipreview.location.replace(param.f_url);
  }
  document.getElementById("f_url").focus();
};

function onOK() {
  var required = {
    "f_url": "You must enter the URL"
  };
  for (var i in required) {
    var el = document.getElementById(i);
    if (!el.value) {
      alert(required[i]);
      el.focus();
      return false;
    }
  }
  // pass data back to the calling window
  var fields = ["f_url", "f_alt", "f_align", "f_border",
                "f_horiz", "f_vert"];
  var param = new Object();
  for (var i in fields) {
  	var id = fields[i];
    var el = document.getElementById(id);
	if(i==0){
		param[id] = "<?=$CMS_VARS["www_userimg_url"]?>" + el.value;
	}else{
    	param[id] = el.value;
	}
	//alert(param[id]);
  }
  __dlg_close(param);
  return false;
};

function onCancel() {
  __dlg_close(null);
  return false;
};

function onPreview() {
  var f_url = document.getElementById("f_url");
  var url = "<?=$CMS_VARS["www_userimg_url"]?>" + f_url.value;
  if (!url) {
    alert("You have to enter an URL first");
    f_url.focus();
    return false;
  }
  window.ipreview.location.replace(url);
  return false;
};
</script>

<style type="text/css">
html, body {
  background: ButtonFace;
  color: ButtonText;
  font: 11px Tahoma,Verdana,sans-serif;
  margin: 0px;
  padding: 0px;
}
body { padding: 5px; }
table {
  font: 11px Tahoma,Verdana,sans-serif;
}
form p {
  margin-top: 5px;
  margin-bottom: 5px;
}
.fl { width: 9em; float: left; padding: 2px 5px; text-align: right; }
.fr { width: 6em; float: left; padding: 2px 5px; text-align: right; }
fieldset { padding: 0px 10px 5px 5px; }
select, input, button { font: 11px Tahoma,Verdana,sans-serif; }
button { width: 70px; }
.space { padding: 2px; }

.title { background: #ddf; color: #000; font-weight: bold; font-size: 120%; padding: 3px 10px; margin-bottom: 10px;
border-bottom: 1px solid black; letter-spacing: 2px;
}
form { padding: 0px; margin: 0px; }
</style>

</head>

<body onLoad="Init()" style="background-color:buttonface;border:0;overflow:hidden" scroll="no">
<form action="" method="get">
<!--- new stuff --->
<table border="0" width="100%" style="padding: 0px; margin: 0px">
  <tbody>

  <tr>
    <td style="width: 7em; text-align: right">Image URL:</td>
    <td>
	<SELECT name="URL" id="f_url" style="width:55%" onChange="return onPreview();">
		<option value="o">Select Image</option>
		<?
		$d = dir($CMS_VARS["www_userimg_path"]); 
		while (false !== ($entry = $d->read())) { 
			if($entry <> "." && $entry <> ".."){
				if(is_dir($CMS_VARS["www_userimg_path"].$entry)){
					$d2 = dir($CMS_VARS["www_userimg_path"].$entry);
					while (false !== ($entry2 = $d2->read())) { 
						if($entry2 <> "." && $entry2 <> ".."){
							echo "<OPTION value=\"" . $entry ."/".$entry2 ."\">" . $entry ."/".$entry2."</OPTION>";
						}
					}
					$d2->close();
					
				}else{
		   			echo "<OPTION value=\"".$entry."\">".$entry."</OPTION>";
				}
		    }
		} 
		$d->close(); 
		?>
	</SELECT>
	<!--- <input type="text" name="url" id="f_url" style="width:75%" title="Enter the image URL here" /> --->
      
    </td>
  </tr>
  <tr>
    <td style="width: 7em; text-align: right">Alternate text:</td>
    <td><input type="text" name="alt" id="f_alt" style="width:100%"
      title="For browsers that don't support images" /></td>
  </tr>

  </tbody>
</table>

<p />

<fieldset style="float: left; margin-left: 5px;">
<legend>Layout</legend>

<div class="space"></div>

<div class="fl">Alignment:</div>
<select size="1" name="align" id="f_align"
  title="Positioning of this image">
  <option value=""                             >Not set</option>
  <option value="left"                         >Left</option>
  <option value="right"                        >Right</option>
  <option value="texttop"                      >Texttop</option>
  <option value="absmiddle"                    >Absmiddle</option>
  <option value="baseline" selected="1"        >Baseline</option>
  <option value="absbottom"                    >Absbottom</option>
  <option value="bottom"                       >Bottom</option>
  <option value="middle"                       >Middle</option>
  <option value="top"                          >Top</option>
</select>

<p />

<div class="fl">Border thickness:</div>
<input type="text" name="border" id="f_border" size="5"
title="Leave empty for no border" />

<div class="space"></div>

</fieldset>

<fieldset style="float:right; margin-right: 5px;">
<legend>Spacing</legend>

<div class="space"></div>

<div class="fr">Horizontal:</div>
<input type="text" name="horiz" id="f_horiz" size="5"
title="Horizontal padding" />

<p />

<div class="fr">Vertical:</div>
<input type="text" name="vert" id="f_vert" size="5"
title="Vertical padding" />

<div class="space"></div>

</fieldset>
<br clear="all" />
<table width="100%" style="margin-bottom: 0.2em">
 <tr>
  <td valign="bottom">
    Image Preview:<br />
    <iframe name="ipreview" id="ipreview" frameborder="0" style="border : 1px solid gray;" height="180" width="370" src=""></iframe>
	<BR><center><button type="button" name="ok" onClick="return onOK();">OK</button>&nbsp;
<button type="button" name="cancel" onClick="return onCancel();">Cancel</button></center>
  </td>
  <td valign="bottom" style="text-align: right">
    
  </td>
 </tr>
</table>
</form>
</body>
</html>
