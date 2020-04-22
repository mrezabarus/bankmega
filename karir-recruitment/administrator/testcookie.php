<?
	if(!isset($_GET["GETCOOKIE"])){
		setcookie("id","",time() - 3600);
		setcookie("id",22);
		echo "<script>location='testcookie.php?GETCOOKIE=YES&refresh=".md5(date('m/d/y,h:m:s'))."';</script>";
	}else{
		echo $_COOKIE["id"];
	}
	//echo $_COOKIE["id"];
	
	
?>