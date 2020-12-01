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
                <div class="card-header" style="background-color: #43425D; color:#fff;">
                    Position List
                </div>
                <div class="card-body">
                    
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Position Code</th>
                                <th scope="col">Position Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            <?php foreach($listjob as $e): ?>
                                <tr>
                                    <th scope="row"><?php echo $a;?></th>
                                    <td><?php echo $e->id_pos_title;?></td>
                                    <td><?php echo $e->position_title;?></td>
                                    <td><a href="<?php echo base_url();?>index.php/job/view/<?php echo $e->id_pos_title;?>"><i class="fas fa-binoculars">&nbsp;</i></a>&nbsp;|&nbsp;<a href="edit"><i class="fas fa-edit">&nbsp;</i></a></td>
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

        