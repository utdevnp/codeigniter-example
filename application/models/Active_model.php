<?php 
class active_model extends CI_Model{
     function active($id,$table,$baseurl){
            //$id = $this->uri->segment(5);
            $res = $this->db->where('id',$id);
            $res = $this->db->set('is_active', 'Y'); //value that used to update column  
            $res = $this->db->update($table);
            if($res){
            	$this->session->set_userdata($this->messages->success());
                redirect(ADMIN_BASE.$baseurl);
            }else{
            	        	
            	$this->session->set_userdata($this->messages->error());
                redirect(ADMIN_BASE.$baseurl);
            }
       }

       function deactive($id,$table,$baseurl){
            //$id = $this->uri->segment(5);
            $res = $this->db->where('id',$id);
            $res = $this->db->set('is_active', 'N'); //value that used to update column  
            $res = $this->db->update($table);
            if($res){
            	$this->session->set_userdata($this->messages->success());
                 redirect(ADMIN_BASE.$baseurl);
            }else{
               $this->session->set_userdata($this->messages->error());
                 redirect(ADMIN_BASE.$baseurl);
            }
       }

}

?>