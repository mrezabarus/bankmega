<?
function polling($id){
		global $_GET;
		global $_POST;
		global $FJR_VARS;
?>

<script language='JavaScript'>
function _popupaction(id) {
	var windowW=500;
	var windowH=510;		
	var l = (screen.width-windowW)/2;
	var t = (screen.height-windowW)/2;
	s = 'scrollbars=yes'+',width='+windowW+',height='+windowH+',left='+l+',top='+t;
	blwindow = window.open('<?=$FJR_VARS["cms_url"]?>_polling/poolresult.php?poll_id='+id,'Popup',s);
}
</script>

<?
		$mega_db = cmsDB();
			
		if (isset($_GET["cat"])){
			 if($_GET["cat"] = "pollProcess") {
				if (isset($_POST["chkpoll"])) {
					$stQuery = "update db_mega.tbl_polling_answer set hints = Hints + 1 where Polling_Answer_ID = " . $_POST["chkpoll"];
					$mega_db->query($stQuery);
				} else {
?>

<script>alert('Choose Pooling Answer First !!');</script>

<? ;
				}
			 }
		}
		$Sql_Statement = "SELECT * FROM db_mega.tbl_polling WHERE Polling_ID =" . $id;
		$mega_db->query($Sql_Statement);
		$mega_db->next();
		$Active_ID = $mega_db->row("Polling_ID");
		$Active_Title = $mega_db->row("Polling_Title");
		$mega_db->free();
		$Sql = "SELECT * FROM db_mega.tbl_polling_answer WHERE Polling_ID =" . $id;
		$mega_db->query($Sql);
		$pgid = uriParam("pgid","");
?>
		<table cellpadding="2" cellspacing="0" border="0" width="100%">
		<form name='frmpoll' action='<?=getenv('SCRIPT_NAME')?>?cat=pollProcess&pgid=<?=$pgid?>&seed=<?=mktime()?>' method='post'>
		<tr>
			<td background="<?=$FJR_VARS["www_img_url"]?>index_18.gif" width="1%" valign="top"><img border="0" src="<?=$FJR_VARS["www_img_url"]?>spacer.gif" width="5" height="1"></td>
			<td width="1%"><img border="0" src="<?=$FJR_VARS["www_img_url"]?>spacer.gif" width="5" height="5"></td>
			<td width="97%">
				<table width='100%' border='0' cellspacing='0' cellpadding='2'>
					<tr>
						<td colspan="2"><b><?=htmlentities($Active_Title)?></b></td>
					</tr>
<? while ($mega_db->next()) { ?>
					<tr>
						<td width="1%"><input type='radio' name='chkpoll' value="<?=$mega_db->row("Polling_Answer_ID")?>"></td>
						<td width="99%"><?=htmlentities($mega_db->row("Answer_Title"))?></td>
					</tr>
<? } ?>
					<tr>
						<td colspan="2"><input type="Image" border="0" width="100" height="26" src="<?=$FJR_VARS["cms_url"]?>_polling/submit.gif"></td>
					</tr>
					<tr>
						<td colspan="2" align="left"><a href='javascript:_popupaction(<?=$id?>)'><b>Pooling Result</b></a></td>
					</tr>
				</table>
			</td>
			<td width="1%" valign="top"><img border="0" src="<?=$FJR_VARS["www_img_url"]?>spacer.gif" width="5" height="2"></td>
		</tr>
		</form>
		</table>
<? } ?>