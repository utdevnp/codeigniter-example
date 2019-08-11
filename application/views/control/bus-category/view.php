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
        <div class="col-md-9">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <?php $this->load->view('control/inc/message');?>
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
                     <?php foreach($row as $data){?>
                      <tbody>
                      <tr><td>Id </td><td><?php echo $data['id']; ?></td></tr>
                      <tr><td> Title </td><td><?php echo $data['title'];?></td></tr>
                      <tr><td> Code </td><td><?php echo $data['code'];?></td></tr>
                      <tr><td>Active  </td><td><?php if($data['is_active']=="Y"){echo "Yes";}else{ echo "no";} ?></td></tr>
                       

                        
                       
                    </tbody>
                  </table>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
           
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

           <div class="col-md-3">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <?php $this->load->view('control/inc/message');?>
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
                      <?php
                       $selected = explode(',',$data['features']);
                       foreach($all as $feat){
                        ?>
                          <input type="checkbox"  name="features[]" <?php echo in_array($feat['id'], $selected) ?  "checked" : "unchecked";?> value="<?php echo $feat['id'];?>" /> <?php echo $feat['title'];?> <?php echo $feat['id'];?><br>
                          <?php } ?>                          
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
        <!-- /.col -->
      </div>
      <?php } ?>
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