<?
	require_once("../../config.php");
	//Ortu
	$family=cmsDB();
	$couple=cmsDB();
	$child=cmsDB();
	
	if(isset($_GET["save"])){
		$family->query("delete from tbl_jobseeker_family where js_id=".uriParam("js_id"));
		$family->query("delete from tbl_jobseeker_couple where js_id=".uriParam("js_id"));
		$family->query("delete from tbl_jobseeker_children where js_id=".uriParam("js_id"));
		
		$father_date = postParam("father_thn")."-".postParam("father_bln")."-".postParam("father_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-father-','".postParam("father_name")."','male','".postParam("father_edu")."','".$father_date."','".postParam("father_pob")."','".postParam("father_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$mother_date = postParam("mother_thn")."-".postParam("mother_bln")."-".postParam("mother_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-mother-','".postParam("mother_name")."','female','".postParam("mother_edu")."','".$mother_date."','".postParam("mother_pob")."','".postParam("mother_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$bro1_date = postParam("bro1_thn")."-".postParam("bro1_bln")."-".postParam("bro1_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-brother/sister-','".postParam("bro1_name")."','".postParam("bro1_sex")."','".postParam("bro1_edu")."','".$bro1_date."','".postParam("bro1_pob")."','".postParam("bro1_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$bro2_date = postParam("bro2_thn")."-".postParam("bro2_bln")."-".postParam("bro2_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-brother/sister-','".postParam("bro2_name")."','".postParam("bro2_sex")."','".postParam("bro2_edu")."','".$bro2_date."','".postParam("bro2_pob")."','".postParam("bro2_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$bro3_date = postParam("bro3_thn")."-".postParam("bro3_bln")."-".postParam("bro3_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-brother/sister-','".postParam("bro3_name")."','".postParam("bro3_sex")."','".postParam("bro3_edu")."','".$bro3_date."','".postParam("bro3_pob")."','".postParam("bro3_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$bro4_date = postParam("bro4_thn")."-".postParam("bro4_bln")."-".postParam("bro4_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-brother/sister-','".postParam("bro4_name")."','".postParam("bro4_sex")."','".postParam("bro4_edu")."','".$bro4_date."','".postParam("bro4_pob")."','".postParam("bro4_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$bro5_date = postParam("bro5_thn")."-".postParam("bro5_bln")."-".postParam("bro5_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-brother/sister-','".postParam("bro5_name")."','".postParam("bro5_sex")."','".postParam("bro5_edu")."','".$bro5_date."','".postParam("bro5_pob")."','".postParam("bro5_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$bro6_date = postParam("bro6_thn")."-".postParam("bro6_bln")."-".postParam("bro6_tgl");
		$strsql = "insert into tbl_jobseeker_family(relation,name,sex,last_edu,date_of_birth,place_of_birth,job,js_id) values('-brother/sister-','".postParam("bro6_name")."','".postParam("bro6_sex")."','".postParam("bro6_edu")."','".$bro6_date."','".postParam("bro6_pob")."','".postParam("bro6_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		//Couple
		$hw_date = postParam("hw_thn")."-".postParam("hw_bln")."-".postParam("hw_tgl");
		$strsql = "insert into tbl_jobseeker_couple(couple_name,sex,place_of_birth,date_of_birth,job_title,last_edu,js_id) values('".postParam("hw_name")."','".postParam("hw_sex")."','".postParam("hw_pob")."','".$hw_date."','".postParam("hw_job")."','".postParam("hw_edu")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		//Children
		$child1_date = postParam("child1_thn")."-".postParam("child1_bln")."-".postParam("child1_tgl");
		$strsql = "insert into tbl_jobseeker_children(name,sex,last_edu,date_of_birth,place_of_birth,job_title,js_id) values('".postParam("child1_name")."','".postParam("child1_sex")."','".postParam("child1_edu")."','".$child1_date."','".postParam("child1_pob")."','".postParam("child1_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$child2_date = postParam("child2_thn")."-".postParam("child2_bln")."-".postParam("child2_tgl");
		$strsql = "insert into tbl_jobseeker_children(name,sex,last_edu,date_of_birth,place_of_birth,job_title,js_id) values('".postParam("child2_name")."','".postParam("child2_sex")."','".postParam("child2_edu")."','".$child2_date."','".postParam("child2_pob")."','".postParam("child2_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$child3_date = postParam("child3_thn")."-".postParam("child3_bln")."-".postParam("child3_tgl");
		$strsql = "insert into tbl_jobseeker_children(name,sex,last_edu,date_of_birth,place_of_birth,job_title,js_id) values('".postParam("child3_name")."','".postParam("child3_sex")."','".postParam("child3_edu")."','".$child3_date."','".postParam("child3_pob")."','".postParam("child3_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$child4_date = postParam("child4_thn")."-".postParam("child4_bln")."-".postParam("child4_tgl");
		$strsql = "insert into tbl_jobseeker_children(name,sex,last_edu,date_of_birth,place_of_birth,job_title,js_id) values('".postParam("child4_name")."','".postParam("child4_sex")."','".postParam("child4_edu")."','".$child4_date."','".postParam("child4_pob")."','".postParam("child4_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$child5_date = postParam("child5_thn")."-".postParam("child5_bln")."-".postParam("child5_tgl");
		$strsql = "insert into tbl_jobseeker_children(name,sex,last_edu,date_of_birth,place_of_birth,job_title,js_id) values('".postParam("child5_name")."','".postParam("child5_sex")."','".postParam("child5_edu")."','".$child5_date."','".postParam("child5_pob")."','".postParam("child5_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		
		$child6_date = postParam("child6_thn")."-".postParam("child6_bln")."-".postParam("child6_tgl");
		$strsql = "insert into tbl_jobseeker_children(name,sex,last_edu,date_of_birth,place_of_birth,job_title,js_id) values('".postParam("child6_name")."','".postParam("child6_sex")."','".postParam("child6_edu")."','".$child6_date."','".postParam("child6_pob")."','".postParam("child6_job")."',".uriParam("js_id").")";
		$family->query($strsql);
		echo "<script>alert('Job Seeker Family Updated!!');location='edit.php?edit=yes&js_id=".uriParam("js_id")."';</script>";
		die();
	}
	
	$strsql = "select * from tbl_jobseeker_family where js_id=".uriParam("js_id") . " order by jsfamily_id asc";
	$family->query($strsql);
	if($family->recordCount()){
		//Father
		$family->next();
		$father_name=$family->row("name");
		$father_edu=$family->row("last_edu");
		$father_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$father_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$father_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$father_pob=$family->row("place_of_birth");
		$father_job=$family->row("job");
		//Mother
		$family->next();
		$mother_name=$family->row("name");
		$mother_edu=$family->row("last_edu");
		$mother_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$mother_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$mother_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$mother_pob=$family->row("place_of_birth");
		$mother_job=$family->row("job");
		
		//Brother& Sister
		$family->next();
		$bro1_name=$family->row("name");
		$bro1_sex=$family->row("sex");
		$bro1_edu=$family->row("last_edu");
		$bro1_pob=$family->row("place_of_birth");
		$bro1_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$bro1_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$bro1_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$bro1_job=$family->row("job");
		
		$family->next();
		$bro2_name=$family->row("name");
		$bro2_sex=$family->row("sex");
		$bro2_edu=$family->row("last_edu");
		$bro2_pob=$family->row("place_of_birth");
		$bro2_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$bro2_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$bro2_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$bro2_job=$family->row("job");
		
		$family->next();
		$bro3_name=$family->row("name");
		$bro3_sex=$family->row("sex");
		$bro3_edu=$family->row("last_edu");
		$bro3_pob=$family->row("place_of_birth");
		$bro3_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$bro3_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$bro3_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$bro3_job=$family->row("job");
		
		$family->next();
		$bro4_name=$family->row("name");
		$bro4_sex=$family->row("sex");
		$bro4_edu=$family->row("last_edu");
		$bro4_pob=$family->row("place_of_birth");
		$bro4_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$bro4_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$bro4_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$bro4_job=$family->row("job");
		
		$family->next();
		$bro5_name=$family->row("name");
		$bro5_sex=$family->row("sex");
		$bro5_edu=$family->row("last_edu");
		$bro5_pob=$family->row("place_of_birth");
		$bro5_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$bro5_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$bro5_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$bro5_job=$family->row("job");
		
		$family->next();
		$bro6_name=$family->row("name");
		$bro6_sex=$family->row("sex");
		$bro6_edu=$family->row("last_edu");
		$bro6_pob=$family->row("place_of_birth");
		$bro6_tgl=listGetAt($family->row("date_of_birth"),3,"-");
		$bro6_bln=listGetAt($family->row("date_of_birth"),2,"-");
		$bro6_thn=listGetAt($family->row("date_of_birth"),1,"-");
		$bro6_job=$family->row("job");
	}else{
		//Father
		$father_name="";
		$father_edu="";
		$father_tgl=date("d");
		$father_bln=date("m");
		$father_thn=date("Y");
		$father_pob="";
		$father_job="";
		//Mother
		
		$mother_name="";
		$mother_edu="";
		$mother_tgl=date("d");
		$mother_bln=date("m");
		$mother_thn=date("Y");
		$mother_pob="";
		$mother_job="";
		
		//Brother& Sister
		
		$bro1_name="";
		$bro1_sex="";
		$bro1_edu="";
		$bro1_pob="";
		$bro1_tgl=date("d");
		$bro1_bln=date("m");
		$bro1_thn=date("Y");
		$bro1_job="";
		
		
		$bro2_name="";
		$bro2_sex="";
		$bro2_edu="";
		$bro2_pob="";
		$bro2_tgl=date("d");
		$bro2_bln=date("m");
		$bro2_thn=date("Y");
		$bro2_job="";
		
		
		$bro3_name="";
		$bro3_sex="";
		$bro3_edu="";
		$bro3_pob="";
		$bro3_tgl=date("d");
		$bro3_bln=date("m");
		$bro3_thn=date("Y");
		$bro3_job="";
		
		
		$bro4_name="";
		$bro4_sex="";
		$bro4_edu="";
		$bro4_pob="";
		$bro4_tgl=date("d");
		$bro4_bln=date("m");
		$bro4_thn=date("Y");
		$bro4_job="";
		
		
		$bro5_name="";
		$bro5_sex="";
		$bro5_edu="";
		$bro5_pob="";
		$bro5_tgl=date("d");
		$bro5_bln=date("m");
		$bro5_thn=date("Y");
		$bro5_job="";
		
		
		$bro6_name="";
		$bro6_sex="";
		$bro6_edu="";
		$bro6_pob="";
		$bro6_tgl=date("d");
		$bro6_bln=date("m");
		$bro6_thn=date("Y");
		$bro6_job="";
	}
	

	$strsql = "select * from tbl_jobseeker_couple where js_id=".uriParam("js_id"). " order by jscouple_id asc";
	$couple->query($strsql);
	if($couple->recordCount()){
		$couple->next();
		$hw_name=$couple->row("couple_name");
		$hw_sex=$couple->row("sex");
		$hw_pob=$couple->row("place_of_birth");
		$hw_tgl=listGetAt($couple->row("date_of_birth"),3,"-");
		$hw_bln=listGetAt($couple->row("date_of_birth"),2,"-");
		$hw_thn=listGetAt($couple->row("date_of_birth"),1,"-");
		$hw_job=$couple->row("job_title");
		$hw_edu=$couple->row("last_edu");
	}else{
		$hw_name="";
		$hw_sex="";
		$hw_pob="";
		$hw_tgl=date("d");
		$hw_bln=date("m");
		$hw_thn=date("Y");
		$hw_job="";
		$hw_edu="";
	}
	
	$strsql = "select * from tbl_jobseeker_children where js_id=".uriParam("js_id"). " order by jschildren_id asc";
	$child->query($strsql);
	if($child->recordCount()){
		$child->next();
		$child1_name=$child->row("name");
		$child1_sex=$child->row("sex");
		$child1_edu=$child->row("last_edu");
		$child1_pob=$child->row("place_of_birth");
		$child1_tgl=listGetAt($child->row("date_of_birth"),3,"-");
		$child1_bln=listGetAt($child->row("date_of_birth"),2,"-");
		$child1_thn=listGetAt($child->row("date_of_birth"),1,"-");
		$child1_job=$child->row("job_title");
		
		$child->next();
		$child2_name=$child->row("name");
		$child2_sex=$child->row("sex");
		$child2_edu=$child->row("last_edu");
		$child2_pob=$child->row("place_of_birth");
		$child2_tgl=listGetAt($child->row("date_of_birth"),3,"-");
		$child2_bln=listGetAt($child->row("date_of_birth"),2,"-");
		$child2_thn=listGetAt($child->row("date_of_birth"),1,"-");
		$child2_job=$child->row("job_title");
		
		$child->next();
		$child3_name=$child->row("name");
		$child3_sex=$child->row("sex");
		$child3_edu=$child->row("last_edu");
		$child3_pob=$child->row("place_of_birth");
		$child3_tgl=listGetAt($child->row("date_of_birth"),3,"-");
		$child3_bln=listGetAt($child->row("date_of_birth"),2,"-");
		$child3_thn=listGetAt($child->row("date_of_birth"),1,"-");
		$child3_job=$child->row("job_title");
		
		$child->next();
		$child4_name=$child->row("name");
		$child4_sex=$child->row("sex");
		$child4_edu=$child->row("last_edu");
		$child4_pob=$child->row("place_of_birth");
		$child4_tgl=listGetAt($child->row("date_of_birth"),3,"-");
		$child4_bln=listGetAt($child->row("date_of_birth"),2,"-");
		$child4_thn=listGetAt($child->row("date_of_birth"),1,"-");
		$child4_job=$child->row("job_title");
		
		$child->next();
		$child5_name=$child->row("name");
		$child5_sex=$child->row("sex");
		$child5_edu=$child->row("last_edu");
		$child5_pob=$child->row("place_of_birth");
		$child5_tgl=listGetAt($child->row("date_of_birth"),3,"-");
		$child5_bln=listGetAt($child->row("date_of_birth"),2,"-");
		$child5_thn=listGetAt($child->row("date_of_birth"),1,"-");
		$child5_job=$child->row("job_title");
		
		$child->next();
		$child6_name=$child->row("name");
		$child6_sex=$child->row("sex");
		$child6_edu=$child->row("last_edu");
		$child6_pob=$child->row("place_of_birth");
		$child6_tgl=listGetAt($child->row("date_of_birth"),3,"-");
		$child6_bln=listGetAt($child->row("date_of_birth"),2,"-");
		$child6_thn=listGetAt($child->row("date_of_birth"),1,"-");
		$child6_job=$child->row("job_title");
	}else{
		$child1_name="";
		$child1_sex="";
		$child1_edu="";
		$child1_pob="";
		$child1_tgl=date("d");
		$child1_bln=date("m");
		$child1_thn=date("Y");
		$child1_job="";
		
		
		$child2_name="";
		$child2_sex="";
		$child2_edu="";
		$child2_pob="";
		$child2_tgl=date("d");
		$child2_bln=date("m");
		$child2_thn=date("Y");
		$child2_job="";
		
		
		$child3_name="";
		$child3_sex="";
		$child3_edu="";
		$child3_pob="";
		$child3_tgl=date("d");
		$child3_bln=date("m");
		$child3_thn=date("Y");
		$child3_job="";
		
		
		$child4_name="";
		$child4_sex="";
		$child4_edu="";
		$child4_pob="";
		$child4_tgl=date("d");
		$child4_bln=date("m");
		$child4_thn=date("Y");
		$child4_job="";
		
		
		$child5_name="";
		$child5_sex="";
		$child5_edu="";
		$child5_pob="";
		$child5_tgl=date("d");
		$child5_bln=date("m");
		$child5_thn=date("Y");
		$child5_job="";
		
		
		$child6_name="";
		$child6_sex="";
		$child6_edu="";
		$child6_pob="";
		$child6_tgl=date("d");
		$child6_bln=date("m");
		$child6_thn=date("Y");
		$child6_job="";
	}
	//name,place_of_birth,date_of_birth,last_edu,job_title,js_id
?>
<body topmargin="0">
<center>
<form action="<?=$_SERVER["SCRIPT_NAME"]?>?save=yes&edit=yes&js_id=<?=uriParam("js_id")?>" method="post" name="sample_form" id="sample_form" onSubmit="return Check()">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td  align="left" colSpan="5">
		<table border="0" cellpadding="5" cellspacing="2" width="100%">
			<tr>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('edit.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Personal Data</a></td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new1.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Referensi</a></td>
				<td class="tableheader" align="center">Susunan Keluarga</td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new3.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Riwayat Pendidikan</a></td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new4.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Riwayat Pekerjaan</a></td>
			</tr>
			<tr>
				<TD colspan="5" style="HEIGHT: 1px"><IMG height=1 
                                src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                                width="100%"></TD>
			</tr>
		</table>
	 
    </td>
  </tr>
  <tr>
    <td  align="left" colSpan="5" class="tablebodyodd">
				<table border="0" align="center" cellpadding="2" cellspacing="1">
					<tr>
                      <td valign="top">
                      <table width="100%" border="0" cellpadding="0" cellspacing="1">
                      <tr class="inputStyle6">
                        <td colspan="10" align="left" height="21"><b><u>OrangTua</u></b></td>
                        </tr>
                      <tr class="inputStyle4">
                        <td class="tableheader" colspan="4" align="center" height="21"><b>Nama</b></td>
                        <td height="21" colspan="4" align="center" class="tableheader"><b>Tempat/Tgl Lahir</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pendidikan</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pekerjaan</b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="4" align="left"><table width="246" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="50"><b>Ayah</b>&nbsp;</td>
                            <td width="2"><b>:</b></td>
                            <td width="186"><input size="30" maxlength="20" name="father_name" type="text" value="<?=$father_name?>" /></td>
                          </tr>
                        </table></td>
                        <td align="left"><input name="father_pob" maxlength="8" type="text" size="10" value="<?=$father_pob?>" /></td>
                        <td align="left"><select name="father_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($father_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="father_bln" size="1">
                          <option value="1"<?if($father_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($father_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($father_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($father_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($father_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($father_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($father_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($father_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($father_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($father_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($father_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($father_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="father_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>" <?if($father_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="center"><input size="30" maxlength="20" name="father_edu" type="text" value="<?=$father_edu?>"/></td>
                        <td align="center"><input size="30" maxlength="20" name="father_job" type="text" value="<?=$father_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="4" align="left">
<table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="52"><b>Ibu</b></td>
                            <td><b>:</b></td>
                            <td><input size="30" maxlength="20" name="mother_name" type="text" value="<?=$mother_name?>" /></td>
                          </tr>
                        </table>                        </td>
                        <td align="left"><input name="mother_pob" maxlength="8" type="text" size="10"  value="<?=$mother_pob?>"/></td>
                        <td align="left"><select name="mother_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($mother_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="mother_bln" size="1">
                          <option value="1"<?if($mother_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($mother_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($mother_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($mother_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($mother_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($mother_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($mother_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($mother_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($mother_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($mother_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($mother_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($mother_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="mother_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"<?if($mother_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="center"><input size="30" maxlength="20" name="mother_edu" type="text" value="<?=$mother_edu?>"/></td>
                        <td align="center"><input size="30" maxlength="20" name="mother_job" type="text" value="<?=$mother_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="10" align="center" height="21">&nbsp;</td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="10" align="left" height="21"><b><u>Saudara Sekandung Berikut Anda Sendiri</u></b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td class="tableheader" colspan="3" align="center" height="21"><b>Nama</b></td>
                        <td class="tableheader" align="center" height="21"><b>Sex</b></td>
                        <td height="21" colspan="4" align="center" class="tableheader"><b>Tempat/Tgl Lahir</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pendidikan</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pekerjaan</b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>1</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="bro1_name" type="text" value="<?=$bro1_name?>"/></td>
                        <td><select size="1" name="bro1_sex">
                            <option value="male"<?if($bro1_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($bro1_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="bro1_pob" maxlength="8" type="text" size="10" value="<?=$bro1_pob?>"/></td>
                        <td align="left"><select name="bro1_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($bro1_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="bro1_bln" size="1">
                          <option value="1"<?if($bro1_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($bro1_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($bro1_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($bro1_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($bro1_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($bro1_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($bro1_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($bro1_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($bro1_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($bro1_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($bro1_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($bro1_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="bro1_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($bro1_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="bro1_edu" type="text" value="<?=$bro1_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="bro1_job" type="text" value="<?=$bro1_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>2</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="bro2_name" type="text" value="<?=$bro2_name?>"/></td>
                        <td><select size="1" name="bro2_sex">
                            <option value="male"<?if($bro2_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($bro2_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="bro2_pob" maxlength="8" type="text" size="10" value="<?=$bro2_pob?>"/></td>
                        <td align="left"><select name="bro2_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($bro2_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="bro2_bln" size="1">
                          <option value="1"<?if($bro2_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($bro2_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($bro2_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($bro2_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($bro2_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($bro2_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($bro2_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($bro2_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($bro2_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($bro2_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($bro2_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($bro2_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="bro2_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($bro2_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="bro2_edu" type="text" value="<?=$bro2_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="bro2_job" type="text" value="<?=$bro2_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>3</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="bro3_name" type="text" value="<?=$bro3_name?>"/></td>
                        <td><select size="1" name="bro3_sex">
                            <option value="male"<?if($bro3_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($bro3_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="bro3_pob" maxlength="8" type="text" size="10" value="<?=$bro3_pob?>"/></td>
                        <td align="left"><select name="bro3_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($bro3_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="bro3_bln" size="1">
                          <option value="1"<?if($bro3_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($bro3_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($bro3_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($bro3_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($bro3_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($bro3_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($bro3_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($bro3_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($bro3_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($bro3_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($bro3_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($bro3_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="bro3_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($bro3_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="bro3_edu" type="text" value="<?=$bro3_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="bro3_job" type="text" value="<?=$bro3_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>4</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="bro4_name" type="text" value="<?=$bro4_name?>"/></td>
                        <td><select size="1" name="bro4_sex">
                            <option value="male"<?if($bro4_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($bro4_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="bro4_pob" maxlength="8" type="text" size="10" value="<?=$bro4_pob?>"/></td>
                        <td align="left"><select name="bro4_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($bro4_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="bro4_bln" size="1">
                          <option value="1"<?if($bro4_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($bro4_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($bro4_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($bro4_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($bro4_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($bro4_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($bro4_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($bro4_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($bro4_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($bro4_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($bro4_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($bro4_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="bro4_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($bro4_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="bro4_edu" type="text" value="<?=$bro4_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="bro4_job" type="text" value="<?=$bro4_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>5</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="bro5_name" type="text" value="<?=$bro5_name?>"/></td>
                        <td><select size="1" name="bro5_sex">
                            <option value="male"<?if($bro5_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($bro5_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="bro5_pob" maxlength="8" type="text" size="10" value="<?=$bro5_pob?>"/></td>
                        <td align="left"><select name="bro5_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($bro5_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="bro5_bln" size="1">
                          <option value="1"<?if($bro5_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($bro5_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($bro5_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($bro5_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($bro5_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($bro5_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($bro5_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($bro5_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($bro5_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($bro5_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($bro5_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($bro5_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="bro5_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($bro5_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="bro5_edu" type="text" value="<?=$bro5_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="bro5_job" type="text" value="<?=$bro5_job?>"/></td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="bro6_name" type="text" value="<?=$bro6_name?>"/></td>
                        <td><select size="1" name="bro6_sex">
                            <option value="male"<?if($bro6_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($bro6_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="bro6_pob" maxlength="8" type="text" size="10" value="<?=$bro6_pob?>"/></td>
                        <td align="left"><select name="bro6_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($bro6_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="bro6_bln" size="1">
                          <option value="1"<?if($bro6_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($bro6_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($bro6_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($bro6_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($bro6_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($bro6_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($bro6_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($bro6_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($bro6_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($bro6_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($bro6_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($bro6_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="bro6_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($bro6_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="bro6_edu" type="text" value="<?=$bro6_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="bro6_job" type="text" value="<?=$bro6_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="10" height="21">&nbsp;</td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="10" height="21"><b><u>Suami/Istri</u></b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td class="tableheader" colspan="3" align="center" height="21"><b>Nama</b></td>
                        <td class="tableheader" align="center" height="21"><b>Sex</b></td>
                        <td height="21" colspan="4" align="center" class="tableheader"><b>Tempat/Tgl Lahir</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pendidikan</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pekerjaan</b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td></td>
                        <td></td>
                        <td><input size="30" maxlength="20" name="hw_name" type="text" value="<?=$hw_name?>"/></td>
                        <td><select size="1" name="hw_sex">
                            <option value="male"<?if($hw_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($hw_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="hw_pob" maxlength="20" type="text" size="10" value="<?=$hw_pob?>"/></td>
                        <td align="left"><select name="hw_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($hw_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="hw_bln" size="1">
                          <option value="1"<?if($hw_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($hw_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($hw_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($hw_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($hw_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($hw_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($hw_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($hw_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($hw_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($hw_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($hw_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($hw_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="hw_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($hw_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="hw_edu" type="text" value="<?=$hw_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="hw_job" type="text" value="<?=$hw_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="10" height="21">&nbsp;</td>
                      </tr>
                      <tr class="inputStyle4">
                        <td colspan="10" height="21"><b><u>Anak</u></b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td class="tableheader" colspan="3" align="center" height="21"><b>Nama</b></td>
                        <td class="tableheader" align="center" height="21"><b>Sex</b></td>
                        <td height="21" colspan="4" align="center" class="tableheader"><b>Tempat/Tgl Lahir</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pendidikan</b></td>
                        <td class="tableheader" align="center" height="21"><b>Pekerjaan</b></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>1</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="child1_name" type="text" value="<?=$child1_name?>"/></td>
                        <td><select size="1" name="child1_sex">
                            <option value="male"<?if($child1_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($child1_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="child1_pob" maxlength="20" type="text" size="10" value="<?=$child1_pob?>"/></td>
                        <td align="left"><select name="child1_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($child1_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="child1_bln" size="1">
                          <option value="1"<?if($child1_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($child1_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($child1_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($child1_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($child1_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($child1_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($child1_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($child1_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($child1_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($child1_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($child1_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($child1_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="child1_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($child1_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="child1_edu" type="text" value="<?=$child1_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="child1_job" type="text" value="<?=$child1_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>2</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="child2_name" type="text" value="<?=$child2_name?>"/></td>
                        <td><select size="1" name="child2_sex">
                            <option value="male"<?if($child2_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($child2_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="child2_pob" maxlength="20" type="text" size="10" value="<?=$child2_pob?>"/></td>
                        <td align="left"><select name="child2_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($child2_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="child2_bln" size="1">
                          <option value="1"<?if($child2_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($child2_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($child2_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($child2_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($child2_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($child2_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($child2_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($child2_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($child2_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($child2_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($child2_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($child2_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="child2_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($child2_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="child2_edu" type="text" value="<?=$child2_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="child2_job" type="text" value="<?=$child2_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>3</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="child3_name" type="text" value="<?=$child3_name?>"/></td>
                        <td><select size="1" name="child3_sex">
                            <option value="male"<?if($child3_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($child3_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="child3_pob" maxlength="20" type="text" size="10" value="<?=$child3_pob?>"/>&nbsp;</td>
                        <td align="left"><select name="child3_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($child3_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="child3_bln" size="1">
                          <option value="1"<?if($child3_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($child3_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($child3_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($child3_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($child3_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($child3_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($child3_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($child3_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($child3_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($child3_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($child3_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($child3_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="child3_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($child3_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="child3_edu" type="text" value="<?=$child3_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="child3_job" type="text" value="<?=$child3_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>4</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="child4_name" type="text" value="<?=$child4_name?>"/></td>
                        <td><select size="1" name="child4_sex">
                            <option value="male"<?if($child4_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($child4_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="child4_pob" maxlength="20" type="text" size="10" value="<?=$child4_pob?>"/></td>
                        <td align="left"><select name="child4_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($child4_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="child4_bln" size="1">
                          <option value="1"<?if($child4_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($child4_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($child4_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($child4_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($child4_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($child4_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($child4_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($child4_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($child4_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($child4_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($child4_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($child4_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="child4_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($child4_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="child4_edu" type="text" value="<?=$child4_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="child4_job" type="text" value="<?=$child4_job?>"/></td>
                      </tr>
                      <tr class="inputStyle4">
                        <td>5</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="child5_name" type="text" value="<?=$child5_name?>"/></td>
                        <td><select size="1" name="child5_sex">
                            <option value="male"<?if($child5_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($child5_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="child5_pob" maxlength="20" type="text" size="10" value="<?=$child5_pob?>"/></td>
                        <td align="left"><select name="child5_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($child5_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td align="left"><select name="child5_bln" size="1">
                          <option value="1"<?if($child5_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($child5_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($child5_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($child5_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($child5_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($child5_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($child5_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($child5_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($child5_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($child5_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($child5_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($child5_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="child5_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <?if($child5_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <?}?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="child5_edu" type="text" value="<?=$child5_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="child5_job" type="text" value="<?=$child5_job?>"/></td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>:</td>
                        <td><input size="30" maxlength="20" name="child6_name" type="text" value="<?=$child6_name?>"/></td>
                        <td><select size="1" name="child6_sex">
                            <option value="male"<?if($child6_sex=="male"){echo " selected";}?>>Male</option>
                            <option value="female"<?if($child6_sex=="female"){echo " selected";}?>>Female</option>
                          </select></td>
                        <td align="left"><input name="child6_pob" maxlength="20" type="text" size="10" value="<?=$child6_pob?>"/></td>
                        <td align="left"><select name="child6_tgl" size="1">
                          <?for($i=1;$i<=31;$i++){?>
                          <option value="<?=$i?>" <?if($child6_tgl==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <? } ?>
                        </select></td>
                        <td align="left"><select name="child6_bln" size="1">
                          <option value="1"<?if($child6_bln==1){echo " selected";}?>>Jan</option>
                          <option value="2"<?if($child6_bln==2){echo " selected";}?>>Feb</option>
                          <option value="3"<?if($child6_bln==3){echo " selected";}?>>Mar</option>
                          <option value="4"<?if($child6_bln==4){echo " selected";}?>>Apr</option>
                          <option value="5"<?if($child6_bln==5){echo " selected";}?>>May</option>
                          <option value="6"<?if($child6_bln==6){echo " selected";}?>>Jun</option>
                          <option value="7"<?if($child6_bln==7){echo " selected";}?>>Jul</option>
                          <option value="8"<?if($child6_bln==8){echo " selected";}?>>Aug</option>
                          <option value="9"<?if($child6_bln==9){echo " selected";}?>>Sep</option>
                          <option value="10"<?if($child6_bln==10){echo " selected";}?>>Oct</option>
                          <option value="11"<?if($child6_bln==11){echo " selected";}?>>Nov</option>
                          <option value="12"<?if($child6_bln==12){echo " selected";}?>>Dec</option>
                        </select></td>
                        <td align="left"><select name="child6_thn" size="1">
                          <?for($i=1900;$i<=2015;$i++){?>
                          <option value="<?=$i?>"  <? if($child6_thn==$i){echo " selected";}?>>
                            <?=$i?>
                          </option>
                          <? } ?>
                        </select></td>
                        <td><input size="30" maxlength="20" name="child6_edu" type="text" value="<?=$child6_edu?>"/></td>
                        <td><input size="30" maxlength="20" name="child6_job" type="text" value="<?=$child6_job?>"/></td>
                      </tr>
                      </table></td>
                    </tr>
				  </table>

			</td>
  </tr>
   <tr>
    <td vAlign="top" colSpan="5">&nbsp;</td>
  </tr>
  <tr>
    <td  class="tableheader" colSpan="5" align="center">
    <? if(listFind($_SESSION["ss_id" . date("mdY")],"13")){?>
    <input type="submit" value="Update Susunan Keluarga">
    <? } ?>
	&nbsp;<input type="Button" value="Cancel" onClick="location='index.php?urlencrypt=<?=md5("mdYHis")?>';"></td>
  </tr>
</table></form></div>
</body>
<script>
function Check() {
     var errmsg='';
	 father_name=document.sample_form.father_name.value;
	 if (father_name.length == 0) errmsg +='Nama ayah Wajib diisi!\n'; 
	 mother_name=document.sample_form.mother_name.value;
	 if (mother_name.length == 0) errmsg +='Nama Ibu Wajib diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>