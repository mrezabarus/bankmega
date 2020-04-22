<?
	require_once("../../config.php");

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
//Add alert message when error occur 
//window.onerror = function(msg, err_url, line) {alert('Unkwon Error :) ' + line);}
//Detects browser type 
function makeObject(){
	var x; 
	var browser = navigator.appName; 
	if(browser == "Microsoft Internet Explorer"){
		x = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		x = new XMLHttpRequest();
	}
	return x;
}

//Call function 
var request = makeObject();

//The get method AJAX 
function get_method(addr){
	var data = addr;
	request.open('get', data);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = output; 
	request.send('');
}

//The POST method AJAX 
function post_method(addr,field,optional){
			var inputan = new Array();
			var get_var = new Array();
			inputan = field.split(",");
			//alert(inputan.length);
			var pars_param = "";
			for(i=0;i<inputan.length;i++){
				//alert();
				get_var = inputan[i].split(".");
				pars_param = pars_param + get_var[1] + "=" + eval("document."+ inputan[i] + ".value") + "&";
			}
			pars_param = pars_param + optional;
			//alert(pars_param);
			request.open('post', addr);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.onreadystatechange = output; 
			request.send(pars_param);
}

function output(){
	if(request.readyState == 1){
		//You can add animated gif while loading // 
	}
	if(request.readyState == 4){
		var data = request.responseText;
		document.getElementById('sample_form').innerHTML = data;
	}
}
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
	<? if(isset($_GET["adv_search"])){?>
		document.adv_search.action=addr_to;
		//alert(document.adv_search.action);
		document.adv_search.submit();
	<? }else{ ?>
	//alert(addr_to);
		location=addr_to;
	<?}?>
}

function popwin(addr){
	PopWindow(addr,'WindowName', '800', '600', 'scrollbars=yes,location=no,status=yes')
}
</script>
<? if(isset($_GET["adv_search"])){
	require_once("adv_search.php");
}?>
<table cellSpacing="0" cellPadding="0" width="100%" border=0> 
                  <tr>
                    <td vAlign=top>
                    <TABLE class=heading2 cellSpacing="0" cellPadding="0" width="100%" align=center border="0">
                      <tr>
                        <td class=tableheader><!--- HEADER --->
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                              <tr>
                                <td class=tableheader>&nbsp;Job Seeker List </td>
                                <td align=right><TABLE width=0>
                                    <tr>
                                      <td><input type="image" style="border:none" onClick="location='index.php?search=yes';" src="<?=$ANOM_VARS["www_img_url"]?>suryakanta.gif" alt="Search" align="bottom" /></td>
                                    </tr>
                                </TABLE></td>
                              </tr>
                          </TABLE></td>
                      </tr>
                      <tr>
                        <td><TABLE cellSpacing=0 cellPadding=0 width="100%" 
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
                        </TABLE></td>
                      </tr>
                      <tr>
                        <td>
