<style>
#browserother{display:none;}
#browserotherlvljbt{display:none;}
#browserotherbdgtgs{display:none;}

#browserother_upd{display:none;}
#browserotherlvljbt_upd{display:none;}
#browserotherbdgtgs_upd{display:none;}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Riwayat Pekerjaan (di luar bank mega)</h1>
                </div><!-- /.col -->
                
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <a href="<?php echo base_url();?>index.php/home/detail" class="btn btn-primary" data-toggle="modal" data-target="#ModalaAdd">
                            Tambah Riwayat Kerja
                            </a></h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Perusahaan</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Tanggal Mulai</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody id="show_data">

                                </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="ModalaAdd">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="addHistoryJob">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Riwayat Kerja</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>nama institusi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="nama_institusi" id="nama_institusi">
                                                <option value="">No Selected</option>
                                                <?php foreach($institusi as $row):?>
                                                    <option value="<?php echo $row->code_pt;?>"><?php echo $row->nama_pt;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherins" class="form-group">
                                            </br>
                                            <p>
                                                <input name="otherins" type="text" placeholder="Other Browser" size="50" class="form-control"/>
                                            </p>
                                        </div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>nama perusahaan</label>
                                            <input name="namaperusahaan" type="text" placeholder="nama perusahaan" size="50" class="form-control"/>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>nama Posisi</label>
                                            <input name="namaposisi" type="text" placeholder="nama posisi" size="50" class="form-control"/>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                            
                                        <div class="form-group">
                                            <label>Tgl Masuk</label>
                                            <input placeholder="masukkan tanggal masuk" type="text" class="form-control datepicker" name="tglmasuk">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tgl Resign</label>
                                            <input placeholder="masukkan tanggal resign" type="text" class="form-control datepicker" name="tglresign">
                                        </div>
                                    </div>

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label>Bidang Usaha</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="bidang_usaha" id="bidang_usaha">
                                                <option value="">No Selected</option>
                                                <?php foreach($bidangusaha as $row):?>
                                                    <option value="<?php echo $row->sandi;?>" ><?php echo $row->bidang_usaha;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            <div id="browserother" class="form-group">
                                                </br>
                                                <p>                                        
                                                    <input name="otherusaha" type="text" placeholder="Other Bidang Usaha" size="50" class="form-control" id="otherusaha"/>
                                                </p>
                                            </div>
                                        </div>
                            
                                    </div>

                                    

                                    <div class="col-md-6">
                            

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Level Jabatan / Posisi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="level_jabatan" id="level_jabatan" >
                                                <option value="">No Selected</option>
                                                <?php foreach($leveljabatan as $row):?>
                                                    <option value="<?php echo $row->sandi_ojk;?>"><?php echo $row->level_jabatan;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            
                                            <div id="browserotherlvljbt" class="form-group">
                                                </br>
                                                <p>
                                                    <input name="otherlvljbt" type="text" placeholder="Other Level Jabatan" size="50" class="form-control"/>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->

                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bidang Tugas</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="bdgtgs" id="bdgtgs" >
                                                <option value="">No Selected</option>
                                                    <?php foreach($bidangtugas as $row):?>
                                                        <option value="<?php echo $row->sandi;?>"><?php echo $row->bidang_tugas;?></option>
                                                    <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherbdgtgs" class="form-group">
                                            
                                            <p>
                                                <input name="otherbdgtgs" type="text" placeholder="Other Browser" size="50" class="form-control"/>
                                            </p>
                                        </div>
                                    </div>

                                    
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>                                       
                        </div>
                        
                        <!-- /.card -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="ModalaEdit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="updHistoryJob">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Riwayat Kerja</h3>
                                <input name="id" id="id" class="form-control" type="hidden" placeholder="">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>nama institusi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="nama_institusi" id="nama_institusi">
                                                <option value="">No Selected</option>
                                                <?php foreach($institusi as $row):?>
                                                    <option value="<?php echo $row->code_pt;?>"><?php echo $row->nama_pt;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherins" class="form-group">
                                            </br>
                                            <p>
                                                <input name="otherins" type="text" placeholder="Other Browser" size="50" class="form-control"/>
                                            </p>
                                        </div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>nama perusahaan</label>
                                            <input name="namaperusahaan_upd" type="text" placeholder="nama perusahaan" size="50" class="form-control"/>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>nama Posisi</label>
                                            <input name="namaposisi_upd" type="text" placeholder="nama posisi" size="50" class="form-control"/>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                            
                                        <div class="form-group">
                                            <label>Tgl Masuk</label>
                                            <input placeholder="masukkan tanggal masuk" type="text" class="form-control datepicker" name="tglmasuk_upd">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tgl Resign</label>
                                            <input placeholder="masukkan tanggal resign" type="text" class="form-control datepicker" name="tglresign_upd">
                                        </div>
                                    </div>

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label>Bidang Usaha</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="bidang_usaha_upd" id="bidang_usaha_upd">
                                                <option value="">No Selected</option>
                                                <?php foreach($bidangusaha as $row):?>
                                                    <option value="<?php echo $row->sandi;?>" ><?php echo $row->bidang_usaha;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            <div id="browserother_upd" class="form-group">
                                                </br>
                                                <p>                                        
                                                    <input name="otherusaha_upd" type="text" placeholder="Other Bidang Usaha" size="50" class="form-control" id="otherusaha"/>
                                                </p>
                                            </div>
                                        </div>
                            
                                    </div>

                                    

                                    <div class="col-md-6">
                            

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Level Jabatan / Posisi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="level_jabatan_upd" id="level_jabatan_upd" >
                                                <option value="">No Selected</option>
                                                <?php foreach($leveljabatan as $row):?>
                                                    <option value="<?php echo $row->sandi_ojk;?>"><?php echo $row->level_jabatan;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            
                                            <div id="browserotherlvljbt_upd" class="form-group">
                                                </br>
                                                <p>
                                                    <input name="otherlvljbt_upd" type="text" placeholder="Other Level Jabatan" size="50" class="form-control"/>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->

                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bidang Tugas</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="bdgtgs_upd" id="bdgtgs_upd" >
                                                <option value="">No Selected</option>
                                                    <?php foreach($bidangtugas as $row):?>
                                                        <option value="<?php echo $row->sandi;?>"><?php echo $row->bidang_tugas;?></option>
                                                    <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherbdgtgs_upd" class="form-group">
                                            
                                            <p>
                                                <input name="otherbdgtgs_upd" type="text" placeholder="Other Browser" size="50" class="form-control"/>
                                            </p>
                                        </div>
                                    </div>

                                    
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>                                       
                        </div>
                        
                        <!-- /.card -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

  
