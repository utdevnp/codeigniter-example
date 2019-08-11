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

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
           <?php $this->load->view('control/inc/message');?>
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
              <div class="row">
                <div class="col-md-12">
                  <?php foreach($row as $data){;?>
                   <div class="col-md-4 form-group">
                          <label>Date </label>
                          <p><big><?php echo $data['timestamp'];?></big> &nbsp;&nbsp;&nbsp; <span class="label label-<?php if($data['is_active']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($data['is_active']=="Y"){echo "Open";}else{echo "Close";};?></span></p>
                      </div>
                      
                      <div class="clearfix"></div>
                      <div class="col-md-4 form-group">
                          <label>Services </label>
                          <p><?php echo $data['service'];?></p>
                      </div>

                      <div class="col-md-8 form-group">
                          <label>Subject </label>
                          <p><?php echo $data['subject'];?></p>
                      </div>


                      <div class="col-md-12 form-group">
                          <label>Services </label>
                          <p><?php echo $data['message'];?></p>
                      </div>
                  
                 <?php } ?>
                 <div class="col-md-2">
                 <a href="<?php echo ADMIN_BASE."complains";?>" class="btn btn-info btn-flat form-control btn-sm">Go Back</a>
                 </div>
                </div>
               
                <!-- /.row -->
              </div>
            </div>
            <!-- ./box-body -->
            
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