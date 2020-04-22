<?
	require_once("../../config.php");
	
	if(isset($_POST["save"])){
			//echo ." + save + " . ;die();
			$comp_name=cmsDB();
			$strsql = "insert into tbl_grouptest(grouptest_name,grouptest_desc,min_a,min_b,min_c,min_d,user_id,insert_date) values('".postParam("txtname")."','".postParam("txtdesc")."',".postParam("txt_a").",".postParam("txt_b").",".postParam("txt_c").",".postParam("txt_d").",".$_SESSION["user_id" . date("mdY")].",'".date("Y-m-d H:i:s")."')";
			$comp_name->query($strsql);
			$grouptest_id= $comp_name->lastInsertID();
			for($i=1;$i<=5;$i++){
				if(strlen(trim($_POST["tdcode_".$i]))){
					$strsql = "insert into tbl_test(test_code,test_name,description,grouptest_id) values('".$_POST["tdcode_".$i]."','".$_POST["tdname_".$i]."','".$_POST["tddesc_".$i]."',".$grouptest_id.")";
					$comp_name->query($strsql);
				}
			}
			
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
?>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<body onLoad="document.sample_form.txtname.focus()">
<br><center>
<form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing="1" cellPadding="2" width="80%" align=center border=0>
<TBODY>
<TR>
  <TD class=tableheader colspan="2">
    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
      <TBODY>
      <TR>
       <TD class=tableheader>&nbsp;New Group Test</TD>
      </TR>
		</TBODY>
	</TABLE>
</TD>
	  </TR>
                     <TR>
                       <TD colspan="2">
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           <TBODY>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR>
			</TBODY>
		  </TABLE>
		</TD>
	</TR>
  <tr>
    <td width="35%" align="right">Nama Group Test :</td>
    <td width="65%"><input type="text" name="txtname" size="53"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Keterangan :</td>
    <td valign="top"><textarea rows="9" name="txtdesc" cols="61"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">Kualifikasi Nilai Kelulusan :&nbsp;</td>
    <td valign="top">
	A : <input type="text" name="txt_a" size="5" maxlength="5" value="80" onKeyPress="return handleEnter(this, event, 4)">
    B : <input type="text" name="txt_b" size="5" maxlength="5" value="70" onKeyPress="return handleEnter(this, event, 4)"> 
	C : <input type="text" name="txt_c" size="5" maxlength="5" value="60" onKeyPress="return handleEnter(this, event, 4)">
    D : <input type="text" name="txt_d" size="5" maxlength="5" value="40" onKeyPress="return handleEnter(this, event, 4)">
	</td>
  </tr>
   <TR>
                       <TD colspan="2">
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           <TBODY>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR>
			</TBODY>
		  </TABLE>
		</TD>
	</TR>

</table>
  <table border="0" width="80%" bordercolor="#000000" cellspacing="0" cellpadding="2">
 <tr>
    <td width="100%" class="tableheader"><font color="#FFFFFF"><b>Group Test Detail</b></font></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="1" width="100%" bordercolor="#C0C0C0" cellspacing="0" cellpadding="2">
      <tr class="tablebodyodd">
          <td width="4%" align="center"><b>No</b></td>
          <td width="9%" align="center"><b>Code</b></td>
          <td width="32%" align="center"><b>Nama Test</b></td>
		  <td width="38%" align="center"><strong>Keterangan</strong></td>
          <!-- td width="17%" align="center"><strong>Bobot</strong></td -->
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">1.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_1" size="7" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_1" size="40"></td>
		  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_1" cols="40" rows="4"></textarea></td>
          <!-- td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_1" size="5" maxlength="5" onKeyPress="return handleEnter(this, event, 4)">
            %</td -->
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">2.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_2" size="7" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_2" size="40"></td>
		  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_2" cols="40" rows="4"></textarea></td>
          <!-- td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_2" size="5" maxlength="5" onKeyPress="return handleEnter(this, event, 4)">
            %</td -->
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">3.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_3" size="7" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_3" size="40"></td>
		  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_3" cols="40" rows="4"></textarea></td>
          <!-- td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_3" size="5" maxlength="5" onKeyPress="return handleEnter(this, event, 4)">
            %</td -->
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">4.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_4" size="7" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_4" size="40"></td>
		  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_4" cols="40" rows="4"></textarea></td>
          <!-- td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_4" size="5" maxlength="5" onKeyPress="return handleEnter(this, event, 4)">
            %</td -->
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">5.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_5" size="7" onKeyUp="this.value=this.value.toUpperCase()"></td>
          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_5" size="40"></td>
		  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_5" cols="40" rows="4"></textarea></td>
          <!-- td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_5" size="5" maxlength="5" onKeyPress="return handleEnter(this, event, 4)">
            %</td -->
        </tr>
		
      </table>
    </td>
  </tr> 
   <tr>
    <td width="100%" colspan="2">
      <p align="center">
	  <input type="button" value="Save Group Recruitment Test" style="cursor:hand" name="B3" onClick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtname,sample_form.txtdesc,sample_form.txt_a,sample_form.txt_b,sample_form.txt_c,sample_form.txt_d,sample_form.tdcode_1,sample_form.tdname_1,sample_form.tddesc_1,sample_form.tdcode_2,sample_form.tdname_2,sample_form.tddesc_2,sample_form.tdcode_3,sample_form.tdname_3,sample_form.tddesc_3,sample_form.tdcode_4,sample_form.tdname_4,sample_form.tddesc_4,sample_form.tdcode_5,sample_form.tdname_5,sample_form.tddesc_5','save=yes&refresh=<?=md5("mdYHis")?>')">&nbsp;
	  <input type="button" value="Cancel" style="cursor:hand" name="B3" onClick="get_method('templates/test/index.php?refresh=<?=date("mdY His")?>');">
      </p>
    </td>
  </tr>
</table></form>
</center>
</body>                                    