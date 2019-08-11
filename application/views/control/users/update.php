
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
              <h3 class="box-title"><?php echo $title;?> <small>Basic Info</small></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
              <form ng-controller="ValidationCtrl" method="post" enctype="multipart/form-data" action="<?php echo base_url('control/users/update/'.$this->uri->segment(4))?>"  name="userForm" novalidate>
            <!-- /.box-header -->
            <?php foreach($row as $data){ ;
              $file = './uploads/users/'.$data['userfile'];

              ?>
            <div class="box-body">
              <div class="row">
                
                <!--  content here and form here -->
                <input type="hidden" value="<?php echo $data['user'] ;?>" name="user">
                <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="company">First Name <span class="stricts"> * </span></label>
                  <input type="text" value="<?php echo $data['fname'] ;?>" ng-model="fname" required class="form-control" name="fname" id="fname" placeholder="First Name">
					<vmessage class="error" ng-show="userForm.fname.$dirty && userForm.fname.$invalid">
					  <small ng-show="userForm.fname.$error.required">First name is required</small>
					</vmessage>
				</div>
                <div class="form-group col-md-4">
                  <label for="companyname">Last Name <span class="stricts"> * </span></label>
                  <input type="text" value="<?php echo $data['lname'] ;?>" ng-model="lname" class="form-control" id="lname" name="lname" placeholder="Last Name">
				  <vmessage class="error" ng-show="userForm.lname.$dirty && userForm.lname.$invalid">
					  <small ng-show="userForm.lname.$error.required">Last name is required</small>
				 </vmessage>
				</div>
          <div class="form-group col-md-4">
                  <label for="companyname">Permanent Address</label>
                  <input type="text" value="<?php echo $data['permanent_addr'] ;?>" class="form-control" id="permanent_addr" name="permanent_addr" placeholder="Pernament Address">
                </div>
          <div class="form-group col-md-4">
                  <label for="companyname">Temporary Address</label>
                  <input type="text" value="<?php echo $data['temp_addr'] ;?>" class="form-control" id="temp_addr" name="temp_addr" placeholder="Temporary Address">
                </div>
          <div class="form-group col-md-4">
                  <label for="companyname">Street <span class="stricts"> * </span></label>
                  <input type="text"  value="<?php echo $data['street'] ;?>" class="form-control" id="street" name="street" placeholder="Street">
                </div>
          <div class="form-group col-md-4">
                  <label for="companyname">Mobile Num <span class="stricts"> * </span></label>
                  <input type="text" value="<?php echo $data['mobile_num'];?>" class="form-control" id="mobile_num" name="mobile_num" placeholder="Mobile Number">
                </div>
          <div class="form-group col-md-4">
                  <label for="companyname">Phone Number</label>
                  <input type="text" value="<?php echo $data['phone'] ;?>" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
          <div class="form-group col-md-4">
                  <label for="companyname">Email <span class="stricts"> * </span></label>
                  <input type="email" value="<?php echo $data['email'] ;?>" class="form-control" id="email" name="email" placeholder="Email">
                </div>
          
          <div class="form-group col-md-4">
                  <label for="companyname">Date of Birth</label>
                  <input type="text" value="<?php echo $data['dob'] ;?>" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
                </div>

                 <div class="form-group col-md-4">
                    <label>User Type</label>
                       <?php 
                       foreach($userdetail as $usertype)
                       {
                       if($usertype['user_type'] == 'company'){
                            $arr =array('counter'=>'Counter','staff'=>'Staff');
                          }else if($usertype['user_type'] == 'counter'){
                             $arr =array('staff'=>'Staff');
                          }else if($usertype['user_type'] == 'admin'){
                            $arr =array('admin'=>'Admin','counter'=>'Counter','company'=>'Company','staff'=>'Staff');
                          }

                        }
                        ?>
                        <select class="form-control" name="user_type">
                        <?php
                        foreach($arr as $k=>$v)
                          {
                            if($data['user_type']==$k)
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
             
              <!-- /.row and  -->
            </div>
            <!-- ./box-body -->
      <div class="box-body">
              <div class="row">
        <hr>
          <div class="form-group col-md-4">
                  <label for="companyname">Username <span class="stricts"> * </span></label>
                  <input type="text" class="form-control" id="username" value="<?php echo $data['username'] ;?>" name="username" placeholder="Username">
                </div>
          <div class="form-group col-md-4">
                  <label for="companyname">Password <span class="stricts"> * </span></label>
                  <br>
                  <a href="<?php echo ADMIN_BASE.'users/changepassword/'.$data['id'];?>" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-key"></i> Change Password</a>
                </div>
        </div>
        </div>
            <div class="box-footer">
              <div class="row">
                <!-- // buttons -->
                 <div class="form-group col-md-4">
                 <button  class="btn btn-success btn-sm btn-flat" type="submit" name="updatebtn" value="updatebtn"><i class="fa fa-floppy-o"></i> Save & Update</button>
                 <button class="btn btn-danger btn-sm btn-flat" type="reset" "><i class="fa fa-refresh"></i> Reset</button>
                
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
                  <div class="clerfix"></div><br>
                
                  <input class="btn btn-info btn-sm" id="ext" type="file" name="userfile"><br>
                  <?php if($this->session->userdata('errormessage')){ echo $this->session->userdata('errormessage'); $this->session->unset_userdata('errormessage'); } ?>
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