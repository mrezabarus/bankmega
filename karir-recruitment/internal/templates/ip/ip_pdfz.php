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
			$font_size = 9;
			$jstest = cmsDB();
			$jstest->query("select *,DATE_FORMAT(ip_date,'%d %M %Y') as ip_date from tbl_ijin_prinsip where ip_id='".$this->js_id."'");
			$jstest->next();
			$jstest_id = $jstest->row("jstest_id");
			$ip_no = $jstest->row("ip_no");
			
			$NIP = $jstest->row("NIP");
			$txt_gp = $jstest->row("comp_gp");
			$txt_transport = $jstest->row("comp_transport");
			$txt_makan = $jstest->row("comp_makan");
			$txt_jabatan = $jstest->row("comp_tjabatan");
			$txt_kemahalan = $jstest->row("comp_kemahalan");
			$txt_perumahan = $jstest->row("comp_rumah");
			$txt_cop = $jstest->row("comp_cop");
			$ip_date = $jstest->row("ip_date");
			$start_date = listGetAt($jstest->row("start_date"),1," ");
			$tanggal_start = listGetAt($start_date,3,"-");
			$bulan_start = listGetAt($start_date,2,"-");
			$tahun_start = listGetAt($start_date,1,"-");
			
			$start_from = listGetAt($jstest->row("ip_duration_start"),1," ");
			$tanggal_from = listGetAt($start_from,3,"-");
			$bulan_from = listGetAt($start_from,2,"-");
			$tahun_from = listGetAt($start_from,1,"-");
			
			$start_to = listGetAt($jstest->row("ip_duration_end"),1," ");
			$tanggal_to = listGetAt($start_to,3,"-");
			$bulan_to = listGetAt($start_to,2,"-");
			$tahun_to = listGetAt($start_to,1,"-");
			
			$jstest->query("select * from tbl_jobseeker_test where jstest_id=".$jstest_id);
			$jstest->next();
			$selposition=$jstest->row("vacant_pos_id");
			$seljobseeker=$jstest->row("js_id");
			$interview = $jstest->row("wawancara_user");
			$notes = $jstest->row("wawancara_dhrm");
			$notes_all = $jstest->row("overall_test_desc");
			$test_no = $jstest->row("test_no");
			$test_status = $jstest->row("test_status");
			$last_salary = $jstest->row("last_salary");
    		$last_study = $jstest->row("last_study");
		
			 $position=cmsDB();
			 $strsql = "SELECT tbl_branch_mpp_apply.branch_id, tbl_branch_mpp_apply.employee_status, 
			 				tbl_golongan.name, tbl_position.position_name 
						FROM tbl_position 
							INNER JOIN tbl_branch_mpp_apply on tbl_branch_mpp_apply.position_id = tbl_position.position_id 
							INNER JOIN tbl_golongan on tbl_branch_mpp_apply.gol_id = tbl_golongan.gol_id 
							INNER JOIN tbl_position_vacant on tbl_position_vacant.mpppos_id=tbl_branch_mpp_apply.mpppos_id 
						WHERE tbl_position_vacant.vacantpos_id=" . $selposition;
						//echo $strsql;
			$position->query($strsql);
			$position->next();
			$branch_id = $position->row("branch_id");
			$gol_name = $position->row("name");
			$position_name =  $position->row("position_name");
			$employee_status = $position->row("employee_status");
			  
			$jobseeker = cmsDB();
			$jobseeker->query("select * from tbl_jobseeker where js_id=".$seljobseeker);
			$jobseeker->next();
			$jobseeker_name = $jobseeker->row("full_name");
			$place_of_birth = $jobseeker->row("place_of_birth");
			$date_of_birth = $jobseeker->row("date_of_birth");
			$address = $jobseeker->row("address1");
			$phone = $jobseeker->row("phone_no1");
			$hp = $jobseeker->row("phone_no2");
			$religion = $jobseeker->row("religion");
			$mar_status = $jobseeker->row("mar_status");
    		$last_study = $jobseeker->row("last_study");
			$jobseeker->query("select * from tbl_jobseeker_formal_edu where js_id=".$seljobseeker . " and certified='yes' order by formaledu_id desc limit 1");
			$jobseeker->next();
			$jurusan = $jobseeker->row("major");
			$kuliah = $jobseeker->row("formal_level") .", ".$jobseeker->row("formal_name");
			$kuliah = strtoupper($kuliah);
			/*
			$jobseeker->query("select * from tbl_jobseeker_formal_edu where js_id=".$seljobseeker . " order by formaledu_id desc");
			$pendidikan = "";
			while($jobseeker->next()){
				if(strlen(trim($jobseeker->row("formal_name")))==0){
					break;
				}else{
					$pendidikan = $jobseeker->row("formal_level") .", ".$jobseeker->row("formal_name"). " Jurusan : ". $jobseeker->row("major");
				}
			}
			*/
			$jobseeker->query("select * from tbl_jobseeker_jobexp where js_id=".$seljobseeker." and job_check='1' order by jsjobexp_id asc");
			$pengalaman = "";
			while($jobseeker->next()){
				if(strlen(trim($jobseeker->row("comp_name")))<>0){
		    $salary = $salary." Salary : ".number_format($jobseeker->row("salary"),0, '.', ',') ."";
			$pengalaman = $pengalaman."Perusahaan: ".$jobseeker->row("comp_name") .",\n Jabatan : ".$jobseeker->row("job_title"). ",\n Masa Kerja : ". $jobseeker->row("working_duration")." sampai ". $jobseeker->row("working_duration2")."\n";					
				}
			}
			
			$branch = cmsDB();
			$strsql = "select tbl_region.region_name,tbl_branch.branch_name 
						from tbl_branch 
						inner join tbl_region on tbl_branch.region_id=tbl_region.region_id 
						where tbl_branch.branch_id=".$branch_id;
			$branch->query($strsql);
			$branch->next();
			$region_name = $branch->row("region_name");
			$branch_name = $branch->row("branch_name");
			$tgl_from = date("d");
			$bln_from = date("m");
			$thn_from = date("Y");
			
			$tgl_to = date("d");
			$bln_to = date("m");
			$thn_to = date("Y");
			
			$tgl_start = date("d");
			$bln_start = date("m");
			$thn_start = date("Y");
			
			
			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,"PERSETUJUAN PRINSIP PEGAWAI BARU",0,1,'C',0);
			$this->ln(10);
			$this->SetFont('Arial','',$font_size);
