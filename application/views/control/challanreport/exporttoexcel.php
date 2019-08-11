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

     
    <div id="printarea"  class="col-xs-12">
      <div class="col-xs-12">
      </div>
      <?php foreach($com as $c){?>
      <div class="col-xs-4 challanheader" align="center">
        <h3 class="text-center"><?php echo $c['name'];?> </h3><br>
        <strong class="text-center">ADDRESS :<?php echo $c['address'];?></strong><br>
        <strong class="text-center">PHONE No :<?php echo $c['contact'];?></strong><br>
        <h3 class="text-center">Chalan </h3><br>
        <strong class="text-center"><?php foreach($busrot as $rot){if($rot['id']==$from){ echo  "From :  " .  $rot['from'];}}?>   <?php foreach($busrot as $rot){if($rot['id']==$to){ echo "To :  ".  $rot['from'];}}?></strong>
      </div>
      <?php } ?>
     <table>
        
          <div class="col-xs-4">
          <tr>
            <td><strong class="pull-right">DATE : <?php echo $dep;?> </strong><br></td> 
           <td><strong class="pull-right">Bus NO : <?php foreach($busno as $bus){  if($bus_no == $bus['id']){ echo $bus['bus_no'];}}?> </strong><br></td> 
            <td><strong class="pull-right">Departure Time: <?php echo $deptime;?></strong></td>
            
        </div>
     
       <?php foreach($busno as $bus){ ?>
        <?php  if($bus_no == $bus['id']){
       ?>
      
      <div class="clearfix"></div>
       <div class="col-md-12">
      
       <td><div class="col-md-4"><b>Driver Name  :   <?php  echo $bus['driver_name'];?></b></div></td>
       <td><div class="col-md-4"><b>Mobile No  :  <?php echo $bus['mobile_no'];?></b></div></td>
      <td><div class="col-md-4"><b>Bus Type : <?php foreach($allcat as $cat){ if($bus['bus_category']==$cat['id']){ echo $cat['title'];}}?></b></div></td>
      </tr>
        
        
        
      </div>
       <?php }} ?>
       </table>
      <div class="clearfix"></div>

      <?php  
      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=exceldata.xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      ?>
    <table border="1">
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
          $total = $ticinfo['total']+$total;
       } ?>
      <tr>
        <th colspan="6">Total (Rs:)</th>
        <td colspan="3">Rs : <?php echo $total."/-";?></td>
        
      </tr>
      <tr>
        <th colspan="6">Office Expanses (Rs:)</th>
        <td colspan="3">
            Rs : <?php echo $officeexp."/-"; ?></td>
      </tr>
      <tr>
        <th colspan="6">Miscellaneous Expences (Rs:)</th>
        <td colspan="3">Rs : <?php echo  $miscellaneous."/-"; ?></td>
      </tr>
       <tr>
        <th colspan="6">Trip Fee (Rs:) </th>
        <td colspan="3">RS : <?php echo  $trip."/-"; ?></td>
      </tr>
      <tr>
      <th colspan="6">Total Net Amount (Rs:)</th>
        <td colspan="3"  >
        RS :  <?php echo  $netamo."/-"; ?>
        </td>
      </tr>
      
    </table>

    </div>
          <!-- /.box -->
      </div>
      <?php  ?>
    </div>
    </body>
    </html>