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
        <a href="<?php echo ADMIN_BASE."users/add"; ?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
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
                
                <!--  content here and form here -->
              
                <div class="box-body">
		            <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 31px">Image</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Active</th>
                  <th colspan="4">Action</th>
                </tr>
                <?php
                $i=1;
                foreach($row as $data){     
                  $file = USER_IMAGE_DIR.$data['userfile']; 

                    if(file_exists($file))
                    {
                       $image = $file;
                    }else{
                      $image  =  NO_PHOTO_USER_IMAGE_DIR;
                    }
                  
                ?>
                <tr>
                  <td><?php echo $data['id'];?></td>
                  <td>
                    <div class="image">
                       <img height="31" width="31" src="<?php echo $image;?>" class="img-circle" alt="User Image">
                    </div>
                 </td>
                  <td><?php echo $data['fname']." ".$data['lname'];?></td>
                  <td> <?php echo $data['username'];?></td>
                  <td> <?php echo $data['email'];?></td>
                  
                  <td>
                  <?php if($data['is_active']=='Y') { ?>
                      <a href="<?php echo ADMIN_BASE;?>users/deactive/<?php echo $data['id'];?>"><strong><span class="label label-success">Yes</span> </strong></a>
                  <?php } else if($data['is_active']=='N') { ?>
                     <a href="<?php echo ADMIN_BASE;?>users/active/<?php echo $data['id'];?>"><strong><span class="label label-danger">No</span> </strong></a>
                  <?php }?>
                  </td>
                  <td><a href="<?php echo ADMIN_BASE."users/permission/".$data['id'];?>"><i class="fa fa-unlock-alt" title="Manage Permissioin"></i></a></td>
                     <?php foreach($mainmenu as $crudmenu){
                      $permit = $this->uri->segment(2)."/".$crudmenu;
                       if(in_array($permit,$user_id)){
                    ?>
                      <td><a href="<?php echo ADMIN_BASE.$this->uri->segment(2)."/".strtolower($crudmenu)."/".$data['id'];?>"  id="element" data-toggle="confirmation" class="<?php if($crudmenu=="trash"){echo "text-danger";};?>"><i class="<?php $this->db->select('icon');$query = $this->db->get_where('minmenu',array('title'=>$crudmenu)); $menus  = $query->result_array(); foreach($menus as $icon){echo $icon['icon'];}?> <?php if($crudmenu=="trash"){echo "text-danger";};?>"></i> <?php echo $crudmenu;?></a></td>
                   <?php  } }?> 
                </tr>
                <?php } ?>
                
              </tbody></table>

              </div>
             
              <!-- /.row and  -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer"> 
		      <span clas="pull-right"><?php echo $this->pagination->create_links(); ?></span>
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
