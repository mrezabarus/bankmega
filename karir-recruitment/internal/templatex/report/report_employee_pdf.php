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
            $mpp->query($strsql);
			
			  $jml_brs = $mpp->recordCount();
			  if($mpp->recordCount()){
				$clas=1;
				$lstdata = "";
				$no=1;

			while($mpp->next()){
			$full_name = $mpp->row("full_name");
			
			if(strlen($mpp->row("sex"))==0){
				$sex = "-";
			}else{
				$sex = $mpp->row("sex");
			}
			if(strlen($mpp->row("phone_no1"))==0){
				$phone_no1 = "-";
			}else{
				$phone_no1 = $mpp->row("phone_no1");
			}
            if(strlen($mpp->row("phone_no2"))==0){
				$phone_no2 = "-";
			}else{
				$phone_no2 = $mpp->row("phone_no2");
			}
			if(strlen($mpp->row("place_of_birth"))==0){
				$place_of_birth = "-";
			}else{
				$place_of_birth = $mpp->row("place_of_birth");
			}
            
            $date_of_birth = datesql2date($mpp->row("date_of_birth"));
			$avail_status = $mpp->row("avail_status");
			$join_date = datesql2date($mpp->row("join_date"));
			if(strlen($mpp->row("working_exp"))==0){
				$working_exp = "-";
			}else{
				$working_exp = $mpp->row("working_exp");
			}
			$lstdata = listAppend($lstdata,$no."|".$full_name."|".$sex."|".$phone_no1."|".$phone_no2."|".$place_of_birth."|".$date_of_birth."|".$avail_status."|".$working_exp."|".$join_date,"#");
			$no++;
				}
          	}


			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,"Summary Job Seeker Report List",0,1,'C',0);
				
			$w=array(6,45,30,55,50,30,35,20);//180
			$this->SetFont('arial','',8);
			//$this->Cell(44,7,"Detail Job Seeker RecordList",0,0,'L',0);
			$this->Ln();
			$this->SetFont('arial','',8);
			$this->Cell($w[0],5,"No",1,0,'C',0);
			$this->Cell($w[1],5,"Nama Lengkap",1,0,'C',0);
			$this->Cell($w[2],5,"Jenis Kelamin",1,0,'C',0);
			$this->Cell($w[3],5,"Tlp Rumah/Handphone",1,0,'C',0);
			$this->Cell($w[4],5,"Tempat/Tgl Lahir",1,0,'C',0);
			$this->Cell($w[5],5,"Status",1,0,'C',0);
			$this->Cell($w[6],5,"Pekerjaan Terakhir",1,0,'C',0);
			$this->Cell($w[7],5,"Tgl Register",1,0,'C',0);
			$this->Ln();
			$i=1;
		
			if(listLen($lstdata,"#")){
				$brs=7;
				for($i=1;$i<=$jml_brs;$i++){
					$row_data = listGetAt($lstdata,$i,"#");
					$no = listGetAt($row_data,1,"|");
					$full_name = listGetAt($row_data,2,"|");
					$sex = listGetAt($row_data,3,"|");
					$phone_no1 = listGetAt($row_data,4,"|");
					$phone_no2 =  listGetAt($row_data,5,"|");
					$place_of_birth = listGetAt($row_data,6,"|");
					$date_of_birth = listGetAt($row_data,7,"|");
					$avail_status = listGetAt($row_data,8,"|");
					if($avail_status=="available"){
						$avail_status = "Available";
					}elseif($avail_status=="employee"){
						$avail_status = "Employee";
					}elseif($avail_status=="recruitment passed"){
						$avail_status = "Recruitment Lulus";
					}elseif($avail_status=="recruitment process"){
						$avail_status = "Recruitment Proses";
					}elseif($avail_status=="ol process"){
						$avail_status = "OL Proses";
					}elseif($avail_status=="ol denied"){
						$avail_status = "Batal";
					}else{
						$avail_status = "Reserved";
					}
					$working_exp = listGetAt($row_data,9,"|");
					$join_date = listGetAt($row_data,10,"|");
					
					$this->Cell($w[0],7,$no,1,0,'C',0);
					$this->Cell($w[1],7,$full_name,1,0,'L',0);
					$this->Cell($w[2],7,$sex,1,0,'C',0);
					$this->Cell($w[3],7,$phone_no1."/".$phone_no2,1,0,'L',0);
					$this->Cell($w[4],7,$place_of_birth.", ".$date_of_birth,1,0,'L',0);
					$this->Cell($w[5],7,$avail_status,1,0,'C',0);
					$this->Cell($w[6],7,$working_exp,1,0,'L',0);
					$this->Cell($w[7],7,$join_date,1,0,'C',0);
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