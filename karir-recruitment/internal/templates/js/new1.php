<?
	require_once("../../config.php");
	$reference = cmsDB();
	if(isset($_GET["save"])){
		$reference->query("delete from tbl_jobseeker_reference where js_id=".uriParam("js_id"));
		$strsql = "insert into tbl_jobseeker_reference(name,address,phone,title,relation,js_id) values('".postParam("name1")."','".postParam("address1")."','".postParam("phone1")."','".postParam("title1")."','".postParam("relation1")."',".uriParam("js_id").")";
		$reference->query($strsql);
		$strsql = "insert into tbl_jobseeker_reference(name,address,phone,title,relation,js_id) values('".postParam("name2")."','".postParam("address2")."','".postParam("phone2")."','".postParam("title2")."','".postParam("relation2")."',".uriParam("js_id").")";
		$reference->query($strsql);
		$strsql = "insert into tbl_jobseeker_reference(name,address,phone,title,relation,js_id) values('".postParam("name3")."','".postParam("address3")."','".postParam("phone3")."','".postParam("title3")."','".postParam("relation3")."',".uriParam("js_id").")";
		$reference->query($strsql);
		
		echo "<script>alert('Job Seeker Reference Updated!!');location='edit.php?edit=yes&js_id=".uriParam("js_id")."';</script>";
		die();
	}
	$reference->query("select * from tbl_jobseeker_reference where js_id=".uriParam("js_id")." order by jsreference_id asc");
	if($reference->recordCount()){
		$reference->next();
		$name1=$reference->row("name");
		$address1=$reference->row("address");
		$phone1=$reference->row("phone");
		$title1=$reference->row("title");
		$relation1=$reference->row("relation");
		
		$reference->next();
		$name2=$reference->row("name");
		$address2=$reference->row("address");
		$phone2=$reference->row("phone");
		$title2=$reference->row("title");
		$relation2=$reference->row("relation");
		
		$reference->next();
		$name3=$reference->row("name");
		$address3=$reference->row("address");
		$phone3=$reference->row("phone");
		$title3=$reference->row("title");
		$relation3=$reference->row("relation");
	}else{
		//$jsreference_id=0;
		$name1="";
		$address1="";
		$phone1="";
		$title1="";
		$relation1="";
		$name2="";
		$address2="";
		$phone2="";
		$title2="";
		$relation2="";
		$name3="";
		$address3="";
		$phone3="";
		$title3="";
		$relation3="";
	}
