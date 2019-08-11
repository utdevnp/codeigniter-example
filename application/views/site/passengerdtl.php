<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?></h3>
            
            <div class="booking-item-dates-change mb30 passengerdtl">
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

                   
                   <div class="col-md-3">
                        <div class="booking-item-car-img">
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
                            <p class="booking-item-car-title"><?php
                        foreach($busno as $bus){
                          foreach($allcatagory as $cat)
                          {
                            if($cat['id']==$bus['bus_category']){
                              echo strtoupper($cat['title']);
                            }
                          }
                        }
                      ?></p>
                        </div>
                    </div>
                    <?php 
                      foreach($scheadual as $busschedul){
                      ?>
                    <div class="col-md-3">
                    <span class="rightarrow buslist">&rightarrow; </span>
                       <p><b><?php foreach($allrot as $rot){if($rot['id']==$busschedul['from']){echo $rot['from'];}} ?></b></p>
                       <h5>
                         <?php $mydate = strtotime($busschedul['departure']); echo date('M d,D', $mydate); ;?>
                             <?php echo $busschedul['departuretime'];?>
                         </h5>
                    </div>
                    <div class="col-md-3">
                        <p><b><?php foreach($allrot as $rot){if($rot['id']==$busschedul['to']){echo $rot['from'];}} ?></b></p>
                         <h5>
                            <?php $mydate = strtotime($busschedul['arrival']); echo date('M d,D', $mydate);?>
                                <?php echo $busschedul['arrivaltime'];?> 
                            </h5>
                    </div>
                     <?php } ?>
                    <div class="col-md-3 faredetails">
                    <p class="pull-right"><small class="pull-right"><a href="javascript:void(0);" data-toggle="popover" title="" data-placement="left" data-trigger="hover" data-html="true" data-content="
                        <small>
                         <strong>Bus Fare</strong> &nbsp;&nbsp;   <span class='pull-right'  align='right'>Rs <?php echo $tprice;?>/-</span> <br>
                         <strong>Discount</strong> &nbsp;&nbsp;   <span class='pull-right'  align='right'><?php echo $dis =  0;?>%</span> <br>
                         <strong>Total</strong>   <span class='pull-right' align='right'>Rs <?php echo $tprice-($tprice*$dis/100);?>/-</span><br>
                         </small>
                " data-original-title="Fare Summary">Fare Details</a></small></p>
                    <div class="clearfix"></div>
                    <p class="pull-right"><small>Grand Total:</small> <big>Rs <?php echo $tprice;?>/-</big></p>
                    </div>

                </div>
            </div>



        <div class="clearfix"></div>
                <div class="col-md-9 row">
                    
                   <form id="passengerdtls" method="post" enctype="multipart/form-data" action="<?php echo base_url('home/confirmation');?>">  
                   <?php for($i=0;$i<$total;$i++){ ?>  
                    <div class="panel panel-default panelcuston">
                        <div class="panel-heading">
                                Travaller No <?php echo $i+1;?>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-2">
                                Seat No <big><?php echo $seat[$i];?></big><br>
                                <?php if($seat[$i]==$female[2].$female[0] OR $seat[$i]==$female[2].$female[1]){  echo "Female";}?>
                                <?php if($seat[$i]==$old[2].$old[0] OR $seat[$i]==$old[2].$old[1]){  echo "Old Citizen";}?>
                                <?php if($seat[$i]==$stuid[2].$stuid[0] OR $seat[$i]==$stuid[2].$stuid[1]){echo "Student";}?>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-8">
                                    <label>Full Name <?php if($i==0){;?> <small> ( Primary Traveller <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ticket will be setting up in primary traveller name"> <i class="fa fa-info-circle"></i> </a>)</small> <?php }?></label>
                                    <input class="form-control fullname" type="text" name="name[]" placeholder="Travaller's Name">
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Age</label>
                                    <input name="age[]" maxlength="3" class="form-control page <?php if($seat[$i]==$old[2].$old[0] OR $seat[$i]==$old[2].$old[1]){ echo "oldage";}else{}?>" type="number" placeholder="Age">
									<?php if($seat[$i]==$old[2].$old[0] OR $seat[$i]==$old[2].$old[1]){;?>
									<div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
									<?php } ?>
                                    <input type="hidden" name="seat[]" value="<?php echo $seat[$i];?>" class="form-control" id="seat">
                                </div>
                                <div class="funkyradio col-md-12 row">
                                    <div class="funkyradio-success col-sm-4">
                                        <div class="form-group col-sm-12 row">
                                            <input  type="radio" class="form-control gender11" value="M" <?php if($seat[$i]==$female[2].$female[0] OR $seat[$i]==$female[2].$female[1]){  echo "disabled";}else{echo "checked='checked';";}?> name="gender<?php echo $seat[$i];?>[]" id="radio1<?php echo $seat[$i];?>" />
                                            <label for="radio1<?php echo $seat[$i];?>">Male</label>
                                        </div>
                                    </div>
                                    <div class="funkyradio-success col-sm-4">
                                     <div class="form-group col-sm-12 row">
                                        <input  type="radio" class="form-control gender11" value="F"   <?php if($seat[$i]==$female[2].$female[0] OR $seat[$i]==$female[2].$female[1]){ echo "checked='checked'"; }?> name="gender<?php echo $seat[$i];?>[]" id="radio2<?php echo $seat[$i];?>"/>
                                        <label for="radio2<?php echo $seat[$i];?>">Female</label>
                                     </div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <p class="gerror"></p>
                            </div>
                        </div>
                    </div>
                     <?php } ?>

                    <div class="panel panel-default panelcuston">
                        <div class="panel-body agree">
                                <div class="col-md-1">
                                    <div class="checkbox form-group">
                                        <label class="Icheckbox"><input class="i-check" name="agreem" type="checkbox" /></label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <p>Secure Traveller Insurance. I understand & agree with the <a href="javascript:void(0)">Terms and Conditions</a> of the insurance and the <a href="javascript:void(0)">terms</a> of  bus.databanknepal.com.</p>
                                </div>
                        </div>
                    </div>
                    <div class="panel panel-default panelcuston">
                        <div class="panel-body agree discount">
                                <div class="col-md-6">
								<br>
                                    <p>Have a discount / promo code (optional)</p>
                                </div>

                                <div class="col-md-6 form-group">
								<br>
                                    <input class="form-control" name="coupon" type="text" placeholder="Enter Coupon code">
                                </div> 
                        </div>
                    </div>
                    <?php 
                    for($i=0;$i<$total;$i++){ 
                    if($seat[$i]==$stuid[2].$stuid[0] OR $seat[$i]==$stuid[2].$stuid[1]){ ?>
                     <div class="panel panel-default panelcuston">
                        <div class="panel-heading">
                           Please  upload your valid stident id card and validity date
                        </div>
                        <div class="panel-body">
                         <?php 
                            for($i=0;$i<$total;$i++){ 
                                if($seat[$i]==$stuid[2].$stuid[0] OR $seat[$i]==$stuid[2].$stuid[1]){ ?>
                                   <div class="form-group col-md-4">
                                    <label for="contactNO">Student Card (seat <?php echo $seat[$i];?>) <small>jpg,gif,png</small> </label>
                                    <input type="file"  accept="image/*" name="card<?php echo $seat[$i];?>[]" class="form-control idcard" id="card">
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                   </div>
                                    <div class="form-group col-md-4">
                                    <label for="contactNO">Card Validity End Date (seat <?php echo $seat[$i];?>) </label>
                                    <input type="text"  name="cvalidity<?php echo $seat[$i];?>[]" class="form-control cvalid" id="cvalidity" placeholder="YYYY/MM/DD">
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                   </div>
                                   <div class="clearfix"></div>
                                <?php
                                }
                              }
                            ?>
                        
                        </div>
                    </div>
                    <?php } }?>

                    <div class="panel panel-default panelcuston">
                        <div class="panel-heading">
                            Please Provide Information 
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-6">
                                <label>Email  <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="This email is your contact email"> <i class="fa fa-info-circle"></i> </a> </label>
                              
                                <input class="form-control required-field-block" type="text" name="email" placeholder="Your Email">
                                
                                 <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Mobile No  <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="This phone no is your contact no"> <i class="fa fa-info-circle"></i> </a></label>
                                <div class = "input-group">
                                     <span class = "input-group-addon">+977</span>
                                    <input class="form-control" type="text"  name="phone" placeholder="Mobile No">
                                 </div>
                                  <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                            </div>
                            <div class="clearfix"></div>
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
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                             </div>
                             <div class="form-group col-md-6">
                                <label for="bp">Dropping Point</label>
                                    <select name="dropping" required="required" class="form-control">
                                         <option value="">Select Dropping Point</option>
                                        <?php for($i=0;$i<$cd;$i++){ ?>
                                          <option value="<?php echo $dp[$i].','.$dt[$i];?>"> 
                                          <?php  foreach($allrot as $route){ if($route['id']==$dp[$i]) { echo $route['from'];}}?> (<?php echo $dt[$i];?>)</option><?php }?>
                                    </select>
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                             </div>
                             <div class="clearfix"></div>
                             <div class="col-md-12">
                                 
                             </div>

                        </div>
                    </div>
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="col-md-3 col-sm-12">
                            <input type="hidden" name="discount" value="<?php echo $discount;?>"  id="discount" >
                            <input type="hidden" name="tamount" value="<?php echo $tprice;?>"  id="tamount" >
                            <input type="hidden" name="buscompany" value="<?php echo $buscom;?>"  id="com" >
                            <input type="hidden" name="departure" value="<?php echo $departuredate;?>"  id="date" >
                            <input type="hidden" name="selectedseats" value="<?php echo $selected;?>"  id="sseats" > 
                            <input type="hidden" name="sid" value="<?php echo $sid;?>"  id="scheadual_id" >
							<input type="hidden" name="tmp_id" value="<?php echo $tmp_id;?>"  id="scheadual_id" >
                              <?php  if(!$this->session->userdata('DBUserH')){ ?>
                                <button type="submit" name="pdetail" value="detail" class="btn btn-primary btn-md">Continue as Guest</button>
                                <?php } else{ ?>
                                    <button type="submit" name="pdetail" value="detail" class="btn btn-danger btn-md">Book Now </button>
                                <?php } ?>
                           </div>
                           <?php  if(!$this->session->userdata('DBUserH')){;?>
                           <div class="col-md-1">
                                <p> <big><!--  OR --> </big></p>
                           </div>
                            <div class="col-md-3 col-xs-12">
                               <!--  <button type="button" class="btn btn-default btn-md">Login & Continue</button> -->
                           </div>
                           <div class="row col-md-5 col-xs-12">
                                <p><a href=""> <!-- Why we recommend login ?  --></a></p>
                           </div>
                           <?php } ?>
                           <div class="clearfix"></div>
                           <div class="col-md-12">
                           <hr>
                               <p>
By clicking the above button you agree with the <a href="javascript:void(0)">bus booking policies</a>, the <a href="javascript:void(0)">Privacy policy</a> and <a href="javascript:void(0)">Terms & Conditions</a> of bus.databanknepal.com</p>
                           </div>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="col-md-3 row pull-right col-xs-12">
                 
                 sidebar
              
                </div>
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>