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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pendidikan</h1>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
                                <input placeholder="masukkan tanggal masuk" type="text" class="form-control datepicker" name="tgl_masuk">
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
                                <input placeholder="masukkan tanggal lulus" type="text" class="form-control datepicker" name="tgl_lulus">
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
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>                                        
            </div>
            
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


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