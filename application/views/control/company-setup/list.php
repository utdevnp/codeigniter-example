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
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
               <!-- error meassate  -->
                  
                    <!-- /.box-header -->
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>#</th>
                          <th>Logo</th>
                          <th>Company Name</th>
                          <th>Register No</th>
                          <th>Email</th>
                          <th>Phone no</th>
                          <th>Total Bus</th>
                          <th>Active</th>
                          <th colspan="3">Actions</th>
                        </tr>
                        <?php 
                          $sn = 1;
                          foreach($row as $data){
                          $file = COMPANY_LOGO_IMG_DIR.$data['image'];
                          if(file_exists($file))
                          {
                            $image =  $file;
                          }else{
                            $image = NO_COMPANY_LOGO_IMG_DIR;
                          }
                        ?>
                        <tr>
                          <td><?php echo $sn++;?></td> 
                          <td> <img src="<?php echo $image;?>" height="40 " width="40px" /></td>
                          <td><?php echo $data['name'];?></td>
                          <td><?php echo $data['register_no'];?></td>
                          <td><?php echo $data['email'];?></td>
                          <td><?php echo $data['contact'];?></td>
                          <td><?php echo $data['totalbus'];?></td>
                          

                          <td>
                              <?php if($data['is_active']=='Y') { ?>
                                  <a href="<?php echo base_url('control/companysetup/');;?>deactive/<?php echo $data['id'];?>"><strong><span class="label label-success">Yes</span> </strong></a>
                              <?php } else if($data['is_active']=='N') { ?>
                                 <a href="<?php echo base_url('control/companysetup/');;?>active/<?php echo $data['id'];?>"><strong><span class="label label-danger">No</span> </strong></a>
                              <?php }?>
                          </td>
                          <?php foreach($mainmenu as $crudmenu){
                            $permit = $this->uri->segment(2)."/".$crudmenu;
                             if(in_array($permit,$user_id)){
                          ?>
                            <td><a href="<?php echo ADMIN_BASE.$this->uri->segment(2)."/".strtolower($crudmenu)."/".$data['id'];?>" class="<?php if($crudmenu=="Trash"){echo "text-danger";};?>"><i class="<?php $this->db->select('icon');$query = $this->db->get_where('minmenu',array('title'=>$crudmenu)); $menus  = $query->result_array(); foreach($menus as $icon){echo $icon['icon'];}?> <?php if($crudmenu=="Trash"){echo "text-danger";};?>"></i> <?php echo $crudmenu;?></a></td>
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