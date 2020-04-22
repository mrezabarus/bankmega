<?

	if(isset($_GET["save"])){
		require_once("../../config.php");
		$selposition=postParam("selposition");
		$seljobseeker = postParam("seljobseeker");
		$interview = postParam("interview");
		$notes = postParam("notes");
		$notes_all = postParam("notes_all");
		$test_no = postParam("test_no");
		$insert=cmsDB();
		$strsql = "update tbl_jobseeker_test set test_no='".$test_no."',wawancara_user='".$interview."',wawancara_dhrm='".$notes."',overall_test_desc='".$notes_all."',user_id=".$_SESSION["user_id" . date("mdY")]." where jstest_id=".uriParam("jstest_id"); 
		//echo $strsql;die();
		$insert->query($strsql);

		
		$insertdetail = cmsDB();
		$insert->query("select * from tbl_jobseeker_test_detail where jstest_id=".uriParam("jstest_id"));
		while($insert->next()){
			$file_name = "doc_".$insert->row("jstestdetail_id");
			$strsql = "update tbl_jobseeker_test_detail set test_desc='".postParam("desc_".$insert->row("jstestdetail_id"))."',test_result='".postParam("result_".$insert->row("jstestdetail_id"))."' where jstestdetail_id=". $insert->row("jstestdetail_id");
			$insertdetail->query($strsql);
			$nama_file = $insert->row("jstestdetail_id")."_". md5("mdYHis");
			$dirpath = $ANOM_VARS["www_img_path"] . "test_photo/";
			if(is_dir($dirpath)){
				if (is_uploaded_file($_FILES[$file_name]['tmp_name'])) {
					if(strtolower(listLast($_FILES[$file_name]['name'],".")) == "jpg" || strtolower(listLast($_FILES[$file_name]['name'],".")) == "gif" || strtolower(listLast($_FILES[$file_name]['name'],".")) == "bmp" || strtolower(listLast($_FILES[$file_name]['name'],".")) == "pdf" || strtolower(listLast($_FILES[$file_name]['name'],".")) == "gif"){
						$nama_file = $nama_file . "." . listLast($_FILES[$file_name]['name'],".");
						copy($_FILES[$file_name]['tmp_name'], $dirpath.$nama_file);
					}else{
						$nama_file = "";
					}
				}else{
					$nama_file = "";
				}
			}
			if(strlen($nama_file)<>0){
				$insertdetail->query("update tbl_jobseeker_test_detail set test_file='".$nama_file."' where jstestdetail_id=".$insert->row("jstestdetail_id"));
			}
			
		}
		echo "<script>alert('Recruitment Test Detail Updated!!');location='edit.php?jstest_id=".uriParam("jstest_id")."&refresh=".md5("mdYHis")."';</script>";
		die();
	}
	if(isset($_POST["selposition"])){
		$selposition=$_POST["selposition"];
		$jobseeker = cmsDB();
		$jobseeker->query("select js_id from tbl_jobseeker_test where vacant_pos_id=".$selposition);
		if($jobseeker->recordCount()){
			$lstjs = $jobseeker->valueList("js_id");
		}else{
			$lstjs = 0;
		}
		$strsql = "select js_id from tbl_vacantpos_jobseeker where js_id not in (".$lstjs.") and vacantpos_id=".$selposition;
		$jobseeker->query($strsql);
		if($jobseeker->recordCount()){
			$lstjobseeker = $jobseeker->valueList("js_id");
		}else{
			$lstjobseeker = 0;
		}
		$strsql = "select mpppos_id from tbl_position_vacant where vacantpos_id=".$selposition;
		$jobseeker->query($strsql);
		if($jobseeker->recordCount()){
			$jobseeker->next();
			$mpppos_id = $jobseeker->row("mpppos_id");
			$strsql = "select branch_id,grouptest_id from tbl_branch_mpp_apply where mpppos_id=".$mpppos_id;
			$jobseeker->query($strsql);
			if($jobseeker->recordCount()){
				$jobseeker->next();
				$branch_id = $jobseeker->row("branch_id");
				$grouptest_id = $jobseeker->row("grouptest_id");
			}else{
				$branch_id = 0;
				$grouptest_id = 0;
			}
		}else{
			$mpppos_id = 0;
			$branch_id = 0;
			$grouptest_id = 0;
		}
		$interview = postParam("interview");
		$notes = postParam("notes");
		$notes_all = postParam("notes_all");
		$test_no = postParam("test_no");
	}else{
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
		
		$jobseeker = cmsDB();
		$strsql = "select js_id from tbl_vacantpos_jobseeker where vacantpos_id=".$selposition;
		$jobseeker->query($strsql);
		if($jobseeker->recordCount()){
			$lstjobseeker = $jobseeker->valueList("js_id");
		}else{
			$lstjobseeker = 0;
		}
	}
	
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>common.js"></script>
<body topmargin="0">
<FORM name="sample_form" action="edit.php?save=yes&jstest_id=<?=uriParam("jstest_id")?>" method="post" enctype="multipart/form-data" onSubmit="return Check()">
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
                            <td class=tableheader>
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td class=tableheader>&nbsp;Edit Recruitment Test</td>
                            </tr></table></td></tr>
                            <td>
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td>
								<!--- Menu --->
                                <!--- End Of Menu ---></td></tr></table></td></tr>
                          <tr>
                            <td>
                              <table cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                
                                <tr>
                                <td style="HEIGHT: 1px">
                                <IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></td></tr>
                                <tr>
                                <td style="HEIGHT: 1px">
                                <IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%"></td></tr></table></td></tr>
                          <tr>
                            <td class=heading2>
                              <table class=heading2 cellSpacing=1 cellPadding=1 width="100%" align=center border=0>
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
    <td width="80%"><input type="text" name="test_no" size="20" value="<?=$test_no?>" onKeyUp="this.value=this.value.toUpperCase()" onChange="GetId()"></td>
  </tr>
  <tr>
    <td width="20%" align="right">Region - Branch :</td>
    <td width="80%">
		<?
			$branch = cmsDB();
			$strsql = "select tbl_region.region_name,tbl_branch.branch_name 
						from tbl_branch 
						inner join tbl_region on tbl_branch.region_id=tbl_region.region_id 
						where tbl_branch.branch_id=".$branch_id;
			$branch->query($strsql);
			$branch->next();
			echo $branch->row("region_name")." - ".$branch->row("branch_name");
		?>
	</td>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">User Interview : </td>
    <td width="80%" valign="top">
	<textarea name="interview" style="width: 320px; height: 50px;"><?=$interview?></textarea>	
    	<!-- <input name="interview" maxlength="50" type="text" size="50" value="<?=$interview?>"> *Note -->
	</td>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">HRD Interview : </td>
    <td width="80%" valign="top">
    <textarea name="notes" style="width: 320px; height: 50px;"><?=$notes?></textarea>
    <!-- <input name="notes" maxlength="50" type="text" size="50" value="<?=$notes?>"> *Note -->
	</tr>
  <tr>
    <td width="20%" align="right" valign="top">Catatan Seluruh Test : </td>
    <td width="80%" valign="top">
    <input name="notes_all" maxlength="50" type="text" size="50" value="<?=$notes_all?>"> *Note
	</tr>
  <tr>
    <td width="100%" colspan="2" align="center">
	<hr size="1">
