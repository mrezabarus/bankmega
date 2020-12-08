<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-9">
        
            

            <div class="card card-signin my-5">                
                <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job Desc Info</h5>
                
                <div class="card-body">
                    <table class="table">
                        
                        <tbody>
                            <tr>
                                <th scope="row">Job Code</th>
                                <td>STM.012.013</td>
                            </tr>
                            <tr>
                                <th scope="row">Job Name</th>
                                <td>STM.012.013</td>
                            </tr>
                        </tbody>
                    </table>        
                </div>
            </div>


            <div class="card card-signin my-5">                
                <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job Desc Detail</h5>
                <div class="card-body">
                    
                    <div class="bs-example">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#tgs" class="nav-link active" data-toggle="tab">Responsibilities</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kwn" class="nav-link" data-toggle="tab">Authority</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kua" class="nav-link" data-toggle="tab">Qualification</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kom" class="nav-link" data-toggle="tab">Competency</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tgs">
                                <h4 class="mt-2">Home tab content</h4>
                                <p>Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                            </div>
                            <div class="tab-pane fade" id="kwn">
                                <h4 class="mt-2">Profile tab content</h4>
                                <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
                            </div>
                            <div class="tab-pane fade" id="kua">
                                <h4 class="mt-2">Messages tab content</h4>
                                <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
                            </div>
                            <div class="tab-pane fade" id="kom">
                                <h4 class="mt-2">Messages tab content</h4>
                                <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
                            </div>
                        </div>
                    </div>

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
                <input type="text" class="form-control" id="jobfamily" aria-describedby="emailHelp" placeholder="Job Family Name">
                
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