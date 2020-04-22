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
					$strsql = "insert into tbl_test(test_code,test_name,description,bobot,grouptest_id) values('".$_POST["tdcode_".$i]."','".$_POST["tdname_".$i]."','".$_POST["tddesc_".$i]."',".$_POST["tdbobot_".$i].",".$grouptest_id.")";
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

<body onLoad="document.sample_form.txtname.focus()">
<br><center>
<form action="" method="post" name="sample_form" id="sample_form">
<TABLE class=heading2 cellSpacing=1 cellPadding=2 width="80%" align=center border=0>
<TBODY>
<TR>
  <TD class=tableheader colspan="3">
    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
      <TBODY>
      <TR>
       <TD class=tableheader>&nbsp;View Group Test</TD>
      </TR>
		</TBODY>
	</TABLE></TD>
	  </TR>
                     <TR>
                       <TD colspan="3">
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
    <td width="34%" align="right">Nama Group Test</td>
    <td width="1%"><b>:</b></td>
    <td width="65%"><?=$test->row("grouptest_name")?></td>
  </tr>
  <tr>
    <td align="right" valign="top">Keterangan</td>
    <td valign="top"><b>:</b></td>
    <td valign="top"><?=$test->row("grouptest_desc")?></td>
  </tr>
  <tr>
    <td align="right" valign="top">Kualifikasi Nilai Kelulusan</td>
    <td valign="top"><b>:</b></td>
    <td valign="top">
	A : <?=$test->row("min_a")?>
    B : <?=$test->row("min_b")?>
	C : <?=$test->row("min_c")?>
    D : <?=$test->row("min_d")?>	</td>
  </tr>
   <TR>
                       <TD colspan="3">
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
          <td width="5%" align="center"><b>No</b></td>
          <td width="10%" align="center"><b>Code</b></td>
          <td width="30%" align="center"><b>Nama Test</b></td>
		  <td width="30%" align="center"><strong>Keterangan</strong></td>
          <!-- td width="25%" align="center"><strong>Bobot</strong></td -->
        </tr>
		<?
		$no=1;
		while($test->next()){?>
			<tr>
	          <td align="center" bgcolor="#FFFFFF"><?=$no?>.</td>
	          <td bgcolor="#FFFFFF" align="center"><?=$test->row("test_code")?></td>
	          <td bgcolor="#FFFFFF" align="left"><?=$test->row("test_name")?></td>
			  <td bgcolor="#FFFFFF" align="left">
			  <?
			  if(strlen($test->row("description"))==0){
			  		echo "<center>-</center>";
				}else{
					echo $test->row("description");
				}?></td>
	          <!-- td align="center" bgcolor="#FFFFFF"><?=$test->row("bobot")?> %</td -->
		<?
			$no++;
		}?>
        <!--- <tr>
          <td align="right" bgcolor="#FFFFFF">1.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_1" size="7"></td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdname_1" size="40"></td>
		  <td bgcolor="#FFFFFF" align="center"><textarea name="tddesc_1" cols="40" rows="4"></textarea></td>
          <td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_1" size="15">
            %</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">2.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_2" size="7"></td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdname_2" size="40"></td>
		  <td bgcolor="#FFFFFF" align="center"><textarea name="tddesc_2" cols="40" rows="4"></textarea></td>
          <td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_2" size="15">
            %</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">3.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_3" size="7"></td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdname_3" size="40"></td>
		  <td bgcolor="#FFFFFF" align="center"><textarea name="tddesc_3" cols="40" rows="4"></textarea></td>
          <td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_3" size="15">
            %</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">4.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_4" size="7"></td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdname_4" size="40"></td>
		  <td bgcolor="#FFFFFF" align="center"><textarea name="tddesc_4" cols="40" rows="4"></textarea></td>
          <td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_4" size="15">
            %</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">5.</td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdcode_5" size="7"></td>
          <td bgcolor="#FFFFFF" align="center"><input type="text" name="tdname_5" size="40"></td>
		  <td bgcolor="#FFFFFF" align="center"><textarea name="tddesc_5" cols="40" rows="4"></textarea></td>
          <td align="center" bgcolor="#FFFFFF"><input type="text" name="tdbobot_5" size="15">
            %</td>
        </tr> --->
		
      </table>
    </td>
  </tr> 
   <tr>
    <td width="100%" colspan="2">
      <p align="center">
	  <?if(listFind($_SESSION["ss_id" . date("mdY")],"23")){?>
	  <input type="button" value="Edit Group Recruitment Test" style="cursor:hand" name="B3" onClick="get_method('templates/test/edit.php?grouptest_id=<?=uriParam("grouptest_id")?>&refresh=<?=date("mdY His")?>')">&nbsp;
	  <?}?>
	  <input type="button" value="Cancel" style="cursor:hand" name="B3" onClick="get_method('templates/test/index.php?refresh=<?=date("mdY His")?>');">
      </p>
    </td>
  </tr>
</table></form>
</center>
</body>                                    