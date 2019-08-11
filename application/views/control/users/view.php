<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header mainheadig">
      <h1>
        <?php echo $title;?>
        <small>0</small>
      </h1>
      
    </section>
    <div class="col-md-12">
    <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="#"><?php echo $primaryheader;?></li>
        <li class="active"><?php echo $title;?></li>
        <a href="<?php echo ADMIN_BASE."users/add"; ?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
      </ol>
    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
      <?php foreach($row as $data){ 
        $file = USER_IMAGE_DIR.$data['userfile'];
        if(file_exists($file))
        {
           $userimage = $file;
        }else{
          $userimage  =  NO_PHOTO_USER_IMAGE_DIR;
        }
        ?>
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle"  src="<?php echo $userimage;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $data['fname']." ".$data['lname'];?></h3>

              <p class="text-muted text-center"><?php echo ucfirst($data['user_type']);?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Users</b> <a class="pull-right">5</a>
                </li>

                 <li class="list-group-item">
                  <b>Mobile</b> <a class="pull-right"><?php echo $data['mobile_num'];?></a>
                </li>
              </ul>
              <a href="<?php echo ADMIN_BASE."users/update/".$data['id'];?>">Update Profile</a><br>
              <a href="<?php echo ADMIN_BASE."companysetup/update/".$companyid;?>">Update Company</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted">
               <?php echo $data['email'];?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $data['street'];?></p>

              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Other Info</strong>

              <p><?php echo $data['permanent_addr']." ".$data['temp_addr']; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#timeline"  data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Send Message</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <?php 
                foreach($activitys as $activity)
                {
                  // activitymenu[0]  = Setup Menu
                  // activitymenu[1]  = Action Menu
                  // activitymenu[2]  = Cutrrent action id
                  $activitymenu = explode(',',$activity['shskey']);
                  ?>

                <div class="post">
                  <div class="user-block pull-left">
                    <img class="img-circle img-bordered-sm" src="<?php echo $userimage;?>" alt="user image">
                        <span class="username">
                          <a href="#"><?php foreach($allusers as $users){if($users['id']==$activity['user_id']){echo $users['fname']." ".$users['lname'];}} ?> </a> 
                        </span>
                  </div>
                   <span class="description pull-left"> &nbsp; &nbsp;  <?php foreach($action_menu as $menu){if($menu['id']==$activitymenu[1]){echo "<i class='".$menu['icon']."'></i> ".$menu['title'];}} ?> &nbsp; &nbsp;
                      <?php foreach($allmainmenu as $menus_main){if($menus_main['id']==$activitymenu[0]){echo "<i class='".$menus_main['icon_class']."'></i> ".$menus_main['title'];}}?> 
                      &nbsp; &nbsp; ID[<?php echo $activitymenu[2]; ?>]

                   &nbsp; &nbsp; -  &nbsp; &nbsp; <?php  echo " <i class='fa fa-clock-o'></i> &nbsp; &nbsp;";?>
                    <?php 
                    $date =  date('M j Y', strtotime($activity['addedinfo']));
                    $today = date('M j Y');

                    $value  = date_range($date,$today);
                    $diff = count($value);

                    if($diff == 1){
                     echo "Today" ." ". date('g:i A', strtotime($activity['addedinfo']));
                     }
                    elseif($diff == 2){
                       echo "Yesterday"." ".date('g:i A', strtotime($activity['addedinfo']));
                    }else{
                      echo date('M j Y g:i A', strtotime($activity['addedinfo']));
                    }
                    ?></span>

                   
                  <!-- /.user-block -->
                  <div class="clearfix"></div> 
                </div>
                <?php
                }
                ?>

                <!-- /.post -->     
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                 <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['fname'] ;?>" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" value="<?php echo $data['email'] ;?>" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" cols="10" id="inputExperience" placeholder="Message"></textarea>
                    </div>
                  </div>
                 
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <?php } ?>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('inc/adminfooter');?>
  <?php $this->load->view('inc/admincontrolsidebar');?>
</div>
<!-- ./wrapper -->

   

</body>
<?php $this->load->view('inc/footer');?>
<script type="text/javascript">
  
function AddAnchor(anchor)
{
window.location.href.hash = anchor;
}

</script>