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
            $vacancy=cmsDB();
			$strsql = postParam("strsql");
            $vacancy->query($strsql);
			 
			  $num_rows_answer = $vacancy->recordCount();
			   $page = ceil($num_rows_answer/20);
			   if (round($page) == 0){
				 $page = 1;
			   }
			   $jml_brs = $vacancy->recordCount();
			  if($vacancy->recordCount()){
				$clas=1;
				$lstdata = "";
				$no=1;
				while($vacancy->next()){
		            $position_name = $vacancy->row("position_name");
					$qty = $vacancy->row("qty");
		            $request_status = $vacancy->row("request_status");
					$region_name = $vacancy->row("region_name");
				    $branch_name = $vacancy->row("branch_name");
				    $name = $vacancy->row("name");
					$approve_date = datesql2date($vacancy->row("approve_date"));
					$month_dateline = date("F",mktime (0,0,0,$vacancy->row("month_dateline"),date("d"),date("Y")));
	          		$lstdata = listAppend($lstdata,$no."|".$position_name."|".$qty."|".$request_status."|".$region_name."|".$branch_name."|".$name."|".$month_dateline."|".$approve_date,"#");
					$no++;
				}
			  }else{
			  	$lstdata="";
			  }


			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,"Summary Vacant Position Report List",0,1,'C',0);
				
			$w=array(6,55,40,40,20,30,40,30);//180
			$this->SetFont('arial','',8);
			//$this->Cell(44,7,"Detail Vacant Position List",0,0,'L',0);
			$this->Ln();
			$this->SetFont('arial','',8);
			$this->Cell($w[0],5,"No",1,0,'C',0);
			$this->Cell($w[1],5,"Position (Qty)",1,0,'C',0);
			$this->Cell($w[2],5,"Region",1,0,'C',0);
			$this->Cell($w[3],5,"Branch",1,0,'C',0);
			$this->Cell($w[4],5,"Grade",1,0,'C',0);
			$this->Cell($w[5],5,"Status",1,0,'C',0);
			$this->Cell($w[6],5,"Tanggal Approved",1,0,'C',0);
			$this->Cell($w[7],5,"Bulan Expired",1,0,'C',0);
			$this->Ln();
			$i=1;
		
		if(listLen($lstdata,"#")){
			$brs=7;
			for($i=1;$i<=$jml_brs;$i++){
				$row_data = listGetAt($lstdata,$i,"#");
				$no = listGetAt($row_data,1,"|");
				$position_name = listGetAt($row_data,2,"|");
				$qty = listGetAt($row_data,3,"|");
	            $request_status = listGetAt($row_data,4,"|");
				$region_name = listGetAt($row_data,5,"|");
			    $branch_name = listGetAt($row_data,6,"|");
			    $name = listGetAt($row_data,7,"|");
				$month_dateline = listGetAt($row_data,8,"|");
				$approve_date = listGetAt($row_data,9,"|");
			
				$this->Cell($w[0],7,$no,1,0,'C',0);
				$this->Cell($w[1],7,$position_name . " (".$qty.")",1,0,'L',0);
				$this->Cell($w[2],7,$region_name,1,0,'L',0);
				$this->Cell($w[3],7,$branch_name,1,0,'L',0);
				$this->Cell($w[4],7,$name,1,0,'C',0);
				$this->Cell($w[5],7,$request_status,1,0,'C',0);
				$this->Cell($w[6],7,$approve_date,1,0,'C',0);
				$this->Cell($w[7],7,$month_dateline,1,0,'C',0);
				$this->Ln();
			}
			//die();
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