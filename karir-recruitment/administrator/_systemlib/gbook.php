<?
function gbook($id){
	global $_GET;
	global $_POST;
	global $FJR_VARS;
  
	$mega_db = cmsDB();
				
	if (isset($_GET["cat"])){
		 if($_GET["cat"] = "gbookprocess") {
			 $Sql = "insert into db_mega.tguestbook(name,address,comment,Code_ID)";
	 		 $Sql = $Sql . " values('" . $_POST['txtname'] . "','" . $_POST['txtaddress'] ."','" . $_POST['txtcomment'] . "',".$_GET["gb_id"].")";
 	 		 //echo $Sql;
 	 		$mega_db->query($Sql);
	 	}
		
	}
	$pgid = uriParam("pgid","");
	echo "<form name='frmgbook' action='".getenv('SCRIPT_NAME')."?pgid=".$pgid."&gb_id=".$id."&cat=gbookprocess&EncryptURL=".urlencode(date('m/d/y,h:m:s'))."' method='post'>";
        echo "<table border='0' width='100%' cellspacing='0' cellpadding='2'>";
         echo "<tr>";
        echo "<td colspan='4'>";
        echo "<table border='0' width='100%' cellspacing='0' cellpadding='2'>";
        
        echo "<tr>";
        echo "<td width='6%'></td>";
        echo "<td width='22%' valign='top'><b><font size='1' face='verdana' >Name&nbsp;</font></b></td>";
        echo "<td width='7%' valign='top'><b><font size='1' face='verdana'>:</font></b></td>";
        echo "<td width='106%' valign='top'><input type='text' name='txtname' size='39' style='font-family: verdana; font-size: 11px'></td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td width='6%' valign='top'><font size='1' face='verdana' ><b>&nbsp;</b></font></td>";
        echo "<td width='22%' valign='top'><b><font size='1' face='verdana'>Address&nbsp;</font></b></td>";
        echo "<td width='7%' valign='top'><b><font size='1' face='verdana'>:</font></b></td>";
        echo "<td width='106%' valign='top'><input type='text' name='txtaddress' size='39' style='font-family: verdana; font-size: 11px'></td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td width='6%' valign='top'><font size='1' face='verdana'><b>&nbsp;</b></font></td>";
        echo "<td width='22%' valign='top'><b><font size='1' face='verdana' >Comments&nbsp;</font></b></td>";
        echo "<td width='7%' valign='top'><b><font size='1' face='verdana' >:</font></b></td>";
        echo "<td width='106%' valign='top'><textarea rows='5' name='txtcomment' cols='41' style='font-family: verdana; font-size: 11px'></textarea></td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td width='6%'>&nbsp;</td>";
        echo "<td width='22%'></td>";
        echo "<td width='7%'></td>";
        echo "<td width='106%'></td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td width='6%'>&nbsp;</td>";
        echo "<td width='22%'></td>";
        echo "<td width='7%'></td>";
        echo "<td width='106%'><input type='submit' value='  Save  ' name='B1' style='font-family: verdana; font-size: 11px'>&nbsp;";
          echo "<input type='reset' value='Cancel' name='B1' style='font-family: verdana; font-size: 11px'></td>";
      echo "</tr>";
        
        echo "</table>";
        echo "</td></tr>";
        
    echo "</table>";
    echo "</form>";
}
function gbooklist($id){
		$mega_db = cmsDB(); 
		$mega_db = cmsDB();
	 	$Sql_Statement = "select * from db_mega.tguestbook where Code_ID=" . $id;
  		$mega_db->query($Sql_Statement);
?>
                      <table border="0" width="100%" cellpadding="3" cellspacing="1">
						<?php
							$No = 0;
						  while ($mega_db->next()) {
						  $No = $No + 1;
						 ?>
						 
                        <tr>
                          <td bgcolor="#DEDEDE" width="10%" align="right"><font size='1' face="verdana"><b><?echo $No?>.</b></font></td>
                          <td bgcolor="#DEDEDE" width="34%"><font size='1' face="verdana"><b>Name</b></font></td>
                          <td bgcolor="#DEDEDE" width="112%"><font size='1' face="verdana"><b><?
						  if (strlen(trim($mega_db->row("name"))) == 0):
								echo "-";						  	
						  else:
							  echo $mega_db->row("name");
						  endif;?></b></font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#DEDEDE" width="10%">&nbsp;</td>
                          <td bgcolor="#DEDEDE" width="34%"><font size='1' face="verdana"><b>Address</b></font></td>
                          <td bgcolor="#DEDEDE" width="112%"><font size='1' face="verdana"><b><?
						  if (strlen(trim($mega_db->row("address"))) == 0):
								echo "-";						  	
						  else:
							  echo $Row["address"];
						  endif;?></b>.</font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#DEDEDE" width="10%">&nbsp;</td>
                          <td bgcolor="#DEDEDE" width="34%"><font size='1' face="verdana"><b>Comment</b></font></td>
                          <td bgcolor="#DEDEDE" width="112%"><font size='1' face="verdana"><b><?
						  if (strlen(trim($mega_db->row("comment"))) == 0):
								echo "-";						  	
						  else:
							  echo $mega_db->row("comment");
						  endif;?></b></font></td>
                        </tr>
                        <tr>
                          <td width="10%">&nbsp;</td>
                          <td width="34%">&nbsp;</td>
                          <td width="112%">&nbsp;</td>
                        </tr>
						<?} ?>
                      </table>
<?
}
?>
               