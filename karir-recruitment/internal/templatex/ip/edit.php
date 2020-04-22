<?
require_once("../../config.php");
if(isset($_POST["save_ip"])){
	$jstest = cmsDB();
	$jstest->query("select * from tbl_ijin_prinsip where ip_id=".postParam("ip_id"));
	$jstest->next();
	$jstest_id = $jstest->row("jstest_id");
    $pjs1 = $jstest->row("pjs1");
    $pjs2 = $jstest->row("pjs2");
	
	$jstest->query("select * from tbl_jobseeker_test where jstest_id=".$jstest_id);
	$jstest->next();
	$selposition=$jstest->row("vacant_pos_id");
	$seljobseeker=$jstest->row("js_id");
	$interview = $jstest->row("wawancara_user");
	$ip_status = $jstest->row("ip_status");
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
    $last_study = $jobseeker->row("last_study");
	
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
	}else{
				$txt_startdate = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
				$txt_enddate = postParam("tahun_to") ."-".postParam("bulan_to")."-".postParam("tanggal_to")." 00:00:00";
				$working_start = postParam("tahun_start") ."-".postParam("bulan_start")."-".postParam("tanggal_start")." 00:00:00";
	}
	$strsql = "update tbl_ijin_prinsip set ip_no='".postParam("ip_no")."',ip_date='".date("Y-m-d H:i:s")."',user_id=".$_SESSION["user_id" . date("mdY")].",
