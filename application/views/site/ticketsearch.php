<?php $this->load->view('site/headerlinks'); ?>
<!-- Modal -->
<div id="searchticketbox" class="modal fade" data-keyboard="false" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="font-size: 36px;">&times;</span></button>
        <h4 class="modal-title"><?php echo  $ticket_ttile;?> </h4>
      </div>
      <div class="modal-body">

            <form method="post" action="<?php echo base_url('home/ticketgen');?>">
            <div class="col-md-12">
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9 bhoechie-tab-container">
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9">
                                <!-- flight section -->
                                <div class="active" id="printarea">

                                  <section class="invoice" >
                                          <div class="col-md-12 page-header nopadding">
                                            <div class="col-md-6">
                                              <h5>eBus-Ticket  #D01<?php echo $ticketid;?> (PNR) </h5>
                                           </div>
                                            <div class="col-md-6">
                                               <h5 class="pull-right">Reserved Date: <?php echo date('d M Y');?></h5>
                                            </div>
                                            </div>
                                        
                                         <div  class="invoice-info">
                                          <div class="col-sm-12 invoice-col" align="center">
                                            <?php foreach($allcom as $comp){
                                            foreach($allcomittee as $comittee){
                                              if($comp['comittee_id']==$comittee['id']){
                                            ?>
                                             <big style="font-size: 20px;"><?php echo $comittee['name'];?></big><br>
                                             <p>Central Office : <?php echo $comittee['address'];?></p> 
                                             <p>Phone  : <?php echo $comittee['contact'];?></p>
                                             <?php }} } ?>
                                        </div>
                                        <br>
                                        <br>
                                        <!-- Table row -->
                                        <div class="row">
                                          <div class="col-xs-12 table-responsive">
                                            <div class="col-sm-12 invoice-col">
                                              </div><table class="table table-bordered">
                                              <thead>
                                               <?php 
                                                  foreach($scheadual as $buschedule){
                                                ?>
                                                <tr>
                                                  <?php foreach($busdetail as $busmatch){?>
                                                    <td colspan="3"><big><?php echo $busname;?> </big></td>
                                                    <!--td>Bus No. <strong><?php //if($buschedule['bus_no']==$busmatch['id']){  echo $busmatch['bus_no'];} ?></strong></td-->
                                                    <td><strong>Shift: <?php echo $buschedule['shift']; ?></strong></td>
                                                    <td><strong>Bus Type : <?php foreach($buscatagory as $cata){foreach($busdetail as $buscata){if($buscata['bus_category']==$cata['id']){echo $cata['title']; }}} ?></strong></td>
                                                    <?php 
                                                      }
                                                    ?>
                                                                
                                                </tr>


                                              <tr>
                                                
                                                <td colspan="3">
                                                   <div class="col-sm-12 invoice-col">
                                                  
                                                    <address>
                                                    <strong><?php foreach($from as $f){if($f['id']==$buschedule['from']){echo $f['from'];}} ?></strong><br>
                                                    Departing : <?php echo nice_date($buschedule['departure'],'M d, D')." ".$buschedule['departuretime'] ; ?><br>
                                                    Pick up : <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['boarding']){echo $route['from'];}}}?> (<?php echo $btimes;?>)
                                                  </address>
                                                   <small>DEPARTURE</small>
                                                  </div>

                                                </td>
                                                <td colspan="3">
                                                  <div class="col-sm-12 invoice-col">
                                                   
                                                    <address>
                                                      <strong><?php foreach($to as $f){if($f['id']==$buschedule['to']){echo $f['from'];}} ?></strong><br>
                                                      Arrival : <?php echo nice_date($buschedule['arrival'],'M d, D')." ".$buschedule['arrivaltime'] ; ?> <br>
                                                      Drop : <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['dropping']){echo $route['from'];}}}?>  (<?php echo $dtimes;?>)
                                                    </address>
                                                     <small>ARRIVAL</small>
                                                  </div>
                                                </td>

                                              </tr>
                                                <?php } ?>
                                              <tr>
                                                <th>#</th>
                                                <th>Traveler(s) Name </th>
                                                <th>Traveler(s) Address </th>
                                                <th>Traveler(s) Num </th>
                                                <th>Rate</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                <?php foreach($passenger_info as $pinfo){ ?>
                                                  <tr>
                                                    <td>1</td>
                                                    <td><?php echo $pinfo['name'];?></td>
                                                    <td><?php foreach($allroutes as $route){if($pinfo['boarding']==$route['id']){echo $route['from'];}} ;?></td>
                                                    <td><?php echo count($stotalpassenger);?></td>
                                                    <td>Rs <?php echo $pinfo['rate'];;?>/-</td>
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
                                              </tbody>
                                            </table>
                                            <small> * 1,00,000 traveller insurence is secured </small><br>
                                            <small> * Cancalation policy is applied 25% of total amount (If cancaled before 4 hour from departure)  </small><br>
                                            <small> * All trems and condition are applied of bus.databanknepal.com </small><br>
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
                                        <div class="form-group col-md-4 pull-right">
                                        <button formtarget="_blank" value="print"  name="print" type="submit" class="btn btn-primary btn-sm"> 
                                           <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print Ticket
                                        </button>
                                        <button  type="submit" name="pdf" value="download" class="btn btn-default btn-sm"> 
                                          <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Generate PDF
                                       </button>
                                      </div>
                                      <br>
                                      </section>

                                </div>                               
                            </div>
                        </div>
                  </div>  

            </div>
           </form>

           </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        
        <?php $this->load->view('site/footerlinks'); ?>