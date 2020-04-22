<?
require_once("../config.inc.php");


$qeditiondefault=cmsDB();
?>
<script language=javascript>
<!--
function clickCategory(CatIDStr) 
{
  var txtObj = document.all("t_" + CatIDStr);
  var imgObj = document.all("i_" + CatIDStr);

  if (txtObj.style.display == 'none') 
  {
    txtObj.style.display = '';
    imgObj.src = '../images/node_minus.gif';
  }
  else 
  {
    txtObj.style.display = 'none';
    imgObj.src = '../images/node_plus.gif';
  }
}
//-->
</script>
<?
if(isset($_GET["setting"])){
	if(strlen($_GET["menu_id"])){
		$sql = "select * from tbl_menu where menu_id=".$_GET["menu_id"];
		$mega_db->query($sql);
		if($mega_db->recordcount()){
			$sql = "update tbl_menu set menu_title='".trim($_POST["txttitle"])."',bg_color='".trim($_POST["txtbgcolor"])."',bg_color_over='".trim($_POST["txtbgcolor_over"])."',font_color='".trim($_POST["txtfontcolor"])."',font_color_over='".trim($_POST["txtfontcolor_over"])."',font_face='".trim($_POST["txtface"])."',font_size='".trim($_POST["txtsize"])."',pos_x=".trim($_POST["txtposx"]).",pos_y=".trim($_POST["txtposy"]).",menu_type=".trim($_POST["seltype"]).",border_color='".trim($_POST["txtbordercolor"])."' where menu_id=".$_GET["menu_id"];
			$mega_db->query($sql);
			echo "<script>alert('Record Updated');location='authorization.php?menu_id=".$_GET["menu_id"]."&refresh=".mktime()."';</script>";
		}else{
			echo "<script>alert('Invalid Data');location='index.php?refresh=".mktime()."';</script>";
		}
	}else{
			$sql = "insert into tbl_menu(menu_title,bg_color,bg_color_over,font_color,font_color_over,font_face,font_size,pos_x,pos_y,menu_type,border_color) values('".trim($_POST["txttitle"])."','".trim($_POST["txtbgcolor"])."','".trim($_POST["txtbgcolor_over"])."','".trim($_POST["txtfontcolor"])."','".trim($_POST["txtfontcolor_over"])."','".trim($_POST["txtface"])."','".trim($_POST["txtsize"])."',".$_POST["txtposx"].",".$_POST["txtposy"].",".$_POST["seltype"].",'".trim($_POST["txtbordercolor"])."')";
			$mega_db->query($sql);
			$id = $mega_db->lastInsertID();
			echo "<script>alert('Record Inserted');location='authorization.php?menu_id=".$id."&refresh=".mktime()."';</script>";
	}
	die();
}
if(isset($_GET["delete"])){
			$sql = "delete from tbl_menu where menu_id=".$_GET["menu_id"];
			$mega_db->query($sql);
			$sql = "delete from tbl_menudetail where menu_id=".$_GET["menu_id"];
			$mega_db->query($sql);
			echo "<script>alert('Record Deleted');location='index.php?refresh=".mktime()."';</script>";
			die();
}
if(isset($_GET["menu_id"])){
	$menu_id=$_GET["menu_id"];
	$sql = "select *  from tbl_menu where menu_id=".$_GET["menu_id"];
	$mega_db->query($sql);
	$mega_db->next();
	$menutitle=$mega_db->row("menu_title");
	$bgcolor=$mega_db->row("bg_color");
	$bordercolor=$mega_db->row("border_color");
	$bgcolor_over=$mega_db->row("bg_color_over");
	$font_color=$mega_db->row("font_color");
	$font_color_over=$mega_db->row("font_color_over");
	$font_face=$mega_db->row("font_face");
	$font_size=$mega_db->row("font_size");
	$pos_x=$mega_db->row("pos_x");
	$pos_y=$mega_db->row("pos_y");
	$menu_type=$mega_db->row("menu_type");
}else{
	$menu_id="";
	$menutitle="";
	$bgcolor="";
	$bordercolor="";
	$bgcolor_over="";
	$font_color="";
	$font_color_over="";
	$font_face="";
	$font_size="";
	$pos_x="0";
	$pos_y="0";
	$menu_type="";
}
?>
<link rel="stylesheet" type="text/css" href="../css/admin.css">
<body leftmargin="10" topmargin="0">
<table border="0" cellpadding="2" width="100%" bgcolor="#DEDEDE" cellspacing="0">
	<form name="frmEdit" action="authorization.php?setting=yes&menu_id=<?=$_GET["menu_id"]?>" method="post">
	<tr>
	<td background="../images/depan.jpg"><b><font color="#FFFFFF">Menu Setting</font></b></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>Menu Title</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txttitle" size="20" maxlength="255" class="text" value="<?=$menutitle?>"></td>
				</tr>
				<tr>
					<td>Background Color</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtbgcolor" size="20" maxlength="255" class="text" value="<?=$bgcolor?>"></td>
				</tr>
				<tr>
					<td>Border Color</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtbordercolor" size="20" maxlength="255" class="text" value="<?=$bordercolor?>"></td>
				</tr>
				<tr>
					<td>Background Color When Mouse Over</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtbgcolor_over" size="20" maxlength="255" class="text" value="<?=$bgcolor_over?>"></td>
				</tr>
				<tr>
					<td>Font Color</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtfontcolor" size="20" maxlength="255" class="text" value="<?=$font_color?>"></td>
				</tr>
				<tr>
					<td>Font Color Over</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtfontcolor_over" size="20" maxlength="255" class="text" value="<?=$font_color_over?>"></td>
				</tr>
				<tr>
					<td>Font Face</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtface" size="20" maxlength="255" class="text" value="<?=$font_face?>"></td>
				</tr>
				<tr>
					<td>Font Size</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtsize" size="20" maxlength="255" class="text" value="<?=$font_size?>"></td>
				</tr>
				<tr>
					<td>X Position</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtposx" size="20" maxlength="255" class="text" value="<?=$pos_x?>"></td>
				</tr>
				<tr>
					<td>Y Position</td>
					<td>:</td>
					<td colspan="3"><input type="text" name="txtposy" size="20" maxlength="255" class="text" value="<?=$pos_y?>"></td>
				</tr>
				<tr>
					<td>Menu Type</td>
					<td>:</td>
					<td colspan="3">
						<select name="seltype">
							<option value="1" <? if($menu_type==1){ echo "selected";} ?>>Horizontal</option>
							<option value="0" <? if($menu_type==0){ echo "selected";} ?>>Vertical</option>
						</select>					</td>
				</tr>
			</table>
	  </td>
	</tr>	
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1" bgcolor="#000000"></td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;
		<input type="submit" class="button" value="    Update    ">
		<? if(strlen($_GET["menu_id"])){ ?>
			<input type="button" class="button" value="  Delete      " onClick="location='authorization.php?delete=yes&menu_id=<?=$_GET["menu_id"]?>&seed=<?=mktime()?>'">
		<? } ?>
		<input type="button" class="button" value="  Cancel      " onClick="location='index.php?seed=<?=mktime()?>'"></td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                <td width="100%" height="1"></td>
                </tr>
            </table>
		</td>
	</tr>
	</form>
