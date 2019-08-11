<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
         
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?> </h3>

            <form method="post" action="<?php echo base_url('home/ticketgen');?>">
            <div class="col-md-12">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9 bhoechie-tab-container">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                              <div class="list-group">
                                <p  class="list-group-item  text-center" style="border-radius:0px; background:#dff0d8;">
                                 <button value="print" formtarget="_blank"  name="print" type="submit" class="btnbg"> 
                                     <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print Ticket
                                 </button>
                                <p/>

                                <p class="list-group-item  text-center" style="background:#d9edf7;">
                                  <button type="submit"  name="pdf" value="download"  class="btnbg"> 
                                    <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Generate PDF
                                  </button>
                                </p>
								
								<p class="list-group-item  text-center" style="margin-top:10px; border-radius:0px; background:#fcf8e3;">
                                  <button type="submit" formtarget="_blank"  name="serve" value="mail" class="btnbg"> 
                                    <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; Send in Email
                                  </button>
                                </p>
                                
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <!-- flight section -->
							<div class="active" id="printarea">

							  <section class="invoice" >
									
									 <div  class="invoice-info">
									  <div class="col-sm-12 invoice-col" align="center">
										<?php foreach($allcom as $comp){
										foreach($allcomittee as $comittee){
										  if($comp['comittee_id']==$comittee['id']){
										?>
										<table width="100%" style="table-border:0px;" class="toptable">
										  <tbody>
											<tr style="height:30px;">
											  <td rowspan="2"><big><b>Ticket Id #</b><?php echo $ticketid;?> (PNR)</big></td>
											  <td><p style="text-align:center; font-size:20px;"><?php echo $comittee['name'];?></p></td>
											  <td rowspan="2" style="text-align:right;"><b>Booking Date:</b> <?php echo date('d M Y');?></td>
											</tr>
											<tr>
											  <td><p style="text-align:center;">Central Office : <?php echo $comittee['address'];?> , Phone  : <?php echo $comittee['contact'];?></p></td>
											</tr>
										  </tbody>
										</table>
										 <?php }} } ?>
									</div>
									<br>
									<br>
									<!-- Table row -->
									<div class="row">
									  <div class="col-xs-12 table-responsive">
										<div class="col-sm-12 invoice-col">
										  </div>
										  <table class="table table-bordered">
										  <thead>
										   <?php 
											  foreach($scheadual as $buschedule){
											?>
										<tr>
										   <td style="width:260px;height:auto;">
											<?php foreach($busdetail as $busmatch){?>
											<strong>Bus Name: </strong> <?php echo $busname;?> <br>
											<strong>Shift: </strong> <?php echo $buschedule['shift']; ?><br>
											<strong>Bus Type : </strong> <?php foreach($buscatagory as $cata){foreach($busdetail as $buscata){if($buscata['bus_category']==$cata['id']){echo $cata['title']; }}} ?><br>
											<?php 
											  }
											?>
										  </td>
			  
											
											<td colspan="2" style="width:260px;height:auto;">
											   <div class="col-sm-12 invoice-col">
											  
												<address>
												<strong><?php foreach($from as $f){if($f['id']==$buschedule['from']){echo $f['from'];}} ?></strong><br>
												Departing : <?php echo nice_date($buschedule['departure'],'M d, D')." ".$buschedule['departuretime'] ; ?><br>
												Boarding point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['boarding']){echo $route['from'];}}}?> (<?php echo $btimes;?>)
											  </address>
											   <small>DEPARTURE</small>
											  </div>

											</td>
											<td colspan="2" style="width:260px;height:auto;">
											  <div class="col-sm-12 invoice-col">
											   
												<address>
												  <strong><?php foreach($to as $f){if($f['id']==$buschedule['to']){echo $f['from'];}} ?></strong><br>
												  Arrival : <?php echo nice_date($buschedule['arrival'],'M d, D')." ".$buschedule['arrivaltime'] ; ?> <br>
												  Droppping Point : <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['dropping']){echo $route['from'];}}}?>  (<?php echo $dtimes;?>)
												</address>
												 <small>ARRIVAL</small>
											  </div>
											</td>

										  </tr>
											<?php } ?>
										  <tr>
											<th>Passenger Name </th>
											<th>Passenger phone </th>
											<th>No of Passenger </th>
											<th>Rate</th>
											<th>Discount (%)</th>
										  </tr>
										  </thead>
										  <tbody>
											<?php foreach($passenger_info as $pinfo){ ?>
											  <tr>
												<td><?php echo $pinfo['name'];?></td>
												<td><?php  echo $pinfo['contact'];?></td>
												<td><?php echo count($stotalpassenger);?></td>
												<td>Rs <?php echo $pinfo['rate'];;?>/-</td>
												<td><?php echo $pinfo['tdiscount']/$pinfo['rate']*100;?></td>
											  </tr>
											<?php 
											$total = count($stotalpassenger) *$pinfo['rate'];
											  }
											  ?>
											</tr>
											  <tr>
											  <td colspan="5"><b>Seats:</b> <?php echo $seats;?></td>
										  </tr>
										  <tr>
											<th colspan="4">Total</th>
											<th>Rs <?php echo $total;?>/-</th>
										  </tr>
										  
										  <tr>
										<td colspan="5">Contact for  <?php echo $busname ." "; foreach($busdetail as $bdtl){ echo $bdtl['driver_mobile_no']."<small> (Driver) </small>,".$bdtl['driver_mobile_no']."<small> (Owner) </small>";};?> </td>
										</tr>
										<tr style="border:none;">
											<td colspan="3" style="border:none; line-height:16px">
												 <small style="font-size:10px;"> * 1,00,000 traveller insurance is secured </small><br>
												 <small style="font-size:10px;"> * Cancellation policy is applied 25% of total amount (If cancelled before 4 hour from departure)  </small><br>
												 <small style="font-size:10px;"> * All terms and condition are applied of databankbooking.com </small><br>
											</td>
											<td colspan="2" style="border:none;">
												<p align="right">
												<img height="40px" style="width:50%;" src="<?php echo base_url(STATIC_IMG_DIR."logo.png");?>"><br>
												<small style="font-size:10px;">Phone : 014102838 <br> Email : support@databankbooking.com</small>
												</p>
											</td>
										</tr>


										  </tbody>
										</table>
									  </div>
									  <!-- /.col -->
									</div>
									<!-- /.row -->
										  <input type="hidden" name="seats" value="<?php echo $seats;?>">
										<input type="hidden" name="scheduleid" value="<?php echo $scheduleid ;?>">
										<input type="hidden" name="ticketid" value="<?php echo $ticketid ;?>">
										<input type="hidden" name="btimes" value="<?php echo $btimes ;?>">
										<input type="hidden" name="dtimes" value="<?php echo $dtimes ;?>">
									<!-- this row will not appear when printing -->
									
								  <br>
								  </section>

							</div>                               
						</div>
	
                  </div>
            </div>
           </form>

        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
     </div>
    </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>