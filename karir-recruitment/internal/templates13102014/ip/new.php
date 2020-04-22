<?
require_once("../../config.php");
$insert=cmsDB();
$jstest = cmsDB();
if(isset($_GET["new"])){
	$jstest->query("select jstest_id from tbl_ijin_prinsip");
	$lstip = $jstest->valueList("jstest_id");
	if(listLen($lstip)==0){
		$lstip = 0;
	}
	$strsql = "SELECT tbl_jobseeker_test.*,tbl_jobseeker.* 
			   FROM tbl_jobseeker_test 
			   INNER JOIN tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id 
			   WHERE tbl_jobseeker_test.test_status_id = '0'
			   AND tbl_jobseeker_test.test_status <> 'new'
			   AND tbl_jobseeker_test.test_status <> 'failed'
			   AND tbl_jobseeker_test.jstest_id not in ('.$lstip.') 
			   AND tbl_jobseeker.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
	$jstest->query($strsql);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<body>
<br />
	<center>
	<form action="" method="post" name="sample_form" id="sample_form" enctype="multipart/form-data" onSubmit="return Check()">
	  <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td><b>Pilih No Test</b></td>
        <td><b>:</b></td>
        <td><select name="jstest_id" onchange="_selsubmit('sample_form.jstest_id','<?=$_SERVER["SCRIPT_NAME"]?>?','jstest_id');">
          <option value="0">Select First</option>
          <? while($jstest->next()){?>
          <option value="<?=$jstest->row("jstest_id")?>">[
            <?=$jstest->row("test_no")?>
            ]
  <?=$jstest->row("full_name")?>
          </option>
          <? } ?>
        </select></td>
      </tr>
    </table>
	</form>
	</center>
<?	
	die();
}

