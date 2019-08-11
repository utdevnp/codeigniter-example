<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?> </h3>
            
            <div class="col-md-12">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9 bhoechie-tab-container">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                              <div class="list-group">
                                <a href="#" class="list-group-item active text-center">
                                  <i class="fa fa-credit-card-alt" aria-hidden="true"></i> &nbsp; Pay With eSewa
                                </a>

                                <a href="#" class="list-group-item  text-center">
                                  <i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp; Pay With iPay
                                </a>
                                
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                                <!-- flight section -->
                                <div class="bhoechie-tab-content active">
                                    <section class="invoice pull-right">
      <!-- title row -->            
                                   
                                       <?php foreach($scheadual as $buschedule){
										   $from11 = $buschedule['from'];
										   $to11 = $buschedule['to'];
										   $departure11 = $buschedule['departure'];
										   ?>
                                      <div class="row invoice-info">

                                        <div class="col-sm-4 invoice-col">
                                          <strong>From</strong>
                                          <address>
											 <strong><?php foreach($from as $f){if($f['id']==$buschedule['from']){echo strtoupper($f['from']);}} ?></strong><br>
											Departing  :  <?php echo nice_date($buschedule['departure'],"M d, D")." ".$buschedule['departuretime'] ; ?><br>
											Boarding Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['boarding']){echo $route['from'];}}}?> (<?php echo $btimes;?>)
											 <br><small>DEPARTING</small>
                                          </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                          <strong>To</strong>
                                          <address>

											<strong><?php foreach($to as $f){if($f['id']==$buschedule['to']){echo strtoupper($f['from']);}} ?></strong><br>
										   Arrival : <?php echo nice_date($buschedule['arrival'],"M d, D")." ".$buschedule['arrivaltime'] ; ?> <br>
											 Dropping Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['dropping']){echo $route['from'];}}}?>  (<?php echo $dtimes;?>)                 
                                            <br><small>ARRIVAL</small>
                                                                           
                                          </address>
                                        </div>
                                        <!-- /.col -->
                                       <div class="col-sm-4 invoice-col">
                                          <strong>Bus Detail</strong><br>
                                          <?php foreach($busdetail as $busmatch){?>
											<strong> <?php echo strtoupper($busname);?></strong> <br>
											Shift:<?php echo $buschedule['shift']; ?><br>
											Bus Type : <?php foreach($buscatagory as $cata){foreach($busdetail as $buscata){if($buscata['bus_category']==$cata['id']){echo $cata['title']; }}} ?>
											<?php 
											  }
											?>
											 <br><small>BUS DETAIL</small>
                                        </div> 
                                        <!-- /.col -->
                                      </div>
                                            <!-- /.row -->
                                    <?php } ?>
                                      <!-- Table row -->
                                      <div class="row">
                                        <div class="col-xs-12 table-responsive">
                                          <table class="table table-striped">
                                            <thead>

                                            <tr>
                                              <th>SN</th>
                                              <th>Name</th>
                                              <th>Seat No</th>
                                              <th>Rate </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
											 
											  foreach($passenger_info as $info){
												  $pid = $info['id'];
												  $rate = $info['rate'];
												  $dis = $info['tdiscount'];
												  $total = $info['total'];
												  $ticketid = $info['ticketid'];
											  }
                                                  $sn = 1;
												  $num = count($stotalpassenger);
                                                 foreach($stotalpassenger as $p){  ?>
                                                <tr>
                                                  <td><?php echo $sn++;?></td>
                                                  <td><?php echo $p['name'];?></td>
                                                  <td><?php echo $p['seat'];?></td>
                                                  <td><?php  if($p['info_id']==$pid){echo "Rs :  " .$rate."/-";}?></td>
                                                </tr>
                                                <?php } ?>
                                             </tbody>
                                          </table>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.row -->
                                      <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                          <p class="" style="margin-top: 10px;">
                                           <strong>CANCELLATION TERM &amp; POLICY :</strong>
                                            When you create your Airbnb listing you select one of three standard cancellation policies: Flexible: Full refund 1 day prior to arrival, except fees. Moderate: Full refund 5 days prior to arrival, except fees. Strict: 50% refund up to 1 week prior to arrival, except fees.
                                          </p>
                                        </div>
                                        <!-- /.col -->
                                       <div class="col-xs-12 col-sm-6 col-md-6">
                                         <form method="post" action="https://esewa.com.np/epay/main">
									     <input value="<?php echo $total;?>" name="tAmt" type="hidden">
										 <input value="<?php echo $total;?>" name="amt" type="hidden">
										 <input value="0" name="txAmt" type="hidden">
										 <input value="0" name="psc" type="hidden">
										 <input value="0" name="pdc" type="hidden">
										 <input value="databank" name="scd" type="hidden">
										 <input value="DBI-<?php echo $ticketid;?>" name="pid" type="hidden">   
										 <input value="<?php echo "http://www.databankbooking.com/home/getticket/".$ticketid."?q=su";?>" type="hidden" name="su">  
										 <input value="<?php echo "http://www.databankbooking.com/home/getticket?q=fu";?>" type="hidden" name="fu"> 
	 
                                        
                                      
                                          <div class="table-responsive">
                                            <table class="table">
                                             <tbody><tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td><?php echo "Rs: ".$rate*$num."/-";?></td>
                                              </tr>
                                              
                                              <tr>
                                                <th>Discount(<?php echo ($dis *100)/$rate*$num."%";?>):</th>
                                                <td><?php echo "Rs: ".$dis."/-";?></td>
                                              </tr>
                                              <tr>
                                                <th>Rate:</th>
                                                <td><?php echo "Rs: ".$rate."/-";?></td>
                                              </tr>
                                              <tr>
                                                <th>Total:</th>
                                                <td><?php echo "Rs: ".$total."/-";?></td>
                                              </tr>
                                            </tbody></table>
                                          </div>
                                         
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.row -->
                                      <!-- this row will not appear when printing -->
                                      <?php
                                         $url = base_url('home/cancalbooking/'.$pid."/").$from11."/".$to11."/".$departure11;
                                      ?>
                                      <div class="row no-print">
                                        <div class="form-group col-md-6 pull-right">
                                          <button type="submit" name="pay" value="cpayement" class="btn btn-success btn-sm btn-flat pull-right" "=""><i class="fa fa-credit-card"></i> Pay With eSewa</button>
                                          <a href="<?php echo $url;?>" class="btn btn-danger btn-sm btn-flat pull-right" style="margin-right:5px;"><i class="fa fa-times"></i> Cancel Payment</a>
                                        </div>
                                      </div>
                                    </form>
                                    </section>
                                </div>   
								<div class="bhoechie-tab-content">
									We are working on it .....
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