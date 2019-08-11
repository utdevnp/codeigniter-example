<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rootsetup extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('eBusLogin')){
			redirect('control/login');
		}
		$this->load->library('form_validation');
		$this->load->library('session');
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
		$data['primaryheader']	=	"Route Setup";
		$data['title'] 			=	"Route List";
		$data['addtitle'] 		=	"Add Route";
		$data['all'] 			=	$this->dynamic_query->getall('root_setup');
	 	$table 					=	"root_setup";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	10;
	 	$baseurl 				= 	"control/rootsetup/index/";
	 	$orderby 				= 	'id';
	 	$order 					=  "desc";
	 	$data['row'] 			=  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['count']			=  $this->dynamic_query->countall('root_setup','','');	
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/root-setup/list',$data);
	}

	function add(){
		if($this->input->post('submit')=='submit'){
			
			$this->form_validation->set_rules('from','From','trim|required');
			
			if($this->form_validation->run() == FALSE){

			 	$table 			=	"root_setup";
			 	$segment 		=  	$this->uri->segment(4); 
			 	$perpage 		= 	10;
			 	$baseurl 		= 	"control/rootsetup/index/";
			 	$orderby 		= 	'id';
			 	$order 			=  	"desc";
			 	$data['row'] 	=  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
				$data['primaryheader']	=	"Route Setup";
				$data['title'] 			=	"Route List";
				$data['addtitle'] 		=	"Add Route";
				$data['count']			=  $this->dynamic_query->countall('root_setup','','');
				$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
				$this->load->view('control/root-setup/list',$data);
			}else{	
				$data				=	array();
				$data['from']		=	$this->input->post('from');
				$data['to']			=	 $this->input->post('to');
				$data['is_active']	=	$this->input->post('is_active');
				$result			 	=	$this->db->insert('root_setup',$data);
				if($result){
					$this->session->set_userdata($this->messages->success());
		        	redirect('control/rootsetup/');
				}else{
					$this->session->set_userdata($this->messages->error());
		        	redirect('control/rootsetup/');
		      	}
			}
		}else{
			$this->index();
		}
	}


	function update(){
		$id 		=	$this->uri->segment(4);
		if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('from','From','trim|required');
			
			if($this->form_validation->run() == FALSE){
				$table	=	"root_setup";
				$data['primaryheader']	=	"Route Setup";
				$data['title'] 	=  "Update Route";
				$data['count']			=  $this->dynamic_query->countall('root_setup','','');
				$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 			$data['row'] 			=	$this->dynamic_query->getbyid($id,$table);
				$this->load->view('control/root-setup/edit',$data);
			}else{	
				$data				=	array();
				$data['from']		=	$this->input->post('from');
				$data['to']			=	 $this->input->post('to');
				$data['is_active']	=	$this->input->post('is_active');
				$this->db->where('id',$id);
				$result			 	=	$this->db->update('root_setup',$data);
				if($result){
					$this->session->set_userdata($this->messages->success());
		        	redirect('control/rootsetup/');
				}else{
					$this->session->set_userdata($this->messages->error());
		        	redirect('control/rootsetup/');
		      	}
			}
		}else{
			$id 					=	$this->uri->segment(4);
			$table					=	"root_setup";
			$data['row'] 			=	$this->dynamic_query->getbyid($id,$table);	
			$data['primaryheader']	=	"Route Setup";			
			$data['title'] 			=	"Update Route";
			$data['count']			=  $this->dynamic_query->countall('root_setup','','');
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/root-setup/edit',$data);
		}
	}

	function delete($id){
		$id 			= 	$this->uri->segment(4);
	 	$result 		=	$this->db->delete('root_setup',array('id'=>$id));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
        	redirect('control/rootsetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/rootsetup/');
	 	}
	}

	function active($id){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"root_setup";
	 	$baseurl		=	"rootsetup";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive($id){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"root_setup";
	 	$baseurl		=	"rootsetup";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}
}