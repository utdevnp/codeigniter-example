<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 0px;">
    <!-- Content Header (Page header) -->
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
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <?php $this->load->view('control/inc/message');?>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <?php  foreach($row as $data){ ?>
                <div class="col-md-3">
                  <div class="box no-padding">
                  <!-- /.box-header -->
                 <?php
                 $file = BUS_IMAGE_DIR.$data['bus_image']; 

                    if(file_exists($file))
                    {
                       $image = $file;
                    }else{
                      $image  =  NO_PHOTO_USER_IMAGE_DIR;
                    }
                    ?>
                  <div class="box-body no-padding busimages">
                    <img src="<?php echo $image;?>" class="img-responsive"/>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                   <h3><?php echo $data['bus_no'];?></h3>
                  </div>
                   <div class="box-footer text-center">
                  <a href="control/busscheadual/view/<?php echo $data['id'];?>">View Current Bus Schedule</a>
                  </div>

                  <!-- /.box-footer -->
                  </div>
               </div>
               <div class="col-md-9">
                  <div class="box no-padding">
                  <!-- /.box-header -->
                  <div class="box-header">
                   <h3 class="box-title"><?php foreach($allbus as $bus){?><?php if($data['bus_name']==$bus['id']){echo $bus['bus_name'];}?><?php }?></h3>
                  </div>
                  <div class="box-body no-padding">
                       
                       <div class="col-md-3">
                         <label for="to">Bus Number</label>
                          <p><?php echo $data['bus_no'];?></p>
                        </div>

                        <div class="col-md-3">
                         <label for="to">Bus Category</label>
                          <p><?php foreach($allcat as $cat){?><?php if($data['bus_category']==$cat['id']){echo $cat['title'];}?><?php }?></p>
                        </div>

                        <div class="col-md-6">
                         <label for="to">Travel Company</label>
                          <p><?php foreach($allcom as $com){?><?php if($data['company']==$com['id']){echo $com['name'];}?><?php }?></p>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                         <div class="col-md-3">
                          <label for="to">Owner</label>
                          <p><?php echo $data['owner'];?></p>
                        </div>
                        <div class="col-md-3">
                          <label for="to">Mobile No</label>
                          <p><?php echo $data['mobile_no'];?></p>
                        </div>
                        <div class="col-md-3">
                          <label for="to">Email</label>
                          <p><?php echo $data['email'];?></p>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                         <div class="col-md-3">
                          <label for="to">Driver Name</label>
                          <p><?php echo $data['driver_name'];?></p>
                        </div>

                        <div class="col-md-3">
                          <label for="to">Driver Contact No</label>
                          <p><?php echo $data['driver_mobile_no'];?></p>
                        </div>

                        <div class="col-md-3">
                          <label for="to">Total Seats in A Side</label>
                          <p><?php echo $data['total_sheet_in_a_side'];?> Seats</p>
                        </div>

                        <div class="col-md-3">
                          <label for="to">Total Seats in B Side</label>
                          <p><?php echo $data['total_sheet_in_b_side'];?> Seats</p>
                        </div>
                        <div class="col-md-3">
                          <label for="to">Last Row</label>
                          <p><?php echo $data['last_row'];?> Seats</p>
                        </div>
                         <div class="col-md-3">
                          <label for="to">Active</label>
                          <span class="label label-<?php if($data['is_active']=='Y'){echo "success";}else{echo 'danger';}?>"><?php if($data['is_active']=='Y'){echo "Yes";}else{echo 'No';}?></span>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                        
                        <div class="col-md-3 pull-right">
                            <?php if(in_array($this->uri->segment(2)."/add",$user_id)){;?>
                              <a href="<?php echo ADMIN_BASE.$this->uri->segment(2)."/update/".$data['id']; ?>" style="margin-left:7px;" class="btn btn-primary btn-sm btn-flat pull-right topbuttons" >Update</a>
                              <?php } ?>
                        </div>

                        <div class="clearfix"></div>
                        <br>
                  </div>
                  </div>
               </div>
              </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
            
              <!-- /.row -->
            </div>
            <?php } ?>
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