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
        <?php echo $title;?>
        <small><?php echo count($allusers);?></small>
      </h1>
      
    </section>
    <div class="col-md-12">
    <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="#"><?php echo $primaryheader;?></li>
      </ol>
    </div>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>0<sup style="font-size: 20px">%</sup></h3>
                
              <p>Verified user</p>
            </div>
            <div class="icon">
              <i class="fa fa-chrome"></i>
            </div>
            
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>0<sup style="font-size: 20px">%</sup></h3>

              <p>Unverified user</p>
            </div>
            <div class="icon">
              <i class="fa fa-firefox"></i>
            </div>
            
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>0<sup style="font-size: 20px">%</sup></h3>

              <p>Safari</p>
            </div>
            <div class="icon">
              <i class="fa fa-safari"></i>
            </div>
            
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>0<sup style="font-size: 20px">%</sup></h3>

              <p>Other </p>
            </div>
            <div class="icon">
              <i class="fa fa-adjust"></i>
            </div>
            
          </div>
      </div>
      <div class="col-md-12 col-sm-6 col-xs-12">
		<?php $this->load->view('control/inc/message');?>
		<?php $this->load->view('control/inc/validation');?>
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Users</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th width="10">S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Ip</th>
                    <th colspan="2">Status</th>
                    <th>Added</th>
                    <th colspan="2">Active</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $sn=1;
                    foreach($allusers as $login){
                  ?>
                    <tr>
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $login['fname']." ".$login['lname'];?></a></td>
                      <td><?php echo  $login['email'];?></td>
                      <td><?php echo $login['mobile_no'];?>  </td>
                      <td><?php echo $login['ip'];?>  </td>
                      <td>
					  <span class="label label-<?php if($login['verif']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($login['verif']=="Y"){echo "Verified";}else{echo "Unverified";};?></span>
                      </td>
                      <td>
						<i data-toggle="tooltip" title="User used channel" class="fa fa-<?php if(!empty($login['vcode'])){echo "mobile";}else{echo "globe";}?>" aria-hidden="true"></i>
					 </td>
                      <td>
                      <?php 
                        $date =  date('M j Y', strtotime($login['addinfo']));
                        $today = date('M j Y');

                        $value  = date_range($date,$today);
                        $diff = count($value);

                        if($diff == 1){
                         echo "Today" ." ". date('g:i A', strtotime($login['addinfo']));
                         }
                        elseif($diff == 2){
                           echo "Yesterday"." ".date('g:i A', strtotime($login['addinfo']));
                        }else{
                          echo date('M j Y g:i A', strtotime($login['addinfo']));
                        }
                    ?>
                    </td>
					<td><span class="label label-<?php if($login['active']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($login['active']=="Y"){echo "Yes";}else{echo "No";};?></span></td>
                    <td>
						<div class="btn-group">
						  <button type="button" class="btn btn-default btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							Action  <span class="caret"></span> </button>
						  <ul class="dropdown-menu pull-right " role="menu">
							<li><a href="JavaScript:void(0)" data-toggle="modal" data-target="#updateModal<?php echo $login['id'];?>"><i class="fa fa-edit "></i> Update user</a></li>
							<li><a href="JavaScript:void(0)" data-toggle="modal" data-target="#viewModal<?php echo $login['id'];?>"><i class="fa fa-eye"></i> View details</a></li>
							<li><a href="JavaScript:void(0)" data-toggle="modal" data-target="#pwchangeModal<?php echo $login['id'];?>" class="text-primary"><i class="fa fa-key text-primary"></i> Change Password</a></li>
							<li class="divider"></li>
							<li><a href="JavaScript:void(0)" data-toggle="modal" data-target="#deleteModal<?php echo $login['id'];?>" class="text-danger"><i class="fa fa-trash text-danger"></i> Delete user</a></li>
						  </ul>
						</div>
							<?php include('actioins.php');?>
					</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
				<hr>
				<?php echo $this->pagination->create_links(); ?>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
            </div>
          </div>
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