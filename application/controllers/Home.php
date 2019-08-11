<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->library('facebook');
		$this->load->model('dynamic_query');
		$this->load->model('site_model');
		$this->load->model('Activity_model');
		$this->load->model('static_model');
		$this->load->model('messages');
		$this->load->helper('date');
		$this->load->helper('string');
		$this->load->library('form_validation');
	
	}
	

	function index()
	{

		/* $data['user'] = array();
		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,name,email');
			
			$data['user'] = $user;
			
		}
		 $data['authUrl'] =  $this->facebook->login_url();
		
		 */
		
		$data['page_title'] = "Databank Nepal Bus Ticketing Service ";
		$data['ticket_ttile'] = "Search Ticket ";
		$data['places'] = $this->dynamic_query->getallactive('root_setup','Y');
	    $data['toprouth'] =  $this->site_model->getwhere('root_setup','','');
		$data['topcom'] =  $this->site_model->getwhere('company_setup','','');

		if($this->input->post('searchticket')==='search'){
			$this->form_validation->set_rules('pnr','PNR','numeric|min_length[9]|max_length[9]');
			if($this->form_validation->run() == FALSE){
			        redirect('home');
				}else{
					$ticket 	= 	$this->input->post('pnr');
					$mobile 	= 	$this->input->post('mobile');
					
					$where = array('ticketid'=>$ticket,'contact'=>$mobile);
					$alltic 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);

					if(count($alltic)<=0){

						$this->session->set_userdata($this->messages->ticketnotfound());
						if( $this->uri->segment(3) == 'customerservices'){
							redirect('user/customerservices');	
						}else{
							redirect('home');
						}
					}else{
						foreach($alltic as $tid){
							$tikcetid =$tid['ticketid']; 
							$ref_code =$tid['ref_code']; 
						}
						redirect(base_url('home/getticket/'.$tikcetid."?q=su&refId=".$ref_code));
						foreach($alltic as $mysche){
							$sid  		= 	@$mysche['sid'];
							$infoid  	= 	@$mysche['id'];
						}
					}
				}
				

			} else {
				// $this->session->set_userdata($this->messages->ticketnotfound());
			 // 	redirect('home');
		}
		 // home content 
		$this->load->view('home',$data);
	}

	function searchbus(){
		$data['page_title'] = "Search Bus";
		$infofiesds 		=	"sid,id";
		$data['places'] = $this->dynamic_query->getallactive('root_setup','Y');
		$data['busno']		=	$this->dynamic_query->getall('bus_setup');
		$data['info']		=	$this->dynamic_query->select_fields('','passengers_ticket_info',$infofiesds);
		$data['detail']		=	$this->dynamic_query->select_fields('','passengers_detail','seat');
		$data['busname']	=	$this->dynamic_query->getall('bus_name_setup');
		$data['busfetures']	=	$this->dynamic_query->getall('feature_setup');
		$data['busrot']		=	$this->dynamic_query->getall('root_setup');
		$data['buscatagory'] =	$this->dynamic_query->getall('category_setup');
		$data['temp_sid']    =  $this->site_model->returnfield('temp_sheet','','sid');
		$data['busno']		=	$this->dynamic_query->getall('bus_setup');
		$data['allcom']		=	$this->dynamic_query->getall('company_setup');
		$data['busrot']		=	$this->dynamic_query->getallactive('root_setup','Y');
		$table 					=	"bus_scheadual";
		if($this->input->post('searchBtn')==='sbtn'){
			print_r($this->input->post());
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			$date = nice_date($this->input->post('date'),'Y-m-d');
		}else{
			 $from = $this->uri->segment(3);
			 $to = $this->uri->segment(4);
			$date = nice_date($this->uri->segment(5),'Y-m-d');
		}

		if($this->input->post('updatesearch')==='update'){
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			$date = nice_date($this->input->post('date'),'Y-m-d');
			$tim = $this->input->post('time');
			$shift = $this->input->post('shift');
		}else{
			 $from = $this->uri->segment(3);
			 $to = $this->uri->segment(4);
			$date = nice_date($this->uri->segment(5),'Y-m-d');
			$timeA = $this->uri->segment(6);
			$timeB = $this->uri->segment(7);
			$times = explode(':', $this->uri->segment(6));
			 
			 if(count(str_split($times[0]))===1){
			  	$time = "0".$timeA." ".$timeB;
			 }
			else{ $time = $timeA." ".$timeB;}
			$shift = $this->uri->segment(8);
		}

		if($from AND $to  AND  $date AND $time AND $shift){
			$where = array('from'=>$from,'to'=>$to,'departure'=>$date,'departuretime'=>$time,'shift'=>$shift);
			@$data['busschedule']  = $this->dynamic_query->getbywhere($table,$where);
			$this->load->view('site/search',$data);
		}
		else if($from AND $to  AND  $date){
			$data['title'] 			=  	"Search Results";
			$active 				=	"Y";
			@$data['busschedule']		=	$this->dynamic_query->search_by_all($table,$date,$from,$to,$active);
			$this->load->view('site/search',$data);		
			
		}
		else{
			$this->load->view('site/search',$data);		
		}
		
	}

	function travallers(){
		$data['page_title'] = "Travellers Details";
		if($this->input->post('contbooking')==="myseats"){
			 $departuredate 		=	$this->input->post("ticket_date");
			$from 						=   $this->input->post("inputfrom");
			 $to  						=   $this->input->post("inputto");
			
			$id  						=   $this->input->post("sid");
			$seat 						=	$this->input->post("seats");
			$where = array('sid'=>$id);
			$bookedids = $this->site_model->returnfield('passengers_ticket_info',$where,'');
			$queue = $this->site_model->returnfield('temp_sheet',$where,'seats');
				foreach($bookedids as $seatsdet){
					
					$info= array('info_id'=>$seatsdet['id']);
					 $booked = $this->site_model->returnfield('passengers_detail',$info,'');
					foreach($booked as $totseats){
						$booked_seats[] =  $totseats;
					}
				}
				$totnum = count(@$booked_seats);
				$totsesected = count(@$seat);
				
				for($m=0;$m<@$totsesected;$m++){
					for($n=0;$n<@$totnum;$n++){
						if(@$booked_seats[$n]==@$seat[$m]){
							$this->session->set_userdata('sid',$id);
							$this->session->set_userdata($this->messages->Not_available());
			        	    redirect('home/searchbus/'.$from."/".$to."/".$departuredate);
						}
					}
				}
					if(@$queue){
						$corrent  = implode(',', @$queue);
						$queue_exp  =  explode(',', @$corrent);
						$queue_tot = count(@$queue_exp);
						for($m=0;$m<@$totsesected;$m++){
							for($o=0;$o<$queue_tot;$o++){
								if(@$queue_exp[$o]==@$seat[$m]){
									$this->session->set_userdata($this->messages->Not_available());
									redirect('home/searchbus/'.$from."/".$to."/".$departuredate);
								}
							} 
						}
					
					} 
			//temporary data  sotore
			$dta['sid'] = $id;
			$dta['seats'] = implode(',', $seat);
			$dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
			$dta['tmptime'] = $dateTime->format("h:i A");
			$this->db->insert("temp_sheet",$dta);
			$data['tmp_id'] = $this->db->insert_id();
			//
			
			
			$data['primaryheader'] 		= 	'Counter Booking';
			$data['title'] 				=  	"Passenger Detail form";
			$data['tprice'] 			=	$this->input->post("total");
			$data['sid'] 				=	$id;
			$data['departuredate'] 		=	$this->input->post("ticket_date");
			$fields 					=	"droppingpoint,droppingtime,boardingpoint,boardingtime";
		    $data['points']				=	$this->dynamic_query->select_fields($id,'bus_scheadual',$fields);
		    $data['busno']				=	$this->dynamic_query->getbyscheadual($id,'bus_scheadual','bus_setup','bus_no','bus_no');
		    $data['busno']				=	$this->dynamic_query->getbyscheadual($id,'bus_scheadual','bus_setup','bus_no','bus_no');
			$data['buscom'] 			=	$this->input->post("buscompany");
		    $data['counter']			=	$this->dynamic_query->getby($data['buscom'],'company_setup','id');
		    $data['allrot']				=	$this->dynamic_query->getall('root_setup');
			$data['buscat'] 			=	$this->input->post("buscategory");
			$data['scheadual']			=	$this->dynamic_query->getbyid($id,'bus_scheadual');
			$data['allcatagory'] 		=	$this->dynamic_query->getall('category_setup');
		    $data['allbusnames']		=	$this->dynamic_query->getall('bus_name_setup');
		    // getting useer data when session stert 
		    if($this->session->userdata('DBUserH')){
				$where = array('email'=>$this->session->userdata('DBUserH'));
			 	$user_id = $this->site_model->getbususerbyfield('bus_user',$where,'id');
			}else{
				$user_id= 0;
			}
			$where = array('id'=>$user_id);
			$data['useremail']  = $this->site_model->getbususerbyfield('bus_user',$where,'email');
			$data['userphone']  = $this->site_model->getbususerbyfield('bus_user',$where,'mobile_no');

			if($seat!=""){
				$data['selected'] 		=	implode(',',$this->input->post("seats"));
		      }
		    $data['counter']	=	$this->dynamic_query->getby($data['buscom'],'company_setup','id');
			$this->load->view('site/passengerdtl',$data);
			}
  		}

  		function confirmation()
  		{
  			if($this->input->post('pdetail')==='detail'){
	  			$sid =    $this->input->post('sid');
				$bysid  = array('id'=>$sid);
				$comid = $this->site_model->returnfield('bus_scheadual',$bysid,'company');
				$tmp_id			=    $this->input->post('tmp_id');
				$disc 			=    $this->input->post('discount');
				$grossamount 	= 	$this->input->post("tamount");
				$cat 			= 	$this->dynamic_query->nestedselect("bus_scheadual",'bus_no','bus_setup',$sid,'bus_category','id','category_setup');
			    $coupon_code 	= 	$this->input->post("coupon");
				$com 			= 	$this->input->post("buscompany");
				$issue_date 	= 	nice_date($this->input->post("departure"),'M d Y');
				$coupon_discuout=	$this->dynamic_query->getallactive('offer_setup','Y');	

				if(count($coupon_discuout) > 0)
				{
					foreach($coupon_discuout as $offer){

					    $osd  		=  	nice_date($offer['offer_from'],'M d Y');
					    $oed 		= 	nice_date($offer['offer_to'],'M d Y');
					    
						$cou 		=  	$offer['coupon'];
						$discount   =	$offer['offer_discount'];
						$company 	=	$offer['company'];
						$bus_cat 	=	$offer['category'];
					}
				
					 $range 	=	date_range($osd, $oed);
					 $days  	= 	count($range); 
					 if($coupon_code	==	$cou AND $com 	==	$company AND $cat 	==	$bus_cat){

					  	$data['total']		= 	$grossamount-$grossamount*$discount/100; 
					  	$data['tdiscount'] 	= 	$grossamount*$discount/100;
					 }else{
					 	$data['total'] 	= 	$grossamount-$disc;
						$data['tdiscount'] 	= 	$disc;
					 }
				}else{
					  $data['total'] 	= 	$grossamount-$disc;
					  $data['tdiscount'] 	= 	$disc;
				}

				$boarding 			= explode(',',$this->input->post('boarding'));
				$dropping 			= explode(',',$this->input->post('dropping'));
				$totalcount 		= count(explode(',', $this->input->post('selectedseats')));
				$totalseats 		= explode(',', $this->input->post('selectedseats'));
				$rate_per   		= $grossamount / $totalcount;
				$data['sid'] 		= 	$sid;
				$data['email'] 		= 	$this->input->post("email");
				$data['contact'] 	= 	$this->input->post("phone");
				$data['boarding'] 	= 	$boarding[0];
				$data['dropping'] 	= 	$dropping[0];
				$data['ticketid'] 	= 	random_string('numeric',9);
				$data['name']		= 	$this->input->post('name[0]');
				$data['rate'] 		= 	$rate_per;
				$data['company'] 	= 	$comid[0];
				if($this->session->userdata('DBUserH')){
					$where = array('email'=>$this->session->userdata('DBUserH'));
					 $data['cuserid'] 		= 	$this->site_model->getbususerbyfield('bus_user',$where,'id');
				}
				$result 			= 	$this->db->insert("passengers_ticket_info",$data);
			    $last_inserted_id 	=	$this->db->insert_id();
				
				for($i=0; $i<$totalcount;$i++){
					$info['info_id']   		=	$last_inserted_id;
	             	$info['name'] 			= 	$this->input->post("name[$i]");
					$info ['age']			= 	$this->input->post("age[$i]");
					$info['seat'] 			= 	$totalseats[$i];
					$gender					=   $this->input->post("gender".$totalseats[$i]);
					$info['gender']  		=  $gender[0];
					$info['card']  			=  $this->input->post("card[$i]");
					$info['cvalidity']  	=  $this->input->post("cvalidity[$i]");
					$res 					= 	$this->db->insert("passengers_detail",$info);
				} 
				if($res){
					$this->db->delete('temp_sheet',array('id'=>$tmp_id));
					$maintable 				=	"bus_scheadual";
					$data['grosstotal'] 	= 	$grossamount;
					$data['dtimes']			=   $dropping[1];
					$data['btimes']			=   $boarding[1];
					$data['category'] 		=	$this->dynamic_query->getbyid($cat,'category_setup');
					$data['busno']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'bus_setup','bus_no','bus_no');
					$data['from']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','from','from');
					$data['to']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','to','from');
					$data['allroutes']		=	$this->dynamic_query->getall('root_setup');
					$data['busnames']		=	$this->dynamic_query->getall('bus_name_setup');
					$data['scheadual']		=	$this->dynamic_query->getbyid($sid,'bus_scheadual');
					$data['allcom']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
					$data['scheduleid'] 	=  	$sid;
					$data['infoid'] 		=  	$last_inserted_id;
					$data['pdetail']		=	$this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
					$data['passengers']		=	$this->dynamic_query->getby($last_inserted_id,'passengers_detail','info_id');
					$data['busdetail'] 		= 	$this->dynamic_query->nestedselect('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup');

					redirect(base_url("home/payamentconfirmation/".$last_inserted_id));
					//$this->load->view('site/confirmation',$data);
  			}else{
  				redirect('home');
  			}
  		}else{
			redirect('home');
  		}
  	  }
	  
	
  	  function cancalbooking(){
  	  	$id 			= 	$this->uri->segment(3);
  	  	$fro 			= 	$this->uri->segment(4);
  	  	$tor 			= 	$this->uri->segment(5);
  	  	$date 			= 	$this->uri->segment(6);
	 	$result 		=	$this->db->delete('passengers_detail',array('info_id'=>$id));
	 	$result 		=	$this->db->delete('passengers_ticket_info',array('id'=>$id));
	 	if($result){
	 		$url =base_url('home/searchbus/').$fro."/".$tor."/".$date;
        	redirect($url);
		}else{
			$url =base_url('home/searchbus/').$fro."/".$tor."/".$date;
        	redirect($url);
	 	}
  	  }
	  
	  

  	  function ticket(){
		
  	  	$data['page_title'] = "Ticket Information";
  	  	if($this->input->post('pay')=='cpayement')
		{
			$data['ticketid']= $this->input->post('ticketid');
			$data['scheduleid']= $this->input->post('scheduleid');
			$data['dtimes']= $this->input->post('dtimes');
			$data['btimes']= $this->input->post('btimes');
			$data['seats']= implode(',',$this->input->post('seats[]'));
			$maintable 	=	"bus_scheadual";
			 $sid =  $this->input->post('scheduleid');
			
			// getting reward to user from every tickets 
			if($this->session->userdata('DBUserH')){
			$rewarddtl = $this->dynamic_query->getall('manage');
			foreach($rewarddtl as $reward){
				$where = array('ticketid'=>$data['ticketid']);
				$total = $this->site_model->returnfieldvalue('passengers_ticket_info',$where,'total');
				if($reward['rewardin']==="PER"){
					 $data11['cuserreward'] = $total * $reward['rewad'] / 100;
				}elseif ($reward['rewardin']==="RS") {
					$data11['cuserreward'] =  $reward['rewad'];		
				}
				$this->db->where('ticketid',$data['ticketid']);
				$this->db->update('passengers_ticket_info',$data11);
			}
		}

			$byticketid   =   $this->dynamic_query->getby($data['ticketid'],'passengers_ticket_info','ticketid');
			foreach($byticketid as $tid){  $infoid =  $tid['id'];}
			$data['stotalpassenger']   =  $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
			$data['allcomittee']   =  $this->dynamic_query->getall('comittee');

			$data['busdetail']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'bus_setup','bus_no','bus_no');
			$data['from']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','from','from');
			$data['to']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','to','from');
			$data['allroutes']		=	$this->dynamic_query->getall('root_setup');
			$data['busnames']		=	$this->dynamic_query->getall('bus_name_setup');
			$data['buscatagory']		=	$this->dynamic_query->getall('category_setup');
			$data['scheadual']		=	$this->dynamic_query->getbyid($sid,'bus_scheadual');
			$data['passenger_info']		=	$byticketid;
			$data['allcom']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
			$data['busname'] 	= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
			
			//$this->sendticet($data);
		
			$this->load->view('site/ticket',$data);
				
	 	}else{
	 		redirect('home');
	 	}
  	  	
  	  }
	  

  	   function ticketgen()
  		{ 
  			if($this->input->post('pdf')=='download' OR $this->input->post('print')=='print' OR $this->input->post('serve')=='mail'){
			$data['ticketid']= $this->input->post('ticketid');
			$data['scheduleid']= $this->input->post('scheduleid');
			$data['dtimes']= $this->input->post('dtimes');
			$data['btimes']= $this->input->post('btimes');
			$data['seats']= $this->input->post('seats');
			$maintable 				=	"bus_scheadual";
			$sid =  $this->input->post('scheduleid');
			$byticketid   =   $this->dynamic_query->getby($data['ticketid'],'passengers_ticket_info','ticketid');
			foreach($byticketid as $tid){  $infoid =  $tid['id']; $to_email = $tid['email'];}
			$data['stotalpassenger']   =  $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
			$data['allcomittee']   =  $this->dynamic_query->getall('comittee');
			$data['busdetail']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'bus_setup','bus_no','bus_no');
			$data['from']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','from','from');
			$data['to']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','to','from');
			$data['allroutes']		=	$this->dynamic_query->getall('root_setup');
			$data['busnames']		=	$this->dynamic_query->getall('bus_name_setup');
			$data['buscatagory']		=	$this->dynamic_query->getall('category_setup');
			$data['scheadual']		=	$this->dynamic_query->getbyid($sid,'bus_scheadual');
			$data['passenger_info']		=	$byticketid;
			$data['allcom']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
			$data['busname'] 	= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
			
			if($this->input->post('pdf')=='download'){
					
				$this->load->view('site/ticketpdf',$data);
				 ob_start();
			 	$html = $this->output->get_output();
				$this->load->library('dompdf_gen');
			 	$this->dompdf->load_html($html,ob_get_clean());
			 	$this->dompdf->render();
			 	$filename  = "Databank booking Bus Ticket".$data['ticketid'].".pdf";
			 	$pdf = $this->dompdf->stream($filename,$data);		
				ob_end_flush(); 

			}else if($this->input->post('serve')=='mail'){
				$this->load->view('site/ticketpdf',$data);
				ob_start();
				$html = $this->output->get_output();
				// // Load library
				 $this->load->library('dompdf_gen');
				// // Convert to PDF
				$this->dompdf->load_html($html,ob_get_clean());
				$this->dompdf->render();
				$filename  = "Databank booking Bus Ticket".$data['ticketid'].".pdf";
				//$pdf = $this->dompdf->stream($filename,$data);
				$pdf = $this->dompdf->output();			
						
				$config = Array(        
				'protocol' => 'sendmail',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('noreply@databanknepal.com', 'Databank Booking - Ticket');
				$this->email->to($to_email);  // replace it with receiver mail id
				$this->email->subject('Ticket Information'); // replace it with relevant subject 
				$body = "Dear ".$to_email." We sent your databank booking bus ticket please keep safe  Please find out attachment pdf file. \n Thank you";
				$this->email->message($body);
				$this->email->attach($pdf,'application/pdf',$filename, false);
				$sent  = $this->email->send();
				if($sent==1){
					/* $this->session->set_userdata($this->messages->success());
					redirect('home'); */
					redirect(base_url('home/sendsuccess'));
				}else{
					$this->session->set_userdata($this->messages->error());
					redirect('home');
				}
				ob_end_flush();
				
			
			}else if($this->input->post('print')=='print'){
				$this->load->view('site/ticketprint',$data);
			}else{
				$this->session->set_userdata($this->messages->error());
				redirect('home');
			}
	}else{
		$this->session->set_userdata($this->messages->error());
		redirect('home');
	}

  }
  
  function sendsuccess(){
	  $data['page_title'] = "Success";
	$this->load->view('site/emailsendsuccess',$data);  
  }
  
  
  
  function checkcuponcode_no(){
		if($this->input->is_ajax_request()) {
		    // grab the coupon value from the post variable.
		    $coupon = $this->input->post('coupon');
			$where = array('coupon'=>$coupon);
			$dates = $this->site_model->getwhere('offer_setup',$where,"");
			if(count($dates)>0){
				foreach($dates as $dt){
					$fromdate = $dt['offer_from'];
					$todate = $dt['offer_to'];
					$diff = date_range($fromdate,$todate);
					if(count($diff)>0){
							 $this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'true')));
					}else{
						 $this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'false')));
					}	
				}
			}else{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'false')));
			}
	    } 
    }
  
  
 function getticket(){

		$ticket 	= 	$this->uri->segment(3);
		$where = array('ticketid'=>$ticket);
		$passengerdtl 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);
		foreach($passengerdtl as $info){
			@$url = "https://www.esewa.com.np/epay/transrec?amt=".$info['total']."&rid=".$_GET['refId']."&scd=databank&pid=DBI-".$info['ticketid']."";	
		}
		$curl = @file_get_contents(@$url);
		htmlentities($curl);
		$removingitem = array(PHP_EOL,"\r", "<\/span><\/b>", "<\/o:p><\/p>","\n","<\/strong><\/a>","\t","\/","&nbsp;");
		 $message = strip_tags(str_replace($removingitem,"",$curl));
	
		$data['page_title'] = "Ticket Information";
		if($message=="Success" AND $_GET['q']=="su"){
			$checkt = $this->dynamic_query->getby($ticket,'passengers_ticket_info','ticketid');
			if(count($checkt)>0){
			$datar['ref_code'] = $_GET['refId'];
			$datar['status'] = 'P';
			$this->db->where('ticketid',$ticket);
			$update = $this->db->update('passengers_ticket_info',$datar);
			if($update==1){
				$jsonrow = array('message'=>'success');
			}
			}
			$where = array('ticketid'=>$ticket);
			$alltic 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);
			
			if(count($alltic)<=0){

				$this->session->set_userdata($this->messages->ticketnotfound());
				redirect('home/ticket');
				
				}else{ 
					foreach($alltic as $mysche){
						$sid  		= 	@$mysche['sid'];
						$infoid  	= 	@$mysche['id'];
					}

					$schead  					=  	$this->dynamic_query->getby($sid,'bus_scheadual','id');
					foreach($schead as $sch){
						$arrival 				= 	$sch['arrival'];
						$departuretime 			= 	$sch['departuretime'];
						$arrivaltime 			= 	$sch['arrivaltime'];
						$boardingpoint 			= 	$sch['boardingpoint'];
						$sedid 					= 	$sch['id'];
						$bus_no 				=	$sch['bus_no'];
					}

					$data['dtimes']				=	$departuretime;
					$data['btimes']				= 	$arrivaltime;
					$data['scheduleid']			= 	$sedid;
					$data['scheadual']			=	$this->dynamic_query->getbyid($sid,'bus_scheadual');
					$data['primaryheader'] 		= 	'Counter Booking';
					$data['title'] 				=  	"Ticket";
					$data['ticketid']=  $ticket;

					$pdet 						=  $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
					foreach($pdet as $passdet){ 
						$seats[] 				= 	$passdet['seat'];
					}
					
					$data['seats']				= 	implode(',', $seats);
					$maintable 					=	"bus_scheadual";
					$byticketid   				=   $this->dynamic_query->getby($ticket,'passengers_ticket_info','ticketid');
					$data['stotalpassenger']	=   $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
					$data['allcomittee']   		=   $this->dynamic_query->getall('comittee');
					$data['busdetail']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'bus_setup','bus_no','bus_no');
					$data['from']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','from','from');
					$data['to']					=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','to','from');
					$data['allroutes']			=	$this->dynamic_query->getall('root_setup');
					$data['busnames']			=	$this->dynamic_query->getall('bus_name_setup');
					$data['buscatagory']		=	$this->dynamic_query->getall('category_setup');
					$data['passenger_info']		=	$byticketid;
					$data['allcom']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
					$data['busname'] 			= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
					
					$this->load->view('site/getticket',$data);
					
				}
		}else{
			$checkt = $this->dynamic_query->getby($ticket,'passengers_ticket_info','ticketid');
			if(count($checkt)>0){
			$datar['status'] = 'U';
			$this->db->where('ticketid',$ticket);
			$update = $this->db->update('passengers_ticket_info',$datar);
			if($update==1){
				$jsonrow = array('message'=>'success');
			}
			}
			$this->load->view('site/responseerror',$data);
		}
			
 }
 
	function payamentconfirmation(){
			$data['page_title'] = "Payment Confirmation";
			$ticket = $this->uri->segment(3);
			$where = array('id'=>$ticket);
			$alltic 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);
			
			if(count($alltic)<=0){
				$this->session->set_userdata($this->messages->ticketnotfound());
				redirect('home/ticket');
				
				}else{ 
					foreach($alltic as $mysche){
						$sid  		= 	@$mysche['sid'];
						$infoid  	= 	@$mysche['id'];
						$to_email  	= 	@$mysche['email'];
					}

					$schead  					=  	$this->dynamic_query->getby($sid,'bus_scheadual','id');
					foreach($schead as $sch){
						$arrival 				= 	$sch['arrival'];
						$departuretime 			= 	$sch['departuretime'];
						$arrivaltime 			= 	$sch['arrivaltime'];
						$boardingpoint 			= 	$sch['boardingpoint'];
						$sedid 					= 	$sch['id'];
						$bus_no 				=	$sch['bus_no'];
					}

					$data['dtimes']				=	$departuretime;
					$data['btimes']				= 	$arrivaltime;
					$data['scheduleid']			= 	$sedid;
					$data['scheadual']			=	$this->dynamic_query->getbyid($sid,'bus_scheadual');
					$data['primaryheader'] 		= 	'Counter Booking';
					$data['title'] 				=  	"Ticket";
					$data['ticketid']=  $ticket;

					$pdet 						=  $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
					foreach($pdet as $passdet){ 
						$seats[] 				= 	$passdet['seat'];
					}
					
					$data['seats']				= 	implode(',', $seats);
					$maintable 					=	"bus_scheadual";
					$byticketid   				=   $this->dynamic_query->getby($ticket,'passengers_ticket_info','id');
					$data['stotalpassenger']	=   $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
					$data['allcomittee']   		=   $this->dynamic_query->getall('comittee');
					$data['busdetail']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'bus_setup','bus_no','bus_no');
					$data['from']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','from','from');
					$data['to']					=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','to','from');
					$data['allroutes']			=	$this->dynamic_query->getall('root_setup');
					$data['busnames']			=	$this->dynamic_query->getall('bus_name_setup');
					$data['buscatagory']		=	$this->dynamic_query->getall('category_setup');
					$data['passenger_info']		=	$byticketid;
					$data['allcom']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
					$data['busname'] 			= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
					
					$this->load->view('site/confirmation',$data);
				}
		
			
 }
 
 
 
 
  
}



