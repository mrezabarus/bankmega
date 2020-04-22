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
    <td width="100%" align="center"><font color="#FFFFFF"><b>Vacancy
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
	  Sorry You Have No Vacancy Report...
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
	$strsql = "select tbl_branch_mpp_apply.*,tbl_branch.branch_name,
	                  tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
				from tbl_branch_mpp_apply 
				inner join tbl_region_mpp on tbl_region_mpp.hacc_id=tbl_branch_mpp_apply.hacc_id 
				inner join tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
				inner join tbl_region on tbl_branch.region_id=tbl_region.region_id  
				inner join tbl_golongan on tbl_golongan.gol_id=tbl_branch_mpp_apply.gol_id 
				inner join tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id 
				where tbl_region_mpp.year_date='".postParam("sel_from")."'";
}else{
	$strsql = "select tbl_branch_mpp_apply.*,tbl_branch.branch_name,
	                  tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
				from tbl_branch_mpp_apply 
				inner join tbl_region_mpp on tbl_region_mpp.hacc_id=tbl_branch_mpp_apply.hacc_id 
				inner join tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
				inner join tbl_region on tbl_branch.region_id=tbl_region.region_id  
				inner join tbl_golongan on tbl_golongan.gol_id=tbl_branch_mpp_apply.gol_id 
				inner join tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id 
				where tbl_region_mpp.year_date='".postParam("sel_from")."' and region_name like '".$selregion."%'";
}
	if(isset($_SESSION["ssbranch_id" . date("mdY")])){
		$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
	}
	$strsql = $strsql . " ORDER BY tbl_branch.branch_name asc";
	
$mpp->query($strsql);
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr bgcolor="#F0F0F0">
    <td align="center"><b>No</b></td>
    <td align="center"><b>Position (Qty)</b></td>
    <td align="center"><b>Region</b></td>
    <td align="center"><b>Branch</b></td>
    <td align="center"><b>Grade</b></td>
    <td align="center"><b>Status</b></td>
    <td align="center"><b>Tanggal Approved</b></td>
    <td align="center"><b>Bulan Expired</b></td>
  </tr>
<?
if($mpp->recordCount()){
	$no = 1;
	while($mpp->next()){?>
	  <tr>
	    <td valign="top" align="center"><?=$no?>.</td>
	    <td valign="top" align="left"><?=$mpp->row("position_name")?>
	      &nbsp;(
	      <?=$mpp->row("qty")?>
        )</td>
	    <td valign="top" align="left"><?=$mpp->row("region_name")?></td>
	    <td valign="top" align="left"><?=$mpp->row("branch_name")?></td>
	    <td valign="top" align="center"><?=$mpp->row("name")?></td>
	    <td align="center" valign="top"><?=$mpp->row("request_status")?></td>
	    <td align="center" valign="top"><?=datesql2date($mpp->row("approve_date"))?></td>
	    <td align="center" valign="top"><? echo date("F",mktime (0,0,0,$mpp->row("month_dateline"),date("d"),  date("Y")));?></td>
	  </tr>
	 <?
	 	$no++;
	 }
 }else{?>
 	<tr>
		<td colspan="8" align="center"><em>No Record Found..</em></td>
	 </tr>
<? } ?>
</table>
<form name=frmsql method=post action="templates/report/vacan_sum_pdf.php" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql?>">
</form>
<? } ?>
</center>