<?
	require_once("../../config.php");

if(isset($_GET["save"])){
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
			$nama_file = "";
		}
	}
	
	if(strlen($nama_file)){
		$strsql = "UPDATE tbl_jobseeker SET 
		           email='".postParam("email")."',full_name='".postParam("full_name")."',sex='".postParam("sex")."',place_of_birth='".postParam("tempat_lahir")."',
				   date_of_birth='".postParam("tahun")."-".postParam("bulan")."-".postParam("tanggal")." 00:00:00',address1='".postParam("address")."',address2='',
				   city='".postParam("city")."',zip_code='".postParam("zip_code")."',id_no='".postParam("ktp")."',id_no_valid='".postParam("ktp_valid")."',
				   phone_no1='".postParam("hp_home")."',phone_no2='".postParam("hp")."',religion='".postParam("agama")."',mar_status='".postParam("kawin")."',
				   last_study='".postParam("last_study")."',course='".postParam("course")."',height='".postParam("height")."',weight='".postParam("weight")."',
				   ethnic='".postParam("ethnic")."',confirm='".postParam("confirm")."',
				   nationality='".postParam("nationality")."',pict_file='".$nama_file."',user_id=".$_SESSION["user_id" . date("mdY")].",
				   branch_id='".postParam("selbranch")."',blood_type='".postParam("darah")."',driving_lisence_a='".postParam("sim_a")."',
				   driving_lisence_c='".postParam("sim_c")."',driving_lisence_other='".postParam("sim_other")."',hobby='".postParam("hobby")."',
				   working_exp='".postParam("working_exp")."'
				   WHERE js_id=".uriParam("js_id");
	}else{
		$strsql = "UPDATE tbl_jobseeker SET 
		           email='".postParam("email")."',full_name='".postParam("full_name")."',sex='".postParam("sex")."',place_of_birth='".postParam("tempat_lahir")."',
				   date_of_birth='".postParam("tahun")."-".postParam("bulan")."-".postParam("tanggal")." 00:00:00',address1='".postParam("address")."',address2='',
				   city='".postParam("city")."',zip_code='".postParam("zip_code")."',id_no='".postParam("ktp")."',id_no_valid='".postParam("ktp_valid")."',
				   phone_no1='".postParam("hp_home")."',phone_no2='".postParam("hp")."',religion='".postParam("agama")."',mar_status='".postParam("kawin")."',
				   last_study='".postParam("last_study")."',course='".postParam("course")."',height='".postParam("height")."',weight='".postParam("weight")."',
				   ethnic='".postParam("ethnic")."',confirm='".postParam("confirm")."',
				   nationality='".postParam("nationality")."',user_id=".$_SESSION["user_id" . date("mdY")].",branch_id='".postParam("selbranch")."',
				   blood_type='".postParam("darah")."',driving_lisence_a='".postParam("sim_a")."',driving_lisence_c='".postParam("sim_c")."',
				   driving_lisence_other='".postParam("sim_other")."',hobby='".postParam("hobby")."',working_exp='".postParam("working_exp")."'
				   WHERE js_id=".uriParam("js_id");
	}
	//echo $strsql;die();
	$insert=cmsDB();
	$insert->query($strsql);
	/*
	$strsql = "UPDATE tbl_jobseeker_interest_pos SET position_id = '".postParam("selposition")."', jsres_id='0' WHERE js_id='".uriParam("js_id")."'";
	$insert->query($strsql);
	*/
	
	$insert->query("delete from tbl_jobseeker_interest_pos where js_id=".uriParam("js_id"));
	$value=$_POST["selposition"];
	foreach($value as $id) {
		$strsql = "insert into tbl_jobseeker_interest_pos(js_id,position_id,jsres_id) values(".uriParam("js_id").",".$id.",0)";
		$insert->query($strsql);
	}
	
	
	echo "<script>alert('Job Seeker Updated!!');location='edit.php?edit=yes&js_id=".uriParam("js_id")."';</script>";
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
	$avail_status=$js->row("avail_status");
	$last_study=$js->row("last_study");
	$course=$js->row("course");
	$height=$js->row("height");
	$weight=$js->row("weight");
	$ethnic=$js->row("ethnic");
	$nationality=$js->row("nationality");
	$pict_file=$js->row("pict_file");
		if (file_exists($ANOM_VARS["www_img_path"]."js_photo/".$pict_file)) {
			$pict_file = $pict_file;
		} else {
			$pict_file = "nophoto.gif";
		}

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
	$confirm=$js->row("confirm");
	
	$js->query("select position_id from tbl_jobseeker_interest_pos where js_id=".uriParam("js_id"));
	$lstpos = $js->valueList("position_id");
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
	$last_salary="";
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
	$confirm="";
	$lstpos="";
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
		//You can add animated gif while loading // 
		//document.getElementById('process').innerHTML = '<img src="<?=$ANOM_VARS["www_img_url"]?>anim_logo.gif" border="0" width="32" height="31">';
	}
	if(request.readyState == 4){
		var data = request.responseText;
		document.getElementById('output').innerHTML = data;
		//document.getElementById('process').innerHTML = '<img src="<?=$ANOM_VARS["www_img_url"]?>Logo_Mega_transparant.gif" border="0" width="32" height="31">';
	}
}
function _selsubmit(frm,addr,pars_var){
	addr = addr + '&'+ pars_var +'=' + eval("document."+ frm + ".value");
	get_method(addr);
}
//The difference between POST and GET, POST method support or can transffer large data... 
</script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<body topmargin="0">
<center><div id="output">
<form enctype="multipart/form-data" action="<?=$_SERVER["SCRIPT_NAME"]?>?save=yes&js_id=<?=uriParam("js_id")?>" method="post" name="sample_form" id="sample_form" onSubmit="return Check()">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td  align="left" colSpan="2">
		<table border="0" cellpadding="5" cellspacing="2" width="100%">
			<tr>
				<td class="tableheader" align="center">Personal Data</td>
				<? if(isset($_GET["edit"])){?>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new1.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Referensi</a></td>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new2.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Susunan Keluarga</a></td>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new3.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Riwayat Pendidikan</a></td>
					<td class="tablebodyodd" align="center"><a href="javascript:get_method('new4.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Riwayat Pekerjaan</a></td>
				<?}?>
			</tr>
			<tr>
				<TD colspan="5" style="HEIGHT: 1px"><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></TD>
			</tr>
		</table>    </td>
  </tr>
  <tr> 
    <td  align="left" colSpan="2" class="tablebodyodd">
	
	<table border="0" cellpadding="2" cellspacing="0" width="100%">
			  <tr >
			    <td align="left" vAlign="top">Photo</td>
			    <td align="left" vAlign="top">:</td>
			    <td colspan="4" align="left" vAlign="top"><? if(isset($_GET["edit"])){?>
                  <img src="<?=$ANOM_VARS["www_img_url"]?>js_photo/<?=$pict_file?>" border=0 width="110" height="150"><br><br>
                  <? } ?>
                  <input type="hidden" name="MAX_FILE_SIZE" value="150000" />
                  <input type="file" size="40" name="pict"> (Max upload Images file : 100 Kb)</td>
			    <td width="1%" align="right" vAlign="top">&nbsp;</td>
			  </tr>
			  <tr >
			    <td width="18%" align="left" vAlign="top">Nama Lengkap</td>
			    <td width="1%" vAlign="top">:</td>
			    <td colspan="4" align="left" vAlign="top"><input maxlength="100" size="30" name="full_name" value="<?=$full_name?>">&nbsp;<font color="red"><b>*</b></font></td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">Email</td>
			    <td vAlign="top">:</td>
			    <td colspan="4" align="left" vAlign="top"><input maxlength="100" size="30" name="email" value="<?=$email?>">&nbsp;<font color="red"><b>*</b></font></td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">ID No. (KTP)</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="29%"><input size="30" name="ktp" value="<?=$id_no?>" onKeyPress="return handleEnter(this, event, 6)">&nbsp;<font color="red"><b>*</b></font></td>
			    <td align="right" width="19%">Berlaku Sampai :</td>
			    <td colspan="2" align="left"><input size="5" maxlength="4" name="ktp_valid" value="<?=$id_no_valid?>" onKeyPress="return handleEnter(this, event, 4)">&nbsp;<font color="red"><b>*</b></font></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="right">
			      <table cellSpacing="0" cellPadding="0" align="left" border="0">
			        <tbody>
			          <tr>
			            <td>Driving Lisence (SIM)</td>
			          </tr>
			        </tbody>
			      </table>
			      A&nbsp;</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="29%"><input size="30" name="sim_a" value="<?=$driving_lisence_a?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			    <td align="right" width="19%">C :</td>
			    <td colspan="2" align="left"><input size="30" name="sim_c" value="<?=$driving_lisence_c?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			  </tr>
			   <tr >
			    <td vAlign="top" align="right">
			      SIM Lainnya				  </td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="29%"><input size="30" name="sim_other" value="<?=$driving_lisence_other?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			    <td align="right" width="19%">&nbsp;</td>
			    <td colspan="2" align="left">&nbsp;</td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Tempat Lahir</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left" width="29%"><input type="Text" name="tempat_lahir" size="30" maxlength="50" value="<?=$place_of_birth?>" onKeyPress="return handleEnter(this, event, 5)">&nbsp;<font color="red"><b>*</b></font></td>
			    <td align="right" width="19%">Tanggal Lahir :</td>
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
			        <? for($i=1950;$i<=2000;$i++){?>
			        <option value="<?=$i?>"  <?if($i==$thn){ echo "selected";}?>><?=$i?></option>
					<? } ?>
		        </select>&nbsp;<font color="red">*</font></td>
			  </tr>
			  <tr >
			    <td vAlign="top" align="left">Jenis Kelamin</td>
			    <td vAlign="top">:</td>
			    <td colspan="4" vAlign="top" align="left"><input type="radio" value="Laki-Laki" name="sex" <? if($sex=="Laki-Laki"){ echo "checked";}?> checked >
			    Laki-Laki
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
			    <td vAlign="top" align="right">Pendidikan :</td>
			    <td width="6%"><select name="last_study">
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
			    <td width="26%"><?
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
			    <td vAlign="top" align="right">Pekerjaan Terakhir :</td>
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
			    <td colspan="4" align="left"><input maxLength="255" size="30" name="hobby" value="<?=$hobby?>"></td>
		      </tr>
			  <tr >
			    <td vAlign="top" align="left">Handphone</td>
			    <td vAlign="top">:</td>
			    <td vAlign="top" align="left"><input maxLength="15" size="30" name="hp" value="<?=$phone_no2?>" onKeyPress="return handleEnter(this, event, 4)">&nbsp;<font color="red"><b>*</b></font><br>
			      <span class="inputStyle5">Contoh: <b>0</b>817xxxxxx</span></td>
			    <td vAlign="top" align="right">Tlp rumah :</td>
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
						$strsql="SELECT * FROM tbl_branch 
						WHERE branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].") order by branch_name asc";
						$branch->query($strsql);
						//$branch->next();
	                    //$br=$branch->row("branch_name");
						?>
						<select name="selbranch">
							<? while($branch->next()){?>
						        <option value="<?=$branch->row("branch_id")?>" <? if($branch_id==$branch->row("branch_id")){ echo " selected";}?>><?=$branch->row("branch_name");?></option>
                                <? } ?>
					      </select></td>
			  <tr >
			    <td align="left">Kode Pos</td>
			    <td>:</td>
			    <td align="left"><input maxlength="6" size="30" name="zip_code" value="<?=$zip_code?>" onKeyPress="return handleEnter(this, event, 4)"></td>
			    <td rowspan="2" align="right" valign="top">Posisi yg Dilamar :</td>
			    <td colspan="2" rowspan="2" align="left" valign="top"><?
				$position = cmsDB();
				//$position->query("select * from tbl_position order by position_name asc")
				//Query update Branch
		$strsql="SELECT COUNT(*) as hasil,tbl_branch.branch_name, tbl_region.region_name,tbl_golongan.name,tbl_position.position_name,
				tbl_position.position_id 
				FROM tbl_position
				INNER JOIN tbl_branch_mpp_apply ON tbl_branch_mpp_apply.position_id = tbl_position.position_id
				INNER JOIN tbl_golongan ON tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
				INNER JOIN tbl_branch ON tbl_branch_mpp_apply.branch_id = tbl_branch.branch_id
				INNER JOIN tbl_region ON tbl_branch.region_id = tbl_region.region_id
				WHERE request_status = 'approved' and tbl_branch.branch_id = '".$branch_id."'
				GROUP BY position_name asc";
				$position->query($strsql);
				?>
                  <select name="selposition[]">
                    <? while($position->next()){?>
                    <option value="<?=$position->row("position_id")?>" <? if(listFind($lstpos,$position->row("position_id"))){echo " selected";}?>>
                      <?=$position->row("position_name")?> - (<?=$position->row("hasil")?> posisi)
                    </option>
                    <? } ?>
                  </select>                 </td>
			  </tr>
			  <tr >
			    <td align="left" valign="top">Alamat</td>
			    <td valign="top">:</td>
			    <td align="left"><textarea class="inputStyle5" name="address" rows="4" cols="40"><?=$address1?></textarea></td>
		      </tr>
