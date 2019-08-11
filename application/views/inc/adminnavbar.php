<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left">
        <?php 
       
        	$query = $this->db->get_where('control_login',array('username'=>$this->session->userdata('eBusLogin')));
        	$image  = $query->result_array();
        	foreach($image as $userimg)
        	{
        		$file = USER_IMAGE_DIR.$userimg['userfile'];
        		if(file_exists($file))
        		{
        			$img =  $file;
        		}else{
        			$img = NO_PHOTO_USER_IMAGE_DIR;
        		}
        	}
        ?>
          <img src="<?php echo $img;?>" height="37" width="37" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('eBusLogin');?> </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php
        $user = $this->session->userdata('eBusLogin');
        $tablemenu = "menu_setup";
        $query = $this->db->get_where($tablemenu,array('is_active'=>'Y','parent'=>0));
        $row  = $query->result_array();
        $d = $this->db->select('id'); 
        $query = $this->db->get_where('control_login',array('username'=>$user));
        $id  = $query->result_array();
        foreach ($id as $key) {
          $userr_id = $key['id'];
        }
        $query =  $this->db->get_where('permission',array('user_id'=>$userr_id));
        $permissionvalue =  $query->result_array();
         foreach($permissionvalue as $pvalue){ 
        $dbpermitparent = explode(',',$pvalue['parent_id']);
        foreach($row as $data){ 
        $url = ADMIN_BASE.$data['pseudo_name'];
        
        // with parent 
        $query = $this->db->get_where('menu_setup',array('parent'=>$data['id'])); 
        $count = $query->num_rows(); 
        if($count>0)
        {
          if(in_array($data['pseudo_name'], $dbpermitparent)){
        ?>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span><?php echo $data['title'];?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <?php
                 $query = $this->db->get_where('menu_setup',array('parent'=>$data['id'])); 
                 $child = $query->result_array();
                 foreach ($child as $value) { 
                  $childurl  = ADMIN_BASE.$value['pseudo_name'];
                  if(in_array($value['pseudo_name'], $dbpermitparent)){
                ?>
            <li><a href="<?php echo $childurl;?>"><i class="<?php echo $value['icon_class'];?>"></i> <?php echo $value['title'];?></a></li>
            <?php } }?>
          </ul>
        </li>
        <?php 
          }
          }else{
          if(in_array($data['pseudo_name'], $dbpermitparent)){
        ?>
          <li class="<?php  if($data['pseudo_name']==$this->uri->segment(2)){echo 'active';}else{};?>">
            <a href="<?php echo $url;?>">
              <i class="<?php echo $data['icon_class'];?>"></i><span><?php echo $data['title'];?></span>
              <span class="pull-right-container"></span>
            </a>
          </li>
        <?php 
          }
          }// permisison
          } // count else
          }// Main foreach
         ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>