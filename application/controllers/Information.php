<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('dynamic_query');
		$this->load->model('site_model');
		$this->load->model('Activity_model');
		$this->load->model('static_model');
		$this->load->model('messages');
		$this->load->helper('date');
		$this->load->helper('string');
		$this->load->library('form_validation');
	
	}
	function index(){
				
		$data['page_title'] = "Information";
		$data['ticket_ttile'] = "Search Ticket ";
		$data['all'] =   $this->site_model->getwhere('content_serup','','');
		$data['cat'] =   $this->site_model->getwhere('page_category','','');
		$this->load->view('site/information/allpost',$data);
	}
	
	function archive(){
		$data['page_title'] = "Archive Post";
		$data['ticket_ttile'] = "Archive Posts";
		$where = array('slug'=>$this->uri->segment(3));
		$tit =   $this->site_model->getwhere('page_category',$where,'');
		foreach($tit as $ti){
			$title = $ti['title'];
		}
		$wher =  array('category'=>@$title);
		$data['all'] = $this->site_model->getwhere('content_serup',$wher,'');
		$data['cat'] =   $this->site_model->getwhere('page_category','','');
		$this->load->view('site/information/archive',$data);
	}
	function single(){
		
		$slugs = $this->uri->segment(3);
		$data['page_title'] = "Databank Nepal Bus Ticketing Service ";
		$data['ticket_ttile'] = "Single Post";
		$where = array('slug'=>$slugs);
		$data['all'] =   $this->site_model->getwhere('content_serup',$where,'');
		$data['cat'] =   $this->site_model->getwhere('page_category','','');
		$this->load->view('site/information/singlepost',$data);
		
	}
}