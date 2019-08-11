

<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 916px;">
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
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/bussetup/update/'.$this->uri->segment(4));?>">
        <?php foreach($row as $a){
          $type = $a['type'];
          $forces = $a['forces'];
          $hices = $a['hices'];
        $file = BUS_IMAGE_DIR.$a['bus_image'];
                          if(file_exists($file))
                          {
                            $image =  $file;
                          }else{
                            $image = NO_COMPANY_LOGO_IMG_DIR;
                          }
                          ?>
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
		              <input type="text" name="bus_no" value="<?php echo $a['bus_no'];?>" class="form-control" id="busNo" placeholder="Bus No">
		            </div>
		             <div class="form-group col-md-4">
		              <label for="busTitle">Bus Name</label>

		              <select name="bus_name" class="form-control">
                    <option value="">Select Bus name</option>
                    <?php foreach($allbus as $bus){?>
                      <option value="<?php echo $bus['id'];?>" <?php if($bus['id']==$a['bus_name']){echo 'selected';}?>><?php echo $bus['bus_name'];?><?php if($bus['id']==$a['bus_name']){echo '*';}?></option>
                    <?php } ?>
                  </select>
		            </div>
		             <div class="form-group col-md-4">
		              <label for="category">Bus Category</label>
		              <select name="bus_category" class="form-control">
		              	<option value="">Select Bus category</option>
		              	<?php foreach($allcat as $cat){?>
		              		<option value="<?php echo $cat['id'];?>"<?php if($cat['id']==$a['bus_category']){echo 'selected';}?>><?php echo $cat['title'];?><?php if($cat['id']==$a['bus_category']){echo '*';}?></option>
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
									<option  value="<?php echo $data['id'];?>"<?php if($a['company']==$data['id']){echo "selected";}?>><?php echo $data['name']; ?><?php if($a['company']==$data['id']){echo "*";}?></option>
									<?php
							}
							 echo "</select>" 
						?>
						</div>
					<?php }?>
		            
		            <div class="form-group col-md-4">
		              <label for="mobileNo">Owner Name</label>
		              <input type="text" name="owner" value="<?php echo $a['owner'];?>" class="form-control" id="mobileNo" placeholder="Mobile No">
		            </div>
		            <div class="form-group col-md-4">
		              <label for="mobileNo">Mobile NO</label>
		              <input type="text" name="mobile_no" value="<?php echo $a['mobile_no'];?>" class="form-control" id="mobileNo" placeholder="Mobile No">
		            </div>
		            <div class="form-group col-md-4">
		              <label for="drivername">Driver Name</label>
		              <input type="text" name="driver_name" value="<?php echo $a['driver_name'];?>" class="form-control" id="drivername" placeholder="Operator Name">
		            </div>
		             <div class="form-group col-md-4">
		              <label for="drivercontact">Driver Contact No</label>
		              <input type="text" name="driver_mobile_no" value="<?php echo $a['driver_mobile_no'];?>" class="form-control" id="drivercontact" placeholder="Driver contact">
		            </div>
		             <div class="form-group col-md-4">
		              <label for="email">Email Address</label>
		              <input type="email" name="email" value="<?php echo $a['email'];?>" class="form-control" id="company" placeholder="Email">
		            </div>
                <div class="clearfix"></div>
                <div class=" row form-group col-md-12">
                      <div class="col-md-12">
                      <label for="bustype">Bus Type </label>
                      </div>
                      <div class="row  col-md-12">

                      <div class="form-group col-md-3"> 
                         
                          <div class="col-md-12"><button type="button"  ng-click="page='bus'"><img src="<?php echo STATIC_IMG_DIR.'/bus.png'; ?>" style="height: 66px; width: 110px;"></button></div> <br>
                           
                      </div>
                     <div class="form-group col-md-3"> 
                         
                         <div class="col-md-12"><button type="button" ng-click="page='hice'"><img src="<?php echo STATIC_IMG_DIR.'/hiace.png'; ?>" style="height: 66px; width: 110px;" ></button></div>
                        
                     </div>
                     <div class="form-group col-md-3">
                       
                       <div class="col-md-12"><button type="button"  ng-click="page='force'"><img src="<?php echo STATIC_IMG_DIR.'/force.png'; ?>" style="height: 66px; width: 110px;"></button></div>
                       
                     </div>
                      <div class="form-group col-md-3">
                        
                        <div class="col-md-12"><button type="button"  ng-click="page='sumo'"><img src="<?php echo STATIC_IMG_DIR.'/sumo.png'; ?>"  style="height: 66px; width: 110px;"></button></div>
                      </div>
                     </div>
                       <div ng-switch on="page">
                       <?php if($type == "bus"){?>
                      <div ng-switch-when="bus">
                       <input type="hidden" name="type" value="bus">
                        <div class="form-group col-md-4">
                  <label for="sheet">Tatal Sheet in A Side</label>
                  <select name="total_sheet_in_a_side" class="form-control">
                    <option value="">Total sheet In A Side</option>
                    <?php for($i=1;$i<=18; $i++){?>
                      <option value="<?php echo $i;?>" <?php if($i==$a['total_sheet_in_a_side']){echo 'selected';}?>><?php echo $i;?><?php if($i==$a['total_sheet_in_a_side']){echo '*';}?></option>
                    <?php } ?>
                  </select>
                </div>

                 <div class="form-group col-md-4">
                  <label for="sheet">Tatal Sheet in B Side</label>
                  <select name="total_sheet_in_b_side" class="form-control">
                    <option value="">Total sheet In B Side</option>
                    <?php for($i=1;$i<=18; $i++){?>
                      <option value="<?php echo $i;?>"<?php if($i==$a['total_sheet_in_b_side']){echo 'selected';}?>><?php echo $i;?><?php if($i==$a['total_sheet_in_b_side']){echo '*';}?></option>
                    <?php } ?>
                  </select>
         
                </div>


                <div class="form-group col-md-3">
                  <label for="sheet">Last Row</label>
                  <select name="last_row" class="form-control">
                    <option value="0">Last Row</option>
                    <?php for($i=1;$i<=7; $i++){?>
                      <option value="<?php echo $i;?>"<?php if($i==$a['last_row']){echo 'selected';}?>><?php echo $i;?><?php if($i==$a['last_row']){echo '*';}?></option>
                    <?php } ?>
                  </select>
         
                </div>
                <div class="form-group col-md-3">
                  <label for="sheet">Cabin seats</label>
                  <select name="cabin" class="form-control">
                    <option value="0">Cabin Seats</option>
                    <?php for($i=1;$i<=5; $i++){?>
                      <option value="<?php echo $i;?>"<?php if($i==$a['cabin']){echo 'selected';}?>><?php echo $i;?><?php if($i==$a['cabin']){echo '*';}?></option>
                    <?php } ?>
                  </select>
         
                </div>
                <div class="form-group col-md-3">
                  <label for="sheet">Special seats</label>
                  <select name="special" class="form-control">
                    <option value="0">Special Seats</option>
                    <?php for($i=1;$i<=2; $i++){?>
                      <option value="<?php echo $i;?>"<?php if($i==$a['special']){echo 'selected';}?>><?php echo $i;?><?php if($i==$a['special']){echo '*';}?></option>
                    <?php } ?>
                  </select>
         
                </div>

                </div>
                <?php } else if($type=="hice"){
                  $sets =  explode(',', $hices)
                  ?>
                <div ng-switch-when="hice">
                        <input type="hidden" name="type" value="hice">
                        <div class="clerfix"></div>
                         <div class="form-group col-md-4">
                          <label for="hice[]">Fornt Sheet  </label>
                          <select name="fornt-Seat" class="form-control">
                            <option value="">Front Seats</option>
                            <?php for($i=1;$i<=3; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$seats[0]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$seats[0]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in A </label>
                          <select name="hice[]" class="form-control">
                            <option value="">Total sheet In A</option>
                            <?php for($i=1;$i<=5; $i++){?>
                              <option value="<?php echo $i;?>" <?php if($i==@$seats[1]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$seats[1]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in B</label>
                          <select name="hice[]" class="form-control">
                            <option value="">Total sheet B</option>
                            <?php for($i=1;$i<=4; $i++){?>
                              <option value="<?php echo $i;?>" <?php if($i==@$seats[2]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$seats[2]){ echo 'selected';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in C </label>
                          <select name="hice[]" class="form-control">
                            <option value="">Cabin sheet </option>
                            <?php for($i=1;$i<=4; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$seats[0]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$seats[3]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sheet">Tatal Last Sheet</label>
                          <select name="hice[]" class="form-control">
                            <option value="">Last Seats </option>
                            <?php for($i=1;$i<=4; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$seats[3]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$seats[3]){ echo 'selected';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                      </div>
                      <?php } else if($type=="force"){
                        $forceseats = explode(',', $forces);
                        ?>
                      <div ng-switch-when="force">
                         <input type="hidden" name="type" value="force">
                          <div class="clerfix"></div>

                          <div class="form-group col-md-4">
                          <label for="sheet">Fornt seats</label>
                          <select name="force[]" class="form-control">
                            <option value="">Cabin sheet </option>
                            <?php for($i=1;$i<=5; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$forceseats[0]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$forceseats[0]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in A Side</label>
                          <select name="force[]" class="form-control">
                            <option value="">Total sheet In A Side</option>
                            <?php for($i=1;$i<=40; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$forceseats[1]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$forceseats[1]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                        </div>

                         <div class="form-group col-md-4">
                          <label for="sheet">Tatal Sheet in B Side</label>
                          <select name="force[]" class="form-control">
                            <option value="">Total sheet In B Side</option>
                            <?php for($i=1;$i<=40; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$forceseats[2]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$forceseats[2]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                        <div class="form-group col-md-4">
                          <label for="sheet">Last Row</label>
                          <select name="force[]" class="form-control">
                            <option value="">Total sheet In B Side</option>
                            <?php for($i=1;$i<=7; $i++){?>
                              <option value="<?php echo $i;?>"<?php if($i==@$forceseats[3]){ echo 'selected';}?>><?php echo $i;?><?php if($i==@$forceseats[3]){ echo '*';}?></option>
                            <?php } ?>
                          </select>
                 
                        </div>
                      </div>
                      <?php } else { ?>
                      <div ng-switch-when="sumo">
                           <input type="hidden" name="type" value="sumo">
                      </div>
                      <?php }?>
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
                            if($a['is_active']==$k)
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
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Save & Update</button>
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
              <h3 class="box-title">Image</h3>
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
                 <div class="col-md-12 centered busimages">
                       <img src="<?php echo  $image;?>" class="centered img-responsive" alt="User Image">
                  </div>
                  <div class="clearfix"></div>
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
       <?php } ?>
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