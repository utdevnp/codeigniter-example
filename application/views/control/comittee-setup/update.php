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
            <?php foreach($row as $data){ 
            $file = COMPANY_LOGO_IMG_DIR.$data['image'];
                          if(file_exists($file))
                          {
                            $image =  $file;
                          }else{
                            $image = NO_COMPANY_LOGO_IMG_DIR;
                          }
              ?>
            <form method="POST" action="<?php echo base_url('control/comitteesetup/update/'.$this->uri->segment(4));?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <!--  content here -->
                  <div class="box-body">
  		            <div class="form-group col-md-4">
  		              <label for="companyname">Company Name</label>
  		              <input type="text" name="name" class="form-control" value="<?php echo $data['name'];?>" id="companyname" placeholder=" Company Name">
  		            </div>
  		            <div class="form-group col-md-4">
  		              <label for="contactNO">Contact No</label>
  		              <input type="text" name="phone" class="form-control" value="<?php echo $data['contact'];?>" id="contactNO" placeholder="Contact No">
  		            </div>
  		            <div class="form-group col-md-4">
  		              <label for="email">Email address</label>
  		              <input type="email" name="email" class="form-control" value="<?php echo $data['email'];?>" id="email" placeholder="Enter email">
  		            </div>
                  <div class="form-group col-md-4">
                    <label for="email"> Address</label>
                    <input type="address" name="address" class="form-control" value="<?php echo $data['address'];?>" id="address" placeholder="Enter Address">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="totalbus">Register No</label>
                    <input type="text" name="register_no" class="form-control" value="<?php echo $data['register_no'];?>" id="totalbus" placeholder="Register No">
                  </div>
  		            <div class="form-group col-md-4">
  		              <label for="totalbus">Total Bus No</label>
  		              <input type="text" name="totalbus" class="form-control" value="<?php echo $data['totalbus'];?>" id="totalbus" placeholder="Total Bus No">
  		            </div>
  		            <div class="form-group col-md-4">
  		              <label for="companyPresident">Company President</label>
  		              <input type="text" name="president" class="form-control" value="<?php echo $data['president'];?>" id="companyPresident" placeholder="President Of Company">
  		            </div>
  		            <div class="form-group col-md-4">
  	                                    <label>Active</label>
  	                                    <?php 
  												$arr =array('Y'=>'Yes','N'=>'No');
  												?>
  												<select class="form-control" name="is_active">
  												<?php
  												foreach($arr as $k=>$v)
  													{
  														if($data['is_active']==$k)
  														{
  															echo "<option value=\"$k\" selected> $v * </option>";
  														}
  														else
  														{
  															echo "<option value=\"$k\"> $v </option>";
  														}
  													}
  												?>
  											</select>
                      </div>
  		            
      		           <div class="form-group col-md-4">
                        <label for="companyPresident">Previous image</label>
                        <?php if($this->session->userdata('uperrormessage')){
                              echo  $this->session->userdata('uperrormessage');
                              $this->session->unset_userdata('uperrormessage');
                        }
                      ?>
                    <img src="<?php  echo $image;?>" height="70px" width="70px" />
                        <input type="file" name="image" class="form-control"  id="companyPresident" placeholder="Image">
                        <label for="companyPresident">Chose new image</label>
                    </div>
  		          
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
              <div class="box-footer">
                <div class="row">
                  <!-- // buttons -->
                  <div class="form-group col-md-4">
                    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Save & Update</button>
  		              <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</button>
  		            </div>
                </div>
                <!-- /.row -->
              </div>
              <?php } ?>
              <!-- /.box-footer -->
            </div>
          </form>
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