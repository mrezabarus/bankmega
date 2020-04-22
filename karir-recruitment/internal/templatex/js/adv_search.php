<? if(isset($_GET["adv_query"])){
	$strsql = "select * from tbl_jobseeker";
	if(isset($_POST["chk_selposition"])){
		$strsql = $strsql . " inner join tbl_jobseeker_interest_pos on tbl_jobseeker.js_id=tbl_jobseeker_interest_pos.js_id";
	}
	if(isset($_POST["chk_selbranch"])){
		$strsql = $strsql . " Inner Join tbl_branch ON tbl_jobseeker.branch_id = tbl_branch.branch_id";
	}	
	$strsql = $strsql . " where 1";
	if(isset($_POST["chk_selposition"])){
		$strsql = $strsql . " and tbl_jobseeker_interest_pos.position_id=".$_POST["selposition"];
	}
	if(isset($_POST["chk_selbranch"])){
		$strsql = $strsql . " and tbl_branch.branch_id=".$_POST["selbranch"];
	}
	if(isset($_POST["chk_full_name"])){
		$strsql = $strsql . " and tbl_jobseeker.full_name like '%".$_POST["full_name"]."%'";
	}
	if(isset($_POST["chk_email"])){
		$strsql = $strsql . " and tbl_jobseeker.email like '%".$_POST["email"]."%'";
	}
	if(isset($_POST["chk_tempat_lahir"])){
		$strsql = $strsql . " and tbl_jobseeker.place_of_birth like '%".$_POST["tempat_lahir"]."%'";
	}
	if(isset($_POST["chk_sex"])){
		$strsql = $strsql . " and tbl_jobseeker.sex like '%".$_POST["sex"]."%'";
	}
	if(isset($_POST["chk_kawin"])){
		$strsql = $strsql . " and tbl_jobseeker.mar_status like '%".$_POST["kawin"]."%'";
	}
	if(isset($_POST["chk_last_study"])){
		$strsql = $strsql . " and tbl_jobseeker.last_study like '%".$_POST["last_study"]."%'";
	}
	if(isset($_POST["chk_course"])){
		$strsql = $strsql . " and tbl_jobseeker.course like '%".$_POST["course"]."%'";
	}
	if(isset($_POST["chk_working_exp"])){
		$strsql = $strsql . " and tbl_jobseeker.working_exp like '%".$_POST["working_exp"]."%'";
	}
	if(isset($_POST["chk_nationality"])){
		$strsql = $strsql . " and tbl_jobseeker.nationality like '%".$_POST["nationality"]."%'";
	}
	if(isset($_POST["chk_agama"])){
		$strsql = $strsql . " and tbl_jobseeker.religion like '%".$_POST["agama"]."%'";
	}
	if(isset($_POST["chk_darah"])){
		$strsql = $strsql . " and tbl_jobseeker.blood_type like '%".$_POST["darah"]."%'";
	}
	if(isset($_POST["chk_weight_height"])){
		$strsql = $strsql . " and tbl_jobseeker.weight like '%".$_POST["weight"]."%' and tbl_jobseeker.height like '%".$_POST["height"]."%'";
	}
	if(isset($_POST["chk_city"])){
		$strsql = $strsql . " and tbl_jobseeker.city like '%".$_POST["city"]."%'";
	}
	if(isset($_POST["chk_zip_code"])){
		$strsql = $strsql . " and tbl_jobseeker.zip_code like '%".$_POST["zip_code"]."%'";
	}
	$strsql_adv = $strsql;
	//echo $strsql_adv;
}?>
<center>
<table border="0" cellpadding="2" cellspacing="0" width="870">
  <tr>
    <td align="left" colSpan="5" width="567" class="tableheader">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6%"><img src="<?=$ANOM_VARS["www_img_url"]?>ijohelp.gif" onMouseOver="return overlay(this, 'tanya_12')" onMouseOut="overlayclose('tanya_12');" border="0" style="cursor:hand">
		  <div id="tanya_12" style="border: 1px solid rgb(102, 102, 102); position: absolute; display: none; background-color: #f7f7f7; width: 280px; color: rgb(0, 0, 102);">
					<div style="border: 5px solid #f7f7f7;" class="inputStyle5">
