<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class boardingsetup extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('eBusLogin')){
			redirect('control/login');
		}
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('messages');
		$this->load->model('Pagination_model');
		$this->load->model('dynamic_query');
		$this->load->model('active_model');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		$this->load->model('static_model');

	}

	function index(){
		$data['primaryheader'] 	= 	'Boarding Point Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Boarding Points";
		$data['addtitle'] 		=   "Add Boarding Point";
	 	$table 					=	"boarding_points";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."boardingpoint/index";
	 	$orderby 				= 	'id';
	 	$order 					=  "desc";
	 	$data['row'] 			=  	$this->Pagination_model->pagination_design_user($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	 $data['count'] 			=	$this->dynamic_query->countall($table,'','');
	 	$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['busrot']			=	$this->dynamic_query->getall('root_setup');
	 	$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$data['companyid']  	= 	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
	 	$this->load->view('control/boarding-point/list',$data);

	}


	function add(){

		if($this->input->post('submit')=='submit'){
			print_r($this->input->post());
			
	 		$this->form_validation->set_rules('title','Boarding Points','trim|required');
	 		
				if($this->form_validation->run() == FALSE){
					$table					=	"boarding_points";
					$active 				=	"Y";
					$data['comapnies'] 		=	$this->dynamic_query->getbyactive($table,$active);
					$data['primaryheader'] 	= 'Boarding Points';
					$data['addtitle'] 		=   "Add Boarding Points";
					$data['title']			=  "Boarding Points List";
					$table 					=	"boarding_points";
				 	$segment 				=  	$this->uri->segment(4); 
				 	$perpage 				= 	9;
				 	$baseurl 				= 	ADMIN_BASE."boardingpoint/index";
				 	$orderby 				= 	'id';
				 	$order 					=  	"desc";
					 $data['row'] 			=  	$this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
					 $data['comapnies'] 	=	$this->dynamic_query->getbyactive('company_setup',$active);
		 			$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
		 			$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
		 			$data['companyid']  	= 	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					$this->load->view('control/boarding-point/list',$data);
				}else{
					 
					$data 				= 	array();
					$data['title']		=	$this->input->post('title'); 
					$data['destrict']		=	$this->input->post('destrict'); 
					$data['company']	=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					$data['user']		=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$data['is_active']		=	$this->input->post('is_active');
					$result 			= 	$this->db->insert('boarding_points',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'boardingsetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'boardingsetup/');
					}
				}

		}else{
			$data['primaryheader'] 	= 	'Boarding Point Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Boarding Points";
		$data['addtitle'] 		=   "Add Boarding Point";
	 	$table 					=	"boarding_points";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."boardingpoint/index";
	 	$orderby 				= 	'id';
	 	$order 					=  "desc";
	 	$data['row'] 			=  	$this->Pagination_model->pagination_design_user($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	 $data['count'] 			=	$this->dynamic_query->countall($table,'','');
	 	$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['busrot']			=	$this->dynamic_query->getall('root_setup');
	 	$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$data['companyid']  	= 	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
	 	$this->load->view('control/boarding-point/list',$data);
		}
	}


	function update(){
		$id 		=	$this->uri->segment(4);
		if($this->input->post('submit')=='submit'){
	 		$this->form_validation->set_rules('title','Boarding Points','trim|required');
	 		
				if($this->form_validation->run() == FALSE){
					$table					=	"boarding_points";
					$active 				=	"Y";
					$data['comapnies'] 		=	$this->dynamic_query->getbyactive($table,$active);
					$data['primaryheader'] 	= 'Boarding Points';
					$data['addtitle'] 		=   "Add Boarding Points";
					$data['title']			=  "Boarding Points List";
					$table 					=	"boarding_points";
				 	$segment 				=  	$this->uri->segment(4); 
				 	$perpage 				= 	9;
				 	$baseurl 				= 	ADMIN_BASE."boardingpoint/index";
				 	$orderby 				= 	'id';
				 	$order 					=  	"desc";
				 	$data['busrot']			=	$this->dynamic_query->getall('root_setup');
					 $data['row'] 			=  	$this->dynamic_query->getbyid($table,$id);
					$this->load->view('control/boarding-point/edit',$data);
				}else{
					 
					$data 				= 	array();
					$data['title']		=	$this->input->post('title'); 
					$data['destrict']		=	$this->input->post('destrict'); 
					$data['company']	=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					$data['user']		=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$data['is_active']	=	$this->input->post('is_active');
					$this->db->where('id',$id);
					$result 			= 	$this->db->update('boarding_points',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'boardingsetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'boardingsetup/');
					}
				}

		}else{

			$table					=	"boarding_points";
			$active 				=	"Y";
			$data['comapnies'] 		=	$this->dynamic_query->getbyactive($table,$active);
			$data['primaryheader'] 	= 	'Boarding Points Setup';
			$data['title'] 			=	"Add Boarding Points";
			$data['busrot']			=	$this->dynamic_query->getall('root_setup');
			$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu'] 	 	= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
	 		$data['rows'] 			=  	$this->dynamic_query->getbyid($id,$table);
	 		$data['companyid']  	= 	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
			$this->load->view('control/boarding-point/edit',$data);
		}
	}

	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$result 	=	$this->db->delete('boarding_points',array('id'=>$id));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
        	redirect('control/boardingsetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/boardingsetup/');
	 	}
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"boarding_points";
	 	$baseurl		=	"boardingsetup";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"boarding_points";
	 	$baseurl		=	"boardingsetup";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}




}