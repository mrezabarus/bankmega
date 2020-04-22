<?
	require_once("../../config.php");
	require_once("../../rtf/Rtf.php");
	if(isset($_GET["delete"])){
			$ip=cmsDB();
			$ip->query("select * from tbl_offering_letter where ol_id=".uriParam("ol_id"));
			$ip->next();
			$file_ol = $ip->row("ol_file");
			$file_old = $ANOM_VARS["www_file_path"]."offering_letter/". $file_ol;
			$delete = @unlink($file_old); 
			
			$ip->query("delete from tbl_offering_letter where ol_id=".uriParam("ol_id"));
			
			header("Location: index.php"); 	
			die();
	}
	if(isset($_POST["save"])){
			$selip=postParam("selip");
			$selol=postParam("selol");
			$ol_no=postParam("txtno");
			$ip=cmsDB();
			$ip->query("select * from tbl_offering_letter where ol_id=".postParam("ol_id"));
			$ip->next();
			$file_ol = $ip->row("ol_file");
			$file_old = $ANOM_VARS["www_file_path"]."offering_letter/". $file_ol;
			$delete = @unlink($file_old); 
		    
			
			$ip->query("select * from tbl_ijin_prinsip where ip_id=".$selip);
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
			$jstest->query("select tbl_jobseeker.*,tbl_jobseeker_test.vacant_pos_id from tbl_jobseeker_test inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id where tbl_jobseeker_test.jstest_id=".$ip->row("jstest_id"));
			$jstest->next();
			
			$vacant_pos_id = $jstest->row("vacant_pos_id");
			$full_name = $jstest->row("full_name");
			$js_address = $jstest->row("address1");
			$pob = $jstest->row("place_of_birth");
			$dob = datesql2date($jstest->row("date_of_birth"));
			$jobseeker_id = $jstest->row("id_no");
			
			
			$position = cmsDB();
			$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
						from tbl_position 
						inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
						inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
						where tbl_position_vacant.vacantpos_id=" . $vacant_pos_id;
						
			$position->query($strsql);
			$position->next();
			$position_name = $position->row("position_name");
			
			$ol_id=postParam("ol_id");
			
			$oltemp = cmsDB();
			$oltemp->query("select * from tbl_offering_letter_template where templateol_id=".$selol);
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
			
			$file = $ol_id. "_" . md5(date("YmdHis")) . ".php";
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
			
			$strsql = "update tbl_offering_letter set ol_no='".postParam("txtno")."',ip_id='".postParam("selip")."',templateol_id='".postParam("selol")."',user_id=".$_SESSION["user_id" . date("mdY")].",ol_date='".date("Y-m-d H:i:s")."' 
						,ol_file='".$file."',is_approved='".postParam("selstatus")."' where ol_id=".$ol_id;
			$ip->query($strsql);
			if(postParam("selstatus")=='deny'){
				$strsql1 = "update tbl_jobseeker set avail_status='ol denied' where js_id=".$jstest->row("js_id")."";
				$jstest->query($strsql1);
			}elseif(postParam("selstatus")=='yes'){
				$strsql1 = "update tbl_jobseeker set avail_status='employee' where js_id=".$jstest->row("js_id")."";
				$jstest->query($strsql1);
			}else{
				echo "";
			}
			
			header("Location: view.php?ol_id=".$ol_id); 	
			die();
			//echo $strsql;die();
	}
	$ol = cmsDB();
	$ol->query("select * from tbl_offering_letter where ol_id=".uriParam("ol_id"));
	$ol->next();
?>
<BR>
<center>
	 <form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing=0 cellPadding="2" width="60%" align=center border=0><TR>
                       <TD class=tableheader>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR>
                            <TD class=tableheader>&nbsp;<b>Offering Letter - Edit</b></TD>
                           </TR></TABLE>
		</TD>
	  </TR>
                     <TR>
                       <TD>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR></TABLE>
		</TD>
	</TR>
	 <tr><td colspan="3">
			<table width="100%" cellpadding="2" cellspacing="0" border="0">
				
				<tr>
					<td width="40%" align="right"><b>Ijin Prinsip </b></td>
					<td width="1%"><b>:</b></td>
					<td width="59%">
					<?
						$ip=cmsDB();
						$ip->query("select * from tbl_ijin_prinsip where ip_id=".$ol->row("ip_id"));
						$ip->next();
						$ip_no = $ip->row("ip_no");
						$ip->query("select ip_id from tbl_offering_letter");
						$lstip = $ip->valueList("ip_id");
						if(listLen($lstip)==0){
							$lstip = 0;
						}
						$ip->query("select * from tbl_ijin_prinsip where ip_id not in (".$lstip.")");
						$ipcount = $ip->recordCount();
					?>
					<select name="selip">
							<option value="<?=$ol->row("ip_id")?>"><?=$ip_no?></option>
						<?
							while($ip->next()){
								echo "<option value=\"".$ip->row("ip_id")."\">".$ip->row("ip_no")."</option>";
							}
						?>
				  </select>					</td>
				</tr>
				<tr>
					<td width="40%" align="right"><b>OL/KKWT Template</b></td>
					<td width="1%"><b>:</b></td>
					<td>
					<?
						$tempol=cmsDB();
						$tempol->query("select * from tbl_offering_letter_template");
						
					?>
					<select name="selol">
						<?
							while($tempol->next()){
								echo "<option value=\"".$tempol->row("templateol_id")."\"";
								if($ol->row("templateol_id")==$tempol->row("templateol_id")){
									echo " selected";
								}
								echo ">".$tempol->row("template_name")."</option>";
							}
						?>
					</select>					</td>
				</tr>
				<tr>
					<td width="40%" align="right"><b>OL/KKWT No.</b></td>
				  <td width="1%"><b>:</b></td>
					<td><input type="text" name="txtno" size="50" value="<?=$ol->row("ol_no")?>" maxlength="255" onKeyUp="this.value=this.value.toUpperCase()"></td>
				</tr>
				<tr>
					<td width="40%" align="right"><b>Status</b></td>
				  <td width="1%"><b>:</b></td>
					<td>
						<select name="selstatus">
							<option value="no" <? if($ol->row("is_approved")=='no'){echo " selected";}?>>Pending</option>
							<option value="yes" <? if($ol->row("is_approved")=='yes'){echo " selected";}?>>Berhasil</option>
							<option value="deny" <? if($ol->row("is_approved")=='deny'){echo " selected";}?>>Batal</option>
						</select>
					</td>
				</tr>
				<TR>
                       <TD colspan="3">
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR></TBODY></TABLE></TD></TR>
                     <TR>
				<tr>
					<td colspan="3"align="center">
						<input type="button" value="Update" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.selip,sample_form.selol,sample_form.txtno,sample_form.selstatus','save=yes&ol_id=<?=uriParam("ol_id")?>&refresh=<?=md5("mdYHis")?>')">
					&nbsp;<input type="Button" value="Preview" onclick="preview_ol()">
					&nbsp;<input type="Button" value="Delete" onclick="get_method('templates/ol/edit.php?delete=yes&ol_id=<?=uriParam("ol_id")?>')">
					&nbsp;<input type="Button" value="Cancel" onclick="get_method('templates/ol/view.php?ol_id=<?=uriParam("ol_id")?>')"></td>
				</tr>			
			</table>
		</td></tr></table>
</form>
</center>