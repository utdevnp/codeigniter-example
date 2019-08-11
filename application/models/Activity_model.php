<?php 
class Activity_model extends CI_Model {

	function ActivityRunner($menu_name,$action,$id,$userid){
		$array = array();
		$query = $this->db->get_where('menu_setup',array('is_active'=>'Y'));
		$getmenus =   $query->result_array();
		foreach($getmenus as $menusetup){
			if($menusetup['pseudo_name']==$menu_name){
				$array['menuid'] = $menusetup['id'];
			}
		}
		$query1 = $this->db->get_where('minmenu',array('is_active'=>'Y'));
		$getactionmenus =  $query1->result_array();
		foreach($getactionmenus as $mainmenu){
			if($mainmenu['title']==$action){
				echo $array['actionid'] = $mainmenu['id'];
			}
		}
		$array['ackey']  = $id;
		$data['shskey'] =  implode(",",$array);
		$data['user_id'] = $userid;
		$this->db->insert('activity',$data);

	}

	function getagent(){
		if ($this->agent->is_browser())
			{
			        $agent = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
			        $agent = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
			        $agent = $this->agent->mobile();
			}
			else
			{
			        $agent = 'Unidentified User Agent';
			}

			return $agent; // Platform info (Windows, Linux, Mac, etc.)
	}

 
function forgotpwemail($to_email,$link){
$ip = $this->input->ip_address();
$config = Array(        
'protocol' => 'sendmail',
'smtp_host' => 'databanknepal.com',
'smtp_port' => 25,
'smtp_timeout' => '4',
'mailtype'  => 'html', 
'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->from('noreply@databanknepal.com', 'Databank Booking - Password reset request');
$this->email->to($to_email);  // replace it with receiver mail id
$this->email->subject('Password reset request'); // replace it with relevant subject 
$body =  "
Dear ".$to_email.",\n
We got the word that you forgot your password.\n
To reset your Databank Booking  password for the account with the email , click the link below and reset your password.\n
".$link." \n 
IP Address  :".$ip." \n
* NOTE: Please don not reply this email
";
$this->email->message($body);   
$this->email->send();
}
	
function registersuccess($to_email,$link){ 
$ip = $this->input->ip_address();
$config = Array(        
'protocol' => 'sendmail',
'smtp_host' => 'databanknepal.com',
'smtp_port' => 25,
'smtp_timeout' => '4',
'mailtype'  => 'html', 
'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->from('noreply@databanknepal.com', 'Databank Booking - Email verifying request');
$this->email->to($to_email);  // replace it with receiver mail id
$this->email->subject('Email verifying request'); // replace it with relevant subject 
$body =  "
Dear ".$to_email.",\n
You're receiving this message because you've registered on databankbooking.com \n
To verify  your email, please click the link below:
".$link."  \n 
IP Address  :".$ip." \n
NOTE: Please do not reply this email";
$this->email->message($body);
$this->email->send();
}

function registersuccessAndroid($to_email,$link,$ip){ 
$config = Array(        
'protocol' => 'sendmail',
'smtp_host' => 'databanknepal.com',
'smtp_port' => 25,
'smtp_timeout' => '4',
'mailtype'  => 'html', 
'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->from('noreply@databanknepal.com', 'Databank Booking - Email verifying request');
$this->email->to($to_email);  // replace it with receiver mail id
$this->email->subject('Email verifying request'); // replace it with relevant subject 
$body =  "
Dear ".$to_email.",\n
You're receiving this message because you've registered on databankbooking.com \n
To verify  your email, please input the code given below:
".$link."  \n 
IP Address  :".$ip." \n
NOTE: Please do not reply this email";
$this->email->message($body);
$this->email->send();
}
	  
         




	function autoload(){
		$this->dynamic_query->ipblock();
		$this->dynamic_query->siteblock($this->input->ip_address());
		$this->dynamic_query->bookingclose();
		$this->dynamic_query->tmp_seats_trash(); 
		
	}

}
?>