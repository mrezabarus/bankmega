<?php
/*
	$base_path = "c:/xampp183/htdocs/mega/internal/";
	$base_www = "http://localhost/mega/internal";
	$base_url = "/mega/internal/";


	$base_path = "/home/xolut246/public_html/client/mega/internal/";
	$base_www = "http://xolution.net/client/mega/internal";
	$base_url = "/client/mega/internal/";
*/

	$base_path = "C:/Apache2/htdocs/erec/internal/";
	$base_www = "http://localhost/erec/internal/";
	$base_url = "/erec/internal/";
	
	session_start();
	/*
	require_once($base_path."includes/dbmysql.inc.php");
	require_once($base_path."includes/miscfunction.inc.php");
	require_once($base_path."includes/listfunction.inc.php");
	require_once($base_path."includes/defaultvar.inc.php");
	*/
	
	include "includes/dbmysql.inc.php";
	include "includes/miscfunction.inc.php";
	include "includes/listfunction.inc.php";
	include "includes/defaultvar.inc.php";
	
	if(isset($_GET["login"])){
		if($_GET["login"]== md5("yes_".date("mdY"))){
			$login = cmsDB();
			$auth = cmsDB();
			
			//$strsql="select * from tbl_hrm_user_new where user_name='".trim(strtolower($_POST["txtname"]))."' and pwd='".base64_encode(base64_encode(trim($_POST["txtpassword"])))."'"; 
			
			//$strsql="select * from tbl_hrm_user_new where user_name='".trim(strtolower($_POST["txtname"]))."'";
			$strsql="select * from tbl_hrm_user_serper where user_name='".trim(strtolower($_POST["txtname"]))."'";
			//$strsql="select * from tbl_hrm_user where user_name='".trim(strtolower($_POST["txtname"]))."' and pwd='".(trim($_POST["txtpassword"]))."'"; 

			//echo $strsql;die();
			
			$login->query($strsql);
			echo $login->row("user_id");
			
			$username = $_POST["txtname"];
			$password = $_POST["txtpassword"];
			$result = $login->query($strsql);
			
			if($login->recordCount() >= 1){
				
				//check password
				$userData = mysql_fetch_array($result, MYSQL_ASSOC);
				$hash = hash('sha256', $userData['salt'] . $password );
				
				if($hash != $userData['pwd']) //incorrect password
				{
					//Incorrect Password
					echo "<script>alert(\"Incorrect Password !!\");history.back();</script>";
					die();
					
				}
				
				/*tambahan reza*/
				//echo "Ini User Id login";
				echo $login->valueList("user_id");
				/*end tambahan reza*/
				
				//
				if(trim(strtolower($_POST["txtname"]))=='super'){
					$login->next();
					$auth->query("select auth_id from tbl_authorization");
					$lstauth=$auth->valueList("auth_id");
					$auth->query("select branch_id from tbl_branch");
					$lstbranch = $auth->valueList("branch_id");
					$auth->query("select region_id from tbl_region");
					$lstregion = $auth->valueList("region_id");
				}else{
					$login->next();
					$auth->query("select group_id from tbl_group_hrmuser where user_id=".$login->row("user_id"));
					$lstgroup = $auth->valueList("group_id");
					$auth->query("select auth_id from tbl_group_authorization where group_id in (".$lstgroup.")");
					$lstauth=$auth->valueList("auth_id");
					$auth->query("select branch_id from tbl_branch_hrmuser where user_id=".$login->row("user_id"));
					$lstbranch = $auth->valueList("branch_id");
				///////// Update Fajar  ///////////////////////	
					$auth->query("SELECT region_id 
					              FROM tbl_branch 
								  INNER JOIN tbl_branch_hrmuser ON tbl_branch.branch_id = tbl_branch_hrmuser.branch_id
					 			  WHERE user_id=".$login->row("user_id"));
					$lstregion = $auth->valueList("region_id");
				/////////////////////////////////////////////////
				
				}
				if(listLen($lstauth)==0){$lstauth="0";};
				if(listLen($lstbranch)==0){$lstbranch="0";};
				if(listLen($lstregion)==0){$lstregion="0";};
				//echo $lstauth; die();
				//echo $lstregion; die();
				/*
				session_register("ss_id" . date("md Y"));
				session_register("ssbranch_id" . date("md Y"));
				session_register("user_id" .date("mdY"));
				session_register("user_name" . date("mdY"));
				session_register("full_name" . date("mdY"));
				session_register("ssregion_id" . date("md Y"));
				*/

				$_SESSION["ss_id" . date("mdY")] = $lstauth;
				$_SESSION["ssbranch_id" . date("mdY")] = $lstbranch;
				$_SESSION["ssregion_id" . date("mdY")] = $lstregion;
				//$_SESSION["user_id" . date("mdY")] = $login->row("user_id");
				$_SESSION["user_id" . date("mdY")] = $userData["user_id"];
				//$_SESSION["user_name" . date("mdY")] = $login->row("user_name");
				$_SESSION["user_name" . date("mdY")] = $userData["user_name"];
				//$_SESSION["full_name" . date("mdY")] = $login->row("full_name");	
				$_SESSION["full_name" . date("mdY")] = $userData["full_name"];	
				
				//echo $_SESSION["user_id" . date("mdY")]; die();

				echo "<script>location='".$base_www."/?refresh=".md5("mdYHis")."';</script>";
				//header('location: home.php');
				die();
			}else{
				echo "<script>location='index.php?err_msg=yes&refresh=".md5("mdYHis")."';</script>";
				die();
			}
		}else{
			echo "<script>location='index.php?err_msg=yes&refresh=".md5("mdYHis")."';</script>";
			die();
		}
	}
?>
<html>

<head>
<title>Human Capital Information System</title>
<LINK href="<?=$ANOM_VARS["www_css_url"]?>stylesheet.css" type=text/css rel=stylesheet>
<link rel="shortcut icon" href="<?=$ANOM_VARS["www_img_url"]?>fav.ico" >
</head>
<script language="javascript">
//Add alert message when error occur 
//window.onerror = function(msg, err_url, line) {alert('Unkwon Error :) ' + line);}
//Detects browser type 
function makeObject(){
	var x; 
	var browser = navigator.appName; 
	if(browser == "Microsoft Internet Explorer"){
		x = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		x = new XMLHttpRequest();
	}
	return x;
}

//Call function 
var request = makeObject();

//The get method AJAX 
function get_method(addr){
	var data = addr;
	request.open('get', data);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.onreadystatechange = output; 
	request.send('');
}

//The POST method AJAX 
function post_method(addr,field,optional){
			var inputan = new Array();
			var get_var = new Array();
			inputan = field.split(",");
			//alert(inputan.length);
			var pars_param = "";
			for(i=0;i<inputan.length;i++){
				//alert();
				get_var = inputan[i].split(".");
				pars_param = pars_param + get_var[1] + "=" + eval("document."+ inputan[i] + ".value") + "&";
			}
			pars_param = pars_param + optional;
			//alert(pars_param);
			//alert(addr);
			request.open('post', addr);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.onreadystatechange = output; 
			request.send(pars_param);
			
}

function output(){
	if(request.readyState == 1){
		//You can add animated gif while loading // 
		document.getElementById('process').innerHTML = "<img width=30 height=30 src='images/progress1.gif''>";
	}
	if(request.readyState == 4){
		var data = request.responseText;
		document.getElementById('output').innerHTML = data;
		document.getElementById('process').innerHTML = "";
	}
}
function _selsubmit(frm,addr,pars_var){
	addr = addr + '&'+ pars_var +'=' + eval("document."+ frm + ".value");
	get_method(addr);
}
//The difference between POST and GET, POST method support or can transffer large data... 
function preview_ol(){
	PopWindow('templates/ol/previewol.php?selip='+ document.sample_form.selip.value +'&templateol_id='+ document.sample_form.selol.value +'&ol_no=' + document.sample_form.txtno.value,'WindowName', '1024', '768', 'scrollbars=yes,location=no,status=yes')
}

function preview_ol2(ol_id){
	PopWindow('templates/ol/previewol.php?ol_id='+ol_id,'WindowName', '1024', '768', 'scrollbars=yes,location=no,status=yes')
}

function _goto(addr){
	//addr_to = addr + '&page='+ document.frmpage.selpage.options[document.frmpage.selpage.selectedIndex].value;
	var select = document.getElementsByName('selpage')[0];
    //alert(select.options[select.selectedIndex].value);	
	//alert(selpage);
	addr_to = addr + '&page='+ select.options[select.selectedIndex].value;
	//alert(addr_to);
	get_method(addr_to);
}

function popwin(addr){
	PopWindow(addr,'WindowName', '800', '600', 'scrollbars=yes,location=no,status=yes')
}
</script>
<script language="Javascript">
function BlinkTxt() {
if(document.getElementById && document.all){
obj = document.getElementsByTagName("blink");
for (var i=0; i<obj.length; i++)
if (obj[i].style.visibility=="hidden") {
obj[i].style.visibility="visible";
}
else {
obj[i].style.visibility="hidden";
}
setTimeout('BlinkTxt()',750);
}
}
onload=BlinkTxt;
</script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tanya.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>validasi.js"></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>js_button.js" type=text/javascript></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>jswarehouse.js" type=text/javascript></script>
<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>common.js" type=text/javascript></script>
<!--<script language="javascript" src="<?=$ANOM_VARS["www_js_url"]?>tooltip.js"></script>-->
<style>
#process {
	position: fixed;
	position: expression("absolute");
	left: 550px;
	padding: 50px;
	top: expression(eval(document.body.scrollTop)+250);
	top: 350px;
}
</style>
<? if(!isset($_SESSION["user_id". date("mdY")])){?>
<body topmargin="0" leftmargin="0" bgcolor="#FFFFFF" onLoad="frmlogin.txtname.focus()">
<? }else{ ?>
<body topmargin="0" leftmargin="0" bgcolor="#FFFFFF">
<? } ?>
<div id="process"></div>
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
  <tr><td colspan=2 bgcolor="#FFFFFF">
  	<? if(isset($_SESSION["user_id". date("mdY")])){
		
?>
	  <table width="100%" cellpadding="4" cellspacing="1" border="0">
	  	<tr>
		  <td bgcolor="#f09500" width="10%" align="center">
		  		<a href="index.php?refresh=<?=md5("mdYHis")?>" style="text-decoration:none">
					<font face="Arial" color="#FFFFFF"><b>Home</b></font></a></td>
		  <?
		  	$menu = cmsDB();
			$menu->query("select * from tbl_authorization where parent_id=0");
			while($menu->next()){
			if(listFind($_SESSION["ss_id" . date("mdY")],$menu->row("auth_id"))){
		  ?>
		  	<td bgcolor="#f09500" width="10%" align="center">
				<a href="javascript:get_method('templates/<?=$menu->row("file_path")?>')" style="text-decoration:none">
				<font face="Arial" color="#FFFFFF"><b><?=$menu->row("auth_name")?></b></font></a></td>
		  <? }
			}?>
		  <td bgcolor="#f09500" width="10%" align="center">
		  		<a href="logout.php" style="text-decoration:none">
					<font face="Arial" color="#FFFFFF"><b>Logout</b></font></a></td>
		</tr>
	  </table>
	  <? } ?>
  </td></tr>
  
  
