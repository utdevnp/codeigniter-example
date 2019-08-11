<?php $this->load->view('inc/headerfiles');?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('inc/adminheader');?>
  <?php $this->load->view('inc/adminnavbar');?>
  <?php foreach($user_type as $user){
  		$usertype 	= 	$user['user_type'];
  	}

  	 	if($usertype 	==	"company"){
  			$this->load->view('inc/companydashboard');
  		}else if($usertype 	==	"admin"){
			   $this->load->view('inc/maindashboard');
		} else 
			$this->load->view('inc/companydashboard');
		?>
 
  <?php $this->load->view('inc/admincontrolsidebar');?>
</div>
<!-- ./wrapper -->
</body>
<?php $this->load->view('inc/footer');?>