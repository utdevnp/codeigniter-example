<?php
class dynamic_query extends CI_Model {

	function getbyid($id,$table){
		$query = $this->db->get_where($table,array('id'=>$id));
		return $query->result_array();
	}

  function getbyuserid($id,$table){
    $query = $this->db->get_where($table,array('user_id'=>$id));
    return $query->result_array();
  }

  function getallactive($table,$active){
    $query = $this->db->get_where($table,array('is_active'=>$active));
    return $query->result_array();
  }

   function getallactiveWithParent($table,$active){
    $query = $this->db->get_where($table,array('is_active'=>$active,'parent'=>0));
    return $query->result_array();
  }

   function countChildren($table,$parent){
    $query = $this->db->get_where($table,array('parent'=>$parent));
    return $query->result_array();
  }


  function getbyusername($username,$table){
    $query = $this->db->get_where($table,array('username'=>$username));
    return $query->result_array();
  }

 function getall($table){
    $query =  $this->db->get($table);
     return $query->result_array();
  }
   function getallbyorder($table,$orderby,$order){
	$this->db->order_by($orderby,$order);
    $query =  $this->db->get($table);
     return $query->result_array();
  }

  function select_fields($id,$table,$fields){
     $this->db->select($fields); 
     if($id!==""){
       $this->db->where('id', $id);
     }
       $query =$this->db->get($table); 
       return $query->result_array();
  }

  function getbyactive($table,$active){
      $query =  $this->db->get_where($table,array('is_active'=>$active));
    return $query->result_array();
  }


function countall($table,$fields,$value){
    if($fields!=="" AND $value !==""){
      $this->db->where($fields,$value);
    }
    $query =  $this->db->count_all_results($table);
    return $query;
  }

  
  function trashbyuserid($id,$table,$baseurl){
        $this->db->where('user_id',$id);
        $res = $this->db->delete($table);
        if($res){
           $this->session->set_userdata($this->messages->trashed());
            redirect(ADMIN_BASE.$baseurl);
        }else{
           $this->session->set_userdata($this->messages->error());
            redirect(ADMIN_BASE.$baseurl);
        }
   }


	function trash($id,$table,$baseurl){
        $this->db->where('id',$id);
        $res = $this->db->delete($table);
        if($res){
           $this->session->set_userdata($this->messages->trashed());
            redirect(ADMIN_BASE.$baseurl);
        }else{
           $this->session->set_userdata($this->messages->error());
            redirect(ADMIN_BASE.$baseurl);
        }
   }

   // parent bata nekaleko
   function getpermissonbyparentid($user_id,$table){
    $query = $this->db->get_where($table,array('user_id'=>$user_id));
    return $query->result_array();
  }

  function getuserpermision($id,$table){
    $query = $this->db->get_where($table,array('user_id'=>$id));
    return $query->result_array();
  }

  function select_fields_by_active($table,$from,$to,$active){
     
        $query = $this->db->select('*');
        $query = $this->db->from($table); 
        $query = $this->db->where(array('from'=>$from, 'to'=>$to, 'is_active'=>$active));
        $query = $this->db->get();
        return $query->result_array();
  }

   function get_by_date($table,$date,$active){
    
       $query = $this->db->select('*');
       $query = $this->db->from($table); 
       $query = $this->db->where(array('departure'=>$date,'is_active'=>$active));
       $query = $this->db->get();
       return $query->result_array();
  }

function getbysid($id,$table){
    $query = $this->db->get_where($table,array('sid'=>$id));
    return $query->result_array();
  }

  function get_by_busno($table,$bus_no,$active){
    
       $query = $this->db->select('*');
       $query = $this->db->from($table); 
       $query = $this->db->where(array('bus_no'=>$bus_no,'is_active'=>$active));
       $query = $this->db->get();
       
       return $query->result_array();
  }


function getbus_by_datebus($table,$ticket_for,$bus_no,$active){
     
        $query = $this->db->select('*');
        $query = $this->db->from($table); 
        $query = $this->db->where(array('departure'=>$ticket_for, 'bus_no'=>$bus_no, 'is_active'=>$active));
        $query = $this->db->get();
        
        return $query->result_array();
  }


  function search_by_all($table,$date,$from,$to,$active){
     
        $query = $this->db->select('*');
        $query = $this->db->from($table); 
        $query = $this->db->where(array('departure'=>$date,'from'=>$from, 'to'=>$to, 'is_active'=>$active));
        $query = $this->db->get();

       return $query->result_array();
  }


