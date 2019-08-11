<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header mainheadig">
      <h1>
        
        <small></small>
      </h1>
      
    </section>
    <div class="col-md-12">
    <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="#"></li>
        <li class="active"></li>
        <a href="" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
      </ol>
    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
      
     
        <!-- /.col -->
        <?php foreach($comp as $com){
              	$cch = explode('/', $com['ccharge']);
              	}
	               
              	?>
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if($sdet=="" AND $enddet ==""){echo "active";}?>"><a href="#balance" data-toggle="tab">Current Balance</a></li>
              <li class="<?php if($sdet!=="" AND $enddet !==""){echo "active";}?>"><a href="#ledger"  data-toggle="tab">Ledger</a></li>
               <li><a href="#activity"  data-toggle="tab">Activity</a></li>
              
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="balance">
                <!-- Post -->
              <div class="ledger" id="ldegercompany">
                <table id="companyledger"  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Date </th>
                  <th>Bus NO </th>
                  <th>Trip Fee </th>
                  <th>Counter Charge</th>
                  <th>Other Expences</th> 
                  <th>Discounts</th>
                  <th>Owner Amount</th>
                  <th>Total</th>
                </tr>
                </thead>
                 <tbody>
                <?php foreach($schead as $sch){
                	
                	if($sch['is_active'] == "Y"){
                	 $totalamount = 0;
                	 $totaldis = 0;
	              	$tcinfo = $this->dynamic_query->getby($sch['id'],'passengers_ticket_info','sid');
	            	foreach($tcinfo as $pinfo){  
	            		$totalamount = $totalamount + $pinfo['total'];
	            		$totaldis = $totaldis + $pinfo['tdiscount'];
	            }
            	?>
                <tr>
                   <td><?php  echo  $sch['departure'];  ?></td>
                  <td><?php  foreach($busno as $bus){if($bus['id']==$sch['bus_no']){ echo $bus['bus_no'];}} ?></td>
                  <td><?php  if($totalamount>0){ echo $tr = @$cch[1];}else { echo $tr =  0;} @$tottrip = $tr+@$tottrip; ?></td>
                  <td><?php echo $cexp =  $totalamount*@$cch[2]/100; @$totcounter = @$totcounter+$cexp;?></td>
                  <td> <?php echo $mis =  $totalamount*$cch[0]/100; @$totmis = @$totmis+$mis;?></td>
                  <td> <?php echo $tdis =  $totaldis; @$totdis = @$totdis+$tdis;?></td>
                  <td><?php $totalesxp = @$cch[1]+$cexp+$mis; if($totalamount>0){ echo $totowoner =  $totalamount-$totalesxp;} else {echo $totowoner = 0;} @$cashowner   = @$cashowner+ $totowoner;?></td>
                  <td><?php  echo $totalamount; @$tot = @$tot+$totalamount; ?></td>
                </tr>


                <?php } } ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th colspan="2">Total</th>
                  <th><?php echo @$tottrip;?></th>
                  <th><?php echo @$totcounter;?></th>
                  <th><?php echo @$totmis;?></th>
                  <th><?php echo @$totdis;?></th>
                  <th><?php echo @$cashowner;?></th>
                  <th><?php echo @$tot;?></th>
                </tr>
                </tfoot>
              </table>
              </div>
                <!-- /.post -->     
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="ledger">
              <div class="col-md-12">
              <form method="POST" action="<?php echo base_url('control/accounting/index');?>" enctype="multipart/form-data">  
              	<div class="form-group col-md-5">
                  
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="from" value="<?php echo date('Y-m-d');?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>

                <div class="form-group col-md-5">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="to" value="<?php echo date('Y-m-d');?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-search"></i> Search</button>
  		            </div>
                </form>

              </div>
              <div class="clearfix"></div>
              <div class="ledger" id="ldegercompany">
                <table id="companyledger"  class="table table-bordered table-striped">
                <thead class="table-header">
                <tr>
                  <th>Date</th>
                  <th>Bus NO </th>
                  <th>Trip Fee </th>
                  <th>Counter Charge</th>
                  <th>Other Cxpences</th>
                  <th>Discounts</th>
                  <th>Owner Amount</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($schead as $sch){
                	if($sch['is_active'] == "N"){
                	$totalamount=0;
                	$totaldis = 0;
	              	
	              	if($sdet!=="" AND $enddet !==""){
	              		$tcinfo =  $this->static_model->selectbetween('passengers_ticket_info','sid',$sch['id'],'addiinfo',$sdet,$enddet);	
	              		
	              	}else {
	              		$tcinfo = $this->dynamic_query->getby($sch['id'],'passengers_ticket_info','sid');
	              		
	              	}
	              	
	            	foreach($tcinfo as $pinfo){  
	            		
	            		$totalamount = $totalamount + $pinfo['total'];
	            		$totaldis = $totaldis + $pinfo['tdiscount'];

	            	}
            	?>
                <tr>
                  <td><?php  echo  $sch['departure'];  ?></td>
                  <td><?php  foreach($busno as $bus){if($bus['id']==$sch['bus_no']){ echo $bus['bus_no'];}} ?></td>
                  <td><?php  if($totalamount>0){ echo $tr = @$cch[1];}else { echo $tr =  0;} @$tottrp = $tr+@$tottrp; ?></td>
                  <td><?php echo $cexp =  $totalamount*@$cch[2]/100; @$totcor = @$totcor+$cexp;?></td>
                  <td> <?php echo $mis =  $totalamount*@$cch[0]/100; @$totmisc = @$totmisc+$mis;?></td>
                  <td> <?php if($totalamount>0){echo $tdis =  $totaldis;}else { echo $tdis =  0; } @$totdis = @$totdis+$tdis;?></td>
                  <td><?php $totalesxp = @$cch[1]+$cexp+$mis; if($totalamount>0){ echo $totowoner =  $totalamount-$totalesxp;} else {echo $totowoner = 0;} @$cashownr   = @$cashownr+ $totowoner;?></td>
                  <td><?php  echo $totalamount; @$totl = @$totl+$totalamount; ?></td>
                </tr>


                <?php } } ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th colspan="2">Total</th>
                  <th><?php echo @$tottrp;?></th>
                  <th><?php echo @$totcor;?></th>
                  <th><?php echo @$totmisc;?></th>
                  <th><?php echo @$totdis;?></th>
                  <th><?php echo @$cashownr;?></th>
                  <th><?php echo @$totl;?></th>
                </tr>
                </tfoot>
              </table>
              </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="activity">
                <form class="form-horizontal">
                 <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" value="" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" value="" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" cols="10" id="inputExperience" placeholder="Message"></textarea>
                    </div>
                  </div>
                 
                 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      
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
<script type="text/javascript">
  
function AddAnchor(anchor)
{
window.location.href.hash = anchor;
}

</script>