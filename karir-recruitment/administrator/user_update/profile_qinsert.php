<?
	require_once("../config.inc.php");
		
	$cekdb = cmsDB();
	$generate_pwd = mktime() .$_POST["txtusername"]."-idc";
	$sql = "insert into tuser(user_name,password,first_name,last_name,phone,hp,nik,email,area_id,join_date) VALUES";
	$sql = $sql . "('".trim($_POST["txtusername"])."','".$generate_pwd."','".trim($_POST["txtfirstname"])."','".trim($_POST["txtlastname"])."','".trim($_POST["txtphone"])."','".trim($_POST["txthandphone"])."','".trim($_POST["txtnik"])."','".trim($_POST["txtemail"])."','".trim($_POST["selarea"])."',now())";
	$cekdb->query($sql);
	
	//Send Email To User
	$to = $_POST["txtemail"];	 
	$subject = ":::: Konfirmasi Registrasi User Palamar Baru E-Recruitment Bank Mega ::::";	
	$content =            "===================================================================\n";	
	$content = $content . "                      e-recruitment.bankmega.com                   \n";	
	$content = $content . "===================================================================\n";	
	$content = $content . "Kepada Yth. Bpk/Ibu/Sdr/i ". $_POST["txtfirstname"] ." ". $_POST["txtlastname"] . ", \n\n"; 	
	$content = $content . "Anda telah terdaftar sebagai User Pelamar Baru di e-recruitment Bank Mega, Silahkan anda melakukan perubahan-perubahan Informasi anda.\n\n";
	$content = $content . "User Name Anda : ".$_POST["txtusername"]."\n";
	$content = $content . "Password Anda : ".$generate_pwd."\n";
	$content = $content . "Segera rubah password anda pada pada menu login\n\n";
	$content = $content . "Email ini disarankan untuk dicetak atau disimpan agar dapat dijadikan referensi yang akan datang. Jika ada pertanyaan lainnya\n";	
	$content = $content . ", Silahkan hubungi Support E-recruitment Bank Mega tbk\n";	
	$content = $content . "Sebagai catatan email ini adalah pelayanan otomatis dan tidak dapat di monitor untuk di reply.\n";	
	mail($to, $subject, $content,"From:Information Document Center ::: PT Bank Mega tbk ::: <system alert>\r\n");
	
	$message = "New User Added!!";
	jsAlertAndNavigate($message,"index.php?ref=".mktime(),true);
	
?>