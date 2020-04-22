<?
	require_once("../../config.php");
	if(isset($_POST["save"])){
			$vacant=cmsDB();
			$vacant->query("select year_date from tbl_region_mpp where hacc_id=".postParam("selhcc"));
			$vacant->next();
			$year_date = $vacant->row("year_date");
			$strsql = "insert into tbl_branch_mpp_apply(position_id,hacc_id,mpp_requirement,qty,qty_tmp,qty_test,branch_id,gol_id,month_dateline,user_id,
			                                            grouptest_id,formula,position_status,request_status,apply_date,employee_status) 
					   values(".postParam("selposition").",".postParam("selhcc").",'".postParam("txtreq")."',".postParam("txtqty").",".postParam("txtqty").",
					          ".postParam("txtqty").",".postParam("selbranch").",".postParam("selgol").",".postParam("txtdateline").",
							  ".$_SESSION["user_id" . date("mdY")].",".postParam("seltest").",'".postParam("txttestformula")."','".postParam("selstatus")."',
							  'new','".date("Y-m-d H:i:s")."','".postParam("selemp_status")."')";
			$vacant->query($strsql);
			$mpppos_id = $vacant->lastInsertID("mpppos_id");
			$vacant->query("insert into tbl_position_vacant(pos_desc,pos_sdate,pos_edate,mpppos_id) 
			                values('".postParam("txtreq")."','".date("Y-m-d H:i:s")."',
							       '".$year_date."-".postParam("txtdateline")."-".date("d H:i:s")."',".$mpppos_id.")");
			$vacant->query("update tbl_region_mpp set hacc_val_apply=hacc_val_apply+".postParam("txtqty")." where hacc_id=". postParam("selhcc"));
			header("Location: index.php"); 	
			die();
			//echo $strsql;die();
	}
?>
<BR>
<center>
	 <form action="" method="post" name="sample_form" id="sample_form">
