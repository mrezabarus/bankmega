<?
	require_once("../../config.php");

if(isset($_GET["save"])){
	//echo $ANOM_VARS["www_img_path"] . "js_photo/";die();
	
	$dirpath = $ANOM_VARS["www_img_path"] . "js_photo/";
	if(is_dir($dirpath)){
		if (is_uploaded_file($_FILES['pict']['tmp_name'])) {
			if(strtolower(listLast($_FILES['pict']['name'],".")) == "jpg" || strtolower(listLast($_FILES['pict']['name'],".")) == "gif" || strtolower(listLast($_FILES['pict']['name'],".")) == "bmp"){
				$nama_file = strtolower(session_register("user_name" . date("mdY")))."_". md5(date("mdYHis")) . "." . listLast($_FILES['pict']['name'],".");
				copy($_FILES['pict']['tmp_name'], $dirpath.$nama_file);
			}else{
				$nama_file = "";
			}
		}else{
			$nama_file = "nophoto.gif";
		}
	}
	
	$strsql = "INSERT INTO tbl_jobseeker(email,full_name,sex,place_of_birth,date_of_birth,address1,address2,city,zip_code,id_no,id_no_valid,
	                                     phone_no1,phone_no2,religion,mar_status,apply_from,join_date,avail_status,last_study,course,
										 height,weight,ethnic,working_exp,nationality,pict_file,insert_by,user_id,branch_id,blood_type,
										 driving_lisence_a,driving_lisence_c,driving_lisence_other,hobby)
			   VALUES('".postParam("email")."','".postParam("full_name")."','".postParam("sex")."','".postParam("tempat_lahir")."',
					  '".postParam("tahun")."-".postParam("bulan")."-".postParam("tanggal")." 00:00:00','".postParam("address")."','',
					  '".postParam("city")."','".postParam("zip_code")."','".postParam("ktp")."','".postParam("ktp_valid")."','".postParam("hp_home")."',
					  '".postParam("hp")."','".postParam("agama")."','".postParam("kawin")."','internal',now(),'available','".postParam("last_study")."',
					  '".postParam("course")."','".postParam("height")."','".postParam("weight")."','".postParam("ethnic")."','".postParam("working_exp")."',
					  '".postParam("nationality")."','".$nama_file."',".$_SESSION["user_id" . date("mdY")].",".$_SESSION["user_id" . date("mdY")].",
					  '".postParam("selbranch")."','".postParam("darah")."','".postParam("sim_a")."','".postParam("sim_c")."','".postParam("sim_other")."',
					  '".postParam("hobby")."')
	";
	//echo ""
	$insert=cmsDB();
	$insert->query($strsql);
	$last_id=$insert->lastInsertID("js_id");
	
	$value=$_POST["selposition"];
	foreach($value as $id) {
		$strsql = "insert into tbl_jobseeker_interest_pos(js_id,position_id,jsres_id) values(".$last_id.",".$id.",0)";
		$insert->query($strsql);
	}
	//die();
	//echo $strsql." _ " . $last_id;
	echo "<script>alert('New Job Seeker Saved!!');location='edit.php?edit=yes&js_id=".$last_id."';</script>";
	die();
}
if(isset($_GET["edit"])){
	$js=cmsDB();
	$js->query("select * from tbl_jobseeker where js_id=".uriParam("js_id"));
	$js->next();
	$email=$js->row("email");
	$full_name=$js->row("full_name");
	$sex=$js->row("sex");
	$place_of_birth=$js->row("place_of_birth");
	$date_of_birth=$js->row("date_of_birth");
	$address1=$js->row("address1");
	$address2=$js->row("address2");
	$city=$js->row("city");
	$zip_code=$js->row("zip_code");
	$id_no=$js->row("id_no");
	$id_no_valid=$js->row("id_no_valid");
	$phone_no1=$js->row("phone_no1");
	$phone_no2=$js->row("phone_no2");
	$religion=$js->row("religion");
	$mar_status=$js->row("mar_status");
	$working_exp=$js->row("working_exp");
	$apply_from=$js->row("apply_from");
	$avail_status=$js->row("avail_status");
	$last_study=$js->row("last_study");
	$course=$js->row("course");
	$height=$js->row("height");
	$weight=$js->row("weight");
	$ethnic=$js->row("ethnic");
	$nationality=$js->row("nationality");
	$pict_file=$js->row("pict_file");
	$insert_by=$js->row("insert_by");
	$user_id=$js->row("user_id");
	$branch_id=$js->row("branch_id");
	$blood_type=$js->row("blood_type");
	$driving_lisence_a=$js->row("driving_lisence_a");
	$driving_lisence_c=$js->row("driving_lisence_c");
	$driving_lisence_other=$js->row("driving_lisence_other");
	$hobby=$js->row("hobby");
	$reading_freq=$js->row("reading_freq");
	$reading_topic=$js->row("reading_topic");
}else{
	$email="";
	$full_name="";
	$sex="";
	$place_of_birth="";
	$date_of_birth="";
	$address1="";
	$address2="";
	$city="";
	$zip_code="";
	$id_no="";
	$id_no_valid="";
	$phone_no1="";
	$phone_no2="";
	$religion="";
	$mar_status="";
	$working_exp="";
	$apply_from="";
	$avail_status="";
	$last_study="";
	$course="";
	$height="";
	$weight="";
	$ethnic="";
	$nationality="";
	$pict_file="";
	$insert_by="";
	$user_id="";
	$branch_id="";
	$blood_type="";
	$driving_lisence_a="";
	$driving_lisence_c="";
	$driving_lisence_other="";
	$hobby="";
	$reading_freq="";
	$reading_topic="";
}
?>
<script language="javascript">
//window.onerror = function(msg, err_url, line) {alert('Unkwon Error :) ' + line);}
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
var request = makeObject();
function get_method(addr){
	var data = addr;
	request.open('get', data);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = output; 
	request.send('');
}
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
	}
	if(request.readyState == 4){
		var data = request.responseText;
		document.getElementById('output').innerHTML = data;
	}
}
function _selsubmit(frm,addr,pars_var){
	addr = addr + '&'+ pars_var +'=' + eval("document."+ frm + ".value");
	get_method(addr);
}
//The difference between POST and GET, POST method support or can transffer large data... 
</script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tanya.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>common.js"></script>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<body topmargin="0">
<center><div id="output">
<form enctype="multipart/form-data" action="<?=$_SERVER["SCRIPT_NAME"]?>?save=yes" method="post" name="sample_form" id="sample_form" onSubmit="return Check()">
<table width="80%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td  align="left" colSpan="5">
		<table border="0" cellpadding="2" cellspacing="0" width="100%">
			<tr>
				<td class="tableheader" align="center">Personal Data</td>
				<? if(isset($_GET["edit"])){?>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new1.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Reference</a></td>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new2.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Family</a></td>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new3.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Educational</a></td>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new4.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Working Experience</a></td>
				<? } ?>
			</tr>
			<tr>
				<TD colspan="5">
                <IMG height=1 src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%"></TD>
			</tr>
		</table>
    </td>
  </tr>
  <tr> 
    <td  align="left" colSpan="5" class="tablebodyodd">
	
	<table border="0" cellpadding="2" cellspacing="0" width="100%">
              <tr>
			    <td colspan="6" align="left"><img src="<?=$ANOM_VARS["www_img_url"]?>help.gif" onMouseOver="return overlay(this, 'tanya_14')" onMouseOut="overlayclose('tanya_14');" border="0" style="cursor:hand">
				  <div id="tanya_14" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
					<div style="border: 5px solid #f7f7f7;" class="inputStyle5">
