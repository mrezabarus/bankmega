<script type="text/javascript">
    
    $('#direktorat').change(function(){
        var id=$(this).val();
        
        $.ajax({
            url : "<?php echo base_url();?>index.php/admin/dirorgpos/get_organisasi",
            method : "POST",
            data : {id: id},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                html += '<option>Organization Name</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].org_group_id+'>'+data[i].org_group_detail+'</option>';
                }
                $('.organization').html(html);
                    
            }
        });
    });
    
</script>

<script type="text/javascript">
    
    $('#organization').change(function(){
        var idorg=$(this).val();
        $.ajax({
            url : "<?php echo base_url();?>index.php/admin/dirorgpos/get_pos_title",
            method : "POST",
            data : {idorg: idorg},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                html += '<option>Position Title</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].position_id+'>'+data[i].position_title+'</option>';
                }
                $('.postitle').html(html);
                    
            }
        });
    });
    
</script>

