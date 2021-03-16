<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Jobdesc App</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>assets/bootstrap-4.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- font awesome -->
        <link href="<?php echo base_url();?>assets/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

        <!-- font -->
        <link href="<?php echo base_url();?>assets/css/font.css" rel="stylesheet">
    </head>
    
    <style>
    th { font-size: 16px; }
    td { font-size: 14px; }
    body{
        background-color:#fff;
    }
    </style>
    
    <body>
        
            <div class="row">
                <div class="col-md-8"><img class="d-block" src="assets/images/logo_mega.png" alt="" width="150"></div>
                
            </div>
            <hr/ style="background-color:#000;">

            </br>
            <h5>1. Profile Jabatan</h5>
            <table class="table">
                <thead>
                    <tr>
                        <td><b>Nama Posisi</b></td>
                        <td><?php echo $profil->position_name; ?></td>
                        <td><b>Unit Kerja</b></td>
                        <td><?php echo $profil->unit_kerja; ?></td>
                    </tr>
                    <tr>
                        <td><b>Nama Posisi Supervisor</b></td>
                        <td><?php echo $profil->posisi_supervisor; ?></td>
                        <td><b>Direktorat</b></td>
                        <td><?php echo $profil->dir_group_name; ?></td>
                    </tr>
                    <tr>
                        <td><b>Tgl Efektif</b></td>
                        <td></td>
                        <td><b>Disiapkan Oleh</b></td>
                        <td><?php echo $profil->unit_kerja; ?></td>
                    </tr>
                </tdead>                
            </table>

            </br>
            <h5>2. Tanggung Jawab Jabatan</h5>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($respons as $e): ?>
                    <tr>
                        <td style="width:2%"><i class="fas fa-circle">&nbsp;&nbsp;&nbsp;</i></td>
                        <td><?php echo $e->tugas_tgg_jwb;?></td>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </tdead>                
            </table>

            </br>
            <h5>3. Kewenangan</h5>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($kewenangan as $e): ?>
                    <tr>
                        <td style="width:2%"><i class="fas fa-circle">&nbsp;&nbsp;&nbsp;</i></td>
                        <td><?php echo $e->kewenangan;?></td>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </tdead>                
            </table>

            </br>
            <h5>4. Kualifikasi Jabatan</h5>
            <p><b>Pendidikan</b></p>
            <p>Minimal <?php echo $pendidikan->min_education;?>, <?php echo $pendidikan->education;?></p>
            <hr/ style="background-color:#000;">
            <p>Pengalaman di posisi yang sama/setara <?php echo $experience->min_pengalaman;?> Tahun</p>
            <hr/ style="background-color:#000;">
            <p>Penglaman kerja yang dibutuhkan</p>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($jobpeng as $e): ?>
                    <tr>
                        <td style="width:2%"><i class="fas fa-circle">&nbsp;&nbsp;&nbsp;</i></td>
                        <td><?php echo $e->pengalaman;?></td>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </tdead>                
            </table>
            
            <p>Kompetensi yang Dibutuhkan</p>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($kompetensi as $e): ?>
                    <tr>
                        <td style="width:2%"><i class="fas fa-circle">&nbsp;&nbsp;&nbsp;</i></td>
                        <td><?php echo $e->sikap;?></td>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </tdead>                
            </table>
        
    </body>

        