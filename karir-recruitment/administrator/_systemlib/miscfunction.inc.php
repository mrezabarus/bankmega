<?

function isEmail($str = "") {
	return preg_match("/^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$/i",$str);
}

function isDate($str = "") {
	return preg_match("/^([0-9]{1,4})[-\/]{1}([0-9]{1,4})[-\/]{1}([0-9]{1,4})$/i",$str);
}

function isDateTime($str = "") {
	return preg_match("/^([0-9]{1,4})[-\/]{1,4}([0-9]{1,4})[-\/]{1}([0-9]{1,4})[ ]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})$/i",$str);
}

function parseDate($str = "") {
	$rs[0] = 0;
	$rs[1] = 0;
	$rs[2] = 0;
	if (preg_match("/^([0-9]{1,4})[-\/]{1}([0-9]{1,4})[-\/]{1}([0-9]{1,4})$/i",$str,$d)) {
		for ($i = 1; $i < count($d); $i++) $rs[$i-1] = $d[$i];
	}
	return $rs;
}

function parseDateTime($str = "") {
	$rs[0] = 0;
	$rs[1] = 0;
	$rs[2] = 0;
	$rs[3] = 0;
	$rs[4] = 0;
	$rs[5] = 0;
	if (preg_match("/^([0-9]{1,4})[-\/]{1,4}([0-9]{1,4})[-\/]{1}([0-9]{1,4})[ ]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})[:]{1}([0-9]{1,2})$/i",$str,$d)) {
		for ($i = 1; $i < count($d); $i++) {
			$rs[$i - 1] = $d[$i];
		}
	}
	return $rs;
}

function location($url = "") {
	if ($url=="") return;
	header("Location: ".$url);
}

function jsformat($str) {
	$result = $str;
	$result = str_replace("\\","\\\\",$result); $result = str_replace("\f","\\f",$result); $result = str_replace("\b","\\b",$result); $result = str_replace("\r","\\r",$result);
	$result = str_replace("\t","\\t",$result); $result = str_replace("\'","\\'",$result); $result = str_replace("\"","\\\"",$result); $result = str_replace("\n","\\n",$result);
	return $result;
}

function disableCaching() {
//	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//	header("Last-Modified: ".gmdate("D, d M Y H:i:s",gmmktime()+3600)." GMT"); 
//	header("Cache-Control: no-store, no-cache, must-revalidate");
//	header("Cache-Control: post-check=0, pre-check=0", false);
//	header("Pragma: no-cache");
}

function timestampReformat($timestamp = "") {
	if (strlen($timestamp) < 14)
		return mktime();
	else
		return mktime(substr($timestamp,8,2),substr($timestamp,10,2),substr($timestamp,11,2),substr($timestamp,4,2),substr($timestamp,6,2),substr($timestamp,0,4));
}

function postParam($name = "",$value = "") {
	global $_POST;
	if (isset($_POST[$name])) {
		if (get_magic_quotes_gpc()) {
			if (is_array($_POST[$name])) {
				$retArr = array();
				foreach ($_POST[$name] as $el) array_push($retArr,stripslashes($el));
				return $retArr;
			} else return stripslashes($_POST[$name]);
		} else
				return $_POST[$name];
	} else
		return $value;
}

function uriParam($name = "",$value = "") {
	global $_GET;
	if (isset($_GET[$name])) {
		if (get_magic_quotes_gpc()) {
			if (is_array($_GET[$name])) {
				$retArr = array();
				foreach ($_GET[$name] as $el) array_push($retArr,stripslashes($el));
				return $retArr;
			} else return stripslashes($_GET[$name]);
		} else
				return $_GET[$name];
	} else
		return $value;
}

function postFileParam($name = "") {
	global $_FILES;
	if (isset($_FILES[$name])) 
		return $_FILES[$name];
	else
		return array();
}

