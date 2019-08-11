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

      <form method="POST" action="<?php echo base_url('control/busnamesetup/add');?>">
        <div class="col-md-3">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $addtitle;?></h3>       
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
                      <label for="companyname">Bus Name</label>
                      <input type="text" name="busname" class="form-control" id="category" placeholder=" Bus Name">
                    </div>
					<?php $utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
						foreach($utype as $ut){
							$utyps  = $ut['user_type'];
						}
						if($utyps=='admin'){?>
						<div class="form-group col-md-12">
						 <label for="companyname">Company</label>
						  <select name='company' class="form-control">
						   <?php  foreach($allcom as $data){
								?>
									<option  value="<?php echo $data['id'];?>"><?php echo $data['name']; ?></option>
									<?php
							}
							 echo "</select>" 
						?>
						</div>
					<?php }?>
                    <div class="form-group col-md-12">
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
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
              <div class="box-footer">
                <div class="row">
                  <!-- // buttons -->
                  <div class="form-group col-md-12">
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Save</button>
                    <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</button>
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-footer -->
            </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      </form>

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
                <div class="col-md-12">
               <!-- error meassate  -->       
                    <!-- /.box-header -->
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>#</th>
                          <th>Bus Name </th>
                          <th>Company</th>
                          <th>Active</th>
                          <th colspan="2">Actions</th>
                        </tr>
                        <?php 
                          $sn = 1;
                          foreach($row as $data){
                        ?>
                        <tr>
                          <td><?php echo $sn++;?></td>
                          <td><?php echo $data['bus_name'];?></td>
                          <td><?php foreach($comapnies as $selected){?>
                          <?php if($data['company']==$selected['id'])  { echo $selected['name'];} ?>
                          <?php }?></td>
                          <td>
                              <?php if($data['is_active']=='Y') { ?>
                                  <a href="<?php echo base_url('control/busnamesetup/');?>deactive/<?php echo $data['id'];?>"><strong><span class="label label-success">Yes</span> </strong></a>
                              <?php } else if($data['is_active']=='N') { ?>
                                 <a href="<?php echo base_url('control/busnamesetup/');?>active/<?php echo $data['id'];?>"><strong><span class="label label-danger">No</span> </strong></a>
                              <?php }?>
                          </td>
                         <?php foreach($mainmenu as $crudmenu){
                      $permit = $this->uri->segment(2)."/".$crudmenu;
                       if(in_array($permit,$user_id)){
                    ?>
                      <td><a href="<?php echo ADMIN_BASE.$this->uri->segment(2)."/".strtolower($crudmenu)."/".$data['id'];?>" class="<?php if($crudmenu=="trash"){echo "text-danger";};?>"><i class="<?php $this->db->select('icon');$query = $this->db->get_where('minmenu',array('title'=>$crudmenu)); $menus  = $query->result_array(); foreach($menus as $icon){echo $icon['icon'];}?> <?php if($crudmenu=="trash"){echo "text-danger";};?>"></i> <?php echo $crudmenu;?></a></td>
                   <?php  } }?> 
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

         


                <!-- /.row -->
              </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
            <?php echo $this->pagination->create_links(); ?>
              <!-- /.row -->
            </div>
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