
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
        <a href="<?php echo ADMIN_BASE.$this->uri->segment(2).'/add';?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
      </ol>
    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-9">
         <?php $this->load->view('control/inc/message');?>
              <?php $this->load->view('control/inc/validation');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?> </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
              <form method="post" action="<?php echo base_url('control/users/changepassword/'.$this->uri->segment(4))?>">
            <!-- /.box-header -->
            <?php foreach($row as $data){ ;
              $file = './uploads/users/'.$data['userfile'];

              ?>
            <div class="box-body">
              <div class="row">
                
                <!--  content here and form here -->
              
                <div class="box-body">
                <div class="col-md-5">
                <div class="form-group">
                  <label for="company">Old Password <span class="stricts"> * </span></label>
                  <input type="password"  class="form-control" name="oldpassword" id="fname" placeholder="Old Password">
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="companyname">New Password <span class="stricts"> * </span></label>
                  <input type="password"  class="form-control" id="password" name="password" placeholder="New Password">
                </div>
                <div class="clearfix"></div>
                 <div class="form-group">
                  <label for="companyname">Re enter New Password <span class="stricts"> * </span></label>
                  <input type="password" class="form-control" id="username"  name="repassword" placeholder="Re enter New Password">
                </div>
              </div>
              <div class="col-md-5">
    <?php if($this->session->userdata('pwchange')){  ?>   
    <small>Please note quick ...... it will be lost after reftesh..</small>       
<pre>
+=============================
| password change info 
+=============================
| username : <?php echo $data['username'];?><br>
| password : <?php echo $this->session->userdata('pwchange');?><br>
| status   : <?php echo $data['is_active'] = 'Y' ? 'Active' : 'Deactive';?><br>
+=============================
</pre>

    <?php 
    $this->session->unset_userdata('pwchange');
    } ?>


              </div>
              </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <!-- // buttons -->
                 <div class="form-group col-md-8">
                 <button  class="btn btn-success btn-sm btn-flat" type="submit" name="changepass" value="changepass"><i class="fa fa-key"></i> Change Password</button>
                 <button class="btn btn-danger btn-sm btn-flat" type="reset" "><i class="fa fa-refresh"></i> Reset</button>
                 <a href="<?php echo ADMIN_BASE.'users/update/'.$data['id']; ?>" class="btn btn-primary btn-sm btn-flat" type="button" "><i class="fa fa-arrow-left"></i> Go Back</a>
                
                </div>
              </div>
             
              <!-- /.row  form close-->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    
    <div class="col-md-3">
     <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title">Image</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
      
      <div class="box-body">
        
        <div class="form-group">
                                
                  <?php
                    if(file_exists($file))
                    {
                       $image = $file;
                    }else{
                      $image  =  NO_PHOTO_USER_IMAGE_DIR;
                    }
                  ?>
                   <div class="clerfix"></div>
                  <div class="col-md-12 centered">
                       <img style="margin-left:22px;" height="150" width="150" src="<?php echo  $image;?>" class="img-circle centered" alt="User Image">
                  </div>       
                  <h3 align="center"><?php echo $data['fname']." ".$data['lname'];?><br> <small>(<?php echo $data['username'];?>)</small></h3>           
                </div>
        
        <div class="form-group">
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
      </div>
      
      <?php } ?>
           </div>
        </div>
      </form>
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