</table>
  <tr>
    <td width="78%" align="center" class="tableheader">
				<? if(listFind($_SESSION["ss_id" . date("mdY")],"13")){?>
				<input type="submit" value=" Update Personal Data">
                <? } ?>
				<? if(listFind($_SESSION["ss_id" . date("mdY")],"41")){?>
				<? if($avail_status=="reserved" || $avail_status=="recruitment process" || $avail_status=="ol process" || $avail_status=="recruitment failed" || $avail_status=="recruitment passed" || $avail_status=="employee"){?>
					&nbsp;<input type="Button" value="Jobseeker Has Been Reserved"  disabled onClick="location='reserved.php?js_id=<?=uriParam("js_id")?>&urlencrypt=<?=md5("mdYHis")?>';">
				<? }else{ ?>
				&nbsp;<input type="Button" value="Reserved Jobseeker" onClick="location='reserved.php?js_id=<?=uriParam("js_id")?>&urlencrypt=<?=md5("mdYHis")?>';">
				<? } ?>
				<? } ?>
				&nbsp;<input type="Button" value="Print" onClick="location='form_lamaran_new_pdf.php?js_id=<?=uriParam("js_id")?>&urlencrypt=<?=md5("mdYHis")?>';">
				<? if(listFind($_SESSION["ss_id" . date("mdY")],"15")){?>
                &nbsp;
                <input type="Button" value="Delete" onClick="location='delete.php?js_id=<?=uriParam("js_id")?>&urlencrypt=<?=md5("mdYHis")?>';">
				<? } ?>
				&nbsp;
			<input type="Button" value="Cancel" onClick="location='index.php?urlencrypt=<?=md5("mdYHis")?>';"></td>
            <td width="22%" align="right"  class="tableheader"><table width="0%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="tableheader">Internal Status</td>
                <td class="tableheader">:</td>
                <td class="tableheader"><? if(listFind($_SESSION["ss_id" . date("mdY")],"15")){?>
                  <select size="0" name="confirm">
                    <option value="" <? if(trim($confirm)==""){echo " selected";}?>></option>
                    <option value="Interview" <? if(trim($confirm)=="Interview"){echo " selected";}?>>Interview</option>
                    <option value="Psychotest" <? if(trim($confirm)=="Psychotest"){echo " selected";}?>>Psychotest</option>
                    <option value="Proses" <? if(trim($confirm)=="Proses"){echo " selected";}?>>Proses</option>
                    <option value="Lulus" <? if(trim($confirm)=="Lulus"){echo " selected";}?>>Lulus</option>
                    <option value="Gagal" <? if(trim($confirm)=="Gagal"){echo " selected";}?>>Gagal</option>
                  </select>
                  <? } ?></td>
              </tr>
            </table>            </td>
        </tr>
  

