<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?> </h3>
            
            <div class="col-md-12">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bhoechie-tab-menu">
                              <div class="list-group">
                                <a href="#" class="list-group-item active text-center">
                                  <i class="fa fa-credit-card-alt" aria-hidden="true"></i> &nbsp; Pay With eSewa
                                </a>

                                <a href="#" class="list-group-item  text-center">
                                  <i class="fa fa-credit-card-alt" aria-hidden="true"></i>Bus
                                </a>
                                
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 bhoechie-tab">
                                <!-- flight section -->
                                <div class="bhoechie-tab-content active">
                                    <section class="invoice pull-right">
      <!-- title row -->            <?php foreach($pdetail as $det){ 
                                        $pid   =   $det['id'];
                                       $tdis  =   $det['tdiscount'];
                                       $tamo  =   $det['total'];
                                       $rate  =   $det['rate'];
                                       $boarding  =   $det['boarding'];
                                       $dropping  =   $det['dropping'];
                                       $ticketid = $det['ticketid'];  
                                       $sid = $det['sid'];  
                                    }?>
                                   
                                       <?php foreach($scheadual as $detail){?>
                                      <div class="">
                                     
                                        <div class="col-sm-4 invoice-col">
                                          <strong>From</strong>
										  
                                          <address>
                                            <?php 
                                             $fro =  $from[0]['id'];
                                             foreach($from as $f){ echo strtoupper($f['from']);}?><br>
                                             <?php echo nice_date($detail['departure'],'M d,D'); $date =   $detail['departure']; echo "&nbsp; ". $detail['departuretime']?><br>
                                             <?php foreach($allroutes as $rot){;?> 
                                             <?php if($rot['id']==$boarding){echo $rot['from'];}?> 
                                             <?php } ?>
                                             (<?php echo $btimes;?>)<br><small>DEPARTURE</small>

                                            
                                          
                                          </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                          <strong>To</strong>
                                          <address>

                                        
                                            <?php 
                                         
                                           $tor = $to[0]['id'];
                                            foreach($to as $t){ echo  strtoupper($t['from']); $to = $t['from'];}?></strong><br>
                                             <?php echo nice_date($detail['arrival'],'M d,D'); echo "&nbsp; ". $detail['arrivaltime']?><br>
                                            <?php foreach($allroutes as $rot){;?> 
                                             <?php if($rot['id']==$dropping){echo $rot['from'];}?>  
                                             <?php } ?>
                                             (<?php echo $dtimes;?>)
                                            <br><small>ARRIVAL</small>
                                                                           
                                          </address>
                                        </div>
                                        <!-- /.col -->
                                       <div class="col-sm-4 invoice-col">
                                          <strong>Bus Detail</strong><br>
                                          <?php foreach($allcom as $comp)
                                              { 
                                                foreach($busnames as $busn)
                                                {
                                                  if($busn['id']==$busdetail){echo $busn['bus_name'] ."<br>";}
                                                }
                                             foreach($category as $cats){ echo "Bus Category : " .$cats['title']."<br>";}
                                            }
                                            ?>
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
                                                 $sn = 1;
                                                 foreach($passengers as $p){ ?>
                                                <tr>
                                                  <td><?php echo $sn++;?></td>
                                                  <td><?php echo $p['name'];?></td>
                                                  <td><?php echo $p['seat'];?><input type="hidden" name="seats[]" value="<?php echo $p['seat'];?>"></td>
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
									     <input value="<?php echo $tamo;?>" name="tAmt" type="hidden">
										 <input value="<?php echo $tamo;?>" name="amt" type="hidden">
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
                                                <td><?php echo "Rs: ".$grosstotal."/-";?></td>
                                              </tr>
                                              
                                              <tr>
                                                <th>Discount(<?php echo ($tdis *100)/$grosstotal."%";?>):</th>
                                                <td><?php echo "Rs: ".$tdis."/-";?></td>
                                              </tr>
                                              <tr>
                                                <th>Rate:</th>
                                                <td><?php echo "Rs: ".$rate."/-";?></td>
                                              </tr>
                                              <tr>
                                                <th>Total:</th>
                                                <td><?php echo "Rs: ".$tamo."/-";?></td>
                                              </tr>
                                            </tbody></table>
                                          </div>
                                         
                                        </div>
                                      </div>
                                      <?php
                                        $url =base_url('home/cancalbooking/'.$infoid."/").$fro."/".$tor."/".$date;
                                      ?>
                                      <div class="row no-print">
                                        <div class="form-group col-md-6 pull-right">
                                          <button type="submit"  class="btn btn-primary btn-sm btn-flat pull-right" "=""><i class="fa fa-credit-card"></i> Pay With eSewa</button>
                                          <a href="<?php echo $url;?>" class="btn btn-danger btn-sm btn-flat pull-right" style="margin-right:5px;"><i class="fa fa-times"></i> Cancel Payment</a>
                                        </div>
                                      </div>
                                    </form>
                                    </section>
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