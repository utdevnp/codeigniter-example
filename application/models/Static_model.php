  <?php
Class static_model extends CI_Model{

	function getpermissionbyusername($user)
	{
		$d = $this->db->select('id'); 
		$query = $this->db->get_where('control_login',array('username'=>$user));
        $id  = $query->result_array();
        foreach ($id as $key) {
        	$userr_id = $key['id'];
        }
        
		$e = $this->db->select('permission'); 
		$query = $this->db->get_where('permission',array('user_id'=>$userr_id));
        $id  = $query->result_array();
        foreach ($id as $key) {
        	return explode(',',$key['permission']);
        }
	}


	function getmenusbyuri($uri){
     $this->db->select('menus');  
     $query = $this->db->get_where('menu_setup',array('pseudo_name'=>$uri));
     $menus  = $query->result_array();
        foreach ($menus as $key) {
        	return explode(',',$key['menus']);
        }
    }

    function permissoncheck_($uriseg1,$uriseg2,$user){
    	$permittedvalue = $this->getpermissionbyusername($user);
    	if(!empty($uriseg2))
    	{
    		 $fulluri = $uriseg1."/".$uriseg2;
    		 if(! in_array($fulluri,$permittedvalue))
        	{
        		//print_r($permittedvalue);
	        	$msg = array('class'=>'warning','message'=>ACCESS_DENIED,'msg_id'=>'user_insert_msg','title'=>'Access Denied');
	        	$this->session->set_userdata($msg);
	          	redirect(ADMIN_BASE.$uriseg1);
        	}

    	} 
    }

        function useridbyusername($user){
    
        $d = $this->db->select('id'); 
        $query = $this->db->get_where('control_login',array('username'=>$user));
        $id  = $query->result_array();
        foreach ($id as $key) {
            return $key['id'];
        }
    }

    function companyidbyusername($user){
    
        $d = $this->db->select('id'); 
        $query = $this->db->get_where('control_login',array('username'=>$user));
        $id  = $query->result_array();
        foreach ($id as $key) {
            $user_id =  $key['id'];
        }

        $d = $this->db->select('id'); 
        $query = $this->db->get_where('company_setup',array('user'=>$user_id));
        $id  = $query->result_array();
        foreach ($id as $key) {
            return  $key['id'];
        }

    }

    function getcompnayidbyparentid($user){
    
        $query = $this->db->select('user'); 
        $query = $this->db->select('id'); 
        $query = $this->db->select('user_type'); 
        $query = $this->db->get_where('control_login',array('username'=>$user));
        $id  = $query->result_array();
        foreach ($id as $key) {
            if($key['user_type']=='company'){
                //$user_id =  $key['id'];
                $qry = $this->db->get_where('company_setup',array('user'=>$key['id'])); 
			    $res = $qry->result_array();
			    foreach($res as $co){
					$comid = $co['id'];
				}
			}else{
              $user_id =  $key['user'];   
            }  
        }

        $d = $this->db->select('id'); 
        $query = $this->db->get_where('company_setup',array('user'=>@$user_id));
        $id  = $query->result_array();
        foreach ($id as $key) {
             $comid = $key['id'];
        }
          return $comid;
    }

            // Dynamic functioln for two where condition 
     function doublewhere($table,$valA,$valB,$fieldA,$fieldB){

        $quer =     $this->db->where(array($fieldA=>$valA, $fieldB=>$valB));
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function monthlyrecapreport(){
       $field  = 'id,name';    
       $table = 'passengers_ticket_info'; 
        
       for($i=1; $i<=12; $i++)
       {
        if($i<10)
        {
          $fromdate = date('Y-0'.$i.'-01');
         $todate = date('Y-0'.$i.'-30');
       }else{
          $fromdate = date('Y-'.$i.'-01');
         $todate = date('Y-'.$i.'-30');
        }
       $this->db->select($field);
       $query = $this->db->get_where($table,"(DATE(addiinfo) BETWEEN '".$fromdate."' AND '".$todate."')");
       $jan[] = count($query->result_array());
     }
        return $jan;
      }


       function monthlyrecapreportcom(){
       $field  = 'id,name';    
       $table = 'passengers_ticket_info'; 
       $company =  $this->static_model->companyidbyusername($this->session->userdata('eBusLogin'));

       for($i=1; $i<=12; $i++)
       {
        if($i<10)
        {
          $fromdate = date('Y-0'.$i.'-01');
         $todate = date('Y-0'.$i.'-30');
       }else{
          $fromdate = date('Y-'.$i.'-01');
         $todate = date('Y-'.$i.'-30');
        }
       //$this->db->select($field);
       $this->db->where('company',$company);
       $query = $this->db->get_where($table,"(DATE(addiinfo) BETWEEN '".$fromdate."' AND '".$todate."') ");
        $jan[] = count($query->result_array());
     }
        return $jan;
      }

      function monthlyrecapreportcomtot(){
       $field  = 'id,name';
       $total = 0;    
       $table = 'passengers_ticket_info'; 
       $company =  $this->static_model->companyidbyusername($this->session->userdata('eBusLogin'));

       for($i=1; $i<=12; $i++){
        if($i<10){
              $fromdate = date('Y-0'.$i.'-01');
             $todate = date('Y-0'.$i.'-30');
        }else{
              $fromdate = date('Y-'.$i.'-01');
             $todate = date('Y-'.$i.'-30');
            }
       
       $this->db->where('company',$company);
       $query = $this->db->get_where($table,"(DATE(addiinfo) BETWEEN '".$fromdate."' AND '".$todate."') ");
            $tot = $query->result_array();
            if(count($tot) > 0){
                foreach($tot as $amo){
                  $total  = $total + $amo['total'];
                }
                $jan[]=$total;
            }else 

                $jan[] = count($tot);
        
     }
    
        return $jan;
      }

    function betweenwhere($table,$valA,$valB,$fieldA,$fieldB,$fielde,$now,$endTime){
        
        $query = $this->db->where("(DATE(".$fielde.") BETWEEN '".$now."' AND '".$endTime."')");
        $quer =     $this->db->where(array($fieldA=>$valA, $fieldB=>$valB));
        $query = $this->db->get($table);
        return $query->result_array();
      }

      function selectbetween($table,$fieldA,$val,$fielde,$now,$endTime){
        
        $query = $this->db->where("(DATE(".$fielde.") BETWEEN '".$now."' AND '".$endTime."')");
        $quer =     $this->db->where(array($fieldA=>$val));
        $query = $this->db->get($table);
        return $query->result_array();
      }


      function gettime($sdate,$edate){
		  $sdate = date("H:i", strtotime($sdate));
		  $edate = date("H:i", strtotime($edate));
         $start_date = new DateTime($sdate,new DateTimeZone('Asia/Kathmandu'));
        $end_date = new DateTime($edate, new DateTimeZone('Asia/Kathmandu'));
		
        $interval = $start_date->diff($end_date);
        $hours   = $interval->format('%h'); 
        $minutes = $interval->format('%i');
       return $hours." hours ".$minutes." minutes";
      }
	  
	  function Urlformat($curl)
	{
		$curl=strtolower($curl);
		$curl=str_replace(" ","-","$curl");
		$curl=str_replace("&","and","$curl");
		$curl=str_replace("_","-","$curl");
		$curl=str_replace("/","-","$curl");						
		$curl=str_replace("\\"," ","$curl");						
		$curl=str_replace("'","t","$curl");						
		$curl=str_replace("@","-","$curl");						
		$curl=str_replace("~","-","$curl");							
		$curl=str_replace("#","-","$curl");
		$curl=str_replace("$","-","$curl");
		$curl=str_replace(".","","$curl");																										
		$curl=str_replace("[","","$curl");
		$curl=str_replace("]","","$curl");
		$curl=str_replace("+","-","$curl");
		$curl=str_replace("|","-","$curl");
		$curl=str_replace(",","-","$curl");
		return $curl;
	}
}

?>