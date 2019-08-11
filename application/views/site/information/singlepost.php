<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
           
            
            <div class="col-md-12">
				
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9 bhoechie-tab-container">
                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                              <div class="box-body">
							    <?php foreach($cat as $catg){ ?>
								 <div class="bhoechie-tab-content active"><a href="<?php echo site_url().'information/archive/'.$catg['slug'];?>"> <?php echo $catg['title'];?></a> </div>
								 <div class="clearfix"> </div>
								 
								<?php
									
								}?>
          		  
							 </div>
                            </div>
							<?php foreach($all as $data){?>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                                <!-- flight section -->
                                <div class="bhoechie-tab-content active">
                                    <section class="invoice">
      <!-- title row -->            <h3 class="booking-title"><?php echo $data['title'];?> </h3>
                                    <p> <?php echo $data['content'];?></p>
                                    </section>
                                </div>                               
                            </div>
							<?php }?>
                        </div>
                  </div>
				  
            </div>

        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>