<style>
#browserother{display:none;}
#browserotherins{display:none;}
#browserotherstd{display:none;}
#browserotherglr{display:none;}

#browserother_upd{display:none}
#browserotherins_upd{display:none}
#browserotherstd_upd{display:none}
#browserotherglr_upd{display:none}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pendidikan</h1>
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
                            Tambah Pendidikan
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
                                        <th scope="col">Jenjang Pendidikan</th>
                                        <th scope="col">Nama Institusi</th>
                                        <th scope="col">Studi</th>
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
            <form id="addPendidikan">
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
                                <h3 class="card-title">Tambah Pendidikan</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                            
                                        <div class="form-group">
                                            <label>Tgl Masuk</label>
                                            <input placeholder="masukkan tanggal masuk" type="text" class="form-control datepicker" name="tglmasuk">
                                        </div>
                            
                                        <div class="form-group">
                                            <label>Jenjang Pendidikan</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="jenjang_pendidikan" id="jenjang_pendidikan">
                                                <option value="">No Selected</option>
                                                <?php foreach($jenjang as $row):?>
                                                    <option value="<?php echo $row->code_jenjang;?>" ><?php echo $row->nama;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            <div id="browserother" class="form-group">
                                                </br>
                                                <p>                                        
                                                    <input name="otherpen" type="text" placeholder="Other Jenjang Pendidikan" size="50" class="form-control" id="otherpen"/>
                                                </p>
                                            </div>
                                        </div>
                            
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tgl Lulus</label>
                                            <input placeholder="masukkan tanggal lulus" type="text" class="form-control datepicker" name="tgllulus">
                                        </div>
                            

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Studi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="studi" id="studi" >
                                                <option value="">No Selected</option>
                                                <?php foreach($jurusan as $row):?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $row->nama_program_studi;?>&nbsp;-&nbsp;<?php echo $row->major_name;?>&nbsp;-&nbsp;<?php echo $row->jenjang;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            
                                            <div id="browserotherstd" class="form-group">
                                                </br>
                                                <p>
                                                    <input name="otherstd" type="text" placeholder="Other Studi" size="50" class="form-control"/>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-12">
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
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Gelar</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="gelar" id="gelar" >
                                                <option value="">No Selected</option>
                                                    <?php foreach($gelar as $row):?>
                                                        <option value="<?php echo $row->id;?>"><?php echo $row->inisial_gelar;?>&nbsp;-&nbsp;<?php echo $row->singkatan;?></option>
                                                    <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherglr" class="form-group">
                                            
                                            <p>
                                                <input name="otherglr" type="text" placeholder="Other Browser" size="50" class="form-control"/>
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
            <form id="updPendidikan">
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
                                <h3 class="card-title">Update Pendidikan</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <input name="id" id="id" class="form-control" type="hidden" placeholder="">
                                    <div class="col-md-6">                                        
                                        
                                        <div class="form-group">
                                            <label>Tgl Masuk</label>
                                            <input placeholder="masukkan tanggal masuk" type="text" class="form-control datepicker" name="tglmasuk_upd">
                                        </div>
                            
                                        <div class="form-group">
                                            <label>Jenjang Pendidikan</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="jenjang_pendidikan_upd" id="jenjang_pendidikan_upd">
                                                <option value="">No Selected</option>
                                                <?php foreach($jenjang as $row):?>
                                                    <option value="<?php echo $row->code_jenjang;?>" ><?php echo $row->nama;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            <div id="browserother" class="form-group">
                                                </br>
                                                <p>                                        
                                                    <input name="otherpen_upd" type="text" placeholder="Other Jenjang Pendidikan" size="50" class="form-control" id="otherpen_upd"/>
                                                </p>
                                            </div>
                                        </div>
                            
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tgl Lulus</label>
                                            <input placeholder="masukkan tanggal lulus" type="text" class="form-control datepicker" name="tgllulus_upd">
                                        </div>
                            

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Studi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="studi_upd" id="studi_upd" >
                                                <option value="">No Selected</option>
                                                <?php foreach($jurusan as $row):?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $row->nama_program_studi;?>&nbsp;-&nbsp;<?php echo $row->major_name;?>&nbsp;-&nbsp;<?php echo $row->jenjang;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                            
                                            <div id="browserotherstd_upd" class="form-group">
                                                </br>
                                                <p>
                                                    <input name="otherstd_upd" type="text" placeholder="Other Studi" size="50" class="form-control"/>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>nama institusi</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="nama_institusi_upd" id="nama_institusi_upd">
                                                <option value="">No Selected</option>
                                                <?php foreach($institusi as $row):?>
                                                    <option value="<?php echo $row->code_pt;?>"><?php echo $row->nama_pt;?></option>
                                                <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherins_upd" class="form-group">
                                            </br>
                                            <p>
                                                <input name="otherins_upd" type="text" placeholder="Other Browser" size="50" class="form-control"/>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Gelar</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="gelar_upd" id="gelar_upd" >
                                                <option value="">No Selected</option>
                                                    <?php foreach($gelar as $row):?>
                                                        <option value="<?php echo $row->id;?>"><?php echo $row->inisial_gelar;?>&nbsp;-&nbsp;<?php echo $row->singkatan;?></option>
                                                    <?php endforeach;?>
                                                <option value="oth">Others</option>
                                            </select>
                                        </div>
                                        <div id="browserotherglr_upd" class="form-group">
                                            
                                            <p>
                                                <input name="otherglr_upd" type="text" placeholder="Other Browser" size="50" class="form-control"/>
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
                    <button type="submit" class="btn btn-primary" id="btn_upd">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
  