<b>Advance search berdasarkan Kriteria :</b>
<br />Untuk Pencarian Advance Searching, Click spesifikasi pencarian dalam <b><font color="#FF0000">Check Box</font></b> Untuk mendapatkan data Akurasi pencarian yang sesuai.</font></div></div></td>
          <td width="94%" class="tableheader">Advance Search Job Seeker</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <form name="adv_search" action="<?=$_SERVER["SCRIPT_NAME"]?>?adv_search=yes&adv_query=yes&refresh=<?=md5("mdY His")?>" method="post">
      <td class="tablebodyodd" align="left" colSpan="5">
        <table border="0" cellPadding="2" cellSpacing="0">
            <tr>
              <td align="center"><input type="checkbox" name="chk_full_name" value="ON" <? if(isset($_GET["adv_search"]) && isset($_POST["chk_full_name"])){ echo " checked";}?>></td>
              <td align="left"><b>Nama Lengkap</b></td>
              <td><b>:</b></td>
              <td align="left"><input maxLength="100" size="30" name="full_name" value="<? if(isset($_GET["adv_search"]) && isset($_POST["chk_full_name"])){ echo trim($_POST["full_name"]);}?>"></td>
              <td align="left">&nbsp;</td>
              <td align="left"><input type="checkbox" name="chk_working_exp" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_working_exp"])){ echo " checked";}?> /></td>
              <td align="left"><b>Pekerjaan Terakhir </b></td>
              <td align="left"><b>:</b></td>
              <td align="left"><?
			  $jobs=cmsDB();
			  $jobs->query("select * from tbl_lastjob order by lst_id asc")
			  ?>
                <select name="working_exp">
                  <? while($jobs->next()){?>
                  <option value="<?=$jobs->row("job_name")?>"<? if(isset($_GET["adv_search"]) && $_POST["working_exp"]==$jobs->row("job_name")){ echo " selected";}?>>
                  <?=$jobs->row("job_name")?>
                  </option>
                  <? } ?>
                </select></td>
            </tr>
            <tr>
              <td align="center"><input type="checkbox" name="chk_email" value="ON" <? if(isset($_GET["adv_search"]) && isset($_POST["chk_email"])){ echo " checked";}?>></td>
              <td align="left"><b>Email Address</b></td>
              <td><b>:</b></td>
              <td vAlign="top" align="left"><input maxLength="100" size="30" name="email" value="<? if(isset($_GET["adv_search"]) && isset($_POST["chk_email"])){ echo $_POST["email"];}?>"></td>
              <td vAlign="top" align="left">&nbsp;</td>
              <td vAlign="top" align="left"><input type="checkbox" name="chk_agama" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_agama"])){ echo " checked";}?> /></td>
              <td vAlign="top" align="left"><b>Agama</b></td>
              <td vAlign="top" align="left"><b>:</b></td>
              <td vAlign="top" align="left"><select name="agama">
                <option value="Islam" <? if(isset($_GET["adv_search"]) && $_POST["agama"]=='Islam'){ echo " selected";}?>>Islam</option>
                <option value="Catholic"<? if(isset($_GET["adv_search"]) && $_POST["agama"]=='Catholic'){ echo " selected";}?>>Catholic</option>
                <option value="Christian"<? if(isset($_GET["adv_search"]) && $_POST["agama"]=='Christian'){ echo " selected";}?>>Christian</option>
                <option value="Hindu"<? if(isset($_GET["adv_search"]) && $_POST["agama"]=='Hindu'){ echo " selected";}?>>Hindu</option>
                <option value="Buddha"<? if(isset($_GET["adv_search"]) && $_POST["agama"]=='Buddha'){ echo " selected";}?>>Buddha</option>
                <option value="Konghuchu"<? if(isset($_GET["adv_search"]) && $_POST["agama"]=='Konghuchu'){ echo " selected";}?>>Konghuchu</option>
              </select></td>
            </tr>
           
            <tr>
              <td vAlign="top" align="center"><input type="checkbox" name="chk_tempat_lahir" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_tempat_lahir"])){ echo " checked";}?>></td>
              <td vAlign="top" align="left"><b>Tempat Lahir</b></td>
              <td vAlign="top"><b>:</b></td>
              <td vAlign="top" align="left"><input maxLength="50" size="30" name="tempat_lahir" value="<? if(isset($_GET["adv_search"]) && isset($_POST["chk_tempat_lahir"])){ echo $_POST["tempat_lahir"];}?>"></td>
              <td vAlign="top" align="left">&nbsp;</td>
              <td vAlign="top" align="left"><input type="checkbox" name="chk_darah" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_darah"])){ echo " checked";}?> /></td>
              <td vAlign="top" align="left"><b>Gol Darah</b></td>
              <td vAlign="top" align="left"><b>:</b></td>
              <td vAlign="top" align="left"><input size="4" maxlength="2" name="darah" value="<? if(isset($_GET["adv_search"]) && isset($_POST["darah"])){ echo $_POST["darah"];}?>" onkeyup="this.value=this.value.toUpperCase()" /></td>
            </tr>
            <tr>
              <td vAlign="top" align="center"><input type="checkbox" name="chk_sex" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_sex"])){ echo " checked";}?>></td>
              <td vAlign="top" align="left"><b>Jenis Kelamin</b></td>
              <td vAlign="top"><b>:</b></td>
              <td vAlign="top" align="left"><input type="radio" value="Laki-Laki" name="sex" <? if(isset($_GET["adv_search"]) && $_POST["sex"]=='Laki-Laki'){ echo " checked";}?>>
                Laki-Laki <input type="radio" value="Perempuan" name="sex"<? if(isset($_GET["adv_search"]) && $_POST["sex"]=='Perempuan'){ echo " checked";}?>> Perempuan</td>
              <td vAlign="top" align="left">&nbsp;</td>
              <td vAlign="top" align="left"><input type="checkbox" name="chk_weight_height" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_weight_height"])){ echo " checked";}?> /></td>
              <td vAlign="top" align="left"><b>Berat</b></td>
              <td vAlign="top" align="left"><b>:</b></td>
              <td vAlign="top" align="left"><input size="4" name="weight" value="<? if(isset($_GET["adv_search"]) && isset($_POST["weight"])){ echo $_POST["weight"];}?>" />
