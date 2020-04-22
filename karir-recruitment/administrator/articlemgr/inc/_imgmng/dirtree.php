<?
	require("_config.php");
	require("_lib.php");
	$imgpath = "../images/";
	
	function DirTree($path, $currpath, $openedpath, $selpath, $depth) {
		global $imgpath;
		if (strcmp($path,"")==0) echo "<table cellpadding=\"0\" cellspacing=\"0\">";
		if (strcmp($path,"")==0) {
			$folderimg = strcmp($currpath,$selpath)==0?"folderopen.gif":"folderclosed.gif";
			$selbgcolor = strcmp($currpath,$selpath)==0?" style=\"background-color:#000080\" ":"";
			$selfontcolor = strcmp($currpath,$selpath)==0?" color=#FFFFFF ":" color=#000000 ";
			echo "<tr><td>";
			echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td><img src=\"".$imgpath."_mnode.gif\" border=0></td><td><a title=\"".htmlentities(stripslashes(RemoveRootPath($currpath)))."\" href=\"dirtree.php?op=".rawurlencode(RemoveRootPath($openedpath))."&sp=".rawurlencode(RemoveRootPath($currpath))."\"><img src=\"".$imgpath."$folderimg\" border=0></a></td><td nowrap><a href=\"dirtree.php?op=".rawurlencode(RemoveRootPath($openedpath))."&sp=".rawurlencode(RemoveRootPath($currpath))."\"><font face=verdana style=\"font-size:8pt\" $selfontcolor $selbgcolor><b>Root Path</b></font></a></td></tr></table>";
			echo "</td></tr>";
			$haschild = DirHasChild($currpath);
			if ($haschild) DirTree($currpath, $currpath, $openedpath, $selpath, $depth+1);
		} else {
			$handler = dir($currpath);
			while (false !== ($entry = $handler->read())) {
				$pathadded = $currpath.$entry."/";
				if (@is_dir($pathadded) && !(strcmp(trim($entry),".")==0 || strcmp(trim($entry),"..")==0)) {
					echo "<tr><td><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>";
					$haschild = DirHasChild($pathadded);
					$inpath = IsInPath($pathadded,$openedpath);
					$folderimg = strcmp($pathadded,$selpath)==0?"folderopen.gif":"folderclosed.gif";
					$selbgcolor = strcmp($pathadded,$selpath)==0?" style=\"background-color:#000080\" ":"";
					$selfontcolor = strcmp($pathadded,$selpath)==0?" color=#FFFFFF ":" color=#000000 ";
					echo str_repeat("<td><img src=\"".$imgpath."blank.gif\" border=0></td>",$depth);
					if ($inpath && $haschild)
						echo "<td><a href=\"dirtree.php?op=".rawurlencode(RemoveRootPath($currpath))."&sp=".rawurlencode(RemoveRootPath($selpath))."\" title=\"Click to collapse!\"><img src=\"".$imgpath."_mnode.gif\" border=0></a></td>";
					else if ($haschild)
						echo "<td><a href=\"dirtree.php?op=".rawurlencode(RemoveRootPath($pathadded))."&sp=".rawurlencode(RemoveRootPath($selpath))."\" title=\"Click to expand!\"><img src=\"".$imgpath."_pnode.gif\" border=0></a></td>";
					else
						echo "<td><img src=\"".$imgpath."blank.gif\" border=0></td>";
					echo "<td><a title=\"".htmlentities(stripslashes(RemoveRootPath($entry)))."\" href=\"dirtree.php?op=".rawurlencode(RemoveRootPath($openedpath))."&sp=".rawurlencode(RemoveRootPath($pathadded))."\"><img src=\"".$imgpath."$folderimg\" border=0></a></td><td nowrap><a title=\"".htmlentities(stripslashes(RemoveRootPath($entry)))."\" href=\"dirtree.php?op=".rawurlencode(RemoveRootPath($openedpath))."&sp=".rawurlencode(RemoveRootPath($pathadded))."\"><font face=verdana style=\"font-size:8pt\" $selfontcolor $selbgcolor>".stripslashes($entry)."</font></a></td>";
					echo "</tr></table></td></tr>";
					if ($haschild && $inpath) DirTree($entry, $pathadded, $openedpath, $selpath, $depth+1);
				}
			}
			@clearstatcache();
			$handler->close();
		}
		if (strcmp($path,"")==0) echo "</table>";
	}
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>devCMS | File Manager | Directory Tree</title>
<style>
	a {font-family:verdana,helvetica;font-size:8pt;text-decoration:none}
	a:hover {text-decoration:underline;}
</style>
</head>

<body>
<?
	$selpath = "";
	if (isset($sp)) {
		if (strcmp(trim($sp),"")!=0) $selpath = stripslashes($sp);
	}
	if (IsInPath($RootPath,$RootPath.$selpath)) {
?>
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
    <!--
			parent.fm_filelist.document.clear();
			parent.fm_filelist.document.write("<table width=100% height=80%><tr><td align=center valign=middle>");
			parent.fm_filelist.document.write("<font face=arial size=2>Loading List of File(s)...</font>");
			parent.fm_filelist.document.write("</td></tr></table>");
			parent.fm_filelist.document.close();
    	parent.fm_filelist.location = "filelist.php?path=<?=rawurlencode($selpath)."&SEED=".rawurlencode(date("mdYhis"))?>";
    //-->
    </SCRIPT>
<?
	}
	if (isset($op)) DirTree("",$RootPath,stripslashes($RootPath.$op),$RootPath.$selpath,0);
	else DirTree("",$RootPath,stripslashes($RootPath),$RootPath.$selpath,0);
?>
</body>
</html>
