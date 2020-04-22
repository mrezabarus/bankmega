<?
/*
****************************** Multilanguage Function **************************************************
Steps : 
1 Declare words that You wanna be Displayed on top of Coding
  Syntax : multilanguage([Content seperate by comma (,)],Language_ID);
exp : 
- multilanguage("name,address,telephone",1);
- multilanguage("Description,Alias",2);

2. Call The Word Declared in the body of coding
   Syntax :getword([Word declared]);
exp :
- getword(name);	
- getword(address);	etc...
********************************************************************************************************
*/

function multilanguage($words,$Lang_ID){
	global $retwords;
	global $len_word;
	global $language_array;
	//global $language_array["Word_Text"];
	
	$words_lst = "'" . $words ."'";
	$words_lst = str_replace(",", "','",$words_lst);
	$arrword = split (",", $words);
	  
 	$Sql_Statement = "select LangWord_ID,Word_Text from tlanguage_word where Lang_ID = ".$Lang_ID." and LangWord_ID IN (".strtolower($words_lst) .")";
  $riau_db->query($Sql_Statement);
	$language_array = array("Word_ID" => array(),"Word_Text" => array());
	$len_word=0;
	 while ($riau_db->next()) {
		$language_array["Word_ID"][$len_word] = strtolower($riau_db->row("LangWord_ID"));
		$language_array["Word_Text"][$len_word] = strtolower($riau_db->row("Word_Text"));
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
	else:
		echo "[$word : <b>Untranslated</b>]";
	endif;
}
?>