
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Counter_booking extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('eBusLogin')){
			redirect('control/login');
		}
		$username = $this->session->userdata('eBusLogin');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->helper('string');
		$this->load->model('messages'); 
		$this->load->model('Pagination_model');
		$this->load->model('dynamic_query');
		$this->load->model('site_model');
		$this->load->model('active_model');
		$this->load->model('static_model');
		$this->load->library('javascript');
		$this->load->helper('date');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		
		
	}

	function index(){
		$data['primaryheader'] 	= 	'Counter Booking';
		$data['title'] 			=  	"Search Bus";
		$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
		foreach($utype as $ut){
			$utyps  = $ut['user_type'];
		}
		if($utyps!=='admin'){
		$company					=		$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
		$data['busno']			=	$this->dynamic_query->getby($company,'bus_setup','company');
		}else {
		$data['busno']			=	$this->dynamic_query->getall('bus_setup');	
		}
		$user 					= 	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
		$data['counter']		=	$this->dynamic_query->getby($user,'company_setup','user');
	 	$data['count'] 			=	$this->dynamic_query->countall('offer_setup','','');
		$data['busrot']			=	$this->dynamic_query->getallactive('root_setup','Y');
		
		$data['info']			=	$this->dynamic_query->getall('passengers_ticket_info');
		$data['detail']			=	$this->dynamic_query->getall('passengers_detail');
	 	$data['bussche']		=	"";
	 	$data['user_id']   		=   $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']   =   $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$this->load->view('control/counter-booking/booking-form',$data);

	}


	function Searched_bus(){

		if($this->input->post('submit')=='submit'){


				$infofiesds 		=	"sid,id";
				$user 				= 	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
				$data['counter']	=	$this->dynamic_query->getby($user,'company_setup','user');
				$data['busno']		=	$this->dynamic_query->getall('bus_setup');
				$data['info']		=	$this->dynamic_query->select_fields('','passengers_ticket_info',$infofiesds);
				$data['detail']		=	$this->dynamic_query->select_fields('','passengers_detail','seat');
				$data['busname']	=	$this->dynamic_query->getall('bus_name_setup');
				$data['busrot']		=	$this->dynamic_query->getall('root_setup');
				$data['busno']		=	$this->dynamic_query->getall('bus_setup');
				$data['allcom']		=	$this->dynamic_query->getall('company_setup');
				$data['busrot']		=	$this->dynamic_query->getallactive('root_setup','Y');
				$data['user_id']    =   $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			$data['mainmenu']   =   $this->static_model->getmenusbyuri($this->uri->segment(2));
	 			$data['companyid']	=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));


			if($this->input->post('ticket_for') AND $this->input->post('from')  AND  $this->input->post('bus_no')  AND $this->input->post('to')){

				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Search Results";
				$date 					=	$this->input->post('ticket_for');
				$from 					=	$this->input->post('from');
				$to 					=	$this->input->post('to');	
				$bus_no 				=	$this->input->post('bus_no');
				$active 				=	"Y";
				$table 					=	"bus_scheadual";
				$data['bussche']		=	$this->dynamic_query->search_by_all_bus_no($table,$date,$from,$to,$bus_no,$active);
				echo $this->db->last_query();
				$this->load->view('control/counter-booking/booking-form',$data);	

			}

			else if($this->input->post('from')   AND  $this->input->post('to')   AND  $this->input->post('ticket_for')){
				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Search Results";
				$date 					=	$this->input->post('ticket_for');
				$from 					=	$this->input->post('from');
				$to 					=	$this->input->post('to');
				$active 				=	"Y";
				$table 					=	"bus_scheadual";
				$data['bussche']		=	$this->dynamic_query->search_by_all($table,$date,$from,$to,$active);
				
				$this->load->view('control/counter-booking/booking-form',$data);	
			}

			else if( $this->input->post('from')  AND  $this->input->post('to')){
				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Search Results";
				//$date 					=	$this->input->post('ticket_for');
				$from 					=	$this->input->post('from');
				$to 					=	$this->input->post('to');
				$active 				=	"Y";
				$table 					=	"bus_scheadual";
				$data['bussche']		=	$this->dynamic_query->select_fields_by_active($table,$from,$to,$active);
				$this->load->view('control/counter-booking/booking-form',$data);	
			
			}else if($this->input->post('bus_no') AND $this->input->post('ticket_for')){
				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Search Results";
				$bus_no 				=	$this->input->post('bus_no');
				$ticket_for 			=	$this->input->post('ticket_for');
				$active 				=	"Y";
				$table 					=	"bus_scheadual";
				$data['bussche']		=	$this->dynamic_query->getbus_by_datebus($table,$bus_no,$ticket_for,$active);
				$this->load->view('control/counter-booking/booking-form',$data);

			}

			else if($this->input->post('ticket_for')){
				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Search Results";
				$date 					=	$this->input->post('ticket_for');
				$active 				=	"Y";
				$table 					=	"bus_scheadual";
				$data['bussche']		=	$this->dynamic_query->get_by_date($table,$date,$active);
				$this->load->view('control/counter-booking/booking-form',$data);

			}else if($this->input->post('bus_no')){
				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Search Results";
				$bus_no 				=	$this->input->post('bus_no');
				$active 				=	"Y";
				$table 					=	"bus_scheadual";
				$data['bussche']		=	$this->dynamic_query->get_by_busno($table,$bus_no,$active);
				$this->load->view('control/counter-booking/booking-form',$data);

			}else{
				$this->form_validation->set_rules('from','departure','trim|required');
				$this->form_validation->set_rules('to','Destiontion ','trim|required');

				if($this->form_validation->run() == FALSE){
					$from					=	$this->input->post('from');
					$to 					=	$this->input->post('to');
					$table 					=	"bus_scheadual";
					$active 				=	"Y";
					$data['primaryheader'] 	= 	'Counter Booking';
					$data['title'] 			=  	"Search Bus";
					$data['bussche']		=	$this->dynamic_query->select_fields_by_active($table,$from,$to,$active);
					$this->load->view('control/counter-booking/booking-form',$data);
				}else{
					$from					=	$this->input->post('from');
					$to 					=	$this->input->post('to');
					$table 					=	"bus_scheadual";
					$active 				=	"Y";
					$data['primaryheader'] 	= 	'Counter Booking';
					$data['title'] 			=  	"Booking Opened Bus";
					$data['bussche']		=	$this->dynamic_query->select_fields_by_active($table,$from,$to,$active);
					$this->load->view('control/counter-booking/booking-form',$data);
				}
			}
		}else{

			$this->index();
		}		

	}

	

	function continuebooking(){

		if($this->input->post('submit')=='myseats'){

		$id  						=   $this->input->post("sid");
		$seat 		=	$this->input->post("seats");
		
		$where = array('sid'=>$id);
			$bookedids = $this->site_model->returnfield('passengers_ticket_info',$where,'');
			$queue = $this->site_model->returnfield('temp_sheet',$where,'seats');
				foreach($bookedids as $seatsdet){
					
					$info= array('info_id'=>@$seatsdet['id']);
					 $booked = $this->site_model->returnfield('passengers_detail',$info,'seat');
					foreach(@$booked as $totseats){
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
			        	   redirect('control/Counter_booking/');
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
									redirect('control/Counter_booking/');
								}
							} 
						}
					
					} 
			//temporary data  sotore
		
		
		
		$data['primaryheader'] 		= 	'Counter Booking';
		$data['title'] 				=  	"Passenger Detail form";
		$data['tprice'] 			=	$this->input->post("total");
		$data['sid'] 				=	$id;
		$data['departuredate'] 		=	$this->input->post("ticket_date");
		$fields 					=	"droppingpoint,droppingtime,boardingpoint,boardingtime";
	    $data['points']				=	$this->dynamic_query->select_fields($id,'bus_scheadual',$fields);
	    $data['busno']			=	$this->dynamic_query->getbyscheadual($id,'bus_scheadual','bus_setup','bus_no','bus_no');
	    $data['allrot']				=	$this->dynamic_query->getall('root_setup');
		$data['buscat'] 			=	$this->input->post("buscategory");
		$data['buscom'] 			=	$this->input->post("buscompany");
		$seat 						=	$this->input->post("seats");
		
		$data['scheadual']		    =	$this->dynamic_query->getbyid($id,'bus_scheadual');
		$data['allcatagory']		=	$this->dynamic_query->getall('category_setup');
	    $data['allbusnames']		=	$this->dynamic_query->getall('bus_name_setup');


		$data['user_id'] 			= $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  			= $this->static_model->getmenusbyuri($this->uri->segment(2));
		if($seat!=""){
			$data['selected'] 		=	implode(',',$this->input->post("seats"));
	      }
        $user 				= 	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
		$data['counter']	=	$this->dynamic_query->getby($user,'company_setup','user');
		
			$dta['sid'] = $id;
			$dta['seats'] = implode(',', $seat);
			$dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
			$dta['tmptime'] = $dateTime->format("h:i A");
			$this->db->insert("temp_sheet",$dta);
			$data['tmp_id'] = $this->db->insert_id();
			
		$this->load->view('control/counter-booking/booking',$data);


		} else if($this->input->post('submit')=='save'){ 
			// print_r($this->input->post());
			

			$sid 			=    $this->input->post('sid');
			$disc 			=    $this->input->post('discount');
			$tmpid 			=    $this->input->post('tmp_id');
			$grossamount 	= 	$this->input->post("tamount");
			$cat 			= 	$this->dynamic_query->nestedselect("bus_scheadual",'bus_no','bus_setup',$sid,'bus_category','id','category_setup');
		    $coupon_code 	= 	$this->input->post("coupon");
			$com 			= 	$this->input->post("buscompany");
			$issue_date 	= 	nice_date($this->input->post("departure"),'M d Y');
			$coupon_discuout=	$this->dynamic_query->getallactive('offer_setup','Y');	
			if(count($coupon_discuout) < 0){
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
			$data['company']    =   $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
			$data['rate'] 		= 	$rate_per;
			$result 			= 	$this->db->insert("passengers_ticket_info",$data);
		    $last_inserted_id 	=	$this->db->insert_id();
			
			for($i=0; $i<$totalcount;$i++){
				$info['info_id']   		=	$last_inserted_id;
             	$info['name'] 			= 	$this->input->post("name[$i]");
				$info ['age']			= 	$this->input->post("age[$i]");
				$info['seat'] 			= 	$totalseats[$i];
				$gender					=   $this->input->post("gender".$totalseats[$i]);
				$info['gender']  		=  $gender[0];
				$res 					= 	$this->db->insert("passengers_detail",$info);
			} 
			if($res){
				$this->db->delete('temp_sheet',array('id'=>$tmpid));
				$data['primaryheader'] 	= 	'Counter Booking';
				$data['title'] 			=  	"Passenger Detail form";
				$maintable 				=	"bus_scheadual";
				$data['grosstotal'] 	= 	$grossamount;
				$data['dtimes']			=   @$dropping[1];
				$data['btimes']			=   @$boarding[1];
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
				$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
				$this->load->view('control/counter-booking/invoice',$data);
			}else{
				$this->session->set_userdata($this->messages->error());
			    redirect('control/counter_booking/');
			}	
		}else{ 
			$this->index();
		}
	}

	function tickets(){

		if($this->input->post('submit')=='cpayement'){

			$data['primaryheader'] 		= 	'Counter Booking';
			$data['title'] 				=  	"Ticket";
			$data['ticketid']= $this->input->post('ticketid');
			$data['scheduleid']= $this->input->post('scheduleid');
			$data['dtimes']= $this->input->post('dtimes');
			$data['btimes']= $this->input->post('btimes');
			$data['seats']= implode(',',$this->input->post('seats[]'));
			$maintable 				=	"bus_scheadual";
			$sid =  $this->input->post('scheduleid');
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
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/counter-booking/ticket',$data);
		}else{ 
				redirect(base_url('control/counter_booking/continue'));
			
		}
	}

	function ultimateticket(){


		$ticket 	= 	$this->uri->segment(4);
		$where = array('ticketid'=>$ticket);
		$passengerdtl 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);
		foreach($passengerdtl as $info){
			$url = "https://esewa.com.np/epay/transrec?amt=".$info['total']."&rid=".$_GET['refId']."&scd=databank&pid=".$_GET['oid']."";	
		}
		$curl = file_get_contents($url);
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
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		        $data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
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
					$data['username']    		=   $this->session->userdata('eBusLogin'); 
					$data['busname'] 			= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
					$this->load->view('control/counter-booking/ticket',$data);
					
				}
		}else{
			$checkt = $this->dynamic_query->getby($ticket,'passengers_ticket_info','ticketid');
			if(count($checkt)>0){
			$datar['ref_code'] = $_GET['refId'];
			$datar['status'] = 'U';
			$this->db->where('ticketid',$ticket);
			$update = $this->db->update('passengers_ticket_info',$datar);
			if($update==1){
				$jsonrow = array('message'=>'success');
			}
			}
			$this->load->view('control/counter-booking/paymenterror',$data);
		}
			
		
	}


 public function ticketgenpdf(){ 

  		
  		 	$data['title'] 				=  	"Ticket";
			$data['ticketid']= $this->input->post('ticketid');
			$data['scheduleid']= $this->input->post('scheduleid');
			$data['dtimes']= $this->input->post('dtimes');
			$data['btimes']= $this->input->post('btimes');
			$data['seats']= $this->input->post('seats');
			$maintable 				=	"bus_scheadual";
			$sid =  $this->input->post('scheduleid');
			$byticketid   =   $this->dynamic_query->getby($data['ticketid'],'passengers_ticket_info','ticketid');
			foreach($byticketid as $tid){ 
			 $to_email =  $tid['email'];
			$infoid =  $tid['id'];}
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
			$data['username']    		=   $this->session->userdata('eBusLogin');
			$data['allcom']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
			$data['busname'] 	= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
			if($this->input->post('genpdf')=='pdf'){

				$this->load->view('control/counter-booking/ticketpdf',$data);
				ob_start();
			 	$html = $this->output->get_output();
				 $this->load->library('dompdf_gen');
			 	$this->dompdf->load_html($html,ob_get_clean());
			 	$this->dompdf->render();
			 	$filename  = "Databankbooking Bbs Ticket".$data['ticketid'].".pdf";
			 	$this->dompdf->stream($filename,$data);
			 	ob_end_flush();
			 	$this->dompdf->close();
			}else if($this->input->post('mailsent')=='mail'){
				print_r($this->input->post());
				$this->load->view('control/counter-booking/ticketpdf',$data);
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
				$body = "Dear ".$to_email." We sent your databank booking ticket please keep safe  Please find out attachment pdf file. \n Thank you";
				$this->email->message($body);
				$this->email->attach($pdf,'application/pdf',$filename, false);
				$sent  = $this->email->send();
				if($sent==1){
					$this->session->set_userdata($this->messages->success());
					redirect('home');
				}else{
					$this->session->set_userdata($this->messages->error());
					redirect('home');
				}
				ob_end_flush();
			
			}
			else if($this->input->post('printticket')=='print'){
				$this->load->view('control/counter-booking/ticketprint',$data);
			}else{
				redirect('control/counter_booking/');
			}


  }

	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$result 		=	$this->db->delete('passengers_detail',array('info_id'=>$id));
	 	$result 		=	$this->db->delete('passengers_ticket_info',array('id'=>$id));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
        	redirect('control/counter_booking/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/counter_booking/');
	 	}
	}

	function ticketsearch(){
		if($this->input->post('submit-ticket')=='submit-ticket'){

			$this->form_validation->set_rules('ticketno','ticketno','numeric|min_length[9]|max_length[9]');
			if($this->form_validation->run() == FALSE){
				$this->index();
				}else{

					$ticket 	= 	$this->input->post('ticketno');
					$alltic 	=  $this->dynamic_query->getby($ticket,'passengers_ticket_info','ticketid');

					if(count($alltic)<=0){
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/counter_booking/');
					} 
					foreach($alltic as $mysche){
						$sid  		= 	$mysche['sid'];
						$infoid  	= 	$mysche['id'];
					}

					$schead  					=  	$this->dynamic_query->getby($sid,'bus_scheadual','id');
					foreach($schead as $sch){
						$arrival 				= 	$sch['arrival'];
						$departuretime 			= 	$sch['departuretime'];
						$arrivaltime 			= 	$sch['arrivaltime'];
						$boardingpoint 			= 	$sch['boardingpoint'];
						$bus_no 				=	$sch['bus_no'];
					}

					$data['dtimes']				=	$departuretime;
					$data['btimes']				= 	$arrivaltime;
					$data['scheduleid']			= 	$departuretime;
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
					$data['stotalpassenger']	=  $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
					$data['allcomittee']   		=  $this->dynamic_query->getall('comittee');
					$data['busdetail']			=	$this->dynamic_query->getbyscheadual($sid,$maintable,'bus_setup','bus_no','bus_no');
					$data['from']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','from','from');
					$data['to']					=	$this->dynamic_query->getbyscheadual($sid,$maintable,'root_setup','to','from');
					$data['allroutes']			=	$this->dynamic_query->getall('root_setup');
					$data['busnames']			=	$this->dynamic_query->getall('bus_name_setup');
					$data['buscatagory']		=	$this->dynamic_query->getall('category_setup');
					$data['passenger_info']		=	$byticketid;
					$data['allcom']				=	$this->dynamic_query->getbyscheadual($sid,$maintable,'company_setup','company','name');
					$data['busname'] 			= 	$this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$sid,'bus_name','id','bus_name_setup','bus_name');
					$data['user_id'] 			= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
			 		$data['mainmenu']  			= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
					$data['username']    		=   $this->session->userdata('eBusLogin');
					$this->load->view('control/counter-booking/ticket',$data);
				}

			} else {
				$this->index();
		}

	}
}
?>