function cookieParam($name = "",$value = "") {
	global $_COOKIE;
	if (isset($_COOKIE[$name])) 
		if (get_magic_quotes_gpc()) {
			if (is_array($_COOKIE[$name])) {
				$retArr = array();
				foreach ($_COOKIE[$name] as $el) array_push($retArr,stripslashes($el));
				return $retArr;
			} else return stripslashes($_COOKIE[$name]);
		} else
			return $_COOKIE[$name];
	else
		return $value;
}

function getURI($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_GET;
	
	$result = "";
	if ($varlist == "")
		$arr_varlist = array_keys($_GET);
	else
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist)) {
			if ($outputifnotset) if ($result != "") $result .= "&";
			if (!isset($_GET[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= $arr_varlist[$i]."=";
			} elseif (isset($_GET[$arr_varlist[$i]])) {
				if (get_magic_quotes_gpc())
					$result .= $arr_varlist[$i]."=".rawurlencode(stripslashes($_GET[$arr_varlist[$i]]));
				else
					$result .= $arr_varlist[$i]."=".rawurlencode($_GET[$arr_varlist[$i]]);
			}
		}
	
	return $result;
}

function getURI2Form($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_GET;
	
	$result = "";
	if ($varlist == "")
		$arr_varlist = array_keys($_GET);
	else
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist) && isset($_GET[$arr_varlist[$i]])) {
			if (!isset($_GET[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"\">";
			} elseif (isset($_GET[$arr_varlist[$i]])) {
				if (get_magic_quotes_gpc())
					$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"".htmlentities(stripslashes($_GET[$arr_varlist[$i]]))."\">";
				else
					$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"".htmlentities($_GET[$arr_varlist[$i]])."\">";
			}
		}
	
	return $result;
}

function getPost2Form($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_POST;
	
	$result = "";
	if ($varlist == "") 
		$arr_varlist = array_keys($_POST);
	else 
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist) && isset($_POST[$arr_varlist[$i]])) {
			if (!isset($_POST[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"\">";
			} elseif (isset($_POST[$arr_varlist[$i]])) {
				$result .= "<input type=\"hidden\" name=\"".$arr_varlist[$i]."\" value=\"".htmlentities(stripslashes($_POST[$arr_varlist[$i]]))."\">";
			}
		}
	
	return $result;
}

function getPost2URI($varlist = "",$excvarlist = "",$outputifnotset = true) {
	global $_POST;
	
	$result = "";
	if ($varlist == "") 
		$arr_varlist = array_keys($_POST);
	else 
		$arr_varlist = explode(",",$varlist);
	$arr_excvarlist = explode(",",$excvarlist);
	
	for($i=0;$i<count($arr_varlist);$i++) 
		if (!in_array($arr_varlist[$i],$arr_excvarlist)) {
			if ($outputifnotset) if ($result != "") $result .= "&";
			if (!isset($_POST[$arr_varlist[$i]]) && $outputifnotset) {
				$result .= $arr_varlist[$i]."=";
			} elseif (isset($_POST[$arr_varlist[$i]])) {
				$result .= $arr_varlist[$i]."=".rawurlencode(stripslashes($_POST[$arr_varlist[$i]]));
			}
		}

	return $result;
}

function jsAlert($msg = "") {
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	alert('<?=jsFormat($msg)?>');
//-->
</SCRIPT>
<?
}

function jsNavigate($url = "",$replacehistory = false) {
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	<? if ($replacehistory) { ?>location.replace('<?=$url?>');<? } else { ?>location='<?=$url?>';<? } ?>
//-->
</SCRIPT>
<?
}

function jsAlertAndNavigate($msg = "",$url = "",$replacehistory = false) {
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
	alert('<?=jsFormat($msg)?>');
	<? if ($replacehistory) { ?>location.replace('<?=$url?>');<? } else { ?>location='<?=$url?>';<? } ?>
//-->
</SCRIPT>
<?
}

function jsRepostURIAndPostData($message = "",$frmAction = "",$frmName = "phpFormResubmit",$uri_varlist = "",$uri_excvarlist = "",$post_varlist = "",$post_excvarlist = "",$outputifnotset = true) {
	if (trim($frmName) == "" || trim($frmAction) == "") return;
?>
	<form action="<?=$frmAction.getURI($post_varlist,$post_excvarlist,$outputifnotset)?>" name="<?=$frmName?>" method="post">
		<?=getPost2Form($post_varlist,$post_excvarlist,$outputifnotset)?>
	</form>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
  <!--
  	<? if (trim($message) != "") { ?>alert('<?=jsFormat($message)?>');<? } ?>
		document.<?=$frmName?>.submit();
  //-->
  </SCRIPT>
<?
}

function findOneOf($str,$spec) {
	$found = -1;
	for ($i=0; $i<strlen($spec); $i++) {
		$found = strpos($str,addslashes(substr($spec,$i,1)));
		if ($found > -1) {
			break;
		}
	}
	$found++;
	return ($found);
}

function ShowCalendar($Indx) {
	echo "<script type=\"text/javascript\">\n";
	echo " Calendar.setup({
	        inputField: \"InDate$Indx\",        // id of the input field
	        ifFormat: \"%d/%m/%Y\",       // format of the input field
	        showsTime: true,                    // will display a time selector
	        singleClick: false                  // double-click mode
	       });\n";
	echo "</script>\n";
}

