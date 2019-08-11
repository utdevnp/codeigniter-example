<div class="top-area show-onload">
            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-parallax" style="background-image:url(<?php echo base_url('assets/site/img/196_365_2048x1365.jpg');?>);"></div>
                <div class="bg-content">
                    <div class="container">
                        <div class="row bussearchscroll">
						 <div class="container offers">
							<marquee> Databank Open To Create Company Account For Bus Ticketing System.</marquee>
						</div>
			 
                            <div class="col-md-8">
                                <div class="search-tabs search-tabs-bg mt50">
                                 
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                          
                                            <li class="active"><a href="<?php echo base_url();?>#tab-1" data-toggle="tab"><i class="fa fa-bus"></i> <span >Bus</span></a>
                                            </li>
                                            
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="tab-1">
                                                <h2>Search for Buses</h2>
                                                <?php
                                                    if($this->input->post('searchBtn')==="sbus"){
														$this->form_validation->set_rules('from','From','required');
														$this->form_validation->set_rules('to','From','required');
														$this->form_validation->set_rules('date','From','required');
														if($this->form_validation->run() == FALSE){
															$this->session->set_userdata($this->messages->SearchEmpty());
															redirect('home');
														}else{
                                                        $from = $this->input->post('from');
                                                        $to = $this->input->post('to');
                                                        $date = nice_date($this->input->post('date'),'Y-m-d'); 
														
                                                        $oper = "/";
                                                        $path = "home/searchbus/";
                                                        $url = $path.$from.$oper.$to.$oper.$date;
                                                        redirect($url);
														}
                                                    }
                                                ?>

                                                <form method="post" id="searchform" action="<?php //echo base_url('Api/bussearch/');?>">
                                                    <div class="tabbable">
                                                        
                                                        <div class="tab-content">
                                                            <div class="tab-pane in active fade" id="flight-search-2">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon-left"></i>
                                                                            <label>From</label>
                                                                            <select required="required" name="from" style="width: 100%" class="form-control select2 input-md">
                                                                            <option value="">Select Departure </option>
                                                                            <?php foreach($places as $place){?>
                                                                                
                                                                                <option value="<?php echo $place['id'];?>"><?php echo $place['from'];?></option> 
                                                                            <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon-left"></i>
                                                                            <label>To</label>
                                                                            <select required="required" name="to" style="width: 100%" class="form-control select2">
                                                                            <option value="">Select Destination </option>
                                                                            <?php foreach($places as $place){?>
                                                                                
                                                                                <option value="<?php echo $place['id'];?>"><?php echo $place['from'];?></option> 
                                                                            <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group form-group-md  form-group-icon-left"><i class="fa fa-calendar input-icon"></i>
                                                                            <label>Departing</label>
                                                                            <input required class="date-pick form-control" name="date" data-date-autoclose="true" data-date-start-date="1d" data-date-format="M d, D" type="text" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-lg " type="submit" name="searchBtn" value="sbus">Search for Buses</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                            <div class="col-md-4 homeoffer">
								<div class="topoffer col-md-12">
								</div>
                                <div class="col-md-12 hidden-xs hidden-sm offerslider">
                                    <?php // crusural start ;?>
									<div id="myCarousel" class="carousel slide" data-ride="carousel">
										<!-- Indicators -->
										<ol class="carousel-indicators">
										  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
										  <li data-target="#myCarousel" data-slide-to="1"></li>
										</ol>

										<!-- Wrapper for slides -->
										<div class="carousel-inner" role="listbox">
										  <div class="item active">
											<img src="<?php echo base_url('assets/site/img/people_on_the_beach_800x600.jpg');?>" alt="Chania">
										  </div>

										  <div class="item">
											<img src="<?php echo base_url('assets/site/img/people_on_the_beach_800x600.jpg'); ?>" alt="Chania" >
										  </div>
										
										 
										</div>

										<!-- Left and right controls -->
										<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
										  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
										  <span class="sr-only">Previous</span>
										</a>
										<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
										  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
										  <span class="sr-only">Next</span>
										</a>
									  </div>
									  <?php /// crusural end ///?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>