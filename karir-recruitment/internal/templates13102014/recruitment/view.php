<?
	require_once("../../config.php");
	
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
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<body topmargin="0">
<FORM name="frmtest" action="new.php?save=yes" method="post" enctype="multipart/form-data">
<table style="HEIGHT: 148px" cellSpacing=0 cellPadding=0 width="100%" border=0>  
  <tr>
    <td vAlign=top height=148>
      <table width="100%">
        <tr>
          <td width="100%">
            <table cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
              <tr>
                <td vAlign=top align=left width="100%">
                  <table cellSpacing=1 cellPadding=1 width="100%" border=0>
                    <tr>
                      <td vAlign=top>
                        <table class=heading2 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                          <tr>
                            <td class=tableheader><!--- HEADER --->
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td class=tableheader>Preview &nbsp;Recruitment
                                  Test
                                </td>
                                <td align=right>
                                <table width=0>
                                <tr>
                                <td>
                                &nbsp;&nbsp; 
                                </td></tr></table></td></tr></table></td></tr>
                          <tr>
                            <td>
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td style="HEIGHT: 1px">
                                <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
                                </tr>
                                <tr>
                                <td style="HEIGHT: 1px">
                                <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td>
								<!--- Menu --->
                                <!--- End Of Menu ---></td></tr></table></td></tr>
                          <tr>
                            <td>
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td style="HEIGHT: 1px">
                                <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
                                </tr>
                                <tr>
                                <td style="HEIGHT: 1px">
                                <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td class=heading2>
                              <table class=heading2 cellSpacing=1 cellPadding=1 width="100%" align=center border=0>
                                <!--- RecordList Field ---><!--- RecordList Field --->
                                  <tr>
                                    <td>
                                    <table border="0" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="4">
  <tr>
    <td width="20%" align="right">Posisi :</td>
    <td width="80%">
	
	 <?
	 $position=cmsDB();
	 $strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
				from tbl_position 
				inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
				inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
				where tbl_position_vacant.vacantpos_id=" . $selposition;
				//echo $strsql;
	$position->query($strsql);
	$position->next();
	$branch_id = $position->row("branch_id");
	echo $position->row("position_name");
	  ?>
	 </td>
  </tr>
 
  <tr>
    <td width="20%" align="right">Nama Jobseeker :</td>
    <td width="80%">
	<?
		$jobseeker = cmsDB();
		$jobseeker->query("select * from tbl_jobseeker where js_id=".$seljobseeker);
		$jobseeker->next();
		echo $jobseeker->row("full_name");
	?>
	</td>
  </tr>
   <tr>
    <td width="20%" align="right">Test No :</td>
    <td width="80%">
	<?=$test_no?>
	</td>
  </tr>
  <tr>
    <td width="20%" align="right">Region - Branch :</td>
    <td width="80%">
		<?
			$branch = cmsDB();
			$strsql = "SELECT tbl_region.region_name,tbl_branch.branch_name 
					   FROM tbl_branch 
					   INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
					   WHERE tbl_branch.branch_id=".$branch_id;
			$branch->query($strsql);
			$branch->next();
			echo $branch->row("region_name")." - ".$branch->row("branch_name");
		?>
	</td>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">User Interview : </td>
    <td width="80%" valign="top">
		<?=$interview?>
		
	</td>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">HRD Interview : </td>
    <td width="80%" valign="top">
	<?=$notes?>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">Catatan Seluruh Test : </td>
    <td width="80%" valign="top">
	<?=$notes_all?>
  </tr>
  <tr>
    <td width="100%" colspan="2" align="center">
	<hr size="1">
	<? if(listFind($_SESSION["ss_id" . date("mdY")],"17") && ($test_status<>"passed" || $test_status<>"failed")){?>
		<input type="button" value="Edit Recruitment Test" name="B3" onClick="location='edit.php?jstest_id=<?=uriParam("jstest_id")?>'">&nbsp;
	<? } ?>
	<? if(listFind($_SESSION["ss_id" . date("mdY")],"20") && ($test_status<>"passed" || $test_status<>"failed")){?>
    <? if($test_status=="passed"){?>
	<? }else{?>
        <input type="button" value="Delete Recruitment Test" name="B3" onClick="location='delete.php?jstest_id=<?=uriParam("jstest_id")?>&js_id=<?=$seljobseeker?>'">&nbsp;
	<? } ?>
	<? } ?>
	      <input type="button" value="Cancel" name="B3" onClick="location='index.php'">
	 <hr size="1">
	
   </td>
  </tr>
