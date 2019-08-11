 <noscript>
	<div class="col-md-12 redmsg" id="ntfndmsg" style="height:56px;">
		<div class="container">
			<div style="overflow: hidden;" class="alert notice notice-danger">
				<strong style="font-size:18px; color:#a94442;"> <i style="font-size:22px; color:red;" class="fa fa-exclamation-triangle"></i> Something Went Wrong !! JavaScript Not running in your browser <small> Databankbooking not running properly</small>  </strong> 
			</div>
		</div>
	</div>		
</noscript>

 <header id="main-header">
            <?php
			
			if($this->session->userdata('msg_id')){ ?>  
            <div class="col-md-12 <?php if($this->session->userdata('id')){echo $this->session->userdata('id');}?>" id="ntfndmsg">
            <div class="container messagecls">
                <div style="overflow: hidden;" class="alert notice notice-<?php echo $this->session->userdata('class');?>">
                    
                    <strong><?php echo  $this->session->userdata('title');?> !!  </strong> 
               
                </div>
            </div>
            </div>
            <?php } ?>
			
             <form method="post" id="ticketSearch" action="<?php echo base_url('home');?>">
            <div class="collapse col-md-12 printtck" id="printticketnum">
              <?php  //print_r($user);
				?>
                <div class="container">
                 <div class="row">
                    <div class="col-md-6 ticket-title">
                        <p><span class="fa fa-ticket"></span> PRINT TICKET</p>
                    </div>
                     <div class="clearfix"></div>
                    
                        <div class="col-md-3 form-group ticketinfo">
                        <label>Your Ticket ID OR (PNR) Number</label>
                            <input style="border-radius: 0px;" required="required" name="pnr" placeholder="PNR" class="form-control"  type="text"/>
                            <div class="required-icon">
                                <div class="text">*</div>
                            </div>
                        </div>
                        <div class="col-md-3 form-group ticketinfo">
                        <label>Your registered mobile no </label>
                            <div class="input-group">
                            <span class="input-group-addon">+977</span>
                            <input style="border-radius: 0px;" required="required"  name="mobile" placeholder="Mobile No" class="form-control"  type="text"/>
                            </div>
                            <div class="required-icon">
                                <div class="text">*</div>
                            </div>
                        </div>
                        <div class="col-md-2 form-group ticketinfo">
                        <label style="color:#fff;">. </label>
                             <button type="submit" name="searchticket" value="search" class="btn btn-danger btn-block btn-md">Request </button>
                        </div>
                    
                 </div>
                </div>
                 <div class="fullborder"> </div>
            </div>
        </form>
            <div class="clearfix"></div>
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="logo" href="<?php echo base_url();?>">
                                <img src="<?php echo base_url('assets/site/img/logo.png');?>" alt="<?php echo $page_title;?>" hight="70" width="300"  title="<?php echo $page_title;?>" />
                            </a>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
						
                        <div class="col-md-5 toprightmenu">
                       

                        <div class="col-md-10 col-xs-12">
						
                        <ul class="nav navbar-nav navbartop navbar-right">
						<li class="printticket">
							<a href="#printticketnum"  data-toggle="collapse" >
								<i class="fa fa-ticket"></i> 
								<strong>Print</strong>
								<small>eTickets</small>
							</a>
                        </li>
							
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i> 
                                    <strong><?php if($this->session->userdata('DBUserH')){ echo "Hi";}else{echo 'Login';};?></strong>
                                    <small> <?php if($this->session->userdata('DBUserH')){ echo substr($this->session->userdata('DBUserH'),0,10);}else{echo 'My Account';};?> </small>
                                    <span class="fa fa-chevron-down icon-down"></span>
                                </a>
                            <ul class="dropdown-menu" onClick="event.stopPropagation();">
                                <li >
                                    <div class="navbar-login">
                                        <div class="row">
                                        <?php if(!$this->session->userdata('DBUserH')){;?>
                                        <div class="col-md-8 row loginborder" id="loginbar">
                                        <form method="post" id="userloginForm" action="<?php echo base_url('user/login') ;?>">
                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-user input-icon-left-top"></i>
                                                <input name="email" placeholder="Email Address" required="required" class="form-control"  type="email"/>
                                            </div>
                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-lock input-icon-left-top"></i>
                                                <input name="password" placeholder="Password" required="required" class="form-control" type="password"/>
                                            </div>
                                          
                                            <div class="col-md-12">
                                               <div class="checkbox checkbox-stroke checkboxcss" style="margin-top:0px;">
                                                    <label><input class="i-check form-control"  name="iagree" type="checkbox" /> <small>Remember me</small> </label>
                                                </div>

                                            </div>
                                             <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                               <button type="submit" name="loginbtn" value="lgn" class="btn btn-info btn-block btn-sm">Login & Continue</button>
                                            </div>
                                        </form>
                                             <div class="col-md-12 form-group form-group-md form-group-icon-top forget">
                                                    <p> <a href="javascirpt:void(0)" id="forgotpassword">Forgot your password? </a> <a class="notamember" href="javascirpt:void(0)"> Not Member ?</a></p> 
                                            </div>
											<div class="col-md-12 form-group form-group-md form-group-icon-top forget">
											 <button type="button"  class="btn btn-primary btn-block btn-sm notamember">Not Member? Create account</button>   
                                            </div>
                                            <div class="clearfix"></div>
                                            <div align="center"><big>OR</big></div>
											<!--fb:login-button class="btn btn-block btn-social btn-facebook" scope="public_profile,email" onlogin="checkLoginState();" id="status">
											</fb:login-button -->
										   <div class="col-md-12 form-group form-group-md form-group-icon-left social-buttons">
		
												<a href="<?php //echo $authUrl;?>" class="btn btn-block btn-social btn-facebook">
                                                    <i class="fa fa-facebook btn-social-icon pull-left"></i> Sign in with Facebook
                                                </a>
                                                <a class="btn btn-block btn-social btn-google-plus">
                                                    <i class="fa fa-google-plus btn-social-icon pull-left"></i> Sign in with Google
                                                </a>
                                                
                                            </div>
                                          </form>
                                        </div>

                                         <div id="registerbar" class="col-md-8 row loginborder">
                                         <div class="clearfix"></div>
                                            <div align="center"><b>CREATE AN ACCOUNT</b></div>
                                         <div class="clearfix"></div>
                                         <form method="post" id="usersignupForm" action="<?php echo base_url('user/register');?>">
                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-user input-icon-left-top"></i>
                                                <input id="email1221" name="email" placeholder="Email Address" required="required" class="form-control" type="email"/>
                                                <small id="ajaxmessage"></small>
                                            </div>
                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-lock input-icon-left-top"></i>
                                                <input name="password" required="required" placeholder="Password" class="password form-control" type="password"/>
                                            </div>
                                             <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-lock input-icon-left-top"></i>
                                                <input name="confirmPassword" required="required" placeholder="Confirm Password" class="form-control" type="password"/>
                                            </div>

                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-mobile input-icon-left-top"></i>
                                                <input name="mobile_no" required="required" placeholder="Mobile No" class="form-control"  type="text"/>
                                            </div>
                                          
                                            <div class="col-md-12 form-group">
                                               <div class="checkbox checkbox-stroke checkboxcss" style="margin-top:0px;">
                                                    <label><input class="i-check" required="required"  type="checkbox" name="aterms" /> <small><a href="">I agree to the Terms & Condition</a></small> </label>
                                                </div>

                                            </div>
                                             <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                               <button type="submit"  name="create" value="user" class="btn btn-danger btn-block btn-sm">Create Account</button>
                                            </div>
                                        </form>
                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                               <button type="submit" class="btn btn-primary btn-block btn-sm memberlogin">Already Registered? Login</button>
                                            </div>

                                            <div class="clearfix"></div>
                                         </div>

                                         <div id="forgotbox" class="col-md-8 row loginborder">
                                          <div align="center"><b>FORGOT YOUR PASSWORD? </b></div>
                                         <div class="clearfix"></div>
                                         <form method="post" id="forgetform" action="<?php echo base_url('user/forgetpassword');?>">
                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                                <i class="fa fa-user input-icon-left-top"></i>
                                                <input name="frogetemail" required="required"  placeholder="Email" class="form-control" type="email"/>
                                            </div>

                                            <div class="col-md-12 form-group form-group-md form-group-icon-top">
                                               <button type="submit" name="forgetpw" value="pw"  class="btn btn-danger btn-block btn-sm"> Get </button>
                                            </div>
                                        </form>
                                             <div class="col-md-12 form-group form-group-md form-group-icon-top forget">
                                                    <p> <a href="javascirpt:void(0)" class="memberlogin">Back to login </a> </p> 
                                            </div>
                                         </div>
                                         <?php }else{;?>
                                         <div class="col-md-8 row loginborder">
                                            <div class="col-md-4">
                                                <p class="text-center">
                                                    <img src="<?php echo base_url('./uploads/users/user20170215-105222.jpg');?>" class="img-circle" alt="User Image">
                                                </p>
                                            </div>
                                            <div class="col-md-8 profileimg">
                                                <p class="text-center"><strong>
                                                <?php 
                                                $where = array('email'=>$this->session->userdata('DBUserH'));
                                                    $user = $this->dynamic_query->getbywhere('bus_user',$where);
                                                    foreach($user as $us){
                                                          $name = $us['fname']." ".$us['lname'];
                                                          if(empty($name)){
                                                            echo "User";
                                                          }else{
                                                           echo  $name ; 
                                                          }
                                                    }
                                                ?>
                                                </strong></p>
                                                <p class="text-center"><big class="text-success">
                                                Reward
                                                    <?php 

                                                      if($this->session->userdata('DBUserH')){
                                                        $where = array('email'=>$this->session->userdata('DBUserH'));
                                                         $user_id = $this->site_model->getbususerbyfield('bus_user',$where,'id');
                                                      }else{
                                                        $user_id= 0;
                                                      }

                                                      $where = array('cuserid'=>$user_id);
                                                      $reward  = $this->dynamic_query->getbywhere('passengers_ticket_info',$where);
                                                    $total = 0; foreach($reward as $re){
                                                   $total =  $re['cuserreward'] + $total;
                                                } echo $total; ?>
                                                 </big></p>
                
                                             </div>
                                             <div class="clearfix"></div>
                                              
                                             <div class="col-md-12">
                                              <div class="usermenu">
                                                <a href="<?php echo base_url('user/index/update');?>">Update Profile</a> 
                                                <a href="<?php echo base_url('user/index/changepassword');?>">Change Password</a>
                                              </div>
                                            </div>
                                         </div>
                                         <?php } ?>
                                       
                                         <div class="col-md-4 loginmanage pull-right">
                                         <div class="clearfix"></div>
                                                <p><a href="<?php if($this->session->userdata('DBUserH')){echo base_url('user');}else{echo "javasccript:void(0);";}?>" <?php if(!$this->session->userdata('DBUserH')){echo "data-toggle='tooltip' data-placement='top' title='Login to view details'";}?>>My Account</a></p>
                                                <p><a href="<?php if($this->session->userdata('DBUserH')){echo base_url('user/index/history');}else{echo "javasccript:void(0);";}?>" >Travel History</a></p>
												<?php if($this->session->userdata('DBUserH')){;?>
                                               <p> <a class="text-danger" href="<?php echo  base_url('user/logout');?>">Logout <i class="fa fa-sign-out text-danger"></i></a></p>
											   <?php } ?>
                                        </div>

                                        <div class="clearfix"></div>

                                           
                                        </div>
                                    </div>
                                </li>
                            </ul>
                           </li>
                            
                        </div>
						 <div class="col-md-2 hidden-xs">
							<img style="width:67%;" src="<?php echo base_url('assets/site/img/nepalflag.png');?>" height="30" width="29" alt="Flag of Nepal" title="Flag of Nepal"/>
						 </div>
                    </div>

                    </div>
                </div>
            </div>
			<?php
				$where  = array('category'=>"Primary menu");
				$content   = $this->site_model->returnfield('content_serup',$where,'');
				?>
            <div class="container menubg">
                <div class="nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li class="<?php if($this->uri->segment(1)=="home" OR $this->uri->segment(1)==""){echo "active";};?>"><a href="<?php echo base_url();?>">  HOME</a></li>  
						<li class="<?php if($this->uri->segment(3)=="news-and-events"){echo "active";}?>"><a href="<?php echo base_url().'information/archive/news-and-events';?>"> News & Events</a></li>
						<?php 
						foreach($content as $pmenu){ ?>
							 <li class="<?php if($this->uri->segment(3)==$pmenu['slug']){echo "active";}?>"><a href="<?echo site_url().'information/single/'.$pmenu['slug'];?>"><?php echo $pmenu['title'];?></a></li>
							 <?php
						}
						?>
                    </ul>
                </div>
            </div>
        </header>