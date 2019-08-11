

<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height:200px;">
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
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/bussetup/add');?>">
        <div class="col-md-9">
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
                  <!--  content here -->
                  <div class="box-body">
          		  
		            <div class="form-group col-md-4">
		              <label for="company">Bus No</label>
		              <input type="text"  name="bus_no" class="form-control" id="busNo" placeholder="NA 05 KHA 3454">
		            </div>
		             <div class="form-group col-md-4">
		              <label for="busTitle">Bus Name</label>
		              <select name="bus_name" class="form-control">
		              	<option value="">Select Bus name</option>
		              	<?php foreach($allbus as $bus){?>
		              		<option value="<?php echo $bus['id'];?>"><?php echo $bus['bus_name'];?></option>
		              	<?php } ?>
		              </select>
		            </div>
		             <div class="form-group col-md-4">
		              <label for="category">Bus Category</label>
		              <select name="bus_category" class="form-control">
		              	<option value="">Select Bus category</option>
		              	<?php foreach($allcat as $cat){?>
		              		<option value="<?php echo $cat['id'];?>"><?php echo $cat['title'];?></option>
		              	<?php } ?>
		              </select>
		            </div>
					<?php $utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
						foreach($utype as $ut){
							$utyps  = $ut['user_type'];
						}
						if($utyps=='admin'){?>
						<div class="form-group col-md-4">
						 <label for="companyname">Company</label>
						  <select name='company' class="form-control">
						  <option value="">Select A company </option>
						   <?php  foreach($allcom as $data){
								?>
									<option  value="<?php echo $data['id'];?>"><?php echo $data['name']; ?></option>
									<?php
							}
							 echo "</select>" 
						?>
						</div>
					<?php }?>
		            
		            <div class="form-group col-md-4">
		              <label for="mobileNo">Owner Name</label>
		              <input type="text" name="owner" class="form-control" id="mobileNo" placeholder="Mobile No">
		            </div>
		            <div class="form-group col-md-4">
		              <label for="mobileNo">Mobile NO</label>
		              <input type="text" name="mobile_no" class="form-control" id="mobileNo" placeholder="Mobile No">
		            </div>
		            <div class="form-group col-md-4">
		              <label for="drivername">Driver Name</label>
		              <input type="text" name="driver_name" class="form-control" id="drivername" placeholder="Operator Name">
		            </div>
		             <div class="form-group col-md-4">
		              <label for="drivercontact">Driver Contact No</label>
		              <input type="text" name="driver_mobile_no" class="form-control" id="drivercontact" placeholder="Driver contact">
		            </div>
		             <div class="form-group col-md-4">
		              <label for="email">Email Address</label>
		              <input type="email" name="email" class="form-control" id="company" placeholder="Email">
		            </div>
                <div class="clerfix"></div>
					<div class="row">
                      <div class="col-md-12">
						<div class="form-group col-md-12">
							<label for="bustype">Bus Type </label>
						</div>
					  </div>
                      <div class="row  col-md-12">
                      <div class="form-group col-md-3"> 
                          <div class="col-md-12 selecttype"><button type="button" ng-click="page='bus'"><img src="<?php echo STATIC_IMG_DIR.'/bus.png'; ?>" style="height: 66px; width: 110px;"></button></div> <br>
                      </div>
                     <div class="form-group col-md-3"> 
                         <div class="col-md-12 selecttype"><button type="button" ng-click="page='hice'"><img src="<?php echo STATIC_IMG_DIR.'/hiace.png'; ?>" style="height: 66px; width: 110px;"></button></div>
                     </div>
                     <div class="form-group col-md-3">
                       <div class="col-md-12 selecttype"><button type="button" ng-click="page='force'"><img src="<?php echo STATIC_IMG_DIR.'/force.png'; ?>" style="height: 66px; width: 110px;"></button></div>
                     </div>
                      <div class="form-group col-md-3">
                        <div class="col-md-12 selecttype"><button type="button" ng-click="page='sumo'"><img src="<?php echo STATIC_IMG_DIR.'/sumo.png'; ?>"  style="height: 66px; width: 110px;"></button></div>
                      </div>
                     </div>
					</div>
					 <div class="row col-md-12">
                       <div ng-switch on="page">
                      <div ng-switch-default="bus">
                        <input type="hidden" name="type" value="bus">
                         <div class="clerfix"></div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in A Side</label>
                          <select name="total_sheet_in_a_side" class="form-control">
                            <option value="">Total sheet In A Side</option>
                            <?php for($i=2;$i<=18; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in B Side</label>
                          <select name="total_sheet_in_b_side" class="form-control">
                            <option value="">Total sheet In B Side</option>
                            <?php for($i=1;$i<=18; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Last Row</label>
                          <select name="last_row" class="form-control">
                            <option value="">Total sheet In B Side</option>
                            <?php for($i=1;$i<=7; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-3">
                          <label for="sheet">Cabin </label>
                          <select name="cabin" class="form-control">
                            <option value="">Cabin sheet </option>
                            <?php for($i=1;$i<=5; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-3">
                          <label for="sheet">Special </label>
                          <select name="special" class="form-control">
                            <option value="">Special Seats </option>
                            <?php for($i=1;$i<=2; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>


                      </div>
                     <div ng-switch-when="hice">
                        <input type="hidden" name="type" value="hice">
                        <div class="clerfix"></div>
                         <div class="form-group col-md-4">
                          <label for="hice[]">Fornt Sheet  </label>
                          <select name="hice[]" class="form-control">
                            <option value="0">Front Seats</option>
                            <?php for($i=1;$i<=3; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in A </label>
                          <select name="hice[]" class="form-control">
                            <option value="0">Total sheet In A</option>
                            <?php for($i=1;$i<=5; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in B</label>
                          <select name="hice[]" class="form-control">
                            <option value="0">Total sheet B</option>
                            <?php for($i=1;$i<=4; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in C </label>
                          <select name="hice[]" class="form-control">
                            <option value="0">Cabin sheet </option>
                            <?php for($i=1;$i<=4; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sheet">Tatal Last Sheet</label>
                          <select name="hice[]" class="form-control">
                            <option value="0">Last Seats </option>
                            <?php for($i=1;$i<=4; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                      </div>
                      <div ng-switch-when="force">
                         <input type="hidden" name="type" value="force">
                          <div class="clerfix"></div>
                          <div class="form-group col-md-4">
                          <label for="sheet">Fornt seats</label>
                          <select name="force[]" class="form-control">
                            <option value="0">Cabin sheet </option>
                            <?php for($i=1;$i<=5; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in A Side</label>
                          <select name="force[]" class="form-control">
                            <option value="0">Total sheet In A Side</option>
                            <?php for($i=1;$i<=40; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in B Side</label>
                          <select name="force[]" class="form-control">
                            <option value="0">Total sheet In B Side</option>
                            <?php for($i=1;$i<=40; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sheet">Last Row</label>
                          <select name="force[]" class="form-control">
                            <option value="0">Last Row </option>
                            <?php for($i=1;$i<=7; $i++){?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                      </div>
                      <div ng-switch-when="sumo">
                           <input type="hidden" name="type" value="sumo">
                      </div>
                  </div>

                    </div>
                

		            <div class="form-group col-md-2">
                    <label>Active</label>
                    <?php 
                        $arr =array('Y'=>'Yes','N'=>'No');
                        ?>
                        <select class="form-control" name="is_active">
                        <?php
                        foreach($arr as $k=>$v)
                          {
                            if(isset($_POST['is_active'])==$k)
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
              </div>

              <div class="box-footer">
                <div class="row">
                  <!-- // buttons -->
                  <div class="form-group col-md-4">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Save</button>
                    <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</button>
                  </div>
                </div>
                <!-- /.row -->
              </div>
          	</div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="col-md-3">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> Bus Image</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            
              <div class="box-body">
                <div class="row">
                  <!--  content here -->
                  <div class="box-body">
                  <div class="form-group col-md-12">
                   <div class="clerfix"></div>
                  <div class="col-md-12 centered">
                       <img style="margin-left:22px;" height="150" width="150" src="<?php echo  NO_PHOTO_USER_IMAGE_DIR;?>" class="img-circle centered" alt="User Image">
                  </div>
	              <label for="company"></label>
	              <input type="file" name="bus_image" class="form-control" id="busNo" placeholder="Bus No">
	            </div>
                
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
              <div class="box-footer">
                <div class="row">
                  <!-- // buttons -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-footer -->
            </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </form>
     

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