<form action="<?=$_SERVER["SCRIPT_NAME"]?>?search=yes&look_search=yes&refresh=<?=md5("mdYHis")?>" method="post" name="sample_form" id="sample_form" enctype="multipart/form-data">
<? 
		if(isset($_GET["search"])){
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
<table cellspacing="0" cellpadding="2" border="0"> 
	  <tr>
	  <td align="left"><b>Search For</b></td>
	  <td align="left"><b>:</b></td>
	  <td>&nbsp;<input type="Text" name="txtsearch" size="30" value="<?=$value?>"></td>
	  <td>&nbsp;<input type="submit" value="Search" style="cursor:hand"></td>
	  <td>&nbsp;<input type="Button" value="Advance Search" onClick="location='index.php?adv_search=yes&refresh=<?=md5("mdYHis")?>'"></td>
	  <td>&nbsp;<input type="Button" value="Cancel" style="cursor:hand" onClick="location='index.php?refresh=<?=md5("mdYHis")?>'"></td>
	  <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_1')" onMouseOut="overlayclose('tanya_1');" border="0" style="cursor:hand">
					<div id="tanya_1" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
					<div style="border: 5px solid #f7f7f7;" class="inputStyle5">
Form searching/pencarian berdasarkan Kriteria :
<br /><font color="#FF0000">*</font> Nama Lengkap <font color="#FF0000">Contoh: Andi Prihandi</font>
<br /><font color="#FF0000">*</font> ID KTP <font color="#FF0000">Contoh: 32345646575</font>
<br /><font color="#FF0000">*</font> Experience <font color="#FF0000">Contoh: Credit Officer</font>
<br /><font color="#FF0000">*</font> Pendidikan Terakhir <font color="#FF0000">Contoh: S1</font>
<br /><font color="#FF0000">*</font> Jenis Kelamin <font color="#FF0000">Contoh: Laki-Laki</font>
<br /><font color="#FF0000">*</font> Status Apply <font color="#FF0000">Contoh: Internal</font>
<br /><font color="#FF0000">*</font> Domisili <font color="#FF0000">Contoh: Jakarta</font>
<br /><font color="#FF0000">*</font> Email <font color="#FF0000">Contoh: awr01@yahoo.com</font>
<br /><font color="#FF0000">*</font> Status Perkawinan <font color="#FF0000">Contoh: Nikah</font>
<br /><font color="#FF0000">*</font> Suku/Ras <font color="#FF0000">Contoh: Sunda</font>
<br /><font color="#FF0000">*</font> Kode Pos <font color="#FF0000">Contoh: 15412</font></b></font></div></div></td>
	  </tr>
	</table>
<? }
} ?></form>
                        <TABLE cellspacing="0" cellpadding="1" border="0">
                            <tr>
                              <td width=0 height=20>
							  <? if(listFind($_SESSION["ss_id" . date("mdY")],"12")){?>
                                  <input type="image" style="border:none" onClick="location='new.php?urlencrypt=<?=md5("mdYHis")?>';" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" alt="create new" align="bottom" />
                                  <? } ?>
                              </td>
                            </tr>
                        </TABLE></td>
                      </tr>
                      <tr>
                        <td><TABLE cellSpacing=0 cellPadding=0 width="100%" 
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
                        </TABLE></td>
                      </tr>
                      <tr>
                        <td class=heading2><TABLE width="100%" class=heading2 cellSpacing="1" cellPadding="2" align=center border=0>
                            <!--- RecordList Field --->
                            <TR class=heading2>
                              <td class=heading2 noWrap align=center>No.</td>
                              <td class=heading2 noWrap align=center>Nama Lengkap</td>
                              <td class=heading2 noWrap align=center>Jenis Kelamin</td>
                              <td class=heading2 noWrap align=center>Telephone</td>
                              <td class=heading2 noWrap align=center>Tempat, Tgl Lahir</td>
                              <td class=heading2 noWrap align=center>Pendidikan</td>
                              <td class=heading2 noWrap align=center>Status</td>
                              <td class=heading2 noWrap align=center>Internal Status</td>
                              <td class=heading2 noWrap align=center>Pekerjaan Terakhir</td>
                              <td class=heading2 noWrap align=center>Tgl Register</td>
                            </tr>
                            <!--- RecordList Field --->
                            <tr>
                              <td class=heading2 colSpan=11><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                  <tr>
                                    <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
                                  </tr>
                                  <tr>
                                    <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
                                  </tr>
                              </TABLE></td>
                            </tr>
                            <?
										  $mpp=cmsDB();
										  if(isset($_GET["adv_query"])){
														$strsql = $strsql_adv;
										  }elseif(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){
							                   $strsql = "SELECT * 
											   			  FROM tbl_jobseeker 
											   			  WHERE (full_name like '%".trim($value)."%'
														  OR sex like '%".trim($value)."%'
														  OR email like '%".trim($value)."%'
														  OR id_no like '%".trim($value)."%'
														  OR ethnic like '%".trim($value)."%'
														  OR mar_status like '%".trim($value)."%'
														  OR user_name like '%".trim($value)."%'
														  OR zip_code like '%".trim($value)."%'
														  OR last_study like '%".trim($value)."%'
														  OR city like '%".trim($value)."%'
														  OR working_exp like '%".trim($value)."%'
														  OR phone_no1 like '%".trim($value)."%'
														  OR phone_no2 like '%".trim($value)."%'
														  OR avail_status like '%".trim($value)."%'
														  OR apply_from like '%".trim($value)."%')";						
											
											}else{
												$strsql = "SELECT * FROM tbl_jobseeker where 1";
											}
											if(isset($_SESSION["ssbranch_id" . date("mdY")])){
												$strsql = $strsql . " AND avail_status <> 'employee'
												                      AND (tbl_jobseeker.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")]."))";
											}
											$strsql = $strsql . " order by join_date desc";
										   $mpp->query($strsql);
										   $num_rows_answer = $mpp->recordCount();
										   $page = ceil($num_rows_answer/20);
										   if (round($page) == 0){
											 $page = 1;
										   }

										  if(isset($_GET["adv_query"])){
														$strsql = $strsql_adv;
										  }elseif(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){
							                   $strsql = "SELECT * 
											   			  FROM tbl_jobseeker 
											   			  WHERE (full_name like '%".trim($value)."%'
														  OR sex like '%".trim($value)."%'
														  OR email like '%".trim($value)."%'
														  OR id_no like '%".trim($value)."%'
														  OR ethnic like '%".trim($value)."%'
														  OR mar_status like '%".trim($value)."%'
														  OR user_name like '%".trim($value)."%'
														  OR zip_code like '%".trim($value)."%'
														  OR last_study like '%".trim($value)."%'
														  OR city like '%".trim($value)."%'
														  OR working_exp like '%".trim($value)."%'
														  OR phone_no1 like '%".trim($value)."%'
														  OR phone_no2 like '%".trim($value)."%'
														  OR avail_status like '%".trim($value)."%'
														  OR apply_from like '%".trim($value)."%')";						
											
											}else{
												$strsql = "select * from tbl_jobseeker where 1";
											}
										  	if(isset($_SESSION["ssbranch_id" . date("mdY")])){
												$strsql = $strsql . " AND avail_status <> 'employee'
												                      AND (tbl_jobseeker.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")]."))";
											}
											$strsql = $strsql . " order by join_date desc";
										  
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
													$pict_file=$mpp->row("pict_file");
													if (file_exists($ANOM_VARS["www_img_path"]."js_photo/".$pict_file)) {
														$pict_file = $pict_file;
													} else {
														$pict_file = "nophoto.gif";
													}
												$date_of_birth = datesql2date($mpp->row("date_of_birth"));
										  ?>
                            <TR class=<? if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>>
                              <td vAlign=top align=right><?=$no?>
                                .</td>
                              <td vAlign=top align=left>
							  		<? if(listFind($_SESSION["ss_id" . date("mdY")],"14")){?>
                                  <a href="edit.php?edit=yes&js_id=<?=$mpp->row("js_id")?>" onMouseover="tip('<center><b><?=$mpp->row("full_name")?></b> <br /><img src=<?=$ANOM_VARS["www_img_url"]?>js_photo/<?=$pict_file?> width=110 height=150 /></center>' ,120)";
 onMouseout="hide_tip()">
                                  <? } ?>
                                  <?=$mpp->row("full_name")?>
                                  <? if(listFind($_SESSION["ss_id" . date("mdY")],"14")){?>
                                  </a>
                                  <? } ?></td>
                              <td vAlign=top align=center><?=$mpp->row("sex")?></td>
                              <td vAlign=top align=left><?=$mpp->row("phone_no1")?>
                                /
                                <?=$mpp->row("phone_no2")?></td>
                              <td align=left vAlign=top><?=$mpp->row("place_of_birth")?>
                                ,
                                <?=$date_of_birth?></td>
                              <td align=center vAlign=top><?=$mpp->row("last_study")?></td>
                              <td align=center vAlign=top><b>
                                <?
													if($mpp->row("avail_status")=="available"){
														echo "<font color=\"green\">Available</font>";
													}elseif($mpp->row("avail_status")=="employee"){
														echo "<font color=\"blue\">Employee</font>";
													}elseif($mpp->row("avail_status")=="recruitment passed"){
														echo "<font color=\"orange\">Recruitment Lulus</font>";
													}elseif($mpp->row("avail_status")=="recruitment process"){
														echo "<font color=\"brown\"><blink>Recruitment Proses</blink></font>";
													}elseif($mpp->row("avail_status")=="ol process"){
														echo "<font color=\"brown\"><blink>OL Proses</blink></font>";
													}elseif($mpp->row("avail_status")=="ol denied"){
														echo "<font color=\"red\">Batal/Gagal</font>";
													}else{
														echo "<font color=\"black\">Reserved</font>";
													}
													?></b></td>
                              <td align="center" vAlign=top><b><?=$mpp->row("confirm")?></b></td>
                              <td align="left" vAlign=top><?=$mpp->row("working_exp")?></td>
                              <td align=center vAlign=top><?
							  if($mpp->row("apply_from") == "Web"){
							  echo "<center><b><font color=\"Blue\">".datesql2date($mpp->row("join_date"))."</font></b></center>";
							  }elseif($mpp->row("apply_from") =="internal"){
							  echo "<center><font color=\"Black\">".datesql2date($mpp->row("join_date"))."</font></center>";
							  }
							  ?></td>
                            </tr>
                            <?
									$clas=$clas*-1;
									$no++;
								}
                             }else{ ?>
                            <TR class=tablebodyeven>
                              <td colspan="11" vAlign=top align=center>No record found</td>
                            </tr>
                            <? } ?>
                            <tr>
                              <td class=tablefooter align=middle colSpan=11><TABLE cellSpacing=1 cellPadding=1 width="100%" 
                                border=0>
                                  <tr>
                                    <td class=tablefooter align=left width="100%"><TABLE cellSpacing=0 cellPadding=0 width="100%" 
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
                                align=left width="100%">&nbsp;<b>Login As : <font color="#0000FF"><?=$full_name;?></font></b></td>
                                        </tr>
                                        <tr>
                                          <td style="HEIGHT: 1px" colSpan=3><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%" 
                                name=zgif2></td>
                                        </tr>
                                    </TABLE></td>
                                    <td class=tablefooter vAlign=center noWrap 
                                align=middle><TABLE cellSpacing=0 cellPadding=0 width=104 
                                border=0>
                                <tr>
                                          <td style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%" name=agif></td>
                                          <td width="1" height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width=1 name=zgif></td>
                                      </tr>
                                        <tr>
                                          <td width="1" height=23><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width=1 name=agif2></td>
                                          <td vAlign=center noWrap align=middle width=118>&nbsp;</td>
                                      </tr>
                                        <tr>
                                          <td style="HEIGHT: 1px" colSpan=3><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="100%" 
                                name=zgif2></td>
                                        </tr>
                                    </TABLE></td>
                                    <td class=tablefooter vAlign=center noWrap align=middle>
                                    <TABLE cellSpacing=0 cellPadding=0 width=120 border=0>
                                        <tr>
                                          <td style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%" name=agif></td>
                                          <td height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width=1 name=zgif></td>
                                        </tr>
                                        <tr>
                                          <td height=23><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="1"></td>
                                          <td vAlign=center noWrap align=middle width=120>
                                          <TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
                                              <!--- Page Counter --->
                                              <form action="" method="post" name="frmpage" id="frmpage">
                                                <tr>
                                                  <td class=tablefooter noWrap>&nbsp;</td>
                                                  <td class=tablefooter noWrap>Page :
                                                  <? if(isset($_GET["adv_search"])){?>
                                                  	<select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>&adv_search=yes&adv_query=yes')" name="selpage">
													<? }elseif(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){?>
                                                    <select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>')" name="selpage">
													<? }else{ ?>
													<select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name="selpage">
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
                                                  <td class=tablefooter noWrap></td>
                                                </tr>
                                              </form>
                                          </TABLE></td>
                                        </tr>
                                        <tr>
                                          <!--- End Of Page Counter --->
                                          <td style="HEIGHT: 1px" colSpan=3>
                                          <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" name=zgif2></td>
                                        </tr>
                                    </TABLE></td>
                                  </tr>
                              </TABLE></td>
                            </tr>
                        </TABLE></td>
                      </tr>
                    </TABLE></td>
                  </tr>
              </TABLE>