</table><BR>
<div id="output">
<? if(!isset($_SESSION["user_id". date("mdY")])){?><center><BR><BR><BR>
		<? if(isset($_GET["err_msg"])){?>
			<font color="#FF0000"><strong>::: Login Invalid - Please Try Again or contact your administrator :::</strong></font>
		<? } ?>
		<table id="Table_01" width="537" height="402" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<img src="images/login_new_01.jpg" width="537" height="83" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/login_new_02.jpg" width="269" height="299" alt=""></td>
		<td width="247" valign=top><BR><BR>
			<form name="frmlogin" action="<?=$_SERVER["SCRIPT_NAME"]?>?login=<?=md5("yes_".date("mdY"))?>" enctype="multipart/form-data" method="post">
		            <table border="0" width="100%" cellspacing="0" cellpadding="2">
		              <tr>
		                <td colspan="3" align=center><b>Login Form</b></td>
		              </tr>
					  <tr>
		                <td colspan="3" align=center>&nbsp;</td>
		              </tr>
		              <tr>
		                <td><b>User Name</b></td>
		                <td><b>:</b></td>
		                <td><input type="text" name="txtname" size="18" maxlength="18"></td>
		              </tr>
		              <tr>
		                <td><b>Password</b></td>
		                <td><b>:</b></td>
		                <td><input type="password" name="txtpassword" size="18" maxlength="18"></td>
		              </tr>
		              <tr>
		                <td>&nbsp;</td>
		                <td>&nbsp;</td>
		                <td><input type="submit" value="Login" style="cursor:hand" name="B1"></td>
		              </tr>
		            </table>
				</form>
		</td>
		<td>
			<img src="images/login_new_04.jpg" width="21" height="299" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/login_new_05.jpg" width="269" height="20" alt=""></td>
		<td colspan="2">
			<img src="images/login_new_06.jpg" width="268" height="20" alt=""></td>
	</tr>
</table>
		</center>
		<br /><br />
<? }else{ ?>
	<p align="center">
	<?
	/*echo $_SESSION["ss_id" . date("mdY")];*/
	
	$ip_temp=cmsDB();
	$lstmar="";
	if(listFind($_SESSION["ss_id" . date("mdY")],31)){
		$ip_temp->query("select * from tbl_ijin_prinsip where ip_status='new'");
		$ip_count = $ip_temp->recordCount();
		if($ip_temp->recordCount()){
			$lstmar = $lstmar . "<a href=\"javascript:get_method('templates/ip/index.php')\"><b><font face=\"Arial\" size=\"3\" color=\"red\">".$ip_temp->recordCount()." Ijin Prinsip Baru Belum Anda Approved</font></b></a> ";
		}
	}
	if(listFind($_SESSION["ss_id" . date("mdY")],39)){
		$ip_temp->query("select * from tbl_branch_mpp_apply where request_status='new'");
		$ip_count = $ip_temp->recordCount();
		if($ip_temp->recordCount()){
			$lstmar = $lstmar . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:get_method('templates/vacancy/index.php')\"><b><font face=\"Arial\" size=\"3\" color=\"red\">" . $ip_temp->recordCount()." Vacancy Baru Belum Anda Approved</font></b></a> ";
		}
	}
	if(strlen($lstmar)){echo "<marquee>".$lstmar."</marquee><P>";}?>
    <b><font face="Arial" size="4"><font color="#0080C0"><img border="0" src="<?=$ANOM_VARS["www_img_url"]?>logo_erecruitment.gif" style="float: left" width="300" height="300"></font><font color="#000000">MEGA </font><font face="Arial" color="#0080C0">
	Human Capital </font><font face="Arial" color="#000000"> Information System</font></font></b>
	<p><font size="2" face="Arial">System Informasi <b><font color="#000000"> MEGA</font><font color="#0080C0"> Human Capital</font></b> adalah System
	Aplikasi berbasis Web yang digunakan oleh bagian Rekruitmen PT Bank Mega, Tbk.<span style="mso-fareast-font-family: Times New Roman; mso-bidi-font-family: Times New Roman; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA"> yang
	terintegrasi antar tiap-tiap region/cabangnya, sehingga diharapkan akan terdapat
	sebuah database terintegrasi yang berisi calon-calon candidat tenaga kerja sehingga
	memudahkan proses pencarian calon-calon candidat tenaga kerja yang dibutuhkan oleh Bank
	Mega baik di Cabang, Region maupun Pusat.</span></font></p>
	<p><span style="mso-fareast-font-family: Times New Roman; mso-bidi-font-family: Times New Roman; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA"><font size="2" face="Arial"><u><b>Tujuan
	dari System ini adalah</b></u> :
	<br>
	1. Integrasi system  di Internal Bank Mega maupun
	public Area (Web Recruitment) sehingga aliran informasi lebih terkoordinasi. <br>
	2. Pemrosesan Data dari System Front End
	(Portal Website Human Capital) menjadi report yang diperlukan oleh Bagian Recruitment baik di region/cabang maupun di Pusat
	
	
	</font></span><span style="font-family:&quot;Arial Narrow&quot;;
	mso-ansi-language:FR;font-weight:normal" lang="FR">
	<o:p>
	</o:p>
	.	</span></p>
  <p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;
<? } ?>
</div>
<hr color="#0080C0" size="1" align="center">
<center>
<font color="#000000"><font size="-2" face="Arial">Copyright@2008 - PT Bank Mega, Tbk</font>
<br>
<font face="Arial" size="1">Development by </font></font><font face="Arial" size="1"><b><font color="#0000FF" face="Arial"><b>Xolution.NET System Integrator</b></font>
<font color="#000000" face="Arial"> Software & Multimedia</font></b></font>
</center>
</body>
</html>
<script>
function GetId() {
	 ip_no=document.sample_form.ip_no.value;
	 if (ip_no.length){
		LoadCheckDATA ("iLoader", "checkdata.php", "ip_no="+ip_no);
	 }
}

function GetId2() {
	 ol_no=document.sample_form.ol_no.value;
	 if (ol_no.length){
		LoadCheckDATA ("iLoader", "checkdata.php", "ol_no="+ol_no);
	 }
}
</script>
