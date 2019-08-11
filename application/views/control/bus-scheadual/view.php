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
      <?php 
       foreach($row as $data){ 
        ?>
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            <?php 
                    foreach($allbuses as $buses)
                    {
                        if($buses['id']==$data['bus_no'])
                        {
                            $busimage = BUS_IMAGE_DIR.$buses['bus_image'];
                            $busno = $buses['bus_no'];
                            if(file_exists($busimage))
                            {
                              $image = $busimage;
                            }else{
                              $image = NO_BUS_IMG_DIR;
                            }
                        }
                    }
                    

                    ?>

              <img class="img-responsive"  src="<?php echo $image ;?>" alt="Bus profile picture">

              <hr>
              <h3 class="profile-username text-center"><?php echo $busno;?></h3>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Next Schedule</h3>
            </div>
            <!-- /.box-header -->
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#Scheadualdetails" data-toggle="tab">Scheadual Details</a></li>
              <li>
                <a href="#bookedsheets"  data-toggle="tab">Passenger List
                </a> 
              </li>
              <li><a href="#busdetail" data-toggle="tab">Bus Details</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="Scheadualdetails">
              <div class="col-md-2 faredetails">
              <div align="center">
                <price> NPR : <?php echo $data['netfare'];?> </price>
                <hr style="margin-top:0px">
                  <big>
                      <?php
                        foreach($allbuses as $buses){
                          if($data['bus_no']==$buses['id'])
                          {
                            foreach($catagory as $buscat)
                            {
                              if($buses['bus_category']==$buscat['id']){
                                 echo $buscat['title'];
                              }
                            }
                          }
                       }
                      ?>
                  </big>
              </div>
              </div>
              <div class="col-md-10">
                  <div class="bustitle col-md-9 row busname">
                    <span><i class="fa fa-bus pull-left"></i> <p class="pull-left">
                    <?php 
                    foreach($allbuses as $buses)
                    {
                        if($buses['id']==$data['bus_no'])
                        {
                            foreach($allbusnames as $names)
                            {
                              if($buses['bus_name']==$names['id']){
                                echo strtoupper($names['bus_name']); 
                              } 

                            }
                        }
                    }
                    

                    ?></span>
                    </div>
                   <div class="bustitle col-md-3 row pull-right">
                    <small class="pull-right"><b>Dept: </b>
                    <?php 

                    echo $data['departure'];
                      
                    ?>
                    </small>
                    <small class="pull-right"><b>Arriv: </b>
                    <?php 
                     echo $data['arrival'];
                      
                    ?>
                    </small>
                   </div>
                <div class="clearfix"></div>
              <hr style="margin-top: 10px;">
                <div class="col-md-3">
                  <div align="center">
                  <p class="bustime"> <?php echo $data['departuretime'];?></p>
                     <strong class="align-center"><big><?php foreach($routs as $routh){ if($routh['id']== $data['from']) {echo $routh['from'];}}?></big></strong>
                  </div>
                </div>
                <div class="col-md-6 busboardiingimage">
                 <div align="center">
                    <img class="img-responsive" src="<?php echo STATIC_IMG_DIR."busboardiing.png";?>">
                  </div>
                </div>
                <div class="col-md-3 pull">
                  <div align="center">
                   <p class="bustime"><?php echo $data['arrivaltime'];?></p>
                      <strong><big><?php foreach($routs as $routh){ if($routh['id']== $data['to']) {echo $routh['from'];}}?></big></strong>
                  </div>
                </div>
              </div>
                <div class="clearfix"></div>
                  <hr>
                <div class="col-md-9 row">
                <div class="col-md-9 viewboardngpoint">
                     <big>Boarding Points</big>
                  </div>
                  <div class="col-md-3 viewboardngpoint">
                      <big>Boarding Time </big>
                  </div>

                   <?php //echo $data['boardingpoint'];
                  $selectedbpoint   = explode(',',$data['boardingpoint']);
                  $selectedtime   = explode(',',$data['boardingtime']);
                  $counter = count($selectedbpoint);
                  $sn = 1;
                 for($i=0;$i< $counter; $i++)
                 {
                ?>
                  <div class="col-md-9 viewboardngpoint">
                      <?php foreach($routs as $rot){  
                        if($rot['id']==$selectedbpoint[$i]){echo $sn++.".  ".$rot['from'];}
                       }
                       ?> 
                  </div>
                  <div class="col-md-3 viewboardngpoint">
                      <?php echo $selectedtime[$i];?>
                  </div>
                <?php 
                 }
                 ?>                  

                 <div class="col-md-9 viewboardngpoint">
                     <big>Dropping Points</big>
                  </div>
                  <div class="col-md-3 viewboardngpoint">
                      <big>Dropping Time </big>
                  </div>

                   <?php //echo $data['boardingpoint'];
                  $selectedbpoint   = explode(',',$data['droppingpoint']);
                  $selectedtime   = explode(',',$data['droppingtime']);
                  $counter = count($selectedbpoint);
                  $sn = 1;
                 for($i=0;$i< $counter; $i++)
                 {
                ?>
                  <div class="col-md-9 viewboardngpoint">
                      <?php foreach($routs as $rot){  
                        if($rot['id']==$selectedbpoint[$i]){echo $sn++.".  ".$rot['from'];}
                       }
                       ?> 
                  </div>
                  <div class="col-md-3 viewboardngpoint">
                      <?php echo $selectedtime[$i];?>
                  </div>
                <?php 
                 }
                 ?>

                 
                </div>
                
                <div class="col-md-3 viewboardngpoint pull-right">
                  <big>Features</big>
                </div>

                 <div class="col-md-3 viewboardngpoint pull-right">
                 <?php
                        foreach($allbuses as $buses){
                          if($data['bus_no']==$buses['id']){
                            foreach($catagory as $buscat){
                              echo $buscat['id'];
                              $buscategoryfeture = explode(',',$buscat['features']);
                              if($buscat['features']==$buscategoryfeture) 
                              { 
                                foreach($allfeture as $feture){
                                  echo in_array($feture['id'],$buscategoryfeture) ? $feture['title']."<br>" : "";
                                }

                              }
                            } 
                          }
                       }
                      ?>
                 </ul>
                </div>

                <div class="clearfix"></div>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="bookedsheets">
               <table class="table table-striped">
                  <tr>
                    <th>S.N</th>
                    <th>Ticketid</th>
                    <th>Seat No</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Boarding</th>
                    <th>Total</th>
                  </tr>
                  <?php 
                  $total= 0;
                  $sn=1;
                    foreach($passengerinfo as $pinnfo)
                    {
                  ?>
                  <tr>
                    <td><?php echo $sn++;?></td>
					 <td><?php echo $pinnfo['ticketid'];?></td>
                      <td>
                    <?php foreach($passengerdtl as $seats){ ?>
                      <?php if($seats['info_id']==$pinnfo['id']) echo $seats['seat'].",";?>
                    <?php }?>
                  </td> 

                    <td><?php echo $pinnfo['name'];?></td>
                    <td><?php echo $pinnfo['contact'];?></td>
                    <td><?php foreach($routs as $rot){ if($pinnfo['boarding'] == $rot['id']) { echo $rot['from']; } } ?></td>
                    <td><?php echo $pinnfo['total'];?></td>
                  </tr>
                  <?php 

                  $total = $pinnfo['total']+$total;
                   }
                ?>
                <tr>
                  <th colspan="6">Total</th>
                  <td><?php echo $total;?> </td>
                </tr>
               </table>
               <?php //echo print_r($passengerdtl);;?>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="busdetail">
              <?php 
                foreach($busdetails as $data){ ?>
               
                  <div class="box-body ">
                       
                       <div class="col-md-3">
                         <label for="to">Bus Number</label>
                          <p><?php echo $data['bus_no'];?></p>
                        </div>

                        <div class="col-md-3">
                         <label for="to">Bus Category</label>
                          <p><?php foreach($catagory as $cat){?><?php if($data['bus_category']==$cat['id']){echo $cat['title'];}?><?php }?></p>
                        </div>

                        <div class="col-md-6">
                         <label for="to">Travel Company</label>
                          <p><?php foreach($allcom as $com){?><?php if($data['company']==$com['id']){echo $com['name'];}?><?php }?></p>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                         <div class="col-md-3">
                          <label for="to">Owner</label>
                          <p><?php echo $data['owner'];?></p>
                        </div>
                        <div class="col-md-3">
                          <label for="to">Mobile No</label>
                          <p><?php echo $data['mobile_no'];?></p>
                        </div>
                        <div class="col-md-3">
                          <label for="to">Email</label>
                          <p><?php echo $data['email'];?></p>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                         <div class="col-md-3">
                          <label for="to">Driver Name</label>
                          <p><?php echo $data['driver_name'];?></p>
                        </div>

                        <div class="col-md-3">
                          <label for="to">Driver Contact No</label>
                          <p><?php echo $data['driver_mobile_no'];?></p>
                        </div>

                        <div class="col-md-3">
                          <label for="to">Total Seats in A Side</label>
                          <p><?php echo $data['total_sheet_in_a_side'];?> Seats</p>
                        </div>

                        <div class="col-md-3">
                          <label for="to">Total Seats in B Side</label>
                          <p><?php echo $data['total_sheet_in_b_side'];?> Seats</p>
                        </div>
                        <div class="col-md-3">
                          <label for="to">Last Row</label>
                          <p><?php echo $data['last_row'];?> Seats</p>
                        </div>
                         

                        <div class="clearfix"></div>
                        <hr>
                        
                        <div class="col-md-3 pull-right">
                            <?php if(in_array('bussetup'."/add",$user_id)){;?>
                              <a href="<?php echo ADMIN_BASE."bussetup"."/update/".$data['id']; ?>" style="margin-left:7px;" class="btn btn-primary btn-sm btn-flat pull-right topbuttons" >Update</a>
                              <?php } ?>
                        </div>

                        <div class="clearfix"></div>
                        <br>
                  </div>
                <?php 
              }
              ?>
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