<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companysetup extends CI_Controller {
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

		$data['primaryheader']	=	"Company Setup";
		$data['title'] 	=	"Company List";
	 	$table ="company_setup";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 3;
	 	$baseurl = "control/companysetup/index/";
	 	$orderby = 'id';
	 	$order =  "desc";
	 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/company-setup/list',$data);
	}

	function add(){

		if($this->input->post('submit')=='submit'){



			if($this->input->post('student[0]')!="" OR $this->input->post('student[1]')!=""){
				$inputes[] = $this->input->post('student[0]').",".$this->input->post('student[1]');;
				
			} else $inputes[] = "0,0";
			if($this->input->post('female[0]')!="" OR $this->input->post('female[1]')!=""){
				$inputes[] = $this->input->post('female[0]').",".$this->input->post('female[1]');
				
			} else $inputes[] = "0,0";
			if($this->input->post('old[0]')!="" OR $this->input->post('old[1]')!=""){
				$inputes[] = $this->input->post('old[0]').",".$this->input->post('old[1]');
				
			} else $inputes[] = "0,0";
			if($this->input->post('staff[0]')!="" OR $this->input->post('staff[1]')!=""){
				$inputes[] = $this->input->post('staff[0]').",".$this->input->post('staff[1]');
				
			} else $inputes[] = "0,0";
			if($this->input->post('handicap[0]')!="" OR $this->input->post('handicap[1]')!=""){
				$inputes[] = $this->input->post('handicap[0]').",".$this->input->post('handicap [1]');
				
			} else $inputes[] = "0,0";


			if($this->input->post('ccharge[0]')!=""){
				$ccharge[] = $this->input->post('ccharge[0]');
			}else $ccharge[] = "0";
			if($this->input->post('ccharge[1]')!=""){
				$ccharge[] = $this->input->post('ccharge[1]');
			}else $ccharge[] = "0";
			if($this->input->post('ccharge[2]')!=""){
				$ccharge[] = $this->input->post('ccharge[2]');
			}else $ccharge[] = "0";

			 $dis = implode('/', $this->input->post('reservationdis'));

			$this->form_validation->set_rules('name','Company name','trim|required');
			$this->form_validation->set_rules('phone','Phone No','trim|required|min_length[7]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('register_no','Register no','trim|required');
			$this->form_validation->set_rules('president','President Name','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Company Setup";
					$data['title'] =  "Add Company";
					$data['comittes']  = $this->dynamic_query->getall('comittee');
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/company-setup/add',$data);
				}else{
					

					$data		=	array();
					$data['name']	=	$this->input->post('name');
					$data['contact']=	$this->input->post('phone');
					$data['reservation'] = "0";
					$data['comission'] = "0";
					$data['email']	=	$this->input->post('email');
					$data['address']=	$this->input->post('address');
					$data['comittee_id']=   $this->input->post('comittee_id');
					$data['register_no']=	$this->input->post('register_no');
					$data['reservation']= 	implode('/', $inputes);
					$data['comission'] 	= 	"0";
					$data['ccharge'] 	= 	implode('/', $ccharge);
					$data['president']	=	$this->input->post('president');
					$data['reservdiscount'] 	= $dis;
					$data['is_active']	=	$this->input->post('is_active');
					$data['termandpolicy']	=	$this->input->post('termandpolicy');
					$data['cancellationpolicy']	=	$this->input->post('cancellationpolicy');

					if($_FILES['image']['name']!=""){
					  	//$random = random_string('alnum',5);
					  	$today	=	date('Ymd_his');
					  	$config['file_name']			=	'new_'.$today.'_ebus';
			            $config['upload_path']          = COMPANY_LOGO_IMG_DIR;
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			            $this->load->library('upload', $config);
			            if ( ! $this->upload->do_upload('image')){
			            	$this->session->set_userdata('errormessage',$this->upload->display_errors("<p class='text-danger'>","</p>"));
			                redirect('control/companysetup/add');
			            }else{
			            	 $filedetails = $this->upload->data();
			            }
			            $data['image'] = $filedetails['file_name'];
			           }else{
				            $data['image'] = "nophoto.gif"; 
				           }
					$result	 =	$this->db->insert('company_setup',$data);
					$id = $this->db->insert_id();
					if($result){
						$this->session->set_userdata($this->messages->success());
			        	redirect('control/companysetup/');
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/companysetup/');
			       }

			}
		}else{

				$data['primaryheader']	=	"Company Setup";			
				$data['title'] 	=	"Add company";
				$data['comittes']  = $this->dynamic_query->getall('comittee');
				$user = $this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
				$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 			$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
	 			$data['counter']  = 		$this->static_model->doublewhere('control_login',$user,'counter','user','user_type');
	 			$data['user'] = $user;
 				$this->load->view('control/company-setup/add',$data);
			}

	}


	// Uadate Method 
	function update(){


		$id 		=	$this->uri->segment(4);
		$table 		=	'company_setup';
		if($this->input->post('submit')=='submit'){
			

			if($this->input->post('comission')){
			$totcounter = count($this->input->post('comission'));
			$countercomission[] = implode(',', $this->input->post('comission[]'));
			$countercomission[] = implode(',', $this->input->post('comissionid[]'));
			} else  $countercomission[] = "0/0";

			if($this->input->post('student[0]')!="" OR $this->input->post('student[1]')!=""){
				$inputes[] = $this->input->post('student[0]').",".$this->input->post('student[1]');;
				
			} else $inputes[] = "0,0,0";
			if($this->input->post('female[0]')!="" OR $this->input->post('female[1]')!=""){
				$inputes[] = $this->input->post('female[0]').",".$this->input->post('female[1]');
				
			} else $inputes[] = "0,0,0";
			if($this->input->post('old[0]')!="" OR $this->input->post('old[1]')!=""){
				$inputes[] = $this->input->post('old[0]').",".$this->input->post('old[1]');
				
			} else $inputes[] = "0,0,0";
			if($this->input->post('staff[0]')!="" OR $this->input->post('staff[1]')!=""){
				$inputes[] = $this->input->post('staff[0]').",".$this->input->post('staff[1]');
				
			} else $inputes[] = "0,0,0";
			if($this->input->post('handicap[0]')!="" OR $this->input->post('handicap[1]')!=""){
				$inputes[] = $this->input->post('handicap[0]').",".$this->input->post('handicap[1]');
				
			} else $inputes[] = "0,0,0";


			if($this->input->post('ccharge[0]')!=""){
				$ccharge[] = $this->input->post('ccharge[0]');
			}else $ccharge[] = "0";
			if($this->input->post('ccharge[1]')!=""){
				$ccharge[] = $this->input->post('ccharge[1]');
			}else $ccharge[] = "0";
			if($this->input->post('ccharge[2]')!=""){
				$ccharge[] = $this->input->post('ccharge[2]');
			}else $ccharge[] = "0";

			 $dis = implode('/', $this->input->post('reservationdis'));
			
			


			$this->form_validation->set_rules('name','Company name','trim|required');
			$this->form_validation->set_rules('phone','Phone No','trim|required|min_length[7]|max_length[10]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('register_no','Register no','trim|required');
			$this->form_validation->set_rules('president','President Name','trim|required');
				if($this->form_validation->run() == FALSE){
					$data['primaryheader']	=	"Company Setup";
					$data['title'] =  "Update Company";
					$table					=	"company_setup";
					$data['comittes']  		= $this->dynamic_query->getall('comittee');
					$data['row']			= 	$this->dynamic_query->getbyid($id,$table);
					$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 				$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
					$this->load->view('control/company-setup/update',$data);
				}else{
						
				
					$data				=	array();
					$data['id']			=	$id;
					$data['name']		=	$this->input->post('name');
					$data['contact']	=	$this->input->post('phone');
					$data['email']		=	$this->input->post('email');
					$data['address']	=	$this->input->post('address');
					$data['register_no']=	$this->input->post('register_no');
					$data['president']	=	$this->input->post('president');
					$data['comittee_id']=   $this->input->post('comittee_id');
					$data['reservation']= 	implode('/', $inputes);
					$data['comission'] 	= 	implode('/', $countercomission);
					$data['ccharge'] 	= 	implode('/', $ccharge);
					$data['reservdiscount'] 	= $dis;
					$data['is_active']	=	$this->input->post('is_active');
					$data['termandpolicy']	=	$this->input->post('termandpolicy');
					$data['cancellationpolicy']	=	$this->input->post('cancellationpolicy');

					if($_FILES['image']['name'] != ""){

						GLOBAL  $today;
						$today = date('Ymd-his');
						$config['file_name']          = 'bus'.$today;
						$config['upload_path']          = COMPANY_LOGO_IMG_DIR;
		                $config['allowed_types']        = 'gif|jpg|png|jpeg';
		                $config['max_size']             = 1024000;
		               // $config['max_width']            = 1024;
		               // $config['max_height']           = 768;
		                $this->load->library('upload', $config);
		                if ( ! $this->upload->do_upload('image'))
		                {
		                	$this->session->set_userdata('errormessage', $this->upload->display_errors("<p class='text-danger'>","</p>"));
	                        redirect(ADMIN_BASE.'companysetup/update/'.$id);
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
	                        redirect(ADMIN_BASE.'companysetup/update/'.$id);
							}	
		                } 
	            	}else{
	            		$getimage	=	$this->dynamic_query->getbyid($id,$table);
	            		foreach ($getimage as $image) { $filename = $image['image'];}	
	            	}	
	            	$data['image'] = $filename;   
					$this->db->where('id',$id);
					$result	 =	$this->db->update('company_setup',$data);
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
							redirect('control/companysetup/');
						}
			        	
					}else{
						$this->session->set_userdata($this->messages->error());
			        	redirect('control/companysetup/');
			       }

			}
		}else{
			
			$table					=	"company_setup";
			$data['row']			= 	$this->dynamic_query->getbyid($id,$table);	
			$data['primaryheader']	=	"Company Update";
			$data['title'] 			=	"Update company";
			$data['comittes']  		= 	$this->dynamic_query->getall('comittee');
			
			$user 					= 	$this->static_model->useridbyusername($this->session->userdata('eBusLogin'));
			$data['user_id'] 		= 	$this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 		$data['mainmenu']  		= 	$this->static_model->getmenusbyuri($this->uri->segment(2));
	 		$data['counter']  		= 	$this->static_model->doublewhere('control_login',$user,'counter','user','user_type');
			
			$utype  			= 	$this->dynamic_query->getby($this->session->userdata('eBusLogin'),'control_login','username');
		foreach($utype as $ut){
			$utyps  = $ut['user_type'];
		}
		if($utyps!=='admin'){
			$companyid				=	$this->static_model->getcompnayidbyparentid($this->session->userdata('eBusLogin'));
	 		$data['company']		=	$this->dynamic_query->getby($companyid,'company_setup','id');
		}
	 		$data['user'] = $user;
			$this->load->view('control/company-setup/update',$data);
		}


	}

	function delete($id){
		$id 		=	$this->uri->segment(4);
		 $table 	= "company_setup";
    	 $fields  	= "image";
    	 $thisimage  =  $this->dynamic_query->select_fields($id,$table,$fields);
    	 foreach($thisimage as $data){
    	 	$img =  $data['image'];
    	 	unlink(COMPANY_LOGO_IMG_DIR.$img);
    	 }
		$result 	=	$this->db->delete('company_setup',array('id'=>$id));
		if($result){
			$this->session->set_userdata($this->messages->trashed());
        	redirect('control/companysetup/');
		}else{
			$this->session->set_userdata($this->messages->error());
        	redirect('control/companysetup/');
       }
   
	}


	function active($id){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'Y'); //value that used to update column  
        $res = $this->db->update('company_setup');
        if($res){
        	$this->session->set_userdata($this->messages->success());
            redirect('control/companysetup/');
        }else{
        	        	
        	$this->session->set_userdata($this->messages->error());
             redirect('control/companysetup/');
        }
   }

   function deactive($id){
        $id = $this->uri->segment(4);
        $res = $this->db->where('id',$id);
        $res = $this->db->set('is_active', 'N'); //value that used to update column  
        $res = $this->db->update('company_setup');
        if($res){
        	$this->session->set_userdata($this->messages->success());
             redirect('control/companysetup/');
        }else{
           $this->session->set_userdata($this->messages->error());
             redirect('control/companysetup/');
        }
   }

   function view($id){

		$table					=	"company_setup";
		$data['row']			= 	$this->dynamic_query->getbyid($id,$table);	
		$data['primaryheader']	=	"Company View";
		$data['title'] 			=	"View Detail";
		$this->load->view('control/company-setup/view',$data);
   }
}