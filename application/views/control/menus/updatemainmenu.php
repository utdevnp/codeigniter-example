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
        <li class="active"><?php echo $addtitle;?></li>
        <a href="<?php echo ADMIN_BASE.$this->uri->segment(2).'/listmainmenu';?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
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
              <h3 class="box-title"><?php echo $addtitle;?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
      
      <div class="box-body collapse in">
       <form method="post" action="<?php echo base_url('control/menus/updatemainmenu/'.$this->uri->segment(4));?>">
       			<?php 
       			foreach ($row as $value) {
       			?>
                  <div class="form-group col-md-3">
                     <label for="company">Title <span class="stricts"> * </span></label>
                      <input type="text" value="<?php echo $value['title'];?>" class="form-control" name="title" id="fname" placeholder="Title">
                  </div>

                  <div class="form-group col-md-3">
                     <label for="company">Icon </label>
                     <input type="text" value="<?php echo $value['icon'];?>"  class="form-control" name="icon" id="icon" placeholder="Icon">
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
                            if($value['is_active'] ==$k)
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
                   <?php  } ?>
                   <div class="form-group col-md-3">
                   <label>.</label><br>
                     <button  class="btn btn-success btn-sm btn-flat" type="submit" name="updatemenu" value="updatemenu"><i class="fa fa-floppy-o"></i> Save & Update </button>
                     <button class="btn btn-danger btn-sm btn-flat" type="reset" "><i class="fa fa-refresh"></i> Reset</button>
                    
                    </div>
             </div>
      
           </div>
           </form>
        </div>
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