function datesql2date ($datesql) {
	if(strlen($datesql)){
		$tgl = listGetAt($datesql,1," ");
		$my_year = listGetAt($tgl,1,"-");
		$my_month = listGetAt($tgl,2,"-");
		$my_day = listGetAt($tgl,3,"-");
		
		$date = "$my_day/$my_month/$my_year";
	}else{
		$date = "";
	}
	return $date;
}

function linechart($chart_id){
		global $_GET;
		global $_COOKIE;
		global $_POST;
		//global $edition_id;
		
		$cekdb = cmsDB();
		$menu = cmsDB();
		$qCek = cmsDB();
		
		$sql = "select * from db_mega.tbl_chart where chart_id=" . $chart_id;
		$cekdb->query($sql);
		$cekdb->next();
		$chart_title = $cekdb->row("chart_name");
		$x_title = $cekdb->row("y_title");
		$y_title = $cekdb->row("x_title");
		$panjang = $cekdb->row("panjang");
		$lebar = $cekdb->row("lebar");
		$type = $cekdb->row("type");
		$report = $cekdb->row("report_id");
		
		if($report==0){
			$sql = "select * from db_mega.tbl_chartmember where chart_id=" . $chart_id;
			$qCek->query($sql);
			$lstx = "";
			$lsty = "";
			while($qCek->next()){
				$lstx = listAppend($lstx,$qCek->row("chart_value"));
				$lsty = listAppend($lsty,$qCek->row("chart_desc"));
			}
		}else{
			if($type == 3){
				$sql = "select * from db_mega.tbl_reportdetail where report_id=" . $report . " order by col_1 desc";
			}else{
				$sql = "select * from db_mega.tbl_reportdetail where report_id=" . $report;
			}
			$qCek->query($sql);
			$lstx = "";
			$lsty = "";
			while($qCek->next()){
				if($type == 3){
					$lstx = listAppend($lstx,$qCek->row("col_2"),"^");
					$lsty = listAppend($lsty,$qCek->row("col_1"),"^");
				}else{
					$lstx = listAppend($lstx,str_replace(",",".",$qCek->row("col_2")));
					$lsty = listAppend($lsty,str_replace(",",".",$qCek->row("col_1")));
				}
			}
		}
		if($type==1){
			echo "<img src='line_trx.php?chart_title= ". $chart_title . "&panjang=". $panjang ."&lebar=". $lebar ."&x_title=". $x_title ."&y_title=" . $y_title . "&lstx=". $lstx ."&lsty=". $lsty ."' border=0 align=top>";
		}elseif($type==2){
			echo "<img src='chart_bar.php?chart_title= ". $chart_title . "&panjang=". $panjang ."&lebar=". $lebar ."&x_title=". $x_title ."&y_title=" . $y_title . "&lstx=". $lstx ."&lsty=". $lsty ."' border=0 align=top>";
		}elseif($type==3){
?>
<table width="156" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="padding-left: 5px; width="100%" colspan="2" bgcolor="#2e80bc"><font color="#FFFFFF" face="Verdana,Tahoma" size="1"><b>
			      <?=$chart_title?></b></font></td>
			  </tr>
			  <? for($i==1;$i<=listLen($lstx,"^");$i++){ ?>
			  <tr>
			    <td width="69" style="padding-left: 5px;"><font color="#666666" face="Verdana,Tahoma" size="1"><?=listGetAt($lsty,$i,"^")?></font></td>
			    <td width="75" align="right" style="padding-right: 5px;"><font color="#666666" face="Verdana,Tahoma" size="1"><?=listGetAt($lstx,$i,"^")?></font></td>
			  </tr>
			  <? } ?>
</table>
  <?			
		}
}

