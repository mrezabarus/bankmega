<?
require_once("../../config.php");
if(isset($_GET["save"])){
	//echo postParam("selstatus");die();
	$insert=cmsDB();
	$jstest = cmsDB();
	$jstest->query("select js_id from tbl_jobseeker_test where jstest_id=".uriParam("jstest_id"));
	$jstest->next();
	$seljobseeker=$jstest->row("js_id");
	if(postParam("selstatus")=="passed"){
		$insert->query("update tbl_jobseeker_test set test_status='passed',test_status_id='0' where jstest_id=".uriParam("jstest_id"));
		$insert->query("update tbl_jobseeker set avail_status='recruitment passed' where js_id=".$seljobseeker);
	}elseif(postParam("selstatus")=="failed"){
		$insert->query("update tbl_jobseeker_test set test_status='failed',test_status_id='1' where jstest_id=".uriParam("jstest_id"));
		$insert->query("update tbl_jobseeker set avail_status='recruitment failed' where js_id=".$seljobseeker);
	}else{
		echo "Unknown Error!!";die();
	}
	
	echo "<script>location='index.php?refresh=".md5("mdYHis")."';</script>";
	die();
}

if(isset($_GET["save_ip"])){
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
	if($jobseeker->row("mar_status")=="s"){
		$mar_status = "Belum Menikah";
	}else{
		$mar_status = "Menikah";
	}
	$last_salary = $jobseeker->row("last_salary");
	
	
	$branch = cmsDB();
	$strsql = "select tbl_region.region_name,tbl_branch.branch_name 
				from tbl_branch 
				inner join tbl_region on tbl_branch.region_id=tbl_region.region_id 
				where tbl_branch.branch_id=".$branch_id;
	$branch->query($strsql);
	$branch->next();
	$region_name = $branch->row("region_name");
	$branch_name = $branch->row("branch_name");

	$insert=cmsDB();
	if($employee_status=="contract" || $employee_status=="outsource"){
				$txt_startdate = postParam("tahun_from") ."-".postParam("bulan_from")."-".postParam("tanggal_from")." 00:00:00";
				$txt_enddate = postParam("tahun_to") ."-".postParam("bulan_to")."-".postParam("tanggal_to")." 00:00:00";
				$working_start = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
				$strsql = "insert into tbl_ijin_prinsip(ip_no,ip_date,user_id,ip_approver,approved_date,ip_file,ip_status,ip_duration_start,ip_duration_end,working_status,last_compensation,
							rencana_penempatan,comp_gp,comp_transport,comp_makan,comp_tjabatan,comp_kemahalan,comp_rumah,comp_cop,golongan,employee_status,start_date,jstest_id) values(
							'".postParam("txt_ipno")."','".date("Y-m-d H:i:s")."',".$_SESSION["user_id" . date("mdY")].",'','','','new','".$txt_startdate."','".$txt_enddate."','".$employee_status."','".$last_salary."',
							'".$region_name ."-". $branch_name."','".postParam("txt_gp")."','".postParam("txt_transport")."','".postParam("txt_makan")."','".postParam("txt_jabatan")."','".postParam("txt_kemahalan")."','".postParam("txt_perumahan")."','".postParam("txt_cop")."','".$gol_name."','','".$working_start."',".uriParam("jstest_id")."
							)
							";
				//$insert->query($strsql)
				echo $strsql;die();
	}else{
				$txt_startdate = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
				$txt_enddate = postParam("tahun_to") ."-".postParam("bulan_to")."-".postParam("tanggal_to")." 00:00:00";
				$working_start = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
				$strsql = "insert into tbl_ijin_prinsip(ip_no,ip_date,user_id,ip_approver,approved_date,ip_file,ip_status,ip_duration_start,ip_duration_end,working_status,last_compensation,
							rencana_penempatan,comp_gp,comp_transport,comp_makan,comp_tjabatan,comp_kemahalan,comp_rumah,comp_cop,golongan,employee_status,start_date,jstest_id) values(
							'".postParam("txt_ipno")."','".date("Y-m-d H:i:s")."',".$_SESSION["user_id" . date("mdY")].",'','','','new','".$txt_startdate."','".$txt_enddate."','".$employee_status."','".$last_salary."',
							'".$region_name ."-". $branch_name."','".postParam("txt_gp")."','".postParam("txt_transport")."','".postParam("txt_makan")."','".postParam("txt_jabatan")."','".postParam("txt_kemahalan")."','".postParam("txt_perumahan")."','".postParam("txt_cop")."','".$gol_name."','','".$working_start."',".uriParam("jstest_id")."
							)
							";
				$insert->query($strsql);
				//$insert->query("update tbl_jobseeker_test set test_status='passed' where jstest_id=".uriParam("jstest_id"));
				//$insert->query("update tbl_jobseeker set avail_status='recruitment passed' where js_id=".$seljobseeker);
				echo "<SCRIPT>alert('Ijin Prinsip Saved!!');location='index.php?refresh=".md5("mdY His")."';</SCRIPT>";
				echo $strsql;die();
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
	if($jobseeker->row("mar_status")=="s"){
		$mar_status = "Belum Menikah";
	}else{
		$mar_status = "Menikah";
	}
	$last_salary = $jobseeker->row("last_salary");
	$jobseeker->query("select * from tbl_jobseeker_formal_edu where js_id=".$seljobseeker . " order by formaledu_id desc");
	$pendidikan = "";
	while($jobseeker->next()){
		if(strlen(trim($jobseeker->row("formal_name")))==0){
			break;
		}else{
			$pendidikan = $jobseeker->row("formal_level") .", ".$jobseeker->row("formal_name"). " Jurusan : ". $jobseeker->row("major");
		}
	}
	
	$jobseeker->query("select * from tbl_jobseeker_jobexp where js_id=".$seljobseeker . " order by jsjobexp_id asc");
	$pengalaman = "";
	while($jobseeker->next()){
		if(strlen(trim($jobseeker->row("comp_name")))<>0){
			$pengalaman = $pengalaman."- ".$jobseeker->row("comp_name") .", Jabatan : ".$jobseeker->row("job_title"). ",  Masa Kerja : ". $jobseeker->row("working_duration")."<BR>";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form name="frmip" method="post" action="create_ip.php?save_ip=yes&jstest_id=<?=uriParam("jstest_id")?>">
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
        <td width="68%" colspan="5">&nbsp;<b><input type="Text" name="txt_ipno" value="--/HCMD-IP/07" id="txt_ipno" size="50"></b></td>
        </tr>
      <tr>
        <td class="cell"><b>Working Start</b></td>
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
			        <? for($i=2000;$i<=2020;$i++){?>
			        <option value="<?=$i?>" <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
        </tr>
      <? if($employee_status=="contract" || $employee_status=="outsource"){?>
      <tr>
        <td class="cell"><b>Duration From</b></td>
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
			        <? for($i=2000;$i<=2020;$i++){?>
			        <option value="<?=$i?>"  <? if($i=="$thn"){ echo "selected";}?>><?=$i?></option>
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
			        <? for($i=2000;$i<=2020;$i++){?>
			        <option value="<?=$i?>"  <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
      </tr>
      <? }else{?>  
      <tr>
        <td class="cell"><b>Probation Date Till</b></td>
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
			        <? for($i=2000;$i<=2020;$i++){?>
			        <option value="<?=$i?>"  <? if($i=="$thn_to"){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
      </tr>
      <? } ?>
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
        <td colspan="5">&nbsp;<?=$phone?></td>
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
        <td colspan="5">&nbsp;<?=$pendidikan?></td>
        </tr>
      <tr>
        <td class="cell" valign="top"><b>Pengalaman Kerja</b></td>
        <td valign="top"><b>:</b></td>
        <td colspan="5">&nbsp;<?=$pengalaman?></td>
        </tr>
      <tr>
        <td class="cell"><b>Kompensasi Terakhir</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$last_salary?></td>
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
            <td>&nbsp;<input type="Text" name="txt_gp" size="20" value="0"></td>
            <td align="right">T.Kemahalan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_kemahalan" size="20" value="0"></td>
          </tr>
          <tr>
            <td align="right">Transport</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_transport" size="20" value="0"></td>
            <td align="right">T.Perumahan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_perumahan" size="20" value="0"></td>
          </tr>
          <tr>
            <td align="right">Makan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_makan" size="20" value="0"></td>
            <td align="right">COP</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_cop" size="20" value="0"></td>
          </tr>
          <tr>
            <td align="right">T.Jabatan</td>
            <td>:</td>
            <td>&nbsp;<input type="Text" name="txt_jabatan" size="20" value="0"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      
      <tr>
        <td class="cell"><b>Pangkat/Golongan</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$gol_name?></td>
        </tr>
      <tr>
        <td class="cell"><b>Status Pegawai</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$employee_status?></td>
        </tr>
      <tr>
        <td colspan="7" class="cell" align="center"><input type="Button" value="Create IP" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txt_ipno,sample_form.tanggal_start,sample_form.bulan_start,sample_form.tahun_start,sample_form.tanggal_from,sample_form.bulan_from,sample_form.tahun_from,sample_form.tanggal_to,sample_form.bulan_to,sample_form.tahun_to,sample_form.txt_gp,sample_form.txt_kemahalan,sample_form.txt_transport,sample_form.txt_perumahan,sample_form.txt_makan,sample_form.txt_cop,sample_form.txt_jabatan','save_ip=yes&jstest_id=<?=uriParam("jstest_id")?>&refresh=<?=md5("mdYHis")?>')">&nbsp;
				<input type="Button" value="Cancel" onclick="get_method('templates/ip/index.php?refresh=<?=md5(date("mdYHis"))?>')">
				</b></td>
        </tr>
    </table></td>
  </tr>
</table>
  </form>
</body>
</html>