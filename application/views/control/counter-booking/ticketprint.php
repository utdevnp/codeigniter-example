<html>
<head>
  <meta  charset="utf-8">
  <title>Passenger ticket</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
</head>
<body onload="window.print()">
    <div style="width: 1000px; margin:0 auto;">
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
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-bordered">
             <thead>
            <?php 
              foreach($scheadual as $buschedule){
            ?>
            <tr>
                <div class="col-sm-12 invoice-col">
                <?php foreach($busdetail as $busmatch){?>
                <td colspan="2"><big><?php echo $busname;?> </big></td>
                <td><strong><?php if($buschedule['bus_no']==$busmatch['id']){echo $busmatch['bus_no'];} ?></strong></td>
                <td><strong>Shift: <?php echo $buschedule['shift']; ?></strong></td>
                <td><strong>Bus Type : <?php foreach($buscatagory as $cata){foreach($busdetail as $buscata){if($buscata['bus_category']==$cata['id']){echo $cata['title']; }}} ?></strong></td>
                <?php 
                  }
                ?>
              </div>
              </tr>
              <tr>
              </td>
              <td colspan="3">
                 <div class="col-sm-12 invoice-col">
               
                  <address>
                    <strong><?php foreach($from as $f){if($f['id']==$buschedule['from']){echo $f['from'];}} ?></strong><br>
                    Departing: <?php echo $buschedule['departure']." ".$buschedule['departuretime'] ; ?><br>
                    Boarding Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['boarding']){echo $route['from'];}}}?> (<?php echo $btimes;?>)
                  </address>
			  <small>DEPARTURE</small>
                </div>

              </td>
              <td colspan="3">
                <div class="col-sm-12 invoice-col">
                  
                  <address>
                    <strong><?php foreach($to as $f){if($f['id']==$buschedule['to']){echo $f['from'];}} ?></strong><br>
                   Arrival : <?php echo $buschedule['arrival']." ".$buschedule['arrivaltime'] ; ?> <br>
                    Dropping Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['dropping']){echo $route['from'];}}}?>  (<?php echo $dtimes;?>)
                  </address>
			  <small>ARRIVAL</small>
                </div>
              </td>

            </tr>
            <?php } ?>
            <tr>
              <th>Passenger Name </th>
              <th>Passenger Phone </th>
              <th>No of Passenger</th>
              <th>Rate</th>
              <th>Discount(%)</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($passenger_info as $pinfo){;?>
            <tr>
              <td><?php echo $pinfo['name'];?></td>
              <td><?php echo $pinfo['contact'];?></td>
              <td><?php echo count($stotalpassenger);?></td>
              <td>Rs <?php echo $pinfo['rate'];;?>/-</td>
			    <td><?php echo $pinfo['tdiscount']/$pinfo['rate']*100;?></td>
            </tr>
          <?php 
          echo $disc   = $pinfo['tdiscount'];
          $total = count($stotalpassenger) *$pinfo['rate'];
            }
            ?>
             <tr>
              <th colspan="6">Seats : <?php echo $seats; ?></th>
            </tr>
            <tr>
              <th colspan="4">Total</th>
              <th>Rs <?php echo $total-$disc;?>/-</th>
            </tr>
			<tr>
				<td colspan="5">Contact for  <?php echo $busname ." "; foreach($busdetail as $bdtl){ echo $bdtl['driver_mobile_no']."<small> (Driver) </small>,".$bdtl['driver_mobile_no']."<small> (Owner) </small>";};?> <p class="pull-right">Ticket by: <?php echo $username;?>  </p></td>
			</tr>
			<tr>
				<td colspan="3" style="border:none; line-height:16px">
					 <small style="font-size:10px;"> * 1,00,000 traveller insurance is secured </small><br>
					 <small style="font-size:10px;"> * Cancellation policy is applied 25% of total amount (If cancelled before 4 hour from departure)  </small><br>
					 <small style="font-size:10px;"> * All terms and condition are applied of databankbooking.com </small><br>
				</td>
				<td colspan="2" style="border:none;">
					<p align="right">
					<img style="width:50%;" height="40px"  src="<?php echo STATIC_IMG_DIR."logo.png"?>"><br>
					<small style="font-size:10px;">Phone : 014102838 <br> Email : support@databankbooking.com</small>
					</p>
				</td>
			</tr>
			
            </tbody>
          </table>
         <div>
    </body>
    </html>