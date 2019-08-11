<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo count(@$busschedule);?> Buses found  in <?php echo nice_date($this->uri->segment(5),"M d, D");?><small></small></h3>
            <div class="row">
			
			 
			   <div class="col-md-3">
                    <div class="booking-item-dates-change mb30">
                       <?php
                            if($this->input->post('updatesearch')==="update"){
                                $from = $this->input->post('from');
                                $to = $this->input->post('to');
                                $date = nice_date($this->input->post('date'),'Y-m-d'); 
                                $time = $this->input->post('time');
                                $timeA = explode(' ',$time);
                                $number = $timeA[0];
                                $ampm = $timeA[1];
                                $shift = $this->input->post('shift');
                                $oper = "/";
                                $path = "home/searchbus/";
                                $url = $path.$from.$oper.$to.$oper.$date.$oper.$number.$oper.$ampm.$oper.$shift;
                               redirect($url);
                            }
                        ?>

                        <form class="input-daterange" id="searchform" data-date-format="M d,D" method="post">
                            
                                <div class="form-group form-group-lg form-group-icon-left">
                                    <i class="fa fa-map-marker input-icon-left"></i>
                                    <label>From</label>
                                    <select required name="from" style="width: 100%" class="form-control select2 input-md">
                                    <option value="">Select Departure </option>
                                    <?php foreach($places as $place){?>
                                        
                                        <option <?php if($this->uri->segment(3)==$place['id']){echo "selected";} ?> value="<?php echo $place['id'];?>"><?php echo $place['from'];?></option> 
                                    <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group form-group-lg form-group-icon-left">
                                     <i class="fa fa-map-marker input-icon-left"></i>
                                    <label>To</label>
                                    <select required name="to" style="width: 100%" class="form-control select2 input-md">
                                    <option  value="">Select Destination </option>
                                    <?php foreach($places as $place){?>
                                        
                                        <option <?php if($this->uri->segment(4)==$place['id']){echo "selected";} ?> value="<?php echo $place['id'];?>"><?php echo $place['from'];?></option> 
                                    <?php } ?>
                                    </select>
                                </div>

                           
                            <div class="row">
                                <div class="col-md-12 form-group form-group-lg form-group-icon-left">
                                         <i class="fa fa-calendar input-icon-left-list"></i>
                                        <label>Departing</label>
                                        <input required class="date-pick form-control" value="<?php echo nice_date($this->uri->segment(5),'M d,D');?>" name="date" data-date-start-date="1d" data-date-format="M d, D" type="text" />
                                </div>
                                <div class="col-md-6 form-group form-group-lg form-group-icon-left">
                                         <i class="fa fa-clock-o input-icon-left-list"></i>
                                        <label>Time</label>
                                        <input name="time" class="time-pick form-control" value="<?php echo $this->uri->segment(6);?> <?php echo $this->uri->segment(7);?>" type="text" />
                                    
                                </div>

                                <div class="col-md-6 form-group form-group-lg form-group-icon-left">
                                         <i class="fa fa-star-half-o input-icon-left-list"></i>
                                        <label>Shift</label>
                                        <select name="shift" class="form-control">
                                            <option <?php if($this->uri->segment(8)=='night'){echo "selected";};?> value="night">Night</option>
                                            <option <?php if($this->uri->segment(8)=='day'){echo "selected";};?> value="day">Day</option>
                                        </select>
                                </div>

                            </div>
                            <div class="clearfix"></div><br>
                            <button class="btn btn-primary" type="submit" name="updatesearch" value="update">Update Search</button>
                        </form>
                    </div>
                   
                </div>
                <div class="col-md-9">
                    
                    <ul class="booking-list">
                    	<?php 
                    	if(count(@$busschedule)>0){
                    	foreach($busschedule as $displybus){ 
						
						
						$where = array('sid'=>$displybus['id']);
									$schid  = $displybus['id'];
									$tmpseats = $this->site_model->returnfield('temp_sheet',$where,'seats');
									$tmptot = count($tmpseats);
									if($tmptot > 0){
									$tmpres  = implode(',', @$tmpseats);
									$expres = explode(',', @$tmpres);
									@$reservetot = count($expres);
									}
						
                            // Getting busdetail from bus_setup by buscheedule ko bus no 
                           $busdetail =   $this->dynamic_query->getby($displybus['bus_no'],'bus_setup','id');
                            foreach($busdetail as $businfo){
                                if($displybus['bus_no']  ==    $businfo['id']){
                                    $tot_cabin= $businfo['cabin'];
                                    $totalrowb= $businfo['total_sheet_in_b_side'];
                                    $totalrowa= $businfo['total_sheet_in_a_side'];
                                    $special =   $businfo['special'];
                                    $aside    =   $businfo['total_sheet_in_a_side'];
                                    $bside   =   $businfo['total_sheet_in_b_side'];
                                    $last   =   $businfo['last_row'];
                                    $cabin   =   $businfo['cabin'];
                                    $special    =   $businfo['special'];
                                    $bus_category    =   $businfo['bus_category'];
                                    $bus_name    =   $businfo['bus_name'];
                                    $bus_type    =   $businfo['type'];
                                    $allseats    =   explode(',', $businfo['hices']);
                                    $forceseats    =  explode(',', $businfo['forces']);
                              
                            


                            ?>
                            <br>
                            <li>

                            <a class="booking-item" href="JavaScript:void(0)">
                                <div class="row">
                               
                                    <div class="col-md-3">
                                        <div class="booking-item-car-img">
                                           <h4><?php  foreach($busname as $bus){ if($bus['id']== $bus_name){echo $bus['bus_name'];}}?></h4>

                                            <p class="booking-item-car-title">BUS TYPE: <?php foreach($buscatagory as $bcata){if($bus_category==$bcata['id']){echo strtoupper($bcata['title']); }};?></p>
                                            <small>Click Select to view details</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <span class="rightarrow buslist"> &rightarrow; </span>
                                               <p><b><?php foreach($busrot as $rot){ if($rot['id']==$displybus['from']){echo $rot['from'];}}?></b></p>
                                               <h5><?php echo  nice_date($displybus['departure'],"M d, D");?> <?php echo $displybus['departuretime'];?></h5>
                                            	 <p>DEPARTURE</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><b><?php foreach($busrot as $rot){ if($rot['id']==$displybus['to']){echo $rot['from'];}}?></b></p>
                                                 <h5><?php  echo  nice_date($displybus['arrival'],'M d, D');?> <?php echo $displybus['arrivaltime'] ?></h5>
                                                 <p>ARRIVAL</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">Rs <?php echo $displybus['netfare'];?>/-</span><span></span>
                                        <p class="booking-item-flight-class">Per Seat</p>
                                      
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#busSeat<?php echo $displybus['id'];?>">Select</button>
                                    </div>
                                </div>
                            </a>
                            <?php 
                                
                                 }
                                 }
								 if($sch = $this->session->userdata('sid')){
									 $sch = $this->session->userdata('sid');
							   
								 }
								  
                              ?>

                            <div class="modal fade <?php if($sch){ if($sch==$schid){echo "in";}}?>" data-keyboard="false" data-backdrop="static" id="busSeat<?php echo $displybus['id'];?>" <?php if($sch){ if($sch==$schid){echo "style='display: block;'";}}?> role="dialog">
                           
							<?php $this->session->unset_userdata('sid');?>
						   <div class="modal-dialog modal-lg">
                            <form method="post" class="seatselectForm" action="<?php echo base_url('home/travallers');?>">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"> <span style="font-size: 36px;"> &times;</span></button>
                                  <h5 class="modal-title">
                                 
                                  <?php foreach($busrot as $rot){ if($rot['id']==$displybus['from']){echo $rot['from'];}}?> 
                                  <span style="font-size: 25px;">&rightarrow; </span>
                                  <?php foreach($busrot as $rot){ if($rot['id']==$displybus['to']){echo $rot['from'];}}?> | 
                                  <?php echo  nice_date($displybus['departure'],"M d");?>
                                   </h5>
                                </div>
                                <div class="modal-body">
                                    
                                <div class="col-md-12 businfo">
                                    <div class="col-md-4">
                                        <div class="booking-item-car-img">
                                           <h4><?php foreach($busname as $bus){ if($bus['id']==$bus_name ){echo $bus['bus_name'];}}?></h4>
                                            <p class="booking-item-car-title"><?php foreach($buscatagory as $bcata){if($bus_category==$bcata['id']){echo strtoupper($bcata['title']); }};?></p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <a data-toggle="collapse" data-target="#busdetailview<?php echo $displybus['id'] ;?>" class="view-bus-details" href="#">View Details</a>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <span class="rightarrow buslist">&rightarrow; </span>
                                               <p><b><?php foreach($busrot as $rot){ if($rot['id']==$displybus['from']){echo $rot['from'];}}?></b></p>
                                               <h5><?php echo  nice_date($displybus['departure'],"M d, D");?> <?php echo $displybus['departuretime'];?></h5>
                           
							 
                                            </div>
                                            <div class="col-md-6">
                                                <p><b><?php foreach($busrot as $rot){ if($rot['id']==$displybus['to']){echo $rot['from'];}}?></b></p>
                                                 <h5><?php  echo  nice_date($displybus['arrival'],'M d, D');?> <?php echo $displybus['arrivaltime'] ?></h5>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <?php 
                                    // extract data from bus schedule varibale named by  displybus
                                    $everybus = $displybus['id'];
                                    $price = $displybus['fare'];
                                    $sid = $displybus['id'];
                                    $buscompany = $displybus['company'];
                                    $departuredate  =   $displybus['departure'];
                                    $total  =   $displybus['fare'];
                                    $bookedseat     =   "";
									$from = $displybus['from'];
									$to = $displybus['to'];
  
                                    // Getting ticket information by schedule id 
                                    $seats_info     =   $this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
                                    $info_id =  $seats_info;

                                   // getting company details by company id  and extract the reservation seat
                                    $companydetail     =   $this->dynamic_query->getby($buscompany,'company_setup','id');
                                    foreach($companydetail as $company){
                                        $res = explode('/', $company['reservation']);
                                    }
                                      @$student  = explode(',', $res[0]);
                                      @$female   = explode(',', $res[1]);
                                      @$old      = explode(',', $res[2]);
                                      @$staff    = explode(',', $res[3]);
                                
                          //getting Booked seats from passengers_detail using info_id 
                          foreach($info_id as $booked_info){
                            $info_id = $booked_info['id'];
                            $booked_seats = $this->dynamic_query->getby($info_id,'passengers_detail','info_id');
                            foreach($booked_seats as $seats){
                              $bookedseat[] = $seats['seat'];
                            }
                          }
                           $all = count($bookedseat);

                        // count seat row  in all side of bus 
                         $totalrowb     = round($bside/2);
                         $totalrowa     = round($aside/2);
                         $tot_cabin     = round($cabin/2);
                         $total_special = round($special);
                       ?>
                            <div class="col-md-12 informationuser">
                                <div class="col-md-1 col-xs-12 seatinf">
                                    <img class="pull-left"  src="<?php echo base_url('uploads/seats/seat-open.png');?>">  <span class="pull-left"><small> Available</small></span> 
                                </div> 
                                <div class="col-md-1 col-xs-12 seatinf">
                                    <img class="pull-left"  src="<?php echo base_url('uploads/seats/seat-booking.png');?>">  <span class="pull-left"><small> Selected</small></span> 
                                </div> 
                                <div class="col-md-1 col-xs-12 seatinf">
                                    <img class="pull-left disconnect"  src="<?php echo base_url('uploads/seats/seat-open.png');?>">  <span class="pull-left"><small> Booked</small></span> 
                                </div> 
                                <div class="col-md-1 col-xs-12 seatinf">
                                    <p class="pull-left"> F </p> <span class="pull-left"><small> Female</small></span> 
                                </div> 
                               
                                <div class="col-md-1 col-xs-12 seatinf">
                                    <p class="pull-left"> H </p> <span class="pull-left"><small>Handicap</small></span> 
                                </div>
                                 <div class="col-md-1 col-xs-12 seatinf">
                                    <p class="pull-left"> S </p> <span class="pull-left"><small>Student</small></span> 
                                </div>
                                <div class="col-md-1 col-xs-12 seatinf">
                                    <p class="pull-left"> ST </p> <span class="pull-left"><small>Staff</small></span> 
                                </div>

                                 <div class="col-md-2 col-xs-12 seatinf">
                                    <p class="pull-left"> O </p> <span class="pull-left"><small> Old Citizen</small></span> 
                                </div> 

                                <div class="col-md-3 col-xs-12 seatinf">
                                
                                    <p class="pull-left travelingtime">
                                    <i class="fa fa-clock-o"></i>
                                    <?php 
                                        echo $this->static_model->gettime($displybus['departuretime'],$displybus['arrivaltime']);
                                    ?>
                                     </p>
                                </div> 

                               
                            </div>
							<div class="booked-message">
							
								<?php if($this->session->userdata('not_available')){ ?>  
									<div class="alert notice notice-<?php echo $this->session->userdata('class');?>">
										<strong><?php echo  $this->session->userdata('title');?> !!  </strong> 
									<?php 
										echo  $this->session->userdata('message'); 
										$this->session->unset_userdata('not_available');
									?>
									</div>


								<?php }?>




							</div>
                            <div class="col-md-12 seatinfosite">
                              <?php  // all seats will be contain this class 
							  
							  ?>
                              <div class="col-md-9 bus-seats">
                                <?php if($bus_type=="bus") {
									
									
                                  // It is busses seats.
                                  // All busses will be in this condition with looping structure. 
                                ?>
                                <div class="bus-seatss">
                                <div id="multiselect"> 
                                <div class="cabin-total col-md-<?php if($tot_cabin == ""){ echo 1;} else if($tot_cabin > 1){ echo $tot_cabin; } else echo 1;?>" style="padding: 0px;" >
                                <div class="tot-cabin" style="margin-bottom: 61px;">
                                 <img src="<?php echo base_url('uploads/seats/stering.jpg');?>" height="40 " width="40px" />
                                  </div>
                                 <div class="seat"></div>
                                 <?php  
                                      $i=2;   
                                      while($i<=$cabin){  ?>
                                        <div  class="select col-md-1 col-xs-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="C"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="C" AND $resv[1]==$i){  echo "disconnect";}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="C<?php echo $i;?>"><span class="seat-no"><?php if($student[2] =="C" AND $student[1]==$i){echo 'SC';} else if($female[2] =="C" AND $female[1]==$i){echo 'FC';} else if($old[2] =="C" AND $old[1]==$i){echo 'OC';} else if($staff[2] =="C" AND $staff[1]==$i){echo 'St';} else echo 'C';?><?php echo $i;?></span></div>
                                          <?php $i = $i+2; 
                                      } ?>
                                     <div class="clearfix"></div> 

                                      <?php  
                                      $i=1;   
                                      while($i<=$cabin){  ?>
                                        <div  class="select col-md-1 col-xs-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="C"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="C"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="C<?php echo $i;?>"><span class="seat-no"><?php if($student[2] =="C" AND $student[0]==$i){echo 'SC';} else if($female[2] =="C" AND $female[0]==$i){echo 'FC';} else if($old[2] =="C" AND $old[0]==$i){echo 'OC';} else if($staff[2] =="C" AND $staff[0]==$i){echo 'St';} else echo 'C';?><?php echo $i;?></span></div>
                                          <?php $i = $i+2; 
                                      } ?>
                                     
                                </div>
                                <!-- <div id="multiselect">  -->  
                                <div class="last-martin col-md-<?php if($total_special > 0){echo $totalrowb + 1;} else echo $totalrowb;?>" style="padding-bottom: 0px;">
                                 <!-- Special Even Side Seats  -->
                                    <?php
                                    if($total_special > 0){  
                                      $i=2;   
                                      while($i<=$special){ ?>
                                        <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="S"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="S"){ if($resv[1]==$i){ echo "disconnect";}}}}  ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="S<?php echo $i;?>"><span class="seat-no">S<?php echo $i;?></span></div>
                                          <?php $i = $i+2; 
                                      }} ?>
                                      <!-- B Side Even seats  -->
                                    <?php  
                                      $i=2;   
                                      while($i<=$bside){  ?>
                                        <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                        <span class="seat-no"><?php if($student[2] =="B" AND $student[1]==$i){echo 'SB';} else if($female[2] =="B" AND $female[1]==$i){echo 'FB';} else if($old[2] =="B" AND $old[1]==$i){echo 'OB';} else if($staff[2] =="B" AND $staff[1]==$i){echo 'St';} else echo 'B';?><?php echo $i;?></span>
                                        </div>
                                          <?php $i = $i+2; 
                                      } ?>
                                      <div class="clearfix"></div>

                                       <!-- Special Odd side seat -->
                                    <?php
                                      $i=1;
                                      if($total_special > 0){
                                      while($i<=$special){ ?>
                                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="S"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="S"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="S<?php echo $i;?>"><span class="seat-no">S<?php echo $i;?></span></div>
                                        <?php $i = $i+2;
                                      }}
                                    ?>
                                      <!-- B Side Odd Seats -->
                                    <?php
                                      $i=1;
                                      while($i<=$bside){ ?>
                                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                        <span class="seat-no"><?php if($student[2] =="B" AND $student[0]==$i){echo 'SB';} else if($female[2] =="B" AND $female[0]==$i){echo 'FB';} else if($old[2] =="B" AND $old[0]==$i){echo 'OB';} else if($staff[2] =="B" AND $staff[0]==$i){echo 'St';} else echo 'B';?><?php echo $i;?></span>
                                        </div><?php 
                                        $i = $i+2;
                                      }
                                    ?>
                                   
                                   <div class="clearfix"></div>
                                   <br>
                                   <div class="clearfix" style="height: 12px;"></div>
                                    <?php  if($totalrowb > $totalrowa OR $totalrowb == $totalrowa AND $total_special > 0 OR $totalrowb > $totalrowa){ ?>
                                    <div class="col-md-1" style="width: 47px;"></div> 
                                    <?php } ?>
                                    
                                    <div class="aside-seats">
                                   <?php 
                                    $i=2;
                                      while($i<=$aside){ ?>
                                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>"><span class="seat-no"><?php if($student[2] =="A" AND $student[1]==$i){echo 'SA';} else if($female[2] =="A" AND $female[1]==$i){echo 'FA';} else if($old[2] =="A" AND $old[1]==$i){echo 'OA';} else if($staff[2] =="A" AND $staff[1]==$i){echo 'St';} else echo 'A';?><?php echo $i;?></span></div>
                                        <?php $i = $i+2;
                                      }
                                    ?>
                                    <div class="clearfix"></div>
                                    <?php if($totalrowb > $totalrowa OR $totalrowb == $totalrowa AND $total_special > 0 OR $totalrowb > $totalrowa){ ?>
                                    <div class="col-md-1" style="width: 47px;"></div> 
                                    <?php } ?>
                                    

                                    <?php
                                      $i=1;
                                       while($i<=$aside){ ?>
                                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>"><span class="seat-no"><?php if($student[2] =="A" AND $student[0]==$i){echo 'SA';} else if($female[2] =="A" AND $female[0]==$i){echo 'FA';} else if($old[2] =="A" AND $old[0]==$i){echo 'OA';} else if($staff[2] =="A" AND $staff[0]==$i){echo 'St';} else echo 'A';?><?php echo $i;?></span></div>
                                        <?php $i = $i+2;
                                      }
                                    ?>
                                    </div>
                                   <!--  <div class="clearfix"></div> -->
                                    
                                  </div>
                                   <div class="last-row col-md-1">
                                  <?php
                                      $i=1;
                                      if($last!==""){
                                       while($i<=$last){ ?>
                                      
                                        <div class="select pull-left col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="L"){  if($myside[1]==$i){ echo "disconnect";}}}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="L"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="L<?php echo $i;?>"><span class="seat-no">L<?php echo $i;?></span></div>
                                        <div class="clearfix"></div>
                                        
                                        <?php $i = $i+1;
                                      }}
                                    ?>
                                    </div>
                                    </div>
                                    </div>
                                  

                                    <?php }

                                     // If there is any hices in the scheadual.
                                    // All Hices will be in this condition with looping structure.
                                    else if($bus_type=="hice"){ ?>
                                    <div class="bus-seatss">
                                        <div id="multiselect"> 
                                        <div class="cabin-total col-md-<?php if($tot_cabin == ""){ echo 1;} else if($tot_cabin > 1){ echo $tot_cabin; } else echo 2;?>" style="padding: 0px;" >
                                        <div class="tot-cabin-hice" style="margin-bottom: 2px;">
                                         <img src="<?php echo base_url('uploads/seats/stering.jpg');?>" height="40 " width="40px" />
                                          </div>
                                         <div class="cabin-seat-hice">
                                         <?php  
                                              $i=1;   
                                              while($i<=$allseats[0]){  ?>
                                                <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="S"){  if($myside[1]==$i){ echo "disconnect";}}}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="S"){ if($resv[1]==$i){ echo "disconnect";}}}}  ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="S<?php echo $i;?>"><span class="seat-no">
                                                <?php  echo 'S';?><?php echo $i;?></span></div>
                                                  <?php $i = $i+1; 
                                              } ?>
                                         </div>

                                        </div>
                                        <!-- <div id="multiselect">  -->  
                                         <!-- Special Even Side Seats  -->
                                         <div class="col-md-1">
                                            <?php  
                                              $i=1;   
                                              while($i<=$allseats[1]){  ?>
                                                <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>">
                                                <span class="seat-no"><?php  echo 'A';?><?php echo $i;?></span>
                                                </div>
                                                 <div class="clearfix"></div>
                                                  <?php $i = $i+1; 
                                              } ?>
                                             </div>
                                              <!-- B Side Even seats  -->
                                            <div class="col-md-1">
                                                <?php  
                                                  $i=1;   
                                                  while($i<=$allseats[2]-1){  ?>
                                                    <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                                    <span class="seat-no"><?php  echo 'B';?><?php echo $i;?></span>
                                                    </div>
                                                     <div class="clearfix"></div>
                                                      <?php $i = $i+1; 
                                                  }  
                                                  $i=3;   
                                                  while($i<=$allseats[2]){ ?>
                                                   <div class="passage-hice"></div>
                                                  <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                                    <span class="seat-no"><?php  echo 'B';?><?php echo $i;?></span>
                                                    </div><?php 
                                                    $i = $i+1;
                                                    }?>
                                                 <div class="clearfix"></div>
                                             </div>
                                               <!-- Special Odd side seat -->

                                            <div class="col-md-1">
                                              <?php
                                                $i=1;
                                                while($i<=$allseats[3]-1){ ?>
                                                  <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="C"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="C"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="C<?php echo $i;?>"><span class="seat-no">C<?php echo $i;?></span></div>
                                                   <div class="clearfix"></div>
                                                  <?php $i = $i+1;
                                                }
                                                 $i=3;
                                                while($i<=$allseats[3]){ 
                                              ?>
                                              <div class="passage-hice"></div>
                                              <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="C"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="C"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="C<?php echo $i;?>"><span class="seat-no">C<?php echo $i;?></span></div>
                                              <?php $i = $i+1;
                                              }?>
                                            </div>
                                              <!-- B Side Odd Seats -->
                                           <div class="col-md-1">
                                              <?php
                                                $i=1;
                                                while($i<=@$allseats[4]){ ?>
                                                  <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="D"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="D"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="D<?php echo $i;?>">
                                                  <span class="seat-no"><?php  echo 'D';?><?php echo $i;?></span>
                                                  </div><?php 
                                                  $i = $i+1;
                                                }
                                              ?>
                                           </div>

                                          
                                           
                                           <!--  <div class="clearfix"></div> -->
                                            
                                         <!--  </div> -->
                                          
                                        </div>
                                        </div>

                                  <?php } 
                                  // All forces will be in this condition.
                                  // If any Forces is in the scehadual, this condition will contain.
                                  else if($bus_type=="force"){
                                    $rowa     = round($forceseats[1]/2);
                                    $rowb     = round($forceseats[2]/2); ?>
                                    <div class="bus-seatss">
                                      <div id="multiselect"> 
                                      <div class="cabin-total col-md-1" style="padding: 0px;" >
                                      <div class="tot-cabin" style="margin-bottom: 9px;">
                                       <img src="<?php echo base_url('uploads/seats/stering.jpg');?>" height="40 " width="40px" />
                                        </div>
                                       <div class="cabin-seat">
                                       <?php  
                                            $i=1;   
                                            while($i<=2){  ?>
                                              <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="C"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="C"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="C<?php echo $i;?>"><span class="seat-no"><?php if(@$student[2] =="C" AND @$student[1]==$i){echo 'SC';} else if(@$female[2] =="C" AND @$female[1]==$i){echo 'FC';} else if(@$old[2] =="C" AND @$old[1]==$i){echo 'OC';} else if(@$staff[2] =="C" AND @$staff[1]==$i){echo 'St';} else echo 'C';?><?php echo $i;?></span></div>
                                               <div class="clearfix"></div> 
                                                <?php $i = $i+1; 
                                            } ?>
                                          

                                       </div>

                                      </div>
                                      <!-- <div id="multiselect">  -->  
                                      <div class="last-martin col-md-<?php if($rowb > $rowa){echo  $rowa+1;} else echo $rowa ;?>" style="padding-bottom: 0px;">
                                       <!-- Special Even Side Seats  -->
                                          
                                            <!-- B Side Even seats  -->
                                          <?php  
                                            $i=2;   
                                            while($i<=$forceseats[2]){  ?>
                                              <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                              <span class="seat-no"><?php if(@$student[2] =="B" AND @$student[1]==$i){echo 'SB';} else if(@$female[2] =="B" AND @$female[1]==$i){echo 'FB';} else if(@$old[2] =="B" AND @$old[1]==$i){echo 'OB';} else if(@$staff[2] =="B" AND @$staff[1]==$i){echo 'St';} else echo 'B';?><?php echo $i;?></span>
                                              </div>
                                                <?php $i = $i+2; 
                                            } ?>
                                            <div class="clearfix"></div>

                                             <!-- Special Odd side seat -->
                                              
                                            <!-- B Side Odd Seats -->
                                          <?php
                                            $i=1;
                                            while($i<=$forceseats[2]){ ?>
                                              <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                              <span class="seat-no"><?php if(@$student[2] =="B" AND @$student[0]==$i){echo 'SB';} else if(@$female[2] =="B" AND @$female[0]==$i){echo 'FB';} else if(@$old[2] =="B" AND @$old[0]==$i){echo 'OB';} else if(@$staff[2] =="B" AND @$staff[0]==$i){echo 'St';} else echo 'B';?><?php echo $i;?></span>
                                              </div><?php 
                                              $i = $i+2;
                                            }
                                          ?>
                                         
                                         <div class="clearfix"></div>
                                         <br>
                                         <div class="clearfix" style="height: 12px;"></div>
                                          <?php  if($rowb > $rowa OR $rowb == $rowa AND $total_special > 0 OR $rowb > $rowa){ ?>
                                          <div class="col-md-1" style="width: 47px;"></div> 
                                          <?php } ?>
                                          
                                          <div class="aside-seats">
                                         <?php 
                                          $i=2;
                                            while($i<=$forceseats[1]){ ?>
                                              <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";}}}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>"><span class="seat-no"><?php if(@$student[2] =="A" AND @$student[1]==$i){echo 'SA';} else if(@$female[2] =="A" AND @$female[1]==$i){echo 'FA';} else if(@$old[2] =="A" AND @$old[1]==$i){echo 'OA';} else if(@$staff[2] =="A" AND @$staff[1]==$i){echo 'St';} else echo 'A';?><?php echo $i;?></span></div>
                                              <?php $i = $i+2;
                                            }
                                          ?>
                                          <div class="clearfix"></div>
                                          <?php if($rowb > $rowa OR $rowb == $rowa AND $total_special > 0 OR $rowb > $rowa){ ?>
                                          <div class="col-md-1" style="width: 47px;"></div> 
                                          <?php } ?>
                                          

                                          <?php
                                            $i=1;
                                             while($i<=$forceseats[1]){ ?>
                                              <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d");  if($myside[0]=="A"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>"><span class="seat-no"><?php if(@$student[2] =="A" AND @$student[0]==$i){echo 'SA';} else if(@$female[2] =="A" AND @$female[0]==$i){echo 'FA';} else if(@$old[2] =="A" AND @$old[0]==$i){echo 'OA';} else if(@$staff[2] =="A" AND @$staff[0]==$i){echo 'St';} else echo 'A';?><?php echo $i;?></span></div>
                                              <?php $i = $i+2;
                                            }
                                          ?>
                                          </div>
                                         <!--  <div class="clearfix"></div> -->
                                          
                                        </div>
                                         <div class="last-row col-md-1">
                                        <?php
                                            $i=1;
                                            if($last!==""){
                                             while($i<=$forceseats[3]){ ?>
                                            
                                              <div class="select pull-left col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="L"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="L"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="L<?php echo $i;?>"><span class="seat-no">L<?php echo $i;?></span></div>
                                              <div class="clearfix"></div>
                                              
                                              <?php $i = $i+1;
                                            }}
                                          ?>
                                          </div>
                                      </div>
                                      </div>
                                    <?php }
                                    // All Sumo will be contained this condition  
                                    else if($bus_type=="sumo"){?>
                                     <div class="bus-seatss">
                                      <div id="multiselect"> 
                                      <div class="cabin-total col-md-1" style="padding: 0px;" >
                                      <div class="tot-cabin-hice" style="margin-bottom: 2px;">
                                       <img src="<?php echo base_url('uploads/seats/stering.jpg');?>" height="40 " width="40px" />
                                        </div>
                                       <div class="cabin-seat-hice">
                                       <?php  
                                            $i=1;   
                                            while($i<=2){  ?>
                                              <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="F"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="F"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="F<?php echo $i;?>"><span class="seat-no"><?php  echo 'F';?><?php echo $i;?></span></div>
                                                <?php $i = $i+1; 
                                            } ?>
                                       </div>

                                      </div>
                                      <!-- <div id="multiselect">  -->  
                                       <!-- Special Even Side Seats  -->
                                       <div class="col-md-1">
                                          <?php  
                                            $i=1;   
                                            while($i<=4){  ?>
                                              <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>">
                                              <span class="seat-no"><?php  echo 'A';?><?php echo $i;?></span>
                                              </div>
                                               <div class="clearfix"></div>
                                                <?php $i = $i+1; 
                                            } ?>
                                           </div>
                                            <!-- B Side Even seats  -->
                                          <div class="col-md-1">
                                              <?php  
                                                $i=1;   
                                                while($i<=4){  ?>
                                                  <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]==$i){ echo "disconnect";} }}}  if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                                                  <span class="seat-no"><?php  echo 'B';?><?php echo $i;?></span>
                                                  </div>
                                                   
                                                    <?php $i = $i+1; 
                                                } ?>     
                                           </div>
										   
                                      </div>
                                      </div>
                                       <div class="clearfix"></div>
                                    <?php } ?>
              
                               </div> 
                                
                                    <div class="col-md-3 no-padding">
                                    <input type="hidden" name="ticket_date" value="<?php echo $departuredate;?>">
                                    <input type="hidden" name="buscompany" value="<?php echo $buscompany;?>">
                                    <div class="seatdetails">
                                      <p><strong>Seats</strong></p>
                                      <input type="text" value="" class="inputer" id="pri<?php echo $everybus;?>" name="cprice" />
                                     <div class="seatinfo<?php echo $everybus;?> seatinfo"></div>
                                      <div class="messages"></div>     
                                      <div class="clearfix"></div>
                                      <small style="color:red;">(Only six seats are booked for one ticket)</small>
                                      <br>
                                     <p><strong>Amount</strong></p>
                                     <big class="text-danger"> <strong>Rs <span id="pricebox<?php echo $everybus;?>"></span> /-</strong></big>
                                      <div class="clearfix"></div>
                                      
                                    </div>
                             
                                   
                                    
                                    <input type="hidden" name="ticket_date" value="<?php echo $departuredate;?>">
									<input type="hidden" name="inputfrom" value="<?php echo $from;?>">
									<input type="hidden" name="inputto" value="<?php echo $to;?>">
                                    <input type="hidden" name="buscompany" value="<?php echo $buscompany;?>">
                                    <input type="hidden" name="buscategory" value="<?php echo $bus_category;?>">
                            </div>
                            <div class="clearfix"></div>
                           
                            <div class="row collapse" id="busdetailview<?php echo $displybus['id'] ;?>">
                            <div class="col-md-12">
                                 <hr>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-9 otherinfo">
                            <div class="panel-group" id="accordion<?php echo $displybus['id'];?>1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion<?php echo $displybus['id'];?>1" href="<?php echo base_url(uri_string());?>#collapse-<?php echo $displybus['id'];?>1" >Boarding and Dropping points</a></h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapse-<?php echo $displybus['id'];?>1">
                                        <div class="panel-body">
                                            <div class="col-md-6 row">
                                                <b>Boarding Points</b>
                                                <div class="clearfix"></div>
                                                <ul class="bdpoints">
                                                    <?php 
                                                        $boardingpoint = explode(',',$displybus['boardingpoint']);
                                                        $boardingtime = explode(',',$displybus['boardingtime']);
                                                        $count =  count($boardingpoint );
                                                        for($i=0; $i<$count; $i++){
                                                    ?>
                                                        <li><?php foreach($busrot as $rot){if($rot['id']==$boardingpoint[$i]){echo $rot['from'];}};?>  <?php echo $boardingtime[$i];?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                               <b>Dropping Points</b>
                                               <div class="clearfix"></div>
                                                <ul class="bdpoints">
                                                    <?php 
                                                        $droppingpoint = explode(',',$displybus['droppingpoint']);
                                                        $droppingtime = explode(',',$displybus['droppingtime']);
                                                        $count =  count($droppingpoint );
                                                        for($i=0; $i<$count; $i++){
                                                    ?>
                                                        <li><?php foreach($busrot as $rot){if($rot['id']==$droppingpoint[$i]){echo $rot['from'];}};?>  <?php echo $droppingtime[$i];?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-group" id="accordion<?php echo $displybus['id'];?>3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion<?php echo $displybus['id'];?>3" href="<?php echo base_url(uri_string());?>#collapse-<?php echo $displybus['id'];?>3" >Cancellation Policy</a></h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapse-<?php echo $displybus['id'];?>3">
                                        <div class="panel-body">
                                           
                                            Cancellation Policy

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3 otherinfo">
                            <div class="panel-group" id="accordion<?php echo $displybus['id'];?>2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion<?php echo $displybus['id'];?>2" href="<?php echo base_url(uri_string());?>#collapse-<?php echo $displybus['id'];?>2" >Fetures</a></h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapse-<?php echo $displybus['id'];?>2">
                                        <div class="panel-body">
                                            <?php 

                                                  $catagorydetail =   $this->dynamic_query->getby($bus_category,'category_setup','id');
                                                  foreach($catagorydetail as $cata){
                                                    $cats = explode(',',$cata['features']);
                                                   foreach($busfetures as $bfeture){
                                                        if(in_array($bfeture['id'],$cats)){
                                                    ?>
                                                            <p> <?php echo $bfeture['title'];?> </p>
                                                    <?php 

                                                     }
                                                   }
                                                  }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                       <div class="clearfix"></div>
                    <div class="modal-footer">
                       <button type="submit" name="contbooking" value="myseats" id="btns" class="btn btn-info btn-md"> Continue Booking </button>
                      <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"> Close </button>
                    </div>
               
                  </div>
                  
                </div>

              </div>

              </form> 

                        </li>
                       <?php } 
                       }else{
                        ?>
                            <div class="alert alert-danger hidden-xs visible-stb">
                                <i class="fa fa-info-circle"></i> No Result Found.
                            </div>
                        <?php
                        }?>
                    </ul>
                    <?php if(count(@$busschedule)>0){ ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p><small>100 bus are departing from New buspark</small>
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p>Not what you're looking for? <a class="popup-text" href="<?php echo base_url(uri_string());?>" data-effect="mfp-zoom-out">Try your search again</a>
                            </p>

                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="gap"></div>
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>