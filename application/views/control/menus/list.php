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
      
      <div class="box-body">
       <form method="post" action="<?php echo base_url('control/menus/add');?>">

                  <div class="form-group">
                     <label for="company">Parent <span class="stricts"> * </span></label>
                     <select type="text" class="form-control" name="parent" id="fname">
                      <option value="0"> SELF</option>
                     <?php foreach ($allmenu as $menu) {;?>
                         <option value="<?php echo $menu['title'];?>"> <?php echo $menu['title'];?></option>
                        <?php } ?>
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="company">Title <span class="stricts"> * </span></label>
                     <input type="text" class="form-control" name="title" id="fname" placeholder="Title">
                  </div>
                   <div class="form-group">
                     <label for="company">Pseudo <span class="stricts"> * </span></label>
                     <input type="text" class="form-control" name="pseudo_name" id="pseudo_name" placeholder="Pseudo Name">
                  </div>
                   <div class="form-group">
                     <label for="company">Icon Class <span class="stricts"> </span></label>
                     <input type="text" class="form-control" name="icon_class" id="icon_class" placeholder="Icon Class">
                  </div>

                  <div class="form-group">
                     <label for="company">Custom Url <span class="stricts"> </span></label>
                     <input type="text" class="form-control" name="custom_url" id="custom_url" placeholder="Custom Url">
                  </div>
        
        <div class="form-group">
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
                    
                    <div calss="form-group">
                    <label>Menus</label><br>
                        <?php foreach ($mainmenu as $menus) { ;?>
                          <label class="col-sm-6"> <input type="checkbox" value="<?php echo $menus['title'];?>" name="menus[]" class="minimal"> <i class="<?php echo $menus['icon'];?>"></i> <?php echo $menus['title'];?> </label>
                         <?php 
                        }
                        ?>
                    </div>
             </div>

         
           <div class="box-footer">
                  <div class="row">
                    <!-- // buttons -->
                     <div class="form-group col-md-12">
                     <button  class="btn btn-success btn-sm btn-flat" type="submit" name="addmenu" value="addmenu"><i class="fa fa-floppy-o"></i> Save </button>
                     <button class="btn btn-danger btn-sm btn-flat" type="reset" "><i class="fa fa-refresh"></i> Reset</button>
                    
                    </div>
                  </div>
                 
                  <!-- /.row  form close-->
                </div>
      
           </div>
           </form>
        </div>

        <div class="col-md-9">
         <?php $this->load->view('control/inc/message');?>
              <?php $this->load->view('control/inc/validation');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo ADMIN_BASE.'menus/listmainmenu';?>">Menus</a></li>
                  </ul>
                </div>
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
                  <th>Title</th>
                  <th>Pseudo</th>
                  <th>Icon</th>
                  <th>Active</th>
                  <th colspan="6">Action</th>
                </tr>
                <?php 
                 foreach($row as $data){ 
                 $query = $this->db->get_where('menu_setup',array('parent'=>$data['id'])); 
                 $count = $query->num_rows();
                 if($count>0)
                 {
                  ?>
                <tr>
                  <td><?php echo $data['id'];?></td>
                  <td><strong><?php echo $data['title'];?></strong></td>
                  <td> <?php echo $data['pseudo_name'];?></td>
                  <td> <i class="<?php echo $data['icon_class'];?>"></i></td>
                  <td>
                  <?php if($data['is_active']=='Y') { ?>
                      <a href="<?php echo ADMIN_BASE;?>menus/deactive/<?php echo $data['id'];?>"><strong><span class="label label-success">Yes</span> </strong></a>
                  <?php } else if($data['is_active']=='N') { ?>
                     <a href="<?php echo ADMIN_BASE;?>menus/active/<?php echo $data['id'];?>"><strong><span class="label label-danger">No</span> </strong></a>
                  <?php }?>
                  </td>

                  <td><a href="<?php echo ADMIN_BASE."menus/update/".$data['id'];?>"><i class="fa fa-edit"></i> edit</a></td>
                  <td><a href="<?php echo ADMIN_BASE."menus/trash/".$data['id'];?>" class="text-danger"><i class="fa fa-trash"></i> delete</a></td>
                </tr>
                <?php
                 $query = $this->db->get_where('menu_setup',array('parent'=>$data['id'])); 
                 $child = $query->result_array();
                 foreach ($child as $value) {
                ?>
                <tr>
                  <td></td>
                  <td>  &nbsp;-<?php echo $value['title'];?></td>
                  <td> <?php echo $value['pseudo_name'];?></td>
                  <td> <i class="<?php echo $value['icon_class'];?>"></i></td>
                  <td>
                  <?php if($value['is_active']=='Y') { ?>
                      <a href="<?php echo ADMIN_BASE;?>menus/deactive/<?php echo $value['id'];?>"><strong><span class="label label-success">Yes</span> </strong></a>
                  <?php } else if($value['is_active']=='N') { ?>
                     <a href="<?php echo ADMIN_BASE;?>menus/active/<?php echo $value['id'];?>"><strong><span class="label label-danger">No</span> </strong></a>
                  <?php }?>
                  </td>

                  <td><a href="<?php echo ADMIN_BASE."menus/update/".$value['id'];?>"><i class="fa fa-edit"></i> edit</a></td>
                  <td><a href="<?php echo ADMIN_BASE."menus/trash/".$value['id'];?>" class="text-danger"><i class="fa fa-trash"></i> delete</a></td>
                </tr>


                <?php
                } 
                  }else{
                ?>
                  <tr>
                  <td><?php echo $data['id'];?></td>
                  <td><?php echo $data['title'];?></td>
                  <td> <?php echo $data['pseudo_name'];?></td>
                  <td> <i class="<?php echo $data['icon_class'];?>"></i></td>
                  <td>
                  <?php if($data['is_active']=='Y') { ?>
                      <a href="<?php echo ADMIN_BASE;?>menus/deactive/<?php echo $data['id'];?>"><strong><span class="label label-success">Yes</span> </strong></a>
                  <?php } else if($data['is_active']=='N') { ?>
                     <a href="<?php echo ADMIN_BASE;?>menus/active/<?php echo $data['id'];?>"><strong><span class="label label-danger">No</span> </strong></a>
                  <?php }?>
                  </td>

                  <td><a href="<?php echo ADMIN_BASE."menus/update/".$data['id'];?>"><i class="fa fa-edit"></i> edit</a></td>
                  <td><a href="<?php echo ADMIN_BASE."menus/trash/".$data['id'];?>" class="text-danger"><i class="fa fa-trash"></i> delete</a></td>
                </tr>


                 <?php   
                  }
                  } 
                ?>
                
              </tbody>
              </table>
              </div>
             
              <!-- /.row and  -->
            </div>
            <!-- ./box-body -->
		
            <div class="box-footer">
              <div class="row">
               <span clas="pull-right"><?php echo $this->pagination->create_links(); ?></span>
              </div>
             
              <!-- /.row  form close-->
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