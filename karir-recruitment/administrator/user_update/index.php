<? 
	require_once("../config.inc.php");
	
	$strSQL = "SELECT COUNT(*) AS maxuser";
	$strSQL .= " FROM erecruitment.tbl_jobseeker";
	$mega_db->query($strSQL);
	
	$mega_db->next();
	$maxuser = $mega_db->row("maxuser");
	$page = is_numeric(uriParam("page",1))?uriParam("page",1):1;
	$maxrow = 50;
	$maxpage = floor($maxuser / $maxrow) + 1;
	if ($page < 1) $page = 1;
	if ($page > $maxpage) $page = $maxpage;
	$startrow = $maxrow * ($page - 1);
		
	$perhalaman = 10;     // tentukan jumlah data perhalaman
	
	// jika ada parameter halaman, ambil. jika tidak, isikan kosong
	$halaman = isset($_GET["page"]) ? $_GET["page"] : "0";
	
	// hitung posisi awal data (offset)
	$awal = $halaman * $perhalaman;
	$query = "select * from erecruitment.tbl_jobseeker order by user_name limit $awal, $perhalaman";
	$query_jumlah = "select count(*) AS maxuser from erecruitment.tbl_jobseeker";
	
	// ambil jumlah total data
	$rs_jumlah = mysql_query($query_jumlah) or die(mysql_error());
	$r = mysql_fetch_row($rs_jumlah);
	
	$total_halaman = ceil($r[0] / $perhalaman);
	
	$halaman_str = "";  // kosongkan variabel
	if ($halaman > 1)
	   $halaman_str .= "<a href='?page=0' title='Halaman pertama'><b>First</b></a> ";
	if ($halaman > 0){
	   $page = $halaman - 1; 
	   $halaman_str .= "<a href='?page=$page' title='Halaman sebelumnya'>Prev</a> ";
	}

		$jumlah_link_hal = 5; 
		$a=$halaman-$jumlah_link_hal;
		$b=$halaman+$jumlah_link_hal+1;
		
		if ($a<1)$a=0;
		if ($b>$total_halaman)$b=$total_halaman;
		
		if ($halaman > $jumlah_link_hal){
			$halaman_str .= "...&nbsp;";
		}
		for ($i = $a; $i < $b; $i++){
			 $page = $i + 1;
			 if ($i == $halaman)
				 $halaman_str .= "<strong>$page </strong>";
			 else
				 $halaman_str .= "<a href='?".$url."&page=$i' title='Halaman $page' class='link_normal'>$page</a> ";
		}
		if ($halaman < $total_halaman-$jumlah_link_hal-1){
			$halaman_str .= "...&nbsp;";
		}

if ($halaman < ($total_halaman - 1)){
   $page = $halaman + 1; 
   $halaman_str .= "<a href='?page=$page' title='Halaman berikutnya'>Next</a> ";
}

if ($halaman < ($total_halaman - 2)){
   $page = $total_halaman - 1; 
   $halaman_str .= "<a href='?page=$page' title='Halaman terakhir'><b>Last</b></a> ";
}

$halaman_str = "<div style='width: 100%; background-color: #ddd'>$halaman_str</div>\n";

$rs = mysql_query($query) or die(mysql_error());
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$FJR_VARS["admin_title"]?> -  Shared Template Part Manager</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<table border="0" cellpadding="2" width="101%" bgcolor="#DEDEDE" cellspacing="0">
	<tr>
		<td colspan="7" background="../images/depan.jpg"><b><font color="#FFFFFF">Member(s)
		      Employee Manager</font></b></td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1"></td>
            </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="6">
<? if(isset($_GET["search"]) || isset($_POST["search"])){
	if(isset($_POST["user_name"])){
		$user_name=$_POST["user_name"];
		$id_no=$_POST["id_no"];
		$email=$_POST["email"];
	}else{
		$user_name="";
		$id_no="";
		$email="";
	}
	?>
<table border="0" cellspacing="0" cellpadding="0">
		  <form action="" method="post" name="search" id="search">
			<tr>
			  <td align="right"><b>Username</b></td>
			  <td><b>:</b></td>
			  <td>&nbsp;<input type="text" name="user_name" value="<?=$mega_db->row("user_name")?>" maxlength="11" size="20" /></td>
			  <td>&nbsp;<input type="image" src="../images/cari.jpg" name="Action" value="Search" /></td>
			</tr>
		  </form>
		</table>
	  <? } ?></td>
	</tr>
	<tr>
		<td colspan="7" align="right"><DIV onmouseup=button_up(this); class=cbtn onmousedown=button_down(this); onmouseover=button_over(this); CURSOR: hand" onclick="location='index.php?search=yes';" onmouseout=button_out(this); valign="bottom"><IMG alt="Search" src="../images/suryakanta.jpg" border=0 title="Search Member">&nbsp;&nbsp;</DIV></td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>UserName</b></td>
		<td><b>ID KTP</b></td>
	  	<td><b>Tanggal Lahir</b></td>
		<td><b>email</b></td>
		<td><b>join date</b></td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>		</td>
	</tr>
	<? if ($mega_db->recordCount() == 0) { ?>
	<tr>
		<td colspan="7" align="center">No Member Pelamar Available...</td>
	</tr>
	<? } else {  
	 while ($r = mysql_fetch_array($rs)){
	 		$date1 = explode('-',$r[date_of_birth]);
			$day1 = explode(" ",$date1[2]);
			$date_of_birth = $day1[0].'-'.$date1[1].'-'.$date1[0];
			
			$date2 = explode('-',$r[join_date]);
			$day2 = explode(" ",$date2[2]);
			$join_date = $day2[0].'-'.$date2[1].'-'.$date2[0];
	
	?>
	<tr>
		<td valign="top" align="left"><?=$mega_db->currentRow()?>.</td>
		<td valign="top"><a href="profile_edit.php?js_id=<?=rawurlencode($r[js_id])?>&seed=<?=mktime()?>"><?=trim($r[user_name]) != "" ?htmlentities($r[user_name]):"<font color=red>N/A</font>"?></a></td>
		<td valign="top"><?=$r[id_no]?></td>
		<td valign="top"><?=$date_of_birth;?></td>
		<td valign="top"><a href="mailto:<?=$r[email]?>"><?=htmlentities($r[email])?></a></td>
		<td valign="top"><?=$join_date;?></td>
	</tr>
		<? } ?>
	<? } ?>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="100%" height="1" bgcolor="#000000"></td>
            </tr>
            </table>		</td>
	</tr>
	<tr>
		<td colspan="7">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="100%" height="1">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="100%" align="left"><table width="50%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><?=$halaman_str?></td>
                      </tr>
                    </table></td>
				</tr>
				</table>              </td>
			</tr>
			</table>		</td>
	</tr>
</table>
</body>
</html>