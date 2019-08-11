

<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 0px;">
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
     <section class="content">

      <div class="row">
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/offersetup/update/'.$this->uri->segment(4));?>">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <?php $this->load->view('control/inc/validation');?>
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
                  <?php foreach($row as $data){?>
                
                <div class="form-group col-md-7">
                <label>Offer Title </label>
                  <input type="text"  name="offer_title"  value="<?php echo $data['offer_title'];?>"   class="form-control">
                </div>
				<?php $utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
						foreach($utype as $ut){
							$utyps  = $ut['user_type'];
						}
						if($utyps=='admin'){?>
						<div class="form-group col-md-5">
						 <label for="companyname">Company</label>
						  <select name='company' class="form-control">
						  <option value=""> Select A Company </option>
						   <?php  foreach($allcom as $cmp){
								?>
									<option  value="<?php echo $cmp['id'];?>"<?php if($cmp['id']==$data['company']){echo "selected";}?> > <?php echo $cmp['name']; ?> <?php if($cmp['id']==$data['company']){echo  "*";}?></option>
									<?php
							}
							 echo "</select>";
						?>
						</div>
					<?php }?>
				<div class="form-group col-md-12"> 
				<label for="companyname">Description</label>
					  <div class="clearfix"></div>
					  <textarea class="terms" name="detail" placeholder="Description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
                <div class="form-group col-md-4">
                  <label for="category">Bus Category</label>
                  <select name="category" class="form-control">
                    <option value="">Select Bus category</option>
                    <?php foreach($allcat as $cat){?>
                      <option value="<?php echo $cat['id'];?>"<?php if($cat['id']==$data['category']){echo 'selected';}?>><?php echo $cat['title'];?><?php if($cat['id']==$data['category']){echo '*';}?></option>
                    <?php } ?>
                  </select>
                </div>
				
				
                <div class="form-group col-md-4">
                  <label for="busTitle">Offer Start</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="offer_from" value="<?php echo $data['offer_from'];?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>

               
                 <div class="form-group col-md-4">
                  <label for="busTitle">Offer End</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="offer_to" value="<?php  echo $data['offer_to'];?>"  class="form-control pull-right datepicker" id="reservationtime">
                  </div>
                </div>
                
                

                  <div class="clearfix"></div>

                  <hr class="horizentaline">
                  <div ng-app="">
                
                <div class="form-group col-md-3">
                <label>Discount</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                
                  <input type="number"  ng-model="b" name="offer_discount" value="<?php echo $data['offer_discount'];?>"  ng-init="b=<?php echo $data['offer_discount'];?>" class="form-control">
                    <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                  </div>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-3">
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

                <?php } ?>
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