<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
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
		
		$data['primaryheader'] 	    = 	'Category';
		$data['title'] 			    =  	"Category";
		$data['category']			=	$this->dynamic_query->getall('page_category');
		$data['content']			=	$this->dynamic_query->getall('content_serup');
		$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
		$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		
		$this->load->view('control/contents/lists',$data);

	}

	function add(){

		if($this->input->post('submit')){
			// print_r($this->input->post());
			// die();
			$data = array();
			if($this->input->post('category')){
			$data['category'] = $this->input->post('category');	
			}
			$data['title'] = $this->input->post('title');
			$data['slug']	=	$this->static_model->Urlformat($this->input->post('title'));
			$data['content'] = $this->input->post('detail');
			$data['is_active'] = $this->input->post('is_active');
			$data['is_temp'] =  $this->input->post('is_temp');
			
			if($_FILES['image']['name']!=""){
					  	//$random = random_string('alnum',5);
					  	$today	=	date('Ymd_his');
					  	$config['file_name']			=	'new_'.$today.'_content';
			            $config['upload_path']          = COMPANY_LOGO_IMG_DIR;
			            $config['allowed_types']        = 'gif|jpg|png|jpeg';
						$config['encrypt_name']         = TRUE;
			            $this->load->library('upload', $config);
			            if (!$this->upload->do_upload('image')){
			            	$this->session->set_userdata('errormessage',$this->upload->display_errors("<p class='text-danger'>","</p>"));
							redirect('control/content/add');
			            }else{
			            	 $filedetails = $this->upload->data();
			            }
			            $data['image'] = $filedetails['file_name'];
			           }else{
				            $data['image'] = "nophoto.gif"; 
				           }

			if($this->input->post('submit')=="addcat"){
			$query = $this->db->insert('page_category',$data);

		    }else{
		    	$query = $this->db->insert('content_serup',$data);
		    }
			if($query){
					$this->session->set_userdata($this->messages->success());
		        	redirect('control/content/');
				}else{
					$this->session->set_userdata($this->messages->error());
		        	redirect('control/content/');
		      	}
			
		     } else {

			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
		 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		 	if($this->uri->segment(4)=="category" OR $this->uri->segment(4)==""){
		 		$data['primaryheader'] 	    = 	'Category';
			    $data['title'] 			    =  	"Category";
				$this->load->view('control/contents/categories/addcat',$data);

			}else if($this->uri->segment(4)=="post"){
				$data['primaryheader'] 	    = 	'Post';
				$data['title'] 			    =  	"Post setup";
				$data['categ']				=	$this->dynamic_query->getall('page_category');
				$this->load->view('control/contents/posts/addpost',$data);

			} else if($this->uri->segment(4)=="pages"){
				$data['primaryheader'] 	    = 	'Page';
				$data['title'] 			    =  	"Page setup";
				$this->load->view('control/contents/pages/addpage',$data);
			}else{
				$this->index();
			}

		}
	}
		
	
	function update(){
		
		$uris = explode('-',$this->uri->segment(4));
		if($this->input->post('submit')){
	
			$id = $this->input->post('id');
			$data = array();
			if($this->input->post('category')){
			$data['category'] = $this->input->post('category');	
			}
			$data['title'] = $this->input->post('title');
			$data['slug']	=	$this->static_model->Urlformat($this->input->post('title'));
 			$data['content'] = $this->input->post('detail');
			$data['is_active'] = $this->input->post('is_active');
			$data['is_temp'] =  $this->input->post('is_temp');
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
		                	$getimage	=	$this->dynamic_query->getbyid($id,'content_serup');
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
	            		$getimage	=	$this->dynamic_query->getbyid($id,'content_serup');
	            		foreach ($getimage as $image) { $filename = $image['image'];}	
	            	}	
	            	$data['image'] = $filename;   
			

			if($this->input->post('submit')=="editcat"){
				$this->db->where('id',$id);
			$query = $this->db->update('page_category',$data);
		    }else{
				$this->db->where('id',$id);
		    	$query = $this->db->update('content_serup',$data);
		    }
			if($query){
					$this->session->set_userdata($this->messages->success());
		        	redirect('control/content/');
				}else{
					$this->session->set_userdata($this->messages->error());
		        	redirect('control/content/');
		      	}
			
		     } else {

			$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
		 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		 	if($uris[0]=="cat" OR $uris==""){
		 		$data['primaryheader'] 	    = 	'Category';
			    $data['title'] 			    =  	"Category";
				$data['categ']			=	$this->dynamic_query->getbyid($uris[1],'page_category');
				$this->load->view('control/contents/categories/edit',$data);

			}else if($uris[0]=="multipost"){
				$data['primaryheader'] 	    = 	'Post';
				$data['title'] 			    =  	"Post setup";
				$data['categ']			=	$this->dynamic_query->getall('page_category');
				$data['pos']			=	$this->dynamic_query->getbyid($uris[1],'content_serup');
				$this->load->view('control/contents/posts/editpost',$data);

			} else if($uris[0]=="singlepost"){
				$data['primaryheader'] 	    = 	'Page';
				$data['title'] 			    =  	"Page setup";
				$data['pag']			=	$this->dynamic_query->getbyid($uris[1],'content_serup');
				$this->load->view('control/contents/pages/editpage',$data);
			}else{
				$this->index();
			}
		}
	}

	function trash(){
		$uris = explode('-',$this->uri->segment(4));
		$id = $uris[1];
	 	$baseurl		=	"content";
		if($uris[0]=="cat"){
			$table			=	"page_category";
		}else{
			$table			=	"content_serup";
		}
	 	$this->dynamic_query->trash($id,$table,$baseurl);
	}
	
	function active(){
		$uris = explode('-',$this->uri->segment(4));
		$id = $uris[1];
	 	$baseurl		=	"content";
		if($uris[0]=="cat"){
			$table			=	"page_category";
		}else{
			$table			=	"content_serup";
		}
	 	$this->active_model->active($id,$table,$baseurl);
	}

	function deactive(){
		$uris = explode('-',$this->uri->segment(4));
		$id = $uris[1];
	 	$baseurl		=	"content";
		if($uris[0]=="cat"){
			$table			=	"page_category";
		}else{
			$table			=	"content_serup";
		}
	 	$this->active_model->deactive($id,$table,$baseurl);
	}
		
}

?>