ip_approver='',approved_date=now(),ip_file='',ip_status='new',ip_duration_start='".$txt_startdate."',ip_duration_end='".$txt_enddate."',working_status='".$employee_status."',
			last_compensation='".$last_salary."',rencana_penempatan='".$region_name ."-". $branch_name."',NIP='".postParam("NIP")."',
			comp_gp='".postParam("txt_gp")."',comp_transport='".postParam("txt_transport")."',comp_makan='".postParam("txt_makan")."',
			comp_tjabatan='".postParam("txt_jabatan")."',comp_kemahalan='".postParam("txt_kemahalan")."',comp_rumah='".postParam("txt_perumahan")."',
			comp_cop='".postParam("txt_cop")."',golongan='".$gol_name."',employee_status='',start_date='".$working_start."',
			pjs1='".postParam("pjs1")."',pjs2='".postParam("pjs2")."' 
			where ip_id=".postParam("ip_id");
	//echo $strsql;die();
	$insert->query($strsql);
	header("Location: index.php?refresh=".md5("mdYHis")); 	
	die();
	
}
	$jstest = cmsDB();
	$jstest->query("select * from tbl_ijin_prinsip where ip_id=".uriParam("ip_id"));
	$jstest->next();
	$jstest_id = $jstest->row("jstest_id");
	$ip_no = $jstest->row("ip_no");
	$ip_status = $jstest->row("ip_status");	
	$NIP = $jstest->row("NIP");
    $pjs1 = $jstest->row("pjs1");
    $pjs2 = $jstest->row("pjs2");

	$txt_gp = $jstest->row("comp_gp");
	$txt_transport = $jstest->row("comp_transport");
	$txt_makan = $jstest->row("comp_makan");
	$txt_jabatan = $jstest->row("comp_tjabatan");
	$txt_kemahalan = $jstest->row("comp_kemahalan");
	$txt_perumahan = $jstest->row("comp_rumah");
	$txt_cop = $jstest->row("comp_cop");
	$ip_date = $jstest->row("ip_date");
	$start_date = listGetAt($jstest->row("start_date"),1," ");
	$tanggal_start = listGetAt($start_date,3,"-");
	$bulan_start = listGetAt($start_date,2,"-");
	$tahun_start = listGetAt($start_date,1,"-");
	
	$start_from = listGetAt($jstest->row("ip_duration_start"),1," ");
	$tanggal_from = listGetAt($start_from,3,"-");
	$bulan_from = listGetAt($start_from,2,"-");
	$tahun_from = listGetAt($start_from,1,"-");
	
	$start_to = listGetAt($jstest->row("ip_duration_end"),1," ");
	$tanggal_to = listGetAt($start_to,3,"-");
	$bulan_to = listGetAt($start_to,2,"-");
	$tahun_to = listGetAt($start_to,1,"-");
	
	$jstest->query("select * from tbl_jobseeker_test where jstest_id=".$jstest_id);
	$jstest->next();
	$selposition=$jstest->row("vacant_pos_id");
	$seljobseeker=$jstest->row("js_id");
	$interview = $jstest->row("wawancara_user");
	$notes = $jstest->row("wawancara_dhrm");
	$notes_all = $jstest->row("overall_test_desc");
	$test_no = $jstest->row("test_no");
	$test_status = $jstest->row("test_status");
	$last_salary = $jstest->row("last_salary");
    $last_study = $jstest->row("last_study");

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
	
	$jobseeker->query("select * from tbl_jobseeker_formal_edu where js_id=".$seljobseeker . " and certified='yes' order by formaledu_id desc limit 1");
	$jobseeker->next();
	$pendidikan = $jobseeker->row("formal_level") .", ".$jobseeker->row("formal_name"). ", Jurusan : ". $jobseeker->row("major");
	$pendidikan = strtoupper($pendidikan);
	/*
	$jobseeker->query("select * from tbl_jobseeker_formal_edu where js_id=".$seljobseeker . " order by formaledu_id desc");
	$pendidikan = "";
	while($jobseeker->next()){
		if(strlen(trim($jobseeker->row("formal_name")))==0){
			break;
		}else{
			$pendidikan = $jobseeker->row("formal_level") .", ".$jobseeker->row("formal_name"). " Jurusan : ". $jobseeker->row("major");
		}
	}
	*/
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<body>
<br />
<form method="post" name="sample_form" id="sample_form" enctype="multipart/form-data" onSubmit="return Checkip()">
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td align="center"><font size="5"><b>EDIT PERSETUJUAN PRINSIP PEGAWAI BARU</b></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="2">
      <tr>
        <td width="30%" class="cell"><b>Nomor Ijin Prinsip</b></td>
        <td width="2%"><b>:</b></td>
        <td width="68%" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><? if($ip_status=="approved"){?>
&nbsp;<b>
<?=$ip_no?>
</b>
<? }else{ ?>
<b>
<input type="Text" name="ip_no" size="40" value="<?=$ip_no?>" onKeyUp="this.value=this.value.toUpperCase()" onChange="GetId()" />
</b>
<? } ?></td>
            <td align="right" width="24%"><?=datesql2date($ip_date)?></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td class="cell"><b>Mulai Kerja</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><select name="tanggal_start">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i==$tanggal_start){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select>/<select name="bulan_start">
			        <option value="1" <? if($bulan_start==1){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bulan_start==2){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bulan_start==3){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bulan_start==4){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bulan_start==5){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bulan_start==6){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bulan_start==7){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bulan_start==8){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bulan_start==9){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bulan_start==10){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bulan_start==11){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bulan_start==12){ echo "selected";}?>>Dec</option>
		      </select>/<select name="tahun_start">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i==$tahun_start){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
        </tr>
      <? if($employee_status=="contract" || $employee_status=="outsource"){?>
      <tr>
        <td class="cell"><b>Duration Dari</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><select name="tanggal_from">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i==$tanggal_from){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select>/<select name="bulan_from">
			        <option value="1" <? if($bulan_from==1){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bulan_from==2){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bulan_from==3){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bulan_from==4){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bulan_from==5){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bulan_from==6){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bulan_from==7){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bulan_from==8){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bulan_from==9){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bulan_from==10){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bulan_from==11){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bulan_from==12){ echo "selected";}?>>Dec</option>
			      </select>/<select name="tahun_from">
			        <?for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i==$tahun_from){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select>
		          </b>Sampai : <b>
			    <select name="tanggal_to">
					<? for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <? if($i==$tanggal_to){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select>/<select name="bulan_to">
			        <option value="1" <? if($bulan_to==1){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bulan_to==2){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bulan_to==3){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bulan_to==4){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bulan_to==5){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bulan_to==6){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bulan_to==7){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bulan_to==8){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bulan_to==9){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bulan_to==10){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bulan_to==11){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bulan_to==12){ echo "selected";}?>>Dec</option>
			      </select>/<select name="tahun_to">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i==$tahun_to){ echo "selected";}?>><?=$i?></option>
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
			        <option value="<?=$i?>" <? if($i==$tanggal_to){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			    </select>/<select name="bulan_to">
			      <option value="1" <? if($bulan_to==1){ echo "selected";}?>>Jan</option>
			        <option value="2" <? if($bulan_to==2){ echo "selected";}?>>Feb</option>
			        <option value="3" <? if($bulan_to==3){ echo "selected";}?>>Mar</option>
			        <option value="4" <? if($bulan_to==4){ echo "selected";}?>>Apr</option>
			        <option value="5" <? if($bulan_to==5){ echo "selected";}?>>May</option>
			        <option value="6" <? if($bulan_to==6){ echo "selected";}?>>Jun</option>
			        <option value="7" <? if($bulan_to==7){ echo "selected";}?>>Jul</option>
			        <option value="8" <? if($bulan_to==8){ echo "selected";}?>>Aug</option>
			        <option value="9" <? if($bulan_to==9){ echo "selected";}?>>Sep</option>
			        <option value="10" <? if($bulan_to==10){ echo "selected";}?>>Oct</option>
			        <option value="11" <? if($bulan_to==11){ echo "selected";}?>>Nov</option>
			        <option value="12" <? if($bulan_to==12){ echo "selected";}?>>Dec</option>
			      </select>/<select name="tahun_to">
			        <? for($i=2000;$i<=2040;$i++){?>
			        <option value="<?=$i?>"  <? if($i==$tahun_to){ echo "selected";}?>><?=$i?></option>
					<? } ?>
			      </select></b></td>
      </tr>
      <? } ?>
      <tr>
        <td class="cell"><b>NIP</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<input type="text" name="NIP" size="20" value="<?=$NIP?>" onkeypress="return handleEnter(this, event, 4)" /></td>
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
        <td colspan="5">&nbsp;<?=$phone?> / <?=$hp?></td>
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
				$grouptest->query("select * from tbl_jobseeker_test_detail where jstest_id=".$jstest_id);
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
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_gp,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_gp" size="20" value="<?=$txt_gp?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
            <td align="right">T.Kemahalan</td>
            <td>:</td>
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_kemahalan,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_kemahalan" size="20" value="<?=$txt_kemahalan?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
          </tr>
          <tr>
            <td align="right">Transport</td>
            <td>:</td>
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_transport,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_transport" size="20" value="<?=$txt_transport?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
            <td align="right">T.Perumahan</td>
            <td>:</td>
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_perumahan,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_perumahan" size="20" value="<?=$txt_perumahan?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
          </tr>
          <tr>
            <td align="right">Makan</td>
            <td>:</td>
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_makan,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_makan" size="20" value="<?=$txt_makan?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
            <td align="right">COP</td>
            <td>:</td>
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_cop,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_cop" size="20" value="<?=$txt_cop?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
          </tr>
          <tr>
            <td align="right">T.Jabatan</td>
            <td>:</td>
            <td><? if($ip_status=="approved"){?>
            <?=number_format($txt_jabatan,0, '.', ',')?>
            <? }else{ ?>
            <input type="Text" name="txt_jabatan" size="20" value="<?=$txt_jabatan?>" onKeyPress="return handleEnter(this, event, 4)">
            <? } ?></td>
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
        <td colspan="7" class="cell">&nbsp;</td>
        </tr>
      <tr>
        <td class="cell"><b>PJS</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<input type="Text" name="pjs1" size="40" value="<?=$pjs1?>"></td>
        </tr>
      <tr>
        <td class="cell"><b>PinBag</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<input type="Text" name="pjs2" size="40" value="<?=$pjs2?>"></td>
        </tr>
      <tr>
        <td colspan="7" class="cell" align="center"><? if($ip_status=="new"){?>
		  		<? if(listFind($_SESSION["ss_id" . date("mdY")],"28")){?>
				<input type="Button" value="Update IP" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.ip_no,sample_form.tanggal_start,sample_form.bulan_start,sample_form.tahun_start,sample_form.tanggal_from,sample_form.bulan_from,sample_form.tahun_from,sample_form.tanggal_to,sample_form.bulan_to,sample_form.tahun_to,sample_form.txt_gp,sample_form.txt_kemahalan,sample_form.txt_transport,sample_form.txt_perumahan,sample_form.txt_makan,sample_form.txt_cop,sample_form.txt_jabatan,sample_form.NIP,sample_form.pjs1,sample_form.pjs2','save_ip=yes&ip_id=<?=uriParam("ip_id")?>&refresh=<?=md5("mdYHis")?>')">&nbsp;
				<? } ?>
				<? if(listFind($_SESSION["ss_id" . date("mdY")],"31")){?>
				<b><input type="Button" value="Approve IP" onclick="get_method('templates/ip/approve.php?ip_id=<?=uriParam("ip_id")?>&refresh=<?=md5(date("mdYHis"))?>')"></b>&nbsp;
				<? } 
			  	} ?>
				<? if(listFind($_SESSION["ss_id" . date("mdY")],"30") && (trim($ip_status) <> "approved")){?>
				<input type="Button" value="Delete IP" onclick="get_method('templates/ip/delete.php?ip_id=<?=uriParam("ip_id")?>&refresh=<?=md5(date("mdYHis"))?>')">&nbsp;
				<? } ?>
<input type="Button" value="Cancel" onclick="get_method('templates/ip/index.php?refresh=<?=md5(date("mdYHis"))?>')">
				</td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
<script>
function Checkip() {
     var errmsg='';
	 ip_no=document.sample_form.ip_no.value;
	 if (ip_no.length == 0) errmsg +='Nomor Ijin Prinsip Wajib Diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>