<? if($test_status <> "passed" || $test_status <> "failed"){?>
  <input type="submit" value="Update Recruitment Test" name="B3">&nbsp;&nbsp;
  <!-- input type="button" value="Kalkulasi Hasil Test" name="B3" onClick="location='edit.php?calculate=yes&jstest_id=<?=uriParam("jstest_id")?>&refresh=<?=md5(date("mdYHis"))?>'" -->&nbsp;&nbsp;
  <? }else{ ?>
  	<input type="submit" value="Update Recruitment Test" name="B3" disabled>&nbsp;&nbsp;
  <? } ?>
  <input type="button" value="Cancel" name="B3" onClick="location='view.php?jstest_id=<?=uriParam("jstest_id")?>&refresh=<?=md5(date("mdYHis"))?>'">
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
				where tbl_position_vacant.vacantpos_id=".$selposition."";
				
	$grouptest->query($strsql);
	$grouptest->next();
	$group_name = $grouptest->row("grouptest_name");
	$min_a = $grouptest->row("min_a");
	$min_b = $grouptest->row("min_b");
	$min_c = $grouptest->row("min_c");
	$min_d = $grouptest->row("min_d");
	$grouptest->query("select * from tbl_jobseeker_test_detail where jstest_id=".uriParam("jstest_id")."");
