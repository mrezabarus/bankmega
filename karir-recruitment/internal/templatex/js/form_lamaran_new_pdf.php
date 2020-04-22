<?php
	require_once("../../config.php");
	
	require('../../includes/fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
	//Load data
		var $cw;
		var $hw;
		var $y;
		var $js_id;
		var $pelamar;
		var $apply_from;
		var $fillfooter;
		
		function MultiCellX($w,$h=0,$txt='',$border=0,$ln=0,$align='L',$fill='0',$link='') {
			$posx = $this->GetX();
			$posy = $this->GetY();
			$this->MultiCell($w,$h,$txt,$border,$align,$fill);    	   
			$this->SetXY($newpos,$posy);
		}
		
		function Report_Content(){
			$defx=$x=$this->GetX(); 
			$defy=$y=$this->GetY(); 
			$js=cmsDB();
			$js->query("SELECT *,DATE_FORMAT(date_of_birth, '%d %M %Y') AS date_of_birth1 
			            FROM tbl_jobseeker 
						WHERE js_id='".$this->js_id."'");
			if($js->recordCount()){
				$js->next();
				$email=$js->row("email");
				$this->pelamar = $full_name=$js->row("full_name");
				$sex=$js->row("sex");
				$place_of_birth=$js->row("place_of_birth");
				$date_of_birth=$js->row("date_of_birth");
				$date_of_birth1=$js->row("date_of_birth1");
				$address1=$js->row("address1");
				$address2=$js->row("address2");
				$city=$js->row("city");
				$zip_code=$js->row("zip_code");
				$id_no=$js->row("id_no");
				$id_no_valid=$js->row("id_no_valid");
				$phone_no1=$js->row("phone_no1");
				$phone_no2=$js->row("phone_no2");
				$religion=$js->row("religion");
				$mar_status=$js->row("mar_status");
				$working_exp=$js->row("working_exp");
				$last_salary=$js->row("last_salary");
				$positioning_place=$js->row("positioning_place");
				$exp_comp_gp=$js->row("exp_comp_gp");
				$exp_comp_transport=$js->row("exp_comp_transport");
				$exp_comp_makan=$js->row("exp_comp_makan");
				$exp_comp_tjabatan=$js->row("exp_comp_tjabatan");
				$exp_comp_kemahalan=$js->row("exp_comp_kemahalan");
				$exp_comp_rumah=$js->row("exp_comp_rumah");
				$exp_comp_cop=$js->row("exp_comp_cop");
				$this->apply_from=$apply_from=$js->row("apply_from");
				$avail_status=$js->row("avail_status");
				$avail_notes=$js->row("avail_notes");
				$height=$js->row("height");
				$weight=$js->row("weight");
				$skin_color=$js->row("skin_color");
				$hair_color=$js->row("hair_color");
				$ethnic=$js->row("ethnic");
				$nationality=$js->row("nationality");
				$pict_file=$js->row("pict_file");
													if (file_exists($ANOM_VARS["www_img_path"]."js_photo/".$pict_file)) {
														$pict_file = $pict_file;
													} else {
														$pict_file = "nophoto.gif";
													}
				$insert_by=$js->row("insert_by");
				$user_id=$js->row("user_id");
				$branch_id=$js->row("branch_id");
				$blood_type=$js->row("blood_type");
				$driving_lisence_a=$js->row("driving_lisence_a");
				$driving_lisence_c=$js->row("driving_lisence_c");
				$driving_lisence_other=$js->row("driving_lisence_other");
				$hobby=$js->row("hobby");
				$reading_freq=$js->row("reading_freq");
				$reading_topic=$js->row("reading_topic");
				$organisasi_pos=$js->row("organisasi_pos");
			}
			
			//HEADER
			$this->SetXY($x,$y);
			//$this->Image('logo-mega.jpg',$x,$y,40,0,'','http://www.bankmega.com');
			$this->Image('logo-mega-new.jpg',20,17,33,0,'','http://www.bankmega.com');
			$this->SetFont('Arial','',14);
			$this->SetX($x+30);
			$this->Cell(0,7,"FORMULIR LAMARAN PEKERJAAN",0,1,'C',0);
			$this->SetFont('Arial','I',10);
			$this->SetX($x+30);
			$this->Cell(0,7,"JOB APPLICATION FORM",0,1,'C',0);

			
			//POSISI LAMARAN
			$position_name="";
			$js->query("SELECT tbl_jobseeker_interest_pos.*,tbl_position.position_name 
						FROM tbl_jobseeker_interest_pos 
						INNER JOIN tbl_position on tbl_jobseeker_interest_pos.position_id=tbl_position.position_id
						WHERE js_id='".$this->js_id."'");
			if($js->recordCount()){
				for ($i=0;$i<$js->recordCount();$i++) {
					$js->next();
					$position_name .= $js->row("position_name") .', ';
				}
			}
			$position_name=substr($position_name,0,strlen($position_name)-2);
			$this->SetXY($x,$y+20);
			$this->MultiCell(0,10,"",1,'L',0); //GARIS KOTAK 
			$this->SetXY($x,$y+19);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,10,"Jabatan yang dilamar : ",0,'L',0);
			$this->SetXY($x,$y+25);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,$position_name,0,'L',0);
			
			/////////////////////////////////
			// DATA DIRI
			$this->SetXY($x,$y+34);
			$this->MultiCell(0,33,"",1,'L',0); //GARIS KOTAK LUAR

			$this->SetXY($x,$y+34);
			$ColW=90;
			$this->MultiCell($ColW,10,"",1,'L',0); //GARIS KOTAK NAMA
			$this->SetXY($x,$y+31);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,10,"Nama Lengkap : ",0,'L',0);
			$this->SetXY($x,$y+37);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,$full_name,0,'L',0);
			
			//////////////////////////////
			//JENIS KELAMIN
			// BERIKAN TANDA CHECK JIKA ISINYA TRUE
			// untuk laki-laki
			$LC=3; //lebar check mark
			if (trim($sex)=='Laki-Laki'){
				$this->Image('check.jpg',$x+$ColW+1,$y+35,$LC,0,'');
				$this->Image('uncheck.jpg',$x+$ColW+1,$y+39,$LC,0,'');
			}//if ($v==1)
			
			// untuk Perempuan
			if (trim($sex)=='Perempuan'){
				$this->Image('uncheck.jpg',$x+$ColW+1,$y+35,$LC,0,'');
				$this->Image('check.jpg',$x+$ColW+1,$y+39,$LC,0,'');
			}//if ($v==1)
			
			$this->SetXY($x+$ColW,$y+34);
			$this->MultiCell(48,10,"",1,'L',0); //GARIS KOTAK JENIS KELAMIN
			$this->SetXY($x+$ColW+$LC+1,$y+32);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,10,"Laki-laki",0,'L',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+$ColW+13+$LC,$y+32);
			$this->MultiCell(0,10,"",0,'L',0);
			$this->SetXY($x+$ColW+$LC+1,$y+38);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,5,"Perempuan",0,'L',0);
			$this->SetXY($x+$ColW+17+$LC,$y+38);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,"",0,'L',0);
			
			///////////////////////////
			$this->SetXY($x+$ColW+45+$LC,$y+34);
			if ($pict_file) {
				$this->Image("../../library/_images/js_photo/".$pict_file,$x+$ColW+45+$LC+8,$y+34+2,20,0,'');
				$this->MultiCell(0,33,"",1,'C',0); //GARIS KOTAK PHOTO
			}else{
				$this->MultiCell(0,33,"NO PHOTO",1,'C',0); //GARIS KOTAK PHOTO
			}
			
			//ALAMAT
			$this->SetXY($x,$y+44);
			$this->MultiCell($ColW,23,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetXY($x,$y+44);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(0,5,"Alamat : ",0,'L',0);
			$this->SetXY($x,$y+48);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,"",0,'L',0);
			$this->SetXY($x+12,$y+44);
			$this->MultiCell(79,5, $address1,0,'L',0);
			$this->SetX($x+12);
			$this->MultiCell(78,5, $address2,0,'L',0);

			//KOTAK TELEPON
			$this->SetXY($x+$ColW,$y+44);
			$this->MultiCell(48,10,"",1,'L',0); //GARIS KOTAK JENIS KELAMIN
			$this->SetFont('Arial','B',8);
			$this->SetXY($x+$ColW,$y+54);
			$this->MultiCell(0,5,"Phone :",0,'L',0);
			$this->SetXY($x+$ColW+13,$y+54);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,"",0,'L',0);
			$this->SetX($x+$ColW);
			$this->MultiCell(45,5,$phone_no2.' '."/".' '.$phone_no1,0,'L',0);
			
			
			//TEMPAT TANGGAL LAHIR
			$x=$this->GetX(); $y=$this->GetY()+3; 
			
			$this->SetXY($x,$y);
			$this->MultiCell(0,4,"",1,'L',0); //GARIS KOTAK KOSONG
			$x=$this->GetX(); $y=$this->GetY(); 
			$this->SetXY($x,$y);
			$this->MultiCell($ColW,12,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(0,5,"Tempat / Tgl. Lahir :",0,'L',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,$place_of_birth.' / '.$date_of_birth1,0,'L',0);
			$this->SetXY($x+28,$y);
			$this->MultiCell(60,5,"",0,'L',0);
			$this->SetXY($x,$y);
			$this->MultiCell(0,12,"",1,'L',0); //GARIS KOTAK Agama :
			$this->SetFont('Arial','B',8);
			$this->SetXY($x+$ColW,$y);
			$this->MultiCell(0,5,"Agama :",0,'L',0);
			$this->SetXY($x+$ColW,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(0,5,$religion,0,'L',0);
			$this->SetXY($x+$ColW+15,$y+4);
			$this->MultiCell(0,5,"",0,'L',0);
			
			/////
			$x=$this->GetX(); $y=$this->GetY()+3; 
			$this->SetXY($x,$y); //GARIS KOTAK JENIS SUKU
			$this->MultiCell($ColW/2,5,"",1,'L',0); 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(($ColW/2)-9,5,"Suku",0,'C',0);
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(($ColW/2)+9,5,"",0,'C',0);
			
			$x=$this->GetX()+($ColW/2);
			$this->SetXY($x,$y); //GARIS KOTAK JENIS SUKU
			$this->MultiCell($ColW/2,5,"",1,'L',0); 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(($ColW/2)-16,5,"Kewarganegaraan",0,'C',0);
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(($ColW/2)+23,5,"",0,'C',0);
			
			$x=$this->GetX()+$ColW;
			$this->SetXY($x,$y); //GARIS KOTAK Material Status
			$this->MultiCell(40,5,"",1,'L',0); 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(40-17,5,"Status",0,'C',0);
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(40+12,5,"",0,'C',0);
			
			$x=$this->GetX()+$ColW+40;
			$this->SetXY($x,$y); //GARIS KOTAK JENIS Gol.Darah/Blood Type
			$this->MultiCell(50,5,"",1,'L',0); 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(50-17,5,"Gol.Darah",0,'C',0);
			$this->SetXY($x,$y);
			$this->SetFont('Arial','I',8);
			$this->MultiCell(50+12,5,"",0,'C',0);
			
			$this->SetFont('Arial','',8);
			$this->Cell($ColW/2,5,$ethnic,1,0,'C',0);
			$this->Cell($ColW/2,5,$nationality,1,0,'C',0);
			$this->Cell(40,5,ucfirst($mar_status),1,0,'C',0);
			$this->Cell(50,5,$blood_type,1,1,'C',0);			
			
			/////// FAMILY DATA
			$x=$this->GetX(); $y=$this->GetY()+4; $cw=30;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,10,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"Nama",0,'C',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($cw,5,"Name",0,'C',0);
			
			$x+=$cw;$cw=30;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,10,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"Hubungan Keluarga",0,'C',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($cw,5,"Family Relation",0,'C',0);
			
			$x+=$cw;$cw=10;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,10,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"L/P",0,'C',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($cw,5,"M/F",0,'C',0);
			
			$x+=$cw;$cw=45;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,10,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"Tempat/Tgl.Lahir",0,'C',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($cw,5,"Place/Date of Birth",0,'C',0);
			
			$x+=$cw;$cw=25;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,10,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"Pendidikan",0,'C',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($cw,5,"Education",0,'C',0);
			
			$x+=$cw;$cw=0;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,10,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"Pekerjaan",0,'C',0);
			$this->SetXY($x,$y+4);
			$this->SetFont('Arial','I',8);
			$this->MultiCell($cw,5,"Occupation",0,'C',0);
			
			////
			$family=cmsDB();
			$strsql = "SELECT *,DATE_FORMAT(date_of_birth, '%d-%m-%Y') AS date_of_birth1
					   FROM tbl_jobseeker_family where js_id='".$this->js_id."' ORDER BY jsfamily_id asc";
			$family->query($strsql);
			$max = 6;
			if($family->recordCount()){
				//Father
				$family->next();
				$father_name=$family->row("name");
				$father_sex=$family->row("sex");
				$father_last_edu=$family->row("last_edu");
				$father_date_of_birth1=$family->row("date_of_birth1");
				$father_place_of_birth=$family->row("place_of_birth");
				$father_pob=$family->row("place_of_birth");
				$father_job=$family->row("job");
				//Mother
				$family->next();
				$mother_name=$family->row("name");
				$mother_sex=$family->row("sex");
				$mother_last_edu=$family->row("last_edu");
				$mother_date_of_birth1=$family->row("date_of_birth1");
				$mother_place_of_birth=$family->row("place_of_birth");
				$mother_pob=$family->row("place_of_birth");
				$mother_job=$family->row("job");
				
				//Brother& Sister
				for ($i=1;$i<=$max;$i++) {
					$family->next();
					$bro_name[$i]=$family->row("name");
					$bro_sex[$i]=$family->row("sex");
					$bro_edu[$i]=$family->row("last_edu");
					$bro_pob[$i]=$family->row("place_of_birth");
					$bro_of_birth1[$i]=$family->row("date_of_birth1");
					$bro_job[$i]=$family->row("job");
				}
			}
			
			$this->SetFont('Arial','',8);
			$x=$this->GetX(); $y=$this->GetY()+1;
			$this->SetXY($x,$y);
			$this->Cell(30,5,$father_name,1,0,'C',0);
			$this->Cell(30,5,"Ayah - Father",1,0,'C',0);
			$this->Cell(10,5,ucfirst($father_sex),1,0,'C',0);
			$this->Cell(45,5,$father_place_of_birth.' / '.$father_date_of_birth1,1,0,'C',0);
			$this->Cell(25,5,$father_last_edu,1,0,'C',0);
			$this->Cell(0,5,$father_job,1,1,'C',0);
			
			$this->Cell(30,5,$mother_name,1,0,'C',0);
			$this->Cell(30,5,"Ibu - Mother",1,0,'C',0);
			$this->Cell(10,5,ucfirst($mother_sex),1,0,'C',0);
			$this->Cell(45,5,$mother_place_of_birth.' / '.$mother_date_of_birth1,1,0,'C',0);
			$this->Cell(25,5,$mother_last_edu,1,0,'C',0);
			$this->Cell(0,5,$mother_job,1,1,'C',0);
			
			/// Saudara Kandung / Termasuk Diri Sendiri -
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->Cell(55,5,"Saudara Kandung / Termasuk Diri Sendiri -",0,0,'L',0);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,5,"Brother & sister / Include yourself",0,1,'L',0);
			$this->SetFont('Arial','',8);
			
			for ($i=1;$i<=$max;$i++){
				//$this->Cell(30,5,"$i",1,0,'C',0);
				$this->Cell(30,5,$bro_name[$i],1,0,'L',0);
				$this->Cell(15,5,ucfirst($bro_sex[$i]),1,0,'L',0);
				$this->Cell(45,5,$bro_pob[$i].' / '.$bro_date_of_birth1[$i],1,0,'L',0);
				$this->Cell(25,5,$bro_job[$i],1,0,'L',0);
				$this->Cell(0,5,$bro_edu[$i],1,1,'L',0);
			}
			
			//if ($mar_status <> "Single") {
				/// SUAMI ISTRI
				$couple=cmsDB();
				$strsql = "SELECT *,DATE_FORMAT(date_of_birth, '%d-%m-%Y') AS date_of_birth1 
						   FROM tbl_jobseeker_couple where js_id='".$this->js_id."' ORDER BY jscouple_id asc";
				$couple->query($strsql);
				if($couple->recordCount()){
					$couple->next();
					$hw_name=$couple->row("couple_name");
					$hw_sex=$couple->row("sex");
					$hw_pob=$couple->row("place_of_birth");
					$hw_date_of_birth1=$couple->row("date_of_birth1");
					$hw_job=$couple->row("job_title");
					$hw_edu=$couple->row("last_edu");
				}
				$x=$this->GetX(); $y=$this->GetY()+2;
				$this->SetXY($x,$y);
				$this->SetFont('Arial','B',8);
				$this->Cell(19,5,"Istri / Suami - ",0,0,'L',0);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,5,"Wife / Husband",0,1,'L',0);
				$this->SetFont('Arial','',8);
				
				$this->Cell(30,5,$hw_name,1,0,'L',0);
				$this->Cell(30,5,"",1,0,'C',0);
				$this->Cell(10,5,ucfirst($hw_sex),1,0,'C',0);
				$this->Cell(30,5,$hw_pob.' / '.$hw_date_of_birth1,1,0,'C',0);
				$this->Cell(30,5,$hw_job,1,0,'C',0);
				$this->Cell(0,5,$hw_edu,1,1,'C',0);
				
				/// Anak
				$x=$this->GetX(); $y=$this->GetY()+2;
				$this->SetXY($x,$y);
				$this->SetFont('Arial','B',8);
				$this->Cell(10,5,"Anak – ",0,0,'L',0);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,5,"Daughter & Son",0,1,'L',0);
				$this->SetFont('Arial','',8);
				
				$child=cmsDB();
				$strsql = "SELECT *, DATE_FORMAT(date_of_birth, '%m-%d-%Y') AS date_of_birth1
						   FROM tbl_jobseeker_children where js_id='".$this->js_id. "' ORDER BY jschildren_id asc";
				$child->query($strsql);
				if($child->recordCount()){
					for ($i=1;$i<=$child->recordCount();$i++){
						$child->next();	
						$child_name[$i]=$child->row("name");
						$child_sex[$i]=$child->row("sex");
						$child_edu[$i]=$child->row("last_edu");
						$child_pob[$i]=$child->row("place_of_birth");
						$child_date_of_birth1[$i]=$child->row("date_of_birth1");
						$child_job[$i]=$child->row("job_title");
					}					
				}
				
				for ($i=1;$i<=4;$i++){
					$this->Cell(30,5,"$i",1,0,'C',0);
					$this->Cell(30,5,$child_name[$i],1,0,'L',0);
					$this->Cell(10,5,ucfirst($child_sex[$i]),1,0,'L',0);
					$this->Cell(30,5,$child_edu[$i],1,0,'L',0);
					$this->Cell(30,5,$child_pob[$i].' / '.$child_date_of_birth1[$i],1,0,'L',0);
					$this->Cell(0,5,$child_job[$i],1,1,'L',0);
				}		
			//}
			
			//////
			/// RIWAYAT PENDIDIKAN / EDUCATIONAL BACKGROUND
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"RIWAYAT PENDIDIKAN / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"EDUCATIONAL BACKGROUND",0,'L',0);
			$this->SetFont('Arial','',8);
			//header
			$x=$this->GetX(); $y=$this->GetY();
			$this->MakeColDblRow($x,$y,40,8,'Tingkat Pendidikan','Education Level');$np=40;
			$this->MakeColDblRow($x+$np,$y,30,8,'Nama Sekolah','School');$np+=30;
			$this->MakeColDblRow($x+$np,$y,30,8,'Kota','City');$np+=30;
			$this->MakeColDblRow($x+$np,$y,40,8,'Jurusan','Major In');$np+=40;
			$this->MakeColDblRow($x+$np,$y,15,8,'Tahun','Years');$np+=15;
			$this->MakeColDblRow($x+$np,$y,10,8,'IPK','Score');$np+=10;
			$this->MakeColDblRow($x+$np,$y,0,8,'Berijazah','Certified');$np+=30;