<script type="text/javascript">

tampil_data_pendidikan();   //pemanggilan fungsi tampil Property.

function tampil_data_pendidikan(){
    $.ajax({
        type  : 'GET',
        url   : '<?php echo base_url()?>index.php/home/data_pendidikan',
        async : true,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td>'+data[i].jenjang_pendidikan+'</td>'+
                        '<td>'+data[i].nama_pt+'</td>'+
                        '<td>'+data[i].nama_program_studi+'</td>'+
                        
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
    alert("Update Code "+idx);
    $('#ModalaEdit').modal('show');
    $("html, body").animate({ scrollTop: 0 }, "slow");  
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('index.php/home/get_pendidikan')?>",
        dataType : "JSON",
        data : {id:idx},
        success: function(data){
            $.each(data,function(id, tgl_masuk, tgl_lulus, jenjang_pendidikan, nama_institusi, studi, gelar){
                $('#ModalaEdit').modal('show');
                // $('[name="id"]').val(data.id);
                // $('[name="tglmasuk_upd"]').val(data.tgl_masuk);
                // $('[name="tgllulus_upd"]').val(data.tgl_lulus);
                // $('[name="jenjang_pendidikan_upd"]').find(":selected").text(data.jenjang_pendidikan);
                // $('[name="nama_institusi_upd"]').find(":selected").text(data.nama_institusi);
                // $('[name="studi_upd"]').find(":selected").text(data.studi);
                // $('[name="gelar_upd"]').find(":selected").text(data.gelar);
                $('[name="id"]').val(data.id);
                
            });
        }
    });
    return false;
});


$('#addPendidikan').submit(function(e){
e.preventDefault(); 
//var otherpen = $('[name="otherpen"]').val();

$.ajax({
    url:'<?php echo base_url();?>index.php/home/savePendidikan',
    method:"post",
    data:new FormData(this),
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    
    success: function(data){
        $('[name="jenjang_pendidikan"]').val("");
        $('[name="nama_institusi"]').val("");
        $('[name="studi"]').val("");
        $('[name="gelar"]').val("");
        $('#ModalaAdd').modal('hide');
        //$("uploaded_image").html(data);
        tampil_data_pendidikan();
    }
});


    
});

$('#updPendidikan').submit(function(e){
e.preventDefault(); 
    $.ajax({
    url:'<?php echo base_url();?>index.php/home/update_pendidikan',
    type:"post",
    data:new FormData(this),
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    
    success: function(data){
        $('[name="jenjang_pendidikan_upd"]').val("");
        $('[name="nama_institusi_upd"]').val("");
        $('[name="studi_upd"]').val("");
        $('[name="gelar_upd"]').val("");
        $('#ModalaEdit').modal('hide');
        //$("uploaded_image").html(data);
        tampil_data_pendidikan();
    }
    });
});
</script>

<script>
    $('select[name=jenjang_pendidikan]').change(function(e){
        if ($('select[name=jenjang_pendidikan]').val() == 'oth'){
            $('#browserother').show();
        }else{
            $('#browserother').hide();
        }
    });

$('select[name=nama_institusi]').change(function(e){
  if ($('select[name=nama_institusi]').val() == 'oth'){
    $('#browserotherins').show();
  }else{
    $('#browserotherins').hide();
  }
});

$('select[name=studi]').change(function(e){
  if ($('select[name=studi]').val() == 'oth'){
    $('#browserotherstd').show();
  }else{
    $('#browserotherstd').hide();
  }
});

$('select[name=gelar]').change(function(e){
  if ($('select[name=gelar]').val() == 'oth'){
    $('#browserotherglr').show();
  }else{
    $('#browserotherglr').hide();
  }
});


$('select[name=jenjang_pendidikan_upd]').change(function(e){
  if ($('select[name=jenjang_pendidikan_upd]').val() == 'oth'){
    $('#browserother_upd').show();
  }else{
    $('#browserother_upd').hide();
  }
});

$('select[name=nama_institusi_upd]').change(function(e){
  if ($('select[name=nama_institusi_upd]').val() == 'oth'){
    $('#browserotherins_upd').show();
  }else{
    $('#browserotherins_upd').hide();
  }
});

$('select[name=studi_upd]').change(function(e){
  if ($('select[name=studi_upd]').val() == 'oth'){
    $('#browserotherstd_upd').show();
  }else{
    $('#browserotherstd_upd').hide();
  }
});

$('select[name=gelar_upd]').change(function(e){
  if ($('select[name=gelar_upd]').val() == 'oth'){
    $('#browserotherglr_upd').show();
  }else{
    $('#browserotherglr_upd').hide();
  }
});
</script>