</table>
<? if(isset($_GET["menu_id"])){
		function NumOfSubs($Parentid){
			$objSubCounter=cmsDB();
			$strSubCounter = "select *  from tbl_menudetail where parent_id=" . $Parentid . " order by level_id, auth_id";
			$objSubCounter->query($strSubCounter); 
			$NumOfSubs = $objSubCounter->recordcount();
			return $NumOfSubs;
		}
	
		Function DisplaySubs($Parentid){
			global $menu_id;
			$menuchild = cmsDB();
			$strDisplaySub = "select *  from tbl_menudetail where parent_id=" . $Parentid . " order by level_id, auth_id";
			$menuchild->query($strDisplaySub);
			
			while($menuchild->next()){
					$menu_id = $menuchild->row("menu_id");
					for ($i = 0; $i <= $menuchild->row("level_id"); $i++) {
				?>
						<img src="../images/hr.gif" width=9 height=9 alt="" border="0">
				<? } ?>
						
						<font face="verdana" size="1" color="#004000"><b><?=$menuchild->row("auth_name")?></b>
						
						&nbsp;<a href="addauth.php?menu_id=<?=$menu_id?>&parent=<?=$menuchild->row("auth_id")?>">[New Child]</a>
						<a href="editauth.php?menu_id=<?=$menu_id?>&id=<?=$menuchild->row("auth_id")?>">[Edit]</a>
						<a href="qdelauth.php?menu_id=<?=$menu_id?>&id=<?=$menuchild->row("auth_id")?>">[Delete]</a>
						</font>
						<br />
					<? if (NumOfSubs($menuchild->row("auth_id")) > 0) { ?>
					<?=DisplaySubs($menuchild->row("auth_id")) ?>
					<? }
			}
		} ?>
	<br />
	<form name="frmauth" action="authorization.php" method="post">
	<table width="100%" cellspacing="0" cellpadding="0" border=0>
	<tr><td bgcolor="#DEDEDE">&nbsp;<b>Menu List</b>&nbsp;
	
	</td></tr>
	<tr>
	<td>
	<?
	$menu=cmsDB();
	$sql = "select *  from tbl_menudetail where parent_id=0 and menu_id=".$_GET["menu_id"]."  order by level_id,auth_id";
	$menu->query($sql);
	$rec = $menu->recordcount();
	if ($rec > 0){
		while($menu->next()){?>
			
				<img src="../images/node_final.gif" width=9 height=9 alt="" border="0">
				
				<font face="verdana" size="1" color="#004000">
					<b><?=$menu->row("auth_name")?></b>
					<a href="addauth.php?menu_id=<?=$menu_id?>&parent=<?=$menu->row("auth_id")?>">[New Child]</a>
					<a href="editauth.php?menu_id=<?=$menu_id?>&id=<?=$menu->row("auth_id")?>">[Edit]</a>
					<a href="qdelauth.php?menu_id=<?=$menu_id?>&id=<?=$menu->row("auth_id")?>">[Delete]</a>
					</font>
					<br />
			
				<? if (NumOfSubs($menu->row("auth_id")) > 0){?>
					<?=DisplaySubs($menu->row("auth_id")) ?>
				 <? }
				   }
				  } ?>	
	<br />
	</td>
	</tr>
	<tr><td class="wintitle" align="left">
	&nbsp;<input type="Button" value="New Parent" onClick="location='newauth.php?menu_id=<?=$menu_id?>'">
	</td></tr>
	</table>
<? } ?>
</form>
</body>



