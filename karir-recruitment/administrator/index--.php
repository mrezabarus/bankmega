<?
	require_once("config.inc.php");
	
	$mega_db->query("SELECT username FROM db_mega.tadmin WHERE admin_id =".getAdminCookie());
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
<body background="images/01.jpg" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table height="100%" width="100%" border=0 align="center" cellpadding=0 cellspacing=0>
  <tr>
    <td rowspan="19" background="images/01.jpg">&nbsp;</td>
    <td colspan="8" background="images/02.jpg">&nbsp;</td>
    <td rowspan="19" background="images/03.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="images/04.jpg" height=102 /></td>
    <td><img src="images/05.jpg" height=102 /></td>
    <td><img src="images/06.jpg" height=102 /></td>
    <td><img src="images/07.jpg" height=102 /></td>
    <td><img src="images/07.jpg" height=102 /></td>
    <td><img src="images/08.jpg" height=102 /></td>
    <td><img src="images/09.jpg" height=102 /></td>
    <td><img src="images/10.jpg" height=102 /></td>
  </tr>
  <tr>
    <td colspan="5"><img src="images/11.jpg" height=26></td>
    <td colspan="3"><img src="images/12.jpg" height=26></td>
  </tr>
  <tr>
    <td colspan="5"><img src="images/13.jpg"height=11></td>
    <td colspan="3"><img src="images/14.jpg"height=11></td>
  </tr>
  <tr>
    <td colspan="8">
	<table bgcolor="#FFFFFF" border="0" width="100%" align="center" cellpadding=0 cellspacing=0>
      <tr>
        <td rowspan="4" background="images/15.jpg" width="16" height="100%" valign="top"></td>
        <td colspan="4"><img src="images/16.jpg"></td>
        <td colspan="2"><img src="images/17.jpg"></td>
        <td rowspan="4" background="images/18.jpg" width="19" height="100%" valign="top"></td>
      </tr>
      <tr>
        <td rowspan="3" align="center" valign="top"><iframe frameborder="0" width="233" height="764" scrolling="no" name="nav" target="main" src="nav.php?&seed=<?=md5(date('m/d/y,h:m:s'))?>"></iframe></td>
        <td rowspan="3" background="images/20.jpg" width="14" height="100%" valign="top"></td>
        <td rowspan="3" background="images/21.jpg" width="14" height="100%" valign="top"></td>
        <td><img src="images/22.jpg" height="14"></td>
        <td><img src="images/23.jpg" height="14"></td>
        <td rowspan="3" background="images/24.jpg" width="15" height="100%" valign="top"></td>
        </tr>
      <tr>
        <td colspan="2" valign="top"><img src="images/28.jpg"></td>
        </tr>
      <tr>
        <td colspan="2" valign="top" bgcolor="#FFFFFF">
		<table width="100%" border="0" cellpadding=0 cellspacing=0>
          <tr class="inputStyle4">
            <td align="center" height="886" valign="top"><iframe frameborder="0" name="main" width="100%" height="880" src="<?=htmlentities($main_url)?>" scrolling="auto"></iframe></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="8"><img src="images/32.jpg"><img src="images/33.jpg"></td>
  </tr>
  <tr>
    <td colspan="8"><img src="images/34.jpg"></td>
  </tr>
  <tr>
    <td colspan="8"><img src="images/35.jpg" width=895 height=47></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
</table>
</body>
</html>