
<?php if($this->session->userdata('msg_id')){ ?>  
    <div class="alert notice notice-<?php echo $this->session->userdata('class');?>">
		<button href="#" type="button" class="close"> <i data-dismiss="alert" class="fa fa-times"></i> </button>
		<strong><?php echo  $this->session->userdata('title');?> !!  </strong> 
	<?php 
		echo  $this->session->userdata('message'); 
		
   	    $this->session->unset_userdata('msg_id');
    ?>
	</div>


<?php }?>



