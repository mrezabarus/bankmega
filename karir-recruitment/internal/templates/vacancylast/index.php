<?
	require_once("../../config.php");
	$region=cmsDB();
	$cp = cmsDB();

	$cp->query("SELECT * FROM tbl_hrm_user WHERE user_id = ".$_SESSION["user_id" . date("mdY")]."");
	$cp->next();
	$full_name = $cp->row("full_name");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>

<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tooltip.js"></script>

<table class="heading2" cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
  <tr>
    <td class="tableheader"><!--- HEADER --->
        <table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tr>
            <td class="tableheader">&nbsp;Vacant Position List</td>
            <td align="right"><table width="0">
                <tr>
                  <td><input type="image" style="border:none" onclick="get_method('templates/vacancy/index.php?search=yes')" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
      <tr>
        <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" /></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="sample_form" id="sample_form" enctype="multipart/form-data">
      <? 
	    if(isset($_GET["search"]) || isset($_POST["search"])){
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
      <table cellspacing="0" cellpadding="2" border="0">
        <tr>
          <td align="left"><b>Search For</b></td>
          <td align="left"><b>:</b></td>
          <td>&nbsp;<input type="text" name="txtsearch" size="30" value="<?=$value?>" /></td>
          <td>&nbsp;<input type="button" value="Search" style="cursor:hand" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtsearch','search=yes&look_search=yes&refresh=<?=md5("mdYHis")?>')" /></td>
          <td>&nbsp;<input type="button" value="Cancel" style="cursor:hand" onclick="get_method('templates/vacancy/index.php')" /></td>
          <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onmouseover="return overlay(this, 'tanya_3')" onmouseout="overlayclose('tanya_3');" border="0" style="cursor:hand" />
                <div id="tanya_3" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
                  <div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                      <font color="#FF0000">*</font> Position <br />
                      <font color="#FF0000">*</font> Status <br />
                      <font color="#FF0000">*</font> Region <br />
                      <font color="#FF0000">*</font> Branch</b></font></div>
                </div></td>
        </tr>
      </table>
      <? } 
	  }?>
    </form>
        <table cellspacing="0" cellpadding="1" border="0">
          <tr>
            <td width="0" height="20">&nbsp;
                <? if(listFind($_SESSION["ss_id" . date("mdY")],"7")){?>
                <input type="image" style="border:none" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" onclick="get_method('templates/vacancy/new.php')" alt="create new" align="bottom" />
                <? } ?>
            </td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
      <tr>
        <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" /></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="heading2"><table width="100%" class="heading2" cellspacing="1" cellpadding="2" align="center" border="0">
      <!--- RecordList Field --->
      <tr class="heading2">
        <td class="heading2" nowrap="nowrap" align="center">No.</td>
        <td class="heading2" nowrap="nowrap" align="center">Position (Qty)</td>
        <td class="heading2" nowrap="nowrap" align="center">Req Description</td>        
        <td class="heading2" nowrap="nowrap" align="center">Status</td>
        <td class="heading2" nowrap="nowrap" align="center">Region</td>
        <td class="heading2" nowrap="nowrap" align="center">Branch</td>
        <td class="heading2" nowrap="nowrap" align="center">Grade</td>
        <td class="heading2" nowrap="nowrap" align="center">Tanggal Approved</td>
        <td class="heading2" nowrap="nowrap" align="center">Bulan Expired</td>
      </tr>
      <!--- RecordList Field --->
      <tr>
        <td class="heading2" colspan="9"><table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tr>
            <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" /></td>
          </tr>
          <tr>
            <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" /></td>
          </tr>
        </table></td>
      </tr>
      <?
                      $vacancy=cmsDB();
                      if(isset($_POST["look_search"]) || isset($_GET["look_search"])){						
                            $strsql = "SELECT tbl_branch_mpp_apply.*,tbl_branch.branch_name,
                                              tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
                                        FROM tbl_branch_mpp_apply 
                                        INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id = tbl_branch.branch_id
                                        INNER JOIN tbl_region on tbl_branch.region_id = tbl_region.region_id  
                                        INNER JOIN tbl_golongan on tbl_golongan.gol_id = tbl_branch_mpp_apply.gol_id 
                                        INNER JOIN tbl_position on tbl_position.position_id = tbl_branch_mpp_apply.position_id 
                                        WHERE (tbl_position.position_name like '%".trim($value)."%' 
                                        OR tbl_region.region_name like '%".trim($value)."%' 
                                        OR tbl_branch.branch_name like '%".trim($value)."%'
                                        OR tbl_golongan.name like '%".trim($value)."%'
										OR tbl_branch_mpp_apply.request_status like '%".trim($value)."%')";
                        }else{
                            $strsql = "SELECT tbl_branch_mpp_apply.*,tbl_branch.branch_name,
                                              tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
                                       FROM tbl_branch_mpp_apply 
                                       INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id
                                       INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id  
                                       INNER JOIN tbl_golongan on tbl_golongan.gol_id=tbl_branch_mpp_apply.gol_id 
                                       INNER JOIN tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id
									   WHERE 1";
                        }
						if(isset($_SESSION["ssbranch_id" . date("mdY")])){
							$strsql = $strsql . " AND tbl_branch_mpp_apply.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
						}
                        $strsql = $strsql . " order by mpppos_id desc";

                       $vacancy->query($strsql);
                       $num_rows_answer = $vacancy->recordCount();
                       $page = ceil($num_rows_answer/20);
                       if (round($page) == 0){
                         $page = 1;
                       }
                       
					  if(isset($_POST["look_search"]) || isset($_GET["look_search"])){
                            $strsql = "SELECT tbl_branch_mpp_apply.*,tbl_branch.branch_name,
                                              tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
                                        FROM tbl_branch_mpp_apply 
                                        INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id = tbl_branch.branch_id
                                        INNER JOIN tbl_region on tbl_branch.region_id = tbl_region.region_id  
                                        INNER JOIN tbl_golongan on tbl_golongan.gol_id = tbl_branch_mpp_apply.gol_id 
                                        INNER JOIN tbl_position on tbl_position.position_id = tbl_branch_mpp_apply.position_id 
                                        WHERE (tbl_position.position_name like '%".trim($value)."%' 
                                        OR tbl_region.region_name like '%".trim($value)."%' 
                                        OR tbl_branch.branch_name like '%".trim($value)."%'
                                        OR tbl_golongan.name like '%".trim($value)."%'
										OR tbl_branch_mpp_apply.request_status like '%".trim($value)."%')";
                        }else{
                            $strsql = "SELECT tbl_branch_mpp_apply.*,tbl_branch.branch_name,
                                              tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
                                       FROM tbl_branch_mpp_apply 
                                       INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id
                                       INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id  
                                       INNER JOIN tbl_golongan on tbl_golongan.gol_id=tbl_branch_mpp_apply.gol_id 
                                       INNER JOIN tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id
									   WHERE 1";
                        }
						if(isset($_SESSION["ssbranch_id" . date("mdY")])){
							$strsql = $strsql . " AND tbl_branch_mpp_apply.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
						}
                        $strsql = $strsql . " order by mpppos_id desc";
                      
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
					  $vacancy->query($strsql);
                      if($vacancy->recordCount()){
                            $clas=1;
                            while($vacancy->next()){
                      ?>
      <tr class="<? if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>">
        <td valign="top" align="left"><?=$no?>.</td>
        <td valign="top" align="left"><? if(listFind($_SESSION["ss_id" . date("mdY")],"9")){?>
              <a href="javascript:get_method('templates/vacancy/view.php?mpppos_id=<?=$vacancy->row("mpppos_id")?>')">
              <? } ?>
              <?=$vacancy->row("position_name")?>
                (
                <?=$vacancy->row("qty")?>
                )
                <? if(listFind($_SESSION["ss_id" . date("mdY")],"9")){ ?>
              </a>
              <? } ?>
        </td>
        <td valign="top" align="left"><?=$vacancy->row("mpp_requirement")?></td>
        <td valign="top" align="center"><b>
          <?
			if($vacancy->row("request_status")=='new'){
				echo "<font color=\"brown\"><blink>New</blink></font>";
			}elseif($vacancy->row("request_status")=='approved'){
				echo "<font color=\"blue\">Approved</font>";
			}elseif($vacancy->row("request_status")=='done'){
				echo "<font color=\"green\">".$vacancy->row("request_status")."</font>";
			}else{
				echo "<font color=\"red\">".$vacancy->row("request_status")."</font>";
			}
		?>
        </b></td>
        <td valign="top" align="left"><?=$vacancy->row("region_name")?></td>
        <td valign="top" align="left"><?=$vacancy->row("branch_name")?></td>
        <td valign="top" align="center"><?=$vacancy->row("name")?></td>
        <td align="center" valign="top"><?=datesql2date($vacancy->row("approve_date"))?></td>
        <td align="center" valign="top"><? echo date("F",mktime (0,0,0,$vacancy->row("month_dateline"),date("d"),  date("Y")));?></td>
      </tr>
      <?
		$clas=$clas*-1;
		$no++;
		}
       }else{ 
	   ?>
      <tr class="tablebodyeven">
        <td colspan="9" valign="top" align="center">No record found</td>
      </tr>
      <? } ?>
      <!--- End Of Record --->
      <tr>
        <td colspan="9"><table cellspacing="1" cellpadding="1" width="100%" border="0">
          <tr>
            <td class="tablefooter" align="left" width="100%"><table cellspacing="0" cellpadding="0" width="100%" border="0">
              <tr>
                <td style="HEIGHT: 1px" colspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif" width="100%" height="1" id="agif" /></td>
                <td height="23" rowspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif" width="1" height="100%" id="zgif" /></td>
              </tr>
              <tr>
                <td height="23"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif2" width="1" height="100%" id="agif2" /></td>
                <td class="formtext" valign="center" nowrap align="left" width="100%">&nbsp;<b>Login As : <font color="#0000FF"><?=$full_name;?></font></b></td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colspan="3"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif2" width="100%" height="1" id="zgif2" /></td>
              </tr>
            </table></td>
            <td class="tablefooter" valign="center" nowrap align="middle"><table cellspacing="0" cellpadding="0" width="120" border="0">
              <tr>
                <td style="HEIGHT: 1px" colspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif" width="100%" height="1" id="agif" /></td>
                <td height="23" rowspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif" width="1" height="100%" id="zgif" /></td>
              </tr>
              <tr>
                <td height="23"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif2" width="1" height="100%" id="agif2" /></td>
                <td valign="center" nowrap="nowrap" align="middle" width="120">&nbsp;</td>
              </tr>
              <tr>
                <td style="HEIGHT: 1px" colspan="3"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif2" width="100%" height="1" id="zgif2" /></td>
              </tr>
            </table></td>
            <td class="tablefooter" valign="center" nowrap="nowrap" align="middle">
            <table cellspacing="0" cellpadding="0" width="120" border="0">
              <tr>
                <td style="HEIGHT: 1px" colspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif" width="100%" height="1" id="agif" /></td>
                <td height="23" rowspan="2"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif" width="1" height="100%" id="zgif" /></td>
              </tr>
              <tr>
                <td height="23"><img src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" name="agif2" width="1" height="100%" id="agif2" /></td>
                <td valign="center" nowrap="nowrap" align="middle" width="120">
                <table cellspacing="0" cellpadding="0" width="100%" border="0">
                  <!--- Page Counter --->
                  <form action="" method="post" name="frmpage" id="frmpage">
                    <tr>
                      <td class="tablefooter" nowrap="nowrap">&nbsp;</td>
                      <td class="tablefooter" nowrap="nowrap">Page :
                        <? if(strlen($value)){?>
									<select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>&look_search=yes')" name="selpage" id="selpage">									                           
                                    <? }else{ ?>
                                    <select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name="selpage" id="selpage">  
                                    <? } ?>
                                    <? for($i=1;$i<=$page;$i++){
                                                        $val = $i*20;
                                                    ?>
                                    <? if(isset($_GET["page"])){
									if(!intval(uriParam("page"))){
											echo "Invalid Input()";die();
										  }
									?>
                                    <option value="<?=$val?>" <? if(uriParam("page")==$val){ echo " selected";}?>><?=$i?></option>
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
              <tr>
                <!--- End Of Page Counter --->
                <td style="HEIGHT: 1px" colspan="3"><img src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" name="zgif2" width="100%" height="1" id="zgif2" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>