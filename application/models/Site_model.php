  <?php
Class Site_model extends CI_Model{

function __construct() {
		$this->tableName = 'bus_user';
		$this->primaryKey = 'id';
	}
	
 function getbususerbyfield($table,$where,$field){
    $this->db->select($field);
    $query = $this->db->get_where($table,$where); 
    $que  = $query->result_array();
    foreach($que as $userinfo){
     	return  $userinfo[$field];
    }
  }

  function returnfieldvalue($table,$where,$field){
    $this->db->select($field);
    $query = $this->db->get_where($table,$where); 
    $que  = $query->result_array();
    foreach($que as $userinfo){
     	return  $userinfo[$field];
    }
  }
  function returnfield($table,$where,$field){
	  if($field!==""){
    $this->db->select($field);
	  }
	if($where!==""){
		$this->db->where($where);
	}
	//$active  =  array('is_active'=>"Y",'is_temp'=>"Y");
    //$this->db->where($active);
    $query = $this->db->get($table); 
    $que  = $query->result_array();
	if($field!==""){
    foreach($que as $userinfo){
     	$seats[] =   $userinfo[$field];
    }
	return @$seats;
	}else {
		return @$que;
	}
  }
  
  function getwhere($table,$where,$limit){
	  if($limit!==""){
		  $query = $this->db->limit($limit);
	  }
	  if($where!==""){
		  $query = $this->db->get_where($table,$where);
	  }else{
		$query = $this->db->get($table);  
	  }
    $que  = $query->result_array();
     return  $que	;
  }
  
  function getorderbylimit($table,$where,$limit,$orderby,$otype){
	  if($limit!==""){
		  $query = $this->db->limit($limit);
	  }
	  if($orderby!==""){
		  $query = $this->db->order_by($orderby,$otype);
	  }
	  if($where!==""){
		  $query = $this->db->get_where($table,$where);
	  }else{
		$query = $this->db->get($table);  
	  }
    $que  = $query->result_array();
     return  $que	;
  }
  
  
   function checkFbloginUser($data = array()){
	$this->db->select($this->primaryKey);
		$this->db->from($this->tableName);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['addinfo'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert($this->tableName,$data);
			$userID = $this->db->insert_id();
		}

		return $userID?$userID:FALSE;
    }
	
  

}
?>