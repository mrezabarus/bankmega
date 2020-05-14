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
            
            <li class="nav-item">
                <a class="nav-link btn active" id="soal1-tab" data-toggle="tab" href="#soal1" role="tab" aria-controls="profile" aria-selected="false">soal 1</a>
                
            </li>
            <li class="nav-item">
                <a class="nav-link btn" id="soal2-tab" data-toggle="tab" href="#soal2" role="tab" aria-controls="profile" aria-selected="false">soal 2</a>
            </li>
            
        </ul>
        
        <!-- tab kuesioner -->
        <div class="tab-content" id="myTabContent">
            
            <div class="tab-pane fade show active" id="soal1" role="tabpanel" aria-labelledby="soal1-tab">
                <div class="card">
                    <div class="card-body">
                        
                        <h5 class="card-title">Soal Kuesioner 1</h5>
                        <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                        <form>
                            <?php foreach($soalkuesioner1 as $e): ?>
                                
                                    <p class="m-t-sm"><?php echo $e->kuesioner;?></p>
                                    
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="1">
                                        <label class="custom-control-label" for="exampleRadios1">
                                            <?php echo $e->pilihan_1;?>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="2">
                                        <label class="custom-control-label" for="exampleRadios1">
                                            <?php echo $e->pilihan_2;?>
                                        </label>
                                    </div>
                                    <?php if ($e->pilihan_3==''){
                                    }
                                    else{
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="3">
                                            <label class="custom-control-label" for="exampleRadios1">
                                                <?php echo $e->pilihan_3;?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    
                                    <?php if($e->pilihan_4==''){

                                    }
                                    else{
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="option1">
                                            <label class="custom-control-label" for="exampleRadios1">
                                                <?php echo $e->pilihan_4;?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    
                                    <?php if($e->pilihan_5==''){

                                    }
                                    else{
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="option1">
                                            <label class="custom-control-label" for="exampleRadios1">
                                                <?php echo $e->pilihan_5;?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php if($e->pilihan_6==''){

                                    }
                                    else{
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="example<?php echo $e->id_soal;?>Radios" id="exampleRadios1" value="option1">
                                            <label class="custom-control-label" for="exampleRadios1">
                                                <?php echo $e->pilihan_6;?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php if($e->pilihan_7==''){

                                    }
                                    else{
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="option1">
                                            <label class="custom-control-label" for="exampleRadios1">
                                                <?php echo $e->pilihan_7;?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php if($e->pilihan_8==''){

                                    }
                                    else{
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="<?php echo $e->id_soal;?>" id="exampleRadios1" value="option1">
                                            <label class="custom-control-label" for="exampleRadios1">
                                                <?php echo $e->pilihan_8;?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                            <?php endforeach;?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>   


            <div class="tab-pane fade show" id="soal2" role="tabpanel" aria-labelledby="soal2-tab">
                <div class="card">
                    <div class="card-body">
                        
                        <h5 class="card-title">Basic Example Soal 2</h5>
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