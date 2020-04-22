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
    <td width="100%" align="center"><font color="#FFFFFF"><b>Recruitment Test
          Report</b></font></td>
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
	  Sorry You Have No Recruitment Test
	  <? } ?>
	  <? if(isset($_POST["save"])){?>
	  	<input type="button" value="Print" name="B3" onclick="popwin('');document.frmsql.submit();">
	  <?}?>
	  <input type="button" value="Cancel" name="B3" onclick="get_method('templates/report/index.php')"></p>
    </td>
  </tr>
</table>
</form>
<p></p>
<? if(isset($_POST["save"])){
$mpp=cmsDB();
$jstest=cmsDB();
$js=cmsDB();
$position=cmsDB();
$strsql = "select * from tbl_jobseeker_test where year(test_date)=".postParam("sel_from") . " order by jstest_id";

$mpp->query($strsql);
$strsql2=$strsql;
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr bgcolor="#F0F0F0">
    <td align="center"><strong>No</strong></td>
    <td align="center"><strong>Test No</strong></td>
    <td align="center"><strong>Jobseeker Name</strong></td>
	<td align="center"><strong>Position</strong></td>
    <td align="center"><strong>Status</strong></td>
    <td align="center"><strong>Region</strong></td>
    <td align="center"><strong>Branch</strong></td>
    <td align="center"><strong>Date</strong></td>
  </tr>
<?
if($mpp->recordCount()){
	$no = 1;
	while($mpp->next()){
			$strsql = "select full_name from tbl_jobseeker where js_id=".$mpp->row("js_id");
			$js->query($strsql);
			$js->next();
			$full_name = $js->row("full_name");
			$strsql = "select mpppos_id from tbl_position_vacant 
						where vacantpos_id=".$mpp->row("vacant_pos_id");
			//echo $strsql;die();
			$js->query($strsql);
			$js->next();
			$mpppos_id=$js->row("mpppos_id");
			
			$strsql = "select tbl_position.*,tbl_branch_mpp_apply.* from tbl_position  
						inner join tbl_branch_mpp_apply on tbl_position.position_id=tbl_branch_mpp_apply.position_id  
						where tbl_branch_mpp_apply.mpppos_id=".$mpppos_id;
			$js->query($strsql);
			$js->next();
			$position_name = $js->row("position_name");
			
			$strsql = "select tbl_branch.branch_name, tbl_region.region_name from tbl_branch 
						inner join tbl_region on tbl_branch.region_id = tbl_region.region_id 
						inner join tbl_branch_mpp_apply on tbl_branch.branch_id=tbl_branch_mpp_apply.branch_id 
						where tbl_branch_mpp_apply.mpppos_id=".$mpppos_id;
			if(isset($_SESSION["ssbranch_id" . date("mdY")])){
				$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
			}
			$strsql = $strsql . " ORDER BY tbl_branch.branch_name asc";	
			$js->query($strsql);
			$js->next();
			$branch_name = $js->row("branch_name");
			$region_name = $js->row("region_name");
			
			if(isset($_SESSION["ssbranch_id" . date("mdY")]) == $branch_name){
	?>
	  <tr>
	    <td align="center"><?=$no?>.</td>
	    <td align="left"><?=$mpp->row("test_no")?></td>
	    <td align="left"><?=$full_name?></td>
		<td align="left"><?=$position_name?></td>
	    <td align="center"><b><?
						if($mpp->row("test_status") == "passed"){
							echo "<center><font color=\"Blue\">Test Lulus</font></center>";
						}elseif($mpp->row("test_status") =="failed"){
							echo "<center><font color=\"red\">Test Gagal</font></center>";
						}else{
							echo "<center><font color=\"brown\">Test Process</font></center>";
						}?></b></td>
	    <td align="left"><?=$region_name?></td>
	    <td align="left"><?=$branch_name?></td>
	    <td align="center"><?=datesql2date($mpp->row("test_date"))?></td>
	  </tr>
	 <?
		}
	 	$no++;
	 }
 }else{?>
 	<tr>
		<td colspan="8" align="center"><em>No Record Found..</em></td>
	 </tr>
<? } ?>
</table>
<form name=frmsql method=post action="templates/report/rec_sum_pdf.php" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql2?>">
</form>
<? } ?>
</center>