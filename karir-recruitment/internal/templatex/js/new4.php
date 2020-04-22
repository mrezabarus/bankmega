<?
	require_once("../../config.php");
	$job=cmsDB();
	if(isset($_GET["save"])){
		$job->query("delete from tbl_jobseeker_questionare where js_id=".uriParam("js_id"));
		$job->query("delete from tbl_jobseeker_jobexp where js_id=".uriParam("js_id"));
		$job->query("delete from tbl_jobseeker_addtional_info where question <>'reading_freq' and js_id=".uriParam("js_id"));
		$strsql="update tbl_jobseeker set exp_comp_gp=0,exp_comp_gp_nego='y',organisasi_pos='' where js_id=".uriParam("js_id");
		$job->query($strsql);
		
		$strsql = "insert into tbl_jobseeker_jobexp(comp_name,working_duration,working_duration2,job_title,job_desc,salary,reason_resign,job_check,js_id) 
				   values('".postParam("job1_company")."','".postParam("job1a_duration")."','".postParam("job1b_duration")."','".postParam("job1_title")."',
				          '".postParam("job1_desc")."','".postParam("job1_salary")."','".postParam("job1_resign")."','1',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_jobexp(comp_name,working_duration,working_duration2,job_title,job_desc,salary,reason_resign,job_check,js_id) 
				   values('".postParam("job2_company")."','".postParam("job2a_duration")."','".postParam("job2b_duration")."','".postParam("job2_title")."',
				          '".postParam("job2_desc")."','".postParam("job2_salary")."','".postParam("job2_resign")."','0',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_jobexp(comp_name,working_duration,working_duration2,job_title,job_desc,salary,reason_resign,job_check,js_id) 
				   values('".postParam("job3_company")."','".postParam("job3a_duration")."','".postParam("job3b_duration")."','".postParam("job3_title")."',
				          '".postParam("job3_desc")."','".postParam("job3_salary")."','".postParam("job3_resign")."','0',".uriParam("js_id").")";
		$job->query($strsql);
		
		$strsql = "insert into tbl_jobseeker_questionare(question,answer,js_id) 
					values('Tujuan anda melamar di perusahaan kami?','".postParam("question1")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_questionare(question,answer,js_id) 
					values('Bidang pekerjaan yang disenangi?','".postParam("question2")."',".uriParam("js_id").")";
		$job->query($strsql);		
		$strsql = "insert into tbl_jobseeker_questionare(question,answer,js_id) 
					values('Bidang pekerjaan yang tidak anda senangi?','".postParam("question3")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_questionare(question,answer,js_id) 
					values('Pengetahuan and keahlian yang anda kuasai?','".postParam("question4")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_questionare(question,answer,js_id) 
					values('Berapakah gaji dan tunjangan lain yang anda harapkan?','".postParam("question5")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_questionare(question,answer,js_id) 
					values('Kapan anda dapat mulai bekerja?','".postParam("question6")."',".uriParam("js_id").")";
		$job->query($strsql);
		
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('Apakah anda pernah melamar di perusahaan kami?, Kapan ? di posisi apa?','".postParam("info1")."','".postParam("info1_notes")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('Apakah anda terikat kontrak dengan perusahaan tempat anda bekerja saat ini?','".postParam("info2")."','".postParam("info2_notes")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('Apakah anda memiliki kenalan / Saudara di Bank Mega?','".postParam("info3")."','".postParam("info3_notes")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('Apakah anda pernah mengalami sakit / kecelakan berat ? Sebutkan !','".postParam("info4")."','".postParam("info4_notes")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('Apakah anda pernah berurusan dengan polisi karena tindak kejahatan?','".postParam("info5")."','".postParam("info5_notes")."',".uriParam("js_id").")";
		$job->query($strsql);
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('Bersediakah anda ditempatkan di luar kota?','".postParam("info6")."','".postParam("info6_notes")."',".uriParam("js_id").")";
		$job->query($strsql);
		
		$strsql="update tbl_jobseeker set exp_comp_gp=".postParam("exp_salary").",exp_comp_gp_nego='".postParam("negotiable")."',organisasi_pos='".postParam("organisasi")."' where js_id=".uriParam("js_id");
		$job->query($strsql);
		//echo $strsql;die();
		echo "<script>alert('Job Seeker Reference Updated!!');location='edit.php?edit=yes&js_id=".uriParam("js_id")."';</script>";
		die();
		
	}
		
		$strSQL = "SELECT * 
		           FROM tbl_jobseeker_jobexp 
				   WHERE js_id=".uriParam("js_id")." 
				   ORDER BY jsjobexp_id asc";
		$job->query($strSQL);			 
		if($job->recordCount()){
			$job->next();
			$job1_title=$job->row("job_title");
			$job1_company=$job->row("comp_name");
			$job1a_duration=$job->row("working_duration");
			$job1b_duration=$job->row("working_duration2");
			$job1_salary=$job->row("salary");
			$job1_resign=$job->row("reason_resign");
			$job1_desc=$job->row("job_desc");
			
			$job->next();
			$job2_title=$job->row("job_title");
			$job2_company=$job->row("comp_name");
			$job2a_duration=$job->row("working_duration");
			$job2b_duration=$job->row("working_duration2");
			$job2_salary=$job->row("salary");
			$job2_resign=$job->row("reason_resign");
			$job2_desc=$job->row("job_desc");
			
			$job->next();
			$job3_title=$job->row("job_title");
			$job3_company=$job->row("comp_name");
			$job3a_duration=$job->row("working_duration");
			$job3b_duration=$job->row("working_duration2");
			$job3_salary=$job->row("salary");
			$job3_resign=$job->row("reason_resign");
			$job3_desc=$job->row("job_desc");
		}else{
			$job1_title="";
			$job1_company="";
			$job1a_duration="";
			$job1b_duration="";
			$job1_salary="";
			$job1_resign="";
			$job1_desc="";
			
			$job2_title="";
			$job2_company="";
			$job2a_duration="";
			$job2b_duration="";
			$job2_salary="";
			$job2_resign="";
			$job2_desc="";
			
			$job3_title="";
			$job3_company="";
			$job3a_duration="";
			$job3b_duration="";
			$job3_salary="";
			$job3_resign="";
			$job3_desc="";
		}
		
		$strSQL1 = "SELECT * 
		            FROM tbl_jobseeker_addtional_info 
					WHERE question <>'reading_freq' AND js_id=".uriParam("js_id")." 
					ORDER BY jsinfo_id asc";
		$job->query($strSQL1);
		if($job->recordCount()){
			$job->next();
			$info1=$job->row("answer_status");
			$info1_notes=$job->row("answer");
			$job->next();
			$info2=$job->row("answer_status");
			$info2_notes=$job->row("answer");
			$job->next();
			$info3=$job->row("answer_status");
			$info3_notes=$job->row("answer");
			$job->next();
			$info4=$job->row("answer_status");
			$info4_notes=$job->row("answer");
			$job->next();
			$info5=$job->row("answer_status");
			$info5_notes=$job->row("answer");
			$job->next();
			$info6=$job->row("answer_status");
			$info6_notes=$job->row("answer");
			
		}else{
			
			$info1="";
			$info1_notes="";
			
			$info2="";
			$info2_notes="";
			
			$info3="";
			$info3_notes="";
			
			$info4="";
			$info4_notes="";
			
			$info5="";
			$info5_notes="";
			
			$info6="";
			$info6_notes="";
		}
		
		$strSQL2 = "SELECT * 
		           FROM tbl_jobseeker_questionare 
				   WHERE js_id=".uriParam("js_id")." 
				   ORDER BY jsiquestion_id asc";
		$job->query($strSQL2);
		if($job->recordCount()){
			$job->next();
			$question1=$job->row("answer");
			$job->next();
			$question2=$job->row("answer");
			$job->next();
			$question3=$job->row("answer");
			$job->next();
			$question4=$job->row("answer");
			$job->next();
			$question5=$job->row("answer");
			$job->next();
			$question6=$job->row("answer");
		}else{
			$question1="";
			$question2="";
			$question3="";
			$question4="";
			$question5="";
			$question6="";
		}
		
		$strSQL3 = "SELECT * 
		            FROM tbl_jobseeker 
					WHERE js_id=".uriParam("js_id")."";
		$job->query($strSQL3);
		$job->next();
		if(strlen($job->row("exp_comp_gp"))){
			$exp_salary=$job->row("exp_comp_gp");
		}else{
			$exp_salary="0";
		}
		if(strlen($job->row("exp_comp_gp"))){
			$negotiable=$job->row("exp_comp_gp_nego");
		}else{
			$negotiable="yes";
		}
		$organisasi=$job->row("organisasi_pos");
		
		
?>
<body topmargin="0">
<center>
<form action="<?=$_SERVER["SCRIPT_NAME"]?>?save=yes&edit=yes&js_id=<?=uriParam("js_id")?>" method="post" name="sample_form" id="sample_form">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td  align="left" colSpan="5">
		<table border="0" cellpadding="5" cellspacing="2" width="100%">
			<tr>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('edit.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Personal Data</a></td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new1.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Referensi</a></td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new2.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Susunan Keluarga</a></td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new3.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Riwayat Pendidikan</a></td>
				<td class="tableheader" align="center">Riwayat Pekerjaan</td>
			</tr>
			<tr>
				<TD colspan="5" style="HEIGHT: 1px">
                <IMG height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></TD>
			</tr>
		</table>
	 
    </td>
  </tr>
  <tr>
    <td  align="left" colSpan="5" class="tablebodyodd">
<table class="corner" border="0" align="center" cellpadding="2" cellspacing="0">
				<tr class="inputStyle6">
					<td colspan="4" align="left" valign="top"><b>Pekerjaan Terakhir</b></td></tr>
              	<tr>
              	  <td align="left">Posisi</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <input name="job1_title" maxlength="100" type="text" size="20" value="<?=$job1_title?>"></td>
              	  </tr>
              	<tr>
              	  <td align="left">Perusahaan</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <input name="job1_company" maxlength="100" type="text" size="20" value="<?=$job1_company?>"></td>
              	  </tr>
              	<tr>
              	  <td align="left">Masa Kerja</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <select name="job1a_duration">
			        <option value="-" <? if($job1a_duration=="-"){ echo "selected";}?>>-</option>
			        <option value="1" <? if($job1a_duration=="1"){ echo "selected";}?>>1</option>
			      </select> - <select name="job1b_duration">
			        <option value="-" <? if($job1a_duration=="-"){ echo "selected";}?>>-</option>
			        <option value="Sekarang" <? if($job1b_duration=="Sekarang"){ echo "selected";}?>>Sekarang</option>
			        <option value="1 tahun" <? if($job1b_duration=="1 tahun"){ echo "selected";}?>>1 tahun</option>
			        <option value="2 tahun" <? if($job1b_duration=="2 tahun"){ echo "selected";}?>>2 tahun</option>
			        <option value="3 tahun" <? if($job1b_duration=="3 tahun"){ echo "selected";}?>>3 tahun</option>
			        <option value="4 tahun" <? if($job1b_duration=="4 tahun"){ echo "selected";}?>>4 tahun</option>
			        <option value="5 tahun" <? if($job1b_duration=="5 tahun"){ echo "selected";}?>>5 tahun</option>
			        <option value="6 tahun" <? if($job1b_duration=="6 tahun"){ echo "selected";}?>>6 tahun</option>
			        <option value="7 tahun" <? if($job1b_duration=="7 tahun"){ echo "selected";}?>>7 tahun</option>
			        <option value="8 tahun" <? if($job1b_duration=="8 tahun"){ echo "selected";}?>>8 tahun</option>
			        <option value="9 tahun" <? if($job1b_duration=="9 tahun"){ echo "selected";}?>>9 tahun</option>
			        <option value="10 tahun" <? if($job1b_duration=="10 tahun"){ echo "selected";}?>>10 tahun</option>
			        <option value="11 tahun" <? if($job1b_duration=="11 tahun"){ echo "selected";}?>>11 tahun</option>
			        <option value="12 tahun" <? if($job1b_duration=="12 tahun"){ echo "selected";}?>>12 tahun</option>
			        <option value="13 tahun" <? if($job1b_duration=="13 tahun"){ echo "selected";}?>>13 tahun</option>
			        <option value="14 tahun" <? if($job1b_duration=="14 tahun"){ echo "selected";}?>>14 tahun</option>
			        <option value="15 tahun" <? if($job1b_duration=="15 tahun"){ echo "selected";}?>>15 tahun</option>
			        <option value="16 tahun" <? if($job1b_duration=="16 tahun"){ echo "selected";}?>>16 tahun</option>
			        <option value="17 tahun" <? if($job1b_duration=="17 tahun"){ echo "selected";}?>>17 tahun</option>
			        <option value="18 tahun" <? if($job1b_duration=="18 tahun"){ echo "selected";}?>>18 tahun</option>
			        <option value="19 tahun" <? if($job1b_duration=="19 tahun"){ echo "selected";}?>>19 tahun</option>
			        <option value="20 tahun" <? if($job1b_duration=="20 tahun"){ echo "selected";}?>>20 tahun</option>
			      </select></td>
              	  </tr>
              	<tr>
              	  <td align="left">Sallary Terakhir </td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
				  <input name="job1_salary" maxlength="12" type="text" size="20" value="<?=$job1_salary?>" onKeyPress="return handleEnter(this, event, 4)"></td>
              	  </tr>
				<tr>
              	  <td align="left" valign="top">Alasan Berhenti</td>
              	  <td valign="top">:</td>
              	  <td colspan="2" align="left">
                  <textarea name="job1_resign" cols="80" rows="5" class="inputStyle5"><?=$job1_resign?></textarea></td>
              	  </tr>
				<tr>
              	  <td align="left" valign="top">Uraian Tugas & Tanggung Jawab Anda Pada Jabatan Terakhir</td>
              	  <td valign="top">:</td>
              	  <td colspan="2" align="left">
                  <textarea name="job1_desc" cols="80" rows="5" class="inputStyle5"><?=$job1_desc?></textarea></td>
              	  </tr>
				  <tr>
              	  <td colspan="4"><hr color="crimson"></td></tr>
              	<tr>
              	  <td align="left">Posisi</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <input name="job2_title" maxlength="100" type="text" size="20" value="<?=$job2_title?>"></td>
              	  </tr>
              	<tr>
              	  <td align="left">Perusahaan</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <input name="job2_company" maxlength="100" type="text" size="20" value="<?=$job2_company?>"></td>
              	  </tr>
              	<tr>
              	  <td align="left">Masa Kerja</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <select name="job2a_duration">
			        <option value="-" <? if($job1a_duration=="-"){ echo "selected";}?>>-</option>
			        <option value="1" <? if($job2a_duration=="1"){ echo "selected";}?>>1</option>
			      </select> - <select name="job2b_duration">
			        <option value="-" <? if($job1a_duration=="-"){ echo "selected";}?>>-</option>
			        <option value="1 tahun" <? if($job2b_duration=="1 tahun"){ echo "selected";}?>>1 tahun</option>
			        <option value="2 tahun" <? if($job2b_duration=="2 tahun"){ echo "selected";}?>>2 tahun</option>
			        <option value="3 tahun" <? if($job2b_duration=="3 tahun"){ echo "selected";}?>>3 tahun</option>
			        <option value="4 tahun" <? if($job2b_duration=="4 tahun"){ echo "selected";}?>>4 tahun</option>
			        <option value="5 tahun" <? if($job2b_duration=="5 tahun"){ echo "selected";}?>>5 tahun</option>
			        <option value="6 tahun" <? if($job2b_duration=="6 tahun"){ echo "selected";}?>>6 tahun</option>
			        <option value="7 tahun" <? if($job2b_duration=="7 tahun"){ echo "selected";}?>>7 tahun</option>
			        <option value="8 tahun" <? if($job2b_duration=="8 tahun"){ echo "selected";}?>>8 tahun</option>
			        <option value="9 tahun" <? if($job2b_duration=="9 tahun"){ echo "selected";}?>>9 tahun</option>
			        <option value="10 tahun" <? if($job2b_duration=="10 tahun"){ echo "selected";}?>>10 tahun</option>
			        <option value="11 tahun" <? if($job2b_duration=="11 tahun"){ echo "selected";}?>>11 tahun</option>
			        <option value="12 tahun" <? if($job2b_duration=="12 tahun"){ echo "selected";}?>>12 tahun</option>
			        <option value="13 tahun" <? if($job2b_duration=="13 tahun"){ echo "selected";}?>>13 tahun</option>
			        <option value="14 tahun" <? if($job2b_duration=="14 tahun"){ echo "selected";}?>>14 tahun</option>
			        <option value="15 tahun" <? if($job2b_duration=="15 tahun"){ echo "selected";}?>>15 tahun</option>
			        <option value="16 tahun" <? if($job2b_duration=="16 tahun"){ echo "selected";}?>>16 tahun</option>
			        <option value="17 tahun" <? if($job2b_duration=="17 tahun"){ echo "selected";}?>>17 tahun</option>
			        <option value="18 tahun" <? if($job2b_duration=="18 tahun"){ echo "selected";}?>>18 tahun</option>
			        <option value="19 tahun" <? if($job2b_duration=="19 tahun"){ echo "selected";}?>>19 tahun</option>
			        <option value="20 tahun" <? if($job2b_duration=="20 tahun"){ echo "selected";}?>>20 tahun</option>
			      </select></td>
              	  </tr>
              	<tr>
              	  <td align="left">Sallary Terakhir </td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
				  <input name="job2_salary" maxlength="12" type="text" size="20" value="<?=$job2_salary?>" onKeyPress="return handleEnter(this, event, 4)"></td>
              	  </tr>
				<tr>
              	  <td align="left" valign="top">Alasan Berhenti</td>
              	  <td valign="top">:</td>
              	  <td colspan="2" align="left">
                  <textarea name="job2_resign" cols="80" rows="5" class="inputStyle5"><?=$job2_resign?></textarea></td>
              	  </tr>
				<tr>
              	  <td align="left" valign="top">Uraian Tugas & Tanggung Jawab Anda Pada Jabatan Terakhir</td>
              	  <td valign="top">:</td>
              	  <td colspan="2" align="left">
                  <textarea name="job2_desc" cols="80" rows="5" class="inputStyle5"><?=$job2_desc?></textarea></td>
              	  </tr>
				  <tr>
              	<tr>
              	  <td colspan="4"><hr color="crimson"></td></tr>
              	<tr>
              	  <td align="left">Posisi</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <input name="job3_title" maxlength="100" type="text" size="20" value="<?=$job3_title?>"></td>
              	  </tr>
              	<tr>
              	  <td align="left">Perusahaan</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <input name="job3_company" maxlength="100" type="text" size="20" value="<?=$job3_company?>"></td>
              	  </tr>
              	<tr>
              	  <td align="left">Masa Kerja</td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
                  <select name="job3a_duration">
			        <option value="-" <? if($job1a_duration=="-"){ echo "selected";}?>>-</option>
			        <option value="1" <? if($job3a_duration=="1"){ echo "selected";}?>>1</option>
			      </select> - <select name="job3b_duration">
			        <option value="-" <? if($job1a_duration=="-"){ echo "selected";}?>>-</option>
			        <option value="1 tahun" <? if($job3b_duration=="1 tahun"){ echo "selected";}?>>1 tahun</option>
			        <option value="2 tahun" <? if($job3b_duration=="2 tahun"){ echo "selected";}?>>2 tahun</option>
			        <option value="3 tahun" <? if($job3b_duration=="3 tahun"){ echo "selected";}?>>3 tahun</option>
			        <option value="4 tahun" <? if($job3b_duration=="4 tahun"){ echo "selected";}?>>4 tahun</option>
			        <option value="5 tahun" <? if($job3b_duration=="5 tahun"){ echo "selected";}?>>5 tahun</option>
			        <option value="6 tahun" <? if($job3b_duration=="6 tahun"){ echo "selected";}?>>6 tahun</option>
			        <option value="7 tahun" <? if($job3b_duration=="7 tahun"){ echo "selected";}?>>7 tahun</option>
			        <option value="8 tahun" <? if($job3b_duration=="8 tahun"){ echo "selected";}?>>8 tahun</option>
			        <option value="9 tahun" <? if($job3b_duration=="9 tahun"){ echo "selected";}?>>9 tahun</option>
			        <option value="10 tahun" <? if($job3b_duration=="10 tahun"){ echo "selected";}?>>10 tahun</option>
			        <option value="11 tahun" <? if($job3b_duration=="11 tahun"){ echo "selected";}?>>11 tahun</option>
			        <option value="12 tahun" <? if($job3b_duration=="12 tahun"){ echo "selected";}?>>12 tahun</option>
			        <option value="13 tahun" <? if($job3b_duration=="13 tahun"){ echo "selected";}?>>13 tahun</option>
			        <option value="14 tahun" <? if($job3b_duration=="14 tahun"){ echo "selected";}?>>14 tahun</option>
			        <option value="15 tahun" <? if($job3b_duration=="15 tahun"){ echo "selected";}?>>15 tahun</option>
			        <option value="16 tahun" <? if($job3b_duration=="16 tahun"){ echo "selected";}?>>16 tahun</option>
			        <option value="17 tahun" <? if($job3b_duration=="17 tahun"){ echo "selected";}?>>17 tahun</option>
			        <option value="18 tahun" <? if($job3b_duration=="18 tahun"){ echo "selected";}?>>18 tahun</option>
			        <option value="19 tahun" <? if($job3b_duration=="19 tahun"){ echo "selected";}?>>19 tahun</option>
			        <option value="20 tahun" <? if($job3b_duration=="20 tahun"){ echo "selected";}?>>20 tahun</option>
			      </select></td>
              	  </tr>
              	<tr>
              	  <td align="left">Sallary Terakhir </td>
              	  <td>:</td>
              	  <td colspan="2" align="left">
				  <input name="job3_salary" maxlength="12" type="text" size="20" value="<?=$job3_salary?>" onKeyPress="return handleEnter(this, event, 4)"></td>
              	  </tr>
				<tr>
              	  <td align="left" valign="top">Alasan Berhenti</td>
              	  <td valign="top">:</td>
              	  <td colspan="2" align="left">
                  <textarea name="job3_resign" cols="80" rows="5" class="inputStyle5"><?=$job3_resign?></textarea></td>
              	  </tr>
				<tr>
              	  <td align="left" valign="top">Uraian Tugas & Tanggung Jawab Anda Pada Jabatan Terakhir</td>
              	  <td valign="top">:</td>
              	  <td colspan="2" align="left">
                  <textarea name="job3_desc" cols="80" rows="5" class="inputStyle5"><?=$job3_desc?></textarea></td>
              	  </tr>
				  <tr>
				 <tr><td colspan="4"><hr color="crimson"></td></tr>
				 <tr>
				 <td align="left" valign="top">Expected Salary</td>
				 <td valign="top">:</td>
				 <td align="left" valign="top">Rp. 
                 <input name="exp_salary" maxlength="12" type="text" size="20" value="<?=$exp_salary?>" onKeyPress="return handleEnter(this, event, 4)"><br />
				 <span class="inputStyle5"><font color="#ff0000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contoh: 15000000</font></span></td>
				 <td align="left" valign="top">
                  Negotiable 
             <input name="negotiable" value="yes" type="radio" <?if($negotiable=="yes"){ echo "checked";}?>/>Yes&nbsp;
                      <input name="negotiable" value="no" type="radio" <?if($negotiable=="no"){ echo "checked";}?>/>No</td>
		  </tr>
                    <tr>
                      <td colspan="4" valign="top">&nbsp;</td>
                    </tr>
 				  <tr>
				  	<td colspan="4" >&nbsp;</td>
				  </tr>
				<tr>
              	  <td colspan="4" align="left" >Struktur Organisasi</td>
				</tr>
              	<tr>
              	  <td colspan="4" align="left"><table width="100%" border="0" cellpadding=0 cellspacing=0>
                    <tr>
                      <td>Gambarkan Posisi anda terakhir dalam Struktur Organisasi</td>
                      </tr>
                    <tr>
                      <td valign="top">
                      <textarea name="organisasi" cols="80" rows="5" class="inputStyle5"><?=$organisasi?></textarea></td>
                      </tr>
                    <tr>
                      <td colspan="5" valign="top">&nbsp;</td>
                    </tr>
                  </table></td>
              	  </tr>
				  <td colspan="4">&nbsp;</td>
				  </tr>
				<tr>
              	  <td colspan="4" align="left" ><b>Informasi Tambahan</b></td>
				</tr>
              	<tr>
              	  <td colspan="4" align="left"><table width="100%" border="0" cellpadding=0 cellspacing=0>
				<tr class="inputStyle6">
					<td colspan="6" align="left" valign="top"><b>Opsi I</b></td>
				</tr>
                    <tr>
                      <td width="3%" valign="top"><strong>No</strong></td>
                      <td width="32%" valign="top"><strong>Pertanyaan</strong></td>
                      <td colspan="2" valign="top"><div align="center"><strong>Pilih</strong></div></td>
                      <td width="52%" valign="top"><strong>Keterangan</strong></td>
                    </tr>
                    <tr>
                      <td valign="top">1.</td>
                      <td valign="top">Apakah anda pernah melamar di perusahaan kami?<br />
                        Kapan &amp; di posisi apa?</td>
                      <td width="5%" valign="top">
                      <input name="info1" value="yes" type="radio" <?if($info1=="yes"){ echo "checked";}?>/>Ya</td>
                      <td width="8%" valign="top">
                      <input name="info1" value="no" type="radio" <?if($info1=="no"){ echo "checked";}?>>Tidak</td>
                      <td valign="top">
                      <textarea name="info1_notes" cols="80" rows="3" class="inputStyle5"><?=$info1_notes?></textarea></td>
                    </tr>
                    <tr>
                      <td valign="top">2.</td>
                      <td valign="top">Apakah anda terikat kontrak dengan perusahaan tempat anda bekerja saat ini?</td>
                       <td width="5%" valign="top">
                      <input name="info2" value="yes" type="radio" <?if($info2=="yes"){ echo "checked";}?>/>Ya</td>
                      <td width="8%" valign="top">
                      <input name="info2" value="no" type="radio" <?if($info2=="no"){ echo "checked";}?>>Tidak</td>
                      <td valign="top">
                      <textarea name="info2_notes" cols="80" rows="3" class="inputStyle5"><?=$info2_notes?></textarea></td>
                    </tr>
                    <tr>
                      <td valign="top">3.</td>
                      <td valign="top">Apakah anda memiliki kenalan / Saudara di Bank Mega?</td>
                       <td width="5%" valign="top">
                      <input name="info3" value="yes" type="radio" <? if($info3=="yes"){ echo "checked";}?>/>Ya</td>
                      <td width="8%" valign="top">
                      <input name="info3" value="no" type="radio" <? if($info3=="no"){ echo "checked";}?>>Tidak</td>
                      <td valign="top">
                      <textarea name="info3_notes" cols="80" rows="3" class="inputStyle5"><?=$info3_notes?></textarea></td>
                    </tr>
                    <tr>
                      <td valign="top">4.</td>
                      <td valign="top">Apakah anda pernah mengalami sakit / kecelakan berat ? Sebutkan !</td>
                      <td width="5%" valign="top">
                      <input name="info4" value="yes" type="radio" <?if($info4=="yes"){ echo "checked";}?>/>Ya</td>
                      <td width="8%" valign="top">
                      <input name="info4" value="no" type="radio" <?if($info4=="no"){ echo "checked";}?>>Tidak</td>
                      <td valign="top">
                      <textarea name="info4_notes" cols="80" rows="3" class="inputStyle5"><?=$info4_notes?></textarea></td>
                    </tr>
                    <tr>
                      <td valign="top">5.</td>
                      <td valign="top">Apakah anda pernah berurusan dengan polisi karena tindak kejahatan?</td>
                       <td width="5%" valign="top">
                      <input name="info5" value="yes" type="radio" <? if($info5=="yes"){ echo "checked";}?>/>Ya</td>
                      <td width="8%" valign="top">
                      <input name="info5" value="no" type="radio" <? if($info5=="no"){ echo "checked";}?>>Tidak</td>
                      <td valign="top">
                      <textarea name="info5_notes" cols="80" rows="3" class="inputStyle5"><?=$info5_notes?></textarea></td>
                    </tr>
                    <tr>
                      <td valign="top">6.</td>
                      <td valign="top">Bersediakah anda ditempatkan di luar kota?</td>
                      <td width="5%" valign="top">
                      <input name="info6" value="yes" type="radio" <? if($info6=="yes"){ echo "checked";}?>/>Ya</td>
                      <td width="8%" valign="top">
                      <input name="info6" value="no" type="radio" <? if($info6=="no"){ echo "checked";}?>>Tidak</td>
                      <td valign="top">
                      <textarea name="info6_notes" cols="80" rows="3" class="inputStyle5"><?=$info6_notes?></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="5" valign="top">&nbsp;</td>
                    </tr>
				<tr class="inputStyle6">
					<td colspan="6" align="left" valign="top"><b>Opsi II</b></td>
				</tr>
                    <tr>
                      <td valign="top"><strong>No</strong></td>
                      <td valign="top"><strong>Pertanyaan</strong></td>
                      <td colspan="3" valign="top"><strong>Jawaban</strong></td>
                      </tr>
                    <tr>
                      <td valign="top">1.</td>
                      <td valign="top">Tujuan anda melamar di perusahaan kami?</td>
                      <td colspan="3" valign="top">
                      <textarea name="question1" cols="80" rows="3" class="inputStyle5"><?=$question1?></textarea></td>
                      </tr>
                    <tr>
                      <td valign="top">2.</td>
                      <td valign="top">Bidang pekerjaan yang disenangi?</td>
                      <td colspan="3" valign="top">
                      <textarea name="question2" cols="80" rows="3" class="inputStyle5"><?=$question2?></textarea></td>
                      </tr>
                    <tr>
                      <td valign="top">3.</td>
                      <td valign="top">Bidang pekerjaan yang tidak anda senangi?</td>
                      <td colspan="3" valign="top">
                      <textarea name="question3" cols="80" rows="3" class="inputStyle5"><?=$question3?></textarea></td>
                      </tr>
                    <tr>
                      <td valign="top">4.</td>
                      <td valign="top">Pengetahuan and keahlian yang anda kuasai?</td>
                      <td colspan="3" valign="top">
                      <textarea name="question4" cols="80" rows="3" class="inputStyle5"><?=$question4?></textarea></td>
                      </tr>
                    <tr>
                      <td valign="top">5.</td>
                      <td valign="top">Berapakah gaji dan tunjangan lain yang anda harapkan?</td>
                      <td colspan="3" valign="top">
                      <textarea name="question5" cols="80" rows="3" class="inputStyle5"><?=$question5?></textarea></td>
                      </tr>
                    <tr>
                      <td valign="top">6.</td>
                      <td valign="top">Kapan anda dapat mulai bekerja?</td>
                      <td colspan="3" valign="top">
                      <textarea name="question6" cols="80" rows="3" class="inputStyle5"><?=$question6?></textarea></td>
                      </tr>
                    <tr>
                      <td colspan="5" valign="top">&nbsp;</td>
                      </tr>
                  </table>
				 </td>
              	  </tr>
				  </table>
				</td>
  </tr>
  <tr>
    <td  class="tableheader" colSpan="5" align="center">
    <? if(listFind($_SESSION["ss_id" . date("mdY")],"13")){?>
    <input type="submit" value="Update Riwayat Pekerjaan">
	<? } ?>
    &nbsp;<input type="Button" value="Cancel" onClick="location='index.php?urlencrypt=<?=md5("mdYHis")?>';"></td>
  </tr>
</table></form></div>