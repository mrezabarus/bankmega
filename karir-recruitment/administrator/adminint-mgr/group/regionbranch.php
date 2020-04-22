<?
	require_once("../../config.inc.php");
	$mega_db = cmsDB2();
	$mega_db->query("SELECT * FROM tbl_region");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title></head>
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<body>
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="4" background="../../images/depan.jpg"><b><font color="#FFFFFF">Region & Branch Group</font></b></td>
  </tr>
	<tr>
		<td colspan="4">
                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td width="20" align="left"><b>No.</b></td>
		<td><strong>Region Name </strong></td>
		<td><strong>Branch</strong></td>
	</tr>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<? if($mega_db->recordCount() == 0){ ?>
	<tr>
		<td colspan="4" align="center">No Member Available...</td>
	</tr>
	<? }else{ ?>
	<form>
		<?
		$branch=cmsDB2();
		while($mega_db->next()){?>
			<tr valign="top">
				<td align="left"><?=$mega_db->currentRow();?>.</td>
				<td><?=$mega_db->row("region_name");?></td>
			  <td>
			  <?
			  $branch->query("select * from tbl_branch where region_id=".$mega_db->row("region_id"));
			  if($branch->recordCount()){
			  	while($branch->next()){
					echo "<a href='regionbranch_edit.php?branch_id=".$branch->row("branch_id")."'>- " . $branch->row("branch_name")."</a><br>";
				}
			  }else{
			  	echo "<em>No Branch Found in this region!</em>";
			  }
			  ?></td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	</form>
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>		</td>
	</tr>
</table>
</body>
</html>