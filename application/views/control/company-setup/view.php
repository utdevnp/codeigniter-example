<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $primaryheader;?>
        <small>0</small>
      </h1>
      

    </section>
    <div class="col-md-12">
      <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $primaryheader;?> > <?php echo $title;?>&nbsp &nbsp </li>
        <a href="<?php echo base_url('control/companysetup/add');?>" type="button" class="btn btn-success btn-xs btn-flat pull-right topbuttons"><i class="fa fa-plus"></i> Add New</a>
      </ol>

    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <?php $this->load->view('control/inc/message');?>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
              
                    <table class="table table-striped">
                      <tbody>
                         <?php  foreach($row as $data){ ?>
                          <tr> <td>ID</td> <td> <?php echo $data['id'];?> </td> </tr>
                          <tr><td>Company Name</td><td><?php echo $data['name'];?></td></tr>
                          <tr><td>Register No</td><td><?php echo $data['register_no'];?></td></tr>
                          <tr><td>Email</td><td><?php echo $data['email'];?></td></tr>
                          <tr><td>Address</td><td><?php echo $data['address'];?></td></tr>
                          <tr><td>Phone no</td><td><?php echo $data['contact'];?></td></tr>
                          <tr><td>Total Bus</td><td><?php echo $data['totalbus'];?></td></tr>
                          <tr><td>President Name</td><td><?php echo $data['president'];?></td></tr>
                          <tr><td>President image</td><td> <img src="<?php  echo base_url().'./uploads/usersfiles/'.$data['image'];?>" height="40 " width="40px" /></td></tr>
                          <tr><td>Active</td><td><?php if($data['is_active'] == "Y"){echo "Yes";} else{ echo "No";}            ?></td></tr>
                         
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
            
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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