//			$this->MakeColumn($x+$np,$y,20,10,'Nama1','Name1');
			//detail
			$inTp=array("SD","SMP","SMU","D1","D3","S1","S2");
			$tpw1=array(9,10,10,9,9,9,9);
			$enTp=array("Primary School","Junior High School","Senior High School","Diploma-1",
						"Diploma-3","Major","Post Graduate");
						
			$edu=cmsDB();		
			$strsql = "SELECT * FROM tbl_jobseeker_formal_edu WHERE js_id='".$this->js_id."' ORDER BY formaledu_id asc";
			$edu->query($strsql);
			if($edu->recordCount()){
				for ($i=1;$i<=$edu->recordCount();$i++){	
					$edu->next();
					$sd_name[$i]=$edu->row("formal_name");
					$sd_city[$i]=$edu->row("city");
					$sd_major[$i]=$edu->row("major");
					$sd_year[$i]=$edu->row("formal_date");
					$sd_ipk[$i]=$edu->row("ipk");
					$sd_certified[$i]=$edu->row("certified");
				}
			}
			for ($i=0;$i<count($inTp);$i++) { 
				$x=$this->GetX();$y=$this->GetY();
				$l=$i+1;
				$this->MakeColSingleRow($x,$y,40,5,"$inTp[$i] -" ,$enTp[$i],$tpw1[$i]);$np=40;
				$this->MakeFillCol($x+$np,$y,30,5,$sd_name[$l]);$np+=30;
				$this->MakeFillCol($x+$np,$y,30,5,$sd_city[$l]);$np+=30;
				$this->MakeFillCol($x+$np,$y,40,5,$sd_major[$l]);$np+=40;
				$this->MakeFillCol($x+$np,$y,15,5,$sd_year[$l]);$np+=15;
				$this->MakeFillCol($x+$np,$y,10,5,$sd_ipk[$i]);$np+=10;
				$this->MakeFillCol($x+$np,$y,0,5,$sd_certified[$l]);$np=0;
			}
			$this->AddPage();
			/// PENDIDIKAN INFORMAL / INFORMAL EDUCATION
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"PENDIDIKAN INFORMAL / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"INFORMAL EDUCATION",0,'L',0);
			$this->SetFont('Arial','',8);
			
			$x=$this->GetX(); $y=$this->GetY();
			$this->MakeColDblRow($x,$y,35,8,'Nama Kursus','Course Name');$np=35;
			$this->MakeColDblRow($x+$np,$y,35,8,'Penyelenggara','Organizer');$np+=35;
			$this->MakeColDblRow($x+$np,$y,35,8,'Jangka Waktu','Period');$np+=35;
			$this->MakeColDblRow($x+$np,$y,35,8,'Berijasah','Certified');$np+=35;
			$this->MakeColDblRow($x+$np,$y,0,8,'Dibiayai Oleh','Sponsored By');$np+=35;
