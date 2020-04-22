<?
	require_once("../../config.php");
	if(isset($_GET["save"])){
	    $position=cmsDB();
		$strsql = "SELECT tbl_branch_mpp_apply.*,tbl_position_vacant.vacantpos_id,tbl_branch.branch_name,
						  tbl_region.region_name,tbl_golongan.name,tbl_position.position_id,tbl_position.position_name 
				   FROM tbl_branch_mpp_apply 
				   INNER JOIN tbl_position_vacant on tbl_branch_mpp_apply.mpppos_id=tbl_position_vacant.mpppos_id 
				   INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
				   INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
				   INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
				   INNER JOIN tbl_position on tbl_branch_mpp_apply.position_id = tbl_position.position_id
				   WHERE tbl_branch_mpp_apply.request_status='approved' and tbl_position_vacant.vacantpos_id=".$_POST["selposition"];
		$position->query($strsql);
		$position->next();
		$qty_test = $position->row("qty_test")-1;
		$mpppos_id = $position->row("mpppos_id");
		$position->query("update tbl_branch_mpp_apply set qty_test=".$qty_test." where request_status='approved' and mpppos_id=".$mpppos_id."");
	
		$selposition=postParam("selposition");
		$seljobseeker = postParam("seljobseeker");
		$interview = postParam("interview");
		$notes = postParam("notes");
		$notes_all = postParam("notes_all");
		$test_no = postParam("test_no");
		
		$insert=cmsDB();
		$strsql = "insert into tbl_jobseeker_test(test_no,wawancara_user,wawancara_dhrm,test_status,test_date,overall_test_desc,vacant_pos_id,user_id,js_id) 
					values('".$test_no."','".$interview."','".$notes."','new','".date("Y-m-d H:i:s")."','".$notes_all."',
					       '".$selposition."',".$_SESSION["user_id" . date("mdY")].",".$seljobseeker.")";
		//echo $strsql;die();
		$insert->query($strsql);
		$jstest_id=$insert->lastInsertID();
		$insert->query("update tbl_jobseeker set avail_status='recruitment process' where js_id=".$seljobseeker);
		
		$insertdetail = cmsDB();
		$insert->query("select * from tbl_test where grouptest_id=".postParam("grouptest_id"));
		while($insert->next()){
			$file_name = "doc_".$insert->row("test_id");
			$strsql = "insert into tbl_jobseeker_test_detail(jstest_id,test_id,history_code,history_name,history_desc,
			                                                 test_desc,test_result,test_date,test_file) 
					   values('".$jstest_id."','".$insert->row("test_id")."','".$insert->row("test_code")."','".$insert->row("test_name")."',
					          '".$insert->row("description")."','".postParam("desc_".$insert->row("test_id"))."',
							  '".postParam("result_".$insert->row("test_id"))."','".date("Y-m-d H:s:i")."','')";
			$insertdetail->query($strsql);
			$jstestdetail_id=$insertdetail->lastInsertID();
			$nama_file = $jstestdetail_id."_". md5("mdYHis");
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
			$insertdetail->query("update tbl_jobseeker_test_detail set test_file='".$nama_file."' where jstestdetail_id=".$jstestdetail_id);
			
		}
		echo "<script>alert('Recruitment Test Detail Saved!!');location='index.php?refresh=".md5("mdYHis")."';</script>";
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
		$selposition=0;
		$interview = "";
		$notes = "";
		$notes_all = postParam("notes_all");
		$test_no = "";
	}
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>common.js"></script>
<body topmargin="0">
<FORM name="sample_form" id="sample_form" action="new.php?save=yes" method="post" enctype="multipart/form-data" onSubmit="return Check()">
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
                                <td class=tableheader>&nbsp;New Recruitment Test</td>
                                </tr></table></td></tr>
                          <tr>
                            <td>
                              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <tr>
                                <td>
                                <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td></tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td class=heading2>
                              <table class=heading2 cellSpacing=1 cellPadding=1 width="100%" align=center border=0>
                                  <tr>
                                    <td>
                                    <table border="0" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="4">
  <tr>
    <td width="20%" align="right">Posisi :</td>
    <td width="80%">
	<script>
	function _selpos(){
		document.sample_form.action="new.php";
		document.sample_form.submit();
	}
	</script>
	 <?
	 $position=cmsDB();
	 $strsql = "SELECT tbl_branch_mpp_apply.*,tbl_position_vacant.vacantpos_id,tbl_branch.branch_name,
	                   tbl_region.region_name,tbl_golongan.name,tbl_position.position_id,tbl_position.position_name 
				FROM tbl_branch_mpp_apply 
				INNER JOIN tbl_position_vacant on tbl_branch_mpp_apply.mpppos_id=tbl_position_vacant.mpppos_id 
				INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
				INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
				INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
				INNER JOIN tbl_position on tbl_branch_mpp_apply.position_id = tbl_position.position_id
				WHERE tbl_branch_mpp_apply.request_status='approved'
				AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
				$position->query($strsql);
	  ?>
	<select size="1" name="selposition" onChange="_selpos()">
			<option value="0" <? if($selposition==0){echo " selected";}?>>Select Position</option>
        <? while($position->next()){?>
     <? if($position->row("qty_test")==0){?>
      <? }else{ ?>
		    <option value="<?=$position->row("vacantpos_id")?>" <? if($selposition==$position->row("vacantpos_id")){echo " selected";}?>>[<?=$position->row("position_name")?> <?=$position->row("qty_test")?> Orang Untuk : <?=$position->row("region_name")?>--<?=$position->row("branch_name")?>]</option>
		<? }
		} ?>
      </select> </td>
  </tr>
 
  <tr>
    <td width="20%" align="right">Nama Jobseeker :</td>
    <td width="80%">
	<? if(isset($_POST["selposition"])){
			$jobseeker->query("select * from tbl_jobseeker where js_id in (".$lstjobseeker.")");
			$jml_js = $jobseeker->recordCount();
			if($jml_js<>0){
			?>
				  <select size="1" name="seljobseeker">
					<? while($jobseeker->next()){?>
						<option value="<?=$jobseeker->row("js_id")?>"><?=$jobseeker->row("full_name")?></option>
					<? } ?>
				  </select>
		  <? }else{
		  		echo "Reserved Dahulu Nama Jobseeker Untuk Posisi ini!!!";
		  }?>
	<? }else{
		$jml_js = 0;
	}
	?></td>
  </tr>
   <tr>
    <td width="20%" align="right">Test No :</td>
    <td width="80%">
	<? if(isset($_POST["selposition"]) && ($jml_js <> 0)){?>
	<input type="text" name="test_no" size="20" value="<?=$test_no?>" onKeyUp="this.value=this.value.toUpperCase()" onChange="GetId()">
	<? } ?></td>
  </tr>
  <tr>
    <td width="20%" align="right">Region - Branch :</td>
    <td width="80%">
		<? if(isset($_POST["selposition"]) && ($jml_js <> 0)){
			$branch = cmsDB();
			$branch->query("select tbl_region.region_name,tbl_branch.branch_name from tbl_branch inner join tbl_region on tbl_branch.region_id=tbl_region.region_id where tbl_branch.branch_id=".$branch_id);
			$branch->next();
			echo $branch->row("region_name")." - ".$branch->row("branch_name");
		}else{?>
			- Pilih Posisi - 
		<? } ?></td>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">User Interview : </td>
    <td width="80%" valign="top">
		<? if(isset($_POST["selposition"]) && ($jml_js <> 0)){?>
        <input name="interview" maxlength="50" type="text" size="50" value="<?=$interview?>"> *Note
		<? } ?></td>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">HRD Interview : </td>
    <td width="80%" valign="top">
	<? if(isset($_POST["selposition"]) && ($jml_js <> 0)){?>
    <input name="notes" maxlength="50" type="text" size="50" value="<?=$notes?>"> *Note
	<? } ?>
  </tr>
  <tr>
    <td width="20%" align="right" valign="top">Catatan Seluruh Test : </td>
    <td width="80%" valign="top">
	<? if(isset($_POST["selposition"]) && ($jml_js <> 0)){?>
        <input name="notes_all" maxlength="50" type="text" size="50" value="<?=$notes_all?>"> *Note
	<? } ?>
  </tr>
  <tr>
    <td width="100%" colspan="2" align="center">
	<hr size="1">
	<? if(isset($_POST["selposition"]) && ($jml_js <> 0)){?>
	  <input type="submit" value="Save Recruitment Test" name="B3">&nbsp;&nbsp;
    <? } ?> 
	<input type="button" value="Cancel" name="B3" onClick="location='index.php'">
	<hr size="1">
   </td>
  </tr>
