<style>

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes http://10.14.18.173/pho/bb_get_photo.php?n=99070706&mf=M-->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="profile-user-img img-responsive" src="http://10.14.18.173/pho/bb_get_photo.php?n=<?php echo $userDetail['EmpId'];?>" alt="User Avatar" style="position:relative; top:-10px;">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $userDetail['EmpName'];?></h3>
              <h5 class="widget-user-desc"><?php echo $userDetail['position_name'];?></h5>
            </div>
            <div class="box-footer no-padding">
              
                <table class="table">
                  <tr>
                    <td width="220px">NIP</td>
                    <td width="5px">:</td>
                    <td style="text-align:left;"><?php echo $userDetail['username'];?></td>
                  </tr>

                  <tr>
                    <td width="220px">UNIT KERJA</td>
                    <td width="5px">:</td>
                    <td style="text-align:left;"><?php echo $userDetail['org_group_code'];?> - <?php echo $userDetail['org_group_detail'];?></td>
                  </tr>

                  <tr>
                    <td width="220px">TANGGAL BERGABUNG</td>
                    <td width="5px">:</td>
                    <td style="text-align:left;"><?php echo $userDetail['EmpJoinDAte'];?></td>
                  </tr>

                  <!-- CHECK DIREKTUR -->
                  <?php
                  if($userDetail['EmpGrade']=='DIR'){

                  }
                  else{
                    ?>
                    <tr>
                      <td width="220px">POSISI ATASAN</td>
                      <td width="5px">:</td>
                      <td style="text-align:left;"><?php echo $userDetail['ReportToNamer'];?></td>
                    </tr>

                    <tr>
                      <td width="220px">NAMA ATASAN</td>
                      <td width="5px">:</td>
                      <td style="text-align:left;"><?php echo $userDetail['namaAtasan'];?></td>
                    </tr>
                    <?php
                  }
                  ?>
                  
                  
                  
                </table>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-xs-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List Posisi </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="employee-list employee-list-in-box">
                <?php foreach($listposisi as $e): ?>
                <li class="item">
                  
                    
                  <!-- <p><?php echo $e->job_title;?></p> -->
                  <p><a href="#"><?php echo $e->position_id;?> &nbsp; - &nbsp;<?php echo $e->position_name;?></a></p>
                  
                </li>
                <?php endforeach; ?>  
                <!-- /.Employee -->
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper