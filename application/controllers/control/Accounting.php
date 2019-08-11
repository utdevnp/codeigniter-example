<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class accounting extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('eBusLogin')){
			redirect('control/login');
		}
		$username = $this->session->userdata('eBusLogin');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('messages');
		$this->load->model('Pagination_model');
		$this->load->model('dynamic_query');
		$this->load->model('active_model');
		$this->load->model('static_model');
		$this->load->library('javascript');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		$this->load->helper('date');
		
	}

	function index(){
		$data['primaryheader'] 	= 	'Accounting';
		$data['title'] 			=  	"Accounting Detail";
		if($this->input->post('submit')=="submit"){

			  $data['sdet']   = $this->input->post('from');
			 $data['enddet'] = $this->input->post('to');

		}else {
			$data['sdet']   = "";
			$data['enddet'] = "";
		}
		$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
		foreach($utype as $ut){
			$utyps  = $ut['user_type'];
		}
		if($utyps!=='admin'){
			$company				=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
			$data['schead']		    =	$this->dynamic_query->getby($company,'bus_scheadual','company');
			$data['busno']			=	$this->dynamic_query->getby($company,'bus_setup','company');
			$data['comp']		   =	$this->dynamic_query->getby($company,'company_setup','id');
		}else{
			$data['schead']		    =	$this->dynamic_query->getall('bus_scheadual');
			$data['busno']			=	$this->dynamic_query->getall('bus_setup');
			$data['comp']		   =	$this->dynamic_query->getall('company_setup');
			
		}
		$user 					= 	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
		$data['counter']		=	$this->dynamic_query->getby($user,'company_setup','user');
		
	 	$data['count'] 			=	$this->dynamic_query->countall('offer_setup','','');
		$data['busrot']			=	$this->dynamic_query->getallactive('root_setup','Y');
		
		$data['detail']			=	$this->dynamic_query->getall('passengers_detail');
		
	 	$data['user_id']   		=   $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']   	=   $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$this->load->view('control/account-detail/details',$data);

	}
}
?>