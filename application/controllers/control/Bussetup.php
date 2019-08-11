<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bussetup extends CI_Controller {
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
		$this->load->library('javascript');
		$this->load->model('dynamic_query');
		$this->load->model('activity_model');
		$this->load->model('active_model');
		$this->load->model('static_model');
    	$this->activity_model->autoload();
		
	}

	function index(){
		  
		$data['primaryheader']	=	"Bus Setup";
		$data['title'] 	=	"Lists of Buses";
		$data['all'] 	=	$this->dynamic_query->getall('company_setup');
	 	$table 			=	"bus_setup";
	 	$segment 		=  	$this->uri->segment(4); 
	 	$perpage 		= 	8;
	 	$baseurl 		= 	"control/bussetup/index/";
	 	$orderby 		= 	'id';
	 	$order 			=  	"desc";
	 	$data['row'] 	=  	$this->Pagination_model->pagination_design_user($table,$perpage,$baseurl,$orderby,$order,$segment);
		$data['allcom'] =	$this->dynamic_query->getall('company_setup');
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/bus-setup/list',$data);
	}

	function add(){
		
		if($this->input->post('submit')=='submit'){ 
			// print_r($this->input->post());
			// die();
			
			$vectype = $this->input->post('type');
			$this->form_validation->set_rules('bus_no','Bus No','trim|required|min_length[10]|max_length[15]');
			$this->form_validation->set_rules('bus_name','Bus Name','trim|required');
			$this->form_validation->set_rules('bus_category','Bus Category','trim|required');
			$this->form_validation->set_rules('mobile_no','Mobile','trim|required|min_length[10]|max_length[10]');
			if($vectype=="bus"){
			$this->form_validation->set_rules('total_sheet_in_a_side','Site in A Side','trim|required');
			$this->form_validation->set_rules('total_sheet_in_b_side','Site in B Side','trim|required');
		  }
				if($this->form_validation->run() == FALSE){
					$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
					$data['allcom'] 		=	$this->dynamic_query->getall('company_setup');
					$data['allbus'] 		=	$this->dynamic_query->getall('bus_name_setup');
					$data['all'] 			=	$this->dynamic_query->getall('company_setup');
					$data['primaryheader']	=	"Bus Setup";
					$data['title'] 			=  "Add New Bus";
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/bus-setup/add',$data);
				}else{	

					if($this->input->post('hice')){
						$hice =  $this->input->post('hice[]');
					}else {
						$hice[]  = 0;
					}
					if($this->input->post('force')){
						$force =  $this->input->post('force[]');
					}else {
						$force[]  = 0;
					}
					if($this->input->post('total_sheet_in_a_side')){
						$aside =  $this->input->post('total_sheet_in_a_side');
					}else {
						$aside  = 0;
					}
					if($this->input->post('total_sheet_in_b_side')){
						$bside =  $this->input->post('total_sheet_in_b_side');
					}else {
						$bside  = 0;
					}
					if($this->input->post('last_row')){
						$last =  $this->input->post('last_row');
					}else {
						$last  = 0;
					}
					if($this->input->post('cabin')){
						$cabin =  $this->input->post('cabin');
					}else {
						$cabin  = 0;
					}
					if($this->input->post('special')){
						$special =  $this->input->post('special');
					}else {
						$special  = 0;
					}
					if($this->input->post('company')){
						$company =  $this->input->post('company');
					}else {
						$company  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}

					$data								=	array();
					$data['bus_no']						=	$this->input->post('bus_no');
					$data['bus_name']					=	$this->input->post('bus_name');
					$data['bus_category']				=	$this->input->post('bus_category');
					$data['company']					=	$company;
					$data['mobile_no']					=	$this->input->post('mobile_no');
					$data['total_sheet_in_a_side']		=	$aside;
					$data['total_sheet_in_b_side']		=	$bside;
					$data['last_row']					=	$last;
					$data['email']						=	$this->input->post('email');
					$data['is_active']					=	$this->input->post('is_active');
					$data['driver_mobile_no']			=	$this->input->post('driver_mobile_no');
					$data['driver_name']				=	$this->input->post('driver_name');
					$data['owner']						=	$this->input->post('owner');
					$data['driver_name']				=	$this->input->post('driver_name');
					$data['cabin']						=	$cabin;
					$data['special']					=	$special;
					$data['type']						=	$this->input->post('type');
					$data['hices']						=	implode(',', $hice);
					$data['forces']						=	implode(',', $force);
					$data['user']						=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));

					if($_FILES['bus_image']['name']!=""){
					  	
					  	$today	=	date('Ymd_his');
					  	$config['file_name']			=	'update_'.$today.'_ebus';
			            $config['upload_path']          = BUS_IMAGE_DIR;
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('bus_image')){
			            	$this->session->set_userdata('errormessage',$this->upload->display_errors("<p class='text-danger'>","</p>"));
			                redirect('control/bussetup/add');
			            }else{
			            	 $filedetails = $this->upload->data();
			            }
			            $data['bus_image'] = $filedetails['file_name'];
			           }else{
				            $data['bus_image'] = ""; 
				           }


					$result	 =	$this->db->insert('bus_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/bussetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/bussetup/');
			       }
			}
		}else{
			$utype  = $this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
			foreach($utype as $ut){
				$utyps  = $ut['user_type'];
			}
			if($utyps!=='admin'){
				$companyid	=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
				$data['allbus'] 	=	$this->dynamic_query->getby($companyid,'bus_name_setup','company');
			}else{
				$data['allbus'] 	=	$this->dynamic_query->getall('bus_name_setup');
			}
			$data['allcat'] 	=	$this->dynamic_query->getall('category_setup');
			$data['allcom'] 	=	$this->dynamic_query->getall('company_setup');
			$data['primaryheader']	=	"Bus Setup";			
			$data['title'] 	=	"Add New Bus";
			$data['all'] 	=	$this->dynamic_query->getall('company_setup'); 
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-setup/add',$data);
		}
	} 

	function update(){
		$id 		= $this->uri->segment(4);
		$table 		= "bus_setup";
		if($this->input->post('submit')=='submit'){ 
			$vectype = $this->input->post('type');
			$this->form_validation->set_rules('bus_no','Bus No','trim|required|min_length[10]|max_length[15]');
			$this->form_validation->set_rules('bus_name','Bus Name','trim|required');
			$this->form_validation->set_rules('bus_category','Bus Category','trim|required');
			$this->form_validation->set_rules('mobile_no','Mobile','trim|required|min_length[10]|max_length[10]');
			if($vectype=="bus"){
			$this->form_validation->set_rules('total_sheet_in_a_side','Site in A Side','required');
			$this->form_validation->set_rules('total_sheet_in_b_side','Site in B Side','required');
			}
				if($this->form_validation->run() == FALSE){
					$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
					$data['allcom'] 		=	$this->dynamic_query->getall('company_setup');
					$data['all'] 			=	$this->dynamic_query->getall('company_setup');
					$data['allbus'] 		=	$this->dynamic_query->getall('bus_name_setup');
					$data['primaryheader']	=	"Bus Setup";
					$data['title'] 			=  "Add New Bus";
					$data['row'] 		=	$this->dynamic_query->getbyid($id,$table);
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/bus-setup/edit',$data);
				}else{	

					if($this->input->post('hice')){
						$hice =  $this->input->post('hice[]');
					}else {
						$hice[]  = 0;
					}
					if($this->input->post('force')){
						$force =  $this->input->post('force[]');
					}else {
						$force[]  = 0;
					}
					if($this->input->post('total_sheet_in_a_side')){
						$aside =  $this->input->post('total_sheet_in_a_side');
					}else {
						$aside  = 0;
					}
					if($this->input->post('total_sheet_in_b_side')){
						$bside =  $this->input->post('total_sheet_in_b_side');
					}else {
						$bside  = 0;
					}
					if($this->input->post('last_row')){
						$last =  $this->input->post('last_row');
					}else {
						$last  = 0;
					}
					if($this->input->post('cabin')){
						$cabin =  $this->input->post('cabin');
					}else {
						$cabin  = 0;
					}
					if($this->input->post('special')){
						$special =  $this->input->post('special');
					}else {
						$special  = 0;
					}
					if($this->input->post('company')){
						$company =  $this->input->post('company');
					}else {
						$company  = $this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
					}
					
					$data								=	array();
					$data['bus_no']						=	$this->input->post('bus_no');
					$data['bus_name']					=	$this->input->post('bus_name');
					$data['bus_category']				=	$this->input->post('bus_category');
					$data['company']					=	$company;
					$data['mobile_no']					=	$this->input->post('mobile_no');
					$data['total_sheet_in_a_side']		=	$aside;
					$data['total_sheet_in_b_side']		=	$bside;
					$data['last_row']					=	$last;
					$data['email']						=	$this->input->post('email');
					$data['is_active']					=	$this->input->post('is_active');
					$data['driver_mobile_no']			=	$this->input->post('driver_mobile_no');
					$data['driver_name']				=	$this->input->post('driver_name');
					$data['owner']						=	$this->input->post('owner');
					$data['driver_name']				=	$this->input->post('driver_name');
					$data['cabin']						=	$cabin;
					$data['special']					=	$special;
					$data['type']						=	$this->input->post('type');
					$data['hices']						=	implode(',', $hice);
					$data['forces']						=	implode(',', $force);
					$data['user']						=	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
					

					if($_FILES['bus_image']['name'] != ""){

						GLOBAL  $today;
						$today = date('Ymd-his');
						$config['file_name']          = 'bus'.$today;
						$config['upload_path']          = BUS_IMAGE_DIR;
		                $config['allowed_types']        = 'gif|jpg|png|jpeg';
		                $config['max_size']             = 1024000;
		               // $config['max_width']            = 1024;
		               // $config['max_height']           = 768;
		                $this->load->library('upload', $config);
		                if ( ! $this->upload->do_upload('bus_image'))
		                {
		                	$this->session->set_userdata('errormessage', $this->upload->display_errors("<p class='text-danger'>","</p>"));
	                        redirect(ADMIN_BASE.'users/update/'.$id);
		                }
		                else
		                {
		                	// when file is uploaded 
		                	$getimage	=	$this->dynamic_query->getbyid($id,$table);
		                	foreach ($getimage as $image) { $userimagedb = $image['bus_image'];}
		                	$file = BUS_IMAGE_DIR.$userimagedb; 
		                	if(file_exists($file )){unlink($file);}
		                	$filename11 = $this->upload->data();
		                	GLOBAL $filename;
		                	$filename = $filename11['file_name'];
		                	// resize the image
		                	$config['image_library'] = 'gd2';
							$config['source_image'] = BUS_IMAGE_DIR.$filename;
							$config['width']         = 160;
							$config['height']       = 120;
							$this->load->library('image_lib', $config);
							if ( ! $this->image_lib->resize())
							{
							$this->session->set_userdata('errormessage', $this->image_lib->display_errors("<p class='text-danger'>","</p>"));
	                        redirect(ADMIN_BASE.'bussetup/update/'.$id);
							}	
		                } 
	            	}else{
	            		$getimage	=	$this->dynamic_query->getbyid($id,$table);
	            		foreach ($getimage as $image) { $filename = $image['bus_image'];}	
	            	}	

	            	$data['bus_image'] = $filename;  	

					
					$this->db->where('id',$id);
					$result	 =	$this->db->update('bus_setup',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/bussetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/bussetup/');
			       }
			}
		}else{
			
			$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
			$data['allcom'] 		=	$this->dynamic_query->getall('company_setup');
			$data['all'] 			=	$this->dynamic_query->getall('company_setup');	
			$data['allbus'] 		=	$this->dynamic_query->getall('bus_name_setup');
			$data['primaryheader']	=	"Bus Setup";
			$table 					=	"bus_setup";			
			$data['title'] 			=	"Update Bus";
			$data['row'] 		=	$this->dynamic_query->getbyid($id,$table);
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/bus-setup/edit',$data);
		}
	}

	function delete(){
		$id 		=	$this->uri->segment(4);
		 $table 	= "bus_setup";
    	 $fields  	= "bus_image";
    	 $thisimage  =  $this->dynamic_query->select_fields($id,$table,$fields);
    	 foreach($thisimage as $data){
    	 	$img =  $data['image'];
	 	}
    	if(file_exists('./uploads/busimages/'.$img)){
    	 	unlink('./uploads/busimages/'.$img);
	 	}
		$result 	=	$this->db->delete('bus_setup',array('id'=>$id));
		if($result){
			$this->session->set_userdata($this->messages->trashed());
        	redirect('control/bussetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/bussetup/');
       }
   
	}

	function active(){
        $id 	= $this->uri->segment(4);
        $res 	= $this->db->where('id',$id);
        $res 	= $this->db->set('is_active', 'Y'); //value that used to update column  
        $res 	
        = $this->db->update('bus_setup');
        if($res){
        	$this->session->set_userdata($this->messages->success());
            redirect('control/bussetup/');
        }else{
        	        	
        	$this->session->set_userdata($this->messages->error());
             redirect('control/bussetup/');
        }
   }

   function deactive(){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'N'); //value that used to update column  
        $res = $this->db->update('bus_setup');
        if($res){
        	$this->session->set_userdata($this->messages->success());
             redirect('control/bussetup/');
        }else{
           $this->session->set_userdata($this->messages->error());
             redirect('control/bussetup/');
        }
   }

   function view(){
   	$id 		= $this->uri->segment(4);
   		$data['allcat'] 		=	$this->dynamic_query->getall('category_setup');
		$data['allcom'] 		=	$this->dynamic_query->getall('company_setup');	
		$data['allbus'] 		=	$this->dynamic_query->getall('bus_name_setup');
		$data['primaryheader']	=	"Bus Setup";
		$table 					=	"bus_setup";			
		$data['title'] 			=	"View Bus";
		$data['row'] 		=	$this->dynamic_query->getbyid($id,$table);
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/bus-setup/view',$data);
   }
}