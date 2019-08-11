 <?php $total = count($bussche);
    if($total == 0){ ?>
   
     <div class="alert notice notice-danger centered-text  col-md-12">
    <button href="#" type="button" class="close"> <i data-dismiss="alert" class="fa fa-times"></i> </button> 
        <strong>Not Found !!  </strong> 
         Result not found !!   
    </div>
    

    <?php }else{  
      ?>
       
       <?php 
        $companyid  = $this->static_model->companyidbyusername($this->session->userdata('eBusLogin'));
     // GLOBAL $allseats;
          $sn = 1;
          foreach($bussche as $data){ 
          $depaeturedate  =   $data['departure']; 
          $sid            =   $data['id'];
          $com           =    $data['company'];
		  
									
          if($companyid==$com){
         ?>
         <div class="box">
            <div class="box-header with-border searchedbus">
             <h3 class="box-title">
                <?php foreach($busname as $bus){?><?php if($data['bus_no']==$bus['id']){echo strtoupper($bus['bus_name']);}?> <?php } ?>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body with-border searchedbus">
        
            <div class="col-md-2">
              <p><big><?php foreach($busno as $bus){?><?php if($data['bus_no']==$bus['id']){echo strtoupper($bus['bus_no']);}?> <?php } ?></big></p>
               <small><?php //echo strtoupper('A/C');?></small>
            </div>

            <div class="col-md-3">
              <p><?php foreach($busrot as $rot){?><?php if($data['from']==$rot['id']){echo $rot['from'];}?> <?php } ?> &rightarrow;  <?php foreach($busrot as $rot){?>   <?php if($data['to']==$rot['id']){echo $rot['from'];}?> <?php } ?></p>
            </div>
            <div class="col-md-2">
              <p><?php $mydate = strtotime($data['departure']);
                echo date('M jS Y', $mydate); echo " &nbsp ";
                echo $data['departuretime'];?> </p>
              <small><?php echo strtoupper("Departure");?></small>
            </div>
            <div class="col-md-2">
              <p><?php  $mydate = strtotime($data['arrival']);
                echo date('M jS Y', $mydate);
                echo " &nbsp "; echo $data['arrivaltime'];?> </p>
              <small><?php echo strtoupper("Arrival");?></small>
            </div>
            <div class="col-md-3">
              <div class="col-md-4">
                <big> <?php echo "Rs"; echo "&nbsp"; echo $data['fare'];?></big>
              </div>
              <div class="col-md-6 pull-right">
                <a href="#view-sheets-<?php echo $data['id'];?>"  data-toggle="collapse"><button  class="btn btn-success btn-sm btn-flat"><i class="fa fa-search"></i> View Sheet</button></a>
              </div>
            </div>
            </div>
          <div style="border:5px solid #fff;"></div>
         <div  id="view-sheets-<?php echo $data['id'];?>" class="collapse">  
             <?php 
             foreach($counter as $resrved){
              $busdata['reserve']   =   $resrved['reservation'];
             }
             
            $seats_info     =   $this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
            $busdata['info_id'] =  $seats_info;
            
             foreach($busno as $seats){
              if($data['bus_no']        ==  $seats['id']){
               $busdata['aside']        =   $seats['total_sheet_in_a_side'];
                $busdata['bside']       =   $seats['total_sheet_in_b_side'];
                $busdata['last']        =   $seats['last_row'];
                $busdata['cabin']       =   $seats['cabin'];
                $busdata['special']     =   $seats['special'];
                $busdata['hic']         =   $seats['hices'];
                $busdata['forc']        =   $seats['forces'];
                $busdata['bustyp']      =   $seats['type'];
              } 
             }

              
             $busdata['everybus']       =   $data['id'];
             $busdata['price']          =   $data['netfare'];
             $busdata['buscompany']     =   $data['company'];
             $busdata['departuredate']  =   $depaeturedate;
             $busdata['bookedseat']     =   "";
			 $busdata['sid']     =   $sid;
			 //$busdata['expres']     =   @$expres;
             $this->load->view('control/counter-booking/mysheets',$busdata);
             ?>
            </div>
         </div>
          <div class="clearfix"></div>

          <!-- <div class="clearfix"></div> -->
          <?php  }   
      }
    
    ?>

    <!-- /.content -->
    <?php } ?>
 