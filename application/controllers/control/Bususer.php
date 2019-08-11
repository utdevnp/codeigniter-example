<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bususer extends CI_Controller {
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
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		$this->load->helper('date');
	}
	
	function index(){
		$data['title']="Client User";
		$data['primaryheader']="dashboard";
		$table ="bus_user";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 20;
	 	$baseurl = "control/bususer/index/";
	 	$orderby = 'id';
	 	$order =  "desc";
	 	$data['allusers'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
		$this->load->view('control/bususer/dashboard',$data);
	}
	
	
	function usercrud(){
		$id =$this->input->post('id');
		if($this->input->post('updateuser')=="update"){
			$this->form_validation->set_rules('mobile_no','Mobile Number','required|max_length[10]|min_length[10]');
	 		$this->form_validation->set_rules('email','Email','trim|required');
			if($this->form_validation->run() == FALSE){
				$this->session->set_userdata($this->messages->error());
				$this->index();
			}else{
				$data['fname'] = $this->input->post('fname');
				$data['lname'] = $this->input->post('lname');
				$data['email'] = $this->input->post('email');
				$data['mobile_no'] = $this->input->post('mobile_no');
				$data['address'] = $this->input->post('address');
				$this->db->where('id',$id);
				$query = $this->db->update('bus_user',$data);
				if($query==1){
					$this->session->set_userdata($this->messages->success());
					redirect(ADMIN_BASE.'bususer');
					//echo "success";
				}else{
					$this->session->set_userdata($this->messages->error());
					redirect(ADMIN_BASE.'bususer');
					//echo "error";
				}
			}
		}	
	}
	
	// This function is used to change password of the user 
   function changepassword()
   {
	   	if($this->input->post('changepass')=='changepass')
	   	{
			$id = $this->input->post('id');
			$table			=	"bus_user";
		
	   		$this->form_validation->set_rules('oldpassword','Old Password','trim|required|min_length[8]|max_length[50]');
	   		$this->form_validation->set_rules('password','New Password','trim|required|min_length[8]|max_length[50]');
	   		$this->form_validation->set_rules('repassword','New Password','trim|required|min_length[8]|max_length[50]');
	   		if($this->form_validation->run()==FALSE){
				$this->session->set_userdata($this->messages->error());
				$data['row']	=	$this->dynamic_query->getbyid($id,$table);
	   			$this->index();
	   		}else{
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
						echo "chenged";
						$datapw['password'] = $password;
						$this->db->where('id',$id); //which row want to upgrade  
						$result 	= 	$this->db->update($table,$datapw);  //table name
						if($result){
							$this->session->set_userdata('pwchange',$pass);
							$data['row']	=	$this->dynamic_query->getbyid($id,$table);
							$this->session->set_userdata($this->messages->success());
           					redirect(ADMIN_BASE."bususer");
						}else{
							$this->session->set_userdata($this->messages->error());
							$data['row']	=	$this->dynamic_query->getbyid($id,$table);
           					$this->index();
						}
	   				}else{
	   					 // if repasword and password dont't match 
	   					$this->session->set_userdata($this->messages->passwordnotmatch());
	   					$data['row']	=	$this->dynamic_query->getbyid($id,$table);
						$this->index();
	   				}

	   			}else{
	   				 // if oldpasword and dbpassword dont't match 
	   				$this->session->set_userdata($this->messages->oldpaswordnotmatch());
	   				$data['row']	=	$this->dynamic_query->getbyid($id,$table);
	   				$this->index();
	   			}
	   		}
	   	}else{
	   		$this->index();
	   	}
   }

   
   function trash(){
	    if($this->input->post('deleteuser')=="deleteuser"){
			$id 			= 	$this->input->post('id');
			$table			=	"bus_user";
			$baseurl		=	"bususer";
			$check	=	$this->dynamic_query->getbyid($id,$table);
			$this->dynamic_query->trash($id,$table,$baseurl);
		}
	}
	
   
   
	
	
}