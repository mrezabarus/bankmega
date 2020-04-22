<?
	require_once("../../config.php");
/////////////////////// Check Data ID NUMBER /////////////////////////////////////
	if(isset($_GET['test_no'])){
			$rec=cmsDB();
			$strSQL = "SELECT test_no
			           FROM tbl_jobseeker_test
					   WHERE test_no='".$_GET['test_no']."'";
			$rec->query($strSQL);
			$rec->next();
			$test_no = $rec->row("test_no");
						
	if ( !$test_no == $rec->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.test_no.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Nomor Test Sudah dipakai!');\n";
		$js_script .= "  parent.document.sample_form.test_no.value = '';\n";
		$js_script .= "  parent.document.sample_form.test_no.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
?>