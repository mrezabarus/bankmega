<script type="text/javascript">    
    $('#saveaddjoblist').click(function(e){
        e.preventDefault();

        var direktorat      = $('#direktorat').val();
        var organization    = $('#organization').val();
        var postitle        = $('#postitle').val();
        var jobname         = $('#jobname').val();

        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/admin/job/addjoblist",
            dataType: "json",
            data: {
                direktorat: direktorat,
                organization: organization,
                postitle: postitle,
                jobname: jobname
            },
            cache: false,
            success : function(response){
                alert("Data Saved");
            }
        });      
    });
    
</script>





