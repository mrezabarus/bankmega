<?
		require_once("../config.inc.php");
		$qchild = cmsDB();
		$strsql = "select * from tbl_menu where edition_id=1";
		$mega_db->query($strsql);
		$mega_db->next();
		$strsql = "insert into tbl_menu(edition_id,bg_color,bg_color_over,font_color,font_color_over,font_face,font_size,pos_x,pos_y,menu_type) values";
		$strsql = $strsql . "(".$_GET["edition_id"].",'".$mega_db->row("bg_color")."','".$mega_db->row("bg_color_over")."','".$mega_db->row("font_color")."','".$mega_db->row("font_color_over")."','".$mega_db->row("font_face")."',".$mega_db->row("font_size").",".$mega_db->row("pos_x").",".$mega_db->row("pos_y").",".$mega_db->row("menu_type").")";
		//echo $strsql."<br />";
		mysql_query($strsql);
		
		$strsql = "select * from tbl_menudetail where edition_id=1";
		$mega_db->query($strsql);
		$mega_db->next();
				
		$strsql = "select * from tbl_menudetail where edition_id=1 order by level_id";
		$mega_db->query($strsql);
		while($mega_db->next()){
			if($mega_db->row("parent_id")==0){
				$strsql= "insert into tbl_menudetail(auth_name,auth_desc,parent_id,level_id,urlid,menu,lebar,tinggi,gambar,edition_id,original_id)";
				$strsql = $strsql . " values('".trim($mega_db->row("auth_name"))."','".$mega_db->row("auth_desc")."',0,".$mega_db->row("level_id").",'".$mega_db->row("urlid")."',".$mega_db->row("menu").",".$mega_db->row("lebar").",".$mega_db->row("tinggi").",'".$mega_db->row("gambar")."',".$_GET["edition_id"]. ",".$mega_db->row("auth_id").")";
				
				//echo $strsql ."<br />";
				
			}else{
				$strsql = "select * from tbl_menudetail where original_id='".trim($mega_db->row("parent_id"))."' and edition_id=".$_GET["edition_id"];
				//echo "select * from tbl_menudetail where original_id='".trim($mega_db->row("parent_id"))."' and edition_id=".$_GET["edition_id"];
				
				$qchild->query($strsql);
				
				if($qchild->recordcount()){
					$qchild->next();
					$parent_id = $qchild->row("auth_id");
				}else{
					$parent_id = 0;
				}
				
				$strsql= "insert into tbl_menudetail(auth_name,auth_desc,parent_id,level_id,urlid,menu,lebar,tinggi,gambar,edition_id,original_id)";
				$strsql = $strsql . " values('".trim($mega_db->row("auth_name"))."','".$mega_db->row("auth_desc")."',".$parent_id.",".$mega_db->row("level_id").",'".$mega_db->row("urlid")."',".$mega_db->row("menu").",".$mega_db->row("lebar").",".$mega_db->row("tinggi").",'".$mega_db->row("gambar")."',".$_GET["edition_id"]. ",".$mega_db->row("auth_id").")";
				//echo $strsql ."<br />";
			}
			mysql_query($strsql);
			
		}
		
		
		
?>
<script language="JavaScript">
	alert("Menu Duplicated!");
	location = "authorization.php?edition_id=<?=$_GET["edition_id"]?>&URLEncode=<?=date("m d Y h:mm:ss")?>";
</script>