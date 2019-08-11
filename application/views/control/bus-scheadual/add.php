

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
    <!-- Main content -->
    <section class="content">

      <div class="row">
      <form method="POST" role="form" autocomplete="off"  name="userForm" enctype="multipart/form-data" action="<?php echo base_url('control/busscheadual/add');?>">
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
            
              <div class="box-body">
                <div class="row">
                  <!--  content here -->
                  <div class="box-body">
                <?php $utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
						foreach($utype as $ut){
							$utyps  = $ut['user_type'];
						}
						if($utyps=='admin'){?>
						<div class="form-group col-md-6">
						 <label for="companyname">Company</label>
						  <select name='company' class="form-control">
						  <option value=""> Select A Company </option>
						   <?php  foreach($allcom as $data){
								?>
									<option  value="<?php echo $data['id'];?>"><?php echo $data['name']; ?></option>
									<?php
							}
							 echo "</select>" 
						?>
						</div>
					<?php }?>
					<div class="clearfix"> </div>
                <div class="form-group col-md-4">
                  <label for="busTitle">Bus No</label>
                  <select name="bus_no" class="form-control select2" style="width: 100%;">
                    <option value="">Select Bus</option>
                    <?php foreach($busno as $bus){?>
                      <option value="<?php echo $bus['id'];?>"><?php echo $bus['bus_no'];?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="busTitle">Departure Date</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="departure" value="<?php echo date('Y-m-d');?>"  class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>

                <div class="form-group col-md-2">
                <label>Departure Time </label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                  <input type="text" name="departuretime" value="" class="form-control timepicker">
                  </div>
                  </div>
                </div>

                 <div class="form-group col-md-2">
                  <label for="busTitle">Arrival Date</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="arrival" value="<?php  echo date('Y-m-d',strtotime("+1 day"));?>"  class="form-control pull-right datepicker" id="reservationtime">
                  </div>
                </div>
                
                <div class="form-group col-md-2">
                <label>Arrival Time </label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                    <input type="text" name="arrivaltime" class="form-control timepicker">
                  </div>
                  </div>
                </div>

                 <div class="form-group col-md-4">
                  <label for="busTitle">Departure</label>
                  <select name="from" class="form-control select2" style="width: 100%;">
                    <option value="">Select Departure</option>
                     <?php foreach($routs as $rot){?>
                      <option  value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>   
                  </select>
                </div>
                 <div class="form-group col-md-4">
                  <label for="category"> Destination </label>
                  <select name="to" class="form-control select2" style="width: 100%;">
                    <option value="">Select Destination</option>
                    <?php foreach($routs as $rot){?>
                       <option  value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>   
                  </select>
                </div>
              
                
                <div class="form-group col-md-2">
                    <label>Shift</label>
                    <?php 
                        $arr =array('day'=>'Day','night'=>'Night');
                        ?>
                        <select class="form-control" name="shift">
                        <?php
                        foreach($arr as $k=>$v)
                          {
                            if(isset($_POST['shift'])==$k)
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

                  <div class="clearfix"></div>

                  <hr class="">
                  <div ng-app="">
                <div class="form-group col-md-3">
                <label>Grand Fare</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><b>NPR</b> </div>
                  <input type="text"  ng-maxlength="10" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" ng-init="a=0" ng-model="a" name="fare" value="0"   class="form-control">
                  </div>
                  </div>
                </div>

                <div class="form-group col-md-3">
                <label>Discount</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                  <input type="number" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/"  ng-init="b=0" ng-model="b" name="discount" value="0"   class="form-control">
                  </div>
                  </div>
                </div>
                <div class="form-group col-md-3">
                <label>Net fare</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><b>NPR</b> </div>
                  <input type="number" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" readonly="readonly"  name="netfare" value="{{ (a - (a * b / 100)) }}"   class="form-control">
                  </div>
                  </div>
                </div>
               
                <div class="clearfix"></div>
                 <hr>

                
			<div class="clearfix"></div>
            <div class="form-group col-md-6">
                   <label>Boarding Points</label>
                  </div>
                   <div class="form-group col-md-3">
                <label>Boarding Times</label>
                </div>

                <div class="clearfix"></div>
                <div ng-app="angularjs-starter" ng-controller="MainCtrl" >
           <fieldset  data-ng-repeat="choice in choices">
               <div class="form-group col-md-6" ng-controller="MultipleAddCtrl">
                <select class="form-control" class="selectp" name="boardingpoint[]" select2s ng-model="var2">
                  <?php foreach($routs as $rot){?>
                      <option ng-value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>  
                </select>
              </div>
            
             <div class="form-group col-md-3">
                <div class="bootstrap-timepicker" ng-controller="MultipleAddCtrl">
                  <div class="input-group" class="date">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                    <input data-format="hh:mm:ss"  id="input1" datetimez ng-model="var1" type="text"  name="boardingtime[]"  class="form-control timepicker">
                  </div>
                </div>
            </div>
              
              <div class="form-group col-md-2">
                <button  class="remove btn btn-danger btn-sm btn-flat"  ng-show="$last" ng-click="removeBoarding()">-</button>
              </div>
           </fieldset>

           <div class="clearfix"></div>
             <div class="form-group col-md-12">
             <input type="button" class="btn btn-primary btn-sm btn-flat" ng-click="addNewBoarding()" value="Add Boarding Point">
          </div>
        </div>
  </div>
               <div class="clearfix"></div>
               <hr>
            <div class="form-group col-md-6">
                   <label>Dropping Points</label>
                  </div>
                   <div class="form-group col-md-3">
                <label>Dropping Times</label>
                </div>

                <div class="clearfix"></div>
                <div ng-app="angularjs-starter" ng-controller="MainCtrl">
           <fieldset  data-ng-repeat="choice in choices">
               <div class="form-group col-md-6" ng-controller="MultipleAddCtrl">
                <select class="form-control" name="droppingpoint[]" class="selectp" select2s ng-model="var2">
                  <?php foreach($routs as $rot){?>
                      <option ng-value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>  
                </select>
              </div>
            
             <div class="form-group col-md-3">
              <div class="bootstrap-timepicker" ng-controller="MultipleAddCtrl">
                  <div class="input-group" class="date" >
                  <div class="input-group-addon add-on"><i class="fa fa-clock-o"></i> </div>
                    <input data-format="hh:mm:ss"  type="text" datetimez ng-model="var1"  name="droppingtime[]"  class="form-control timepicker">
                  </div>
                </div>
            </div>
              
              <div class="form-group col-md-2">
                <button class="remove btn btn-danger btn-sm btn-flat"  ng-show="$last" ng-click="removeBoarding()">-</button>
              </div>
           </fieldset>

           <div class="clearfix"></div>
             <div class="form-group col-md-12">
             <input type="button" class="btn btn-info btn-sm btn-flat" ng-click="addNewBoarding()" value="Add Dropping Point">
          </div>
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