kg&nbsp;&nbsp; <b>Tinggi :</b>
<input size="4" name="height" value="<? if(isset($_GET["adv_search"]) && isset($_POST["height"])){ echo $_POST["height"];}?>" />
cm</td>
            </tr>
            <tr>
              <td vAlign="top" align="center"><input type="checkbox" name="chk_kawin" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_kawin"])){ echo " checked";}?>></td>
              <td vAlign="top" align="left"><b>Status Perkawinan</b></td>
              <td vAlign="top"><b>:</b></td>
              <td vAlign="top" align="left">
			  	<select name="kawin">
                  <option value="Single"<? if(isset($_GET["adv_search"]) && $_POST["kawin"]=='Single'){ echo " selected";}?>>Single</option>
                  <option value="Nikah"<? if(isset($_GET["adv_search"]) && $_POST["kawin"]=='Nikah'){ echo " selected";}?>>Nikah</option>
                  <option value="Cerai"<? if(isset($_GET["adv_search"]) && $_POST["kawin"]=='Cerai'){ echo " selected";}?>>Cerai</option>
                </select></td>
              <td vAlign="top" align="left">&nbsp;</td>
              <td vAlign="top" align="left"><input type="checkbox" name="chk_city" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_city"])){ echo " checked";}?> /></td>
              <td vAlign="top" align="left"><b>Kota</b></td>
              <td vAlign="top" align="left"><b>:</b></td>
              <td vAlign="top" align="left"><?
						$kota = cmsDB();
						$kota->query("select * from tbl_kota order by kot_id asc")
						?>
                <select name="city">
                  <? while($kota->next()){?>
                  <option value="<?=$kota->row("kota")?>" <? if(isset($_GET["adv_search"]) && $_POST["city"]==$kota->row("kota")){ echo " selected";}?>>
                  <?=$kota->row("kota")?>
                  </option>
                  <? } ?>
                </select></td>
            </tr>
            <tr>
              <td vAlign="top" align="center"><input type="checkbox" name="chk_nationality" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_nationality"])){ echo " checked";}?>></td>
              <td vAlign="top" align="left"><b>Kewarganegaraan</b></td>
              <td vAlign="top"><b>:</b></td>
              <td vAlign="top" align="left"><input size="30" name="nationality" value="<? if(isset($_GET["adv_search"]) && isset($_POST["nationality"])){ echo $_POST["nationality"];}?>"></td>
              <td vAlign="top" align="left">&nbsp;</td>
              <td vAlign="top" align="left"><input type="checkbox" name="chk_selbranch" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_selbranch"])){ echo " checked";}?> /></td>
              <td vAlign="top" align="left"><b>Cabang Dilamar</b></td>
              <td vAlign="top" align="left"><b>:</b></td>
              <td vAlign="top" align="left"><?
						$branch = cmsDB();
						$branch->query("select * from tbl_branch where branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].") order by branch_name asc")
						?>
                <select name="selbranch">
                  <? while($branch->next()){?>
                  <option value="<?=$branch->row("branch_id")?>" <? if(isset($_GET["adv_search"]) && $_POST["selbranch"]==$branch->row("branch_id")){ echo " selected";}?>>
                    <?=$branch->row("branch_name")?>
                  </option>
                  <? } ?>
                </select></td>
            </tr>
			<tr>
              <td vAlign="top" align="center"><input type="checkbox" name="chk_last_study" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_last_study"])){ echo " checked";}?>></td>
              <td vAlign="top" align="left"><b>Pendidikan</b></td>
              <td vAlign="top"><b>:</b></td>
              <td vAlign="top" align="left"><select name="last_study">
                <option value="SD"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='SD'){ echo " selected";}?>>SD</option>
                <option value="SMP"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='SMP'){ echo " selected";}?>>SMP</option>
                <option value="SMU"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='SMU'){ echo " selected";}?>>SMU</option>
                <option value="D1"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='D1'){ echo " selected";}?>>D1</option>
                <option value="D2"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='D2'){ echo " selected";}?>>D2</option>
                <option value="D3"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='D3'){ echo " selected";}?>>D3</option>
                <option value="S1"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='S1'){ echo " selected";}?>>S1</option>
                <option value="S2"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='S2'){ echo " selected";}?>>S2</option>
                <option value="S3"<? if(isset($_GET["adv_search"]) && $_POST["last_study"]=='S3'){ echo " selected";}?>>S3</option>
              </select></td>
			  <td vAlign="top" align="left">&nbsp;</td>
			  <td vAlign="top" align="left"><input type="checkbox" name="chk_selposition" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_selposition"])){ echo " checked";}?> /></td>
			  <td vAlign="top" align="left"><b>Posisi Yg Dilamar</b></td>
			  <td vAlign="top" align="left"><b>:</b></td>
			  <td vAlign="top" align="left"><?
			  $position=cmsDB();
			  $position->query("select * from tbl_position order by position_name");
			  ?>
                <select name="selposition">
                  <? while($position->next()){?>
                  <option value="<?=$position->row("position_id")?>"<? if(isset($_GET["adv_search"]) && $_POST["selposition"]==$position->row("position_id")){ echo " selected";}?>>
                  <?=$position->row("position_name")?>
                  </option>
                  <? } ?>
                </select></td>
			</tr>
			<tr>
              <td vAlign="top" align="center"><input type="checkbox" name="chk_course" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_course"])){ echo " checked";}?> /></td>
              <td vAlign="top" align="left"><b>Jurusan</b></td>
              <td vAlign="top"><b>:</b></td>
              <td vAlign="top" align="left"><?
			  $jurusan=cmsDB();
			  $jurusan->query("select * from tbl_jurusan order by code asc")
			  ?>
                <select name="course">
                  <? while($jurusan->next()){?>
                  <option value="<?=$jurusan->row("jurusan")?>"<? if(isset($_GET["adv_search"]) && $_POST["course"]==$jurusan->row("jurusan")){ echo " selected";}?>>
                  <?=$jurusan->row("jurusan")?>
                  </option>
                  <? } ?>
                </select></td>
			  <td vAlign="top" align="left">&nbsp;</td>
			  <td vAlign="top" align="left"><input type="checkbox" name="chk_zip_code" value="ON"<? if(isset($_GET["adv_search"]) && isset($_POST["chk_zip_code"])){ echo " checked";}?> /></td>
			  <td vAlign="top" align="left"><b>KodePos</b></td>
			  <td vAlign="top" align="left"><b>:</b></td>
			  <td vAlign="top" align="left"><input size="30" name="zip_code" value="<? if(isset($_GET["adv_search"]) && isset($_POST["zip_code"])){ echo $_POST["zip_code"];}?>"></td>
			</tr>
        </table>
    <tr>
      <td class="tableheader" align="middle" colSpan="5" width="567"><input type="submit" value="Search Job Seeker">
        &nbsp;<input onclick="location='index.php?search=yes&urlencrypt=<?=md5("mdYHis")?>';" type="button" value="Cancel"></td>
    </tr>
    </form>
  </table></center>