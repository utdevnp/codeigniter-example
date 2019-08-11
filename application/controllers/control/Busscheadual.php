<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busscheadual extends CI_Controller {
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
		$data['primaryheader'] 	= 	'Bus Scheadual Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Scheadual List";
	 	$table 					=	"bus_scheadual";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."busscheadual/index";
	 	$orderby 				= 	'id';
	 	$order 					=  	'DESC';
	 	$date 					= 	date('m-d-Y');
	 	$data['row'] 			=  	$this->Pagination_model->pagination_design_user_busscheadual($table,$perpage,$baseurl,$orderby,$order,$segment,$date);
	 	$data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	$data['count'] 			=	$this->dynamic_query->countall('bus_scheadual','','');
	 	$data['busno']			=	$this->dynamic_query->getall('bus_setup');
		$data['busrot']			=	$this->dynamic_query->getall('root_setup');
		$data['allcom']			=	$this->dynamic_query->getall('company_setup');
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$this->load->view('control/bus-scheadual/list',$data);

	}

	

	function departedbus(){
		$data['primaryheader'] 	= 	'Bus Scheadual Setup';
		$active 				=	"Y";
		$data['title'] 			=  	"Departed Scheadual List";
	 	$table 					=	"bus_scheadual";
	 	$segment 				=  	$this->uri->segment(4); 
	 	$perpage 				= 	9;
	 	$baseurl 				= 	ADMIN_BASE."busscheadual/departedbus";
	 	$orderby 				= 	'id';
	 	$order 					=  	'DESC';
	 	$date 					= 	date('m-d-Y');
	 	$data['row'] 			=  	$this->Pagination_model->pagination_design_user_busscheadual_depart($table,$perpage,$baseurl,$orderby,$order,$segment,$date);
	 	$data['comapnies'] 		=	$this->dynamic_query->getbyactive('company_setup',$active);
	 	$data['count'] 			=	$this->dynamic_query->countall('bus_scheadual','','');
	 	$data['busno']			=	$this->dynamic_query->getall('bus_setup');
		$data['busrot']			=	$this->dynamic_query->getall('root_setup');
		$data['allcom']			=	$this->dynamic_query->getall('company_setup');
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 	$this->load->view('control/bus-scheadual/list-depart',$data);

	}

	function add(){

		if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('bus_no','Bus No name','trim|required');
			$this->form_validation->set_rules('departuretime','Departure Time name','trim|required|min_length[8]|max_length[11]');
			$this->form_validation->set_rules('arrivaltime','Arrival Time name','trim|required|min_length[8]|max_length[11]');
			$this->form_validation->set_rules('departure','Departure','trim|required');
			$this->form_validation->set_rules('arrival','Arrival','trim|required');
			$this->form_validation->set_rules('from','From','trim|required');
			$this->form_validation->set_rules('to','To','trim|required');
			$this->form_validation->set_rules('fare','Grand Fare','trim|required');
			$this->form_validation->set_rules('netfare','Net Fare','trim|required');
			$this->form_validation->set_rules('discount','Discount','trim|required');
			
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Scheadual";			
					$data['title'] 			=	"Add Scheadual";
					$data['busno']			=	$this->dynamic_query->getall('bus_setup');
					$data['allcom']			=	$this->dynamic_query->getall('company_setup');
					$data['routs']			=	$this->dynamic_query->getall('root_setup');
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/bus-scheadual/add',$data);
				}else{
					
					if($this->input->post('company')){
						$company  	= $this->input->post('company');
					}else{
						$company	= $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}
					$data					=	array();
					$data['shift']			=	$this->input->post('shift');
					$data['boardingpoint']	=	implode(',',$this->input->post('boardingpoint'));
					$data['boardingtime']	=	implode(',',$this->input->post('boardingtime'));
					$data['droppingtime']	=	implode(',',$this->input->post('droppingtime'));
					$data['droppingpoint']	=	implode(',',$this->input->post('droppingpoint'));
					$data['fare']			=	$this->input->post('fare');
					$data['netfare']			=	$this->input->post('netfare');
					$data['discount']			=	$this->input->post('discount');
					$data['bus_no']			=	$this->input->post('bus_no');
					$data['departure']		=	$this->input->post('departure');
					$data['arrival']		=	$this->input->post('arrival');
					$data['departuretime']	=	$this->input->post('departuretime');
					$data['arrivaltime']	=	$this->input->post('arrivaltime');
					$data['from']			=	$this->input->post('from');
					$data['to']				=	$this->input->post('to');
					$data['company']		=	$company;
					$data['is_active']		=	$this->input->post('is_active');
					$data['user']	=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$result	 =	$this->db->insert('bus_scheadual',$data);
					$id = $this->db->insert_id();
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/busscheadual/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/busscheadual/');
			       }
				}
		}else{
			$data['primaryheader']	=	"Scheadual";		
			$data['title'] 			=	"Add Scheadual";
			
			$utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
			foreach($utype as $ut){
				$utyps  = $ut['user_type'];
			}
			if($utyps!=='admin'){
				$companyid	=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
				$data['busno'] 	=	$this->dynamic_query->getby($companyid,'bus_setup','company');	
			}else {
				$data['busno'] 	=	$this->dynamic_query->getall('bus_setup');	
			}
			$data['routs']			=	$this->dynamic_query->getall('root_setup');
			$data['allcom']			=	$this->dynamic_query->getall('company_setup');
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-scheadual/add',$data);
		}

		
	}

	function update($id){

		$id 	=	$this->uri->segment(4);
		if($this->input->post('submit')=='submit'){

			$this->form_validation->set_rules('bus_no','Bus No name','trim|required');
			$this->form_validation->set_rules('departuretime','Departure Time name','trim|required|min_length[8]|max_length[11]');
			$this->form_validation->set_rules('arrivaltime','Arrival Time name','trim|required|min_length[8]|max_length[11]');
			$this->form_validation->set_rules('departure','Departure','trim|required');
			$this->form_validation->set_rules('arrival','Arrival','trim|required');
			$this->form_validation->set_rules('from','From','trim|required');
			$this->form_validation->set_rules('to','To','trim|required');
			$this->form_validation->set_rules('fare','Grand Fare','trim|required');
			$this->form_validation->set_rules('netfare','Net Fare','trim|required');
			$this->form_validation->set_rules('discount','Discount','trim|required');
			
				if($this->form_validation->run() == FALSE){

					$data['primaryheader']	=	"Scheadual";			
					$data['title'] 			=	"Add Scheadual";
					$data['count'] 			=	$this->dynamic_query->countall('bus_scheadual','','');
					$data['busno']			=	$this->dynamic_query->getall('bus_setup');
					$data['bussch']			=	$this->dynamic_query->getbyid($id,'bus_scheadual');
					$data['allcom']			=	$this->dynamic_query->getall('company_setup');
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 				$data['routs']			=	$this->dynamic_query->getall('root_setup');
					$this->load->view('control/bus-scheadual/edit',$data);
				}else{
					if($this->input->post('company')){
						$company  	= $this->input->post('company');
					}else{
						$company	= $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}
					$data					=	array();
					$data['id']				=	$id;
					$data['droppingtime']	=	implode(',',$this->input->post('droppingtime'));
					$data['droppingpoint']	=	implode(',',$this->input->post('droppingpoint'));
					$data['shift']			=	$this->input->post('shift');
					$data['boardingpoint']	=	implode(',',$this->input->post('boardingpoint'));
					$data['boardingtime']	=	implode(',',$this->input->post('boardingtime'));
					$data['fare']			=	$this->input->post('fare');
					$data['netfare']			=	$this->input->post('netfare');
					$data['discount']			=	$this->input->post('discount');
					$data['bus_no']			=	$this->input->post('bus_no');
					$data['departure']		=	$this->input->post('departure');
					$data['arrival']		=	$this->input->post('arrival');
					$data['departuretime']	=	$this->input->post('departuretime');
					$data['arrivaltime']	=	$this->input->post('arrivaltime');
					$data['from']			=	$this->input->post('from');
					$data['to']				=	$this->input->post('to');
					$data['company']		=	$company;
					$data['is_active']		=	$this->input->post('is_active');
					$data['user']	=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					$this->db->where('id',$id);
					$result	 =	$this->db->update('bus_scheadual',$data);
					if($result){

						$this->session->set_userdata($this->messages->success());
			        	redirect('control/busscheadual/');
					}else{
						 
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/busscheadual/');
			       }
				}
		}else{
			$data['primaryheader']	=	"Scheadual";
			$data['title'] 			=	"Update Scheadual";
			$data['count'] 			=	$this->dynamic_query->countall('bus_scheadual','','');
			$data['bussch']			=	$this->dynamic_query->getbyid($id,'bus_scheadual');
			$data['busno']			=	$this->dynamic_query->getall('bus_setup');
			$data['routs']			=	$this->dynamic_query->getall('root_setup');
			$data['allcom']			=	$this->dynamic_query->getall('company_setup');
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-scheadual/edit',$data);
		}

	}

	function view(){
			$id 	=	$this->uri->segment(4);
			$data['primaryheader']	=	"Scheadual Setup";
			$data['title'] 			=	"View Scheadual";
			$data['count'] 			=	$this->dynamic_query->countall('bus_scheadual','','');
			$data['allbusnames'] 	=	$this->dynamic_query->getall('bus_name_setup');
			$data['row']			=	$this->dynamic_query->getbyid($id,'bus_scheadual');
			$data['allbuses']		=	$this->dynamic_query->getall('bus_setup');
			$data['catagory']		=	$this->dynamic_query->getall('category_setup');
			$data['allfeture']		=	$this->dynamic_query->getall('feature_setup');
			$data['routs']			=	$this->dynamic_query->getall('root_setup');
			$data['passengerinfo']	=	$this->dynamic_query->getbysid($id,'passengers_ticket_info');
			$table 					= 	'passengers_detail';
			$data['passengerdtl']   = 	$this->dynamic_query->getall($table);
			$data['allcom']			=	$this->dynamic_query->getall('company_setup');
			$maintable 				= 	'bus_scheadual';
			$table = 'bus_setup';
			$fieldA = 'bus_no';
			$fieldB  = 'id';
			$data['busdetails']		=	$this->dynamic_query->getbyscheadual($id,$maintable,$table,$fieldA,$fieldB);
			$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-scheadual/view',$data);
	}

	function trash(){
		$id 			= 	$this->uri->segment(4);
	 	$result 		=	$this->db->delete('bus_scheadual',array('id'=>$id));
	 	if($result){
	 		$this->session->set_userdata($this->messages->trashed());
        	redirect('control/busscheadual/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/busscheadual/');
	 	}
	}

	function active(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"bus_scheadual";
	 	$baseurl		=	"busscheadual";
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$id 			= 	$this->uri->segment(4);
	 	$table			=	"bus_scheadual";
	 	$baseurl		=	"busscheadual";
	 	$this->active_model->deactive($id,$table,$baseurl);
	}
}
?>