
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
    <section class="invoice">
      <!-- title row -->
     
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-credit-card"></i> Payment Conformation  
            <small class="pull-right"></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <?php foreach($pdetail as $det){ 
       $pid   =   $det['id'];
       $tdis  =   $det['tdiscount'];
       $tamo  =   $det['total'];
       $rate  =   $det['rate'];
       $boarding  =   $det['boarding'];
       $dropping  =   $det['dropping'];
       $ticketid = $det['ticketid'];


     
  }?>

      <?php foreach($scheadual as $detail){?>
      <!-- info row -->
      <div class="row invoice-info">
      <input type="hidden" name="scheduleid" value="<?php echo $detail['id'];?>"/>
        <div class="col-sm-4 invoice-col">
          <strong>From</strong>
          <address>
            <?php foreach($from as $f){ echo  $f['from'];}?><br>
            <?php echo "Departure Date : ". $detail['departure'];?><br>
             <?php echo "Departure Time : ".$detail['departuretime'];?><br>
              <?php echo "Boarding Point : ";?>  <?php foreach($allroutes as $rot){;?> 
             <?php if($rot['id']==$boarding){echo $rot['from'];};?> 
             <?php } ?>
             (<?php echo $btimes;?>)
            <br>
            
          
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <strong>To</strong>
          <address>
            <?php foreach($to as $t){ echo  $t['from'];}?></strong><br>
            <?php echo"Arrival Date : ". $detail['arrival'];?><br>
             <?php echo "Arrival Time : ". $detail['arrivaltime'];?><br>
             
             <?php echo "Dropping Point : ";?>  <?php foreach($allroutes as $rot){;?> 
             <?php if($rot['id']==$dropping){echo $rot['from'];};?>  
             <?php } ?>
             (<?php echo $dtimes;?>)
            <br>
           
          </address>
        </div>
        <!-- /.col -->
       <div class="col-sm-4 invoice-col">
          <strong>Bus Detail</strong><br>
          <?php foreach($allcom as $comp)
          { 
            foreach($busnames as $busn)
            {
              if($busn['id']==$busdetail){echo $busn['bus_name'] ."<br>";}
            }
         foreach($category as $cats){ echo "Bus Category : " .$cats['title']."<br>";}
        
        }
        ?>

        </div> 
        <!-- /.col -->
      </div>
      <?php } ?>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>

            <tr>
              <th>SN</th>
              <th>Name</th>
              <th>Seat No</th>
              <th>Rate </th>
            </tr>
            </thead>
            <tbody>
             <?php 
             $sn = 1;
             foreach($passengers as $p){ ?>
            <tr>
              <td><?php echo $sn++;?></td>
              <td><?php echo $p['name'];?></td>
              <td><?php echo $p['seat'];?><input type="hidden" name="seats[]" value="<?php echo $p['seat'];?>"></td>
              <td><?php  if($p['info_id']==$pid){echo "Rs :  " .$rate."/-";}?></td>
              <td></td>

            <?php } ?>
           
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	   <form method="post" action="https://esewa.com.np/epay/main">
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <strong><?php echo strtoupper("Cancellation Term & Policy :");?></strong>
            When you create your Airbnb listing you select one of three standard cancellation policies: Flexible: Full refund 1 day prior to arrival, except fees. Moderate: Full refund 5 days prior to arrival, except fees. Strict: 50% refund up to 1 week prior to arrival, except fees.
          </p>
        </div>
        <!-- /.col -->
       <div class="col-xs-12 col-sm-6 col-md-6">
	   
	  <!-- /change for esewa ingegration  -->
			
				 <input value="<?php echo $tamo;?>" name="tAmt" type="hidden">
				 <input value="<?php echo $tamo;?>" name="amt" type="hidden">
				 <input value="0" name="txAmt" type="hidden">
				 <input value="0" name="psc" type="hidden">
				 <input value="0" name="pdc" type="hidden">
				 <input value="databank" name="scd" type="hidden">
				 <input value="DBI-<?php echo $ticketid;?>" name="pid" type="hidden">   
				 <input value="<?php echo "http://www.databankbooking.com/control/counter_booking/ultimateticket/".$ticketid."?q=su";?>" type="hidden" name="su">  
				 <input value="<?php echo "http://www.databankbooking.com/control/counter_booking/ultimateticket?q=fu";?>" type="hidden" name="fu"> 
	   
	    <!-- /change for esewa ingegration  -->
	   
          <input type="hidden" name="ticketid" value="<?php echo $ticketid ;?>">
          <input type="hidden" name="btimes" value="<?php echo $btimes ;?>">
          <input type="hidden" name="dtimes" value="<?php echo $dtimes ;?>">
        
      
          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo "Rs: ".$grosstotal."/-";?></td>
              </tr>
              
              <tr>
                <th>Discount(<?php echo ($tdis *100)/$grosstotal."%";?>):</th>
                <td><?php echo "Rs: ".$tdis."/-";?></td>
              </tr>
              <tr>
                <th>Rate:</th>
                <td><?php echo "Rs: ".$rate."/-";?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo "Rs: ".$tamo."/-";?></td>
              </tr>
            </tbody></table>
          </div>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="form-group col-md-4 pull-right">
          <button type="submit" name="submit" value="cpayement" class="btn btn-success btn-sm btn-flat pull-right" "><i class="fa fa-credit-card"></i> Confirm Payment</button>
          <a href="<?php echo ADMIN_BASE."counter_booking/trash/".$infoid;?>" class="btn btn-danger btn-sm btn-flat pull-right" style="margin-right:5px;"><i class="fa fa-times"></i> Cancel Payment</a>
        </div>
      </div>
	   </form>
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