</table>
<?
	$grouptest = cmsDB();
	$strsql = "select tbl_grouptest.* 
				from tbl_grouptest 
				inner join tbl_branch_mpp_apply on tbl_grouptest.grouptest_id = tbl_branch_mpp_apply.grouptest_id 
				inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
				where tbl_position_vacant.vacantpos_id=" . $selposition;
				
	$grouptest->query($strsql);
	$grouptest->next();
	$group_name = $grouptest->row("grouptest_name");
	$min_a = $grouptest->row("min_a");
	$min_b = $grouptest->row("min_b");
	$min_c = $grouptest->row("min_c");
	$min_d = $grouptest->row("min_d");
	$grouptest->query("select * from tbl_jobseeker_test_detail where jstest_id=".uriParam("jstest_id"));
?>
<table border="1" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="2">
  <tr>
    <td width="100%" colspan="7" class="tableheader"><font color="#FFFFFF"><b>Test Detail Untuk  : <?=$group_name?></b></font></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="1" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="2">
        <tr>
          <td width="5%" align="center">No</td>
          <td width="10%" align="center">Code</td>
		  <td width="25%" align="center">Nama Test</td>
		  <!-- td width="5%" align="center">Bobot</td -->
          <td width="30%" align="center">Keterangan</td>
          <td width="5%" align="center">Hasil Test</td>
          <td width="20%" align="center">Attachment Doc Pendukung</td>
        </tr>
		<? if($grouptest->recordCount()){
			$no=0;
			while($grouptest->next()){
			$no++;
            $score_temp = ($grouptest->row("history_bobot")/100) * $grouptest->row("test_result");
			$score = $score + $score_temp / 2.5;
		?>
        <tr>
          <td align="right" bgcolor="#FFFFFF" valign="top"><?=$no?>.</td>
          <td bgcolor="#FFFFFF" valign="top"><?=$grouptest->row("history_code")?></td>
          <td bgcolor="#FFFFFF" valign="top"><?=$grouptest->row("history_name")?></td>
		  <!-- td bgcolor="#FFFFFF" valign="top" align="center"><?=$grouptest->row("history_bobot")?> %</td -->
          <td bgcolor="#FFFFFF" valign="top"><?=$grouptest->row("test_desc")?></td>
          <td align="center" bgcolor="#FFFFFF" valign="top"><?=$grouptest->row("test_result")?></td>
          <td bgcolor="#FFFFFF" valign="top" align="center">
          <?
		if (strlen($grouptest->row("test_file") <> 0)) { 
			?>
			<a href="javascript:window.open('<?=$ANOM_VARS["www_img_url"]?>test_photo/<?=$grouptest->row("test_file")?>','frmnew','width=800,height=600,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes');void null;"><img src="file.jpg" width=20></img></a>
			<? 
		} else {
			echo "-";
		}
	 ?>
	</td>
        </tr>
		<?	
			}
		}else{?>
			<tr>
			  <td colspan=7 align="center" bgcolor="#FFFFFF" valign="top">No Test Found</td>
			 
			</tr>
		<?}?>
       <tr>
		<td width="100%" colspan="7" class="tableheader">&nbsp;</td>
	  </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%"align="center" bgcolor="#FFFFFF">
      <table align="center" border="1" cellspacing="0" cellpadding="2">
        <tr>
          <!-- td colspan="3" class="tableheader"><b>Nilai : </b><?=$score?></b></td -->
        </tr>
        <tr>
          <!-- td width="71"><font color="#008000"><b>[<?=$min_b+1?>&nbsp;-&nbsp;<?=$min_a?>]</b></font></td -->
          <!-- td width="232">&nbsp;<font color="#008000"><b>Lulus (A)</b></font></td -->
          <td width="232" rowspan="4"><?
if($test_status == "passed"){
    echo "<center><font size=\"+1\">Kandidat Test: </font><font color=\"green\" size=\"+1\">Lulus</font></center>";
}elseif($test_status =="failed"){
    echo "<center><font size=\"+1\">Kandidat Test: </font><font color=\"red\" size=\"+1\">Gagal</font></center>";
}?></td>
        </tr>
        <tr>
          <!-- td><font color="#008000"><b>[<?=$min_c+1?>&nbsp;-&nbsp;<?=$min_b?>]</b></font></td -->
          <!-- td>&nbsp;<font color="#008000"><b>Lulus (B)</b></font></td -->
          </tr>
        <tr>
          <!-- td><font color="#008000"><b>[<?=$min_d+1?>&nbsp;-&nbsp;<?=$min_c?>]</b></font></td -->
          <!-- td>&nbsp;<font color="#008000"><b>Lulus (C)</b></font></td -->
          </tr>
        <tr>
          <!-- td><font color="#FF0000"><b>[0&nbsp;-&nbsp;<?=$min_d?>]</b></font></td -->
          <!-- td>&nbsp;<font color="#FF0000"><b>Gagal</b></font></td -->
          </tr>
      </table></td>
  </tr>
  <tr>
    <td width="100%">
      <p align="center">
      </p>
    </td>
  </tr>
</table>
<input type="hidden" name="grouptest_id" value="<?=$grouptest_id?>">
</form>
</BODY>
</HTML>