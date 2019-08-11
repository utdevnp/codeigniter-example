<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menus extends CI_Controller {
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
		$data['primaryheader'] = 'Menu Setup';
		$data['title'] =  "Menu List";
		$data['addtitle'] =  "Add Menu";
	 	$table ="menu_setup";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 15;
	 	$baseurl = ADMIN_BASE."menus/index";
	 	$orderby = 'id';
	 	$parent = 0;
	 	$order =  "asc";
	 	$data['row'] =  $this->Pagination_model->pagination_design_parent($table,$perpage,$baseurl,$orderby,$order,$segment,$parent);
	 	$data['allmenu']  = $this->dynamic_query->getallactiveWithParent($table,$active);
	 	$data['mainmenu']  = $this->dynamic_query->getallactive($mainneutable,$active);
	 	$this->load->view('control/menus/list',$data);

	}

	function add(){
		$this->static_model->permissoncheck_($this->uri->segment(2),$this->uri->segment(3),$this->session->userdata('eBusLogin'));

		$mainneutable = 'minmenu';
		$table = 'menu_setup';
		$active = 'Y';
		$parent = 0;
		if($this->input->post('addmenu')=='addmenu'){
	 		$this->form_validation->set_rules('title','Title','trim|required');
	 		$this->form_validation->set_rules('pseudo_name','Pseudo Name','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader'] = 'Menu Setup';
					$data['title'] =  "Menu List";
					$data['addtitle'] =  "Add Menu";
					$table =$table;
					$segment =  $this->uri->segment(4); 
				 	$perpage = 9;
				 	$baseurl = ADMIN_BASE."menus/index";
				 	$orderby = 'id';
				 	$order =  "asc";
				 	$data['row'] =  $this->Pagination_model->pagination_design_parent($table,$perpage,$baseurl,$orderby,$order,$segment,$parent);
				 	$this->session->set_userdata($this->messages->information());
				 	$data['mainmenu']  = $this->dynamic_query->getallactive($mainneutable,$active);
					$this->load->view('control/menus/list',$data);
				}else{
					$data['title']	=	$this->input->post('title'); 
					$data['parent']	=	$this->input->post('parent'); 
					$data['pseudo_name']	=	$this->input->post('pseudo_name'); 
					$data['icon_class']	=	$this->input->post('icon_class'); 
					$data['custom_url']	=	$this->input->post('custom_url'); 
					$data['is_active']	=	$this->input->post('is_active'); 
					if(empty($this->input->post('menus')))
					{
						$data['menus']	=	""; 
					}else{
						$data['menus']	=	implode(',',$this->input->post('menus')); 
					}
					$result = $this->db->insert($table,$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'menus');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'menus');
					}
				}

		}else{
			$this->session->set_userdata($this->messages->information());
			redirect(ADMIN_BASE.'menus');
		}
	}

	function update(){
		$id = $this->uri->segment(4);
		$table = 'menu_setup';
		$mainneutable = 'minmenu';
		$fields = 'menus';
		$active= 'Y';
		if($this->input->post('updatebtn')=='updatebtn'){
	 		$this->form_validation->set_rules('title','Title','trim|required');
	 		$this->form_validation->set_rules('pseudo_name','Pseudo Name','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader'] = 'Menu Setup';
					$data['title'] =  "Update Menu";
					$data['row']	=	$this->dynamic_query->getbyid($id,$table);
					$data['allmenu']  = $this->dynamic_query->getallactiveWithParent($table,$active);
					$data['mainmenu']  = $this->dynamic_query->getallactive($mainneutable,$active);
					$data['menudbmenus']  = $this->dynamic_query->select_fields($id,$table,$fields);
					$this->session->set_userdata($this->messages->information());
					$this->load->view('control/menus/update',$data);
				}else{
					$data['title']	=	$this->input->post('title'); 
					$data['parent']	=	$this->input->post('parent'); 
					$data['pseudo_name']	=	$this->input->post('pseudo_name'); 
					$data['icon_class']	=	$this->input->post('icon_class'); 
					$data['custom_url']	=	$this->input->post('custom_url'); 
					$data['is_active']	=	$this->input->post('is_active'); 
					if(empty($this->input->post('menus')))
					{
						$data['menus']	=	""; 
					}else{
						$data['menus']	=	implode(',',$this->input->post('menus')); 
					} 
					$this->db->where('id',$id);
					$result = $this->db->update($table,$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'menus');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'menus');
					}
				}

		}else{
			$data['primaryheader'] = 'Menu Setup';
			$data['title'] =  "Update Menu";
			$data['allmenu']  = $this->dynamic_query->getallactiveWithParent($table,$active);
			$data['row']	=	$this->dynamic_query->getbyid($id,$table);
			$data['mainmenu']  = $this->dynamic_query->getallactive($mainneutable,$active);
			$data['menudbmenus']  = $this->dynamic_query->select_fields($id,$table,$fields);
			$this->session->set_userdata($this->messages->information());
			$this->load->view('control/menus/update',$data);
		}
	}

	function listmainmenu(){
		if($this->input->post('addmenu')=='addmenu')
		{
			$table ="minmenu";
			$this->form_validation->set_rules('title','Title','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader'] = 'Main Menu Setup';
					$data['title'] =  "Main Menu List";
					$data['addtitle'] =  "Add Menu";
				 	$segment =  $this->uri->segment(4); 
				 	$perpage = 9;
				 	$baseurl = ADMIN_BASE."menus/updatemainmenu";
				 	$orderby = 'id';
				 	$parent = 0;
				 	$order =  "asc";
				 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment,$parent);
					$this->load->view('control/menus/listmainmenu',$data);
				}else{
					$data['title']	=	$this->input->post('title'); 
					$data['icon']	=	$this->input->post('icon'); 
					$data['is_active']	=	$this->input->post('is_active'); 
					$result = $this->db->insert($table,$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'menus/listmainmenu');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'menus/listmainmenu');
					}
				}	
	 	}else{
			$data['primaryheader'] = 'Main Menu Setup';
			$data['title'] =  "Main Menu List";
			$data['addtitle'] =  "Add Menu";
		 	$table ="minmenu";
		 	$segment =  $this->uri->segment(4); 
		 	$perpage = 9;
		 	$baseurl = ADMIN_BASE."menus/updatemainmenu";
		 	$orderby = 'id';
		 	$parent = 0;
		 	$order =  "asc";
		 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment,$parent);
		 	$this->load->view('control/menus/listmainmenu',$data);	
	 	}

	}


	function updatemainmenu(){
		$id = $this->uri->segment(4);
		$table ="minmenu";
		if($this->input->post('updatemenu')=='updatemenu')
		{
			$this->form_validation->set_rules('title','Title','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader'] = 'Main Menu Setup';
					$data['addtitle'] =  "Update Menu";
					$data['row']	=	$this->dynamic_query->getbyid($id,$table);
					$this->load->view('control/menus/updatemainmenu',$data);
				}else{
					$data['title']	=	$this->input->post('title'); 
					$data['icon']	=	$this->input->post('icon'); 
					$data['is_active']	=	$this->input->post('is_active'); 
					$this->db->where('id',$id);
					$result = $this->db->update($table,$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						redirect(ADMIN_BASE.'menus/listmainmenu');
					}else{
						$this->session->set_userdata($this->messages->error());
						redirect(ADMIN_BASE.'menus/listmainmenu');
					}
				}	
	 	}else{
			$data['primaryheader'] = 'Main Menu Setup';
			$data['addtitle'] =  "Update Menu";
			$data['row']	=	$this->dynamic_query->getbyid($id,$table);
		 	$this->load->view('control/menus/updatemainmenu',$data);	
	 	}

	}


	function trashmainemnu(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"minmenu";
	 	$baseurl		=	"menus/listmainmenu";
	 	$this->dynamic_query->trash($id,$table,$baseurl);
	}


	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"menu_setup";
	 	$baseurl		=	"menus";
	 	$this->dynamic_query->trash($id,$table,$baseurl);
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"menu_setup";
	 	$baseurl		=	"menus";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"menu_setup";
	 	$baseurl		=	"menus";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}




}