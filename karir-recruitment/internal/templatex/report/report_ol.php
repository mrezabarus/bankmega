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
    <td width="100%" align="center"><font color="#FFFFFF"><b>Offering Letter
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
	  <p><input type="button" value="View Result" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.sel_from','save=yes&refresh=<?=md5("mdYHis")?>')">
	  <? }else{ ?>
	  Sorry You Have No Offering Letter Plan..
	  <? } ?>
	  <? if(isset($_POST["save"])){ ?>
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
$ip=cmsDB();
$position=cmsDB();
$strsql = "select * from tbl_offering_letter where year(ol_date)=".postParam("sel_from");
$mpp->query($strsql);
$strsql2=$strsql;
?>
<table border="1" width="100%" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr bgcolor="#F0F0F0">
    <td width="4%" align="center"><strong>No</strong></td>
    <td align="center"><strong>OL No</strong></td>
    <td align="center"><strong>Tgl Created OL</strong></td>
	<td align="center"><strong>IP No</strong></td>
    <td align="center"><strong>Nama Pelamar</strong></td>
    <td align="center"><strong>Posisi</strong></td>
    <td align="center"><strong>Penempatan</strong></td>
	<td align="center"><strong>Status</strong></td>
  </tr>
<?
if($mpp->recordCount()){
	$no = 1;
	while($mpp->next()){
			$ip->query("select * from tbl_ijin_prinsip where ip_id=".$mpp->row("ip_id"));
			$ip->next();
			$penempatan = $ip->row("rencana_penempatan");
			$ip_no = $ip->row("ip_no");
			
		 	$jstest->query("select tbl_jobseeker.full_name,tbl_jobseeker_test.vacant_pos_id 
			                from tbl_jobseeker_test 
							inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id 
							where tbl_jobseeker_test.jstest_id=".$ip->row("jstest_id"));
			$jstest->next();
			$vacant_pos_id = $jstest->row("vacant_pos_id");
			$full_name = $jstest->row("full_name");
			
			$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
						from tbl_position 
						inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
						inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
						where tbl_position_vacant.vacantpos_id=".$vacant_pos_id;
						
			$position->query($strsql);
			$position->next();
			$position_name = $position->row("position_name");
	?>
	  <tr>
	    <td valign="top" align="center"><?=$no?>.</td>
	    <td valign="top" align="left"><?=$mpp->row("ol_no")?></td>
	    <td valign="top" align="center"><?=datesql2date($mpp->row("ol_date"))?></td>
		<td valign="top" align="left"><?=$ip_no?></td>
	    <td valign="top" align="left"><?=$full_name?></td>
	    <td valign="top" align="left"><?=$position_name?></td>
	    <td valign="top" align="left"><?=$penempatan?></td>
		<td valign="top" align="center"><b>
		<?
		if($mpp->row("is_approved")=='no'){
			echo "<font color=\"brown\">Pending</font>";
		}elseif($mpp->row("is_approved")=='yes'){
			echo "<font color=\"green\">Berhasil</font>";
		}else{
			echo "<font color=\"red\">Batal</font>";
		}
		?></b></td>
	  </tr>
	 
	 <?
	 	$no++;
	 }
 }else{ ?>
 	<tr>
		<td colspan="8" align="center"><em>No Record Found..</em></td>
	 </tr>
<? } ?>
</table>
<form name=frmsql method=post action="templates/report/ol_sum_pdf.php" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql2?>">
</form>
<? } ?>
</center>