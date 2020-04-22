<?
	require_once("../../config.php");
	$edu=cmsDB();
	if(isset($_GET["save"])){
		$edu->query("delete from tbl_jobseeker_formal_edu where js_id=".uriParam("js_id"));
		$edu->query("delete from tbl_jobseeker_informal_edu where js_id=".uriParam("js_id"));
		$edu->query("delete from tbl_jobseeker_activity where js_id=".uriParam("js_id"));
		$edu->query("delete from tbl_jobseeker_language where js_id=".uriParam("js_id"));
		$edu->query("delete from tbl_jobseeker_addtional_info where question='reading_freq' and js_id=".uriParam("js_id"));
		//FORMAL EDUCATION
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('sd','".postParam("sd_name")."','','".postParam("sd_year")."','".postParam("sd_ipk")."','".postParam("sd_certified")."',
					       '".postParam("sd_city")."','".postParam("sd_major")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('smp','".postParam("smp_name")."','','".postParam("smp_year")."','".postParam("smp_ipk")."','".postParam("smp_certified")."',
					       '".postParam("smp_city")."','".postParam("smp_major")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('smu','".postParam("smu_name")."','','".postParam("smu_year")."','".postParam("smu_ipk")."','".postParam("smu_certified")."',
					       '".postParam("smu_city")."','".postParam("smu_major")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('d1','".postParam("d1_name")."','','".postParam("d1_year")."','".postParam("d1_ipk")."','".postParam("d1_certified")."',
					       '".postParam("d1_city")."','".postParam("d1_major")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('d3','".postParam("d3_name")."','','".postParam("d3_year")."','".postParam("d3_ipk")."','".postParam("d3_certified")."',
					       '".postParam("d3_city")."','".postParam("d3_major")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('s1','".postParam("s1_name")."','','".postParam("s1_year")."','".postParam("s1_ipk")."','".postParam("s1_certified")."',
					       '".postParam("s1_city")."','".postParam("s1_major")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_formal_edu(formal_level,formal_name,formal_status,formal_date,ipk,certified,city,major,js_id) 
					values('s2','".postParam("s2_name")."','','".postParam("s2_year")."','".postParam("s2_ipk")."','".postParam("s2_certified")."',
					       '".postParam("s2_city")."','".postParam("s2_major")."',".uriParam("js_id").")";
		$edu->query($strsql);

		//INFORMAL EDUCATION
		$strsql = "insert into tbl_jobseeker_informal_edu(informal_name,organizer,informal_status,informal_period,sponsored_by,js_id) 
					values('".postParam("informal1_name")."','".postParam("informal1_vendor")."','".postParam("informal1_certified")."',
					       '".postParam("informal1_time")."','".postParam("informal1_funder")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_informal_edu(informal_name,organizer,informal_status,informal_period,sponsored_by,js_id) 
					values('".postParam("informal2_name")."','".postParam("informal2_vendor")."','".postParam("informal2_certified")."',
					       '".postParam("informal2_time")."','".postParam("informal2_funder")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_informal_edu(informal_name,organizer,informal_status,informal_period,sponsored_by,js_id) 
					values('".postParam("informal3_name")."','".postParam("informal3_vendor")."','".postParam("informal3_certified")."',
					       '".postParam("informal3_time")."','".postParam("informal3_funder")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_informal_edu(informal_name,organizer,informal_status,informal_period,sponsored_by,js_id) 
					values('".postParam("informal4_name")."','".postParam("informal4_vendor")."','".postParam("informal4_certified")."',
					       '".postParam("informal4_time")."','".postParam("informal4_funder")."',".uriParam("js_id").")";
		$edu->query($strsql);

		//LANGUAGE SKILL
		$strsql = "insert into tbl_jobseeker_language(language_name,reading_status,writing_status,oral_status,js_id) 
					values('".postParam("language1_name")."','".postParam("language1_read")."','".postParam("language1_write")."',
					       '".postParam("language1_oral")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_language(language_name,reading_status,writing_status,oral_status,js_id) 
			        values('".postParam("language2_name")."','".postParam("language2_read")."','".postParam("language2_write")."',
					       '".postParam("language2_oral")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_language(language_name,reading_status,writing_status,oral_status,js_id) 
			        values('".postParam("language3_name")."','".postParam("language3_read")."','".postParam("language3_write")."',
					       '".postParam("language3_oral")."',".uriParam("js_id").")";
		$edu->query($strsql);
		
		//JOBSEEKER ACTIVITY
		$strsql = "insert into tbl_jobseeker_activity(organization_name,place,title,year_date,js_id) 
					values('".postParam("organisasi1_name")."','".postParam("organisasi1_place")."','".postParam("organisasi1_job")."',
					       '".postParam("organisasi1_year")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_activity(organization_name,place,title,year_date,js_id) 
					values('".postParam("organisasi2_name")."','".postParam("organisasi2_place")."','".postParam("organisasi2_job")."',
					       '".postParam("organisasi2_year")."',".uriParam("js_id").")";
		$edu->query($strsql);
		$strsql = "insert into tbl_jobseeker_activity(organization_name,place,title,year_date,js_id) 
					values('".postParam("organisasi3_name")."','".postParam("organisasi3_place")."','".postParam("organisasi3_job")."',
					       '".postParam("organisasi3_year")."',".uriParam("js_id").")";
		$edu->query($strsql);
		
		//ADDITIONAL INFO
		$strsql = "insert into tbl_jobseeker_addtional_info(question,answer_status,answer,js_id) 
					values('reading_freq','".postParam("reading_freq")."','".postParam("reading_notes")."',".uriParam("js_id").")";
		$edu->query($strsql);
		echo "<script>alert('Job Seeker Educational Background Updated!!');location='edit.php?edit=yes&js_id=".uriParam("js_id")."';</script>";
		die();
	}
	
	$strsql = "SELECT * 
	           FROM tbl_jobseeker_formal_edu 
			   WHERE js_id=".uriParam("js_id")." 
			   ORDER BY formaledu_id asc";
			   
	$edu->query($strsql);
	if($edu->recordCount()){
		$edu->next();
		$sd_name=$edu->row("formal_name");
		$sd_city=$edu->row("city");
		$sd_major=$edu->row("major");
		$sd_year=$edu->row("formal_date");
		$sd_ipk=$edu->row("ipk");
		$sd_certified=$edu->row("certified");
		
		$edu->next();
		$smp_name=$edu->row("formal_name");
		$smp_city=$edu->row("city");
		$smp_major=$edu->row("major");
		$smp_year=$edu->row("formal_date");
		$smp_ipk=$edu->row("ipk");
		$smp_certified=$edu->row("certified");
		
		$edu->next();
		$smu_name=$edu->row("formal_name");
		$smu_city=$edu->row("city");
		$smu_major=$edu->row("major");
		$smu_year=$edu->row("formal_date");
		$smu_ipk=$edu->row("ipk");
		$smu_certified=$edu->row("certified");
		
		$edu->next();
		$d1_name=$edu->row("formal_name");
		$d1_city=$edu->row("city");
		$d1_major=$edu->row("major");
		$d1_year=$edu->row("formal_date");
		$d1_ipk=$edu->row("ipk");
		$d1_certified=$edu->row("certified");
		
		$edu->next();
		$d3_name=$edu->row("formal_name");
		$d3_city=$edu->row("city");
		$d3_major=$edu->row("major");
		$d3_year=$edu->row("formal_date");
		$d3_ipk=$edu->row("ipk");
		$d3_certified=$edu->row("certified");
		
		$edu->next();
		$s1_name=$edu->row("formal_name");
		$s1_city=$edu->row("city");
		$s1_major=$edu->row("major");
		$s1_year=$edu->row("formal_date");
		$s1_ipk=$edu->row("ipk");
		$s1_certified=$edu->row("certified");
		
		$edu->next();
		$s2_name=$edu->row("formal_name");
		$s2_city=$edu->row("city");
		$s2_major=$edu->row("major");
		$s2_year=$edu->row("formal_date");
		$s2_ipk=$edu->row("ipk");
		$s2_certified=$edu->row("certified");

	}else{
		$sd_name="";
		$sd_city="";
		$sd_major="";
		$sd_year="";
		$sd_ipk="";
		$sd_certified="no";
		
		$smp_name="";
		$smp_city="";
		$smp_major="";
		$smp_year="";
		$smp_ipk="";
		$smp_certified="no";
		
		$smu_name="";
		$smu_city="";
		$smu_major="";
		$smu_year="";
		$smu_ipk="";
		$smu_certified="no";
		
		$d1_name="";
		$d1_city="";
		$d1_major="";
		$d1_year="";
		$d1_ipk="";
		$d1_certified="no";
		
		$d3_name="";
		$d3_city="";
		$d3_major="";
		$d3_year="";
		$d3_ipk="";
		$d3_certified="no";
		
		$s1_name="";
		$s1_city="";
		$s1_major="";
		$s1_year="";
		$s1_ipk="";
		$s1_certified="no";
		
		$s2_name="";
		$s2_city="";
		$s2_major="";
		$s2_year="";
		$s2_ipk="";
		$s2_certified="no";
	}
	
	$strsql = "SELECT * 
	           FROM tbl_jobseeker_informal_edu 
			   WHERE js_id=".uriParam("js_id")." 
			   ORDER BY informaledu_id asc";
	
	$edu->query($strsql);
	if($edu->recordCount()){
		$edu->next();
		$informal1_name=$edu->row("informal_name");
		$informal1_vendor=$edu->row("organizer");
		$informal1_certified=$edu->row("informal_status");
		$informal1_time=$edu->row("informal_period");
		$informal1_funder=$edu->row("sponsored_by");
		
		$edu->next();
		$informal2_name=$edu->row("informal_name");
		$informal2_vendor=$edu->row("organizer");
		$informal2_certified=$edu->row("informal_status");
		$informal2_time=$edu->row("informal_period");
		$informal2_funder=$edu->row("sponsored_by");
		
		$edu->next();
		$informal3_name=$edu->row("informal_name");
		$informal3_vendor=$edu->row("organizer");
		$informal3_certified=$edu->row("informal_status");
		$informal3_time=$edu->row("informal_period");
		$informal3_funder=$edu->row("sponsored_by");
		
		$edu->next();
		$informal4_name=$edu->row("informal_name");
		$informal4_vendor=$edu->row("organizer");
		$informal4_certified=$edu->row("informal_status");
		$informal4_time=$edu->row("informal_period");
		$informal4_funder=$edu->row("sponsored_by");
	}else{
		
		$informal1_name="";
		$informal1_vendor="";
		$informal1_certified="no";
		$informal1_time="";
		$informal1_funder="";
		
		$informal2_name="";
		$informal2_vendor="";
		$informal2_certified="no";
		$informal2_time="";
		$informal2_funder="";
		
		$informal3_name="";
		$informal3_vendor="";
		$informal3_certified="no";
		$informal3_time="";
		$informal3_funder="";
		
		$informal4_name="";
		$informal4_vendor="";
		$informal4_certified="no";
		$informal4_time="";
		$informal4_funder="";
	}
	
	$strsql = "SELECT * 
	           FROM tbl_jobseeker_language 
			   WHERE js_id=".uriParam("js_id")." 
			   ORDER BY jslanguage_id asc";
			   
	$edu->query($strsql);
	if($edu->recordCount()){
		$edu->next();
		$language1_name=$edu->row("language_name");
		$language1_read=$edu->row("reading_status");
		$language1_write=$edu->row("writing_status");
		$language1_oral=$edu->row("oral_status");
		
		$edu->next();
		$language2_name=$edu->row("language_name");
		$language2_read=$edu->row("reading_status");
		$language2_write=$edu->row("writing_status");
		$language2_oral=$edu->row("oral_status");
		
		$edu->next();
		$language3_name=$edu->row("language_name");
		$language3_read=$edu->row("reading_status");
		$language3_write=$edu->row("writing_status");
		$language3_oral=$edu->row("oral_status");
		
	}else{
		$language1_name="";
		$language1_read="";
		$language1_write="";
		$language1_oral="";
		
		$language2_name="";
		$language2_read="";
		$language2_write="";
		$language2_oral="";
		
		$language3_name="";
		$language3_read="";
		$language3_write="";
		$language3_oral="";
	}
	
	$strsql = "SELECT * 
	           FROM tbl_jobseeker_activity 
			   WHERE js_id=".uriParam("js_id")." 
			   ORDER BY jsactivity_id asc";
			   
	$edu->query($strsql);
	if($edu->recordCount()){
		$edu->next();
		$organisasi1_name=$edu->row("organization_name");
		$organisasi1_place=$edu->row("place");
		$organisasi1_job=$edu->row("title");
		$organisasi1_year=$edu->row("year_date");
		$edu->next();
		$organisasi2_name=$edu->row("organization_name");
		$organisasi2_place=$edu->row("place");
		$organisasi2_job=$edu->row("title");
		$organisasi2_year=$edu->row("year_date");
		$edu->next();
		$organisasi3_name=$edu->row("organization_name");
		$organisasi3_place=$edu->row("place");
		$organisasi3_job=$edu->row("title");
		$organisasi3_year=$edu->row("year_date");
	}else{
		$organisasi1_name="";
		$organisasi1_place="";
		$organisasi1_job="";
		$organisasi1_year="";
		
		$organisasi2_name="";
		$organisasi2_place="";
		$organisasi2_job="";
		$organisasi2_year="";
		
		$organisasi3_name="";
		$organisasi3_place="";
		$organisasi3_job="";
		$organisasi3_year="";
	}

	$strsql = "SELECT * 
	           FROM tbl_jobseeker_addtional_info 
			   WHERE question='reading_freq' 
			   AND js_id=".uriParam("js_id")." 
			   ORDER BY jsinfo_id";
			   
	$edu->query($strsql);
	if($edu->recordCount()){
		$edu->next();
		$reading_freq=$edu->row("answer_status");
		$reading_notes=$edu->row("answer");
	}else{
		$reading_freq="cukup";
		$reading_notes="";
	}
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
				<td class="tableheader" align="center">Riwayat Pendidikan</td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new4.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Riwayat Pekerjaan</a></td>
			</tr>
			<tr>
				<TD colspan="5" style="HEIGHT: 1px"><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></TD>
			</tr>
		</table>
	 
    </td>
  </tr>
  <tr>
    <td class="tablebodyodd">
    <table border="0" align="center" cellspacing="1">
    <tr >
      <td colspan="6" align="left" ><strong><u>Pendidikan Formal</u></strong></td>
    </tr>
    <tr >
      <td colspan="6" align="left" ><table border="0" cellspacing="1" cellpadding="0">
    <tr height="18">
    <td align="center" class="tableheader">Tingkat Pendidikan</td>
    <td align="center" class="tableheader">Nama Sekolah</td>
    <td align="center" class="tableheader">Kota</td>
    <td align="center" class="tableheader">Jurusan</td>
    <td align="center" class="tableheader">&nbsp;Tahun Lulus&nbsp;</td>
    <td align="center" class="tableheader">IPK</td>
    <td align="center" class="tableheader">&nbsp;Berijasah&nbsp;</td>
  <tr>
    <td>SD - <i> Primary School</i></td>
    <td align="center"><input type="text" name="sd_name" size="16" maxlength="24" value="<?=$sd_name?>"/></td>
    <td align="center"><input type="text" name="sd_city" size="16" maxlength="24" value="<?=$sd_city?>"/></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="sd_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($sd_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="sd_year" size="6" value="<?=$sd_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="sd_ipk" size="4" value="<?=$sd_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="sd_certified">
      <option value="yes" <?if($sd_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($sd_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
  <tr>
    <td>SMP - <i> Junior High School</i>&nbsp;</td>
    <td align="center"><input type="text" name="smp_name" size="16" maxlength="24" value="<?=$smp_name?>" /></td>
    <td align="center"><input type="text" name="smp_city" size="16" maxlength="24" value="<?=$smp_city?>" /></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="smp_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($smp_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="smp_year" size="6" value="<?=$smp_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="smp_ipk" size="4" value="<?=$smp_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="smp_certified">
      <option value="yes" <?if($smp_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($smp_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
  <tr>
    <td>SMU - <i> Senior High School</i>&nbsp;</td>
    <td align="center"><input type="text" name="smu_name" size="16" maxlength="24" value="<?=$smu_name?>" /></td>
    <td align="center"><input type="text" name="smu_city" size="16" maxlength="24" value="<?=$smu_city?>" /></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="smu_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($smu_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="smu_year" size="6" value="<?=$smu_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="smu_ipk" size="4" value="<?=$smu_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="smu_certified">
      <option value="yes" <?if($smu_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($smu_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
  <tr>
    <td>D1 - <i> Diploma 1</i></td>
    <td align="center"><input type="text" name="d1_name" size="16" maxlength="24" value="<?=$d1_name?>" /></td>
    <td align="center"><input type="text" name="d1_city" size="16" maxlength="24" value="<?=$d1_city?>" /></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="d1_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($d1_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="d1_year" size="6" value="<?=$d1_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="d1_ipk" size="4" value="<?=$d1_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="d1_certified">
      <option value="yes" <?if($d1_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($d1_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
  <tr>
    <td>D3 - <i> Diploma 3</i></td>
    <td align="center"><input type="text" name="d3_name" size="16" maxlength="24" value="<?=$d3_name?>" /></td>
    <td align="center"><input type="text" name="d3_city" size="16" maxlength="24" value="<?=$d3_city?>" /></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="d3_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($d3_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="d3_year" size="6" value="<?=$d3_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="d3_ipk" size="4" value="<?=$d3_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="d3_certified">
      <option value="yes" <?if($d3_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($d3_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
  <tr>
    <td>S1 - <i> Bachelor Degree</i></td>
   <td align="center"><input type="text" name="s1_name" size="16" maxlength="24" value="<?=$s1_name?>" /></td>
    <td align="center"><input type="text" name="s1_city" size="16" maxlength="24" value="<?=$s1_city?>" /></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="s1_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($s1_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="s1_year" size="6" value="<?=$s1_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="s1_ipk" size="4" value="<?=$s1_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="s1_certified">
      <option value="yes" <?if($s1_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($s1_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
  <tr>
    <td>S2 - <i> Post Graduate</i></td>
    <td align="center"><input type="text" name="s2_name" size="16" maxlength="24" value="<?=$s2_name?>" /></td>
    <td align="center"><input type="text" name="s2_city" size="16" maxlength="24" value="<?=$s2_city?>" /></td>
    <td align="center"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="s2_major">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($s2_major==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
    <td align="center"><input type="text" name="s2_year" size="6" value="<?=$s2_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
    <td align="center"><input type="text" name="s2_ipk" size="4" value="<?=$s2_ipk?>" maxlength="4" onKeyPress="return handleEnter(this, event, 3)"></td>
    <td align="center"><select size="1" name="s2_certified">
      <option value="yes" <?if($s2_certified=="yes"){echo "selected";}?>>Yes</option>
      <option value="no" <?if($s2_certified=="no"){echo "selected";}?>>No</option>
      &nbsp;
    </select></td>
  </tr>
      </table></td>
    </tr>
                            	
				<tr >
              	  <td colspan="6" align="left" ><strong><u>Pendidikan Informal</u></strong></td>
				</tr>
				
              	<tr >
              	  <td colspan="6" align="left">
				  <table border="0" cellspacing="1" cellpadding="0">
					  <tr height="18">
					    <td align="center" class="tableheader">&nbsp;</td>
					    <td align="center" class="tableheader">Nama Kursus</td>
					    <td align="center" class="tableheader">Penyelenggara</td>
					    <td align="center" class="tableheader">Jangka Waktu</td>
					    <td align="center" class="tableheader">&nbsp;Berijasah&nbsp;</td>
					    <td align="center" class="tableheader">Dibiayai Oleh</td>
					  </tr>
					  <tr>
					    <td align="center">1.</td>
					    <td align="center"><input type="text" name="informal1_name" size="30" maxlength="20" value="<?=$informal1_name?>" /></td>
					    <td align="center"><input type="text" name="informal1_vendor" size="16" maxlength="20" value="<?=$informal1_vendor?>" /></td>
					    <td align="center"><input type="text" name="informal1_time" size="16" maxlength="20" value="<?=$informal1_time?>" /></td>
					    <td align="center"><select size="1" name="informal1_certified">
												      <option value="yes" <?if($informal1_certified=="yes"){echo "selected";}?>>Yes</option>
												      <option value="no" <?if($informal1_certified=="no"){echo "selected";}?>>No</option>
																								      &nbsp;
												      </select></td>
					    <td align="center"><input type="text" name="informal1_funder" size="16" value="<?=$informal1_funder?>" /></td>
					  </tr>
					  <tr>
					    <td align="center">2.</td>
					    <td align="center"><input type="text" name="informal2_name" size="30" maxlength="20" value="<?=$informal2_name?>" /></td>
					    <td align="center"><input type="text" name="informal2_vendor" size="16" maxlength="20" value="<?=$informal2_vendor?>" /></td>
					    <td align="center"><input type="text" name="informal2_time" size="16" maxlength="20" value="<?=$informal2_time?>" /></td>
					    <td align="center"><select size="1" name="informal2_certified">
												      <option value="yes" <?if($informal2_certified=="yes"){echo "selected";}?>>Yes</option>
												      <option value="no" <?if($informal2_certified=="no"){echo "selected";}?>>No</option>
																								      &nbsp;
												      </select></td>
					    <td align="center"><input type="text" name="informal2_funder" size="16" value="<?=$informal2_funder?>" /></td>
					  </tr>
					  <tr>
					    <td align="center">3.</td>
					    <td align="center"><input type="text" name="informal3_name" size="30" maxlength="20" value="<?=$informal3_name?>" /></td>
					    <td align="center"><input type="text" name="informal3_vendor" size="16" maxlength="20" value="<?=$informal3_vendor?>" /></td>
					    <td align="center"><input type="text" name="informal3_time" size="16" maxlength="20" value="<?=$informal3_time?>" /></td>
					    <td align="center"><select size="1" name="informal3_certified">
												      <option value="yes" <?if($informal3_certified=="yes"){echo "selected";}?>>Yes</option>
												      <option value="no" <?if($informal3_certified=="no"){echo "selected";}?>>No</option>
																								      &nbsp;
												      </select></td>
					    <td align="center"><input type="text" name="informal3_funder" size="16" value="<?=$informal3_funder?>" /></td>
					  </tr>
					  <tr>
					    <td align="center">4.</td>
					    <td align="center"><input type="text" name="informal4_name" size="30" maxlength="20" value="<?=$informal4_name?>" /></td>
					    <td align="center"><input type="text" name="informal4_vendor" size="16" maxlength="20" value="<?=$informal4_vendor?>" /></td>
					    <td align="center"><input type="text" name="informal4_time" size="16" maxlength="20" value="<?=$informal4_time?>" /></td>
					    <td align="center"><select size="1" name="informal4_certified">
												      <option value="yes" <?if($informal4_certified=="yes"){echo "selected";}?>>Yes</option>
												      <option value="no" <?if($informal4_certified=="no"){echo "selected";}?>>No</option>
																								      &nbsp;
												      </select></td>
					    <td align="center"><input type="text" name="informal4_funder" size="16" value="<?=$informal4_funder?>" /></td>
					  </tr>
					                  </table></td>
              	</tr>
              	
				<tr >
              	  <td colspan="6" align="left"><strong><u>Bahasa Asing</u></strong></td>
				</tr>
				
              	<tr >
              	  <td colspan="6" align="left"><table border="0" cellspacing="1">
                    <tr height="18">
                      <td class="tableheader" align="center">Bahasa</td>
                      <td class="tableheader" align="center">Baca</td>
                      <td class="tableheader" align="center">Tulis</td>
                      <td class="tableheader" align="center">Lisan</td>
                      </tr>
                    <tr>
                      <td height="19"><input name="language1_name" maxlength="20" type="text" size="20" value="<?=$language1_name?>"/></td>
                      <td height="19"><input name="language1_read" value="kurang" type="radio" <?if($language1_read=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language1_read" value="baik" type="radio" <?if($language1_read=="baik"){echo "checked";}?>/>
                        Baik <input name="language1_read" value="sangat baik" type="radio" <?if($language1_read=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                      <td height="19"><input name="language1_write" value="kurang" type="radio" <?if($language1_write=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language1_write" value="baik" type="radio" <?if($language1_write=="baik"){echo "checked";}?>/>
                        Baik <input name="language1_write" value="sangat baik" type="radio" <?if($language1_write=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                      <td height="19"><input name="language1_oral" value="kurang" type="radio" <?if($language1_oral=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language1_oral" value="baik" type="radio" <?if($language1_oral=="baik"){echo "checked";}?>/>
                        Baik <input name="language1_oral" value="sangat baik" type="radio" <?if($language1_oral=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                    </tr>
                  <tr>
                      <td height="19"><input name="language2_name" maxlength="20" type="text" size="20" value="<?=$language2_name?>"/></td>
                      <td height="19"><input name="language2_read" value="kurang" type="radio" <?if($language2_read=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language2_read" value="baik" type="radio" <?if($language2_read=="baik"){echo "checked";}?>/>
                        Baik <input name="language2_read" value="sangat baik" type="radio" <?if($language2_read=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                      <td height="19"><input name="language2_write" value="kurang" type="radio" <?if($language2_write=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language2_write" value="baik" type="radio" <?if($language2_write=="baik"){echo "checked";}?>/>
                        Baik <input name="language2_write" value="sangat baik" type="radio" <?if($language2_write=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                      <td height="19"><input name="language2_oral" value="kurang" type="radio" <?if($language2_oral=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language2_oral" value="baik" type="radio" <?if($language2_oral=="baik"){echo "checked";}?>/>
                        Baik <input name="language2_oral" value="sangat baik" type="radio" <?if($language2_oral=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                    </tr>
                    <tr>
                      <td height="19"><input name="language3_name" maxlength="20" type="text" size="20" value="<?=$language3_name?>"/></td>
                      <td height="19"><input name="language3_read" value="kurang" type="radio" <?if($language3_read=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language3_read" value="baik" type="radio" <?if($language3_read=="baik"){echo "checked";}?>/>
                        Baik <input name="language3_read" value="sangat baik" type="radio" <?if($language3_read=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                      <td height="19"><input name="language3_write" value="kurang" type="radio" <?if($language3_write=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language3_write" value="baik" type="radio" <?if($language3_write=="baik"){echo "checked";}?>/>
                        Baik <input name="language3_write" value="sangat baik" type="radio" <?if($language3_write=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                      <td height="19"><input name="language3_oral" value="kurang" type="radio" <?if($language3_oral=="kurang"){echo "checked";}?>/>
                        Kurang <input name="language3_oral" value="baik" type="radio" <?if($language3_oral=="baik"){echo "checked";}?>/>
                        Baik <input name="language3_oral" value="sangat baik" type="radio" <?if($language3_oral=="sangat baik"){echo "checked";}?>/>
                        Sangat Baik</td>
                    </tr>
                  </table>				  </td>
              	  </tr>
              	
				<tr >
              	  <td colspan="6" align="left"><strong><u>Aktivitas Sosial</u></strong> </td>
				</tr>
              	<tr >
              	  <td colspan="6" align="left"><table border="0" cellspacing="1">
                    <tr height="18">
                      <td class="tableheader" align="center">Organisasi</td>
                      <td class="tableheader" align="center">Tempat</td>
                      <td class="tableheader" align="center">Jabatan</td>
                      <td class="tableheader" align="center">Tahun</td>
                    </tr>
                    <tr>
                      <td align="center"><input name="organisasi1_name" maxlength="20" type="text" size="32" value="<?=$organisasi1_name?>"/></td>
                      <td align="center"><input name="organisasi1_place" maxlength="20" type="text" size="20" value="<?=$organisasi1_place?>"/></td>
                      <td align="center"><input name="organisasi1_job" maxlength="20" type="text" size="20" value="<?=$organisasi1_job?>"/></td>
                      <td align="center"><input name="organisasi1_year" type="text" size="6" value="<?=$organisasi1_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
                    </tr>
                    <tr>
                      <td align="center"><input name="organisasi2_name" maxlength="20" type="text" size="32" value="<?=$organisasi2_name?>"/></td>
                      <td align="center"><input name="organisasi2_place" maxlength="20" type="text" size="20" value="<?=$organisasi2_place?>"/></td>
                      <td align="center"><input name="organisasi2_job" maxlength="20" type="text" size="20" value="<?=$organisasi2_job?>"/></td>
                      <td align="center"><input name="organisasi2_year" type="text" size="6" value="<?=$organisasi2_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
                    </tr>
                    <tr>
                      <td align="center"><input name="organisasi3_name" maxlength="20" type="text" size="32" value="<?=$organisasi3_name?>"/></td>
                      <td align="center"><input name="organisasi3_place" maxlength="20" type="text" size="20" value="<?=$organisasi3_place?>"/></td>
                      <td align="center"><input name="organisasi3_job" maxlength="20" type="text" size="20" value="<?=$organisasi3_job?>"/></td>
                      <td align="center"><input name="organisasi3_year" type="text" size="6" value="<?=$organisasi3_year?>" maxlength="4" onKeyPress="return handleEnter(this, event, 4)"></td>
                    </tr>
                  </table></td>
              	  </tr>
				<tr >
              	  <td colspan="6" align="left"><strong><u>Kecakapan Membaca</u></strong> </td>
				</tr>
              	<tr >
              	  <td colspan="6" align="left">
				  <table width="100%" border="0" cellpadding=0 cellspacing=0>
                    <tr>
                      <td colspan="2">Frekwensi anda membaca </td>
                      <td width="50%" colspan="3">Pokok yang Dibaca </td>
                      </tr>
                    <tr>
                      <td width="7%"><input type="RADIO" name="reading_freq" value="banyak" <?if($reading_freq=="banyak"){echo "checked";}?>/>Banyak</td>
                      <td width="11%"><input type="RADIO" name="reading_freq" value="cukup" <?if($reading_freq=="cukup"){echo "checked";}?> />Cukup</td>
                      <td colspan="3" rowspan="2" valign="top">
					  <textarea name="reading_notes" cols="80" rows="3" class="inputStyle5"><?=$reading_notes?></textarea></td>
                      </tr>
                    <tr>
                      <td valign="top"><input type="RADIO" name="reading_freq" value="sedikit" <? if($reading_freq=="sedikit"){echo "checked";}?>/>Sedikit</td>
                      <td valign="top"><input type="RADIO" name="reading_freq" value="tidak" <? if($reading_freq=="tidak"){echo "checked";}?>/>Tidak Pernah</td>
                      </tr>
                  </table>				  </td>
              	  </tr>
				  </table>
	  </td>
  </tr>
  
  <tr>
    <td  class="tableheader" colSpan="5" align="center">
    <? if(listFind($_SESSION["ss_id" . date("mdY")],"13")){?>
    <input type="submit" value="Update Pendidikan">
    <? } ?>
	&nbsp;<input type="Button" value="Cancel" onClick="location='index.php?urlencrypt=<?=md5("mdYHis")?>';"></td>
  </tr>
</table></form></div>