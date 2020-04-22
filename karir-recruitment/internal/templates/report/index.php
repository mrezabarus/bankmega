<?
	require_once("../../config.php");
?>
<table class="heading2" cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
  <tr>
    <td width="100%" class="tableheader"><!--- HEADER --->
        <table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tr>
            <td class="tableheader">&nbsp;<b>Report Module</b></td>
            <td align="right"><table width="0">
                <tr>
                  <td><img src="<?=$ANOM_VARS["www_img_url"]?>blank.gif" style="border:none" /></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellspacing="0" cellpadding="0" width="100%" border="0">
      <tr>
        <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" width="100%" /></td>
      </tr>
      <tr>
        <td style="HEIGHT: 1px"><img height="1" src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" width="100%" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>mpp-report.jpg" style="border:none" onclick="get_method('templates/report/report_mpp.php')" /></td>
        <td><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>js-report.jpg" style="border:none" onclick="get_method('templates/report/report_js.php')" /></td>
        <td><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>ip-report.jpg" style="border:none" onclick="get_method('templates/report/report_ip.php')" /></td>
      </tr>
      <tr>
        <td><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>vacan-report.jpg" style="border:none" onclick="get_method('templates/report/report_vacancy.php')" /></td>
        <td><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>rectest-report.jpg" style="border:none" onclick="get_method('templates/report/report_recruitment.php')" /></td>
        <td><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>ol-report.jpg" style="border:none" onclick="get_method('templates/report/report_ol.php')" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><input type="image" src="<?=$ANOM_VARS["www_img_url"]?>report-employee.jpg" style="border:none" onclick="get_method('templates/report/report_employee.php')" /></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
