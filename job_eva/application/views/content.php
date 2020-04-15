<div class="page-content">

        <div class="container-fluid">
            <div class="row">
                
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List Posisi </h5>
                            
                            <ul class="report-list list-unstyled">
                                <?php foreach($listposisi as $e): ?>
                                <li class="report-item">
                                    <div class="report-icon">
                                        <a href="<?php echo base_url();?>index.php/home/soalkuesioner/<?php echo $e->id_job;?>" ><i class="material-icons">code</i></a>
                                    </div>
                                    <div class="report-text"><?php echo $e->job_title;?>
                                        <span>Status Sudah Done apa Belum</span>
                                    </div>
                                </li>
                                <?php endforeach; ?>  
                            </ul>
                        </div>
                    </div>
                </div>

                

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Browsers</h5>
                            <div class="card-info"><a href="#" class="btn btn-xs btn-text-dark"><i class="material-icons">refresh</i></a></div>
                            <ul class="list-unstyled browser-list">
                                <li class="trending-up"><span class="browser-icon"><i class="fab fa-chrome"></i></span>Google Chrome <span class="browser-stat">44% <i class="material-icons">trending_up</i></span></li>
                                <li class="trending-down"><span class="browser-icon"><i class="fab fa-firefox"></i></span>Mozilla Firefox <span class="browser-stat">23% <i class="material-icons">trending_down</i></span></li>
                                <li class="trending-down"><span class="browser-icon"><i class="fab fa-opera"></i></span>Opera <span class="browser-stat">13% <i class="material-icons">trending_down</i></span></li>
                                <li class="trending-up"><span class="browser-icon"><i class="fab fa-edge"></i></span>Microsoft Edge <span class="browser-stat">9% <i class="material-icons">trending_up</i></span></li>
                                <li class="trending-down"><span class="browser-icon"><i class="fab fa-safari"></i></span>Safari <span class="browser-stat">5% <i class="material-icons">trending_down</i></span></li>
                                <li class="trending-up"><span class="browser-icon"><i class="fas fa-globe"></i></span>Other <span class="browser-stat">6% <i class="material-icons">trending_up</i></span></li>
                            </ul>
                            <a href="#" class="btn btn-text-secondary float-right">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal untuk show pertanyaan -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Pertanyaan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div id="soal" align="center">

        
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-text-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-text-primary">Save changes</button>
                            </div>
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