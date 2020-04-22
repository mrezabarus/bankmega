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
<title><?=$FJR_VARS["admin_title"]?> -  Guestbook Management</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<? 
require_once("../config.inc.php");
  
	$mega_db2 = cmsDB();
  
	$Sql = "select * from tfeedback";
  $mega_db->query($Sql);
?>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="6" background="../images/depan.jpg"><b><font color="#FFFFFF">Feedback Module</font></b></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
	         <tr>
          <td><b>No.</b></td>
          <td><b>Group Title</b></td>
		  <td><b>Description</b></td>
       </tr>
	   <tr>
       <td colspan="3" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
       </td>
       </tr>
		<?
				$i = 1;
			  while ($mega_db->next()) { 
	 	  ?>
        <tr>
			
          <td><b><? echo $i;?>.</b></td>
          <td ><a href="edit.php?fb_id=<?=$mega_db->row("fb_id")?>&URLEncrypt=<?=urlencode(date('m/d/y,h:m:s'))?>"><?=$mega_db->row("fb_name")?></a></td>
          <td><?=$mega_db->row("fb_desc")?></td>
        </tr>
		 <?
		  $i = $i+1;
		  }
		  ?>   
		   <tr>
           <td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
           </td>
           </tr>
        <tr>
          <td colspan="4"  align="left">
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