<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php //echo $page_title;?> </h3>
            <div class="col-md-12">
                <div class="row">
					<div align="center" class="col-md-12 centered">
						<div class="successicon">
							<i class="fa fa-check rignticon" aria-hidden="true"></i>
						</div>
						<h3>Ticket is successfully sent in your email !!</h3>
						<p>Your eTicket is successfully sent in email please check in email . if you have any quires please contact us to <a href="mailto:support@databankbooking.com">support@databankbooking.com</a>  OR   <a href="<?php echo base_url('home')?>">Go Back Home</a></p>
						
					</div>
            </div>
        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
	</div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>