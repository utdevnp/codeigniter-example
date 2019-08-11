<div class="container">
            <div class="row row-wrap" data-gutter="60">
                <div class="col-md-4">
                    <div class="thumb">
                        <header class="thumb-header"><i class="fa fa-dollar box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
                        </header>
                        <div class="thumb-caption">
                            <h5 class="thumb-title"><a class="text-darken" href="http://databankbooking.com/busticket/information/single/best-price-guarantee-">Best Price Guarantee</a></h5>
                           <!--  <p class="thumb-desc">Eu lectus non vivamus ornare lacinia elementum faucibus natoque parturient ullamcorper placerat</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumb">
                        <header class="thumb-header"><i class="fa fa-lock box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
                        </header>
                        <div class="thumb-caption">
                            <h5 class="thumb-title"><a class="text-darken" href="http://databankbooking.com/busticket/information/single/trust-and-seafty-">Trust & Safety</a></h5>
                            <!-- <p class="thumb-desc">Imperdiet nisi potenti fermentum vehicula eleifend elementum varius netus adipiscing neque quisque</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumb">
                        <header class="thumb-header"><i class="fa fa-thumbs-o-up box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
                        </header>
                        <div class="thumb-caption">
                            <h5 class="thumb-title"><a class="text-darken" href="http://databankbooking.com/busticket/information/archive/best-travel-company">Best Travel Agent</a></h5>
                           <!--  <p class="thumb-desc">Curae urna fusce massa a lacus nisl id velit magnis venenatis consequat</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default whydbook">
						<div class="panel-heading">Why Databank Booking ? </div>
						<div class="panel-body">
							<div class="col-md-2 iconinfo">
								<big>05</big><br> <small>Hundreds</small>
							</div>
							<div class="col-md-10 whydbinfo">
								<b>Customer Satisfaction</b><br>
								<p>Superior customer service, 24x7 Dedicated helpline.</p>
							</div>
							
							<div class="col-md-2 iconinfo">
								<i class="fa fa-suitcase"></i>
							</div>
							<div class="col-md-10 whydbinfo">
								<b>Nepal's Leading Online Booking Company</b>
								<p>Databank Booking Established in 2017 and growing stronger.</p>
							</div>
							
							<div class="col-md-2 iconinfo">
								<i class="fa fa-usd"></i>
							</div>
							<div class="col-md-10 whydbinfo">
								<b>Best Price Guarantee</b>
								<p>Great experiences at lowest prices guaranteed.<p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default whydbook">
					<?php
							$where  = array('title'=>'Booking Feature','is_active'=>'Y');
							$limit = '4,0';
							$pages  =  $this->site_model->getwhere('page_category',$where,$limit);
							foreach($pages as $pag){?>
								<div class="panel-heading"><a href="<?echo site_url().'information/archive/'.$pag['slug'];?>"><?php echo $pag['title'];?></a></div>
								<div class="panel-body"><a href="<?echo site_url().'information/archive/'.$pag['slug'];?>"><p> <?php echo $pag['content'];?></p></a></div>
							<?php } ?>
						
						
							
						
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="panel panel-default whydbook">
						<div class="panel-heading">Customer Services</div>
						<div class="panel-body">
							<div class=" customersrv">
								<a href="<?php echo base_url('user/customerservices');?>">
								<div class="col-sm-4">
									<div  class="cuntomureservoce round-sm hollow">
										<span class="fa fa-print"></span>
									</div>
									<div class="clearfix"></div>
									<a class="clinks" href="<?php echo base_url('user/customerservices');?>">Print eTickets</a>
								</div>
								</a>
								<a href="<?php echo base_url('user/customerservices');?>">
								<div class="col-sm-4">
									<div align="center" class="cuntomureservoce round-sm hollow">
										<span class="fa fa-file-excel-o"></span>
									</div>
									<div class="clearfix"></div>
									<a class="clinks" href="<?php echo base_url('user/customerservices');?>">Cancellation</a>
								</div>
								</a>
								<a href="<?php echo base_url('user/customerservices');?>">
								<div class="col-sm-4">
									<div align="center" class="cuntomureservoce round-sm hollow">
										<span class="fa fa-address-book"></span>
									</div>
									<div class="clearfix"></div>
									<a class="clinks" href="<?php echo base_url('user/customerservices');?>">Travel History</a>
								</div>
								</a>
								<a href="<?php echo base_url('user/customerservices');?>">
								<div class="col-sm-4 nextservices">
									<div align="center" class="cuntomureservoce round-sm hollow">
										<span class="fa  fa-envelope-o"></span>
									</div>
									<div class="clearfix"></div>
									<a class="clinks" href="<?php echo base_url('information/single/contact-us');?>">Contact with us</a>
								</div>
								</a>
								<a href="<?php echo base_url('user/customerservices');?>">
								<div class="col-sm-4 nextservices">
									<div align="center" class="cuntomureservoce round-sm hollow">
										<span class="fa fa-question"></span>
									</div>
									<div class="clearfix"></div>
									<a class="clinks" href="">Read FAQs</a>
								</div>
								</a>
								<a href="<?php echo base_url('user/customerservices');?>">
								<div class="col-sm-4 nextservices">
									<div align="center" class="cuntomureservoce round-sm hollow">
										<span class="fa fa-phone"></span>
									</div>
									<div class="clearfix"></div>
									<a class="clinks" href="<?php echo base_url('user/customerservices');?>">Your Complaints</a>
								</div>
								</a>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>