//			$this->MakeColumn($x+$np,$y,20,10,'Nama1','Name1');

			$strsql = "SELECT * FROM tbl_jobseeker_informal_edu WHERE js_id='".$this->js_id."' ORDER BY informaledu_id asc";
			$edu->query($strsql);
			if($edu->recordCount()){
				for ($i=0;$i<=$edu->recordCount();$i++){
					$edu->next();
					$informal_name[$i]=$edu->row("informal_name");
					$informal_vendor[$i]=$edu->row("organizer");
					$informal_certified[$i]=$edu->row("informal_status");
					$informal_time[$i]=$edu->row("informal_period");
					$informal_funder[$i]=$edu->row("sponsored_by");
				}
			}
			
			for ($i=0;$i<=3;$i++) { 
				$x=$this->GetX();$y=$this->GetY();
				//$this->MakeColSingleRow($x,$y,35,5,"" ,$enTp[$i],$tpw1[$i]);$np=35;
				$this->MakeFillCol($x,$y,35,5,$informal_name[$i]);$np=35;
				$this->MakeFillCol($x+$np,$y,35,5,$informal_vendor[$i]);$np+=35;
				$this->MakeFillCol($x+$np,$y,35,5,$informal_time[$i]);$np+=35;
				$this->MakeFillCol($x+$np,$y,35,5,$informal_certified[$i]);$np+=35;
				$this->MakeFillCol($x+$np,$y,0,5,$informal_funder[$i]);$np+=35;
			}
			/// BAHASA ASING / FOREIGN LANGUAGE
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"BAHASA ASING / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"FOREIGN LANGUAGE",0,'L',0);
			$this->SetFont('Arial','',8);
			$x=$this->GetX(); $y=$this->GetY();
			$this->MakeColDblRow($x,$y,40,13,'Bahasa','Language (s)');$np=40;
			$this->MakeColDblRow($x+$np,$y,48,8,'Baca','Reading');$np+=48;
			$this->MakeColDblRow($x+$np,$y,48,8,'Tulis','Writing');$np+=48;
			$this->MakeColDblRow($x+$np,$y,0,8,'Lisan','Oral');$np+=35;
			$x=$this->GetX()+40; $y=$this->GetY();$this->SetXY($x,$y);
			$this->Cell(12,5,"Poor",1,0,'C',0); /////////////////
			$this->Cell(12,5,"Fair",1,0,'C',0);
			$this->Cell(24,5,"Excellent",1,0,'C',0);
			$this->Cell(12,5,"Poor",1,0,'C',0); //////////////////
			$this->Cell(12,5,"Fair",1,0,'C',0);
			$this->Cell(24,5,"Excellent",1,0,'C',0);
			$this->Cell(12,5,"Poor",1,0,'C',0); /////////////////
			$this->Cell(12,5,"Fair",1,0,'C',0);
			$this->Cell(0,5,"Excellent",1,1,'C',0);
			
			///////detail bahasa
			$this->SetFont('Arial','',8);
			
			$strsql = "SELECT * FROM tbl_jobseeker_language WHERE js_id='".$this->js_id."' ORDER BY jslanguage_id asc";
			$edu->query($strsql);
			if($edu->recordCount()){
				for ($i=0;$i<=$edu->recordCount();$i++){
					$edu->next();
					$language_name[$i]=$edu->row("language_name");
					//READING
					if ($edu->row("reading_status")=='kurang'){$rp[$i]='yes';}
					elseif($edu->row("reading_status")=='baik'){$rf[$i]='yes';}
					elseif($edu->row("reading_status")=='sangat baik'){$re[$i]='yes';}
					//WRITING
					if ($edu->row("writing_status")=='kurang'){$wp[$i]='yes';}
					elseif($edu->row("writing_status")=='baik'){$wf[$i]='yes';}
					elseif($edu->row("writing_status")=='sangat baik'){$we[$i]='yes';}
					//ORAL
					if ($edu->row("oral_status")=='kurang'){$op[$i]='yes';}
					elseif($edu->row("oral_status")=='baik'){$of[$i]='yes';}
					elseif($edu->row("oral_status")=='sangat baik'){$oe[$i]='yes';}
				}
			}
			
			for ($i=0;$i<3;$i++) {
				$this->Cell(40,5,$language_name[$i],1,0,'C',0); /////////////////
				$this->Cell(12,5,$rp[$i],1,0,'C',0); /////////////////
				$this->Cell(12,5,$rf[$i],1,0,'C',0);	
				$this->Cell(24,5,$re[$i],1,0,'C',0);
				$this->Cell(12,5,$wp[$i],1,0,'C',0); //////////////////
				$this->Cell(12,5,$wf[$i],1,0,'C',0);
				$this->Cell(24,5,$we[$i],1,0,'C',0);
				$this->Cell(12,5,$op[$i],1,0,'C',0); /////////////////
				$this->Cell(12,5,$of[$i],1,0,'C',0);
				$this->Cell(0,5,$oe[$i],1,1,'C',0);
			}
			/// AKTIVITAS SOSIAL
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"AKTIVITAS SOSIAL / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"SOCIAL ACTIVITIES",0,'L',0);
			$x=$this->GetX(); $y=$this->GetY();
			$this->MakeColDblRow($x,$y,40,8,'Organisasi','Organization');$np=40;
			$this->MakeColDblRow($x+$np,$y,48,8,'Tempat','Place');$np+=48;
			$this->MakeColDblRow($x+$np,$y,48,8,'Jabatan','Title');$np+=48;
			$this->MakeColDblRow($x+$np,$y,0,8,'Tahun','Year');$np+=35;
			
			/////// detail AKTIVITAS SOSIAL
			$x=$this->GetX(); $y=$this->GetY();
			$this->SetXY($x,$y);$this->SetFont('Arial','',8);
			
			$strsql = "SELECT * from tbl_jobseeker_activity WHERE js_id='".$this->js_id."' ORDER BY jsactivity_id asc";
			$edu->query($strsql);
			if($edu->recordCount()){
				for ($i=1;$i<=$edu->recordCount();$i++){
					$edu->next();
					$o_name[$i]=$edu->row("organization_name");
					$o_place[$i]=$edu->row("place");
					$o_job[$i]=$edu->row("title");
					$o_year[$i]=$edu->row("year_date");
				}
			}//if($edu->recordCount())
			
			for ($i=1;$i<=$edu->recordCount();$i++) {
				$this->Cell(40,5,$o_name[$i],1,0,'C',0); 
				$this->Cell(48,5,$o_place[$i],1,0,'C',0); 
				$this->Cell(48,5,$o_job[$i],1,0,'C',0);
				$this->Cell(0,5,$o_year[$i],1,1,'C',0);
			}
			//// Hoby dan Reading Freq
			$strsql = "SELECT * FROM tbl_jobseeker_addtional_info WHERE question='reading_freq' and js_id='".$this->js_id."'";
			$edu->query($strsql);
			if($edu->recordCount()){
				$edu->next();
				$reading_freq=$edu->row("answer_status");
				$reading_notes=$edu->row("answer");
			}
			
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->MakeColDblRow($x,$y,0,10,'Hobi :','Hobbies','L');$np=40;
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->MakeColDblRow($x,$y,40,20,'Frekwensi anda membaca','The frequency of reading','L');$np=40;
			$this->SetXY($x+40,$y);
			$this->MultiCell(40,20,$reading_freq,1,'L',0); //GARIS KOTAK 
			//$x=$this->GetX(); $y=$this->GetY()+2;
			$this->MakeColSingleRow($x+80,$y,100,20,"Pokok yang dibaca/",'Topics :',29);
			$this->SetXY($x+80,$y);
			$this->MultiCell(100,20,$reading_notes,0,'L',0); //GARIS KOTAK 	

			///////////////////////////////
			/// RIWAYAT PEKERJAAN
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"RIWAYAT PEKERJAAN / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"WORKING EXPERIENCE",0,'L',0);
			$x=$this->GetX(); $y=$this->GetY();
			$this->MakeColDblRow($x,$y,35,8,'Nama Perusahaan','Name of Company');$np=35;
			$this->MakeColDblRow($x+$np,$y,35,8,'Masa Kerja','Dates of Employe');$np+=35;
			$this->MakeColDblRow($x+$np,$y,35,8,'Jabatan','Title');$np+=35;
			$this->MakeColDblRow($x+$np,$y,35,8,'Penghasilan','Salary');$np+=35;
			$this->MakeColDblRow($x+$np,$y,0,8,'Alasan Berhenti','Reason of Resignation');$np+=35;
			
			$x=$this->GetX(); $y=$this->GetY();
			$this->SetXY($x,$y);$this->SetFont('Arial','',8);
			
			$job=cmsDB();
			$job->query("SELECT * FROM tbl_jobseeker_jobexp WHERE js_id='".$this->js_id."'");
			if($job->recordCount()){
				for ($l=0;$l<$job->recordCount();$l++){
					$job->next();
					$job_title[$l]=$job->row("job_title").$l;
					$job_company[$l]=$job->row("comp_name");
					$job_duration[$l]=$job->row("working_duration");
					$job_salary[$l]=$job->row("salary");			
					$job_resign[$l]=$job->row("reason_resign");
					//$job_desc[$l]=$job->row("job_desc");
				}
			}//if($job->recordCount())
			
			for ($i=0;$i<3;$i++) {
				$x=$this->GetX(); $y=$this->GetY();
				$split_text1 = str_split($job_company[$i],30);
				$split_text2 = str_split($job_title[$i],30);
				$sal = floatval($job_salary[$i]);
				//$this->Cell(35,5,strtoupper($job_company[$i]),1,0,'C',0); 
				//$this->Cell(35,5,$job_duration[$i],1,0,'C',0); 
				//$this->Cell(35,5,strtoupper($job_title[$i]),1,0,'C',0);
				//$this->Cell(35,5,$job_salary[$i],1,0,'C',0);
				//$this->Cell(0,5,$job_resign[$i],1,1,'C',0);
				//$this->Cell(0,5,'',1,1,'C',0);
				$this->MakeColDblRow2($x,$y,35,8,strtoupper($split_text1[0]),strtoupper($split_text1[1]));$np=35;
				$this->MakeColDblRow2($x+$np,$y,35,8,$job_duration[$i],'');$np+=35;
				$this->MakeColDblRow2($x+$np,$y,35,8,strtoupper($split_text2[0]),strtoupper($split_text2[1]));$np+=35;
				$this->MakeColDblRow2($x+$np,$y,35,8,number_format($sal),'');$np+=35;
				//$this->MakeColDblRow2($x+$np,$y,35,8,$job_salary[$i],'');$np+=35;
				$this->MakeColDblRow2($x+$np,$y,0,8,ucfirst($job_resign[$i]),'');
			}			

			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->MakeColDblRow($x,$y,0,8,'Uraian Tugas & Tanggung Jawab Anda Pada Jabatan Terakhir',
											'Description of Your Last Job');$np+=35;
			//$this->MultiCell($cw,25,$job_desc[$l-1],1,'L',0); //GARIS KOTAK ALAMAT
			$this->MultiCell($cw,25,'',1,'L',0); //GARIS KOTAK ALAMAT
			
			////////////Posisi Anda Dalam Struktur Organisasi
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->MakeColDblRow($x,$y,0,8,'Posisi Anda Dalam Struktur Organisasi',
											'Put Your Last Position in Organization Structure');$np+=35;
			//$this->MultiCell($cw,25,$organisasi_pos,1,'L',0); //GARIS KOTAK ALAMAT
			$this->MultiCell($cw,25,'',1,'L',0); //GARIS KOTAK ALAMAT
			
			$this->AddPage(); ///HALAMAN TIGA
			
			/// REFERENSI
			$x=$this->GetX(); $y=$this->GetY();
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"REFERENSI / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"REFERENCE",0,'L',0);
			$x=$this->GetX(); $y=$this->GetY();
			$this->MakeColDblRow($x,$y,40,8,'Nama','Name');$np=40;
			$this->MakeColDblRow($x+$np,$y,40,8,'Alamat / Telepon','Address / Phone');$np+=40;
			$this->MakeColDblRow($x+$np,$y,60,8,'Jabatan','Title');$np+=60;
			$this->MakeColDblRow($x+$np,$y,0,8,'Hubungan','Relation');$np+=35;
			
			///////detail REFERENSI
			$x=$this->GetX(); $y=$this->GetY();
			$this->SetXY($x,$y);$this->SetFont('Arial','',8);
			$reference=cmsDB();
			$reference->query("SELECT * FROM tbl_jobseeker_reference WHERE js_id='".$this->js_id."' ORDER BY jsreference_id asc");
			if($reference->recordCount()){
				$reference->next();
				$name1=$reference->row("name");
				$address1=$reference->row("address");
				$phone1=$reference->row("phone");
				$title1=$reference->row("title");
				$relation1=$reference->row("relation");
		
				$reference->next();
				$name2=$reference->row("name");
				$address2=$reference->row("address");
				$phone2=$reference->row("phone");
				$title2=$reference->row("title");
				$relation2=$reference->row("relation");
		
				$reference->next();
				$name3=$reference->row("name");
				$address3=$reference->row("address");
				$phone3=$reference->row("phone");
				$title3=$reference->row("title");
				$relation3=$reference->row("relation");
			}else{
				//$jsreference_id=0;
				$name1="";
				$address1="";
				$phone1="";
				$title1="";
				$relation1="";
				$name2="";
				$address2="";
				$phone2="";
				$title2="";
				$relation2="";
				$name3="";
				$address3="";
				$phone3="";
				$title3="";
				$relation3="";
			}
			//for ($i=1;$i<=3;$i++) {
				$this->Cell(40,5,$name1,1,0,'C',0); 
				$this->Cell(40,5,''." / ".$phone1,1,0,'C',0); 
				$this->Cell(60,5,$title1,1,0,'C',0);	
				$this->Cell(0,5,$relation1,1,1,'C',0);
				$this->Cell(40,5,$name2,1,0,'C',0); 
				$this->Cell(40,5,''." / ".$phone2,1,0,'C',0); 
				$this->Cell(60,5,$title2,1,0,'C',0);	
				$this->Cell(0,5,$relation2,1,1,'C',0);
				$this->Cell(40,5,$name3,1,0,'C',0); 
				$this->Cell(40,5,''." / ".$phone3,1,0,'C',0); 
				$this->Cell(60,5,$title3,1,0,'C',0);	
				$this->Cell(0,5,$relation3,1,1,'C',0);
			//}//for ($i=1;$i<=3;$i++)			
			
			//////////////////////////	
			/// Informasi Tambahan
			$x=$this->GetX(); $y=$this->GetY()+2;
			$this->SetXY($x,$y);
			$this->MultiCell($cw,5,"",1,'L',0); //GARIS KOTAK 
			$this->SetFont('Arial','B',8);
			$this->SetXY($x,$y);
			$this->MultiCell(75,5,"INFORMASI TAMBAHAN / ",0,'R',0);
			$this->SetFont('Arial','I',8);
			$this->SetXY($x+75,$y);
			$this->MultiCell(0,5,"ADDITIONAL INFORMATION",0,'L',0);
			$x=$this->GetX(); $y=$this->GetY();
			
			$this->MakeColDblRow($x,$y,10,8,'No.','');$np=10;
			$this->MakeColDblRow($x+$np,$y,100,8,'Pertanyaan','Question');$np+=100;
			$this->MakeColDblRow($x+$np,$y,10,8,'Ya','Yes');$np+=10;
			$this->MakeColDblRow($x+$np,$y,10,8,'Tidak','No');$np+=10;
			$this->MakeColDblRow($x+$np,$y,0,8,'Keterangan','Explanation');$np+=40;
			
			$itam_id=array('Apakah anda pernah melamar di perusahaan kami ?
Kapan & di posisi apa?',
						'Apakah anda terikat kontrak dengan perusahaan tempat anda bekerja saat ini ?',
						'Apakah anda memeliki kenalan / Saudara di Bank Mega ?',
						'Apakah anda pernah mengalami sakit / kecelakan berat ?  Sebutkan !',
						'Apakah anda pernah berurusan dengan polisi karena tindak kejahatan ?',
						'Bersediakah anda ditempatkan di luar kota ?');
			$itam_en=array('Have you ever sent application to our company ?
When & what did you apply for ?',
						'Are you under a working contract with the current company ?',
						'Do you have any reference in Bank Mega ?',
						'Have you ever been hospitalized ?',
						'Have you ever been involved with crime ?',
						'Are you willing to be placed in other city ?');
			
			$db_data = cmsDB();			
			$db_data->query("SELECT * FROM tbl_jobseeker_addtional_info WHERE question <>'reading_freq' AND js_id='".$this->js_id."'");
			if($db_data->recordCount()){
				for ($l=0;$l<=$db_data->recordCount();$l++){
					$db_data->next();
					if ($db_data->row("answer_status")=='yes') {$info_y[$l]='y';}
					else{$info_n[$l]='n';}
					
					$info_notes[$l]=$db_data->row("answer");
				}
			}
			
			for ($i=0;$i<count($itam_id);$i++){
				if ($i<=2 && $i<>0) $this->SetY($y+16);
				$x=$this->GetX(); $y=$this->GetY();
				$this->MakeColDblRow($x,$y,10,16,$i+1,'');$np=10;
				$this->MakeColDblRow($x+$np,$y,100,16,$itam_id[$i],$itam_en[$i],'L');$np+=100;
				$this->SetFont('Arial','',8);
				$this->MakeColDblRow($x+$np,$y,10,16,$info_y[$i],'');$np+=10;
				$this->MakeColDblRow($x+$np,$y,10,16,$info_n[$i],'');$np+=10;
				$this->MakeColDblRow($x+$np,$y,0,16,$info_notes[$i],'','L');$np+=40;
				$this->MakeColDblRow($x+$np,$y,0,16,'','','L');$np+=40;
			}
			
			/////////////////////////
			$x=$this->GetX(); $y=$this->GetY()+16;
			$this->MakeColDblRow($x,$y,10,8,'No.','');$np=10;
			$this->MakeColDblRow($x+$np,$y,80,8,'Pertanyaan','Question');$np+=80;
			$this->MakeColDblRow($x+$np,$y,0,8,'Pertanyaan','Answer');$np+=10;
			
			$itam_id=array('Tujuan anda melamar di perusahaan kami ?','Bidang pekerjaan yang disenangi?','Bidang pekerjaan yang tidak anda senangi ?','Pengetahuan and keahlian yang anda kuasai ?','Berapakah gaji dan tunjangan lain yang anda harapkan ?','Kapan anda dapat mulai bekerja ?');
			$itam_en=array('What is the purpose of applying to our company ?','What kind of job do you like ?','What kind of job do you like ?','What kind of knowledge and skill that you possess ?','What level of salary and other benefits do you expect ?','When will you be able to join this company ?');
			
			$db_data->query("SELECT * FROM tbl_jobseeker_questionare WHERE js_id='".$this->js_id."'");
			if($db_data->recordCount()){
				for ($i=0;$i<=$db_data->recordCount();$i++){
					$db_data->next();
					$question[$i]=$db_data->row("answer");
				}
			}//if($db_data->recordCount())
			
			for ($i=0;$i<count($itam_id);$i++){
				//if ($i<=2 && $i<>0) $this->SetY($y+16);
				$x=$this->GetX(); $y=$this->GetY();
				$this->MakeColDblRow($x,$y,10,8,$i+1,'');$np=10;
				$this->MakeColDblRow($x+$np,$y,80,8,$itam_id[$i],$itam_en[$i],'L');$np+=80;
				//$this->MakeColDblRow($x+$np,$y,0,8,'','','L'); //$np+=40;
				$this->SetXY($x+$np,$y);
				$this->SetFont('Arial','',8);
				$this->MultiCell(0,8,$question[$i],1,'L',0);
				//$this->MultiCell(0,8,'',1,'L',0);
			}
			
			//////////
			$x=$this->GetX(); $y=$this->GetY()+4;
			$this->SetXY($x,$y);$this->SetFont('Arial','',8);
			$this->Cell(0,5,"Demikianlah data dan informasi ini dibuat dengan sebenarnya",0,1,'L',0);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,5,"Where by declare that all the above data and information are true",0,1,'L',0);
			$this->ln(5);
			$this->SetX($x+120);$this->SetFont('Arial','',8);
			$this->Cell(0,5,"Jakarta, ".date('F j, Y'),0,1,'C',0);
			$this->SetX($x+120);$this->SetFont('Arial','I',8);
			$this->Cell(0,5,"Pelamar / Applicant",0,1,'C',0);
			$this->ln(10);
			$this->SetX($x+120);
			$this->Cell(0,5,"( ".$this->pelamar." )",0,0,'C',0);
		    $this->SetX($x+150);
            $this->Cell(0,30,"Form/DHRM/007/02/Rev.01",0,0,'C',0);
			
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
		function MakeColDblRow2($x,$y,$colW,$colH,$ft,$sdt,$align='C') {
			$this->SetXY($x,$y);
			$this->MultiCell($colW,$colH,"",1,$align,0); //GARIS KOTAK ALAMAT
			$this->SetFont('Arial','',8);
			$this->SetXY($x,$y);
			$this->MultiCell($colW,4,$ft,0,$align,0);
			$y=$this->GetY();
			$this->SetXY($x,$y);
			$this->SetFont('Arial','',8);
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
	$pdf->js_id=uriParam("js_id");
	$pdf->fillfooter="-- Document Automatically Generated by Mega Human Capital Information System ---";
	$pdf->SetTopMargin(20);
	$pdf->SetLeftMargin(15);
	$pdf->SetRightMargin(15);
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->Report_Content();
	$pdf->Output();
?>