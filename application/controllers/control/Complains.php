<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complains extends CI_Controller {
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
		$data['primaryheader'] 	    = 	'Complains';
		$data['title'] 			    =  	"Complains List";
		$data['row'] = $this->dynamic_query->getall('complains');
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/complains/list',$data);
	}

	function view(){
		$id = $this->uri->segment(4);
		if(empty($id)){
			$this->session->set_userdata($this->messages->idnotfound());
			redirect("control/complains/list");
		}
		$data['primaryheader'] 	    = 	'Complains';
		$data['title'] 			    =  	"View  Complains";
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$data['row'] = $this->dynamic_query->getbyid($id,'complains');
		$this->load->view('control/complains/view',$data);
	}

	function active($id){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'Y'); //value that used to update column  
        $res = $this->db->update('complains');
        if($res){
        	$this->session->set_userdata($this->messages->success());
            redirect('control/complains/');
        }else{
        	        	
        	$this->session->set_userdata($this->messages->error());
             redirect('control/complains/');
        }
   }

   function deactive($id){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'N'); //value that used to update column  
        $res = $this->db->update('complains');
        if($res){
        	$this->session->set_userdata($this->messages->success());
             redirect('control/complains/');
        }else{
           $this->session->set_userdata($this->messages->error());
             redirect('control/complains/');
        }
   }


   function trash($id){
		$id 		=	$this->uri->segment(4);
		 $table 	= "company_setup";
		$result 	=	$this->db->delete('complains',array('id'=>$id));
		if($result){
			$this->session->set_userdata($this->messages->trashed());
        	redirect('control/complains/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/complains/');
       }
   
	}



}