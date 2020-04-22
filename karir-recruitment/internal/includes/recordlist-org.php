<?
function recordlist($record_id){

global $_GET,$_POST,$ANOM_VARS;

$record_db = cmsDB();
$strsql = "select * from afs_recordlist where record_id=".$record_id;
$record_db->query($strsql);
$record_db->next();

$record_name=$record_db->row("record_name");
$record_sql_syntax=$record_db->row("record_sql_syntax");
$record_primary=$record_db->row("record_primary");
$record_col=$record_db->row("record_col");
$record_coltype=$record_db->row("record_coltype");
$record_directcol=$record_db->row("record_coltype");
$record_searchby=$record_db->row("record_searchby");
$record_sortby=$record_db->row("record_sortby");
$record_fieldtype=$record_db->row("record_fieldtype");
$record_fieldform=$record_db->row("record_fieldform");
$record_table=$record_db->row("record_table");
$record_count=$record_db->row("record_count");


$function_db = cmsDB();

$url_id = $_GET["url_id"];

if(isset($_GET["save"])){
	$strsql = "insert into ". trim($record_table) ."(";
	$field = "";
	for ($i=1;$i<=listLen($record_fieldtype,"#");$i++){
		$field = listAppend($field,listGetAt(listGetAt(trim($record_fieldtype),$i,"#"),1,"|"));
	}
	$strsql .= $field. ")";
	$strsql .= " values(";
	
	$value_string = "";
	//recordlist pake delimeter #
	for($i=1;$i<=listLen($record_fieldtype,"#");$i++){
		$fieldtype = listgetAt($record_fieldtype,$i,"#");
		$field = listgetAt($fieldtype,1,"|");
		$type = listgetAt($fieldtype,4,"|");
		
		if ($type=='datetime'){
			$value_post = postParam($field);
			$mon_date=listGetAt($value_post,2,"/")."/".listGetAt($value_post,1,"/")."/".listGetAt($value_post,3,"/");
			$value = "'". date("Y-m-d",strtotime($mon_date)) ."'";
			
		}elseif ($type=='password'){
			$value_post = postParam($field);
			if(strlen(trim(postParam($field)))){
				$value = "PASSWORD('". trim(postParam($field)) ."')";	
				
			}else{
				$value = "";
			}
			
			
		}else{
			$value = "'" . postParam($field) . "'";
		}
		$value_string = listAppend($value_string,$value);
	}
	
	$strsql .= $value_string. ")";
	//echo $strsql;
	$function_db->query($strsql);
	echo "<SCRIPT>alert('Record Saved..!!');location='".getenv("SCRIPT_NAME")."?url_id=".$url_id."&refresh=".urlencode(date("m d y h m s"))."';</SCRIPT>";
	die();
}

if(isset($_GET["update"])){
	$strsql = "update ". trim($record_table)." set ";
	$value_string = "";
	for($i=1;$i<=listLen($record_fieldtype,"#");$i++){
		$fieldtype = listgetAt($record_fieldtype,$i,"#");
		$field = listgetAt($fieldtype,1,"|");
		$type = listgetAt($fieldtype,4,"|");
		
		if ($type=='datetime'){
			$value_post = postParam($field);
			$mon_date=listGetAt($value_post,2,"/")."/".listGetAt($value_post,1,"/")."/".listGetAt($value_post,3,"/");
			$value = "'". date("Y-m-d",strtotime($mon_date)) ."'";
			$field .= "=". $value;
			
		}elseif ($type=='password'){
			$value_post = postParam($field);
			if(strlen(trim(postParam($field)))){
				$value = "PASSWORD('". trim(postParam($field)) ."')";	
				$field .= "=". $value;
			}else{
				$field = "";
			}
			
		}else{
			$value = "'" . postParam($field) . "'";
			$field .= "=". $value;
		}
		
		$value_string = listAppend($value_string,$field);
	}
	$strsql.=$value_string;
	$strsql.=" where " . $record_primary . "=" . $_GET[$record_primary];
	//echo $strsql;die();
	$function_db->query($strsql);
	echo "<SCRIPT>alert('Record Updated..!!');location='".getenv("SCRIPT_NAME")."?url_id=".$url_id."&refresh=".urlencode(date("m d y h m s"))."';</SCRIPT>";
	die();
}

if(isset($_GET["delete"])){
	$strsql = "delete from ".  trim($record_table) ." where ". $record_primary . "=" . $_GET[$record_primary];
	$function_db->query($strsql);
	echo "<SCRIPT>alert('Record Deleted..!!');location='".getenv("SCRIPT_NAME")."?url_id=".$url_id."&refresh=".urlencode(date("m d y h m s"))."';</SCRIPT>";
	die();
}

//Start Query for this Recordlist
$strSQL = $record_sql_syntax;
if(isset($_POST["txtsearch"])){
	$strSQL .= " where ";
	for($i=1;$i<=listLen($record_searchby);$i++){
		$strSQL .= " " . listGetAt($record_searchby,$i) . " like '%". $_POST["txtsearch"] ."%'";
		if($i <> listLen($record_searchby)){
			$strSQL .= " or ";
		}
	}
}

if(isset($_GET["sortby"]) && isset($_GET["orderby"])){
	$strSQL .= " order by " . trim($_GET["sortby"]) . " " . trim($_GET["orderby"]);
}

$record_list = cmsDB();
$real_SQL = $strSQL; 
$record_list->query($real_SQL);
$record_page=ceil($record_list->recordCount()/$record_count);

if(isset($_GET["selpage"])){
	$start = ($_GET["selpage"] * $record_count) - $record_count;
	$strSQL .= " limit " . $start . "," . $record_count;
}else{
	$start = 0;
	$strSQL .= " limit 0," . $record_count;
}
$function_db->query($strSQL);
$no = $start + 1;
?>

<body topmargin="0" leftmargin="0">
<script type="text/javascript" src="<?=$ANOM_VARS["www_js_url"]?>calendar.js"></script>
<script type="text/javascript" src="<?=$ANOM_VARS["www_js_url"]?>calendar-en.js"></script>
<script type="text/javascript" src="<?=$ANOM_VARS["www_js_url"]?>calendar-setup.js"></script>
<script src="<?=$ANOM_VARS["www_js_url"]?>js_button.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$ANOM_VARS["www_css_url"]?>stylesheet_1.css">

<!--- Start Main Workflow --->
<TABLE style="HEIGHT: 148" cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD vAlign=top height="148">
      <TABLE width="100%">
        <TBODY>
        <TR>
          <TD width="100%">
			<TABLE cellSpacing=1 cellPadding=0 width="100%" align=center border=0>
              <TBODY>
              <TR>
                <TD vAlign=top align=left width="100%">
                  <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>
                        <TABLE class=heading2 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
                          <TBODY>
                          <TR>
                            <TD class=tableheader>
							<form name="frmsearch" action="<?=getenv("SCRIPT_NAME")?>?<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>record_id=<?=$record_id?>" method="post">
							  <!--- HEADER --->
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                                <TR>
	                                <TD class=tableheader>&nbsp;<?=$record_name?></TD>
	                                <TD align=right>
	                             <table width="0" class=tableheader>
									<tr>
										<td>
											
											Search :&nbsp;
											<input type="Text" name="txtsearch" size="20">&nbsp;<input type="Submit" value="Search">
											
											&nbsp;
										</td>
									</tr>
									</table>
	                                </TD></form>
								</TR>
								</TBODY>
							   </TABLE>
							  </TD>
						  </TR>
                          <TR>
                            <TD>
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                                <TR>
                                	<TD style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width="100%"></TD>
								</TR>
                                <TR>
                                	<TD style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width="100%"></TD>
								</TR>
								</TBODY>
							  </TABLE>
							 </TD>
						  </TR>
						  <TR>
                            <TD>
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                                
								<TR>
                                	<TD>
									<!--- Menu --->
									<table border=0 width=0 cellpadding=2 cellspacing=1>
									<tr>
										<td width=0 height=20>
										   <div class="cbtn" style="font:10pt sans-serif;cursor:hand" valign="bottom"  
											onclick="location='<?=getenv("SCRIPT_NAME")?>?create=yes&<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>record_id=<?=uriParam("record_id")?>&refresh=<?=urlencode(date("m/d/Y/h/m/s"))?>';" 
											onmouseover="button_over(this);" 
											onmouseout="button_out(this);" 
											onmousedown="button_down(this);" 
											onmouseup="button_up(this);"> &nbsp;&nbsp;&nbsp;New&nbsp;&nbsp;&nbsp;</div></td>
										
									</tr>
									</table>

									<!--- End Of Menu --->
									</TD>
								</TR>
                                
								</TBODY>
							  </TABLE>
							 </TD>
						  </TR>
						  <TR>
                            <TD>
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                                <TR>
                                	<TD style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width="100%"></TD>
								</TR>
                                <TR>
                                	<TD style="HEIGHT: 1px"><IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width="100%"></TD>
								</TR>
								</TBODY>
							  </TABLE>
							 </TD>
						  </TR>
                          <TR>
                            <TD class=heading2>
                              <TABLE class=heading2 cellSpacing=1 cellPadding=1 
                              width="100%" align=center border=0>
                                <TBODY>
								<!--- RecordList Field --->
                                <TR class=heading2>
									<TD class=heading2 noWrap align=center width="5%">No.</TD>
								<?
									for($i=1;$i<=listLen($record_col);$i++){
										$cols = listgetAt($record_col,$i);
										if(listLen($cols,"|")>1){
											$head_cols = listgetAt($cols,1,"|");
											$width_cols = listgetAt($cols,2,"|");
										}else{
											$head_cols = $cols;
											$width_cols = 0;
										}
										$field_col = listgetAt($record_coltype,$i);
										if(substr($field_col, 0,1)=='^'){
											$field_col = substr($field_col,1,strlen($field_col));
										}
								?>
									<TD class=heading2 noWrap align=center height=25 <?if($width_cols <> 0){echo " width=\"".$width_cols."\"";}?>><?=$head_cols?>
									<?
									if(ListFind($record_sortby,$field_col)){
										echo "  <input type=image src='".$ANOM_VARS["www_url"]."images/up.gif' onclick=\"location='".getenv("SCRIPT_NAME")."?";
										if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}
										echo "record_id=". uriParam("record_id")."&sortby=".$field_col."&orderby=asc';\" border=0>";
										
										echo "  <input type=image src='". $ANOM_VARS["www_url"]."images/dn.gif' onclick=\"location='".getenv("SCRIPT_NAME")."?";
										if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}
										echo "record_id=". uriParam("record_id")."&sortby=".$field_col."&orderby=desc';\" border=0>";
									}
									?>
									</TD>
								
								<?
									}
								?>
	                               
	                           </TR>
								
								<!--- RecordList Field --->
                                <TR>
								<!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
                                <TD class=heading2 colSpan=<?=listLen($record_col)+1?>>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                                <TR>
                                <TD style="HEIGHT: 1px">
									<IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width="100%"></TD></TR>
                                <TR>
                                <TD style="HEIGHT: 1px">
									<IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width="100%"></TD></TR></TBODY></TABLE></TD></TR>
									
									<?
										//jika mau buat form Create Component Baru
										if(isset($_GET["create"])){
									?>
										<form name="frmnew" action="<?=getenv("SCRIPT_NAME")?>?<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>record_id=<?=uriParam("record_id")?>&save=yes" method="post">
											<tr class="tablebodyeven">
													<td align='left' colspan="<?=listLen($record_col)+1?>" valign="top">
														<!--- Start Form New --->
												    	<table border="0" width="100%" cellspacing="0" cellpadding="2">
														
																<tr>
																    <?
																	$jml_tgl1 = ListValueCount($record_fieldtype,"datetime","|");
																	$jml_tgl2 = ListValueCount($record_fieldtype,"date","|");
																	$jml_tgl=$jml_tgl1+$jml_tgl2;
																	
																	for($i=1;$i<=listLen($record_fieldtype,"#");$i++){
																		$strfield = listgetAt($record_fieldtype,$i,"#");
																		if(listLen($strfield,"|")==4){
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = listgetAt($strfield,2,"|");
																			$strfield_width = listgetAt($strfield,3,"|");
																			if(listlen(listgetAt($strfield,4,"|"),"^") > 1){
																				$strfield_form = listGetAt(listgetAt($strfield,4,"|"),1,"^");
																				$strfield_sql = listGetAt(listgetAt($strfield,4,"|"),2,"^");
																			}else{
																				$strfield_form = listGetAt(listgetAt($strfield,4,"|"),1,"^");
																				$strfield_sql = "";
																			}
																			
																		}elseif(listLen($strfield,"|")==3){
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = listgetAt($strfield,2,"|");
																			$strfield_width = listgetAt($strfield,3,"|");
																			$strfield_form = "text";
																			$strfield_sql = "";
																			
																		}elseif(listLen($strfield,"|")==2){
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = listgetAt($strfield,2,"|");
																			$strfield_width = 50;
																			$strfield_form = "text";
																			$strfield_sql = "";
																		}else{
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = "text";
																			$strfield_width = 50;
																			$strfield_form = "text";
																			$strfield_sql = "";
																		}
																		if(listLen($record_fieldform)){
																		  	$alias_name = listgetAt($record_fieldform,$i,"|");
																		 }else{
																		  	$alias_name = $strfield_name;
																		 }
																	  
																	  if(listLen($strfield_name,"~")>1){
																			$strfield_name = listGetAt($strfield_name,1,"~");
																			$insert_new = "yes";
																	   }else{
																	   		$insert_new="";
																	   }
																	  echo "<td align=\"right\" width=\"30%\" valign=\"top\">". $alias_name."&nbsp;&nbsp;&nbsp;</td>";
																	  echo "<td valign=\"top\">";
																	  switch ($strfield_form) { 
																	   case "textarea": 
																	       echo "<textarea name=\"".$strfield_name."\" rows=\"5\" cols=\"50\"></textarea>";
																	       break 1;  
																		   
																	   case "select": 
																	   	   $select_db = cmsDB();
																		   $strsql = $strfield_sql;
																		   $select_db->query($strsql);
																		   
																		   echo "<select name=\"".$strfield_name."\">";
																		   while($select_db->next()){
																		   			echo "<option value='". $select_db->row("id") ."'>". $select_db->row("name") ."</option>";
																		   }
																		   echo "</select>";
																		   if($insert_new=="yes"){
																		   		echo "<input type=\"Text\" name=\"".$strfield_name."_2\" size=\"5\" value=\"".$function_db->row($strfield_name)."\">";
																		   		$insert_new="";
																		   }
																		   break 1;
																		   
																	   case "text": 
																	       echo "<input type=\"Text\" name=\"".$strfield_name."\" size=\"50\">";
																	       break 1;  
																		   
																	   case "datetime": 
																	       echo "<input id=\"InDate".$jml_tgl."\" type=\"text\" name=\"".$strfield_name."\" size=\"10\" read-only value=\"".date("d/m/Y")."\">";
																		   echo ShowCalendar($jml_tgl);
																		   $jml_tgl--;
																	       break 1;
																		     
																	   case "date": 
																	       echo "<input id=\"InDate".$jml_tgl."\" type=\"text\" name=\"".$strfield_name."\" size=\"10\" read-only value=\"".date("d/m/Y")."\">";
																		   echo ShowCalendar($jml_tgl);
																		   $jml_tgl--;
																	       break 1;
																		
																	   case "password": 
																	       echo "<input type=\"password\" name=\"".$strfield_name."\" size=\"10\" value=\"\">";
																	       break 1;  
																		   
																       case "chkbox": 
																	       echo "<input type=\"Checkbox\" name=\"".$strfield_name."\" size=\"10\" value=\"".$strfield_sql."\">";
																	       break 1;  
																		   
																	   default: 
																   		   echo "<input type=\"Text\" name=\"".$strfield_name."\" size=\"20\">";
																	       break; 
																	   } 
																	?>
																	</td>
																    
																  </tr>
															<?}?>
															 <tr></tr><td valign=top colspan="2" align="center">
																	<input type="Submit" name="submit" value="Save">&nbsp;
																	<input type="button" name="cancel" value="Back" onclick="location='<?=getenv("SCRIPT_NAME")?>?<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>record_id=<?=uriParam("record_id")?>&refresh=<?=urlencode(date("m d Y h m s"))?>';"> 
															 </td></tr>
														</table>
														
															
														

														<!--- End OF Form New --->
													</td>
											</tr>
										</form>
									<?}?>
									<?
									$class = 1;
									while ($function_db->next()) {?>
										<?if(isset($_GET["edit"]) && $_GET[$record_primary]==$function_db->row($record_primary)){?>
											<form name="frmnew" action="<?=getenv("SCRIPT_NAME")?>?<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>update=yes&record_id=<?=$record_id?>&<?=$record_primary?>=<?=$function_db->row($record_primary)?>&refresh=<?=urlencode("Y m d h:m:s")?>" method="post">
												<tr class="<?if($class==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>">
														<td align='right' valign="top"><?=$no?>.</td>
														<td align='left' colspan="<?=listLen($record_col)+1?>" valign="top">
															<!--- Start Form Edit --->
														<table border="0" width="100%" cellspacing="0" cellpadding="2">
														
																<tr>
																    <?
																	$jml_tgl1 = ListValueCount($record_fieldtype,"datetime","|");
																	$jml_tgl2 = ListValueCount($record_fieldtype,"date","|");
																	$jml_tgl=$jml_tgl1+$jml_tgl2;
																	for($i=1;$i<=listLen($record_fieldtype,"#");$i++){
																		$strfield = listgetAt($record_fieldtype,$i,"#");
																		if(listLen($strfield,"|")==4){
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = listgetAt($strfield,2,"|");
																			$strfield_width = listgetAt($strfield,3,"|");
																			if(listlen(listgetAt($strfield,4,"|"),"^") > 1){
																				$strfield_form = listGetAt(listgetAt($strfield,4,"|"),1,"^");
																				$strfield_sql = listGetAt(listgetAt($strfield,4,"|"),2,"^");
																			}else{
																				$strfield_form = listGetAt(listgetAt($strfield,4,"|"),1,"^");
																				$strfield_sql = "";
																			}
																			
																		}elseif(listLen($strfield,"|")==3){
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = listgetAt($strfield,2,"|");
																			$strfield_width = listgetAt($strfield,3,"|");
																			$strfield_form = "text";
																			$strfield_sql = "";
																			
																		}elseif(listLen($strfield,"|")==2){
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = listgetAt($strfield,2,"|");
																			$strfield_width = 50;
																			$strfield_form = "text";
																			$strfield_sql = "";
																		}else{
																			$strfield_name = listgetAt($strfield,1,"|");
																			$strfield_type = "text";
																			$strfield_width = 50;
																			$strfield_form = "text";
																			$strfield_sql = "";
																		}
																	if(listLen($record_fieldform)){
																		  	$alias_name = listgetAt($record_fieldform,$i,"|");
																		 }else{
																		  	$alias_name = $strfield_name;
																		 }
																	  if(listLen($strfield_name,"~")>1){
																			$strfield_name = listGetAt($strfield_name,1,"~");
																			$insert_new = "yes";
																	   }else{
																	   		$insert_new="";
																	   }
																	  echo "<td align=\"right\" width=\"30%\" valign=\"top\">". $alias_name."&nbsp;&nbsp;&nbsp;</td>";
																	  echo "<td valign=\"top\">";
																	   switch ($strfield_form) { 
																	   case "textarea": 
																	       echo "<textarea name=\"".$strfield_name."\" rows=\"5\" cols=\"50\">".$function_db->row($strfield_name)."</textarea>";
																	       break 1;  
																		   
																	   case "select": 
																	   	   $select_db = cmsDB();
																		   $strsql = $strfield_sql;
																		   $select_db->query($strsql);
																		   
																		   echo "<select name=\"".$strfield_name."\">";
																		   		echo "<option value=\"\">Select</option>";
																		   while($select_db->next()){
																		   		echo "<option value='". $select_db->row("id") ."'";
																				if($select_db->row("id")==$function_db->row($strfield_name)){
																					echo " selected";
																				}
																				echo ">". $select_db->row("name") ."</option>";
																		   }
																		   echo "</select>";
																		   if($insert_new=="yes"){
																		   		echo "<input type=\"Text\" name=\"".$strfield_name."_2\" size=\"5\" value=\"".$function_db->row($strfield_name)."\">";
																		   }
																		   $insert_new="";
																	       break 1;
																		   
																	   case "text": 
																	       echo "<input type=\"Text\" name=\"".$strfield_name."\" size=\"50\" value=\"".$function_db->row($strfield_name)."\">";
																	       break 1;  
																		   
																	   case "datetime": 
																	   	   if(strlen($function_db->row($strfield_name))){
																		   		$date_nih = $function_db->row($strfield_name);
																		   }else{
																		   		$date_nih = "";
																		   }
																	       echo "<input id=\"InDate".$jml_tgl."\" type=\"text\" name=\"".$strfield_name."\" size=\"10\" read-only value=\"".datesql2date($date_nih)."\">";
																		   echo ShowCalendar($jml_tgl);
																		   $jml_tgl--;
																	       break 1;  
																	
																	   case "date": 
																	   	   if(strlen($function_db->row($strfield_name))){
																		   		$date_nih = $function_db->row($strfield_name);
																		   }else{
																		   		$date_nih = "";
																		   }
																	       echo "<input id=\"InDate".$jml_tgl."\" type=\"text\" name=\"".$strfield_name."\" size=\"10\" read-only value=\"".datesql2date($date_nih)."\">";
																		   echo ShowCalendar($jml_tgl);
																		   $jml_tgl--;
																	       break 1;
																	   	   
																	   case "password": 
																	       echo "<input type=\"password\" name=\"".$strfield_name."\" size=\"10\" value=\"\">";
																	       break 1;  
																		   
																       case "chkbox":
																	   		if(strtolower(trim($function_db->row($strfield_name))) == strtolower(trim($strfield_sql))){
																		   		$check = " checked";
																		   }else{ 
																		   		$check = ""; 
																		   }
																	       echo "<input type=\"Checkbox\" name=\"".$strfield_name."\" size=\"10\" value=\"".$strfield_sql."\"".$check.">";
																	       break 1;  
																		   
																	   default: 
																   		   echo "<input type=\"Text\" name=\"".$strfield_name."\" size=\"20\">";
																	       break; 
																	   } 

																	?>
																	</td>
																    
																  </tr>
															<?}?>
															 <tr></tr><td valign=top colspan="2" align="center">
																	<input type="Submit" name="submit" value="Update">&nbsp;
																	<input type="button" name="delete" value="Delete" onclick="location='<?=getenv("SCRIPT_NAME")?>?<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>record_id=<?=uriParam("record_id")?>&<?=$record_primary?>=<?=$function_db->row($record_primary)?>&delete=yes&refresh=<?=urlencode(date("m d Y h m s"))?>';">&nbsp;
																	<input type="button" name="cancel" value="Back" onclick="location='<?=getenv("SCRIPT_NAME")?>?<?if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}?>record_id=<?=uriParam("record_id")?><?if(isset($_GET["selpage"])){ echo "&selpage=".$_GET["selpage"]; }?>&refresh=<?=urlencode(date("m d Y h m s"))?>';"> 
															 </td></tr>
														</table>
															
	
															<!--- End OF Form New --->
														</td>
												</tr>
											</form>
											
										<?}else{?>
											<tr class="<?if($class==1){echo "tablebodyodd";}else{echo "tablebodyeven";}?>">
												<td align='right' valign="top"><?=$no?>.</td>
												<?
													for($i=1;$i<=listLen($record_coltype);$i++){
														$cols = listgetAt($record_coltype,$i);
														if(listLen($cols,"|")>1){
															$cf_name = listgetAt($cols,1,"|");
															$cf_type = listgetAt($cols,2,"|");
														}else{
															$cf_name = $cols;
															$cf_type = "text";
														}
														echo "<td align=\"left\" valign=\"top\">";
														$href = "no";
														if(substr($cf_name, 0,1)=='^'){
															$href="yes";
															$cf_name = substr($cf_name, 1,strlen($cf_name));
															echo "<a href='".getenv("SCRIPT_NAME")."?";
															if(isset($_GET["url_id"])){echo "url_id=" . $_GET["url_id"] . "&";}
															echo "record_id=".$record_id."&edit=yes&".$record_primary."=".$function_db->row($record_primary);
															if(isset($_GET["selpage"])){
																echo "&selpage=". $_GET["selpage"];
															}
															echo "' style=\"text-decoration:none\">";
														}
														echo $function_db->row($cf_name);
														if($href=="yes"){
															echo "</a>";
														}
														echo "</td>";
													}
												?>
													
													<!--- <td align='center' valign="top"><a href="<?=getenv("SCRIPT_NAME")?>?edit=yes&function_id=<?=$function_db->row("function_id")?>" style="text-decoration:none;"><?=$function_db->row("function_code")?></a></td> --->
													
											</tr>
										<?}?>
									<?
									$class=$class*-1;
									$no++;
									}?>
									
									
								<!--- End Of Record --->
                                <TR>
								<!--- Rubah Colspan Sebanyak Field yg ditampilkan --->
                                <TD class=tablefooter align=middle colSpan=<?=listLen($record_col)+1?>>
								<input type="hidden" name="FILECOUNT" value="1">
                                <TABLE cellSpacing=1 cellPadding=1 width="100%" 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD class=tablefooter align=left width="100%">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD style="HEIGHT: 1px" colSpan=2><IMG height=1 
                                src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width="100%" 
                                name=agif></TD>
                                <TD height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width=1 
                                name=zgif></TD></TR>
                                <TR>
                                <TD height=23><IMG height="100%" src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width=1 name=agif2></TD>
                                                                <TD class=formtext vAlign=center noWrap 
                                align=left 
                                width="100%">&nbsp;&nbsp;</TD>
                                                              </TR>
                                <TR>
                                <TD style="HEIGHT: 1px" colSpan=3><IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width="100%" name=zgif2></TD></TR></TBODY></TABLE></TD>
                                <TD class=tablefooter vAlign=center noWrap 
                                align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 width=120 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD style="HEIGHT: 1px" colSpan=2><IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width="100%" name=agif></TD>
                                <TD height=23 rowSpan=2><IMG height="100%" src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width=1 name=zgif></TD></TR>
                                <TR>
                                <TD height=23><IMG height="100%" src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width=1 name=agif2></TD>
                                <TD vAlign=center noWrap align=middle width=120>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD class=tablefooter vAlign=center noWrap 
                                align=middle>
									&nbsp;
                                </TD></TR></TBODY></TABLE></TD></TR>
                                <TR>
                                <TD style="HEIGHT: 1px" colSpan=3>
									<IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width="100%" name=zgif2></TD></TR></TBODY></TABLE></TD>
                                <TD class=tablefooter vAlign=center noWrap align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 width=120 border=0>
                                <TBODY>
                                <TR>
                                <TD style="HEIGHT: 1px" colSpan=2>
									<IMG height=1 src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width="100%" name=agif></TD>
                                <TD height=23 rowSpan=2><IMG height="100%" 
                                src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width=1 
                                name=zgif></TD></TR>
                                <TR>
                                <TD height=23><IMG height="100%" src="<?=$ANOM_VARS["www_url"]?>images/spots.gif" width=1 name=agif2></TD>
                                <TD vAlign=center noWrap align=middle width=120>
								<form name="frmpage" method="get" action="<?=getenv("SCRIPT_NAME")?>">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>
                                <TBODY>
								<!--- Page Counter --->
                                <TR>
                                <TD class=tablefooter noWrap>&nbsp;</TD>
                                <TD class=tablefooter noWrap>
								<?if(isset($_GET["url_id"])){?>
								<input type="Hidden" name="url_id" value="<?=$_GET["url_id"]?>">
								<?}?>
								<input type="Hidden" name="record_id" value="<?=$record_id?>">
								&nbsp;Page :&nbsp;<select name="selpage" onchange="document.frmpage.submit()">
								<?
										for($page=1;$page<=$record_page;$page++){
											echo "<option value=\"". $page ."\"";
											if(isset($_GET["selpage"]) && $_GET["selpage"] == $page){
												echo " selected";
											}
											echo ">". $page."</option>".chr(13);
										}
								?>
								</select>
								
                                </TD>
                                <TD class=tablefooter noWrap></TD></TR></TBODY></TABLE></TD></TR>
                                <TR>
								<!--- End Of Page Counter --->
								</form>
                                <TD style="HEIGHT: 1px" colSpan=3><IMG height=1 
                                src="<?=$ANOM_VARS["www_url"]?>images/spotw.gif" width="100%" 
                                name=zgif2></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></FORM>
                        
                       
                      </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    </TR></TBODY></TABLE>
</body>
<?
}
?>