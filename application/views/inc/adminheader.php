 <?php 
          $query = $this->db->get_where('control_login',array('username'=>$this->session->userdata('eBusLogin')));
          $image  = $query->result_array();
          foreach($image as $userimg)
          {
            $file = USER_IMAGE_DIR.$userimg['userfile'];
            $fullname = $userimg['fname']." ".$userimg['lname'];
            $email = $userimg['email'];
            if(file_exists($file))
            {
              $img =  $file;
            }else{
              $img = NO_PHOTO_USER_IMAGE_DIR;
            }
          }
        ?>

<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DATA</b>BUS</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $img;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('eBusLogin');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $img;?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $fullname; ?>
                  <small><?php echo  $email; ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo ADMIN_BASE."users/view/".$userimg['id'];?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('control/dashboard/Logout');?>" class="btn btn-default btn-flat"> Logut </a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->