<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Insert Image/Embedded Objects</title>
</head>

<frameset rows="*,80,45" border="8" frameborder="1" framespacing="0">
	<frameset cols="55%,45%">
		<frame name="preview" src="about:blank">
		<frame name="imgbrowser" target="preview" src="ns_imgbrowser.php">
	</frameset>
	<frame name="properties" noresize target="contents" src="ns_imgprop.php?formfield=<?=$formfield?>">
	<frame name="insertframe" scrolling="no" noresize target="contents" src="ns_insertframe.php?formfield=<?=$formfield?>&OP=IMG">
	<noframes><body><p>This page uses frames, but your browser doesn't support them.</p></body></noframes>
</frameset>

</html>