<table class="heading2" cellSpacing="0" cellPadding="2" width="50%" align="center" border="0">
                     
                     <tr>
                       <td class="tableheader">
                         <table cellSpacing="0" cellPadding="0" width="100%" border="0">
                           
                           <tr>
                            <td class=tableheader>&nbsp;New Vacancy</td>
                           </tr>
			</table>		</td>
	  </tr>
                     <tr>
                       <td>
                         <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR>
                      </TABLE>
                      </TD>
	</TR> 
	 <tr><td colspan="3"><table>
       <?
	   $cekregion = cmsDB();
	   $cekregion->query("select distinct(region_id) from tbl_branch where branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")");
	   $lstregion = $cekregion->valueList("region_id");
	   if(listLen($lstregion)==0){
	   		$lstregion=0;
	   }
	if(isset($_GET["selregion"])){
		$selcomp = $_GET["selregion"];
	}else{
		$selcomp = 0;
	}
	$region=cmsDB();
	$region->query("select * from tbl_region where region_id in (".$lstregion.")");
	?>
       <tr>
         <td valign="top" align="right" width="36%"><b>Region</b></td>
         <td valign="top" align="right" width="2%"><b>:</b></td>
         <td valign="top" width="62%"><select size="1" name="selregion" onchange="_selsubmit('sample_form.selregion','<?=$_SERVER["SCRIPT_NAME"]?>?','selregion');">
             <option value="0">Select Region</option>
             <?
				$firstcomp=0;
				while($region->next()){?>
             <option value="<?=$region->row("region_id")?>"<? if($selcomp==$region->row("region_id")){ echo " selected";}?>>
               <?=$region->row("region_name")?>
               </option>
             <? } ?>
         </select></td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Cabang/Capem</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top">
		 <?
				if(isset($_GET["selregion"])){
						$branch_name=cmsDB();
						$strsql ="select * from tbl_branch where region_id=".$_GET["selregion"]." and branch_id in (".$_SESSION["ssbranch_id" . date("mdY")].")";
						$branch_name->query($strsql);
						//echo $selbranch;
						$selbranch = $_GET["selbranch"];
						?>
             <select size="1" name="selbranch" onchange="_selsubmit('sample_form.selbranch','<?=$_SERVER["SCRIPT_NAME"].'?selregion='.$selcomp; ?>','selbranch');">
               <?
				if($branch_name->recordCount()){
				  while($branch_name->next()){?>
					<option value="<?=$branch_name->row("branch_id")?>" <?if($selbranch==$branch_name->row("branch_id")){ echo " selected";}?>>
					 <?=$branch_name->row("branch_name")?>
					 </option>
               <? } ?>
               <? }else{ ?>
               <option value="0">No Branch Found</option>
               <? } ?>
             </select>
             <? }else{ ?>
             <input type="hidden" name="selbranchkosong" value="0" />
           Select Region First
           <? } ?>
         </td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>MPP Year</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><?
				if(isset($_GET["selregion"])){
					$mpp=cmsDB();
					$mpp->query("select * from tbl_region_mpp where region_id=".$_GET["selregion"]);
					?>
             <select name="selhcc">
               <? if($mpp->recordCount()){
							  while($mpp->next()){?>
               <option value="<?=$mpp->row("hacc_id")?>">
                 <?=$mpp->row("year_date")?>
                 </option>
               <? } ?>
               <? }else{ ?>
               <option value="0">No MPP Found</option>
               <? } ?>
             </select>
             <? }else{ ?>
             <input type="hidden" name="selhcc" value="0" />
           Select Region First
           <? } ?>
         </td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Position</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><?
		 if(isset($_GET["selbranch"])){
		$position=cmsDB();
		$position->query("select tbl_position.* from tbl_position inner join tbl_branch_mpp_apply
				on tbl_position.position_id=tbl_branch_mpp_apply.position_id
				where tbl_branch_mpp_apply.branch_id = ".$_GET["selbranch"]);		
		?>
             <select size="1" name="selposition">
               <? while($position->next()){ ?>
               <option value="<?=$position->row("position_id")?>">
                 <?=$position->row("position_name")?>
                 </option>
               <? } ?>
           </select>
		   <? }else{ ?>
             <input type="hidden" name="selhcc" value="0" />
           Select Region First
           <? } ?>
		 </td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Grade</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><?
		$golongan=cmsDB();
		$golongan->query("select * from tbl_golongan order by gol_id");
	?>
             <select size="1" name="selgol">
               <? while($golongan->next()){ ?>
               <option value="<?=$golongan->row("gol_id")?>">
                 <?=$golongan->row("name") ?>
                 </option>
               <? } ?>
           </select></td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Month Dateline</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><select name="txtdateline">
             <option value="1">January</option>
             <option value="2">February</option>
             <option value="3">March</option>
             <option value="4">April</option>
             <option value="5">May</option>
             <option value="6">June</option>
             <option value="7">July</option>
             <option value="8">August</option>
             <option value="9">September</option>
             <option value="10">October</option>
             <option value="11">November</option>
             <option value="12">December</option>
         </select></td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Requirement Description</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><textarea name="txtreq" rows="4" cols="46"></textarea></td>
       </tr>
       <input type="hidden" name="seltest" value="0" />
       <input type="hidden" name="txttestformula" value="" />
       <tr>
         <td align="right" valign="top"><b>Vacant Qty</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><input size="8" name="txtqty" value="0" onKeyPress="return handleEnter(this, event, 6)" />
           person(s)</td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Request Status</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><select size="1" name="selstatus">
             <option value="new hire" selected="selected">New Hire</option>
             <option value="rehire">ReHire</option>
             <option value="replacement">Replacement</option>
         </select></td>
       </tr>
       <tr>
         <td align="right" valign="top"><b>Employee Status</b></td>
         <td align="right" valign="top"><b>:</b></td>
         <td valign="top"><select size="1" name="selemp_status">
             <option value="permanent" selected="selected">Permanent</option>
             <option value="contract">Contract</option>
             <option value="contract1">Contract1</option>
             <option value="outsource">Outsource</option>
             <option value="probation">probation</option>
         </select></td>
       </tr>	   
     </table></td></tr>
	 <tr>
	   <td>
                         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spots.gif" 
                           width="100%"></TD></TR>
                           <TR>
                           <TD style="HEIGHT: 1px"><IMG height=1 
                           src="<?=$ANOM_VARS["www_img_url"]?>spotw.gif" 
                           width="100%"></TD></TR>
                      </TABLE>
       </td>
      </tr>
<tr>
         <td colspan="3"align="right"><input type="button" value="Save" onclick="post_method('<?=$_SERVER["SCRIPT_NAME"]?>','sample_form.selregion,sample_form.selbranch,sample_form.selhcc,sample_form.selposition,sample_form.selgol,sample_form.txtdateline,sample_form.txtreq,sample_form.seltest,sample_form.txttestformula,sample_form.txtqty,sample_form.selstatus,sample_form.selemp_status','save=yes&amp;refresh=<?=md5("mdYHis")?>')" />
           &nbsp;
           <input type="button" value="Cancel" onclick="get_method('templates/vacancy/index.php')" /></td>
	     </tr></table>
</form>
</center>