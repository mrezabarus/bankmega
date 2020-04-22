<?
	session_start();
	require_once("config.inc.php");
	
	$qeditiondefault = cmsDB();
	$admin = cmsDB();
	$strSQL = "select edition_id from tbl_editiondefault where default_site=1";
	$qeditiondefault->query($strSQL);
	$qeditiondefault->next();
	
	if(isset($_GET["edition_id"])){
		$edition_id= $_GET["edition_id"];
	}elseif (isset($_POST["seledition"])){
		$edition_id=$_POST["seledition"];
		echo "<script>parent.location='index.php?refresh=".urlencode(date("m/d/Y"))."';</script>";
		die();
	}
	//$admin->query("select username from tadmin where admin_id=".$_COOKIE[$FJR_VARS["admin_cookie"]]);
	$admin->query("select username from tadmin_new where admin_id=".$_SESSION[$FJR_VARS["admin_cookie"]]);
	$admin->next();
	
?>
<html>
<head>
<title>Administrator Area</title>
</head>
<body>
<center>
<table border="1" width="100%" cellspacing="0" cellpadding="2">
  <tr>
	<td colspan="6" background="images/depan.jpg"><b><font color="#FFFFFF">:: Administrator Area</font></b></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#FFFFFF">&nbsp;
      <p align="center"><font size="4"><b>Welcome: <?=$admin->row("username")?> </b></font></p>
      <p></td>
  </tr>
</table>
</center>
</body>
</html>
