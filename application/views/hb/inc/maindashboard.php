<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
       
        <div class="clearfix"></div>
         <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion ion-ios-calendar-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Scheduled Buses</span>
              <span class="info-box-number"><?php echo $todayschedules;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                  <?php    $Decrease =  $todayschedules - $day30beforechedules;
                           echo $val  = @($Decrease/$todayschedules*100);
                  ?>
                    % Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-clock"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Departing Buses</span>
              <span class="info-box-number"><?php echo $todaydeparting;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">

                  <?php    $Decrease =  $todayschedules - $day30departing;
                           echo $val  = @($Decrease/$todayschedules*100);
                  ?>

                    % Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>


        <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-android-stopwatch"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Departed Buses</span>
              <span class="info-box-number"><?php echo $todaydeparted;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                   <?php  $Decrease =  $todaydeparted - $day30departed;
                           echo $val  = @($Decrease/$todaydeparted*100);
                  ?>
                   % Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>


        <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-document-text"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Issued Tickets</span>
              <span class="info-box-number"><?php echo $todaytickets;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                  <?php  $Decrease =  $todaytickets - $day30tickets;
                           echo $val  = @($Decrease/$todaytickets*100);
                  ?>
                   % Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-gray">
            <span class="info-box-icon"><i class="fa  fa-file-excel-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Issued Challans</span>
              <span class="info-box-number">5</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">

                   70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-android-bus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Added Bus</span>
              <span class="info-box-number"><?php echo $todaybuses;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                   <?php  $Decrease =  $todaybuses - $day30buses;
                           echo $val  = @($Decrease/$todaybuses*100);
                  ?>

                   70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>



        <!-- /.col -->
      </div>

<?php ?>


      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, <?php echo date('Y');?> - 31 Dec, <?php echo date('Y');?></strong>
                  </p>
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                     <canvas id="salesChart" style="height: 180px; width: 701px;" height="180" width="701"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
       <div class="col-md-8 col-sm-6 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Activities</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th width="10">S.N</th>
                    <th>User Name</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php 
                    $sn=1;
                    foreach($allactivities as $activity){
                        $activitymenu = explode(',',$activity['shskey']);
                    ?>
                  <tr>
                    <td><?php echo $sn++;?></td>
                    <td><a target="_blank" href="<?php echo ADMIN_BASE."users/view/".$activity['user_id'];?>"><?php foreach($allusers as $users){if($users['id']==$activity['user_id']){echo $users['username'];}} ?></a></td>
                    <td><span class="description pull-left"> &nbsp; &nbsp;  <?php foreach($action_menu as $menu){if($menu['id']==$activitymenu[1]){echo "<i class='".$menu['icon']."'></i> ".$menu['title'];}} ?> &nbsp; &nbsp;
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
                    ?></span></td>
                   
                   
                  </tr>
                  <?php } ?>
                  

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Activities</a>
            </div>
            <!-- /.box-footer -->
            </div>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                  <?php 
                    foreach($alluserdesc as $user){
                      $uimage  = USER_IMAGE_DIR.$user['userfile'];
                      if(file_exists($uimage)){
                        $image = $uimage;
                      }else{
                        $image = NO_PHOTO_USER_IMAGE_DIR;
                      }
                  ?>
                    <li>
                      <img src="<?php echo $image;?>" alt="User Image">
                      <a class="users-list-name" href="#"></a><?php echo $user['fname'];?> </a>
                      <span class="users-list-date"><?php 
                    $date =  date('M j Y', strtotime($user['addiinfo']));
                    $today = date('M j Y');

                    $value  = date_range($date,$today);
                    $diff = count($value);

                    if($diff == 1){
                     echo "Today";
                     }
                    elseif($diff == 2){
                       echo "Yesterday";
                    }else{
                      echo date('M j', strtotime($user['addiinfo']));
                    }
                    ?></span>
                    </li>
                  <?php } ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?php echo ADMIN_BASE."users";?>" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
           </div>

      </div>





      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tickets Sales</span>
              <span class="info-box-number"><?php echo $totaltickets;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Buses</span>
              <span class="info-box-number"><?php echo $totalcompany;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-building-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Companys</span>
              <span class="info-box-number"><?php echo $totalcompany;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number"><?php echo $totalmembsers;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-shuffle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SCHEDULED </span>
              <span class="info-box-number"><?php echo $allschedulesbus;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-black"><i class="ion ion-ios-list-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bus Names </span>
              <span class="info-box-number"><?php echo $allbusnames;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa  fa-road"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Routes </span>
              <span class="info-box-number"><?php echo $allrouts;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check-square-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Activities </span>
              <span class="info-box-number"><?php echo $allactivity;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>




      </div>
      <!-- /.row -->

      <!-- Main row -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->