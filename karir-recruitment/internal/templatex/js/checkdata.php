<?
	require_once("../../config.php");
/////////////////////// Check Data ID KTP /////////////////////////////////////
	if(isset($_GET['ktp'])){
			$js=cmsDB();
			$strSQL = "select id_no
			           FROM tbl_jobseeker
					   WHERE id_no='".$_GET['ktp']."'";
			$js->query($strSQL);
			$js->next();
			$ktp = $js->row("id_no");
						
	if ( !$ktp == $js->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.ktp.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Data ID KTP Sudah ada!');\n";
		$js_script .= "  parent.document.sample_form.ktp.value = '';\n";
		$js_script .= "  parent.document.sample_form.ktp.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
///////////////////////// Check Data Email /////////////////////////////////////////
	if(isset($_GET['email'])){
			$js=cmsDB();
			$strSQL = "select email 
			           FROM tbl_jobseeker
					   WHERE email = '".$_GET['email']."'";
			$js->query($strSQL);
			$js->next();
			$email = $js->row("email");
						
	if ( !$email == $js->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.email.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Data Email Sudah ada!');\n";
		$js_script .= "  parent.document.sample_form.email.value = '';\n";
		$js_script .= "  parent.document.sample_form.email.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
///////////////////////////// Check Data Tlp Rumah ///////////////////////////////////////
	if(isset($_GET['hp_home'])){
			$js=cmsDB();
			$strSQL = "select phone_no1
			           FROM tbl_jobseeker
					   WHERE phone_no1 = '".$_GET['hp_home']."'";
			$js->query($strSQL);
			$js->next();
			$phone_no1 = $js->row("phone_no1");
						
	if ( !$phone_no1 == $js->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.hp_home.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Data Tlp Rumah Sudah ada!');\n";
		$js_script .= "  parent.document.sample_form.hp_home.value = '';\n";
		$js_script .= "  parent.document.sample_form.hp_home.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
//////////////////////////// Check Data Handphone //////////////////////////////////////
	if(isset($_GET['hp'])){
			$js=cmsDB();
			$strSQL = "select email,id_no,phone_no1,phone_no2 
			           FROM tbl_jobseeker
					   WHERE phone_no2 = '".$_GET['hp']."'";
			$js->query($strSQL);
			$js->next();
			$phone_no2 = $js->row("phone_no2");
			echo $strSQL;
						
	if (!$phone_no2 == $js->query($strSQL)) {
		$js_script  = "<script>\n";
		$js_script .= "  parent.document.sample_form.hp.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;
	} else {
		$js_script  = "<script>\n";
		$js_script .= " alert('Data Handphone Sudah ada!');\n";
		$js_script .= "  parent.document.sample_form.hp.value = '';\n";
		$js_script .= "  parent.document.sample_form.hp.focus();\n";
		$js_script .= "</script>\n";
		print $js_script;	
     }
   }
   
?>