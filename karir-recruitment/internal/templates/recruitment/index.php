<?
	require_once("../../config.php");
	/*echo "ss_id : ". $_SESSION["ss_id" . date("mdY")]. "<BR>";
	echo "ssbranch_id : ".$_SESSION["ssbranch_id" . date("mdY")]. "<BR>";
	echo "ssregion_id : ".$_SESSION["ssregion_id" . date("mdY")]. "<BR>";
	echo "user_id : ".$_SESSION["user_id" . date("mdY")]. "<BR>";
	echo "user_name : ".$_SESSION["user_name" . date("mdY")]. "<BR>";
	echo "full_name : ".$_SESSION["full_name" . date("mdY")]. "<BR>";
	*/
	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$cp->next();
	$full_name = $cp->row("full_name");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>tooltip.css" type=text/css rel=stylesheet>
<script language="Javascript">
function BlinkTxt() {
if(document.getElementById && document.all){
obj = document.getElementsByTagName("blink");
for (var i=0; i<obj.length; i++)
if (obj[i].style.visibility=="hidden") {
obj[i].style.visibility="visible";
}
else {
obj[i].style.visibility="hidden";
}
setTimeout('BlinkTxt()',750);
}
}
onload=BlinkTxt;
</script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tanya.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>js_button.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tooltip.js"></script>
<script language="javascript">
function _selsubmit(frm,addr,pars_var){
	addr = addr + '&'+ pars_var +'=' + eval("document."+ frm + ".value");
	get_method(addr);
}
//The difference between POST and GET, POST method support or can transffer large data... 
function preview_ol(){
	PopWindow('templates/ol/previewol.php?selip='+ document.sample_form.selip.value +'&templateol_id='+ document.sample_form.selol.value +'&ol_no=' + document.sample_form.txtno.value,'WindowName', '800', '600', 'scrollbars=yes,location=no,status=yes')
}

function preview_ol2(ol_id){
	PopWindow('templates/ol/previewol.php?ol_id='+ol_id,'WindowName', '800', '600', 'scrollbars=yes,location=no,status=yes')
}

function _goto(addr){
	addr_to = addr + '&page='+ document.frmpage.selpage.options[document.frmpage.selpage.selectedIndex].value;
	location=addr_to;
}

