<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-7 col-lg-6">
        
            <div class="card card-signin my-5">
                <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job Family <small class="float-sm-right"><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i></a></small></h5>
                    
                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID Job</th>
                                <th scope="col">Job Family</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            <?php foreach($jobfamily as $e): ?>
                                <tr>
                                    <th scope="row"><?php echo $a;?></th>
                                    <td><?php echo $e->id_job_family;?></td>
                                    <td><?php echo $e->job_family;?></td>
                                    <td><a href="<?php echo base_url();?>index.php/job/view/<?php echo $e->id_job_family;?>"><i class="fas fa-binoculars">&nbsp;</i></a>&nbsp;|&nbsp;<a href="edit"><i class="fas fa-edit">&nbsp;</i></a></td>
                                </tr>
                            <?php $a++; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th scope="col">#</th>
                                <th scope="col">Position Code</th>
                                <th scope="col">Position Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-7 col-lg-6">
        
            <div class="card card-signin my-5">
                <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job Category <small class="float-sm-right"><i class="fa fa-plus" aria-hidden="true"></i></small></h5>
               
                <div class="card-body">
                    
                </div>
            </div>
        </div>


<!-- MODAL NEW JOB FAMILY -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Job Family</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
        <div class="modal-body">
            
            <div class="form-group">
                <label for="exampleInputEmail1">Job Family</label>
                <input type="text" class="form-control" id="jobfamily" aria-describedby="emailHelp" placeholder="Job Family Name">
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Details</label>
                <input type="text" class="form-control" id="detailsjobfamily" placeholder="Details">
                <small id="emailHelp" class="form-text text-muted">Input details of Job Family</small>
            </div>
            
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
        </div>
    </div>
</div>
        

        