if(isset($_POST["save_ip"])){
	$jstest = cmsDB();
	$jstest->query("select * from tbl_jobseeker_test where jstest_id=".postParam("jstest_id"));
	$jstest->next();
	$selposition=$jstest->row("vacant_pos_id");
	$seljobseeker=$jstest->row("js_id");
	$interview = $jstest->row("wawancara_user");
	$notes = $jstest->row("wawancara_dhrm");
	$notes_all = $jstest->row("overall_test_desc");
	$test_no = $jstest->row("test_no");
	$test_status = $jstest->row("test_status");

	 $position=cmsDB();
	$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_branch_mpp_apply.employee_status,tbl_golongan.name,tbl_position.position_name 
				from tbl_position 
				inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
				inner join tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id 
				inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
				where tbl_position_vacant.vacantpos_id=" . $selposition;
				//echo $strsql;
	$position->query($strsql);
	$position->next();
	$branch_id = $position->row("branch_id");
	$gol_name = $position->row("name");
	$position_name =  $position->row("position_name");
	$employee_status = $position->row("employee_status");
	  
	$jobseeker = cmsDB();
	$jobseeker->query("select * from tbl_jobseeker where js_id=".$seljobseeker);
	$jobseeker->next();
	$jobseeker_name = $jobseeker->row("full_name");
	$place_of_birth = $jobseeker->row("place_of_birth");
	$date_of_birth = $jobseeker->row("date_of_birth");
	$address = $jobseeker->row("address1");
	$phone = $jobseeker->row("phone_no1");
	$hp = $jobseeker->row("phone_no2");
	$religion = $jobseeker->row("religion");
	$mar_status = $jobseeker->row("mar_status");
	$last_salary = $jobseeker->row("last_salary");
	
	$branch = cmsDB();
	$strsql = "SELECT tbl_region.region_name,tbl_branch.branch_name 
			   FROM tbl_branch 
			   INNER JOIN tbl_region ON tbl_branch.region_id=tbl_region.region_id 
			   WHERE tbl_branch.branch_id=".$branch_id;
	$branch->query($strsql);
	$branch->next();
	$region_name = $branch->row("region_name");
	$branch_name = $branch->row("branch_name");

	$insert=cmsDB();
	if($employee_status=="contract" || $employee_status=="outsource"){

	$txt_startdate = postParam("tahun_from") ."-".postParam("bulan_from")."-".postParam("tanggal_from")." 00:00:00";
	$txt_enddate = postParam("tahun_to") ."-".postParam("bulan_to")."-".postParam("tanggal_to")." 00:00:00";
	$working_start = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
	$strsql = "insert into tbl_ijin_prinsip(ip_no,ip_date,user_id,ip_approver,approved_date,ip_file,ip_status,ip_duration_start,
											ip_duration_end,NIP,working_status,last_compensation,rencana_penempatan,comp_gp,comp_transport,
											comp_makan,comp_tjabatan,comp_kemahalan,comp_rumah,comp_cop,golongan,employee_status,
											start_date,jstest_id,pjs1,pjs2)
			   values('".postParam("ip_no")."','".date("Y-m-d H:i:s")."',".$_SESSION["user_id" . date("mdY")].",'', now(),'','new',
					  '".$txt_startdate."','".$txt_enddate."','".postParam("NIP")."','".$employee_status."','".$last_salary."',
					  '".$region_name ."-". $branch_name."','".postParam("txt_gp")."','".postParam("txt_transport")."',
					  '".postParam("txt_makan")."','".postParam("txt_jabatan")."','".postParam("txt_kemahalan")."',
					  '".postParam("txt_perumahan")."','".postParam("txt_cop")."','".$gol_name."','','".$working_start."',
					  '".postParam("jstest_id")."','".postParam("pjs1")."','".postParam("pjs2")."')";
	$insert->query($strsql);

	$strsql1 = "update tbl_jobseeker_test set test_status_id='1' where jstest_id=".postParam("jstest_id")."";
	$insert->query($strsql1);
	header("Location: index.php?refresh=".md5("mdYHis")); 	
	die();
	}else{
	$txt_startdate = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
	$txt_enddate = postParam("tahun_to") ."-".postParam("bulan_to")."-".postParam("tanggal_to")." 00:00:00";
	$working_start = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
	$strsql = "insert into tbl_ijin_prinsip(ip_no,ip_date,user_id,ip_approver,approved_date,ip_file,ip_status,ip_duration_start,
											ip_duration_end,NIP,working_status,last_compensation,rencana_penempatan,comp_gp,comp_transport,
											comp_makan,comp_tjabatan,comp_kemahalan,comp_rumah,comp_cop,golongan,employee_status,start_date,
											jstest_id,pjs1,pjs2)
			   values('".postParam("ip_no")."','".date("Y-m-d H:i:s")."',".$_SESSION["user_id" . date("mdY")].",'',now(),'','new',
					  '".$txt_startdate."','".$txt_enddate."','".postParam("NIP")."','".$employee_status."','".$last_salary."',
					  '".$region_name ."-". $branch_name."','".postParam("txt_gp")."','".postParam("txt_transport")."',
					  '".postParam("txt_makan")."','".postParam("txt_jabatan")."','".postParam("txt_kemahalan")."',
					  '".postParam("txt_perumahan")."','".postParam("txt_cop")."','".$gol_name."','',
					  '".$working_start."','".postParam("jstest_id")."','".postParam("pjs1")."','".postParam("pjs2")."')";
			$insert->query($strsql);

	$strsql1 = "update tbl_jobseeker_test set test_status_id='1' where jstest_id=".postParam("jstest_id")."";
	$insert->query($strsql1);
	
			header("Location: index.php?refresh=".md5("mdYHis")); 	
			die();
	}
}
	$jstest = cmsDB();
	$jstest->query("select * from tbl_jobseeker_test where jstest_id=".uriParam("jstest_id"));
	$jstest->next();
	$selposition=$jstest->row("vacant_pos_id");
	$seljobseeker=$jstest->row("js_id");
	$interview = $jstest->row("wawancara_user");
	$notes = $jstest->row("wawancara_dhrm");
	$notes_all = $jstest->row("overall_test_desc");
	$test_no = $jstest->row("test_no");
	$test_status = $jstest->row("test_status");
	$last_salary = $jstest->row("last_salary");

	 $position=cmsDB();
	 $strsql = "select tbl_branch_mpp_apply.branch_id,tbl_branch_mpp_apply.employee_status,tbl_golongan.name,tbl_position.position_name 
				from tbl_position 
				inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
				inner join tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id 
				inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
				where tbl_position_vacant.vacantpos_id=" . $selposition;
				//echo $strsql;
	$position->query($strsql);
	$position->next();
	$branch_id = $position->row("branch_id");
	$gol_name = $position->row("name");
	$position_name =  $position->row("position_name");
	$employee_status = $position->row("employee_status");
	  
	$jobseeker = cmsDB();
	$jobseeker->query("select * from tbl_jobseeker where js_id=".$seljobseeker);
	$jobseeker->next();
	$jobseeker_name = $jobseeker->row("full_name");
	$place_of_birth = $jobseeker->row("place_of_birth");
	$date_of_birth = $jobseeker->row("date_of_birth");
	$address = $jobseeker->row("address1");
	$phone = $jobseeker->row("phone_no1");
	$hp = $jobseeker->row("phone_no2");
	$religion = $jobseeker->row("religion");
	$mar_status = $jobseeker->row("mar_status");
	$last_salary = $jobseeker->row("last_salary");
    $last_study = $jobseeker->row("last_study");
    $course = $jobseeker->row("course");
	
	$jobseeker->query("select * from tbl_jobseeker_formal_edu where js_id=".$seljobseeker . " order by formaledu_id desc");
	$pendidikan = "";
	while($jobseeker->next()){
		if(strlen(trim($jobseeker->row("formal_name")))==0){
			break;
		}else{
			$pendidikan = $jobseeker->row("formal_level") .", ".$jobseeker->row("formal_name"). " Jurusan : ". $jobseeker->row("major");
		}
	}
	
	$jobseeker->query("select * from tbl_jobseeker_jobexp where js_id=".$seljobseeker." and job_check='1' order by jsjobexp_id asc");
	$pengalaman = "";
	while($jobseeker->next()){
		if(strlen(trim($jobseeker->row("comp_name")))<>0){
		    $salary = $salary." Salary : ".number_format($jobseeker->row("salary"),0, '.', ',') ."";
			$pengalaman = $pengalaman."Perusahaan: ".$jobseeker->row("comp_name") .",<br> &nbsp;Jabatan : ".$jobseeker->row("job_title"). ",<br> &nbsp;Masa Kerja : ". $jobseeker->row("working_duration")." sampai ". $jobseeker->row("working_duration2")."<BR>";
		}
	}
	
	$branch = cmsDB();
	$strsql = "select tbl_region.region_name,tbl_branch.branch_name 
				from tbl_branch 
				inner join tbl_region on tbl_branch.region_id=tbl_region.region_id 
				where tbl_branch.branch_id=".$branch_id;
	$branch->query($strsql);
	$branch->next();
	$region_name = $branch->row("region_name");
	$branch_name = $branch->row("branch_name");
	$tgl_from = date("d");
	$bln_from = date("m");
	$thn_from = date("Y");
	
	$tgl_to = date("d");
	$bln_to = date("m");
	$thn_to = date("Y");
	
	$tgl_start = date("d");
	$bln_start = date("m");
	$thn_start = date("Y");
