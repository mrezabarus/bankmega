<?
function multilanguage($words,$Lang_ID){
	global $retwords;
	global $len_word;
	global $language_array;
	//global $language_array["Word_Text"];
	
	$words_lst = "'" . $words ."'";
	$words_lst = str_replace(",", "','",$words_lst);
	$arrword = split (",", $words);
	$MY_HOST = "localhost";
	$MY_UNAME = "";
	$MY_UPASSWORD="";
	
  	$DBconnect = mysql_connect($MY_HOST,$MY_UNAME,$MY_UPASSWORD);
  	$DB = mysql_select_db("dbriau",$DBconnect);
  
  	$Sql_Statement = "select LangWord_ID,Word_Text from tlanguage_word where Lang_ID = ".$Lang_ID." and LangWord_ID IN (".strtolower($words_lst) .")";
  	$Result_Statement = mysql_query($Sql_Statement,$DBconnect);
	$language_array = array("Word_ID" => array(),"Word_Text" => array());
	$len_word=0;
	 while ($Row = mysql_fetch_array($Result_Statement)) {
		$language_array["Word_ID"][$len_word] = strtolower($Row["LangWord_ID"]);
		$language_array["Word_Text"][$len_word] = strtolower($Row["Word_Text"]);
		$len_word=$len_word+1;
	 }
}
function getword($word){
	global $language_array;
	global $len_word;
	 
	if (in_array(strtolower(trim($word)),$language_array["Word_ID"])):
		for ($i = 0; $i <= $len_word; $i++) {
		    if(trim($language_array["Word_ID"][$i]) == strtolower(trim($word))){
				echo $language_array["Word_Text"][$i];
				break;
			}
		}
	    //print "Ada!!<br />";
    else:
		echo "[$word : <b>Untranslated</b>]";
	endif;
}
multilanguage("name,address,telephone",1);
getword("name");
echo "<br />";
getword("address");
echo "<br />";
getword("telephone");
echo "<br />";
?>