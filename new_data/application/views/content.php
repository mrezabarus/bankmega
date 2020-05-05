

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
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Pendidikan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="errorTxt"></div>
                                
                                <div class="form-group">
                                    <p><i>Jenjang Pendidikan</i></p>
                                    <select class="form-control" name="jenjang_pendidikan" id="js-states">                                        
                                        <?php foreach($jenjang as $row):?>
                                            <option value="<?php echo $row->code_jenjang;?>" ><?php echo $row->nama;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p><i>Nama Institusi</i></p>
                                    <select class="form-control" name="nama_institusi" id="nama_institusi" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p><i>Studi</i></p>
                                    <select class="form-control" name="studi" id="studi" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p><i>Gelar</i></p>
                                    <select class="form-control selectpicker" name="gelar" id="gelar"  data-show-subtext="true" data-live-search="true">
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>                                    
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
                        <form id="updProperty">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Unit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                                <input name="id" id="id" class="form-control" type="hidden" placeholder="">
                                <div class="form-group">
                                    <p><i>Jenjang Pendidikan</i></p>
                                    <select class="form-control" name="jenjang_pendidikan_upd" id="jenjang_pendidikan_upd" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p><i>Nama Institusi</i></p>
                                    <select class="form-control" name="nama_institusi_upd" id="nama_institusi_upd" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p><i>Studi</i></p>
                                    <select class="form-control" name="studi_upd" id="studi_upd" require>
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p><i>Gelar</i></p>
                                    <select class="form-control selectpicker" name="gelar_upd" id="gelar_upd"  data-show-subtext="true" data-live-search="true">
                                        <option value="">No Selected</option>
                                        <?php foreach($property as $row):?>
                                            <option value="<?php echo $row->id_property;?>"><?php echo $row->property_name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>                                    
                                
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

$('#js-states').select2({ width: '100%' });
} );

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
    
var id=$(this).attr('data');
$('#ModalaEdit').modal('show');
$("html, body").animate({ scrollTop: 0 }, "slow");  
$.ajax({
    type : "GET",
    url  : "<?php echo base_url('index.php/home/get_pendidikan')?>",
    dataType : "JSON",
    data : {id:id},
    success: function(data){
        $.each(data,function(id, jenjang_pendidikan, nama_institusi, studi, gelar){
            $('#ModalaEdit').modal('show');
            $('[name="jenjang_pendidikan_upd"]').val(data.jenjang_pendidikan);
            $('[name="nama_institusi_upd"]').val(data.nama_institusi);
            $('[name="studi_upd"]').val(data.studi);
            $('[name="gelar_upd"]').val(data.gelar);
            
        });
    }
});
return false;
});


$('#addUnit').submit(function(e){
e.preventDefault(); 

$.ajax({
    url:'<?php echo base_url();?>index.php/menu/savePendidikan',
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
        $('[name="gelar_upd"]').val("");
        //$("uploaded_image").html(data);
        tampil_data_pendidikan();
    }
});


    
});

$('#updProperty').submit(function(e){
e.preventDefault(); 
    $.ajax({
    url:'<?php echo base_url();?>index.php/menu/update_unit',
    type:"post",
    data:new FormData(this),
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    
    success: function(data){
        $('[name="namaunit"]').val("");
        $('[name="property"]').val("");
        $('[name="keterangan"]').val("");
        $('#ModalaEdit').modal('hide');
        tampil_data_unit();
        location.reload();
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
</script>