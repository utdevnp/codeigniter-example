<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class categorysetup extends CI_Controller {
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
		$data['primaryheader']	=	"Category Setup";
		$data['title'] 	=	"Category List";
		$data['titleadd'] 	=	"Add Category";
		$data['all'] 	=	$this->dynamic_query->getall('feature_setup');
	 	$table ="category_setup";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 10;
	 	$baseurl = "control/categorysetup/index/";
	 	$orderby = 'id';
	 	$order =  "desc";
	 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/bus-category/list',$data);
	}

	function add(){
		if($this->input->post('submit')=='submit'){
			// print_r($this->input->post());
			// die();
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('code','Code','trim|required|min_length[3]');
				if($this->form_validation->run() == FALSE){
					$data['all'] 	=	$this->dynamic_query->getall('feature_setup');
				 	$table ="category_setup";
				 	$segment =  $this->uri->segment(4); 
				 	$perpage = 10;
				 	$baseurl = "control/categorysetup/index/";
				 	$orderby = 'id';
				 	$order =  "desc";
				 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
					$data['primaryheader']	=	"Category Setup";
					$data['title'] =  "Add Category";
					$data['titleadd'] 	=	"Add Category";
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/bus-category/add',$data);
				}else{
					$title 		= $this->input->post('title');
					$features 	= $this->input->post('features');
					$code 		= $this->input->post('code');
					$is_active 	=	$this->input->post('is_active');
					$data		=	array();
					$data['title']		=	$title;
					if($features!=""){
						$data['features']	= implode(',',$features);
					}else{
						$data['features']	=	"";
					}
					$data['code']		=	$code;
					$data['is_active']	=	$is_active;
					$result	 =	$this->db->insert('category_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/categorysetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/categorysetup/');
			       }
			}
		}else{
			$table					=	"category_setup";
			$data['row'] 			=	$this->dynamic_query->getall($table);	
			$data['primaryheader']	=	"Category Setup";			
			$data['title'] 	=	"Add Category";
			$data['all'] 	=	$this->dynamic_query->getall('feature_setup');
			$data['total']  =  $this->db->get('feature_setup')->num_rows(); 
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-category/add',$data);
		}
	}


	function update(){
		$id 	=	$this->uri->segment(4);
		if($this->input->post('submit')=='submit'){
			// print_r($this->input->post());
			// die();
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('code','Code','trim|required|min_length[3]');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Category Setup";
					$data['title'] =  "Add Category";
					$data['all'] 	=	$this->dynamic_query->getall('feature_setup');
					$table					=	"category_setup";
					$data['row'] 			=	$this->dynamic_query->getbyid($id,$table);
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));	
					$this->load->view('control/bus-category/edit',$data);
				}else{
					$title 		= $this->input->post('title');
					$features 	= $this->input->post('features');
					$code 		= $this->input->post('code');
					$is_active 	=	$this->input->post('is_active');
					$data		=	array();
					$data['title']		=	$title;
					if($features!=""){
						$data['features']	= implode(',',$features);
					}else{
						$data['features']	=	"";
					}
					$data['code']		=	$code;
					$data['is_active']	=	$is_active;
					$this->db->where('id',$id);
					$result	 =	$this->db->update('category_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/categorysetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/categorysetup/');
			       }
			}
		}else{
			$id 	=	$this->uri->segment(4);
			$table					=	"category_setup";
			$data['row'] 			=	$this->dynamic_query->getbyid($id,$table);	
			$data['primaryheader']	=	"Category Setup";			
			$data['title'] 	=	"Update Category";
			$data['all'] 	=	$this->dynamic_query->getall('feature_setup');
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-category/edit',$data);
		}

	}

	function view(){

			$id 	=	$this->uri->segment(4);
			$table					=	"category_setup";
			$data['row'] 			=	$this->dynamic_query->getbyid($id,$table);	
			$data['primaryheader']	=	"Category Setup";			
			$data['title'] 	=	"View Category";
			$data['all'] 	=	$this->dynamic_query->getall('feature_setup');
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-category/view',$data);
		}

	function delete(){
		$id 			= 	$this->uri->segment(4);
	 	$result 	=	$this->db->delete('category_setup',array('id'=>$id));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
        	redirect('control/categorysetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/categorysetup/');
	 	}
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"category_setup";
	 	$baseurl		=	"categorysetup";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"category_setup";
	 	$baseurl		=	"categorysetup";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}

}