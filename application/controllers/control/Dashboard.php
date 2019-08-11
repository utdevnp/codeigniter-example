<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('eBusLogin')){
			redirect('control/login');
		}
		$this->load->model('dynamic_query');
		$this->load->model('static_model');
		$this->load->helper('date');
		$this->load->model('activity_model');
		$this->load->model('messages');
    	$this->activity_model->autoload();
	}


	function index(){

		$data['title'] 				=		"Dashboard";
		$dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
	    $now  = $dateTime->format("h:i A"); 
	    $username            	 	=  		$this->session->userdata('eBusLogin');
		$data['user_type']			=		$this->dynamic_query->getby($username,'control_login','username');
		$userid						=		$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
		
		$usertype    				=		$this->dynamic_query->getby($userid,'control_login','id');
		foreach($usertype as $ut) {
			  $type = $ut['user_type'];
			
		}
		if($type == "admin"){
			
		$data['monthlyrecapreport'] 	=	$this->static_model->monthlyrecapreport();
		$data['totalrevnue'] 	=	$this->dynamic_query->select_fields('','passengers_ticket_info','total');
		/// Count all function 
		$data['totalbus']  = $this->dynamic_query->countall('bus_setup','','');
		$data['totalcompany']  = $this->dynamic_query->countall('company_setup','','');
		$data['totaltickets']  = $this->dynamic_query->countall('passengers_ticket_info','','');
		$data['totalmembsers']  = $this->dynamic_query->countall('control_login','','');
		$data['allschedulesbus']  = $this->dynamic_query->countall('bus_scheadual','','');
		$data['allbusnames']  = $this->dynamic_query->countall('bus_name_setup','','');
		$data['allrouts'] 	 = $this->dynamic_query->countall('root_setup','','');
		$data['allactivity']  = $this->dynamic_query->countall('activity','','');
		// get all functiono 
		$data['allusers']	    =	$this->dynamic_query->getall('control_login');
		$data['allmainmenu']	=	$this->dynamic_query->getall('menu_setup');
		$data['action_menu']	=	$this->dynamic_query->getall('minmenu');
		// Get order bylimit function
		$data['alluserdesc']  = $this->dynamic_query->getallonorderlimit('control_login','id','desc',0,6);
		$data['allactivities']  = $this->dynamic_query->getallonorderlimit('activity','id','desc',0,5);
		// today count all function 
		$tdate = date('Y-m-d');
		$b30date = date('Y-m-d', strtotime('-30 days'));
		$data['todaydeparting']  = $this->dynamic_query->todaycountall('bus_scheadual',$tdate,'departure','','');
		$data['todaydeparted']  = $this->dynamic_query->bookingclose();
		$data['todayschedules']  = $this->dynamic_query->todaycounttimestamp('bus_scheadual',$tdate,'addiinfo');
		$data['todaytickets']  = $this->dynamic_query->todaycounttimestamp('passengers_ticket_info',$tdate,'addiinfo');
		$data['todaybuses']  = $this->dynamic_query->todaycounttimestamp('bus_setup',$tdate,'addiinfo');
		// day30before
		$data['day30beforechedules']  = $this->dynamic_query->todaycounttimestamp('bus_scheadual',$b30date,'addiinfo');
		$data['day30departing']  = $this->dynamic_query->todaycounttimestamp('bus_scheadual',$b30date,'departure');
		$data['day30departed']  = $this->dynamic_query->getdepartedBydate('bus_scheadual',$b30date);
		$data['day30tickets']  = $this->dynamic_query->todaycounttimestamp('passengers_ticket_info',$b30date,'addiinfo');
		$data['day30buses']  = $this->dynamic_query->todaycounttimestamp('bus_setup',$b30date,'addiinfo');
		
		$this->load->view('control/dashboard/dashboard',$data);
		}else if($type == "company"){
		
		$company					=		$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
		$data['totalbus']  			= 		$this->dynamic_query->countall('bus_setup','company',$company);
		$data['monthlyrecapreportcom'] = 		$this->static_model->monthlyrecapreportcom();
		$data['monthlyrecapreportcomtot'] = 		$this->static_model->monthlyrecapreportcomtot();
		$data['totalbuses']  		= 		$this->dynamic_query->countall('bus_setup','company',$company);
		$com         				=		$this->dynamic_query->getby($company,'company_setup','id');
		foreach($com as $cid){
			$uid   = $cid['user'];
		}
		$data['totalstaff']  		= 		$this->dynamic_query->getby($uid,'control_login','user');

		$users         				=		$this->dynamic_query->getby($company,'bus_scheadual','company');
		foreach($users as $uid){
			$sid   = $uid['id'];
		}
		$data['totaltickets']  		= 		$this->dynamic_query->getby(@$sid,'passengers_ticket_info','sid');
		$data['totalmembsers']  	= 		$this->dynamic_query->countall('control_login','','');
		$data['allschedulesbus']  	= 		$this->dynamic_query->countall('bus_scheadual','company',$company);
		$data['allbusnames']  		= 		$this->dynamic_query->countall('bus_name_setup','company',$company);
		$data['allrouts']  			= 		$this->dynamic_query->countall('root_setup','','');
		$data['allactivity']  		= 		$this->dynamic_query->countall('activity','user_id',$userid);
		$tdate 						= 		date('d-m-Y');
		$data['todaydeparting']  	= 		$this->dynamic_query->todaycountall('bus_scheadual',$tdate,'departure','company',$company);

		$data['alluserdesc']  		= 		$this->dynamic_query->getallonorderlimit('control_login','id','desc',0,8);
		$data['allusers']			=		$this->dynamic_query->getall('control_login');
		$data['allticket']			=		$this->dynamic_query->todaytimestamp('passengers_ticket_info',date('Y-m-d'),'addiinfo');
		$data['allmainmenu']		=		$this->dynamic_query->getall('menu_setup');
		$data['action_menu']		=		$this->dynamic_query->getall('minmenu');
		$data['allactivities']  	= 		$this->dynamic_query->getallonorderlimit('activity','id','desc',0,5);
		
		$data['allbus']				=		$this->dynamic_query->getby($company,'bus_setup','company');
		//$data['scheadual'] 			= 		$this->dynamic_query->getby($company,'bus_scheadual','company');
		$where    					=    	array('company' => $company);
		$data['scheadual'] 			= 		$this->dynamic_query->getorderbylimit($where,'bus_scheadual','desc','id','5','0');
		$data['uid']          =       $userid;

		$this->load->view('control/dashboard/dashboard',$data);
		} else {

		
		$companyid					=		$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
		$data['totalbus']  			= 		$this->dynamic_query->countall('bus_setup','company',$companyid);
		$data['monthlyrecapreportcom'] = 		$this->static_model->monthlyrecapreportcom();
		$data['monthlyrecapreportcomtot'] = 		$this->static_model->monthlyrecapreportcomtot();
		$data['totalbuses']  		= 		$this->dynamic_query->countall('bus_setup','company',$companyid);
		$com         				=		$this->dynamic_query->getby($companyid,'company_setup','id');
		foreach($com as $cid){
			$uid   = $cid['user'];
		}
		$data['totalstaff']  		= 		$this->dynamic_query->getby($uid,'control_login','user');
		$users         				=		$this->dynamic_query->getby($companyid,'bus_scheadual','company');
		foreach($users as $uid){
			$sid   = $uid['id'];
		}
		$data['totaltickets']  		= 		$this->dynamic_query->getby(@$sid,'passengers_ticket_info','sid');
		$data['totalmembsers']  	= 		$this->dynamic_query->countall('control_login','','');
		$data['allschedulesbus']  	= 		$this->dynamic_query->countall('bus_scheadual','company',$companyid);
		$data['allbusnames']  		= 		$this->dynamic_query->countall('bus_name_setup','company',$companyid);
		$data['allrouts']  			= 		$this->dynamic_query->countall('root_setup','','');
		$data['allactivity']  		= 		$this->dynamic_query->countall('activity','user_id',$userid);
		$tdate 						= 		date('d-m-Y');
		$data['todaydeparting']  	= 		$this->dynamic_query->todaycountall('bus_scheadual',$tdate,'departure','company',$companyid);

		$data['alluserdesc']  		= 		$this->dynamic_query->getallonorderlimit('control_login','id','desc',0,8);
		$data['allusers']			=		$this->dynamic_query->getall('control_login');
		$data['allticket']			=		$this->dynamic_query->todaytimestamp('passengers_ticket_info',date('Y-m-d'),'addiinfo');
		$data['allmainmenu']		=		$this->dynamic_query->getall('menu_setup');
		$data['action_menu']		=		$this->dynamic_query->getall('minmenu');
		$data['allactivities']  	= 		$this->dynamic_query->getallonorderlimit('activity','id','desc',0,5);
		
		$data['allbus']				=		$this->dynamic_query->getby($companyid,'bus_setup','company');
		//$data['scheadual'] 			= 		$this->dynamic_query->getby($company,'bus_scheadual','company');
		$where    					=    	array('company' => $companyid);
		$data['scheadual'] 			= 		$this->dynamic_query->getorderbylimit($where,'bus_scheadual','desc','id','5','0');
		
		$data['uid']          =       $userid;
		$this->load->view('control/dashboard/dashboard',$data);
		}

	}

	// User logout function 
	function logout(){
			$this->session->unset_userdata('eBusLogin');
			redirect('control/login');
	}

	// when file is uploaded 
		                	
