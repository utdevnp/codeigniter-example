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
        <small><?php echo $count;?></small>
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
             
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-ellipsis-v"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo ADMIN_BASE.'busscheadual/departedbus';?>">Departed Buses</a></li>
                  </ul>
                </div>

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
               <!-- error meassate  -->
                   
                    <!-- /.box-header -->
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>#</th>
                          <th>Bus No</th>
                          <th>From <i class="fa  fa-angle-double-right"></i> To </th>
                          <th> Fare </th>
                          <th>Departure</th>
                          <th>Arrival </th>
                          <th>Status</th>
                          <th colspan="2">Actions</th>
                        </tr>
                       
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