		  <ul class="nav navbar-nav navbar-right">
			<?php 
			if(!empty($_SESSION['status'])){
				$sstatus = $_SESSION['status'];
			}
			else{			
				$sstatus = '';
			}
			
			if($sstatus==='admin' && !empty($_SESSION['lbrary_nip'])){
				$this->load->view('navbar_adminmax');
			}
			elseif($sstatus==='pic' && !empty($_SESSION['lbrary_nip'])){
				$this->load->view('navbar_pic');
			}
			elseif($sstatus==='region' && !empty($_SESSION['lbrary_nip'])){
				$this->load->view('navbar_region');
			}
			?>
		  
			<li class="dropdown">
              <a aria-expanded="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $_SESSION['name2lwr']; ?>  <span class="caret"> </span></a>
              <ul role="menu" class="dropdown-menu">
				<!--
                <li><a href="<?php echo base_url(); ?>index.php/welcome/Evaluate">Evaluate</a></li> -->
                <li><a href="<?php echo base_url(); ?>index.php/welcome/KalenderTraining">Kalender Training</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/welcome/EditProfile">Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/welcome/ChangePassword">Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/welcome/SignOut">Sign Out</a></li>
              </ul>
            </li>
		  </ul>		  