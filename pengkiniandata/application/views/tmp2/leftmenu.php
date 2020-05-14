<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url();?>templates/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Update Data</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>templates/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $userdetail['employeename'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?php echo base_url();?>index.php/Home" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pendidikan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url();?>index.php/RiwayatPekerjaan" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Riwayat Pekerjaan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url();?>index.php/verifylogin/logout" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>