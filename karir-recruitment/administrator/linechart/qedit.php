<?
	require_once("../config.inc.php");
	
	$strsql = "update tbl_chart set chart_name='".trim(postParam("txtname",""))."',chart_desc='".trim(postParam("txtdesc",""))."',x_title='".trim(postParam("txtxname",""))."',y_title='".trim(postParam("txtyname",""))."',panjang='".trim(postParam("txtpanjang",""))."',lebar='".trim(postParam("txtlebar",""))."',type=".$_POST["selchart"] . ",";
	if($_POST["chkreport"]==1){
		$strsql .= "report_id=". $_POST["selreport"];
	}else{
		$strsql .= "report_id=". $_POST["txtreport"];
	}
	$strsql .= " where chart_id=" . $_GET["chart_id"];
	$mega_db->query($strsql);
	$message = "Chart Updated succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>