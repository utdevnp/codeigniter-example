
        <?php 
		
									$where = array('sid'=>$sid);
									$tmpseats = $this->site_model->returnfield('temp_sheet',$where,'seats');
									$tmptot = count($tmpseats);
									if($tmptot > 0){
									$tmpres  = implode(',', @$tmpseats);
									$expres = explode(',', @$tmpres);
									@$reservetot = count($expres);
									
									}					
		
		
		
          $res = explode('/', $reserve);

              $student  = explode(',', $res[0]);
              $female   = explode(',', $res[1]);
              $old      = explode(',', $res[2]);
              $staff    = explode(',', $res[3]);

          // print_r($rev);
          //Booked seats disable 
          foreach($info_id as $booked_info){
            $info_id = $booked_info['id'];
           $booked_seats = $this->dynamic_query->getby($info_id,'passengers_detail','info_id');
           foreach($booked_seats as $seats){
             $bookedseat[] = $seats['seat'];
           }
          }
           $all = count($bookedseat);
          
           // count seat row  in B side
             $totalrowb     = round($bside/2);
             $totalrowa     = round($aside/2);
             $tot_cabin     = round($cabin/2);
             $total_special = round($special);


          //for($m=0;$m<$all;$m++){ $myside = str_split($bookedseat[$m],1); if($myside[0]=="A"){  echo  $myside[0];  $bside = $myside[1]; }}
        ?>
          <form method="POST"  id="protectForm" action="<?php echo base_url('control/counter_booking/continuebooking');?>">
          
              <div class="row">
                 <div class="form-group col-md-2">   
                    <div class="selectseatinfo"> 
                      <img src="<?php echo STATIC_IMG_DIR."seatinformation.jpg";?>" class="img-responsive"/>
                    </div>
                </div>
                <?php if($bustyp=="bus"){
					//@$reservetot = count($expres);

               include('seats/busses.php');
                ?>
        
              <!-- HIce's Seats  -->
              <?php } else if($bustyp=="hice"){
				  //@$reservetot = count($expres);
                $allseats  =  explode(',', $hic);
                include('seats/hices.php');
                ?>
                
              <?php } else if($bustyp=="sumo"){
				  //@$reservetot = count($expres);
                  include('seats/sumo.php');
                ?>

              <?php } else if($bustyp =="force"){
				  //@$reservetot = count($expres);
               $forceseats  =  explode(',', $forc);
               $rowa     = round($forceseats[1]/2);
               $rowb     = round($forceseats[2]/2);
               include('seats/force.php');
               } ?>
            <div class="col-md-3">
            <input type="hidden" name="ticket_date" value="<?php echo $departuredate;?>">
            <input type="hidden" name="buscompany" value="<?php echo $buscompany;?>">
            <div class="seatdetails">
              <p><strong>Seats</strong></p>
               <div class="messages"></div>
              
             <div class="seatinfo<?php echo $everybus;?> seatinfo"></div>
              <div class="clearfix"></div>
              <small style="color:red;">(Only six seats will be provided for each ticket)</small>
              <br>
             <p><strong>Amount</strong></p>
             <big class="text-danger"> <strong>Rs <span id="pricebox<?php echo $everybus;?>"></span> /-</strong></big>
              <div class="clearfix"></div>

              <button type="submit" name="submit" value="myseats" class="btn btn-primary btn-sm btn-flat disconnects col-md-12"><big class="pull-left">Continue Booking</big> &nbsp; <i style="font-size:20;line-height: 20px;" class="fa fa-arrow-right pull-right"></i> </button>      
            </div>
          </div>
          </form>

      
