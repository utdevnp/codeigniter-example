<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?> </h3>
            
            <div class="col-md-12">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9 bhoechie-tab-container">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 bhoechie-tab-menu">
                              <div class="list-group">
                                <a href="#" class="list-group-item <?php if(!empty($this->uri->segment('3'))){}else{echo "active";};?> text-center">
                                  <i class="fa fa-television" aria-hidden="true"></i> &nbsp; Dashboard
                                </a>

                                <a href="#" class="list-group-item <?php if($this->uri->segment('3')=="history"){echo 'active';}?>  text-center">
                                  <i class="fa fa-address-book" aria-hidden="true"></i> &nbsp; Traval  History
                                </a>
                                <a href="#" class="list-group-item <?php if($this->uri->segment('3')=="update"){echo 'active';}?>  text-center">
                                  <i class="fa fa-user" aria-hidden="true"></i> &nbsp; Update Profile
                                </a>
                                <a href="#" class="list-group-item <?php if($this->uri->segment('3')=="changepassword"){echo 'active';}?>  text-center">
                                  <i class="fa fa-key" aria-hidden="true"></i> &nbsp; Change Password
                                </a>
								
								 <a href="#" class="list-group-item <?php if($this->uri->segment('3')=="complains"){echo 'active';}?>  text-center">
                                  <i class="fa fa-bookmark" aria-hidden="true"></i> &nbsp; Complains
                                </a>
                                
                                
                              </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 bhoechie-tab">
                              <?php $this->load->view('control/inc/message');?>
                              <?php $this->load->view('control/inc/validation');?>
                                <!-- flight section -->
                                <div class="bhoechie-tab-content <?php if(!empty($this->uri->segment('3'))){}else{echo "active";};?>">
                                    <section class="invoice">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="info-box">
                                            <span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>

                                            <div class="info-box-content">
                                              <span class="info-box-text">Reward</span>
                                              <span class="info-box-number"><?php $total = 0; foreach($usertravelhistry as $re){
                                                   $total =  $re['cuserreward'] + $total;
                                                } echo $total; ?></span>
                                            </div>
                                            <!-- /.info-box-content -->
                                          </div>
                                          <!-- /.info-box -->
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="info-box">
                                            <span class="info-box-icon bg-green"><i class="fa fa-ticket"></i></span>

                                            <div class="info-box-content">
                                              <span class="info-box-text">Tickets</span>
                                              <span class="info-box-number"><?php echo count($usertravelhistry);?></span>
                                            </div>
                                            <!-- /.info-box-content -->
                                          </div>
                                          <!-- /.info-box -->
                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                          <div class="info-box">
                                            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

                                            <div class="info-box-content">
                                              <span class="info-box-text">Payement</span>
                                              <span class="info-box-number"><?php $total = 0; foreach($usertravelhistry as $re){
                                                   $total =  $re['total'] + $total;
                                                } echo $total; ?></span>
                                            </div>
                                            <!-- /.info-box-content -->
                                          </div>
                                          <!-- /.info-box -->
                                        </div>
                                    </section>
                                </div> 
                                <div class="bhoechie-tab-content <?php if($this->uri->segment('3')=="history"){echo 'active';}?>">
                                    <section class="invoice">
                                        <div class="table-responsive">          
                                          <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>PNR</th>
                                                <th>Coupon</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; foreach($usertravelhistry as $history){;?>
                                              <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php 
                                                $where = array('id'=>$history['sid']);
                                                echo  $this->site_model->getbususerbyfield('bus_scheadual',$where,'departure');?></td>
                                                <td><?php echo $history['name'];?></td>
                                                <td><?php echo $history['ticketid'];?></td>
                                                <td><?php echo $history['coupon'];?></td>
                                                <td><?php echo $history['total'];?></td>
                                                <td>
                                                  <span> <?php echo $history['cuserreward'];?></span> &nbsp;
                                                  <span class="pull-right"><form method="post" action="<?php echo base_url('user/index/history');?>">
                                                      <input type="hidden" name="pnr" value="<?php echo $history['ticketid'];?>">
                                                      <input type="hidden" name="mobile" value="<?php echo $history['contact'];?>">
                                                      <button type="submit" name="userticket" value="usearch" class="btn btn-primary  btn-xs"><i class="fa fa-print"></i> Print </button>
                                                  </form></span>
                                                  <span class="pull-right" style="margin-right:10px;"> <button type="button" name="userticket" data-toggle="collapse" data-target="#travellers<?php echo $history['ticketid'];?>" value="usearch" class="btn btn-danger  btn-xs"><i class="fa fa-user-circle-o"></i> Travellers </button></span>
                                                </td>
                                              </tr>
                                              <tr>
                                              <td colspan="7" style="padding:0px;">
                                              <div id="travellers<?php echo $history['ticketid'];?>" class="collapse">
                                              <table class="table table-striped">
                                              <thead>
                                                <tr>
                                                  <th><small>#</small></th>
                                                  <th><small>Name</small></th>
                                                  <th><small>Gender</small></th>
                                                  <th><small>Age</small></th>
                                                  <th><small>Seat</small></th>
                                                  <th><small>Card Cvalidity</small></th>
                                                  <th><small>Card</small></th>
                                                  <th><small>Rate</small></th>
                                                </tr>
                                              <tbody>
                                              <?php 
                                                $where = array('info_id'=>$history['id']);
                                                $travellers = $this->dynamic_query->getbywhere('passengers_detail',$where);
                                                $i=1;
                                                foreach($travellers as $traveler){
                                                ?>
                                                <tr>
                                                  <td><?php echo $i++;?></td>
                                                  <td><?php echo $traveler['name'];?></td>
                                                  <td><?php echo $traveler['gender'];?></td>
                                                  <td><?php echo $traveler['age'];?></td>
                                                  <td><?php echo $traveler['seat'];?></td>
                                                  <td><?php echo $traveler['cvalidity'];?></td>
                                                  <td><?php echo $traveler['card'];?></td>
                                                  <td><?php echo $history['rate'];?></td>
             
                                                </tr>
                                                <?php
                                                }
                                              ?>
                                              </div>
                                            </tbody>
                                            </table>
                                           </td>
                                           </tr>
                                            <?php } 
												
											?>
                                            </tbody>
                                          </table>
										  <?php echo  $this->pagination->create_links($usertravelhistry); ?>
                                        </div>        
                                    
                                    </section>
                                </div> 
                                <div class="bhoechie-tab-content <?php if($this->uri->segment('3')=="update"){echo 'active';}?>">

                                    <section class="invoice row">

                                    <?php foreach($userdtl as $udtl){ ?>
                                    <form method="post" id="userupdateForm" action="<?php echo base_url('user/update');?>">
      <!-- title row -->              <div class="col-md-4 form-group">
                                        <label>First Name</label>
                                        <input style="border-radius: 0px;" name="fname" value="<?php echo $udtl['fname'];?>" placeholder="" class="form-control" type="text">
                                        
                                      </div>
                                      <div class="col-md-4 form-group">
                                        <label>Last Name</label>
                                        <input style="border-radius: 0px;" name="lname" value="<?php echo $udtl['lname'];?>" placeholder="" class="form-control" type="text">
                                        
                                      </div>
                                      <div class="col-md-4 form-group">
                                        <label>Address</label>
                                        <input style="border-radius: 0px;" name="address" value="<?php echo $udtl['address'];?>" placeholder="" class="form-control" type="text">
                                       
                                      </div>

                                       <div class="clearfix"></div>
                                      <div class="col-md-12">
                                        <hr>
                                      </div>
                                      <div class="clearfix"></div>

                                      <div class="col-md-6 form-group">
                                        <label>Email <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="When you change your email address your username  also change. "> <i class="fa fa-info-circle"></i> </a></label>
                                        <input style="border-radius: 0px;" name="email" value="<?php echo $udtl['email'];?>" placeholder="" class="form-control" type="text">
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 form-group">
                                        <label>Mobile No</label>
                                        <div class="input-group">
                                        <span class="input-group-addon">+977</span>
                                        <input style="border-radius: 0px;" name="mobile_no" value="<?php echo $udtl['mobile_no'];?>" placeholder="" class="form-control" type="text">
                                        </div>
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="col-md-12">
                                        <hr>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="col-md-4 form-group">
                                       <button type="submit" name="updateuser" value="upate" class="btn btn-danger  btn-md"><i class="fa fa-floppy-o"></i> Save & Update </button>
                                      </div>
                                      </form>
                                    </section>
                                    <?php } ?>
                                </div>  
                                <div class="bhoechie-tab-content <?php if($this->uri->segment('3')=="changepassword"){echo 'active';}?>">
                                    <section class="invoice ">
                                    <form method="post" id="userpasswworChange" action="<?php echo  base_url('user/userchangepassword');?>">
      <!-- title row -->             <div class="col-md-4 form-group">
                                        <label>Old Password </label>
                                        <input style="border-radius: 0px;" name="oldpassword"  class="form-control passwords" type="password">
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                      </div>

                                      <div class="clearfix"></div>
                                      <div class="col-md-12">
                                        <hr>
                                      </div>
                                      <div class="clearfix"></div>

                                      <div class="col-md-4 form-group">
                                        <label>New  Password </label>
                                        <input style="border-radius: 0px;" name="password"   class="form-control passwords" type="password">
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                      </div>
                                      <div class="col-md-4 form-group">
                                        <label>Confirm Password </label>
                                        <input style="border-radius: 0px;" name="repassword"  class="form-control passwords" type="password">
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                      </div>
                                      <div class="col-md-3 form-group">
                                      <label style="color:#fff;">. </label>
                                       <button type="submit" name="chapgeudercp" value="change" class="btn btn-danger  btn-md"><i class="fa fa-key"></i> Change </button>
                                      </div>
                                    </form>
                                    
                                    </section>
                                </div> 

							<div class="bhoechie-tab-content <?php if($this->uri->segment('3')=="complains"){echo 'active';}?>">
                  									
                                         
                                   
                                  <?php 

                                  if($this->uri->segment('4')=="add"){?>

                                      <form method="post" action="<?php echo  base_url('user/addcomplains');?>">
                                    <div class="col-md-8 form-group">
                                      <label>Subject </label>
                                      <input style="border-radius: 0px;" name="subject"  class="form-control passwords" type="text">
                                      <div class="required-icon">
                                          <div class="text">*</div>
                                      </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                     <label style="color:#fff;"> . </label>
                                      <a href="<?php echo base_url('user/index/complains/list');?>">View Complains</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-4 form-group">
                                        <label>Services </label>
                                        <select class="form-control" name="service" style="border-radius: 0px;">
                                          <option value="">Select Service</option>
                                          <option value="Bus Ticketing">Bus Ticketing</option>
                                        </select>
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Message </label>
                                        <textarea style="border-radius: 0px;" name="message" rows="8" cols="8" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <button type="submit" name="submitc" value="submessage" class="btn btn-danger  btn-md"><i class="fa fa-check-circle"></i> Submit </button>
                                    </div>
                                  </form>

                                     <?php } ?>


                                      <div class="col-md-12 form-group">
                                     <a href="<?php echo base_url('user/index/complains/add');?>"  class="btn btn-primary  btn-sm pull-right"><i class="fa fa-plus"></i> New Complain </a>
                                    </div>
                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th></th>
                                          <th>#</th>
                                          <th>Date</th>
                                          <th>Service</th>
                                          <th>Subjecct</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $i=1; foreach($complains as $cc){;?>
                                        <tr>
                                          <td><i style="cursor: pointer;" data-toggle="collapse" data-target="#message<?php echo $cc['id'];?>" class="fa fa-plus"></i></td>
                                          <td><?php echo $i++;?></td>
                                          <td><?php echo $cc['timestamp'];?></td>
                                          <td><?php echo $cc['service'];?></td>
                                          <td><?php echo $cc['subject'];?></td>
                                          <td>
                                            <span class="label label-<?php if($cc['is_active']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($cc['is_active']=="Y"){echo "Open";}else{echo "Close";};?></span>
                                          </td>

                                        <tr>
                                        <tr>
                                          <td colspan="7" style="padding:0px;">
                                              <div id="message<?php echo $cc['id'];?>" class="collapse">
                                                <table class="table">
                                                  <tr>
                                                    <td><small>Message</small></td>
                                                  </tr>
                                                  <td><?php echo $cc['subject'];?></td>
                                                </table>
                                              </div>
                                          </td>
                                        </tr>
                                        <?php }
											 
										?>
                                      </tbody>
                                    </table>
									<?php  echo $this->pagination->create_links($complains);?>

                  				</div>
                            </div>
                        </div>
                  </div>
            </div>

        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>