?>
<br />
<form method="post" name="sample_form" id="sample_form" enctype="multipart/form-data" onSubmit="return Check()">
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td align="center"><font size="5"><b>PERSETUJUAN PRINSIP PEGAWAI BARU</b></font></td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="1" cellspacing="0" cellpadding="2">
      <tr>
        <td width="30%" class="cell"><b>Nomor Ijin Prinsip</b></td>
        <td width="2%"><b>:</b></td>
        <td width="68%" colspan="5">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="76%"><b><input type="Text" name="ip_no" value="" size="40" onKeyUp="this.value=this.value.toUpperCase()" onChange="GetId()" /></b></td>
              <td align="right" width="24%"><?=$ip_date?></td>
            </tr>
          </table></td>
        </tr>
      <tr>
        <td class="cell"><b>Mulai Bekerja</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><select name="tanggal_start">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i=="$tgl_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select> 
				<select name="bulan_start">
			        <option value="1" <? if($bln_to=="1"){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bln_to=="2"){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bln_to=="3"){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bln_to=="4"){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bln_to=="5"){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bln_to=="6"){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bln_to=="7"){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bln_to=="8"){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bln_to=="9"){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bln_to=="10"){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bln_to=="11"){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bln_to=="12"){ echo "selected";}?>>Dec</option>
			      </select> 
				  <select name="tahun_start">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>" <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
        </tr>
      <? if($employee_status=="contract" || $employee_status=="outsource"){?>
      <tr>
        <td class="cell"><b>Durasi Dari</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><select name="tanggal_from">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i=="$tgl_from"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select> 
				<select name="bulan_from">
			        <option value="1" <? if($bln_from=="1"){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bln_from=="2"){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bln_from=="3"){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bln_from=="4"){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bln_from=="5"){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bln_from=="6"){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bln_from=="7"){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bln_from=="8"){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bln_from=="9"){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bln_from=="10"){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bln_from=="11"){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bln_from=="12"){ echo "selected";}?>>Dec</option>
			      </select> 
				  <select name="tahun_from">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select>
        </b>To : <b><select name="tanggal_to">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i=="$tgl_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select> 
				<select name="bulan_to">
			        <option value="1" <? if($bln_to=="1"){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bln_to=="2"){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bln_to=="3"){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bln_to=="4"){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bln_to=="5"){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bln_to=="6"){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bln_to=="7"){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bln_to=="8"){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bln_to=="9"){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bln_to=="10"){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bln_to=="11"){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bln_to=="12"){ echo "selected";}?>>Dec</option>
			      </select> 
				  <select name="tahun_to">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
      </tr>
      <? }else{?>  
      <tr>
        <td class="cell"><b>Masa Probation Sampai</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><input type="Hidden" name="tanggal_from" value="<?=date("d")?>">
				  <input type="Hidden" name="bulan_from" value="<?=date("m")?>">
				  <input type="Hidden" name="tahun_from" value="<?=date("Y")?>">
				  <select name="tanggal_to">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i=="$tgl_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select> 
				<select name="bulan_to">
			        <option value="1" <? if($bln_to=="1"){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bln_to=="2"){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bln_to=="3"){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bln_to=="4"){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bln_to=="5"){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bln_to=="6"){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bln_to=="7"){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bln_to=="8"){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bln_to=="9"){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bln_to=="10"){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bln_to=="11"){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bln_to=="12"){ echo "selected";}?>>Dec</option>
			      </select> 
				  <select name="tahun_to">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
      </tr>
      <? } ?>
      <tr>
        <td class="cell"><b>NIP</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<input type="text" name="NIP" size="20" value="0" onkeypress="return handleEnter(this, event, 4)" /></td>
        </tr>
      <tr>
        <td class="cell"><b>Calon Pegawai</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$jobseeker_name?></td>
        </tr>
      <tr>
        <td class="cell"><b>Tempat Tgl. Lahir</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$place_of_birth?>, <?=datesql2date($date_of_birth)?></td>
        </tr>
      <tr>
        <td class="cell" valign="top"><b>Alamat</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5">&nbsp;<?=$address?></td>
        </tr>
      <tr>
        <td class="cell"><b>Telepon</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$phone?> / <?=$ph?></td>
        </tr>
      <tr>
        <td class="cell"><b>Agama</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$religion?></td>
        </tr>
      <tr>
        <td class="cell"><b>Status</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$mar_status?></td>
        </tr>
      <tr>
        <td class="cell" valign="top"><b>Pendidikan Terakhir</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5">&nbsp;<?=$last_study?>&nbsp;<?=$course?></td>
        </tr>
      <tr>
        <td class="cell" valign="top"><b>Pengalaman Kerja</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5">&nbsp;<?=$pengalaman?></td>
        </tr>
      <tr>
        <td class="cell"><b>Kompensasi Terakhir</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$salary?></td>
        </tr>
      <tr>
        <td class="cell" valign="top"><b>Rencana Penempatan</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td align="right">Region</td>
            <td>:</td>
            <td>&nbsp;
                <?=$region_name?></td>
          </tr>
          <tr>
            <td align="right">Branch</td>
            <td>:</td>
            <td>&nbsp;
                <?=$branch_name?></td>
          </tr>
          <tr>
            <td align="right">Posisi</td>
            <td>:</td>
            <td>&nbsp;
                <?=$position_name?></td>
          </tr>
        </table></td>
        </tr>
      <tr>
	  <?
		$grouptest = cmsDB();
		$grouptest->query("select * from tbl_jobseeker_test_detail where jstest_id=".uriParam("jstest_id"));
		$rowspan = $grouptest->recordCount();
	  ?>
        <td class="cell" valign="top"><b>Hasil Test</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5">
        <table border="0" cellspacing="0" cellpadding="2">
          <? while($grouptest->next()){?>
          <tr>
            <td>&nbsp;<?=$grouptest->row("history_name")?></td>
            <td>:</td>
            <td>&nbsp;<?=$grouptest->row("test_result")?></td>
          </tr>
          <? } ?>
        </table></td>
        </tr>
      <tr>
        <td class="cell"><b>Wawancara&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; User</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$interview?></td>
        </tr>
      <tr>
        <td class="cell"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HRD</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$notes?></td>
        </tr>
      <tr>
        <td class="cell" valign="top"><b>Kompensasi yang direkomendasikan</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5">
        <table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td align="right">GP</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_gp" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
            <td align="right">T.Kemahalan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_kemahalan" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
          </tr>
          <tr>
            <td align="right">Transport</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_transport" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
            <td align="right">T.Perumahan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_perumahan" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
          </tr>
          <tr>
            <td align="right">Makan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_makan" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
            <td align="right">COP</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_cop" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
          </tr>
          <tr>
            <td align="right">T.Jabatan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_jabatan" size="20" value="0" onKeyPress="return handleEnter(this, event, 4)"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      
      <tr>
        <td class="cell"><b>Grade/Golongan</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$gol_name?></td>
        </tr>
      <tr>
        <td class="cell"><b>Status Pegawai</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$employee_status?></td>
        </tr>
      <tr>
        <td colspan="7" class="cell">&nbsp;</td>
        </tr>
      <tr>
        <td class="cell"><b>PJS</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<input type="text" name="pjs1" size="40" value="<?=$pjs1?>" /></td>
        </tr>
      <tr>
        <td class="cell"><b>PinBag</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<input type="text" name="pjs2" size="40" value="<?=$pjs2?>" /></td>
        </tr>
      <tr>
        <td colspan="7" class="cell" align="center"><input type="Button" value="Create IP" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.ip_no,sample_form.tanggal_start,sample_form.bulan_start,sample_form.tahun_start,sample_form.tanggal_from,sample_form.bulan_from,sample_form.tahun_from,sample_form.tanggal_to,sample_form.bulan_to,sample_form.tahun_to,sample_form.txt_gp,sample_form.txt_kemahalan,sample_form.txt_transport,sample_form.txt_perumahan,sample_form.txt_makan,sample_form.txt_cop,sample_form.txt_jabatan','save_ip=yes&jstest_id=<?=uriParam("jstest_id")?>&refresh=<?=md5("mdYHis")?>')">&nbsp;
				<input type="Button" value="Cancel" onclick="get_method('templates/ip/index.php?refresh=<?=md5(date("mdYHis"))?>')">
				</b></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
<script>
function Check() {
     var errmsg='';
	 ip_no=document.sample_form.ip_no.value;
	 if (ip_no.length == 0) errmsg +='Nomor Ijin Prinsip Wajib Diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>
