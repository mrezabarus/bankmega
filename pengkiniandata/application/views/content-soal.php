<div class="page-content">

        
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <h2 class="page-title">Forms</h2>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms.
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php foreach($namakuesioner as $e): ?>
            <li class="nav-item">
                <a class="nav-link btn" id="<?php echo $e->table_soal;?>-tab" data-toggle="tab" href="#<?php echo $e->table_soal;?>" role="tab" aria-controls="profile" aria-selected="false"><?php echo $e->table_soal;?></a>
            </li>
            <?php endforeach; ?>  
        </ul>
        
        <!-- tab kuesioner -->
        <div class="tab-content" id="myTabContent">
            <?php foreach($soalkuesioner as $eek): ?>
            <div class="tab-pane fade show active" id="<?php echo $eek->table_soal;?>" role="tabpanel" aria-labelledby="<?php echo $eek->table_soal;?>-tab">
                <div class="card">
                    <div class="card-body">
                        <?php foreach($soal_detail as $soal): ?>
                            <?php echo $soal->kuesioner;?>
                        <?php endforeach;?>
                        <h5 class="card-title">Basic Example</h5>
                        <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>            
            <?php endforeach; ?>
        </div>
    </div>
        
        
</div><!-- Page Content -->


<script type="text/javascript">

    $(document).ready(function() {

        $("#display").click(function() {     
            var url = "<?php echo base_url(); ?>index.php/home/soalshow";
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: url,             
                dataType: "json",   //expect html to be returned                
                success: function(response){                    
                    $('#soal').html(response.soal); //hold the response in id and show on popup
                }

            });
        });
    });

</script>