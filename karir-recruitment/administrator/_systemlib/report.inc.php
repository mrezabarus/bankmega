<?
function report($report_id) {
	global $FJR_VARS;
	global $_GET;	
	
	$report = cmsDB();	
	$strSQL = "select * from db_mega.tbl_reportdetail order by report_id asc";
	$mega_db->query($strSQL);
	//$report->next();
	if ($report->recordCount() == 1) {
		$report->next();
		$report_fields = array();
		$report_fields["report_id"] = $report->row("report_id");
		$report_fields["reportdetail_id"] = $report->row("reportdetail_id");
		$report_fields["col_1"] = $report->row("col_1");
		$report_fields["col_2"] = $report->row("col_2");
		$report_fields["insert_date"] = $report->row("insert_date");
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=$report->row("report_id");?></td>
    <td><?=$report->row("col_1");?></td>
    <td><?=$report->row("col_2");?></td>
    <td><?=$report->row("insert_date");?></td>
  </tr>
</table>
<? } ?>