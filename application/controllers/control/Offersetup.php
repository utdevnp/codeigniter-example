
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class offersetup extends CI_Controller {
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
		$this->load->model('static_model');
		$this->load->model('Pagination_model');
		$this->load->model('dynamic_query');
		$this->load->model('active_model');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
		
	}

	function index(){
		$data['primaryheader'] 	= 	'Offer  Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Offer List";
	 	$table 					=	"offer_setup";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."offersetup/index";
	 	$orderby 				= 	'id';
	 	$order 					=  	'DESC';

	 	$data['row'] 			=  	$this->Pagination_model->pagination_design_user($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	$data['count'] 			=	$this->dynamic_query->countall('offer_setup','','');
	 	$data['busno']			=	$this->dynamic_query->getall('bus_setup');
		$data['busrot']			=	$this->dynamic_query->getall('root_setup');
		$data['allcom']			=	$this->dynamic_query->getall('company_setup');
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$data['scheadual']			=	$this->dynamic_query->getall('offer_setup');
	 	$this->load->view('control/offer-setup/list',$data);

	}


	function add(){
		if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('offer_title','Offer title','trim|required');
			$this->form_validation->set_rules('offer_from','Offer From','trim|required');
			$this->form_validation->set_rules('offer_to','Offer To','trim|required');
			$this->form_validation->set_rules('offer_discount','Offer Discount','trim|required');
			$this->form_validation->set_rules('category','Bus Category ','trim|required');
			
			
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Offer Setup";			
					$data['title'] 			=	"Add Offer";
					$data['row']			=	$this->dynamic_query->getall('offer_setup');
					$data['allcat'] 	=	$this->dynamic_query->getall('category_setup');
					$data['scheadual']		=	$this->dynamic_query->getall('offer_setup');
					$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/offer-setup/add',$data);
				}else{
					if($this->input->post('company')){
						$company =  $this->input->post('company');
					}else {
						$company  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}

					$data						=	array();
					$data['offer_title']		=	$this->input->post('offer_title');
					$data['category']			=	$this->input->post('category');
					$data['offer_discount']		=	 $this->input->post('offer_discount');
					$data['offer_from']			=	$this->input->post('offer_from');
					$data['offer_to']			=	$this->input->post('offer_to');
					$data['company']			=	$company;
					$data['is_active']			=	$this->input->post('is_active');
					$data['coupon']				=    strtoupper(random_string('alnum',6));
					$data['user']				=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$result	 =	$this->db->insert('offer_setup',$data);

					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/offersetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/offersetup/');
			       }
				}
		}else{
			$data['primaryheader']	=	"Offer Setup";			
			$data['title'] 			=	"Update Offer";
			$data['row']			=	$this->dynamic_query->getall('offer_setup');
			$data['allcom']			=	$this->dynamic_query->getall('company_setup');
			$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
			$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/offer-setup/add',$data);
		}

	}

	function update(){

		$id 		=		$this->uri->segment(4);
		if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('offer_title','Offer title','trim|required');
			$this->form_validation->set_rules('offer_from','Offer From','trim|required');
			$this->form_validation->set_rules('offer_to','Offer To','trim|required');
			$this->form_validation->set_rules('offer_discount','Offer Discount','trim|required');
			
			
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Offer Setup";			
					$data['title'] 			=	"Update Offer";
					$table     				=   "offer_setup";
					$data['row']			=	$this->dynamic_query->getbyid($id,$table);
					$data['scheadual']		=	$this->dynamic_query->getall('offer_setup');
					$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
					$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/offer-setup/edit',$data);
				}else{
					
					if($this->input->post('company')){
						$company =  $this->input->post('company');
					}else {
						$company  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}
					$data						=	array();
					$data['offer_title']			=	$this->input->post('offer_title');
					$data['category']			=	$this->input->post('category');
					$data['offer_discount']		=	$this->input->post('offer_discount');
					$data['offer_from']			=	$this->input->post('offer_from');
					$data['offer_to']			=	$this->input->post('offer_to');
					$data['company']			=	$company;
					$data['is_active']			=	$this->input->post('is_active');
					$data['coupon']				=   strtoupper(random_string('alnum',6));
					$data['user']				=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$this->db->where('id',$id);
					$result	 =	$this->db->update('offer_setup',$data);
					$this->activity_model->ActivityRunner($this->uri->segment(2),$this->uri->segment(3),$id,$data['user']);
					// echo $this->db->last_query();
					// die();
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/offersetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/offersetup/');
			       }
				}
		}else{
			$data['primaryheader']	=	"Offer Setup";			
			$data['title'] 			=	"Update Offer";
			$table     				=   "offer_setup";
			$data['row']			=	$this->dynamic_query->getbyid($id,$table);
			$data['scheadual']		=	$this->dynamic_query->getall('offer_setup');
			$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
			$data['allcom']		    =	$this->dynamic_query->getall('company_setup');
			$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/offer-setup/edit',$data);
		}
	}

	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$result 		=	$this->db->delete('offer_setup',array('id'=>$id));
	 	$data['user'] =	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
	 		$this->Activity_model->ActivityRunner($this->uri->segment(2),$this->uri->segment(3),$id,$data['user']);
        	redirect('control/offersetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/offersetup/');
	 	}
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
}
?>