<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
          

<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            <h3 class="booking-title"><?php echo $page_title;?> </h3>

            <form method="post" id="linkchangeasswordForm" action="<?php echo base_url('user/changepass/'.htmlentities($this->uri->segment(3)));?>">
            <div class="col-md-12 row">
                <div class="row">
					<div class="form-group col-md-4">
						<strong>Please enter detail to change password</strong> 
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-4">
						<label>New Password </label>
						<input class="form-control" type="password" name="password" placeholder="New Password ">
						<div class="required-icon">
							<div class="text">*</div>
						</div>
                    </div>
					<div class="form-group col-md-4">
						<label>Confirm Password </label>
						<input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password">
						<div class="required-icon">
							<div class="text">*</div>
						</div>
                    </div>
					<div class="form-group col-md-2">
						<label style="color:#fff;">. </label>
						<button type="submit" name="updatepw" value="update" class="btn btn-danger btn-block btn-md"><i class="fa fa-key"> </i> Change  </button>
                    </div>
                </div>
            </div>
           </form>

        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>