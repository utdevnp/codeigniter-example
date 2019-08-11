<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php //echo $page_title;?> </h3>
            <div class="col-md-12">
                <div class="row">
					<div align="center" class="col-md-12 centered">
						<div class="erroricon">
							<i class="fa fa-times cross" aria-hidden="true"></i>
						</div>
						<h3>Transaction was not successful !!</h3>
						<p>Your processed transaction was not successful because something is wrong while you transacting. Thank you for Processing <a href="<?php echo base_url('home')?>">Go Back</a></p>
						
					</div>
            </div>
        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
	</div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>