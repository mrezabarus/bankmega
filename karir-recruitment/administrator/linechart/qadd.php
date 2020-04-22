<?
	require_once("../config.inc.php");
	
	$strsql = "insert into tbl_chart(chart_name,chart_desc,x_title,y_title,panjang,lebar,type,report_id) values('".trim(postParam("txtname",""))."','".trim(postParam("txtdesc",""))."','".trim(postParam("txtxname",""))."','".trim(postParam("txtyname",""))."','".trim(postParam("txtpanjang",""))."','".trim(postParam("txtlebar",""))."',".$_POST["selchart"].",";
	if($_POST["chkreport"]==1){
		$strsql .= $_POST["selreport"];
	}else{
		$strsql .= $_POST["txtreport"];
	}
	$strsql .= ")";
	$mega_db->query($strsql);
	$message = "Chart added succesfully!";
	
	jsAlertAndNavigate($message,"index.php?seed=".mktime(),true);
?>