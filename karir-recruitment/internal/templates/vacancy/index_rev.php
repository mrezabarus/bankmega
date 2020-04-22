<?
	require_once("../../config.php");

	$region=cmsDB();
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
	//alert(addr_to);
	//get_method(addr_to);
	location=addr_to;
}

function popwin(addr){
	PopWindow(addr,'WindowName', '800', '600', 'scrollbars=yes,location=no,status=yes')
}
</script>
<table cellSpacing="0" cellPadding="0" width="100%" border=0> 
                  <tr>
                    <td vAlign=top>
                    <TABLE class=heading2 cellSpacing="0" cellPadding="0" width="100%" align=center border="0">
                      <tr>
                        <td class=tableheader><!--- HEADER --->
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                              <tr>
                                <td class=tableheader>&nbsp;Vacant Position List</td>
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
			$value=$_POST["txtsearch"];
		}elseif(isset($_GET["txtsearch"])){
			$value=$_GET["txtsearch"];
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
	  <td>&nbsp;<input type="Button" value="Cancel" style="cursor:hand" onClick="location='index.php?refresh=<?=md5("mdYHis")?>'"></td>
	  <td><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_1')" onMouseOut="overlayclose('tanya_1');" border="0" style="cursor:hand">
					<div id="tanya_1" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
					<div style="border: 5px solid #f7f7f7;" class="inputStyle5"> Form searching/pencarian berdasarkan Kriteria : <br />
                      <font color="#FF0000">*</font> Position <br />
                      <font color="#FF0000">*</font> Status <br />
                      <font color="#FF0000">*</font> Region <br />
                      <font color="#FF0000">*</font> Branch</b></font></div>
                </div></td>
	  </tr>
	</table>
<? }
} ?></form>
                        <TABLE cellspacing="0" cellpadding="1" border="0">
                            <tr>
                              <td width=0 height=20>
							  <? if(listFind($_SESSION["ss_id" . date("mdY")],"7")){?>
                                  <input type="image" style="border:none" onClick="location='new.php?urlencrypt=<?=md5("mdYHis")?>';" src="<?=$ANOM_VARS["www_img_url"]?>create.gif" alt="create new" align="bottom" />
                                  <? } ?>
                              </td>
                            </tr>
                        </TABLE></td>
                      </tr>
                      <tr>
                        <td><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                            <tr>
                              <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
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
                              <td class=heading2 noWrap align=center>Position (Qty)</td>
                              <td class=heading2 noWrap align=center>Status</td>
                              <td class=heading2 noWrap align=center>Region</td>
                              <td class=heading2 noWrap align=center>Branch</td>
                              <td class=heading2 noWrap align=center>Grade</td>
                              <td class=heading2 noWrap align=center>Tanggal Approved</td>
                              <td class=heading2 noWrap align=center>Bulan Expired</td>
                            </tr>
                            <!--- RecordList Field --->
                            <tr>
                              <td class=heading2 colSpan=9><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                  <tr>
                                    <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></td>
                                  </tr>
                                  <tr>
                                    <td style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%"></td>
                                  </tr>
                              </TABLE></td>
                            </tr>
                            <?
						  $vacancy=cmsDB();
						 if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){
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

										  if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){
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
                            <TR class=<? if($clas==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>>
                              <td vAlign=top align=right><?=$no?>
                                .</td>
                              <td vAlign=top align=left><? if(listFind($_SESSION["ss_id" . date("mdY")],"9")){?>
                                <!--a href="javascript:get_method('templates/vacancy/view.php?mpppos_id=<?=$vacancy->row("mpppos_id")?>')"-->
                                <a href="view.php?mpppos_id=<?=$vacancy->row("mpppos_id")?>">
                                <? } ?>
                                <?=$vacancy->row("position_name")?>
(
<?=$vacancy->row("qty")?>
)
<? if(listFind($_SESSION["ss_id" . date("mdY")],"9")){ ?>
                                </a>
                              <? } ?></td>
                              <td vAlign=top align=center><b>
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
                              <td vAlign=top align=left><?=$vacancy->row("region_name")?></td>
                              <td align=left vAlign=top><?=$vacancy->row("branch_name")?></td>
                              <td align=center vAlign=top><?=$vacancy->row("name")?></td>
                              <td align="center" vAlign=top><?=datesql2date($vacancy->row("approve_date"))?></td>
                              <td align="left" vAlign=top><? echo date("F",mktime (0,0,0,$vacancy->row("month_dateline"),date("d"),  date("Y")));?></td>
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
                              <td class="tablefooter" align="middle" colSpan="11">
                              <table cellSpacing="1" cellPadding="1" width="100%" border="0">
                                  <tr>
                                    <td class="tablefooter" align="left" width="100%">
                                    <table cellSpacing="0" cellPadding="0" width="100%" border="0">
                                        <tr>
                                          <td style="HEIGHT: 1px" colSpan=2><IMG height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" name=agif></td>
                                          <td height="23" rowSpan="2"><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                                width="1" name=zgif></td>
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
                                          <td width="1" height=23><IMG height="100%" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width=1 name=agif2></td>
                                          <td vAlign=center noWrap align=middle width=118>&nbsp;</td>
                                      </tr>
                                <tr>
                                  <td style="HEIGHT: 1px" colSpan=3><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" name=zgif2></td>
                                </tr>
                                    </TABLE></td>
                                    <td class=tablefooter vAlign=center noWrap align=middle>
                                    <TABLE cellSpacing=0 cellPadding=0 width=120 border=0>
                                        <tr>
                                          <td style="HEIGHT: 1px" colSpan=2><IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif"  width="100%" name=agif></td>
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
                                                  <? if(isset($_GET["look_search"]) || isset($_GET["txtsearch"])){?>
                                                    <select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes&search=yes&txtsearch=<?=$value?>')" name="selpage">
													<? }else{ ?>
													<select onChange="_goto('<?=$_SERVER["SCRIPT_NAME"]?>?paging=yes')" name="selpage">
													<? } ?>
                                                        <? for($i=1;$i<=$page;$i++){
																			$val = $i*20;
																		?>
                                                        <? if(isset($_GET["page"])){?>
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
