<!-- Content Wrapper. Contains page content -->

<?php 
$tdate    =     date('Y-m-d');
        $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
        $now  = $dateTime->format("h:i A"); 

?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
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
              <span class="info-box-number"><?php foreach($scheadual as $total){ if($total['departure']==$tdate AND $total['is_active'] =="Y"){
              $todaysche[]   =   $total['id'];
                
                } 
              }
                   $todaysche[]= "";
                echo count($todaysche) - 1;
                ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                   
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
              <span class="info-box-number"><?php foreach($scheadual as $total){ if($total['departure']==$tdate AND strtotime($total['departuretime']) > strtotime($now) AND $total['is_active'] =="Y"){
               $todaydep[] =  $total['id'];
                
                }
              }
              $todaydep[] =  "";
                  echo count(@$todaydep)-1;
                ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                   
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
              <span class="info-box-number"><?php foreach($scheadual as $total){ if($total['departure']==$tdate AND strtotime($total['departuretime']) < strtotime($now) AND $total['is_active'] =="N"){
				$departed[]  = $total['id'];
                
                }}
				if(count(@$departed)>0){ echo count(@$departed);}else {echo 0;}
				?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
                  <span class="progress-description">
                   
				   
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <!-- /.col -->
      </div>
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
                    <strong>Sales: 1 Jan, <?php echo date('Y');?> - 30 Jul, <?php echo date('Y');?></strong>
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
           
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
       <div class="col-md-8 col-sm-6 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Scheadual Status For Today</h3>

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
                    <th>Bus NO</th>
                    <th>Departure Time </th>
                    <th>Contact  NO </th>
                    <th>Booked Seats</th>
                    <th>Status </th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php 
                    $sn=1;
                    foreach($scheadual as $depart){

                     
                      if($depart['departure']==$tdate AND strtotime($depart['departuretime']) < strtotime($now) AND $depart['is_active'] =="N"){
                         $sid = $depart['id'];
                        
                      ?>
                       <tr>
                        <td><?php echo  $sn++; ?></td>
                        <td><?php foreach($allbus as $bus){if($bus['id']==$depart['bus_no']){ echo $bus['bus_no'];}}?></td>
                        <td><?php echo  $depart['departuretime']; ?></td>
                        <td><?php  foreach($allbus as $bus){if($bus['id']==$depart['bus_no']){ echo $bus['mobile_no'];}}?></td>
                        <td>
                        <?php 
                            $ticket   = $this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
                            foreach($ticket as $tod){ 
                            $info = $tod['id'];
                            $allseats =   $this->db->get_where('passengers_detail',array('info_id'=>$info));
                            $allbook =  $allseats->result_array();
                            foreach($allbook as $seat){
                                $alltot[] = $seat['seat'];
                            }
                            }
                            echo count(@$alltot);
                             ?>
                          
                        </td>
                        <td><?php if($depart['is_active']=='Y') { ?>
                              <strong><span class="label label-success disabled">Departing</span> </strong></a>
                            <?php } else if($depart['is_active']=='N') { ?>
                               <strong><span class="label label-danger disabled">Departed</span> </strong></a>
                            <?php }?></td>
                      </tr>
                      <?php
                    
                    }
                    if($depart['departure']==$tdate AND strtotime($depart['departuretime']) > strtotime($now) AND $depart['is_active'] =="Y"){

                       $sid = $depart['id'];
                        
                      ?>
                       <tr>
                       <td><?php echo  $sn++; ?></td>
                        <td><?php foreach($allbus as $bus){if($bus['id']==$depart['bus_no']){ echo $bus['bus_no'];}}?></td>
                        <td><?php echo  $depart['departuretime']; ?></td>
                        <td><?php  foreach($allbus as $bus){if($bus['id']==$depart['bus_no']){ echo $bus['mobile_no'];}}?></td>
                        <td>
                          <?php 
                            $ticket   = $this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
                            if(count($ticket) > 0 ){
                            foreach($ticket as $tod){ 
                            $info = $tod['id'];
                            $all =   $this->db->get_where('passengers_detail',array('info_id'=>$info)); $dat = $all->result_array(); 
                            $allseat =  $all->result_array();
                            foreach($allseat as $seats){
                              $allbook[] = $seats['seat'];
                            }
                            } 
                            echo count( $allbook);
                          }
                            else echo count( $ticket);
                          ?>

                        </td>
                        <td><?php if($depart['is_active']=='Y') { ?>
                                 <strong><span class="label label-success disabled">Departing</span> </strong></a>
                              <?php } else if($depart['is_active']=='N') { ?>
                                <strong><span class="label label-danger disabled">Departed</span> </strong></a>
                              <?php }?></td>
                      </tr>
                      <?php
                    
                     } 
                    
                    
                  }
                        
                    ?>
                 
                 
                  

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="<?php echo base_url('control/busscheadual'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Activities</a>
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
                      if($user !== 0 AND $user['user'] ==$uid){
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
                  <?php }} ?>
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
              <span class="info-box-number"> 
              <?php
                echo count(@$totaltickets);
              //  foreach(@$totaltickets as $schid){
              //     $sid =  $schid['id'];
              //     $info = $this->dynamic_query->getby(@$sid,'passengers_ticket_info','sid');
              //     foreach($info as $inf){
              //       $inid[] =  $inf['id'];
                  
              //     }

              // }
              //  echo  count(@$inid);
            

              ?></span>
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
              <span class="info-box-text">Total Buses</span>
              <span class="info-box-number"><?php echo @$totalbuses;?></span>
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
              <span class="info-box-text"> Staffs </span>
              <span class="info-box-number"><?php echo count(@$totalstaff); ?></span>
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
              <span class="info-box-number"><?php echo @$totalmembsers;?></span>
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
              <span class="info-box-number"><?php echo @$allbusnames;?></span>
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
              <span class="info-box-number"><?php echo @$allrouts;?></span>
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
              <span class="info-box-number"><?php echo @$allactivity;?></span>
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


 