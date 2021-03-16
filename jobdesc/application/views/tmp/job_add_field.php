<script type="text/javascript">
    
    /* tugas tanggung jawab */
    var maxField = 20;
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="col-sm-10"></br><input type="text" name="tgs[]" class="form-control" placeholder="Responsibilities"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"></br><button type="button" width="300" id="appendform" class="btn btn-primary remove_button">Delete</button></a></div>'; //New input field html 
	
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
    /* End tugas tanggung jawab */


    /* tugas tanggung jawab detail*/
    var maxFieldtgsdetail = 20;
	var addButton_tgsdetail = $('.add_button_tgsdetail'); //Add button selector
	var wrapper_tgsdetail = $('.field_wrapper_tgsdetail'); //Input field wrapper
	var addedit             = 'Hello'; 
    var fieldHTMLtgsdetail = '<div class="row"><div class="col-sm-10"></br><input type="text" name="tgs[]" class="form-control" placeholder="Responsibilities"></div><a href="javascript:void(0);" class="remove_button_tgsdetail" title="Remove field"></br><button type="button" width="300" id="appendform" class="btn btn-primary remove_button_tgsdetail">Delete</button></a></div>'; //New input field html 
	
	var xtgsdetail = 1; //Initial field counter is 1
	$(addButton_tgsdetail).click(function(){ //Once add button is clicked
        console.log(fieldHTMLtgsdetail);
		if(xtgsdetail < maxFieldtgsdetail){ //Check maximum number of input fields
            
			xtgsdetail++; //Increment field counter
			$(wrapper_tgsdetail).append(fieldHTMLtgsdetail); // Add field html
		}
	});

	$(wrapper_tgsdetail).on('click', '.remove_button_tgsdetail', function(e){ //Once remove button is clicked
        
        e.preventDefault();        
        var id = $(this).val();
        var tablename = 'job_tugas_tgg_jwb';   
        
        console.log(id);
        if(id!=''){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>index.php/job/deljob',
                data: {
                    id: id,tablename:tablename
                },
                cache: false,
                success: function(data) {
                    alert("Deleted");
                    location.reload();
                }
            });
        }
        

		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		xtgsdetail--; //Decrement field counter

	});


    /* Kewenangan */
    var maxField_kwn = 20;
	var addButton_kwn = $('.add_button_kwn'); //Add button selector
	var wrapper_kwn = $('.field_wrapper_kwn'); //Input field wrapper
	var wrapper_kwn_exist = $('.field_wrapper_kwn_exist'); //Input field wrapper
    var fieldHTML_kwn = '<div class="row"><div class="col-sm-10"></br><input type="text" name="kwn[]" class="form-control" placeholder="Authority"></div><a href="javascript:void(0);" class="remove_button_kwn" title="Remove field"></br><button type="button" width="300" id="appendform" class="btn btn-primary remove_button">Delete</button></a></div></div>'; //New input field html 
	
	var x_kwn = 1; //Initial field counter is 1
	$(addButton_kwn).click(function(){ //Once add button is clicked
		if(x_kwn < maxField_kwn){ //Check maximum number of input fields
			x_kwn++; //Increment field counter
			$(wrapper_kwn).append(fieldHTML_kwn); // Add field html
		}
	});
	$(wrapper_kwn).on('click', '.remove_button_kwn', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
    $(wrapper_kwn_exist).on('click', '.remove_button_kwnexist', function(e){ //Once remove button is clicked
        

        e.preventDefault();        
        var id = $(this).val();
        var tablename = 'job_kewenangan';   
        
        var kwn = "#kwn";
        
        if(id!=''){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>index.php/job/deljob',
                data: {
                    id: id, tablename: tablename
                },
                cache: false,
                success: function(data) {
                    alert("Deleted");
                    location.reload();
                }
            });
        }

		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});

	/* expneed */
    var maxField_exp = 20;
	var addButton_exp = $('.add_button_exp'); //Add button selector
	var wrapper_exp = $('.field_wrapper_exp'); //Input field wrapper
	var wrapper_exp_exist = $('.field_wrapper_exp_exist'); //Input field wrapper
    var fieldHTML_exp = '<div class="row"><div class="col-sm-4"><label>&nbsp;</label></div><div class="col-sm-4"></br><input type="text" name="exp[]" class="form-control" placeholder="Experience"></div><a href="javascript:void(0);" class="remove_button_exp" title="Remove field"></br><button type="button" width="300" id="appendform" class="btn btn-primary remove_button">Delete</button></a></div></div>'; //New input field html 
	
	var x_exp = 1; //Initial field counter is 1
	$(addButton_exp).click(function(){ //Once add button is clicked
		if(x_exp < maxField_exp){ //Check maximum number of input fields
			x_exp++; //Increment field counter
			$(wrapper_exp).append(fieldHTML_exp); // Add field html
		}
	});
	$(wrapper_exp).on('click', '.remove_button_exp', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
    $(wrapper_exp_exist).on('click', '.remove_button_expexist', function(e){ //Once remove button is clicked
        

        e.preventDefault();        
        var id = $(this).val();
        var tablename = 'job_pengalaman_kerja';   
        
        var kom = "#kom";
        
        if(id!=''){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>index.php/job/deljob',
                data: {
                    id: id, tablename: tablename
                },
                cache: false,
                success: function(data) {
                    alert("Deleted");
                    location.reload();
                }
            });
        }

		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});

    /* kompetensi */
    var maxField_kom = 20;
	var addButton_kom = $('.add_button_kom'); //Add button selector
	var wrapper_kom = $('.field_wrapper_kom'); //Input field wrapper
	var wrapper_kom_exist = $('.field_wrapper_kom_exist'); //Input field wrapper
    var fieldHTML_kom = '<div class="row"><div class="col-sm-10"></br><input type="text" name="kom[]" class="form-control" placeholder="Competency"></div><a href="javascript:void(0);" class="remove_button_kom" title="Remove field"></br><button type="button" width="300" id="appendform" class="btn btn-primary remove_button">Delete</button></a></div></div>'; //New input field html 
	
	var x_kom = 1; //Initial field counter is 1
	$(addButton_kom).click(function(){ //Once add button is clicked
		if(x_kom < maxField_kom){ //Check maximum number of input fields
			x_kom++; //Increment field counter
			$(wrapper_kom).append(fieldHTML_kom); // Add field html
		}
	});
	$(wrapper_kom).on('click', '.remove_button_kom', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
    $(wrapper_kom_exist).on('click', '.remove_button_komexist', function(e){ //Once remove button is clicked
        

        e.preventDefault();        
        var id = $(this).val();
        var tablename = 'job_kompetensi_sikap';   
        
        var kom = "#kom";
        
        if(id!=''){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>index.php/job/deljob',
                data: {
                    id: id, tablename: tablename
                },
                cache: false,
                success: function(data) {
                    alert("Deleted");
                    location.reload();
                }
            });
        }

		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
    
</script>

<!-- ajax responsibilities -->
<script type="text/javascript">    
	/* save tugas kewenangan */
    $('#savetgs').click(function(e){
        // var tgs = $('input[name="tgs[]"]').map(function(){ 
        //     return this.value; 
        // }).get();

        var datastring = $("#tgstng").serialize();

        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>index.php/job/savetugas',
            data: datastring,
            success: function(data) {
					alert("Data Saved");
                    location.reload();
                }
            });
    });
    
