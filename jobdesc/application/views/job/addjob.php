<script>
window.onbeforeunload = function(event)
{
    return confirm("Confirm refresh");
};
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-9">
        
            

            <div class="card card-signin my-5">                
                <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job Desc Info
                </h5>
                
                <div class="card-body">
                    <table class="table">
                        
                        <tbody>
                            <tr>
                                <th scope="row">Job Code</th>
                                <td><?php echo $id_job;?></td>
                            </tr>
                            <tr>
                                <th scope="row">Job Name</th>
                                <td><?php echo $detailjob->job_title;?></td>
                            </tr>
                            <tr>
                                <th scope="row"><button type="button" class="btn btn-primary">Send To Admin</button></th>
                                <td>
                                &nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>        
                </div>
            </div>


            <div class="card card-signin my-5">                
                <h5 class="card-header" style="background-color: #43425D; color:#fff;">Job Desc Detail
                <small class="float-sm-right"><a href="<?php echo base_url();?>index.php/job/review/<?php echo $id_job;?>"  target="_blank">Preview</a></small></h5>
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
                            
                            <!-- responsibilities -->
                            <div class="tab-pane fade show active" id="tgs">
                                </br>
                                <form id="tgstng">
                                    <div class="field_wrapper">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" name="tgs[]" class="form-control" placeholder="Responsibilities">
                                                <input type="hidden" name="id_job" value="<?php echo $id_job;?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <button type="button" width="300" id="appendform1" class="btn btn-primary add_button">Add</button>
                                            </div>
                                        </div>
                                    </div>

                                    </br>
                                    <button type="button" id="savetgs" class="btn btn-primary">Save</button>
                                </form>
                            </div>

                            <!-- Authority -->
                            <div class="tab-pane fade" id="kwn">
                                </br>
                                <form id="kwnkwn">
                                    <div class="field_wrapper_kwn">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" name="kwn[]" class="form-control" placeholder="Authority">
                                                <input type="hidden" name="id_job" value="<?php echo $id_job;?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <button type="button" width="300" id="appendform" class="btn btn-primary add_button_kwn">Add</button>
                                            </div>
                                        </div>
                                    </div>

                                    </br>
                                    <button type="button" id="savekwn" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="kua">
                            </br>
                                <form id="eduedu">                                    
                                    <div class="row ">
                                        <input type="hidden" name="id_job" value="<?php echo $id_job;?>" class="form-control">
                                        <div class="col-sm-4">
                                            <label>Education</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="pendidikan" class="form-control" placeholder="Education">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="jurusan" class="form-control" placeholder="Education">
                                        </div>
                                    </div>
                                    <div class="d-flex p-1"></div>
                                    <div class="row">
                                            <div class="col-sm-4">
                                                <label>Experience In Related Position</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="expposition" class="form-control" placeholder="Min Experience">
                                            </div>
                                    </div>
                                    <div class="d-flex p-1"></div>
                                        <div class="field_wrapper_exp">
                                            <div class="row">                                            
                                                <div class="col-sm-4">
                                                    <label>Experience Needed</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="exp[]" class="form-control" placeholder="Experience">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" width="300" id="appendform" class="btn btn-primary add_button_exp">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </br>
                                    <button type="button" id="saveexp" class="btn btn-primary">Save</button>
                                </form>
                            </div>

                            <!-- kompetensi -->
                            <div class="tab-pane fade" id="kom">
                                </br>
                                <form id="komkom">
                                    <div class="field_wrapper_kom">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" name="kom[]" class="form-control" placeholder="Competency">
                                                <input type="hidden" name="id_job" value="<?php echo $id_job;?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <button type="button" width="300" id="appendform" class="btn btn-primary add_button_kom">Add</button>
                                            </div>
                                        </div>
                                    </div>

                                    </br>
                                    <button type="button" id="savekom" class="btn btn-primary add_button">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
