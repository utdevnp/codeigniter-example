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
              <h3 class="box-title"><?php echo $title;?> </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
              <form method="post" action="<?php echo base_url('control/users/permission/'.$this->uri->segment(4))?>">
            <div class="box-body">
              <div class="row">            
                <div class="box-body">
                	
            	<table class="table table-striped">
            	<tbody>
            	<tr>
                  <th style="width: 10px">#</th>
                  <th>Title</th>
                  <th>Icon</th>
                  <th>Main</th>
                  <th colspan="4">Permissions</th>
                </tr>
                <?php    

                 foreach($dbpermit as $permit){ 
                 	$dbpermit = explode(',',$permit['permission']);
                 // print_r($dbpermit);
                 	$dbpermitparent = explode(',',$permit['parent_id']);
                  //print_r($dbpermitparent);

                  foreach($userpermission as $realpermit)
                  {

                    $realuserpermission = explode(',',$realpermit['permission']);
                    $realuserpermissionparent = explode(',',$realpermit['parent_id']);
                   // print_r($realuserpermission);
                   // print_r($realuserpermissionparent);
                 foreach($row as $data){ 
                
                 $query = $this->db->get_where('menu_setup',array('parent'=>$data['id'])); 
                 $count = $query->num_rows();
                 if($count>0)
                 {  	
                 ?>
                <tr>
                  <td><?php echo $data['id'];?></td>
                  <td><strong><?php echo $data['title'];?></strong></td>
                  <td> <i class="<?php echo $data['icon_class'];?>"></i></td>
                   <td>
                   <?php 
                   if(in_array($data['pseudo_name'], $dbpermitparent)){ ?>
                    <label><input type="checkbox" <?php echo in_array($data['pseudo_name'], $realuserpermissionparent) ?  "checked" : "unchecked";?> name="parent_id[]" value="<?php echo $data['pseudo_name'];?>" class="minimal"> <?php echo $data['title'];?> </label>
                    <?php }?>
                   </td>
                    <?php 
                  foreach ($addEditDlttable as $crud) { 
                  ?>
                   <td> 
                      <?php if(method_exists($data['pseudo_name'],$crud['title'])){
                           if(in_array($value['pseudo_name']."/".$crud['title'], $dbpermit))
                        {
                        ?>
                        <label><input type="checkbox" <?php echo in_array($data['pseudo_name']."/".$crud['title'], $realuserpermission) ?  "checked" : "unchecked";?> name="permission[]" value="<?php echo $data['pseudo_name']."/".$crud['title'];?>" class="minimal"> <?php echo $crud['title'];?> </label>
                     <?php  }}else{echo "&nbsp;";}?>
                     
                    </td>
                  <?php 
                }
                ?>
                </tr>
                <?php
                 $query = $this->db->get_where('menu_setup',array('parent'=>$data['id'])); 
                 $child = $query->result_array();
                 foreach ($child as $value) {
                  
                ?>
                <tr>
             		<td> &nbsp;-</td>
                  <td> <?php echo $value['title'];?></td>
                  <td> <i class="<?php echo $value['icon_class'];?>"></i></td>
                  <td>
                  <?php 
                    if(in_array($value['pseudo_name'], $dbpermitparent))
                        {
                  ?>
                  <label><input type="checkbox" <?php echo in_array($value['pseudo_name'], $realuserpermissionparent) ?  "checked" : "unchecked";?> name="parent_id[]" value="<?php echo $value['pseudo_name'];?>" class="minimal"> <?php echo $value['title'];?> </label>
                   <?php
                 }
                   ?>
                   </td>
                   <?php 
                  foreach ($addEditDlttable as $crud) { 
                  ?>
                   <td> 
                      <?php if(method_exists($value['pseudo_name'],$crud['title'])){
                        if(in_array($value['pseudo_name']."/".$crud['title'], $dbpermit))
                        {
                        ?>
                         <label><input type="checkbox" <?php echo in_array($value['pseudo_name']."/".$crud['title'], $realuserpermission) ?  "checked" : "unchecked";?> name="permission[]" value="<?php echo $value['pseudo_name']."/".$crud['title'];?>" class="minimal"> <?php echo $crud['title'];?> </label>
                     <?php  }}else{echo "&nbsp;";}?>
                     
                    </td>
                  <?php 
                }
                ?>
                 
                </tr>
                <?php
                } 
                  }else{
                ?>
                  <tr>
                  <td><?php echo $data['id'];?></td>
                  <td><?php echo $data['title'];?></td>  
                  <td> <i class="<?php echo $data['icon_class'];?>"></i></td> 
                  <td>
                  <?php  
                  if(in_array($data['pseudo_name'], $dbpermitparent))
                  {
                    ?>
                 <label><input type="checkbox" <?php echo in_array($data['pseudo_name'], $realuserpermissionparent) ?  "checked" : "unchecked";?> name="parent_id[]" value="<?php echo $data['pseudo_name'];?>" class="minimal"> <?php echo $data['title'];?> </label>
                 <?php } ?>
                  </td>
                <?php 
                  foreach ($addEditDlttable as $crud) { 
                  ?>
                   <td> 
                      <?php if(method_exists($data['pseudo_name'],$crud['title'])){
                           if(in_array($data['pseudo_name']."/".$crud['title'], $dbpermit))
                         {
                        ?>
                         <label><input type="checkbox" <?php echo in_array($data['pseudo_name']."/".$crud['title'], $realuserpermission) ?  "checked" : "unchecked";?> name="permission[]" value="<?php echo $data['pseudo_name']."/".$crud['title'];?>" class="minimal"> <?php echo $crud['title'];?> </label>
                     <?php  }}else{echo "&nbsp;";}?>
                     
                    </td>
                  <?php 
                }
                ?>
                  
                </tr>
                 <?php   
                  }
             	   }
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
                <!-- // buttons -->
                 <div class="form-group col-md-8">
                 <button  class="btn btn-success btn-sm btn-flat" type="submit" name="setpermit" value="setpermit"><i class="fa fa-floppy-o"></i> Save & Update</button>
                 <button class="btn btn-danger btn-sm btn-flat" type="reset" "><i class="fa fa-refresh"></i> Reset</button>
                 <a href="<?php echo ADMIN_BASE."users/update/".$this->uri->segment(4);?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-arrow-left"></i> Go Back</a>
                
                </div>
              </div>
             
              <!-- /.row  form close-->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
   
      </form>
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