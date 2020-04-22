<?
	require_once("../../config.php");
	if(isset($_POST["save"])){
		$year_date = postParam("sel_from");
	}else{
		$year_date = date("Y");
	}
	$mpp=cmsDB();
	$mpp->query("select distinct(year_date) as tahun from tbl_region_mpp");
?><P></P>
<center>
<form action="" method="post" name="sample_form" id="sample_form">
<table border="1" width="38%" bgcolor="#006699" cellpadding="2" bordercolor="#FFFFFF">
  <tr>
    <td width="100%" align="center"><font color="#FFFFFF"><b>Man Power Planning
      Report </b></font></td>
  </tr> 
  <tr>
    <td width="100%" align="center" bgcolor="#FFFFFF">
	<? if($mpp->recordCount()){?>
	<b><font color="#006699">Start From </font></b>
	  <select size="1" name="sel_from">
	  <? while($mpp->next()){?>
	  	<option value="<?=$mpp->row("tahun")?>" <? if($year_date==$mpp->row("tahun")){echo " selected";}?>><?=$mpp->row("tahun")?></option>
	  <? } ?>
      </select> 
      <p><input type="button" value="View Result" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.sel_from','save=yes&refresh=<?=md5("mdYHis")?>')">
	  <? }else{ ?>
	  Sorry You Have No MPP Plan..
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
	$strsql = "SELECT tbl_region_mpp.*,tbl_region.region_name 
	           FROM tbl_region_mpp 
			   INNER JOIN tbl_region on tbl_region_mpp.region_id=tbl_region.region_id
			   WHERE tbl_region_mpp.year_date='".postParam("sel_from")."'";
	$mpp->query($strsql);
	$strsql2=$strsql;
	?>
	<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
	  <tr bgcolor="#F0F0F0">
	    <td width="5%" align="center"><b>No</b></td>
	    <td width="7%" align="center"><b>Years</b></td>
	    <td align="center"><b>Region</b></td>
	    <td width="13%" align="center"><b>MPP Apply</b></td>
	    <td width="16%" align="center"><b>MPP Approved</b></td>
	    <td width="16%" align="center"><b>MPP Achieved</b></td>
	  </tr>
	<?
if($mpp->recordCount()){
		$no = 1;
		while($mpp->next()){?>
		  <tr>
		    <td valign="top" align="center"><?=$no?>.</td>
		    <td valign="top" align="center"><?=$mpp->row("year_date")?></td>
		    <td align="left" valign="top"><?=$mpp->row("region_name")?>
			<?
			 $strsql = "SELECT tbl_branch_mpp_apply.mpppos_id,tbl_branch_mpp_apply.qty,tbl_branch.branch_name,tbl_position.position_name,tbl_golongan.name
			                     FROM tbl_branch_mpp_apply 
								 INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id
								 INNER JOIN tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id
								 INNER JOIN tbl_golongan ON tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
								 WHERE tbl_branch_mpp_apply.hacc_id=".$mpp->row("hacc_id")."";
								 
			if(isset($_SESSION["ssbranch_id" . date("mdY")])){
				$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
			}
			$strsql = $strsql . " ORDER BY tbl_branch.branch_name asc";	
				
			 $mpp_branch->query($strsql);
			 //echo $strsql;		 
			 $lstmpppos_id = "";
			 while($mpp_branch->next()){
			 	 $lstmpppos_id = listAppend($lstmpppos_id,$mpp_branch->row("mpppos_id"));
			 	echo "<br>- ".$mpp_branch->row("branch_name")." : <b><font color=\"green\">".$mpp_branch->row("qty")."</font> <font color=\"green\">".$mpp_branch->row("position_name")."</font></b> (Golongan : <b><font color=\"blue\">".$mpp_branch->row("name")."</font></b>)";
			 }
			 if(listLen($lstmpppos_id)==0){$lstmpppos_id=0;}
			 $mpp_branch->query("SELECT vacantpos_id 
			 					 FROM tbl_position_vacant 
								 WHERE mpppos_id in (".$lstmpppos_id.")");
			 $lstvacantpos_id = $mpp_branch->valueList("vacantpos_id");
			 
			 if(listLen($lstvacantpos_id)==0){$lstvacantpos_id=0;}
			 $mpp_branch->query("SELECT jstest_id 
			 					 FROM tbl_jobseeker_test 
								 WHERE vacant_pos_id in (".$lstvacantpos_id.")");
			 $lstjstest_id = $mpp_branch->valueList("jstest_id");
			 
			 if(listLen($lstjstest_id)==0){$lstjstest_id=0;}
			 $mpp_branch->query("SELECT tbl_ijin_prinsip.ip_id 
			 					 FROM tbl_ijin_prinsip 
								 INNER JOIN tbl_offering_letter on tbl_ijin_prinsip.ip_id = tbl_offering_letter.ip_id 
								 WHERE tbl_offering_letter.is_approved='yes' 
								 AND tbl_ijin_prinsip.jstest_id in (".$lstjstest_id.")");
			 $achieved = $mpp_branch->recordCount();
			?></td>
		    <td valign="top" align="center"><?=$mpp->row("hacc_val_apply")?></td>
		    <td valign="top" align="center"><?=$mpp->row("hacc_val_approve")?></td>
		    <td valign="top" align="center"><?=$achieved?></td>
	  </tr>
		 <? $no++;
	      }
        }else{?>
 	<tr>
		<td colspan="6" align="center"><em>No Record Found..</em></td>
	 </tr>
<? } ?>
</table>
<form name=frmsql method=post action="templates/report/report_mpp_pdf.php" target="WindowName">
	<input type="Hidden" name="strsql" value="<?=$strsql2?>">
</form>
<? } ?>
</center>
