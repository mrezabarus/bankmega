<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-8">
        
            <div class="card card-signin my-5">
                <div class="card-header" style="background-color: #43425D; color:#fff;">
                    List Posisi
                </div>
                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Posisi</th>
                            <th scope="col">Nama Posisi</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $a = 1; ?>
                        <?php foreach($listjob as $e): ?>
                            <tr>
                                <th scope="row"><?php echo $a;?></th>
                                <td><?php echo $e->position_id;?></td>
                                <td><?php echo $e->position_name;?></td>
                                <td><a href="<?php echo base_url();?>index.php/job/view/<?php echo $e->position_id;?>"><i class="fas fa-binoculars">&nbsp;</i></a>&nbsp;|&nbsp;<a href="edit"><i class="fas fa-edit">&nbsp;</i></a></td>
                            </tr>
                        <?php $a++; ?>
                        <?php endforeach; ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        