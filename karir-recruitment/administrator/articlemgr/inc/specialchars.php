<?
	if (!isset($instance)) $instance = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Special Characters</title>
	<style type="text/css">
		body {margin:0px;}
		.regular {font-family:verdana,helvetica; font-size:8pt;cursor:hand}
		.hover {font-family:verdana,helvetica; font-size:8pt; border:solid 1px; border-color:#000000; cursor:hand}
		input { border-style:solid; border-width:1; border-color:#000000; font-size:8pt; font-family:verdana,helvetica}
	</style>
	<script language="JavaScript">
		function insertChar(code) {
			eval(parent).insertHTML(code,<?=$instance?>);	
		}
	</script>
	<script>
		document.oncontextmenu = function(){return false}
		if(document.layers) {
		    window.captureEvents(Event.MOUSEDOWN);
		    window.onmousedown = function(e){
		        if(e.target==document)return false;
		    }
		}
		else {
		    document.onmousedown = function(){return false}
		}
	</script>
</head>

<body bgcolor="buttonface" scroll="no" style="border:outset 2px">
<table cellpadding="0" border="0" cellpadding="0" width="100%">
	<tr>
		<td>
<table border="0" cellspacing="0" cellpadding="2" width="100%" align="center">
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&quot; ');" align="center">&quot;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&amp; ');" align="center">&amp;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('<SUP><FONT SIZE=-1>TM</FONT></SUP> ');" align="center"><SUP><FONT style="font-size:9px">TM</FONT></td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&lt; ');" align="center">&lt;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&gt; ');" align="center">&gt;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&nbsp;')" align="center"><i>_</i></td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&iexcl; ')" align="center">&iexcl;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&cent; ')" align="center">&cent;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&pound; ')" align="center">&pound;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&curren; ')" align="center">&curren;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&yen; ')" align="center">&yen;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&brvbar; ')" align="center">&brvbar;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&sect; ')" align="center">&sect;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&uml; ')" align="center">&uml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&copy; ')" align="center">&copy;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ordf; ')" align="center">&ordf;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&laquo; ')" align="center">&laquo;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&not; ')" align="center">&not;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&shy; ')" align="center">&shy;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&reg; ')" align="center">&reg;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&macr; ')" align="center">&macr;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&deg; ')" align="center">&deg;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&plusmn; ')" align="center">&plusmn;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&sup2; ')" align="center">&sup2;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&sup3; ')" align="center">&sup3;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&acute; ')" align="center">&acute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&micro; ')" align="center">&micro;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&para; ')" align="center">&para;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&middot; ')" align="center">&middot;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&cedil; ')" align="center">&cedil;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&sup1; ')" align="center">&sup1;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ordm; ')" align="center">&ordm;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&raquo; ')" align="center">&raquo;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&frac14; ')" align="center">&frac14;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&frac12; ')" align="center">&frac12;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&frac34; ')" align="center">&frac34;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&iquest; ')" align="center">&iquest;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Agrave; ')" align="center">&Agrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Aacute; ')" align="center">&Aacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Acirc; ')" align="center">&Acirc;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Atilde; ')" align="center">&Atilde;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Auml; ')" align="center">&Auml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Aring; ')" align="center">&Aring;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&AElig; ')" align="center">&AElig;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Ccedil; ')" align="center">&Ccedil;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Egrave; ')" align="center">&Egrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Eacute; ')" align="center">&Eacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Ecirc; ')" align="center">&Ecirc;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Euml; ')" align="center">&Euml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Igrave; ')" align="center">&Igrave;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Iacute; ')" align="center">&Iacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Icirc; ')" align="center">&Icirc;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Iuml; ')" align="center">&Iuml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ETH; ')" align="center">&ETH;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Ntilde; ')" align="center">&Ntilde;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Ograve; ')" align="center">&Ograve;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Oacute; ')" align="center">&Oacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Ouml; ')" align="center">&Ouml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&times; ')" align="center">&times;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Oslash; ')" align="center">&Oslash;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Ugrave; ')" align="center">&Ugrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Uacute; ')" align="center">&Uacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Uuml; ')" align="center">&Uuml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Yacute; ')" align="center">&Yacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&THORN; ')" align="center">&THORN;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&szlig; ')" align="center">&szlig;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&agrave; ')" align="center">&agrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&aacute; ')" align="center">&aacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&acirc; ')" align="center">&aacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&atilde; ')" align="center">&atilde;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&auml; ')" align="center">&auml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&aring; ')" align="center">&aring;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&aelig; ')" align="center">&aelig;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ccedil; ')" align="center">&ccedil;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&egrave; ')" align="center">&egrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&Oslash; ')" align="center">&Oslash;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&egrave; ')" align="center">&egrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&eacute; ')" align="center">&eacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ecirc; ')" align="center">&ecirc;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&euml; ')" align="center">&Yacute;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&euro; ')" align="center">&euro;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&igrave; ')" align="center">&igrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&iacute; ')" align="center">&iacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&icirc; ')" align="center">&icirc;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&iuml; ')" align="center">&iuml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&eth; ')" align="center">&eth;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ntilde; ')" align="center">&ntilde;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ograve; ')" align="center">&Ntilde;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&oacute; ')" align="center">&oacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ocirc; ')" align="center">&ocirc;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&otilde; ')" align="center">&otilde;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ouml; ')" align="center">&ouml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&divide; ')" align="center">&divide;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&oslash; ')" align="center">&oslash;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ugrave; ')" align="center">&ugrave;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&uacute; ')" align="center">&Uuml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&yacute; ')" align="center">&yacute;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&thorn; ')" align="center">&thorn;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&yuml; ')" align="center">&yuml;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ndash; ')" align="center">&ndash;</td>
	</tr>
	<tr>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&mdash; ')" align="center">&mdash;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&lsquo; ')" align="center">&lsquo;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&rsquo; ')" align="center">&rsquo;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&ldquo; ')" align="center">&ldquo;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('&rdquo; ')" align="center">&rdquo;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('');" align="center">&nbsp;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('');" align="center">&nbsp;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('');" align="center">&nbsp;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('');" align="center">&nbsp;</td>
		<td class="regular" width="10%" height="25" valign="middle" onclick="insertChar('');" align="center">&nbsp;</td>
	</tr>
</table>
		</td>
	</tr>
</table>		 
</body>
</html>
