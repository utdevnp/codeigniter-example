




<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header mainheadig">
      <h1>
        <?php echo $primaryheader;?>
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
  <div class="clearfix"></div>
    <!-- Main content -->
    <form method="post" action="<?php echo base_url('control/counter_booking/ticketgenpdf/').$ticketid;?>">
    <section class="invoice" id="printarea">
      <!-- title row -->
     
      
       <div style="" class="invoice-info">
        <div class="col-sm-12 invoice-col" align="center">
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
       </div>
      </div>
      <br>
      <br>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <?php 
              foreach($scheadual as $buschedule){
            ?>

             <tr>
                <div class="col-sm-12 invoice-col">
                <?php foreach($busdetail as $busmatch){?>
                <td colspan="2"><big><?php echo $busname;?> </big></td>
                <td>Bus No. <strong><?php if($buschedule['bus_no']==$busmatch['id']){echo $busmatch['bus_no'];} ?></strong></td>
                <td><strong>Shift: <?php echo $buschedule['shift']; ?></strong></td>
                <td><strong>Bus Type : <?php foreach($buscatagory as $cata){foreach($busdetail as $buscata){if($buscata['bus_category']==$cata['id']){echo $cata['title']; }}} ?></strong></td>
                <?php 
                  }
                ?>
              </div>
              </tr>


            <tr>
              
              <td colspan="3">
                 <div class="col-sm-12 invoice-col">
                  DEPARTURE
                  <address>
                    <strong><?php foreach($from as $f){if($f['id']==$buschedule['from']){echo $f['from'];}} ?></strong><br>
                    Departure : <?php echo $buschedule['departure']." ".$buschedule['departuretime'] ; ?><br>
                    Boarding Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['boarding']){echo $route['from'];}}}?> (<?php echo $btimes;?>)
                  </address>
                </div>

              </td>
              <td colspan="3">
                <div class="col-sm-12 invoice-col">
                  ARRIVAL
                  <address>
                    <strong><?php foreach($to as $f){if($f['id']==$buschedule['to']){echo $f['from'];}} ?></strong><br>
                    Arrival : <?php echo $buschedule['arrival']." ".$buschedule['arrivaltime'] ; ?> <br>
                    Dropping Point: <?php foreach($passenger_info as $pinfo){foreach($allroutes as $route){if($route['id']==$pinfo['dropping']){echo $route['from'];}}}?>  (<?php echo $dtimes;?>)
                  </address>
                </div>
              </td>

            </tr>
            <?php } ?>
            <tr>
              <th>Passenger Name </th>
              <th>Passenger Phone </th>
              <th>No of Passenger</th>
              <th>Rate</th>
              <th>Discount (%)</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($passenger_info as $pinfo){ ?>
            <tr>
              <td><?php echo $pinfo['name'];?></td>
              <td><?php echo $pinfo['contact'] ?></td>
              <td><?php echo count($stotalpassenger);?></td>
              <td>Rs <?php echo $pinfo['rate'];?>/-</td>
              <td><?php echo $pinfo['tdiscount']/$pinfo['rate']*100;?></td>
            </tr>
          <?php 
          $disc   = $pinfo['tdiscount'];
          $total = count($stotalpassenger) *$pinfo['rate'];
            }
            ?>
            <tr>
                <td colspan="5"><b>Seats:</b> <?php echo $seats;?></td>
            </tr>
            <tr>
              <th colspan="4">Total</th>
              <th>Rs <?php echo $total - $disc;?>/-</th>
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
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
           <input type="hidden" name="seats" value="<?php echo $seats;?>">
          <input type="hidden" name="scheduleid" value="<?php echo $scheduleid ;?>">
          <input type="hidden" name="ticketid" value="<?php echo $ticketid ;?>">
          <input type="hidden" name="btimes" value="<?php echo $btimes ;?>">
		  <input type="hidden" name="username" value="<?php echo $username ;?>">
          <input type="hidden" name="dtimes" value="<?php echo $dtimes ;?>">
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button name="printticket" formtarget="_blank" value="print"   class="btn pull-right btn-flat btn-sm btn-default"><i class="fa fa-print"></i> Print</button>
          <button name="mailsent" formtarget="_blank" value="mail"   class="btn pull-right btn-flat btn-sm btn-success"><i class="fa fa-envelope-o"></i> Send Mail</button>
          <button name="genpdf" formtarget="_blank" value="pdf" class="btn btn-primary btn-flat btn-sm pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    </from>


  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('inc/adminfooter');?>
  <?php $this->load->view('inc/admincontrolsidebar');?>
</div>
<!-- ./wrapper -->
</body>
<?php $this->load->view('inc/footer');?>