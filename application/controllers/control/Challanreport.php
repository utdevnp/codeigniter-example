
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challanreport extends CI_Controller {
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
		$this->load->model('active_model');
		$this->load->model('static_model');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		
	}

	function index(){
		$data['primaryheader'] 	= 	'Challan Reports';
		$data['title'] 			=  	"Search Challan";
		$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
		foreach($utype as $ut){
			$utyps  = $ut['user_type'];
		}
		if($utyps!=='admin'){
			$companyid				=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
			$data['company']		=	$this->dynamic_query->getby($companyid,'company_setup','id');
			$data['busno']			=	$this->dynamic_query->getby($companyid,'bus_setup','company');
		}else {
			$data['company']		=	$this->dynamic_query->getall('company_setup');
			$data['busno']			=	$this->dynamic_query->getall('bus_setup');
		}
	 	$data['count'] 			=	$this->dynamic_query->countall('offer_setup','','');
		$data['busrot']			=	$this->dynamic_query->getallactive('root_setup','Y');
		
	 	$data['bussche']	=	"";
	 	$data['mached'] = "";
	 	$data['user_id']    =   $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']   =   $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	
	 	$this->load->view('control/challanreport/search',$data);

	}
	function searchchalan(){
		 if($this->input->post("submit")=="submit"){

		 	$bus_no  = $this->input->post("bus_no");
		 	$ent_date  = $this->input->post("date_for");
			$fields  	  	=  	"id,bus_no,departure";
			$table 	 	  	=  	"bus_scheadual";
			$id  			=	"";
			$scheadual   	=   $this->dynamic_query->select_fields($id,$table,$fields);
			
			foreach($scheadual as $sche){
				
				$sid  		= 	$sche['id'];
				$bus_id  	=  	$sche['bus_no'];
				$date   	=  	$sche['departure'];

				if($bus_no==$bus_id AND $ent_date==$date){
					
					$chalan['mached'] 	= 	'mached';
					$chalan['primaryheader'] 	= 	'Challan Reports';
					$chalan['title'] 			=  	"Search Challan";
					$fieldB 	=	"";
					$chalan['sid']	=	$sid;
					$chalan['com']  =  $this->dynamic_query->getbyscheadual($sid,'bus_scheadual','company_setup','company',$fieldB);
					$chalan['user_id']    =   $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
					$chalan['sche'] =  $this->static_model->doublewhere('bus_scheadual',$bus_no,$ent_date,'bus_no','departure');
					$chalan['allcat']			=	$this->dynamic_query->getall('category_setup');
					$chalan['ticket']			=	$this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
					$chalan['passenger']	=	$this->dynamic_query->getall('passengers_detail');
					$chalan['busrot']			=	$this->dynamic_query->getallactive('root_setup','Y');
					$chalan['busno']			=	$this->dynamic_query->getall('bus_setup');
					$chalan['busno']			=	$this->dynamic_query->getall('bus_setup');
					$chalan['postedbus']			=	$bus_no;
					$chalan['posteddate']			=	$ent_date;
					$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
						foreach($utype as $ut){
							$utyps  = $ut['user_type'];
						}
						if($utyps!=='admin'){
									$companyid				=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
									$chalan['comp']		=	$this->dynamic_query->getby($companyid,'company_setup','id');
						}else {
							$chalan['comp']		=	$this->dynamic_query->getall('company_setup');
						}
				  $this->load->view('control/challanreport/search',$chalan);

				}
			}
		}
	}
	
	function printchalan(){
		
		 	$bus_no  = $this->input->post("bus_no");
		 	$ent_date  = $this->input->post("date_for");
			$fields  	  	=  	"id,bus_no,departure";
			$table 	 	  	=  	"bus_scheadual";
			$id  			=	"";
			$scheadual   	=   $this->dynamic_query->select_fields($id,$table,$fields);
			
			foreach($scheadual as $sche){
				$sid  		= 	$sche['id'];
				$bus_id  	=  	$sche['bus_no'];
				$date   	=  	$sche['departure'];
			}
			
			if($bus_no==$bus_id AND $ent_date==$date){
				$chalan['mached'] 	= 	'mached';
				$chalan['primaryheader'] 	= 	'Challan Reports';
				$chalan['title'] 			=  	"Search Challan";
				$fieldB 	=	"";
				$chalan['sid']	=	$sid;
				$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
						foreach($utype as $ut){
							$utyps  = $ut['user_type'];
						}
						if($utyps!=='admin'){
							$companyid				=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
							$chalan['company']		=	$this->dynamic_query->getby($companyid,'company_setup','id');
							$chalan['com']  =  $this->dynamic_query->getbyscheadual($sid,'bus_scheadual','company_setup','company',$fieldB);
						}else{
							
							$chalan['company']		=	$this->dynamic_query->getall('company_setup');
							
						}
				$chalan['com']  =  $this->dynamic_query->getbyscheadual($sid,'bus_scheadual','company_setup','company',$fieldB);
				$chalan['user_id']    =   $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
				$chalan['sche'] =  $this->static_model->doublewhere('bus_scheadual',$bus_no,$ent_date,'bus_no','departure');
				$chalan['allcat']			=	$this->dynamic_query->getall('category_setup');
				$chalan['ticket']			=	$this->dynamic_query->getby($sid,'passengers_ticket_info','sid');
				$chalan['passenger']	=	$this->dynamic_query->getall('passengers_detail');
				$chalan['busrot']			=	$this->dynamic_query->getallactive('root_setup','Y');
				$chalan['busno']			=	$this->dynamic_query->getall('bus_setup');
				$chalan['busno']			=	$this->dynamic_query->getall('bus_setup');
				$chalan['officeexp']			=	$this->input->post("officeexp");
				$chalan['miscellaneous']			=	$this->input->post("miscellaneous");
				$chalan['trip']			=	$this->input->post("trip");
				$chalan['total']			=	$this->input->post("total");
				$chalan['netamo']			=	$this->input->post("netamo");
				
				 if($this->input->post("submit")=="print"){
					$this->load->view('control/challanreport/printchalan',$chalan);	
				} else if($this->input->post("submitexcel")=="excel"){
				$this->load->view('control/challanreport/exporttoexcel',$chalan);

			}

		}
		
	}

	function mychalan(){
		$this->load->library('excel');

		
		 
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"offer_setup";
	 	$baseurl		=	"offersetup";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"offer_setup";
	 	$baseurl		=	"offersetup";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}

	// function bookingcontinue(){
	// 	print_r($this->input->post());
	// 	die();

	// }




}
?>