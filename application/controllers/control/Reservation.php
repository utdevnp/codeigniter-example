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

		$data['primaryheader']	=	"Pre-reservation Seats";
		$data['title'] 	=	"Reservation";
	 	$table ="reservation";
	 	$segment =  $this->uri->segment(4); 
	 	$perpage = 3;
	 	$baseurl = "control/companysetup/index/";
	 	$orderby = 'id';
	 	$order =  "desc";
	 	$data['row'] =  $this->Pagination_model->pagination_design($table,$perpage,$baseurl,$orderby,$order,$segment);
	 	$data['user_id'] = $this->static_model->getpermissionbyusername($this->session->userdata('eBusLogin'));
	 	$data['mainmenu']  = $this->static_model->getmenusbyuri($this->uri->segment(2));
		$this->load->view('control/reservation-setup/list',$data);

		}
	}
?>