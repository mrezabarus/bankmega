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
<link rel="stylesheet" href="path/to/file/picker.min.css">
<script type="text/javascript" src="path/to/file/picker.min.js"></script>

<div class="page-content">

<div class="container-fluid">
    <div class="row">
        
    </div>

    <div class="row">
        <div class="col-12">
            <!-- <div class="card">
                <div class="card-body">
                    <form>
                    <input name="id_property" id="id_property" class="form-control" type="text" placeholder="">
                        <div class="form-group">
                            <label for="inputAddress">Nama Property</label>
                            <input type="text" class="form-control" name="namaproperty" id="namaproperty" placeholder="Nama Property">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn_save">Submit</button>
                    </form>
                </div>
            </div> -->
            
    
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List
                        <small>Pendidikan</small> 
                        <div class="pull-right"><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Add Pendidikan</a></div>              
                    </h5> 
                    <div class="table-container">
                        <table class="table">
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
                </div>
            </div>

            <!-- MODAL ADD -->                
            <div class="modal fade bd-example-modal-xl" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="addPendidikan">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" > -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<select data-live-search="true" data-none-results-text="I found no results" title="Please select fruit" class="form-control selectpicker">
							<option>Mango</option>
							<option>Orange</option>
							<option>Lychee</option>
							<option>Pineapple</option>
							<option>Apple</option>
							<option>Banana</option>
							<option>Grapes</option>
							<option>Water Melon</option>
						</select>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Pendidikan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="errorTxt"></div>
                                <div class="form-group">
                                    <p><i>Tanggal Masuk</i></p>
                                    <input type='text' class="form-control" id='datetimepicker4' name="tglmasuk"/>
                                </div>

                                <div class="form-group">
                                    <p><i>Tanggal Lulus</i></p>
                                    <input type='text' class="form-control" id='datetimepicker5' name="tgllulus"/>
                                </div>
                                <div class="form-group">
                                    <p><i>Jenjang Pendidikan</i></p>
                                    <select class="form-control" name="jenjang_pendidikan">                                        
                                        <?php foreach($jenjang as $row):?>
                                            <option value="<?php echo $row->code_jenjang;?>" ><?php echo $row->nama;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div>
                                <div id="browserother" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherpen" type="text" placeholder="Other Browser" size="50" class="form-control" id="otherpen"/></label></p>
                                </div>
                                </br>
                                <div class="form-group">
                                    <p><i>Nama Institusi</i></p>
                                    <select class="form-control selectpicker" name="nama_institusi" id="nama_institusi">
                                    
                                        <option value="">No Selected</option>
                                        <?php foreach($institusi as $row):?>
                                            <option value="<?php echo $row->code_pt;?>"><?php echo $row->nama_pt;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div>
                                <div id="browserotherins" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherins" type="text" placeholder="Other Browser" size="50" class="form-control"/></label></p>
                                </div>
                                <div class="form-group">
						<label for="exampleDropdown">#1 # Dropdown Select with "data-live-search" </label>
						<select data-live-search="true" class="form-control selectpicker">
							<option>Mango</option>
							<option>Orange</option>
							<option>Lychee</option>
							<option>Pineapple</option>
							<option>Apple</option>
							<option>Banana</option>
							<option>Grapes</option>
							<option>Water Melon</option>
						</select>
					</div> 
					<div class="form-group">
						<label for="exampleDropdown">#2 Dropdown Select with "title" attribute</label>
						<select data-live-search="true" title="Please select fruit" class="form-control selectpicker">
							<option>Mango</option>
							<option>Orange</option>
							<option>Lychee</option>
							<option>Pineapple</option>
							<option>Apple</option>
							<option>Banana</option>
							<option>Grapes</option>
							<option>Water Melon</option>
						</select>
					</div>
					
                                </br>
                                <div class="form-group">
                                    <p><i>Studi</i></p>
                                    <select class="form-control" name="studi" id="studi" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($jurusan as $row):?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->nama_program_studi;?>&nbsp;-&nbsp;<?php echo $row->major_name;?>&nbsp;-&nbsp;<?php echo $row->jenjang;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div>
                                <div id="browserotherstd" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherstd" type="text" placeholder="Other Browser" size="50" class="form-control"/></label></p>
                                </div>
                                </br>
                                <div class="form-group">
                                    <p><i>Gelar</i></p>
                                    <select class="form-control selectpicker" name="gelar" id="gelar"  data-show-subtext="true" data-live-search="true">
                                        <option value="">No Selected</option>
                                        <?php foreach($gelar as $row):?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->inisial_gelar;?>&nbsp;-&nbsp;<?php echo $row->singkatan;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div> 
                                <div id="browserotherglr" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherglr" type="text" placeholder="Other Browser" size="50" class="form-control"/></label></p>
                                </div>
                                </br>  
                                                                 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-text-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn_upload" class="btn btn-text-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="modal-content">
                        <form class="form-horizontal" id="submit">
                            <div class="form-group">
                                <input type="text" name="judul" class="form-control" placeholder="Judul">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file">
                            </div>
            
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_upload" type="submit">Upload</button>
                            </div>
                        </form>  
                    </div> -->
                </div>
            </div>
            <!--END MODAL ADD-->


            <!-- MODAL Edit -->                
            <div class="modal fade bd-example-modal-xl" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="updPendidikan">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pendidikan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                                <input name="id" id="id" class="form-control" type="text" placeholder="">
                                <div class="form-group">
                                    <p><i>Tanggal Masuk</i></p>
                                    <input type='text' class="form-control" id='' name="tglmasuk_upd"/>
                                </div>

                                <div class="form-group">
                                    <p><i>Tanggal Lulus</i></p>
                                    <input type='text' class="form-control" id='' name="tgllulus_upd"/>
                                </div>
                                <div class="form-group">
                                    <p><i>Jenjang Pendidikan</i></p>
                                    <select class="form-control" name="jenjang_pendidikan_upd" id="jenjang_pendidikan_upd">    
                                        <option value="">No Selected</option>                                    
                                        <?php foreach($jenjang as $row):?>
                                            <option value="<?php echo $row->code_jenjang;?>" ><?php echo $row->nama;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div>
                                <div id="browserother_upd" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherpen_upd" type="text" placeholder="Other Browser" size="50" class="form-control" id="otherpen_upd"/></label></p>
                                </div>
                                </br>
                                <div class="form-group">
                                    <p><i>Nama Institusi</i></p>
                                    <select class="form-control" name="nama_institusi_upd" id="nama_institusi" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($institusi as $row):?>
                                            <option value="<?php echo $row->code_pt;?>"><?php echo $row->nama_pt;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div>
                                <div id="browserotherins_upd" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherins_upd" type="text" placeholder="Other Browser" size="50" class="form-control"/></label></p>
                                </div>
                                </br>
                                <div class="form-group">
                                    <p><i>Studi</i></p>
                                    <select class="form-control" name="studi_upd" id="studi_upd" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($jurusan as $row):?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->nama_program_studi;?>&nbsp;-&nbsp;<?php echo $row->major_name;?>&nbsp;-&nbsp;<?php echo $row->jenjang;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div>
                                <div id="browserotherstd_upd" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherstd_upd" type="text" placeholder="Other Browser" size="50" class="form-control"/></label></p>
                                </div>
                                </br>
                                <div class="form-group">
                                    <p><i>Gelar</i></p>
                                    <select class="form-control selectpicker" name="gelar_upd" id="gelar_upd"  data-show-subtext="true" data-live-search="true">
                                        <option value="">No Selected</option>
                                        <?php foreach($gelar as $row):?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->inisial_gelar;?>&nbsp;-&nbsp;<?php echo $row->singkatan;?></option>
                                        <?php endforeach;?>
                                        <option value="oth">Others</option>
                                    </select>
                                </div> 
                                
                                <div id="browserotherglr_upd" class="form-group">
                                    <p>Please Specify: <label id="browserlabel"><input name="otherglr_upd" type="text" placeholder="Other Browser" size="50" class="form-control"/></label></p>
                                </div>
                                </br>    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-text-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn_upd" class="btn btn-text-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--END MODAL Edit-->
        </div>
    </div>
</div>

</div><!-- Page Content -->


<script type="text/javascript">
$(document).ready(function() {
tampil_data_pendidikan();   //pemanggilan fungsi tampil Property.


});


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
                    '<td>'+data[i].nama_institusi+'</td>'+
                    '<td>'+data[i].studi+'</td>'+
                    
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

//Update Property
// $('#btn_upd').on('click',function(){
//     var id_unit=$('#id_unit').val();
//     var namaunit=$('#namaunit_upd').val();
//     var detail=$('#detail_upd').val();
//     var property=$('#property_upd').val();

//     //alert(id_unit+namaunit+detail+property);
//     $.ajax({
//         type : "POST",
//         url  : "<?php echo base_url('index.php/menu/update_unit')?>",
//         dataType : "JSON",
//         data : {id_unit:id_unit , namaunit:namaunit, detail:detail, property:property},
//         success: function(data){
//             $('[name="id_unit"]').val("");
//             $('[name="namaunit_upd"]').val("");
//             $('[name="property_upd"]').val("");
//             $('[name="detail_upd"]').val("");
//             $('#ModalaEdit').modal('hide');
//             tampil_data_unit();
//         }
//     });
//     return false;
// });
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
