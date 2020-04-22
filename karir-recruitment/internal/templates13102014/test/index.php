<?
	require_once("../../config.php");

	$cp = cmsDB();
	$cp->query("SELECT * FROM tbl_hrm_user_new WHERE user_id = '".$_SESSION["user_id" . date("mdY")]."'");
	$cp->next();
	$full_name = $cp->row("full_name");
?>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<script language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>js_button.js" type=text/javascript></SCRIPT>
<script language=JavaScript src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js" type=text/javascript></SCRIPT>
<table cellSpacing="0" cellPadding="0" width="100%" border="0">
  <tr>
    <td vAlign=top>
    <table class=heading2 cellSpacing="0" cellPadding="0" width="100%" align="center" border="0">
      <tr>
        <td class=tableheader><!--- HEADER --->
              <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                <tr>
                  <td class=tableheader>&nbsp;Test Management</td>
                  <td align=right><table width=0>
                      <tr>
                        <td><input type="image" style="border:none" onClick="get_method('templates/test/index.php?search=yes')" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
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
        <td><table cellSpacing=0 cellPadding=0 width="100%" border=0>
          <tr>
            <td><!--- Menu --->
                    <form action="" method="post" name="sample_form" id="sample_form">
                      <? if(isset($_GET["search"]) || isset($_POST["search"])){
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
                      <table cellSpacing="0" cellPadding="2" border=0>
                        <tr>
                          <td><b>Search For</b></td>
                          <td><b>:</b></td>
                          <td>&nbsp;
                              <input type="Text" name="txtsearch" size="30" value="<?=$value?>"></td>
                          <td>&nbsp;
                              <input type="button" value="Search" style="cursor:hand" onClick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtsearch','search=yes&look_search=yes&refresh=<?=md5("mdYHis")?>')" /></td>
                          <td>&nbsp;
                              <input type="Button" value="Cancel" style="cursor:hand" onClick="get_method('templates/test/index.php')" /></td>
                          <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_5')" onMouseOut="overlayclose('tanya_5');" border="0" style="cursor:hand">
                              <div id="tanya_5" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
                                <div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                                    <font color="#FF0000">*</font> Group Test <br />
                                  <font color="#FF0000">*</font> Description</b></font></div>
                              </div></td>
                        </tr>
                      </table>
                      <?		}
}?>
                    </form>
              <table cellSpacing=1 cellPadding=2 width=0 border=0>
                      <tr>
                        <td width=0 height=20><? if(listFind($_SESSION["ss_id" . date("mdY")],"22")){?>
                            <input type="image" style="border:none" onClick="get_method('templates/test/new.php?refresh=<?=date("mdY His")?>')" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" alt="create new" align="bottom" />
                            <? } ?>
                        </td>
                      </tr>
              </table>
              <!--- End Of Menu ---></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
          <tr>
            <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
          </tr>
          <tr>
            <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class=heading2><table class=heading2 cellSpacing=1 cellPadding=3 width="100%" align=center border=0>
          <!--- RecordList Field --->
          <tr class=heading2>
            <td class=heading2 noWrap align=center width="5%">No.</td>
            <td class=heading2 noWrap align=center width="20%" height=25>Group Test</td>
            <td class=heading2 noWrap align=center width="30%" height=25>Keterangan</td>
            <td class=heading2 noWrap align=center width="20%" height=25>Nilai
              Kelulusan</td>
            <td class=heading2 noWrap align=center width="25%" height=25>Test Detail&nbsp;</td>
          </tr>
          <!--- RecordList Field --->
          <tr>
            <!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
            <td class=heading2 colSpan=6 width="100%"><table cellSpacing=0 cellPadding=0 width="100%" border=0>
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
										  $test=cmsDB();
										  if(isset($_POST["look_search"])){
												$strsql = "select * from tbl_grouptest where grouptest_name like '%".trim($value)."%' order by grouptest_name desc";
											}else{
												$strsql = "select * from tbl_grouptest order by grouptest_name desc";
											}
										  //echo $strsql;
										  $mpp->query($strsql);
										  $num_rows_answer = $mpp->recordCount();
										   $page = ceil($num_rows_answer/20);
										   if (round($page) == 0){
											 $page = 1;
										   }
										   
										    if(isset($_POST["look_search"])){
												$strsql = "select * from tbl_grouptest where grouptest_name like '%".trim($value)."%' order by grouptest_name desc";
											}else{
												$strsql = "select * from tbl_grouptest order by grouptest_name desc";
											}
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
												$clas=1;
										  		while($mpp->next()){
										  ?>
          <tr class=<? if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>>
            <td vAlign=top align=right><?=$no?>
              .</td>
            <td vAlign=top align=left><? if(listFind($_SESSION["ss_id" . date("mdY")],"24")){?>
                    <a href="javascript:get_method('templates/test/view.php?grouptest_id=<?=$mpp->row("grouptest_id")?>&refresh=<?=md5("mdYHis")?>')">
                    <? } ?>
                    <?=$mpp->row("grouptest_name")?>
                    <? if(listFind($_SESSION["ss_id" . date("mdY")],"24")){?>
                    </a>
                    <? } ?>
            </td>
            <td vAlign=top align=left><?=$mpp->row("grouptest_desc")?></td>
            <td vAlign=top align=left><strong>A :</strong>
                    <?=$mpp->row("min_a")?>
              - <b>B : </b>
              <?=$mpp->row("min_b")?>
              - <b>C : </b>
              <?=$mpp->row("min_c")?>
              - <b>D : </b>
              <?=$mpp->row("min_d")?></td>
            <td vAlign=top align=center><?
													$test->query("select * from tbl_test where grouptest_id=".$mpp->row("grouptest_id"));
													if($test->recordCount()){?>
                    <table width="100%" cellpadding="2" cellspacing="0" border="0">
                      <? while($test->next()){?>
                      <tr>
                        <td><?=$test->row("test_name")?></td>
                        <!-- td><?=$test->row("bobot")?>%</td -->
                      </tr>
                      <? } ?>
                    </table>
              <? }else{
														echo "No Test Detail";
													}?>
            </td>
          </tr>
          <?
													$clas=$clas*-1;
													$no++;
												}?>
          <? }else{ ?>
          <tr class=tablebodyeven>
            <td colspan="6" vAlign=top align=center>No record found</td>
          </tr>
          <? } ?>
          <!--- End Of Record --->
          <tr>
            <!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
            <td class=tablefooter align=middle colSpan=6 width="100%"><table cellSpacing=1 cellPadding=1 width="100%" border=0>
              <tr>
                <td class=tablefooter align=left width="100%"><table cellSpacing=0 cellPadding=0 width="100%" border=0>
                  <tr>
                    <td style="HEIGHT: 1px" colSpan=2><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" name=agif></td>
                    <td height=23 rowSpan=2><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width=1 name=zgif></td>
                  </tr>
                  <tr>
                    <td height=23><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width=1 name=agif2></td>
                    <td class=formtext vAlign=center noWrap align=left width="100%">&nbsp;<b>Login As : <font color="#0000FF">
                      <?=$full_name;?>
                    </font></b></td>
                  </tr>
                  <tr>
                    <td style="HEIGHT: 1px" colSpan=3><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" name=zgif2></td>
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
                    <td vAlign=center noWrap align=middle width=120><table cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <form action="" method="post" name="frmpage">
                        <tr>
                          <td class=tablefooter noWrap>&nbsp;
                                        <!--- Page ---></td>
                          <td class=tablefooter noWrap>Page :
                            <? if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){?>
                                        <SELECT onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>')" name=selpage>
                                          <? }else{ ?>
                                          <SELECT onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name=selpage>
                                          <? } ?>
                                          <? for($i=1;$i<=$page;$i++){
                                                        $val = $i*20;
                                                    ?>
                                          <? if(isset($_GET["page"])){?>
                                          <OPTION value="<?=$val?>" <?if(uriParam("page")==$val){ echo " selected";}?>>
                                            <?=$i?>
                                          </OPTION>
                                          <? }else{?>
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
        </FORM></td>
  </tr>
</table>
