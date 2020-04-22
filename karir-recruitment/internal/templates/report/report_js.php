<?
	require_once("../../config.php");
	if(isset($_POST["save"])){
		$year_date = postParam("sel_from");
		$selregion = postParam("sel_region");
	}else{
		$year_date = date("Y");
		$selregion = "none";
	}
	$mpp = cmsDB();
	$region = cmsDB();
	$mpp->query("select distinct(year_date) as tahun from tbl_region_mpp");
	$region->query("select * from tbl_region order by region_name desc");
?><P></P>
<center>
<form action="" method="post" name="sample_form" id="sample_form">
<table border="1" width="38%" bgcolor="#006699" cellpadding="2" bordercolor="#FFFFFF">
  <tr>
    <td width="100%" align="center"><font color="#FFFFFF"><b>Job Seeker
      Report </b></font></td>
  </tr>
  <tr>
    <td width="100%" align="center" bgcolor="#FFFFFF">
	<? if($mpp->recordCount()){?>
	<b><font color="#006699">Year :</font></b>
	  <select size="1" name="sel_from">
	  <? while($mpp->next()){?>
	  	<option value="<?=$mpp->row("tahun")?>" <? if($year_date==$mpp->row("tahun")){echo " selected";}?>><?=$mpp->row("tahun")?></option>
	  <? } ?>
      </select>&nbsp;
	  <b><font color="#006699">Region :</font></b> 
	  <select size="1" name="sel_region">
	  	<option value="none"<? if($selregion==0){echo " selected";}?>>All Region</option>
	  <? while($region->next()){?>
	  	<option value="<?=$region->row("region_name")?>" <? if($selregion==$region->row("region_name")){echo " selected";}?>><?=$region->row("region_name")?></option>
	  <? } ?>
      </select>
      <p><input type="button" value="View Result" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.sel_from,sample_form.sel_region','save=yes&refresh=<?=md5("mdYHis")?>')"> 
	  <? }else{ ?>
	  Sorry You Have No Jobseeker Plan..
	  <? } ?>
	  <? if(isset($_POST["save"])){?>
	  	<input type="button" value="Print" name="B3" onclick="popwin('');document.frmsql.submit();">
	  <? } ?>
	  <input type="button" value="Cancel" name="B3" onclick="get_method('templates/report/index.php')"></p>
    </td>
  </tr>
</table>
</form>
<p></p>
<? if(isset($_POST["save"])){
	$mpp=cmsDB();
	$mpp_branch=cmsDB();
if($selregion=='none'){
	$strsql = "SELECT * FROM tbl_jobseeker 
			   WHERE (tbl_jobseeker.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")) 
			   AND year(join_date)=".postParam("sel_from")."
			   AND avail_status <> 'employee'
	           ORDER BY tbl_jobseeker.join_date desc";
}else{
	$strsql = "SELECT * FROM tbl_jobseeker
	           INNER JOIN tbl_branch ON tbl_branch.branch_id = tbl_jobseeker.branch_id
			   INNER JOIN tbl_region ON tbl_region.region_id = tbl_branch.region_id
	           WHERE (tbl_jobseeker.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")) 
			   AND year(join_date)=".postParam("sel_from"). "
			   AND avail_status <> 'employee' 
			   AND region_name like '".$selregion."%'
			   ORDER BY tbl_jobseeker.join_date desc";
}

    $mpp->query($strsql);
	?>
	<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
	  <tr bgcolor="#F0F0F0">
	    <td colspan="8" align="center"><b>Total Pelamar : <font color="green"><blink><? echo $tot = $mpp->recordCount();?></blink> Available</font></b></td>
      </tr>
	  <tr bgcolor="#F0F0F0">
	    <td align="center"><strong>No</strong></td>
	    <td align="center"><strong>Nama Lengkap</strong></td>
	    <td align="center"><strong>Jenis Kelamin</strong></td>
	    <td align="center"><strong>Tlp Rumah/Handphone</strong></td>
	    <td align="center"><strong>Tempat, Tgl Lahir</strong></td>
	    <td align="center"><strong>Status</strong></td>
	    <td align="center"><strong>Pekerjaan Terakhir</strong></td>
	    <td align="center"><strong>Tgl Register</strong></td>
	  </tr>
	<?
if($mpp->recordCount()){
		$no = 1;
		while($mpp->next()){
		$full_name = $mpp->row("full_name");
        $sex = $mpp->row("sex");
		$phone_no1 = $mpp->row("phone_no1");
		$phone_no2 = $mpp->row("phone_no2");
		$place_of_birth = $mpp->row("place_of_birth");
	    $date_of_birth = datesql2date($mpp->row("date_of_birth"));
		$avail_status = $mpp->row("avail_status");
		$apply_from = $mpp->row("apply_from");
		?>
		  <tr>
		    <td align="center"><?=$no?>.</td>
		    <td align="left"><?=$full_name?></td>
		    <td align="center"><?=$sex?></td>
		    <td align="left"><?=$phone_no1?>/<?=$phone_no2?></td>
		    <td align="left"><?=$place_of_birth?>, <?=$date_of_birth?></td>
		    <td align="center"><b><?
								if($mpp->row("avail_status")=="available"){
									echo "<font color=\"green\">Available</font>";
								}elseif($mpp->row("avail_status")=="employee"){
									echo "<font color=\"blue\">Employee</font>";
								}elseif($mpp->row("avail_status")=="recruitment passed"){
									echo "<font color=\"orange\">Recruitment Lulus</font>";
								}elseif($mpp->row("avail_status")=="recruitment process"){
									echo "<font color=\"brown\">Recruitment Proses</font>";
								}else{
									echo "<font color=\"red\">".$mpp->row("avail_status")."</font>";
								}
								?></b></td>
		    <td align="left"><?=$mpp->row("working_exp")?></td>
		    <td align="center"><?
			  if($mpp->row("apply_from") == "Web"){
			  echo "<center><b><font color=\"Blue\">".datesql2date($mpp->row("join_date"))."</font></b></center>";
			  }elseif($mpp->row("apply_from") =="internal"){
			  echo "<center><font color=\"Black\">".datesql2date($mpp->row("join_date"))."</font></center>";
			  }
			?></td>
	  </tr>
		 <? $no++;
			 }
		}else{ ?>
 	<tr>
		<td colspan="8" align="center"><em>No Record Found..</em></td>
	 </tr>
<? } ?>
</table>
<form name=frmsql method=post action="templates/report/js_sum_pdf.php" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql?>">
</form>
<? } ?>
</center>
