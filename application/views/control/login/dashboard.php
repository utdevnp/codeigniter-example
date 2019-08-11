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
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo @round($google_chrome*100/$allcount); ?><sup style="font-size: 20px">%</sup></h3>
                
              <p>Google Chrome</p>
            </div>
            <div class="icon">
              <i class="fa fa-chrome"></i>
            </div>
            
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo @round($mozila_firefox*100/$allcount); ?><sup style="font-size: 20px">%</sup></h3>

              <p>Mozilla Firefox</p>
            </div>
            <div class="icon">
              <i class="fa fa-firefox"></i>
            </div>
            
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo @round($safari*100/$allcount); ?><sup style="font-size: 20px">%</sup></h3>

              <p>Safari</p>
            </div>
            <div class="icon">
              <i class="fa fa-safari"></i>
            </div>
            
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php $other = $google_chrome + $mozila_firefox + $safari - $allcount;  echo @round(abs($other*100/$allcount));  ?><sup style="font-size: 20px">%</sup></h3>

              <p>Other </p>
            </div>
            <div class="icon">
              <i class="fa fa-adjust"></i>
            </div>
            
          </div>
      </div>
      <div class="col-md-8 col-sm-6 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Logins</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th width="10">S.N</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $sn=1;
                    foreach($latest_login as $login){
                  ?>
                    <tr>
                      <td><?php echo $sn++;?></td>
                      <td><a target="_blank"><?php echo $login['username'];?></a> login from  </td>
                      <td><strong><?php echo  strtoupper($login['agent']);?></strong></td>
                      <td> (<?php echo $login['ip'];?>)  </td>
                      <td>
                      <?php 
                        $date =  date('M j Y', strtotime($login['logged']));
                        $today = date('M j Y');

                        $value  = date_range($date,$today);
                        $diff = count($value);

                        if($diff == 1){
                         echo "Today" ." ". date('g:i A', strtotime($login['logged']));
                         }
                        elseif($diff == 2){
                           echo "Yesterday"." ".date('g:i A', strtotime($login['logged']));
                        }else{
                          echo date('M j Y g:i A', strtotime($login['logged']));
                        }
                    ?>
                    </td>
                    <td>
                      
                    <span class="label label-<?php if($login['attemp']>3){echo "danger";}else{echo "success";} ;?>"><?php if($login['attemp']>3){echo "Block";}else{echo "Allow";} ;?></span>
                  </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
            </div>
          </div>
          <form method="post" action="<?php echo ADMIN_BASE."dashboard/iphandle";?>">
          
         <div class="col-md-4 col-sm-6 col-xs-12">
         <?php $this->load->view('control/inc/message');?>
          <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Function</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="col-md-12"><label for="company">Flush IP  </label></div>
                <div class="clearfix"></div>
                <div class="col-md-9">
                    <div class="form-group">
                      <input type="ip"  class="form-control pull-left col-md-9" style="background-color:rgba(0,255,0,0.3);" name="allow" id="fname" placeholder="192.168.1.0">
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit"  name="allowip" value="allowip" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-gear-o"></i> Flush</button>
                    </div>


                </div>

                 <div class="col-md-12"><label for="company">Block IP  </label></div>
                <div class="clearfix"></div>
                <div class="col-md-9">
                    <div class="form-group">
                      <input type="ip"  class="form-control pull-left col-md-9" style="background-color:rgba(255,0,0,0.3);" name="block" id="fname" placeholder="192.168.1.0">
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" name="blockip" value="blockip" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-gear-o"></i> Block</button>
                    </div>
                </div>
              </div>
              </div>

    </div>
 </form>
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