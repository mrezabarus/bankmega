<?php
function polling($id)
{
		global $_GET;
		global $_POST;
		
		$MY_HOST = "localhost";
		$MY_UNAME = "root";
		$MY_UPASSWORD="123456789";
		
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
		$DB = mysql_select_db("db_mega",$DBconnect);
		
		if (isset($_GET["cat"])){
			 if($_GET["cat"] = "pollProcess") {
				if (isset($_POST["chkpoll"])):
					$stQuery = "update tbl_polling_answer set hints = Hints + 1 where Polling_Answer_ID = " . $_POST["chkpoll"];
					mysql_query($stQuery,$DBconnect);
				else:
					echo "<script>alert('Choose Pooling Answer First !!');</script>";
				endif;
			 }
		}
		  
		
		$Sql_Statement = "select * from tbl_polling where Polling_ID =" . $id;
		$Result_Statement = mysql_query($Sql_Statement,$DBconnect);
		//$num_rows = mysql_num_rows($Result_Statement);
		$Row_Statement = mysql_fetch_array($Result_Statement);
		$Active_ID = $Row_Statement["Polling_ID"];
		$Active_Title = $Row_Statement["Polling_Title"];
		$Sql = "select * from tbl_polling_answer where Polling_ID =" . $id;
		$Result = mysql_query($Sql,$DBconnect);
		$num_rows = mysql_num_rows($Result);
		
		echo "<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>";
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "<form name='frmpoll' action='".getenv('SCRIPT_NAME')."?cat=pollProcess&EncryptURL=".urlencode(date('m/d/y,h:m:s'))."' method='post'>";
		echo "<tr><td valign='top'><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='Black'>";
		echo $Active_Title;
		echo "</font><br /><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		while ($Row = mysql_fetch_array($Result)) {
		        echo "<tr><td width='25%' align='center' valign='top'> <font color='#8080FF' size='2'> ";
		        echo "<input type='radio' name='chkpoll' checked value=".$Row['Polling_Answer_ID'].">";
		        echo "</font></td><td width='75%'><font face='Verdana,Tahoma' color='#2E7EC0' size='1'>";
			    echo $Row["Answer_Title"];
				echo "</font></td></tr>";
		}
		echo "<tr><td colspan='2' height='5'></td></tr><tr><td width='25%' align='center'></td><td width='75%'><font color='#8080FF'>";
		echo "<input type='submit' name='Submit' value=':: Vote ::' style='background-color: white; font-family: Verdana; font-size: 8pt'>";
		echo "</font></td></tr><tr><td width='25%' align='center'></td><td width='75%'><b><font size='2' face='Verdana, Arial, Helvetica, sans-serif' color='#F0500F'>";
		echo "<a href='javascript:_popupaction(". $id .")' style='font-family: Verdana; color: #F0500F; font-style: bold; font-size:10'>";
		echo "<b>[Hasil]</b></font></td></tr>";
		echo "</a>";
		echo "</font></b></td></tr></table>";
		echo "</td></tr></form></table></body>";
		mysql_close($DBconnect);
		echo "</html>";
}

polling(1);
?>
