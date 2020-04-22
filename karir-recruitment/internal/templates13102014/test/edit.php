<?
	require_once("../../config.php");
	
	if(isset($_POST["save"])){
			//echo ." + save + " . ;die();
			$comp_name=cmsDB();
			$strsql = "update tbl_grouptest set grouptest_name='".postParam("txtname")."',grouptest_desc='".postParam("txtdesc")."',
			                                    min_a=".postParam("txt_a").",min_b=".postParam("txt_b").",min_c=".postParam("txt_c").",
												min_d=".postParam("txt_d").",user_id=".$_SESSION["user_id" . date("mdY")].",
												insert_date='".date("Y-m-d H:i:s")."' where grouptest_id=".postParam("grouptest_id");
			$comp_name->query($strsql);
			$comp_name->query("delete from tbl_test where grouptest_id=".postParam("grouptest_id"));
			$grouptest_id= postParam("grouptest_id");
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
	$test = cmsDB();
	$test->query("select * from tbl_grouptest where grouptest_id=".uriParam("grouptest_id"));
	$test->next();
?>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
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
       <TD class=tableheader>&nbsp;View Group Test</TD>
      </TR>
		</TBODY>
	</TABLE></TD>
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
		  </TABLE>		</TD>
	</TR>
  <tr>
    <td width="35%" align="right">Nama Group Test :</td>
    <td width="65%"><input type="text" name="txtname" size="53" value="<?=$test->row("grouptest_name")?>"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Keterangan :</td>
    <td valign="top"><textarea rows="9" name="txtdesc" cols="61"><?=$test->row("grouptest_desc")?></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">Kualifikasi Nilai Kelulusan :&nbsp;</td>
    <td valign="top">
	A : 
	  <input type="text" name="txt_a" size="5" maxlength="5" value="<?=$test->row("min_a")?>" onKeyPress="return handleEnter(this, event, 4)">
    B : 
	  <input type="text" name="txt_b" size="5" maxlength="5" value="<?=$test->row("min_b")?>" onKeyPress="return handleEnter(this, event, 4)"> 
	C : <input type="text" name="txt_c" size="5" maxlength="5" value="<?=$test->row("min_c")?>" onKeyPress="return handleEnter(this, event, 4)">
    D : <input type="text" name="txt_d" size="5" maxlength="5" value="<?=$test->row("min_d")?>" onKeyPress="return handleEnter(this, event, 4)"></td>
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
		  </TABLE>		</TD>
	</TR>
</table>
  <table border="0" width="80%" bordercolor="#000000" cellspacing="1" cellpadding="2">
 <tr>
    <td width="100%" class="tableheader"><font color="#FFFFFF"><b>Group Test Detail</b></font></td>
  </tr>
  <?
  	$test->query("select * from tbl_test where grouptest_id=".uriParam("grouptest_id")." order by test_id");
	//$count = $test->recordCount;
	
  ?>
  <tr>
    <td width="100%">
      <table border="1" width="100%" bordercolor="#C0C0C0" cellspacing="0" cellpadding="2">
      <tr class="tablebodyodd">
          <td width="5%" align="center">No</td>
          <td width="10%" align="center">Code</td>
          <td width="30%" align="center">Nama Test</td>
		  <td width="30%" align="center">Keterangan</td>
          <!-- td width="25%" align="center">Bobot</td -->
        </tr>
		<?
		$no=0;
		$rec=$test->recordCount();
		
		while($test->next()){
			$no++;
		?>
			<tr>
	          <td align="right" bgcolor="#FFFFFF"><?=$no?>.</td>
	          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_<?=$no?>" size="7" value="<?=$test->row("test_code")?>" onKeyUp="this.value=this.value.toUpperCase()"></td>
	          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_<?=$no?>" size="40" value="<?=$test->row("test_name")?>"></td>
			  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_<?=$no?>" cols="40" rows="4"><?=$test->row("description")?></textarea></td>
	          <!-- td align="center"><input type="text" name="tdbobot_<?=$no?>" size="5" maxlength="5" value="<?=$test->row("bobot")?>" onKeyPress="return handleEnter(this, event, 4)">%</td -->
		<?
			
		}
		$no_loop=5-$no;
		
		if($no_loop>0){
			$no++;
			for($i=1;$i<=$no_loop;$i++){
			?>
	        <tr>
	          <td align="right" bgcolor="#FFFFFF"><?=$no?>.</td>
	          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_<?=$no?>" size="7" onKeyUp="this.value=this.value.toUpperCase()"></td>
	          <td bgcolor="#FFFFFF" align="left"><input type="text" name="tdname_<?=$no?>" size="40"></td>
			  <td bgcolor="#FFFFFF" align="left"><textarea name="tddesc_<?=$no?>" cols="40" rows="4"></textarea></td>
	          <!-- td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_<?=$no?>" size="5" maxlength="5" onKeyPress="return handleEnter(this, event, 4)">
	            %</td -->
	        </tr>
	        <?
			$no++;
			}
		}?>
		
      </table>
    </td>
  </tr> 
   <tr>
    <td width="100%" colspan="2">
      <p align="center">
	  <input type="button" value="Update Group Recruitment Test" style="cursor:hand" name="B3" onClick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.txtname,sample_form.txtdesc,sample_form.txt_a,sample_form.txt_b,sample_form.txt_c,sample_form.txt_d,sample_form.tdcode_1,sample_form.tdname_1,sample_form.tddesc_1,sample_form.tdcode_2,sample_form.tdname_2,sample_form.tddesc_2,sample_form.tdcode_3,sample_form.tdname_3,sample_form.tddesc_3,sample_form.tdcode_4,sample_form.tdname_4,sample_form.tddesc_4,sample_form.tdcode_5,sample_form.tdname_5,sample_form.tddesc_5','save=yes&grouptest_id=<?=uriParam("grouptest_id")?>&refresh=<?=md5("mdYHis")?>')">&nbsp;
	  <?if(listFind($_SESSION["ss_id" . date("mdY")],"25")){?>
	  	&nbsp;<input type="button" value="Delete" style="cursor:hand" onClick="get_method('templates/test/delete.php?grouptest_id=<?=uriParam("grouptest_id")?>')">
	  <?}?>
	  <input type="button" value="Cancel" style="cursor:hand" name="B3" onClick="get_method('templates/test/index.php?refresh=<?=date("mdY His")?>');">
      </p>
    </td>
  </tr>
</table></form>
</center>
</body>                                    