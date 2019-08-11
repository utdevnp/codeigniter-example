<?php $this->load->view('inc/headerfiles');?>
<body  class="skin-blue sidebar-mini">
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
           <form method="POST" action="<?php echo base_url('control/companysetup/add');?>" enctype="multipart/form-data">    
            <div class="box-body">
                <div class="row">
                  <!--  content here -->
                  <div class="box-body">
                  
                  <div class="form-group col-md-6">
                    <label for="companyname">Seelct Your Involbe Bus Comittee</label>
                  <select name="comittee_id" class="form-control select2">
                    <option value="">Comittee </option>
                    <?php foreach($comittes as $com){?>
                      <option <?php if($this->input->post('comittee_id')==$com['id']){echo "selected";} ;?> value="<?php echo $com['id'];?>"><?php echo $com['name'];?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="clearfix"></div>

  		            <div class="form-group col-md-5">
  		              <label for="companyname">Company Name</label>
  		              <input type="text" name="name" class="form-control" id="companyname" placeholder=" Company Name">
  		            </div>
  		            <div class="form-group col-md-2">
  		              <label for="contactNO">Contact No</label>
  		              <input type="text" name="phone" class="form-control" id="contactNO" placeholder="Contact No">
  		            </div>
  		            <div class="form-group col-md-5">
  		              <label for="email">Email address</label>
  		              <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
  		            </div>
                  <div class="form-group col-md-4">
                    <label for="email"> Address</label>
                    <input type="address" name="address" class="form-control" id="email" placeholder="Enter email">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="totalbus">Register No</label>
                    <input type="text" name="register_no" class="form-control" id="totalbus" placeholder="Register No">
                  </div>
  		            
  		            <div class="form-group col-md-4">
  		              <label for="companyPresident">Company President</label>
  		              <input type="text" name="president" class="form-control" id="companyPresident" placeholder="President Of Company">
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
  		             <div class="form-group col-md-2">
                    <label for="companyPresident">image</label>
                     <?php if($this->session->userdata('errormessage')){
                              echo  $this->session->userdata('errormessage');
                              $this->session->unset_userdata('errormessage');
                        }
                      ?>
                    <input type="file" name="image" class="form-control" id="companyPresident" placeholder="Image">
                  </div>
  		           
  		          
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->

              <div class="col-md-12 pull-left" style="margin-bottom: 10px;">
                <a href="#set-the-reservation-<?php //echo $data['id'];?>"  data-toggle="collapse"><button  class="btn btn-success btn-sm btn-flat"><i class="fa fa-gears" ></i>Rules & Regulations Setup </button></a>
                 <!--  <a href="#comission<?php //echo $data['id'];?>"  data-toggle="collapse"><button  class="btn btn-success btn-sm btn-flat"><i class="fa fa-gears"></i>Set Counter Comission Setup </button></a></div> <div class="clearfix"> -->
                  
                </div>
               
                 <div  id="set-the-reservation-<?php //echo $data['id'];?>" class="collapse col-md-12">
               <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li  class="active"><a href="#reservation" data-toggle="tab"><strong> Reservation </strong></a></li>
                  <li><a href="#counter-charge" data-toggle="tab"><strong> Counter Charge  </strong></a></li>
                  <li><a href="#counter-comission" data-toggle="tab"><strong>  Comission </strong></a></li>
                  <li><a href="#conservartion-discount" data-toggle="tab"><strong> Discount  </strong></a></li>
                   <li><a href="#termandpolicy" data-toggle="tab"><strong> Term & Policy </strong></a></li>

                </ul>
                <div class="tab-content">

                
                  <div class="tab-pane active" id="reservation">
                
               
               <div class="row">
                <div class="form-group col-md-3">
                 <div class="col-md-12"> <label for="busTitle">Female  Seats </label></div>
                 <div calss="clearfix"></div>
                   <div class="col-md-7 pull-left">
                  <select name="female[]" class="form-control select2" style="width: 100%;">
                    <option value=""> Select sets </option>
                     <?php  $j=2; $i=1;
                     while($i<=20){
                     while($j<=$i+1){?>
                      <option  value="<?php echo $i.",".$j;?>"><?php echo $i." and ".$j;?></option>
                    <?php $j=$j+2;} $i=$i+2; }?>   
                  </select>
                </div>
                <div class="col-md-5 pull-left">
                      A<input type="radio" name="female[]" value="A" class="minimal">
                      B<input type="radio" name="female[]" value="B" class="minimal">
                  </div>
                </div>

                <div class="form-group col-md-3">
                 <div class="col-md-12"><label for="busTitle">student  Seats </label></div>
                 <div calss="clearfix"></div>
                   <div class="col-md-7 pull-left">
                  <select name="student[]" class="form-control select2" style="width: 100%;">
                    <option value=""> Select sets </option>
                     <?php  $j=2; $i=1;
                     while($i<=20){
                     while($j<=$i+1){?>
                      <option  value="<?php echo $i.",".$j;?>"><?php echo $i." and ".$j;?></option>
                    <?php $j=$j+2;} $i=$i+2; }?>   
                  </select>
                </div>
                <div class="col-md-5 pull-left">
                      A<input type="radio" name="student[]" value="A" class="minimal">
                      B<input type="radio" name="student[]" value="B" class="minimal">
                  </div>
                </div>

                 <div class="form-group col-md-3">
                 <div class="col-md-12"><label for="busTitle">Old Citizen  Seats </label></div>
                 <div calss="clearfix"></div>
                   <div class="col-md-7 pull-left">
                   <select name="old[]" class="form-control select2" style="width: 100%;">
                    <option value=""> Select sets </option>
                     <?php  $j=2; $i=1;
                     while($i<=20){
                     while($j<=$i+1){?>
                      <option  value="<?php echo $i.",".$j;?>"><?php echo $i." and ".$j;?></option>
                    <?php $j=$j+2;} $i=$i+2; }?>   
                  </select>
                </div>
                <div class="col-md-5 pull-left">
                      A<input type="radio" name="old[]" value="A" class="minimal">
                      B<input type="radio" name="old[]" value="B" class="minimal">
                  </div>
                </div>
                
                <div class="form-group col-md-3">
                <div class="col-md-12"> <label for="busTitle">Staff  Seats </label></div> 
                 <div calss="clearfix"></div>
                   <div class="col-md-7 pull-left">
                   <select name="staff[]" class="form-control select2" style="width: 100%;">
                    <option value=""> Select sets </option>
                     <?php  $j=2; $i=1;
                     while($i<=20){
                     while($j<=$i+1){?>
                      <option  value="<?php echo $i.",".$j; ?>" ><?php echo $i." and ".$j;?></option>
                    <?php $j=$j+2;} $i=$i+2; }?>   
                  </select>
               </div>
                <div class="col-md-5 pull-left">
                      A<input type="radio" name="staff[]" value="A" class="minimal">
                      B<input type="radio" name="staff[]" value="B" class="minimal">
                  </div>
                </div>
                 <div class="form-group col-md-3">
                 <div class="col-md-12"><label for="busTitle">Handicap Citizen  Seats </label></div>
                 <div calss="clearfix"></div>
                   <div class="col-md-7 pull-left">
                   <select name="handicap[]" class="form-control select2" style="width: 100%;">
                    <option value=""> Select sets </option>
                     <?php  $j=2; $i=1;
                     while($i<=20){
                     while($j<=$i+1){?>
                      <option  value="<?php echo $i.",".$j;?>"><?php echo $i." and ".$j;?></option>
                    <?php $j=$j+2;} $i=$i+2; }?>   
                  </select>
                </div>
                <div class="col-md-5 pull-left">
                      A<input type="radio" name="handicap[]" value="A" class="minimal">
                      B<input type="radio" name="handicap[]" value="B" class="minimal">
                  </div>
                </div>
 
               </div>
               </div>
               <!-- </div> -->
               <div class="tab-pane " id="counter-comission">
               <!--  <div  id="comission<?php //echo $data['id'];?>" class="collapse">  -->

               </div>
               <div class="tab-pane " id="counter-charge">
               <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle"> Miscellenous Expenses </label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                      <input type="number" name="ccharge[]"  value="<?php ?>" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
                 <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle"> Trip Fee </label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                    <div class="input-group-addon"><i>NPR</i> </div>
                      <input type="number" name="ccharge[]"  value="<?php  ?>" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
                 <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle"> Counter Expenses </label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                      <input type="number" name="ccharge[]"  value="<?php  ?>" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>

               </div>

               <div class="tab-pane " id="conservartion-discount">
               <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle"> Discount On Student Seats </label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                      <input type="number" name="reservationdis[]"  value="0" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
                 <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle">  Discount On Female Seats</label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                      <input type="number" name="reservationdis[]"  value="0" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle"> Discount On Handicap seat  </label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                      <input type="number" name="reservationdis[]"  value="0" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
                 <div class="form-group col-md-6"> 
                  <div class="clearfix"></div>
                   <div class="col-md-6"> <label for="busTitle"> Discount On Old Citizen Seats </label></div>
                   <div class="col-md-6">
                    <div class="input-group">
                      <input type="number" name="reservationdis[]"  value="0" class="form-control" id="ccharge" min="0" max="100" placeholder="00.00%">
                      <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
               </div>
               <div class="tab-pane " id="termandpolicy">
                <div class="clearfix"></div>
                 <div class="form-group col-md-12"> 
                  <div class="clearfix"></div>
                  <textarea class="terms" name="termandpolicy" placeholder="Terms And Policy" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="clearfix"></div>
                 <div class="form-group col-md-12"> 
                  <div class="clearfix"></div>
                  <textarea class="terms" name="cancellationpolicy" placeholder="Cancellation Policy" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="clearfix"></div>
               </div>
               </div>
               </div>
               </div>
             
               
               <div class="clearfix"></div>
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