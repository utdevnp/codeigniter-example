<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?> </h3>
            
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
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                                <!-- flight section -->
                                <div class="bhoechie-tab-content active">
                                    <section class="invoice">
      <!-- title row -->            <div class="box-body">
										<?php foreach($all as $archive){ ?>
										 <div class="bhoechie-tab-content active"><h2><a href="<?echo site_url().'information/single/'.$archive['slug'];?>"> <?php echo $archive['title'];?></a></h2> </div>
										 <div class="clearfix"> </div>
										 <div class="bhoechie-tab-content active"> <?php echo $archive['content'];?> </div>
										 <div class="clearfix"> </div>
										<?php
											
										}?>
						  
									 </div>
                                    
                                    </section>
                                </div>                               
                            </div>
                        </div>
                  </div>
            </div>

        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>