</table>
<? if(isset($_POST["selposition"]) && $grouptest_id<>0){
	$grouptest = cmsDB();
	$grouptest->query("select * from tbl_grouptest where grouptest_id=".$grouptest_id);
	$grouptest->next();
	$group_name = $grouptest->row("grouptest_name");
	$min_a = $grouptest->row("min_a");
	$min_b = $grouptest->row("min_b");
	$min_c = $grouptest->row("min_c");
	$min_d = $grouptest->row("min_d");
	$grouptest->query("select * from tbl_test where grouptest_id=".$grouptest_id);
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
		?>
        <tr>
          <td align="right" bgcolor="#FFFFFF" valign="top"><?=$no?>.</td>
          <td bgcolor="#FFFFFF" valign="top"><?=$grouptest->row("test_code")?></td>
          <td bgcolor="#FFFFFF" valign="top"><?=$grouptest->row("test_name")?></td>
		  <!-- td bgcolor="#FFFFFF" valign="top" align="center"><?=$grouptest->row("bobot")?> %</td -->
          <td bgcolor="#FFFFFF" valign="top"><textarea rows="3" name="desc_<?=$grouptest->row("test_id")?>" cols="47"></textarea></td>
          <td align="center" bgcolor="#FFFFFF" valign="top"><input type="text" name="result_<?=$grouptest->row("test_id")?>" size="3" maxlength="1" value="0" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="file" name="doc_<?=$grouptest->row("test_id")?>" size="40"></td>
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
  <!-- tr>
    <td align="center" width="100%" bgcolor="#FFFFFF"><table align="center" border="1" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2" class="tableheader"><b>Nilai :</b></td>
      </tr>
      <tr>
        <td width="71"><font color="#008000"><b>[<?=$min_b+1?>
          &nbsp;-&nbsp;
          <?=$min_a?>]</b></font></td>
        <td width="232">&nbsp;<font color="#008000"><b>Lulus (A)</b></font></td>
      </tr>
      <tr>
        <td><font color="#008000"><b>[<?=$min_c+1?>
          &nbsp;-&nbsp;
          <?=$min_b?>]</b></font></td>
        <td>&nbsp;<font color="#008000"><b>Lulus (B)</b></font></td>
      </tr>
      <tr>
        <td><font color="#008000"><b>[<?=$min_d+1?>
          &nbsp;-&nbsp;
          <?=$min_c?>]</b></font></td>
        <td>&nbsp;<font color="#008000"><b>Lulus (C)</b></font></td>
      </tr>
      <tr>
        <td><font color="#FF0000"><b>[0&nbsp;-&nbsp;
                <?=$min_d?>]</b></font></td>
        <td>&nbsp;<font color="#FF0000"><b>Gagal</b></font></td>
      </tr>
    </table></td>
  </tr -->
  <tr>
    <td width="100%">
      <p align="center">
      </p>
    </td>
  </tr>
</table>
<input type="hidden" name="grouptest_id" value="<?=$grouptest_id?>">
<? } ?>
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