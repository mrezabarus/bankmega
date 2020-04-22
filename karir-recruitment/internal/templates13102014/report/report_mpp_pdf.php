<?
if(isset($_POST["strsql"])){
	require_once("../../config.php");
	require('../../includes/fpdf/fpdf.php');
	require_once("../../includes/ez_sql.php");
	
	class PDF extends FPDF{
	//Load data
		var $js_id;
		
		function Header() {

		}//function Header() 
			
		function Report_Content(){
            $mpp=cmsDB();
			$strsql = postParam("strsql");
			//echo $strsql;die();
              $mpp->query($strsql);
			  $jml_brs = $mpp->recordCount();
			  if($mpp->recordCount()){
					$clas=1;
					$no=1;
					$lstdata = "";
					$mpp_branch=cmsDB();
					while($mpp->next()){
			            $year_date = $mpp->row("year_date");
						$region_name = $mpp->row("region_name");
					    $hacc_val_apply = $mpp->row("hacc_val_apply");
					    $hacc_val_approve = $mpp->row("hacc_val_approve");
					    $user_name = $mpp->row("user_name");
						
						$strsql = "SELECT tbl_branch_mpp_apply.mpppos_id,tbl_branch_mpp_apply.qty,tbl_branch.branch_name,tbl_position.position_name,tbl_golongan.name
			                     FROM tbl_branch_mpp_apply 
								 INNER JOIN tbl_branch on tbl_branch_mpp_apply.branch_id=tbl_branch.branch_id
								 INNER JOIN tbl_position on tbl_position.position_id=tbl_branch_mpp_apply.position_id
								 INNER JOIN tbl_golongan ON tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id
								 WHERE tbl_branch_mpp_apply.hacc_id=".$mpp->row("hacc_id")."";
						$mpp_branch->query($strsql);
				    	$lstmpppos_id = "";
						$lstdetail = "";
						while($mpp_branch->next()){
							$lstmpppos_id = listAppend($lstmpppos_id,$mpp_branch->row("mpppos_id"));
							$lstdetail =  listAppend($lstdetail,"- ".$mpp_branch->row("branch_name")." : ".$mpp_branch->row("qty")." ". $mpp_branch->row("position_name").", Gol : ".$mpp_branch->row("name"),"^");
							/*$branch_name = $mpp_branch->row("branch_name");
							$qty = $mpp_branch->row("qty");
							$position_name = $mpp_branch->row("position_name");*/
						}
						
						if(listLen($lstmpppos_id)==0){
							$lstmpppos_id=0;
						}
						$mpp_branch->query("select vacantpos_id from tbl_position_vacant where mpppos_id in (".$lstmpppos_id.")");
						$lstvacantpos_id = $mpp_branch->valueList("vacantpos_id");
						if(listLen($lstvacantpos_id)==0){
							$lstvacantpos_id=0;
						}
						$mpp_branch->query("select jstest_id from tbl_jobseeker_test where vacant_pos_id in (".$lstvacantpos_id.")");
						$lstjstest_id = $mpp_branch->valueList("jstest_id");
						if(listLen($lstjstest_id)==0){
							$lstjstest_id=0;
						}
						$mpp_branch->query("select tbl_ijin_prinsip.ip_id from tbl_ijin_prinsip inner join tbl_offering_letter on  tbl_ijin_prinsip.ip_id=tbl_offering_letter.ip_id where tbl_offering_letter.is_approved='yes' and tbl_ijin_prinsip.jstest_id in (".$lstjstest_id.")");
						$achieved = $mpp_branch->recordCount();
						
						$lstdata = listAppend($lstdata,$no."|".$year_date."|".$region_name."|".$hacc_val_apply."|".$hacc_val_approve."|".$achieved."|".$lstdetail,"#");
						$no++;
					}
		      }
			//echo $lstdata;die();
			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,"Summary MPP Report List",0,1,'C',0);
				
			$w=array(6,15,40,40,40,40);//180
			$this->SetFont('arial','',8);
			$this->Ln();
			$this->SetFont('arial','B',8);
			$this->Cell($w[0],5,"No",1,0,'C',0);
			$this->Cell($w[1],5,"Years",1,0,'C',0);
			$this->Cell($w[2],5,"Region",1,0,'C',0);
			$this->Cell($w[3],5,"MPP Apply",1,0,'C',0);
			$this->Cell($w[4],5,"MPP Approved",1,0,'C',0);
			$this->Cell($w[5],5,"MPP Achieved",1,0,'C',0);
			$this->Ln();
			$i=1;
		
		if(listLen($lstdata,"#")){
			$brs=4;
			for($i=1;$i<=$jml_brs;$i++){
				$row_data = listGetAt($lstdata,$i,"#");
				$no = listGetAt($row_data,1,"|");
				$year_date = listGetAt($row_data,2,"|");
				$region_name = listGetAt($row_data,3,"|");
			    $hacc_val_apply = listGetAt($row_data,4,"|");
			    $hacc_val_approve = listGetAt($row_data,5,"|");
			    $achieved = listGetAt($row_data,6,"|");
				if(listLen($row_data,"|")==7){
					$detail_region = listGetAt($row_data,7,"|");
				}else{
					$detail_region="";
				}
				
				$this->SetFont('arial','',8);
				$this->Cell($w[0],$brs,$no,1,0,'C',0);
				$this->Cell($w[1],$brs,$year_date,1,0,'C',0);
				$this->Cell($w[2],$brs,$region_name,1,0,'L',0);
				$this->Cell($w[3],$brs,$hacc_val_apply,1,0,'C',0);
				$this->Cell($w[4],$brs,$hacc_val_approve,1,0,'C',0);
				$this->Cell($w[5],$brs,$achieved,1,0,'C',0);
				//$this->Ln();
				if(listLen($detail_region,"^")){
					for($temp_brs=1;$temp_brs<=listLen($detail_region,"^");$temp_brs++){
						$temp_content = listGetAt($detail_region,$temp_brs,"^");
						//$this->Cell($w[2],$brs,$temp_content,1,0,'L',0);
						$this->Ln();
						$this->Cell($w[0],$brs," ",1,0,'C',1);
						$this->Cell($w[1],$brs," ",1,0,'C',1);
						$this->Cell($w[2],$brs,$temp_content,0,0,'L',0);
						$this->Cell($w[3],$brs," ",0,0,'C',0);
						$this->Cell($w[4],$brs," ",1,0,'C',1);
						$this->Cell($w[5],$brs," ",1,0,'C',1);
					}
				}
				$this->Ln();
			}
		}
	}
	// function Rowdata()
		


		function Footer() {
			$this->SetY(-15);
			$this->Cell(0,5,$this->fillfooter,0,0,'R',0);
	    	//$this->Cell(0,5,'','T');
		}//function Footer() 
		
		function MakeFillCol($x,$y,$colW,$colH,$v){
			$this->SetXY($x,$y);
			$this->SetFont('Arial','',8);
			$this->MultiCell($colW,$colH,"$v",1,'L',0);
		}
		
		function MakeColDblRow($x,$y,$colW,$colH,$ft,$sdt,$align='C') {
			$this->SetXY($x,$y);
			$this->MultiCell($colW,$colH,"",1,$align,0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($colW,4,$ft,0,$align,0);
			$y=$this->GetY();
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($colW,4,$sdt,0,$align,0);
		}
		
		function MakeColSingleRow($x,$y,$colW,$colH,$ft,$sdt,$w1,$align=""){
			$align=$align="C"?"":"";
			$this->SetXY($x,$y);
			$this->MultiCell($colW,$colH,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($w1,5,$ft,0,'L',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+$w1,$y);
			$this->MultiCell($colW-$w1,5,$sdt,0,'L',0);
			$this->SetFont('Arial','',8);
		}
	}
	
	$pdf=new PDF();

	$pdf->js_id=uriParam("ip_id");
	$pdf->fillfooter="-- Document Automatically Generated by Mega Human Capital Information System ---";
	$pdf->SetTopMargin(20);
	$pdf->SetLeftMargin(15);
	$pdf->SetRightMargin(15);
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->Report_Content();
	$pdf->Output();
}else{
echo "Invalid Parameter!!";die();
}
?>