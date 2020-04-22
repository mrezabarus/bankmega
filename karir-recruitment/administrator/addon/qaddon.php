<?require_once("../config.inc.php");?>

<?php
$uploaddir = $FJR_VARS["addon_path"]; 
//if(!empty($myimage_name)) 
 //{ 
	
  if ($_GET["txtaction"] == 'new'):
  	$dirpath = $uploaddir.trim($_POST["txtfoldername"]);
	//echo $dirpath;
  	if(mkdir($dirpath,0777))
	{
			if (is_uploaded_file($_FILES['txtfilename']['tmp_name'])) {
			    copy($_FILES['txtfilename']['tmp_name'], $dirpath."/".$_FILES['txtfilename']['name']);
				$Sql_Insert = "insert into taddonmodule(addon_name,addon_desc,addon_syntax,addon_adminurl,addon_filename,addon_foldername) values('".$_POST["txtname"]."','".$_POST["txtdesc"]."','".$_POST["txtsyntax"]."','".$_POST["txtadminurl"]."','".$_FILES["txtfilename"]["name"]."','".$_POST["txtfoldername"]."')";
				$mega_db->query($Sql_Insert);
			} 
			else 
			{
				$Sql_Insert = "insert into taddonmodule(addon_name,addon_desc,addon_syntax,addon_adminurl,addon_filename,addon_foldername) values('".$_POST["txtname"]."','".$_POST["txtdesc"]."','".$_POST["txtsyntax"]."','".$_POST["txtadminurl"]."','','".$_POST["txtfoldername"]."')";
				$mega_db->query($Sql_Insert);
				echo "<script>alert('Confirmation !!, Permission to create file Denied OR file name is null!!');history.back();</script>"; 
			}
	}
	else{
		echo "<script>alert('Confirmation Creating Folder Denied !!');history.back();</script>"; 
	}
  elseif ($_GET["txtaction"] == 'edit'):
  	  	$dirpath = $uploaddir.trim($_POST["txtfoldername"]);
		if(is_dir($dirpath))
		{
			if (is_uploaded_file($_FILES['txtfilename']['tmp_name'])) {
				copy($_FILES['txtfilename']['tmp_name'], $dirpath."/".$_FILES['txtfilename']['name']);
				$Sql_Update = "update taddonmodule set addon_name='".$_POST["txtname"]."',addon_desc='".$_POST["txtdesc"]."',addon_syntax='".$_POST["txtsyntax"]."',addon_adminurl='".$_POST["txtadminurl"]."',addon_filename='".$_FILES["txtfilename"]["name"]."' where addon_id=".$_GET["addon_id"];
				$mega_db->query($Sql_Update);
			}
			else{
				$Sql_Update = "update taddonmodule set addon_name='".$_POST["txtname"]."',addon_desc='".$_POST["txtdesc"]."',addon_syntax='".$_POST["txtsyntax"]."',addon_adminurl='".$_POST["txtadminurl"]."' where addon_id=".$_GET["addon_id"];
				$mega_db->query($Sql_Update);
			}
		}
		else
		{
			mkdir($dirpath,0777);
			if (strlen($_FILES['txtfilename']['tmp_name']) <> 0)
			{
				if(copy($_FILES['txtfilename']['tmp_name'], $dirpath."/".$_FILES['txtfilename']['name'])){
					echo "File Uploaded!";
					$Sql_Update = "update taddonmodule set addon_name='".$_POST["txtname"]."',addon_desc='".$_POST["txtdesc"]."',addon_syntax='".$_POST["txtsyntax"]."',addon_adminurl='".$_POST["txtadminurl"]."',addon_filename='".$_FILES["txtfilename"]["name"]."', addon_foldername='".$_POST["txtfoldername"]."',addon_filename='".$_FILES["txtfilename"]["name"]."' where addon_id=".$_GET["addon_id"];
					$mega_db->query($Sql_Update);
				}
			}
			else
			{
				$Sql_Update = "update taddonmodule set addon_name='".$_POST["txtname"]."',addon_desc='".$_POST["txtdesc"]."',addon_syntax='".$_POST["txtsyntax"]."',addon_adminurl='".$_POST["txtadminurl"]."',addon_filename='".$_FILES["txtfilename"]["name"]."' where addon_id=".$_GET["addon_id"];
				$mega_db->query($Sql_Update);
			}

		}
  elseif ($_GET["txtaction"] == 'delete'):
	  	$Sql_Update = "delete from taddonmodule where addon_id=" . $_GET["addon_id"];
		$mega_db->query($Sql_Update);
  elseif ($_GET["txtaction"] == 'status'):
		$Sql_Status = "update taddonmodule set addon_tatus=0";
		$mega_db->query($Sql_Status);
  endif;
  
?>


<script language="JavaScript">
	parent.nav.location.reload();
	location="index.php?ref=<?=urlencode(date('m/d/y,h:m:s'))?>";
</script>