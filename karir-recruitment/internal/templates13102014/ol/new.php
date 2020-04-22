<?
	require_once("../../config.php");
	if(isset($_POST["save"])){
			$selip=postParam("selip");
			$selol=postParam("selol");
			$ol_no=postParam("ol_no");
			$number=postParam("olnum");
			$ip=cmsDB();
			$ip->query("SELECT * FROM tbl_ijin_prinsip WHERE ip_id=".$selip);
			$ip->next();
			$golongan = $ip->row("golongan");
			$comp_gp = number_format($ip->row("comp_gp"), 0, ',', '.').",-";
			$comp_tjabatan=number_format($ip->row("comp_tjabatan"), 0, ',', '.').",-";
			$comp_makan=number_format($ip->row("comp_makan"), 0, ',', '.').",-";
			$comp_transport=number_format($ip->row("comp_transport"), 0, ',', '.').",-";
			$start_date=datesql2date($ip->row("start_date"));
			$penempatan = $ip->row("rencana_penempatan");
			$end_probation = datesql2date($ip->row("ip_duration_end"));
			
			$jstest=cmsDB();
			$jstest->query("SELECT tbl_jobseeker.*,tbl_jobseeker_test.vacant_pos_id 
			                FROM tbl_jobseeker_test 
							INNER JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id=tbl_jobseeker.js_id 
							WHERE tbl_jobseeker_test.jstest_id=".$ip->row("jstest_id"));
			$jstest->next();
			
			$vacant_pos_id = $jstest->row("vacant_pos_id");
			$full_name = $jstest->row("full_name");
			$js_address = $jstest->row("address1");
			$pob = $jstest->row("place_of_birth");
			$dob = datesql2date($jstest->row("date_of_birth"));
			$jobseeker_id = $jstest->row("id_no");
			
			$position = cmsDB();
			$strsql = "SELECT tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
					   FROM tbl_position 
					   INNER JOIN tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
					   INNER JOIN tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
					   WHERE tbl_position_vacant.vacantpos_id=" . $vacant_pos_id;
						
			$position->query($strsql);
			$position->next();
			$position_name = $position->row("position_name");
			
			$strsql = "INSERT INTO tbl_offering_letter(ol_no,ip_id,templateol_id,user_id,ol_date) 
			VALUES('".postParam("ol_no")."','".postParam("selip")."','".postParam("selol")."',".$_SESSION["user_id" . date("mdY")].",'".date("Y-m-d H:i:s")."')";
			$ip->query($strsql);
			$ol_id=$ip->lastInsertID();
			
			$oltemp = cmsDB();
			$oltemp->query("SELECT * FROM tbl_offering_letter_template WHERE templateol_id=".$selol);
			$oltemp->next();
			$file_name = $oltemp->row("template_file");
			//echo $file_name;
			$content = fopen ("../../library/_files/offering_letter_template/".$file_name, "r");
			$fcontent = fread($content, filesize("../../library/_files/offering_letter_template/".$file_name));
			$content = str_replace("[ol_date]", date("d-M-Y"),$fcontent);
			$content = str_replace("[ol_no]", $ol_no,$content);
			$content = str_replace("[jobseeker_name]", $full_name,$content);
			$content = str_replace("[jobseeker_address]", $js_address,$content);
			$content = str_replace("[position]", $position_name,$content);
			$content = str_replace("[golongan]", $golongan,$content);
			$content = str_replace("[grade]", $golongan,$content);
			$content = str_replace("[region_branch]", $penempatan,$content);
			$content = str_replace("[gaji_pokok]", $comp_gp,$content);
			$content = str_replace("[tunjangan_jabatan]", $comp_tjabatan,$content);
			$content = str_replace("[tunjangan_makan]", $comp_makan,$content);
			$content = str_replace("[tunjangan_transport]", $comp_transport,$content);
			$content = str_replace("[tanggal_start]", $start_date,$content);
			$content = str_replace("[end_probation]", $end_probation,$content);
			$content = str_replace("[pob]", $pob,$content);
			$content = str_replace("[dob]", $dob,$content);
			$content = str_replace("[jobseeker_id]", $jobseeker_id,$content);
			
			$file = $ol_id. "_" . md5("YmdHis") . ".html";
			$filename = $ANOM_VARS["www_file_path"]."offering_letter/". $file;
			$somecontent = $content;
			
			// Let's make sure the file exists and is writable first.
			$handle = fopen($filename, "w");
		    if (!fwrite($handle, $somecontent)) {
		        print "Cannot write to file (".$filename.")";
				die();
		        exit;
		    }
		    fclose($handle);
			
			
			$strsql = "UPDATE tbl_offering_letter SET ol_file='".$file."' WHERE ol_id=".$ol_id;
			$ip->query($strsql);
			header("Location: index.php"); 	
			die();
	}
?>
<script language="javascript" type="text/javascript" src="<?=$ANOM_VARS["www_js_url"]?>common.js" ></script>
<br />
<center>
	 <form action="" method="post" name="sample_form" id="sample_form" enctype="multipart/form-data" onSubmit="return Check()">
     <table class="heading2" cellSpacing="0" cellPadding="2" width="60%" align=center border=0>
                     
                     <tr>
                       <td class="tableheader">
                         <table cellSpacing="0" cellPadding="0" width="100%" border="0">
                           
                           <tr>
                            <td class=tableheader>&nbsp;<b>Offering Letter - New</b></td>
                           </tr>
			
			</table>
		</td>
	  </tr>
                     <tr>
                       <td>
                         <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <tr>
                           <td style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></td></tr>
                           <tr>
                           <td style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></td></tr>
			
		  </table>
		</td>
	</tr>
	 <tr><td colspan="3">
			<table width="100%" cellpadding="2" cellspacing="0" border="0">
				
				<tr>
					<td width="40%" align="right"><strong>Ijin Prinsip </strong></td>
				  <td width="1%" align="right"><strong>:</strong></td>
				  <td width="59%">
					<?
						$ip=cmsDB();
						$ip->query("select ip_id from tbl_offering_letter");
						$lstip = $ip->valueList("ip_id");
						if(listLen($lstip)==0){
							$lstip = 0;
						}
						$ip->query("SELECT * FROM tbl_ijin_prinsip WHERE ip_id not in (".$lstip.")");
						$ipcount = $ip->recordCount();
						
						$ip->query("SELECT *
									FROM tbl_ijin_prinsip
									LEFT JOIN tbl_jobseeker_test ON tbl_ijin_prinsip.jstest_id = tbl_jobseeker_test.jstest_id
									LEFT JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
									LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
									LEFT JOIN tbl_branch_mpp_apply ON tbl_position_vacant.mpppos_id = tbl_branch_mpp_apply.mpppos_id
									LEFT JOIN tbl_position ON tbl_branch_mpp_apply.position_id = tbl_position.position_id
									LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
									WHERE ip_status <> 'new' 
									AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
									AND ip_id not in (".$lstip.")");						
					?>
				  <select name="selip">
						<?
							while($ip->next()){
								echo "<option value=\"".$ip->row("ip_id")."\">".$ip->row("full_name")." [".$ip->row("ip_no")."]</option>";
							}
						?>
					</select></td>
			  </tr>
				<tr>
					<td width="40%" align="right"><b>OL/KKWT Template</b></td>
				  <td width="1%" align="right"><b>:</b></td>
				  <td>
					<?
						$tempol=cmsDB();
						$tempol->query("select * from tbl_offering_letter_template");
						
					?>
					<select name="selol">
						<?
							while($tempol->next()){
								echo "<option value=\"".$tempol->row("templateol_id")."\">".$tempol->row("template_name")."</option>";
							}
						?>
					</select></td>
				</tr>
                <tr>
					<td width="40%" align="right"><b>OL/KKWT No.</b></td>
				  <td width="1%" align="right"><b>:</b></td>
				  <td><input type="text" name="ol_no" value="001/HCMD-OL/08" size="50" maxlength="255" onKeyUp="this.value=this.value.toUpperCase()" onChange="GetId2()"></td>
				</tr>
				<tr>
                       <td colspan="3">
                         <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                           
                           <tr>
                           <td style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></td></tr>
                           <tr>
                           <td style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></td></tr></table></td></tr>
                     <tr>
				<tr>
					<td colspan="3"align="center">
					<? if($ipcount<>0){?>
					<input type="button" value="Save" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.selip,sample_form.selol,sample_form.ol_no','save=yes&refresh=<?=md5("mdYHis")?>')">
					&nbsp;<input type="Button" value="Preview" onclick="preview_ol()">
					<? } ?>
					&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/ol/index.php')"></td>
				</tr>			
			</table>
		</td></tr>
</table>
</form>
</center>
<script>
function Check() {
     var errmsg='';
	 ol_no=document.sample_form.ol_no.value;
	 if (ol_no.length == 0) errmsg +='Nomor OL Wajib Diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>