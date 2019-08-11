<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class featuresetup extends CI_Controller {
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
		$this->load->model('static_model');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
	}

	
	function index(){
		$mainneutable = 'minmenu';
		$active = 'Y';
		$data['primaryheader'] = 'Feature Setup';
		$data['title'] =  "Feature List";
	 	$table ="feature_setup";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 9;
	 	$baseurl = ADMIN_BASE."featuresetup/index";
	 	$orderby = 'id';
	 	$order =  "desc";
	 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$this->load->view('control/bus-feature/list',$data);

	}



	function add(){

		if($this->input->post('addbtn')=='addbtn'){
		// print_r($this->input->post());
		// die();

	 		$this->form_validation->set_rules('title','Feature Title','trim|required');
	 		$this->form_validation->set_rules('key','Key Title','trim|required|max_length[5]');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader'] = 'Feature Setup';
					$data['title'] =  "Add Feature";
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
					$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/bus-feature/add',$data);
				}else{
					//print_r($this->input->post());
					$title	=	$this->input->post('title'); 
					$key	=	$this->input->post('key'); 
					$is_active	=	$this->input->post('is_active'); 
					$data 				= 	array();
					$data['title']	=	$title;
					$data['key']	=	$key;
					$data['is_active']	=	$is_active;
					$result = $this->db->insert('feature_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'featuresetup');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'featuresetup');
					}
				}

		}else{
			$data['primaryheader'] = 'Feature Setup';
			$data['title'] 	=	"Add Feature";
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
			$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-feature/add',$data);
		}
	}

	function update(){
		$id = $this->uri->segment(4);
		$table			=	"feature_setup";
		if($this->input->post('updatebtn')=='updatebtn'){
	 		$this->form_validation->set_rules('title','Feature Title','trim|required');
	 		$this->form_validation->set_rules('key','Key Title','trim|required|max_length[5]');
				if($this->form_validation->run() == FALSE){
	 				$data['primaryheader'] = 'Feature Setup';
					$data['title'] 	=	"Update Feature";
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
					$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 				$data['row']	=	$this->dynamic_query->getbyid($id,$table);
					$this->load->view('control/bus-feature/update',$data);
				}else{
					$title	=	$this->input->post('title'); 
					$key	=	$this->input->post('key'); 
					$is_active	=	$this->input->post('is_active'); 
					$data 				= 	array();
					$data['title']	=	$title;
					$data['key']	=	$key;
					$data['is_active']	=	$is_active;
					$this->db->where('id',$id);
					$result 	=	$this->db->update('feature_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'featuresetup');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'featuresetup');
					}
				}
	 	}else{
	 		$data['primaryheader'] = 'Feature Setup';
			$data['title'] 	=	"Update Feature";
	 		$data['row']	=	$this->dynamic_query->getbyid($id,$table);
	 		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
			$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-feature/update',$data);
		}
	}

	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"feature_setup";
	 	$baseurl		=	"featuresetup";
	 	$this->dynamic_query->trash($id,$table,$baseurl);
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"feature_setup";
	 	$baseurl		=	"featuresetup";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"feature_setup";
	 	$baseurl		=	"featuresetup";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}




}