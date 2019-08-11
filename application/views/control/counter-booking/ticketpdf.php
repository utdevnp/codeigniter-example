<html>
<head>
  <meta  charset="utf-8">
  <title>Passenger ticket</title>
  <style>
     hr{border-collapse:collapse; color:#dedede;}
  .invoice-col{line-height:20px;}
    table { font-family:sans-serif; font-style:normal; font-size:12px;  text-shadow: none; font-weight:normal;    border-collapse: collapse;}
    table td{border:1px solid #000; }
    table th{border:1px solid #000; text-align:left;}
    table td, th{padding:3px;}
	.toptable td{border:none;}
  </style>
</head>
<body>
          <?php foreach($allcom as $comp){
          foreach($allcomittee as $comittee){
            if($comp['comittee_id']==$comittee['id']){
          ?>
          <table width="730px" style="table-border:0px;" class="toptable">
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
      </div>
      <br>
      <br>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12">
          <table  width="730px">
             <thead>
            <?php 
              foreach($scheadual as $buschedule){
            ?>
            <tr>
              <td style="width:200px;height:auto; line-height:16px;">
                <?php foreach($busdetail as $busmatch){?>
                <strong>Bus Name: </strong> <?php echo $busname;?> <br>
                <strong>Shift: </strong> <?php echo $buschedule['shift']; ?><br>
                <strong>Bus Type : </strong> <?php foreach($buscatagory as $cata){foreach($busdetail as $buscata){if($buscata['bus_category']==$cata['id']){echo $cata['title']; }}} ?><br>
                <?php 
                  }
                ?>
              </td>
              <td colspan="2">
                 <div class="col-sm-12 invoice-col">
               
                 
                    <strong><?php foreach($from as $f){if($f['id']==$buschedule['from']){echo $f['from'];}} ?></strong><br>
                   Departure : <?php echo $buschedule['departure']." ".$buschedule['departuretime'] ; ?><br>
                    Boarding Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['boarding']){echo $route['from'];}}}?> (<?php echo $btimes;?>)
            <hr>
			  <small style="font-size:10px;">DEPARTURE</small>
                </div>

              </td>
              <td colspan="2">
                <div class="col-sm-12 invoice-col">
                  
                  
                    <strong><?php foreach($to as $f){if($f['id']==$buschedule['to']){echo $f['from'];}} ?></strong><br>
                   Arrival : <?php echo $buschedule['arrival']." ".$buschedule['arrivaltime'] ; ?> <br>
                    Dropping Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['dropping']){echo $route['from'];}}}?>  (<?php echo $dtimes;?>)
                  <hr>
				<small style="font-size:10px;">ARRIVAL</small>
                </div>
              </td>

            </tr>
            <?php } ?>
            <tr>
              <th>Passenger Name </th>
              <th>Passenger Contact</th>
              <th>No of Passenger </th>
              <th>Rate</th>
              <th>Discount</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($passenger_info as $pinfo){ ?>
            <tr>
              <td><?php echo $pinfo['name'];?></td>
              <td><?php echo $pinfo['contact'] ;?></td>
              <td><?php echo count($stotalpassenger);?></td>
              <td>Rs <?php echo $pinfo['rate'];;?>/-</td>
             <td><?php echo $pinfo['tdiscount']/$pinfo['rate']*100;?>  </td>
            </tr>
          <?php 
          $disc   = $pinfo['tdiscount'];
          $total = count($stotalpassenger) *$pinfo['rate'];
            }
            ?>
            <tr>
              <td colspan="5">Seats: <?php echo $seats;?></td>
            </tr>
            <tr>
              <th colspan="4">Total</th>
              <th>Rs <?php echo $total-$disc;?>/-</th>
            </tr>
			<tr>
				<td colspan="5">Contact for  <?php echo $busname ." "; foreach($busdetail as $bdtl){ echo $bdtl['driver_mobile_no']."<small> (Driver) </small>,".$bdtl['driver_mobile_no']."<small> (Owner) </small>";};?> Ticket by: <?php echo $username;?>  </td>
			</tr>
			<tr>
				<td colspan="3" style="border:none; line-height:16px">
					 <small style="font-size:10px;"> * 1,00,000 traveller insurance is secured </small><br>
					 <small style="font-size:10px;"> * Cancellation policy is applied 25% of total amount (If cancelled before 4 hour from departure)  </small><br>
					 <small style="font-size:10px;"> * All terms and condition are applied of databankbooking.com </small><br>
				</td>
				<td colspan="2" style="border:none;">
					<p align="right">
					<img height="40px" src="<?php echo STATIC_IMG_DIR."logo.png"?>"><br>
					<small style="font-size:10px;">Phone : 014102838 <br> Email : support@databankbooking.com</small>
					</p>
				</td>
			</tr>
            </tbody>
          </table>

    </body>
    </html>