function showbanner($lstofbanner){
global $FJR_VARS;
?>
<table border="0" cellpadding="5" cellspacing="2" style="border-collapse: collapse" bordercolor="#111111" width="100%" >
<?
		$trans_db = cmsDB();
		$qCek = cmsDB();
		
		$sql = "select * from db_mega.tadvertisement where ad_id in (".$lstofbanner.")";
		$trans_db->query($sql); 
		
   		while ($trans_db->next()) { 
?>
        <tr>
                  <td width="100%" valign="top">
				  <? if(strlen(trim($trans_db->row("ad_link")))){?>
				  	<a href="<?=trim($trans_db->row("ad_link"))?>" target="_blank">
				  <? } ?>
				  <img src='<?=$FJR_VARS["www_img_url"]?>banner/<?=$trans_db->row("ad_banner")?>' border="0" width="120" height="60">
				  <? if(strlen(trim($trans_db->row("ad_link")))){ ?>
				  	</a>
				  <? } ?>
				  </td>
  </tr>
        <tr>
		
				
<?		}?>
</table>
<? }

function getDirList ($dirName,$title) {
	global $FJR_VARS;
	echo "<b><u><font color='#2E7EC0'>".$title."</font></u></b><p>";
	$d = dir($dirName);
	echo "<table width='100%' cellpadding='2' cellspacing='0' border='0'>";
	$lstfile = "";
	while($entry = $d->read()) {
		$lstfile = listAppend($lstfile,$entry);
	}
	for($i=0;$i<listLen($lstfile);$i++){
		$entry = listGetAt($lstfile,listLen($lstfile)-$i);
		if ($entry != "." && $entry != "..") {
			if (is_dir($dirName."/".$entry)) {
				getDirList($dirName.$entry);
			}else{
				//echo $dirName.$entry."<br />";
				$dir_real = str_replace($FJR_VARS["www_file_path"],"",$dirName);
				$ext = listLast($entry,".");
				if($ext == "pdf" || $ext == "PDF"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_pdf.gif' border='0' width='20' height='20'  style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}elseif($ext == "doc" || $ext == "DOC"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_msword.gif' border='0' width='20' height='20' style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}elseif($ext == "xls" || $ext=="csv" || $ext=="xlk"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_msexcel.gif' border='0' width='20' height='20' style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}elseif($ext == "ppt" || $ext == "PPT"){
					echo "<tr><td><a href=\"javascript:PopWindow('../_cms/getfile.php?fn=".$dir_real.$entry."','winfile',800,600);\"><img src='".$FJR_VARS["www_img_url"]."icon_mspoint.gif' border='0' width='20' height='20' style='float: left'>&nbsp;".$entry."</a></td></tr>";
				}
			}
		}
	}
	
	echo "</table>";
	$d->close();
}

?>