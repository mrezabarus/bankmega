<?
require_once("../../config.inc.php");
?>
<html>
<head>
<title><?=$CMS_VARS["admin_title"]?> -  Template Editor</title>

<?
/*
for($i=1;$i<=255;$i++){
	echo "i = " . $i . " " . chr($i) . "<BR>";
}
die();
*/

if(isset($_GET["finish"])){
	$content = str_replace("\'","'",$_POST["ta"]);
	$content = str_replace('\"',"'",$content);
	$content = str_replace(chr(92),"",$content);
	$content = str_replace($CMS_VARS["www_img_url"],'[%www_img_url%]',$content);
	//echo $content;die();
	echo "<script>opener.document.".trim($_GET["function"]).".value=\"". jsFormat($content)."\";window.close();</script>";
	die();
}
if(isset($_GET["pgid"]) && isset($_GET["auid"])){
		//echo "select * from tarticle where article_uid=".trim($_GET["auid"]);die();
		$strSQL = "select * from tarticle where article_uid=".trim($_GET["auid"]);
		$riau_db->query($strSQL);
		$riau_db->next();
		if(trim($_GET["field"])=="ISUMMARY"){
			$content = $riau_db->row("isummary");
		}else{
			$content = $riau_db->row("icontent");
		}
		
		$content = str_replace('[%www_img_url%]',$CMS_VARS["www_img_url"],$content);
		$function = "frmAdd." . $_GET["field"];
	
}else{
	$content = "";
	$function = "frmAdd." . $_GET["field"];
}
//echo $content;die();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
  _editor_url = "../";
  _editor_lang = "en";
</script>
<script type="text/javascript" src="../htmlarea.js"></script>
<!-- load the plugins -->
<script type="text/javascript">

      HTMLArea.loadPlugin("TableOperations");
      HTMLArea.loadPlugin("SpellChecker");
      HTMLArea.loadPlugin("FullPage");
      HTMLArea.loadPlugin("CSS");
      HTMLArea.loadPlugin("ContextMenu");
</script>

<style type="text/css">
html, body {
  font-family: Verdana,sans-serif;
  background-color: #fea;
  color: #000;
}
a:link, a:visited { color: #00f; }
a:hover { color: #048; }
a:active { color: #f00; }

textarea { background-color: #fff; border: 1px solid 00f; }
</style>

<script type="text/javascript">
var editor = null;
function initEditor() {

  // create an editor for the "ta" textbox
  editor = new HTMLArea("ta");

  // register the FullPage plugin
  editor.registerPlugin(FullPage);

  // register the SpellChecker plugin
  editor.registerPlugin(TableOperations);

  // register the SpellChecker plugin
  editor.registerPlugin(SpellChecker);

  // register the CSS plugin
  editor.registerPlugin(CSS, {
    combos : [
      { label: "Syntax:",
                   // menu text       // CSS class
        options: { "None"           : "",
                   "Code" : "code",
                   "String" : "string",
                   "Comment" : "comment",
                   "Variable name" : "variable-name",
                   "Type" : "type",
                   "Reference" : "reference",
                   "Preprocessor" : "preprocessor",
                   "Keyword" : "keyword",
                   "Function name" : "function-name",
                   "Html tag" : "html-tag",
                   "Html italic" : "html-helper-italic",
                   "Warning" : "warning",
                   "Html bold" : "html-helper-bold"
                 },
        context: "pre"
      },
      { label: "Info:",
        options: { "None"           : "",
                   "Quote"          : "quote",
                   "Highlight"      : "highlight",
                   "Deprecated"     : "deprecated"
                 }
      }
    ]
  });

  // add a contextual menu
  editor.registerPlugin("ContextMenu");

  // load the stylesheet used by our CSS plugin configuration
  editor.config.pageStyle = "@import url(custom.css);";

  setTimeout(function() {
    editor.generate();
  }, 500);
  return false;
}

function insertHTML() {
  var html = prompt("Enter some HTML code here");
  if (html) {
    editor.insertHTML(html);
  }
}
function highlight() {
  editor.surroundHTML('<span style="background-color: white">', '</span>');
}
</script>

</head>
<script>
function mySubmit() {
	document.edit.onsubmit();
	document.edit.submit();
};
</script>
<!-- use <body onload="HTMLArea.replaceAll()" if you don't care about
     customizing the editor.  It's the easiest way! :) -->
<body leftmargin="0" topmargin="0" onload="initEditor()" style="background-color:buttonface;border:0;overflow:hidden" scroll="no">
<form action="editor.php?function=<?=$function?>&finish=yes" method="post" id="edit" name="edit">
<textarea id="ta" name="ta" style="width:100%" rows="35" cols="100%"><?=htmlentities($content)?></textarea>
<input type="button" value="Finish" name="B3" style="background-color: #C0C0C0; font-family: Arial; font-size: 10pt; border: 1 solid #000000" onclick="mySubmit();">
<input type="button" value="Close" name="B3" style="background-color: #C0C0C0; font-family: Arial; font-size: 10pt; border: 1 solid #000000" onclick="window.close()">

</form>

</body>
</html>
<script>
	window.moveTo((screen.width-800)/2,(screen.height-580)/2)
	window.focus();
</script>