Form bertanda <b><font color="#FF0000">*</font></b> Wajib Diisi !!
<br />- Upload Photo dimensi 110x150 pixels
<br />- (Max upload Images file : 100 Kb)</div></div></td>
		      </tr>
              <tr>
			    <td align="left" width="17%">Photo</td>
			    <td width="1%">:</td>
			    <td colspan="4" align="left"><?if(isset($_GET["edit"])){?>
                <img src="<?=$ANOM_VARS["www_img_url"]?>js_photo/<?=$pict_file?>" border=0 width="110" height="150"><br>
                  <? } ?>
                  <input type="file" size="40" name="pict"> (Max upload Images file : 100 Kb)</td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">Nama Lengkap</td>
			    <td vAlign="top">:</td>
			    <td colspan="4" align="left" vAlign="top"><input maxlength="100" size="30" name="full_name" value="<?=$full_name?>">&nbsp;<font color="red"><b>*</b></font></td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">Email Address</td>
			    <td vAlign="top">:</td>
			    <td colspan="4" align="left" vAlign="top"><input maxlength="100" size="30" name="email" value="<?=$email?>">&nbsp;<font color="red"><b>*</b></font></td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">ID No. (KTP)</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="33%"><input size="30" name="ktp" value="<?=$id_no?>" onChange="GetId2()" onKeyPress="return handleEnter(this, event, 6)">&nbsp;<font color="red"><b>*</b></font></td>
			    <td align="right" width="20%">Berlaku sampai :</td>
			    <td colspan="2" align="left"><input size="5" maxlength="4" name="ktp_valid" value="<?=$id_no_valid?>" onKeyPress="return handleEnter(this, event, 4)"><font color="red">&nbsp;*</font></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="right">
			      <table cellSpacing="0" cellPadding="0" align="left" border="0">
			          <tr>
			            <td>Driving Lisence (SIM)</td>
			          </tr>
			      </table>
			      A&nbsp;</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="33%"><input size="30" name="sim_a" value="<?=$driving_lisence_a?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			    <td align="right" width="20%">C :</td>
			    <td colspan="2" align="left"><input size="30" name="sim_c" value="<?=$driving_lisence_c?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			  </tr>
			   <tr >
			    <td vAlign="top" align="right">
			      SIM Lainnya				  </td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="33%"><input size="30" name="sim_other" value="<?=$driving_lisence_other?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			    <td align="right" width="20%">&nbsp;</td>
			    <td colspan="2" align="left">&nbsp;</td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Tempat Lahir</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="33%"><input type="Text" name="tempat_lahir" size="30" maxlength="50" value="<?=$place_of_birth?>" onKeyPress="return handleEnter(this, event, 5)">&nbsp;<font color="red"><b>*</b></font></td>
			    <td align="right" width="20%">Tanggal Lahir :</td>
			    <td colspan="2" align="left">
				<?
				if(isset($_GET["edit"])){
					$tgl_lahir = listGetAt($date_of_birth,1," ");
					$tgl = listGetAt($tgl_lahir,3,"-");
					$bln = listGetAt($tgl_lahir,2,"-");
					$thn = listGetAt($tgl_lahir,1,"-");
				}else{
					$tgl = "1";
					$bln = "1";
					$thn = "1950";
				}
				 
				?>
				<select name="tanggal">
					<?for($i=1;$i<=31;$i++){?>
			        <option value="<?=$i?>" <?if($i==$tgl){ echo "selected";}?>><?=$i?></option>
					<?}?>
			    </select> 
				<select name="bulan">
			        <option value="1" <?if($bln==1){ echo "selected";}?>>Jan</option>
			        <option value="2" <?if($bln==2){ echo "selected";}?>>Feb</option>
			        <option value="3" <?if($bln==3){ echo "selected";}?>>Mar</option>
			        <option value="4" <?if($bln==4){ echo "selected";}?>>Apr</option>
			        <option value="5" <?if($bln==5){ echo "selected";}?>>May</option>
			        <option value="6" <?if($bln==6){ echo "selected";}?>>Jun</option>
			        <option value="7" <?if($bln==7){ echo "selected";}?>>Jul</option>
			        <option value="8" <?if($bln==8){ echo "selected";}?>>Aug</option>
			        <option value="9" <?if($bln==9){ echo "selected";}?>>Sep</option>
			        <option value="10" <?if($bln==10){ echo "selected";}?>>Oct</option>
			        <option value="11" <?if($bln==11){ echo "selected";}?>>Nov</option>
			        <option value="12" <?if($bln==12){ echo "selected";}?>>Dec</option>
			      </select> 
				  <select name="tahun">
			        <?for($i=1950;$i<=2000;$i++){?>
			        <option value="<?=$i?>"  <?if($i==$thn){ echo "selected";}?>><?=$i?></option>
					<?}?>
		        </select>&nbsp;<font color="red">*</font></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">jemis Kelamin</td>
			    <td vAlign="top">:</td>
			    <td colspan="4" vAlign="top" align="left"><input type="radio" value="Laki-Laki" name="sex" checked <? if($sex=="Laki-Laki"){ echo "checked";}?>>
			      Laki-laki
			        <input type="radio" value="Perempuan" name="sex" <? if($sex=="Perempuan"){ echo "checked";}?>>
			        Perempuan</td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Status</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left"><select name="kawin">
			        <option value="Single" <? if($mar_status=="Single"){ echo "selected";}?>>Single</option>
			        <option value="Nikah" <? if($mar_status=="Nikah"){ echo "selected";}?>>Nikah</option>
			        <option value="Cerai" <? if($mar_status=="Cerai"){ echo "selected";}?>>Cerai</option>
			      </select></td>
			    <td align="right">Pendidikan :</td>
			    <td width="7%"><select name="last_study">
                  <option value="SD" <? if($last_study=="SD"){ echo "selected";}?>>SD</option>
                  <option value="SMP" <? if($last_study=="SMP"){ echo "selected";}?>>SMP</option>
                  <option value="SMU" <? if($last_study=="SMU"){ echo "selected";}?>>SMU</option>
                  <option value="D1" <? if($last_study=="D1"){ echo "selected";}?>>D1</option>
                  <option value="D2" <? if($last_study=="D2"){ echo "selected";}?>>D2</option>
                  <option value="D3" <? if($last_study=="D3"){ echo "selected";}?>>D3</option>
                  <option value="S1" <? if($last_study=="S1"){ echo "selected";}?>>S1</option>
                  <option value="S2" <? if($last_study=="S2"){ echo "selected";}?>>S2</option>
                  <option value="S3" <? if($last_study=="S3"){ echo "selected";}?>>S3</option>
                </select></td>
			    <td width="22%"><?
						$jurusan = cmsDB();
						$jurusan->query("select * from tbl_jurusan order by code asc")
						?>
                  <select name="course">
                    <? while($jurusan->next()){?>
                    <option value="<?=$jurusan->row("jurusan")?>" <? if($course==$jurusan->row("jurusan")){ echo " selected";}?>>
                      <?=$jurusan->row("jurusan")?>
                    </option>
                    <? } ?>
                  </select></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Kewarganegaraan</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left"><input size="30" name="nationality" value="<?=$nationality?>"></td>
			    <td align="right">Pekerjaan Terakhir :</td>
			    <td colspan="2"><?
						$jobs = cmsDB();
						$jobs->query("select * from tbl_lastjob order by lst_id asc")
						?>
                  <select name="working_exp">
                    <? while($jobs->next()){?>
                    <option value="<?=$jobs->row("job_name")?>" <? if($working_exp==$jobs->row("job_name")){ echo " selected";}?>>
                      <?=$jobs->row("job_name")?>
                    </option>
                    <? } ?>
                  </select>&nbsp;<font color="red"><b>*</b></font></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Agama</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left"><select name="agama">
			        <option value="Islam" <? if($religion=="Islam"){ echo "selected";}?>>Islam</option>
			        <option value="Catholic" <? if($religion=="Catholic"){ echo "selected";}?>>Catholic</option>
			        <option value="Christian" <? if($religion=="Christian"){ echo "selected";}?>>Christian</option>
			        <option value="Hindu" <? if($religion=="Hindu"){ echo "selected";}?>>Hindu</option>
			        <option value="Buddha" <? if($religion=="Buddha"){ echo "selected";}?>>Buddha</option>
			        <option value="Konghuchu" <? if($religion=="Konghuchu"){ echo "selected";}?>>Konghuchu</option>
			      </select></td>
			    <td vAlign="top" align="right">Suku/Ras :</td>
			    <td colspan="2" align="left" vAlign="top"><input name="ethnic" size="20" value="<?=$ethnic?>"></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Gol Darah</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" colSpan="4"><input size="4" maxlength="2" name="darah" value="<?=$blood_type?>" onKeyUp="this.value=this.value.toUpperCase()"></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Berat</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left"><input size="4" maxlength="4" name="weight" value="<?=$weight?>" onKeyPress="return handleEnter(this, event, 4)"> kg</td>
			    <td vAlign="top" align="right">Tinggi :</td>
			    <td colspan="2" align="left" vAlign="top"><input size="4" maxlength="4" name="height" value="<?=$height?>" onKeyPress="return handleEnter(this, event, 4)"> cm</td>
			  </tr>
			  <tr >
			    <td align="left">Hobby</td>
			    <td>:</td>
			    <td colspan="4" align="left"><input maxLength="255" size="30" name="hobby" value="<?=$hobby?>">			    </td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">Handphone</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left"><input maxLength="15" size="30" name="hp" value="<?=$phone_no2?>" onKeyPress="return handleEnter(this, event, 4)">&nbsp;<font color="red"><b>*</b></font><br>
			      <span class="inputStyle5">Contoh: <b>0</b>817xxxxxx</span></td>
			    <td vAlign="top" align="right">Tlp Rumah :</td>
			    <td colspan="2" align="left"><input maxLength="15" name="hp_home" size="20" value="<?=$phone_no1?>" onKeyPress="return handleEnter(this, event, 4)">&nbsp;<font color="red"><b>*</b></font><br>
			      <span class="inputStyle5">Contoh: <b>0</b>21xxxxxx</span></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Kota</td>
			    <td vAlign="top">:</td>
			    <td align="left" valign="top"><?
						$kota = cmsDB();
						$kota->query("select * from tbl_kota order by kot_id asc")
						?>
                  <select name="city">
                    <? while($kota->next()){?>
                    <option value="<?=$kota->row("kota")?>" <? if($city==$kota->row("kota")){ echo " selected";}?>>
                      <?=$kota->row("kota")?>
                    </option>
                    <? } ?>
                  </select></td>
			    <td vAlign="top" align="right">Melamar untuk Cabang :</td>
				<td colspan="2" align="left" vAlign="top">
						<?
						$branch = cmsDB();
						$strsql="select * from tbl_branch 
						where branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].") order by branch_name asc";
						$branch->query($strsql);					?>
						<select name="selbranch">
							<? while($branch->next()){
								//update Branch
								//$br=$branch->row("branch_name");
								?>
						<option value="<?=$branch->row("branch_id")?>" <? if($branch_id==$branch->row("branch_id")){ echo " selected";}?>><?=$branch->row("branch_name")?></option>
                        <? } ?>
					      </select></td>
			  <tr>
			    <td align="left">Kode Pos</td>
			    <td>:</td>
			    <td align="left"><input maxlength="6" size="30" name="zip_code" value="<?=$zip_code?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			    <td rowspan="2" align="right" valign="top">Posisi yg Dilamar
			      :</td>
			    <td colspan="2" rowspan="2" align="left" valign="top"><?
				$position = cmsDB();
				$position->query("select * from tbl_position order by position_name asc")
