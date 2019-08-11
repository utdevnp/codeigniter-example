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
        <small><?php echo $count;?></small>
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
             
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-ellipsis-v"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo ADMIN_BASE.'busscheadual/departedbus';?>">Departed Buses</a></li>
                  </ul>
                </div>

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
                          <th>Bus No</th>
                          <th>From <i class="fa  fa-angle-double-right"></i> To </th>
                          <th> Fare </th>
                           <th>Departure</th>
                           <th>Arrival </th>
                          <th>Status</th>
                          <th colspan="2">Actions</th>
                        </tr>
                        <?php 
                          $sn = 1;
                          foreach($row as $data){
                        ?>
                        <tr>
                          <td><?php echo $sn++;?></td> 
                          
                          <td> <?php foreach($busno as $bus){?><?php if($data['bus_no']==$bus['id']){echo strtoupper($bus['bus_no']);}?> <?php } ?></td> 
                          <td><?php foreach($busrot as $rot){?><?php if($data['from']==$rot['id']){echo $rot['from'];}?> <?php } ?> <b><i class="fa  fa-angle-double-right"></i></b> <?php foreach($busrot as $rot){?><?php if($data['to']==$rot['id']){echo $rot['from'];}?> <?php } ?></td>
                          <td><?php echo $data['netfare'];?></td>
                          <td><?php echo  $data['departure']; echo " &nbsp "; echo $data['departuretime'];?></td>
                          <td><?php echo $data['arrival']; echo " &nbsp "; echo $data['arrivaltime'];?></td>
                          <td>
                              <?php if($data['is_active']=='Y') { ?>
                                  <a href="<?php echo base_url('control/busscheadual/');;?>deactive/<?php echo $data['id'];?>"><strong><span class="label label-success">Opened</span> </strong></a>
                              <?php } else if($data['is_active']=='N') { ?>
                                 <a href="<?php echo base_url('control/busscheadual/');;?>active/<?php echo $data['id'];?>"><strong><span class="label label-danger">Closed</span> </strong></a>
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