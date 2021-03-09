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


    /* Kewenangan */
    var maxField_kwn = 20;
	var addButton_kwn = $('.add_button_kwn'); //Add button selector
	var wrapper_kwn = $('.field_wrapper_kwn'); //Input field wrapper
	
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

    /* kompetensi */
    var maxField_kom = 20;
	var addButton_kom = $('.add_button_kom'); //Add button selector
	var wrapper_kom = $('.field_wrapper_kom'); //Input field wrapper
	
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
    
</script>

<!-- ajax -->
<script type="text/javascript">    
	/* save tugas kewenangan */
    $('#savetgs').click(function(e){
        var tgs = $('input[name="tgs[]"]').map(function(){ 
            return this.value; 
        }).get();

        var datastring = $("#tgstng").serialize();

        $.ajax({
            type:'POST',
            url:'<?php echo base_url();?>index.php/admin/job/savekewenangan',
            data: datastring,
            success: function(data) {
                    alert(data);
                }
            });
    });
    
</script>