   function search_by_all_bus_no($table,$date,$from,$to,$bus_no,$active){
     
        $query = $this->db->select('*');
        $query = $this->db->from($table); 
        $query = $this->db->where(array('departure'=>$date,'from'=>$from, 'to'=>$to, 'bus_no'=>$bus_no, 'is_active'=>$active));
        $query = $this->db->get();
       return $query->result_array();
  }

  function getby($val,$table,$field){
    $query = $this->db->get_where($table,array($field=>$val)); 
    return $query->result_array();
  }

function getbyscheadual($sid,$maintable,$table,$fieldA,$fieldB){
        //$query = $this->db->select($fieldA);
        $query = $this->db->get_where($maintable,array('id'=>$sid));
        $res  = $query->result_array();
        foreach($res as $col){
          $value =  $col[$fieldA];

        }
      
        
      // $que = $this->db->select($fieldB);
      $que  = $this->db->get_where($table,array('id'=>$value));
       return $que->result_array();
      // print_r($qu);
      // die();
       
    }

function nestedselect($table,$fiesd,$tableA,$id,$fiesdA,$fiesdB,$tableB){

          $que  = $this->db->get_where($table,array('id'=>$id));
          $bid  = $que->result_array();
          foreach ($bid as $buskey) {
            $key_id =  $buskey[$fiesd];
        }
   
        $query = $this->db->get_where($tableA,array('id'=>$key_id));
        $id  = $query->result_array();
        foreach ($id as $key) {
            $keys =  $key[$fiesdA];
        }
        
        
        $query = $this->db->get_where($tableB,array($fiesdB=> $keys));
        $id  = $query->result_array();
        foreach ($id as $keys) {
            return  $keys[$fiesdB];
        }

    }

  function todaycountall($table,$date,$field,$title,$value){
      if($title!=="" AND $value !== ""){
        $this->db->where($title,$value);
      }

       $this->db->where($field,$date);
      $query =  $this->db->count_all_results($table);
      return $query;
    }
  function getallonorderlimit($table,$orderby,$order,$limitto,$limitfr){
      $this->db->limit($limitfr,$limitto);
       $this->db->order_by($orderby,$order);
       $query =  $this->db->get($table);
       return $query->result_array();
    }

  function todaycounttimestamp($table,$tdate,$field){
       $this->db->where('STR_TO_DATE('.$field.', "%Y-%m-%d") =',$tdate);
      $query = $this->db->count_all_results($table);
      return $query  ;
  }

    function todaytimestamp($table,$tdate,$field){
       $this->db->where('STR_TO_DATE('.$field.', "%Y-%m-%d") =',$tdate);
      $query = $this->db->get($table);
      $today = $query->result_array();

      
      return $today;
      
  }

 function bookingclose()
    {
      $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
        $nowtime = $dateTime->format("h:i A");
		$time_in_24_hour_format_now  = date("H:i", strtotime($nowtime)); 
	
        $date = date('Y-m-d');
      $query = $this->db->select('departure,id,departuretime');
        $query = $this->db->get_where('bus_scheadual',array('departure'=>$date));
        $res  = $query->result_array();
        foreach($res as $dbuses){
		 $time_in_24_hour_format_departing  = date("H:i", strtotime($dbuses['departuretime']));	
		
          if($time_in_24_hour_format_now >=  $time_in_24_hour_format_departing){
            $res = $this->db->where('id',$dbuses['id']);
            $res = $this->db->set('is_active', 'N'); //value that used to update column  
            $res = $this->db->update('bus_scheadual');
          }
        }

        $beforeclose = $this->getby('Y','bus_scheadual','is_active');
        foreach($beforeclose as $colose){
          if($date > $colose['departure']){
          $res = $this->db->where('id',$colose['id']);
          $res = $this->db->set('is_active', 'N'); //value that used to update column  
          $res = $this->db->update('bus_scheadual');
        }
      }

        $query =  $this->db->where(array('is_active'=>'N','departure <'=>$date));
        return $query->count_all_results('bus_scheadual');
        $this->db->last_query();
    }
	