function popwin(addr){
	PopWindow(addr,'WindowName', '800', '600', 'scrollbars=yes,location=no,status=yes')
}
</script>
<table cellSpacing="0" cellPadding="0" width="100%" border="0">
  <tr>
    <td vAlign=top><table class="heading2" cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
      <tr>
        <td class=tableheader><!--- HEADER --->
              <table cellSpacing="0" cellPadding="0" width="100%" border="0">
                <tr>
                  <td class=tableheader>&nbsp;Recruitment Test</td>
                  <td align=right><table width=0>
                      <tr>
                        <td><input type="image" style="border:none" onClick="location='index.php?search=yes';" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
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
        <td><form action="<?=getEnv("script_name")?>?search=yes&look_search=yes&refresh=<?=md5("mdYHis")?>" method="post" name="sample_form" id="sample_form">
          <? if(isset($_GET["search"])){
		if(isset($_GET["look_search"])){
			$value=postParam("txtsearch");
		}elseif(isset($_GET["txtsearch"])){
			$value=uriParam("txtsearch");
		}else{
			$value="";
		}
		if(!isset($_GET["search"]) && strlen($value)==0){
		}else{
		?>
          <table cellSpacing="0" cellPadding="2" border="0">
            <tr>
              <td align="left"><b>Search For</b></td>
              <td align="left"><b>:</b></td>
              <td>&nbsp;
                      <input type="Text" name="txtsearch" size="30" value="<?=$value?>"></td>
              <td>&nbsp;
                      <input type="submit" value="Search" style="cursor:hand"></td>
              <td>&nbsp;
                      <input type="Button" value="Cancel" style="cursor:hand" onClick="location='index.php?refresh=<?=md5("mdYHis")?>'"></td>
              <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_4')" onMouseOut="overlayclose('tanya_4');" border="0" style="cursor:hand">
                      <div id="tanya_4" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
                        <div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                            <font color="#FF0000">*</font> Test No. <br />
                          <font color="#FF0000">*</font> Job Seeker <br />
                          <font color="#FF0000">*</font> Position <br />
                          <font color="#FF0000">*</font> Status <br />
                          <font color="#FF0000">*</font> Region <br />
                          <font color="#FF0000">*</font> Branch</b></font></div>
                      </div></td>
            </tr>
          </table>
          <?		}
}?>
        </form>
              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                <tr>
                  <td><!--- Menu --->
                      <table cellSpacing=1 cellPadding=2 width=0 border=0>
                        <tr>
                          <td width=0 height=20><? if(listFind($_SESSION["ss_id" . date("mdY")],"17")){?>
                              <input type="image" style="border:none" onClick="location='new.php?urlencrypt=<?=md5("mdYHis")?>';" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" alt="create new" align="bottom" />
                              <?}?>
                          </td>
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
        <td class="heading2"><table width="100%" class="heading2" cellSpacing="1" cellPadding="2" align="center" border=0>
          <!--- RecordList Field --->
          <tr class="heading2">
            <td class="heading2" noWrap align="center">No.</td>
            <td class="heading2" noWrap align="center">Test No</td>
            <td class="heading2" noWrap align="center">Nama Jobseeker</td>
            <td class="heading2" noWrap align="center">Posisi</td>
            <td class="heading2" noWrap align="center">Status</td>
            <td class="heading2" noWrap align="center">Region</td>
            <td class="heading2" noWrap align="center">Branch</td>
            <td class="heading2" noWrap align="center">Tgl Created Test</td>
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
										  if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){
										$strsql = "SELECT tbl_jobseeker_test.*,tbl_jobseeker.full_name,tbl_position.position_name,
													      tbl_branch.branch_name,tbl_region.region_name
												   FROM tbl_jobseeker_test
												   INNER JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												   INNER JOIN tbl_position_vacant ON tbl_jobseeker_test.vacant_pos_id = tbl_position_vacant.vacantpos_id
												   INNER JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
												   INNER JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
												   INNER JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												   INNER JOIN tbl_region ON tbl_branch.region_id = tbl_region.region_id
												   WHERE tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
												   AND (tbl_jobseeker_test.test_no like '%".trim($value)."%'
												   OR tbl_jobseeker.full_name like '%".trim($value)."%'
												   OR tbl_position.position_name like '%".trim($value)."%'
												   OR tbl_jobseeker_test.test_status like '%".trim($value)."%'
												   OR tbl_branch.branch_name like '%".trim($value)."%'
												   OR tbl_region.region_name like '%".trim($value)."%'
												   OR tbl_jobseeker_test.test_date like '%".trim($value)."%')";
									}else{
										$strsql = "SELECT tbl_jobseeker_test.*,tbl_jobseeker.full_name,tbl_jobseeker.pict_file,
										                  tbl_position.position_name,tbl_branch.branch_name,tbl_region.region_name
												   FROM tbl_jobseeker_test
												   INNER JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												   INNER JOIN tbl_position_vacant ON tbl_jobseeker_test.vacant_pos_id = tbl_position_vacant.vacantpos_id
												   INNER JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
												   INNER JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
												   INNER JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												   INNER JOIN tbl_region ON tbl_branch.region_id = tbl_region.region_id
												   WHERE 1";
									}
									if(isset($_SESSION["ssbranch_id" . date("mdY")])){
										$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
									}
									$strsql = $strsql . " ORDER BY tbl_jobseeker_test.test_date desc";


										  $mpp->query($strsql);
										  $num_rows_answer = $mpp->recordCount();
										  $page = ceil($num_rows_answer/20);
										  if (round($page) == 0){
											$page = 1;
										  }
									    if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){
										$strsql = "SELECT tbl_jobseeker_test.*,tbl_jobseeker.full_name,tbl_jobseeker.pict_file,
										                  tbl_position.position_name,tbl_branch.branch_name,tbl_region.region_name
												   FROM tbl_jobseeker_test
												   INNER JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												   INNER JOIN tbl_position_vacant ON tbl_jobseeker_test.vacant_pos_id = tbl_position_vacant.vacantpos_id
												   INNER JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
												   INNER JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
												   INNER JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												   INNER JOIN tbl_region ON tbl_branch.region_id = tbl_region.region_id
												   WHERE tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")
												   AND (tbl_jobseeker_test.test_no like '%".trim($value)."%'
												   OR tbl_jobseeker.full_name like '%".trim($value)."%'
												   OR tbl_position.position_name like '%".trim($value)."%'
												   OR tbl_jobseeker_test.test_status like '%".trim($value)."%'
												   OR tbl_branch.branch_name like '%".trim($value)."%'
												   OR tbl_region.region_name like '%".trim($value)."%'
												   OR tbl_jobseeker_test.test_date like '%".trim($value)."%')";
									}else{
										$strsql = "SELECT tbl_jobseeker_test.*,tbl_jobseeker.full_name,tbl_jobseeker.pict_file,
										                  tbl_position.position_name,tbl_branch.branch_name,tbl_region.region_name
												   FROM tbl_jobseeker_test
												   INNER JOIN tbl_jobseeker ON tbl_jobseeker_test.js_id = tbl_jobseeker.js_id
												   INNER JOIN tbl_position_vacant ON tbl_jobseeker_test.vacant_pos_id = tbl_position_vacant.vacantpos_id
												   INNER JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.mpppos_id = tbl_position_vacant.mpppos_id
												   INNER JOIN tbl_position ON tbl_position.position_id = tbl_branch_mpp_apply.position_id
												   INNER JOIN tbl_branch ON tbl_branch.branch_id = tbl_branch_mpp_apply.branch_id
												   INNER JOIN tbl_region ON tbl_branch.region_id = tbl_region.region_id
												   WHERE 1";
									}
									if(isset($_SESSION["ssbranch_id" . date("mdY")])){
										$strsql = $strsql . " AND tbl_branch.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
									}
									$strsql = $strsql . " ORDER BY tbl_jobseeker_test.test_date desc";

										if(isset($_GET["paging"])){
											if(!intval(uriParam("page"))){
												echo "Invalid Input()";die();
											  }
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
          <tr class=<?if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>>
            <td vAlign=top align="center"><?=$no?>
              .</td>
            <td vAlign=top align="left"><? if(listFind($_SESSION["ss_id" . date("mdY")],"19")){?>
                    <a href="javascript:location='view.php?edit=yes&jstest_id=<?=$mpp->row("jstest_id")?>';" onMouseover="tip('<center><b><?=$mpp->row("full_name")?></b> <br /><img src=<?=$ANOM_VARS["www_img_url"]?>js_photo/<?=$mpp->row("pict_file")?> width=110 height=150 /></center>' ,120)"; onMouseout="hide_tip()">
                    <? } ?>
                    <?=$mpp->row("test_no")?>
                    <? if(listFind($_SESSION["ss_id" . date("mdY")],"19")){?>
                    </a>
                    <? } ?></td>
            <td align="left"><?=$mpp->row("full_name")?></td>
            <td align="left"><?=$mpp->row("position_name")?></td>
            <td align="center"><b>
              <?
													if($mpp->row("test_status") == "passed"){
													 	echo "<center><font color=\"Blue\">Test Lulus</font></center>";
													}elseif($mpp->row("test_status") =="failed"){
														echo "<center><font color=\"red\">Test Gagal</font></center>";
													}elseif($mpp->row("test_status") =="new"){
														echo "<center><font color=\"brown\"><blink>Test Process</blink></font></center>";
													}?>
            </b></td>
            <td align="left"><?=$mpp->row("region_name")?></td>
            <td align="left"><?=$mpp->row("branch_name")?></td>
            <td vAlign=top align="center"><?=datesql2date($mpp->row("test_date"))?></td>
          </tr>
          <?
													$clas=$clas*-1;
													$no++;
												}?>
          <? }else{ ?>
          <tr class=tablebodyeven>
            <td colspan="8" vAlign=top align="center">No record found</td>
          </tr>
          <? } ?>
          <!--- End Of Record --->
          <tr>
            <!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
            <td class=tablefooter align=middle colSpan=8><table cellSpacing=1 cellPadding=1 width="100%" 
                                border=0>
              <tr>
                <td class=tablefooter align="left" width="100%"><table cellSpacing=0 cellPadding=0 width="100%" 
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
                    <td class=formtext valign="center" noWrap 
                                align="left" width="100%">&nbsp;<b>Login As : <font color="#0000FF">
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
                <td class=tablefooter valign="center" noWrap 
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
                    <td valign="center" noWrap align=middle width=120><table cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                      <tr>
                        <td class=tablefooter valign="center" noWrap 
                                align=middle>&nbsp;</td>
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
                <td class=tablefooter valign="center" noWrap align=middle><table cellSpacing=0 cellPadding=0 width=120 
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
                    <td valign="center" noWrap align=middle width=120><table cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                      <form action="" method="post" name="frmpage">
                        <tr>
                          <td class=tablefooter noWrap>&nbsp;
                                        <!--- Page ---></td>
                          <td class=tablefooter noWrap>Page
                            :
                            <? if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){?>
                                        <SELECT onChange="_goto('<?=getEnv("script_name")?>?paging=yes&search=yes&txtsearch=<?=$value?>')" name=selpage>
                                          <? }else{ ?>
                                          <SELECT onChange="_goto('<?=getEnv("script_name")?>?paging=yes')" name=selpage>
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
    </table></td>
  </tr>
</table>
