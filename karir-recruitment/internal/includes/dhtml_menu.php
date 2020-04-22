<?
function dhtml_menu($menu_id){
		global $_GET;
		global $_COOKIE;
		global $_POST;
		global $ANOM_VARS;
		global $_SESSION;
		$cekdb = cmsDB();
		$menu = cmsDB();
		$qCek = cmsDB();
	
		$sql = "select * from tbl_menu where menu_id=" . $menu_id;
		//echo $menu_id;die();
		$menu->query($sql);
		$menu->next();
		//echo $menu->recordcount() . "<BR>";
		
		
		$sql = "select * from tbl_menudetail where parent_id=0 and menu_id=".  $menu_id ." and auth_id in (".$_SESSION["auth_menu"].")  order by level_id,auth_id";
				
		//echo $sql . "<BR>";
		$cekdb->query($sql);
		$countrec = $cekdb->recordcount();
		//echo $_SESSION["auth_menu"];
		/*==========================================================================================*/
		?>
		<script type='text/javascript'>
			function Go(){return}
			        var NoOffFirstLineMenus=<?=$countrec?>;                        // Number of first level items
			        var LowBgColor='<?=$menu->row("bg_color")?>';                        // Background color when mouse is not over
			        var LowSubBgColor='<?=$menu->row("bg_color")?>';                        // Background color when mouse is not over on subs
			        var HighBgColor='<?=$menu->row("bg_color_over")?>';                        // Background color when mouse is over
			        var HighSubBgColor='<?=$menu->row("bg_color_over")?>';                        // Background color when mouse is over on subs
			        var FontLowColor='<?=$menu->row("font_color")?>';                        // Font color when mouse is not over
			        var FontSubLowColor='<?=$menu->row("font_color")?>';                        // Font color subs when mouse is not over
			        var FontHighColor='<?=$menu->row("font_color_over")?>';                        // Font color when mouse is over
			        var FontSubHighColor='<?=$menu->row("font_color_over")?>';                        // Font color subs when mouse is over
			        var BorderColor='<?=$menu->row("font_color")?>';                        // Border color
			        var BorderSubColor='<?=$menu->row("font_color")?>';                        // Border color for subs
			        var BorderWidth=1;                                // Border width
			        var BorderBtwnElmnts=1;                        // Border between elements 1 or 0
			        var FontFamily="<?=$menu->row("font_face")?>"        // Font family menu items
			        var FontSize=<?=$menu->row("font_size")?>;                                // Font size menu items
			        var FontBold=1;                                // Bold menu items 1 or 0
			        var FontItalic=0;                                // Italic menu items 1 or 0
			        var MenuTextCentered='left';                        // Item text position 'left', 'center' or 'right'
			        var MenuCentered='left';                        // Menu horizontal position 'left', 'center' or 'right'
			        var MenuVerticalCentered='top';                // Menu vertical position 'top', 'middle','bottom' or static
			        var ChildOverlap=0;                                // horizontal overlap child/ parent
			        var ChildVerticalOverlap=0;                        // vertical overlap child/ parent
			
			        var StartTop=<?=$menu->row("pos_x")?>;                 // Menu offset x coordinate
			        var StartLeft=<?=$menu->row("pos_y")?>;                // Menu offset y coordinate
			
			        var VerCorrect=0;                                // Multiple frames y correction
			        var HorCorrect=0;                                // Multiple frames x correction
			        var RightPaddng=8;                                // Right padding
			        var LeftPaddng=4;                                // Left padding
			        var TopPaddng=2;                                // Top padding
			        var FirstLineHorizontal=<?=$menu->row("menu_type")?>;                        // SET TO 1 FOR HORIZONTAL MENU, 0 FOR VERTICAL
			        var MenuFramesVertical=0;                        // Frames in cols or rows 1 or 0
			        var DissapearDelay=500;                        // delay before menu folds in
			        var TakeOverBgColor=1;                        // Menu frame takes over background color subitem frame
			        var FirstLineFrame='navig';                        // Frame where first level appears
			        var SecLineFrame='space';                        // Frame where sub levels appear
			        var DocTargetFrame='space';                        // Frame where target documents appear
			        var TargetLoc='';                                // span id for relative positioning
			        var HideTop=0;                                // Hide first level when loading new document 1 or 0
			        var MenuWrap=1;                                // enables/ disables menu wrap 1 or 0
			        var RightToLeft=0;                                // enables/ disables right to left unfold 1 or 0
			        var UnfoldsOnClick=0;                        // Level 1 unfolds onclick/ onmouseover
			        var WebMasterCheck=0;                        // menu tree checking on or off 1 or 0
			        var ShowArrow=1;                                // Uses arrow gifs when 1
			        var KeepHilite=1;                                // Keep selected path highligthed
			        var Arrws=['<?=$ANOM_VARS["www_img_url"]?>panah_kotak.gif',10,15,'<?=$ANOM_VARS["www_img_url"]?>tridown.gif',10,5,'<?=$ANOM_VARS["www_img_url"]?>trileft.gif',5,10];        // Arrow source, width and height
			
			
			
			
			
			
			function BeforeStart(){return}
			function AfterBuild(){return}
			function BeforeFirstOpen(){return}
			function AfterCloseAll(){return}
			
			</script>
			<script>
			<?
			
			//while($cekdb->next()){
				print_menu(0,"",$menu_id);
			//}
			?>
			
			</script>
			<script type='text/javascript' src='<?=$ANOM_VARS["www_js_url"]?>menu_com.js'></script>
<?}
function print_menu($parent,$old_menu,$menu_id){
		$qchild = cmsDB();
		$trans_db = cmsDB();
		$counter = 0;
        $sql = "select urlid,auth_id,auth_name,auth_desc,parent_id,level_id,menu,lebar,tinggi,gambar from tbl_menudetail where parent_id=". $parent ." and menu_id=". $menu_id ." and auth_id in (".$_SESSION["auth_menu"].")  order by level_id,auth_id";
		//print chr(13). $sql . chr(13);
		$trans_db->query($sql);
		echo "//" . $old_menu . chr(13);
        if (strlen($old_menu)){ 
			$menu_level = $old_menu . "_"; 
		}else{ 
			$menu_level = ""; 
		}
        /*if (strlen($old_name)){ 
			$parent_name = $parent_name . $old_name;
		}*/
        while ($trans_db->next()) { 
				$counter=$counter+1;
                $j = 1; 
				$lbr = $trans_db->row("lebar");
				$tg = $trans_db->row("tinggi");
				
				$sql = "select *  from tbl_menudetail where parent_id=". $trans_db->row("auth_id");
				$qchild->query($sql);
				$crchild = $qchild->recordcount();
				if(!strlen($crchild)){
					$crchild = 0;
				}
				if (strlen($trans_db->row("gambar"))){
					//echo "Masuk";
                    //echo "Menu" . $menu_level . $counter . "= new Array(""<img src='images/'". $trans_db->row("gambar") . "'>"",'index.asp?TID=1&URLID=" . $trans_db->row("urlid") . "&URLEncodedFormat=" . mktime() . "','',". $crchild .",". $tg ."," . $lbr . ",'','','','','');" . chr(13);
                }else{
					//echo "Gak Masuk";
					if($parent==0){
                    	echo "Menu" . $menu_level . $counter . "= new Array('<center>" . $trans_db->row("auth_name") . "</center>    ";
					}else{
						echo "Menu" . $menu_level . $counter . "= new Array('" . $trans_db->row("auth_name") . "    ";
					}
					echo "','".$trans_db->row("urlid")."','',". $crchild .",";
					echo $tg . "," ;
					echo $lbr . ",'','','','','');" . chr(13);
                }
				//echo $trans_db->row("auth_id") ."|". $menu_level . $counter ."|". $trans_db->row("lebar") ."|".$trans_db->row("tinggi") ."|".$crchild .chr(13);
               	print_menu($trans_db->row("auth_id"), $menu_level . $counter,$menu_id);
		}
}
?>