	function tmp_seats_trash(){
		
		$dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
		$nowtime = $dateTime->format("h:i A"); 
		$tmpseat  =  $this->getall('temp_sheet');
		foreach($tmpseat as $tmpbooked){
		    $tmp_time = $tmpbooked['tmptime'];
		    $next = date('h:i A', strtotime('+5 minutes', strtotime($tmp_time)));
		    $id = $tmpbooked['id'];
			if($nowtime>=$next){
				$this->db->delete('temp_sheet',array('id'=>$id));
			}
		}
	}

	
  function like($table,$field,$value){
      $this->db->select($field);
     $this->db->like($field, $value);
    $query = $this->db->count_all_results($table);
    return $query;
    }
  function getdepartedBydate($table,$tdate){
     $this->db->where('departure <',$tdate);
     $this->db->where('is_active <','N');
    $query = $this->db->count_all_results($table);
    return $query  ;
    }


  function nestedselect3rd($table,$fiesd,$tableA,$id,$fiesdA,$fiesdB,$tableB,$fieldC){

          $que  = $this->db->get_where($table,array('id'=>$id));
          $bid  = $que->result_array();
          foreach ($bid as $buskey) {
            $key_id =  $buskey[$fiesd];
        }
   
        $query = $this->db->get_where($tableA,array('id'=>$key_id));
        $id  = $query->result_array();
        foreach ($id as $key) {
            $key_id =  $key[$fiesdA];
        }
        
        
        $query = $this->db->get_where($tableB,array($fiesdB=> $key_id));
        $id  = $query->result_array();
        foreach ($id as $keys) {
            return  $keys[$fieldC];
        }

    }

     function ipblock(){
      $latest_login = $this->getall('login');
      foreach($latest_login as $login){
      $intvday = "0 days";
      $intvtime = "-30 minutes";
      $datef  = "Y-m-d";
      $timef  = "Y-m-d H:i";
      $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
      $now = $dateTime->format($datef); 
      $endTime = date($datef,strtotime($intvday,strtotime($now)));
    //betweenwhere($table,$valA,$valB,$fieldA,$fieldB,$intvtime,$fielde,$datef)
     $todaylogin = $this->static_model->betweenwhere('login',$login['ip'],'N','ip','auth','logged',$now,$endTime);
     foreach($todaylogin as $tlogin){
      //   // getorderby($mfield,$table,$field,$order,$orderby)
        $where = array('auth'=>'N','ip'=>$tlogin['ip']);
        $timeintvl = $this->getorderbylimit($where,'login','desc','id',1,0);
        //echo $this->db->last_query();
        foreach($timeintvl as $timint){  $last =  $timint['logged']; }
       
        $timeintvl2 = $this->getorderbylimit($where,'login','asc','id',1,0);
        foreach($timeintvl2 as $timint1){ $first = $timint1['logged']; $ip = $timint1['ip'];}
        $count =  count($todaylogin);
          $datetime1 = new DateTime($first);
          $datetime2 = new DateTime($last);
          $interval = $datetime1->diff($datetime2);
          $minutes= $interval->format('%i');
          if($minutes<30 AND $count>3){
            $data['attemp'] = 6;
            $this->db->where('ip',$ip);
            $this->db->update('login',$data);
          }

       }

      }
     
    }


    function siteblock($ip){
       $where = array('auth'=>'N','ip'=>$ip);
        $blockuser = $this->getorderbylimit($where,'login','desc','id',4,0);
        $count = count($blockuser);
         foreach($blockuser as $block){
          @$attemp2 =    $block['attemp'];
          @$ip =    $block['ip'];
       }
       if(@$attemp2 >3 AND $count>3){
             return $ip;
             $this->session->unset_userdata('eBusLogin');
             redirect('control/login');
           
       }

    }

    function delete($field,$fieldA,$table,$baseurl){
        $this->db->where($field,$fieldA);
        $res = $this->db->delete($table);
        if($res){
           $this->session->set_userdata($this->messages->trashed());
            redirect(ADMIN_BASE.$baseurl);
        }else{
           $this->session->set_userdata($this->messages->error());
            redirect(ADMIN_BASE.$baseurl);
        }
   }

   function getorderbylimit($where,$table,$order,$orderby,$limitfr,$limitto){
      $this->db->limit($limitfr,$limitto);
       $query = $this->db->order_by($orderby,$order);
      $query = $this->db->get_where($table,$where); 
      return $query->result_array();
    }

    function getbywhere($table,$where){
    $query = $this->db->get_where($table,$where); 
    return $query->result_array();
  }

}

?>