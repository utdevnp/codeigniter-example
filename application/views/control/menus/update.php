
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
        <a href="<?php echo ADMIN_BASE.$this->uri->segment(2).'/add';?>" style="margin-left:7px;" class="btn btn-success btn-xs btn-flat pull-right topbuttons" ><i class="fa fa-plus"></i> Add New</a>
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
      
      <div class="box-body">
       <form method="post" action="<?php echo base_url('control/menus/update/'.$this->uri->segment(4));?>">
       <?php foreach($row as $data) {?>

                  <div class="form-group col-md-4">
                     <label for="company">Parent <span class="stricts"> * </span></label>
                     <select type="text" class="form-control" name="parent" id="parent">

                     <?php 
                     if($data['parent']==0)
                      {
                        echo '<option value="0" selected>'; 
                          echo "* SELF ";
                        echo "</option>"; 
                      }
                      else
                      {
                        echo '<option value="0">'; 
                          echo " SELF ";
                        echo "</option>"; 
                      }

                     foreach ($allmenu as $menu) {
                        echo $pid= $menu['id'];
                        echo $data['parent'];
                        if($data['parent']==$pid)
                        {
                          
                          echo "<option value=\"$pid\" selected>"; 
                            echo "* ".$menu['title'];
                          echo "</option>"; 
                        }
                        else
                        {
                          echo "<option value=\"$pid\">"; 
                            echo $menu['title'];
                          echo "</option>"; 

                        }
                      }
                      ?>
                     </select>
                  </div>

                  <div class="form-group col-md-4">
                     <label for="company">Title <span class="stricts"> * </span></label>
                     <input type="text" value="<?php echo $data['title'];?>" class="form-control" name="title" id="fname" placeholder="Title">
                  </div>
                   <div class="form-group col-md-4">
                     <label for="company">Pseudo <span class="stricts"> * </span></label>
                     <input type="text" value="<?php echo $data['pseudo_name'];?>" class="form-control" name="pseudo_name" id="pseudo_name" placeholder="Pseudo Name">
                  </div>
                   <div class="form-group col-md-4">
                     <label for="company">Icon Class <span class="stricts"> </span></label>
                     <input type="text" value="<?php echo $data['icon_class'];?>" class="form-control" name="icon_class" id="icon_class" placeholder="Icon Class">
                  </div>

                  <div class="form-group col-md-4">
                     <label for="company">Custom Url <span class="stricts"> </span></label>
                     <input type="text" class="form-control" value="<?php echo $data['custom_url'];?>" name="custom_url" id="custom_url" placeholder="Custom Url">
                  </div>
        
        		<div class="form-group col-md-4">
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
                   <div calss="form-group col-md-12">
                   <div class="col-md-12">
                      <label>Menus</label><br>
                        <?php foreach ($mainmenu as $menus) { 
                                foreach ($menudbmenus as $keymenu) {;?>

                            <label> <input type="checkbox" <?php echo in_array($menus['title'], explode(',',$keymenu['menus'])) ?  "checked" : "unchecked";?> value="<?php echo $menus['title'];?>" name="menus[]" class="minimal">  <i class="<?php echo $menus['icon'];?>"></i> <?php echo $menus['title'];?> </label> &nbsp; &nbsp;
                         <?php 
                        }
                        }  
                        ?>
                    </div>
                    </div>
             </div>
      
			<?php } ?>
           <div class="box-footer">
                  <div class="row">
                    <!-- // buttons -->
                     <div class="form-group col-md-12">
                       <div class="col-md-12">
                     <button  class="btn btn-success btn-sm btn-flat" type="submit" name="updatebtn" value="updatebtn"><i class="fa fa-floppy-o"></i> Save & Update </button>
                     <button class="btn btn-danger btn-sm btn-flat" type="reset" "><i class="fa fa-refresh"></i> Reset</button>
                    
                    </div>
                    </div>
                  </div>
                 
                  <!-- /.row  form close-->
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