//				$position->query("SELECT COUNT(*) as hasil,tbl_branch.branch_name, tbl_region.region_name,tbl_golongan.name,tbl_position.position_name 
//				FROM tbl_branch_mpp_apply 
//				INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
//				INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
//				INNER JOIN tbl_golongan on tbl_golongan.gol_id=tbl_branch_mpp_apply.gol_id 
//				INNER JOIN tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id 
//				WHERE request_status = 'approved' and tbl_branch.branch_id = '".$branch_id."' 
//				GROUP BY position_name asc")
				?>
                  <select name="selposition[]">
                    <? while($position->next()){?>
                    <option value="<?=$position->row("position_id")?>" <? if($positioning_place==$position->row("position_id")){echo " selected";}?>>
                      <?=$position->row("position_name")?>
                    </option>
                    <? } ?>
                  </select></td>
			  </tr>
			  <tr >
			    <td align="left" valign="top">Alamat</td>
			    <td valign="top">:</td>
			    <td align="left"><textarea class="inputStyle5" name="address" rows="4" cols="40"><?=$address1?></textarea></td>
		      </tr>
</table>
  
  <tr>
    <td  class="tableheader" colSpan="5" align="center"><input type="submit" value=" Save New Job Seeker">
					&nbsp;<input type="Button" value="Cancel" onClick="location='index.php?urlencrypt=<?=md5("mdYHis")?>';"></td>
  </tr>
  

