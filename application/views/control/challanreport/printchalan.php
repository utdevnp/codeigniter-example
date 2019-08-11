<html >

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chalan Report </title>

<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
<!-- Bootstrap 3.3.6 -->

</head>
<body onload="window.print()">

<div class="box-body">

    <?php foreach($sche as $ch){
      $bus_no  =  $ch['bus_no'];
      $depa   =  $ch['departure'];
      $from   = $ch['from'];
      $to     = $ch['to'];
      $deptime= $ch['departuretime'];
      $dep    =  $ch['departure'];


      }
      ?>

     <table width="100%">
    <div id="printarea"  class="col-xs-12">
      <div class="col-xs-12">
      </div>
      
      
      <?php foreach($com as $c){?>
      <tr>
        
        <td colspan="2" class="text-right"></td>
          <td colspan="4" class="text-center">
            <h3><?php echo $c['name'];?> </h3><br>
            <strong>ADDRESS :<?php echo $c['address'];?></strong><br>
            <strong>PHONE No :<?php echo $c['contact'];?></strong><br>
            <h3>Chalan </h3><br>
            <strong><?php foreach($busrot as $rot){if($rot['id']==$from){ echo  "From :  " .  $rot['from'];}}?>   <?php foreach($busrot as $rot){if($rot['id']==$to){ echo "To :  ".  $rot['from'];}}?></strong>
            </td>
            <br>
       
        <?php } ?>
          
          
          <td colspan="2" class="pull-right" style="margin-top: 20px;">
          <strong>DATE : <?php echo $dep;?> </strong><br>
          <strong>Bus NO : <?php foreach($busno as $bus){  if($bus_no == $bus['id']){ echo $bus['bus_no'];}}?> </strong><br>
          <strong>Departure Time: <?php echo $deptime;?></strong>
          </td>
         
        </tr>

      
       <?php foreach($busno as $bus){ ?>
        <?php  if($bus_no == $bus['id']){
       ?>
      
      <div class="clearfix"></div>
      <br>
          <tr style="padding: 5px;"> 
            <td colspan="2"> <b>Driver Name  :   <?php  echo $bus['driver_name'];?></b></td>
            <td colspan="3"><b>Mobile No  :  <?php echo $bus['mobile_no'];?></b></td>
            <td colspan="2"><b>Bus Type : <?php foreach($allcat as $cat){ if($bus['bus_category']==$cat['id']){ echo $cat['title'];}}?></b></td>
          </tr>
       
      </table>
     
       <?php }} ?>
       <br>
      <div class="clearfix"></div>

      
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
       
       $infoid  = $ticinfo['id'];
     
       ?>

      <tr>
        <td><?php   echo $no++; ?></td>
        <td><?php echo  $ticinfo['ticketid'];?></td>
         <td><?php echo  $ticinfo['contact'];?></td>
        <td><?php echo  $ticinfo['name'];?></td>
        <td><?php  $all =   $this->db->get_where('passengers_detail',array('info_id'=>$infoid)); $dat = $all->result_array();  echo count($dat); ?></td>
        <td><?php  foreach($passenger as $det) { if($infoid==$det['info_id']) { echo  $det['seat'].","; } }?></td>
        <td><?php echo  $ticinfo['total'];?></td>
        <td><?php ?></td>
        <td></td>
      </tr>
      <?php 

          if(count($company) > 0){
          foreach($company as $charge){
          $cch = explode('/',  $charge['ccharge']);             
          }}
          $total = $ticinfo['total']+$total;
       } ?>
       <tr>
        <th colspan="6">Total (Rs:)</th>
        <td colspan="3"><?php if($total!==0){ echo $total; }?> </td>
        
      </tr>
      <tr>
        <th colspan="6">Office Expanses (Rs:)</th>
        <td colspan="3"> <?php if($total!==0 AND @$cch[2] !==0){ echo  $office =  $total*$cch[2]/100; } else echo 0;?>
            </td>
      </tr>
      <tr>
        <th colspan="6">Miscellaneous Expences (Rs:)</th>
        <td colspan="3"><?php if($total!==0 AND @$cch[0] !==0){ echo $miscell =  $total * @$cch[0]/100; }  else echo 0; ?></td>
      </tr>
       <tr>
        <th colspan="6">Trip Fee (Rs:) </th>
        <td colspan="3"> <?php if(@$cch[1] !==0){ echo $trip =  @$cch[1]; }  else echo 0; ?></td>
      </tr>
      <tr>
      <th colspan="6">Total Net Amount (Rs:)</th>
        <td colspan="3"  ><?php if($total!==0){ $exp = $office + $miscell + $trip; echo $total - $exp; } else echo 0;  ?></td>
      </tr>
      
    </table>

    </div>
          <!-- /.box -->
      </div>
      <?php  ?>
    </div>
    </body>
    </html>