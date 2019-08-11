<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comitteesetup extends CI_Controller {
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
		$this->load->helper('string');
		$this->load->model('static_model');
		$this->load->model('activity_model');
    	$this->activity_model->autoload();
	}
	function index(){

		$data['primaryheader']	=	"Comittee Setup";
		$data['title'] 	=	"Company List";
	 	$table ="comittee";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 3;
	 	$baseurl = "control/comitteesetup/index/";
	 	$orderby = 'id';
	 	$order =  "desc";
	 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/comittee-setup/list',$data);
	}

	function add(){

		if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('name','Company name','trim|required');
			$this->form_validation->set_rules('phone','Phone No','trim|required|min_length[7]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('register_no','Register no','trim|required');
			$this->form_validation->set_rules('totalbus','Total Bus','trim|required');
			$this->form_validation->set_rules('president','President Name','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Comittee Setup";
					$data['title'] =  "Add Comittee";
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/comittee-setup/add',$data);
				}else{
					$name = $this->input->post('name');
					$phone 		=	$this->input->post('phone');
					$email 		=	$this->input->post('email');
					$address 	=	$this->input->post('address');
					$register_no=	$this->input->post('register_no');
					$totalbus 	=	$this->input->post('totalbus');
					$president 	= 	$this->input->post('president');
					$is_active 	=	$this->input->post('is_active');

					$data		=	array();
					$data['name']	=	$name;
					$data['contact']=	$phone;
					$data['email']	=	$email;
					$data['address']=	$address;
					$data['register_no']=	$register_no;
					$data['totalbus']	=	$totalbus;
					$data['president']	=	$president;
					$data['is_active']	=	$is_active;

					if($_FILES['image']['name']!=""){
					  	//$random = random_string('alnum',5);
					  	$today	=	date('Ymd_his');
					  	$config['file_name']			=	'new_'.$today.'_ebus';
			            $config['upload_path']          = COMPANY_LOGO_IMG_DIR;
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('image')){
			            	$this->session->set_userdata('errormessage',$this->upload->display_errors("<p class='text-danger'>","</p>"));
			                redirect('control/comitteesetup/add');
			            }else{
			            	 $filedetails = $this->upload->data();
			            }
			            $data['image'] = $filedetails['file_name'];
			           }else{
				            $data['image'] = ""; 
				           }
					$result	 =	$this->db->insert('comittee',$data);
					$id = $this->db->insert_id();
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/comitteesetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/comitteesetup/');
			       }

			}
		}else{
				$data['primaryheader']	=	"Comittee Setup";			
				$data['title'] 	=	"Add Comittee";
				$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
				$this->load->view('control/comittee-setup/add',$data);
			}

	}

	// Uadate Method 
	function update(){
		
		
		$id 		=	$this->uri->segment(4);
		$table 		=	'comittee';
		if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('name','Company name','trim|required');
			$this->form_validation->set_rules('phone','Phone No','trim|required|min_length[7]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('register_no','Register no','trim|required');
			$this->form_validation->set_rules('totalbus','Total Bus','trim|required');
			$this->form_validation->set_rules('president','President Name','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Comittee Setup";
					$data['title'] =  "Update Comittee";
					$table					=	"comittee";
					$data['row']			= 	$this->dynamic_query->getbyid($id,$table);
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/comittee-setup/update',$data);
				}else{
					
					 $name 			=    $this->input->post('name');
					 $phone 		=	$this->input->post('phone');
					 $email 		=	$this->input->post('email');
					 $address 		=	$this->input->post('address');
					 $register_no	=	$this->input->post('register_no');
					 $totalbus 		=	$this->input->post('totalbus');
					 $president 	= 	$this->input->post('president');
					 $is_active 	=	$this->input->post('is_active');
				
					$data				=	array();
					$data['id']			=	$id;
					$data['name']		=	$name;
					$data['contact']	=	$phone;
					$data['email']		=	$email;
					$data['address']	=	$address;
					$data['register_no']=	$register_no;
					$data['totalbus']	=	$totalbus;
					$data['president']	=	$president;
					$data['is_active']	=	$is_active;

					if($_FILES['image']['name'] != ""){

						GLOBAL  $today;
						$today = date('Ymd-his');
						$config['file_name']          = 'bus'.$today;
						$config['upload_path']          = COMPANY_LOGO_IMG_DIR;
		                $config['allowed_types']        = 'gif|jpg|png|jpeg';
		                //$config['max_size']             = 1024000;
		               // $config['max_width']            = 1024;
		               // $config['max_height']           = 768;
		                $this->load->library('upload', $config);
		                if ( ! $this->upload->do_upload('image'))
		                {
		                	$this->session->set_userdata('errormessage', $this->upload->display_errors("<p class='text-danger'>","</p>"));
	                        redirect(ADMIN_BASE.'comitteesetup/update/'.$id);
		                }
		                else
		                {
		                	// when file is uploaded 
		                	$getimage	=	$this->dynamic_query->getbyid($id,$table);
		                	foreach ($getimage as $image) { $userimagedb = $image['image'];}
		                	$file = COMPANY_LOGO_IMG_DIR.$userimagedb; 
		                	if(file_exists($file )){unlink($file);}
		                	$filename11 = $this->upload->data();
		                	GLOBAL $filename;
		                	$filename = $filename11['file_name'];
		                	// resize the image
		                	$config['image_library'] = 'gd2';
							$config['source_image'] = COMPANY_LOGO_IMG_DIR.$filename;
							$config['width']         = 160;
							$config['height']       = 120;
							$this->load->library('image_lib', $config);
							if ( ! $this->image_lib->resize())
							{
							$this->session->set_userdata('errormessage', $this->image_lib->display_errors("<p class='text-danger'>","</p>"));
	                        redirect(ADMIN_BASE.'comitteesetup/update/'.$id);
							}	
		                } 
	            	}else{
	            		$getimage	=	$this->dynamic_query->getbyid($id,$table);
	            		foreach ($getimage as $image) { $filename = $image['image'];}	
	            	}	
	            	$data['image'] = $filename;   
					$this->db->where('id',$id);
					$result	 =	$this->db->update('comittee',$data);
					if($result){
						$this->session->set_userdata($this->messages->success());
						$userid =  $this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
						 $usertype =  $this->dynamic_query->select_fields($userid,'control_login','user_type');
						foreach($usertype as $usertyp){
							$ysertype = $usertyp['user_type'];
						}
						if( $ysertype != "admin"){
							redirect('control/users/view/'.$userid);
						}else{
							redirect('control/comitteesetup/');
						}
			        	
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/comitteesetup/');
			       }

			}
		}else{
			
			$table					=	"comittee";
			$data['row']			= 	$this->dynamic_query->getbyid($id,$table);	
			$data['primaryheader']	=	"Comittee Update";
			$data['title'] 			=	"Update Comittee";
			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
			$this->load->view('control/comittee-setup/update',$data);
		}


	}

	function delete($id){
		$id 		=	$this->uri->segment(4);
		 $table 	= "comittee";
    	 $fields  	= "image";
    	 $thisimage  =  $this->dynamic_query->select_fields($id,$table,$fields);
    	 foreach($thisimage as $data){
    	 	$img =  $data['image'];
    	 	unlink(COMPANY_LOGO_IMG_DIR.$img);
    	 }
		$result 	=	$this->db->delete('comittee',array('id'=>$id));
		if($result){
			$this->session->set_userdata($this->messages->trashed());
        	redirect('control/comitteesetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/comitteesetup/');
       }
   
	}


	function active($id){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'Y'); //value that used to update column  
        $res = $this->db->update('comittee');
        if($res){
        	$this->session->set_userdata($this->messages->success());
            redirect('control/comitteesetup/');
        }else{
        	        	
        	$this->session->set_userdata($this->messages->error());
             redirect('control/comitteesetup/');
        }
   }

   function deactive($id){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'N'); //value that used to update column  
        $res = $this->db->update('comittee');
        if($res){
        	$this->session->set_userdata($this->messages->success());
             redirect('control/comitteesetup/');
        }else{
           $this->session->set_userdata($this->messages->error());
             redirect('control/comitteesetup/');
        }
   }

   function view($id){

		$table					=	"comittee";
		$data['row']			= 	$this->dynamic_query->getbyid($id,$table);	
		$data['primaryheader']	=	"Comittee View";
		$data['title'] 			=	"View Detail";
		$this->load->view('control/comittee-setup/view',$data);
   }
}