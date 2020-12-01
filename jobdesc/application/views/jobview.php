<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-8">
        
            <div class="card card-signin my-5">
                <div class="card-header" style="background-color: #43425D; color:#fff;">
                    Jobdesc
                </div>
                <div class="card-body">
                    Nama Posisi: <b>Lorem Ipsum</b>
                    <hr/>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Tugas tanggung jawab</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kewenangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kualifikasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kompetensi</a>
                        </li>
                    </ul>
                                        
                </div>
            </div>
        </div>

        <div class="col-sm-9 col-md-7 col-lg-4">        
            <div class="card card-signin my-5">
                <div class="card-body">
                    
                    <!-- <img class="mx-auto d-block rounded img-thumbnail" src="http://10.14.18.173/pho/bb_get_photo.php?n=<?php echo $userdet->EmpId;?>&mf=M" alt="" width="150"> -->
                    <img class="mx-auto d-block rounded img-thumbnail">
                    <h6 class="text-center"><?php echo $userdet->EmpName;?></h6>
                    <h6 class="text-center"><?php echo $userdet->position_name;?></h6>
                    <hr/>
                    <br/>
                    
                    <h5>Data Rekap</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Total Jobdesc</td>
                                <td><?php echo $totaljob['total'];?></td>                            
                            </tr>
                            <tr>
                                <td>Jobdesc Terisi</td>
                                <td>7</td>                            
                            </tr>
                            <tr>
                                <td>Jobdesc Belum</td>
                                <td>3</td>                            
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>