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
			$jstest = cmsDB();
			$position=cmsDB();
			$ip=cmsDB();
			$strsql = postParam("strsql");
            $mpp->query($strsql);
			
			  $jml_brs = $mpp->recordCount();
			  if($mpp->recordCount()){
					$clas=1;
				$lstdata = "";
				$no=1;
			while($mpp->next()){
			$ol_no = $mpp->row("ol_no");
			$ol_date = datesql2date($mpp->row("ol_date"));
			$ol_approved = $mpp->row("is_approved");
			
			$ip->query("select * from tbl_ijin_prinsip where ip_id=".$mpp->row("ip_id"));
			$ip->next();
			$rencana_penempatan = $ip->row("rencana_penempatan");
			$ip_no = $ip->row("ip_no");

			$jstest->query("select tbl_jobseeker.full_name,tbl_jobseeker_test.vacant_pos_id from tbl_jobseeker_test inner join tbl_jobseeker on tbl_jobseeker_test.js_id=tbl_jobseeker.js_id where tbl_jobseeker_test.jstest_id=".$ip->row("jstest_id"));
			$jstest->next();
			$vacant_pos_id = $jstest->row("vacant_pos_id");
			$full_name = $jstest->row("full_name");


			$strsql = "select tbl_branch_mpp_apply.branch_id,tbl_position.position_name 
						from tbl_position 
						inner join tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
						inner join tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
						where tbl_position_vacant.vacantpos_id=" . $vacant_pos_id;
						
			$position->query($strsql);
			$position->next();
			$position_name = $position->row("position_name");
			$lstdata = listAppend($lstdata,$no."|".$ol_no."|".$ol_date."|".$ip_no."|".$full_name."|".$position_name."|".$rencana_penempatan."|".$ol_approved,"#");
            $no++;
              }
          }else{
		  	$lstdata="";
		  }


			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,"Summary Offering Letter Report List",0,1,'C',0);
				
			$w=array(6,45,25,35,50,35,55,20);//180
			$this->SetFont('arial','',8);
			//$this->Cell(44,7,"Detail Offering Letter RecordList",0,0,'L',0);
			$this->Ln();
			$this->SetFont('arial','',8);
			$this->Cell($w[0],5,"No",1,0,'C',0);
			$this->Cell($w[1],5,"OL No.",1,0,'C',0);
			$this->Cell($w[2],5,"Tgl Created OL",1,0,'C',0);
			$this->Cell($w[3],5,"IP No.",1,0,'C',0);
			$this->Cell($w[4],5,"Nama Pelamar",1,0,'C',0);
			$this->Cell($w[5],5,"Posisi",1,0,'C',0);
			$this->Cell($w[6],5,"Penempatan",1,0,'C',0);
			$this->Cell($w[7],5,"Status",1,0,'C',0);
			$this->Ln();
			$i=1;
		
			if(listLen($lstdata,"#")){
				$brs=7;
				for($i=1;$i<=$jml_brs;$i++){
					$row_data = listGetAt($lstdata,$i,"#");
					$no = listGetAt($row_data,1,"|");
					$ol_no = listGetAt($row_data,2,"|");
					$ol_date = listGetAt($row_data,3,"|");
					$ip_no = listGetAt($row_data,4,"|");
					$full_name =  listGetAt($row_data,5,"|");
					$position_name = listGetAt($row_data,6,"|");
					$rencana_penempatan = listGetAt($row_data,7,"|");
					$ol_approved = listGetAt($row_data,8,"|");
					if($ol_approved=="no"){
						$ol_approved = "Pending";
					}elseif($ol_approved=="yes"){
						$ol_approved = "Berhasil";
					}elseif($ol_approved=="ol denied"){
						$ol_approved = "Batal";
					}
					
					$this->Cell($w[0],7,$no,1,0,'C',0);
					$this->Cell($w[1],7,$ol_no,1,0,'L',0);
					$this->Cell($w[2],7,$ol_date,1,0,'C',0);
					$this->Cell($w[3],7,$ip_no,1,0,'L',0);
					$this->Cell($w[4],7,$full_name,1,0,'L',0);
					$this->Cell($w[5],7,$position_name,1,0,'L',0);
					$this->Cell($w[6],7,$rencana_penempatan,1,0,'L',0);
					$this->Cell($w[7],7,$ol_approved,1,0,'C',0);
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