<script type="text/javascript">

tampil_data_riwker();   //pemanggilan fungsi tampil Property.

function tampil_data_riwker(){
    $.ajax({
        type  : 'GET',
        url   : '<?php echo base_url()?>index.php/riwayatPekerjaan/data_riwker',
        async : true,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td>'+data[i].nama_perusahaan+'</td>'+
                        '<td>'+data[i].nama_posisi+'</td>'+
                        '<td>'+data[i].tgl_mulai+'</td>'+
                        '<td>'+data[i].tgl_selesai+'</td>'+

                        '<td>'+
                            '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id+'">Edit</a>'+' '+
                            '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].id+'">Hapus</a>'+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }

    });
}

//GET DATA untuk Isi Field
$('#show_data').on('click','.item_edit',function(){
    
    var idx=$(this).attr('data');
    //alert("Update Code "+idx);
    $('#ModalaEdit').modal('show');
    $("html, body").animate({ scrollTop: 0 }, "slow");  
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('index.php/riwayatPekerjaan/get_riwker')?>",
        dataType : "JSON",
        data : {idx:idx},
        success: function(data){
            $.each(data,function(idx){
                $('#ModalaEdit').modal('show');
                $('[name="id"]').val(data.id);
                $('[name="namaperusahaan_upd"]').val(data.nama_perusahaan);
                $('[name="namaposisi_upd"]').val(data.nama_posisi);
                $('[name="tglmasuk_upd"]').val(data.tgl_mulai);
                $('[name="tglresign_upd"]').val(data.tgl_selesai);
                //$('[name="bidang_usaha_upd"]').val(data.sandi);
                $('[name="bidang_usaha_upd"]').append("<option value='"+data.sandi+"' selected>"+data.bidang_usaha+"</option>");
                //$('[name="tglmulai_upd"]').find(":selected").text(data.tgl_mulai);
                // $('[name="nama_institusi_upd"]').find(":selected").text(data.nama_institusi);
                // $('[name="studi_upd"]').find(":selected").text(data.studi);
                // $('[name="gelar_upd"]').find(":selected").text(data.gelar);
                
                
            });
        }
    });
    return false;
});


