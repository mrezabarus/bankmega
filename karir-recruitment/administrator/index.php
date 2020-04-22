<?
	session_start();
	require_once("config.inc.php");
	
	//echo "admin cookie = " . getAdminCookie();
	//die();
	
	$mega_db->query("SELECT username FROM tadmin_new WHERE admin_id =".getAdminCookie());
	$mega_db->next();
	if (uriParam("ref","") != "") 
		$main_url = uriParam("ref","");
	else
		$main_url = "main.php?seed=".md5(date('m/d/y,h:m:s'));
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../administrator/css/admin.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/fav.ico" >
<title>:: Administrator Area</title>
</head>
<body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bgcolor="#FFFFFF">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
   <tr>
    <td  colspan=2 width="100%">
		<table id="Table_01" width="100%" height="120" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="0">
					<img src="images/header_bar_01.jpg" width="587" height="120" alt=""></td>
				<td background="images/header_bar_02.jpg" width="100%">&nbsp;</td>
				<td width=0>
					<img src="images/header_bar_03.jpg" width="313" height="120" alt=""></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
  <td width="20%">
	<iframe frameborder="0" width="100%" height="520" scrolling="auto" name="nav" target="main" src="nav.php?&seed=<?=md5(date('m/d/y,h:m:s'))?>"></iframe>
  </td>
  <td width="80%">
	<iframe frameborder="0" name="main" width="100%" height="520" src="<?=htmlentities($main_url)?>" scrolling="auto"></iframe></td>
  </td>
  </tr>
   <tr>
    <td  colspan=2 width="100%">
		<center>
<font color="#000000"><font size="-2" face="Arial">Copyright@2008 - PT Bank Mega, Tbk</font>
<br>
<font face="Arial" size="1">Development by </font></font><font face="Arial" size="1"><b><font color="#0000FF" face="Arial"><b>Xolution.NET System Integrator</b></font>
<font color="#000000" face="Arial"> Software & Multimedia</font></b></font>
</center>
	</td>
  </tr>
 </table>



</body>
</html>