
<?php
class messages extends CI_Model {

	function information(){
	$msg = array('class'=>'info','message'=>INFORMATION_MSG,'msg_id'=>'user_insert_msg','title'=>'Information');
	return $msg;
	}

	function success(){
	$msg = array('class'=>'success','id'=>'greenmsg','message'=>MSG_SUCCESS,'msg_id'=>'user_insert_msg','title'=>'Success');
	return $msg;
	}
	function error(){
	$msg = array('class'=>'danger','id'=>'redmsg','message'=>MSG_ERROR,'msg_id'=>'user_insert_msg','title'=>'Error');
	return $msg;
	}

	function idnotfound(){
	$msg = array('class'=>'warning','message'=>MSG_ID_NOT_FOUND,'msg_id'=>'user_insert_msg','title'=>'Success');
	}

	function passwordnotmatch(){
	$msg = array('class'=>'warning','id'=>'yellowmsg','message'=>MSG_PASSWORD_NOT_MATCH,'msg_id'=>'user_insert_msg','title'=>'Warning');
	return $msg;
	}

	function oldpaswordnotmatch(){
	$msg = array('class'=>'warning','id'=>'yellowmsg','message'=>MSG_OLD_PASSWORD_NOT_MATCH,'msg_id'=>'user_insert_msg','title'=>'Warning');
	return $msg;
	}

	function alreadyexist(){
	$msg = array('class'=>'warning','message'=>MSG_ALREADY_EXIST,'msg_id'=>'user_insert_msg','title'=>'Warning');
	return $msg;
	}

	function trashed(){
	$msg = array('class'=>'success','message'=>MSG_TRASHED,'msg_id'=>'user_insert_msg','title'=>'Success');
	return $msg;
	}

	function registration(){
	$msg = array('class'=>'success','message'=>MSG_REGISTRATION_SUCCESS,'msg_id'=>'user_insert_msg','title'=>'Retistration Success');
	return $msg;
	}
	function loginerror(){
	$msg = array('class'=>'warning', 'id'=>'redmsg' ,'message'=>INVALID_LOGIN,'msg_id'=>'user_insert_msg','title'=>'Invalid Login');
	return $msg;
	}


	function accessdenid(){
	$msg = array('class'=>'warning','message'=>ACCESS_DENIED,'msg_id'=>'user_insert_msg','title'=>'Access Denied');
	return $msg;
	}
	function notfound(){
	$msg = array('class'=>'danger','message'=>MSG_NOTFOUND,'msg_id'=>'user_insert_msg','title'=>'Not Found');
	return $msg;
	}

	function ticketnotfound(){
	$msg = array('class'=>'danger','id'=>'redmsg' ,'message'=>TICKET_NOT_FOUND,'msg_id'=>'user_insert_msg','title'=>'Not Found');
	return $msg;
	}

	function sugnupsuccess(){
	$msg = array('class'=>'success', 'id'=>'greenmsg','message'=>SIGNUP_SUCCESS,'msg_id'=>'user_insert_msg','title'=>'Sugnup Success');
	return $msg;
	}

	function invalidkey(){
	$msg = array('class'=>'success', 'id'=>'redmsg','message'=>INVALID_KEY,'msg_id'=>'user_insert_msg','title'=>'Invalid verification link ');
	return $msg;
	}

	function successverufy(){
	$msg = array('class'=>'success', 'id'=>'greenmsg','message'=>SUCCESS_VERIFY,'msg_id'=>'user_insert_msg','title'=>'Success ');
	return $msg;
	}
	function forgetpassword(){
	$msg = array('class'=>'success', 'id'=>'greenmsg','message'=>FORGET_SENT_LINK,'msg_id'=>'user_insert_msg','title'=>'Success ');
	return $msg;
	}
	
	function cannotRegisterAccount(){
	$msg = array('class'=>'danger', 'id'=>'redmsg','message'=>CANNOT_REGISTER_ACCOUNT,'msg_id'=>'user_insert_msg','title'=>'Sorry ');
	return $msg;
	}
	function SearchEmpty(){
	$msg = array('class'=>'danger', 'id'=>'yellowmsg','message'=>BUS_SEARCH_EMPTY,'msg_id'=>'user_insert_msg','title'=>'Warning');
	return $msg;
	}
	
	function Not_available(){
	$msg = array('class'=>'danger', 'id'=>'yellowmsg','message'=>ALREADY_BOOKED,'not_available'=>'not_available','title'=>'Warning');
	return $msg;
	}
	
}