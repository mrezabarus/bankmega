<?
require_once("../../config.php");

	$jstest = cmsDB();
	$jstest->query("select *,DATE_FORMAT(ip_date,'%d %M %Y') as ip_date from tbl_ijin_prinsip where ip_id=".uriParam("ip_id"));
	$jstest->next();
	$jstest_id = $jstest->row("jstest_id");
	$ip_no = $jstest->row("ip_no");
    $pjs1 = $jstest->row("pjs1");
    $pjs2 = $jstest->row("pjs2");
	
    $NIP = $jstest->row("NIP");
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
	$salary = "";
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
<body>
<br />
<form name="sample_form" method="post" action="create_ip.php?save_ip=yes&jstest_id=<?=$jstest_id?>">
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td align="center"><font size="5"><b>PREVIEW PERSETUJUAN PRINSIP PEGAWAI BARU</b></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="2">
      <tr>
        <td width="30%" class="cell"><b>Nomor Ijin Prinsip</b></td>
        <td width="2%"><b>:</b></td>
        <td width="68%" colspan="5">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="76%">&nbsp;<b><?=$ip_no?></b></td>
              <td align="right" width="24%"><?=$ip_date?></td>
            </tr>
          </table></td>
        </tr>
      <tr>
        <td class="cell"><b>Mulai Bekerja</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><?=$tanggal_start?>/<?=$bulan_start?>/<?=$tahun_start?></b></td>
        </tr>
      <? if($employee_status=="contract" || $employee_status=="outsource"){?>
      <tr>
        <td class="cell"><b>Durasi dari</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><?=$tanggal_from?>/<?=$bulan_from?>/<?=$tahun_from?>
		          </b>Sampai : <b><?=$tanggal_to?>/<?=$bulan_to?>/<?=$tahun_to?></b></td>
      </tr>
      <? }else{?>  
      <tr>
        <td class="cell"><b>Masa Percobaan Sampai</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<b><?=$tanggal_to?>/<?=$bulan_to?>/<?=$tahun_to?></b></td>
      </tr>
      <? } ?>
      <tr>
        <td class="cell"><b>NIP</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$NIP?></td>
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
              <td>&nbsp;<?=$region_name?></td>
            </tr>
            <tr>
              <td align="right">Branch</td>
              <td>:</td>
              <td>&nbsp;<?=$branch_name?></td>
            </tr>
            <tr>
              <td align="right">Posisi</td>
              <td>:</td>
              <td>&nbsp;<?=$position_name?></td>
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
            <td>&nbsp;<?=number_format($txt_gp,0, '.', ',')?></td>
            <td align="right">T.Kemahalan</td>
            <td>:</td>
            <td>&nbsp;<?=number_format($txt_kemahalan,0, '.', ',')?></td>
          </tr>
          <tr>
            <td align="right">Transport</td>
            <td>:</td>
            <td>&nbsp;<?=number_format($txt_transport,0, '.', ',')?></td>
            <td align="right">T.Perumahan</td>
            <td>:</td>
            <td>&nbsp;<?=number_format($txt_perumahan,0, '.', ',')?></td>
          </tr>
          <tr>
            <td align="right">Makan</td>
            <td>:</td>
            <td>&nbsp;<?=number_format($txt_makan,0, '.', ',')?></td>
            <td align="right">T.Lain-lain</td>
            <td>:</td>
            <td>&nbsp;<?=number_format($txt_cop,0, '.', ',')?></td>
          </tr>
          <tr>
            <td align="right">T.Jabatan</td>
            <td>:</td>
            <td>&nbsp;<?=number_format($txt_jabatan,0, '.', ',')?></td>
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
        <td colspan="5">&nbsp;<?=$pjs1?></td>
        </tr>
      <tr>
        <td class="cell"><b>PinBag</b></td>
        <td><b>:</b></td>
        <td colspan="5">&nbsp;<?=$pjs2?></td>
        </tr>
      <tr>
        <td colspan="7" class="cell" align="center"><? if(listFind($_SESSION["ss_id" . date("mdY")],"28")){ ?>
				<input type="Button" value="Edit IP" onclick="get_method('templates/ip/edit.php?ip_id=<?=uriParam("ip_id")?>&refresh=<?=md5(date("mdYHis"))?>')">&nbsp;
				<input type="Button" value="Print IP" onclick="popwin('');document.frmsql.submit();">&nbsp;
				<? } ?>
				<input type="Button" value="Cancel" onclick="get_method('templates/ip/index.php?refresh=<?=md5(date("mdYHis"))?>')">
				</td>
        </tr>
    </table></td>
  </tr>
</table>
</form>

<form name=frmsql method=post action="templates/ip/ip_pdf.php?ip_id=<?=uriParam("ip_id")?>" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql2?>">
</form>
</body>
</html>
