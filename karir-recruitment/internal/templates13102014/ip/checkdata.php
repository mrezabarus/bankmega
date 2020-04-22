<?
	require_once("../../config.php");
/////////////////////// Check Data ID NUMBER /////////////////////////////////////
	if(isset($_GET['ip_no'])){
			$rec=cmsDB();
			$strSQL = "SELECT ip_no
			           FROM tbl_ijin_prinsip
					   WHERE ip_no='".$_GET['ip_no']."'";
			$rec->query($strSQL);
			$rec->next();
			$ip_no = $rec->row("ip_no");
						
	if (!$ip_no == $rec->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.ip_no.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Nomor Test Sudah dipakai!');\n";
		$js_script .= "  parent.document.sample_form.ip_no.value = '';\n";
		$js_script .= "  parent.document.sample_form.ip_no.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
?>