?>
<table border="1" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="2">
  <tr>
    <td width="100%" colspan="7" class="tableheader"><font color="#FFFFFF"><b>Test Detail Untuk 
    : <?=$group_name?></b></font></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="1" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="2">
        <tr>
          <td width="5%" align="center">No</td>
          <td width="5%" align="center">Code</td>
		  <td align="center">Nama Test</td>
		  <!-- td width="5%" align="center">Bobot</td -->
          <td align="center">Keterangan</td>
          <td align="center">Hasil Test</td>
          <td align="center">Attachment Doc Pendukung</td>
        </tr>
		<? if($grouptest->recordCount()){
			$no=0;
			$score = 0;
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
          <td bgcolor="#FFFFFF" valign="top"><textarea rows="2" name="desc_<?=$grouptest->row("jstestdetail_id")?>" cols="47"><?=$grouptest->row("test_desc")?></textarea></td>
          <td align="center" bgcolor="#FFFFFF" valign="top"><input type="text" name="result_<?=$grouptest->row("jstestdetail_id")?>" size="16" maxlength="16" value="<?=$grouptest->row("test_result")?>" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" valign="top" align="center">
          	<?
		if (strlen($grouptest->row("test_file") <> 0)) { 
			?>
			<a href="javascript:window.open('<?=$ANOM_VARS["www_img_url"]?>test_photo/<?=$grouptest->row("test_file")?>','frmnew','width=800,height=600,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes');void null;"><img src="file.jpg" width=20></img></a>
			<? 
		} else {
			echo "-";
		} ?>
			
			<BR>
			<input type="file" name="doc_<?=$grouptest->row("jstestdetail_id")?>" size="40">
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
		<td width="100%" colspan="7" class="tableheader" align="center">
		<?
			if(isset($_GET["calculate"])){
				echo "<font size=\"+2\">Nilai : ".$score."</font>";
			}
		?></td>
	  </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center" width="100%" bgcolor="#FFFFFF">
      <table align="center" border="1" cellspacing="0" cellpadding="2">
        <!-- tr>
          <td colspan="3" class="tableheader"><b>Nilai : <?=$score?></b></td>
          </tr>
        <tr -->
          <!-- td width="71"><font color="#008000"><b>[<?=$min_b+1?>
            &nbsp;-&nbsp;
            <?=$min_a?>]</b></font></td -->
          <!-- td width="232">&nbsp;<font color="#008000"><b>Lulus (A)</b></font></td -->
          <td width="232" rowspan="4"><?
if($test_status == "passed"){
    echo "<center><font size=\"+1\">Kandidat Test: </font><font color=\"green\" size=\"+1\">Lulus</font></center>";
}elseif($test_status =="failed"){
    echo "<center><font size=\"+1\">Kandidat Test: </font><font color=\"red\" size=\"+1\">Gagal</font></center>";
}?></td>
        </tr>
        <tr>
          <!-- td><font color="#008000"><b>[<?=$min_c+1?>
            &nbsp;-&nbsp;
            <?=$min_b?>]</b></font></td -->
          <!-- td>&nbsp;<font color="#008000"><b>Lulus (B)</b></font></td -->
          </tr>
        <tr>
          <!-- td><font color="#008000"><b>[<?=$min_d+1?>
            &nbsp;-&nbsp;
            <?=$min_c?>]</b></font></td -->
          <!-- td>&nbsp;<font color="#008000"><b>Lulus (C)</b></font></td -->
          </tr>
        <tr>
          <!-- td><font color="#FF0000"><b>[0&nbsp;-&nbsp;
                  <?=$min_d?>]</b></font></td -->
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
</form><br />
<form name="frmip" method="post" action="create_ip.php?save=yes&jstest_id=<?=uriParam("jstest_id")?>">
<table align="center" cellSpacing=0 cellPadding=0 border=0>
    <tr>
      <td><?
if($test_status == "passed"){

}elseif($test_status =="failed"){

}else{?>
            <select name="selstatus">
              <option value="">Pilih Kriteria</option>
              <option value="failed">Gagal Test</option>
              <option value="passed">Lulus Test</option>
            </select>
        </td><td>&nbsp;<input type="Submit" value="Processed"></td>
          <? } ?>
    </tr>
</table>
</form>
</BODY>
</HTML>
<script>
function Check() {
     var errmsg='';
	 test_no=document.sample_form.test_no.value;
	 if (test_no.length == 0) errmsg +='Test.No Wajib Diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}

function GetId() {
			 test_no=document.sample_form.test_no.value;
			 if (test_no.length){
				LoadCheckDATA ("iLoader", "checkdata.php", "test_no="+test_no);
			 }
}
</script>