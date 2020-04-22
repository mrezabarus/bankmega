<?
	require_once("../../config.php");

	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$cp->next();
	$full_name = $cp->row("full_name");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>

<table class="heading2" cellSpacing="0" cellPadding="0" width="100%" border=0> 
  <tr>
    <td class="tableheader"><!--- HEADER --->
        <table cellSpacing="0" cellPadding="0" width="100%" align="center" border=0>
          <tr>
            <td class=tableheader>&nbsp;Offering Letter</td>
            <td align=right><table width=0>
                <tr>
                  <td><input type="image" style="border:none" onClick="get_method('templates/ol/index.php?search=yes')" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
      <tr>
        <td style="HEIGHT: 1px"><img height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><img height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="sample_form" id="sample_form" enctype="multipart/form-data">
       <? 	if(isset($_GET["search"]) || isset($_POST["search"])){
			if(isset($_POST["look_search"])){
				$value=postParam("txtsearch");
			}elseif(isset($_GET["look_search"])){
				$value=uriParam("txtsearch");
			}elseif(isset($_GET["txtsearch"])){
				$value=uriParam("txtsearch");
			}else{
				$value="";
			}
			if(isset($_GET["txtsearch"]) && strlen($value)==0){
			
			}else{
		?>
      <table cellSpacing="0" cellPadding="2" border=0>
        <tr>
          <td><b>Search For</b></td>
          <td><b>:</b></td>
          <td>&nbsp;
                <input type="Text" name="txtsearch" size="30" value="<?=$value?>"></td>
          <td>&nbsp;
                <input type="button" value="Search" style="cursor:hand" onClick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtsearch','search=yes&look_search=yes&refresh=<?=md5("mdYHis")?>')" /></td>
          <td>&nbsp;
                <input type="Button" value="Cancel" style="cursor:hand" onClick="get_method('templates/ol/index.php')" /></td>
          <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_6')" onMouseOut="overlayclose('tanya_6');" border="0" style="cursor:hand">
                <div id="tanya_6" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
                  <div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                      <font color="#FF0000">*</font> OL No <br />
                      <font color="#FF0000">*</font> IP No <br />
                      <font color="#FF0000">*</font> Job Seeker Name <br />
                      <font color="#FF0000">*</font> Position <br />
                      <font color="#FF0000">*</font> Branch</b></font></div>
                </div></td>
        </tr>
      </table>
      <?		}
}?>
    </form>
        <table cellspacing="0" cellpadding="1" border="0">
          <tr>
            <td width="0" height="20">&nbsp;
				<? if(listFind($_SESSION["ss_id" . date("mdY")],"33")){?>
                <input type="image" style="border:none" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" onClick="get_method('templates/ol/new.php?new=yes')" alt="create new" align="bottom" />
                <? } ?>
            </td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
      <tr>
        <td style="HEIGHT: 1px"><img height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><img height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class=heading2><table width="100%" class=heading2 cellSpacing=1 cellPadding=3 align=center border=0>
      <!--- RecordList Field --->
      <TR class=heading2>
        <td class=heading2 noWrap align=center>No.</td>
        <td class=heading2 noWrap align=center>OL No</td>
        <td class=heading2 noWrap align=center>Tgl Created OL</td>
        <td class=heading2 noWrap align=center>Nama Jobseeker</td>
        <td class=heading2 noWrap align=center>Posisi</td>
        <td class=heading2 noWrap align=center>Penempatan</td>
        <td class=heading2 noWrap align=center>Status</td>
      </tr>
      <!--- RecordList Field --->
      <tr>
        <!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
        <td class=heading2 colSpan=7><table cellSpacing=0 cellPadding=0 width="100%" border=0>
          <tr>
            <td style="HEIGHT: 1px"><img height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
          </tr>
          <tr>
            <td style="HEIGHT: 1px"><img height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
          </tr>
        </table></td>
      </tr>
      <?
										  $mpp=cmsDB();
										  if(isset($_POST["look_search"]) || isset($_GET["look_search"])){													
											$strsql = "SELECT *
													FROM tbl_offering_letter
													LEFT JOIN tbl_ijin_prinsip ON tbl_ijin_prinsip.ip_id = tbl_offering_letter.ip_id
													LEFT JOIN tbl_jobseeker_test ON tbl_jobseeker_test.jstest_id = tbl_ijin_prinsip.jstest_id
													LEFT JOIN tbl_jobseeker ON tbl_jobseeker.js_id = tbl_jobseeker_test.js_id
													LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
													LEFT JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
													LEFT JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
													LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
													WHERE tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
													AND (tbl_offering_letter.ol_no like '%".trim($value)."%'
													OR tbl_offering_letter.ol_date like '%".trim($value)."%'
													OR tbl_jobseeker.full_name like '%".trim($value)."%'
													OR tbl_position.position_name like '%".trim($value)."%'
													OR tbl_ijin_prinsip.rencana_penempatan like '%".trim($value)."%')";

											}else{
												$strsql = "SELECT * 
													FROM tbl_offering_letter
													LEFT JOIN tbl_ijin_prinsip ON tbl_ijin_prinsip.ip_id = tbl_offering_letter.ip_id
													LEFT JOIN tbl_jobseeker_test ON tbl_jobseeker_test.jstest_id = tbl_ijin_prinsip.jstest_id
													LEFT JOIN tbl_jobseeker ON tbl_jobseeker.js_id = tbl_jobseeker_test.js_id
													LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
													LEFT JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
													LEFT JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
													LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
													WHERE 1";
											}
									
									if(isset($_SESSION["ssbranch_id" . date("mdY")])){
										$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
									}
									
									$strsql = $strsql . " ORDER BY ol_date desc";

										  $mpp->query($strsql);
										  $num_rows_answer = $mpp->recordCount();
										   $page = ceil($num_rows_answer/20);
										   if (round($page) == 0){
											 $page = 1;
										   }
										  if(isset($_POST["look_search"]) || isset($_GET["look_search"])){	
											$strsql = "SELECT *
													FROM tbl_offering_letter
													LEFT JOIN tbl_ijin_prinsip ON tbl_ijin_prinsip.ip_id = tbl_offering_letter.ip_id
													LEFT JOIN tbl_jobseeker_test ON tbl_jobseeker_test.jstest_id = tbl_ijin_prinsip.jstest_id
													LEFT JOIN tbl_jobseeker ON tbl_jobseeker.js_id = tbl_jobseeker_test.js_id
													LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
													LEFT JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
													LEFT JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
													LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
													WHERE tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
													AND (tbl_offering_letter.ol_no like '%".trim($value)."%'
													OR tbl_offering_letter.ol_date like '%".trim($value)."%'
													OR tbl_jobseeker.full_name like '%".trim($value)."%'
													OR tbl_position.position_name like '%".trim($value)."%'
													OR tbl_ijin_prinsip.rencana_penempatan like '%".trim($value)."%')";

											}else{
												$strsql = "SELECT * 
													FROM tbl_offering_letter
													LEFT JOIN tbl_ijin_prinsip ON tbl_ijin_prinsip.ip_id = tbl_offering_letter.ip_id
													LEFT JOIN tbl_jobseeker_test ON tbl_jobseeker_test.jstest_id = tbl_ijin_prinsip.jstest_id
													LEFT JOIN tbl_jobseeker ON tbl_jobseeker.js_id = tbl_jobseeker_test.js_id
													LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
													LEFT JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
													LEFT JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
													LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
													WHERE 1";
											}
										
									if(isset($_SESSION["ssbranch_id" . date("mdY")])){
										$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
									}
									
									$strsql = $strsql . " ORDER BY ol_date desc";

											if(isset($_GET["paging"])){
												if(!intval(uriParam("page"))){
													echo "Invalid Input()";die();
												  }
												$limit = uriParam("page") - 20;
												$strsql = $strsql . " limit ".$limit.",20";
												$no = $limit+1;
											}else{
												$strsql = $strsql . " limit 0,20";
												$no=1;
											}
										  $mpp->query($strsql);
										  if($mpp->recordCount()){										
												$clas=1;
												
										  		while($mpp->next()){
										  ?>
      <TR class="<? if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>">
        <td vAlign=top align="left"><?=$no?>.</td>
        <td vAlign=top align="left"><? if(listFind($_SESSION["ss_id" . date("mdY")],"36")){?>
              <a href="javascript:get_method('templates/ol/view.php?ol_id=<?=$mpp->row("ol_id")?>')" title=''>
              <?}?>
              <?=$mpp->row("ol_no")?>
              <? if(listFind($_SESSION["ss_id" . date("mdY")],"36")){?>
              </a>
              <?}?>
        </td>
        <td vAlign=top align=center><?=datesql2date($mpp->row("ol_date"))?></td>
        <td vAlign=top><?		
												$ip=cmsDB();
												$ip->query("select * from tbl_ijin_prinsip where ip_id=".$mpp->row("ip_id"));
												$ip->next();
												$jstest = cmsDB();
												$jstest->query("select tbl_jobseeker.full_name,tbl_jobseeker_test.vacant_pos_id 
																from tbl_jobseeker_test inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id 
																where tbl_jobseeker_test.jstest_id=".$ip->row("jstest_id"));
												$jstest->next();
												$vacant_pos_id = $jstest->row("vacant_pos_id");
												echo $jstest->row("full_name");
											?></td>
        <td vAlign=top><?
													$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
																from tbl_position 
																inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
																inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
																where tbl_position_vacant.vacantpos_id=".$vacant_pos_id;
													$position=cmsDB();
													$position->query($strsql);
													$position->next();
													echo $position->row("position_name");
													
													?></td>
        <td vAlign=top><?=$ip->row("rencana_penempatan")?>
        </td>
        <td vAlign=top align="center"><b>
          <?
													if($mpp->row("is_approved")=='no'){
														echo "<font color=\"brown\"><blink>Pending</blink></font>";
													}elseif($mpp->row("is_approved")=='yes'){
														echo "<font color=\"green\">Berhasil</font>";
													}else{
														echo "<font color=\"red\">Batal</font>";
													}
													?>
        </b></td>
      </tr>
      <?
													$clas=$clas*-1;
													$no++;
												}?>
      <? }else{ ?>
      <TR class=tablebodyeven>
        <td colspan="7" vAlign=top align=center>No record found</td>
      </tr>
      <? } ?>
      <!--- End Of Record --->
      <tr>
        <!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
        <td class=tablefooter align=middle colSpan=7><table cellSpacing=1 cellPadding=1 width="100%" 
                                border=0>
          <tr>
            <td class=tablefooter align=left width="100%"><table cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
              <tr>
                <td style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%" name=agif></td>
                <td height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width=1 name=zgif></td>
              </tr>
              <tr>
                <td height=23><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width=1 name=agif2></td>
                <td class=formtext vAlign=center noWrap 
                                align=left width="100%">&nbsp;<b>Login As : <font color="#0000FF">
                  <?=$full_name;?>
                </font></b></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colSpan=3><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%" 
                                name=zgif2></td>
              </tr>
            </table></td>
            <td class=tablefooter vAlign=center noWrap 
                                align=middle><table cellSpacing=0 cellPadding=0 width=120 
                                border=0>
              <tr>
                <td style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%" name=agif></td>
                <td height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width=1 name=zgif></td>
              </tr>
              <tr>
                <td height=23><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width=1 name=agif2></td>
                <td vAlign=center noWrap align=middle width=120><table cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                  <tr>
                    <td class=tablefooter vAlign=center noWrap 
                                align=middle><!--- Record Counter --->
                                <!---  Record 1-20 
                                                                      of 136 --->
                      &nbsp;
                      <!--- End Of Record Counter --->
                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colSpan=3><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%" 
                                name=zgif2></td>
              </tr>
            </table></td>
            <td class=tablefooter vAlign=center noWrap align=middle><table cellSpacing=0 cellPadding=0 width=120 
                                border=0>
              <tr>
                <td style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%" name=agif></td>
                <td height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width=1 name=zgif></td>
              </tr>
              <tr>
                <td height=23><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width=1 name=agif2></td>
                <td vAlign=center noWrap align=middle width=120><table cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                  <form action="" method="post" name="frmpage">
                    <tr>
                      <td class=tablefooter noWrap>&nbsp;
                                  <!--- Page ---></td>
                      <td class=tablefooter noWrap>Page :
                        <? if(strlen($value)){?>
                                  <SELECT onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&look_search=yes&txtsearch=<?=$value?>')" name="selpage" id="selpage">
                                    <? }else{ ?>
                                    <SELECT onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name="selpage" id="selpage">
                                    <? } ?>
                                    <? for($i=1;$i<=$page;$i++){
                                                            $val = $i*20;
                                                        ?>
                                    <? if(isset($_GET["page"])){
										if(!intval(uriParam("page"))){
											echo "Invalid Input()";die();
										  }
									?>
                                    <OPTION value="<?=$val?>" <? if(uriParam("page")==$val){ echo " selected";}?>>
                                    <?=$i?>
                                    </OPTION>
                                    <? }else{ ?>
                                    <OPTION value="<?=$val?>">
                                    <?=$i?>
                                    </OPTION>
                                    <? }
                                                    } ?>
                                  </SELECT>
                        of
                        <?=$page?></td>
                      <td class=tablefooter noWrap></td>
                    </tr>
                  </form>
                </table></td>
              </tr>
              <tr>
                <!--- End Of Page Counter --->
                <td style="HEIGHT: 1px" colSpan=3><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%" 
                                name=zgif2></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
