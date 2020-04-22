<?
function feedback($id)
{
	global $_GET;
	global $_POST;
		
	$MY_HOST = "localhost";
	$MY_UNAME = "";
	$MY_UPASSWORD="";
	
	echo "<script language='JavaScript'>";
	echo "function _popupaction(id)";
	echo "{";
	echo "var windowW=500;";
	echo "var windowH=500;";
	echo "s = 'scrollbars=yes'+',width='+windowW+',height='+windowH;";
	echo "blwindow = window.open('poolresult.php?poll_id='+id,'Popup',s);";
	echo "}";
	echo "</script>";
	
	$DBconnect = mysql_connect($MY_HOST,$MY_UNAME,$MY_UPASSWORD);
	$DB = mysql_select_db("dbriau",$DBconnect);
	
	if (isset($_GET["cat"])){
		 if($_GET["cat"] = "fbprocess") {
			$Sql = "insert into tcontactus(name,address,phone,hp,email,comment,fb_id)";
	 		$Sql = $Sql . " values('" . $_POST['txtname'] . "','" . $_POST['txtaddress'] ."','" . $_POST['txtphone'] ."','". $_POST['txthp'] ."','". $_POST['txtemail'] ."','" . $_POST['txtcomment'] . "',".$_GET["fb_id"].")";
 	 		mysql_query($Sql,$DBconnect);	  
	 		mysql_close($DBconnect);
	 	}
		
	}
	
	echo "<form name='frmfeedback' action='".getenv('SCRIPT_NAME')."?fb_id=".$id."&cat=fbprocess&EncryptURL=".urlencode(date('m/d/y,h:m:s'))."' method='post'>";
        echo "<table border='1' bordercolor='#319AFF' width='100%' cellspacing='0' cellpadding='2'>";
        echo "<tr>";
        echo "<td bgcolor='#319AFF' colspan='4'><font size='2' face='Arial' color='white'><b>Guest Book</b></font></td>";
        echo "</tr>";
          echo "<tr>";
        echo "<td colspan='4'>";
        echo "<table border='0' bordercolor='#319AFF' width='100%' cellspacing='0' cellpadding='2'>";
        echo "<tr>";
        echo "<td width='6%'></td>";
        echo "<td width='22%'><b><font size='2' face='Arial' color='#319AFF'>Name&nbsp;</font></b></td>";
        echo "<td width='7%'><b><font size='2' face='Arial' color='#319AFF'>:</font></b></td>";
        echo "<td width='106%'><input type='text' name='txtname' size='39' style='background-color: #99CCFF; color: #000000; font-family: Arial; font-size: 10pt'></td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td width='6%'><font size='2' face='Arial' color='#319AFF'><b>&nbsp;</b></font></td>";
        echo "<td width='22%'><b><font size='2' face='Arial' color='#319AFF'>Address&nbsp;</font></b></td>";
        echo "<td width='7%'><b><font size='2' face='Arial' color='#319AFF'>:</font></b></td>";
        echo "<td width='106%'><input type='text' name='txtaddress' size='39' style='background-color: #99CCFF; color: #000000; font-family: Arial; font-size: 10pt'></td>";
      echo "</tr>";
       echo "<tr>";
        echo "<td width='6%'><font size='2' face='Arial' color='#319AFF'><b>&nbsp;</b></font></td>";
        echo "<td width='22%'><b><font size='2' face='Arial' color='#319AFF'>Phone&nbsp;</font></b></td>";
        echo "<td width='7%'><b><font size='2' face='Arial' color='#319AFF'>:</font></b></td>";
        echo "<td width='106%'><input type='text' name='txtphone' size='39' style='background-color: #99CCFF; color: #000000; font-family: Arial; font-size: 10pt'></td>";
      echo "</tr>";
       echo "<tr>";
        echo "<td width='6%'><font size='2' face='Arial' color='#319AFF'><b>&nbsp;</b></font></td>";
        echo "<td width='22%'><b><font size='2' face='Arial' color='#319AFF'>HP&nbsp;</font></b></td>";
        echo "<td width='7%'><b><font size='2' face='Arial' color='#319AFF'>:</font></b></td>";
        echo "<td width='106%'><input type='text' name='txthp' size='39' style='background-color: #99CCFF; color: #000000; font-family: Arial; font-size: 10pt'></td>";
      echo "</tr>";
       echo "<tr>";
        echo "<td width='6%'><font size='2' face='Arial' color='#319AFF'><b>&nbsp;</b></font></td>";
        echo "<td width='22%'><b><font size='2' face='Arial' color='#319AFF'>Email&nbsp;</font></b></td>";
        echo "<td width='7%'><b><font size='2' face='Arial' color='#319AFF'>:</font></b></td>";
        echo "<td width='106%'><input type='text' name='txtemail' size='39' style='background-color: #99CCFF; color: #000000; font-family: Arial; font-size: 10pt'></td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td width='6%'><font size='2' face='Arial' color='#319AFF'><b>&nbsp;</b></font></td>";
        echo "<td width='22%'><b><font size='2' face='Arial' color='#319AFF'>Comments&nbsp;</font></b></td>";
        echo "<td width='7%'><b><font size='2' face='Arial' color='#319AFF'>:</font></b></td>";
        echo "<td width='106%'><textarea rows='5' name='txtcomment' cols='41' style='background-color: #99CCFF; color: #000000; font-family: Arial; font-size: 10pt'></textarea></td>";
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
        echo "<td width='106%'><input type='submit' value='  Save  ' name='B1' style='background-color: #319AFF; color: #FFFFFF; font-family: Arial; font-size: 10pt'>";
        echo "<input type='reset' value='Cancel' name='B1' style='background-color: #319AFF; color: #FFFFFF; font-family: Arial; font-size: 10pt'></td>";
    echo "</tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "</table>";
    echo "</form>";
}

feedback(1);
?>
               