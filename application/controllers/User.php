<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('Pagination_model');
		$this->load->library('pagination');
		$this->load->library('email');
	}

	 function check_sessoin(){
		if(!$this->session->userdata('DBUserH')){
			redirect('home');
			exit(1);
		}
	} 
	function index()	
	{
		$this->check_sessoin();
		$data['page_title'] = 'User Panel';
		$data['ticket_ttile'] = 'View Ticket';
		$segment =  $this->uri->segment(3);
		if($this->session->userdata('DBUserH')){
			$where = array('email'=>$this->session->userdata('DBUserH'));
			 $user_id = $this->site_model->getbususerbyfield('bus_user',$where,'id');
		}else{
			$user_id= 0;
		}
		$where = array('cuserid'=>$user_id);
		
		$table ="passengers_ticket_info";
	 	$segmentp =  $this->uri->segment(4); 
	 	$perpage = 30;
	 	$baseurl = "";//base_url("user/index/history/");
	 	$orderby = 'addiinfo';
	 	$order =  "desc";
	 	$data['usertravelhistry'] =  $this->Pagination_model->sitepeginationByuser($table,$perpage,$baseurl,$orderby,$order,$segmentp,$where);
	 	
		$where1 = array('user'=>$user_id);
		$table1 ="complains";
		$baseuri = "";//base_url("user/index/complains/list/");
		$orderby1 = 'timestamp';
		$order =  "desc";
		$perpage = 30;
		$segmentp =  $this->uri->segment(5); 
		$data['complains'] =  $this->Pagination_model->sitepeginationByuser($table1,$perpage,$baseuri,$orderby1,$order,$segmentp,$where1);
		
		/* $where = array('cuserid'=>$user_id);
		$data['usertravelhistry']  = $this->dynamic_query->getbywhere('passengers_ticket_info',$where); */
		$where = array('id'=>$user_id);
		$data['userdtl']  = $this->dynamic_query->getbywhere('bus_user',$where);
		 if($this->input->post('userticket')==='usearch'){
			//print_r($this->input->post());
			$this->form_validation->set_rules('pnr','PNR','numeric|min_length[9]|max_length[9]');
			if($this->form_validation->run() == FALSE){
			        redirect('home');
				}else{

					$ticket 	= 	$this->input->post('pnr');
					$mobile 	= 	$this->input->post('mobile');
					//$alltic 	=  $this->dynamic_query->getby($ticket,'passengers_ticket_info','ticketid');
					$where = array('ticketid'=>$ticket,'contact'=>$mobile);
					$alltic 	=  $this->dynamic_query->getbywhere('passengers_ticket_info',$where);

					if(count($alltic)<=0){

						$this->session->set_userdata($this->messages->ticketnotfound());
						if( $segment == 'customerservices'){
							redirect('user/customerservices');	
						}else{
							redirect('home');
						}
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
						
						$this->load->view('site/ticketsearch',$data);
					}
				}

			} 

		$this->load->view('site/user/dashboard',$data);	
	}

	
  function register(){
  	if($this->input->post('create')==='user'){
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('mobile_no','Mobile','required');
		$this->form_validation->set_rules('aterms','Terms And Condition','required');
		$this->form_validation->is_unique('email', 'bus_user.email');
		$this->form_validation->is_unique('mobile_no', 'bus_user.mobile_no');
		if($this->form_validation->run()==FALSE){
			$this->session->set_userdata($this->messages->cannotRegisterAccount());
			redirect('home');
		}else{
				
			$data['email']  = $this->input->post('email');
			$to_email =  $this->input->post('email');
			$data['password']  = md5($this->input->post('password'));
			$data['mobile_no']  = $this->input->post('mobile_no');
			$data['verif']  = 'N';
			$data['active']  = 'Y';
			$data['key']  = random_string('alnum',40);
			$data['ip']  = $this->input->ip_address();
			$link = "http://databankbooking.com/user/verifyuseemail/".$data['key'];
			$this->activity_model->registersuccess($to_email,$link);
			$reg = $this->db->insert('bus_user',$data);
			if($reg==1){
				$this->session->set_userdata($this->messages->sugnupsuccess());
				redirect('home');
			}else{
				$this->session->set_userdata($this->messages->error());
				redirect('home');
			}
			
		}
	}
  }

  function verifyuseemail(){
  	$key = $this->uri->segment(3);
  	$key1 = htmlentities($key);
  	if(empty($key1)){
  		$this->session->set_userdata($this->messages->invalidkey());
		redirect('home');
  	}else{
  		$check = $this->dynamic_query->getby($key1,'bus_user','key');
  		if(count($check)>0){
  			$data['verif'] ='Y';
  			$this->db->update('bus_user',$data);
  			$this->session->set_userdata($this->messages->successverufy());
			redirect('home');
  		}else{
	  		$this->session->set_userdata($this->messages->invalidkey());
			redirect('home');	
  		}
  	}

  }

  function checkemail(){
		if($this->input->is_ajax_request()) {
		    // grab the email value from the post variable.
		    if($this->input->post('email')){
			    $email =  $this->input->post('email');
			    // check in database - table name : tbl_users  , Field name in the table : email
			    if(!$this->form_validation->is_unique($email, 'bus_user.email')) {
			    // set the json object as output                 
			    	 $this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'false')));
			    }else{
			   		$this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'true')));
			    }
		 	}elseif($this->input->post('frogetemail')){
		 		 $frogetemail =  $this->input->post('frogetemail');
		 		 if(!$this->form_validation->is_unique($frogetemail, 'bus_user.email')) {
			    // set the json object as output                 
			    	 $this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'true')));
			    }else{
			   		$this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'false')));
			    }
		 	}
	    }
    }

    function checkmobile_no(){
		if($this->input->is_ajax_request()) {
		    // grab the email value from the post variable.
		    $mobile_no =  $this->input->post('mobile_no');
		    // check in database - table name : tbl_users  , Field name in the table : email
		    if(!$this->form_validation->is_unique($mobile_no, 'bus_user.mobile_no')) {
		    // set the json object as output                 
		    	 $this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'false')));
		    }else{
		   		$this->output->set_content_type('application/json')->set_output(json_encode(array('valid' => 'true')));
		    }
	    }
    }

    function login(){
    	if($this->input->post('loginbtn')==='lgn')
    	{
			 $this->form_validation->set_rules('email','Email','required');
	   		$this->form_validation->set_rules('password','Password','required');
	   		if($this->form_validation->run()==FALSE){
				$this->session->set_userdata($this->messages->loginerror());
	   			redirect('home');
			}else{ 
				$username = $this->input->post('email');
				$password = md5($this->input->post('password'));
				$where = array('email'=>$username,'password'=>$password,'verif'=>'Y','active'=>'Y');
				$res 	=  $this->dynamic_query->getbywhere('bus_user',$where);
				if(count($res)>0){
					$this->session->set_userdata('DBUserH',$username);
					redirect('user');
				}else{
					$this->session->set_userdata($this->messages->loginerror());
					if($this->uri->segment(3)==='customerservices'){
						redirect('user/customerservices');	
					}else{
						redirect('home');
					}
				}
			}
		}
	}

    function logout(){
			$this->check_sessoin();
			$this->session->unset_userdata('DBUserH');
			redirect('home');
	}

	function update(){
		$this->check_sessoin();
		if($this->input->post('updateuser')==='upate'){
			$data['fname'] = $this->input->post('fname');
			$data['lname'] = $this->input->post('lname');
			$data['address'] = $this->input->post('address');
			$data['email'] = $this->input->post('email');
			$data['mobile_no'] = $this->input->post('mobile_no');
			$this->db->where('email',$data['email']);
			$res = $this->db->update('bus_user',$data);
			if($res == 1)
			{
				$this->session->set_userdata($this->messages->success());
				redirect('user/index/update');
			}else{
				$this->session->set_userdata($this->messages->error());
				redirect('user/index/update');
			}
		}
	}

	function userchangepassword()
   {
		$this->check_sessoin();
   		$table = 'bus_user';
	   	if($this->input->post('chapgeudercp')=='change')
	   	{
	   		$this->form_validation->set_rules('oldpassword','Old Password','trim|required|min_length[8]|max_length[50]');
	   		$this->form_validation->set_rules('password','New Password','trim|required|min_length[8]|max_length[50]');
	   		$this->form_validation->set_rules('repassword','New Password','trim|required|min_length[8]|max_length[50]');
	   		if($this->form_validation->run()==FALSE){
	   			redirect('user/index/changepassword');
	   		}else{
	   			$table = 'bus_user';
	   			$oldpassword = md5($this->input->post('oldpassword'));
	   			$this->db->where('password',$oldpassword);
	   			$dbpassword = $this->db->get($table);
	   			// echo $this->db->last_query();
	   			// die();
	   			if($dbpassword->num_rows()>0){
	   				$pass = $this->input->post('password');
	   				$password = md5($this->input->post('password'));
	   				$repassword = md5($this->input->post('repassword'));
	   				// if Passwords are match than ...
	   				if($password == $repassword ){
	   					$result 	=	 $this->db->set('password', $password); //value that used to update column  
						$result 	= 	$this->db->where('id', $id); //which row want to upgrade  
						$result 	= 	$this->db->update($table);  //table name
						if($result){
							
							$this->session->set_userdata('pwchange',$pass);
							$this->session->set_userdata($this->messages->success());
           					redirect('user/index/changepassword');
						}else{
							
							$this->session->set_userdata($this->messages->error());
           					redirect('user/index/changepassword');
						}
	   				}else{
	   					 // if repasword and password dont't match 
	   					$this->session->set_userdata($this->messages->passwordnotmatch());
						redirect('user/index/changepassword');
	   				}

	   			}else{
	   				 // if oldpasword and dbpassword dont't match 
	   				$this->session->set_userdata($this->messages->oldpaswordnotmatch());
	   				redirect('user/index/changepassword');
	   			}
	   		}
	   	}else{
	   		redirect('user');
	   	}
   }
   
   function forgetpassword(){
	    if($this->input->post('forgetpw')==='pw'){
			$to_email = $this->input->post('frogetemail');
			if(empty($to_email)){
				$this->session->set_userdata($this->messages->error());
				redirect('home');
			}
			$check = $this->dynamic_query->getby($to_email,'bus_user','email');
		if(! $check){
				$this->session->set_userdata($this->messages->error());
				redirect('home');
		   }else{
				$data['key']  = random_string('alnum',40); 
				$link = "http://www.databankbooking.com/user/changepassword/".$data['key'];
				
				$this->db->where('email',$to_email);
				$reg = $this->db->update('bus_user',$data);
				
				$this->activity_model->forgotpwemail($to_email,$link);
				if($reg==1){
					$this->session->set_userdata($this->messages->forgetpassword());
					redirect('home');
				}else{
					$this->session->set_userdata($this->messages->error());
					redirect('home');
				}
		   }
		}
   }
   
   function changepassword(){
	 
	$key = $this->uri->segment(3); 
  	$key1 = htmlentities($key);
  	if(empty($key1)){
  		$this->session->set_userdata($this->messages->invalidkey());
		redirect('home');
  	}else{
  		$check = $this->dynamic_query->getby($key1,'bus_user','key');
  		if(count($check)>0){
			$ppage['page_title'] = "Change Password";
			$this->load->view('site/user/changepassword',$ppage);
  		}else{
	  		$this->session->set_userdata($this->messages->invalidkey());
			redirect('home');	
  		}
  	}
	
   }
   
   function changepass(){
	    $key = $this->uri->segment(3); 
		$key1 = htmlentities($key); 
		if($this->input->post('updatepw')==='update'){
			$data['password'] = md5($this->input->post('password'));
			$check1 = $this->dynamic_query->getby($key1,'bus_user','key');
			
			if(count($check1)>0){
				$this->db->where('key',$key1);
				$run = $this->db->update('bus_user',$data);
				echo $this->db->last_query();
				
				if($run==1){
					$this->session->set_userdata($this->messages->success());
					redirect('home');
				}else{
					$this->session->set_userdata($this->messages->error());
					redirect('home');
				}	
			}else{
				$this->session->set_userdata($this->messages->invalidkey());
				redirect('home');	
			} 
		}else{
			$this->session->set_userdata($this->messages->error());
			redirect('home');	
		}
	}
	
	function customerservices(){
		if($this->session->userdata('DBUserH')){
			redirect('user');
		}
		$data['page_title'] = "Customer Services";
		$this->load->view('site/user/loginpage',$data);
	}
	
	
	
	function addcomplains(){
		$this->check_sessoin();
		if($this->input->post('submitc')==='submessage'){
			$data['subject'] = $this->input->post('subject');
			$data['message'] = $this->input->post('message');
			$data['service'] = $this->input->post('service');
			
			$res = $this->db->insert('complains',$data);
			if($res == 1)
			{
				$this->session->set_userdata($this->messages->success());
				redirect('user/index/complains/list');
			}else{
				$this->session->set_userdata($this->messages->error());
				redirect('user/index/complains/list');
			}
		}
	}


}





