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
	$position = cmsDB();
	$mpp->query("select distinct(year_date) as tahun from tbl_region_mpp");
	$region->query("select * from tbl_region order by region_name desc");
?><P></P>
<center>
<form action="" method="post" name="sample_form" id="sample_form">
<table border="1" width="38%" bgcolor="#006699" cellpadding="2" bordercolor="#FFFFFF">
  <tr>
    <td width="100%" align="center"><font color="#FFFFFF"><b>Ijin Prinsip
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
	  Sorry You Have No Ijin Prinsip..
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
$jstest=cmsDB();
$mpp_branch=cmsDB();
if($selregion=='none'){
		$strsql = "select * from tbl_ijin_prinsip where year(ip_date)=".postParam("sel_from");
	}else{
		$strsql = "select * from tbl_ijin_prinsip where year(ip_date)=".postParam("sel_from"). " 
				   and rencana_penempatan like '".$selregion."%'";
	}
	$mpp->query($strsql);
	$strsql2=$strsql;
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr bgcolor="#F0F0F0">
    <td align="center"><strong>No</strong></td>
    <td align="center"><strong>IP No</strong></td>
    <td align="center"><strong>Tgl Created IP</strong></td>
    <td align="center"><strong>Nama Jobseeker</strong></td>
    <td align="center"><b>Status</b></td>
    <td align="center"><strong>Posisi</strong></td>
    <td align="center"><strong>Rencana Penempatan</strong></td>
  </tr>
<?
if($mpp->recordCount()){
	$no = 1;
	while($mpp->next()){
			 $strsql = "select tbl_jobseeker.full_name,tbl_jobseeker_test.vacant_pos_id 
		               from tbl_jobseeker_test inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id 
					   where tbl_jobseeker_test.jstest_id=".$mpp->row("jstest_id");
			 $jstest->query($strsql);
             $jstest->next();
             $vacant_pos_id = $jstest->row("vacant_pos_id");
             $full_name = $jstest->row("full_name");
			   
			 $strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
						from tbl_position 
						inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
						inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
						where tbl_position_vacant.vacantpos_id=" . $vacant_pos_id;
						
			//if(isset($_SESSION["ssbranch_id" . date("mdY")])){
			//	$strsql = $strsql . " AND tbl_branch_mpp_apply.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
			//}
			
			//$strsql = $strsql . " ORDER BY tbl_branch.branch_name asc";
			
			$position->query($strsql);
			$position->next();
			$position_name = $position->row("position_name");
			$penempatan = $mpp->row("rencana_penempatan");
			$ip_status = $mpp->row("ip_status");
			

	?>
	  <tr>
	    <td align="center"><?=$no?>.</td>
	    <td align="left"><?=$mpp->row("ip_no")?></td>
	    <td align="center"><?=datesql2date($mpp->row("ip_date"))?></td>
	    <td align="left"><?=$full_name?></td>
	    <td align="center"><b><?
		if($mpp->row("ip_status")=="new"){
			echo "<font color=\"brown\">IP Proses</font>";
		}elseif($mpp->row("ip_status")=="approved"){
			echo "<font color=\"blue\">IP Approved</font>";
		}else{
			echo "<font color=\"red\">".$mpp->row("ip_status")."</font>";
		}
		?></b></td>
	    <td align="left"><?=$position_name?></td>
	    <td align="left"><?=$penempatan?></td>
	  </tr>
	 
	 <? 
	 	$no++;
	 }
 }else{?>
 	<tr>
		<td colspan="7" align="center"><em>No Record Found..</em></td>
	 </tr>
<? } ?>
</table>
<form name=frmsql method=post action="templates/report/ip_sum_pdf.php" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql2?>">
</form>
<? } ?>
</center>