<? if($avail_status=="reserved" || $avail_status=="recruitment process" || $avail_status=="ol process" || $avail_status=="recruitment failed" || $avail_status=="recruitment passed" || $avail_status=="employee"){
	$js_avail = cmsDB();
	$js_avail->query("select vacantpos_id,apply_date from tbl_vacantpos_jobseeker where js_id=". uriParam("js_id"));
	if($js_avail->recordCount()){
		$js_avail->next();
		$vacantpos_id = $js_avail->row("vacantpos_id");
		$apply_date = $js_avail->row("apply_date");
		$strsql = "SELECT tbl_branch_mpp_apply.*,tbl_position_vacant.vacantpos_id,tbl_branch.branch_name,
		                  tbl_region.region_name,tbl_golongan.name,tbl_position.position_id,tbl_position.position_name 
					FROM tbl_branch_mpp_apply 
					INNER JOIN tbl_position_vacant on tbl_branch_mpp_apply.mpppos_id=tbl_position_vacant.mpppos_id 
					INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id 
					INNER JOIN tbl_region on tbl_branch.region_id=tbl_region.region_id 
					INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
					INNER JOIN tbl_position on tbl_branch_mpp_apply.position_id = tbl_position.position_id
					where tbl_branch_mpp_apply.request_status='approved'  and tbl_position_vacant.vacantpos_id=".$vacantpos_id;
		$js_avail->query($strsql);
		$js_avail->next();
		$position = $js_avail->row("position_name");
		$region = $js_avail->row("region_name");
		$branch = $js_avail->row("branch_name");
		$grade = $js_avail->row("name");
		$dateline = $js_avail->row("month_dateline");
		echo "<tr><td  class=\"heading2\" colSpan=\"5\" align=\"center\"><font color=\"blue\">Reserved Posisi :</font><font color=\"red\"> " . $position . " <font color=\"blue\">Tgl :</font><font color=\"red\"> ".datesql2date($apply_date)."</font><font color=\"blue\"> Region-Branch :</font><font color=\"red\"> [".$region."-".$branch."]</font></td></tr>";
		
	}else{
		echo "<tr><td  class=\"heading2\" colSpan=\"5\" align=\"center\">Unknown Status : Contact Your Administrator</td></tr>";
	}
	
}?>
</table>
</form>
</div>
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