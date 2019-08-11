<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class busnamesetup extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('eBusLogin')){
			redirect('control/login');
		}
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('messages');
		$this->load->model('Pagination_model');
		$this->load->model('static_model');
		$this->load->model('dynamic_query');
		$this->load->model('active_model');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		

		

	}

	function index(){
		$data['primaryheader'] 	= 	'Bus Name Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Bus Name List";
		$data['addtitle'] 		=   "Add Bus Name";
	 	$table 					=	"bus_name_setup";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."busnamesetup/index";
	 	$orderby 				= 	'id';
	 	$order 				=  	"desc";
	 	$data['row'] 		=  	$this->Pagination_model->pagination_design_user($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['comapnies'] 	=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	$data['user_id'] 	= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  	= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
		$data['allcom'] 	=	$this->dynamic_query->getall('company_setup'); 
		$utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
		foreach($utype as $ut){
			$utyps  = $ut['user_type'];
		}
		if($utyps!=='admin'){
			$data['companyid']  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
		}
	 	$this->load->view('control/busname-setup/list',$data);

	}

	function add(){

		if($this->input->post('submit')=='submit'){
		
	 		$this->form_validation->set_rules('busname','Bus Name','trim|required');
	 		$this->form_validation->set_rules('company','Company ID','trim');
	 		
				if($this->form_validation->run() == FALSE){
					$table					=	"company_setup";
					$active 				=	"Y";
					$data['comapnies'] 		=	$this->dynamic_query->getbyactive($table,$active);
					$data['primaryheader'] 	= 'Bus Name Setup';
					$data['addtitle'] 		=   "Add Bus Name";
					$data['title']			=  "Bus Name List";
					$table 					=	"bus_name_setup";
				 	$segment 				=  	$this->uri->segment(4); 
				 	$perpage 				= 	9;
				 	$baseurl 				= 	ADMIN_BASE."busnamesetup/index";
				 	$orderby 				= 	'id';
				 	$order 				=  "desc";
				 $data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
				 $data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
				 $data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			 $data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 			 $data['companyid']  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
				 $this->load->view('control/busname-setup/list',$data);
				}else{
					
					$busname	=	$this->input->post('busname'); 
						 
					$is_active	=	$this->input->post('is_active');
					if($this->input->post('company')){
						$company  	= $this->input->post('company');
					}else{
						$company	= $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}
					
					
					$data 				= 	array();
					$data['bus_name']	=	$busname;
					$data['company']	=	$company;
					$data['user']	=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$data['is_active']	=	$is_active;
					$result = $this->db->insert('bus_name_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'busnamesetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'busnamesetup/');
					}
				}

		}else{
			$data['primaryheader'] 	= 	'Bus Name Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Bus Name List";
		$data['addtitle'] 		=   "Add Bus Name";
	 	$table 					=	"bus_name_setup";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."busnamesetup/index";
	 	$orderby 				= 	'id';
	 	$order 				=  "desc";
	 	$data['row'] =  $this->Pagination_model->pagination_design_user($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
		foreach($utype as $ut){
			$utyps  = $ut['user_type'];
		}
		if($utyps!=='admin'){
	 	$data['companyid']  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
		}
	 	$this->load->view('control/busname-setup/list',$data);
		}
	}


	function update(){
		$id 		=	$this->uri->segment(4);
		if($this->input->post('submit')=='submit'){
	 		$this->form_validation->set_rules('busname','Bus Name','trim|required');
	 		
				if($this->form_validation->run() == FALSE){
					$table					=	"company_setup";
					$active 				=	"Y";
					$data['comapnies'] 		=	$this->dynamic_query->getbyactive($table,$active);
					$data['primaryheader'] 	= 'Bus Name Setup';
					$data['title']			=  "Update Bus Name";
					$data['row']			=	$this->dynamic_query->getbyid($id,$table);
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/busname-setup/edit',$data);
				}else{
					//print_r($this->input->post());
					$busname	=	$this->input->post('busname');  
					$is_active	=	$this->input->post('is_active'); 
					if($this->input->post('company')){
						$company  	= $this->input->post('company');
					}else{
						$company	= $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}
					$data 				= 	array();
					$data['bus_name']	=	$busname;
					$data['id']			= 	$id;
					$data['company']	=	$company;
					$data['user']	=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$data['is_active']	=	$is_active;
					$id = $this->db->where('id',$id);
					$result = $this->db->update('bus_name_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'busnamesetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'busnamesetup/');
					}
				}

		}else{
			$table1					=	"company_setup";
			$active 				=	"Y";
			$data['comapnies'] 		=	$this->dynamic_query->getbyactive($table1,$active);
			$table 					=	"bus_name_setup";
			$data['row']			=	$this->dynamic_query->getbyid($id,$table);
			$data['title']			=  "Update Bus Name";
			$data['primaryheader'] 	= 	'Bus Name Setup';
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/busname-setup/edit',$data);
		}
	}

	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$result 	=	$this->db->delete('bus_name_setup',array('id'=>$id));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
        	redirect('control/busnamesetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/busnamesetup/');
	 	}
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"bus_name_setup";
	 	$baseurl		=	"busnamesetup";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"bus_name_setup";
	 	$baseurl		=	"busnamesetup";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}




}