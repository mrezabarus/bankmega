<?php
	
	require_once("../../config.php");
	require('../../includes/fpdf/fpdf.php');
	
	class PDF extends FPDF{
	//Load data
		var $cw;
		var $hw;
		var $y;
		var $hacc_id;
		var $fillfooter;
		
		function Header() {

		}//function Header() 
		
		function MultiCellX($w,$h=0,$txt='',$border=0,$ln=0,$align='L',$fill='0',$link='') {
			$posx = $this->GetX();
			$posy = $this->GetY();
			$this->MultiCell($w,$h,$txt,$border,$align,$fill);    	   
			$this->SetXY($newpos,$posy);
		}
		
		function Report_Content(){
			$defx=$x=$this->GetX(); 
			$defy=$y=$this->GetY(); 
			 $mpp=cmsDB();
			$mpp_branch=cmsDB();
			
//		$strsql = "SELECT tbl_region_mpp.*,tbl_region.region_name,tbl_hrm_user.full_name 
//				   FROM tbl_region_mpp 
//				   INNER JOIN tbl_region on tbl_region_mpp.region_id=tbl_region.region_id 
//				   INNER JOIN tbl_hrm_user on tbl_region_mpp.user_id=tbl_hrm_user.user_id
//				   WHERE (tbl_region_mpp.region_id in (".$_SESSION["ssregion_id" . date("mdY")]."))
//				   ORDER BY tbl_region_mpp.year_date";
//			$mpp->query($strsql);
			  
			  $num_rows_answer = $mpp->recordCount();
			   $page = ceil($num_rows_answer/20);
			   if (round($page) == 0){
				 $page = 1;
			   }
			   $jml_brs = $mpp->recordCount();
			  if($mpp->recordCount()){
					$clas=1;
					$no=1;
					$lstdata = "";
					
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
						 WHERE tbl_branch_mpp_apply.hacc_id = ".$mpp->row("hacc_id")."
						 AND (tbl_branch_mpp_apply.branch_id in (".$_SESSION["ssbranch_id" . date("mdY")]."))";
			  $mpp_branch->query($strsql);			 
	 //echo $strsql;
	 $lstmpppos_id = "";

		 while($mpp_branch->next()){
			 $lstmpppos_id = listAppend($lstmpppos_id,$mpp_branch->row("mpppos_id"));
			//echo "<br>- ".$mpp_branch->row("branch_name")." : ".$mpp_branch->row("qty")." ".$mpp_branch->row("position_name")."";
			$branch_name = $mpp_branch->row("branch_name");
			$qty = $mpp_branch->row("qty");
		 }
		 if(listLen($lstmpppos_id)==0){$lstmpppos_id=0;}
		 $mpp_branch->query("select vacantpos_id from tbl_position_vacant where mpppos_id in (".$lstmpppos_id.")");
		 $lstvacantpos_id = $mpp_branch->valueList("vacantpos_id");
		 
		 if(listLen($lstvacantpos_id)==0){$lstvacantpos_id=0;}
		 $mpp_branch->query("select jstest_id 
		                     from tbl_jobseeker_test 
							 where vacant_pos_id in (".$lstvacantpos_id.")");
		 $lstjstest_id = $mpp_branch->valueList("jstest_id");
		 
		 if(listLen($lstjstest_id)==0){$lstjstest_id=0;}
		 $mpp_branch->query("select tbl_ijin_prinsip.ip_id 
		                     from tbl_ijin_prinsip 
							 inner join tbl_offering_letter on tbl_ijin_prinsip.ip_id=tbl_offering_letter.ip_id 
							 where tbl_offering_letter.is_approved='yes' 
							 and tbl_ijin_prinsip.jstest_id in (".$lstjstest_id.")");
		 $achieved = $mpp_branch->recordCount();
						
						$lstdata = listAppend($lstdata,$no."|".$year_date."|".$region_name."|".$hacc_val_apply."|".$hacc_val_approve."|".$achieved,"#");
						$no++;
					}
		      }
			
							
			
			
			//HEADER
			$this->SetXY($x,$y);
			$this->SetFont('Arial','',14);
			$this->SetX($x+20);
			$this->Cell(0,7,"FORMULIR PERMOHONAN PEGAWAI",0,1,'C',0);
			
			//ALAMAT
			$this->SetXY($x,$y+24);
			$this->MultiCell($ColW,26,"",0,'L',0); //GARIS KOTAK ALAMAT
			$this->SetXY($x,$y+24);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,5,'Dari         : Pimpinan'.' '.$region_name,0,'L',0);
			$this->SetXY($x,$y+28);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,5,"Kepada   : Divisi Human Resources Management",0,'L',0);
			$this->SetXY($x,$y+34);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,5,"Spesifikasi Kebutuhan:",0,'L',0);
			$this->SetXY($x,$y+38);
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,5,"Dasar Permohonan :",0,'L',0);
			$this->SetXY($x+28,$y+38);
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,5,"(1) Rencana Kebutuhan pegawai tahunan",0,'L',0);
			$this->SetXY($x+28,$y+41);
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,5,"(2) Penggantian pegawai yang mengundurkan diri/mutasi/pensiun",0,'L',0);
			$this->SetXY($x+28,$y+44);
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,5,"(3) Lain-lain.......",0,'L',0);
			$this->SetXY($x,$y+50);
			$this->SetFont('Arial','',8);
			$this->MultiCell(0,5,"Kriteria Calon Pegawai",0,'L',0);
			$this->SetXY($x+12,$y+39);
			$this->MultiCell(79,5, $address1,0,'L',0);
			$this->SetX($x+12);
			$this->MultiCell(78,5, $address2,0,'L',0);
			
			$w=array(6,65,30,26,26,27);//180
			$this->SetFont('arial','',8);
			//$this->Cell(44,7,"Detail MPP RecordList",0,0,'L',0);
			$this->Ln();
			$this->SetFont('arial','',8);
			$this->Cell($w[0],5,"No",1,0,'C',0);
			$this->Cell($w[1],5,"Region",1,0,'C',0);
			$this->Cell($w[2],5,"Golongan",1,0,'C',0);
			$this->Cell($w[3],5,"MPP Apply",1,0,'C',0);
			$this->Cell($w[4],5,"MPP Approved",1,0,'C',0);
			$this->Cell($w[5],5,"MPP Achieved",1,0,'C',0);
			$this->Ln();
			$i=1;
			
		if(listLen($lstdata,"#")){
			$brs=7;
			for($i=1;$i<=$jml_brs;$i++){
				$row_data = listGetAt($lstdata,$i,"#");
				$no = listGetAt($row_data,1,"|");
				$year_date = listGetAt($row_data,2,"|");
				$region_name = listGetAt($row_data,3,"|");
			    $hacc_val_apply = listGetAt($row_data,4,"|");
			    $hacc_val_approve = listGetAt($row_data,5,"|");
			    $achieved = listGetAt($row_data,6,"|");
				
				$this->SetFont('arial','',8);
				$this->Cell($w[0],$brs,$no,1,0,'C',0);
				$this->Cell($w[1],$brs,$region_name,1,0,'C',0);
				$this->Cell($w[2],$brs,$name,1,0,'L',0);
				$this->Cell($w[3],$brs,$hacc_val_apply,1,0,'C',0);
				$this->Cell($w[4],$brs,$hacc_val_approve,1,0,'C',0);
				$this->Cell($w[5],$brs,$achieved,1,0,'C',0);
				$this->Ln();
				//echo $i."<br>";
				//$brs = $brs + 7;
			}
		}

			//TEMPAT TANGGAL LAHIR
			$x=$this->GetX(); $y=$this->GetY()+3; 
			
			$this->SetFont('Arial','',8);
						
			//////////
			$x=$this->GetX(); $y=$this->GetY()+4;
			$this->MultiCell($ColW,46,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->ln(5);
			$this->MultiCell($ColW+70,32,"",1,'L',0); //GARIS KOTAK PEMOHON
			$this->SetXY($x,$y+48);
			$this->SetX($x);$this->SetFont('Arial','',8);
			$this->Cell(0,5,"Jakarta, ".date('j F Y'),0,1,'L',0);
			$this->SetX($x);$this->SetFont('Arial','I',8);
			$this->Cell(0,5,"Pemohon,",0,1,'L',0);
			$this->ln(16);
			$this->SetX($x+13);
			$this->Cell(0,5,"(Pimpinan Divisi/Cabang/Capem)",0,0,'L',0);
		    $this->SetX($x+150);
            $this->Cell(0,30,"Form/DHRM/003/02/Rev.02",0,0,'C',0);
			
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
	$pdf->hacc_id=$_GET["hacc_id"];
	$pdf->fillfooter="-- Document Automatically Generated by Mega Human Capital Information System ---";
	$pdf->SetTopMargin(20);
	$pdf->SetLeftMargin(15);
	$pdf->SetRightMargin(15);
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->Report_Content();
	$pdf->Output();
?>