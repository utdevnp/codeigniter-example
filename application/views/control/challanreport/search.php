<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 0px;">
    <!-- Content Header (Page header) -->
   <section class="content-header mainheadig">
      <h1>
        <?php echo $primaryheader;?>
        <small>0</small>
      </h1>
      
    </section>
    <div class="col-md-12">
    <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="#"><?php echo $primaryheader;?></li>
        <li class="active"><?php echo $title;?></li>
        <?php if(in_array($this->uri->segment(2)."/add",$user_id)){;?>
        <a href="<?php echo ADMIN_BASE.$this->uri->segment(2)."/add"; ?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
        <?php } ?>
      </ol>
    </div>
     <section class="content">
      <div class="row">
      
        <div class="col-md-12">
         <?php $this->load->view('control/inc/validation');?>
          <div class="box">
            <div class="box-header with-border">
             <h3 class="box-title"><?php echo $title;?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
           
            <div class="box-body">
        <div class="tab-pane active" id="general">
      
         <form method="POST" action="<?php echo base_url('control/Challanreport/searchchalan');?>">
          <div class="box-body">
              <div class="row col-md-12">

                 <div class="form-group col-md-3">
                 
                  <select name="bus_no" class="form-control select2">
                    <option value="">From </option>
                    <?php foreach($busno as $number){?>
                      <option <?php if($this->input->post('from')==$number['id']){echo "selected";} ;?> value="<?php echo $number['id'];?>"><?php echo $number['bus_no'];?></option>
                    <?php } ?>
                  </select>
                </div>
                

                <div class="form-group col-md-3">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="date_for" value="<?php echo date('Y-m-d');?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>

                <div class="form-group col-md-3">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-search"></i> Search Challan</button>
                  </div>

              </div>  
              <div class="clearfix"></div>

              <hr>
        </div>
        </form>
      </div>
       <?php $this->load->view('control/inc/message');?>
  </div>
  <?php if($mached !==""){?>
  	<div class="box-body">

    <?php foreach($sche as $ch){
      $bus_no  =  $ch['bus_no'];
      $depa   =  $ch['departure'];
      $from   = $ch['from'];
      $to     = $ch['to'];
      $deptime= $ch['departuretime'];
      $dep    =  $ch['departure'];



      }
       if(count($comp) > 0){
      foreach($comp as $charge){
       $cch = explode('/',  $charge['ccharge']);             
      }}
      ?>
      <form method="POST" action="<?php echo base_url('control/Challanreport/printchalan');?>">
        <input type="hidden" name="bus_no" value="<?php echo $postedbus; ?>">
        <input type="hidden" name="date_for" value="<?php echo $posteddate;?>">
      <div class="clearfix"></div>
    <div id="printarea" class="col-xs-12">
  		<div class="col-xs-4">
  		</div>
      <?php foreach($com as $c){?>
  		<div class="col-xs-4 challanheader" align="center">
  			<h3 class="text-center"><?php echo $c['name'];?> </h3><br>
  			<strong class="text-center">ADDRESS :<?php echo $c['address'];?></strong><br>
  			<strong class="text-center">PHONE No :<?php echo $c['contact'];?></strong><br>
  			<h3 class="text-center">चलान</h3><br>
  			<strong class="text-center"><?php foreach($busrot as $rot){if($rot['id']==$from){ echo  "From :  " .  $rot['from'];}}?>   <?php foreach($busrot as $rot){if($rot['id']==$to){ echo "To :  ".  $rot['from'];}}?></strong>
  		</div>
      <?php } ?>
     
        <div class="col-xs-4">
        <strong class="pull-right">DATE : <?php echo $dep;?> </strong><br>
        <strong class="pull-right">Bus NO : <?php foreach($busno as $bus){  if($bus_no == $bus['id']){ echo $bus['bus_no'];}}?> </strong><br>
        <strong class="pull-right">Departure Time: <?php echo $deptime;?></strong>
      </div>
       <?php foreach($busno as $bus){ ?>
        <?php  if($bus_no == $bus['id']){
       ?>
  		
  		<div class="clearfix"></div>
       <div class="col-md-12">
        <div class="col-md-4"><b>Driver Name  :   <?php  echo $bus['driver_name'];?></b></div>
        <div class="col-md-4"><b>Mobile No  :  <?php echo $bus['mobile_no'];?></b></div>
        <div class="col-md-4"><b>Bus Type : <?php foreach($allcat as $cat){ if($bus['bus_category']==$cat['id']){ echo $cat['title'];}}?></b></div>
      </div>
       <?php }} ?>
      <div class="clearfix"></div>

      <?php // $ticket;


       ?>
		<table class="table table-bordered">
			<tr>
				<th>S.N</th>
				<th>Ticket No</th>
        <th>Contact No</th>
				<th>Passenger Name</th>
				
        <th>Num</th>
        <th>Seat(s)</th>
				<th>Amount(s)</th>
        <th>Due</th>
        <th>Remarks</th>
			</tr>
      <?php
      $no = 1;
      $total = 0;
       foreach($ticket as $ticinfo) { 
        if($sid==$ticinfo['id']){

        }
       $infoid  = $ticinfo['id'];
     
       ?>

      <tr>
        <td><?php   echo $no++; ?></td>
        <td><?php   echo  $ticinfo['ticketid'];?></td>
        <td><?php  echo  $ticinfo['contact'];?></td>
        <td><?php   echo  $ticinfo['name'];?></td>
        <td><?php  $all =   $this->db->get_where('passengers_detail',array('info_id'=>$infoid)); $dat = $all->result_array();  echo count($dat); ?></td>
        <td><?php  foreach($passenger as $det) { if($infoid==$det['info_id']) { echo  $det['seat'].","; } }?></td>
        <td><?php echo  $ticinfo['total'];?></td>
        <td><?php ?></td>
        <td></td>
      </tr>
      <?php 
          $total = $ticinfo['total']+$total;
       } ?>
      <tr>
        <th colspan="6">Total (Rs:)</th>
        <td colspan="3"><?php echo $total;?> <input type="hidden" name="total" value="<?php echo $total;?>"   class="form-control"> </td>
        
      </tr>
      <tr>
        <th colspan="6">Office Expanses (Rs:)</th>
        <td colspan="3"> <?php  $office =  $total*$cch[2]/100; if($total!==0 AND $cch[2] !==0){ echo  $office ; }  else echo 0; ?><input type="hidden"   name="officeexp" value="<?php echo $office;?>"></td>
      </tr>
      <tr>
        <th colspan="6">Miscellaneous Expences (Rs:)</th>
        <td colspan="3"><?php $miscell =  $total * $cch[0]/100; if($total!==0 AND $cch[0] !==0){ echo $miscell; }  else echo 0; ?><input type="hidden" name="miscellaneous" value="<?php echo $miscell; ?>"></td>
      </tr>
       <tr>
        <th colspan="6">Trip Fee (Rs:) </th>
        <td colspan="3"> <?php if($cch[1] !==0){ echo $trip = $cch[1]; }  else echo 0;?><input type="hidden" name="trip" value="<?php echo $trip;?>" ></td>
      </tr>
      <tr>
      <th colspan="6">Total Net Amount (Rs:)</th>
        <td colspan="3"  ><?php $exp = $office + $miscell + $trip;  $nettot = $total - $exp; if($total!==0){ echo $nettot; }  else echo 0; ?><input type="hidden" name="netamo" value="<?php echo $nettot;?>"   class="form-control"></td>
      </tr>

      <!-- <tr>
        <th colspan="6">Total (Rs:)</th>
        <td ng-model="total" ng-init="total=<?php// echo $total;?>" value="<?php ?>" colspan="3"><?php //echo $total;?> <input type="hidden" name="total" value="<?php //echo $total;?>"   class="form-control"></td>
        
      </tr>
      <tr>
        <th colspan="6">Office Expanses (Rs:)</th>
        <td colspan="3"> <?php //echo  $office =  $total*$cch[2]/100; ?>
            <input type="text"  style="border: 0px" ng-maxlength="10" placeholder="Rs:" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" ng-init="e=0" ng-model="e" name="officeexp" value="0"   class="form-control"></td>
      </tr>
      <tr>
        <th colspan="6">Miscellaneous Expences (Rs:)</th>
        <td colspan="3"><?php// echo $miscell =  $total * $cch[0]/100; ?><input style="border: 0px" type="text"  ng-maxlength="10" placeholder="Rs:" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" ng-init="f=0" ng-model="f" name="miscellaneous" value="0"   class="form-control"></td>
      </tr>
       <tr>
        <th colspan="6">Trip Fee (Rs:) </th>
        <td colspan="3"> <?php //echo $trip =  $total * $cch[1]/100; ?><input type="text"  style="border: 0px" placeholder="Rs:" ng-maxlength="10" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" ng-init="g=0" ng-model="g" name="trip" value="0"   class="form-control"></td>
      </tr>
      <tr>
      <th colspan="6">Total Net Amount (Rs:)</th>
        <td colspan="3"  ><?php// $exp = $office + $miscell + $trip; echo $total - $exp; ?>
         {{ (total - e - f -  g ) }}
         <input type="hidden" name="netamo" value="{{ (total - e - f -  g ) }}"   class="form-control">
        </td>
      </tr> -->
			
		</table>

  	</div>

     <button  type="submit" name="submit" value="print" formtarget="_blank" class="btn btn-warning btn-sm btn-flat pull-right"><i class="fa fa-print"></i> print</button> 
   <!--  <a href="<?php //echo base_url('control/Challanreport/mychalan');?>"> <button  style="margin-right:5px;"  formtarget="_blank" class="btn btn-success btn-sm btn-flat pull-right"><i class="fa fa-pdf"></i> PDF</button></a> -->
     <button style="margin-right:5px;"  type="submit"  name="submitexcel" value="excel"  formtarget="_blank"   class="btn btn-success btn-sm btn-flat pull-right"><i class="fa fa-excel"></i> Export to excel</button>
      </form>
          <!-- /.box -->
      </div>
      <?php } ?>
    </div>
        <!-- /.col -->   
      </div>
      <!-- /.row -->
     
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('inc/adminfooter');?>
  <?php $this->load->view('inc/admincontrolsidebar');?>
</div>
<!-- ./wrapper -->
</body>
<?php $this->load->view('inc/footer');?>