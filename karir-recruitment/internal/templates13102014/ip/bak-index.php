<?
	require_once("../../config.php");

	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$cp->next();
	$full_name = $cp->row("full_name");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>

<table class="heading2" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
  <tr>
    <td class=tableheader><table cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr>
        <td class=tableheader>&nbsp;Ijin Prinsip</td>
        <td align=right><table width=0>
          <tr>
            <td><input type="image" style="border:none" onClick="get_method('templates/ip/index.php?search=yes')" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
      <tr>
        <td style="HEIGHT: 1px"><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="sample_form" id="sample_form" enctype="multipart/form-data">
      <? if(isset($_GET["search"]) || isset($_POST["search"])){
		if(isset($_POST["look_search"]) || isset($_GET["look_search"])){
			$value=$_POST["txtsearch"];
		}elseif(isset($_GET["txtsearch"])){
			$value=$_GET["txtsearch"];
		}else{
			$value="";
		}
		if(isset($_GET["txtsearch"]) && strlen($value)==0){
		
		}else{
		?>
      <table cellspacing="0" cellpadding="2" border="0">
        <tr>
          <td align="right"><b>Search For</b></td>
          <td align="right"><b>:</b></td>
          <td>&nbsp;<input type="Text" name="txtsearch" size="30" value="<?=$value?>"></td>
          <td>&nbsp;<input type="button" value="Search IP" style="cursor:hand" onClick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtsearch','search=yes&look_search=yes')" /></td>
          <td>&nbsp;<input type="Button" value="Cancel" style="cursor:hand" onClick="get_method('templates/ip/index.php')" /></td>
          <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_6')" onMouseOut="overlayclose('tanya_6');" border="0" style="cursor:hand">
                <div id="tanya_6" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
                  <div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                      <font color="#FF0000">*</font> IP No <br />
                      <font color="#FF0000">*</font> IP Date <br />
                      <font color="#FF0000">*</font> Job Seeker Name <br />
                      <font color="#FF0000">*</font> Position <br />
                      <font color="#FF0000">*</font> Status</b></font></div>
                </div></td>
        </tr>
      </table>
      <?		}
}?>
    </form>
        <table cellspacing="0" cellpadding="1" border="0">
          <tr>
            <td width=0 height=20><? if(listFind($_SESSION["ss_id" . date("mdY")],"27")){?>
                <input type="image" style="border:none" onClick="get_method('templates/ip/new.php?new=yes')" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" alt="create new" align="bottom" />
                <? } ?>
            </td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
      <tr>
        <td style="HEIGHT: 1px"><IMG height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><IMG height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="heading2"><table width="100%" class="heading2" cellSpacing="1" cellPadding="3" align="center" border="0">
      <tr class="heading2">
        <td class="heading2" noWrap align=center>No.</td>
        <td class="heading2" noWrap align=center>IP No</td>
        <td class="heading2" noWrap align=center>Tgl Created IP</td>
        <td class="heading2" noWrap align=center>Nama Jobseeker</td>
        <td class="heading2" noWrap align=center>Posisi</td>
        <td class="heading2" noWrap align=center>Status</td>
      </tr>
      <tr>
        <td class="heading2" colSpan=6><table cellSpacing=0 cellPadding=0 width="100%" border=0>
          <tr>
            <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
          </tr>
          <tr>
            <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
          </tr>
        </table></td>
      </tr>
      <?
										  $mpp=cmsDB();
										  if(isset($_POST["look_search"])){
												$strsql = "SELECT *
												FROM tbl_ijin_prinsip
												LEFT JOIN tbl_jobseeker_test ON tbl_ijin_prinsip.jstest_id = tbl_jobseeker_test.jstest_id
												LEFT JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
												LEFT JOIN tbl_branch_mpp_apply ON tbl_position_vacant.mpppos_id = tbl_branch_mpp_apply.mpppos_id
												LEFT JOIN tbl_position ON tbl_branch_mpp_apply.position_id = tbl_position.position_id
												LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												WHERE tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
												AND (ip_no like '%".trim($value)."%'
												OR ip_date like '%".trim($value)."%'
												OR full_name like '%".trim($value)."%'
												OR position_name like '%".trim($value)."%'
												OR rencana_penempatan like '%".trim($value)."%'
												OR ip_status like '%".trim($value)."%')";
										  }else{
												$strsql = "SELECT *
												FROM tbl_ijin_prinsip
												LEFT JOIN tbl_jobseeker_test ON tbl_ijin_prinsip.jstest_id = tbl_jobseeker_test.jstest_id
												LEFT JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
												LEFT JOIN tbl_branch_mpp_apply ON tbl_position_vacant.mpppos_id = tbl_branch_mpp_apply.mpppos_id
												LEFT JOIN tbl_position ON tbl_branch_mpp_apply.position_id = tbl_position.position_id
												LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												WHERE 1";
										  }
											if(isset($_SESSION["ssbranch_id" . date("mdY")])){
												$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
											}
											$strsql = $strsql . " ORDER BY tbl_ijin_prinsip.ip_id desc";

										  $mpp->query($strsql);
										  $num_rows_answer = $mpp->recordCount();
										   $page = ceil($num_rows_answer/20);
										   if (round($page) == 0){
											 $page = 1;
										   }
										  
										  if(isset($_POST["look_search"])){
												$strsql = "SELECT *
												FROM tbl_ijin_prinsip
												LEFT JOIN tbl_jobseeker_test ON tbl_ijin_prinsip.jstest_id = tbl_jobseeker_test.jstest_id
												LEFT JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
												LEFT JOIN tbl_branch_mpp_apply ON tbl_position_vacant.mpppos_id = tbl_branch_mpp_apply.mpppos_id
												LEFT JOIN tbl_position ON tbl_branch_mpp_apply.position_id = tbl_position.position_id
												LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												WHERE tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
												AND (ip_no like '%".trim($value)."%'
												OR ip_date like '%".trim($value)."%'
												OR full_name like '%".trim($value)."%'
												OR position_name like '%".trim($value)."%'
												OR rencana_penempatan like '%".trim($value)."%'
												OR ip_status like '%".trim($value)."%')";
										  }else{
												$strsql = "SELECT *
												FROM tbl_ijin_prinsip
												LEFT JOIN tbl_jobseeker_test ON tbl_ijin_prinsip.jstest_id = tbl_jobseeker_test.jstest_id
												LEFT JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												LEFT JOIN tbl_position_vacant ON tbl_position_vacant.vacantpos_id = tbl_jobseeker_test.vacant_pos_id
												LEFT JOIN tbl_branch_mpp_apply ON tbl_position_vacant.mpppos_id = tbl_branch_mpp_apply.mpppos_id
												LEFT JOIN tbl_position ON tbl_branch_mpp_apply.position_id = tbl_position.position_id
												LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												WHERE 1";
										  }
											if(isset($_SESSION["ssbranch_id" . date("mdY")])){
												$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
											}
											$strsql = $strsql . " ORDER BY tbl_ijin_prinsip.ip_id desc";

										  if(isset($_GET["paging"])){
												$limit = uriParam("page") - 20;
												$strsql = $strsql . " limit ".$limit.",20";
												$no = $limit+1;
										  }else{
												$strsql = $strsql . " limit 0,20";
												$no=1;
										  }
                                        $mpp->query($strsql);
										  if($mpp->recordCount()){
										$jstest = cmsDB();
										$position=cmsDB();
												$clas=1;
										  		while($mpp->next()){
										  ?>
      <tr class=<? if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>>
        <td valign="top" align="center"><?=$no?>.</td>
        <td valign="top" align=left><? if(listFind($_SESSION["ss_id" . date("mdY")],"29")){?>
              <a href="javascript:get_method('templates/ip/view.php?ip_id=<?=$mpp->row("ip_id")?>')">
              <? } ?>
              <?=$mpp->row("ip_no")?>
              <? if(listFind($_SESSION["ss_id" . date("mdY")],"29")){?>
              </a>
              <? } ?></td>
        <td valign="top" align=center><?=datesql2date($mpp->row("ip_date"))?></td>
        <td valign="top"><?
                                        $jstest->query("select tbl_jobseeker.full_name,tbl_jobseeker_test.vacant_pos_id 
										                from tbl_jobseeker_test inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id 
														where tbl_jobseeker_test.jstest_id=".$mpp->row("jstest_id"));
                                        $jstest->next();
                                        $vacant_pos_id = $jstest->row("vacant_pos_id");
                                        echo $jstest->row("full_name");
                                     ?></td>
        <td valign="top"><?
													$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
																from tbl_position 
																inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
																inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
																where tbl_position_vacant.vacantpos_id=" . $vacant_pos_id;
																
													$position->query($strsql);
													$position->next();
													echo "<font color=\"blue\"><b>".$position->row("position_name")."</b></font>" . " (".$mpp->row("rencana_penempatan").")";
													
													?></td>
        <td valign="top" align=center><b><?
													if($mpp->row("ip_status")=="new"){
														echo "<font color=\"brown\"><blink>IP Proses</blink></font>";
													}elseif($mpp->row("ip_status")=="approved"){
														echo "<font color=\"blue\">Approved</font>";
													}else{
														echo "<font color=\"red\">".$mpp->row("ip_status")."</font>";
													}
													?></b></td>
      </tr>
      <?
		$clas=$clas*-1;
		$no++;
	      }
       }else{ 
	  ?>
      <tr class=tablebodyeven>
        <td colspan="6" valign="top" align=center>No record found</td>
      </tr>
      <? } ?>
      <!--- End Of Record --->
      <tr>
        <td class="tablefooter" align=middle colSpan=6><table cellspacing="1" cellpadding="1" width="100%" border="0">
          <tr>
            <td class="tablefooter" align="left" width="100%"><table cellspacing="0" cellpadding="0" width="100%" border="0">
              <tr>
                <td style="HEIGHT: 1px" colspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif" width="100%" height="1" id="agif" /></td>
                <td height="23" rowspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif" width="1" height="100%" id="zgif" /></td>
              </tr>
              <tr>
                <td height="23"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif2" width="1" height="100%" id="agif2" /></td>
                <td class="formtext" valign="center" nowrap="nowrap" align="left" width="100%">&nbsp;<b>Login As : <font color="#0000FF">
                  <?=$full_name;?>
                </font></b></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colspan="3"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif2" width="100%" height="1" id="zgif2" /></td>
              </tr>
            </table></td>
            <td class="tablefooter" valign="center" nowrap="nowrap" align="middle"><table cellspacing="0" cellpadding="0" width="120" border="0">
              <tr>
                <td style="HEIGHT: 1px" colspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif" width="100%" height="1" id="agif" /></td>
                <td height="23" rowspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif" width="1" height="100%" id="zgif" /></td>
              </tr>
              <tr>
                <td height="23"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif2" width="1" height="100%" id="agif2" /></td>
                <td valign="center" nowrap="nowrap" align="middle" width="120"><table cellspacing="0" cellpadding="0" width="100%" border="0">
                  <tr>
                    <td class="tablefooter" valign="center" nowrap="nowrap" align="middle">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colspan="3"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif2" width="100%" height="1" id="zgif2" /></td>
              </tr>
            </table></td>
            <td class="tablefooter" valign="center" nowrap="nowrap" align="middle"><table cellspacing="0" cellpadding="0" width="120" border="0">
              <tr>
                <td style="HEIGHT: 1px" colspan="2"><img 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif" 
                                width="100%" height="1" id="agif" /></td>
                <td height="23" rowspan="2"><img 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif" 
                                width="1" height="100%" id="zgif" /></td>
              </tr>
              <tr>
                <td height="23"><img 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif2" 
                                width="1" height="100%" id="agif2" /></td>
                <td valign="center" nowrap="nowrap" align="middle" width="120"><table cellspacing="0" cellpadding="0" width="100%" 
                                border="0">
                  <form action="" method="post" name="frmpage" id="frmpage">
                    <tr>
                      <td class="tablefooter" nowrap="nowrap">&nbsp;</td>
                      <td class="tablefooter" nowrap="nowrap">Page :
                        <? if(strlen($value)){?>
                                  <select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>&look_search=yes')" name="selpage">
                                    <? }else{ ?>
                                    <select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name="selpage">
                                    <? } ?>
                                    <? for($i=1;$i<=$page;$i++){
                                                $val = $i*20;
                                            ?>
                                    <? if(isset($_GET["page"])){?>
                                    <option value="<?=$val?>" <? if(uriParam("page")==$val){ echo " selected";}?>>
                                    <?=$i?>
                                    </option>
                                    <? }else{ ?>
                                    <option value="<?=$val?>"><?=$i?></option>
                                    <? }
                                            }?>
                                  </select> of <?=$page?></td>
                      <td class="tablefooter" nowrap="nowrap"></td>
                    </tr>
                  </form>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>