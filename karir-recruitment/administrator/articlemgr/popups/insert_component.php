<?
require_once("../../config.inc.php");
?>
<html>

<head>
  <title>Insert Cmponent</title>

<script type="text/javascript" src="popup.js"></script>

<script type="text/javascript">

window.resizeTo(400, 100);

function Init() {
  __dlg_init();
  var param = window.dialogArguments;
  if (param) {
      document.getElementById("f_alt").value = param["f_alt"];
  }
  document.getElementById("f_alt").focus();
};

function onOK() {
  var required = {
    "f_alt": "You must enter the Function Name"
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
  var fields = ["f_alt"];
  var param = new Object();
  for (var i in fields) {
    var id = fields[i];
    var el = document.getElementById(id);
    param[id] = "[" + el.value + "()]";
	//alert(i + "|" + param[id]);
  }
  //alert(param["f_alt"]);
  __dlg_close(param);
  return false;
};

function onCancel() {
  __dlg_close(null);
  return false;
};

function onPreview() {
  var f_url = document.getElementById("f_url");
  var url = f_url.value;
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

<body onload="Init()" style="background-color:buttonface;border:0;overflow:hidden" scroll="no">

<div class="title">Insert Component</div>
<!--- new stuff --->
<form action="" method="get">
<table border="0" width="100%" style="padding: 0px; margin: 0px">
  <tbody>
  <tr>
    <td style="width: 15em; text-align: right">Component Name:</td>
    <td>
	<select name="alt" id="f_alt">
	<option value="articleDate">Article Date</option>
	<option value="articleTitle">Article Title</option>
	<option value="articleSummary">Article Summary</option><br>
	<option value="articleContent">Article Content</option>
	</select>
	
  </tr>

  </tbody>
</table>
<br clear="all" />
<table width="100%" style="margin-bottom: 0.2em">
 <tr>
  
  <td valign="bottom" style="text-align: right">
    <button type="button" name="ok" onclick="return onOK();">OK</button>
    <button type="button" name="cancel" onclick="return onCancel();">Cancel</button>
  </td>
 </tr>
</table>
</form>
</body>
</html>
