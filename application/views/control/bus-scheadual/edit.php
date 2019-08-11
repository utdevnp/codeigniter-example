

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
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/busscheadual/update/'.$this->uri->segment(4));?>">
        <div class="col-md-12">
         <?php $this->load->view('control/inc/validation');?>
         <?php $this->load->view('control/inc/message');?>
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
            <?php foreach($bussch as $data){   
                  $selected = explode(",",$data['boardingpoint']);
              ?>
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
						   <?php  foreach($allcom as $cm){
								?>
									<option  value="<?php echo $cm['id'];?>"<?php if($cm['id']==$data['company']){echo "selected";}?>><?php echo $cm['name']; ?><?php if($cm['id']==$data['company']){echo "*";}?></option>
									<?php
							}
							 echo "</select>" 
						?>
						</div>
					<?php }?>
					 <div class="clearfix"></div>
                <div class="form-group col-md-4">
                  <label for="busTitle">Bus No</label>
                  <select name="bus_no" class="form-control select2" style="width: 100%;">
                    <option value="">Select Bus</option>
                    <?php foreach($busno as $bus){?>
                      <option value="<?php echo $bus['id'];?>"<?php if($data['bus_no']==$bus['id']){echo 'selected';}?>><?php echo $bus['bus_no'];?><?php if($data['bus_no']==$bus['id']){echo '*';}?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="busTitle">Departure Date</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar "></i>
                    </div>
                    <input type="text" name="departure" value="<?php echo $data['departure'];?>" class="form-control pull-right datepickerdest " id="reservationtime">
                  </div>
                </div>
                <div class="form-group col-md-2">
                <label>Departure Time :</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                    <input type="text" name="departuretime" value="<?php echo $data['departuretime'];?>" class="form-control timepicker">
                  </div>
                  </div>
                </div>

                 <div class="form-group col-md-2">
                  <label for="busTitle">Arrival Date</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="arrival" value="<?php echo $data['arrival'];?>" class="form-control pull-right datepicker" id="reservationtime">
                  </div>
                </div>
                <div class="form-group col-md-2">
                <label>Arrival Time :</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                    <input type="text" name="arrivaltime" value="<?php echo $data['arrivaltime'];?>" class="form-control timepicker">
                  </div>
                  </div>
                </div>

                 <div class="form-group col-md-4">
                  <label for="busTitle">Departure</label>
                  <select name="from" class="form-control select2" style="width: 100%;">
                    <option value="0">Select Departure</option>
                     <?php 
                    foreach($routs as $rot){?>
                      <option  value="<?php echo $rot['id'];?>" <?php if($rot['id']==$data['from']){echo "selected";} ?> class=""><?php if($rot['id']==$data['from']){echo "*";} ?> <?php echo $rot['from'];?></option>
                    <?php } ?>    
                  </select>
                </div>
                 <div class="form-group col-md-4">
                  <label for="category"> Destination </label>
                  <select name="to" class="form-control select2" style="width: 100%;">
                    <option value="">Select Destination</option>
                    <?php 
                    foreach($routs as $rot){?>
                      <option  value="<?php echo $rot['id'];?>" <?php if($rot['id']==$data['to']){echo "selected";} ?> class=""><?php if($rot['id']==$data['to']){echo "*";} ?> <?php echo $rot['from'];?></option>
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
                            if($data['shift']==$k)
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



                    <div class="clearfix"></div>

                  <hr>
                <div class="form-group col-md-3">
                <label>Grand Fare</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><b>NPR</b> </div>
                  <input type="number" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" ng-model="fare"  name="fare" ng-init="fare=<?php echo $data['fare'];?>"  class="form-control">
                  </div>
                  </div>
                </div>

                <div class="form-group col-md-3">
                <label>Discount</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-percent"></i> </div>
                  <input type="number" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/"  ng-model="discount" ng-init="discount=<?php echo $data['discount'];?>"  name="discount"    class="form-control">
                  </div>
                  </div>
                </div>
                <div class="form-group col-md-3">
                <label>Net fare</label>
                  <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><b>NPR</b> </div>
                  <input type="number" ng-pattern="/^\d{0,9}(\.\d{1,9})?$/" readonly="readonly"  name="netfare" value="{{ fare - fare * discount / 100 }}"   class="form-control">
                  </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                 <hr>

                  <div class="form-group col-md-6">
                   <label>Boarding Points</label>
                  </div>
                   <div class="form-group col-md-3">
                <label>Boarding Times</label>
                </div>
                <div cont="subACtrl">
                    <?php //echo $data['boardingpoint'];
                  $selectedbpoint   = explode(',',$data['boardingpoint']);
                  $selectedtime   = explode(',',$data['boardingtime']);
                  $counter = count($selectedbpoint);
                 for($i=0;$i< $counter; $i++)
                 //foreach($val as $count)
                 {
                ?>
               
                <div remove-me>
                <div class="form-group col-md-6">
                <select class="form-control" name="boardingpoint[]">
                  <?php foreach($routs as $rot){?>
                      <option <?php if($rot['id']==$selectedbpoint[$i]){echo "selected";}?> value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?> <?php if($rot['id']==$selectedbpoint[$i]){echo "*";}?></option>
                    <?php } ?>  
                </select>
              </div>

              <div class="form-group col-md-3" ng-hide="checked<?php echo $i;?>">
              <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                    <input type="text" name="boardingtime[]"  value="<?php echo $selectedtime[$i];?>" class="form-control timepicker">
                  </div>
                  </div>
            </div>
             <div class="form-group col-md-2">
                <button class="remove btn btn-danger btn-sm btn-flat" remove-me class="buttonremove">-</button>
              </div>
              </div>
              
                <?php
                 }
                ?>

              </div>

          <div class="clearfix"></div>

                <div ng-controller="MainCtrl">
           <fieldset  data-ng-repeat="choice in choices">
                <div class="form-group col-md-6" ng-controller="MultipleAddCtrl">
                <select class="form-control" name="boardingpoint[]" class="selectp" select2s ng-model="var2">
                
                  <?php foreach($routs as $rot){?>
                      <option ng-value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?></option>
                    <?php } ?>  
                </select>
              </div>
             <div class="form-group col-md-3">
              <div class="bootstrap-timepicker" ng-controller="MultipleAddCtrl">
                  <div class="input-group" class="date">
                  <div class="input-group-addon add-on"><i class="fa fa-clock-o"></i> </div>
                    <input data-format="hh:mm:ss" type="text" datetimez ng-model="var1" id="input1" name="boardingtime[]"  class="form-control timepicker">
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



        <div class="clearfix"></div>
                 <hr>

                  <div class="form-group col-md-6">
                   <label>Dropping Points</label>
                  </div>
                   <div class="form-group col-md-3">
                <label>Dropping Times</label>
                </div>
                <div cont="subACtrl">
                    <?php //echo $data['boardingpoint'];
                  $selectedbpoint   = explode(',',$data['droppingpoint']);
                  $selectedtime   = explode(',',$data['droppingtime']);
                  $counter = count($selectedbpoint);
                 for($i=0;$i< $counter; $i++)
                 //foreach($val as $count)
                 {
                ?>
               
                <div remove-me>
                <div class="form-group col-md-6">
                <select class="form-control" name="droppingpoint[]">
                  <?php foreach($routs as $rot){?>
                      <option <?php if($rot['id']==$selectedbpoint[$i]){echo "selected";}?> value="<?php echo $rot['id'];?>"><?php echo $rot['from'];?> <?php if($rot['id']==$selectedbpoint[$i]){echo "*";}?></option>
                    <?php } ?>  
                </select>
              </div>

              <div class="form-group col-md-3" ng-hide="checked<?php echo $i;?>">
              <div class="bootstrap-timepicker">
                  <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-clock-o"></i> </div>
                    <input type="text" name="droppingtime[]"  value="<?php echo $selectedtime[$i];?>" class="form-control timepicker">
                  </div>
                  </div>
            </div>
             <div class="form-group col-md-2">
                <button class="remove btn btn-danger btn-sm btn-flat" remove-me class="buttonremove">-</button>
              </div>
              </div>
              
                <?php
                 }
                ?>

              </div>


              <div class="clearfix"></div>

                <div ng-controller="MainCtrl">
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
                    <input data-format="hh:mm:ss" type="text" datetimez ng-model="var1" id="input1" name="droppingtime[]"  class="form-control timepicker">
                  </div>
                </div>
            </div>
              
              <div class="form-group col-md-2">
                <button  class="remove btn btn-danger btn-sm btn-flat"  ng-show="$last" ng-click="removeBoarding()">-</button>
              </div>
           </fieldset>

           <div class="clearfix"></div>
             <div class="form-group col-md-12">
             <input type="button" class="btn btn-info btn-sm btn-flat" ng-click="addNewBoarding()" value="Add Droppping Point">
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
            <?php } ?>
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