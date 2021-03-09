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
    th { font-size: 12px; }
    td { font-size: 11px; }
    </style>
    
    <body>
        <div class="container">
            
            <div class="row">
                <div class="col-md-8"><img class="d-block" src="<?php echo base_url();?>assets/images/logo_mega.png" alt="" width="150"></div>
                <div class="col-md-4"><p>Deskripsi Jabatan<p><h3>Bank Mega</h3></div>
            </div>
            <hr/ style="background-color:#000;">

            
            <h3>1. Profile Jabatan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Posisi</th>
                        <th scope="col"><?php echo $profil->position_name; ?></th>
                        <th scope="col">Unit Kerja</th>
                        <th scope="col"><?php echo $profil->unit_kerja; ?></th>
                    </tr>
                    <tr>
                        <th scope="col">Nama Posisi Supervisor</th>
                        <th scope="col"><?php echo $profil->posisi_supervisor; ?></th>
                        <th scope="col">Direktorat</th>
                        <th scope="col"><?php echo $profil->dir_group_name; ?></th>
                    </tr>
                    <tr>
                        <th scope="col">Tgl Efektif</th>
                        <th scope="col"></th>
                        <th scope="col">Disiapkan Oleh</th>
                        <th scope="col"><?php echo $profil->unit_kerja; ?></th>
                    </tr>
                </thead>                
            </table>

            </br>
            <h3>2. Tanggung Jawab Jabatan</h3>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($respons as $e): ?>
                    <tr>
                        <th scope="col"><?php echo $a;?></th>
                        <th scope="col"><?php echo $e->tugas_tgg_jwb;?></th>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </thead>                
            </table>

            </br>
            <h3>3. Kewenangan</h3>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($kewenangan as $e): ?>
                    <tr>
                        <th scope="col"><?php echo $a;?></th>
                        <th scope="col"><?php echo $e->kewenangan;?></th>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </thead>                
            </table>

            </br>
            <h3>4. Kualifikasi Jabatan</h3>
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
                        <th scope="col"><?php echo $a;?></th>
                        <th scope="col"><?php echo $e->pengalaman;?></th>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </thead>                
            </table>
            
            <p>Kompetensi yang Dibutuhkan</p>
            <table class="table">
                <thead>
                    <?php $a = 1; ?>
                    <?php foreach($kompetensi as $e): ?>
                    <tr>
                        
                        <th scope="col"><?php echo $e->sikap;?></th>
                    </tr>
                    <?php $a++; ?>
                    <?php endforeach; ?>
                </thead>                
            </table>
        </div> <!-- /container -->
    </body>

        