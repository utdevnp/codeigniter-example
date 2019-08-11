<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct(){
    	Parent::__construct();
    	$this->load->library('session');
    	if($this->session->userdata('eBusLogin')){
    		redirect('control/dashboard');
    	}
    	$this->load->library('form_validation');
    	$this->load->model('messages');
    	
    	$this->load->model('dynamic_query');
    	$this->load->model('static_model');
    	$this->load->model('activity_model');
    	$this->activity_model->autoload();
    	$this->load->library('user_agent');
    	
    	
    }

	public function index(){
		$this->activity_model->autoload();
			$block = $this->dynamic_query->siteblock($this->input->ip_address());
			if($block==$this->input->ip_address()){
				$this->load->view('errors/html/blocked');
			}else{
				$data['title']	=	"Admin Login";
				$this->load->view('control/login/login',$data);
			}
	}

	// Login Action 
	function invalid(){
		if($this->input->post('submit') == 'submit'){
			$this->activity_model->autoload();
			$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[8]|max_length[50]');
				if($this->form_validation->run() == FALSE){
					$data['title'] = "Login | Admin";
					$this->load->view('control/login/login',$data);
				}else{
					$username	=	$this->input->post('username');
					$password	=	md5($this->input->post('password'));
					$res = $this->db->get_where('control_login',array('username'=>$username,'password'=>$password));
		        if($res->num_rows() > 0){

		        	$data						=	array();
							$data['username']		=	$this->input->post('username');
							$data['attemp']		=	0;
							$data['agent']		=	$this->activity_model->getagent();
							$data['ip']		=	$this->input->ip_address();
							$data['auth']		=	'Y';
							$data = $this->security->xss_clean($data);
							$result	 =	$this->db->insert('login',$data);

		       	 	$this->session->set_userdata('eBusLogin',$username);
		        	redirect('control/dashboard');
		        }else{

		        	$data						=	array();
							$data['username']		=	$this->input->post('username');
							$data['attemp']		=	1;
							$data['agent']		=	$this->activity_model->getagent();
							$data['ip']		=	$this->input->ip_address();
							$data['auth']		=	'N';
							$data = $this->security->xss_clean($data);
							$result	 =	$this->db->insert('login',$data);

		        	$this->session->set_userdata($this->messages->loginerror());
		        	redirect('control/login');
	       		}
			}
		}else{
			$this->activity_model->autoload();
			$this->session->set_userdata($this->messages->error());
	       redirect('control/login');
   		}
   	}

   	function forget(){
   			$data['title']	=	"Forget Password";
   			if($this->input->post('forgot') === 'forgot'){
				$to_email	=	$this->security->xss_clean($this->input->post('email'));

				$res = $this->db->get_where('control_login',array('email'=>$to_email,'is_active'=>'Y'));
				if($res->num_rows() > 0){
					 $key['key'] = md5(random_string('alnum',40));
					 $link = "bus.databanknepal.com/control/login/forget?fkey='".$key['key']."'";
					$this->db->where('email',$to_email);
					$this->db->update('control_login',$key);	
					//$this->activity_model->forgotpwemail($to_email,$link);
					$this->session->set_userdata($this->messages->success());
					$this->load->view('control/login/login',$data);	
				}else{
					$this->session->set_userdata($this->messages->error());
					$this->load->view('control/login/forget',$data);	
				}
   			}else{
   				$this->load->view('control/login/forget',$data);
   			}
   			
   		}
}