//			$this->Cell(60,6,"Nomor Ijin Prinsip",1,0,'L',0);
//				$this->Cell(0,6,"$ip_no",1,1,'L',0);
//			$this->Cell(60,6,"Working Start",1,0,'L',0);
//				$this->Cell(0,6,"$tanggal_start/$bulan_start/$tahun_start",1,1,'L',0);
//			$this->Cell(60,6,"Probation Date Till",1,0,'L',0);
//				$this->Cell(0,6,"$tanggal_to/$bulan_to/$tahun_to",1,1,'L',0);
//			$this->Cell(60,6,"Nama Calon Pegawai",1,0,'L',0);
			$this->SetFont('Arial','B',$font_size);
			$this->MultiCell(180,15,"",0,"R",0);$this->SetXY($this->GetX(),$this->GetY()-24);
			$x=$this->GetX();$y=$this->GetY();
			$this->SetXY($this->GetX(),$this->GetY()-35);
			$this->SetXY($x,$y);
				$this->Cell(0,6,$ip_date,0,1,'R',0);
				$this->SetFont('Arial','B',$font_size);	

			$this->SetFont('Arial','B',$font_size);
			$this->MultiCell(180,25,"",1,"L",0);$this->SetXY($this->GetX(),$this->GetY()-24);
			$x=$this->GetX();$y=$this->GetY();
			$this->SetXY($this->GetX(),$this->GetY()-35);
			$this->SetXY($x,$y);
				$this->Cell(0,6,"Region Cabang	: $region_name - $branch_name",0,1,'L',0);
				$this->Cell(0,6,"Posisi       	: $position_name",0,1,'L',0);
				$this->SetFont('Arial','B',$font_size);	
				$this->Cell(0,6,"Nama         	: $jobseeker_name",0,1,'L',0);
				$this->SetFont('Arial','B',$font_size);	
				$this->Cell(0,6,"NIP          	: $NIP",0,1,'L',0);

			$this->SetFont('Arial','',$font_size);	
			$this->Cell(60,6,"Tempat Tgl. Lahir",1,0,'L',0);
				$this->Cell(0,6,"$place_of_birth, ". datesql2date($date_of_birth),1,1,'L',0);
			$this->Cell(60,6,"Alamat",1,0,'L',0);
				$this->MultiCell(0,6,"$address",1,1,'L',0);
				//$this->Cell(0,6,"$address",1,1,'L',0);
			$this->Cell(60,6,"Telepon",1,0,'L',0);
				$this->Cell(50,6,"$phone",1,0,'L',0);
				$this->Cell(0,6,"$hp",1,1,'L',0);
			$this->Cell(60,6,"Agama",1,0,'L',0);
				$this->Cell(0,6,"$religion",1,1,'L',0);
			$this->Cell(60,6,"Status",1,0,'L',0);
				$this->Cell(0,6,"$mar_status",1,1,'L',0);
			$this->Cell(60,6,"Pendidikan Terakhir",1,0,'L',0);
				$this->Cell(0,6,"$kuliah",1,1,'L',0);
			$this->Cell(60,6,"",1,0,'L',0);
				$this->Cell(0,6,"$jurusan",1,1,'L',0);
				
			
			$this->MultiCell(60,15,"",1,"L",0);$this->SetXY($this->GetX()+60,$this->GetY()-15);
			$this->MultiCell(0,15,"",1,"L",0);
			$x=$this->GetX();$y=$this->GetY();
			$this->SetXY($this->GetX(),$this->GetY()-15);
			$this->Cell(60,5,"Pengalaman Kerja",0,0,'L',0);
			$this->MultiCell(0,5,"$pengalaman",0,"L",0);
			$this->SetXY($x,$y);
			
			$this->Cell(60,6,"Kompensasi Terakhir",1,0,'L',0);
				$this->Cell(0,6,"$salary",1,1,'L',0);
			
			$this->MultiCell(60,18,"",1,"L",0);
			$this->SetXY($this->GetX()+60,$this->GetY()-18);
			$this->MultiCell(0,18,"",1,"L",0);
			$x=$this->GetX();$y=$this->GetY();
			$this->SetXY($this->GetX(),$this->GetY()-18);
			$this->Cell(60,5,"Rencana Penempatan",0,0,'L',0);
			$this->SetFont('Arial','',$font_size);	
				$this->Cell(0,6,"Region : $region_name",1,1,'L',0);
			$this->Cell(60,5,"",0,0,'L',0);
				$this->Cell(0,6,"Branch : $branch_name",1,1,'L',0);
			$this->Cell(60,5,"",0,0,'L',0);
				$this->Cell(0,6,"Posisi : $position_name",1,1,'L',0);
			
			$grouptest = cmsDB();
			$grouptest->query("select * from tbl_jobseeker_test_detail where jstest_id=".$jstest_id);
			$rowspan = 5 * $grouptest->recordCount();
				
			$this->SetFont('Arial','',$font_size);	
			$this->MultiCell(60,$rowspan,"",1,"L",0);$this->SetXY($this->GetX()+60,$this->GetY()-$rowspan);
			$this->MultiCell(0,$rowspan,"",1,"L",0);
			$x=$this->GetX();$y=$this->GetY();
			$this->SetXY($this->GetX(),$this->GetY()-$rowspan);
			$this->Cell(60,5,"Hasil Test",0,0,'L',0);
				while($grouptest->next()) {
					$history_name = $grouptest->row("history_name");
					$test_result = $grouptest->row("test_result");
					
					if (strlen($grouptest->row("history_name"))==""){
						$history_name = "NULL";
						}else{
						$history_name = $grouptest->row("history_name");
					} 
					if (strlen($grouptest->row("test_result"))==""){
						$test_result = "NULL";
						}else{
						$test_result = $grouptest->row("test_result");
					} 
					$this->Cell(30,5,$history_name,0,0,'L',0);
					$this->Cell(0,5,":".' '.$test_result,0,1,'L',0);$this->SetX($x+60);
				}
			
			$this->SetXY($this->GetX()-60,$this->GetY());
			$this->SetFont('Arial','I',$font_size);
			$this->Cell(0,6,"Wawancara User : $interview",1,1,'L',0);
			$this->Cell(0,6,"Wawancara HRD	: $notes",1,1,'L',0);
				
				
			$this->MultiCell(60,20,"",1,"L",0);$this->SetXY($this->GetX()+60,$this->GetY()-20);
			$this->MultiCell(0,20,"",1,"L",0);
			$x=$this->GetX();$y=$this->GetY();
			$this->SetXY($this->GetX(),$this->GetY()-20);
			$this->SetFont('Arial','',$font_size);
			$this->Cell(60,5,"Kompensasi yang direkomendasikan",0,0,'L',0);
			$this->SetFont('Arial','',$font_size);	
				$this->Cell(30,5,"GP",1,0,'L',0);
					$this->Cell(30,5,number_format($txt_gp,0, '.', ','),1,0,'L',0);////
					$this->Cell(30,5,"T.Kemahalan",1,0,'L',0);
					$this->Cell(0,5,number_format($txt_kemahalan,0, '.', ','),1,1,'L',0);$this->SetX($x+60);
				$this->Cell(30,5,"Transport",1,0,'L',0);
					$this->Cell(30,5,number_format($txt_transport,0, '.', ','),1,0,'L',0);////
					$this->Cell(30,5,"T.Perumahan",1,0,'L',0);
					$this->Cell(0,5,number_format($txt_perumahan,0, '.', ','),1,1,'L',0);$this->SetX($x+60);				
				$this->Cell(30,5,"Makan",1,0,'L',0);
					$this->Cell(30,5,number_format($txt_makan,0, '.', ','),1,0,'L',0);////
					$this->Cell(30,5,"COP",1,0,'L',0);
					$this->Cell(0,5,number_format($txt_cop,0, '.', ','),1,1,'L',0);$this->SetX($x+60);
				$this->Cell(30,5,"T.Jabatan",1,0,'L',0);
					$this->Cell(30,5,number_format($txt_jabatan,0, '.', ','),1,0,'L',0);////
					$this->Cell(30,5,"",1,0,'L',0);
					$this->Cell(0,5,"",1,1,'L',0);$this->SetX($x+60);								
			$this->SetXY($x,$y);
			
				
			$this->SetFont('Arial','',$font_size);	
			$this->Cell(60,6,"Pangkat/Golongan",1,0,'L',0);
				$this->Cell(0,6,$gol_name,1,1,'L',0);
			$this->Cell(60,6,"Status Pegawai",1,0,'L',0);
				$this->Cell(0,6,$employee_status,1,1,'L',0);
			
			$x=$this->GetX();$y=$this->GetY();
			$this->Cell(45,20,"Paraf",1,0,'L',0);
			$this->Cell(45,20,"Paraf",1,0,'L',0);
			$this->Cell(45,20,"Paraf",1,0,'L',0);
			$this->Cell(45,20,"Paraf",1,0,'L',0);
			
			$this->SetX($x+140);
            $this->Cell(0,60,"FORM/HCMD/009/06/Rev.00",0,0,'C',0);

		}// function Rowdata()
		
		function Footer() {
			$this->SetY(-15);
			$this->Cell(0,5,$this->fillfooter,0,0,'R',0);
	    	//$this->Cell(0,5,'','T');
		}//function Footer() 
		
		function MakeFillCol($x,$y,$colW,$colH,$v){
			$this->SetXY($x,$y);
			$this->SetFont('Arial','',$font_size);
			$this->MultiCell($colW,$colH,"$v",1,'L',0);
		}
		
		function MakeColDblRow($x,$y,$colW,$colH,$ft,$sdt,$align='C') {
			$this->SetXY($x,$y);
			$this->MultiCell($colW,$colH,"",1,$align,0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',$font_size);
			$this->SetXY($x,$y);
			$this->MultiCell($colW,4,$ft,0,$align,0);
			$y=$this->GetY();
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',$font_size);
			$this->MultiCell($colW,4,$sdt,0,$align,0);
		}
		function MakeColDblRow2($x,$y,$colW,$colH,$ft,$sdt,$align='C') {
			$this->SetXY($x,$y);
			$this->MultiCell($colW,$colH,"",1,$align,0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',$font_size);
			$this->SetXY($x,$y);
			$this->MultiCell($colW,4,$ft,0,$align,0);
			$y=$this->GetY();
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',$font_size);
			$this->MultiCell($colW,4,$sdt,0,$align,0);
		}
		
		function MakeColSingleRow($x,$y,$colW,$colH,$ft,$sdt,$w1,$align=""){
			$align=$align="C"?"":"";
			$this->SetXY($x,$y);
			$this->MultiCell($colW,$colH,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',$font_size);
			$this->SetXY($x,$y);
			$this->MultiCell($w1,5,$ft,0,'L',0);
			$this->SetFont('Arial','I',$font_size);
			$this->SetXY($x+$w1,$y);
			$this->MultiCell($colW-$w1,5,$sdt,0,'L',0);
			$this->SetFont('Arial','',$font_size);
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
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->Report_Content();
	$pdf->Output();
}else{
	echo "Invalid Parameter!!";die();
}
?>