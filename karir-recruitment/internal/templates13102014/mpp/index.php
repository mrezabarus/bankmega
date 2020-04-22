<?
	require_once("../../config.php");

	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user_new WHERE user_id = '".$_SESSION["user_id" . date("mdY")]."'");
	$cp->next();
	$full_name = $cp->row("full_name");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tanya.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>js_button.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js"></script>
<table class="heading2" cellSpacing=0 cellPadding=0 width="100%" align="center" border=0>
  <tr>
    <td class=tableheader><table cellSpacing=0 cellPadding=0 width="100%" border=0>
      <tr>
        <td class=tableheader>&nbsp;Man Power Planing </td>
        <td align=right><table width=0>
          <tr>
            <td><input type="image" style="border:none" onClick="get_method('templates/mpp/index.php?search=yes')" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table cellSpacing=0 cellPadding=0 width="100%" border=0>
      <tr>
        <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="sample_form" id="sample_form">
      <? 
	    if(isset($_GET["search"]) || isset($_POST["search"])){
		if(isset($_POST["look_search"])){
			$value=$_POST["txtsearch"];
		}elseif(isset($_GET["txtsearch"])){
			$value=$_GET["txtsearch"];
		}else{
			$value="";
		}
		if(isset($_GET["txtsearch"]) && strlen($value)==0){
		}else{
		?>
      <table cellSpacing=0 cellPadding=2 border=0>
        <tr>
          <td align="left"><b>Search For</b></td>
          <td align="left"><b>:</b></td>
          <td>&nbsp;
                <input type="Text" name="txtsearch" size="30" value="<?=$value?>"></td>
          <td>&nbsp;
                <input type="button" value="Search" style="cursor:hand" onClick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtsearch','search=yes&look_search=yes&refresh=<?=md5("mdYHis")?>')"></td>
          <td>&nbsp;
                <input type="Button" value="Cancel" style="cursor:hand" onClick="get_method('templates/mpp/index.php')"></td>
          <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_713')" onMouseOut="overlayclose('tanya_713');" border="0" style="cursor:hand">
                <div id="tanya_713" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
                  <div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                      <font color="#FF0000">*</font> Region <br />
                      <font color="#FF0000">*</font> MPP Apply <br />
                      <font color="#FF0000">*</font> MPP Approved <br />
                      <font color="#FF0000">*</font> Tahun <br />
                      <font color="#FF0000">*</font> User name</b></font></div>
                </div></td>
        </tr>
      </table>
      <?		}
}?>
    </form>
        <table cellspacing="0" cellpadding="1" border="0">
          <tr>
            <td>&nbsp;
                <? if(listFind($_SESSION["ss_id" . date("mdY")],"2")){?>
                <input type="image" style="border:none" onClick="get_method('templates/mpp/new.php')" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" alt="create new" align="bottom" />
                <? } ?></td>
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
    <td class="heading2"><table width="100%" class="heading2" cellSpacing=1 cellPadding=3 align="center" border=0>
      <!--- RecordList Field --->
      <TR class="heading2">
        <td class="heading2" noWrap align="center">No.</td>
        <td class="heading2" noWrap align="center">Year</td>
        <td class="heading2" noWrap align="center">Region</td>
        <td class="heading2" noWrap align="center">Budget</td>
        <td class="heading2" noWrap align="center">MPP Apply</td>
        <td class="heading2" noWrap align="center">MPP Approved</td>
        <td class="heading2" noWrap align="center">MPP Achieved</td>
        <td class="heading2" noWrap align="center">Insert by</td>
      </tr>
      <!--- RecordList Field --->
      <tr>
        <!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
        <td class="heading2" colSpan=8><table cellSpacing=0 cellPadding=0 width="100%" border=0>
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
										  $mpp_branch=cmsDB();
										  if(isset($_POST["look_search"])){
											$strsql = "SELECT tbl_region_mpp.*,tbl_region.region_name,tbl_hrm_user_new.user_name 
													   FROM tbl_region_mpp 
													   INNER JOIN tbl_region on tbl_region_mpp.region_id=tbl_region.region_id 
													   INNER JOIN tbl_hrm_user_new on tbl_region_mpp.user_id=tbl_hrm_user_new.user_id 
													   WHERE tbl_region_mpp.region_id in (".$_SESSION["ssregion_id" . date("mdY")].")
													   AND (tbl_region_mpp.year_date like '%".trim($value)."%'
													   OR tbl_region.region_name like '%".trim($value)."%'
													   OR tbl_region_mpp.hacc_val_apply like '%".trim($value)."%'
													   OR tbl_region_mpp.hacc_val_approve like '%".trim($value)."%'
													   OR tbl_hrm_user_new.user_name like '%".trim($value)."%')
													   ORDER BY tbl_region_mpp.year_date desc";
										}else{
											$strsql = "SELECT tbl_region_mpp.*,tbl_region.region_name,tbl_hrm_user_new.user_name 
									  				   FROM tbl_region_mpp 
													   INNER JOIN tbl_region on tbl_region_mpp.region_id=tbl_region.region_id 
												       INNER JOIN tbl_hrm_user_new on tbl_region_mpp.user_id=tbl_hrm_user_new.user_id
													   WHERE (tbl_region_mpp.region_id in (".$_SESSION["ssregion_id" . date("mdY")]."))
													   ORDER BY tbl_region_mpp.year_date desc";
											}

										  $mpp->query($strsql);
										  $num_rows_answer = $mpp->recordCount();
										  $page = ceil($num_rows_answer/20);
										  if (round($page) == 0){
											$page = 1;
										  }
									    if(isset($_POST["look_search"])){
											$strsql = "SELECT tbl_region_mpp.*,tbl_region.region_name,tbl_hrm_user_new.full_name 
													   FROM tbl_region_mpp 
													   INNER JOIN tbl_region on tbl_region_mpp.region_id=tbl_region.region_id 
													   INNER JOIN tbl_hrm_user_new on tbl_region_mpp.user_id=tbl_hrm_user_new.user_id 
													   WHERE tbl_region_mpp.region_id in (".$_SESSION["ssregion_id" . date("mdY")].")
													   AND (tbl_region_mpp.year_date like '%".trim($value)."%'
													   OR tbl_region.region_name like '%".trim($value)."%'
													   OR tbl_region_mpp.hacc_val_apply like '%".trim($value)."%'
													   OR tbl_region_mpp.hacc_val_approve like '%".trim($value)."%'
													   OR tbl_hrm_user_new.user_name like '%".trim($value)."%')
													   ORDER BY tbl_region_mpp.year_date desc";
										}else{
											$strsql = "SELECT tbl_region_mpp.*,tbl_region.region_name,tbl_hrm_user_new.full_name 
									  				   FROM tbl_region_mpp 
													   INNER JOIN tbl_region on tbl_region_mpp.region_id=tbl_region.region_id 
												       INNER JOIN tbl_hrm_user_new  on tbl_region_mpp.user_id=tbl_hrm_user_new.user_id
													   WHERE (tbl_region_mpp.region_id in (".$_SESSION["ssregion_id" . date("mdY")]."))
													   ORDER BY tbl_region_mpp.year_date desc";
										}
										
										if(isset($_GET["paging"])){
											$limit = uriParam("page") - 20;
											$strsql = $strsql . " limit ".$limit.",20";
											$no = $limit+1;
										}else{
											$strsql = $strsql . " limit 0,20";
											$no = 1;
										}
										
										$mpp->query($strsql);
										 if($mpp->recordCount()){
												$clas=1;
										  		while($mpp->next()){
										  ?>
      <TR class=<?if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>>
        <td vAlign=top align="center"><?=$no?>
          .</td>
        <td vAlign=top align="center"><?=$mpp->row("year_date")?></td>
        <td vAlign=top align=left><? if(listFind($_SESSION["ss_id" . date("mdY")],"4")){?>
              <a href="javascript:get_method('templates/mpp/view.php?hacc_id=<?=$mpp->row("hacc_id")?>')">
              <? } ?>
              <?=$mpp->row("region_name");
													 if(listFind($_SESSION["ss_id" . date("mdY")],"4")){?>
              </a>
              <?
			          $strsql = "SELECT tbl_branch_mpp_apply.mpppos_id,tbl_branch_mpp_apply.qty,tbl_branch.branch_name,tbl_position.position_name,tbl_golongan.name 
			                     FROM tbl_branch_mpp_apply 
								 INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id
								 INNER JOIN tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id
								 INNER JOIN tbl_golongan ON tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
								 WHERE tbl_branch_mpp_apply.hacc_id = ".$mpp->row("hacc_id")."
								 AND (tbl_branch_mpp_apply.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")]."))";
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
								 INNER JOIN tbl_offering_letter on tbl_ijin_prinsip.ip_id=tbl_offering_letter.ip_id 
								 WHERE tbl_offering_letter.is_approved='yes' and tbl_ijin_prinsip.jstest_id in (".$lstjstest_id.")");
			 $achieved = $mpp_branch->recordCount();
			 }
			 ?></td>
        <td vAlign=top align="right"><?=number_format($mpp->row("budget"),0, '.', ',')?></td>
        <td vAlign=top align="center"><?=$mpp->row("hacc_val_apply")?></td>
        <td align="center" vAlign=top><?=$mpp->row("hacc_val_approve")?></td>
        <td align="center" vAlign=top><?=$achieved?></td>
        <td vAlign=top><?=$mpp->row("full_name")?></td>
      </tr>
      <?
													$clas=$clas*-1;
													$no++;
												}
										   }else{ ?>
      <TR class=tablebodyeven>
        <td colspan="8" vAlign=top align="center">No record found</td>
      </tr>
      <? } ?>
      <tr>
        <td class="tablefooter" align="middle" colSpan=8><table cellSpacing="1" cellPadding="1" width="100%" border="0">
          <tr>
            <td class="tablefooter" align=left width="100%"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
              <tr>
                <td style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%" name=agif></td>
                <td height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width=1 name=zgif></td>
              </tr>
              <tr>
                <td height=23><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width=1 name=agif2></td>
                <td class=formtext valign="center" noWrap align=left width="100%">&nbsp;<b>Login As : <font color="#0000FF"><?=$full_name;?></font></b></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colSpan=3><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" name=zgif2></td>
              </tr>
            </table></td>
            <td class="tablefooter" valign="center" noWrap 
                                align="middle"><table cellSpacing=0 cellPadding=0 width=120 
                                border=0>
              <tr>
                <td style="HEIGHT: 1px" colSpan=2><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" name=agif></td>
                <td height=23 rowSpan=2><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width=1 name=zgif></td>
              </tr>
              <tr>
                <td height=23><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width=1 name=agif2></td>
                <td valign="center" noWrap align="middle" width=120><table cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                  <tr>
                    <td class="tablefooter" valign="center" noWrap align="middle">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colSpan=3><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" name=zgif2></td>
              </tr>
            </table></td>
            <td class="tablefooter" valign="center" noWrap align="middle"><table cellSpacing=0 cellPadding=0 width=120 border=0>
              <tr>
                <td style="HEIGHT: 1px" colSpan=2><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" name=agif></td>
                <td height=23 rowSpan=2><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width=1 name=zgif></td>
              </tr>
              <tr>
                <td height=23><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width=1 name=agif2></td>
                <td valign="center" noWrap align="middle" width=120><table cellSpacing=0 cellPadding=0 width="100%" border=0>
                  <!--- Page Counter --->
                  <form action="" method="post" name="frmpage">
                    <tr>
                      <td class="tablefooter" noWrap>&nbsp;</td>
                      <td class="tablefooter" noWrap>Page :
                        <? if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){?>
                                  <SELECT onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>')" name=selpage>
                                    <? }else{ ?>
                                    <SELECT onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name=selpage>
                                    <? } ?>
                                    <? for($i=1;$i<=$page;$i++){
                                                            $val = $i*20;
                                                        ?>
                                    <? if(isset($_GET["page"])){?>
                                    <OPTION value="<?=$val?>" <? if(uriParam("page")==$val){ echo " selected";}?>>
                                    <?=$i?>
                                    </OPTION>
                                    <? }else{ ?>
                                    <OPTION value="<?=$val?>">
                                    <?=$i?>
                                    </OPTION>
                                    <? }
                                                            }?>
                                  </SELECT>
                        of
                        <?=$page?></td>
                      <td class="tablefooter" noWrap></td>
                    </tr>
                  </form>
                </table></td>
              </tr>
              <tr>
                <!--- End Of Page Counter --->
                <td style="HEIGHT: 1px" colSpan=3><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" name=zgif2></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
