<?php $this->load->view('site/headerlinks'); ?>
 <?php $this->load->view('site/inc/header'); ?>
<div class="container">
            <?php $this->load->view('site/inc/breadcums');?>
            
			<h3 class="booking-title"><?php echo $page_title;?> </h3>
            

				<div class="col-md-6 servicelogin ">
					
					<div class="col-md-12 ticket-title">
						<div align="center">
							<p><span class="fa fa-user"></span> LOGIN</p>
						</div>
					</div>
					
					<form method="post" class="userloginPagefrom"   action="<?php echo base_url('user/login/customerservices') ;?>">
					<div class="row col-md-12 form-group">
					    <label>Email Address </label>
						<input name="email" style="border-radius:0px;" placeholder="Email Address" class="form-control"  type="text"/>
						<div class="required-icon">
                            <div class="text">*</div>
                        </div>
					</div>
					<div class="row col-md-12 form-group">
						 <label>Password </label>
						<input name="password" style="border-radius:0px;" placeholder="Password" class="form-control" type="password"/>
						<div class="required-icon">
                            <div class="text">*</div>
                        </div>
					</div>
				  
					<div class="row col-md-12">
					   <div class="checkbox checkbox-stroke checkboxcss" style="margin-top:0px;">
							<label><input class="i-check form-control"  name="iagree" type="checkbox" /> <small>Remember me</small> </label>
						</div>

					</div>
					 <div  class=" row col-md-4 form-group">
					   <button type="submit" name="loginbtn" value="lgn" class="btn btn-info btn-block btn-md">Login & Continue</button>
					</div>
					 <div class="col-md-4 form-group ticketinfo">
                       
                             <a href="<?php echo base_url('home');?>"  class="btn btn-danger btn-block btn-md">Go Back </a>
                        </div>
						
				</form>
				</div>
				<div class="col-md-6">
					<form method="post" class="pageticketearch"  action="<?php echo base_url('home/index/customerservices');?>">
					<div class="col-md-12 ticket-title">
						<div align="center">
							<p><span class="fa fa-ticket"></span> PRINT TICKET</p>
						</div>
					</div>
					
                     <div class="clearfix"></div>
                    
                        <div class="col-md-12 form-group ticketinfo">
                        <label>Your Ticket ID OR (PNR) Number</label>
                            <input style="border-radius: 0px;" name="pnr" placeholder="PNR" class="form-control"  type="text"/>
                            <div class="required-icon">
                                <div class="text">*</div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group ticketinfo">
                        <label>Your registered mobile no </label>
                            <div class="input-group">
                            <span class="input-group-addon">+977</span>
                            <input style="border-radius: 0px;" name="mobile" placeholder="Mobile No Used In Booking" class="form-control"  type="text"/>
                            </div>
                            <div class="required-icon">
                                <div class="text">*</div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group ticketinfo">
                        <label style="color:#fff;">. </label>
                             <button type="submit" name="searchticket" value="search" class="btn btn-info btn-block btn-md">Request </button>
                        </div>
						 <div class="col-md-4 form-group ticketinfo">
                        <label style="color:#fff;">. </label>
                             <a href="<?php echo base_url('home');?>"  class="btn btn-danger btn-block btn-md">Go Back </a>
                        </div>
                    
                
        </form>
				</div>

        <div class="clearfix"></div>
        <div class="gap"></div>
              
        </div>
        <?php $this->load->view('site/inc/footer'); ?>
        <?php $this->load->view('site/footerlinks'); ?>