function logindashboard(){
		$data['title'] 	=	"Dashboard";
		$data['primaryheader'] 	=	"Login Dashboard";
		$table = "login"; $field = "agent"; $value = "Chrome";
		$data['google_chrome'] = $this->dynamic_query->like($table,$field,$value);
		$value = "Firefox";
		$data['mozila_firefox'] = $this->dynamic_query->like($table,$field,$value);
		$value = 'Safari';
		$data['safari'] = $this->dynamic_query->like($table,$field,$value);
   		$data['login'] = $this->dynamic_query->getall('login');
   		$data['allcount'] = count($data['login']);
   		$data['latest_login'] = $this->dynamic_query->getallonorderlimit($table,'id','desc',0,9);
   		$this->load->view('control/login/dashboard',$data);
   	}

   	function iphandle(){
   		if($this->input->post('allowip') === "allowip"){
   				$ip = $this->input->post('allow');
   				$fieldA = $ip;
   				$field = 'ip';
   				$this->dynamic_query->delete($field,$fieldA,'login','dashboard/logindashboard');
   		}elseif($this->input->post('blockip') === "blockip"){
   				$ip = $this->input->post('block');
   				for($i=1; $i<=4; $i++)
   				{
	   				$data['attemp'] = 6;
	   				$data['ip'] = $ip;
	   				$data['username'] = 'username';
	   				//$data['agent'] = $this->activity_model->getagent();
	   				$data['auth']='N';
	   				$this->db->insert('login',$data);
   				}
   			redirect(ADMIN_BASE.'dashboard/logindashboard');
   		}
   	}


}
