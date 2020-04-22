<? 
	require_once("../config.inc.php");
	
	$strSQL = "SELECT * from taddonmodule where addon_status = 1";
	$mega_db->query($strSQL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Polling Management</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="6" background="../images/depan.jpg"><b><font color="#FFFFFF">Addon Module</font></b></td>
	</tr>
  <tr>
    <td width="100%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
          <td width="20"><b>No.</b></td>
          <td><b>Addon Name</b></td>
		  <td><b>Addon Description</b></td>
		  <td><b>Status</b></td>
       </tr>
	   <tr>
       <td colspan="4" >
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
	      <td  align="left"><font face="Arial" size="2"><b><? echo $i;?>.</b></font></td>
          <td ><a href="edit.php?addon_id=<?=$mega_db->row("addon_id")?>&URLEncrypt=<?=urlencode(date('m/d/y,h:m:s'))?>"> <font face="Arial" size="2"><?=$mega_db->row("addon_name")?></font></a></td>
		  <td ><font face="Arial" size="2"><?=$mega_db->row("addon_desc")?></font></td>
		  <td >
		  <?
		  		if($mega_db->row("addon_status") == 1):
					echo "<font face='Arial' size='2' color='Blue'>Active</font>";
				else:
					echo "<font face='Arial' size='2' color='Red'>Disabled</font>";
				endif;
		 ?>
		 </td>
        </tr>
		 <?
		  		$i = $i+1;
		  	}
		  ?>   
		   <tr>
           <td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
           </td>
           </tr>
        <tr>
          <td colspan="4"  align="left">
		  <input type="button" name="btnadd" value="New" class="button" onClick="location='new.php';">
		  <input type="button" name="btnback" value="Back" class="button" onClick="location='../main.php';">
		  &nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
