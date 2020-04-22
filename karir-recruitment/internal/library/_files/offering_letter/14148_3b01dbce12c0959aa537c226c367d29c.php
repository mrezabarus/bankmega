<?php
require_once("../../../rtf/Rtf.php");
function writeSectionText(&$sect, &$arial14, &$times12, &$text, &$text2, &$text3) {      
//    $sect->writeText('Sample RTF document', $arial14, new ParFormat());
    $sect->writeText($text,$times12, new ParFormat());

//    $sect->writeText('Character encoding', $arial14, new ParFormat());
//    $sect->writeText($text2, $times12, new ParFormat());
//    
//    $sect->writeText('Common implementations', $arial14, new ParFormat());
//    $sect->writeText($text3, $times12, new ParFormat());      
}

$text = '






Jakarta, 11-Jun-2015


Nomor	: 001/HCMD-OL/08
Lampiran	: -
Perihal	: Penawaran Kerja



Kepada Yth.
Sdr/i. <b>Wenly Kilmanun (Batal Join)</b>
<b>KPR Moyo KM 12</b>


Dengan Hormat,

Sehubungan dengan lamaran pekerjaan Saudara serta hasil interview dan test yang telah kita laksanakan, pada prinsipnya kami menyetujui permohonan Saudara untuk menjadi pegawai PT. Bank Mega, Tbk dengan ketentuan sebagai berikut :


I.  <b>Ketentuan Umum :</b>
    1. Status Kepegawaian	: Pegawai dengan 3 (tiga) bulan masa percobaan.
    2. Jabatan		: SME-AO SME
    3. Pangkat & Golongan	: JO
    4. Unit Kerja	: Regional Makasar-KC Sorong
    5. Jam Kerja	: - Senin s/d Kamis, 08.00 s/d 17.00 Waktu setempat
   		  - Jumat, 08.00 s/d 17.30 Waktu Setempat
		  - Sudah termasuk 1 jam untuk istirahat.
       Jadwal kerja dapat berubah disesuaikan dengan kondisi pekerjaan dan pengembangan perusahaan
       namun jumlah jam kerja tetap tidak melebihi 40 jam seminggu sesuai dengan Undang-Undang. 
    6. Hak Cuti Tahunan	: 12 (dua belas) hari kerja setelah masa kerja minimal 1 (satu) tahun.
    7. Pengunduran Diri : Secara tertulis disampaikan minimum 30 (tiga puluh) hari sebelumnya.

II. <b>Gaji, Tunjangan dan Jamsostek :</b>
    A. Gaji Pokok	: Rp. 3.000.000,-
    B. Tunjangan-tunjungan	: 
       Diberikan dari mulai masuk sebagai pegawai dalam masa percobaan :
    1. Tunjangan Jabatan	: Tidak Ada
    2. Tunjangan makan	: Rp. 300.000,-
    3. Tunjangan Transport	: Rp. 15.000,- Per hari kerja yang diberikan bersamaan dengan pembayaran gaji bulanan
    C. Potongan Jamsostek	: Sebesar 2 % dari gaji pokok dan Tunjangan makan, sesuai tanggal efektif bekerja. 

                                                                                                             







    Diberikan setelah diangkat menjadi pegawai tetap
    1. Bantuan kesehatan	: Diberikan sesuai dengan Peraturan dan Ketentuan Perusahaan yang berlaku. 
    2. Tunjangan Hari Raya
          Keagamaan	: Besarnya 1 (satu) bulan gaji pokok dan tunjangan makan, yang akan Diberikan 
		  2 (dua) minggu sebelum Hari Raya Keagaamaan tersebut.
		  Pegawai yang masa kerjanya kurang dari 1 (satu) tahun tetapi lebih Dari 3 bulan
		  diberikan secara pro rata. 
	3. Tunjangan Cuti	: Besarnya 1 (satu) bulan gaji pokok dan tunjangan makan, dibayarkan Bersamaan
          Tahunan	  dengan pembayaran gaji bulanan pada saat cuti akan Dilaksanakan.


III. <b>Tanggal Mulai Bekerja :</b> 23/03/2015
      Kondisi dan ketentuan-ketentuan lain yang tidak tersebut di atas diatur dalam peraturan perusahaan dan
      Sistem & Prosedur Kepegawaian PT. Bank Mega, Tbk beserta keputusan Direksi yang berlaku. 
      Demikian penawaran kerja dan kondisi yang kami sampaikan, apabila Saudara menyetujui, harap Saudara
      menandatangani salinan surat ini dan mengembalikannya kepada kami.
      Atas perhatian Saudara kami ucapkan terimakasih. 



Hormat Kami,

<b>PT. BANK MEGA Tbk,</b>





<b>Tjutjut Bramantoro</b>                                         <b>Ariza Sufian</b>
Direktur                                                          Pjs. Pemimpin HCMD


...................................................................................................................
Saya menerima dan menyetujui penawaran beserta ketentuan-ketentuan yang ada di atas,
dan saya siap bekerja mulai tanggal,........................


Jakarta,................................



(....................)';

$times12 = new Font(12, 'Times new Roman');
$arial14 = new Font(12, 'Arial', '#000066');

$parFormat = new ParFormat();

//rtf document
$rtf = new Rtf();
//borders
//$rtf->setBorders(new BorderFormat(1, '#0000ff'), 1, 0, 1, 0);
//$rtf->setBorders(new BorderFormat(2, '#ff0000'), 0, 1, 0, 1);
//headers
//$rtf->setOddEvenDifferent(1);

//$header = &$rtf->addHeader('left');
//$header->writeText("PhpRtf class library. Left document header", $times12, $parFormat);

//$header = &$rtf->addHeader('right');
//$header->writeText("PhpRtf class library. Right document header", $times12, $parFormat);



//section 1
$sect = &$rtf->addSection();
$sect->setPaperHeight(29);
$sect->setPaperWidth(25);
//Borders overriden: No Borders
//$sect->setBorders(new BorderFormat(0));
//$sect->setSpaceBetweenColumns(1);
//$sect->setColumnsCount(2);
//$sect->setLineBetweenColumns();
//
//writeSectionText($sect, $arial14, $times12, $text, $text2, $text3);
      
////section 2
//$sect = &$rtf->addSection();
////Header overriden
//$header = &$sect->addHeader('right');
//$header->writeText("PhpRtf class library. Overriden right section header", $times12, $parFormat);
//$header = &$sect->addHeader('left');
//$header->writeText("PhpRtf class library. Overriden left section header", $times12, $parFormat);
////Borders overriden: Green border
//$sect->setBorders(new BorderFormat(1, '#00ff00', 'dash', 1));
//
//writeSectionText($sect, $arial14, $times12, $text, $text2, $text3);

//section 3
//$sect = &$rtf->addSection();
//$sect->setColumns(array(3, 3, 8));    
//Border from rtf
//....

writeSectionText($sect, $arial14, $times12, $text, $text2, $text3);

$rtf->sendRtf('Document');
?> 