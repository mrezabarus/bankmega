<select name="selbranch">`
<?
	require_once("../config.inc.php");

if($_GET['id']){

				if(isset($_GET["id"])){
						$branch_name=cmsDB();
						$strsql ="select * from tbl_branch where region_id='".$_GET['id']."'";
						$branch_name->query($strsql);
						if($branch_name->recordCount()){
							  while($branch_name->next()){?>
          <option value="<?=$branch_name->row("branch_id")?>"><?=$branch_name->row("branch_name")?></option>
          <? } ?>
          <? }else{ ?>
          <option value="0">No Branch Found</option>
          <? } ?>
        
        <? }
}
?>
</select>