</table></form></div>
</center>
</body>
<script>
function Check() {
     var errmsg='';
	 full_name=document.sample_form.full_name.value;
	 if (full_name.length == 0) errmsg +='Nama Lengkap Wajib diisi!\n'; 
	 email=document.sample_form.email.value;
	 if (email.length == 0) errmsg +='email Wajib diisi!\n'; 
	 ktp=document.sample_form.ktp.value;
	 if (ktp.length == 0) errmsg +='ID KTP Wajib diisi!\n'; 
	 ktp_valid=document.sample_form.ktp_valid.value;
	 if (ktp_valid.length == 0) errmsg +='Valid ID Wajib diisi!\n'; 
	 ktp=document.sample_form.ktp.value;
	 if (ktp.length == 0) errmsg +='ID KTP Wajib diisi!\n'; 
	 hp=document.sample_form.hp.value;
	 if (hp.length == 0) errmsg +='Handphone Wajib diisi!\n'; 
	 hp_home=document.sample_form.hp_home.value;
	 if (hp_home.length == 0) errmsg +='Tlp Rumah Wajib diisi!\n';
	 tempat_lahir=document.sample_form.tempat_lahir.value;
	 if (tempat_lahir.length == 0) errmsg +='Tempat Lahir Wajib diisi!\n';
	 working_exp=document.sample_form.working_exp.value;
	 if (working_exp.length == 0) errmsg +='Pekerjaan Terakhir Wajib diisi!\n';
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}

function GetId1() {
			 emailNo = document.sample_form.email.value;
			 if (emailNo.length){
				LoadCheckDATA ("iLoader", "checkdata.php", "email="+emailNo);
			 }
}

function GetId2() {
			 IdNo = document.sample_form.ktp.value;
			 if (IdNo.length){
				LoadCheckDATA ("iLoader", "checkdata.php", "ktp="+IdNo);
			 }
}

function GetId3() {
			 hpNo = document.sample_form.hp.value;
			 if (hpNo.length){
				LoadCheckDATA ("iLoader", "checkdata.php", "hp="+hpNo);
			 }
}

function GetId4() {
			 hp_homeNo = document.sample_form.hp_home.value;
			 if (hp_homeNo.length){
				LoadCheckDATA ("iLoader", "checkdata.php", "hp_home="+hp_homeNo);
			 }
}
</script>