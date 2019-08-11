<footer id="main-footer">
            <div class="container">
                <div class="row row-wrap">
                    <div class="col-md-3">
                        <a class="logo" href="index.html">
                           <!--  <img src="http://localhost:2052/busticket/assets/site/img/logo-invert.png" alt="Image Alternative text" title="Image Title" /> -->
                        </a>
                        <p class="mb20">Databank Booking </p>
                        <ul class="list list-horizontal list-space">
                            <li>
                                <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href=""></a>
                            </li>
                            <li>
                                <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href=""></a>
                            </li>
                            <li>
                                <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href=""></a>
                            </li>
                            <li>
                                <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href=""></a>
                            </li>
                            <li>
                                <a class="fa fa-pinterest box-icon-normal round animate-icon-bottom-to-top" href=""></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h4>Newsletter</h4>
                        <form>
                            <label>Enter your E-mail Address</label>
                            <input type="text" class="form-control">
                            <p class="mt5"><small>*We Never Send Spam</small>
                            </p>
                            <input type="submit" class="btn btn-primary" value="Subscribe">
                        </form>
                    </div>
                    <div class="col-md-2">
                        <ul class="list list-footer">
						 <?php
							$where  = array('category'=>'pages','is_active'=>'Y');
							$limit = '4,0';
							$pages  =  $this->site_model->getwhere('content_serup',$where,$limit);
							foreach($pages as $pag){?>
								<li><a href="<?echo site_url().'information/single/'.$pag['slug'];?>"><?php echo $pag['title'];?></a></li>	
							<?php } 
							$where  = array('category'=>'dynamic post','is_active'=>'Y');
							$pos =  $this->site_model->getwhere('content_serup',$where,$limit);
							foreach($pos as $posts){?>
								<li><a href="<?echo site_url().'information/archive/'.$posts['slug'];?>"><?php echo $posts['title'];?></a></li>	
							<?php } ?>
                           
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Have Questions?</h4>
                        <h4 class="text-color">+977 01 4102838</h4>
                        <h4><a href="" class="text-color">support@databankbooking.com</a></h4>
                        <p>24/7 Dedicated Customer Support</p>
                    </div>

                </div>
            </div>
        </footer>
		