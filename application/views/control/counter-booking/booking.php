<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 0px;">
    <!-- Content Header (Page header) -->
   <section class="content-header mainheadig">
      <h1>
        <?php echo $primaryheader;?>
      </h1>
      
    </section>
    <div class="col-md-12">
    <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="#"><?php echo $primaryheader;?></li>
        <li class="active"><?php echo $title;?></li>
        <?php if(in_array($this->uri->segment(2)."/add",$user_id)){;?>
        <a href="<?php echo ADMIN_BASE.$this->uri->segment(2)."/add"; ?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
        <?php } ?>
      </ol>
    </div>

     <section class="content">

      <div class="row">

      <?php   
          
           $total = count(explode(',', $selected));
            $seat = explode(',', $selected);
            foreach($counter as $reg){
              $res   =  explode('/', $reg['reservation']); 
              $resdis   =  explode('/', $reg['reservdiscount']);
            }
              $stuid    = explode(',', $res[0]);
              $female   = explode(',', $res[1]);
              $old      = explode(',', $res[2]);
              $staff    = explode(',', $res[3]);
              $hancap    = explode(',', $res[4]);

                         $perrate = $tprice / $total;
                         for($i=0;$i<$total;$i++){ 
                          if($seat[$i]==@$stuid[2].@$stuid[0] OR $seat[$i]==@$stuid[2].@$stuid[1]){ 
                              $discount = $perrate * @$resdis[0] / 100; 
                          }

                           else if($seat[$i]==@$female[2].@$female[0] OR $seat[$i]==@$female[2].@$female[1]){ 
                            $discount = $perrate * @$resdis[1] / 100; 
                          }

                           else if($seat[$i]==@$hancap[2].@$hancap[0] OR $seat[$i]==@$hancap[2].@$hancap[1]){ 
                             $discount = $perrate * @$resdis[2] / 100; 
                          }

                           else if($seat[$i]==@$old[2].@$old[0] OR $seat[$i]==@$old[2].@$old[1]){ 
                             $discount = $perrate * @$resdis[3] / 100; 
                          }

                          else {   $discount = 0;}
                        }
                        

                      
           
            
            ?>


            <div class="col-md-12">
            <div class="box bookingheading">
              <div class="col-md-3">
           
                <h4><?php 
                        foreach($busno as $bus){
                          foreach($allbusnames as $name)
                          {
                            if($name['id']==$bus['bus_name']){
                              echo $name['bus_name'];
                            }
                          }
                        }
                      ?></h4>
                <p><small>BUSTYPE:  <?php
                        foreach($busno as $bus){
                          foreach($allcatagory as $cat)
                          {
                            if($cat['id']==$bus['bus_category']){
                              echo strtoupper($cat['title']);
                            }
                          }
                        }
                      ?></small></p>
              </div>
              <?php 
              foreach($scheadual as $busschedul){
              ?>
               <div class="col-md-3">
                <p><?php foreach($allrot as $rot){if($rot['id']==$busschedul['from']){echo $rot['from'];}} ?></p>
                <h4>
                  <?php echo $busschedul['departuretime'];?>,
                  <?php $mydate = strtotime($busschedul['departure']); echo date('jS M', $mydate); ;?>
                 </h4>
                 <span class="boardingarrow hidden-xs">&rightarrow; </span>
              </div>
              <div class="col-md-3 hidden-md hidden-sm hidden-lg"> <span align="center">&downarrow;</span> </div>
              <div class="col-md-3">
                <p><?php foreach($allrot as $rot){if($rot['id']==$busschedul['to']){echo $rot['from'];}} ?></p>
                <h4>
                <?php echo $busschedul['arrivaltime'];?>, 
                <?php $mydate = strtotime($busschedul['arrival']); echo date('jS M', $mydate); ;?>
                  
                </h4>
              </div>
              <?php } ?>
               <div class="col-md-3 fare">
                <p class="pull-right"><small class="pull-right"><a href="" data-toggle="popover" title="Fare Details" data-placement="left" data-trigger="focus" data-html="true" data-content="
                <small>
                 <strong>Bus Fare</strong> &nbsp;&nbsp;   <span class='pull-right'  align='right'>Rs <?php echo $tprice;?>/-</span> <br>
                 <strong>Discount</strong> &nbsp;&nbsp;   <span class='pull-right'  align='right'><?php echo $dis =  0;?>%</span> <br>
                 <strong>Total</strong>   <span class='pull-right' align='right'>Rs <?php echo $tprice-($tprice*$dis/100);?>/-</span><br>
                 </small>
                ">Fare Details</a></small></p>
                <div class="clearfix"></div>
                <p class="pull-right"><small>Grand Total:</small> <big>Rs <?php echo $tprice;?>/-</big></p>
              </div>

            </div>
          </div>

        
          <div class="col-md-9">
          <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/counter_booking/continuebooking');?>">
          <div class="box ">
            <?php $this->load->view('control/inc/validation');?>
            <div class="box-header with-border">
            <h3 class="box-title"><?php echo $title;?></h3>
         </div>
         </div>
           <?php for($i=0;$i<$total;$i++){ ?>
            
              <div class="box no-padding minusmargintop">
              <div class="box-header with-border">
                <h3 class="box-title">SEAT NO:<?php echo $seat[$i];?></h3>
                <?php $this->load->view('control/inc/validation');?>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
             
                <div class="box-body">
                  <div class="row">
                    <!--  content here -->
                     <div class="form-group col-md-6">
                        <label for="Passenger">Passenger Name</label>
                        <input type="text" name="name[]" class="form-control" id="Passenger" placeholder=" Passenger Name" required>
                      </div>
                   
                    <div class="form-group col-md-3">
                      <div class="col-md-12">
                      <label for="gender">Gender</label>
                      </div>
                      <div class="col-md-12">

                      <input type="radio" name="gender<?php echo $seat[$i];?>[]" value="M" class="minimal" required  <?php if($seat[$i]==@$female[2].@$female[0] OR $seat[$i]==@$female[2].@$female[1]){  echo "disabled";}?>>Male
                      <input type="radio" name="gender<?php echo $seat[$i];?>[]" value="F" class="minimal" required  <?php if($seat[$i]==@$female[2].@$female[0] OR $seat[$i]==@$female[2].@$female[1]){ echo "checked='checked'"; }?> >Female
                     </div>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="age">Age</label>
                      <input type="number" name="age[]" class="form-control" id="age" <?php if($seat[$i]==@$old[2].@$old[0] OR $seat[$i]==@$old[2].@$old[1]){ echo "required='required'";}?> placeholder="Age">
                      <input type="hidden" name="seat[]" value="<?php echo $seat[$i];?>" class="form-control" id="email" placeholder="Age">
                    </div> 
                  </div>
                </div>
                </div>
            <!-- /.box -->
         <!--  </div> -->
                <?php } ?>

                 <div class="box minusmargintop no-padding">
                    <div class="box-header with-border">
                      <h3 class="box-title">Please Porvide Valid Email & Phone </h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                   
                      <div class="box-body">
                        <div class="row">
                          <!--  content here -->
                          <div class="col-md-12">
                           <div class="form-group col-md-2">
                              <label for="contactNO">Coupon code</label>
                              <input type="text" name="coupon" class="form-control" id="contactNO" placeholder="Coupon code">
                           </div>
                          </div>
                         <div class="col-md-12">
                          <div class="form-group col-md-6">
                            <label for="contactNO">Email </label>
                            <input type="email" required="required" name="email" class="form-control" id="contactNO" placeholder="Email">
                          </div>

                         <div class="form-group col-md-3">
                            <label for="contactNO">Contact No</label>
                            <input type="text" required="required" name="phone" class="form-control" id="contactNO" placeholder="Contact No">
                         </div> 
                          <?php 
                            for($i=0;$i<$total;$i++){ 
                                if($seat[$i]==@$stuid[2].@$stuid[0] OR $seat[$i]==@$stuid[2].@$stuid[1]){ ?>
                                   <div class="form-group col-md-3">
                                    <label for="contactNO">Student Card </label>
                                    <input type="file" required="required" name="card" class="form-control" id="card">
                                   </div><?php
                                }
                              }
                            ?>
                        
                         <?php 
                         foreach($points as $p){
                          $dp   =   explode(',',$p['droppingpoint']);
                          $cd   =   count( explode(',',$p['droppingpoint']));
                          $bp   =   explode(',',$p['boardingpoint']);
                          $cb   =   count(explode(',',$p['boardingpoint']));
                          $dt   =   explode(',',$p['droppingtime']);
                          $bt   =   explode(',',$p['boardingtime']);
                         }
                         ?>


                         <div class="form-group col-md-6">
                            <label for="bp">Boarding Point</label>
                            <select name="boarding" required="required" class="form-control">
                              <option value="">Select Boarding Point</option>
                              <?php for($i=0;$i<$cb;$i++){ ?>
                              <option value="<?php echo $bp[$i].','.$bt[$i];?>"> <?php  foreach($allrot as $route){ if($route['id']==$bp[$i])  { echo $route['from'];}} ?> (<?php echo $bt[$i];?>)</option> <?php }?>
                            </select>
                         </div>
                         <div class="form-group col-md-6">
                            <label for="dp">Droppint Point</label>
                            <select name="dropping" class="form-control">
                              <option value="">Select Droppint Point</option>
                              <?php for($i=0;$i<$cd;$i++){ ?>
                              <option value="<?php echo $dp[$i].','.$dt[$i];?>"> 
                              <?php  foreach($allrot as $route){ if($route['id']==$dp[$i]) { echo $route['from'];}}?> (<?php echo $dt[$i];?>)</option><?php }?>
                            </select>
                         </div>
                        </div>
                      </div>
                    </div>
                  <!-- /.box -->
                </div>
                <div class="box minusmargintop no-padding">   
                  <!-- /.box-header -->
                    <div class="box-footer">
                      <div class="row">
                        <!--  content here -->
                        <div class="col-md-12">
                            
                          <div class="form-group col-md-7">
                            <input type="hidden" name="tamount" value="<?php echo $tprice;?>"  id="tamount" >
                            <input type="hidden" name="buscompany" value="<?php echo $buscom;?>"  id="com" >
                            <input type="hidden" name="departure" value="<?php echo $departuredate;?>" id="date" >
                            <input type="hidden" name="selectedseats" value="<?php echo $selected;?>"  id="sseats" > 
                            <input type="hidden" name="sid" value="<?php echo $sid;?>" id="scheadual_id" >
							<input type="hidden" name="tmp_id" value="<?php echo $tmp_id;?>">
                            <input type="hidden" name="discount" value="<?php echo $discount;?>" id="discount" >
                            <button type="submit" name="submit" value="save" class="btn btn-success btn-sm btn-flat"><big class="pull-left">Continue Booking</big> &nbsp; <i style="font-size:20;line-height: 20px;" class="fa fa-arrow-right pull-right"></i></button>
                            <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- /.box -->
                </div>
                </form>
             </div>
              
          <!-- /.col -->

        <!-- /.row -->
         


         <div class="col-md-3">
          
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"> Information </h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                    <div class="bookinginfo">
                    <p><strong>Selected Bus No</strong></p>
                      <?php 
                        foreach($busno as $bus){
                          echo $bus['bus_no'];
                        }
                      ?>
                     </div>
                     <div class="bookinginfo">
                     <p><strong>Selected Bus Name</strong></p>
                      <?php 
                        foreach($busno as $bus){
                          foreach($allbusnames as $name)
                          {
                            if($name['id']==$bus['bus_name']){
                              echo $name['bus_name'];
                            }
                          }
                        }
                      ?>
                      </div>
                      <div class="bookinginfo">
                      <p><strong>Bus Type</strong></p>
                   <?php
                        foreach($busno as $bus){
                          foreach($allcatagory as $cat)
                          {
                            if($cat['id']==$bus['bus_category']){
                              echo $cat['title'];
                            }
                          }
                        }
                      ?>
                     </div>
                     <div class="bookinginfo">
                    <p><strong>Selected Seats</strong></p>
                       <?php for($i=0;$i<$total;$i++){ 
                          echo $seat[$i]."&nbsp;&nbsp;";
                        }?>
                    </div>
                    <div class="bookinginfo">
                     <p><strong>Student Discount </strong></p>
                        <?php echo $discount; ?>
                     </div>
              </div>
             </div>
          <!-- /.col -->
            </div>
        <!-- /.row -->
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