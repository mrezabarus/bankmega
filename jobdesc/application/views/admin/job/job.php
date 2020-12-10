<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-9">
        
            <!-- <div class="card card-signin my-5">
                <div class="card-header" style="background-color: #43425D; color:#fff;">
                    Search
                </div>
                <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Directorate</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="directorate">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Organization</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="organization">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="position" placeholder="Password">
                        </div>
                    </div>
                </form>  
                    
                </div>
            </div> -->

            <div class="card card-signin my-5">                
            <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job List <small class="float-sm-right"><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i></a></small></h5>
                <div class="card-body">
                    
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID Job</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            <?php foreach($listjob as $e): ?>
                                <tr>
                                    <th scope="row"><?php echo $a;?></th>
                                    <td><?php echo $e->id_job;?></td>
                                    <td><?php echo $e->job_title;?></td>
                                    <td>
                                        <a href="<?php echo base_url();?>index.php/admin/job/view/<?php echo $e->position_id;?>"><i class="fas fa-binoculars"></i></a>
                                        <a href="<?php echo base_url();?>index.php/admin/job/add/<?php echo $e->position_id;?>"><i class="fas fa-plus"></i></a></i></a>
                                        <!-- <a href="<?php echo base_url();?>index.php/admin/job/edit/<?php echo $e->position_id;?>"><i class="fas fa-edit"></i></a></i></a> -->
                                    </td>
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

        
<!-- JOB LIST MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Job List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Direktorat</label>
                <select name="direktorat" class="form-control" id="direktorat">
                    <option>Directorate</option>
                    <?php foreach($direktorat->result() as $row):?>
                        <option value="<?php echo $row->id_dir;?>"><?php echo $row->dir_group_name;?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Organization</label>
                <select class="form-control organization" id="organization" name="organization">
                    <option>Organization Name</option>
                    
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Position Title</label>
                <select class="form-control postitle" id="postitle" name="postitle">
                    <option>Position Title</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Job Name</label>
                <input type="text" class="form-control" id="jobname" placeholder="Job Name">
                
            </div>
            
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveaddjoblist">Save changes</button>
        </div>
        </form>
        </div>
    </div>
</div>