$('#addHistoryJob').submit(function(e){
e.preventDefault(); 
//var otherpen = $('[name="otherpen"]').val();

$.ajax({
    url:'<?php echo base_url();?>index.php/riwayatPekerjaan/saveHistoryJob',
    method:"post",
    data:new FormData(this),
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    
    success: function(data){
        $('[name="namaperusahaan"]').val("");
        $('[name="tglmasuk"]').val("");
        $('[name="bidang_usaha"]').val("");
        $('[name="otherusaha"]').val("");
        $('[name="tglresign"]').val("");
        $('[name="level_jabatan"]').val("");
        $('[name="otherlvljbt"]').val("");
        $('[name="bdgtgs"]').val("");
        $('[name="otherbdgtgs"]').val("");
        
        $('#ModalaAdd').modal('hide');
        //$("uploaded_image").html(data);
        tampil_data_riwker();
    }
});


    
});

$('#updHistoryJob').submit(function(e){
e.preventDefault(); 
    $.ajax({
    url:'<?php echo base_url();?>index.php/riwayatPekerjaan/update_riwker',
    type:"post",
    data:new FormData(this),
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    
    success: function(data){
        $('[name="namaperusahaan"]').val("");
        $('[name="tglmasuk"]').val("");
        $('[name="bidang_usaha"]').val("");
        $('[name="otherusaha"]').val("");
        $('[name="tglresign"]').val("");
        $('[name="level_jabatan"]').val("");
        $('[name="otherlvljbt"]').val("");
        $('[name="bdgtgs"]').val("");
        $('[name="otherbdgtgs"]').val("");

        $('#ModalaEdit').modal('hide');
        //$("uploaded_image").html(data);
        tampil_data_riwker();
    }
    });
});
</script>

<script>
    $('select[name=bidang_usaha]').change(function(e){
        if ($('select[name=bidang_usaha]').val() == 'oth'){
            $('#browserother').show();
        }else{
            $('#browserother').hide();
        }
    });


    $('select[name=level_jabatan]').change(function(e){
    if ($('select[name=level_jabatan]').val() == 'oth'){
        $('#browserotherlvljbt').show();
    }else{
        $('#browserotherlvljbt').hide();
    }
    });

    $('select[name=bdgtgs]').change(function(e){
    if ($('select[name=bdgtgs]').val() == 'oth'){
        $('#browserotherbdgtgs').show();
    }else{
        $('#browserotherbdgtgs').hide();
    }
    });


</script>

<script>
    $('select[name=bidang_usaha_upd]').change(function(e){
        if ($('select[name=bidang_usaha_upd]').val() == 'oth'){
            $('#browserother_upd').show();
        }else{
            $('#browserother_upd').hide();
        }
    });


    $('select[name=level_jabatan_upd]').change(function(e){
    if ($('select[name=level_jabatan_upd]').val() == 'oth'){
        $('#browserotherlvljbt_upd').show();
    }else{
        $('#browserotherlvljbt_upd').hide();
    }
    });

    $('select[name=bdgtgs_upd]').change(function(e){
    if ($('select[name=bdgtgs_upd]').val() == 'oth'){
        $('#browserotherbdgtgs_upd').show();
    }else{
        $('#browserotherbdgtgs_upd').hide();
    }
    });


</script>