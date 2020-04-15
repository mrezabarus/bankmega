<div class="page-sidebar">
    <div class="page-sidebar-inner">
        <div class="page-sidebar-profile">
            <div class="sidebar-profile-image">
                <img src="<?php echo base_url();?>template/assets/images/avatars/avatar1.png">
            </div>
            <div class="sidebar-profile-info">
                <a href="javascript:void(0);" class="account-settings-link">
                    <p><?php echo $userdetail['employeename'];?></p>
                    <span><?php echo $userdetail['positiontitle'];?><i class="material-icons float-right">arrow_drop_down</i></span>
                </a>
            </div>
        </div>
        <div class="page-sidebar-menu">
            <div class="page-sidebar-settings hidden">
                <ul class="sidebar-menu list-unstyled">
                    <li><a href="<?php echo base_url();?>index.php/verifylogin/logout" class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Sign Out</a></li>
                </ul>
            </div>
            <div class="sidebar-accordion-menu">
                <ul class="sidebar-menu list-unstyled">
                    <li>
                        <a href="#" class="waves-effect waves-grey active">
                            <i class="material-icons">settings_input_svideo</i>List Job
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php/verifylogin/logout"" class="waves-effect waves-grey">
                            <i class="material-icons">exit_to_app</i>Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
</div><!-- Left Sidebar -->