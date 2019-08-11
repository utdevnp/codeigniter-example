<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li  class="active"><a href="#general" data-toggle="tab">General</a></li>
      <li><a href="#advance-search" data-toggle="tab">Advance seaech</a></li>
       <li><a href="#ticket-search" data-toggle="tab">Ticket seaech</a></li>
    </ul>
    <div class="tab-content">

    
      <div class="tab-pane active" id="general">
      
         <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/counter_booking/searched_bus');?>">
          <div class="box-body">
              <div class="row col-md-12">

                 <div class="form-group col-md-3">
                 
                  <select name="from" class="form-control select2">
                    <option value="">From </option>
                    <?php foreach($busrot as $rot){?>
                      <option <?php if($this->input->post('from')==$rot['id']){echo "selected";} ;?> value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  
                  <select name="to" class="form-control select2">
                    <option value="">To</option>
                    <?php foreach($busrot as $rot){?>
                      <option <?php if($this->input->post('to')==$rot['id']){echo "selected";} ;?> value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>
                  </select>
                </div>
                

                <div class="form-group col-md-3">
                  
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="ticket_for" value="<?php echo date('Y-m-d');?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>

                <div class="form-group col-md-3">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Search Bus</button>
                    <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</button>
                  </div>

              </div>  

        </div>
        </form>
      </div>
      
      <!-- /.tab-pane -->

      <!-- /.tab-pane -->
   <div class="clearfix"></div>
     
     <div class="tab-pane <?php //if($this->input->post('bus_no')==$bus['bus_no']){//echo "active";}?>" id="advance-search">
     <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/counter_booking/Searched_bus');?>">
          
           <div class="box-body">

            <div class="row">

                 <div class="form-group col-md-3">
                 
                  <select name="from" class="form-control select2" style="width: 100%;">
                    <option value="">From </option>
                    <?php foreach($busrot as $rot){?>
                      <option <?php if($this->input->post('from')==$rot['id']){echo "selected";} ;?> value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>
                  </select>
                </div>
                
                <div class="form-group col-md-3">
                  
                  <select name="to" class="form-control select2" style="width: 100%;">
                    <option value="">To</option>
                   
                      <option value="">From </option>
                    <?php foreach($busrot as $rot){?>
                      <option <?php if($this->input->post('to')==$rot['id']){echo "selected";} ;?> value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>
                   
                  </select>
                </div>
                

                <div class="form-group col-md-3">
                  
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="ticket_for" value="<?php echo date('Y-m-d');?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>

                <div class="form-group col-md-3">
                  <select name="bus_no" class="form-control select2" style="width: 100%;">
                    <option value="0">Bus No</option>
                    <?php foreach($busno as $bus){?>
                      <option <?php if($this->input->post('from')==$bus['bus_no']){echo "selected";}?> value="<?php echo $bus['id'];?>"><?php echo $bus['bus_no'];?></option>
                    <?php } ?>
                  </select>
                </div>


                <div class="form-group col-md-3">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-search"></i> Search Bus</button>
                    <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</button>
                  </div>

              </div>  
             </div>

         </form>
       
        </div>


        <div class="clearfix"></div>

        <div class="tab-pane" id="ticket-search">
         <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/counter_booking/ticketsearch');?>">
          <div class="box-body">
              <div class="row col-md-12">
                 <div class="col-md-7">
                 <div class="col-md-5"> <label class="pull-right">Enter Your Ticket Id </label></div>
                 
                    <div class="input-group m-t-10 col-md-7">
                        <input type="text" id="ticket" name="ticketno" class="form-control" placeholder="123456789" required="required">
                        <span class="input-group-btn">
                        <button type="submit" name="submit-ticket" value="submit-ticket" class="btn btn-effect-ripple btn-primary btn-flat"><i class="fa fa-search"> </i> Search </button>
                        </span>
                    </div>
                </div>  

              </div>  

        </div>
        </form>
      </div>
    </div>
    <!-- /.tab-content -->

</div>