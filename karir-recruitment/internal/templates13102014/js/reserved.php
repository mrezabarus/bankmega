<?
	require_once("../../config.php");
	$position=cmsDB();
	if(isset($_GET["reserve"])){
			$strsql = "SELECT tbl_branch_mpp_apply.*,tbl_position_vacant.vacantpos_id,tbl_branch.branch_name,
			                  tbl_region.region_name,tbl_golongan.name,tbl_position.position_id,tbl_position.position_name 
						FROM tbl_branch_mpp_apply 
						INNER JOIN tbl_position_vacant on tbl_branch_mpp_apply.mpppos_id=tbl_position_vacant.mpppos_id 
						INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
						INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
						INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
						INNER JOIN tbl_position on tbl_branch_mpp_apply.position_id = tbl_position.position_id
						where tbl_branch_mpp_apply.request_status='approved' and tbl_position_vacant.vacantpos_id=".$_POST["selposition"];
			$position->query($strsql);
			$position->next();
			$qty_check = $position->row("qty_tmp")-1;
			$mpppos_id = $position->row("mpppos_id");
	
		$position->query("update tbl_branch_mpp_apply set qty_tmp=".$qty_check." where request_status='approved' and mpppos_id=".$mpppos_id."");
		$position->query("update tbl_jobseeker set avail_status='reserved' where js_id=".uriParam("js_id"));
		$position->query("insert into tbl_vacantpos_jobseeker(js_id,vacantpos_id,apply_date) values(".uriParam("js_id").",".postParam("selposition").",'".date("Y-m-d H:i:s")."')");
		echo "<script>alert('Job Seeker Reserved!!');location='edit.php?edit=yes&js_id=".uriParam("js_id")."';</script>";
		die();
	}

	if(isset($_POST["selposition"])){
		$selpos = $_POST["selposition"];
	}else{
		$selpos = 0;
	}
	
	if(isset($_POST["selposition"])){
			$strsql = "SELECT tbl_branch_mpp_apply.*,tbl_position_vacant.vacantpos_id,tbl_branch.branch_name,
			                  tbl_region.region_name,tbl_golongan.name,tbl_position.position_id,tbl_position.position_name 
						FROM tbl_branch_mpp_apply 
						INNER JOIN tbl_position_vacant on tbl_branch_mpp_apply.mpppos_id=tbl_position_vacant.mpppos_id 
						INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
						INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
						INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
						INNER JOIN tbl_position on tbl_branch_mpp_apply.position_id = tbl_position.position_id
						where tbl_branch_mpp_apply.request_status='approved' and tbl_position_vacant.vacantpos_id=".$_POST["selposition"];
			$position->query($strsql);
			$position->next();
			$qty_check = $position->row("qty_tmp");
			$region = $position->row("region_name");
			$branch = $position->row("branch_name");
			$grade = $position->row("name");
			$dateline = $position->row("month_dateline");
	}else{
			$region = "-";
			$branch = "-";
			$grade = "-";
			$dateline = "-";	
	}
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<SCRIPT language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>js_button.js" type=text/javascript></SCRIPT>
<SCRIPT language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js" type=text/javascript></SCRIPT>
<script>
function _selpos(){
	document.frmreserve.action="reserved.php?js_id=<?=uriParam("js_id")?>";
	document.frmreserve.submit();
}
</script>
<body topmargin="0">
<center><br>
<form action="reserved.php?reserve=yes&js_id=<?=uriParam("js_id")?>" name="frmreserve" method="post">
<table width="50%" style="border: 1 solid #003366" cellspacing="0" cellpadding="2">
  <tr>
    <td vAlign="top" align="left" colspan="3" class="tableheader"><font color="#FFFFFF"><b>Reserved
      Job Seeker For :</b></font></td>
  </tr>
  <tr>
      <td vAlign="top" align="right" width="189"  class="heading2"><b>Position</b></td>
	  <td width="5" vAlign="top" class="heading2"><b>:</b></td>
	  <?
	 $strsql = "SELECT tbl_branch_mpp_apply.*,tbl_position_vacant.vacantpos_id,tbl_branch.branch_name,
	 				   tbl_region.region_name,tbl_golongan.name,tbl_position.position_id,tbl_position.position_name 
				FROM tbl_branch_mpp_apply 
				INNER JOIN tbl_position_vacant on tbl_branch_mpp_apply.mpppos_id=tbl_position_vacant.mpppos_id 
				INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
				INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
				INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
				INNER JOIN tbl_position on tbl_branch_mpp_apply.position_id = tbl_position.position_id
				WHERE tbl_branch_mpp_apply.request_status='approved'
				AND (tbl_branch_mpp_apply.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")) 
				order by tbl_position.position_name,tbl_region.region_name,tbl_branch.branch_name asc";
				//echo $strsql;
				$position->query($strsql);
	  ?>
    <td vAlign="top" width="292" class="heading2">
		<select size="1" name="selposition" onChange="_selpos()">
			<option value="0" <? if($selpos==0){echo " selected";}?>>Select Position</option>
        <? while($position->next()){?>
     <? if($position->row("qty_tmp")==0){?>
      <? }else{ ?>
		    <option value="<?=$position->row("vacantpos_id")?>" <? if($selpos==$position->row("vacantpos_id")){echo " selected";}?>><?=$position->row("position_name")?> [<?=$position->row("qty")?> Orang Untuk : <?=$position->row("region_name")?>--<?=$position->row("branch_name")?>]</option>
      <? } ?>
		<? } ?>
      </select>
      </td>
  </tr>
  <tr>
      <td width="189" align="right" vAlign="top" class="heading2"><b>Region</b></td>
	  <td vAlign="top" class="heading2"><b>:</b></td>
      <td vAlign="top" width="292" class="heading2"><?=$region?></td>
  </tr>
  <tr>
      <td width="189" align="right" vAlign="top" class="heading2"><b>Cabang/Capem</b></td>
	  <td vAlign="top" class="heading2"><b>:</b></td>
      <td vAlign="top" width="292" class="heading2"><?=$branch?></td>
  </tr>
  <tr>
      <td width="189" align="right" vAlign="top" class="heading2"><b>Grade</b></td>
	  <td vAlign="top" class="heading2"><b>:</b></td>
      <td vAlign="top" width="292" class="heading2"><?=$grade?></td>
  </tr>
  <tr>
      <td width="189" align="right" vAlign="top" class="heading2"><b>Month Dateline</b></td>
	  <td vAlign="top" class="heading2"><b>:</b></td>
      <td vAlign="top" width="292" class="heading2"><?=$dateline?></td>
  </tr>
  <tr>
    <td vAlign="top" align="right" colspan="3" class="tableheader">
         <? if($selpos = $_POST["selposition"]){?>
    <input type="submit" value="Reserve Utk Posisi ini" name="B3">
      <? }else{ ?>
    <input type="submit" value="Reserve Utk Posisi ini" name="B3" disabled>
      <? } ?>
        <input type="button" value="Cancel" name="B3" onClick="location='edit.php?edit=yes&js_id=<?=uriParam("js_id")?>'">&nbsp;</td>
  </tr>
</table>
</form>
</center>
</BODY></HTML>