</script>

<!-- ajax authority -->
<script type="text/javascript">    
	/* save tugas kewenangan */
    $('#savekwn').click(function(e){
        // var tgs = $('input[name="tgs[]"]').map(function(){ 
        //     return this.value; 
        // }).get();

        var datastring = $("#kwnkwn").serialize();

        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>index.php/job/savekewenangan',
            data: datastring,
            success: function(data) {
                    alert("Data Saved");
                }
            });
    });
    
</script>

<!-- ajax experience -->
<script type="text/javascript">    
	/* save tugas kewenangan */
    $('#saveexp').click(function(e){
        // var tgs = $('input[name="tgs[]"]').map(function(){ 
        //     return this.value; 
        // }).get();

        var datastring = $("#eduedu").serialize();

        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>index.php/job/saveexperience',
            data: datastring,
            success: function(data) {
                    alert("Data Saved");
                }
            });
    });
    
</script>

<!-- ajax competency -->
<script type="text/javascript">    
	/* save tugas kewenangan */
    $('#savekom').click(function(e){
        // var tgs = $('input[name="tgs[]"]').map(function(){ 
        //     return this.value; 
        // }).get();

        var datastring = $("#komkom").serialize();

        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>index.php/job/savekompetensi',
            data: datastring,
            success: function(data) {
                    alert("Data Saved");
                }
            });
    });
    
</script>