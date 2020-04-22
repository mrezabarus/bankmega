<?
if(isset($_POST["strsql"])){
	require_once("../../config.php");
	require_once('../../includes/fpdf/fpdf.php');
	require_once("../../includes/ez_sql.php");
	
	class PDF extends FPDF{
	//Load data
		var $js_id;
		
		function Header() {

		}//function Header() 
			
		function Report_Content(){
            $mpp=cmsDB();
			$js=cmsDB();
			$strsql = postParam("strsql");
            $mpp->query($strsql);
			$jml_brs = $mpp->recordCount();
			  if($mpp->recordCount()){
				$clas=1;
				$lstdata = "";
				$no=1;
				$js = cmsDB();
				$jstest = cmsDB();
				while($mpp->next()){
					$test_no = $mpp->row("test_no");
					$test_status = $mpp->row("test_status");
					$test_date = datesql2date($mpp->row("test_date"));
		
					$strsql = "select full_name from tbl_jobseeker 															
								where js_id=".$mpp->row("js_id");
					$js->query($strsql);
					$js->next();
					$full_name = $js->row("full_name");
					
					$strsql = "select mpppos_id from tbl_position_vacant 
								where vacantpos_id=".$mpp->row("vacant_pos_id");
					$js->query($strsql);
					$js->next();
					$mpppos_id = $js->row("mpppos_id");
					
					$strsql = "select tbl_position.*,tbl_branch_mpp_apply.* from tbl_position  
								inner join tbl_branch_mpp_apply on tbl_position.position_id=tbl_branch_mpp_apply.position_id  
								where tbl_branch_mpp_apply.mpppos_id=".$mpppos_id;
					$js->query($strsql);
					$js->next();
					$position_name = $js->row("position_name");
					
					$strsql = "select tbl_branch.branch_name, tbl_region.region_name from tbl_branch 
								inner join tbl_region on tbl_branch.region_id = tbl_region.region_id 
								inner join tbl_branch_mpp_apply on tbl_branch.branch_id=tbl_branch_mpp_apply.branch_id 
								where tbl_branch_mpp_apply.mpppos_id=".$mpppos_id;
					$js->query($strsql);
					$js->next();
					$branch_name = $js->row("branch_name");
					$region_name = $js->row("region_name");
					$lstdata = listAppend($lstdata,$no."|".$test_no."|".$test_status."|".$test_date."|".$full_name."|".$position_name."|".$branch_name."|".$region_name,"#");
					$no++;
				}
          }else{
		  	$lstdata="";
		  }


			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,"Summary Recruitment Test Report List",0,1,'C',0);
				
			$w=array(6,55,55,45,16,35,35,20);//180
			$this->SetFont('arial','',8);
			//$this->Cell(44,7,"Detail Recruitment Test RecordList",0,0,'L',0);
			$this->Ln();
			$this->SetFont('arial','',8);
			$this->Cell($w[0],5,"No",1,0,'C',0);
			$this->Cell($w[1],5,"Test No.",1,0,'C',0);
			$this->Cell($w[2],5,"Job Seeker",1,0,'C',0);
			$this->Cell($w[3],5,"Position",1,0,'C',0);
			$this->Cell($w[4],5,"Status",1,0,'C',0);
			$this->Cell($w[5],5,"Region",1,0,'C',0);
			$this->Cell($w[6],5,"Branch",1,0,'C',0);
			$this->Cell($w[7],5,"Date",1,0,'C',0);
			$this->Ln();
			$i=1;
		
			if(listLen($lstdata,"#")){
				$brs=7;
				for($i=1;$i<=$jml_brs;$i++){
					$row_data = listGetAt($lstdata,$i,"#");
					$no = listGetAt($row_data,1,"|");
					$test_no = listGetAt($row_data,2,"|");
					$test_status = listGetAt($row_data,3,"|");
					if($test_status == "passed"){
						$test_status = "Test Lulus";
						}elseif($test_status =="failed"){
						$test_status = "Test Gagal";
						}else{
						$test_status = "Test Process";
						}					
					
					$test_date = listGetAt($row_data,4,"|");
					$full_name = listGetAt($row_data,5,"|");
					$position_name = listGetAt($row_data,6,"|");
					$branch_name = listGetAt($row_data,7,"|");
					$region_name = listGetAt($row_data,8,"|");
					
					$lstdata = listAppend($lstdata,$no."|".$test_no."|".$test_status."|".$test_date."|".$full_name."|".$position_name."|".$branch_name."|".$region_name,"#");
					$this->Cell($w[0],7,$no,1,0,'C',0);
					$this->Cell($w[1],7,$test_no,1,0,'L',0);
					$this->Cell($w[2],7,$full_name,1,0,'L',0);
					$this->Cell($w[3],7,$position_name,1,0,'L',0);
					$this->Cell($w[4],7,$test_status,1,0,'C',0);
					$this->Cell($w[5],7,$region_name,1,0,'L',0);
					$this->Cell($w[6],7,$branch_name,1,0,'L',0);
					$this->Cell($w[7],7,$test_date,1,0,'C',0);
					$this->Ln();
					//$i++;
				}
			}

	}// function Rowdata()
		
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

//	$pdf->cw=array(0=>10);
//	$pdf->hw=array(0=>7);

	$pdf->js_id=uriParam("ip_id");
	$pdf->fillfooter="-- Document Automatically Generated by Mega Human Capital Information System ---";
	$pdf->SetTopMargin(20);
	$pdf->SetLeftMargin(15);
	$pdf->SetRightMargin(15);
	$pdf->AddPage('l');
	$pdf->AliasNbPages();
	$pdf->Report_Content();
	$pdf->Output();
}else{
	echo "Invalid Parameter!!";die();
}
?>