<?
	require_once("../../config.php");
/////////////////////// Check Data ID NUMBER /////////////////////////////////////
	if(isset($_GET['ol_no'])){
			$ol=cmsDB();
			$strSQL = "SELECT ol_no
			           FROM tbl_offering_letter
					   WHERE ol_no='".$_GET['ol_no']."'";
			$ol->query($strSQL);
			$ol->next();
			$ol_no = $ol->row("ol_no");
						
	if ( !$ol_no == $ol->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.ol_no.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Nomor OL Sudah dipakai!');\n";
		$js_script .= "  parent.document.sample_form.ol_no.value = '';\n";
		$js_script .= "  parent.document.sample_form.ol_no.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
?>