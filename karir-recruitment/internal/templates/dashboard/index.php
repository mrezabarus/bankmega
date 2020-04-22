<?
	require_once("../../config.php");

	if(isset($_POST["save"])){
		$year_date = postParam("sel_from");
		$selregion = postParam("sel_region");
	}else{
		$year_date = date("Y");
		$selregion = "none";
	}
	$mpp = cmsDB();
	$db1 = cmsDB();
	$db2 = cmsDB();
	$db3 = cmsDB();
	$db4 = cmsDB();
	$db5 = cmsDB();
	$region = cmsDB();
	$mpp->query("select distinct(year_date) as tahun from tbl_region_mpp");
	$region->query("select * from tbl_region order by region_name desc");

	$db1->query("SELECT avail_status, COUNT(*) AS avail FROM tbl_jobseeker GROUP BY avail_status");
	while ($db1->next()){
	$avail[$db1->row("avail_status")] = $db1->row("avail");
	}

	$db2->query("SELECT test_status, COUNT(*) AS test FROM tbl_jobseeker_test GROUP BY test_status");
	while ($db2->next()){
	$test[$db2->row("test_status")] = $db2->row("test");
	}

	$db3->query("SELECT ip_status, COUNT(*) AS ip FROM tbl_ijin_prinsip GROUP BY ip_status");
	while ($db3->next()){
	$ip[$db3->row("ip_status")] = $db3->row("ip");
	}

	$db4->query("SELECT is_approved,COUNT(*) AS ol FROM tbl_offering_letter GROUP BY is_approved");
	while ($db4->next()){
	$ol[$db4->row("is_approved")] = $db4->row("ol");
	}

	$db5->query("SELECT employee_status, COUNT(*) AS vacan FROM tbl_branch_mpp_apply GROUP BY employee_status");
	while ($db5->next()){
	$vacan[$db5->row("employee_status")] = $db5->row("vacan");
	}
?>
<table class="heading2" cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
  <tr>
    <td width="100%" class="tableheader">
        <table cellspacing="0" cellpadding="0" width="100%" border="0">
          <tr>
            <td class="tableheader">&nbsp;<b>Dashboard</b></td>
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
        <td valign="top" bgcolor="#FFFFFF"><form action="" method="post" name="sample_form" id="sample_form">
<table border="0" cellpadding="0">
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><table width="0%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><? if($mpp->recordCount()){?>
      <b><font color="#006699">Year</font></b></td>
    <td><b><font color="#006699">:</font></b></td>
    <td><select size="1" name="sel_from">
      <? while($mpp->next()){?>
      <option value="<?=$mpp->row("tahun")?>" <? if($year_date==$mpp->row("tahun")){echo " selected";}?>>
        <?=$mpp->row("tahun")?>
        </option>
      <? } ?>
    </select></td>
    <td>&nbsp;</td>
    <td><b><font color="#006699">Region</font></b></td>
    <td><b><font color="#006699">:</font></b></td>
    <td><select size="1" name="sel_region">
      <option value="none"<? if($selregion==0){echo " selected";}?>>All Region</option>
      <? while($region->next()){?>
      <option value="<?=$region->row("region_name")?>" <? if($selregion==$region->row("region_name")){echo " selected";}?>>
        <?=$region->row("region_name")?>
        </option>
      <? } ?>
    </select></td>
  </tr>
</table>

	  </td>
    <td align="center"><input type="button" value="View Result" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.sel_from,sample_form.sel_region','save=yes')" />
      <? }else{ ?>
      Data Tidak ada..
  <? } ?>
  <input type="button" value="Cancel" name="B3" onclick="get_method('templates/dashboard/index.php')" /></td>
  </tr>
</table>
</form>
</td>
      </tr>
      
  <tr>
    <td align="center" bgcolor="#FFFFFF"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><fieldset><legend><b>Data Pelamar</b></legend><table width="71%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="45%"><b><font color="green">Available</font></b></td>
    <td width="1%">:</td>
    <td width="15%"><b><?=intval($avail["available"])?></b></td>
    <td width="45%">Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="black">Reserved</font></b></td>
    <td>:</td>
    <td><b><?=intval($avail["reserved"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="brown">Test Process</font></b></td>
    <td>:</td>
    <td><b><?=intval($test["new"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="Blue">Test Lulus</font></b></td>
    <td>:</td>
    <td><b><?=intval($test["passed"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="Red">Test Gagal</font></b></td>
    <td>:</td>
    <td><b><?=intval($test["failed"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="brown">Recruitment Proses</font></b></td>
    <td>:</td>
    <td><b><?=intval($avail["recruitment process"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="orange">Recruitment Lulus</font></b></td>
    <td>:</td>
    <td><b><?=intval($avail["recruitment passed"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="brown">IP Proses</font></b></td>
    <td>:</td>
    <td><b><?=intval($ip["new"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="blue">IP Approve</font></b></td>
    <td>:</td>
    <td><b><?=intval($ip["approved"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="Blue">OL Berhasil</font></b></td>
    <td>:</td>
    <td><b><?=intval($ol["yes"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="magenta">OL Pending</font></b></td>
    <td>:</td>
    <td><b><?=intval($ol["no"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="red">OL Batal/Gagal</font></b></td>
    <td>:</td>
    <td><b><?=intval($ol["deny"])?></b></td>
    <td>Pelamar</td>
  </tr>
  <tr>
    <td><b><font color="Blue">Employee</font></b></td>
    <td>:</td>
    <td><b><?=$avail["employee"]?></b></td>
    <td>Pelamar</td>
  </tr>
</table>
</fieldset></td>
          </tr>
        </table><br /><br />
        <table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><fieldset>
              <legend><b>Data Lowongan</b></legend>
              <table width="82%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="45%"><b>Permanent</b></td>
                  <td width="1%">:</td>
                  <td width="15%"><b>
                    <?=intval($vacan["permanent"])?>
                  </b></td>
                  <td width="45%">Permintaan</td>
                </tr>
                <tr>
                  <td><b>Kontrak</b></td>
                  <td>:</td>
                  <td><b>
                    <?=intval($vacan["contract"])?>
                  </b></td>
                  <td>Permintaan</td>
                </tr>
                <tr>
                  <td><b>OutSource</b></td>
                  <td>:</td>
                  <td><b>
                    <?=intval($vacan["outsource"])?>
                  </b></td>
                  <td>Permintaan</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </fieldset></td>
          </tr>
        </table></td>
        <td valign="top" width="58%"><table width="80%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><fieldset>
              <legend><b>Data Pelamar</b></legend>
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td><iframe src="templates/dashboard/graph.php" align="center" frameborder="0" height="200" scrolling="no" width="100%"></iframe></td>
                  </tr>
              </table>
            </fieldset></td>
          </tr>
        </table><br /><br />
        <table width="80%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><fieldset>
              <legend><b>Data Lowongan</b></legend>
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td><iframe src="templates/dashboard/graph.php" align="center" frameborder="0" height="200" scrolling="No" width="100%"></iframe></td>
                </tr>
              </table>
            </fieldset></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
