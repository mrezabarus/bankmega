<? 
	require_once("../config.inc.php");
	
	$strSQL = "SELECT template_id,template_type,template_group,custom_charset,
	                  ttemplate.language_id,isindex,ttemplate.display_name as tempDName,
					  tlanguage.display_name as langDName
			   FROM ttemplate 
			   LEFT JOIN tlanguage ON ttemplate.language_id = tlanguage.language_id 
			   ORDER BY template_group, template_id";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Polling Management</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<?php	 
require_once("../config.inc.php");
  
	$mega_db2 = cmsDB();
  
	$Sql = "select * from tbl_polling";
  $mega_db->query($Sql);
?>
<script>
function _pollchild(id){
		var windowW=500;
		var windowH=400;

		s = "scrollbars=yes"+",width="+windowW+",height="+windowH;
		blwindow = window.open("pollanswer.php?poll_id="+id,"Popup",s);
}
</script>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="6" background="../images/depan.jpg"><b><font color="#FFFFFF">Polling Module</font></b></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
	         <tr>
          <td><b>No.</b></td>
		  <td><b>Polling ID</b></td>
          <td><b>Polling Title</b></td>
		  <td><b>Polling Answer</b></td>
       </tr>
	   <tr>
       <td colspan="6" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
       </td>
       </tr>
		<?php
				$i = 1;
			  while ($mega_db->next()) { 
	 	  ?>
        <tr>
		 <td  align="left"><b><?=$i?>.</b></td>
		 <td  align="center"><b><?=$mega_db->row("Polling_ID")?></b></td>
		 <td ><a href="edit.php?poll_id=<?=$mega_db->row("Polling_ID")?>&URLEncrypt=<?=urlencode(date('m/d/y,h:m:s'))?>"><?=$mega_db->row("Polling_Title")?></a></td>
		  <?
           $Sql_answer = "select * from tbl_polling_answer where Polling_ID = " . $mega_db->row("Polling_ID");
             
           $mega_db2->query($Sql_answer);
           $num_rows_answer = $mega_db2->recordCount();
          ?>
		 <td  align="center"><a href="javascript:_pollchild(<?=$mega_db->row("Polling_ID");?>);"><?=$num_rows_answer?> Answer(s)</a></td>
        </tr>
		 <?php
		  $i = $i+1;
		  }
		  ?>   
		   <tr>
           <td colspan="6" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
           </td>
           </tr>
		  
        <tr>
          <td colspan="5"  align="left">
		  <input class="button" type="button" name="btnadd" value="New" onClick="location='new.php';">
		  <input class="button" type="button" name="btnback" value="Back" onClick="location='../main.php';">
		  &nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>