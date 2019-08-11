<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->model('dynamic_query');
		$this->load->model('site_model');
		$this->load->model('static_model');
		$this->load->model('messages');
		$this->load->helper('date');
		$this->load->helper('string');
		$this->load->model('activity_model');
		$this->load->library('form_validation');
		$this->load->library('email');
	}
	
	function allrouts(){
		$result=$this->dynamic_query->getall('root_setup');
		$jsonresponse = array("result"=>array());
		foreach($result as $row){
			$jsonrow = array
					(
					"id"=>$row['id'],
					"from"=>$row['from'],
					"is_active"=>$row['is_active']
					);	
		//push the values in the array
		array_push($jsonresponse['result'],$jsonrow);			
		}
		echo  json_encode($jsonresponse);		
	}
	
	function busdetailsBybusid(){
		$bus_id = $this->input->post('bus_id');
		$sch_id = $this->input->post('sch_id');
		$where = array('id'=>$bus_id);
		$result=$this->dynamic_query->getbywhere('bus_setup',$where);
		foreach($result as $r)
		{
			$bus_id1 = $r['bus_name'];
			$company = $r['company'];
		}
		// get company reservation seats
		$getcommpany = $this->dynamic_query->getby($company,'company_setup','id');
		foreach($getcommpany as $company){ 
		$reservation =  $company['reservation'];
		$singler = explode("/",$reservation);
		 $female = $singler[0];
		 $student = $singler[1];
		 $old = $singler[2];
		 $staff = $singler[3];
		 $handicap = $singler[4];
		}
		
		$result1 = $this->dynamic_query->getby($bus_id1,'bus_name_setup','id');
		foreach($result1 as $bus_name){ $busname =  $bus_name['bus_name'];}
		// get passenger ticket info from sch_id
		$getrticketinfo = $this->dynamic_query->getby($sch_id,'passengers_ticket_info','sid');
		foreach($getrticketinfo as $detail){
			$getbookSheet = $this->dynamic_query->getby($detail['id'],'passengers_detail','info_id');
			foreach($getbookSheet as $sheet){
				$booksheet[] = $sheet['seat'];
			}
		}
		$jsonresponse = array("result"=>array());
		foreach($result as $row){
			$where = array('id'=>$row['bus_category']);
			$getcat=$this->dynamic_query->getbywhere('category_setup',$where);
			foreach($getcat  as $cat){$catag = $cat['title'];}
			$jsonrow = array
					(
					"message"=>'Trip loaded successfully !!',
					"id"=>$row['id'],
					"bus_no"=>$row['bus_no'],
					"bus_name"=>$busname,
					"bus_category"=>$catag,
					"company"=>$row['company'],
					"mobile_no"=>$row['mobile_no'],
					"booked_seat"=>@$booksheet,
					"rev_female"=>$female,
					"rev_student"=>$student,
					"rev_old"=>$old,
					"rev_staff"=>$staff,
					"rev_handicap"=>$handicap,
					"bus_image"=>$row['bus_image'],
					"total_sheet_in_a_side"=>$row['total_sheet_in_a_side'],
					"total_sheet_in_b_side"=>$row['total_sheet_in_b_side'],
					"cabin"=>$row['cabin'],
					"special"=>$row['special'],
					"last_row"=>$row['last_row'],
					"type"=>$row['type'],
					"hices"=>$row['hices'],
					"forces"=>$row['forces'],
					"is_active"=>$row['is_active']
					);	
		//push the values in the array
		array_push($jsonresponse['result'],$jsonrow);			
		}
		echo  json_encode($jsonresponse);		
	}
	
	
	function bussearch(){
		$from = $this->input->post('from');// 34;
		$to =   $this->input->post('to'); //101;
		$date =  nice_date($this->input->post('date'),'Y-m-d'); //'2017-04-05';
		$where  = array('from'=>$from,'to'=>$to,'departure'=>$date,'is_active'=>'Y');
		
		$result=$this->dynamic_query->getbywhere('bus_scheadual',$where);
		// get bus name from schedule bus_name_id 
		//print_r($result);
		$allfeatures = $this->dynamic_query->getall('feature_setup');
		foreach($result  as $bname){
			// get bus name 
			$fboradigpoint1 = $this->dynamic_query->getbyscheadual($bname['id'],'bus_scheadual','root_setup','from','from');
			foreach($fboradigpoint1 as $fb){ $fboradigpoint = $fb['from'];}
			// get bus fetures
				
		}
		$jsonresponse = array("result"=>array());
		foreach($result as $row){
			$busname = $this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$row['id'],'bus_name','id','bus_name_setup','bus_name');
			$features = $this->dynamic_query->nestedselect3rd('bus_scheadual','bus_no','bus_setup',$bname['id'],'bus_category','id','category_setup','features');
			$explodearray = explode(',',$features);
			$num = count($explodearray);
				foreach($allfeatures as $fet){
					for($i=0;$i<$num;$i++){
					if($fet['id']==$explodearray[$i]){$feturesss[] = $fet['title'];}
				}
			}	
			$jsonrow = array
					(
					"sch_id"=>$row['id'],
					"bus_id"=>$row['bus_no'],
					"bus_name"=>$busname,
					"features"=>$feturesss,
					"first_boradigpoint"=>$fboradigpoint,
					"departure"=>$row['departure'],
					"arrival"=>$row['arrival'],
					"departuretime"=>$row['departuretime'],
					"arrivaltime"=>$row['departure'],
					"from"=>$row['from'],
					"to"=>$row['to'],
					"discount"=>$row['discount'],
					"netfare"=>$row['netfare'],
					"boardingpoint"=>$row['boardingpoint'],
					"droppingpoint"=>$row['droppingpoint'],
					"shift"=>$row['shift'],
					"boardingtime"=>$row['boardingtime'],
					"company"=>$row['company'],
					"addiinfo"=>$row['addiinfo'],
					"user"=>$row['user'],
					"is_active"=>$row['is_active']
					);	
					
		//push the values in the array
		array_push($jsonresponse['result'],$jsonrow);		
			$feturesss = null;
		}
		echo  json_encode($jsonresponse);		
	}
	

	function login(){
				$jsonresponse = array("result"=>array());
				$username = $this->input->post('email');
				$password = md5($this->input->post('password'));
				$where = array('email'=>$username,'password'=>$password,'verif'=>'Y','active'=>'Y');
				$res 	=  $this->dynamic_query->getbywhere('bus_user',$where);
				if(count($res)>0){
					foreach($res as $row){
						$jsonrow = array
							(
							"message"=>'success',
							"id"=>$row['id'],
							"fname"=>$row['fname'],
							"lname"=>$row['lname'],
							"address"=>$row['address'],
							"email"=>$row['email'],
							"mobile_no"=>$row['mobile_no']
							);			
					}		
				}else{
					$jsonrow = array("message"=>'Invalid Login !! Please check your user name or password');	
				}
				array_push($jsonresponse['result'],$jsonrow);			
				echo  json_encode($jsonresponse);
    }
	
	
	function register(){
			$jsonresponse = array("result"=>array());
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile_no');
			$ip = $this->input->post('ip');
			$where = array('email'=>$email);
			$checkemail = $this->dynamic_query->getbywhere('bus_user',$where );
			if(count($checkemail)>0){
				$jsonrow = array("message"=>'Email already exist');	 
			}else{
				$where = array('mobile_no'=>$mobile);
				$checkmob = $this->dynamic_query->getbywhere('bus_user',$where);
				if(count($checkmob)>0){
					$jsonrow = array("message"=>'Mobile no already exist');	 
				}else{
					$data['email']  = $this->input->post('email');
					$to_email =  $this->input->post('email');
					$data['password']  = md5($this->input->post('password'));
					$data['mobile_no']  = $this->input->post('mobile_no');
					$data['verif']  = 'N';
					$data['active']  = 'Y';
					$data['key']  = random_string('alnum',40);
					$data['vcode']  = rand(111111,999999);
					$data['ip']  = $this->input->post('ip');
					$link = $data['vcode'];
					$ip = $data['ip'];
					$this->activity_model->registersuccessAndroid($to_email,$link,$ip);
					$reg = $this->db->insert('bus_user',$data);
					
					if($reg==1){
						$jsonrow = array("message"=>'Sign up Success !! Please check email to verify');	
					}else{
						$jsonrow = array("message"=>'Something went wrong !!');	
					}
				}
			}
			array_push($jsonresponse['result'],$jsonrow);	
			echo  json_encode($jsonresponse);
	}
	
	function passengersdtls(){
		$jsonresponse = array("result"=>array());
		$sid 			=    $this->input->post('sid');
		$disc 			=    "0";
		
		$cat 			= 	$this->dynamic_query->nestedselect("bus_scheadual",'bus_no','bus_setup',$sid,'bus_category','id','category_setup');
		$coupon_code 	= 	$this->input->post("coupon");
		$rate 			= 	$this->input->post("rate");
		$com 			= 	$this->input->post("buscompany");
		$issue_date 	= 	nice_date($this->input->post("departure"),'M d Y');
		$seat 		= explode(',', $this->input->post('selectedseats'));
		$where = array('sid'=>$sid);
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
							$Berror = "booked";	
						}else{
							$Berror = "notbooked";
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
									$Berror = "booked";
								}else{
									$Berror = "notbooked";
								}
							} 
						}
					
					} 
			//temporary data  sotore
			$dta['sid'] = $sid;
			$dta['seats'] = implode(',', $seat);
			$dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
			$dta['tmptime'] = $dateTime->format("h:i A");
			$this->db->insert("temp_sheet",$dta);
			$datar['tmp_id'] = $this->db->insert_id();
			//
			
			
			
		// discounts in seat manage by server 
		
	if($Berror == "notbooked"){
		$boarding 			= explode(',',$this->input->post('boarding'));
		$dropping 			= explode(',',$this->input->post('dropping'));
		$totalcount 		= count(explode(',', $this->input->post('selectedseats')));
		$totalseats 		= explode(',', $this->input->post('selectedseats'));
		
		// total price of seats
		$tprice  = $totalcount *$rate;
		$total = $totalcount;
		$grossamount = $tprice;
		$seat = $totalseats;
		$counter  = $this->dynamic_query->getby($com,'company_setup','id');
		foreach($counter as $reg){
		  $res   =  explode('/', $reg['reservation']);
		  $resdis   =  explode('/', $reg['reservdiscount']);
		}
		   $stuid    = explode(',', $res[0]);
		   $female   = explode(',', $res[1]);
		   $old      = explode(',', $res[2]);
		   $staff    = explode(',', $res[3]);
		   
		   $perrate = $tprice / $total;
			 for($i=0;$i<$total;$i++){ 
			  if($seat[$i]==@$stuid[2].@$stuid[0] OR $seat[$i]==@$stuid[2].@$stuid[1]){ 
				  $disc = $perrate * @$resdis[0] / 100; 
				  
			  }

			   else if($seat[$i]==@$female[2].@$female[0] OR $seat[$i]==@$female[2].@$female[1]){ 
				$disc = $perrate * @$resdis[1] / 100; 
			  }

			   else if($seat[$i]==@$hancap[2].@$hancap[0] OR $seat[$i]==@$hancap[2].@$hancap[1]){ 
				 $disc = $perrate * @$resdis[2] / 100; 
			  }

			   else if($seat[$i]==@$old[2].@$old[0] OR $seat[$i]==@$old[2].@$old[1]){ 
				 $disc = $perrate * @$resdis[3] / 100; 
			  }

			  else {   $disc = 0;}
			}
			///
		$coupon_discuout=	$this->dynamic_query->getallactive('offer_setup','Y');	
		if(count($coupon_discuout) > 0){
		//print_r($coupon_discuout);
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

		$rate_per   		= $grossamount / $totalcount;
			
		$data['sid'] = $this->input->post('sid');
		$data['email'] = $this->input->post('email');
		$data['contact'] = $this->input->post('contact');
		$data['coupon'] = $this->input->post('coupon');
		$data['company'] = $com;
		$data['rate'] = $rate_per;
		$data['boarding'] = $this->input->post('boarding');
		$data['dropping'] = $this->input->post('dropping');
		$data['ticketid'] = random_string('numeric',9);
		$data['name'] = $this->input->post('name[0]');
		$data['cuserid'] = $this->input->post('cuserid');
		$data['cuserreward'] = "";
		$result 			= 	$this->db->insert("passengers_ticket_info",$data);
		$last_inserted_id 	=	$this->db->insert_id();
		for($i=0; $i<$totalcount;$i++){
			$info['info_id']   		=	$last_inserted_id;
			$info['name'] 			= 	$this->input->post("name[$i]");
			$info['age']			= 	$this->input->post("age[$i]");
			$info['gender']			= 	$this->input->post("gender[$i]");
			$info['seat'] 			= 	$this->input->post("seat[$i]");
			$res 					= 	$this->db->insert("passengers_detail",$info);
		}
			if($res==1){
				$pinfo  = $this->dynamic_query->getby($last_inserted_id,'passengers_ticket_info','id');
					foreach($pinfo as $info){
					$jsonrow = array(
					"message"=>'Success',
					"total"=>$info['total'],
					"name"=>$info['name'],
					"ticketid"=>$info['ticketid'],
					"discount"=>$info['tdiscount']
					);
				}
			}else{
				$jsonrow = array("message"=>'Something went wrong');	
			}
	}else{
			$jsonrow = array("message"=>'This seat is already booked,please select another seat');	
		}
		array_push($jsonresponse['result'],$jsonrow);	
		echo  json_encode($jsonresponse);
	}
	
	
	function travelhistory(){
		$jsonresponse = array("result"=>array());
		$user_id=$this->input->post('user_id');
		$where = array('cuserid'=>$user_id);
		$result=$this->dynamic_query->getbywhere('passengers_ticket_info',$where);
		if(count($result)>0){
			foreach($result as $row){
				$where11 = array('id'=>$row['sid']);
				$date = $this->site_model->getbususerbyfield('bus_scheadual',$where11,'departure');
				$jsonrow = array
					(
					"message"=>'success',
					"id"=>$row['id'],
					"sid"=>$row['sid'],
					"date"=> $date,
					"name"=>$row['name'],
					"coupon"=>$row['coupon'],
					"total"=>$row['total']
					);	
			}
		}else{
			$jsonrow = array('message'=>'Cannot retrieve travel history');
		}	
		array_push($jsonresponse['result'],$jsonrow);		
		echo  json_encode($jsonresponse);
	}
	
	function update(){
			$jsonresponse = array("result"=>array());
			$data['fname'] = $this->input->post('fname');
			$data['lname'] = $this->input->post('lname');
			$data['address'] = $this->input->post('address');
			$data['email'] = $this->input->post('email');
			$data['mobile_no'] = $this->input->post('mobile_no');
			$this->db->where('email',$data['email']);
			$res = $this->db->update('bus_user',$data);
			if($res == 1){
				$jsonrow = array('message'=>'success');
			}else{
				$jsonrow = array('message'=>'Something went wrong !!');
			}
		array_push($jsonresponse['result'],$jsonrow);		
		echo  json_encode($jsonresponse);
	}
	
	function updatestatus(){
		$jsonresponse = array("result"=>array());
		$ticketid = $this->input->post('ticketid');
		$refcode = $this->input->post('ref_code');
		$where = array('ticketid'=>$ticketid);
		$passengerdtl 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);
		foreach($passengerdtl as $info){
			@$url = "https://www.esewa.com.np/epay/transrec?amt=".$info['total']."&rid=".$refcode."&scd=databank&pid=".$info['ticketid']."";	
		}
		$curl = @file_get_contents(@$url);
		htmlentities($curl);
		$removingitem = array(PHP_EOL,"\r", "<\/span><\/b>", "<\/o:p><\/p>","\n","<\/strong><\/a>","\t","\/","&nbsp;");
		$message = strip_tags(str_replace($removingitem,"",$curl));
		if($message == "Success"){
			$checkt = $this->dynamic_query->getby($ticketid,'passengers_ticket_info','ticketid');
			if(count($checkt)>0){
				$data['ref_code'] = $refcode;
				$data['status'] = 'P';
				$this->db->where('ticketid',$ticketid);
				$update = $this->db->update('passengers_ticket_info',$data);
				if($update==1){
					foreach($checkt as $mysche){
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
						$data['ticketid']=  $ticketid;
						$pdet 						=  $this->dynamic_query->getby($infoid,'passengers_detail','info_id');
						foreach($pdet as $passdet){ 
							$seats[] 				= 	$passdet['seat'];
						}
						$data['seats']				= 	implode(',', $seats);
						$maintable 					=	"bus_scheadual";
						$byticketid   				=   $this->dynamic_query->getby($ticketid,'passengers_ticket_info','ticketid');
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
						
						$this->load->view('site/ticketpdf',$data);
						ob_start();
						$html = $this->output->get_output();
						$this->load->library('dompdf_gen');
						$this->dompdf->load_html($html,ob_get_clean());
						$this->dompdf->render();
						$filename  = "Databank booking Bus Ticket".$data['ticketid'].".pdf";
						$pdf = $this->dompdf->output();					
						$config = Array(        
						'protocol' => 'sendmail',
						'mailtype'  => 'html', 
						'charset'   => 'iso-8859-1'
						);
						$this->load->library('email', $config);
						$this->email->set_newline("\r\n");
						$this->email->from('noreply@databanknepal.com', 'Databank Booking - Ticket Information');
						$this->email->to($to_email);  // replace it with receiver mail id
						$this->email->subject('Ticket Information'); // replace it with relevant subject 
						$body = "Dear ".$to_email." We sent your databank booking ticket please keep safe  Please find out attachment pdf file. \n Thank you";
						$this->email->message($body);
						$this->email->attach($pdf,'application/pdf',$filename, false);
						$sent  = $this->email->send();
						if($sent==1){
							$jsonrow = array('message'=>'success');
						}else{
							$jsonrow = array('message'=>'Something went wrong ');
						}
						ob_end_flush();	
					$jsonrow = array('message'=>'success');
				}
			}else{
				$jsonrow = array('message'=>'Ticket not found!!');
			}
		}else{
			$jsonrow = array('message'=>'Transaction was not successful !!');
		}
		array_push($jsonresponse['result'],$jsonrow);		
		echo  json_encode($jsonresponse);
	}
	
	function userverify(){
		$jsonresponse = array("result"=>array());
		$email = $this->input->post('email');
		$code = $this->input->post('code');
			if(empty($email)){
				$jsonrow = array('message'=>'Email is required');
			}else{
				if(empty($code)){
					$jsonrow = array('message'=>'Code is required');
				}else{
					$where = array('vcode'=>$code,"email"=>$email);
					$verify  = $this->dynamic_query->getbywhere('bus_user',$where);
					if(count($verify)>0){
						$data['verif'] = "Y";
						$this->db->where('email',$email);
						$updatestetus = $this->db->update('bus_user',$data);
						if($updatestetus==1){
							$where = array("email"=>$email);
							$userdtl = $this->dynamic_query->getbywhere('bus_user',$where);
							if(count($userdtl)>0){
								foreach($userdtl as $row){
									$jsonrow = array(
										"message"=>'Congratulation ! Your email is verified',
										"id"=>$row['id'],
										"fname"=>$row['fname'],
										"lname"=>$row['lname'],
										"address"=>$row['address'],
										"email"=>$row['email'],
										"mobile_no"=>$row['mobile_no']
									);
								}
							}else{
								$jsonrow = array('message'=>'User detail not found');
							}
						}	
					}
				}
			}
		array_push($jsonresponse['result'],$jsonrow);		
		echo  json_encode($jsonresponse);
	}
	
	function deleteuser(){
		$jsonresponse = array("result"=>array());
		$email ="dpshkhnl@gmail.com";
		$where = array('email'=>$email);
		$result= $this->dynamic_query->getbywhere('bus_user',$where);
		if(count($result)>0){
			$data['email'] = $email;
			$this->db->where('email',$email);
			$this->db->delete('bus_user',$data);
			$jsonrow = array('message'=>'Delete successfully (dpshkhnl@gmail.com)');
			
		}else{
			$jsonrow = array('message'=>'User not found (dpshkhnl@gmail.com)');
		}
		array_push($jsonresponse['result'],$jsonrow);		
		echo  json_encode($jsonresponse);
	}
	
	
}


?>