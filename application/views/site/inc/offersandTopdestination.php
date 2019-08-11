<div class="container">
				<div class="row">
                    <div class="col-md-8 topdestination">
						<div class="panel panel-default whydbook">
							<div class="panel-heading">Top Destinations</div>
							<div class="panel-body">
									<?php foreach($toprouth as $allrouth){
								$where = array('to'=>$allrouth['id']);
								$rot = $this->site_model->getwhere('bus_scheadual',$where,'');
								$totinsch = count($rot);
								$upper[]  = $totinsch;
								$average = (max($upper))/2;
								$biger = (max($upper));
								if($totinsch > $average){
									$trt[] =  $allrouth['id'];
								}
								if($totinsch > $average){ 
								   $totmx[]  = $totinsch; ?>
									<div class="col-md-3 row">
										<ul class="destinatoinss"><li><i class="fa fa-check-o"></i> <a href="<?php echo base_url().'home/searchbus/34/'.$allrouth['id']."/".date('Y-m-d');?>"><?php	echo $allrouth['from']; ?></a></li></ul>
									</div>
								<?php 
								}
								$allindex = count($allrouth);
							}
							$roffset  = 24-(count($trt));
							$limitdata =  array_slice($toprouth, 0, $roffset);
							foreach($limitdata as $fr){ ?>
								<div class="col-md-3 row">
										<ul class="destinatoinss"><li><i class="fa fa-check-o"></i> <a href="<?php echo base_url().'home/searchbus/34/'.$fr['id']."/".date('Y-m-d');?>"><?php	echo $fr['from']; ?></a></li></ul>
								</div>
							<?php } ?>
							</div>
						</div>	
                  </div>
                  <div class="col-md-4">
				  
				  
				  <div class="panel panel-default whydbook">
						<div class="panel-heading">Latest Active Company</div>
						<div class="panel-body">
							 	<?php
							/* foreach($topcom as $com){
								$wher = array('id'=>$com['id']);
								$comp = $this->site_model->getwhere('bus_scheadual',$wher,'');
								$totcom = count($comp);
								$tcom[]  = $totcom;
								$avgcom = (max($tcom))/2;
								$tpcom = (max($tcom));
								if($totcom > $avgcom){
									$totbus[] = $com['id'];
								}
								if($totcom > $avgcom){ 
								   $toppercom[]  = $totcom; ?>
									<div class="col-md-12 row">
											<ul class="destinatoinss"><li><?php echo $com['name']; ?></li><ul>
									</div>
								<?php 
								}
								$allcom = count($com);
							}
							$offset = 15-count($totbus);
							$avgco =  array_slice($topcom, 0, $offset);
							foreach($avgco as $cmp){ ?>
								<div class="col-md-12 row">
									
									 <ul class="destinatoinss"><li><?php echo $cmp['name']; ?></li><ul>
								   
							</div>			
						   <?php } */?>  
						   
						   <?php 
						   $limit  = '0,6';
						   $latest = $this->site_model->getorderbylimit('company_setup','',$limit,'id','DESC');
						   foreach($latest as $lcom){?>
							   <div class="col-md-12 row">
									
									 <ul class="destinatoinss"><li><?php echo $lcom['name']; ?></li><ul>
								   
							</div>
							   <?php
						   }
						   ?>
						</div>
					</div>
								  
					</div>
                </div>
             </div>
				
		<div class="clearfix"></div>

