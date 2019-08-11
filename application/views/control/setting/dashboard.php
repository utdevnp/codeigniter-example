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
        <?php echo $title;?>
        <small>0</small>
      </h1>
      
    </section>
    <div class="col-md-12">
    <ol class="breadcrumb breadcrumb-sm">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="#"><?php echo $primaryheader;?></li>
      </ol>
    </div>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
    <?php $this->load->view('control/inc/message');?>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#Comissions_1-1" data-toggle="tab" aria-expanded="true">Comissions</a></li>
              <li class="active"><a href="#Information_2-2" data-toggle="tab" aria-expanded="false">Company Information</a></li>
              <li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">Tab 3</a></li>
              <li class="pull-left header"><i class="fa fa-gear"></i>Setting</li>
            </ul>
            <div class="tab-content" style="overflow: hidden;">
                <div class="tab-pane" id="Comissions_1-1">

                  <div class="col-md-5 col-sm-6 col-xs-12">
                  <div class="box no-padding">
                    <div class="box-header with-border">
                      <h3 class="box-title"> User  Reward Setup </h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>

                    <div class="box-body no-padding">
                    <br>
                    <form method="post" action="<?php echo ADMIN_BASE.'setting/index';?>">
                      <div class="form-group col-md-10">
                      <?php 
                        foreach($manage as $m){
                      ?>
                        <div class="input-group">
                        <input type="text" name="rewad" value="<?php echo $m['rewad'];?>" class="form-control" placeholder="value">
                          <span class="input-group-addon"> 
                         <input type="radio" <?php if($m['rewardin']=='RS'){echo "checked";}else{};?> name="rewardin" value="RS"> &nbsp; Rs
                        </span>
                        <span class="input-group-addon"> 
                         <input type="radio" <?php if($m['rewardin']=='PER'){echo "checked";}else{};?> name="rewardin" value="PER"> &nbsp; Percent
                          </span>
                        
                        </div>
                      <?php } ?>
                      </div>
                      
                      <div class="form-group col-md-2">
                        <button class="btn btn-success btn-sm btn-flat" type="submit" name="rewardup" value="rewardup"><i class="fa fa-floppy-o" style="font-size: 16px;"></i> </button>
                      </div>
                    </form>
                    </div>
                    <div class="box-footer ">
                      <p style="margin:0px;"><i class="fa fa-info-circle"></i> Now Reward is setup in  <?php if($m['rewardin']=='RS'){echo "Rupese (Rs)";}else{echo "Percentage (%)";};?></p>
                    </div>
                    </div>
                  </div>

                  <div class="col-md-5 col-sm-6 col-xs-12">
                  <div class="box no-padding">
                    <div class="box-header with-border">
                      <h3 class="box-title"> System Comission Setup </h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>

                    <div class="box-body no-padding">
                    <br>
                    <form method="post" action="<?php echo ADMIN_BASE.'setting/index';?>">
                      <div class="form-group col-md-10">
                      <?php 
                        foreach($manage as $m){
                      ?>
                        <div class="input-group">
                        <input type="text" name="creward" value="<?php echo $m['creward'];?>" class="form-control" placeholder="value">
                          <span class="input-group-addon"> 
                         <input type="radio" <?php if($m['crewardin']=='RS'){echo "checked";}else{};?> name="crewardin" value="RS"> &nbsp; Rs
                        </span>
                        <span class="input-group-addon"> 
                         <input type="radio" <?php if($m['crewardin']=='PER'){echo "checked";}else{};?> name="crewardin" value="PER"> &nbsp; Percent
                          </span>
                        
                        </div>
                      <?php } ?>
                      </div>
                      
                      <div class="form-group col-md-2">
                        <button class="btn btn-warning btn-sm btn-flat" type="submit" name="cewardup" value="cewardup"><i class="fa fa-floppy-o" style="font-size: 16px;"></i> </button>
                      </div>
                    </form>
                    </div>
                    <div class="box-footer ">
                      <p style="margin:0px;"><i class="fa fa-info-circle"></i> Now Reward is setup in  <?php if($m['crewardin']=='RS'){echo "Rupese (Rs)";}else{echo "Percentage (%)";};?></p>
                    </div>
                    </div>
                  </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="Information_2-2">
                  <div class=" col-md-9">
                  <div class="box no-padding">
                    <div class="box-body no-padding">
                    <form method="post" action="<?php echo ADMIN_BASE."setting/index/information";?>">
                      <div class="form-group col-md-4">
                      <label>Name</label>
                        <input type="text" name="name" value="<?php echo $m['name'];?>" class="form-control" placeholder="Name">
                      </div>
                      <div class="form-group col-md-4">
                      <label>Address</label>
                        <input type="text" name="address" value="<?php echo $m['address'];?>" class="form-control" placeholder="Address">
                      </div>
                      <div class="form-group col-md-4">
                      <label>Phone</label>
                        <div class="input-group">
                          <span class="input-group-addon">+977</span>
                          <input type="text" name="phone" value="<?php echo $m['phone'];?>" class="form-control" placeholder="Phone">
                        </div>
                      </div>

                      <div class="form-group col-md-4">
                      <label>Troll Free</label>
                        <div class="input-group">
                          <span class="input-group-addon">+977</span>
                          <input type="text" name="trollfree" value="<?php echo $m['trollfree'];?>" class="form-control" placeholder="Troll Free">
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                          <label>Email</label>
                          <input type="text" name="email" value="<?php echo $m['email'];?>" class="form-control" placeholder="Email">
                      </div>
                      <div class="form-group col-md-4">
                          <label>Reged No</label>
                          <input type="text" name="reged" value="<?php echo $m['reged'];?>" class="form-control" placeholder="Reged No">
                      </div>
                      <div class="form-group col-md-4">
                          <label>Presendent</label>
                          <input type="text" name="presendent" value="<?php echo $m['presendent'];?>" class="form-control" placeholder="Presendent">
                      </div>
                      <div class="form-group col-md-12">
                          <label>Meta Description</label>
                          <textarea name="metad"  class="form-control"  placeholder="Meta Description"><?php echo $m['metad'];?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Meta Keyword</label>
                          <textarea name="metak"  class="form-control" placeholder="Meta Keyword"><?php echo $m['metak'];?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Terms & Condition</label>
                          <textarea name="tc"  class="form-control termsandcondition" placeholder="Terms & Condition"><?php echo $m['tc'];?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Bus Booking Policies</label>
                          <textarea name="bbp"  class="form-control bookingpolicy" placeholder="Bus Booking Policies"><?php echo $m['bbp'];?></textarea>
                      </div>
                       <div class="form-group col-md-12">
                          <label>Privacy policy </label>
                          <textarea name="pp"  class="form-control privacypolicy" placeholder="Privacy policy"><?php echo $m['pp'];?></textarea>
                      </div>
                    <div class="form-group col-md-2">
                        <button  type="submit" class="btn btn-success btn-sm btn-flat"  name="updateinfo" value="updateinfo"><i class="fa fa-floppy-o"></i> Save & Update </button>
                      </div>
                      </form>
                      </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="box no-padding">
                    <div class="box-body no-padding">
                      Image
                    </div>
                  </div>
                </div>

              </div>
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>

        <div class="clearfix"></div>
      
        
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