?>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<center><body topmargin="0">
<form action="<?=$_SERVER["SCRIPT_NAME"]?>?save=yes&edit=yes&js_id=<?=uriParam("js_id")?>" method="post" name="sample_form" id="sample_form" onSubmit="return Check()">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td  align="left" colSpan="5">
		<table border="0" cellpadding="5" cellspacing="2" width="100%">
			<tr>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('edit.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Personal Data</a></td>
				<td class="tableheader" align="center">Referensi</td>
				<td class="tablebodyodd" align="center"><a href="javascript:get_method('new2.php?edit=yes&js_id=<?=uriParam("js_id")?>')">Susunan Keluarga</a></td>
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
    <td  align="center" colSpan="5" class="tablebodyodd">
	<table border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td colspan="5" align="left" class="headlineNICE"><strong><u>Referensi 1
					      :</u></strong> </td>
				</tr>
				<tr class="inputStyle4">
					<td align="right">Nama</td>
					<td>:</td>
					<td align="left"><input size="30" name="name1" maxlength="20" type="text" value="<?=$name1?>"></td>
					
					<td align="right">Hubungan : </td>
					<td align="left"><input name="relation1" maxlength="20" type="text" value="<?=$relation1?>"></td>
				</tr>
				<tr class="inputStyle4">
					<td align="right">Jabatan</td>
				  <td>:</td>
					<td align="left"><input size="30" name="title1" maxlength="20" type="text" value="<?=$title1?>"></td>
					<td align="right">Tlp No: </td>
					<td align="left"><input name="phone1" maxlength="15" type="text" value="<?=$phone1?>" onKeyPress="return handleEnter(this, event, 4)"></td>
				</tr>
				<tr class="inputStyle4">
					<td align="right" valign="top">Alamat</td>
					<td valign="top">:</td>
					<td colspan="3" align="left"><textarea name="address1" cols="70" rows="3" class="inputStyle5"><?=$address1?></textarea></td>
					</tr>
                    <tr>
                      <td colspan="5" valign="top">&nbsp;</td>
                    </tr>
				
					
					<tr>
					<td colspan="5" align="left" class="headlineNICE"><strong><u>Referensi 2
					      :</u></strong> </td>
					</tr>
				<tr class="inputStyle4">
					<td align="right">Nama</td>
					<td>:</td>
					<td align="left"><input size="30" name="name2" maxlength="20" type="text" value="<?=$name2?>"></td>
					
					<td align="right">Hubungan : </td>
					<td align="left"><input name="relation2" maxlength="20" type="text" value="<?=$relation2?>"></td>
				</tr>
				<tr class="inputStyle4">
					<td align="right">Jabatan</td>
				  <td>:</td>
					<td align="left"><input size="30" name="title2" maxlength="20" type="text" value="<?=$title2?>"></td>
					<td align="right">Tlp No: </td>
					<td align="left"><input name="phone2" maxlength="15" type="text" value="<?=$phone2?>" onKeyPress="return handleEnter(this, event, 4)"></td>
				</tr>
				<tr class="inputStyle4">
					<td align="right" valign="top">Alamat</td>
					<td valign="top">:</td>
					<td colspan="3" align="left"><textarea name="address2" cols="70" rows="3" class="inputStyle5"><?=$address2?></textarea></td>
					</tr>
                    <tr>
                      <td colspan="5" valign="top">&nbsp;</td>
                    </tr>
				
					  <td colspan="5" align="left" class="headlineNICE"><strong><u>Referensi
					          3 :</u></strong> </td>
					</tr>
				<tr class="inputStyle4">
					<td align="right">Nama</td>
					<td>:</td>
					<td align="left"><input size="30" name="name3" maxlength="20" type="text" value="<?=$name3?>"></td>
					
					<td align="right">Hubungan : </td>
					<td align="left"><input name="relation3" maxlength="20" type="text" value="<?=$relation3?>"></td>
				</tr>
				<tr class="inputStyle4">
					<td align="right">Jabatan</td>
				  <td>:</td>
					<td align="left"><input size="30" name="title3" maxlength="20" type="text" value="<?=$title3?>"></td>
					<td align="right">Tlp No: </td>
					<td align="left"><input name="phone3" maxlength="15" type="text" value="<?=$phone3?>" onKeyPress="return handleEnter(this, event, 4)"></td>
				</tr>
				<tr class="inputStyle4">
					<td align="right" valign="top">Alamat</td>
					<td valign="top">:</td>
					<td colspan="3" align="left"><textarea name="address3" cols="70" rows="3" class="inputStyle5"><?=$address3?></textarea></td>
					</tr>
				</table>
</td>
  </tr>

  <tr>
    <td  class="tableheader" colSpan="5" align="center">
    <? if(listFind($_SESSION["ss_id" . date("mdY")],"13")){?>
    <input type="submit" value="Update Referensi">
	<? } ?>
    &nbsp;<input type="Button" value="Cancel" onClick="location='index.php?urlencrypt=<?=md5("mdYHis")?>';"></td>
  </tr>
</table></form>
</div>
</body>
<script>
function Check() {
     var errmsg='';
	 name1=document.sample_form.name1.value;
	 if (name1.length == 0) errmsg +='Nama Wajib diisi!\n'; 
	 relation1=document.sample_form.relation1.value;
	 if (relation1.length == 0) errmsg +='Hubungan Wajib diisi!\n'; 
	 title1=document.sample_form.title1.value;
	 if (title1.length == 0) errmsg +='Jabatan Wajib diisi!\n'; 
	 if ( errmsg.length) {
	      alert(errmsg);
	     return false;
	 } else return true;
}
</script>