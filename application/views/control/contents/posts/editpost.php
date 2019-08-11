
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
      <form method="POST" action="<?php echo base_url('control/content/update');?>" enctype="multipart/form-data">
        <div class="col-md-12">
          <?php $this->load->view('control/inc/message');?>
              <?php $this->load->view('control/inc/validation');?>
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
                    <?php foreach($pos as $posts){ 
						$file = COMPANY_LOGO_IMG_DIR.$posts['image'];
                          if(file_exists($file))
                          {
                            $image =  $file;
                          }else{
                            $image = NO_COMPANY_LOGO_IMG_DIR;
                          }
					
					?>
                   <div class="form-group col-md-12">
                      <label for="companyname">Post Title</label>
                      <input type="text" name="title" value="<?php echo $posts['title'];?>" class="form-control" id="category" placeholder=" Bus Category">
                    </div>
                    <div class="form-group col-md-12">
                      <label for="busTitle">Category</label>
                      <select name="category" class="form-control">
                        <option value="Self">Self</option>
                        <?php foreach($categ as $cat){?>
                          <option value="<?php echo $cat['title'];?>"<?php if($posts['category']==$cat['title']){ echo 'selected';}?>><?php echo $cat['title'];?><?php if($posts['category']==$cat['id']){ echo "*";}?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="companyname">Detail</label>
                      <div class="clearfix"></div>
                      <textarea class="terms" name="detail" placeholder="Terms And Policy" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $posts['content'];?></textarea>
                    </div>
					 
					
                    <div class="form-group col-md-4">
					<img style="margin-left:22px;" height="150" width="150" src="<?php echo  $image;?>" class="img-circle centered" alt="User Image">
                    <label for="companyPresident">image</label>
                     <?php if($this->session->userdata('errormessage')){
                              echo  $this->session->userdata('errormessage');
                              $this->session->unset_userdata('errormessage');
                        }
                      ?>
                    <input type="file" name="image" class="form-control" id="" placeholder="Image">
                  </div>
				   <div class="clearfix"></div>
				  
                    <div class="form-group col-md-5">
                    <label>Active</label>
                    <?php 
                        $arr =array('Y'=>'Yes','N'=>'No');
                        ?>
                        <select class="form-control" name="is_active">
                        <?php
                        foreach($arr as $k=>$v)
                          {
                            if($posts['is_active']==$k)
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
                     <div class="form-group col-md-5">
                    <label>Template</label>
                    <?php 
                        $arr =array('Y'=>'Yes','N'=>'No');
                        ?>
                        <select class="form-control" name="is_temp">
                        <?php
                        foreach($arr as $k=>$v)
                          {
                            if($posts['is_temp']==$k)
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
					<?php }?>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
              <div class="box-footer">
                <div class="row">
                  <!-- // buttons -->
                  <div class="form-group col-md-4">
				  <input type="hidden" name="id" value="<?php echo $posts['id'];?>">
                    <button type="submit" name="submit" value="editpost" class="btn btn-success btn-sm btn-flat"><i class="fa fa-floppy-o"></i> Save </button>
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












