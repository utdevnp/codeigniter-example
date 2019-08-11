

<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header mainheadig">
      <h1>
        <?php echo $primaryheader;?>
        <small></small>
      </h1>
      
     <section class="content">

      <div class="row">
      <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('control/offersetup/update/'.$this->uri->segment(4));?>">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title;?></h3>
              <?php $this->load->view('control/inc/validation');?>
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
                   <?php if($bussche==""){ echo "No Bus Available for Your Reuqest";}?>

                  <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>#</th>
                          <th>Bus No</th>
                          <th>From</th>
                          <th> Destination </th>
                          <th> Fare </th>
                           <th>Departure</th>
                           <th>Arrival </th>
                          
          
                        </tr>
                        <?php 
                          $sn = 1;
                           foreach($bussche as $data){ ?>
                        <tr>
                          <td><?php echo $sn++;?></td> 
                          
                          <td> <?php foreach($busno as $bus){?><?php if($data['bus_no']==$bus['id']){echo strtoupper($bus['bus_no']);}?> <?php } ?></td> 
                           <td><?php foreach($busrot as $rot){?><?php if($data['from']==$rot['id']){echo $rot['from'];}?> <?php } ?></td>
                          <td><?php foreach($busrot as $rot){?>   <?php if($data['to']==$rot['id']){echo $rot['to'];}?> <?php } ?>  </td>
                          <td><?php echo $data['fare'];?></td>
                          <td><?php echo $data['departure']; echo " &nbsp "; echo $data['departuretime'];?></td>
                          <td><?php echo $data['arrival']; echo " &nbsp "; echo $data['arrivaltime'];?></td>
                          
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                  
              </div>
               

                
              
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